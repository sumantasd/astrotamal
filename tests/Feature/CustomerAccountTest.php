<?php

namespace Tests\Feature;

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

    public function test_customer_can_update_profile(): void
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
        ]);

        $response->assertRedirect('/account/profile');
        $customer->refresh();

        $this->assertEquals('New Name', $customer->name);
        $this->assertEquals('new@example.com', $customer->email);
        $this->assertEquals('9111111111', $customer->phone);
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

    public function test_customer_logout_flow(): void
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
    }
}
