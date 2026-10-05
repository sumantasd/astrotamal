<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function general()
    {
        return view('admin.settings.general');
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'site_description' => ['nullable', 'string'],
            'default_language' => ['nullable', 'string', 'max:10'],
            'default_timezone' => ['nullable', 'string', 'max:50'],

            'contact_phone' => ['required', 'string', 'max:50'],
            'whatsapp_number' => ['required', 'string', 'max:50'],
            'contact_email' => ['required', 'email', 'max:255'],
            'office_address' => ['required', 'string'],
            'website_url' => ['nullable', 'url', 'max:255'],

            'business_name' => ['nullable', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'business_address' => ['nullable', 'string'],
            'google_maps_url' => ['nullable', 'url', 'max:500'],
            'business_hours' => ['nullable', 'string', 'max:255'],
            'consultation_availability' => ['nullable', 'string', 'max:255'],

            'maintenance_mode' => ['nullable', 'in:0,1'],
            'default_pagination' => ['nullable', 'integer', 'min:1', 'max:100'],

            'logo_file' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp,svg', 'max:2048'],
            'favicon_file' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp,ico', 'max:1024'],
        ]);

        // Handle logo file upload
        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $filename = 'site_logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            SiteSetting::set('site_logo', 'images/' . $filename, 'general');
        }

        // Handle favicon file upload
        if ($request->hasFile('favicon_file')) {
            $file = $request->file('favicon_file');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            SiteSetting::set('site_favicon', 'images/' . $filename, 'general');
        }

        $fields = [
            'site_name',
            'site_tagline',
            'site_description',
            'default_language',
            'default_timezone',
            'contact_phone',
            'whatsapp_number',
            'contact_email',
            'office_address',
            'website_url',
            'business_name',
            'contact_person',
            'business_address',
            'google_maps_url',
            'business_hours',
            'consultation_availability',
            'default_pagination',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                SiteSetting::set($field, $request->input($field), 'general');
            }
        }

        // Handle maintenance mode switch
        SiteSetting::set('maintenance_mode', $request->has('maintenance_mode') ? '1' : '0', 'general');

        $this->clearCache();

        return redirect()->route('admin.settings.general')->with('status', 'General Website Settings updated successfully.');
    }

    public function seo()
    {
        return view('admin.settings.seo');
    }

    public function updateSeo(Request $request)
    {
        $validated = $request->validate([
            'default_meta_title' => ['required', 'string', 'max:255'],
            'default_meta_description' => ['nullable', 'string'],
            'default_keywords' => ['nullable', 'string'],
            'canonical_base_url' => ['nullable', 'url', 'max:255'],
            'robots_directive' => ['required', 'string', \Illuminate\Validation\Rule::in(['index, follow', 'noindex, nofollow', 'index, nofollow', 'noindex, follow'])],

            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string'],
            'twitter_card_type' => ['required', 'string', 'in:summary_large_image,summary'],
            'twitter_title' => ['nullable', 'string', 'max:255'],
            'twitter_description' => ['nullable', 'string'],

            'google_site_verification' => ['nullable', 'string', 'max:255'],
            'bing_site_verification' => ['nullable', 'string', 'max:255'],
            'json_ld_schema' => ['nullable', 'string'],

            'og_image_file' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'twitter_image_file' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ]);

        // Handle OG image file upload
        if ($request->hasFile('og_image_file')) {
            $file = $request->file('og_image_file');
            $filename = 'og_image_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            SiteSetting::set('og_image', 'images/' . $filename, 'seo');
        }

        // Handle Twitter image file upload
        if ($request->hasFile('twitter_image_file')) {
            $file = $request->file('twitter_image_file');
            $filename = 'twitter_image_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            SiteSetting::set('twitter_image', 'images/' . $filename, 'seo');
        }

        // Validate JSON-LD if provided
        if (!empty($request->input('json_ld_schema'))) {
            $json = json_decode($request->input('json_ld_schema'));
            if ($json === null && json_last_error() !== JSON_ERROR_NONE) {
                return back()->withInput()->withErrors(['json_ld_schema' => 'Invalid JSON-LD format. Please provide valid JSON.']);
            }
        }

        $fields = [
            'default_meta_title',
            'default_meta_description',
            'default_keywords',
            'canonical_base_url',
            'robots_directive',
            'og_title',
            'og_description',
            'twitter_card_type',
            'twitter_title',
            'twitter_description',
            'google_site_verification',
            'bing_site_verification',
            'json_ld_schema',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                SiteSetting::set($field, $request->input($field), 'seo');
            }
        }

        $this->clearCache();

        return redirect()->route('admin.settings.seo')->with('status', 'SEO & Meta Tags Settings updated successfully.');
    }

    /**
     * Legacy generic update method for backwards compatibility.
     */
    public function update(Request $request)
    {
        if ($request->input('group') === 'seo') {
            return $this->updateSeo($request);
        }

        return $this->updateGeneral($request);
    }

    protected function clearCache(): void
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
        } catch (\Throwable $e) {
            // Silently ignore cache clearing errors
        }
    }
}
