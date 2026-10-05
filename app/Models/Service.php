<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'full_description',
        'icon',
        'image',
        'badge',
        'price',
        'duration',
        'is_featured',
        'is_active',
        'sort_order',
        
        // Hero
        'hero_eyebrow',
        'hero_title',
        'hero_description',
        'hero_image',
        'hero_visible',

        // Intro
        'intro_eyebrow',
        'intro_heading',
        'main_content_visible',

        // Covers
        'covers_eyebrow',
        'covers_title',
        'covers_items',
        'covers_visible',

        // Benefits
        'benefits_eyebrow',
        'benefits_title',
        'benefits_items',
        'benefits_visible',

        // Process
        'process_eyebrow',
        'process_title',
        'process_items',
        'process_visible',

        // Dimensions
        'dimensions_eyebrow',
        'dimensions_title',
        'dimensions_items',
        'dimensions_visible',

        // Who for
        'who_for_title',
        'who_for_items',
        'who_for_visible',

        // Questions
        'questions_title',
        'questions_items',
        'questions_visible',

        // Methodology
        'methodology_title',
        'methodology_content',
        'methodology_visible',

        // Expectations
        'expectations_title',
        'expectations_items',
        'expectations_visible',

        // FAQs
        'faqs_eyebrow',
        'faqs_title',
        'faqs_items',
        'faqs_visible',

        // CTA
        'cta_eyebrow',
        'cta_title',
        'cta_description',
        'cta_button_text',
        'cta_url',
        'cta_visible',

        // SEO
        'seo_title',
        'seo_meta_description',
        'seo_og_image',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'hero_visible' => 'boolean',
        'main_content_visible' => 'boolean',
        'covers_visible' => 'boolean',
        'benefits_visible' => 'boolean',
        'process_visible' => 'boolean',
        'dimensions_visible' => 'boolean',
        'who_for_visible' => 'boolean',
        'questions_visible' => 'boolean',
        'methodology_visible' => 'boolean',
        'expectations_visible' => 'boolean',
        'faqs_visible' => 'boolean',
        'cta_visible' => 'boolean',
        'covers_items' => 'array',
        'benefits_items' => 'array',
        'process_items' => 'array',
        'dimensions_items' => 'array',
        'who_for_items' => 'array',
        'questions_items' => 'array',
        'expectations_items' => 'array',
        'faqs_items' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
