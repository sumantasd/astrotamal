@extends('admin.layouts.app')

@section('title', 'General Website Settings')

@section('content')
<div class="max-w-5xl mx-auto space-y-6 pb-12">

    <!-- Header Banner -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between bg-[#FFFFFF] p-6 rounded-2xl border border-[#C8D8CF] shadow-xs gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold font-serif-luxury text-[#0B3D2E]">General Website Settings</h1>
            <p class="text-xs sm:text-sm text-[#60736B] mt-1">Manage global website identity, official contact details, business information, and website behaviour.</p>
        </div>
        <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#0B3D2E] bg-[#E8F1EC] hover:bg-[#C3E8D2] transition-colors shrink-0">
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

    <form method="POST" action="{{ route('admin.settings.general.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- SECTION A: WEBSITE IDENTITY -->
        <div class="bg-[#FFFFFF] p-6 sm:p-8 rounded-2xl border border-[#C8D8CF] shadow-xs space-y-6">
            <div class="flex items-center gap-3 border-b border-[#C8D8CF]/40 pb-4">
                <span class="text-lg">🆔</span>
                <h2 class="text-lg font-bold font-serif-luxury text-[#0B3D2E]">A. Website Identity</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Website / Brand Name <span class="text-rose-600">*</span></label>
                    <input type="text" name="site_name" value="{{ old('site_name', App\Models\SiteSetting::get('site_name', 'Ganesha Astro Consultancy')) }}" required class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    <span class="text-[10px] text-[#60736B] mt-1 block">Global site title used across headers, footers, and brand tags.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Site Tagline / Subtitle</label>
                    <input type="text" name="site_tagline" value="{{ old('site_tagline', App\Models\SiteSetting::get('site_tagline', 'Tamal Chakraborty — Celebrity Astrologer & Vastu Expert')) }}" class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    <span class="text-[10px] text-[#60736B] mt-1 block">Subtitle displayed in hero sections or header titles.</span>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Short Description</label>
                <textarea name="site_description" rows="2" class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('site_description', App\Models\SiteSetting::get('site_description', 'Empowering individuals globally with ancient Vedic wisdom, accurate birth chart readings, and practical spiritual remedies for life\'s challenges.')) }}</textarea>
                <span class="text-[10px] text-[#60736B] mt-1 block">Brief summary used in footer bio and brand section.</span>
            </div>

            <!-- Uploads: Logo & Favicon -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2">
                <div class="p-4 bg-[#F3F8F5] border border-[#C8D8CF]/60 rounded-xl space-y-3">
                    <label class="block text-xs font-bold text-[#0B3D2E]">Website Logo</label>
                    @php $logo = App\Models\SiteSetting::get('site_logo', 'images/ganesha-logo.png'); @endphp
                    @if($logo)
                        <div class="flex items-center gap-3">
                            <img src="{{ asset($logo) }}" alt="Current Logo" class="h-10 max-w-[120px] object-contain bg-[#0B3D2E] p-1.5 rounded-lg border border-[#C49A45]/40">
                            <span class="text-[11px] text-[#60736B]">Current logo</span>
                        </div>
                    @endif
                    <input type="file" name="logo_file" accept="image/jpeg,image/png,image/webp,image/svg+xml" class="block w-full text-xs text-[#60736B] file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#0B3D2E] file:text-[#FFFFFF]">
                    <span class="text-[10px] text-[#60736B] block">Supported formats: JPG, PNG, WEBP, SVG (Max: 2MB).</span>
                </div>

                <div class="p-4 bg-[#F3F8F5] border border-[#C8D8CF]/60 rounded-xl space-y-3">
                    <label class="block text-xs font-bold text-[#0B3D2E]">Browser Favicon</label>
                    @php $favicon = App\Models\SiteSetting::get('site_favicon', 'images/ganesha-logo.png'); @endphp
                    @if($favicon)
                        <div class="flex items-center gap-3">
                            <img src="{{ asset($favicon) }}" alt="Current Favicon" class="w-8 h-8 object-contain bg-[#0B3D2E] p-1 rounded-md border border-[#C49A45]/40">
                            <span class="text-[11px] text-[#60736B]">Current favicon</span>
                        </div>
                    @endif
                    <input type="file" name="favicon_file" accept="image/jpeg,image/png,image/webp,image/x-icon" class="block w-full text-xs text-[#60736B] file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#0B3D2E] file:text-[#FFFFFF]">
                    <span class="text-[10px] text-[#60736B] block">Supported formats: PNG, ICO, WEBP (Max: 1MB).</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2">
                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Default Language</label>
                    <input type="text" name="default_language" value="{{ old('default_language', App\Models\SiteSetting::get('default_language', 'en')) }}" class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Timezone</label>
                    <input type="text" name="default_timezone" value="{{ old('default_timezone', App\Models\SiteSetting::get('default_timezone', 'Asia/Kolkata')) }}" class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                </div>
            </div>
        </div>

        <!-- SECTION B: BUSINESS CONTACT -->
        <div class="bg-[#FFFFFF] p-6 sm:p-8 rounded-2xl border border-[#C8D8CF] shadow-xs space-y-6">
            <div class="flex items-center gap-3 border-b border-[#C8D8CF]/40 pb-4">
                <span class="text-lg">📞</span>
                <h2 class="text-lg font-bold font-serif-luxury text-[#0B3D2E]">B. Business Contact Details</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Official Phone Number <span class="text-rose-600">*</span></label>
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', App\Models\SiteSetting::get('contact_phone', '8392059201')) }}" required class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    <span class="text-[10px] text-[#60736B] mt-1 block">Renders as tel: link across header, footer & pre-footer.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">WhatsApp Number <span class="text-rose-600">*</span></label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', App\Models\SiteSetting::get('whatsapp_number', '8392059201')) }}" required class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                    <span class="text-[10px] text-[#60736B] mt-1 block">Renders as WhatsApp chat link publicly.</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Official Email Address <span class="text-rose-600">*</span></label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', App\Models\SiteSetting::get('contact_email', 'ganesha4astro@gmail.com')) }}" required class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Website URL</label>
                    <input type="url" name="website_url" value="{{ old('website_url', App\Models\SiteSetting::get('website_url', 'https://astrotamal.com')) }}" class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Office / Chamber Address <span class="text-rose-600">*</span></label>
                <textarea name="office_address" rows="2" required class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">{{ old('office_address', App\Models\SiteSetting::get('office_address', 'Kolkata | Bongaon | Ranaghat & More')) }}</textarea>
            </div>
        </div>

        <!-- SECTION C: BUSINESS INFORMATION -->
        <div class="bg-[#FFFFFF] p-6 sm:p-8 rounded-2xl border border-[#C8D8CF] shadow-xs space-y-6">
            <div class="flex items-center gap-3 border-b border-[#C8D8CF]/40 pb-4">
                <span class="text-lg">🏛️</span>
                <h2 class="text-lg font-bold font-serif-luxury text-[#0B3D2E]">C. Business Information</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Business Name</label>
                    <input type="text" name="business_name" value="{{ old('business_name', App\Models\SiteSetting::get('business_name', 'Ganesha Astro Consultancy')) }}" class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Contact Person</label>
                    <input type="text" name="contact_person" value="{{ old('contact_person', App\Models\SiteSetting::get('contact_person', 'Tamal Chakraborty')) }}" class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Google Maps URL</label>
                <input type="url" name="google_maps_url" value="{{ old('google_maps_url', App\Models\SiteSetting::get('google_maps_url', '')) }}" placeholder="https://maps.google.com/..." class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                <span class="text-[10px] text-[#60736B] mt-1 block">Optional Google Maps URL for office directions.</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Business Hours</label>
                    <input type="text" name="business_hours" value="{{ old('business_hours', App\Models\SiteSetting::get('business_hours', 'Mon - Sun: 10:00 AM - 08:00 PM')) }}" class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Consultation Availability</label>
                    <input type="text" name="consultation_availability" value="{{ old('consultation_availability', App\Models\SiteSetting::get('consultation_availability', 'By Appointment Only (Online & Chamber)')) }}" class="w-full px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
                </div>
            </div>
        </div>

        <!-- SECTION D: WEBSITE BEHAVIOUR -->
        <div class="bg-[#FFFFFF] p-6 sm:p-8 rounded-2xl border border-[#C8D8CF] shadow-xs space-y-6">
            <div class="flex items-center gap-3 border-b border-[#C8D8CF]/40 pb-4">
                <span class="text-lg">⚙️</span>
                <h2 class="text-lg font-bold font-serif-luxury text-[#0B3D2E]">D. Website Behaviour</h2>
            </div>

            <div class="p-5 bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="block text-sm font-bold text-[#0B3D2E]">Maintenance Mode</span>
                    <p class="text-xs text-[#60736B] mt-0.5">When enabled, public visitors see a maintenance page. Administrators retain full access to `/admin-tamal`.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                    <input type="hidden" name="maintenance_mode" value="0">
                    <input type="checkbox" name="maintenance_mode" value="1" {{ App\Models\SiteSetting::get('maintenance_mode', '0') == '1' ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0B3D2E]"></div>
                </label>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#0B3D2E] mb-1">Default Items Per Page (Pagination)</label>
                <input type="number" name="default_pagination" min="1" max="100" value="{{ old('default_pagination', App\Models\SiteSetting::get('default_pagination', '12')) }}" class="w-48 px-3.5 py-2.5 text-xs bg-[#E8F1EC]/60 border border-[#C8D8CF] rounded-xl focus:outline-none focus:border-[#C49A45]">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 flex justify-end">
            <button type="submit" class="px-8 py-3.5 rounded-xl text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] border border-[#C49A45]/40 shadow-lg transition-all transform hover:-translate-y-0.5">
                💾 SAVE GENERAL SETTINGS
            </button>
        </div>
    </form>

</div>
@endsection
