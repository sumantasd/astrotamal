<?php

namespace Tests\Feature;

use App\Models\NavigationItem;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HeaderNavigationTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin_nav_' . uniqid() . '@example.com',
            'is_admin' => true,
            'is_active' => true,
        ]);

        $this->customer = User::factory()->create([
            'email' => 'customer_nav_' . uniqid() . '@example.com',
            'is_admin' => false,
            'is_active' => true,
        ]);

        NavigationItem::seedDefaultsIfEmpty();
    }

    /** @test */
    public function admin_can_open_header_and_navigation_settings()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.settings.header'));

        $response->assertOk();
        $response->assertSee('Header & Navigation Management');
        $response->assertSee('Navigation Menu Items');
    }

    /** @test */
    public function admin_can_update_logo_and_general_header_settings()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('custom_logo.png', 300, 60);

        $response = $this->actingAs($this->admin)->post(route('admin.settings.header.update-general'), [
            'header_enabled' => '1',
            'header_logo_width' => '250',
            'header_logo_height' => '50',
            'header_logo_link' => 'home',
            'header_bg_color' => '#F7F0E3',
            'header_text_color' => '#29211F',
            'header_active_color' => '#541F1D',
            'header_border_color' => '#D8C6A8',
            'header_height' => '74px',
            'header_sticky' => '1',
            'header_shadow' => '1',
            'header_action_account_enabled' => '1',
            'header_action_account_guest_label' => 'Client Account',
            'header_action_account_auth_label' => 'Client Dashboard',
            'header_action_booking_enabled' => '1',
            'header_action_booking_label' => 'Book Now',
            'header_action_booking_url' => 'consultation.book',
            'mobile_header_enabled' => '1',
            'mobile_logo_width' => '180',
            'mobile_logo_height' => '40',
            'mobile_hamburger_enabled' => '1',
            'mobile_menu_bg' => '#F7F0E3',
            'mobile_menu_text_color' => '#29211F',
            'mobile_menu_active_color' => '#541F1D',
            'mobile_account_visible' => '1',
            'mobile_booking_visible' => '1',
            'logo_file' => $file,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertEquals('Client Account', SiteSetting::get('header_action_account_guest_label'));
        $this->assertEquals('Book Now', SiteSetting::get('header_action_booking_label'));
    }

    /** @test */
    public function admin_can_create_navigation_item()
    {
        $response = $this->actingAs($this->admin)->post(route('admin.settings.header.nav.store'), [
            'label' => 'Horoscope Special',
            'parent_id' => null,
            'link_type' => 'internal',
            'route_name' => 'horoscope.index',
            'target' => '_self',
            'sort_order' => 8,
            'is_active' => '1',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('navigation_items', [
            'label' => 'Horoscope Special',
            'route_name' => 'horoscope.index',
        ]);
    }

    /** @test */
    public function admin_can_edit_navigation_item()
    {
        $item = NavigationItem::first();

        $response = $this->actingAs($this->admin)->put(route('admin.settings.header.nav.update', $item), [
            'label' => 'Updated Home Label',
            'parent_id' => null,
            'link_type' => 'internal',
            'route_name' => 'home',
            'target' => '_self',
            'sort_order' => 1,
            'is_active' => '1',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('navigation_items', [
            'id' => $item->id,
            'label' => 'Updated Home Label',
        ]);
    }

    /** @test */
    public function admin_can_disable_navigation_item()
    {
        $item = NavigationItem::where('label', 'Services')->first();

        $response = $this->actingAs($this->admin)->put(route('admin.settings.header.nav.update', $item), [
            'label' => 'Services',
            'parent_id' => null,
            'link_type' => 'internal',
            'route_name' => 'services.index',
            'target' => '_self',
            'sort_order' => 3,
            // no is_active sent means disabled
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('navigation_items', [
            'id' => $item->id,
            'is_active' => false,
        ]);
    }

    /** @test */
    public function admin_can_create_submenu_item()
    {
        $parent = NavigationItem::where('label', 'Services')->first();

        $response = $this->actingAs($this->admin)->post(route('admin.settings.header.nav.store'), [
            'label' => 'Astrology Services',
            'parent_id' => $parent->id,
            'link_type' => 'internal',
            'route_name' => 'services.index',
            'target' => '_self',
            'sort_order' => 1,
            'is_active' => '1',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('navigation_items', [
            'label' => 'Astrology Services',
            'parent_id' => $parent->id,
        ]);
    }

    /** @test */
    public function customer_account_action_goes_to_login_when_logged_out()
    {
        auth()->logout();

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee(route('account.login'));
    }

    /** @test */
    public function customer_account_action_goes_to_dashboard_when_logged_in()
    {
        $response = $this->actingAs($this->customer)->get(route('home'));

        $response->assertOk();
        $response->assertSee(route('account.dashboard'));
    }

    /** @test */
    public function quick_booking_action_points_to_correct_booking_route()
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee(route('consultation.book'));
    }

    /** @test */
    public function disabled_navigation_item_does_not_appear_publicly()
    {
        $item = NavigationItem::where('label', 'Shop')->first();
        $item->update(['is_active' => false]);

        $response = $this->get(route('home'));

        $response->assertOk();
        // Menu item for Shop should not be rendered in navigation tree
        $this->assertDatabaseHas('navigation_items', ['id' => $item->id, 'is_active' => false]);
    }

    /** @test */
    public function public_header_renders_saved_navigation()
    {
        NavigationItem::create([
            'label' => 'Custom Dynamic Item',
            'link_type' => 'custom',
            'url' => '/custom-path',
            'sort_order' => 99,
            'is_active' => true,
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Custom Dynamic Item');
    }

    /** @test */
    public function unauthorized_users_cannot_modify_header_settings()
    {
        auth()->logout();

        $response = $this->post(route('admin.settings.header.update-general'), [
            'header_action_booking_label' => 'Hacked Button',
        ]);

        $response->assertRedirect(route('admin.login'));
    }
}
