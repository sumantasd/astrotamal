<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create backup_histories table
        if (!Schema::hasTable('backup_histories')) {
            Schema::create('backup_histories', function (Blueprint $table) {
                $table->id();
                $table->string('filename')->unique();
                $table->string('path');
                $table->unsignedBigInteger('size_bytes')->default(0);
                $table->string('type')->default('manual'); // manual, pre_restore
                $table->json('manifest')->nullable();
                $table->timestamps();
            });
        }

        // 2. Create date_schedule_overrides table
        if (!Schema::hasTable('date_schedule_overrides')) {
            Schema::create('date_schedule_overrides', function (Blueprint $table) {
                $table->id();
                $table->date('override_date')->unique();
                $table->string('opening_time')->default('09:00 AM');
                $table->string('closing_time')->default('08:00 PM');
                $table->integer('slot_duration_minutes')->default(30);
                $table->string('reason')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 3. Ensure payment_settings has all required columns
        if (Schema::hasTable('payment_settings')) {
            Schema::table('payment_settings', function (Blueprint $table) {
                if (!Schema::hasColumn('payment_settings', 'webhook_secret')) {
                    $table->string('webhook_secret')->nullable()->after('secret_key');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('date_schedule_overrides');
        Schema::dropIfExists('backup_histories');
    }
};
