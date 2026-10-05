<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\BlockedSlot;
use App\Models\PaymentTransaction;
use App\Models\User;
use App\Services\BookingService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingWorkflowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_customer_submits_booking_form_creates_pending_payment_booking()
    {
        $response = $this->post(route('consultation.submit'), [
            'name' => 'John Doe',
            'phone' => '9876543210',
            'whatsapp' => '9876543210',
            'email' => 'john@example.com',
            'birth_date' => '1995-05-15',
            'birth_time' => '08:30 AM',
            'birth_place' => 'Kolkata',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'terms_consent' => '1',
        ]);

        $appointment = Appointment::first();

        $this->assertNotNull($appointment);
        $this->assertEquals('Pending Payment', $appointment->status);
        $this->assertEquals('Pending', $appointment->payment_status);
        $this->assertEquals(5000.00, $appointment->amount);
        $this->assertNotNull($appointment->slot_reserved_until);

        $response->assertRedirect(route('consultation.checkout', ['reference' => $appointment->booking_reference]));
    }

    /** @test */
    public function test_normal_consultation_enforces_server_side_pricing_of_3000()
    {
        $response = $this->post(route('consultation.submit'), [
            'name' => 'Jane Smith',
            'phone' => '9876543211',
            'birth_date' => '1992-08-20',
            'consultation_type' => 'normal',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '02:00 PM - 05:00 PM IST',
            'terms_consent' => '1',
        ]);

        $appointment = Appointment::first();
        $this->assertEquals(3000.00, $appointment->amount);
    }

    /** @test */
    public function test_booking_without_terms_consent_fails_validation()
    {
        $response = $this->post(route('consultation.submit'), [
            'name' => 'John Doe',
            'phone' => '9876543210',
            'birth_date' => '1995-05-15',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        $response->assertSessionHasErrors('terms_consent');
        $this->assertEquals(0, Appointment::count());
    }

    /** @test */
    public function test_blocked_slot_prevents_customer_booking()
    {
        $tomorrow = Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d');
        BlockedSlot::create([
            'blocked_date' => $tomorrow,
            'time_slot' => '10:00 AM - 01:00 PM IST',
            'reason' => 'Holiday',
            'is_active' => true,
        ]);

        $response = $this->post(route('consultation.submit'), [
            'name' => 'John Doe',
            'phone' => '9876543210',
            'birth_date' => '1995-05-15',
            'consultation_type' => 'urgent',
            'preferred_date' => $tomorrow,
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasErrors('preferred_time');
        $this->assertEquals(0, Appointment::count());
    }

    /** @test */
    public function test_recurring_blocked_slot_prevents_customer_booking()
    {
        $targetDate = Carbon::tomorrow('Asia/Kolkata');
        $dayOfWeek = $targetDate->dayOfWeek; // Carbon day of week integer (0..6)

        BlockedSlot::create([
            'is_recurring' => true,
            'day_of_week' => (string)$dayOfWeek,
            'time_slot' => '10:00 AM - 01:00 PM IST',
            'reason' => 'Weekly Off',
            'is_active' => true,
        ]);

        $response = $this->post(route('consultation.submit'), [
            'name' => 'Jane Recurring',
            'phone' => '9876543299',
            'birth_date' => '1995-05-15',
            'consultation_type' => 'urgent',
            'preferred_date' => $targetDate->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasErrors('preferred_time');
        $this->assertEquals(0, Appointment::count());
    }

    /** @test */
    public function test_accessing_checkout_or_starting_payment_does_not_confirm_booking()
    {
        $appointment = BookingService::createPendingBooking([
            'name' => 'John Pending',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        $response = $this->get(route('consultation.checkout', ['reference' => $appointment->booking_reference]));
        $response->assertStatus(200);

        $appointment->refresh();
        $this->assertEquals('Pending Payment', $appointment->status);
        $this->assertEquals('Pending', $appointment->payment_status);
    }

    /** @test */
    public function test_create_razorpay_order_returns_order_payload_and_server_side_amount()
    {
        $appointment = BookingService::createPendingBooking([
            'name' => 'John Order',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        $response = $this->postJson(route('consultation.payment.create-order'), [
            'booking_reference' => $appointment->booking_reference,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'amount' => 500000, // 5000 INR in paise
            'currency' => 'INR',
            'booking_reference' => $appointment->booking_reference,
        ]);

        $appointment->refresh();
        $this->assertEquals('Pending Payment', $appointment->status);
        $this->assertEquals('Pending', $appointment->payment_status);
    }

    /** @test */
    public function test_invalid_signature_fails_verification_and_does_not_confirm_booking()
    {
        \App\Models\PaymentSetting::updateOrCreate(
            ['gateway' => 'Razorpay'],
            ['secret_key' => 'test_secret_12345', 'is_enabled' => true]
        );

        $appointment = BookingService::createPendingBooking([
            'name' => 'John Signature Fail',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        $response = $this->postJson(route('consultation.payment.verify'), [
            'booking_reference' => $appointment->booking_reference,
            'payment_id' => 'pay_fake_999',
            'order_id' => 'ord_fake_888',
            'signature' => 'invalid_signature_hash',
            'gateway' => 'Razorpay',
        ]);

        $response->assertStatus(422);

        $appointment->refresh();
        $this->assertNotEquals('Confirmed', $appointment->status);
        $this->assertEquals('Failed', $appointment->payment_status);
    }

    /** @test */
    public function test_server_side_payment_verification_confirms_booking_and_paid_status()
    {
        $appointment = BookingService::createPendingBooking([
            'name' => 'John Doe',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        $response = $this->post(route('consultation.payment.verify'), [
            'booking_reference' => $appointment->booking_reference,
            'payment_id' => 'pay_test_12345',
            'order_id' => 'ord_test_67890',
            'gateway' => 'Test Gateway',
        ]);

        $appointment->refresh();

        $this->assertEquals('Confirmed', $appointment->status);
        $this->assertEquals('Paid', $appointment->payment_status);
        $this->assertEquals('pay_test_12345', $appointment->payment_reference);

        $transaction = PaymentTransaction::where('appointment_id', $appointment->id)->first();
        $this->assertNotNull($transaction);
        $this->assertEquals('Success', $transaction->status);

        $response->assertRedirect(route('consultation.confirmation', ['reference' => $appointment->booking_reference]));
    }

    /** @test */
    public function test_payment_verification_is_idempotent()
    {
        $appointment = BookingService::createPendingBooking([
            'name' => 'John Doe',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        // First Verification
        BookingService::confirmPaymentAndBooking($appointment, 'pay_test_123', 'Razorpay', 'ord_test_123');

        // Second Verification Call (Repeated Webhook / Callback)
        $result = BookingService::confirmPaymentAndBooking($appointment, 'pay_test_123', 'Razorpay', 'ord_test_123');

        $this->assertEquals('Confirmed', $result->status);
        $this->assertEquals(1, PaymentTransaction::where('appointment_id', $appointment->id)->count());
    }

    /** @test */
    public function test_unauthorized_user_cannot_access_admin_panel()
    {
        $response = $this->get('/admin-tamal/dashboard');
        $response->assertRedirect('/admin-tamal/login');
    }

    /** @test */
    public function test_admin_login_page_renders_and_authenticates_admin()
    {
        $admin = User::create([
            'name' => 'Tamal Chakraborty',
            'email' => 'admin@tamalchakraborty.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
            'is_active' => true,
        ]);

        $response = $this->get('/admin-tamal/login');
        $response->assertStatus(200);

        $this->actingAs($admin);
        $dashboardResponse = $this->get('/admin-tamal/dashboard');
        $dashboardResponse->assertStatus(200);
    }

    /** @test */
    public function test_birth_time_normalizes_12_hour_time_to_database_time_format()
    {
        $response = $this->post(route('consultation.submit'), [
            'name' => 'Birth Time Test',
            'phone' => '9876543219',
            'birth_date' => '1990-01-01',
            'birth_time' => '11:18 PM',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'terms_consent' => '1',
        ]);

        $appointment = Appointment::first();
        $this->assertNotNull($appointment);
        $this->assertEquals('23:18:00', $appointment->birth_time);
    }

    /** @test */
    public function test_invalid_birth_time_is_rejected()
    {
        $response = $this->post(route('consultation.submit'), [
            'name' => 'Invalid Birth Time Test',
            'phone' => '9876543219',
            'birth_date' => '1990-01-01',
            'birth_time' => 'invalid-time-value',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasErrors('birth_time');
        $this->assertEquals(0, Appointment::count());
    }

    /** @test */
    public function test_urgent_booking_cannot_use_normal_only_slots()
    {
        $response = $this->post(route('consultation.submit'), [
            'name' => 'Urgent Wrong Slot',
            'phone' => '9876543219',
            'birth_date' => '1990-01-01',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '02:00 PM - 05:00 PM IST',
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasErrors('preferred_time');
        $this->assertEquals(0, Appointment::count());
    }

    /** @test */
    public function test_normal_booking_cannot_use_urgent_only_morning_slot()
    {
        $response = $this->post(route('consultation.submit'), [
            'name' => 'Normal Wrong Slot',
            'phone' => '9876543219',
            'birth_date' => '1990-01-01',
            'consultation_type' => 'normal',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasErrors('preferred_time');
        $this->assertEquals(0, Appointment::count());
    }

    /** @test */
    public function test_occupied_active_reservation_prevents_duplicate_booking()
    {
        $tomorrow = Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d');
        BookingService::createPendingBooking([
            'name' => 'First Reserver',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => $tomorrow,
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        $response = $this->post(route('consultation.submit'), [
            'name' => 'Second Reserver',
            'phone' => '9876543222',
            'birth_date' => '1990-01-01',
            'consultation_type' => 'urgent',
            'preferred_date' => $tomorrow,
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasErrors('preferred_time');
        $this->assertEquals(1, Appointment::count());
    }

    /** @test */
    public function test_urgent_booking_can_select_today_when_slot_available()
    {
        $today = Carbon::now('Asia/Kolkata')->format('Y-m-d');
        $response = $this->post(route('consultation.submit'), [
            'name' => 'Urgent Today Test',
            'phone' => '9876543219',
            'birth_date' => '1990-01-01',
            'consultation_type' => 'urgent',
            'preferred_date' => $today,
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'terms_consent' => '1',
        ]);

        $appointment = Appointment::first();
        $this->assertNotNull($appointment);
        $this->assertEquals($today, $appointment->preferred_date->format('Y-m-d'));
    }

    /** @test */
    public function test_normal_booking_cannot_select_today()
    {
        $today = Carbon::now('Asia/Kolkata')->format('Y-m-d');
        $response = $this->post(route('consultation.submit'), [
            'name' => 'Normal Today Fail Test',
            'phone' => '9876543219',
            'birth_date' => '1990-01-01',
            'consultation_type' => 'normal',
            'preferred_date' => $today,
            'preferred_time' => '02:00 PM - 05:00 PM IST',
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasErrors('preferred_date');
        $this->assertEquals(0, Appointment::count());
    }

    /** @test */
    public function test_booking_cannot_select_past_date()
    {
        $yesterday = Carbon::now('Asia/Kolkata')->subDays(1)->format('Y-m-d');
        $response = $this->post(route('consultation.submit'), [
            'name' => 'Past Date Fail Test',
            'phone' => '9876543219',
            'birth_date' => '1990-01-01',
            'consultation_type' => 'urgent',
            'preferred_date' => $yesterday,
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasErrors('preferred_date');
        $this->assertEquals(0, Appointment::count());
    }

    /** @test */
    public function test_unpaid_or_pending_booking_cannot_download_receipt_pdf()
    {
        $appointment = BookingService::createPendingBooking([
            'name' => 'Pending PDF Test',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        $response = $this->get(route('consultation.receipt.pdf', ['reference' => $appointment->booking_reference]));
        $response->assertRedirect(route('consultation.confirmation', ['reference' => $appointment->booking_reference]));
        $response->assertSessionHas('error');
    }

    /** @test */
    public function test_confirmed_paid_booking_can_download_receipt_pdf()
    {
        $appointment = BookingService::createPendingBooking([
            'name' => 'Paid PDF Test',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        BookingService::confirmPaymentAndBooking($appointment, 'pay_pdf_test_999', 'Razorpay', 'ord_pdf_test_999');

        $response = $this->get(route('consultation.receipt.pdf', ['reference' => $appointment->booking_reference]));
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    /** @test */
    public function test_booking_with_optional_account_creation_registers_user_and_links_booking()
    {
        $response = $this->post(route('consultation.submit'), [
            'name' => 'Account Creator',
            'email' => 'creator@example.com',
            'phone' => '9876543299',
            'birth_date' => '1992-05-15',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'terms_consent' => '1',
            'create_account' => '1',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
        ]);

        $user = User::where('email', 'creator@example.com')->first();
        $this->assertNotNull($user);
        $this->assertAuthenticatedAs($user);

        $appointment = Appointment::first();
        $this->assertNotNull($appointment);
        $this->assertEquals($user->id, $appointment->user_id);
    }

    /** @test */
    public function test_admin_reschedule_triggers_email_notification()
    {
        \Illuminate\Support\Facades\Mail::fake();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin.reschedule@example.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
            'is_active' => true,
        ]);

        $appointment = BookingService::createPendingBooking([
            'name' => 'Rescheduled Client',
            'email' => 'client.reschedule@example.com',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        $newDate = Carbon::tomorrow('Asia/Kolkata')->addDays(1)->format('Y-m-d');
        $newTime = '02:00 PM - 05:00 PM IST';

        $response = $this->actingAs($admin)->put(route('admin.appointments.update', $appointment), [
            'status' => 'Confirmed',
            'payment_status' => 'Paid',
            'preferred_date' => $newDate,
            'preferred_time' => $newTime,
        ]);

        $appointment->refresh();
        $this->assertEquals($newDate, $appointment->preferred_date->format('Y-m-d'));
        $this->assertEquals($newTime, $appointment->preferred_time);

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\BookingRescheduledMail::class);
    }

    /** @test */
    public function test_admin_cancellation_triggers_email_notification()
    {
        \Illuminate\Support\Facades\Mail::fake();

        $admin = User::create([
            'name' => 'Admin User 2',
            'email' => 'admin.cancel@example.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
            'is_active' => true,
        ]);

        $appointment = BookingService::createPendingBooking([
            'name' => 'Cancelled Client',
            'email' => 'client.cancel@example.com',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        $response = $this->actingAs($admin)->put(route('admin.appointments.update', $appointment), [
            'status' => 'Cancelled',
            'payment_status' => 'Paid',
        ]);

        $appointment->refresh();
        $this->assertEquals('Cancelled', $appointment->status);
        $this->assertNotNull($appointment->cancelled_at);

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\BookingCancelledMail::class);
    }

    /** @test */
    public function test_payment_failure_sends_payment_failed_email_and_no_confirmation_email()
    {
        \Illuminate\Support\Facades\Mail::fake();

        $appointment = BookingService::createPendingBooking([
            'name' => 'Failed Payment Client',
            'email' => 'failed.client@example.com',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        BookingService::markPaymentFailed($appointment, 'Razorpay', 'order_failed_123', 'Bank decline');

        $appointment->refresh();
        $this->assertEquals('Failed', $appointment->payment_status);
        $this->assertNotNull($appointment->failed_email_sent_at);

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\PaymentFailedMail::class, function ($mail) use ($appointment) {
            return $mail->hasTo($appointment->email);
        });

        \Illuminate\Support\Facades\Mail::assertNotSent(\App\Mail\BookingConfirmedMail::class);
    }

    /** @test */
    public function test_payment_expiry_sends_expired_email_and_no_confirmation_email()
    {
        \Illuminate\Support\Facades\Mail::fake();

        $appointment = BookingService::createPendingBooking([
            'name' => 'Expired Client',
            'email' => 'expired.client@example.com',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        // Travel 20 minutes into the future to expire slot reservation
        $this->travel(20)->minutes();

        $response = $this->get(route('consultation.checkout', ['reference' => $appointment->booking_reference]));
        $response->assertStatus(200);

        $appointment->refresh();
        $this->assertEquals('Expired', $appointment->status);
        $this->assertNotNull($appointment->expired_email_sent_at);

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\PaymentExpiredMail::class, function ($mail) use ($appointment) {
            return $mail->hasTo($appointment->email);
        });

        \Illuminate\Support\Facades\Mail::assertNotSent(\App\Mail\BookingConfirmedMail::class);
    }

    /** @test */
    public function test_consultation_reminders_24h_and_1h_with_exclusions()
    {
        \Illuminate\Support\Facades\Mail::fake();

        // Fix current time to 2026-10-05 09:15:00 for 1h reminder testing (10:00 AM slot is in 45 mins)
        Carbon::setTestNow(Carbon::parse('2026-10-05 09:15:00'));

        // 1. Confirmed booking starting 23 hours from test time (Oct 6, 08:15 AM? No, set testNow for 24h or set Oct 6 10:00 AM when testNow is Oct 5 11:00 AM)
        // Let's create 24h appt on Oct 6 10:00 AM (24h 45m from 09:15)
        // If we set testNow to 2026-10-05 11:00:00:
        // Appt 24h is on Oct 6 10:00 AM -> 23 hours away -> gets 24h reminder
        // Appt 1h is on Oct 5 11:45 AM? No, slot 10:00 AM with testNow 09:15 AM -> 45 mins away -> gets 1h reminder

        // 1. Confirmed booking 23 hours away (Oct 6 10:00 AM when testNow is Oct 5 11:00 AM)
        $appt24h = Appointment::create([
            'booking_reference' => 'ASTRO-24H',
            'name' => 'Client 24h',
            'email' => 'client24h@example.com',
            'phone' => '9876543210',
            'consultation_type' => 'Normal',
            'consultation_mode' => 'Audio',
            'amount' => 3000.00,
            'preferred_date' => '2026-10-06',
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'status' => 'Confirmed',
            'payment_status' => 'Paid',
        ]);

        // 2. Confirmed booking 45 minutes away (Oct 5 10:00 AM when testNow is Oct 5 09:15 AM)
        $appt1h = Appointment::create([
            'booking_reference' => 'ASTRO-1H',
            'name' => 'Client 1h',
            'email' => 'client1h@example.com',
            'phone' => '9876543211',
            'consultation_type' => 'Urgent',
            'consultation_mode' => 'Audio',
            'amount' => 5000.00,
            'preferred_date' => '2026-10-05',
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'status' => 'Confirmed',
            'payment_status' => 'Paid',
        ]);

        // 3. Cancelled booking 45 minutes away -> Should NOT get reminder
        $apptCancelled = Appointment::create([
            'booking_reference' => 'ASTRO-CANCELLED',
            'name' => 'Client Cancelled',
            'email' => 'cancelled@example.com',
            'phone' => '9876543212',
            'consultation_type' => 'Normal',
            'consultation_mode' => 'Audio',
            'amount' => 3000.00,
            'preferred_date' => '2026-10-05',
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'status' => 'Cancelled',
            'payment_status' => 'Paid',
        ]);

        // 4. Expired booking 45 minutes away -> Should NOT get reminder
        $apptExpired = Appointment::create([
            'booking_reference' => 'ASTRO-EXPIRED',
            'name' => 'Client Expired',
            'email' => 'expired@example.com',
            'phone' => '9876543213',
            'consultation_type' => 'Urgent',
            'consultation_mode' => 'Audio',
            'amount' => 5000.00,
            'preferred_date' => '2026-10-05',
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'status' => 'Expired',
            'payment_status' => 'Expired',
        ]);

        // Run command at 09:15 AM -> triggers 1h reminder for appt1h
        $this->artisan('consultation:send-reminders')->assertExitCode(0);

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\ConsultationReminder1hMail::class, function ($mail) use ($appt1h) {
            return $mail->hasTo($appt1h->email);
        });

        // Travel to 11:00 AM on Oct 5 -> appt24h (Oct 6 10:00 AM) is now 23 hours away -> triggers 24h reminder
        Carbon::setTestNow(Carbon::parse('2026-10-05 11:00:00'));
        $this->artisan('consultation:send-reminders')->assertExitCode(0);

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\ConsultationReminder24hMail::class, function ($mail) use ($appt24h) {
            return $mail->hasTo($appt24h->email);
        });

        \Illuminate\Support\Facades\Mail::assertNotSent(\App\Mail\ConsultationReminder24hMail::class, function ($mail) use ($apptCancelled) {
            return $mail->hasTo($apptCancelled->email);
        });

        \Illuminate\Support\Facades\Mail::assertNotSent(\App\Mail\ConsultationReminder1hMail::class, function ($mail) use ($apptExpired) {
            return $mail->hasTo($apptExpired->email);
        });

        Carbon::setTestNow(); // Reset test time
    }

    /** @test */
    public function test_duplicate_events_do_not_send_duplicate_emails()
    {
        \Illuminate\Support\Facades\Mail::fake();

        $user = User::create([
            'name' => 'Idempotent User',
            'email' => 'idempotent@example.com',
            'phone' => '9999988888',
            'password' => bcrypt('password123'),
            'is_admin' => false,
            'is_active' => true,
        ]);

        // Call welcome email twice
        BookingService::sendWelcomeEmail($user);
        BookingService::sendWelcomeEmail($user);

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\CustomerWelcomeMail::class, 1);

        $appointment = BookingService::createPendingBooking([
            'name' => 'Idempotent Booking',
            'email' => 'booking.idempotent@example.com',
            'phone' => '9999977777',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        // Confirm twice
        BookingService::confirmPaymentAndBooking($appointment, 'pay_test_1');
        BookingService::confirmPaymentAndBooking($appointment, 'pay_test_1');

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\BookingConfirmedMail::class, 1);

        // Mark failed twice on another appointment
        $apptFailed = BookingService::createPendingBooking([
            'name' => 'Failed Idempotent',
            'email' => 'failed.idempotent@example.com',
            'phone' => '9999966666',
            'consultation_type' => 'normal',
            'preferred_date' => Carbon::tomorrow('Asia/Kolkata')->format('Y-m-d'),
            'preferred_time' => '02:00 PM - 05:00 PM IST',
        ]);

        BookingService::markPaymentFailed($apptFailed);
        BookingService::markPaymentFailed($apptFailed);

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\PaymentFailedMail::class, 1);
    }
}

