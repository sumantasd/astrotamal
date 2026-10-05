<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use App\Models\PaymentTransaction;
use App\Services\RazorpaySettingsService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function transactions(Request $request)
    {
        $query = PaymentTransaction::with('appointment')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'like', "%{$search}%")
                  ->orWhere('payment_id', 'like', "%{$search}%")
                  ->orWhere('booking_reference', 'like', "%{$search}%")
                  ->orWhereHas('appointment', function ($appQ) use ($search) {
                      $appQ->where('name', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%")
                           ->orWhere('phone', 'like', "%{$search}%");
                  });
            });
        }

        $transactions = $query->paginate(15)->withQueryString();

        return view('admin.payments.transactions', compact('transactions'));
    }

    public function show(PaymentTransaction $transaction)
    {
        $transaction->load('appointment');
        return view('admin.payments.show', compact('transaction'));
    }

    public function settings()
    {
        $setting = PaymentSetting::where(function ($q) {
            $q->where('gateway', 'Razorpay')
              ->orWhere('gateway', 'razorpay');
        })->first();

        $keyId = RazorpaySettingsService::getKeyId();
        $isTestMode = RazorpaySettingsService::isTestMode();
        $isEnabled = RazorpaySettingsService::isEnabled();

        return view('admin.payments.settings', compact('setting', 'keyId', 'isTestMode', 'isEnabled'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'is_enabled' => ['required', 'boolean'],
            'is_test_mode' => ['required', 'boolean'],
            'public_key' => ['nullable', 'string', 'max:255'],
            'secret_key' => ['nullable', 'string', 'max:255'],
            'webhook_secret' => ['nullable', 'string', 'max:255'],
        ]);

        $setting = PaymentSetting::firstOrCreate(
            ['gateway' => 'Razorpay'],
            ['gateway' => 'Razorpay']
        );

        $dataToUpdate = [
            'is_enabled' => $validated['is_enabled'],
            'is_test_mode' => $validated['is_test_mode'],
            'public_key' => $validated['public_key'],
        ];

        // Only update secrets if non-empty input is provided (preserves existing encrypted secrets)
        if ($request->filled('secret_key')) {
            $dataToUpdate['secret_key'] = $validated['secret_key'];
        }

        if ($request->filled('webhook_secret')) {
            $dataToUpdate['webhook_secret'] = $validated['webhook_secret'];
        }

        $setting->update($dataToUpdate);

        // Clear application config & route caches safely
        try {
            \Illuminate\Support\Facades\Artisan::call('config:clear');
        } catch (\Throwable $e) {
            // Log fallback
        }

        return redirect()->back()->with('status', 'Razorpay payment settings saved securely in database.');
    }
}
