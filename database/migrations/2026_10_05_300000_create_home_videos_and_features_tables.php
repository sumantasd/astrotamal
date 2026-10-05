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
        if (!Schema::hasTable('home_videos')) {
            Schema::create('home_videos', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('thumbnail')->nullable();
                $table->string('tag')->nullable();
                $table->text('video_url');
                $table->integer('display_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('home_features')) {
            Schema::create('home_features', function (Blueprint $table) {
                $table->id();
                $table->string('icon')->nullable();
                $table->string('title');
                $table->string('description');
                $table->integer('display_order')->default(0);
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
        Schema::dropIfExists('home_videos');
        Schema::dropIfExists('home_features');
    }
};
