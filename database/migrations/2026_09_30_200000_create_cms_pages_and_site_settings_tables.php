<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create cms_pages table
        if (!Schema::hasTable('cms_pages')) {
            Schema::create('cms_pages', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('seo_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->longText('content')->nullable();
                $table->string('featured_image')->nullable();
                $table->string('status')->default('published'); // draft, published
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        // 2. Create site_settings table
        if (!Schema::hasTable('site_settings')) {
            Schema::create('site_settings', function (Blueprint $table) {
                $table->id();
                $table->string('group')->default('general'); // general, homepage, contact, branding, social, footer
                $table->string('key')->unique();
                $table->longText('value')->nullable();
                $table->string('label')->nullable();
                $table->string('type')->default('text'); // text, textarea, rich_text, image, toggle
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('cms_pages');
    }
};
