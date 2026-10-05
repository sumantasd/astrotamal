<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutGuidanceItem;
use App\Models\CmsPage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    /**
     * Seed default guidance items if none exist.
     */
    private function seedDefaultGuidanceItemsIfNeeded(): void
    {
        if (AboutGuidanceItem::count() === 0) {
            $defaultItems = [
                [
                    'item_number' => '01',
                    'title' => 'Birth Chart Analysis',
                    'description' => 'A detailed examination of foundational planetary placements, Lagna, and Chandra Rashi.',
                    'display_order' => 1,
                    'is_active' => true,
                ],
                [
                    'item_number' => '02',
                    'title' => 'Transit & Timing',
                    'description' => 'Understanding planetary transits and changing periods to explore phases of time.',
                    'display_order' => 2,
                    'is_active' => true,
                ],
                [
                    'item_number' => '03',
                    'title' => 'Career & Job Guidance',
                    'description' => 'Astrological perspectives on career direction and professional timing considerations.',
                    'display_order' => 3,
                    'is_active' => true,
                ],
                [
                    'item_number' => '04',
                    'title' => 'Business Guidance',
                    'description' => 'Exploring commercial opportunities and strategic timing through chart analysis.',
                    'display_order' => 4,
                    'is_active' => true,
                ],
                [
                    'item_number' => '05',
                    'title' => 'Life Direction',
                    'description' => 'Gaining clarity on key life phases and decision-making through chart and time interplay.',
                    'display_order' => 5,
                    'is_active' => true,
                ],
                [
                    'item_number' => '06',
                    'title' => 'Astrology Learning',
                    'description' => 'Exploration into classical Vedic astrology fundamentals, signs, and planetary logic.',
                    'display_order' => 6,
                    'is_active' => true,
                ],
            ];

            foreach ($defaultItems as $item) {
                AboutGuidanceItem::create($item);
            }
        }
    }

    public function edit()
    {
        $this->seedDefaultGuidanceItemsIfNeeded();

        $page = CmsPage::firstOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Page',
                'seo_title' => 'About Tamal Chakraborty | Astrologer & Vedic Astrology',
                'meta_description' => "Learn about Astrologer Tamal Chakraborty's approach to astrology, birth chart analysis, planetary timing, astrology education and personalised guidance.",
                'status' => 'published',
            ]
        );

        $guidanceItems = AboutGuidanceItem::orderBy('display_order')->get();

        return view('admin.about.edit', compact('page', 'guidanceItems'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            // Section toggles
            'section_about_hero_active' => 'nullable|boolean',
            'section_about_approach_active' => 'nullable|boolean',
            'section_about_philosophy_active' => 'nullable|boolean',
            'section_about_guidance_active' => 'nullable|boolean',
            'section_about_methodology_active' => 'nullable|boolean',

            // Hero
            'about_hero_eyebrow' => 'nullable|string|max:255',
            'about_hero_title' => 'nullable|string|max:255',
            'about_hero_title_highlight' => 'nullable|string|max:255',
            'about_hero_description' => 'nullable|string|max:1000',
            'about_hero_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',

            // Approach & Bio
            'about_approach_eyebrow' => 'nullable|string|max:255',
            'about_approach_heading' => 'nullable|string|max:255',
            'about_approach_paragraph1' => 'nullable|string|max:2000',
            'about_approach_paragraph2' => 'nullable|string|max:2000',
            'about_approach_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',

            // Philosophy
            'about_philosophy_eyebrow' => 'nullable|string|max:255',
            'about_philosophy_quote' => 'nullable|string|max:1000',
            'about_philosophy_quote_highlight' => 'nullable|string|max:255',
            'about_philosophy_description' => 'nullable|string|max:1000',

            // Core Guidance Header
            'about_guidance_eyebrow' => 'nullable|string|max:255',
            'about_guidance_heading' => 'nullable|string|max:255',

            // Methodology / Language of Astrology
            'about_methodology_eyebrow' => 'nullable|string|max:255',
            'about_methodology_heading' => 'nullable|string|max:255',
            'about_methodology_paragraph1' => 'nullable|string|max:2000',
            'about_methodology_paragraph2' => 'nullable|string|max:2000',
            'about_methodology_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',

            // SEO
            'seo_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Save toggles
        SiteSetting::set('section_about_hero_active', $request->has('section_about_hero_active') ? '1' : '0', 'about');
        SiteSetting::set('section_about_approach_active', $request->has('section_about_approach_active') ? '1' : '0', 'about');
        SiteSetting::set('section_about_philosophy_active', $request->has('section_about_philosophy_active') ? '1' : '0', 'about');
        SiteSetting::set('section_about_guidance_active', $request->has('section_about_guidance_active') ? '1' : '0', 'about');
        SiteSetting::set('section_about_methodology_active', $request->has('section_about_methodology_active') ? '1' : '0', 'about');

        // Text settings
        $textFields = [
            'about_hero_eyebrow',
            'about_hero_title',
            'about_hero_title_highlight',
            'about_hero_description',
            'about_approach_eyebrow',
            'about_approach_heading',
            'about_approach_paragraph1',
            'about_approach_paragraph2',
            'about_philosophy_eyebrow',
            'about_philosophy_quote',
            'about_philosophy_quote_highlight',
            'about_philosophy_description',
            'about_guidance_eyebrow',
            'about_guidance_heading',
            'about_methodology_eyebrow',
            'about_methodology_heading',
            'about_methodology_paragraph1',
            'about_methodology_paragraph2',
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                SiteSetting::set($field, $request->input($field), 'about');
            }
        }

        // Image uploads
        if ($request->hasFile('about_hero_image_file')) {
            $path = $request->file('about_hero_image_file')->store('uploads/about', 'public');
            SiteSetting::set('about_hero_image', 'storage/' . $path, 'about');
        }

        if ($request->hasFile('about_approach_image_file')) {
            $path = $request->file('about_approach_image_file')->store('uploads/about', 'public');
            SiteSetting::set('about_approach_image', 'storage/' . $path, 'about');
        }

        if ($request->hasFile('about_methodology_image_file')) {
            $path = $request->file('about_methodology_image_file')->store('uploads/about', 'public');
            SiteSetting::set('about_methodology_image', 'storage/' . $path, 'about');
        }

        // Save SEO Metadata in CmsPage
        $page = CmsPage::firstOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Page',
                'seo_title' => 'About Tamal Chakraborty | Astrologer & Vedic Astrology',
                'meta_description' => "Learn about Astrologer Tamal Chakraborty's approach to astrology, birth chart analysis, planetary timing, astrology education and personalised guidance.",
                'status' => 'published',
            ]
        );

        if ($request->filled('seo_title') || $request->filled('meta_description')) {
            $page->update([
                'seo_title' => $request->input('seo_title', $page->seo_title),
                'meta_description' => $request->input('meta_description', $page->meta_description),
            ]);
        }

        return redirect()->back()->with('status', 'About Page settings updated successfully.');
    }

    public function storeGuidanceItem(Request $request)
    {
        $validated = $request->validate([
            'item_number' => 'required|string|max:20',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        AboutGuidanceItem::create([
            'item_number' => $validated['item_number'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'display_order' => $validated['display_order'] ?? ((int)AboutGuidanceItem::max('display_order') + 1),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->back()->with('status', 'Guidance item created successfully.');
    }

    public function updateGuidanceItem(Request $request, AboutGuidanceItem $item)
    {
        $validated = $request->validate([
            'item_number' => 'required|string|max:20',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $item->update([
            'item_number' => $validated['item_number'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'display_order' => $validated['display_order'] ?? $item->display_order,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->back()->with('status', 'Guidance item updated successfully.');
    }

    public function destroyGuidanceItem(AboutGuidanceItem $item)
    {
        $item->delete();
        return redirect()->back()->with('status', 'Guidance item deleted successfully.');
    }
}
