<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Footer Quick Navigation Items
        if (!Schema::hasTable('footer_nav_items')) {
            Schema::create('footer_nav_items', function (Blueprint $table) {
                $table->id();
                $table->string('label');
                $table->string('link_type')->default('internal'); // internal, custom, external
                $table->string('route_name')->nullable();
                $table->string('url')->nullable();
                $table->string('target')->default('_self');
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 2. Footer Guidance Items
        if (!Schema::hasTable('footer_guidance_items')) {
            Schema::create('footer_guidance_items', function (Blueprint $table) {
                $table->id();
                $table->string('label');
                $table->string('link_type')->default('custom'); // internal, custom, external
                $table->string('route_name')->nullable();
                $table->string('url')->nullable();
                $table->string('target')->default('_self');
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 3. Footer Social Links
        if (!Schema::hasTable('footer_social_links')) {
            Schema::create('footer_social_links', function (Blueprint $table) {
                $table->id();
                $table->string('platform'); // facebook, instagram, youtube, whatsapp, twitter, linkedin, etc.
                $table->string('url');
                $table->string('icon')->nullable();
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_social_links');
        Schema::dropIfExists('footer_guidance_items');
        Schema::dropIfExists('footer_nav_items');
    }
};
