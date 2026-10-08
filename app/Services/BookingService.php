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
     * Get configured app timezone.
     */
    public static function getTimezone(): string
    {
        return config('app.timezone', 'Asia/Kolkata');
    }

    /**
     * Get available slots for date and type (returns array of slot arrays).
     */
    public static function getAvailableSlots(string $date, string $type = 'urgent'): array
    {
        return self::getAvailableSlotsForDate($date, $type)['slots'];
    }

    public static function getScheduleConfigForDate(string $date): array
    {
        return [
            'opening' => '09:00 AM',
            'closing' => '08:00 PM',
            'duration' => 30,
        ];
    }

    public static function generateTimeSlots(string $start, string $end, int $duration = 30): array
    {
        $slots = [];
        $current = Carbon::parse($start);
        $endTime = Carbon::parse($end);
        while ($current <= $endTime) {
            $slots[] = $current->format('h:i A');
            $current->addMinutes($duration);
        }
        return $slots;
    }

    /**
     * Get minimum allowed booking date for a consultation type.
     */
    public static function getMinimumBookingDate(string $type): string
    {
        $tz = self::getTimezone();
        $today = Carbon::now($tz)->startOfDay();
        $type = strtolower($type);

        if ($type === 'urgent') {
            return $today->copy()->addDays(1)->format('Y-m-d');
        }

        // Normal consultation requires minimum 7 calendar days advance
        return $today->copy()->addDays(7)->format('Y-m-d');
    }

    /**
     * Check if a date satisfies minimum advance booking rules for type.
     */
    public static function isDateAllowedForType(string $date, string $type): bool
    {
        $minDate = self::getMinimumBookingDate($type);
        return $date >= $minDate;
    }

    /**
     * Normalize time slot string for consistent matching across system.
     */
    public static function normalizeSlot(string $slot): string
    {
        $slot = trim(str_replace(['–', '—'], '-', $slot));
        $parts = explode('-', $slot);
        if (count($parts) === 2) {
            $start = trim($parts[0]);
            $end = trim($parts[1]);
            try {
                $tStart = Carbon::parse($start)->format('g:i A');
                $tEnd = Carbon::parse($end)->format('g:i A');
                return $tStart . ' - ' . $tEnd;
            } catch (\Throwable $e) {
                return trim($start) . ' - ' . trim($end);
            }
        }
        return $slot;
    }

    /**
     * Master time slots for Urgent (3 slots) and Normal (10 slots).
     */
    public static function getMasterSlots(string $type): array
    {
        $type = strtolower($type);

        if ($type === 'urgent') {
            return [
                '9:00 PM - 9:20 PM',
                '9:25 PM - 9:45 PM',
                '9:50 PM - 10:10 PM',
            ];
        }

        return [
            '4:00 PM - 4:20 PM',
            '4:25 PM - 4:45 PM',
            '4:50 PM - 5:10 PM',
            '5:15 PM - 5:35 PM',
            '5:40 PM - 6:00 PM',
            '6:00 PM - 6:20 PM',
            '6:25 PM - 6:45 PM',
            '6:50 PM - 7:10 PM',
            '8:00 PM - 8:20 PM',
            '8:25 PM - 8:45 PM',
        ];
    }

    /**
     * Check if a slot is blocked by weekly recurring rules for the specified day of week.
     */
    public static function isWeeklyBlocked(string $type, int $dayOfWeek, string $slot): bool
    {
        $type = strtolower($type);
        $normSlot = self::normalizeSlot($slot);

        if ($type === 'urgent') {
            // Monday (1)
            if ($dayOfWeek === 1) {
                return $normSlot === '9:00 PM - 9:20 PM';
            }
            // Tuesday (2), Wednesday (3), Thursday (4), Friday (5)
            if (in_array($dayOfWeek, [2, 3, 4, 5])) {
                return $normSlot === '9:50 PM - 10:10 PM';
            }
            // Saturday (6), Sunday (0)
            if ($dayOfWeek === 6 || $dayOfWeek === 0) {
                return in_array($normSlot, ['9:25 PM - 9:45 PM', '9:50 PM - 10:10 PM']);
            }
            return false;
        }

        if ($type === 'normal') {
            // Monday (1): Available 5:40-6:00, 6:00-6:20, 6:25-6:45, 6:50-7:10
            if ($dayOfWeek === 1) {
                $allowed = [
                    '5:40 PM - 6:00 PM',
                    '6:00 PM - 6:20 PM',
                    '6:25 PM - 6:45 PM',
                    '6:50 PM - 7:10 PM',
                ];
                return !in_array($normSlot, $allowed);
            }

            // Tuesday (2) & Wednesday (3): ONLY 4:25-4:45 available
            if ($dayOfWeek === 2 || $dayOfWeek === 3) {
                return $normSlot !== '4:25 PM - 4:45 PM';
            }

            // Thursday (4) & Friday (5): 4:00-4:20 through 6:00-6:20 available
            if ($dayOfWeek === 4 || $dayOfWeek === 5) {
                $allowed = [
                    '4:00 PM - 4:20 PM',
                    '4:25 PM - 4:45 PM',
                    '4:50 PM - 5:10 PM',
                    '5:15 PM - 5:35 PM',
                    '5:40 PM - 6:00 PM',
                    '6:00 PM - 6:20 PM',
                ];
                return !in_array($normSlot, $allowed);
            }

            // Saturday (6) & Sunday (0): ONLY 8:00-8:20 & 8:25-8:45 available
            if ($dayOfWeek === 6 || $dayOfWeek === 0) {
                $allowed = [
                    '8:00 PM - 8:20 PM',
                    '8:25 PM - 8:45 PM',
                ];
                return !in_array($normSlot, $allowed);
            }
        }

        return false;
    }

    /**
     * Check if a date and time slot is available for booking.
     */
    public static function isSlotAvailable(string $date, string $slot, string $type = 'urgent', ?int $excludeAppointmentId = null): bool
    {
        $type = strtolower($type);
        if (!in_array($type, ['urgent', 'normal'])) {
            $type = 'urgent';
        }

        // 1. Advance booking requirement check
        if (!self::isDateAllowedForType($date, $type)) {
            return false;
        }

        // 2. Master slots check
        $masterSlots = self::getMasterSlots($type);
        $normSlot = self::normalizeSlot($slot);
        $normalizedMasterSlots = array_map([self::class, 'normalizeSlot'], $masterSlots);

        if (!in_array($normSlot, $normalizedMasterSlots)) {
            return false;
        }

        // 3. Weekly recurring block rules check
        $dayOfWeek = Carbon::parse($date, self::getTimezone())->dayOfWeek;
        if (self::isWeeklyBlocked($type, $dayOfWeek, $normSlot)) {
            return false;
        }

        // 4. Admin BlockedSlot check
        $blockedSlots = BlockedSlot::all();

        $targetDateStr = Carbon::parse($date, self::getTimezone())->format('Y-m-d');
        $targetDayOfWeek = Carbon::parse($date, self::getTimezone())->dayOfWeek; // 0..6
        $targetDayIso = Carbon::parse($date, self::getTimezone())->dayOfWeekIso; // 1..7
        $targetDayName = strtolower(Carbon::parse($date, self::getTimezone())->format('l'));

        foreach ($blockedSlots as $block) {
            if ($block->is_active === false || $block->is_active === 0 || $block->is_active === '0') {
                continue;
            }

            // Check consultation_type filter
            if (!empty($block->consultation_type) && strtolower(trim($block->consultation_type)) !== $type) {
                continue;
            }

            $isMatch = false;

            // Specific date match
            if (!empty($block->blocked_date)) {
                $bDateStr = Carbon::parse($block->blocked_date)->format('Y-m-d');
                if ($bDateStr === $targetDateStr) {
                    $isMatch = true;
                }
            }

            // Recurring day match
            if (!empty($block->is_recurring) && isset($block->day_of_week) && trim((string)$block->day_of_week) !== '') {
                $dow = strtolower(trim((string)$block->day_of_week));
                if (
                    $dow === (string)$targetDayOfWeek ||
                    $dow === (string)$targetDayIso ||
                    $dow === $targetDayName
                ) {
                    $isMatch = true;
                }
            }

            if ($isMatch) {
                if (empty($block->time_slot)) {
                    // Full day block
                    return false;
                }

                $bSlot = self::normalizeSlot($block->time_slot);
                if ($bSlot === $normSlot) {
                    return false;
                }
            }
        }

        // 5. Check for existing active appointments or active 15-min reservations
        $occupiedQuery = Appointment::whereDate('preferred_date', $date)
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

        $occupied = $occupiedQuery->get();
        foreach ($occupied as $app) {
            $appSlot = self::normalizeSlot($app->preferred_time);
            if ($appSlot === $normSlot) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get list of generated slots for date with availability status.
     */
    public static function getAvailableSlotsForDate(string $date, string $type = 'urgent', ?int $excludeAppointmentId = null): array
    {
        $type = strtolower($type);
        if (!in_array($type, ['urgent', 'normal'])) {
            $type = 'urgent';
        }

        $masterSlots = self::getMasterSlots($type);
        $results = [];

        foreach ($masterSlots as $slot) {
            $isAvailable = self::isSlotAvailable($date, $slot, $type, $excludeAppointmentId);
            $results[] = [
                'time' => $slot,
                'available' => $isAvailable,
            ];
        }

        return [
            'date' => $date,
            'type' => $type,
            'min_date' => self::getMinimumBookingDate($type),
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
