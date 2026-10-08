<?php

namespace Tests\Feature;

use App\Models\FooterGuidanceItem;
use App\Models\FooterNavItem;
use App\Models\FooterSocialLink;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmsVisibilitySystemTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin_visibility_' . uniqid() . '@example.com',
            'is_admin' => true,
            'is_active' => true,
        ]);

        FooterNavItem::seedDefaultsIfEmpty();
        FooterGuidanceItem::seedDefaultsIfEmpty();
        FooterSocialLink::seedDefaultsIfEmpty();
        \App\Http\Controllers\LegalPageController::seedLegalPagesIfMissing();
    }

    /** @test */
    public function footer_visibility_toggles_persist_correctly_on_admin_save_and_reload()
    {
        $payload = [
            'footer_enabled' => '1',
            'footer_logo_width' => '260',
            'footer_description' => 'Empowering individuals globally with ancient Vedic wisdom.',
            'footer_col2_title' => 'Quick Navigation',
            'footer_col3_title' => 'Our Guidance',
            'footer_col4_title' => 'Consultation Office',
            'footer_contact_brand' => 'Ganesha Astro Consultancy',
            'footer_contact_phone' => '8392059201',
            'footer_contact_whatsapp' => '8392059201',
            'footer_contact_email' => 'ganesha4astro@gmail.com',
            'footer_contact_address' => 'Kolkata | Bongaon | Ranaghat & More',
            'footer_contact_website' => 'astrotamal.com',
            'footer_copyright_text' => '© {current_year} Ganesha Astro Consultancy. All Rights Reserved.',
            'footer_logo_visible' => '1',
            'footer_col1_enabled' => '1',
            'footer_col2_enabled' => '1',
            'footer_col3_enabled' => '1',
            'footer_col4_enabled' => '1',
            'footer_copyright_enabled' => '1',
        ];

        // Set all to ON initially
        $response = $this->actingAs($this->admin)->post(route('admin.settings.footer.update-general'), $payload);
        $response->assertRedirect();

        // Reload admin page and verify settings
        $adminView = $this->actingAs($this->admin)->get(route('admin.settings.footer'));
        $adminView->assertOk();
        $this->assertEquals('1', SiteSetting::get('footer_enabled'));
        $this->assertEquals('1', SiteSetting::get('footer_logo_visible'));
        $this->assertEquals('1', SiteSetting::get('footer_col1_enabled'));
        $this->assertEquals('1', SiteSetting::get('footer_col2_enabled'));
        $this->assertEquals('1', SiteSetting::get('footer_col3_enabled'));
        $this->assertEquals('1', SiteSetting::get('footer_col4_enabled'));
        $this->assertEquals('1', SiteSetting::get('footer_copyright_enabled'));

        // Now set logo to 0 and col1 to 0
        $payload['footer_logo_visible'] = '0';
        $payload['footer_col1_enabled'] = '0';

        $response2 = $this->actingAs($this->admin)->post(route('admin.settings.footer.update-general'), $payload);
        $response2->assertRedirect();

        // Verify logo and col1 remain 0, others remain 1
        $this->assertEquals('1', SiteSetting::get('footer_enabled'));
        $this->assertEquals('0', SiteSetting::get('footer_logo_visible'));
        $this->assertEquals('0', SiteSetting::get('footer_col1_enabled'));
        $this->assertEquals('1', SiteSetting::get('footer_col2_enabled'));
        $this->assertEquals('1', SiteSetting::get('footer_col3_enabled'));
        $this->assertEquals('1', SiteSetting::get('footer_col4_enabled'));
        $this->assertEquals('1', SiteSetting::get('footer_copyright_enabled'));
    }

    /** @test */
    public function test_a_footer_logo_on_and_footer_columns_on()
    {
        SiteSetting::set('footer_enabled', '1');
        SiteSetting::set('footer_logo_visible', '1');
        SiteSetting::set('footer_col1_enabled', '1');
        SiteSetting::set('footer_col2_enabled', '1');
        SiteSetting::set('footer_col3_enabled', '1');
        SiteSetting::set('footer_col4_enabled', '1');

        $view = $this->blade('<x-footer />');

        $view->assertSee('images/astrotamal-logo.png');
        $view->assertSee('Quick Navigation');
        $view->assertSee('Our Guidance');
        $view->assertSee('Consultation Office');
    }

    /** @test */
    public function test_b_footer_logo_off_and_footer_columns_on()
    {
        SiteSetting::set('footer_enabled', '1');
        SiteSetting::set('footer_logo_visible', '0');
        SiteSetting::set('footer_col1_enabled', '1');
        SiteSetting::set('footer_col2_enabled', '1');
        SiteSetting::set('footer_col3_enabled', '1');
        SiteSetting::set('footer_col4_enabled', '1');

        $view = $this->blade('<x-footer />');

        // Footer columns STILL visible even when logo is OFF
        $view->assertSee('Quick Navigation');
        $view->assertSee('Our Guidance');
        $view->assertSee('Consultation Office');

        // Logo image hidden from footer
        $view->assertDontSee('images/astrotamal-logo.png');
    }

    /** @test */
    public function test_c_footer_logo_on_and_footer_columns_off()
    {
        SiteSetting::set('footer_enabled', '1');
        SiteSetting::set('footer_logo_visible', '1');
        SiteSetting::set('footer_col1_enabled', '0');
        SiteSetting::set('footer_col2_enabled', '0');
        SiteSetting::set('footer_col3_enabled', '0');
        SiteSetting::set('footer_col4_enabled', '0');

        $view = $this->blade('<x-footer />');

        // Logo visible
        $view->assertSee('images/astrotamal-logo.png');

        // Column titles hidden
        $view->assertDontSee('Quick Navigation');
        $view->assertDontSee('Our Guidance');
        $view->assertDontSee('Consultation Office');
    }

    /** @test */
    public function test_d_column_1_off_column_2_on_column_3_on_column_4_on()
    {
        SiteSetting::set('footer_enabled', '1');
        SiteSetting::set('footer_logo_visible', '1');
        SiteSetting::set('footer_col1_enabled', '0');
        SiteSetting::set('footer_col2_enabled', '1');
        SiteSetting::set('footer_col3_enabled', '1');
        SiteSetting::set('footer_col4_enabled', '1');

        $view = $this->blade('<x-footer />');

        // Column 1 description hidden
        $view->assertDontSee('Empowering individuals globally with ancient Vedic wisdom');

        // Columns 2, 3, 4 visible
        $view->assertSee('Quick Navigation');
        $view->assertSee('Our Guidance');
        $view->assertSee('Consultation Office');
    }

    /** @test */
    public function test_e_all_footer_components_on()
    {
        SiteSetting::set('footer_enabled', '1');
        SiteSetting::set('footer_logo_visible', '1');
        SiteSetting::set('footer_col1_enabled', '1');
        SiteSetting::set('footer_col2_enabled', '1');
        SiteSetting::set('footer_col3_enabled', '1');
        SiteSetting::set('footer_col4_enabled', '1');
        SiteSetting::set('footer_copyright_enabled', '1');

        $view = $this->blade('<x-footer />');

        $view->assertSee('images/astrotamal-logo.png');
        $view->assertSee('Quick Navigation');
        $view->assertSee('Our Guidance');
        $view->assertSee('Consultation Office');
        $view->assertSee('All Rights Reserved');
    }

    /** @test */
    public function test_f_all_footer_components_off()
    {
        SiteSetting::set('footer_enabled', '1');
        SiteSetting::set('footer_logo_visible', '0');
        SiteSetting::set('footer_col1_enabled', '0');
        SiteSetting::set('footer_col2_enabled', '0');
        SiteSetting::set('footer_col3_enabled', '0');
        SiteSetting::set('footer_col4_enabled', '0');
        SiteSetting::set('footer_copyright_enabled', '0');

        $view = $this->blade('<x-footer />');

        // Master footer tag exists
        $view->assertSee('<footer', false);

        // Individual sections hidden
        $view->assertDontSee('images/astrotamal-logo.png');
        $view->assertDontSee('Quick Navigation');
        $view->assertDontSee('Our Guidance');
        $view->assertDontSee('Consultation Office');
        $view->assertDontSee('All Rights Reserved');
    }

    /** @test */
    public function master_footer_disabled_hides_entire_footer()
    {
        SiteSetting::set('footer_enabled', '0');
        SiteSetting::set('footer_logo_visible', '1');
        SiteSetting::set('footer_col1_enabled', '1');

        $view = $this->blade('<x-footer />');

        // Footer block tag should not be rendered
        $view->assertDontSee('<footer', false);
    }
}
