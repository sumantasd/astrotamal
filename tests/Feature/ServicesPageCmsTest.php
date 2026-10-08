<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicesPageCmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);
    }

    public function test_services_hero_appears_first_above_intro_and_quick_booking(): void
    {
        $response = $this->get('/services');

        $response->assertStatus(200);

        $content = $response->getContent();

        $heroPos = strpos($content, 'Guidance For The Important Questions In Life');
        $introPos = strpos($content, 'আমাদের পরিষেবা');

        $this->assertTrue($heroPos < $introPos, 'Services Hero must appear before "আমাদের পরিষেবা"');
    }

    public function test_individual_section_visibility_toggles_work(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'is_active' => true,
        ]);

        // 1. Turn Hero OFF
        SiteSetting::set('section_services_hero_active', '0', 'services');

        $response = $this->get('/services');
        $response->assertDontSee('Guidance For The Important Questions In Life');
        $response->assertSee('আমাদের পরিষেবা');

        // 2. Turn Quick Booking OFF
        SiteSetting::set('section_services_quick_booking_active', '0', 'services');

        $response = $this->get('/services');
        $response->assertDontSee('⚡ QUICK BOOKING');
        $response->assertSee('জোটক বিচার');

        // 3. Turn Numerology OFF
        SiteSetting::set('services_numerology_active', '0', 'services');

        $response = $this->get('/services');
        $response->assertDontSee('Numerology Calculation');

        // 4. Restore sections ON
        SiteSetting::set('section_services_hero_active', '1', 'services');
        SiteSetting::set('section_services_quick_booking_active', '1', 'services');
        SiteSetting::set('services_numerology_active', '1', 'services');

        $restoredResponse = $this->get('/services');
        $restoredResponse->assertSee('Guidance For The Important Questions In Life');
        $restoredResponse->assertSee('⚡ QUICK BOOKING');
        $restoredResponse->assertSee('জোটক বিচার');
        $restoredResponse->assertSee('Numerology Calculation');
    }

    public function test_admin_can_access_services_page_cms_editor(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->get('/admin-tamal/services-page');

        $response->assertStatus(200);
        $response->assertSee('Services Page Management');
        $response->assertSee('1. Services Hero');
        $response->assertSee('Quick Booking');
        $response->assertSee('Master Visibility (ON/OFF)');
    }

    public function test_admin_can_update_services_page_settings(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'is_active' => true,
        ]);

        $updateData = [
            'section_services_hero_active' => '1',
            'section_services_intro_header_active' => '1',
            'section_services_quick_booking_active' => '1',
            'services_urgent_active' => '1',
            'services_normal_active' => '1',
            'services_phone_active' => '1',
            'services_kundli_active' => '1',
            'services_remedy_active' => '1',

            'services_hero_eyebrow' => 'SPECIAL ASTRO GUIDANCE',
            'services_hero_heading' => 'Custom Hero Title',
            'services_hero_description' => 'Custom hero description.',

            'services_intro_eyebrow' => 'SPECIAL ASTRO SERVICES',
            'services_intro_heading' => 'আমাদের সমস্ত পরিষেবা সমূহ',
            'services_intro_description' => 'Updated phone consultation notes.',

            'services_qb_heading' => '⚡ FAST CONSULTATION BOOKING',
            'services_urgent_title' => 'Priority Urgent Consultation',
            'services_urgent_subtitle' => 'Within 12 hours',
            'services_urgent_price' => '₹5,500',
            'services_urgent_icon' => '🚨',

            'services_normal_title' => 'Standard Consultation',
            'services_normal_subtitle' => 'Within 5 business days',
            'services_normal_price' => '₹3,200',
            'services_normal_icon' => '📅',

            'services_phone_heading' => 'ফোন কল পরামর্শ',
            'services_phone_subtitle' => 'Call for more details',
            'services_phone_btn_text' => 'WhatsApp Astrologer',
            'services_phone_btn_url' => 'https://wa.me/918392059201',

            'services_kundli_heading' => 'Janam Kundli Reading',
            'services_kundli_description' => 'Detailed Janam Kundli analysis during consultation.',

            'services_remedy_heading' => 'Vedic Remedies & Gemstones',
            'services_remedy_description' => 'Effective remedies and gemstone recommendations.',

            'seo_title' => 'Custom Services SEO Title | Tamal Chakraborty',
            'meta_description' => 'Custom services meta description.',
        ];

        $response = $this->actingAs($admin)
            ->post('/admin-tamal/services-page/settings', $updateData);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertEquals('SPECIAL ASTRO SERVICES', SiteSetting::get('services_intro_eyebrow'));
        $this->assertEquals('Priority Urgent Consultation', SiteSetting::get('services_urgent_title'));

        // Verify updated values reflect on public /services page
        $publicResponse = $this->get('/services');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('SPECIAL ASTRO GUIDANCE');
        $publicResponse->assertSee('Custom Hero Title');
        $publicResponse->assertSee('SPECIAL ASTRO SERVICES');
        $publicResponse->assertSee('আমাদের সমস্ত পরিষেবা সমূহ');
        $publicResponse->assertSee('⚡ FAST CONSULTATION BOOKING');
        $publicResponse->assertSee('Priority Urgent Consultation');
        $publicResponse->assertSee('₹5,500');
        $publicResponse->assertSee('WhatsApp Astrologer');
    }

    public function test_guest_cannot_update_services_page_settings(): void
    {
        $response = $this->post('/admin-tamal/services-page/settings', [
            'services_intro_heading' => 'Hacked Heading',
        ]);

        $response->assertRedirect('/admin-tamal/login');
        $this->assertNotEquals('Hacked Heading', SiteSetting::get('services_intro_heading'));
    }
}
