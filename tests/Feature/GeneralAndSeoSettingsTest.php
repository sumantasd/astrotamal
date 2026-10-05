<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GeneralAndSeoSettingsTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin_settings_' . uniqid() . '@example.com',
            'is_admin' => true,
            'is_active' => true,
        ]);
    }

    /** @test */
    public function admin_can_access_general_settings()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.settings.general'));

        $response->assertOk();
        $response->assertSee('General Website Settings');
        $response->assertSee('Website Identity');
    }

    /** @test */
    public function admin_can_save_general_settings_and_public_views_reflect_values()
    {
        $response = $this->actingAs($this->admin)->post(route('admin.settings.general.update'), [
            'site_name' => 'Astrology Divine Portal',
            'site_tagline' => 'Vedic Guidance by Tamal',
            'site_description' => 'Global astrology service.',
            'contact_phone' => '8392059201',
            'whatsapp_number' => '8392059201',
            'contact_email' => 'contact@astrotamal.com',
            'office_address' => 'Kolkata Chamber Office',
            'website_url' => 'https://astrotamal.com',
            'default_language' => 'en',
            'default_timezone' => 'Asia/Kolkata',
        ]);

        $response->assertRedirect(route('admin.settings.general'));
        $this->assertEquals('Astrology Divine Portal', SiteSetting::get('site_name'));
        $this->assertEquals('8392059201', SiteSetting::get('contact_phone'));

        // Public page reflects new site name
        $homeResponse = $this->get(route('home'));
        $homeResponse->assertOk();
        $homeResponse->assertSee('8392059201');
    }

    /** @test */
    public function invalid_email_or_url_in_general_settings_is_rejected()
    {
        $response = $this->actingAs($this->admin)->post(route('admin.settings.general.update'), [
            'site_name' => 'Astrology Portal',
            'contact_phone' => '8392059201',
            'whatsapp_number' => '8392059201',
            'contact_email' => 'invalid-email-address',
            'office_address' => 'Kolkata Address',
            'website_url' => 'not-a-valid-url',
        ]);

        $response->assertSessionHasErrors(['contact_email', 'website_url']);
    }

    /** @test */
    public function unauthorized_users_cannot_update_general_settings()
    {
        auth()->logout();

        $response = $this->post(route('admin.settings.general.update'), [
            'site_name' => 'Hacked Portal',
            'contact_phone' => '0000000000',
            'whatsapp_number' => '0000000000',
            'contact_email' => 'hacker@example.com',
            'office_address' => 'Unknown',
        ]);

        $response->assertRedirect(route('admin.login'));
        $this->assertNotEquals('Hacked Portal', SiteSetting::get('site_name'));
    }

    /** @test */
    public function admin_can_access_seo_settings()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.settings.seo'));

        $response->assertOk();
        $response->assertSee('Global SEO');
        $response->assertSee('Open Graph');
    }

    /** @test */
    public function admin_can_save_seo_settings_and_meta_tags_render_in_public_head()
    {
        $response = $this->actingAs($this->admin)->post(route('admin.settings.seo.update'), [
            'default_meta_title' => 'Custom Global Meta Title - AstroTamal',
            'default_meta_description' => 'Custom meta description for testing SEO rendering.',
            'default_keywords' => 'custom, keywords, test',
            'canonical_base_url' => 'https://astrotamal.com',
            'robots_directive' => 'index, follow',
            'twitter_card_type' => 'summary_large_image',
            'google_site_verification' => 'google-verify-code-12345',
            'bing_site_verification' => 'bing-verify-code-67890',
        ]);

        $response->assertRedirect(route('admin.settings.seo'));
        $this->assertEquals('Custom Global Meta Title - AstroTamal', SiteSetting::get('default_meta_title'));

        $homeResponse = $this->get(route('home'));
        $homeResponse->assertOk();
        $homeResponse->assertSee('Custom meta description for testing SEO rendering.');
        $homeResponse->assertSee('google-site-verification');
        $homeResponse->assertSee('google-verify-code-12345');
        $homeResponse->assertSee('msvalidate.01');
        $homeResponse->assertSee('bing-verify-code-67890');
    }

    /** @test */
    public function page_specific_title_overrides_global_seo_defaults()
    {
        SiteSetting::set('default_meta_title', 'GLOBAL FALLBACK TITLE', 'seo');

        $contactResponse = $this->get(route('contact'));
        $contactResponse->assertOk();
        $contactResponse->assertSee('Contact & Appointments — Tamal Chakraborty');
        $contactResponse->assertDontSee('GLOBAL FALLBACK TITLE');
    }

    /** @test */
    public function maintenance_mode_blocks_public_pages_and_allows_admin_access()
    {
        // Turn ON maintenance mode
        SiteSetting::set('maintenance_mode', '1', 'general');

        // Public visitor is blocked with 503 maintenance page
        $publicResponse = $this->get(route('home'));
        $publicResponse->assertStatus(503);
        $publicResponse->assertSee('SCHEDULED MAINTENANCE');

        // Admin login route remains accessible
        $adminLoginResponse = $this->get(route('admin.login'));
        $adminLoginResponse->assertOk();

        // Authenticated admin can access admin dashboard
        $adminDashboardResponse = $this->actingAs($this->admin)->get(route('admin.dashboard'));
        $adminDashboardResponse->assertOk();

        // Turn OFF maintenance mode
        SiteSetting::set('maintenance_mode', '0', 'general');

        $restoredResponse = $this->get(route('home'));
        $restoredResponse->assertOk();
    }
}
