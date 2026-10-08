<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CustomerAccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_view_login_and_registration_pages(): void
    {
        $loginResponse = $this->get('/account/login');
        $loginResponse->assertStatus(200);

        $registerResponse = $this->get('/account/register');
        $registerResponse->assertStatus(200);
    }

    public function test_customer_can_register_new_account(): void
    {
        \Illuminate\Support\Facades\Mail::fake();

        $response = $this->post('/account/register', [
            'name' => 'John Customer',
            'email' => 'john.customer@example.com',
            'phone' => '9876543210',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertRedirect('/account');
        $this->assertAuthenticated();

        $user = User::where('email', 'john.customer@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('John Customer', $user->name);
        $this->assertEquals('9876543210', $user->phone);
        $this->assertFalse((bool) $user->is_admin);
        $this->assertNotNull($user->welcome_email_sent_at);

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\CustomerWelcomeMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

    public function test_customer_can_login_with_valid_credentials(): void
    {
        $customer = User::create([
            'name' => 'Jane Customer',
            'email' => 'jane@example.com',
            'phone' => '9123456789',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'is_active' => true,
        ]);

        $response = $this->post('/account/login', [
            'email' => 'jane@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/account');
        $this->assertAuthenticatedAs($customer);
    }

    public function test_unauthenticated_visitor_cannot_access_customer_dashboard(): void
    {
        $response = $this->get('/account');
        $response->assertRedirect('/account/login');
    }

    public function test_customer_can_update_profile_with_full_astrological_fields(): void
    {
        $customer = User::create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
            'phone' => '9000000000',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'is_active' => true,
        ]);

        $response = $this->actingAs($customer)->put('/account/profile', [
            'name' => 'New Name',
            'email' => 'new@example.com',
            'phone' => '9111111111',
            'whatsapp' => '9111111111',
            'birth_date' => '1992-05-15',
            'birth_time' => '14:30',
            'birth_place' => 'Kolkata, WB',
            'gender' => 'Male',
            'address' => '123 Salt Lake, Kolkata',
        ]);

        $response->assertRedirect('/account/profile');
        $customer->refresh();

        $this->assertEquals('New Name', $customer->name);
        $this->assertEquals('new@example.com', $customer->email);
        $this->assertEquals('9111111111', $customer->phone);
        $this->assertEquals('9111111111', $customer->whatsapp);
        $this->assertEquals('1992-05-15', $customer->birth_date->format('Y-m-d'));
        $this->assertEquals('14:30:00', $customer->birth_time);
        $this->assertEquals('Kolkata, WB', $customer->birth_place);
        $this->assertEquals('Male', $customer->gender);
        $this->assertEquals('123 Salt Lake, Kolkata', $customer->address);
    }

    public function test_customer_can_change_password(): void
    {
        $customer = User::create([
            'name' => 'Security User',
            'email' => 'security@example.com',
            'phone' => '9222222222',
            'password' => Hash::make('oldpassword123'),
            'is_admin' => false,
            'is_active' => true,
        ]);

        $response = $this->actingAs($customer)->put('/account/password', [
            'current_password' => 'oldpassword123',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect('/account/password');
        $customer->refresh();

        $this->assertTrue(Hash::check('newpassword123', $customer->password));
    }

    public function test_customer_cannot_access_admin_dashboard(): void
    {
        $customer = User::create([
            'name' => 'Normal Customer',
            'email' => 'customer@example.com',
            'phone' => '9333333333',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'is_active' => true,
        ]);

        $response = $this->actingAs($customer)->get('/admin-tamal/dashboard');
        $response->assertRedirect('/admin-tamal/login');
    }

    public function test_customer_logout_flow_and_session_termination(): void
    {
        $customer = User::create([
            'name' => 'Logout Customer',
            'email' => 'logout@example.com',
            'phone' => '9444444444',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'is_active' => true,
        ]);

        $this->actingAs($customer);
        $response = $this->post('/account/logout');

        $response->assertRedirect('/account/login');
        $this->assertGuest();

        $protectedResponse = $this->get('/account');
        $protectedResponse->assertRedirect('/account/login');
    }

    public function test_booking_page_uses_time_picker_and_prefills_logged_in_customer_profile(): void
    {
        $customer = User::create([
            'name' => 'Prefill Customer',
            'email' => 'prefill@example.com',
            'phone' => '9888877777',
            'whatsapp' => '9888877777',
            'birth_date' => '1995-10-20',
            'birth_time' => '10:30:00',
            'birth_place' => 'Howrah',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'is_active' => true,
        ]);

        $response = $this->actingAs($customer)->get('/book-consultation');
        $response->assertStatus(200);
        $response->assertSee('type="time"', false);
        $response->assertSee('Prefill Customer');
        $response->assertSee('prefill@example.com');
        $response->assertSee('9888877777');
        $response->assertSee('1995-10-20');
        $response->assertSee('10:30');
        $response->assertSee('Howrah');
    }

    public function test_guest_booking_with_account_creation_saves_profile_and_prevents_duplicates(): void
    {
        \Illuminate\Support\Facades\Mail::fake();

        $tomorrow = \Carbon\Carbon::now('Asia/Kolkata')->addDays(1)->format('Y-m-d');

        $payload = [
            'name' => 'Guest Newbie',
            'email' => 'newbie@example.com',
            'phone' => '9998887776',
            'whatsapp' => '9998887776',
            'birth_date' => '1998-04-12',
            'birth_time' => '09:15',
            'birth_place' => 'Durgapur',
            'consultation_type' => 'urgent',
            'preferred_date' => $tomorrow,
            'preferred_time' => '09:00 PM - 09:20 PM',
            'create_account' => '1',
            'password' => 'accountpass123',
            'password_confirmation' => 'accountpass123',
            'terms_consent' => '1',
        ];

        $response = $this->post('/book-consultation', $payload);
        $response->assertRedirect();

        $user = User::where('email', 'newbie@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Guest Newbie', $user->name);
        $this->assertEquals('9998887776', $user->phone);
        $this->assertEquals('1998-04-12', $user->birth_date->format('Y-m-d'));
        $this->assertEquals('09:15:00', $user->birth_time);
        $this->assertEquals('Durgapur', $user->birth_place);

        // Duplicate account creation attempt must fail for guest
        auth()->logout();
        $duplicateResponse = $this->post('/book-consultation', array_merge($payload, [
            'preferred_time' => '09:25 PM - 09:45 PM',
        ]));
        $duplicateResponse->assertSessionHasErrors(['email']);
    }

    public function test_historical_bookings_remain_unchanged_when_customer_submits_new_booking_with_different_data(): void
    {
        $customer = User::create([
            'name' => 'Regular User',
            'email' => 'regular@example.com',
            'phone' => '9777766666',
            'birth_date' => '1990-01-01',
            'birth_time' => '08:00:00',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'is_active' => true,
        ]);

        $oldAppointment = Appointment::create([
            'user_id' => $customer->id,
            'booking_reference' => 'OLDREF123',
            'name' => 'Regular User',
            'email' => 'regular@example.com',
            'phone' => '9777766666',
            'birth_date' => '1990-01-01',
            'birth_time' => '08:00:00',
            'consultation_type' => 'Urgent',
            'consultation_mode' => 'Audio',
            'preferred_date' => \Carbon\Carbon::now('Asia/Kolkata')->addDays(1)->format('Y-m-d'),
            'preferred_time' => '09:00 PM - 09:20 PM',
            'amount' => 5000,
            'status' => 'Confirmed',
            'payment_status' => 'Paid',
        ]);

        $tomorrow = \Carbon\Carbon::now('Asia/Kolkata')->addDays(1)->format('Y-m-d');

        // New booking with modified DOB
        $this->actingAs($customer)->post('/book-consultation', [
            'name' => 'Regular User',
            'email' => 'regular@example.com',
            'phone' => '9777766666',
            'birth_date' => '1992-02-02',
            'birth_time' => '09:30',
            'birth_place' => 'Siliguri',
            'consultation_type' => 'urgent',
            'preferred_date' => $tomorrow,
            'preferred_time' => '09:25 PM - 09:45 PM',
            'terms_consent' => '1',
        ]);

        $oldAppointment->refresh();
        $this->assertEquals('1990-01-01', $oldAppointment->birth_date->format('Y-m-d'));
        $this->assertEquals('08:00:00', $oldAppointment->birth_time);

        $newAppointment = Appointment::where('booking_reference', '!=', 'OLDREF123')->latest()->first();
        $this->assertNotNull($newAppointment);
        $this->assertEquals('1992-02-02', $newAppointment->birth_date->format('Y-m-d'));
        $this->assertEquals('09:30:00', $newAppointment->birth_time);
    }

    public function test_customer_cannot_access_another_customers_booking_details_idor(): void
    {
        $user1 = User::create([
            'name' => 'User One',
            'email' => 'user1@example.com',
            'phone' => '9111122222',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'is_active' => true,
        ]);

        $user2 = User::create([
            'name' => 'User Two',
            'email' => 'user2@example.com',
            'phone' => '9333344444',
            'password' => Hash::make('password123'),
            'is_admin' => false,
            'is_active' => true,
        ]);

        $appointment1 = Appointment::create([
            'user_id' => $user1->id,
            'booking_reference' => 'USER1REF',
            'name' => 'User One',
            'email' => 'user1@example.com',
            'phone' => '9111122222',
            'birth_date' => '1990-01-01',
            'consultation_type' => 'Urgent',
            'consultation_mode' => 'Audio',
            'preferred_date' => \Carbon\Carbon::now('Asia/Kolkata')->addDays(1)->format('Y-m-d'),
            'preferred_time' => '09:00 PM - 09:20 PM',
            'amount' => 5000,
            'status' => 'Confirmed',
            'payment_status' => 'Paid',
        ]);

        // User2 attempts to access User1's booking
        $response = $this->actingAs($user2)->get('/account/bookings/USER1REF');
        $response->assertStatus(404);
    }
}
