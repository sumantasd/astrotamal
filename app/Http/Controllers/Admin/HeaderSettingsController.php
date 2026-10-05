<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class HeaderSettingsController extends Controller
{
    /**
     * Public route list available for internal navigation link selection.
     */
    public static function getAvailableRoutes(): array
    {
        return [
            'home' => 'Home Page (/)',
            'about' => 'About Page (/about)',
            'services.index' => 'Services Index (/services)',
            'shop' => 'Shop Page (/shop)',
            'gallery' => 'Gallery Page (/gallery)',
            'videos' => 'Videos Page (/videos)',
            'contact' => 'Contact Page (/contact)',
            'consultation.book' => 'Quick Consultation Booking (/book-consultation)',
            'kundli' => 'Kundli Page (/kundli)',
            'horoscope.index' => 'Horoscope Index (/horoscope)',
            'blog.index' => 'Blog Index (/blog)',
            'testimonials.index' => 'Testimonials (/testimonials)',
            'account.login' => 'Customer Login (/account/login)',
            'account.dashboard' => 'Customer Dashboard (/account)',
        ];
    }

    /**
     * Display the header & navigation management page.
     */
    public function index()
    {
        NavigationItem::seedDefaultsIfEmpty();

        $navItems = NavigationItem::with('children')->orderBy('sort_order')->get();
        $parentCandidates = NavigationItem::whereNull('parent_id')->orderBy('sort_order')->get();
        $availableRoutes = static::getAvailableRoutes();

        // General Header Settings
        $settings = [
            'header_enabled' => SiteSetting::get('header_enabled', '1'),
            'header_logo' => SiteSetting::get('header_logo', 'images/astrotamal-logo.png'),
            'header_logo_width' => SiteSetting::get('header_logo_width', '240'),
            'header_logo_height' => SiteSetting::get('header_logo_height', '48'),
            'header_logo_link' => SiteSetting::get('header_logo_link', 'home'),
            'header_bg_color' => SiteSetting::get('header_bg_color', '#F7F0E3'),
            'header_text_color' => SiteSetting::get('header_text_color', '#29211F'),
            'header_active_color' => SiteSetting::get('header_active_color', '#541F1D'),
            'header_border_color' => SiteSetting::get('header_border_color', '#D8C6A8'),
            'header_height' => SiteSetting::get('header_height', '74px'),
            'header_sticky' => SiteSetting::get('header_sticky', '1'),
            'header_shadow' => SiteSetting::get('header_shadow', '1'),

            // Right Side Actions
            'header_action_account_enabled' => SiteSetting::get('header_action_account_enabled', '1'),
            'header_action_account_guest_label' => SiteSetting::get('header_action_account_guest_label', 'Account'),
            'header_action_account_auth_label' => SiteSetting::get('header_action_account_auth_label', 'Dashboard'),
            'header_action_booking_enabled' => SiteSetting::get('header_action_booking_enabled', '1'),
            'header_action_booking_label' => SiteSetting::get('header_action_booking_label', 'Quick Booking'),
            'header_action_booking_url' => SiteSetting::get('header_action_booking_url', 'consultation.book'),

            // Mobile Header
            'mobile_header_enabled' => SiteSetting::get('mobile_header_enabled', '1'),
            'mobile_logo_width' => SiteSetting::get('mobile_logo_width', '170'),
            'mobile_logo_height' => SiteSetting::get('mobile_logo_height', '36'),
            'mobile_hamburger_enabled' => SiteSetting::get('mobile_hamburger_enabled', '1'),
            'mobile_menu_bg' => SiteSetting::get('mobile_menu_bg', '#F7F0E3'),
            'mobile_menu_text_color' => SiteSetting::get('mobile_menu_text_color', '#29211F'),
            'mobile_menu_active_color' => SiteSetting::get('mobile_menu_active_color', '#541F1D'),
            'mobile_account_visible' => SiteSetting::get('mobile_account_visible', '1'),
            'mobile_booking_visible' => SiteSetting::get('mobile_booking_visible', '1'),
        ];

        return view('admin.settings.header', compact('navItems', 'parentCandidates', 'availableRoutes', 'settings'));
    }

    /**
     * Update general, action & mobile header settings.
     */
    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'header_enabled' => ['nullable', 'string'],
            'header_logo_width' => ['required', 'string', 'max:10'],
            'header_logo_height' => ['required', 'string', 'max:10'],
            'header_logo_link' => ['nullable', 'string', 'max:255'],
            'header_bg_color' => ['required', 'string', 'max:20'],
            'header_text_color' => ['required', 'string', 'max:20'],
            'header_active_color' => ['required', 'string', 'max:20'],
            'header_border_color' => ['required', 'string', 'max:20'],
            'header_height' => ['required', 'string', 'max:20'],
            'header_sticky' => ['nullable', 'string'],
            'header_shadow' => ['nullable', 'string'],

            'header_action_account_enabled' => ['nullable', 'string'],
            'header_action_account_guest_label' => ['required', 'string', 'max:50'],
            'header_action_account_auth_label' => ['required', 'string', 'max:50'],
            'header_action_booking_enabled' => ['nullable', 'string'],
            'header_action_booking_label' => ['required', 'string', 'max:50'],
            'header_action_booking_url' => ['required', 'string', 'max:255'],

            'mobile_header_enabled' => ['nullable', 'string'],
            'mobile_logo_width' => ['required', 'string', 'max:10'],
            'mobile_logo_height' => ['required', 'string', 'max:10'],
            'mobile_hamburger_enabled' => ['nullable', 'string'],
            'mobile_menu_bg' => ['required', 'string', 'max:20'],
            'mobile_menu_text_color' => ['required', 'string', 'max:20'],
            'mobile_menu_active_color' => ['required', 'string', 'max:20'],
            'mobile_account_visible' => ['nullable', 'string'],
            'mobile_booking_visible' => ['nullable', 'string'],

            'logo_file' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp,svg', 'max:2048'],
        ]);

        // Handle logo file upload safely
        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            SiteSetting::set('header_logo', 'images/' . $filename, 'header');
        }

        $checkboxes = [
            'header_enabled',
            'header_sticky',
            'header_shadow',
            'header_action_account_enabled',
            'header_action_booking_enabled',
            'mobile_header_enabled',
            'mobile_hamburger_enabled',
            'mobile_account_visible',
            'mobile_booking_visible',
        ];

        foreach ($validated as $key => $val) {
            if ($key === 'logo_file') {
                continue;
            }
            SiteSetting::set($key, (string) $val, 'header');
        }

        foreach ($checkboxes as $cbKey) {
            SiteSetting::set($cbKey, $request->has($cbKey) ? '1' : '0', 'header');
        }

        return redirect()->back()->with('status', 'Header & Navigation configuration updated successfully.');
    }

    /**
     * Store a new navigation item.
     */
    public function storeNavItem(Request $request)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:100'],
            'parent_id' => ['nullable', 'exists:navigation_items,id'],
            'link_type' => ['required', 'in:internal,custom,external,none'],
            'route_name' => ['nullable', 'string', 'max:100'],
            'url' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:50'],
            'target' => ['required', 'in:_self,_blank'],
            'sort_order' => ['required', 'integer'],
            'is_active' => ['nullable'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        NavigationItem::create($validated);

        return redirect()->back()->with('status', 'Navigation menu item created successfully.');
    }

    /**
     * Update an existing navigation item.
     */
    public function updateNavItem(Request $request, NavigationItem $navigationItem)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:100'],
            'parent_id' => ['nullable', 'exists:navigation_items,id'],
            'link_type' => ['required', 'in:internal,custom,external,none'],
            'route_name' => ['nullable', 'string', 'max:100'],
            'url' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:50'],
            'target' => ['required', 'in:_self,_blank'],
            'sort_order' => ['required', 'integer'],
            'is_active' => ['nullable'],
        ]);

        // Prevent self-referencing parent
        if ($validated['parent_id'] == $navigationItem->id) {
            $validated['parent_id'] = null;
        }

        $validated['is_active'] = $request->has('is_active');
        $navigationItem->update($validated);

        return redirect()->back()->with('status', "Navigation menu item '{$navigationItem->label}' updated successfully.");
    }

    /**
     * Delete a navigation item.
     */
    public function destroyNavItem(NavigationItem $navigationItem)
    {
        $label = $navigationItem->label;
        $navigationItem->delete();

        return redirect()->back()->with('status', "Navigation menu item '{$label}' deleted successfully.");
    }

    /**
     * Reset Header & Navigation to default state.
     */
    public function resetToDefault()
    {
        // 1. Clear & Seed Navigation Items
        NavigationItem::query()->delete();
        NavigationItem::seedDefaultsIfEmpty();

        // 2. Reset General & Mobile Settings
        $defaults = [
            'header_enabled' => '1',
            'header_logo' => 'images/astrotamal-logo.png',
            'header_logo_width' => '240',
            'header_logo_height' => '48',
            'header_logo_link' => 'home',
            'header_bg_color' => '#F7F0E3',
            'header_text_color' => '#29211F',
            'header_active_color' => '#541F1D',
            'header_border_color' => '#D8C6A8',
            'header_height' => '74px',
            'header_sticky' => '1',
            'header_shadow' => '1',

            'header_action_account_enabled' => '1',
            'header_action_account_guest_label' => 'Account',
            'header_action_account_auth_label' => 'Dashboard',
            'header_action_booking_enabled' => '1',
            'header_action_booking_label' => 'Quick Booking',
            'header_action_booking_url' => 'consultation.book',

            'mobile_header_enabled' => '1',
            'mobile_logo_width' => '170',
            'mobile_logo_height' => '36',
            'mobile_hamburger_enabled' => '1',
            'mobile_menu_bg' => '#F7F0E3',
            'mobile_menu_text_color' => '#29211F',
            'mobile_menu_active_color' => '#541F1D',
            'mobile_account_visible' => '1',
            'mobile_booking_visible' => '1',
        ];

        foreach ($defaults as $key => $val) {
            SiteSetting::set($key, $val, 'header');
        }

        return redirect()->back()->with('status', 'Header & Navigation reset to default settings successfully.');
    }
}
