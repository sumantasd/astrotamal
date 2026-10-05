<?php

namespace Tests\Feature;

use App\Models\CmsPage;
use App\Models\FooterGuidanceItem;
use App\Models\FooterNavItem;
use App\Models\FooterSocialLink;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FooterManagerTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin_footer_' . uniqid() . '@example.com',
            'is_admin' => true,
            'is_active' => true,
        ]);

        FooterNavItem::seedDefaultsIfEmpty();
        FooterGuidanceItem::seedDefaultsIfEmpty();
        FooterSocialLink::seedDefaultsIfEmpty();
        \App\Http\Controllers\LegalPageController::seedLegalPagesIfMissing();
    }

    /** @test */
    public function admin_can_access_footer_manager()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.settings.footer'));

        $response->assertOk();
        $response->assertSee('Footer Manager');
        $response->assertSee('Quick Navigation');
    }

    /** @test */
    public function admin_can_edit_quick_navigation()
    {
        $item = FooterNavItem::where('label', 'Services')->first();

        $response = $this->actingAs($this->admin)->put(route('admin.settings.footer.nav.update', $item), [
            'label' => 'Astrology Offerings',
            'link_type' => 'internal',
            'route_name' => 'services.index',
            'target' => '_self',
            'sort_order' => 3,
            'is_active' => '1',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('footer_nav_items', [
            'id' => $item->id,
            'label' => 'Astrology Offerings',
        ]);
    }

    /** @test */
    public function quick_navigation_changes_appear_publicly()
    {
        FooterNavItem::create([
            'label' => 'Custom Footer Nav Link',
            'link_type' => 'custom',
            'url' => '/custom-footer-link',
            'target' => '_self',
            'sort_order' => 99,
            'is_active' => true,
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Custom Footer Nav Link');
    }

    /** @test */
    public function admin_can_add_edit_delete_social_links()
    {
        // Add
        $addResponse = $this->actingAs($this->admin)->post(route('admin.settings.footer.social.store'), [
            'platform' => 'Telegram',
            'url' => 'https://t.me/astrotamal',
            'icon' => 'telegram',
            'sort_order' => 5,
            'is_active' => '1',
        ]);
        $addResponse->assertRedirect();
        $this->assertDatabaseHas('footer_social_links', ['platform' => 'Telegram']);

        $social = FooterSocialLink::where('platform', 'Telegram')->first();

        // Edit
        $editResponse = $this->actingAs($this->admin)->put(route('admin.settings.footer.social.update', $social), [
            'platform' => 'Telegram Channel',
            'url' => 'https://t.me/astrotamal_official',
            'icon' => 'telegram',
            'sort_order' => 5,
            'is_active' => '1',
        ]);
        $editResponse->assertRedirect();
        $this->assertDatabaseHas('footer_social_links', ['platform' => 'Telegram Channel']);

        // Delete
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.settings.footer.social.destroy', $social));
        $deleteResponse->assertRedirect();
        $this->assertDatabaseMissing('footer_social_links', ['id' => $social->id]);
    }

    /** @test */
    public function social_links_appear_publicly_and_disabled_disappears()
    {
        $social = FooterSocialLink::where('platform', 'Facebook')->first();

        $response = $this->get(route('home'));
        $response->assertOk();
        $response->assertSee($social->url);

        // Disable
        $social->update(['is_active' => false]);

        $disabledResponse = $this->get(route('home'));
        $disabledResponse->assertOk();
        $disabledResponse->assertDontSee($social->url);
    }

    /** @test */
    public function admin_can_edit_contact_details_and_links_work()
    {
        $response = $this->actingAs($this->admin)->post(route('admin.settings.footer.update-general'), [
            'footer_logo_width' => '260',
            'footer_description' => 'Vedic astrology mentorship & readings.',
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
        ]);

        $response->assertRedirect();
        $this->assertEquals('8392059201', SiteSetting::get('footer_contact_phone'));

        $publicResponse = $this->get(route('home'));
        $publicResponse->assertOk();
        $publicResponse->assertSee('tel:8392059201');
        $publicResponse->assertSee('mailto:ganesha4astro@gmail.com');
        $publicResponse->assertSee('8392059201');
    }

    /** @test */
    public function legal_pages_exist_and_render_publicly()
    {
        $privacyResponse = $this->get(route('privacy.policy'));
        $privacyResponse->assertOk();
        $privacyResponse->assertSee('Privacy Policy');

        $termsResponse = $this->get(route('terms.conditions'));
        $termsResponse->assertOk();
        $termsResponse->assertSee('Terms & Conditions');

        $refundResponse = $this->get(route('refund.policy'));
        $refundResponse->assertOk();
        $refundResponse->assertSee('Refund Policy');
    }

    /** @test */
    public function admin_can_edit_legal_pages_and_disabled_page_link_disappears()
    {
        $page = CmsPage::where('slug', 'refund-policy')->first();

        $response = $this->actingAs($this->admin)->put(route('admin.settings.footer.legal.update', $page), [
            'title' => 'Updated Refund Policy Title',
            'content' => '<p>Updated refund terms and conditions.</p>',
            'status' => 'draft',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('cms_pages', [
            'id' => $page->id,
            'title' => 'Updated Refund Policy Title',
            'status' => 'draft',
        ]);

        // When draft/disabled, link disappears from footer
        $homeResponse = $this->get(route('home'));
        $homeResponse->assertOk();
        $homeResponse->assertDontSee('Updated Refund Policy Title');
    }

    /** @test */
    public function unauthorized_users_cannot_edit_footer()
    {
        auth()->logout();

        $response = $this->post(route('admin.settings.footer.update-general'), [
            'footer_contact_phone' => '0000000000',
        ]);

        $response->assertRedirect(route('admin.login'));
    }
}
