<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ConsultationProfileSchemaRegressionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow('2026-10-05 10:00:00'); // Set test time to a Monday
    }

    /** @test */
    public function logged_in_customer_submits_consultation_successfully_updating_profile_birth_details()
    {
        $user = User::factory()->create([
            'email' => 'authuser@example.com',
            'phone' => '9998887770',
            'birth_date' => null,
            'birth_time' => null,
            'birth_place' => null,
        ]);

        $response = $this->actingAs($user)->post(route('consultation.submit'), [
            'name' => 'Authenticated Customer',
            'email' => 'authuser@example.com',
            'phone' => '9998887770',
            'whatsapp' => '9998887770',
            'birth_date' => '1990-06-15',
            'birth_time' => '07:30 AM',
            'birth_place' => 'Delhi',
            'consultation_type' => 'urgent',
            'preferred_date' => '2026-10-06',
            'preferred_time' => '9:25 PM - 9:45 PM',
            'terms_consent' => '1',
        ]);

        $appointment = Appointment::first();
        $this->assertNotNull($appointment);
        $this->assertEquals('ASTRO-', substr($appointment->booking_reference, 0, 6));

        $response->assertRedirect(route('consultation.checkout', ['reference' => $appointment->booking_reference]));

        $user->refresh();
        $this->assertEquals('1990-06-15', $user->birth_date->format('Y-m-d'));
        $this->assertEquals('07:30:00', $user->birth_time);
        $this->assertEquals('Delhi', $user->birth_place);
    }

    /** @test */
    public function logged_in_customer_submits_consultation_does_not_fail_with_500_even_if_users_table_is_missing_birth_date()
    {
        // Drop profile columns from users table temporarily in runtime to simulate unmigrated production DB state
        Schema::table('users', function ($table) {
            $table->dropColumn(['birth_date', 'birth_time', 'birth_place', 'whatsapp']);
        });

        $user = User::factory()->create([
            'email' => 'legacyuser@example.com',
            'phone' => '9998887771',
        ]);

        $response = $this->actingAs($user)->post(route('consultation.submit'), [
            'name' => 'Legacy Customer',
            'email' => 'legacyuser@example.com',
            'phone' => '9998887771',
            'birth_date' => '1988-04-12',
            'birth_time' => '10:15 AM',
            'birth_place' => 'Mumbai',
            'consultation_type' => 'urgent',
            'preferred_date' => '2026-10-06',
            'preferred_time' => '9:25 PM - 9:45 PM',
            'terms_consent' => '1',
        ]);

        // Assert HTTP status is redirect to checkout, NOT 500 Server Error
        $response->assertStatus(302);

        $appointment = Appointment::first();
        $this->assertNotNull($appointment);
        $this->assertEquals('1988-04-12', $appointment->birth_date->format('Y-m-d'));
        $response->assertRedirect(route('consultation.checkout', ['reference' => $appointment->booking_reference]));
    }

    /** @test */
    public function guest_customer_submits_consultation_and_creates_account_with_profile_details()
    {
        $response = $this->post(route('consultation.submit'), [
            'name' => 'New Customer',
            'email' => 'newcustomer@example.com',
            'phone' => '9998887772',
            'whatsapp' => '9998887772',
            'birth_date' => '1992-11-25',
            'birth_time' => '02:45 PM',
            'birth_place' => 'Bangalore',
            'create_account' => '1',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'consultation_type' => 'urgent',
            'preferred_date' => '2026-10-06',
            'preferred_time' => '9:25 PM - 9:45 PM',
            'terms_consent' => '1',
        ]);

        $user = User::where('email', 'newcustomer@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('1992-11-25', $user->birth_date->format('Y-m-d'));
        $this->assertEquals('14:45:00', $user->birth_time);

        $appointment = Appointment::first();
        $this->assertNotNull($appointment);
        $this->assertEquals($user->id, $appointment->user_id);
        $response->assertRedirect(route('consultation.checkout', ['reference' => $appointment->booking_reference]));
    }
}
