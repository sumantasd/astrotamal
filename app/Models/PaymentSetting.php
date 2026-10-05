<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

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

    /**
     * Mutator to encrypt secret_key before storing in database.
     */
    public function setSecretKeyAttribute(?string $value): void
    {
        if (empty($value)) {
            $this->attributes['secret_key'] = null;
        } else {
            // Avoid double encryption if value is already encrypted
            try {
                Crypt::decryptString($value);
                $this->attributes['secret_key'] = $value;
            } catch (\Throwable $e) {
                $this->attributes['secret_key'] = Crypt::encryptString($value);
            }
        }
    }

    /**
     * Accessor to decrypt secret_key from database.
     */
    public function getSecretKeyAttribute(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }
        try {
            return Crypt::decryptString($value);
        } catch (\Throwable $e) {
            return $value; // Fallback if plain text from previous migration
        }
    }

    /**
     * Mutator to encrypt webhook_secret before storing in database.
     */
    public function setWebhookSecretAttribute(?string $value): void
    {
        if (empty($value)) {
            $this->attributes['webhook_secret'] = null;
        } else {
            try {
                Crypt::decryptString($value);
                $this->attributes['webhook_secret'] = $value;
            } catch (\Throwable $e) {
                $this->attributes['webhook_secret'] = Crypt::encryptString($value);
            }
        }
    }

    /**
     * Accessor to decrypt webhook_secret from database.
     */
    public function getWebhookSecretAttribute(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }
        try {
            return Crypt::decryptString($value);
        } catch (\Throwable $e) {
            return $value;
        }
    }

    /**
     * Get a setting value by key with optional fallback.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        $setting = static::where(function ($q) {
            $q->where('gateway', 'Razorpay')
              ->orWhere('gateway', 'razorpay');
        })->first();

        if (!$setting) {
            return $default;
        }

        return match ($key) {
            'razorpay_key_id', 'public_key' => !empty($setting->public_key) ? $setting->public_key : $default,
            'razorpay_key_secret', 'secret_key' => !empty($setting->secret_key) ? $setting->secret_key : $default,
            'webhook_secret', 'razorpay_webhook_secret' => !empty($setting->webhook_secret) ? $setting->webhook_secret : $default,
            'razorpay_test_mode', 'is_test_mode' => $setting->is_test_mode ? '1' : '0',
            'is_enabled' => $setting->is_enabled ? '1' : '0',
            default => $default,
        };
    }
}
