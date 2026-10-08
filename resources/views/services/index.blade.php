@extends('layouts.app')

@section('title', $cmsPage->seo_title ?? 'Astrology Services — Tamal Chakraborty')

@section('content')

<!-- 1. SERVICES HERO SECTION (Very Light Green #F3F8F5 Background) -->
@if(\App\Models\SiteSetting::get('section_services_hero_active', '1') == '1')
<section class="bg-[#F3F8F5] text-[#17211D] pt-6 sm:pt-8 lg:pt-8 pb-10 lg:pb-14 relative overflow-hidden border-b border-[#C8D8CF]">
    <!-- Subtle Celestial Lines Background -->
    <div class="absolute inset-0 pointer-events-none opacity-10">
        <svg class="w-full h-full text-[#C49A45]" viewBox="0 0 1200 450" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="600" cy="225" r="380" stroke="currentColor" stroke-width="0.75" stroke-dasharray="4 6"/>
            <circle cx="600" cy="225" r="280" stroke="currentColor" stroke-width="0.5"/>
            <circle cx="600" cy="225" r="180" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 4"/>
            <path d="M 100,225 L 1100,225" stroke="currentColor" stroke-width="0.5" opacity="0.4"/>
            <path d="M 600,0 L 600,450" stroke="currentColor" stroke-width="0.5" opacity="0.4"/>
        </svg>
    </div>

    <!-- Soft Golden Ambient Radial Glow -->
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 bg-[#C49A45]/10 blur-3xl rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Hero Content -->
            <div class="lg:col-span-8 space-y-4">
                <!-- Breadcrumb -->
                <nav class="flex items-center space-x-2 text-xs font-semibold tracking-widest text-[#C49A45] uppercase">
                    <a href="{{ route('home') }}" class="hover:text-[#0B3D2E] transition-colors">HOME</a>
                    <span class="text-[#60736B]">/</span>
                    <span class="text-[#17211D]">SERVICES</span>
                </nav>

                <!-- Eyebrow -->
                <div class="inline-flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                    <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">
                        {{ \App\Models\SiteSetting::get('services_hero_eyebrow', 'ASTROLOGICAL GUIDANCE') }}
                    </span>
                </div>

                <!-- Heading -->
                <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold text-[#0B3D2E] leading-tight">
                    {{ \App\Models\SiteSetting::get('services_hero_heading', 'Guidance For The Important Questions In Life') }}
                </h1>

                <!-- Supporting Text -->
                <p class="text-[#60736B] text-sm sm:text-base max-w-2xl font-normal leading-relaxed">
                    {{ \App\Models\SiteSetting::get('services_hero_description', 'Explore astrology-based guidance around birth charts, planetary timing, career, business, life direction and astrology learning.') }}
                </p>
            </div>

            <!-- Celestial Decorative Visual -->
            <div class="hidden lg:col-span-4 lg:flex items-center justify-end">
                <div class="relative w-48 h-48 sm:w-56 sm:h-56 rounded-full border border-[#C8D8CF] p-3 flex items-center justify-center bg-[#FFFFFF] shadow-md">
                    <div class="w-full h-full rounded-full border border-dashed border-[#C49A45]/40 flex items-center justify-center p-4">
                        <svg class="w-24 h-24 text-[#C49A45] opacity-80 animate-spin-slow" viewBox="0 0 100 100" fill="none" stroke="currentColor">
                            <circle cx="50" cy="50" r="45" stroke-width="1"/>
                            <circle cx="50" cy="50" r="32" stroke-width="0.75" stroke-dasharray="3 3"/>
                            <path d="M50 5 L50 95 M5 50 L95 50 M18 18 L82 82 M18 82 L82 18" stroke-width="0.5"/>
                            <circle cx="50" cy="18" r="3" fill="currentColor"/>
                            <circle cx="82" cy="50" r="2.5" fill="currentColor"/>
                            <circle cx="50" cy="82" r="3" fill="currentColor"/>
                            <circle cx="18" cy="50" r="2.5" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- 2. SERVICES INTRO & QUICK BOOKING SECTION (Light Green Background & Light Cards) -->
@php
    $showIntroHeader = \App\Models\SiteSetting::get('section_services_intro_header_active', '1') == '1';
    $showQuickBooking = \App\Models\SiteSetting::get('section_services_quick_booking_active', '1') == '1';
    $showJotok = \App\Models\SiteSetting::get('services_phone_active', '1') == '1';
    $showNumerology = \App\Models\SiteSetting::get('services_numerology_active', '1') == '1';
    $showRightCol = $showJotok || $showNumerology;
    $showIntroSection = $showIntroHeader || $showQuickBooking || $showRightCol;
@endphp

@if($showIntroSection)
<section class="bg-[#F3F8F5] text-[#17211D] pt-6 sm:pt-8 lg:pt-8 pb-10 lg:pb-14 relative overflow-hidden border-b border-[#C8D8CF]">
    <!-- Soft Background Celestial Lines -->
    <div class="absolute inset-0 pointer-events-none opacity-10">
        <svg class="w-full h-full text-[#C49A45]" viewBox="0 0 1200 450" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="600" cy="225" r="380" stroke="currentColor" stroke-width="0.75" stroke-dasharray="4 6"/>
            <circle cx="600" cy="225" r="280" stroke="currentColor" stroke-width="0.5"/>
            <circle cx="600" cy="225" r="180" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 4"/>
            <path d="M 100,225 L 1100,225" stroke="currentColor" stroke-width="0.5" opacity="0.4"/>
            <path d="M 600,0 L 600,450" stroke="currentColor" stroke-width="0.5" opacity="0.4"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-6">
        <!-- Top Eyebrow & Main Heading -->
        @if($showIntroHeader)
        <div class="space-y-2 max-w-3xl">
            <span class="text-xs sm:text-sm font-bold uppercase tracking-[0.2em] text-[#C49A45] block">
                {{ \App\Models\SiteSetting::get('services_intro_eyebrow', 'SERVICES') }}
            </span>

            <h2 class="font-serif-luxury text-3xl sm:text-4xl lg:text-5xl font-bold text-[#0B3D2E] leading-tight">
                {{ \App\Models\SiteSetting::get('services_intro_heading', 'আমাদের পরিষেবা') }}
            </h2>

            <p class="text-sm sm:text-base text-[#60736B] leading-relaxed font-normal pt-1">
                {{ \App\Models\SiteSetting::get('services_intro_description', 'সব consultation বর্তমানে audio/voice call-এ হয়। Prediction over the phone call only.') }}
            </p>
        </div>
        @endif

        <!-- Two Column Main Layout -->
        @if($showQuickBooking || $showRightCol)
        <div class="grid grid-cols-1 {{ ($showQuickBooking && $showRightCol) ? 'lg:grid-cols-2' : '' }} gap-6 lg:gap-8 items-stretch pt-2">
            
            <!-- LEFT COLUMN: QUICK BOOKING CARD -->
            @if($showQuickBooking)
            <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-2xl lg:rounded-3xl p-6 sm:p-8 space-y-6 shadow-xs flex flex-col justify-between">
                <!-- Heading -->
                <h3 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#0B3D2E] flex items-center gap-2">
                    {{ \App\Models\SiteSetting::get('services_qb_heading', '⚡ QUICK BOOKING') }}
                </h3>

                <!-- Consultation Options Container -->
                <div class="space-y-4 flex-1 flex flex-col justify-center pt-2">
                    <!-- URGENT CONSULTATION -->
                    @if(\App\Models\SiteSetting::get('services_urgent_active', '1') == '1')
                    <a href="{{ route('consultation.book') }}?type=urgent" 
                       class="block bg-[#F7FBF8] border border-[#C49A45]/40 hover:border-[#C49A45] rounded-2xl p-5 shadow-xs hover:shadow transition-all group">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <h4 class="font-bold text-[#0B3D2E] text-base sm:text-lg flex items-center gap-2">
                                    <span>{{ \App\Models\SiteSetting::get('services_urgent_icon', '🚨') }}</span>
                                    <span>{{ \App\Models\SiteSetting::get('services_urgent_title', 'Urgent Consultation') }}</span>
                                </h4>
                            </div>
                            <p class="text-xs sm:text-sm text-[#60736B] font-normal">
                                {{ \App\Models\SiteSetting::get('services_urgent_subtitle', 'Appointment should be within 24 hours') }}
                            </p>
                            <div class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#C49A45] pt-1">
                                {{ \App\Models\SiteSetting::get('services_urgent_price', '₹5,000') }}
                            </div>
                        </div>
                    </a>
                    @endif

                    <!-- NORMAL CONSULTATION -->
                    @if(\App\Models\SiteSetting::get('services_normal_active', '1') == '1')
                    <a href="{{ route('consultation.book') }}?type=normal" 
                       class="block bg-[#F7FBF8] border border-[#C8D8CF] hover:border-[#C49A45] rounded-2xl p-5 shadow-xs hover:shadow transition-all group">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <h4 class="font-bold text-[#0B3D2E] text-base sm:text-lg flex items-center gap-2">
                                    <span>{{ \App\Models\SiteSetting::get('services_normal_icon', '📅') }}</span>
                                    <span>{{ \App\Models\SiteSetting::get('services_normal_title', 'Normal Consultation') }}</span>
                                </h4>
                            </div>
                            <p class="text-xs sm:text-sm text-[#60736B] font-normal">
                                {{ \App\Models\SiteSetting::get('services_normal_subtitle', 'Appointment within one week') }}
                            </p>
                            <div class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#0B3D2E] pt-1">
                                {{ \App\Models\SiteSetting::get('services_normal_price', '₹3,000') }}
                            </div>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
            @endif

            <!-- RIGHT COLUMN: PHONE (JOTOK) & NUMEROLOGY CARDS -->
            @if($showRightCol)
            <div class="flex flex-col gap-6 justify-between">
                <!-- TOP CARD: JOTOK BICHAR (জোটক বিচার) -->
                @if($showJotok)
                <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-2xl lg:rounded-3xl p-6 sm:p-8 space-y-4 shadow-xs flex-1 flex flex-col justify-between">
                    <div class="space-y-2">
                        <h3 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#0B3D2E] flex items-center gap-2">
                            <span>{{ \App\Models\SiteSetting::get('services_phone_icon', '🔮') }}</span>
                            <span>{{ \App\Models\SiteSetting::get('services_phone_heading', 'জোটক বিচার') }}</span>
                        </h3>
                        
                        <p class="text-xs sm:text-sm text-[#60736B] font-normal">
                            {{ \App\Models\SiteSetting::get('services_phone_subtitle', 'For More Information') }}
                        </p>
                    </div>

                    <div class="pt-2">
                        <a href="{{ \App\Models\SiteSetting::get('services_phone_btn_url', 'https://wa.me/918392059201') }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="inline-flex items-center px-6 py-2.5 rounded-full text-xs sm:text-sm font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] shadow transition-colors">
                            {{ \App\Models\SiteSetting::get('services_phone_btn_text', 'WhatsApp Us') }}
                        </a>
                    </div>
                </div>
                @endif

                <!-- BOTTOM CARD: NUMEROLOGY CALCULATION -->
                @if($showNumerology)
                <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-2xl lg:rounded-3xl p-6 sm:p-8 space-y-4 shadow-xs flex-1 flex flex-col justify-between">
                    <div class="space-y-2">
                        <h3 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#0B3D2E] flex items-center gap-2">
                            <span>{{ \App\Models\SiteSetting::get('services_numerology_icon', '🔢') }}</span>
                            <span>{{ \App\Models\SiteSetting::get('services_numerology_heading', 'Numerology Calculation') }}</span>
                        </h3>
                        
                        <p class="text-xs sm:text-sm text-[#60736B] font-normal">
                            {{ \App\Models\SiteSetting::get('services_numerology_subtitle', 'For More Information') }}
                        </p>
                    </div>

                    <div class="pt-2">
                        <a href="{{ \App\Models\SiteSetting::get('services_numerology_btn_url', 'https://wa.me/918392059201') }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="inline-flex items-center px-6 py-2.5 rounded-full text-xs sm:text-sm font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] shadow transition-colors">
                            {{ \App\Models\SiteSetting::get('services_numerology_btn_text', 'WhatsApp Us') }}
                        </a>
                    </div>
                </div>
                @endif
            </div>
            @endif

        </div>
        @endif
    </div>
</section>
@endif

<!-- 3. EDITORIAL INTRODUCTION (Soft Green #E8F1EC) -->
@if(\App\Models\SiteSetting::get('section_services_editorial_active', '1') == '1')
<section class="bg-[#E8F1EC] text-[#17211D] py-16 sm:py-20 border-b border-[#C8D8CF]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-4">
        <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45] block">
            {{ \App\Models\SiteSetting::get('services_editorial_eyebrow', 'ASTROLOGY CONSULTATION') }}
        </span>
        
        <h2 class="font-serif-luxury text-2xl sm:text-4xl font-bold text-[#0B3D2E] leading-snug">
            {{ \App\Models\SiteSetting::get('services_editorial_heading', 'Astrology With Context, Timing & Understanding') }}
        </h2>

        <p class="text-sm sm:text-base text-[#60736B] leading-relaxed font-normal max-w-3xl mx-auto">
            {{ \App\Models\SiteSetting::get('services_editorial_description', 'Through birth-chart analysis, planetary transits and the study of time, explore an astrological perspective on important phases, questions and decisions in life.') }}
        </p>

        <div class="pt-2 flex justify-center">
            <div class="w-16 h-0.5 bg-[#C49A45] rounded-full"></div>
        </div>
    </div>
</section>
@endif

<!-- 4. MAIN SERVICES CATALOGUE (Very Light Green #F3F8F5) -->
@if(\App\Models\SiteSetting::get('section_services_catalogue_active', '1') == '1')
<section class="bg-[#F3F8F5] py-16 lg:py-24 border-b border-[#C8D8CF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">
                {{ \App\Models\SiteSetting::get('services_catalogue_eyebrow', 'CONSULTATION SERVICES') }}
            </span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#0B3D2E]">
                {{ \App\Models\SiteSetting::get('services_catalogue_heading', 'Core Astrological Consultations') }}
            </h2>
        </div>

        <!-- 6 Service Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <x-service-card :service="$service" :index="$loop->iteration" />
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- 5. FEATURED SERVICE (Primary Deep Green #0B3D2E Background) -->
@if(\App\Models\SiteSetting::get('section_services_featured_active', '1') == '1')
<section class="bg-[#0B3D2E] text-[#FFFFFF] py-20 lg:py-28 relative overflow-hidden border-y border-[#145A43]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Left: Large Premium Astrology Chart Visual -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-2xl overflow-hidden border border-[#C49A45]/30 shadow-xl group aspect-[4/3] bg-[#06281F]">
                    <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?q=80&w=1200&h=900&auto=format&fit=crop" 
                          alt="Birth Chart Analysis" 
                          class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#06281F] via-transparent to-transparent opacity-60"></div>
                    
                    <div class="absolute bottom-4 left-4 right-4 p-4 rounded-xl bg-[#06281F]/90 border border-[#C49A45]/30 backdrop-blur-md">
                        <span class="text-xs font-bold text-[#C49A45] uppercase tracking-wider block mb-1">FOUNDATIONAL ANALYSIS</span>
                        <p class="text-xs text-[#E8F1EC]/90 font-normal">Comprehensive examination of Janam Kundli, Lagna & Dashas.</p>
                    </div>
                </div>
            </div>

            <!-- Right: Detailed Information & CTAs -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45] block">
                    {{ \App\Models\SiteSetting::get('services_featured_eyebrow', 'FEATURED CONSULTATION') }}
                </span>

                <h2 class="font-serif-luxury text-3xl sm:text-4xl lg:text-5xl font-bold text-[#FFFFFF] leading-tight">
                    {{ \App\Models\SiteSetting::get('services_featured_heading', 'Birth Chart Analysis') }}
                </h2>

                <p class="text-[#E8F1EC]/90 text-sm sm:text-base font-normal leading-relaxed">
                    {{ \App\Models\SiteSetting::get('services_featured_description', 'A birth chart provides an astrological framework for understanding planetary positions and important life themes. A consultation can explore the chart alongside relevant timing and planetary movement.') }}
                </p>

                <!-- Key Exploration Points -->
                <div class="space-y-3 pt-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[#C49A45]">What the consultation can explore:</h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs sm:text-sm text-[#E8F1EC]">
                        <li class="flex items-center space-x-2.5">
                            <svg class="w-4 h-4 text-[#C49A45] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Lagna & Chandra Rashi structure</span>
                        </li>
                        <li class="flex items-center space-x-2.5">
                            <svg class="w-4 h-4 text-[#C49A45] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Planetary placements & house strength</span>
                        </li>
                        <li class="flex items-center space-x-2.5">
                            <svg class="w-4 h-4 text-[#C49A45] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Mahadasha & Antardasha time cycles</span>
                        </li>
                        <li class="flex items-center space-x-2.5">
                            <svg class="w-4 h-4 text-[#C49A45] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Favorable timing for major decisions</span>
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 flex flex-wrap items-center gap-4">
                    <a href="{{ route('services.show', 'birth-chart') }}" 
                       class="inline-flex items-center px-6 py-3 rounded-lg text-xs font-bold uppercase tracking-widest text-[#FFFFFF] bg-[#06281F] border border-[#C49A45]/40 hover:border-[#C49A45] transition-colors">
                        <span>EXPLORE BIRTH CHART</span>
                        <svg class="w-4 h-4 ml-2 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <a href="{{ route('consultation.book') }}" 
                       class="inline-flex items-center px-6 py-3 rounded-lg text-xs font-bold uppercase tracking-widest text-[#06281F] bg-[#C49A45] hover:bg-[#D8B86A] shadow transition-all">
                        <span>BOOK A CONSULTATION</span>
                        <svg class="w-4 h-4 ml-2 text-[#06281F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- 6. WHAT CAN WE EXPLORE? (Soft Green #E8F1EC Background) -->
@if(\App\Models\SiteSetting::get('section_services_exploration_active', '1') == '1')
<section class="bg-[#E8F1EC] text-[#17211D] py-20 lg:py-28 border-b border-[#C8D8CF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">
                {{ \App\Models\SiteSetting::get('services_exploration_eyebrow', 'AREAS OF EXPLORATION') }}
            </span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#0B3D2E]">
                {{ \App\Models\SiteSetting::get('services_exploration_heading', 'What Can We Explore?') }}
            </h2>
            <p class="text-xs sm:text-sm text-[#60736B] font-normal">
                {{ \App\Models\SiteSetting::get('services_exploration_subtitle', 'Key topics covered during a 1-on-1 private astrology consultation.') }}
            </p>
        </div>

        <!-- 5 Compact Items -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 sm:gap-8">
            <!-- Item 1: Birth Chart -->
            <div class="bg-[#FFFFFF] p-6 rounded-xl border border-[#C8D8CF] shadow-sm hover:shadow transition-shadow space-y-3">
                <div class="w-10 h-10 rounded-lg bg-[#0B3D2E] flex items-center justify-center text-[#C49A45]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v18m9-9H3m14.364-5.364l-12.728 12.728m0-12.728l12.728 12.728"/>
                    </svg>
                </div>
                <h3 class="font-serif-luxury text-lg font-bold text-[#0B3D2E]">Birth Chart</h3>
                <p class="text-xs text-[#60736B] leading-relaxed">Understanding core planetary positions, Lagna, and your foundational chart structure.</p>
            </div>

            <!-- Item 2: Planetary Timing -->
            <div class="bg-[#FFFFFF] p-6 rounded-xl border border-[#C8D8CF] shadow-sm hover:shadow transition-shadow space-y-3">
                <div class="w-10 h-10 rounded-lg bg-[#0B3D2E] flex items-center justify-center text-[#C49A45]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-serif-luxury text-lg font-bold text-[#0B3D2E]">Planetary Timing</h3>
                <p class="text-xs text-[#60736B] leading-relaxed">Exploring current Mahadasha, Antardasha, and planetary transits (Gochar).</p>
            </div>

            <!-- Item 3: Career & Work -->
            <div class="bg-[#FFFFFF] p-6 rounded-xl border border-[#C8D8CF] shadow-sm hover:shadow transition-shadow space-y-3">
                <div class="w-10 h-10 rounded-lg bg-[#0B3D2E] flex items-center justify-center text-[#C49A45]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="font-serif-luxury text-lg font-bold text-[#0B3D2E]">Career & Work</h3>
                <p class="text-xs text-[#60736B] leading-relaxed">Gaining astrological context for employment, career moves, and work timing.</p>
            </div>

            <!-- Item 4: Business Decisions -->
            <div class="bg-[#FFFFFF] p-6 rounded-xl border border-[#C8D8CF] shadow-sm hover:shadow transition-shadow space-y-3">
                <div class="w-10 h-10 rounded-lg bg-[#0B3D2E] flex items-center justify-center text-[#C49A45]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <h3 class="font-serif-luxury text-lg font-bold text-[#0B3D2E]">Business Decisions</h3>
                <p class="text-xs text-[#60736B] leading-relaxed">Evaluating timing and planetary influences for commercial expansion and ventures.</p>
            </div>

            <!-- Item 5: Life Direction -->
            <div class="bg-[#FFFFFF] p-6 rounded-xl border border-[#C8D8CF] shadow-sm hover:shadow transition-shadow space-y-3 sm:col-span-2 lg:col-span-1">
                <div class="w-10 h-10 rounded-lg bg-[#0B3D2E] flex items-center justify-center text-[#C49A45]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
                <h3 class="font-serif-luxury text-lg font-bold text-[#0B3D2E]">Life Direction</h3>
                <p class="text-xs text-[#60736B] leading-relaxed">Exploring broader life phases, transitions, personal growth, and clarity of purpose.</p>
            </div>
        </div>
    </div>
</section>
@endif

<!-- 7. CONSULTATION PROCESS (Very Light Green #F3F8F5) -->
@if(\App\Models\SiteSetting::get('section_services_process_active', '1') == '1')
<section class="bg-[#F3F8F5] text-[#17211D] py-20 lg:py-28 relative overflow-hidden border-b border-[#C8D8CF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-16">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">
                {{ \App\Models\SiteSetting::get('services_process_eyebrow', 'HOW IT WORKS') }}
            </span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#0B3D2E]">
                {{ \App\Models\SiteSetting::get('services_process_heading', 'A Simple Consultation Journey') }}
            </h2>
        </div>

        <!-- Timeline Steps Grid -->
        <div class="relative">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative z-10">
                <!-- STEP 01 -->
                <div class="bg-[#FFFFFF] border border-[#C8D8CF] p-6 rounded-2xl space-y-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="font-serif-luxury text-2xl font-bold text-[#0B3D2E]">01</span>
                        <span class="text-[10px] font-bold tracking-widest uppercase text-[#0B3D2E] bg-[#E8F1EC] px-2 py-0.5 rounded border border-[#C8D8CF]">STEP ONE</span>
                    </div>
                    <h3 class="font-serif-luxury text-xl font-bold text-[#0B3D2E]">Choose Your Consultation</h3>
                    <p class="text-xs text-[#60736B] font-normal leading-relaxed">
                        Select the consultation area that best matches your current life questions or career focus.
                    </p>
                </div>

                <!-- STEP 02 -->
                <div class="bg-[#FFFFFF] border border-[#C8D8CF] p-6 rounded-2xl space-y-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="font-serif-luxury text-2xl font-bold text-[#0B3D2E]">02</span>
                        <span class="text-[10px] font-bold tracking-widest uppercase text-[#0B3D2E] bg-[#E8F1EC] px-2 py-0.5 rounded border border-[#C8D8CF]">STEP TWO</span>
                    </div>
                    <h3 class="font-serif-luxury text-xl font-bold text-[#0B3D2E]">Select Date & Time</h3>
                    <p class="text-xs text-[#60736B] font-normal leading-relaxed">
                        Pick a convenient available slot for your private 1-on-1 session with Tamal Chakraborty.
                    </p>
                </div>

                <!-- STEP 03 -->
                <div class="bg-[#FFFFFF] border border-[#C8D8CF] p-6 rounded-2xl space-y-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="font-serif-luxury text-2xl font-bold text-[#0B3D2E]">03</span>
                        <span class="text-[10px] font-bold tracking-widest uppercase text-[#0B3D2E] bg-[#E8F1EC] px-2 py-0.5 rounded border border-[#C8D8CF]">STEP THREE</span>
                    </div>
                    <h3 class="font-serif-luxury text-xl font-bold text-[#0B3D2E]">Share Your Birth Details</h3>
                    <p class="text-xs text-[#60736B] font-normal leading-relaxed">
                        Provide accurate date, exact time, and place of birth prior to the consultation.
                    </p>
                </div>

                <!-- STEP 04 -->
                <div class="bg-[#FFFFFF] border border-[#C8D8CF] p-6 rounded-2xl space-y-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="font-serif-luxury text-2xl font-bold text-[#0B3D2E]">04</span>
                        <span class="text-[10px] font-bold tracking-widest uppercase text-[#0B3D2E] bg-[#E8F1EC] px-2 py-0.5 rounded border border-[#C8D8CF]">STEP FOUR</span>
                    </div>
                    <h3 class="font-serif-luxury text-xl font-bold text-[#0B3D2E]">Begin Your Consultation</h3>
                    <p class="text-xs text-[#60736B] font-normal leading-relaxed">
                        Connect via private call to explore your birth chart, transits, and timing.
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA in Timeline -->
        <div class="text-center pt-4">
            <a href="{{ route('consultation.book') }}" 
               class="inline-flex items-center px-8 py-3.5 rounded-lg text-xs font-bold uppercase tracking-widest text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] border border-[#0B3D2E] shadow transition-all">
                <span>START YOUR CONSULTATION JOURNEY</span>
                <svg class="w-4 h-4 ml-2 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- 8. FAQ — SERVICES -->
@if(\App\Models\SiteSetting::get('section_services_faq_active', '1') == '1')
<section class="bg-[#F3F8F5] text-[#17211D] py-20 lg:py-28">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <!-- Section Header -->
        <div class="text-center space-y-3">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">
                {{ \App\Models\SiteSetting::get('services_faq_eyebrow', 'SERVICES FAQ') }}
            </span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#0B3D2E]">
                {{ \App\Models\SiteSetting::get('services_faq_heading', 'Frequently Asked Questions') }}
            </h2>
            <p class="text-xs sm:text-sm text-[#60736B] font-normal">
                {{ \App\Models\SiteSetting::get('services_faq_subtitle', 'Common questions regarding astrological consultations and birth chart requirements.') }}
            </p>
        </div>

        <!-- FAQ Accordion Container -->
        <div x-data="{ active: null }" class="space-y-4">
            <!-- FAQ 1 -->
            <div class="border border-[#C8D8CF] rounded-xl overflow-hidden bg-[#FFFFFF] transition-shadow shadow-sm">
                <button @click="active = (active === 1 ? null : 1)" 
                        class="w-full px-6 py-5 text-left flex items-center justify-between font-serif-luxury text-lg font-bold text-[#0B3D2E] hover:text-[#145A43] transition-colors focus:outline-none">
                    <span>What information is needed for a birth chart consultation?</span>
                    <span class="ml-4 flex-shrink-0 w-7 h-7 rounded-full border border-[#C8D8CF] flex items-center justify-center text-[#C49A45]">
                        <svg class="w-4 h-4 transform transition-transform duration-300" :class="{ 'rotate-180': active === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </span>
                </button>
                <div x-show="active === 1" x-collapse x-cloak class="px-6 pb-6 text-sm text-[#60736B] leading-relaxed font-normal border-t border-[#C8D8CF]/40 pt-4">
                    You will need to provide your exact date of birth, time of birth (as accurate as possible), and place of birth (city/state/country). These details are essential for calculating precise planetary positions, Lagna, and house cusps in your Janam Kundli.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="border border-[#C8D8CF] rounded-xl overflow-hidden bg-[#FFFFFF] transition-shadow shadow-sm">
                <button @click="active = (active === 2 ? null : 2)" 
                        class="w-full px-6 py-5 text-left flex items-center justify-between font-serif-luxury text-lg font-bold text-[#0B3D2E] hover:text-[#145A43] transition-colors focus:outline-none">
                    <span>How should I provide my birth time if I am unsure of the exact minute?</span>
                    <span class="ml-4 flex-shrink-0 w-7 h-7 rounded-full border border-[#C8D8CF] flex items-center justify-center text-[#C49A45]">
                        <svg class="w-4 h-4 transform transition-transform duration-300" :class="{ 'rotate-180': active === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </span>
                </button>
                <div x-show="active === 2" x-collapse x-cloak class="px-6 pb-6 text-sm text-[#60736B] leading-relaxed font-normal border-t border-[#C8D8CF]/40 pt-4">
                    Please provide the most accurate estimated time available from birth records or family recollection. Mention any uncertainty when filling out the consultation booking details so the analysis can account for timing variances.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="border border-[#C8D8CF] rounded-xl overflow-hidden bg-[#FFFFFF] transition-shadow shadow-sm">
                <button @click="active = (active === 3 ? null : 3)" 
                        class="w-full px-6 py-5 text-left flex items-center justify-between font-serif-luxury text-lg font-bold text-[#0B3D2E] hover:text-[#145A43] transition-colors focus:outline-none">
                    <span>Can a consultation focus specifically on career or business questions?</span>
                    <span class="ml-4 flex-shrink-0 w-7 h-7 rounded-full border border-[#C8D8CF] flex items-center justify-center text-[#C49A45]">
                        <svg class="w-4 h-4 transform transition-transform duration-300" :class="{ 'rotate-180': active === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </span>
                </button>
                <div x-show="active === 3" x-collapse x-cloak class="px-6 pb-6 text-sm text-[#60736B] leading-relaxed font-normal border-t border-[#C8D8CF]/40 pt-4">
                    Yes. Consultations can be focused directly on professional areas such as career changes, employment timing, work transitions, commercial expansion, or business planning based on your birth chart and active Dasha cycles.
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="border border-[#C8D8CF] rounded-xl overflow-hidden bg-[#FFFFFF] transition-shadow shadow-sm">
                <button @click="active = (active === 4 ? null : 4)" 
                        class="w-full px-6 py-5 text-left flex items-center justify-between font-serif-luxury text-lg font-bold text-[#0B3D2E] hover:text-[#145A43] transition-colors focus:outline-none">
                    <span>What happens after I submit my booking request?</span>
                    <span class="ml-4 flex-shrink-0 w-7 h-7 rounded-full border border-[#C8D8CF] flex items-center justify-center text-[#C49A45]">
                        <svg class="w-4 h-4 transform transition-transform duration-300" :class="{ 'rotate-180': active === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </span>
                </button>
                <div x-show="active === 4" x-collapse x-cloak class="px-6 pb-6 text-sm text-[#60736B] leading-relaxed font-normal border-t border-[#C8D8CF]/40 pt-4">
                    Once you submit your preferred date, time, and birth details via the booking page, your consultation schedule will be confirmed with session preparation guidelines and a private link for your scheduled video session.
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="border border-[#C8D8CF] rounded-xl overflow-hidden bg-[#FFFFFF] transition-shadow shadow-sm">
                <button @click="active = (active === 5 ? null : 5)" 
                        class="w-full px-6 py-5 text-left flex items-center justify-between font-serif-luxury text-lg font-bold text-[#0B3D2E] hover:text-[#145A43] transition-colors focus:outline-none">
                    <span>How do I choose between Birth Chart Analysis and Transit & Timing Analysis?</span>
                    <span class="ml-4 flex-shrink-0 w-7 h-7 rounded-full border border-[#C8D8CF] flex items-center justify-center text-[#C49A45]">
                        <svg class="w-4 h-4 transform transition-transform duration-300" :class="{ 'rotate-180': active === 5 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </span>
                </button>
                <div x-show="active === 5" x-collapse x-cloak class="px-6 pb-6 text-sm text-[#60736B] leading-relaxed font-normal border-t border-[#C8D8CF]/40 pt-4">
                    Birth Chart Analysis focuses on your overall chart architecture, strengths, and foundational life themes. Transit & Timing Analysis focuses specifically on current planetary movements (Gochar) and active Dasha phases. If it is your first consultation, Birth Chart Analysis is recommended.
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection
