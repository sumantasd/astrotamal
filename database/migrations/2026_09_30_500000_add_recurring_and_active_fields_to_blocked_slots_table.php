<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blocked_slots', function (Blueprint $table) {
            if (!Schema::hasColumn('blocked_slots', 'is_recurring')) {
                $table->boolean('is_recurring')->default(false)->after('blocked_date');
            }
            if (!Schema::hasColumn('blocked_slots', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('reason');
            }
        });
    }

    public function down(): void
    {
        Schema::table('blocked_slots', function (Blueprint $table) {
            if (Schema::hasColumn('blocked_slots', 'is_recurring')) {
                $table->dropColumn('is_recurring');
            }
            if (Schema::hasColumn('blocked_slots', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};
