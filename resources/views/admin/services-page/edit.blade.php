@extends('admin.layouts.app')

@section('title', 'Services Page CMS Management')

@section('content')
<div class="max-w-6xl mx-auto space-y-6" x-data="{ 
    activeTab: 'hero',
    toggles: {
        section_services_hero_active: {{ \App\Models\SiteSetting::get('section_services_hero_active', '1') == '1' ? 'true' : 'false' }},
        section_services_intro_header_active: {{ \App\Models\SiteSetting::get('section_services_intro_header_active', '1') == '1' ? 'true' : 'false' }},
        section_services_quick_booking_active: {{ \App\Models\SiteSetting::get('section_services_quick_booking_active', '1') == '1' ? 'true' : 'false' }},
        services_urgent_active: {{ \App\Models\SiteSetting::get('services_urgent_active', '1') == '1' ? 'true' : 'false' }},
        services_normal_active: {{ \App\Models\SiteSetting::get('services_normal_active', '1') == '1' ? 'true' : 'false' }},
        services_phone_active: {{ \App\Models\SiteSetting::get('services_phone_active', '1') == '1' ? 'true' : 'false' }},
        services_kundli_active: {{ \App\Models\SiteSetting::get('services_kundli_active', '1') == '1' ? 'true' : 'false' }},
        services_remedy_active: {{ \App\Models\SiteSetting::get('services_remedy_active', '1') == '1' ? 'true' : 'false' }},
        section_services_editorial_active: {{ \App\Models\SiteSetting::get('section_services_editorial_active', '1') == '1' ? 'true' : 'false' }},
        section_services_catalogue_active: {{ \App\Models\SiteSetting::get('section_services_catalogue_active', '1') == '1' ? 'true' : 'false' }},
        section_services_featured_active: {{ \App\Models\SiteSetting::get('section_services_featured_active', '1') == '1' ? 'true' : 'false' }},
        section_services_exploration_active: {{ \App\Models\SiteSetting::get('section_services_exploration_active', '1') == '1' ? 'true' : 'false' }},
        section_services_process_active: {{ \App\Models\SiteSetting::get('section_services_process_active', '1') == '1' ? 'true' : 'false' }},
        section_services_faq_active: {{ \App\Models\SiteSetting::get('section_services_faq_active', '1') == '1' ? 'true' : 'false' }}
    }
}">

    <!-- Header Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between bg-[#FDFBF7] p-6 rounded-2xl border border-[#D8C6A8] shadow-xs gap-4">
        <div>
            <div class="flex items-center space-x-2 text-xs font-bold text-[#C49A45] tracking-widest uppercase mb-1">
                <span>CMS Content Editor</span>
                <span>•</span>
                <span>Ganesha Astro Consultancy</span>
            </div>
            <h1 class="text-2xl font-bold font-serif-luxury text-[#541F1D]">Services Page Management</h1>
            <p class="text-xs text-[#81766D] mt-1">Manage section order, individual section ON/OFF visibility, Quick Booking details, content, and SEO.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('services.index') }}" target="_blank" class="px-4 py-2.5 rounded-xl text-xs font-bold text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] border border-[#C49A45]/30 flex items-center transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Live Services Page
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
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
            1. Services Hero
        </button>

        <button @click="activeTab = 'intro_booking'" 
                :class="activeTab === 'intro_booking' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            2. Quick Booking & Intro
        </button>

        <button @click="activeTab = 'content_sections'" 
                :class="activeTab === 'content_sections' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            3. Page Sections
        </button>

        <button @click="activeTab = 'visibility'" 
                :class="activeTab === 'visibility' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Master Visibility (ON/OFF)
        </button>

        <button @click="activeTab = 'seo'" 
                :class="activeTab === 'seo' ? 'bg-[#541F1D] text-[#F7F0E3] font-bold shadow-md' : 'text-[#541F1D] hover:bg-[#EDE3D4]/60 font-semibold'" 
                class="px-4 py-2.5 rounded-xl text-xs transition-all whitespace-nowrap flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            SEO Settings
        </button>
    </div>

    <!-- MAIN FORM -->
    <form action="{{ route('admin.services-page.settings.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- TAB 1: SERVICES HERO -->
        <div x-show="activeTab === 'hero'" x-cloak class="bg-[#FDFBF7] p-6 sm:p-8 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            <div class="border-b border-[#D8C6A8] pb-4 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">1. Services Hero Section (Top Banner)</h2>
                    <p class="text-xs text-[#81766D] mt-0.5">Topmost hero banner containing breadcrumb, main heading, and celestial visual.</p>
                </div>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="section_services_hero_active" value="1" x-model="toggles.section_services_hero_active" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    <span class="ml-2.5 text-xs font-bold text-[#541F1D]" x-text="toggles.section_services_hero_active ? 'Section ON' : 'Section OFF'"></span>
                </label>
            </div>

            <div class="grid grid-cols-1 gap-5">
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] uppercase tracking-wider mb-2">Eyebrow Badge</label>
                    <input type="text" 
                           name="services_hero_eyebrow" 
                           value="{{ \App\Models\SiteSetting::get('services_hero_eyebrow', 'ASTROLOGICAL GUIDANCE') }}" 
                           class="w-full px-4 py-2.5 rounded-xl bg-white border border-[#D8C6A8] text-xs font-semibold text-[#29211F] focus:border-[#C49A45] focus:outline-none shadow-xs">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] uppercase tracking-wider mb-2">Hero Main Heading</label>
                    <input type="text" 
                           name="services_hero_heading" 
                           value="{{ \App\Models\SiteSetting::get('services_hero_heading', 'Guidance For The Important Questions In Life') }}" 
                           class="w-full px-4 py-2.5 rounded-xl bg-white border border-[#D8C6A8] text-sm font-bold text-[#29211F] focus:border-[#C49A45] focus:outline-none shadow-xs">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] uppercase tracking-wider mb-2">Supporting Description</label>
                    <textarea name="services_hero_description" 
                              rows="3" 
                              class="w-full px-4 py-2.5 rounded-xl bg-white border border-[#D8C6A8] text-xs leading-relaxed text-[#29211F] focus:border-[#C49A45] focus:outline-none shadow-xs">{{ \App\Models\SiteSetting::get('services_hero_description', 'Explore astrology-based guidance around birth charts, planetary timing, career, business, life direction and astrology learning.') }}</textarea>
                </div>
            </div>
        </div>

        <!-- TAB 2: SERVICES INTRO & QUICK BOOKING -->
        <div x-show="activeTab === 'intro_booking'" x-cloak class="bg-[#FDFBF7] p-6 sm:p-8 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            <div class="border-b border-[#D8C6A8] pb-4">
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">2. Services Intro & Quick Booking Cards</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Manage Bengali heading, Quick Booking cards, Phone consultation, and Kundli/Remedy info blocks.</p>
            </div>

            <!-- INTRO HEADER -->
            <div class="p-5 rounded-2xl border border-[#D8C6A8] bg-[#F9F5EE] space-y-4">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
                    <span class="text-xs font-bold text-[#541F1D] uppercase tracking-wider">Services Intro Heading Block</span>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_services_intro_header_active" value="1" x-model="toggles.section_services_intro_header_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                        <span class="ml-2 text-xs font-semibold text-[#541F1D]" x-text="toggles.section_services_intro_header_active ? 'Active' : 'Inactive'"></span>
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-[#541F1D] uppercase mb-1">Eyebrow</label>
                        <input type="text" name="services_intro_eyebrow" value="{{ \App\Models\SiteSetting::get('services_intro_eyebrow', 'SERVICES') }}" class="w-full px-3 py-2 rounded-lg bg-white border border-[#D8C6A8] text-xs focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-[#541F1D] uppercase mb-1">Main Heading (Bengali)</label>
                        <input type="text" name="services_intro_heading" value="{{ \App\Models\SiteSetting::get('services_intro_heading', 'আমাদের পরিষেবা') }}" class="w-full px-3 py-2 rounded-lg bg-white border border-[#D8C6A8] text-xs font-bold focus:outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-bold text-[#541F1D] uppercase mb-1">Description / Audio Call Note</label>
                        <textarea name="services_intro_description" rows="2" class="w-full px-3 py-2 rounded-lg bg-white border border-[#D8C6A8] text-xs focus:outline-none">{{ \App\Models\SiteSetting::get('services_intro_description', 'সব consultation বর্তমানে audio/voice call-এ হয়। Prediction over the phone call only.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- QUICK BOOKING CARDS BLOCK -->
            <div class="p-5 rounded-2xl border border-[#D8C6A8] bg-[#F9F5EE] space-y-4">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-3">
                    <span class="text-xs font-bold text-[#541F1D] uppercase tracking-wider">⚡ Quick Booking Block (Entire Left Column)</span>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_services_quick_booking_active" value="1" x-model="toggles.section_services_quick_booking_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                        <span class="ml-2 text-xs font-semibold text-[#541F1D]" x-text="toggles.section_services_quick_booking_active ? 'Block Active' : 'Block Inactive'"></span>
                    </label>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-[#541F1D] uppercase mb-1">Quick Booking Card Heading</label>
                    <input type="text" name="services_qb_heading" value="{{ \App\Models\SiteSetting::get('services_qb_heading', '⚡ QUICK BOOKING') }}" class="w-full px-3 py-2 rounded-lg bg-white border border-[#D8C6A8] text-xs font-bold focus:outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <!-- Urgent Card -->
                    <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-[#541F1D]">Urgent Card</span>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="services_urgent_active" value="1" x-model="toggles.services_urgent_active" class="sr-only peer">
                                <div class="w-7 h-4 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                            </label>
                        </div>
                        <input type="text" name="services_urgent_title" value="{{ \App\Models\SiteSetting::get('services_urgent_title', 'Urgent Consultation') }}" class="w-full px-3 py-1.5 rounded bg-[#FDFBF7] border border-[#D8C6A8] text-xs font-bold focus:outline-none" placeholder="Title">
                        <input type="text" name="services_urgent_subtitle" value="{{ \App\Models\SiteSetting::get('services_urgent_subtitle', 'Appointment should be within 24 hours') }}" class="w-full px-3 py-1.5 rounded bg-[#FDFBF7] border border-[#D8C6A8] text-xs focus:outline-none" placeholder="Subtitle">
                        <input type="text" name="services_urgent_price" value="{{ \App\Models\SiteSetting::get('services_urgent_price', '₹5,000') }}" class="w-full px-3 py-1.5 rounded bg-[#FDFBF7] border border-[#D8C6A8] text-xs font-extrabold focus:outline-none" placeholder="Price Display">
                    </div>

                    <!-- Normal Card -->
                    <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-[#351211]">Normal Card</span>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="services_normal_active" value="1" x-model="toggles.services_normal_active" class="sr-only peer">
                                <div class="w-7 h-4 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                            </label>
                        </div>
                        <input type="text" name="services_normal_title" value="{{ \App\Models\SiteSetting::get('services_normal_title', 'Normal Consultation') }}" class="w-full px-3 py-1.5 rounded bg-[#FDFBF7] border border-[#D8C6A8] text-xs font-bold focus:outline-none" placeholder="Title">
                        <input type="text" name="services_normal_subtitle" value="{{ \App\Models\SiteSetting::get('services_normal_subtitle', 'Appointment within one week') }}" class="w-full px-3 py-1.5 rounded bg-[#FDFBF7] border border-[#D8C6A8] text-xs focus:outline-none" placeholder="Subtitle">
                        <input type="text" name="services_normal_price" value="{{ \App\Models\SiteSetting::get('services_normal_price', '₹3,000') }}" class="w-full px-3 py-1.5 rounded bg-[#FDFBF7] border border-[#D8C6A8] text-xs font-extrabold focus:outline-none" placeholder="Price Display">
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN CARDS (PHONE, KUNDLI, REMEDY) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Phone Card -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-[#F9F5EE] space-y-3">
                    <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-2">
                        <span class="text-xs font-bold text-[#541F1D]">🔮 Phone Card</span>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="services_phone_active" value="1" x-model="toggles.services_phone_active" class="sr-only peer">
                            <div class="w-7 h-4 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                        </label>
                    </div>
                    <input type="text" name="services_phone_heading" value="{{ \App\Models\SiteSetting::get('services_phone_heading', 'ফোনে বিচার') }}" class="w-full px-3 py-1.5 rounded bg-white border border-[#D8C6A8] text-xs font-bold focus:outline-none" placeholder="Heading">
                    <input type="text" name="services_phone_btn_text" value="{{ \App\Models\SiteSetting::get('services_phone_btn_text', '💬 WhatsApp Us') }}" class="w-full px-3 py-1.5 rounded bg-white border border-[#D8C6A8] text-xs focus:outline-none" placeholder="Btn Label">
                    <input type="text" name="services_phone_btn_url" value="{{ \App\Models\SiteSetting::get('services_phone_btn_url', 'https://wa.me/918392059201') }}" class="w-full px-3 py-1.5 rounded bg-white border border-[#D8C6A8] text-xs focus:outline-none" placeholder="Btn URL">
                </div>

                <!-- Kundli Block -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-[#F9F5EE] space-y-3">
                    <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-2">
                        <span class="text-xs font-bold text-[#541F1D]">🔮 Kundli Block</span>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="services_kundli_active" value="1" x-model="toggles.services_kundli_active" class="sr-only peer">
                            <div class="w-7 h-4 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                        </label>
                    </div>
                    <input type="text" name="services_kundli_heading" value="{{ \App\Models\SiteSetting::get('services_kundli_heading', 'Kundli') }}" class="w-full px-3 py-1.5 rounded bg-white border border-[#D8C6A8] text-xs font-bold focus:outline-none" placeholder="Heading">
                    <textarea name="services_kundli_description" rows="2" class="w-full px-3 py-1.5 rounded bg-white border border-[#D8C6A8] text-xs focus:outline-none" placeholder="Description">{{ \App\Models\SiteSetting::get('services_kundli_description', 'Kundli preparation and reading, discussed during your consultation call.') }}</textarea>
                </div>

                <!-- Remedy Block -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-[#F9F5EE] space-y-3">
                    <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-2">
                        <span class="text-xs font-bold text-[#541F1D]">💊 Remedy Block</span>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="services_remedy_active" value="1" x-model="toggles.services_remedy_active" class="sr-only peer">
                            <div class="w-7 h-4 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                        </label>
                    </div>
                    <input type="text" name="services_remedy_heading" value="{{ \App\Models\SiteSetting::get('services_remedy_heading', 'Remedy Suggestion') }}" class="w-full px-3 py-1.5 rounded bg-white border border-[#D8C6A8] text-xs font-bold focus:outline-none" placeholder="Heading">
                    <textarea name="services_remedy_description" rows="2" class="w-full px-3 py-1.5 rounded bg-white border border-[#D8C6A8] text-xs focus:outline-none" placeholder="Description">{{ \App\Models\SiteSetting::get('services_remedy_description', 'Remedy suggestions where applicable. Prediction over the phone call only.') }}</textarea>
                </div>
            </div>
        </div>

        <!-- TAB 3: OTHER PAGE SECTIONS CONTENT & TOGGLES -->
        <div x-show="activeTab === 'content_sections'" x-cloak class="bg-[#FDFBF7] p-6 sm:p-8 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            <div class="border-b border-[#D8C6A8] pb-4">
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">3. Remaining Page Sections</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Manage editorial introduction, core services catalogue, featured birth chart, exploration areas, process & FAQ.</p>
            </div>

            <!-- EDITORIAL INTRO -->
            <div class="p-5 rounded-2xl border border-[#D8C6A8] bg-[#F9F5EE] space-y-3">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-2">
                    <span class="text-xs font-bold text-[#541F1D] uppercase">Editorial Introduction Section</span>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_services_editorial_active" value="1" x-model="toggles.section_services_editorial_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                        <span class="ml-2 text-xs font-semibold text-[#541F1D]" x-text="toggles.section_services_editorial_active ? 'Active' : 'Inactive'"></span>
                    </label>
                </div>
                <input type="text" name="services_editorial_heading" value="{{ \App\Models\SiteSetting::get('services_editorial_heading', 'Astrology With Context, Timing & Understanding') }}" class="w-full px-3 py-2 rounded-lg bg-white border border-[#D8C6A8] text-xs font-bold focus:outline-none" placeholder="Heading">
                <textarea name="services_editorial_description" rows="2" class="w-full px-3 py-2 rounded-lg bg-white border border-[#D8C6A8] text-xs focus:outline-none" placeholder="Description">{{ \App\Models\SiteSetting::get('services_editorial_description', 'Through birth-chart analysis, planetary transits and the study of time, explore an astrological perspective on important phases, questions and decisions in life.') }}</textarea>
            </div>

            <!-- CORE CATALOGUE -->
            <div class="p-5 rounded-2xl border border-[#D8C6A8] bg-[#F9F5EE] space-y-3">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-2">
                    <span class="text-xs font-bold text-[#541F1D] uppercase">Core Services Catalogue Section</span>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_services_catalogue_active" value="1" x-model="toggles.section_services_catalogue_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                        <span class="ml-2 text-xs font-semibold text-[#541F1D]" x-text="toggles.section_services_catalogue_active ? 'Active' : 'Inactive'"></span>
                    </label>
                </div>
                <input type="text" name="services_catalogue_heading" value="{{ \App\Models\SiteSetting::get('services_catalogue_heading', 'Core Astrological Consultations') }}" class="w-full px-3 py-2 rounded-lg bg-white border border-[#D8C6A8] text-xs font-bold focus:outline-none">
            </div>

            <!-- FEATURED SERVICE -->
            <div class="p-5 rounded-2xl border border-[#D8C6A8] bg-[#F9F5EE] space-y-3">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-2">
                    <span class="text-xs font-bold text-[#541F1D] uppercase">Featured Birth Chart Service Section</span>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_services_featured_active" value="1" x-model="toggles.section_services_featured_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                        <span class="ml-2 text-xs font-semibold text-[#541F1D]" x-text="toggles.section_services_featured_active ? 'Active' : 'Inactive'"></span>
                    </label>
                </div>
                <input type="text" name="services_featured_heading" value="{{ \App\Models\SiteSetting::get('services_featured_heading', 'Birth Chart Analysis') }}" class="w-full px-3 py-2 rounded-lg bg-white border border-[#D8C6A8] text-xs font-bold focus:outline-none">
                <textarea name="services_featured_description" rows="2" class="w-full px-3 py-2 rounded-lg bg-white border border-[#D8C6A8] text-xs focus:outline-none">{{ \App\Models\SiteSetting::get('services_featured_description', 'A birth chart provides an astrological framework for understanding planetary positions and important life themes.') }}</textarea>
            </div>

            <!-- AREAS OF EXPLORATION -->
            <div class="p-5 rounded-2xl border border-[#D8C6A8] bg-[#F9F5EE] space-y-3">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-2">
                    <span class="text-xs font-bold text-[#541F1D] uppercase">Areas of Exploration Section</span>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_services_exploration_active" value="1" x-model="toggles.section_services_exploration_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                        <span class="ml-2 text-xs font-semibold text-[#541F1D]" x-text="toggles.section_services_exploration_active ? 'Active' : 'Inactive'"></span>
                    </label>
                </div>
                <input type="text" name="services_exploration_heading" value="{{ \App\Models\SiteSetting::get('services_exploration_heading', 'What Can We Explore?') }}" class="w-full px-3 py-2 rounded-lg bg-white border border-[#D8C6A8] text-xs font-bold focus:outline-none">
            </div>

            <!-- CONSULTATION PROCESS -->
            <div class="p-5 rounded-2xl border border-[#D8C6A8] bg-[#F9F5EE] space-y-3">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-2">
                    <span class="text-xs font-bold text-[#541F1D] uppercase">Consultation Journey Process Section</span>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_services_process_active" value="1" x-model="toggles.section_services_process_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                        <span class="ml-2 text-xs font-semibold text-[#541F1D]" x-text="toggles.section_services_process_active ? 'Active' : 'Inactive'"></span>
                    </label>
                </div>
                <input type="text" name="services_process_heading" value="{{ \App\Models\SiteSetting::get('services_process_heading', 'A Simple Consultation Journey') }}" class="w-full px-3 py-2 rounded-lg bg-white border border-[#D8C6A8] text-xs font-bold focus:outline-none">
            </div>

            <!-- SERVICES FAQ -->
            <div class="p-5 rounded-2xl border border-[#D8C6A8] bg-[#F9F5EE] space-y-3">
                <div class="flex items-center justify-between border-b border-[#D8C6A8] pb-2">
                    <span class="text-xs font-bold text-[#541F1D] uppercase">Services FAQ Section</span>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="section_services_faq_active" value="1" x-model="toggles.section_services_faq_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                        <span class="ml-2 text-xs font-semibold text-[#541F1D]" x-text="toggles.section_services_faq_active ? 'Active' : 'Inactive'"></span>
                    </label>
                </div>
                <input type="text" name="services_faq_heading" value="{{ \App\Models\SiteSetting::get('services_faq_heading', 'Frequently Asked Questions') }}" class="w-full px-3 py-2 rounded-lg bg-white border border-[#D8C6A8] text-xs font-bold focus:outline-none">
            </div>
        </div>

        <!-- TAB 4: MASTER VISIBILITY DASHBOARD -->
        <div x-show="activeTab === 'visibility'" x-cloak class="bg-[#FDFBF7] p-6 sm:p-8 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            <div class="border-b border-[#D8C6A8] pb-4">
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">Master Section Visibility Controls</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Toggle publication status of every individual section on the public Services page (/services).</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- 1. Services Hero -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#541F1D]">1. Services Hero Section</div>
                        <div class="text-[11px] text-[#81766D]">Topmost hero banner immediately below header.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="toggles.section_services_hero_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    </label>
                </div>

                <!-- 2. Services Intro Header -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#541F1D]">2. Services Intro Header</div>
                        <div class="text-[11px] text-[#81766D]">Bengali heading (আমাদের পরিষেবা) & audio note.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="toggles.section_services_intro_header_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    </label>
                </div>

                <!-- 3. Quick Booking Block -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#541F1D]">3. Quick Booking Block</div>
                        <div class="text-[11px] text-[#81766D]">Entire Quick Booking left column block.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="toggles.section_services_quick_booking_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    </label>
                </div>

                <!-- 4. Phone Consultation Card -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#541F1D]">4. Phone Consultation Card</div>
                        <div class="text-[11px] text-[#81766D]">ফোনে বিচার & WhatsApp card.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="toggles.services_phone_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    </label>
                </div>

                <!-- 5. Kundli Block -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#541F1D]">5. Kundli Block</div>
                        <div class="text-[11px] text-[#81766D]">Kundli preparation information card block.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="toggles.services_kundli_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    </label>
                </div>

                <!-- 6. Remedy Block -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#541F1D]">6. Remedy Suggestion Block</div>
                        <div class="text-[11px] text-[#81766D]">Remedy suggestion information card block.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="toggles.services_remedy_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    </label>
                </div>

                <!-- 7. Editorial Introduction -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#541F1D]">7. Editorial Introduction</div>
                        <div class="text-[11px] text-[#81766D]">Astrology with context, timing & understanding.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="toggles.section_services_editorial_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    </label>
                </div>

                <!-- 8. Services Catalogue -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#541F1D]">8. Core Services Catalogue</div>
                        <div class="text-[11px] text-[#81766D]">Grid of 6 consultation service cards.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="toggles.section_services_catalogue_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    </label>
                </div>

                <!-- 9. Featured Birth Chart Service -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#541F1D]">9. Featured Birth Chart Service</div>
                        <div class="text-[11px] text-[#81766D]">Burgundy banner with birth chart analysis details.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="toggles.section_services_featured_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    </label>
                </div>

                <!-- 10. Areas of Exploration -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#541F1D]">10. Areas of Exploration</div>
                        <div class="text-[11px] text-[#81766D]">What can we explore? (5 compact items).</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="toggles.section_services_exploration_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    </label>
                </div>

                <!-- 11. Consultation Journey Process -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#541F1D]">11. Consultation Journey Process</div>
                        <div class="text-[11px] text-[#81766D]">How it works (4 timeline steps).</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="toggles.section_services_process_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    </label>
                </div>

                <!-- 12. Services FAQ -->
                <div class="p-4 rounded-xl border border-[#D8C6A8] bg-white flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-[#541F1D]">12. Services FAQ</div>
                        <div class="text-[11px] text-[#81766D]">Frequently asked questions accordion block.</div>
                    </div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="toggles.section_services_faq_active" class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#541F1D] relative"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- TAB 5: SEO SETTINGS -->
        <div x-show="activeTab === 'seo'" x-cloak class="bg-[#FDFBF7] p-6 sm:p-8 rounded-2xl border border-[#D8C6A8] shadow-xs space-y-6">
            <div class="border-b border-[#D8C6A8] pb-4">
                <h2 class="text-lg font-bold font-serif-luxury text-[#541F1D]">SEO Metadata Configuration</h2>
                <p class="text-xs text-[#81766D] mt-0.5">Title and meta description tags for search engine optimization.</p>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-[#541F1D] uppercase tracking-wider mb-2">SEO Title</label>
                    <input type="text" 
                           name="seo_title" 
                           value="{{ old('seo_title', $page->seo_title) }}" 
                           class="w-full px-4 py-2.5 rounded-xl bg-white border border-[#D8C6A8] text-xs font-semibold text-[#29211F] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#541F1D] uppercase tracking-wider mb-2">Meta Description</label>
                    <textarea name="meta_description" 
                              rows="3" 
                              class="w-full px-4 py-2.5 rounded-xl bg-white border border-[#D8C6A8] text-xs leading-relaxed text-[#29211F] focus:outline-none">{{ old('meta_description', $page->meta_description) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Submit Button Bar -->
        <div class="bg-[#FDFBF7] p-4 rounded-2xl border border-[#D8C6A8] shadow-xs flex items-center justify-between">
            <span class="text-xs text-[#81766D]">Changes are saved directly to the database upon submission.</span>
            <button type="submit" class="px-6 py-3 rounded-xl bg-[#541F1D] hover:bg-[#351211] text-[#F7F0E3] font-bold text-xs uppercase tracking-widest border border-[#C49A45]/40 shadow-md transition-all flex items-center">
                <svg class="w-4 h-4 mr-2 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Services Settings
            </button>
        </div>
    </form>
</div>
@endsection
