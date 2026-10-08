<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LegalPageController;
use App\Models\CmsPage;
use App\Models\FooterGuidanceItem;
use App\Models\FooterNavItem;
use App\Models\FooterSocialLink;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FooterSettingsController extends Controller
{
    /**
     * Display the Footer Manager index page.
     */
    public function index()
    {
        FooterNavItem::seedDefaultsIfEmpty();
        FooterGuidanceItem::seedDefaultsIfEmpty();
        FooterSocialLink::seedDefaultsIfEmpty();
        LegalPageController::seedLegalPagesIfMissing();

        $navItems = FooterNavItem::orderBy('sort_order')->get();
        $guidanceItems = FooterGuidanceItem::orderBy('sort_order')->get();
        $socialLinks = FooterSocialLink::orderBy('sort_order')->get();

        $legalPages = CmsPage::whereIn('slug', ['privacy-policy', 'terms-and-conditions', 'refund-policy'])->get();

        $availableRoutes = HeaderSettingsController::getAvailableRoutes();

        // Footer Settings Values
        $settings = [
            'footer_enabled' => SiteSetting::get('footer_enabled', '1'),
            'footer_logo' => SiteSetting::get('footer_logo', 'images/astrotamal-logo.png'),
            'footer_logo_width' => SiteSetting::get('footer_logo_width', '260'),
            'footer_logo_visible' => SiteSetting::get('footer_logo_visible', '1'),
            'footer_description' => SiteSetting::get('footer_description', "Empowering individuals globally with ancient Vedic wisdom, accurate birth chart readings, and practical spiritual remedies for life's challenges."),

            // Column Titles & Visibility
            'footer_col1_enabled' => SiteSetting::get('footer_col1_enabled', '1'),
            'footer_col2_title' => SiteSetting::get('footer_col2_title', 'Quick Navigation'),
            'footer_col2_enabled' => SiteSetting::get('footer_col2_enabled', '1'),
            'footer_col3_title' => SiteSetting::get('footer_col3_title', 'Our Guidance'),
            'footer_col3_enabled' => SiteSetting::get('footer_col3_enabled', '1'),
            'footer_col4_title' => SiteSetting::get('footer_col4_title', 'Consultation Office'),
            'footer_col4_enabled' => SiteSetting::get('footer_col4_enabled', '1'),

            // Contact Details
            'footer_contact_brand' => SiteSetting::get('footer_contact_brand', 'Ganesha Astro Consultancy'),
            'footer_contact_phone' => SiteSetting::get('footer_contact_phone', '8392059201'),
            'footer_contact_whatsapp' => SiteSetting::get('footer_contact_whatsapp', '8392059201'),
            'footer_contact_email' => SiteSetting::get('footer_contact_email', 'ganesha4astro@gmail.com'),
            'footer_contact_address' => SiteSetting::get('footer_contact_address', 'Kolkata | Bongaon | Ranaghat & More'),
            'footer_contact_website' => SiteSetting::get('footer_contact_website', 'astrotamal.com'),
            'footer_contact_map_url' => SiteSetting::get('footer_contact_map_url', ''),

            // Copyright
            'footer_copyright_text' => SiteSetting::get('footer_copyright_text', '© {current_year} Ganesha Astro Consultancy. All Rights Reserved.'),
            'footer_copyright_enabled' => SiteSetting::get('footer_copyright_enabled', '1'),
        ];

        return view('admin.settings.footer', compact('navItems', 'guidanceItems', 'socialLinks', 'legalPages', 'availableRoutes', 'settings'));
    }

    /**
     * Update General Footer, Contact & Column Settings.
     */
    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'footer_logo_width' => ['required', 'string', 'max:10'],
            'footer_description' => ['required', 'string', 'max:1000'],
            'footer_col2_title' => ['required', 'string', 'max:100'],
            'footer_col3_title' => ['required', 'string', 'max:100'],
            'footer_col4_title' => ['required', 'string', 'max:100'],

            'footer_contact_brand' => ['required', 'string', 'max:100'],
            'footer_contact_phone' => ['required', 'string', 'max:50'],
            'footer_contact_whatsapp' => ['required', 'string', 'max:50'],
            'footer_contact_email' => ['required', 'email', 'max:100'],
            'footer_contact_address' => ['required', 'string', 'max:255'],
            'footer_contact_website' => ['required', 'string', 'max:100'],
            'footer_contact_map_url' => ['nullable', 'string', 'max:500'],

            'footer_copyright_text' => ['required', 'string', 'max:255'],

            'logo_file' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp,svg', 'max:2048'],
        ]);

        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $filename = 'footer_logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            SiteSetting::set('footer_logo', 'images/' . $filename, 'footer');
        }

        $checkboxes = [
            'footer_enabled',
            'footer_logo_visible',
            'footer_col1_enabled',
            'footer_col2_enabled',
            'footer_col3_enabled',
            'footer_col4_enabled',
            'footer_copyright_enabled',
        ];

        foreach ($validated as $key => $val) {
            if ($key === 'logo_file') {
                continue;
            }
            SiteSetting::set($key, (string) $val, 'footer');
        }

        foreach ($checkboxes as $cbKey) {
            if ($request->has($cbKey)) {
                SiteSetting::set($cbKey, $request->input($cbKey) == '1' ? '1' : '0', 'footer');
            }
        }

        return redirect()->back()->with('status', 'Footer settings and contact details updated successfully.');
    }

    /**
     * Store Quick Navigation item.
     */
    public function storeNavItem(Request $request)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:100'],
            'link_type' => ['required', 'in:internal,custom,external'],
            'route_name' => ['nullable', 'string', 'max:100'],
            'url' => ['nullable', 'string', 'max:255'],
            'target' => ['required', 'in:_self,_blank'],
            'sort_order' => ['required', 'integer'],
            'is_active' => ['nullable'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        FooterNavItem::create($validated);

        return redirect()->back()->with('status', 'Footer Quick Navigation item created successfully.');
    }

    /**
     * Update Quick Navigation item.
     */
    public function updateNavItem(Request $request, FooterNavItem $item)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:100'],
            'link_type' => ['required', 'in:internal,custom,external'],
            'route_name' => ['nullable', 'string', 'max:100'],
            'url' => ['nullable', 'string', 'max:255'],
            'target' => ['required', 'in:_self,_blank'],
            'sort_order' => ['required', 'integer'],
            'is_active' => ['nullable'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $item->update($validated);

        return redirect()->back()->with('status', "Footer Navigation item '{$item->label}' updated successfully.");
    }

    /**
     * Delete Quick Navigation item.
     */
    public function destroyNavItem(FooterNavItem $item)
    {
        $label = $item->label;
        $item->delete();

        return redirect()->back()->with('status', "Footer Navigation item '{$label}' deleted successfully.");
    }

    /**
     * Store Guidance item.
     */
    public function storeGuidanceItem(Request $request)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:100'],
            'link_type' => ['required', 'in:internal,custom,external'],
            'route_name' => ['nullable', 'string', 'max:100'],
            'url' => ['nullable', 'string', 'max:255'],
            'target' => ['required', 'in:_self,_blank'],
            'sort_order' => ['required', 'integer'],
            'is_active' => ['nullable'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        FooterGuidanceItem::create($validated);

        return redirect()->back()->with('status', 'Footer Guidance item created successfully.');
    }

    /**
     * Update Guidance item.
     */
    public function updateGuidanceItem(Request $request, FooterGuidanceItem $item)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:100'],
            'link_type' => ['required', 'in:internal,custom,external'],
            'route_name' => ['nullable', 'string', 'max:100'],
            'url' => ['nullable', 'string', 'max:255'],
            'target' => ['required', 'in:_self,_blank'],
            'sort_order' => ['required', 'integer'],
            'is_active' => ['nullable'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $item->update($validated);

        return redirect()->back()->with('status', "Footer Guidance item '{$item->label}' updated successfully.");
    }

    /**
     * Delete Guidance item.
     */
    public function destroyGuidanceItem(FooterGuidanceItem $item)
    {
        $label = $item->label;
        $item->delete();

        return redirect()->back()->with('status', "Footer Guidance item '{$label}' deleted successfully.");
    }

    /**
     * Store Social link.
     */
    public function storeSocialLink(Request $request)
    {
        $validated = $request->validate([
            'platform' => ['required', 'string', 'max:50'],
            'url' => ['required', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['required', 'integer'],
            'is_active' => ['nullable'],
        ]);

        // Secure URL Validation
        $url = $validated['url'];
        if (preg_match('/^(javascript|data|file):/i', $url)) {
            return redirect()->back()->with('error', 'Security check failed: Prohibited URL scheme detected.');
        }

        $validated['is_active'] = $request->has('is_active');
        FooterSocialLink::create($validated);

        return redirect()->back()->with('status', 'Footer Social Link created successfully.');
    }

    /**
     * Update Social link.
     */
    public function updateSocialLink(Request $request, FooterSocialLink $socialLink)
    {
        $validated = $request->validate([
            'platform' => ['required', 'string', 'max:50'],
            'url' => ['required', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['required', 'integer'],
            'is_active' => ['nullable'],
        ]);

        $url = $validated['url'];
        if (preg_match('/^(javascript|data|file):/i', $url)) {
            return redirect()->back()->with('error', 'Security check failed: Prohibited URL scheme detected.');
        }

        $validated['is_active'] = $request->has('is_active');
        $socialLink->update($validated);

        return redirect()->back()->with('status', "Social link for '{$socialLink->platform}' updated successfully.");
    }

    /**
     * Delete Social link.
     */
    public function destroySocialLink(FooterSocialLink $socialLink)
    {
        $platform = $socialLink->platform;
        $socialLink->delete();

        return redirect()->back()->with('status', "Social link for '{$platform}' deleted successfully.");
    }

    /**
     * Update Legal Page Content & Status.
     */
    public function updateLegalPage(Request $request, CmsPage $page)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:published,draft'],
        ]);

        $page->update($validated);

        return redirect()->back()->with('status', "Legal Page '{$page->title}' updated successfully.");
    }

    /**
     * Reset Footer Manager to default values.
     */
    public function resetToDefault()
    {
        FooterNavItem::query()->delete();
        FooterNavItem::seedDefaultsIfEmpty();

        FooterGuidanceItem::query()->delete();
        FooterGuidanceItem::seedDefaultsIfEmpty();

        FooterSocialLink::query()->delete();
        FooterSocialLink::seedDefaultsIfEmpty();

        LegalPageController::seedLegalPagesIfMissing();

        $defaults = [
            'footer_enabled' => '1',
            'footer_logo' => 'images/astrotamal-logo.png',
            'footer_logo_width' => '260',
            'footer_logo_visible' => '1',
            'footer_description' => "Empowering individuals globally with ancient Vedic wisdom, accurate birth chart readings, and practical spiritual remedies for life's challenges.",
            'footer_col1_enabled' => '1',
            'footer_col2_title' => 'Quick Navigation',
            'footer_col2_enabled' => '1',
            'footer_col3_title' => 'Our Guidance',
            'footer_col3_enabled' => '1',
            'footer_col4_title' => 'Consultation Office',
            'footer_col4_enabled' => '1',
            'footer_contact_brand' => 'Ganesha Astro Consultancy',
            'footer_contact_phone' => '8392059201',
            'footer_contact_whatsapp' => '8392059201',
            'footer_contact_email' => 'ganesha4astro@gmail.com',
            'footer_contact_address' => 'Kolkata | Bongaon | Ranaghat & More',
            'footer_contact_website' => 'astrotamal.com',
            'footer_contact_map_url' => '',
            'footer_copyright_text' => '© {current_year} Ganesha Astro Consultancy. All Rights Reserved.',
            'footer_copyright_enabled' => '1',
        ];

        foreach ($defaults as $key => $val) {
            SiteSetting::set($key, $val, 'footer');
        }

        return redirect()->back()->with('status', 'Footer Manager reset to defaults successfully.');
    }
}
