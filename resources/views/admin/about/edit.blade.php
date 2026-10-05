@extends('admin.layouts.app')

@section('title', 'About Page CMS Management')

@section('content')
<div class="max-w-6xl mx-auto space-y-6" x-data="{ 
    activeTab: 'hero',
    editingGuidance: null,
    showGuidanceModal: false
}">

    <!-- Header Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs gap-4">
        <div>
            <div class="flex items-center space-x-2 text-xs font-bold text-[#C49A45] tracking-widest uppercase mb-1">
                <span>CMS Content Editor</span>
                <span>•</span>
                <span>Ganesha Astro Consultancy</span>
            </div>
            <h1 class="text-2xl font-bold font-serif-luxury text-[#541F1D]">About Page Management</h1>
            <p class="text-xs text-[#81766D] mt-1">Manage practitioner biography, philosophy, guidance areas, images, and section visibility.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('about') }}" target="_blank" class="px-4 py-2.5 rounded-xl text-xs font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] border border-[#C49A45]/30 flex items-center transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Live About Page
            </a>
        </div>
    </div>

    @if(session('status'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-3.5 rounded-xl text-xs font-semibold flex items-center justify-between shadow-xs">
            <div class="flex items-center">
                <svg class="w-4 h-4 text-emerald-600 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>{{ session('status') }}</span>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-xl text-xs space-y-1">
            <div class="font-bold mb-1">Please correct the following errors:</div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Navigation Tabs -->
    <div class="bg-[#FDFBF7] p-2 rounded-2xl border border-[#D8C6A8] shadow-xs overflow-x-auto flex space-x-2">
        <button @click="activeTab = 'hero'" 
                :class="activeTab === 'hero' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            About Hero
        </button>

        <button @click="activeTab = 'approach'" 
                :class="activeTab === 'approach' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Practitioner Biography
        </button>

        <button @click="activeTab = 'philosophy'" 
                :class="activeTab === 'philosophy' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Philosophy / Quote
        </button>

        <button @click="activeTab = 'guidance'" 
                :class="activeTab === 'guidance' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            Core Guidance Cards ({{ $guidanceItems->count() }})
        </button>

        <button @click="activeTab = 'methodology'" 
                :class="activeTab === 'methodology' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            Fundamentals & Language
        </button>

        <button @click="activeTab = 'visibility'" 
                :class="activeTab === 'visibility' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Section Visibility
        </button>

        <button @click="activeTab = 'seo'" 
                :class="activeTab === 'seo' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            SEO Settings
        </button>
    </div>

    <!-- TAB 1: ABOUT HERO SECTION -->
    <div x-show="activeTab === 'hero'" class="space-y-6">
        <form method="POST" action="{{ route('admin.about.settings.update') }}" enctype="multipart/form-data" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf
            <div>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">Edit About Hero Banner</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Customize the main top banner text, titles, description, and hero portrait image.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Eyebrow Badge Text</label>
                    <input type="text" name="about_hero_eyebrow" value="{{ \App\Models\SiteSetting::get('about_hero_eyebrow', 'ABOUT TAMAL CHAKRABORTY') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Main Title (Line 1)</label>
                    <input type="text" name="about_hero_title" value="{{ \App\Models\SiteSetting::get('about_hero_title', 'Understanding Astrology.') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Highlighted Subtitle (Italic Gold Line 2)</label>
                    <input type="text" name="about_hero_title_highlight" value="{{ \App\Models\SiteSetting::get('about_hero_title_highlight', 'Understanding Time.') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Hero Description Paragraph</label>
                    <textarea name="about_hero_description" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ \App\Models\SiteSetting::get('about_hero_description', 'Explore the approach, philosophy and work behind Astrologer Tamal Chakraborty\'s journey through astrology.') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Hero Image / Portrait</label>
                    <div class="flex items-center space-x-4">
                        @if(\App\Models\SiteSetting::get('about_hero_image'))
                            <img src="{{ asset(\App\Models\SiteSetting::get('about_hero_image', 'images/tamal_hero_portrait.jpg')) }}" alt="Hero Image" class="w-16 h-16 object-cover rounded-xl border border-[#D8C6A8]">
                        @endif
                        <input type="file" name="about_hero_image_file" accept="image/jpeg,image/png,image/webp" class="text-xs text-[#81766D] file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#EDE3D4] file:text-[#541F1D] hover:file:bg-[#D8C6A8]">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                    Save Hero Settings
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 2: PRACTITIONER BIOGRAPHY & APPROACH -->
    <div x-show="activeTab === 'approach'" class="space-y-6">
        <form method="POST" action="{{ route('admin.about.settings.update') }}" enctype="multipart/form-data" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf
            <div>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">Edit Practitioner Biography & Approach</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Customize the practitioner portrait image and narrative biography paragraphs.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Eyebrow</label>
                    <input type="text" name="about_approach_eyebrow" value="{{ \App\Models\SiteSetting::get('about_approach_eyebrow', 'OUR APPROACH') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Heading</label>
                    <input type="text" name="about_approach_heading" value="{{ \App\Models\SiteSetting::get('about_approach_heading', 'A Journey Through Astrology') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Biography Paragraph 1</label>
                    <textarea name="about_approach_paragraph1" rows="4" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ \App\Models\SiteSetting::get('about_approach_paragraph1', 'Tamal Chakraborty\'s public work reflects a deep interest in astrology, its foundational principles, and the logic behind its interpretation. Rather than presenting astrology as rigid prophecy, his approach centers on analyzing how planetary placements, birth charts, and time interact.') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Biography Paragraph 2</label>
                    <textarea name="about_approach_paragraph2" rows="4" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ \App\Models\SiteSetting::get('about_approach_paragraph2', 'His content explores astrology not simply as prediction, but as a subject involving birth charts, planetary positions, transits, and the understanding of time. Through clear chart analysis, the goal is to provide responsible, balanced astrological guidance.') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Portrait Image</label>
                    <div class="flex items-center space-x-4">
                        @if(\App\Models\SiteSetting::get('about_approach_image'))
                            <img src="{{ asset(\App\Models\SiteSetting::get('about_approach_image', 'images/tamal_hero_portrait.jpg')) }}" alt="Approach Image" class="w-16 h-16 object-cover rounded-xl border border-[#D8C6A8]">
                        @endif
                        <input type="file" name="about_approach_image_file" accept="image/jpeg,image/png,image/webp" class="text-xs text-[#81766D] file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#EDE3D4] file:text-[#541F1D] hover:file:bg-[#D8C6A8]">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                    Save Biography & Approach
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 3: PHILOSOPHY & TIME QUOTE -->
    <div x-show="activeTab === 'philosophy'" class="space-y-6">
        <form method="POST" action="{{ route('admin.about.settings.update') }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf
            <div>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">Edit Philosophy & Time Quote Banner</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Customize the burgundy background quote and philosophy statement.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Eyebrow</label>
                    <input type="text" name="about_philosophy_eyebrow" value="{{ \App\Models\SiteSetting::get('about_philosophy_eyebrow', 'PHILOSOPHY') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Quote Italic Highlight Phrase</label>
                    <input type="text" name="about_philosophy_quote_highlight" value="{{ \App\Models\SiteSetting::get('about_philosophy_quote_highlight', 'time speaks.') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Main Quote Text</label>
                    <textarea name="about_philosophy_quote" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ \App\Models\SiteSetting::get('about_philosophy_quote', '“Planets are not the only thing — time speaks. And I speak of time.”') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Supporting Philosophy Text</label>
                    <textarea name="about_philosophy_description" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ \App\Models\SiteSetting::get('about_philosophy_description', 'Understanding time, planetary transits, and changing periods is central to his approach to astrological guidance and decision-making clarity.') }}</textarea>
                </div>
            </div>

            <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                    Save Philosophy Quote
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 4: CORE GUIDANCE CARDS CRUD -->
    <div x-show="activeTab === 'guidance'" class="space-y-6">
        <div class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#D8C6A8]/40 mb-6">
                <div>
                    <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">Core Areas of Guidance Management</h2>
                    <p class="text-xs text-[#81766D] mt-0.5">Manage the 6 core guidance cards displayed on the About Page grid.</p>
                </div>
                <button @click="editingGuidance = null; showGuidanceModal = true" class="px-4 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-sm flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    + Add New Guidance Card
                </button>
            </div>

            <!-- Header Settings Form -->
            <form method="POST" action="{{ route('admin.about.settings.update') }}" class="mb-6 p-4 bg-[#EDE3D4]/30 rounded-xl border border-[#D8C6A8]/50 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Eyebrow Text</label>
                        <input type="text" name="about_guidance_eyebrow" value="{{ \App\Models\SiteSetting::get('about_guidance_eyebrow', 'CORE AREAS') }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Heading</label>
                        <input type="text" name="about_guidance_heading" value="{{ \App\Models\SiteSetting::get('about_guidance_heading', 'Areas of Astrological Guidance') }}" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] border border-[#C49A45]/30">
                        Save Section Headers
                    </button>
                </div>
            </form>

            <!-- CRUD Table -->
            <div class="w-full overflow-x-auto rounded-xl border border-[#D8C6A8]/60 bg-white shadow-xs">
                <table class="w-full text-left border-collapse text-xs align-middle">
                    <thead class="bg-[#351211] text-[#F7F0E3] font-serif-luxury uppercase tracking-wider text-[11px]">
                        <tr>
                            <th class="py-3.5 px-3.5 whitespace-nowrap">NO.</th>
                            <th class="py-3.5 px-3.5 whitespace-nowrap">TITLE</th>
                            <th class="py-3.5 px-3.5 whitespace-nowrap">DESCRIPTION</th>
                            <th class="py-3.5 px-3.5 whitespace-nowrap text-center">ORDER</th>
                            <th class="py-3.5 px-3.5 whitespace-nowrap text-center">STATUS</th>
                            <th class="py-3.5 px-3.5 whitespace-nowrap text-right">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8C6A8]/40">
                        @foreach($guidanceItems as $item)
                            <tr class="hover:bg-[#EDE3D4]/20 transition-colors">
                                <td class="py-3 px-3.5 font-mono font-bold text-[#C49A45] whitespace-nowrap">
                                    {{ $item->item_number }}
                                </td>
                                <td class="py-3 px-3.5 font-bold text-[#541F1D]">
                                    {{ $item->title }}
                                </td>
                                <td class="py-3 px-3.5 text-[#81766D] max-w-md">
                                    {{ $item->description }}
                                </td>
                                <td class="py-3 px-3.5 text-center font-bold text-[#C49A45] whitespace-nowrap">
                                    {{ $item->display_order }}
                                </td>
                                <td class="py-3 px-3.5 text-center whitespace-nowrap">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $item->is_active ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-slate-100 text-slate-600 border border-slate-300' }}">
                                        {{ $item->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="py-3 px-3.5 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center justify-end space-x-2">
                                        <button @click="editingGuidance = {{ json_encode($item) }}; showGuidanceModal = true" class="px-3 py-1.5 rounded-lg text-xs font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] transition-colors">
                                            Edit
                                        </button>
                                        <form method="POST" action="{{ route('admin.about.guidance.destroy', $item->id) }}" onsubmit="return confirm('Delete this guidance card?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition-colors">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB 5: FUNDAMENTALS & METHODOLOGY -->
    <div x-show="activeTab === 'methodology'" class="space-y-6">
        <form method="POST" action="{{ route('admin.about.settings.update') }}" enctype="multipart/form-data" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf
            <div>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">Edit Fundamentals & Language of Astrology Section</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Customize educational methodology details, concepts, and manuscript image.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Eyebrow</label>
                    <input type="text" name="about_methodology_eyebrow" value="{{ \App\Models\SiteSetting::get('about_methodology_eyebrow', 'FUNDAMENTALS & LOGIC') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Section Heading</label>
                    <input type="text" name="about_methodology_heading" value="{{ \App\Models\SiteSetting::get('about_methodology_heading', 'Exploring the Language of Astrology') }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Paragraph 1 (Concepts & Terminology)</label>
                    <textarea name="about_methodology_paragraph1" rows="4" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ \App\Models\SiteSetting::get('about_methodology_paragraph1', 'Tamal Chakraborty\'s public educational content explores foundational concepts such as Rashi, Lagna, Chandra Rashi, Rashichakra, planetary positions, birth charts, and transits.') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Paragraph 2 (Methodology Goal)</label>
                    <textarea name="about_methodology_paragraph2" rows="4" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ \App\Models\SiteSetting::get('about_methodology_paragraph2', 'This work reflects an ongoing interest in demystifying astrological structures and encouraging a logical, thoughtful understanding of how celestial movements are interpreted.') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Methodology / Manuscript Image</label>
                    <div class="flex items-center space-x-4">
                        @if(\App\Models\SiteSetting::get('about_methodology_image'))
                            <img src="{{ asset(\App\Models\SiteSetting::get('about_methodology_image', 'images/tamal_about_study.jpg')) }}" alt="Methodology Image" class="w-16 h-16 object-cover rounded-xl border border-[#D8C6A8]">
                        @endif
                        <input type="file" name="about_methodology_image_file" accept="image/jpeg,image/png,image/webp" class="text-xs text-[#81766D] file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#EDE3D4] file:text-[#541F1D] hover:file:bg-[#D8C6A8]">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                    Save Methodology Content
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 6: SECTION VISIBILITY TOGGLES -->
    <div x-show="activeTab === 'visibility'" class="space-y-6">
        <form method="POST" action="{{ route('admin.about.settings.update') }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf
            <div>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">About Page Section Visibility</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Enable or disable specific sections on the live public About Page.</p>
            </div>

            <div class="space-y-4">
                <!-- Hero Toggle -->
                <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-[#D8C6A8]/60">
                    <div>
                        <div class="text-sm font-bold text-[#541F1D]">1. About Hero Section</div>
                        <div class="text-xs text-[#81766D]">Displays top breadcrumbs, main heading, and compact portrait image.</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_about_hero_active" value="1" {{ \App\Models\SiteSetting::get('section_about_hero_active', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#541F1D]"></div>
                    </label>
                </div>

                <!-- Approach Toggle -->
                <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-[#D8C6A8]/60">
                    <div>
                        <div class="text-sm font-bold text-[#541F1D]">2. Practitioner Approach & Biography</div>
                        <div class="text-xs text-[#81766D]">Displays portrait photo and practitioner narrative biography.</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_about_approach_active" value="1" {{ \App\Models\SiteSetting::get('section_about_approach_active', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#541F1D]"></div>
                    </label>
                </div>

                <!-- Philosophy Toggle -->
                <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-[#D8C6A8]/60">
                    <div>
                        <div class="text-sm font-bold text-[#541F1D]">3. Philosophy & Time Quote Banner</div>
                        <div class="text-xs text-[#81766D]">Displays the deep burgundy philosophy quote section.</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_about_philosophy_active" value="1" {{ \App\Models\SiteSetting::get('section_about_philosophy_active', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#541F1D]"></div>
                    </label>
                </div>

                <!-- Guidance Toggle -->
                <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-[#D8C6A8]/60">
                    <div>
                        <div class="text-sm font-bold text-[#541F1D]">4. Areas of Astrological Guidance</div>
                        <div class="text-xs text-[#81766D]">Displays the 6 core areas of guidance cards grid.</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_about_guidance_active" value="1" {{ \App\Models\SiteSetting::get('section_about_guidance_active', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#541F1D]"></div>
                    </label>
                </div>

                <!-- Methodology Toggle -->
                <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-[#D8C6A8]/60">
                    <div>
                        <div class="text-sm font-bold text-[#541F1D]">5. Fundamentals & Language of Astrology</div>
                        <div class="text-xs text-[#81766D]">Displays classical Vedic concept breakdown and manuscript image.</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_about_methodology_active" value="1" {{ \App\Models\SiteSetting::get('section_about_methodology_active', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#541F1D]"></div>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                    Save Visibility Settings
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 7: SEO SETTINGS -->
    <div x-show="activeTab === 'seo'" class="space-y-6">
        <form method="POST" action="{{ route('admin.about.settings.update') }}" class="bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            @csrf
            <div>
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">About Page SEO Settings</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Customize browser title and meta description for search engine indexation.</p>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">SEO Title</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title', $page->seo_title) }}" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] mb-1">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="w-full px-3 py-2 text-xs bg-[#EDE3D4]/30 border border-[#D8C6A8] rounded-xl focus:outline-none">{{ old('meta_description', $page->meta_description) }}</textarea>
                </div>
            </div>

            <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#C49A45]/40 shadow-md">
                    Save SEO Settings
                </button>
            </div>
        </form>
    </div>

    <!-- MODAL: ADD/EDIT GUIDANCE CARD -->
    <div x-show="showGuidanceModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-xs" @click="showGuidanceModal = false"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-[#FDFBF7] rounded-2xl border border-[#D8C6A8] shadow-2xl max-w-lg w-full p-6 space-y-5">
                <div class="flex items-center justify-between border-b border-[#D8C6A8]/40 pb-3">
                    <h3 class="text-base font-bold font-serif-luxury text-[#541F1D]" x-text="editingGuidance ? 'Edit Guidance Card' : 'Add New Guidance Card'"></h3>
                    <button @click="showGuidanceModal = false" class="text-[#81766D] hover:text-[#541F1D]">✕</button>
                </div>

                <form method="POST" :action="editingGuidance ? '/admin-tamal/about/guidance/' + editingGuidance.id : '{{ route('admin.about.guidance.store') }}'" class="space-y-4">
                    @csrf
                    <template x-if="editingGuidance">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Card Number (e.g. 01, 02) *</label>
                        <input type="text" name="item_number" :value="editingGuidance ? editingGuidance.item_number : '07'" required class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Title *</label>
                        <input type="text" name="title" :value="editingGuidance ? editingGuidance.title : ''" required placeholder="Birth Chart Analysis" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#541F1D] mb-1">Description *</label>
                        <textarea name="description" rows="3" required placeholder="A detailed examination..." class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none" x-text="editingGuidance ? editingGuidance.description : ''"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Display Order</label>
                            <input type="number" name="display_order" :value="editingGuidance ? editingGuidance.display_order : 1" min="0" class="w-full px-3 py-2 text-xs bg-white border border-[#D8C6A8] rounded-xl focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#541F1D] mb-1">Status</label>
                            <label class="flex items-center space-x-2 mt-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" :checked="editingGuidance ? editingGuidance.is_active : true" class="rounded text-[#541F1D] focus:ring-0">
                                <span class="text-xs font-bold text-[#541F1D]">Active</span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#D8C6A8]/40 flex justify-end space-x-2">
                        <button type="button" @click="showGuidanceModal = false" class="px-4 py-2 rounded-xl text-xs font-semibold text-[#81766D] hover:bg-[#EDE3D4]">Cancel</button>
                        <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211]">Save Guidance Card</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
