@extends('layouts.app')

@section('title', 'Tamal Chakraborty — Premium Vedic Astrologer & Spiritual Mentor')

@section('content')

<!-- ==========================================
     SECTION 1: HERO SECTION (Light Green #F3F8F5 Theme)
     ========================================== -->
@if(\App\Models\SiteSetting::get('section_hero_active', '1') == '1')
<section class="relative bg-[#F3F8F5] text-[#17211D] pt-8 pb-12 lg:pt-12 lg:pb-16 overflow-hidden border-b border-[#C8D8CF]">
    <!-- Background Subtle Celestial Overlay -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-[#C49A45]/10 via-[#F3F8F5] to-[#E8F1EC] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-10 lg:space-y-14">
        
        <!-- MAIN DEVOTIONAL HERO ROW -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- LEFT COLUMN: Devotional Card & Action Buttons -->
            <div class="lg:col-span-6 space-y-6 text-left order-2 lg:order-1">
                
                <!-- 1. Small Outlined Badge -->
                <div class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full bg-[#E8F1EC] border border-[#C8D8CF] text-[#0B3D2E] text-xs font-bold uppercase tracking-widest shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-[#C49A45] animate-pulse"></span>
                    <span>{{ \App\Models\SiteSetting::get('homepage_hero_eyebrow', 'AUTHENTIC VEDIC ASTROLOGY') }}</span>
                </div>

                <!-- 2. Devotional Card -->
                <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-2xl p-6 sm:p-8 shadow-md space-y-4 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-[radial-gradient(#C49A45_1px,transparent_1px)] opacity-20 pointer-events-none [background-size:12px_12px]"></div>

                    <!-- Ganesha Emblem & Heading -->
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#E8F1EC] border border-[#C8D8CF] flex items-center justify-center p-1.5 flex-shrink-0 shadow-xs">
                            <img src="{{ asset('images/ganesha-logo.png') }}" alt="Ganesha Icon" class="w-full h-full object-contain" />
                        </div>
                        <h2 class="font-serif text-2xl sm:text-3xl font-bold text-[#0B3D2E] tracking-wide">
                            {{ \App\Models\SiteSetting::get('homepage_hero_heading', 'Ganesha Astro Consultancy') }}
                        </h2>
                    </div>

                    <!-- Mantra Text -->
                    @if(\App\Models\SiteSetting::get('homepage_hero_mantra'))
                        <div class="font-serif text-sm sm:text-base text-[#17211D] leading-relaxed space-y-1.5 pt-1 pl-1 border-l-2 border-[#C49A45]">
                            {!! nl2br(e(\App\Models\SiteSetting::get('homepage_hero_mantra'))) !!}
                        </div>
                    @endif

                    <p class="text-xs sm:text-sm text-[#60736B] font-normal leading-relaxed pt-1">
                        {{ \App\Models\SiteSetting::get('homepage_hero_description', 'Discover clarity and purpose with genuine Vedic astrology guidance from Tamal Chakraborty. Get precise birth chart analysis, life solutions, and practical remedies.') }}
                    </p>
                </div>

                <!-- 3. Action Buttons -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 pt-1">
                    <a href="{{ \App\Models\SiteSetting::get('homepage_hero_primary_btn_url', route('consultation.book')) }}" 
                       class="inline-flex items-center justify-center px-7 py-3.5 text-xs font-bold uppercase tracking-widest text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] active:bg-[#06281F] rounded-lg shadow-md border border-[#0B3D2E] transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-4 h-4 mr-2 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ \App\Models\SiteSetting::get('homepage_hero_primary_btn_text', 'QUICK BOOKING') }}</span>
                    </a>

                    <a href="{{ \App\Models\SiteSetting::get('homepage_hero_secondary_btn_url', route('services.index')) }}" 
                       class="inline-flex items-center justify-center px-7 py-3.5 text-xs font-bold uppercase tracking-widest text-[#0B3D2E] bg-[#FFFFFF] hover:bg-[#E8F1EC] border border-[#0B3D2E] rounded-lg transition-colors">
                        <span>{{ \App\Models\SiteSetting::get('homepage_hero_secondary_btn_text', 'Explore services') }}</span>
                        <svg class="w-4 h-4 ml-2 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>

                <!-- 4. Compact Astrologer Identity Row & Stats -->
                <div class="pt-3 flex flex-wrap items-center justify-between gap-4 border-t border-[#C8D8CF]">
                    <div class="flex items-center">
                        <img src="{{ asset('images/astrotamal-logo.png') }}" 
                             alt="তমাল চক্রবর্তী — Ganesha Astro Consultancy" 
                             class="h-9 sm:h-10 w-auto object-contain" />
                    </div>

                    <!-- Statistics -->
                    <div class="flex items-center space-x-4 text-xs font-bold text-[#17211D]">
                        @if(\App\Models\SiteSetting::get('homepage_hero_stat1_number'))
                            <div>
                                <span class="text-[#0B3D2E] font-serif-luxury text-sm block">{{ \App\Models\SiteSetting::get('homepage_hero_stat1_number', '15+') }}</span>
                                <span class="text-[10px] text-[#60736B] font-normal uppercase tracking-wider">{{ \App\Models\SiteSetting::get('homepage_hero_stat1_label', 'Years Experience') }}</span>
                            </div>
                        @endif
                        @if(\App\Models\SiteSetting::get('homepage_hero_stat2_number'))
                            <div>
                                <span class="text-[#0B3D2E] font-serif-luxury text-sm block">{{ \App\Models\SiteSetting::get('homepage_hero_stat2_number', '10k+') }}</span>
                                <span class="text-[10px] text-[#60736B] font-normal uppercase tracking-wider">{{ \App\Models\SiteSetting::get('homepage_hero_stat2_label', 'Consultations') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Temple Image / Hero Image -->
            <div class="lg:col-span-6 relative flex justify-center lg:justify-end order-1 lg:order-2">
                <div class="relative w-full max-w-lg mx-auto lg:mr-0">
                    <div class="absolute -inset-2 rounded-3xl bg-gradient-to-tr from-[#C49A45]/20 via-transparent to-[#0B3D2E]/20 blur-xl opacity-70"></div>
                    
                    <div class="relative rounded-2xl overflow-hidden border-2 border-[#C8D8CF] shadow-xl bg-[#FFFFFF]">
                        @php
                            $heroImg = \App\Models\SiteSetting::get('homepage_hero_image');
                            $imgSrc = $heroImg ? asset($heroImg) : asset('images/ganesha-temple-hero.jpg');
                        @endphp
                        <img src="{{ $imgSrc }}" 
                             alt="Ganesha Astro Consultancy Banner" 
                             class="w-full h-[320px] xs:h-[380px] sm:h-[460px] lg:h-[520px] object-cover object-center" />
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                        
                        <div class="absolute bottom-4 left-4 right-4 bg-[#FFFFFF]/95 backdrop-blur-md p-3.5 rounded-xl border border-[#C8D8CF] flex items-center justify-between shadow-md">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-[#C49A45] block">AUSPICIOUS BLESSINGS</span>
                                <p class="font-serif text-xs font-bold text-[#0B3D2E]">Vedic Astrological Remedies & Chart Analysis</p>
                            </div>
                            <span class="text-xl text-[#C49A45]">ॐ</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif


<!-- ==========================================
     SECTION 2: FEATURE HIGHLIGHT STRIP (#E8F1EC Panel)
     ========================================== -->
@if(\App\Models\SiteSetting::get('section_features_active', '1') == '1')
<section class="bg-[#F3F8F5] text-[#17211D] py-5 sm:py-7 lg:py-8 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-[#E8F1EC] rounded-[22px] px-5 sm:px-7 lg:px-8 xl:px-10 py-6 sm:py-7 border border-[#C8D8CF] shadow-xs">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-3 xl:gap-5 items-center">
                
                @php
                    $featuresToDisplay = isset($homeFeatures) && $homeFeatures->count() > 0 
                        ? $homeFeatures 
                        : collect([
                            (object)['title' => 'Vedic Astrology', 'description' => 'Authentic Knowledge', 'icon' => 'book'],
                            (object)['title' => 'Personalized Guidance', 'description' => 'Solutions for Your Life', 'icon' => 'user-check'],
                            (object)['title' => 'Confidential & Secure', 'description' => 'Your Privacy Is Priority', 'icon' => 'shield-lock'],
                            (object)['title' => 'Practical Suggestion', 'description' => '', 'icon' => 'sparkles'],
                            (object)['title' => 'Global Consultation', 'description' => 'Serving Worldwide', 'icon' => 'globe']
                        ]);
                @endphp

                @foreach($featuresToDisplay as $index => $feature)
                    <div class="flex items-center space-x-3 xl:space-x-3.5 min-w-0 {{ $loop->last && $loop->count % 2 != 0 ? 'col-span-1 sm:col-span-2 lg:col-span-1' : '' }}">
                        <div class="w-[54px] h-[54px] rounded-full bg-[#FFFFFF] border border-[#C8D8CF] flex items-center justify-center flex-shrink-0 shadow-xs">
                            @if(in_array($feature->icon ?? '', ['book', 'Vedic Astrology']))
                                <svg class="w-6 h-6 text-[#0B3D2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            @elseif(in_array($feature->icon ?? '', ['shield-lock', 'lock', 'Confidential & Secure']))
                                <svg class="w-6 h-6 text-[#0B3D2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            @elseif(in_array($feature->icon ?? '', ['sparkles', 'remedy', 'Practical Remedies', 'Practical Suggestion']))
                                <svg class="w-6 h-6 text-[#0B3D2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            @elseif(in_array($feature->icon ?? '', ['globe', 'world', 'Global Consultation']))
                                <svg class="w-6 h-6 text-[#0B3D2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-[#0B3D2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="font-serif-luxury font-semibold text-[16px] xl:text-[17px] text-[#0B3D2E] leading-tight tracking-wide break-words">{{ $feature->title }}</h4>
                            @if(!empty($feature->description))
                                <p class="text-[13px] xl:text-[13.5px] text-[#60736B] font-normal leading-snug mt-0.5 break-words">{{ $feature->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
@endif


<!-- ==========================================
     SECTION 3: QUICK BOOKING (Dark Green #06281F Background)
     ========================================== -->
@if(\App\Models\SiteSetting::get('section_quick_booking_active', '1') == '1')
<section id="quick-booking" class="bg-[#06281F] text-[#FFFFFF] py-12 sm:py-14 lg:py-18 border-b border-[#0B3D2E] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-8 lg:mb-10 space-y-1.5">
            <span class="block text-[10px] sm:text-xs font-bold uppercase tracking-[0.22em] text-[#C49A45]">
                {{ \App\Models\SiteSetting::get('homepage_qb_eyebrow', 'QUICK BOOKING') }}
            </span>
            <h2 class="font-serif-luxury text-2xl sm:text-3xl lg:text-4xl font-bold text-[#FFFFFF] flex items-center justify-center space-x-2">
                <span class="text-[#C49A45]">⚡</span>
                <span>{{ \App\Models\SiteSetting::get('homepage_qb_heading', 'Schedule Your Personal Consultation') }}</span>
            </h2>
            @if(\App\Models\SiteSetting::get('homepage_qb_description'))
                <p class="text-xs sm:text-sm text-[#D8E5DE] font-normal max-w-lg mx-auto pt-1">
                    {{ \App\Models\SiteSetting::get('homepage_qb_description') }}
                </p>
            @endif
        </div>

        <!-- 2 Consultation Booking Cards (Side-by-side on desktop, rounded 24px, 36px padding) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 max-w-5xl mx-auto items-stretch">
            
            <!-- Card 1: Urgent Consultation -->
            <a href="{{ route('consultation.book', ['type' => 'urgent']) }}" 
               class="group bg-[#FFFFFF] border border-[#C8D8CF] rounded-[24px] p-6 sm:p-8 lg:p-9 shadow-md hover:shadow-xl hover:border-[#C49A45] transition-all duration-300 flex flex-col justify-between hover:scale-[1.01] active:scale-[0.99] relative overflow-hidden">
                
                <div>
                    <!-- Top Row: Title + Badge -->
                    <div class="flex items-start justify-between flex-wrap gap-3">
                        <div class="flex items-center space-x-2.5">
                            <!-- Subtle Alert / Clock Icon -->
                            <div class="w-8 h-8 rounded-full bg-[#E8F1EC] flex items-center justify-center shrink-0 border border-[#C8D8CF]">
                                <svg class="w-4 h-4 text-[#0B3D2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="font-serif-luxury text-xl sm:text-2xl lg:text-[25px] font-semibold text-[#0B3D2E] tracking-wide">
                                {{ \App\Models\SiteSetting::get('homepage_qb_urgent_title', 'URGENT CONSULTATION') }}
                            </h3>
                        </div>

                        <!-- Pill Badge -->
                        <span class="px-3.5 py-1 rounded-full text-[10px] sm:text-xs font-bold uppercase tracking-widest bg-[#0B3D2E] text-[#FFFFFF] border border-[#0B3D2E] shrink-0">
                            WITHIN 24H
                        </span>
                    </div>

                    <!-- Description -->
                    <p class="text-base sm:text-[17px] text-[#60736B] font-normal leading-relaxed my-5 sm:my-7">
                        Appointment should be within 24 hours
                    </p>
                </div>

                <!-- Bottom Row: Price -->
                <div class="pt-4 border-t border-[#C8D8CF]/60 flex items-center justify-between mt-auto">
                    <span class="font-serif-luxury text-3xl sm:text-4xl lg:text-[38px] font-bold text-[#0B3D2E] tracking-tight">
                        {{ \App\Models\SiteSetting::get('homepage_qb_urgent_price', '₹5,000') }}
                    </span>

                    <span class="inline-flex items-center px-4 py-2 rounded-lg bg-[#0B3D2E] text-[#FFFFFF] group-hover:bg-[#145A43] text-xs font-bold uppercase tracking-wider transition-colors shadow-xs">
                        <span>Book Now</span>
                        <svg class="w-4 h-4 ml-1.5 group-hover:translate-x-1 transition-transform text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </div>

            </a>

            <!-- Card 2: Normal Consultation -->
            <a href="{{ route('consultation.book', ['type' => 'normal']) }}" 
               class="group bg-[#FFFFFF] border border-[#C8D8CF] rounded-[24px] p-6 sm:p-8 lg:p-9 shadow-md hover:shadow-xl hover:border-[#C49A45] transition-all duration-300 flex flex-col justify-between hover:scale-[1.01] active:scale-[0.99] relative overflow-hidden">
                
                <div>
                    <!-- Top Row: Title + Badge -->
                    <div class="flex items-start justify-between flex-wrap gap-3">
                        <div class="flex items-center space-x-2.5">
                            <!-- Subtle Calendar Icon -->
                            <div class="w-8 h-8 rounded-full bg-[#E8F1EC] flex items-center justify-center shrink-0 border border-[#C8D8CF]">
                                <svg class="w-4 h-4 text-[#0B3D2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="font-serif-luxury text-xl sm:text-2xl lg:text-[25px] font-semibold text-[#0B3D2E] tracking-wide">
                                {{ \App\Models\SiteSetting::get('homepage_qb_normal_title', 'NORMAL CONSULTATION') }}
                            </h3>
                        </div>

                        <!-- Pill Badge -->
                        <span class="px-3.5 py-1 rounded-full text-[10px] sm:text-xs font-bold uppercase tracking-widest bg-[#E8F1EC] text-[#0B3D2E] border border-[#C8D8CF] shrink-0">
                            WITHIN A WEEK
                        </span>
                    </div>

                    <!-- Description -->
                    <p class="text-base sm:text-[17px] text-[#60736B] font-normal leading-relaxed my-5 sm:my-7">
                        Appointment within one week
                    </p>
                </div>

                <!-- Bottom Row: Price -->
                <div class="pt-4 border-t border-[#C8D8CF]/60 flex items-center justify-between mt-auto">
                    <span class="font-serif-luxury text-3xl sm:text-4xl lg:text-[38px] font-bold text-[#0B3D2E] tracking-tight">
                        {{ \App\Models\SiteSetting::get('homepage_qb_normal_price', '₹3,000') }}
                    </span>

                    <span class="inline-flex items-center px-4 py-2 rounded-lg bg-[#0B3D2E] text-[#FFFFFF] group-hover:bg-[#145A43] text-xs font-bold uppercase tracking-wider transition-colors shadow-xs">
                        <span>Book Now</span>
                        <svg class="w-4 h-4 ml-1.5 group-hover:translate-x-1 transition-transform text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </div>

            </a>

        </div>

    </div>
</section>
@endif


<!-- ==========================================
     SECTION 4: LATEST VIDEOS SECTION (Light Green #F3F8F5 Background)
     ========================================== -->
@if(\App\Models\SiteSetting::get('section_videos_active', '1') == '1')
<section class="bg-[#F3F8F5] text-[#17211D] py-12 sm:py-16 lg:py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 sm:space-y-10 lg:space-y-12">
        
        <!-- Top Row Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div class="space-y-1 sm:space-y-1.5">
                <span class="inline-flex items-center text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">
                    <span class="mr-1.5">🎬</span> {{ trim(str_replace('🎬', '', \App\Models\SiteSetting::get('homepage_videos_eyebrow', 'LATEST VIDEOS'))) }}
                </span>
                <h2 class="font-serif-luxury text-2xl sm:text-4xl lg:text-5xl font-bold text-[#0B3D2E] tracking-tight">
                    {{ \App\Models\SiteSetting::get('homepage_videos_heading', 'From the consultation room') }}
                </h2>
            </div>
            <a href="{{ route('videos') }}" 
               class="font-serif-luxury text-sm sm:text-base font-bold text-[#0B3D2E] hover:text-[#C49A45] transition-colors self-start sm:self-auto flex items-center group">
                <span>{{ \App\Models\SiteSetting::get('homepage_videos_btn_text', 'View all videos →') }}</span>
            </a>
        </div>

        @if(isset($latestVideos) && $latestVideos->count() > 0)
            <!-- Image-based Video Cards Grid (Desktop: 3 cols, Tablet: 2 cols, Mobile: 1 col) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 lg:gap-8 items-stretch">
                @foreach($latestVideos->take(6) as $video)
                    <div class="flex flex-col h-full bg-[#FFFFFF] rounded-[16px] border border-[#C8D8CF] shadow-[0_4px_16px_rgba(11,61,46,0.06)] overflow-hidden transition-all duration-300 hover:shadow-md hover:border-[#0B3D2E] group">
                        
                        <!-- 1. Large Landscape Image Container (16:9 Aspect Ratio) - Clickable link with subtle play overlay -->
                        <a href="{{ $video->video_url }}" target="_blank" rel="noopener noreferrer" class="block relative w-full aspect-[16/9] bg-[#06281F] overflow-hidden shrink-0">
                            @if($video->thumbnail)
                                <img src="{{ asset($video->thumbnail) }}" 
                                     alt="{{ $video->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-95 group-hover:opacity-100">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[#06281F] text-[#F3F8F5]/50 text-xs">
                                    No Image Available
                                </div>
                            @endif

                            <!-- Centered Play Icon Overlay -->
                            <div class="absolute inset-0 bg-black/20 flex items-center justify-center group-hover:bg-black/10 transition-colors">
                                <div class="w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-[#0B3D2E]/85 text-[#FFFFFF] border border-[#C49A45]/60 flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                    <svg class="w-4 h-4 fill-current ml-0.5 text-[#C49A45]" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                        </a>

                        <!-- 2. Text Content & Watch Video Button Inside Card Body -->
                        <div class="p-3.5 sm:p-4 lg:p-5 flex-1 flex flex-col justify-between space-y-3">
                            <div class="space-y-2">
                                <h3 class="font-serif-luxury text-[15px] sm:text-lg lg:text-[21px] font-bold text-[#0B3D2E] leading-snug line-clamp-2 group-hover:text-[#145A43] transition-colors">
                                    <a href="{{ $video->video_url }}" target="_blank" rel="noopener noreferrer" class="hover:underline">
                                        {{ $video->title }}
                                    </a>
                                </h3>

                                @if($video->tag)
                                    <div>
                                        <span class="inline-block px-2.5 py-0.5 rounded-full bg-[#E8F1EC] text-[#0B3D2E] border border-[#C8D8CF] text-[11px] sm:text-xs font-semibold tracking-wide">
                                            {{ $video->tag }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- 3. Premium Watch Video Button Aligned to Bottom -->
                            <div class="pt-2 mt-auto">
                                <a href="{{ $video->video_url }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   class="flex items-center justify-between w-full h-[36px] sm:h-[44px] px-3 sm:px-4 rounded-lg bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] text-[10px] sm:text-xs font-bold uppercase tracking-wider border border-[#0B3D2E] hover:border-[#C49A45] shadow-xs transition-all duration-200 hover:scale-[1.01] active:scale-[0.99]">
                                    <span class="flex items-center space-x-1.5">
                                        <svg class="w-3 h-3 text-[#C49A45] fill-current shrink-0" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        <span>WATCH VIDEO</span>
                                    </span>
                                    <svg class="w-3.5 h-3.5 text-[#C49A45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <!-- Clean Empty State if no active videos -->
            <div class="text-center py-12 px-4 rounded-2xl bg-[#E8F1EC]/60 border border-[#C8D8CF]/60">
                <p class="text-sm font-bold text-[#0B3D2E]">No videos published yet.</p>
                <p class="text-xs text-[#60736B] mt-1">Check back soon for new video insights from Tamal Chakraborty.</p>
            </div>
        @endif

    </div>
</section>
@endif

@endsection

