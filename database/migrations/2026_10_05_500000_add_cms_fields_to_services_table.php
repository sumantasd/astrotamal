<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('is_featured');
            
            // Hero section
            $table->string('hero_eyebrow')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();
            $table->boolean('hero_visible')->default(true);
            
            // Main content & Intro
            $table->string('intro_eyebrow')->nullable();
            $table->string('intro_heading')->nullable();
            $table->boolean('main_content_visible')->default(true);

            // Scope / Covers
            $table->string('covers_eyebrow')->nullable();
            $table->string('covers_title')->nullable();
            $table->json('covers_items')->nullable();
            $table->boolean('covers_visible')->default(true);

            // Benefits
            $table->string('benefits_eyebrow')->nullable();
            $table->string('benefits_title')->nullable();
            $table->json('benefits_items')->nullable();
            $table->boolean('benefits_visible')->default(true);

            // Process
            $table->string('process_eyebrow')->nullable();
            $table->string('process_title')->nullable();
            $table->json('process_items')->nullable();
            $table->boolean('process_visible')->default(true);

            // Life Dimensions / What you get
            $table->string('dimensions_eyebrow')->nullable();
            $table->string('dimensions_title')->nullable();
            $table->json('dimensions_items')->nullable();
            $table->boolean('dimensions_visible')->default(true);

            // Who it is for
            $table->string('who_for_title')->nullable();
            $table->json('who_for_items')->nullable();
            $table->boolean('who_for_visible')->default(true);

            // Questions explored
            $table->string('questions_title')->nullable();
            $table->json('questions_items')->nullable();
            $table->boolean('questions_visible')->default(true);

            // Methodology
            $table->string('methodology_title')->nullable();
            $table->text('methodology_content')->nullable();
            $table->boolean('methodology_visible')->default(true);

            // Expectations
            $table->string('expectations_title')->nullable();
            $table->json('expectations_items')->nullable();
            $table->boolean('expectations_visible')->default(true);

            // FAQs
            $table->string('faqs_eyebrow')->nullable();
            $table->string('faqs_title')->nullable();
            $table->json('faqs_items')->nullable();
            $table->boolean('faqs_visible')->default(true);

            // CTA
            $table->string('cta_eyebrow')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_url')->nullable();
            $table->boolean('cta_visible')->default(true);

            // SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_meta_description')->nullable();
            $table->string('seo_og_image')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'is_active', 'hero_eyebrow', 'hero_title', 'hero_description', 'hero_image', 'hero_visible',
                'intro_eyebrow', 'intro_heading', 'main_content_visible',
                'covers_eyebrow', 'covers_title', 'covers_items', 'covers_visible',
                'benefits_eyebrow', 'benefits_title', 'benefits_items', 'benefits_visible',
                'process_eyebrow', 'process_title', 'process_items', 'process_visible',
                'dimensions_eyebrow', 'dimensions_title', 'dimensions_items', 'dimensions_visible',
                'who_for_title', 'who_for_items', 'who_for_visible',
                'questions_title', 'questions_items', 'questions_visible',
                'methodology_title', 'methodology_content', 'methodology_visible',
                'expectations_title', 'expectations_items', 'expectations_visible',
                'faqs_eyebrow', 'faqs_title', 'faqs_items', 'faqs_visible',
                'cta_eyebrow', 'cta_title', 'cta_description', 'cta_button_text', 'cta_url', 'cta_visible',
                'seo_title', 'seo_meta_description', 'seo_og_image'
            ]);
        });
    }
};
