<?php

namespace App\Services;

use App\Models\PaymentSetting;

class RazorpaySettingsService
{
    /**
     * Get active Razorpay Key ID.
     */
    public static function getKeyId(): string
    {
        $dbKey = PaymentSetting::get('public_key');
        if (!empty($dbKey)) {
            return $dbKey;
        }

        return (string) config('services.razorpay.key', '');
    }

    /**
     * Get active Razorpay Key Secret.
     */
    public static function getKeySecret(): string
    {
        $dbSecret = PaymentSetting::get('secret_key');
        if (!empty($dbSecret)) {
            return $dbSecret;
        }

        return (string) config('services.razorpay.secret', '');
    }

    /**
     * Get active Webhook Secret.
     */
    public static function getWebhookSecret(): string
    {
        $dbWebhook = PaymentSetting::get('webhook_secret');
        if (!empty($dbWebhook)) {
            return $dbWebhook;
        }

        return (string) config('services.razorpay.webhook_secret', '');
    }

    /**
     * Check if test sandbox mode is enabled.
     */
    public static function isTestMode(): bool
    {
        $setting = PaymentSetting::where(function ($q) {
            $q->where('gateway', 'Razorpay')
              ->orWhere('gateway', 'razorpay');
        })->first();

        if ($setting) {
            return (bool) $setting->is_test_mode;
        }

        return config('services.razorpay.mode', 'test') === 'test';
    }

    /**
     * Get active environment string ('test' or 'live').
     */
    public static function getEnvironment(): string
    {
        return self::isTestMode() ? 'test' : 'live';
    }

    /**
     * Check if Razorpay gateway is enabled.
     */
    public static function isEnabled(): bool
    {
        $setting = PaymentSetting::where(function ($q) {
            $q->where('gateway', 'Razorpay')
              ->orWhere('gateway', 'razorpay');
        })->first();

        if ($setting) {
            return (bool) $setting->is_enabled;
        }

        return true;
    }
}
