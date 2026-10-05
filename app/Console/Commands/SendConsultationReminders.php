<?php

namespace App\Console\Commands;

use App\Mail\ConsultationReminder1hMail;
use App\Mail\ConsultationReminder24hMail;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendConsultationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consultation:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send 24-hour and 1-hour email reminders for confirmed upcoming consultations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $this->info("Checking consultation reminders at {$now->toDateTimeString()}...");

        // Fetch confirmed, paid appointments
        $appointments = Appointment::where('status', 'Confirmed')
            ->where('payment_status', 'Paid')
            ->whereNotNull('preferred_date')
            ->where(function ($query) {
                $query->whereNull('reminder_24h_sent_at')
                      ->orWhereNull('reminder_1h_sent_at');
            })
            ->get();

        $sent24h = 0;
        $sent1h = 0;

        foreach ($appointments as $appointment) {
            $consultationStart = $this->getConsultationStart($appointment);
            if (!$consultationStart) {
                continue;
            }

            // Calculate hours until consultation
            $hoursUntil = $now->diffInHours($consultationStart, false);
            $minutesUntil = $now->diffInMinutes($consultationStart, false);

            // 24-Hour Reminder: Send if consultation is within 24 hours (and not past) and not sent yet
            if (is_null($appointment->reminder_24h_sent_at)) {
                if ($minutesUntil > 0 && $hoursUntil <= 24) {
                    $updated = Appointment::where('id', $appointment->id)
                        ->whereNull('reminder_24h_sent_at')
                        ->update(['reminder_24h_sent_at' => Carbon::now()]);

                    if ($updated) {
                        $appointment->reminder_24h_sent_at = Carbon::now();
                        try {
                            if ($appointment->email && filter_var($appointment->email, FILTER_VALIDATE_EMAIL)) {
                                Mail::to($appointment->email)->send(new ConsultationReminder24hMail($appointment));
                                $sent24h++;
                                $this->info("Sent 24h reminder to {$appointment->email} for {$appointment->booking_reference}");
                            }
                        } catch (\Throwable $e) {
                            Log::error("Failed sending 24h reminder for {$appointment->booking_reference}: " . $e->getMessage());
                        }
                    }
                }
            }

            // 1-Hour Reminder: Send if consultation is within 1 hour (and not past) and not sent yet
            if (is_null($appointment->reminder_1h_sent_at)) {
                if ($minutesUntil > 0 && $minutesUntil <= 60) {
                    $updated = Appointment::where('id', $appointment->id)
                        ->whereNull('reminder_1h_sent_at')
                        ->update(['reminder_1h_sent_at' => Carbon::now()]);

                    if ($updated) {
                        $appointment->reminder_1h_sent_at = Carbon::now();
                        try {
                            if ($appointment->email && filter_var($appointment->email, FILTER_VALIDATE_EMAIL)) {
                                Mail::to($appointment->email)->send(new ConsultationReminder1hMail($appointment));
                                $sent1h++;
                                $this->info("Sent 1h reminder to {$appointment->email} for {$appointment->booking_reference}");
                            }
                        } catch (\Throwable $e) {
                            Log::error("Failed sending 1h reminder for {$appointment->booking_reference}: " . $e->getMessage());
                        }
                    }
                }
            }
        }

        $this->info("Reminder processing completed. 24h sent: {$sent24h}, 1h sent: {$sent1h}.");
        return Command::SUCCESS;
    }

    /**
     * Get start Carbon datetime for an appointment.
     */
    protected function getConsultationStart(Appointment $appointment): ?Carbon
    {
        if (!$appointment->preferred_date) {
            return null;
        }

        $dateStr = Carbon::parse($appointment->preferred_date)->format('Y-m-d');
        $timeStr = '10:00:00';

        if ($appointment->preferred_time) {
            if (str_contains($appointment->preferred_time, '02:00 PM')) {
                $timeStr = '14:00:00';
            } elseif (str_contains($appointment->preferred_time, '06:00 PM')) {
                $timeStr = '18:00:00';
            } elseif (str_contains($appointment->preferred_time, '10:00 AM')) {
                $timeStr = '10:00:00';
            }
        }

        return Carbon::parse("{$dateStr} {$timeStr}");
    }
}
