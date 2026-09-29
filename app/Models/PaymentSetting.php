<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $fillable = [
        'gateway',
        'is_enabled',
        'is_test_mode',
        'public_key',
        'secret_key',
        'webhook_secret',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'is_test_mode' => 'boolean',
    ];

    public static function get(string $key, ?string $default = null): ?string
    {
        $setting = static::where('gateway', 'Razorpay')->first();
        if (!$setting) {
            return $default;
        }

        return match ($key) {
            'razorpay_key_id', 'public_key' => $setting->public_key ?? $default,
            'razorpay_key_secret', 'secret_key' => $setting->secret_key ?? $default,
            'webhook_secret' => $setting->webhook_secret ?? $default,
            'razorpay_test_mode', 'is_test_mode' => $setting->is_test_mode ? '1' : '0',
            'is_enabled' => $setting->is_enabled ? '1' : '0',
            default => $default,
        };
    }
}
