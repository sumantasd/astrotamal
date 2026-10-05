<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'welcome_email_sent_at')) {
                $table->timestamp('welcome_email_sent_at')->nullable()->after('must_change_password');
            }
        });

        Schema::table('appointments', function (Blueprint $table) {
            if (!Schema::hasColumn('appointments', 'confirmed_email_sent_at')) {
                $table->timestamp('confirmed_email_sent_at')->nullable()->after('cancelled_at');
            }
            if (!Schema::hasColumn('appointments', 'failed_email_sent_at')) {
                $table->timestamp('failed_email_sent_at')->nullable()->after('confirmed_email_sent_at');
            }
            if (!Schema::hasColumn('appointments', 'expired_email_sent_at')) {
                $table->timestamp('expired_email_sent_at')->nullable()->after('failed_email_sent_at');
            }
            if (!Schema::hasColumn('appointments', 'reminder_24h_sent_at')) {
                $table->timestamp('reminder_24h_sent_at')->nullable()->after('expired_email_sent_at');
            }
            if (!Schema::hasColumn('appointments', 'reminder_1h_sent_at')) {
                $table->timestamp('reminder_1h_sent_at')->nullable()->after('reminder_24h_sent_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn([
                'confirmed_email_sent_at',
                'failed_email_sent_at',
                'expired_email_sent_at',
                'reminder_24h_sent_at',
                'reminder_1h_sent_at',
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('welcome_email_sent_at');
        });
    }
};
