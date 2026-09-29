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
            'preferred_date' => Carbon::tomorrow()->format('Y-m-d'),
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
            'preferred_date' => Carbon::tomorrow()->format('Y-m-d'),
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
            'preferred_date' => Carbon::tomorrow()->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
        ]);

        $response->assertSessionHasErrors('terms_consent');
        $this->assertEquals(0, Appointment::count());
    }

    /** @test */
    public function test_blocked_slot_prevents_customer_booking()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
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
        $targetDate = Carbon::tomorrow();
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
    public function test_server_side_payment_verification_confirms_booking_and_paid_status()
    {
        $appointment = BookingService::createPendingBooking([
            'name' => 'John Doe',
            'phone' => '9876543210',
            'consultation_type' => 'urgent',
            'preferred_date' => Carbon::tomorrow()->format('Y-m-d'),
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
            'preferred_date' => Carbon::tomorrow()->format('Y-m-d'),
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
        $response = $this->get('/custom-admin/dashboard');
        $response->assertRedirect('/custom-admin/login');
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

        $response = $this->get('/custom-admin/login');
        $response->assertStatus(200);

        $this->actingAs($admin);
        $dashboardResponse = $this->get('/custom-admin/dashboard');
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
            'preferred_date' => Carbon::tomorrow()->format('Y-m-d'),
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
            'preferred_date' => Carbon::tomorrow()->format('Y-m-d'),
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
            'preferred_date' => Carbon::tomorrow()->format('Y-m-d'),
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
            'preferred_date' => Carbon::tomorrow()->format('Y-m-d'),
            'preferred_time' => '10:00 AM - 01:00 PM IST',
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasErrors('preferred_time');
        $this->assertEquals(0, Appointment::count());
    }

    /** @test */
    public function test_occupied_active_reservation_prevents_duplicate_booking()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
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
}

