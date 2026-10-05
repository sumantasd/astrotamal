<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order', 'asc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.form', ['service' => new Service()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:services,slug'],
            'badge' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'string', 'max:255'],
            'duration' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:500'],
            'hero_image' => ['nullable', 'string', 'max:500'],
            'short_description' => ['nullable', 'string'],
            'full_description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],

            // Hero
            'hero_eyebrow' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string'],
            'hero_visible' => ['boolean'],

            // Intro
            'intro_eyebrow' => ['nullable', 'string', 'max:255'],
            'intro_heading' => ['nullable', 'string', 'max:255'],
            'main_content_visible' => ['boolean'],

            // Covers
            'covers_eyebrow' => ['nullable', 'string', 'max:255'],
            'covers_title' => ['nullable', 'string', 'max:255'],
            'covers_items' => ['nullable', 'array'],
            'covers_visible' => ['boolean'],

            // Benefits
            'benefits_eyebrow' => ['nullable', 'string', 'max:255'],
            'benefits_title' => ['nullable', 'string', 'max:255'],
            'benefits_items' => ['nullable', 'array'],
            'benefits_visible' => ['boolean'],

            // Process
            'process_eyebrow' => ['nullable', 'string', 'max:255'],
            'process_title' => ['nullable', 'string', 'max:255'],
            'process_items' => ['nullable', 'array'],
            'process_visible' => ['boolean'],

            // Dimensions
            'dimensions_eyebrow' => ['nullable', 'string', 'max:255'],
            'dimensions_title' => ['nullable', 'string', 'max:255'],
            'dimensions_items' => ['nullable', 'array'],
            'dimensions_visible' => ['boolean'],

            // Who for
            'who_for_title' => ['nullable', 'string', 'max:255'],
            'who_for_items' => ['nullable', 'array'],
            'who_for_visible' => ['boolean'],

            // Questions
            'questions_title' => ['nullable', 'string', 'max:255'],
            'questions_items' => ['nullable', 'array'],
            'questions_visible' => ['boolean'],

            // Methodology
            'methodology_title' => ['nullable', 'string', 'max:255'],
            'methodology_content' => ['nullable', 'string'],
            'methodology_visible' => ['boolean'],

            // Expectations
            'expectations_title' => ['nullable', 'string', 'max:255'],
            'expectations_items' => ['nullable', 'array'],
            'expectations_visible' => ['boolean'],

            // FAQs
            'faqs_eyebrow' => ['nullable', 'string', 'max:255'],
            'faqs_title' => ['nullable', 'string', 'max:255'],
            'faqs_items' => ['nullable', 'array'],
            'faqs_visible' => ['boolean'],

            // CTA
            'cta_eyebrow' => ['nullable', 'string', 'max:255'],
            'cta_title' => ['nullable', 'string', 'max:255'],
            'cta_description' => ['nullable', 'string'],
            'cta_button_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'cta_visible' => ['boolean'],

            // SEO
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_meta_description' => ['nullable', 'string'],
            'seo_og_image' => ['nullable', 'string', 'max:500'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['hero_visible'] = $request->boolean('hero_visible');
        $validated['main_content_visible'] = $request->boolean('main_content_visible');
        $validated['covers_visible'] = $request->boolean('covers_visible');
        $validated['benefits_visible'] = $request->boolean('benefits_visible');
        $validated['process_visible'] = $request->boolean('process_visible');
        $validated['dimensions_visible'] = $request->boolean('dimensions_visible');
        $validated['who_for_visible'] = $request->boolean('who_for_visible');
        $validated['questions_visible'] = $request->boolean('questions_visible');
        $validated['methodology_visible'] = $request->boolean('methodology_visible');
        $validated['expectations_visible'] = $request->boolean('expectations_visible');
        $validated['faqs_visible'] = $request->boolean('faqs_visible');
        $validated['cta_visible'] = $request->boolean('cta_visible');

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('status', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:services,slug,' . $service->id],
            'badge' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'string', 'max:255'],
            'duration' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:500'],
            'hero_image' => ['nullable', 'string', 'max:500'],
            'short_description' => ['nullable', 'string'],
            'full_description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],

            // Hero
            'hero_eyebrow' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string'],
            'hero_visible' => ['boolean'],

            // Intro
            'intro_eyebrow' => ['nullable', 'string', 'max:255'],
            'intro_heading' => ['nullable', 'string', 'max:255'],
            'main_content_visible' => ['boolean'],

            // Covers
            'covers_eyebrow' => ['nullable', 'string', 'max:255'],
            'covers_title' => ['nullable', 'string', 'max:255'],
            'covers_items' => ['nullable', 'array'],
            'covers_visible' => ['boolean'],

            // Benefits
            'benefits_eyebrow' => ['nullable', 'string', 'max:255'],
            'benefits_title' => ['nullable', 'string', 'max:255'],
            'benefits_items' => ['nullable', 'array'],
            'benefits_visible' => ['boolean'],

            // Process
            'process_eyebrow' => ['nullable', 'string', 'max:255'],
            'process_title' => ['nullable', 'string', 'max:255'],
            'process_items' => ['nullable', 'array'],
            'process_visible' => ['boolean'],

            // Dimensions
            'dimensions_eyebrow' => ['nullable', 'string', 'max:255'],
            'dimensions_title' => ['nullable', 'string', 'max:255'],
            'dimensions_items' => ['nullable', 'array'],
            'dimensions_visible' => ['boolean'],

            // Who for
            'who_for_title' => ['nullable', 'string', 'max:255'],
            'who_for_items' => ['nullable', 'array'],
            'who_for_visible' => ['boolean'],

            // Questions
            'questions_title' => ['nullable', 'string', 'max:255'],
            'questions_items' => ['nullable', 'array'],
            'questions_visible' => ['boolean'],

            // Methodology
            'methodology_title' => ['nullable', 'string', 'max:255'],
            'methodology_content' => ['nullable', 'string'],
            'methodology_visible' => ['boolean'],

            // Expectations
            'expectations_title' => ['nullable', 'string', 'max:255'],
            'expectations_items' => ['nullable', 'array'],
            'expectations_visible' => ['boolean'],

            // FAQs
            'faqs_eyebrow' => ['nullable', 'string', 'max:255'],
            'faqs_title' => ['nullable', 'string', 'max:255'],
            'faqs_items' => ['nullable', 'array'],
            'faqs_visible' => ['boolean'],

            // CTA
            'cta_eyebrow' => ['nullable', 'string', 'max:255'],
            'cta_title' => ['nullable', 'string', 'max:255'],
            'cta_description' => ['nullable', 'string'],
            'cta_button_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'cta_visible' => ['boolean'],

            // SEO
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_meta_description' => ['nullable', 'string'],
            'seo_og_image' => ['nullable', 'string', 'max:500'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['hero_visible'] = $request->boolean('hero_visible');
        $validated['main_content_visible'] = $request->boolean('main_content_visible');
        $validated['covers_visible'] = $request->boolean('covers_visible');
        $validated['benefits_visible'] = $request->boolean('benefits_visible');
        $validated['process_visible'] = $request->boolean('process_visible');
        $validated['dimensions_visible'] = $request->boolean('dimensions_visible');
        $validated['who_for_visible'] = $request->boolean('who_for_visible');
        $validated['questions_visible'] = $request->boolean('questions_visible');
        $validated['methodology_visible'] = $request->boolean('methodology_visible');
        $validated['expectations_visible'] = $request->boolean('expectations_visible');
        $validated['faqs_visible'] = $request->boolean('faqs_visible');
        $validated['cta_visible'] = $request->boolean('cta_visible');

        // Filter out empty arrays
        if (isset($validated['covers_items'])) {
            $validated['covers_items'] = array_values(array_filter($validated['covers_items'], fn($item) => !empty($item['title'])));
        }
        if (isset($validated['benefits_items'])) {
            $validated['benefits_items'] = array_values(array_filter($validated['benefits_items'], fn($item) => !empty($item['title'])));
        }
        if (isset($validated['process_items'])) {
            $validated['process_items'] = array_values(array_filter($validated['process_items'], fn($item) => !empty($item['title'])));
        }
        if (isset($validated['dimensions_items'])) {
            $validated['dimensions_items'] = array_values(array_filter($validated['dimensions_items'], fn($item) => !empty($item['title'])));
        }
        if (isset($validated['who_for_items'])) {
            $validated['who_for_items'] = array_values(array_filter($validated['who_for_items'], fn($item) => !empty($item)));
        }
        if (isset($validated['questions_items'])) {
            $validated['questions_items'] = array_values(array_filter($validated['questions_items'], fn($item) => !empty($item)));
        }
        if (isset($validated['expectations_items'])) {
            $validated['expectations_items'] = array_values(array_filter($validated['expectations_items'], fn($item) => !empty($item['title'])));
        }
        if (isset($validated['faqs_items'])) {
            $validated['faqs_items'] = array_values(array_filter($validated['faqs_items'], fn($item) => !empty($item['question'])));
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('status', 'Service "' . $service->title . '" updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('status', 'Service deleted successfully.');
    }
}
