<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;

class CmsPageController extends Controller
{
    private static array $defaultPages = [
        'home' => [
            'title' => 'Home Page',
            'slug' => 'home',
            'seo_title' => 'Tamal Chakraborty | Best Astrologer & Vastu Expert in Kolkata',
            'meta_description' => 'Official website of Tamal Chakraborty, leading celebrity astrologer, Kundli specialist, and Vastu consultant in Kolkata, India.',
            'content' => [
                'hero_title' => 'Align Your Life With Celestial Guidance',
                'hero_subtitle' => 'Personalized Vedic Astrology, Kundli Analysis, and Vastu Consultations by Tamal Chakraborty.',
                'cta_label' => 'Book Consultation Now',
                'cta_link' => '/book-consultation',
                'about_heading' => 'About Tamal Chakraborty',
                'about_text' => 'Over 15+ years of experience providing accurate astrological insights, horoscope reading, gemstone guidance, and spatial Vastu energy corrections.',
                'services_heading' => 'Our Core Astrological Services',
                'testimonials_heading' => 'What Our Esteemed Clients Say',
            ],
            'status' => 'published',
        ],
        'about' => [
            'title' => 'About Page',
            'slug' => 'about',
            'seo_title' => 'About Tamal Chakraborty | Astrology & Vastu Specialist',
            'meta_description' => 'Learn about Tamal Chakraborty’s astrological background, methodology, and commitment to guiding clients towards prosperity.',
            'content' => [
                'page_heading' => 'About Ganesha Astro Consultancy',
                'biography' => 'Tamal Chakraborty is a renowned Vedic Astrologer and Vastu Expert with over 15 years of dedicated practice in Kolkata, West Bengal.',
                'experience_years' => '15+',
                'happy_clients' => '10,000+',
                'approach' => 'Combining traditional Vedic principles with modern practical guidance.',
            ],
            'status' => 'published',
        ],
        'services' => [
            'title' => 'Services Page',
            'slug' => 'services',
            'seo_title' => 'Astrology & Vastu Services | Tamal Chakraborty',
            'meta_description' => 'Explore professional astrology services including Kundli matching, Career Guidance, Marriage Horoscope, and Vastu Consultancy.',
            'content' => [
                'page_heading' => 'Comprehensive Astrological Solutions',
                'subtitle' => 'Choose a tailored consultation for clarity in career, relationships, health, and prosperity.',
            ],
            'status' => 'published',
        ],
        'contact' => [
            'title' => 'Contact Page',
            'slug' => 'contact',
            'seo_title' => 'Contact Tamal Chakraborty | Book Appointment',
            'meta_description' => 'Get in touch with Ganesha Astro Consultancy for in-person or online astrological consultations.',
            'content' => [
                'page_heading' => 'Get In Touch',
                'subtitle' => 'Schedule a personal meeting or online consultation with Tamal Chakraborty.',
            ],
            'status' => 'published',
        ],
        'horoscope' => [
            'title' => 'Horoscope Page',
            'slug' => 'horoscope',
            'seo_title' => 'Daily, Weekly & Monthly Horoscope Predictions',
            'meta_description' => 'Read free accurate daily, weekly, monthly, and yearly horoscope predictions for all 12 zodiac signs.',
            'content' => [
                'page_heading' => 'Zodiac Horoscope & Forecasts',
            ],
            'status' => 'published',
        ],
        'blog' => [
            'title' => 'Blog & Insights Page',
            'slug' => 'blog',
            'seo_title' => 'Astrology Blog & Planetary Insights',
            'meta_description' => 'Read expert articles on planetary transits, Vastu tips, numerology, and astrological remedies.',
            'content' => [
                'page_heading' => 'Astrological Articles & Wisdom',
            ],
            'status' => 'published',
        ],
    ];

    public function index()
    {
        // Ensure default pages exist
        foreach (self::$defaultPages as $slug => $data) {
            CmsPage::firstOrCreate(
                ['slug' => $slug],
                [
                    'title' => $data['title'],
                    'seo_title' => $data['seo_title'],
                    'meta_description' => $data['meta_description'],
                    'content' => is_array($data['content']) ? json_encode($data['content']) : $data['content'],
                    'status' => $data['status'],
                ]
            );
        }

        $pages = CmsPage::orderBy('id')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function edit($slug)
    {
        $page = CmsPage::where('slug', $slug)->firstOrFail();
        $contentData = is_string($page->content) ? json_decode($page->content, true) : ($page->content ?? []);

        if ($slug === 'home') {
            return view('admin.pages.editors.home', compact('page', 'contentData'));
        } elseif ($slug === 'about') {
            return view('admin.pages.editors.about', compact('page', 'contentData'));
        } elseif ($slug === 'services') {
            return view('admin.pages.editors.services', compact('page', 'contentData'));
        }

        return view('admin.pages.edit', compact('page', 'contentData'));
    }

    public function update(Request $request, $slug)
    {
        $page = CmsPage::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'content_fields' => 'nullable|array',
        ]);

        $page->title = $validated['title'];
        $page->seo_title = $validated['seo_title'] ?? $page->seo_title;
        $page->meta_description = $validated['meta_description'] ?? $page->meta_description;
        $page->status = $validated['status'];

        if ($request->has('content_fields')) {
            $page->content = json_encode($request->input('content_fields'));
        }

        $page->save();

        return redirect()->route('admin.pages.index')
            ->with('status', "{$page->title} updated successfully.");
    }
}
