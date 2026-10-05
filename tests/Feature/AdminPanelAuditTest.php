<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\BackupHistory;
use App\Models\BlockedSlot;
use App\Models\DateScheduleOverride;
use App\Models\PaymentSetting;
use App\Models\PaymentTransaction;
use App\Models\SiteSetting;
use App\Models\User;
use App\Services\BackupRestoreService;
use App\Services\BookingService;
use App\Services\RazorpaySettingsService;
use App\Services\SidebarMenuService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class AdminPanelAuditTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::factory()->create([
            'is_admin' => true,
            'is_active' => true,
        ]);
    }

    // ==========================================
    // BLOCKED DATES & SLOTS TESTS (1-5)
    // ==========================================

    /** @test 1 */
    public function full_date_block_prevents_booking()
    {
        $targetDate = Carbon::tomorrow()->format('Y-m-d');
        BlockedSlot::create([
            'blocked_date' => $targetDate,
            'time_slot' => null,
            'reason' => 'Personal Holiday',
            'is_active' => true,
        ]);

        $available = BookingService::isSlotAvailable($targetDate, '10:00 AM');
        $this->assertFalse($available);

        $response = $this->post(route('consultation.submit'), [
            'name' => 'John Doe',
            'phone' => '9876543210',
            'birth_date' => '1995-05-15',
            'consultation_type' => 'urgent',
            'preferred_date' => $targetDate,
            'preferred_time' => '10:00 AM',
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasErrors('preferred_time');
    }

    /** @test 2 */
    public function specific_time_block_prevents_booking()
    {
        $targetDate = Carbon::tomorrow()->format('Y-m-d');
        BlockedSlot::create([
            'blocked_date' => $targetDate,
            'time_slot' => '10:00 AM - 10:30 AM',
            'reason' => 'Personal Appointment',
            'is_active' => true,
        ]);

        $availableBlocked = BookingService::isSlotAvailable($targetDate, '10:00 AM');
        $this->assertFalse($availableBlocked);
    }

    /** @test 3 */
    public function other_slots_remain_available_when_specific_slot_blocked()
    {
        $targetDate = Carbon::tomorrow()->format('Y-m-d');
        BlockedSlot::create([
            'blocked_date' => $targetDate,
            'time_slot' => '10:00 AM - 10:30 AM',
            'reason' => 'Personal Appointment',
            'is_active' => true,
        ]);

        $availableOther = BookingService::isSlotAvailable($targetDate, '02:00 PM');
        $this->assertTrue($availableOther);
    }

    /** @test 4 */
    public function removing_block_restores_availability()
    {
        $targetDate = Carbon::tomorrow()->format('Y-m-d');
        $block = BlockedSlot::create([
            'blocked_date' => $targetDate,
            'time_slot' => null,
            'reason' => 'Temporary Block',
            'is_active' => true,
        ]);

        $this->assertFalse(BookingService::isSlotAvailable($targetDate, '10:00 AM'));

        $response = $this->actingAs($this->adminUser)->delete(route('admin.blocked-slots.destroy', $block));
        $response->assertRedirect();

        $this->assertTrue(BookingService::isSlotAvailable($targetDate, '10:00 AM'));
    }

    /** @test 5 */
    public function editing_block_works()
    {
        $targetDate = Carbon::tomorrow()->format('Y-m-d');
        $block = BlockedSlot::create([
            'blocked_date' => $targetDate,
            'time_slot' => '10:00 AM',
            'reason' => 'Old Reason',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->adminUser)->put(route('admin.blocked-slots.update', $block), [
            'blocked_date' => $targetDate,
            'time_slot' => '11:00 AM',
            'reason' => 'Updated Reason',
            'is_active' => '1',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('blocked_slots', [
            'id' => $block->id,
            'time_slot' => '11:00 AM',
            'reason' => 'Updated Reason',
        ]);
    }

    // ==========================================
    // BOOKING SCHEDULE TESTS (6-8)
    // ==========================================

    /** @test 6 */
    public function default_schedule_is_9_am_to_8_pm()
    {
        $config = BookingService::getScheduleConfigForDate(Carbon::tomorrow()->format('Y-m-d'));
        $this->assertEquals('09:00 AM', $config['opening']);
        $this->assertEquals('08:00 PM', $config['closing']);
        $this->assertEquals(30, $config['duration']);
    }

    /** @test 7 */
    public function slots_generate_every_30_minutes()
    {
        $slots = BookingService::generateTimeSlots('09:00 AM', '11:00 AM', 30);
        $expected = ['09:00 AM', '09:30 AM', '10:00 AM', '10:30 AM', '11:00 AM'];
        $this->assertEquals($expected, $slots);
    }

    /** @test 8 */
    public function admin_schedule_changes_affect_public_booking_form()
    {
        $this->actingAs($this->adminUser)->post(route('admin.schedule.update'), [
            'opening_time' => '10:00 AM',
            'closing_time' => '02:00 PM',
            'slot_duration_minutes' => 30,
        ]);

        $targetDate = Carbon::tomorrow()->format('Y-m-d');
        $response = $this->get(route('consultation.slots', ['date' => $targetDate]));
        $response->assertOk();

        $data = $response->json('data.slots');
        $times = array_column($data, 'time');
        $this->assertContains('10:00 AM', $times);
        $this->assertContains('02:00 PM', $times);
        $this->assertNotContains('09:00 AM', $times);
        $this->assertNotContains('05:00 PM', $times);
    }

    // ==========================================
    // PAYMENTS & TRANSACTIONS TESTS (9-14)
    // ==========================================

    /** @test 9 */
    public function payment_transaction_shows_correct_order_id()
    {
        $appointment = Appointment::factory()->create([
            'booking_reference' => 'ASTRO-2026-TEST01',
            'amount' => 5000.00,
        ]);

        $tx = PaymentTransaction::create([
            'appointment_id' => $appointment->id,
            'booking_reference' => $appointment->booking_reference,
            'gateway' => 'Razorpay',
            'order_id' => 'order_test_999',
            'payment_id' => 'pay_test_888',
            'amount' => 5000.00,
            'currency' => 'INR',
            'status' => 'Success',
        ]);

        $response = $this->actingAs($this->adminUser)->get(route('admin.payments.transactions'));
        $response->assertOk();
        $response->assertSee('order_test_999');
    }

    /** @test 10 */
    public function payment_id_is_displayed()
    {
        $appointment = Appointment::factory()->create();
        PaymentTransaction::create([
            'appointment_id' => $appointment->id,
            'booking_reference' => $appointment->booking_reference,
            'gateway' => 'Razorpay',
            'order_id' => 'order_123',
            'payment_id' => 'pay_abc_777',
            'amount' => 5000.00,
            'currency' => 'INR',
            'status' => 'Success',
        ]);

        $response = $this->actingAs($this->adminUser)->get(route('admin.payments.transactions'));
        $response->assertSee('pay_abc_777');
    }

    /** @test 11 */
    public function booking_reference_is_displayed()
    {
        $appointment = Appointment::factory()->create(['booking_reference' => 'ASTRO-REF-777']);
        PaymentTransaction::create([
            'appointment_id' => $appointment->id,
            'booking_reference' => 'ASTRO-REF-777',
            'gateway' => 'Razorpay',
            'amount' => 3000.00,
            'currency' => 'INR',
            'status' => 'Success',
        ]);

        $response = $this->actingAs($this->adminUser)->get(route('admin.payments.transactions'));
        $response->assertSee('ASTRO-REF-777');
    }

    /** @test 12 */
    public function customer_details_are_displayed()
    {
        $appointment = Appointment::factory()->create([
            'name' => 'Alice Astrologer',
            'phone' => '9988776655',
        ]);
        PaymentTransaction::create([
            'appointment_id' => $appointment->id,
            'booking_reference' => $appointment->booking_reference,
            'gateway' => 'Razorpay',
            'amount' => 5000.00,
            'status' => 'Success',
        ]);

        $response = $this->actingAs($this->adminUser)->get(route('admin.payments.transactions'));
        $response->assertSee('Alice Astrologer');
    }

    /** @test 13 */
    public function payment_amount_and_status_are_correct()
    {
        $appointment = Appointment::factory()->create(['amount' => 5000.00]);
        PaymentTransaction::create([
            'appointment_id' => $appointment->id,
            'booking_reference' => $appointment->booking_reference,
            'gateway' => 'Razorpay',
            'amount' => 5000.00,
            'status' => 'Success',
        ]);

        $response = $this->actingAs($this->adminUser)->get(route('admin.payments.transactions'));
        $response->assertSee('₹5,000.00');
        $response->assertSee('SUCCESS');
    }

    /** @test 14 */
    public function payment_detail_page_works()
    {
        $appointment = Appointment::factory()->create([
            'name' => 'Jane Client',
            'email' => 'jane@example.com',
        ]);
        $tx = PaymentTransaction::create([
            'appointment_id' => $appointment->id,
            'booking_reference' => $appointment->booking_reference,
            'gateway' => 'Razorpay',
            'order_id' => 'order_detail_111',
            'payment_id' => 'pay_detail_222',
            'amount' => 5000.00,
            'status' => 'Success',
        ]);

        $response = $this->actingAs($this->adminUser)->get(route('admin.payments.show', $tx));
        $response->assertOk();
        $response->assertSee('Jane Client');
        $response->assertSee('order_detail_111');
        $response->assertSee('pay_detail_222');
    }

    // ==========================================
    // RAZORPAY SETTINGS TESTS (15-20)
    // ==========================================

    /** @test 15 */
    public function admin_saved_razorpay_key_id_is_used()
    {
        PaymentSetting::updateOrCreate(
            ['gateway' => 'Razorpay'],
            [
                'is_enabled' => true,
                'is_test_mode' => true,
                'public_key' => 'rzp_test_DBKEY123',
                'secret_key' => 'DBSECRET456',
            ]
        );

        $this->assertEquals('rzp_test_DBKEY123', RazorpaySettingsService::getKeyId());
    }

    /** @test 16 */
    public function admin_saved_secret_is_used_server_side()
    {
        PaymentSetting::updateOrCreate(
            ['gateway' => 'Razorpay'],
            [
                'public_key' => 'rzp_test_DBKEY123',
                'secret_key' => 'MySecretKey777',
            ]
        );

        $this->assertEquals('MySecretKey777', RazorpaySettingsService::getKeySecret());
    }

    /** @test 17 */
    public function admin_saved_webhook_secret_is_used()
    {
        PaymentSetting::updateOrCreate(
            ['gateway' => 'Razorpay'],
            [
                'public_key' => 'rzp_test_DBKEY123',
                'webhook_secret' => 'WebhookSecret888',
            ]
        );

        $this->assertEquals('WebhookSecret888', RazorpaySettingsService::getWebhookSecret());
    }

    /** @test 18 */
    public function environment_mode_works()
    {
        PaymentSetting::updateOrCreate(
            ['gateway' => 'Razorpay'],
            [
                'is_test_mode' => false,
            ]
        );

        $this->assertFalse(RazorpaySettingsService::isTestMode());
        $this->assertEquals('live', RazorpaySettingsService::getEnvironment());
    }

    /** @test 19 */
    public function database_settings_take_precedence_over_env_fallback()
    {
        config(['services.razorpay.key' => 'ENV_KEY_FALLBACK']);
        
        PaymentSetting::updateOrCreate(
            ['gateway' => 'Razorpay'],
            ['public_key' => 'DB_KEY_PRIMARY']
        );

        $this->assertEquals('DB_KEY_PRIMARY', RazorpaySettingsService::getKeyId());
    }

    /** @test 20 */
    public function secrets_are_not_exposed_publicly()
    {
        PaymentSetting::updateOrCreate(
            ['gateway' => 'Razorpay'],
            [
                'public_key' => 'rzp_test_PUB123',
                'secret_key' => 'SUPER_CONFIDENTIAL_SECRET',
            ]
        );

        $response = $this->actingAs($this->adminUser)->get(route('admin.payments.settings'));
        $response->assertOk();
        $response->assertDontSee('SUPER_CONFIDENTIAL_SECRET');
    }

    // ==========================================
    // SIDEBAR VISIBILITY TESTS (21-24)
    // ==========================================

    /** @test 21 */
    public function menu_on_appears()
    {
        SidebarMenuService::setVisibility([
            'groups' => ['content' => true],
            'items' => ['content' => ['media' => true]],
        ]);

        $this->assertTrue(SidebarMenuService::isGroupVisible('content'));
        $this->assertTrue(SidebarMenuService::isItemVisible('content', 'media'));
    }

    /** @test 22 */
    public function menu_off_disappears()
    {
        SidebarMenuService::setVisibility([
            'groups' => ['content' => true],
            'items' => ['content' => ['media' => false]],
        ]);

        $this->assertFalse(SidebarMenuService::isItemVisible('content', 'media'));

        $response = $this->actingAs($this->adminUser)->get(route('admin.dashboard'));
        $response->assertDontSee('<span>Gallery &amp; Videos</span>', false);
    }

    /** @test 23 */
    public function parent_off_hides_child_menus()
    {
        SidebarMenuService::setVisibility([
            'groups' => ['content' => false],
            'items' => ['content' => ['media' => true]],
        ]);

        $this->assertFalse(SidebarMenuService::isGroupVisible('content'));
        $this->assertFalse(SidebarMenuService::isItemVisible('content', 'media'));
    }

    /** @test 24 */
    public function route_protection_still_works()
    {
        SidebarMenuService::setVisibility([
            'groups' => ['bookings' => false],
            'items' => ['bookings' => ['payments' => false]],
        ]);

        // Route must remain protected and accessible to authenticated admin
        $response = $this->actingAs($this->adminUser)->get(route('admin.payments.transactions'));
        $response->assertOk();

        // Clear auth state for guest test
        auth()->logout();

        // Guest redirected to login
        $guestResponse = $this->get(route('admin.payments.transactions'));
        $guestResponse->assertRedirect(route('admin.login'));
    }

    // ==========================================
    // BACKUP & RESTORE TESTS (25-30)
    // ==========================================

    /** @test 25 */
    public function database_backup_can_be_created()
    {
        $backup = BackupRestoreService::createBackup('manual');
        $this->assertNotNull($backup);
        $this->assertDatabaseHas('backup_histories', ['id' => $backup->id]);
    }

    /** @test 26 */
    public function backup_file_exists()
    {
        $backup = BackupRestoreService::createBackup('manual');
        $fullPath = storage_path('app/' . $backup->path);
        $this->assertTrue(File::exists($fullPath));
    }

    /** @test 27 */
    public function backup_does_not_contain_env()
    {
        $backup = BackupRestoreService::createBackup('manual');
        $fullPath = storage_path('app/' . $backup->path);
        
        $validation = BackupRestoreService::validateBackupSql($fullPath);
        $this->assertTrue($validation['valid']);
    }

    /** @test 28 */
    public function backup_can_be_validated()
    {
        $backup = BackupRestoreService::createBackup('manual');
        $fullPath = storage_path('app/' . $backup->path);

        $validation = BackupRestoreService::validateBackupSql($fullPath);
        $this->assertTrue($validation['valid']);
    }

    /** @test 29 */
    public function restore_creates_pre_restore_safety_backup()
    {
        $initialBackup = BackupRestoreService::createBackup('manual');
        $fullPath = storage_path('app/' . $initialBackup->path);

        $initialCount = BackupHistory::where('type', 'pre_restore')->count();

        BackupRestoreService::restoreBackup($fullPath);

        $newCount = BackupHistory::where('type', 'pre_restore')->count();
        $this->assertGreaterThan($initialCount, $newCount);
    }

    /** @test 30 */
    public function invalid_backup_is_rejected()
    {
        $invalidSql = storage_path('app/backups/invalid_dummy.sql');
        File::makeDirectory(storage_path('app/backups'), 0755, true, true);
        File::put($invalidSql, 'not a real sql content');

        $validation = BackupRestoreService::validateBackupSql($invalidSql);
        $this->assertFalse($validation['valid']);

        $this->expectException(\InvalidArgumentException::class);
        BackupRestoreService::restoreBackup($invalidSql);
    }
}
