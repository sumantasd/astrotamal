@extends('admin.layouts.app')

@section('title', 'Global SEO Settings')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
        <div>
            <h1 class="text-xl font-bold font-serif-luxury text-[#541F1D]">Global SEO & Open Graph Settings</h1>
            <p class="text-xs text-[#81766D] mt-1">Configure default search titles, social sharing images, and indexing parameters.</p>
        </div>
        <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8]">
            ← Back to Settings
        </a>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
        @csrf
        <input type="hidden" name="group" value="seo">

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Default Meta Title</label>
            <input type="text" name="default_meta_title" value="{{ App\Models\SiteSetting::get('default_meta_title', 'Tamal Chakraborty | Best Astrologer in Kolkata | Ganesha Astro Consultancy') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Default Meta Description</label>
            <textarea name="default_meta_description" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ App\Models\SiteSetting::get('default_meta_description', 'Official website of Tamal Chakraborty, leading celebrity astrologer, Kundli specialist, and Vastu consultant in Kolkata, India.') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-[#541F1D] mb-1">Open Graph (OG) Image URL</label>
            <input type="text" name="og_image_url" value="{{ App\Models\SiteSetting::get('og_image_url', asset('images/astrotamal-logo.png')) }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Robots Indexing Directive</label>
                <select name="robots_directive" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
                    <option value="index, follow" {{ App\Models\SiteSetting::get('robots_directive') === 'index, follow' ? 'selected' : '' }}>index, follow (Allow Google Search)</option>
                    <option value="noindex, nofollow" {{ App\Models\SiteSetting::get('robots_directive') === 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow (Block Indexing)</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Google Site Verification Code</label>
                <input type="text" name="google_site_verification" value="{{ App\Models\SiteSetting::get('google_site_verification', '') }}" placeholder="e.g. google-site-verification=..." class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none">
            </div>
        </div>

        <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                Save SEO Settings
            </button>
        </div>
    </form>

</div>
@endsection
