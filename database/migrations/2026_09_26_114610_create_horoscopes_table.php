<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horoscopes', function (Blueprint $table) {
            $table->id();
            $table->string('zodiac_sign');
            $table->string('slug')->unique();
            $table->string('symbol');
            $table->string('element');
            $table->string('date_range');
            $table->string('ruling_planet');
            $table->string('lucky_number');
            $table->string('lucky_color');
            $table->text('overview');
            $table->text('daily_prediction');
            $table->text('weekly_prediction');
            $table->text('monthly_prediction');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horoscopes');
    }
};
