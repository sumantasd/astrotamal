<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'booking_reference' => 'ASTRO-' . strtoupper(Str::random(8)),
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => '8392059201',
            'whatsapp' => '8392059201',
            'birth_date' => '1995-05-15',
            'birth_time' => '10:30',
            'birth_place' => 'Kolkata',
            'consultation_type' => 'normal',
            'consultation_mode' => 'online',
            'amount' => 3000,
            'preferred_date' => now()->addDays(2)->format('Y-m-d'),
            'preferred_time' => '02:00 PM - 05:00 PM IST',
            'notes' => 'Testing appointment',
            'status' => 'pending',
            'payment_status' => 'paid',
        ];
    }
}
