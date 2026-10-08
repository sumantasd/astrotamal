<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\BlockedSlot;
use App\Services\BookingService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingAvailabilityRulesTest extends TestCase
{
    use RefreshDatabase;

    protected string $tz = 'Asia/Kolkata';

    /** Helper to get next specific day of week (1 = Monday, 7 = Sunday) at least $minDays in future */
    protected function getNextDayOfWeek(int $dayOfWeekIso, int $minDays = 1): Carbon
    {
        $date = Carbon::now($this->tz)->addDays($minDays);
        while ($date->dayOfWeekIso !== $dayOfWeekIso) {
            $date->addDay();
        }
        return $date;
    }

    // ==========================================
    // URGENT CONSULTATION TESTS
    // ==========================================

    /** @test */
    public function urgent_booking_today_is_rejected()
    {
        $today = Carbon::now($this->tz)->format('Y-m-d');

        $response = $this->post(route('consultation.submit'), [
            'name' => 'Urgent Today User',
            'phone' => '9876543210',
            'birth_date' => '1990-01-01',
            'consultation_type' => 'urgent',
            'preferred_date' => $today,
            'preferred_time' => '9:25 PM - 9:45 PM',
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasErrors('preferred_date');
        $this->assertEquals(0, Appointment::count());
    }

    /** @test */
    public function urgent_booking_tomorrow_is_accepted_if_slot_is_available()
    {
        $tomorrow = Carbon::now($this->tz)->addDay();
        $availableSlots = BookingService::getAvailableSlots($tomorrow->format('Y-m-d'), 'urgent');
        $openSlot = collect($availableSlots)->firstWhere('available', true);

        $this->assertNotNull($openSlot, 'Should have at least one open slot for tomorrow urgent booking.');

        $response = $this->post(route('consultation.submit'), [
            'name' => 'Urgent Tomorrow User',
            'phone' => '9876543210',
            'birth_date' => '1990-01-01',
            'consultation_type' => 'urgent',
            'preferred_date' => $tomorrow->format('Y-m-d'),
            'preferred_time' => $openSlot['time'],
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertEquals(1, Appointment::count());
    }

    /** @test */
    public function urgent_monday_weekly_recurring_blocks()
    {
        $monday = $this->getNextDayOfWeek(1, 1);
        $dateStr = $monday->format('Y-m-d');

        // Monday: 9:00-9:20 BLOCKED, 9:25-9:45 OPEN, 9:50-10:10 OPEN
        $this->assertFalse(BookingService::isSlotAvailable($dateStr, '9:00 PM - 9:20 PM', 'urgent'));
        $this->assertTrue(BookingService::isSlotAvailable($dateStr, '9:25 PM - 9:45 PM', 'urgent'));
        $this->assertTrue(BookingService::isSlotAvailable($dateStr, '9:50 PM - 10:10 PM', 'urgent'));
    }

    /** @test */
    public function urgent_tuesday_to_friday_weekly_recurring_blocks()
    {
        foreach ([2, 3, 4, 5] as $dayIso) {
            $dayDate = $this->getNextDayOfWeek($dayIso, 1);
            $dateStr = $dayDate->format('Y-m-d');

            // Tue-Fri: 9:00-9:20 OPEN, 9:25-9:45 OPEN, 9:50-10:10 BLOCKED
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '9:00 PM - 9:20 PM', 'urgent'), "Failed on day $dayIso 9:00");
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '9:25 PM - 9:45 PM', 'urgent'), "Failed on day $dayIso 9:25");
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '9:50 PM - 10:10 PM', 'urgent'), "Failed on day $dayIso 9:50");
        }
    }

    /** @test */
    public function urgent_saturday_and_sunday_weekly_recurring_blocks()
    {
        foreach ([6, 7] as $dayIso) {
            $dayDate = $this->getNextDayOfWeek($dayIso, 1);
            $dateStr = $dayDate->format('Y-m-d');

            // Sat-Sun: 9:00-9:20 OPEN, 9:25-9:45 BLOCKED, 9:50-10:10 BLOCKED
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '9:00 PM - 9:20 PM', 'urgent'));
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '9:25 PM - 9:45 PM', 'urgent'));
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '9:50 PM - 10:10 PM', 'urgent'));
        }
    }

    // ==========================================
    // NORMAL CONSULTATION ADVANCE RULE & WEEKLY BLOCKS
    // ==========================================

    /** @test */
    public function normal_booking_rejected_for_days_0_to_6_and_accepted_on_day_7()
    {
        for ($i = 0; $i <= 6; $i++) {
            $dateStr = Carbon::now($this->tz)->addDays($i)->format('Y-m-d');
            $this->assertFalse(
                BookingService::isDateAllowedForType($dateStr, 'normal'),
                "Date +$i days should be rejected for normal consultation"
            );
        }

        $day7Str = Carbon::now($this->tz)->addDays(7)->format('Y-m-d');
        $this->assertTrue(
            BookingService::isDateAllowedForType($day7Str, 'normal'),
            "Date +7 days should be allowed for normal consultation"
        );
    }

    /** @test */
    public function normal_monday_weekly_blocks()
    {
        $monday = $this->getNextDayOfWeek(1, 7);
        $dateStr = $monday->format('Y-m-d');

        // Monday starts 5:40 PM.
        $this->assertFalse(BookingService::isSlotAvailable($dateStr, '4:00 PM - 4:20 PM', 'normal'));
        $this->assertFalse(BookingService::isSlotAvailable($dateStr, '4:25 PM - 4:45 PM', 'normal'));
        $this->assertFalse(BookingService::isSlotAvailable($dateStr, '4:50 PM - 5:10 PM', 'normal'));
        $this->assertFalse(BookingService::isSlotAvailable($dateStr, '5:15 PM - 5:35 PM', 'normal'));

        $this->assertTrue(BookingService::isSlotAvailable($dateStr, '5:40 PM - 6:00 PM', 'normal'));
        $this->assertTrue(BookingService::isSlotAvailable($dateStr, '6:00 PM - 6:20 PM', 'normal'));
        $this->assertTrue(BookingService::isSlotAvailable($dateStr, '6:25 PM - 6:45 PM', 'normal'));
        $this->assertTrue(BookingService::isSlotAvailable($dateStr, '6:50 PM - 7:10 PM', 'normal'));

        // 8 PM slots rejected on Monday
        $this->assertFalse(BookingService::isSlotAvailable($dateStr, '8:00 PM - 8:20 PM', 'normal'));
        $this::assertFalse(BookingService::isSlotAvailable($dateStr, '8:25 PM - 8:45 PM', 'normal'));
    }

    /** @test */
    public function normal_tuesday_and_wednesday_weekly_blocks()
    {
        foreach ([2, 3] as $dayIso) {
            $dayDate = $this->getNextDayOfWeek($dayIso, 7);
            $dateStr = $dayDate->format('Y-m-d');

            // ONLY 4:25 PM - 4:45 PM is OPEN
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '4:25 PM - 4:45 PM', 'normal'));

            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '4:00 PM - 4:20 PM', 'normal'));
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '4:50 PM - 5:10 PM', 'normal'));
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '5:40 PM - 6:00 PM', 'normal'));
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '6:00 PM - 6:20 PM', 'normal'));
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '8:00 PM - 8:20 PM', 'normal'));
        }
    }

    /** @test */
    public function normal_thursday_and_friday_weekly_blocks()
    {
        foreach ([4, 5] as $dayIso) {
            $dayDate = $this->getNextDayOfWeek($dayIso, 7);
            $dateStr = $dayDate->format('Y-m-d');

            // Available through 6:00 PM - 6:20 PM
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '4:00 PM - 4:20 PM', 'normal'));
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '4:25 PM - 4:45 PM', 'normal'));
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '4:50 PM - 5:10 PM', 'normal'));
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '5:15 PM - 5:35 PM', 'normal'));
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '5:40 PM - 6:00 PM', 'normal'));
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '6:00 PM - 6:20 PM', 'normal'));

            // 6:25 PM onward blocked
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '6:25 PM - 6:45 PM', 'normal'));
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '6:50 PM - 7:10 PM', 'normal'));
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '8:00 PM - 8:20 PM', 'normal'));
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '8:25 PM - 8:45 PM', 'normal'));
        }
    }

    /** @test */
    public function normal_saturday_and_sunday_weekly_blocks()
    {
        foreach ([6, 7] as $dayIso) {
            $dayDate = $this->getNextDayOfWeek($dayIso, 7);
            $dateStr = $dayDate->format('Y-m-d');

            // Before 8 PM: ALL BLOCKED
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '4:00 PM - 4:20 PM', 'normal'));
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '6:00 PM - 6:20 PM', 'normal'));
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '6:50 PM - 7:10 PM', 'normal'));

            // 8 PM slots: OPEN
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '8:00 PM - 8:20 PM', 'normal'));
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '8:25 PM - 8:45 PM', 'normal'));
        }
    }

    /** @test */
    public function permanent_8_pm_rule_enforced()
    {
        // Monday-Friday: 8:00 PM and 8:25 PM BLOCKED
        for ($dayIso = 1; $dayIso <= 5; $dayIso++) {
            $dayDate = $this->getNextDayOfWeek($dayIso, 7);
            $dateStr = $dayDate->format('Y-m-d');

            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '8:00 PM - 8:20 PM', 'normal'));
            $this->assertFalse(BookingService::isSlotAvailable($dateStr, '8:25 PM - 8:45 PM', 'normal'));
        }

        // Saturday-Sunday: 8:00 PM and 8:25 PM OPEN
        for ($dayIso = 6; $dayIso <= 7; $dayIso++) {
            $dayDate = $this->getNextDayOfWeek($dayIso, 7);
            $dateStr = $dayDate->format('Y-m-d');

            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '8:00 PM - 8:20 PM', 'normal'));
            $this->assertTrue(BookingService::isSlotAvailable($dateStr, '8:25 PM - 8:45 PM', 'normal'));
        }
    }

    // ==========================================
    // ADMIN BLOCK & ALREADY BOOKED & DOUBLE BOOKING
    // ==========================================

    /** @test */
    public function admin_blocked_slot_prevents_booking()
    {
        $monday = $this->getNextDayOfWeek(1, 1);
        $dateStr = $monday->format('Y-m-d');
        $slot = '9:25 PM - 9:45 PM';

        // Initially open
        $this->assertTrue(BookingService::isSlotAvailable($dateStr, $slot, 'urgent'));

        // Admin blocks it
        BlockedSlot::create([
            'blocked_date' => $dateStr,
            'time_slot' => $slot,
            'consultation_type' => 'urgent',
            'is_active' => true,
        ]);

        $this->assertFalse(BookingService::isSlotAvailable($dateStr, $slot, 'urgent'));
    }

    /** @test */
    public function already_booked_slot_prevents_double_booking()
    {
        $tuesday = $this->getNextDayOfWeek(2, 7);
        $dateStr = $tuesday->format('Y-m-d');
        $slot = '4:25 PM - 4:45 PM';

        // First booking succeeds
        $app1 = BookingService::createPendingBooking([
            'name' => 'First Client',
            'phone' => '9876543210',
            'consultation_type' => 'normal',
            'preferred_date' => $dateStr,
            'preferred_time' => $slot,
        ]);

        $this->assertNotNull($app1);

        // Slot is now unavailable
        $this->assertFalse(BookingService::isSlotAvailable($dateStr, $slot, 'normal'));

        // Second booking attempt fails on backend validation
        $response = $this->post(route('consultation.submit'), [
            'name' => 'Second Client',
            'phone' => '9876543211',
            'birth_date' => '1990-01-01',
            'consultation_type' => 'normal',
            'preferred_date' => $dateStr,
            'preferred_time' => $slot,
            'terms_consent' => '1',
        ]);

        $response->assertSessionHasErrors('preferred_time');
        $this->assertEquals(1, Appointment::count());
    }
}
