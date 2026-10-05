@extends('admin.layouts.app')

@section('title', 'Global SEO & Open Graph Settings')

@section('content')
<div class="max-w-5xl mx-auto space-y-6 pb-12">

    <!-- Header Banner -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold font-serif-luxury text-[#541F1D]">Global SEO & Open Graph Settings</h1>
            <p class="text-xs sm:text-sm text-[#81766D] mt-1">Configure site-wide search meta tags, social sharing previews, search console verifications, and JSON-LD schema.</p>
        </div>
        <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] transition-colors shrink-0">
            ← Back to Settings
        </a>
    </div>

    <!-- Status Alert -->
    @if(session('status'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-xl font-medium flex items-center gap-2">
            <span>✅</span> {{ session('status') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-xl space-y-1">
            <span class="font-bold">Please correct the following errors:</span>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.seo.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- SECTION A: BASIC SEO -->
        <div class="bg-[#FDFBF7] p-6 sm:p-8 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            <div class="flex items-center gap-3 border-b border-[#D8C6A8]/40 pb-4">
                <span class="text-lg">🔍</span>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">A. Basic Search Engine Optimization</h2>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Default Meta Title <span class="text-rose-600">*</span></label>
                <input type="text" name="default_meta_title" value="{{ old('default_meta_title', App\Models\SiteSetting::get('default_meta_title', 'Tamal Chakraborty | Best Astrologer in Kolkata | Ganesha Astro Consultancy')) }}" required class="w-full px-3.5 py-2.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                <span class="text-[10px] text-[#81766D] mt-1 block">Default title tag used when a page does not specify a custom title.</span>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Default Meta Description</label>
                <textarea name="default_meta_description" rows="3" class="w-full px-3.5 py-2.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('default_meta_description', App\Models\SiteSetting::get('default_meta_description', 'Empowering individuals globally with ancient Vedic wisdom, accurate birth chart readings, and practical spiritual remedies for life\'s challenges.')) }}</textarea>
                <span class="text-[10px] text-[#81766D] mt-1 block">Default meta description shown in search engine results snippets.</span>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">Default Meta Keywords</label>
                <input type="text" name="default_keywords" value="{{ old('default_keywords', App\Models\SiteSetting::get('default_keywords', 'Vedic astrology, Astrologer in Kolkata, Kundli reading, Horoscope, Vastu consultant, Tamal Chakraborty')) }}" class="w-full px-3.5 py-2.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                <span class="text-[10px] text-[#81766D] mt-1 block">Comma-separated list of target search keywords.</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Canonical Base URL</label>
                    <input type="url" name="canonical_base_url" value="{{ old('canonical_base_url', App\Models\SiteSetting::get('canonical_base_url', 'https://astrotamal.com')) }}" class="w-full px-3.5 py-2.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    <span class="text-[10px] text-[#81766D] mt-1 block">Base URL used for canonical link tag.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Robots Directive <span class="text-rose-600">*</span></label>
                    @php $robots = App\Models\SiteSetting::get('robots_directive', 'index, follow'); @endphp
                    <select name="robots_directive" required class="w-full px-3.5 py-2.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                        <option value="index, follow" {{ $robots === 'index, follow' ? 'selected' : '' }}>index, follow (Allow Search Engines - Recommended)</option>
                        <option value="noindex, nofollow" {{ $robots === 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow (Block Indexing)</option>
                        <option value="index, nofollow" {{ $robots === 'index, nofollow' ? 'selected' : '' }}>index, nofollow (Index Page, Do not Follow Links)</option>
                        <option value="noindex, follow" {{ $robots === 'noindex, follow' ? 'selected' : '' }}>noindex, follow (Do not Index Page, Follow Links)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- SECTION B: SOCIAL / OPEN GRAPH & TWITTER/X -->
        <div class="bg-[#FDFBF7] p-6 sm:p-8 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            <div class="flex items-center gap-3 border-b border-[#D8C6A8]/40 pb-4">
                <span class="text-lg">🌐</span>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">B. Social Sharing (Open Graph & Twitter/X)</h2>
            </div>

            <!-- Open Graph -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Facebook / Open Graph Defaults</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">OG Title</label>
                        <input type="text" name="og_title" value="{{ old('og_title', App\Models\SiteSetting::get('og_title', '')) }}" placeholder="Same as Default Meta Title if empty" class="w-full px-3.5 py-2.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">OG Description</label>
                        <input type="text" name="og_description" value="{{ old('og_description', App\Models\SiteSetting::get('og_description', '')) }}" placeholder="Same as Default Meta Description if empty" class="w-full px-3.5 py-2.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    </div>
                </div>

                <div class="p-4 bg-[#EDE3D4]/30 border border-[#D8C6A8]/60 rounded-xl space-y-3">
                    <label class="block text-xs font-bold text-[#541F1D]">Open Graph Sharing Image</label>
                    @php $ogImg = App\Models\SiteSetting::get('og_image', 'images/astrotamal-logo.png'); @endphp
                    @if($ogImg)
                        <div class="flex items-center gap-3">
                            <img src="{{ asset($ogImg) }}" alt="OG Preview" class="h-14 max-w-[160px] object-cover rounded-lg border border-[#C49A45]/40 shadow-xs">
                            <span class="text-[11px] text-[#81766D]">Current OG image preview</span>
                        </div>
                    @endif
                    <input type="file" name="og_image_file" accept="image/jpeg,image/png,image/webp" class="block w-full text-xs text-[#81766D] file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#541F1D] file:text-[#F7F0E3]">
                    <span class="text-[10px] text-[#81766D] block">Recommended dimensions: 1200x630px (JPG, PNG, WEBP).</span>
                </div>
            </div>

            <!-- Twitter / X -->
            <div class="space-y-4 pt-4 border-t border-[#D8C6A8]/40">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">Twitter / X Card Defaults</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Twitter Card Type</label>
                        @php $twCard = App\Models\SiteSetting::get('twitter_card_type', 'summary_large_image'); @endphp
                        <select name="twitter_card_type" class="w-full px-3.5 py-2.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                            <option value="summary_large_image" {{ $twCard === 'summary_large_image' ? 'selected' : '' }}>summary_large_image (Large banner card)</option>
                            <option value="summary" {{ $twCard === 'summary' ? 'selected' : '' }}>summary (Small thumbnail card)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Twitter Title</label>
                        <input type="text" name="twitter_title" value="{{ old('twitter_title', App\Models\SiteSetting::get('twitter_title', '')) }}" placeholder="Same as OG Title if empty" class="w-full px-3.5 py-2.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Twitter Description</label>
                        <input type="text" name="twitter_description" value="{{ old('twitter_description', App\Models\SiteSetting::get('twitter_description', '')) }}" placeholder="Same as OG Description if empty" class="w-full px-3.5 py-2.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    </div>
                </div>

                <div class="p-4 bg-[#EDE3D4]/30 border border-[#D8C6A8]/60 rounded-xl space-y-3">
                    <label class="block text-xs font-bold text-[#541F1D]">Twitter Card Image (Optional)</label>
                    @php $twImg = App\Models\SiteSetting::get('twitter_image'); @endphp
                    @if($twImg)
                        <div class="flex items-center gap-3">
                            <img src="{{ asset($twImg) }}" alt="Twitter Preview" class="h-14 max-w-[160px] object-cover rounded-lg border border-[#C49A45]/40 shadow-xs">
                            <span class="text-[11px] text-[#81766D]">Current Twitter image</span>
                        </div>
                    @endif
                    <input type="file" name="twitter_image_file" accept="image/jpeg,image/png,image/webp" class="block w-full text-xs text-[#81766D] file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#541F1D] file:text-[#F7F0E3]">
                    <span class="text-[10px] text-[#81766D] block">Fallback to Open Graph image if left empty.</span>
                </div>
            </div>
        </div>

        <!-- SECTION C: SEARCH ENGINE VERIFICATIONS -->
        <div class="bg-[#FDFBF7] p-6 sm:p-8 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            <div class="flex items-center gap-3 border-b border-[#D8C6A8]/40 pb-4">
                <span class="text-lg">🛡️</span>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">C. Search Engine Verification Meta Tokens</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Google Site Verification Code</label>
                    <input type="text" name="google_site_verification" value="{{ old('google_site_verification', App\Models\SiteSetting::get('google_site_verification', '')) }}" placeholder="e.g. google-site-verification-token" class="w-full px-3.5 py-2.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    <span class="text-[10px] text-[#81766D] mt-1 block">Renders google-site-verification meta tag.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Bing Webmaster Verification Code</label>
                    <input type="text" name="bing_site_verification" value="{{ old('bing_site_verification', App\Models\SiteSetting::get('bing_site_verification', '')) }}" placeholder="e.g. bing-msvalidate-token" class="w-full px-3.5 py-2.5 text-xs bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    <span class="text-[10px] text-[#81766D] mt-1 block">Renders msvalidate.01 meta tag.</span>
                </div>
            </div>
        </div>

        <!-- SECTION D: SITE-WIDE STRUCTURED DATA (JSON-LD) -->
        <div class="bg-[#FDFBF7] p-6 sm:p-8 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            <div class="flex items-center gap-3 border-b border-[#D8C6A8]/40 pb-4">
                <span class="text-lg">📊</span>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">D. Site-Wide Structured Data (JSON-LD)</h2>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#541F1D] mb-1">JSON-LD Schema Markup</label>
                <textarea name="json_ld_schema" rows="6" placeholder='{
  "@@context": "https://schema.org",
  "@@type": "LocalBusiness",
  "name": "Ganesha Astro Consultancy",
  "url": "https://astrotamal.com"
}' class="w-full px-3.5 py-2.5 text-xs font-mono bg-[#EDE3D4]/40 border border-[#D8C6A8] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('json_ld_schema', App\Models\SiteSetting::get('json_ld_schema', '')) }}</textarea>
                <span class="text-[10px] text-[#81766D] mt-1 block">Optional JSON-LD schema payload. Automatically injected into ld+json script tag.</span>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 flex justify-end">
            <button type="submit" class="px-8 py-3.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-lg transition-all transform hover:-translate-y-0.5">
                💾 SAVE SEO SETTINGS
            </button>
        </div>
    </form>

</div>
@endsection
