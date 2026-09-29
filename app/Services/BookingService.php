<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\BlockedSlot;
use App\Models\PaymentTransaction;
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
            $reference = 'AST-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        } while (Appointment::where('booking_reference', $reference)->exists());

        return $reference;
    }

    /**
     * Check if a date and time slot is available for booking.
     */
    public static function isSlotAvailable(string $date, string $time, ?int $excludeAppointmentId = null): bool
    {
        // 1. Check if date or time slot is explicitly blocked by admin
        $isBlocked = BlockedSlot::where(function ($query) {
                $query->where('is_active', true)
                      ->orWhereNull('is_active');
            })
            ->where(function ($query) use ($date, $time) {
                // Specific date & time block
                $query->where(function ($q) use ($date, $time) {
                    $q->whereDate('blocked_date', $date)
                      ->where(function ($st) use ($time) {
                          $st->whereNull('time_slot')->orWhere('time_slot', $time);
                      });
                })
                // Recurring day of week block (0 = Sun, 1 = Mon, etc.)
                ->orWhere(function ($q) use ($date, $time) {
                    $dayOfWeek = Carbon::parse($date)->dayOfWeek;
                    $dayName = Carbon::parse($date)->format('l');
                    $q->where('is_recurring', true)
                      ->where(function ($dw) use ($dayOfWeek, $dayName) {
                          $dw->where('day_of_week', (string)$dayOfWeek)
                            ->orWhere('day_of_week', $dayName);
                      })
                      ->where(function ($st) use ($time) {
                          $st->whereNull('time_slot')->orWhere('time_slot', $time);
                      });
                });
            })->exists();

        if ($isBlocked) {
            return false;
        }

        // 2. Check for existing confirmed appointments or active reservations
        $occupiedQuery = Appointment::whereDate('preferred_date', $date)
            ->where('preferred_time', $time)
            ->where(function ($query) {
                $query->whereIn('status', ['Confirmed', 'Completed'])
                      ->orWhere(function ($resQuery) {
                          // Actively reserved slot (Pending Payment and reservation not expired)
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
            // Reload with lock to prevent race conditions
            $appointment = Appointment::where('id', $appointment->id)->lockForUpdate()->first();

            if ($appointment->payment_status === 'Paid' && $appointment->status === 'Confirmed') {
                return $appointment; // Already processed, return idempotent response
            }

            // Update appointment
            $appointment->update([
                'status' => 'Confirmed',
                'payment_status' => 'Paid',
                'payment_method' => $gateway,
                'payment_reference' => $paymentId,
                'slot_reserved_until' => null, // Lock is now permanent as confirmed booking
            ]);

            // Create Payment Transaction Log
            PaymentTransaction::create([
                'appointment_id' => $appointment->id,
                'booking_reference' => $appointment->booking_reference,
                'gateway' => $gateway,
                'gateway_order_id' => $orderId,
                'gateway_payment_id' => $paymentId,
                'amount' => $appointment->amount,
                'currency' => 'INR',
                'status' => 'Success',
                'raw_response' => $rawPayload ? json_encode($rawPayload) : null,
                'verified_at' => Carbon::now(),
            ]);

            return $appointment;
        });
    }

    /**
     * Record a payment failure.
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
                'gateway_order_id' => $orderId,
                'amount' => $appointment->amount,
                'currency' => 'INR',
                'status' => 'Failed',
                'notes' => $failureReason,
            ]);
        });
    }
}
