@extends('admin.layouts.app')

@section('title', 'General Website Settings')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl font-bold font-serif-luxury text-[#541F1D]">General Website Settings</h1>
            <p class="text-xs text-[#81766D] mt-1">Configure site name, official contact numbers, WhatsApp, and office address.</p>
        </div>
        <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8]">
            ← Back to Settings
        </a>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
        @csrf
        <input type="hidden" name="group" value="general">

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Website Name</label>
            <input type="text" name="site_name" value="{{ App\Models\SiteSetting::get('site_name', 'Ganesha Astro Consultancy') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Tagline / Subtitle</label>
            <input type="text" name="site_tagline" value="{{ App\Models\SiteSetting::get('site_tagline', 'Tamal Chakraborty — Celebrity Astrologer & Vastu Expert') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Official Phone Number</label>
                <input type="text" name="contact_phone" value="{{ App\Models\SiteSetting::get('contact_phone', '+91 98300 00000') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">WhatsApp Number</label>
                <input type="text" name="whatsapp_number" value="{{ App\Models\SiteSetting::get('whatsapp_number', '+91 98300 00000') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Official Email Address</label>
            <input type="email" name="contact_email" value="{{ App\Models\SiteSetting::get('contact_email', 'contact@astrotamal.com') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Chamber / Office Address</label>
            <textarea name="office_address" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ App\Models\SiteSetting::get('office_address', 'Kolkata, West Bengal, India') }}</textarea>
        </div>

        <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                Save General Settings
            </button>
        </div>
    </form>

</div>
@endsection
