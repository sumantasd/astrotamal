<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use App\Models\PaymentTransaction;
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
                  ->orWhere('booking_reference', 'like', "%{$search}%");
            });
        }

        $transactions = $query->paginate(15)->withQueryString();

        return view('admin.payments.transactions', compact('transactions'));
    }

    public function settings()
    {
        $setting = PaymentSetting::first();
        return view('admin.payments.settings', compact('setting'));
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
            ['gateway' => 'razorpay'],
            ['gateway' => 'razorpay']
        );

        $setting->update($validated);

        return redirect()->back()->with('status', 'Razorpay payment settings saved successfully.');
    }
}
