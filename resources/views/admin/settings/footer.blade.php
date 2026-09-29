@extends('admin.layouts.app')

@section('title', 'Footer Manager')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl font-bold font-serif-luxury text-[#541F1D]">Footer Manager</h1>
            <p class="text-xs text-[#81766D] mt-1">Manage footer branding text, copyright disclaimer, and social media handles.</p>
        </div>
        <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8]">
            ← Back to Settings
        </a>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
        @csrf
        <input type="hidden" name="group" value="footer">

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Footer About Description</label>
            <textarea name="footer_about" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ App\Models\SiteSetting::get('footer_about', 'Tamal Chakraborty is a renowned celebrity astrologer providing authentic Vedic astrology readings, Kundli matching, and Vastu consultations.') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Copyright Disclaimer Text</label>
            <input type="text" name="footer_copyright" value="{{ App\Models\SiteSetting::get('footer_copyright', '© 2026 Ganesha Astro Consultancy. All Rights Reserved. Tamal Chakraborty.') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Facebook URL</label>
                <input type="text" name="facebook_url" value="{{ App\Models\SiteSetting::get('facebook_url', 'https://facebook.com') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Instagram URL</label>
                <input type="text" name="instagram_url" value="{{ App\Models\SiteSetting::get('instagram_url', 'https://instagram.com') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">YouTube Channel URL</label>
                <input type="text" name="youtube_url" value="{{ App\Models\SiteSetting::get('youtube_url', 'https://youtube.com') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">WhatsApp Chat Direct Link</label>
                <input type="text" name="whatsapp_url" value="{{ App\Models\SiteSetting::get('whatsapp_url', 'https://wa.me/919830000000') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
        </div>

        <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                Save Footer Settings
            </button>
        </div>
    </form>

</div>
@endsection
