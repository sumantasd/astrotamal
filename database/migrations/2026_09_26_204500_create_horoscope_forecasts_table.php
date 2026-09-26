<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horoscope_forecasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('horoscope_id')->constrained('horoscopes')->onDelete('cascade');
            $table->string('period_type'); // daily, weekly, monthly, yearly
            $table->date('period_start')->nullable();
            $table->date('period_end')->nullable();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->text('overview')->nullable();
            $table->text('career')->nullable();
            $table->text('finance')->nullable();
            $table->text('love')->nullable();
            $table->text('health')->nullable();
            $table->text('education')->nullable();
            $table->text('family')->nullable();
            $table->text('travel')->nullable();
            $table->text('important_dates')->nullable();
            $table->text('advice')->nullable();
            $table->string('lucky_day')->nullable();
            $table->string('lucky_colour')->nullable();
            $table->string('lucky_number')->nullable();
            $table->text('planetary_influence')->nullable();
            $table->text('transit_context')->nullable();
            $table->text('disclaimer')->nullable();
            $table->string('status')->default('published'); // published, draft
            $table->boolean('featured')->default(false);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('og_image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horoscope_forecasts');
    }
};
