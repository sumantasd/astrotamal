@extends('layouts.app')

@section('title', 'Tamal Chakraborty — Premium Vedic Astrologer & Spiritual Mentor')

@section('content')
<!-- ==========================================
     SECTION 2: HERO SECTION (Warm Cream / Ivory Background with Premium Styling)
     ========================================== -->
<!-- ==========================================
     SECTION 2: DEVOTIONAL HERO SECTION (Warm Cream / Ivory Background)
     ========================================== -->
<section class="relative bg-[#F7F0E3] text-[#29211F] pt-8 pb-12 lg:pt-12 lg:pb-16 overflow-hidden border-b border-[#D8C6A8]">
    <!-- Background Subtle Celestial Overlay -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-[#C49A45]/10 via-[#F7F0E3] to-[#FDFBF7] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-10 lg:space-y-14">
        
        <!-- MAIN DEVOTIONAL HERO ROW (Left Content + Right Temple Ganesha Image) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- LEFT COLUMN: Devotional Card, Buttons & Astrologer Profile Row (Order 2 on mobile, Order 1 on desktop) -->
            <div class="lg:col-span-6 space-y-6 text-left order-2 lg:order-1">
                
                <!-- 1. Small Outlined Badge -->
                <div class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full bg-[#F7F0E3] border border-[#D8C6A8] text-[#541F1D] text-xs font-bold uppercase tracking-widest shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-[#C49A45] animate-pulse"></span>
                    <span>AUDIO CONSULTATION</span>
                </div>

                <!-- 2. Devotional Card (Cream background with subtle gold border) -->
                <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-6 sm:p-8 shadow-sm space-y-4 relative overflow-hidden">
                    <!-- Subtle Corner Accent -->
                    <div class="absolute top-0 right-0 w-24 h-24 bg-[radial-gradient(#C49A45_1px,transparent_1px)] opacity-20 pointer-events-none [background-size:12px_12px]"></div>

                    <!-- Ganesha Emblem & Heading -->
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#EDE3D4] border border-[#D8C6A8] flex items-center justify-center p-1.5 flex-shrink-0 shadow-xs">
                            <img src="{{ asset('images/ganesha-logo.png') }}" alt="Ganesha Icon" class="w-full h-full object-contain" />
                        </div>
                        <h2 class="font-serif text-2xl sm:text-3xl font-bold text-[#541F1D] tracking-wide">
                            {{ \App\Models\SiteSetting::get('homepage_devotional_heading', 'জয় শ্রী গণেশ') }}
                        </h2>
                    </div>

                    <!-- Bengali Mantra Text -->
                    <div class="font-serif text-sm sm:text-base text-[#29211F] leading-relaxed space-y-1.5 pt-1 pl-1 border-l-2 border-[#C49A45]">
                        {!! nl2br(e(\App\Models\SiteSetting::get('homepage_devotional_mantra', "ওঁ তৎপুরুষায় বিদ্মহে,\nবক্রতুণ্ডায় ধীমহি।\nতন্নো দন্তী প্রচোদয়াৎ।"))) !!}
                    </div>

                    <p class="text-xs text-[#81766D] font-light pt-1">
                        Auspicious Vedic guidance & remedies by Astrologer Tamal Chakraborty.
                    </p>
                </div>

                <!-- 3. Two Action Buttons (Horizontal on Desktop) -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 pt-1">
                    <!-- Quick Booking Button -->
                    <a href="{{ route('consultation.book') }}" 
                       class="inline-flex items-center justify-center px-7 py-3.5 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-lg shadow-md border border-[#D8C6A8] hover:border-[#C49A45] transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-4 h-4 mr-2 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>QUICK BOOKING</span>
                    </a>

                    <!-- Explore Services Button -->
                    <a href="{{ route('services.index') }}" 
                       class="inline-flex items-center justify-center px-7 py-3.5 text-xs font-bold uppercase tracking-widest text-[#541F1D] bg-[#EDE3D4] hover:bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg transition-colors">
                        <span>Explore services</span>
                        <svg class="w-4 h-4 ml-2 text-[#541F1D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>

                <!-- 4. Compact Astrologer Identity Row -->
                <div class="pt-3 flex items-center space-x-3.5 border-t border-[#D8C6A8]/60">
                    <img src="{{ asset('images/tamal_hero_portrait.jpg') }}" 
                         alt="Tamal Chakraborty" 
                         class="w-11 h-11 rounded-full object-cover object-top border-2 border-[#D8C6A8] shadow-sm flex-shrink-0" />
                    <img src="{{ asset('images/astrotamal-logo.png') }}" 
                         alt="তমাল চক্রবর্তী — Ganesha Astro Consultancy" 
                         class="h-9 sm:h-10 w-auto object-contain" />
                </div>

            </div>

            <!-- RIGHT COLUMN: High Quality Devotional Temple Ganesha Image (Order 1 on mobile, Order 2 on desktop) -->
            <div class="lg:col-span-6 relative flex justify-center lg:justify-end order-1 lg:order-2">
                <div class="relative w-full max-w-lg mx-auto lg:mr-0">
                    <!-- Soft Warm Glow Backdrop -->
                    <div class="absolute -inset-2 rounded-3xl bg-gradient-to-tr from-[#C49A45]/30 via-transparent to-[#541F1D]/20 blur-xl opacity-70"></div>
                    
                    <!-- Temple Ganesha Image Frame -->
                    <div class="relative rounded-2xl overflow-hidden border-2 border-[#D8C6A8] shadow-2xl bg-[#351211]">
                        <img src="{{ asset('images/ganesha-temple-hero.jpg') }}" 
                             alt="Lord Ganesha Temple - Ganesha Astro Consultancy" 
                             class="w-full h-[320px] xs:h-[380px] sm:h-[460px] lg:h-[520px] object-cover object-center" />
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-[#351211]/80 via-transparent to-transparent opacity-60"></div>
                        
                        <!-- Elegant Bottom Caption Overlay -->
                        <div class="absolute bottom-4 left-4 right-4 bg-[#F7F0E3]/95 backdrop-blur-md p-3.5 rounded-xl border border-[#D8C6A8] flex items-center justify-between shadow-md">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-[#C49A45] block">AUSPICIOUS BLESSINGS</span>
                                <p class="font-serif text-xs font-bold text-[#541F1D]">Vedic Astrological Remedies & Chart Analysis</p>
                            </div>
                            <span class="text-xl text-[#C49A45]">ॐ</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- 5-ITEM FEATURE STRIP (Positioned Below Hero Content) -->
        <div class="pt-4 border-t border-[#D8C6A8]">
            <div class="bg-[#EDE3D4] text-[#29211F] rounded-2xl p-6 lg:p-7 border border-[#D8C6A8] shadow-sm">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 text-center lg:text-left">
                    
                    <!-- Item 1 -->
                    <div class="flex items-center space-x-3 justify-center lg:justify-start p-1">
                        <div class="w-10 h-10 rounded-full bg-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D] flex-shrink-0">
                            <svg class="w-5 h-5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <h5 class="font-serif-luxury font-bold text-sm leading-tight text-[#29211F]">Vedic Astrology</h5>
                            <span class="text-[11px] text-[#81766D] block font-medium">Authentic Knowledge</span>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="flex items-center space-x-3 justify-center lg:justify-start p-1">
                        <div class="w-10 h-10 rounded-full bg-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D] flex-shrink-0">
                            <svg class="w-5 h-5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <h5 class="font-serif-luxury font-bold text-sm leading-tight text-[#29211F]">Personalized Guidance</h5>
                            <span class="text-[11px] text-[#81766D] block font-medium">Solutions for Your Life</span>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="flex items-center space-x-3 justify-center lg:justify-start p-1">
                        <div class="w-10 h-10 rounded-full bg-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D] flex-shrink-0">
                            <svg class="w-5 h-5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <div>
                            <h5 class="font-serif-luxury font-bold text-sm leading-tight text-[#29211F]">Confidential & Secure</h5>
                            <span class="text-[11px] text-[#81766D] block font-medium">Your Privacy Is Priority</span>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="flex items-center space-x-3 justify-center lg:justify-start p-1">
                        <div class="w-10 h-10 rounded-full bg-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D] flex-shrink-0">
                            <svg class="w-5 h-5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <h5 class="font-serif-luxury font-bold text-sm leading-tight text-[#29211F]">Practical Remedies</h5>
                            <span class="text-[11px] text-[#81766D] block font-medium">Easy & Effective</span>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="flex items-center space-x-3 justify-center lg:justify-start p-1 col-span-2 md:col-span-1">
                        <div class="w-10 h-10 rounded-full bg-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D] flex-shrink-0">
                            <svg class="w-5 h-5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h5 class="font-serif-luxury font-bold text-sm leading-tight text-[#29211F]">Global Consultation</h5>
                            <span class="text-[11px] text-[#81766D] block font-medium">Serving Worldwide</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<!-- ==========================================
     SECTION 3: COMPACT QUICK BOOKING (Soft Beige #EDE3D4 Background)
     ========================================== -->
<section class="bg-[#EDE3D4] text-[#29211F] py-8 lg:py-10 border-b border-[#D8C6A8] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header (Compact) -->
        <div class="text-center max-w-xl mx-auto mb-6 lg:mb-7 space-y-1">
            <span class="block text-[10px] sm:text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">
                BOOKING
            </span>
            <h2 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#541F1D] flex items-center justify-center space-x-1.5">
                <span>⚡</span>
                <span>QUICK BOOKING</span>
            </h2>
        </div>

        <!-- 2 Compact Consultation Cards (Side-by-side on desktop, stacked on mobile, height ~130-150px) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6 max-w-4xl mx-auto items-stretch">
            
            <!-- Card 1: Urgent Consultation -->
            <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-xl p-4 sm:p-5 shadow-xs hover:shadow-sm hover:border-[#C49A45] transition-all duration-300 flex flex-col justify-between">
                <!-- Top Row: Title + Badge -->
                <div class="flex items-center justify-between flex-wrap gap-2">
                    <h3 class="font-serif-luxury text-xs sm:text-sm font-bold uppercase tracking-wider text-[#541F1D]">
                        URGENT CONSULTATION
                    </h3>
                    <span class="px-2.5 py-0.5 text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] rounded border border-[#D8C6A8]">
                        WITHIN 24 HOURS
                    </span>
                </div>

                <!-- Middle Row: Description -->
                <p class="text-[11px] sm:text-xs text-[#81766D] font-normal leading-snug my-2">
                    Appointment should be within 24 hours
                </p>

                <!-- Bottom Row: Price + Book Now Button -->
                <div class="flex items-center justify-between pt-2.5 border-t border-[#D8C6A8]/60 mt-auto">
                    <span class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#541F1D]">
                        ₹5,000
                    </span>

                    <a href="{{ route('consultation.book', ['type' => 'urgent']) }}" 
                       class="inline-flex items-center justify-center px-4 py-2 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-[#FDFBF7] bg-[#541F1D] hover:bg-[#351211] rounded-lg shadow-xs border border-[#D8C6A8] hover:border-[#C49A45] transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                        <span>Book Now</span>
                        <svg class="w-3.5 h-3.5 ml-1 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Card 2: Normal Consultation -->
            <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-xl p-4 sm:p-5 shadow-xs hover:shadow-sm hover:border-[#C49A45] transition-all duration-300 flex flex-col justify-between">
                <!-- Top Row: Title + Badge -->
                <div class="flex items-center justify-between flex-wrap gap-2">
                    <h3 class="font-serif-luxury text-xs sm:text-sm font-bold uppercase tracking-wider text-[#541F1D]">
                        NORMAL CONSULTATION
                    </h3>
                    <span class="px-2.5 py-0.5 text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-[#541F1D] bg-[#EDE3D4] rounded border border-[#D8C6A8]">
                        WITHIN A WEEK
                    </span>
                </div>

                <!-- Middle Row: Description -->
                <p class="text-[11px] sm:text-xs text-[#81766D] font-normal leading-snug my-2">
                    Appointment within one week
                </p>

                <!-- Bottom Row: Price + Book Now Button -->
                <div class="flex items-center justify-between pt-2.5 border-t border-[#D8C6A8]/60 mt-auto">
                    <span class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#541F1D]">
                        ₹3,000
                    </span>

                    <a href="{{ route('consultation.book', ['type' => 'normal']) }}" 
                       class="inline-flex items-center justify-center px-4 py-2 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-[#FDFBF7] bg-[#541F1D] hover:bg-[#351211] rounded-lg shadow-xs border border-[#D8C6A8] hover:border-[#C49A45] transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                        <span>Book Now</span>
                        <svg class="w-3.5 h-3.5 ml-1 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ==========================================
     SECTION 4: ASTROLOGY SERVICES (Light Ivory #FDFBF7 Background)
     ========================================== -->
<section class="pt-20 pb-28 lg:pt-28 lg:pb-36 relative border-b border-[#D8C6A8] w-full bg-[#FDFBF7] text-[#29211F]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 lg:mb-16">
            <div class="max-w-3xl">
                <!-- Eyebrow -->
                <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.2em] uppercase mb-2 text-[#C49A45]">
                    <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                    <span>ASTROLOGY CONSULTATION</span>
                </div>

                <!-- Main Heading -->
                <h2 class="font-serif-luxury text-3xl sm:text-4xl lg:text-[44px] font-bold leading-[1.12] mb-3 text-[#29211F]">
                    Astrological Guidance for <br class="hidden sm:inline"/>
                    <span class="italic font-serif-luxury text-[#C49A45]">Life's Important Decisions</span>
                </h2>

                <!-- Supporting Text -->
                <p class="text-sm sm:text-base leading-relaxed font-normal mb-3 max-w-2xl text-[#81766D]">
                    Through birth chart analysis, planetary transits and the study of time, gain a deeper understanding of important phases, opportunities and challenges in life.
                </p>

                <!-- Brand Philosophy Quote -->
                <div class="flex items-start space-x-1.5 text-xs sm:text-sm font-serif-luxury italic text-[#81766D]">
                    <span class="text-lg font-bold leading-none mt-0.5 text-[#C49A45]">“</span>
                    <span>"Planets are not the only thing — time speaks. And I speak of time."</span>
                </div>
            </div>

            <!-- Top Right Link: EXPLORE ALL SERVICES → -->
            <a href="{{ route('services.index') }}" 
               class="inline-flex items-center text-xs font-bold uppercase tracking-wider transition-colors pb-1 border-b-2 self-start md:self-auto mt-6 md:mt-0 flex-shrink-0 text-[#541F1D] border-[#541F1D] hover:text-[#351211]">
                <span>EXPLORE ALL SERVICES</span>
                <svg class="w-4 h-4 ml-1.5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <!-- 6 Service Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach($services as $index => $service)
                <x-service-card :service="$service" :index="$loop->iteration" />
            @endforeach
        </div>

    </div>
</section>

<!-- ==========================================
     SECTION 5: ABOUT TAMAL CHAKRABORTY (Soft Beige #EDE3D4 Background)
     ========================================== -->
<section class="bg-[#EDE3D4] text-[#29211F] py-20 lg:py-28 border-y border-[#D8C6A8] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- Left Image Column -->
            <div class="lg:col-span-6 relative">
                <div class="relative rounded-2xl overflow-hidden shadow-xl border border-[#D8C6A8] group">
                    <img src="{{ asset('images/tamal_about_study.jpg') }}" 
                         alt="Tamal Chakraborty at study" 
                         class="w-full h-[450px] sm:h-[520px] object-cover object-center group-hover:scale-105 transition-transform duration-700"
                         onerror="this.src='https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=800&auto=format&fit=crop'">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#29211F]/60 via-transparent to-transparent"></div>

                    <!-- Floating Experience Badge -->
                    <div class="absolute bottom-6 left-6 bg-[#541F1D] text-[#F7F0E3] p-4 sm:p-5 rounded-xl border border-[#D8C6A8] shadow-lg flex items-center space-x-4 backdrop-blur-md">
                        <span class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#C49A45] leading-none">15+</span>
                        <div class="text-left">
                            <span class="block text-xs font-bold uppercase tracking-wider text-[#F7F0E3]">Years of</span>
                            <span class="block text-[11px] text-[#D8C6A8]">Vedic Experience</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Bio Content -->
            <div class="lg:col-span-6 space-y-6">
                <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] text-[#C49A45] uppercase">
                    <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                    <span>ABOUT TAMAL CHAKRABORTY</span>
                </div>

                <h2 class="font-serif-luxury text-3xl sm:text-5xl font-bold text-[#29211F] leading-tight">
                    Guiding Lives with <br/>
                    <span class="text-[#C49A45] italic">Ancient Wisdom</span>
                </h2>

                <p class="text-sm sm:text-base text-[#81766D] leading-relaxed font-normal">
                    Tamal Chakraborty is a renowned Vedic Astrologer with over 15 years of experience in helping people find clarity, balance, and direction in life. Combining deep classical scriptural knowledge with modern analytical remedies, he provides practical and non-superstitious guidance for real-life challenges.
                </p>

                <!-- Expertise Checklist -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-2">
                    <div class="flex items-center space-x-3 p-2.5 rounded-lg bg-[#FDFBF7] border border-[#D8C6A8]">
                        <div class="w-7 h-7 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs sm:text-sm font-semibold text-[#29211F]">Vedic Astrology</span>
                    </div>
                    <div class="flex items-center space-x-3 p-2.5 rounded-lg bg-[#FDFBF7] border border-[#D8C6A8]">
                        <div class="w-7 h-7 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs sm:text-sm font-semibold text-[#29211F]">Numerology</span>
                    </div>
                    <div class="flex items-center space-x-3 p-2.5 rounded-lg bg-[#FDFBF7] border border-[#D8C6A8]">
                        <div class="w-7 h-7 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs sm:text-sm font-semibold text-[#29211F]">Vastu Consultation</span>
                    </div>
                    <div class="flex items-center space-x-3 p-2.5 rounded-lg bg-[#FDFBF7] border border-[#D8C6A8]">
                        <div class="w-7 h-7 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs sm:text-sm font-semibold text-[#29211F]">Gemstone Guidance</span>
                    </div>
                    <div class="flex items-center space-x-3 p-2.5 rounded-lg bg-[#FDFBF7] border border-[#D8C6A8] sm:col-span-2">
                        <div class="w-7 h-7 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs sm:text-sm font-semibold text-[#29211F]">Spiritual Healing & Karmic Remedies</span>
                    </div>
                </div>

                <!-- CTA -->
                <div class="pt-4">
                    <a href="{{ route('about') }}" 
                       class="inline-flex items-center px-7 py-3.5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-lg shadow border border-[#D8C6A8] transition-colors">
                        <span>Know More About Me</span>
                        <svg class="w-4 h-4 ml-2 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 6: EXPERIENCE / STATS STRIP (Primary Burgundy #541F1D Background)
     ========================================== -->
<section class="bg-[#541F1D] text-[#F7F0E3] py-14 border-b border-[#D8C6A8]/40 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-8 text-center">
            
            <div class="space-y-1">
                <span class="font-serif-luxury text-4xl sm:text-5xl font-bold text-[#C49A45] block">15+</span>
                <span class="text-xs text-[#F7F0E3] font-medium tracking-wide uppercase">Years Experience</span>
            </div>

            <div class="space-y-1">
                <span class="font-serif-luxury text-4xl sm:text-5xl font-bold text-[#C49A45] block">1000+</span>
                <span class="text-xs text-[#F7F0E3] font-medium tracking-wide uppercase">Happy Clients</span>
            </div>

            <div class="space-y-1">
                <span class="font-serif-luxury text-4xl sm:text-5xl font-bold text-[#C49A45] block">5000+</span>
                <span class="text-xs text-[#F7F0E3] font-medium tracking-wide uppercase">Consultations</span>
            </div>

            <div class="space-y-1">
                <span class="font-serif-luxury text-4xl sm:text-5xl font-bold text-[#C49A45] block">95%</span>
                <span class="text-xs text-[#F7F0E3] font-medium tracking-wide uppercase">Positive Feedback</span>
            </div>

            <div class="space-y-1 col-span-2 md:col-span-1">
                <span class="font-serif-luxury text-4xl sm:text-5xl font-bold text-[#C49A45] block">10+</span>
                <span class="text-xs text-[#F7F0E3] font-medium tracking-wide uppercase">Countries Served</span>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 7: ZODIAC / HOROSCOPE SECTION (Light Ivory #FDFBF7 Background)
     ========================================== -->
<section class="py-24 lg:py-32 relative border-b border-[#D8C6A8] bg-[#FDFBF7] text-[#29211F]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        
        <!-- Editorial Centered Header -->
        <div class="max-w-3xl mx-auto mb-14 lg:mb-16 space-y-3">
            <span class="block text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">
                EXPLORE YOUR ZODIAC
            </span>

            <h2 class="font-serif-luxury text-3xl sm:text-5xl lg:text-[48px] font-bold leading-[1.12] text-[#29211F]">
                Know What the Stars Say About You
            </h2>

            <p class="text-sm sm:text-base leading-relaxed font-normal max-w-xl mx-auto text-[#81766D]">
                Explore daily, weekly and monthly predictions for your zodiac sign.
            </p>
        </div>

        <!-- 12 Zodiac Cards Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-6 gap-y-12 gap-x-6 sm:gap-x-8 items-start">
            @foreach($horoscopes as $zodiac)
                <x-zodiac-card :zodiac="$zodiac" />
            @endforeach
        </div>

    </div>
</section>

<!-- ==========================================
     SECTION 8: CONSULTATION PROCESS (Soft Beige #EDE3D4 Background)
     ========================================== -->
<section class="bg-[#EDE3D4] text-[#29211F] py-20 lg:py-28 relative overflow-hidden border-y border-[#D8C6A8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <x-section-heading 
            eyebrow="HOW IT WORKS"
            title="Book Your Consultation in"
            highlight="Just a Few Steps"
            subtext="Simple, confidential, and seamless process to get personal Vedic guidance."
            theme="light"
        />

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch mt-12">
            
            <!-- Left 4 Step Cards -->
            <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- Step 1 -->
                <div class="bg-[#FDFBF7] p-6 sm:p-7 rounded-2xl border border-[#D8C6A8] hover:border-[#C49A45] transition-colors flex flex-col justify-between shadow-sm">
                    <div>
                        <span class="font-serif-luxury text-3xl font-bold text-[#541F1D] block mb-3">01</span>
                        <h4 class="font-serif-luxury text-xl font-bold text-[#29211F] mb-2">Choose Service</h4>
                        <p class="text-xs text-[#81766D] leading-relaxed">Select the specific consultation service you need (Kundli, Marriage, Career, Vastu, etc.).</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="bg-[#FDFBF7] p-6 sm:p-7 rounded-2xl border border-[#D8C6A8] hover:border-[#C49A45] transition-colors flex flex-col justify-between shadow-sm">
                    <div>
                        <span class="font-serif-luxury text-3xl font-bold text-[#541F1D] block mb-3">02</span>
                        <h4 class="font-serif-luxury text-xl font-bold text-[#29211F] mb-2">Pick Date & Time</h4>
                        <p class="text-xs text-[#81766D] leading-relaxed">Choose a convenient slot that suits your schedule for video or audio session.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="bg-[#FDFBF7] p-6 sm:p-7 rounded-2xl border border-[#D8C6A8] hover:border-[#C49A45] transition-colors flex flex-col justify-between shadow-sm">
                    <div>
                        <span class="font-serif-luxury text-3xl font-bold text-[#541F1D] block mb-3">03</span>
                        <h4 class="font-serif-luxury text-xl font-bold text-[#29211F] mb-2">Make Payment</h4>
                        <p class="text-xs text-[#81766D] leading-relaxed">Complete your payment securely via online gateway, UPI, or PayPal.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="bg-[#FDFBF7] p-6 sm:p-7 rounded-2xl border border-[#D8C6A8] hover:border-[#C49A45] transition-colors flex flex-col justify-between shadow-sm">
                    <div>
                        <span class="font-serif-luxury text-3xl font-bold text-[#541F1D] block mb-3">04</span>
                        <h4 class="font-serif-luxury text-xl font-bold text-[#29211F] mb-2">Get Confirmation</h4>
                        <p class="text-xs text-[#81766D] leading-relaxed">Receive instant confirmation and meeting link on WhatsApp & Email.</p>
                    </div>
                </div>

            </div>

            <!-- Right CTA Card -->
            <div class="lg:col-span-4 bg-[#F7F0E3] border-2 border-[#D8C6A8] rounded-2xl p-8 flex flex-col items-center justify-center text-center shadow-md">
                <div class="w-14 h-14 rounded-full bg-[#541F1D] border border-[#D8C6A8] flex items-center justify-center text-[#C49A45] mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                </div>

                <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F] leading-tight mb-3">
                    Start Your Journey Towards a <span class="text-[#C49A45] italic">Better Tomorrow</span>
                </h3>

                <p class="text-xs text-[#81766D] leading-relaxed mb-8 font-normal">
                    Take the first step to uncover your planetary alignments and resolve life's challenges.
                </p>

                <a href="{{ route('consultation.book') }}" 
                   class="block text-center w-full py-4 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-lg shadow-md transition-all border border-[#D8C6A8]">
                    Book a Consultation →
                </a>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 9: TESTIMONIALS (Warm Cream #F7F0E3 Background)
     ========================================== -->
<section class="bg-[#F7F0E3] text-[#29211F] py-20 lg:py-28 border-b border-[#D8C6A8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-section-heading 
            eyebrow="TESTIMONIALS"
            title="What My Clients Say"
            subtext="Real experiences from people who have received guidance and remedies."
            theme="light"
        />

        <!-- 6 Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <x-testimonial-card :testimonial="$testimonial" />
            @endforeach
        </div>

        <!-- VIEW MORE TESTIMONIALS CTA -->
        <div class="mt-12 text-center">
            <a href="{{ route('testimonials.index') }}" 
               class="group inline-flex items-center px-8 py-4 text-xs font-bold uppercase tracking-widest text-[#541F1D] bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg hover:border-[#C49A45] hover:bg-[#EDE3D4] transition-all shadow-sm">
                <span>VIEW MORE TESTIMONIALS</span>
                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>

<!-- ==========================================
     SECTION 10: ASTROLOGY BLOG (Light Ivory #FDFBF7 Background)
     ========================================== -->
<section class="bg-[#FDFBF7] text-[#29211F] py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 lg:mb-16">
            <x-section-heading 
                eyebrow="ASTROLOGY INSIGHTS"
                title="Latest Articles & Blogs"
                subtext="Stay updated with astrology tips, guidance and spiritual insights."
                :centered="false"
                theme="light"
            />

            <a href="{{ route('blog.index') }}" 
               class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-[#541F1D] hover:text-[#351211] transition-colors pb-2 border-b border-[#541F1D] hover:border-[#351211] self-start md:self-auto mt-4 md:mt-0">
                <span>View All Articles</span>
                <svg class="w-4 h-4 ml-1.5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($blogPosts as $post)
                <x-blog-card :post="$post" />
            @endforeach
        </div>

    </div>
</section>

<!-- ==========================================
     SECTION 12: FAQ SECTION (Soft Beige #EDE3D4 Background)
     ========================================== -->
<section class="bg-[#EDE3D4] text-[#29211F] py-20 lg:py-28 border-b border-[#D8C6A8]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-section-heading 
            eyebrow="FREQUENTLY ASKED QUESTIONS"
            title="Have Questions? We Have Answers."
            subtext="Find answers to common questions about astrology, consultation process, and privacy."
            theme="light"
        />

        <div class="space-y-4">
            @foreach($faqs as $faq)
                <x-faq-accordion :faq="$faq" :index="$loop->index" />
            @endforeach
        </div>

    </div>
</section>

<!-- ==========================================
     SECTION 13: CONTACT SECTION (Soft Beige #EDE3D4 Background)
     ========================================== -->
<section class="pt-24 pb-28 lg:pt-32 lg:pb-36 relative border-t border-[#D8C6A8] overflow-hidden bg-[#EDE3D4] text-[#29211F]">
    
    <!-- Background Accents -->
    <div class="absolute top-12 left-10 w-72 h-72 bg-[#C49A45]/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-12 right-10 w-80 h-80 bg-[#C49A45]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="max-w-3xl mx-auto text-center mb-16 lg:mb-20 space-y-3">
            <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] uppercase text-[#C49A45]">
                <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                <span>GET IN TOUCH</span>
            </div>

            <h2 class="font-serif-luxury text-3xl sm:text-5xl lg:text-[48px] font-bold leading-[1.12] text-[#29211F]">
                Let's Connect
            </h2>

            <p class="text-sm sm:text-base leading-relaxed font-normal max-w-xl mx-auto text-[#81766D]">
                Have a question or want to book a consultation? Reach out to us.
            </p>
        </div>

        <!-- 3-Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch">
            
            <!-- LEFT COLUMN: Contact Information Panel (4 Cols) -->
            <div class="lg:col-span-4 group bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-7 lg:p-8 shadow-sm relative overflow-hidden transition-all duration-300 hover:shadow-md hover:border-[#C49A45] flex flex-col justify-between">
                <div class="absolute top-0 left-0 right-0 h-1 bg-[#541F1D]"></div>
                
                <div class="space-y-6">
                    
                    <!-- Website -->
                    <div class="flex items-start space-x-4">
                        <div class="w-11 h-11 rounded-full bg-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D] flex-shrink-0 shadow-xs">
                            <svg class="w-5 h-5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        </div>
                        <div>
                            <span class="block text-[11px] uppercase font-bold tracking-widest text-[#C49A45]">WEBSITE</span>
                            <a href="https://astrotamal.com" target="_blank" rel="noopener noreferrer" class="block font-serif-luxury text-base sm:text-lg font-bold text-[#29211F] hover:text-[#541F1D] transition-colors mt-0.5">astrotamal.com</a>
                        </div>
                    </div>

                    <div class="border-t border-[#D8C6A8]/40"></div>

                    <!-- Email -->
                    <div class="flex items-start space-x-4">
                        <div class="w-11 h-11 rounded-full bg-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D] flex-shrink-0 shadow-xs">
                            <svg class="w-5 h-5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[11px] uppercase font-bold tracking-widest text-[#C49A45]">EMAIL</span>
                            <a href="mailto:support@astrotamal.com" class="block font-serif-luxury text-base sm:text-lg font-bold text-[#29211F] hover:text-[#541F1D] transition-colors mt-0.5 truncate">support@astrotamal.com</a>
                        </div>
                    </div>

                    <div class="border-t border-[#D8C6A8]/40"></div>

                    <!-- Phone -->
                    <div class="flex items-start space-x-4">
                        <div class="w-11 h-11 rounded-full bg-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D] flex-shrink-0 shadow-xs">
                            <svg class="w-5 h-5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <span class="block text-[11px] uppercase font-bold tracking-widest text-[#C49A45]">CONTACT</span>
                            <a href="tel:+919647680707" class="block font-serif-luxury text-base sm:text-lg font-bold text-[#29211F] hover:text-[#541F1D] transition-colors mt-0.5">96476 80707</a>
                        </div>
                    </div>

                    <div class="border-t border-[#D8C6A8]/40"></div>

                    <!-- Chamber Location -->
                    <div class="flex items-start space-x-4">
                        <div class="w-11 h-11 rounded-full bg-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D] flex-shrink-0 shadow-xs">
                            <svg class="w-5 h-5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <span class="block text-[11px] uppercase font-bold tracking-widest text-[#C49A45]">CHAMBER ADDRESS</span>
                            <span class="block font-serif-luxury text-sm font-bold text-[#29211F] mt-0.5">Kolkata | Bongaon | Ranaghat & More</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- CENTER COLUMN: Contact Form Card (5 Cols) -->
            <div class="lg:col-span-5 group bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-7 sm:p-9 shadow-md relative overflow-hidden transition-all duration-300 hover:shadow-lg hover:border-[#C49A45] flex flex-col justify-between">
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-[#541F1D]"></div>
                
                <div>
                    <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F] mb-1.5">Send Us a Message</h3>
                    <p class="text-xs sm:text-sm text-[#81766D] leading-relaxed mb-6 font-normal">We'd love to hear from you. Send us a message and we'll get back to you.</p>
                    
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4 text-xs sm:text-sm">
                        @csrf
                        <div>
                            <label class="block text-[#29211F] font-semibold mb-1.5 text-xs">Your Name *</label>
                            <input type="text" name="name" required placeholder="e.g. Anish Roy" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#29211F] placeholder-[#81766D]/60 transition-all focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45]/40">
                        </div>
                        <div>
                            <label class="block text-[#29211F] font-semibold mb-1.5 text-xs">Your Email *</label>
                            <input type="email" name="email" required placeholder="anish@example.com" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#29211F] placeholder-[#81766D]/60 transition-all focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45]/40">
                        </div>
                        <div>
                            <label class="block text-[#29211F] font-semibold mb-1.5 text-xs">Phone Number</label>
                            <input type="tel" name="phone" placeholder="e.g. 96476 80707" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#29211F] placeholder-[#81766D]/60 transition-all focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45]/40">
                        </div>
                        <div>
                            <label class="block text-[#29211F] font-semibold mb-1.5 text-xs">Your Message *</label>
                            <textarea name="message" rows="4" required placeholder="How can we assist you?" class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl px-4 py-3 text-[#29211F] placeholder-[#81766D]/60 transition-all focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45]/40"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 px-6 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-xl shadow border border-[#D8C6A8] hover:border-[#C49A45] transition-all duration-300 flex items-center justify-center space-x-2">
                            <span>SEND MESSAGE</span>
                            <svg class="w-4 h-4 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- RIGHT COLUMN: Location / In-Person Consultation Card (3 Cols) -->
            <div class="lg:col-span-3 group bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-6 lg:p-7 shadow-sm relative overflow-hidden transition-all duration-300 hover:shadow-md hover:border-[#C49A45] flex flex-col justify-between">
                <div class="absolute top-0 left-0 right-0 h-1 bg-[#541F1D]"></div>
                
                <div class="space-y-5">
                    <!-- Location Visual -->
                    <div class="relative w-full rounded-xl overflow-hidden shadow-inner border border-[#D8C6A8] bg-[#F7F0E3]" style="aspect-ratio: 4 / 3;">
                        <img src="https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?q=80&w=600&auto=format&fit=crop" 
                             alt="Kolkata Sanctuary Location" 
                             class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500 block">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#29211F]/60 via-transparent to-transparent"></div>
                        
                        <div class="absolute bottom-3 left-3 right-3 flex items-center space-x-2.5 bg-[#F7F0E3]/95 backdrop-blur-md p-2.5 rounded-lg border border-[#D8C6A8] shadow">
                            <div class="w-7 h-7 rounded-full bg-[#541F1D] text-[#F7F0E3] flex items-center justify-center flex-shrink-0 text-xs font-bold">📍</div>
                            <div>
                                <span class="block font-serif-luxury text-xs font-bold text-[#29211F] leading-tight">Kolkata Sanctuary</span>
                                <span class="block text-[10px] text-[#C49A45] leading-none">West Bengal, India</span>
                            </div>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="space-y-2">
                        <div class="inline-flex items-center space-x-1.5 text-[11px] font-bold uppercase tracking-wider text-[#C49A45]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>IN-PERSON CONSULTATION</span>
                        </div>

                        <p class="text-xs sm:text-sm text-[#81766D] leading-relaxed font-normal">
                            In-person consultations are available by prior appointment at our Kolkata sanctuary.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
