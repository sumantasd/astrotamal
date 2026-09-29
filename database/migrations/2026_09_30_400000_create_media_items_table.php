<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('media_items')) {
            Schema::create('media_items', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('caption')->nullable();
                $table->string('type')->default('image'); // image, video, youtube
                $table->string('file_path')->nullable();
                $table->string('url')->nullable();
                $table->boolean('is_published')->default(true);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('media_items');
    }
};
