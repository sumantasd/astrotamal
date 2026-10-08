<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ServicesPageController extends Controller
{
    public function edit()
    {
        $page = CmsPage::firstOrCreate(
            ['slug' => 'services'],
            [
                'title' => 'Services Page',
                'seo_title' => 'Astrology & Vastu Services | Ganesha Astro Consultancy',
                'meta_description' => 'Explore professional astrology services including Birth Chart Analysis, Kundli matching, Career Guidance, and Vastu Consultancy.',
                'status' => 'published',
            ]
        );

        return view('admin.services-page.edit', compact('page'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            // Section Visibility Toggles
            'section_services_hero_active' => 'nullable|boolean',
            'section_services_intro_header_active' => 'nullable|boolean',
            'section_services_quick_booking_active' => 'nullable|boolean',
            'services_urgent_active' => 'nullable|boolean',
            'services_normal_active' => 'nullable|boolean',
            'services_phone_active' => 'nullable|boolean',
            'services_kundli_active' => 'nullable|boolean',
            'services_remedy_active' => 'nullable|boolean',
            'section_services_editorial_active' => 'nullable|boolean',
            'section_services_catalogue_active' => 'nullable|boolean',
            'section_services_featured_active' => 'nullable|boolean',
            'section_services_exploration_active' => 'nullable|boolean',
            'section_services_process_active' => 'nullable|boolean',
            'section_services_faq_active' => 'nullable|boolean',

            // Services Hero
            'services_hero_eyebrow' => 'nullable|string|max:255',
            'services_hero_heading' => 'nullable|string|max:255',
            'services_hero_description' => 'nullable|string|max:1000',

            // Services Intro
            'services_intro_eyebrow' => 'nullable|string|max:255',
            'services_intro_heading' => 'nullable|string|max:255',
            'services_intro_description' => 'nullable|string|max:1000',

            // Quick Booking
            'services_qb_heading' => 'nullable|string|max:255',
            'services_urgent_title' => 'nullable|string|max:255',
            'services_urgent_subtitle' => 'nullable|string|max:255',
            'services_urgent_price' => 'nullable|string|max:255',
            'services_urgent_icon' => 'nullable|string|max:50',

            'services_normal_title' => 'nullable|string|max:255',
            'services_normal_subtitle' => 'nullable|string|max:255',
            'services_normal_price' => 'nullable|string|max:255',
            'services_normal_icon' => 'nullable|string|max:50',

            // Phone Consultation Card
            'services_phone_heading' => 'nullable|string|max:255',
            'services_phone_subtitle' => 'nullable|string|max:255',
            'services_phone_btn_text' => 'nullable|string|max:255',
            'services_phone_btn_url' => 'nullable|string|max:500',
            'services_phone_icon' => 'nullable|string|max:50',

            // Kundli Card
            'services_kundli_heading' => 'nullable|string|max:255',
            'services_kundli_description' => 'nullable|string|max:1000',
            'services_kundli_icon' => 'nullable|string|max:50',

            // Remedy Card
            'services_remedy_heading' => 'nullable|string|max:255',
            'services_remedy_description' => 'nullable|string|max:1000',
            'services_remedy_icon' => 'nullable|string|max:50',

            // Editorial Intro
            'services_editorial_eyebrow' => 'nullable|string|max:255',
            'services_editorial_heading' => 'nullable|string|max:255',
            'services_editorial_description' => 'nullable|string|max:1000',

            // Services Catalogue
            'services_catalogue_eyebrow' => 'nullable|string|max:255',
            'services_catalogue_heading' => 'nullable|string|max:255',

            // Featured Service
            'services_featured_eyebrow' => 'nullable|string|max:255',
            'services_featured_heading' => 'nullable|string|max:255',
            'services_featured_description' => 'nullable|string|max:1000',

            // Areas of Exploration
            'services_exploration_eyebrow' => 'nullable|string|max:255',
            'services_exploration_heading' => 'nullable|string|max:255',
            'services_exploration_subtitle' => 'nullable|string|max:1000',

            // Consultation Process
            'services_process_eyebrow' => 'nullable|string|max:255',
            'services_process_heading' => 'nullable|string|max:255',

            // FAQ
            'services_faq_eyebrow' => 'nullable|string|max:255',
            'services_faq_heading' => 'nullable|string|max:255',
            'services_faq_subtitle' => 'nullable|string|max:1000',

            // SEO
            'seo_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Save active toggles
        $toggles = [
            'section_services_hero_active',
            'section_services_intro_header_active',
            'section_services_quick_booking_active',
            'services_urgent_active',
            'services_normal_active',
            'services_phone_active',
            'services_kundli_active',
            'services_remedy_active',
            'section_services_editorial_active',
            'section_services_catalogue_active',
            'section_services_featured_active',
            'section_services_exploration_active',
            'section_services_process_active',
            'section_services_faq_active',
        ];

        foreach ($toggles as $toggle) {
            if ($request->has($toggle)) {
                SiteSetting::set($toggle, $request->input($toggle) == '1' ? '1' : '0', 'services');
            }
        }

        // Save text settings
        $textFields = [
            'services_hero_eyebrow',
            'services_hero_heading',
            'services_hero_description',
            'services_intro_eyebrow',
            'services_intro_heading',
            'services_intro_description',
            'services_qb_heading',
            'services_urgent_title',
            'services_urgent_subtitle',
            'services_urgent_price',
            'services_urgent_icon',
            'services_normal_title',
            'services_normal_subtitle',
            'services_normal_price',
            'services_normal_icon',
            'services_phone_heading',
            'services_phone_subtitle',
            'services_phone_btn_text',
            'services_phone_btn_url',
            'services_phone_icon',
            'services_kundli_heading',
            'services_kundli_description',
            'services_kundli_icon',
            'services_remedy_heading',
            'services_remedy_description',
            'services_remedy_icon',
            'services_editorial_eyebrow',
            'services_editorial_heading',
            'services_editorial_description',
            'services_catalogue_eyebrow',
            'services_catalogue_heading',
            'services_featured_eyebrow',
            'services_featured_heading',
            'services_featured_description',
            'services_exploration_eyebrow',
            'services_exploration_heading',
            'services_exploration_subtitle',
            'services_process_eyebrow',
            'services_process_heading',
            'services_faq_eyebrow',
            'services_faq_heading',
            'services_faq_subtitle',
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                SiteSetting::set($field, $request->input($field), 'services');
            }
        }

        // Save SEO Metadata in CmsPage
        $page = CmsPage::firstOrCreate(
            ['slug' => 'services'],
            [
                'title' => 'Services Page',
                'seo_title' => 'Astrology & Vastu Services | Ganesha Astro Consultancy',
                'meta_description' => 'Explore professional astrology services including Birth Chart Analysis, Kundli matching, Career Guidance, and Vastu Consultancy.',
                'status' => 'published',
            ]
        );

        if ($request->filled('seo_title') || $request->filled('meta_description')) {
            $page->update([
                'seo_title' => $request->input('seo_title', $page->seo_title),
                'meta_description' => $request->input('meta_description', $page->meta_description),
            ]);
        }

        return redirect()->back()->with('status', 'Services Page section order, visibility & content updated successfully.');
    }
}
