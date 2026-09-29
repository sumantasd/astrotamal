<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add fields to appointments table if they don't exist
        Schema::table('appointments', function (Blueprint $table) {
            if (!Schema::hasColumn('appointments', 'booking_reference')) {
                $table->string('booking_reference')->nullable()->unique()->after('id');
            }
            if (!Schema::hasColumn('appointments', 'consultation_type')) {
                $table->string('consultation_type')->default('urgent')->after('service_id');
            }
            if (!Schema::hasColumn('appointments', 'consultation_mode')) {
                $table->string('consultation_mode')->default('audio')->after('consultation_type');
            }
            if (!Schema::hasColumn('appointments', 'amount')) {
                $table->decimal('amount', 10, 2)->default(5000.00)->after('consultation_mode');
            }
            if (!Schema::hasColumn('appointments', 'payment_status')) {
                $table->string('payment_status')->default('Pending')->after('status');
            }
            if (!Schema::hasColumn('appointments', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('payment_status');
            }
            if (!Schema::hasColumn('appointments', 'payment_reference')) {
                $table->string('payment_reference')->nullable()->after('payment_method');
            }
            if (!Schema::hasColumn('appointments', 'whatsapp')) {
                $table->string('whatsapp')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('appointments', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('notes');
            }
            if (!Schema::hasColumn('appointments', 'slot_reserved_until')) {
                $table->timestamp('slot_reserved_until')->nullable()->after('admin_notes');
            }
            if (!Schema::hasColumn('appointments', 'completed_at')) {
                $table->timestamp('completed_at')->nullable()->after('slot_reserved_until');
            }
            if (!Schema::hasColumn('appointments', 'cancelled_at')) {
                $table->timestamp('cancelled_at')->nullable()->after('completed_at');
            }
        });

        // 2. Create payment_transactions table
        if (!Schema::hasTable('payment_transactions')) {
            Schema::create('payment_transactions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('appointment_id')->constrained('appointments')->cascadeOnDelete();
                $table->string('booking_reference')->index();
                $table->string('gateway')->default('Razorpay');
                $table->string('order_id')->nullable()->index();
                $table->string('payment_id')->nullable()->index();
                $table->decimal('amount', 10, 2);
                $table->string('currency')->default('INR');
                $table->string('status')->default('Pending'); // Pending, Paid, Failed, Refunded
                $table->text('gateway_response')->nullable();
                $table->string('refund_reference')->nullable();
                $table->text('refund_reason')->nullable();
                $table->timestamps();
            });
        }

        // 3. Create blocked_slots table
        if (!Schema::hasTable('blocked_slots')) {
            Schema::create('blocked_slots', function (Blueprint $table) {
                $table->id();
                $table->date('blocked_date')->nullable()->index();
                $table->string('day_of_week')->nullable(); // e.g. Sunday
                $table->string('time_slot')->nullable(); // e.g. 10:00 AM - 01:00 PM IST
                $table->string('reason')->nullable();
                $table->timestamps();
            });
        }

        // 4. Create payment_settings table
        if (!Schema::hasTable('payment_settings')) {
            Schema::create('payment_settings', function (Blueprint $table) {
                $table->id();
                $table->string('gateway')->unique(); // razorpay, paypal, test
                $table->boolean('is_enabled')->default(true);
                $table->boolean('is_test_mode')->default(true);
                $table->string('public_key')->nullable();
                $table->string('secret_key')->nullable();
                $table->string('webhook_secret')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
        Schema::dropIfExists('blocked_slots');
        Schema::dropIfExists('payment_transactions');
    }
};
