@extends('admin.layouts.app')

@section('title', 'Header & Navigation Configuration')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl font-bold font-serif-luxury text-[#541F1D]">Header & Navigation Configuration</h1>
            <p class="text-xs text-[#81766D] mt-1">Manage header announcement text, phone bar, and main navigation settings.</p>
        </div>
        <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8]">
            ← Back to Settings
        </a>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
        @csrf
        <input type="hidden" name="group" value="header">

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Top Announcement Bar Text</label>
            <input type="text" name="header_announcement" value="{{ App\Models\SiteSetting::get('header_announcement', '✨ Book Personal Consultation with Tamal Chakraborty — Online & In-Person Chambers Available') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Header Helpline Display Text</label>
            <input type="text" name="header_helpline" value="{{ App\Models\SiteSetting::get('header_helpline', 'Call/WhatsApp: +91 98300 00000') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
        </div>

        <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                Save Header Settings
            </button>
        </div>
    </form>

</div>
@endsection
