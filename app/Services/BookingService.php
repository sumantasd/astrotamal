<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\BlockedSlot;
use App\Models\DateScheduleOverride;
use App\Models\PaymentTransaction;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingService
{
    /**
     * Get price for consultation type.
     */
    public static function getConsultationPrice(string $type): float
    {
        return strtolower($type) === 'urgent' ? 5000.00 : 3000.00;
    }

    /**
     * Generate unique booking reference.
     */
    public static function generateBookingReference(): string
    {
        do {
            $reference = 'ASTRO-' . date('Y') . '-' . strtoupper(Str::random(6));
        } while (Appointment::where('booking_reference', $reference)->exists());

        return $reference;
    }

    /**
     * Get schedule configuration (opening, closing, slot duration) for a date.
     */
    public static function getScheduleConfigForDate(string $date): array
    {
        $override = DateScheduleOverride::whereDate('override_date', $date)
            ->where('is_active', true)
            ->first();

        if ($override) {
            return [
                'opening' => $override->opening_time,
                'closing' => $override->closing_time,
                'duration' => (int) $override->slot_duration_minutes,
                'is_override' => true,
                'reason' => $override->reason,
            ];
        }

        return [
            'opening' => SiteSetting::get('booking_opening_time', '09:00 AM'),
            'closing' => SiteSetting::get('booking_closing_time', '08:00 PM'),
            'duration' => (int) SiteSetting::get('booking_slot_duration', 30),
            'is_override' => false,
            'reason' => null,
        ];
    }

    /**
     * Generate time slots array for given opening, closing, and duration.
     */
    public static function generateTimeSlots(string $openingTime, string $closingTime, int $durationMinutes = 30): array
    {
        $slots = [];

        try {
            $start = Carbon::parse($openingTime);
            $end = Carbon::parse($closingTime);
        } catch (\Throwable $e) {
            $start = Carbon::parse('09:00 AM');
            $end = Carbon::parse('08:00 PM');
        }

        if ($start->gte($end)) {
            return ['09:00 AM'];
        }

        $current = $start->copy();
        while ($current->lte($end)) {
            $slots[] = $current->format('h:i A');
            $current->addMinutes($durationMinutes);
        }

        return $slots;
    }

    /**
     * Check if a date and time slot is available for booking.
     */
    public static function isSlotAvailable(string $date, string $time, ?int $excludeAppointmentId = null): bool
    {
        // Past date/time restriction check
        $tz = 'Asia/Kolkata';
        $today = Carbon::now($tz)->format('Y-m-d');
        if ($date < $today) {
            return false;
        }

        if ($date === $today) {
            try {
                $slotTime = Carbon::parse($date . ' ' . $time, $tz);
                if ($slotTime->lt(Carbon::now($tz))) {
                    return false;
                }
            } catch (\Throwable $e) {
                // Ignore parse failures
            }
        }

        // 1. Check if full date or specific time slot is explicitly blocked by admin
        $blockedQuery = BlockedSlot::where(function ($query) {
                $query->where('is_active', true)
                      ->orWhereNull('is_active');
            })
            ->where(function ($query) use ($date) {
                $query->whereDate('blocked_date', $date)
                      ->orWhere(function ($q) use ($date) {
                          $dayOfWeek = Carbon::parse($date)->dayOfWeek;
                          $dayName = Carbon::parse($date)->format('l');
                          $q->where('is_recurring', true)
                            ->where(function ($dw) use ($dayOfWeek, $dayName) {
                                $dw->where('day_of_week', (string)$dayOfWeek)
                                  ->orWhere('day_of_week', $dayName);
                            });
                      });
            })->get();

        foreach ($blockedQuery as $block) {
            if (empty($block->time_slot)) {
                // Full day block
                return false;
            }

            // Specific time slot block comparison
            $bSlot = trim($block->time_slot);
            $target = trim($time);

            if ($bSlot === $target) {
                return false;
            }

            // Check range containment or partial string match (e.g. "10:00 AM - 10:30 AM" vs "10:00 AM")
            if (str_contains($bSlot, $target) || str_contains($target, $bSlot)) {
                return false;
            }
        }

        // 2. Check for existing confirmed appointments or active 15-min reservations
        $occupiedQuery = Appointment::whereDate('preferred_date', $date)
            ->where(function ($q) use ($time) {
                $q->where('preferred_time', $time)
                  ->orWhere('preferred_time', 'like', "%{$time}%");
            })
            ->where(function ($query) {
                $query->whereIn('status', ['Confirmed', 'Completed'])
                      ->orWhere(function ($resQuery) {
                          $resQuery->where('status', 'Pending Payment')
                                   ->where('slot_reserved_until', '>', Carbon::now());
                      });
            });

        if ($excludeAppointmentId) {
            $occupiedQuery->where('id', '!=', $excludeAppointmentId);
        }

        return !$occupiedQuery->exists();
    }

    /**
     * Get list of generated slots for date with availability status.
     */
    public static function getAvailableSlotsForDate(string $date, ?int $excludeAppointmentId = null): array
    {
        $config = self::getScheduleConfigForDate($date);
        $allSlots = self::generateTimeSlots($config['opening'], $config['closing'], $config['duration']);

        $results = [];
        foreach ($allSlots as $slot) {
            $isAvailable = self::isSlotAvailable($date, $slot, $excludeAppointmentId);
            $results[] = [
                'time' => $slot,
                'available' => $isAvailable,
            ];
        }

        return [
            'date' => $date,
            'schedule' => $config,
            'slots' => $results,
        ];
    }

    /**
     * Create a new pending appointment with a 15-minute slot reservation.
     */
    public static function createPendingBooking(array $data): Appointment
    {
        return DB::transaction(function () use ($data) {
            $consultationType = strtolower($data['consultation_type'] ?? 'urgent');
            $amount = self::getConsultationPrice($consultationType);
            $reference = self::generateBookingReference();

            $birthTime = null;
            if (!empty($data['birth_time'])) {
                $timestamp = strtotime(trim($data['birth_time']));
                if ($timestamp !== false) {
                    $birthTime = date('H:i:s', $timestamp);
                }
            }

            $appointment = Appointment::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'booking_reference' => $reference,
                'name' => $data['name'],
                'email' => !empty($data['email']) ? $data['email'] : ($data['phone'] . '@astrotamal.com'),
                'phone' => $data['phone'],
                'whatsapp' => $data['whatsapp'] ?? $data['phone'],
                'birth_date' => $data['birth_date'] ?? null,
                'birth_time' => $birthTime,
                'birth_place' => $data['birth_place'] ?? null,
                'service_id' => $data['service_id'] ?? null,
                'consultation_type' => ucfirst($consultationType),
                'consultation_mode' => 'Audio',
                'preferred_date' => $data['preferred_date'],
                'preferred_time' => $data['preferred_time'],
                'notes' => $data['notes'] ?? null,
                'amount' => $amount,
                'status' => 'Pending Payment',
                'payment_status' => 'Pending',
                'slot_reserved_until' => Carbon::now()->addMinutes(15),
            ]);

            return $appointment;
        });
    }

    /**
     * Complete payment & confirm booking server-side atomically.
     */
    public static function confirmPaymentAndBooking(
        Appointment $appointment,
        string $paymentId,
        string $gateway = 'Razorpay',
        ?string $orderId = null,
        ?array $rawPayload = null
    ): Appointment {
        return DB::transaction(function () use ($appointment, $paymentId, $gateway, $orderId, $rawPayload) {
            $appointment = Appointment::where('id', $appointment->id)->lockForUpdate()->first();

            if ($appointment->payment_status === 'Paid' && $appointment->status === 'Confirmed') {
                return $appointment;
            }

            $appointment->update([
                'status' => 'Confirmed',
                'payment_status' => 'Paid',
                'payment_method' => $gateway,
                'payment_reference' => $paymentId,
                'slot_reserved_until' => null,
            ]);

            PaymentTransaction::create([
                'appointment_id' => $appointment->id,
                'booking_reference' => $appointment->booking_reference,
                'gateway' => $gateway,
                'order_id' => $orderId,
                'payment_id' => $paymentId,
                'amount' => $appointment->amount,
                'currency' => 'INR',
                'status' => 'Success',
                'gateway_response' => $rawPayload ? json_encode($rawPayload) : null,
            ]);

            self::sendBookingConfirmedEmail($appointment);

            return $appointment;
        });
    }

    /**
     * Record a payment failure and send failure notification.
     */
    public static function markPaymentFailed(
        Appointment $appointment,
        string $gateway = 'Razorpay',
        ?string $orderId = null,
        ?string $failureReason = null
    ): void {
        DB::transaction(function () use ($appointment, $gateway, $orderId, $failureReason) {
            $appointment->update([
                'payment_status' => 'Failed',
            ]);

            PaymentTransaction::create([
                'appointment_id' => $appointment->id,
                'booking_reference' => $appointment->booking_reference,
                'gateway' => $gateway,
                'order_id' => $orderId,
                'amount' => $appointment->amount,
                'currency' => 'INR',
                'status' => 'Failed',
                'refund_reason' => $failureReason,
            ]);
        });

        self::sendPaymentFailedEmail($appointment);
    }

    /**
     * Mark booking slot reservation expired and send expiry notification.
     */
    public static function markPaymentExpired(Appointment $appointment): void
    {
        if ($appointment->status === 'Pending Payment' || $appointment->payment_status === 'Pending') {
            $appointment->update([
                'status' => 'Expired',
                'payment_status' => 'Expired',
            ]);
        }

        self::sendPaymentExpiredEmail($appointment);
    }

    public static function sendWelcomeEmail(\App\Models\User $user): void
    {
        if (is_null($user->welcome_email_sent_at) && $user->email && filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            $updated = \App\Models\User::where('id', $user->id)
                ->whereNull('welcome_email_sent_at')
                ->update(['welcome_email_sent_at' => Carbon::now()]);

            if ($updated) {
                $user->welcome_email_sent_at = Carbon::now();
                try {
                    \Illuminate\Support\Facades\Mail::to($user->email)
                        ->send(new \App\Mail\CustomerWelcomeMail($user));
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('Failed sending CustomerWelcomeMail for user ' . $user->id . ': ' . $e->getMessage());
                }
            }
        }
    }

    public static function sendBookingConfirmedEmail(Appointment $appointment): void
    {
        if (is_null($appointment->confirmed_email_sent_at) && $appointment->email && filter_var($appointment->email, FILTER_VALIDATE_EMAIL)) {
            $updated = Appointment::where('id', $appointment->id)
                ->whereNull('confirmed_email_sent_at')
                ->update(['confirmed_email_sent_at' => Carbon::now()]);

            if ($updated) {
                $appointment->confirmed_email_sent_at = Carbon::now();
                try {
                    \Illuminate\Support\Facades\Mail::to($appointment->email)
                        ->send(new \App\Mail\BookingConfirmedMail($appointment));
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('Failed sending BookingConfirmedMail for ' . $appointment->booking_reference . ': ' . $e->getMessage());
                }
            }
        }
    }

    public static function sendPaymentFailedEmail(Appointment $appointment): void
    {
        if (is_null($appointment->failed_email_sent_at) && $appointment->email && filter_var($appointment->email, FILTER_VALIDATE_EMAIL)) {
            $updated = Appointment::where('id', $appointment->id)
                ->whereNull('failed_email_sent_at')
                ->update(['failed_email_sent_at' => Carbon::now()]);

            if ($updated) {
                $appointment->failed_email_sent_at = Carbon::now();
                try {
                    \Illuminate\Support\Facades\Mail::to($appointment->email)
                        ->send(new \App\Mail\PaymentFailedMail($appointment));
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('Failed sending PaymentFailedMail for ' . $appointment->booking_reference . ': ' . $e->getMessage());
                }
            }
        }
    }

    public static function sendPaymentExpiredEmail(Appointment $appointment): void
    {
        if (is_null($appointment->expired_email_sent_at) && $appointment->email && filter_var($appointment->email, FILTER_VALIDATE_EMAIL)) {
            $updated = Appointment::where('id', $appointment->id)
                ->whereNull('expired_email_sent_at')
                ->update(['expired_email_sent_at' => Carbon::now()]);

            if ($updated) {
                $appointment->expired_email_sent_at = Carbon::now();
                try {
                    \Illuminate\Support\Facades\Mail::to($appointment->email)
                        ->send(new \App\Mail\PaymentExpiredMail($appointment));
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('Failed sending PaymentExpiredMail for ' . $appointment->booking_reference . ': ' . $e->getMessage());
                }
            }
        }
    }
}
