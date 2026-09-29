@extends('admin.layouts.app')

@section('title', 'Razorpay Payment Settings')
@section('header_title', 'Razorpay Payment Settings')
@section('header_subtitle', 'Manage Razorpay payment gateway API keys, test mode, and webhooks')

@section('content')
<div class="max-w-4xl space-y-8">

    <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-3xl p-6 sm:p-8 shadow-xs">
        <h2 class="font-serif-luxury text-lg font-bold text-[#541F1D] mb-1">Razorpay Configuration</h2>
        <p class="text-xs text-[#81766D] mb-6">Manage live & test API credentials securely</p>

        <form method="POST" action="{{ route('admin.payments.settings.update') }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="is_enabled" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Gateway Enabled</label>
                    <select name="is_enabled" id="is_enabled" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                        <option value="1" {{ old('is_enabled', $setting->is_enabled ?? true) ? 'selected' : '' }}>Enabled</option>
                        <option value="0" {{ ! old('is_enabled', $setting->is_enabled ?? true) ? 'selected' : '' }}>Disabled</option>
                    </select>
                </div>

                <div>
                    <label for="is_test_mode" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Environment Mode</label>
                    <select name="is_test_mode" id="is_test_mode" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs text-[#29211F]">
                        <option value="1" {{ old('is_test_mode', $setting->is_test_mode ?? true) ? 'selected' : '' }}>Test Sandbox Mode</option>
                        <option value="0" {{ ! old('is_test_mode', $setting->is_test_mode ?? true) ? 'selected' : '' }}>Live Production Mode</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="public_key" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Razorpay Key ID (Public)</label>
                <input type="text" name="public_key" id="public_key" value="{{ old('public_key', $setting->public_key ?? '') }}" placeholder="rzp_test_..." 
                       class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F] font-mono">
            </div>

            <div>
                <label for="secret_key" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Razorpay Key Secret</label>
                <input type="password" name="secret_key" id="secret_key" value="{{ old('secret_key', $setting->secret_key ?? '') }}" placeholder="••••••••••••••••" 
                       class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F] font-mono">
            </div>

            <div>
                <label for="webhook_secret" class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-1.5">Webhook Secret</label>
                <input type="password" name="webhook_secret" id="webhook_secret" value="{{ old('webhook_secret', $setting->webhook_secret ?? '') }}" placeholder="••••••••••••••••" 
                       class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-xs sm:text-sm text-[#29211F] font-mono">
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#351211] hover:bg-[#541F1D] rounded-full shadow-md">
                    Save Razorpay Settings
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
