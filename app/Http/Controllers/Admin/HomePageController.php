<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeFeature;
use App\Models\HomeVideo;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomePageController extends Controller
{
    /**
     * Show the Home Page Management CMS Editor.
     */
    public function edit()
    {
        $videos = HomeVideo::orderBy('display_order', 'asc')->orderBy('id', 'desc')->get();
        $features = HomeFeature::orderBy('display_order', 'asc')->orderBy('id', 'desc')->get();

        return view('admin.homepage.edit', compact('videos', 'features'));
    }

    /**
     * Update General Home Page Section Settings.
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            // Section Toggles
            'section_hero_active' => 'nullable|string',
            'section_features_active' => 'nullable|string',
            'section_quick_booking_active' => 'nullable|string',
            'section_videos_active' => 'nullable|string',
            'section_pre_footer_active' => 'nullable|string',

            // Hero Section
            'homepage_hero_eyebrow' => 'nullable|string|max:255',
            'homepage_hero_heading' => 'nullable|string|max:255',
            'homepage_hero_mantra' => 'nullable|string|max:1000',
            'homepage_hero_description' => 'nullable|string|max:1000',
            'homepage_hero_primary_btn_text' => 'nullable|string|max:255',
            'homepage_hero_primary_btn_url' => 'nullable|string|max:255',
            'homepage_hero_secondary_btn_text' => 'nullable|string|max:255',
            'homepage_hero_secondary_btn_url' => 'nullable|string|max:255',
            'homepage_hero_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'homepage_hero_stat1_number' => 'nullable|string|max:50',
            'homepage_hero_stat1_label' => 'nullable|string|max:100',
            'homepage_hero_stat2_number' => 'nullable|string|max:50',
            'homepage_hero_stat2_label' => 'nullable|string|max:100',
            'homepage_hero_stat3_number' => 'nullable|string|max:50',
            'homepage_hero_stat3_label' => 'nullable|string|max:100',

            // Quick Booking Section
            'homepage_qb_eyebrow' => 'nullable|string|max:255',
            'homepage_qb_heading' => 'nullable|string|max:255',
            'homepage_qb_description' => 'nullable|string|max:1000',
            'homepage_qb_urgent_title' => 'nullable|string|max:255',
            'homepage_qb_urgent_price' => 'nullable|string|max:255',
            'homepage_qb_normal_title' => 'nullable|string|max:255',
            'homepage_qb_normal_price' => 'nullable|string|max:255',

            // Videos Header Section
            'homepage_videos_eyebrow' => 'nullable|string|max:255',
            'homepage_videos_heading' => 'nullable|string|max:255',
            'homepage_videos_btn_text' => 'nullable|string|max:255',

            // Pre-Footer Section
            'homepage_pf_eyebrow' => 'nullable|string|max:255',
            'homepage_pf_heading' => 'nullable|string|max:255',
            'homepage_pf_description' => 'nullable|string|max:1000',
            'homepage_pf_call_text' => 'nullable|string|max:255',
            'homepage_pf_whatsapp_text' => 'nullable|string|max:255',
            'homepage_pf_email_text' => 'nullable|string|max:255',
        ]);

        // Toggle defaults
        $toggles = ['section_hero_active', 'section_features_active', 'section_quick_booking_active', 'section_videos_active', 'section_pre_footer_active'];
        foreach ($toggles as $toggle) {
            if ($request->has($toggle)) {
                SiteSetting::set($toggle, $request->input($toggle) == '1' ? '1' : '0', 'homepage');
            }
        }

        // Image uploads
        if ($request->hasFile('homepage_hero_image')) {
            $path = $request->file('homepage_hero_image')->store('homepage', 'public');
            SiteSetting::set('homepage_hero_image', '/storage/' . $path, 'homepage');
        }

        // Text fields
        $fields = [
            'homepage_hero_eyebrow', 'homepage_hero_heading', 'homepage_hero_mantra', 'homepage_hero_description',
            'homepage_hero_primary_btn_text', 'homepage_hero_primary_btn_url', 'homepage_hero_secondary_btn_text', 'homepage_hero_secondary_btn_url',
            'homepage_hero_stat1_number', 'homepage_hero_stat1_label', 'homepage_hero_stat2_number', 'homepage_hero_stat2_label', 'homepage_hero_stat3_number', 'homepage_hero_stat3_label',
            'homepage_qb_eyebrow', 'homepage_qb_heading', 'homepage_qb_description', 'homepage_qb_urgent_title', 'homepage_qb_urgent_price', 'homepage_qb_normal_title', 'homepage_qb_normal_price',
            'homepage_videos_eyebrow', 'homepage_videos_heading', 'homepage_videos_btn_text',
            'homepage_pf_eyebrow', 'homepage_pf_heading', 'homepage_pf_description', 'homepage_pf_call_text', 'homepage_pf_whatsapp_text', 'homepage_pf_email_text',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                SiteSetting::set($field, $request->input($field), 'homepage');
            }
        }

        return redirect()->back()->with('status', 'Home Page content & settings updated successfully.');
    }

    /**
     * Store a new Home Video record.
     */
    public function storeVideo(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255',
            'video_url' => 'required|url|max:1000',
            'display_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'thumbnail_url' => 'nullable|string|max:1000',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('videos', 'public');
            $thumbnailPath = '/storage/' . $path;
        } elseif (!empty($validated['thumbnail_url'])) {
            $thumbnailPath = $validated['thumbnail_url'];
        } else {
            // Auto extract YouTube thumbnail if possible
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^\"&?\/\s]{11})/', $validated['video_url'], $matches);
            if (isset($matches[1])) {
                $thumbnailPath = 'https://img.youtube.com/vi/' . $matches[1] . '/hqdefault.jpg';
            } else {
                return back()->withInput()->withErrors([
                    'thumbnail_file' => 'Please upload a thumbnail image or provide a thumbnail image URL.',
                ]);
            }
        }

        HomeVideo::create([
            'title' => $validated['title'],
            'tag' => $validated['tag'] ?? null,
            'video_url' => $validated['video_url'],
            'thumbnail' => $thumbnailPath,
            'display_order' => $validated['display_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->back()->with('status', 'Video card added successfully.');
    }

    /**
     * Update an existing Home Video record.
     */
    public function updateVideo(Request $request, HomeVideo $video)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255',
            'video_url' => 'required|url|max:1000',
            'display_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'thumbnail_url' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('videos', 'public');
            $video->thumbnail = '/storage/' . $path;
        } elseif (!empty($validated['thumbnail_url'])) {
            $video->thumbnail = $validated['thumbnail_url'];
        }

        $video->update([
            'title' => $validated['title'],
            'tag' => $validated['tag'] ?? null,
            'video_url' => $validated['video_url'],
            'display_order' => $validated['display_order'] ?? $video->display_order,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->back()->with('status', 'Video card updated successfully.');
    }

    /**
     * Delete a Home Video record.
     */
    public function destroyVideo(HomeVideo $video)
    {
        $video->delete();

        return redirect()->back()->with('status', 'Video card deleted successfully.');
    }

    /**
     * Store a new Home Feature record.
     */
    public function storeFeature(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'display_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        HomeFeature::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'icon' => $validated['icon'] ?? 'star',
            'display_order' => $validated['display_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->back()->with('status', 'Feature item added successfully.');
    }

    /**
     * Update an existing Home Feature record.
     */
    public function updateFeature(Request $request, HomeFeature $feature)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'display_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $feature->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'icon' => $validated['icon'] ?? $feature->icon,
            'display_order' => $validated['display_order'] ?? $feature->display_order,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->back()->with('status', 'Feature item updated successfully.');
    }

    /**
     * Delete a Home Feature record.
     */
    public function destroyFeature(HomeFeature $feature)
    {
        $feature->delete();

        return redirect()->back()->with('status', 'Feature item deleted successfully.');
    }
}
