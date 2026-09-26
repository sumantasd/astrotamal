@extends('layouts.app')

@section('title', 'Tamal Chakraborty — Premium Vedic Astrologer & Spiritual Mentor')

@section('content')<!-- ==========================================
     SECTION 2: HERO SECTION (Dark Cinematic with 5-Item Feature Strip at Bottom)
     ========================================== -->
<section class="relative bg-navy-950 text-white pt-8 pb-12 lg:pt-12 lg:pb-16 overflow-hidden">
    <!-- Starfield & Celestial Background Glow -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gold-500/10 via-navy-900 to-navy-950 pointer-events-none"></div>

    <!-- Zodiac Halo Wheel behind portrait -->
    <div class="absolute top-6 right-0 w-[600px] h-[600px] lg:w-[800px] lg:h-[800px] opacity-15 animate-spin-slow pointer-events-none transform translate-x-1/4 -translate-y-10">
        <svg viewBox="0 0 500 500" class="w-full h-full text-gold-400 stroke-current fill-none" stroke-width="1">
            <circle cx="250" cy="250" r="240"/>
            <circle cx="250" cy="250" r="210" stroke-dasharray="4 4"/>
            <circle cx="250" cy="250" r="170"/>
            <circle cx="250" cy="250" r="120" stroke-dasharray="8 8"/>
            <line x1="250" y1="10" x2="250" y2="490"/>
            <line x1="10" y1="250" x2="490" y2="250"/>
            <line x1="80" y1="80" x2="420" y2="420"/>
            <line x1="80" y1="420" x2="420" y2="80"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-10 lg:space-y-14">
        
        <!-- MAIN HERO CONTENT ROW (Left Intro + Right Portrait) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start lg:items-center">
            
            <!-- Left Hero Text (Positions Intro Content Upward & Balanced) -->
            <div class="lg:col-span-7 space-y-5 text-center lg:text-left">
                <!-- Small Eyebrow -->
                <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] text-gold-400 uppercase">
                    <span class="w-2 h-2 rounded-full bg-gold-500"></span>
                    <span>DISCOVER • UNDERSTAND • TRANSFORM</span>
                </div>

                <!-- Main Brand Title -->
                <div>
                    <h1 class="font-serif-luxury text-4xl sm:text-6xl lg:text-7xl font-bold tracking-tight text-white leading-[1.08]">
                        Tamal Chakraborty
                    </h1>
                    <p class="text-xs sm:text-sm font-semibold tracking-[0.25em] text-gold-400 uppercase mt-1.5">
                        ASTROLOGER | VEDIC ASTROLOGY | SPIRITUAL GUIDANCE
                    </p>
                </div>

                <!-- Main Headline with Gold Emphasis -->
                <h2 class="font-serif-luxury text-3xl sm:text-5xl lg:text-5xl font-semibold text-slate-100 leading-tight">
                    Your Life Has a <br class="hidden sm:inline"/>
                    <span class="text-gold-gradient italic font-bold">Divine Blueprint</span>
                </h2>

                <!-- Supporting Text -->
                <p class="text-sm sm:text-base text-slate-300 max-w-xl font-light leading-relaxed">
                    Get personalized astrological guidance for a better tomorrow. Understand your life path, remove obstacles, and unlock new opportunities with the ancient wisdom of Vedic astrology.
                </p>

                <!-- CTA Buttons -->
                <div class="pt-1 flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-5">
                    <a href="{{ route('consultation.book') }}" 
                       class="w-full sm:w-auto px-8 py-4 text-xs font-bold uppercase tracking-widest text-navy-950 bg-gold-gradient rounded-lg shadow-xl gold-glow hover:scale-[1.03] transition-all border border-gold-300 text-center">
                        Book a Consultation →
                    </a>
                    
                    <a href="{{ route('services.index') }}" 
                       class="w-full sm:w-auto px-8 py-4 text-xs font-bold uppercase tracking-widest text-gold-300 border border-gold-500/40 rounded-lg hover:border-gold-500 hover:bg-gold-500/10 transition-all text-center">
                        Explore Services
                    </a>
                </div>

                <!-- Hero Trust Stats Pill -->
                <div class="pt-5 border-t border-slate-800/80 flex items-center justify-center lg:justify-start space-x-8 text-xs text-slate-300">
                    <div class="flex items-center space-x-2">
                        <span class="font-serif-luxury text-xl font-bold text-gold-400">15+</span>
                        <span class="text-[11px] text-slate-400 leading-tight">Years of<br/>Experience</span>
                    </div>
                    <div class="h-8 w-px bg-slate-800"></div>
                    <div class="flex items-center space-x-2">
                        <span class="font-serif-luxury text-xl font-bold text-gold-400">1000+</span>
                        <span class="text-[11px] text-slate-400 leading-tight">Happy<br/>Clients</span>
                    </div>
                    <div class="h-8 w-px bg-slate-800"></div>
                    <div class="flex items-center space-x-2">
                        <span class="font-serif-luxury text-xl font-bold text-gold-400">95%</span>
                        <span class="text-[11px] text-slate-400 leading-tight">Positive<br/>Feedback</span>
                    </div>
                </div>
            </div>

            <!-- Right Hero Portrait Composition -->
            <div class="lg:col-span-5 relative flex justify-center lg:justify-end">
                <div class="relative w-full max-w-md">
                    
                    <!-- Decorative Golden Frame & Glow -->
                    <div class="absolute -inset-2 rounded-3xl bg-gradient-to-tr from-gold-500/40 via-transparent to-gold-400/20 blur-xl opacity-70"></div>
                    
                    <!-- Main Portrait Image Card -->
                    <div class="relative rounded-2xl overflow-hidden border-2 border-gold-500/40 shadow-2xl bg-navy-900">
                        <img src="{{ asset('images/tamal_hero_portrait.jpg') }}" 
                             alt="Tamal Chakraborty - Vedic Astrologer" 
                             class="w-full h-[460px] sm:h-[520px] object-cover object-top"
                             onerror="this.src='https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=800&auto=format&fit=crop'">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-transparent to-transparent opacity-80"></div>

                        <!-- Floating Quote Overlay on Bottom Right -->
                        <div class="absolute bottom-4 right-4 max-w-[210px] bg-navy-950/85 backdrop-blur-md p-3.5 rounded-xl border border-gold-500/30 text-right shadow-lg">
                            <p class="font-serif-luxury text-xs italic text-gold-300 leading-tight">
                                "Astrology is a Guidance, not a Fate."
                            </p>
                            <span class="block text-[9px] uppercase tracking-wider text-slate-400 mt-1 font-semibold">
                                — Tamal Chakraborty
                            </span>
                        </div>

                        <!-- Floating Video Badge on Bottom Left -->
                        <a href="{{ route('consultation.book') }}" class="absolute bottom-4 left-4 bg-navy-950/90 backdrop-blur-md p-2.5 pr-4 rounded-xl border border-gold-500/30 flex items-center space-x-3 shadow-lg hover:border-gold-500 cursor-pointer transition-colors">
                            <div class="w-8 h-8 rounded-full bg-gold-gradient flex items-center justify-center text-navy-950 flex-shrink-0 shadow">
                                <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                            <div class="text-left">
                                <span class="block text-xs font-bold text-white leading-tight">Watch Intro</span>
                                <span class="block text-[10px] text-gold-400">2:30 minutes</span>
                            </div>
                        </a>
                    </div>

                </div>
            </div>

        </div>

        <!-- 5-ITEM FEATURE / BENEFIT STRIP (Positioned at Lower Part of Hero, Below Main Content & Portrait) -->
        <div class="pt-4 border-t border-slate-800/80">
            <div class="bg-ivory-100 text-[#17202D] rounded-2xl p-6 lg:p-7 border border-ivory-300 shadow-xl">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 text-center lg:text-left">
                    
                    <!-- Item 1 -->
                    <div class="flex items-center space-x-3 justify-center lg:justify-start p-1">
                        <div class="w-10 h-10 rounded-full bg-ivory-200 border border-[#B08A2E]/50 flex items-center justify-center text-[#B08A2E] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <h5 class="font-serif-luxury font-bold text-sm leading-tight text-[#17202D]">Vedic Astrology</h5>
                            <span class="text-[11px] text-[#687180] block font-medium">Authentic Knowledge</span>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="flex items-center space-x-3 justify-center lg:justify-start p-1">
                        <div class="w-10 h-10 rounded-full bg-ivory-200 border border-[#B08A2E]/50 flex items-center justify-center text-[#B08A2E] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <h5 class="font-serif-luxury font-bold text-sm leading-tight text-[#17202D]">Personalized Guidance</h5>
                            <span class="text-[11px] text-[#687180] block font-medium">Solutions for Your Life</span>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="flex items-center space-x-3 justify-center lg:justify-start p-1">
                        <div class="w-10 h-10 rounded-full bg-ivory-200 border border-[#B08A2E]/50 flex items-center justify-center text-[#B08A2E] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <div>
                            <h5 class="font-serif-luxury font-bold text-sm leading-tight text-[#17202D]">Confidential & Secure</h5>
                            <span class="text-[11px] text-[#687180] block font-medium">Your Privacy Is Priority</span>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="flex items-center space-x-3 justify-center lg:justify-start p-1">
                        <div class="w-10 h-10 rounded-full bg-ivory-200 border border-[#B08A2E]/50 flex items-center justify-center text-[#B08A2E] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <h5 class="font-serif-luxury font-bold text-sm leading-tight text-[#17202D]">Practical Remedies</h5>
                            <span class="text-[11px] text-[#687180] block font-medium">Easy & Effective</span>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="flex items-center space-x-3 justify-center lg:justify-start p-1 col-span-2 md:col-span-1">
                        <div class="w-10 h-10 rounded-full bg-ivory-200 border border-[#B08A2E]/50 flex items-center justify-center text-[#B08A2E] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h5 class="font-serif-luxury font-bold text-sm leading-tight text-[#17202D]">Global Consultation</h5>
                            <span class="text-[11px] text-[#687180] block font-medium">Serving Worldwide</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

</section>

<!-- ==========================================
     SECTION 4: ASTROLOGY SERVICES (Guaranteed Light Ivory #FDFBF7 Background)
     ========================================== -->
<section class="pt-20 pb-28 lg:pt-28 lg:pb-36 relative border-b border-ivory-300 w-full" style="background-color: #FDFBF7 !important; color: #17202D !important;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header matching reference image layout -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 lg:mb-16">
            <div class="max-w-3xl">
                <!-- Eyebrow with gold dot -->
                <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.2em] uppercase mb-2" style="color: #B08A2E !important;">
                    <span class="w-2 h-2 rounded-full" style="background-color: #B08A2E !important;"></span>
                    <span style="color: #B08A2E !important;">ASTROLOGY CONSULTATION</span>
                </div>

                <!-- Main Heading -->
                <h2 class="font-serif-luxury text-3xl sm:text-4xl lg:text-[44px] font-bold leading-[1.12] mb-3" style="color: #17202D !important;">
                    Astrological Guidance for <br class="hidden sm:inline"/>
                    <span class="italic font-serif-luxury" style="color: #9A7422 !important;">Life's Important Decisions</span>
                </h2>

                <!-- Supporting Text -->
                <p class="text-sm sm:text-base leading-relaxed font-normal mb-3 max-w-2xl" style="color: #4B5563 !important;">
                    Through birth chart analysis, planetary transits and the study of time, gain a deeper understanding of important phases, opportunities and challenges in life.
                </p>

                <!-- Brand Philosophy Quote -->
                <div class="flex items-start space-x-1.5 text-xs sm:text-sm font-serif-luxury italic" style="color: #4B5563 !important;">
                    <span class="text-lg font-bold leading-none mt-0.5" style="color: #B08A2E !important;">“</span>
                    <span style="color: #4B5563 !important;">"Planets are not the only thing — time speaks. And I speak of time."</span>
                </div>
            </div>

            <!-- Top Right Link: EXPLORE ALL SERVICES → -->
            <a href="{{ route('services.index') }}" 
               class="inline-flex items-center text-xs font-bold uppercase tracking-wider transition-colors pb-1 border-b-2 self-start md:self-auto mt-6 md:mt-0 flex-shrink-0"
               style="color: #17202D !important; border-color: #17202D !important;">
                <span>EXPLORE ALL SERVICES</span>
                <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <!-- 6 Service Cards Grid (Desktop: 3 cols × 2 rows, Tablet: 2 cols, Mobile: 1 col) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach($services as $index => $service)
                <x-service-card :service="$service" :index="$loop->iteration" />
            @endforeach
        </div>

    </div>
</section>

<!-- ==========================================
     SECTION 5: ABOUT TAMAL CHAKRABORTY (Editorial)
     ========================================== -->
<section class="bg-ivory-100 text-[#17202D] py-20 lg:py-28 border-y border-ivory-300 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- Left Image Column -->
            <div class="lg:col-span-6 relative">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-ivory-300 group">
                    <img src="{{ asset('images/tamal_about_study.jpg') }}" 
                         alt="Tamal Chakraborty at study" 
                         class="w-full h-[450px] sm:h-[520px] object-cover object-center group-hover:scale-105 transition-transform duration-700"
                         onerror="this.src='https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=800&auto=format&fit=crop'">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-950/60 via-transparent to-transparent"></div>

                    <!-- Floating Experience Badge -->
                    <div class="absolute bottom-6 left-6 bg-navy-950/90 text-white p-4 sm:p-5 rounded-xl border border-gold-500/40 shadow-xl flex items-center space-x-4 backdrop-blur-md">
                        <span class="font-serif-luxury text-3xl sm:text-4xl font-bold text-gold-400 leading-none">15+</span>
                        <div class="text-left">
                            <span class="block text-xs font-bold uppercase tracking-wider text-white">Years of</span>
                            <span class="block text-[11px] text-gold-300">Vedic Experience</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Bio Content -->
            <div class="lg:col-span-6 space-y-6">
                <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] text-[#B08A2E] uppercase">
                    <span class="w-2 h-2 rounded-full bg-[#B08A2E]"></span>
                    <span>ABOUT TAMAL CHAKRABORTY</span>
                </div>

                <h2 class="font-serif-luxury text-3xl sm:text-5xl font-bold text-[#17202D] leading-tight">
                    Guiding Lives with <br/>
                    <span class="text-[#9A7422] italic">Ancient Wisdom</span>
                </h2>

                <p class="text-sm sm:text-base text-[#5B6472] leading-relaxed font-normal">
                    Tamal Chakraborty is a renowned Vedic Astrologer with over 15 years of experience in helping people find clarity, balance, and direction in life. Combining deep classical scriptural knowledge with modern analytical remedies, he provides practical and non-superstitious guidance for real-life challenges.
                </p>

                <!-- Expertise Checklist -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-2">
                    <div class="flex items-center space-x-3 p-2.5 rounded-lg bg-ivory-50 border border-ivory-200">
                        <div class="w-7 h-7 rounded-full bg-[#B08A2E]/20 text-[#B08A2E] flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs sm:text-sm font-semibold text-[#253044]">Vedic Astrology</span>
                    </div>
                    <div class="flex items-center space-x-3 p-2.5 rounded-lg bg-ivory-50 border border-ivory-200">
                        <div class="w-7 h-7 rounded-full bg-[#B08A2E]/20 text-[#B08A2E] flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs sm:text-sm font-semibold text-[#253044]">Numerology</span>
                    </div>
                    <div class="flex items-center space-x-3 p-2.5 rounded-lg bg-ivory-50 border border-ivory-200">
                        <div class="w-7 h-7 rounded-full bg-[#B08A2E]/20 text-[#B08A2E] flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs sm:text-sm font-semibold text-[#253044]">Vastu Consultation</span>
                    </div>
                    <div class="flex items-center space-x-3 p-2.5 rounded-lg bg-ivory-50 border border-ivory-200">
                        <div class="w-7 h-7 rounded-full bg-[#B08A2E]/20 text-[#B08A2E] flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs sm:text-sm font-semibold text-[#253044]">Gemstone Guidance</span>
                    </div>
                    <div class="flex items-center space-x-3 p-2.5 rounded-lg bg-ivory-50 border border-ivory-200 sm:col-span-2">
                        <div class="w-7 h-7 rounded-full bg-[#B08A2E]/20 text-[#B08A2E] flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs sm:text-sm font-semibold text-[#253044]">Spiritual Healing & Karmic Remedies</span>
                    </div>
                </div>

                <!-- CTA -->
                <div class="pt-4">
                    <a href="{{ route('about') }}" 
                       class="inline-flex items-center px-7 py-3.5 text-xs font-bold uppercase tracking-wider text-white bg-navy-950 rounded-lg shadow-lg hover:bg-[#9A7422] transition-colors">
                        <span>Know More About Me</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 6: EXPERIENCE / STATS STRIP (Dark Navy)
     ========================================== -->
<section class="bg-navy-950 text-white py-14 border-b border-gold-500/20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-8 text-center">
            
            <div class="space-y-1">
                <span class="font-serif-luxury text-4xl sm:text-5xl font-bold text-gold-gradient block">15+</span>
                <span class="text-xs text-slate-300 font-medium tracking-wide uppercase">Years Experience</span>
            </div>

            <div class="space-y-1">
                <span class="font-serif-luxury text-4xl sm:text-5xl font-bold text-gold-gradient block">1000+</span>
                <span class="text-xs text-slate-300 font-medium tracking-wide uppercase">Happy Clients</span>
            </div>

            <div class="space-y-1">
                <span class="font-serif-luxury text-4xl sm:text-5xl font-bold text-gold-gradient block">5000+</span>
                <span class="text-xs text-slate-300 font-medium tracking-wide uppercase">Consultations</span>
            </div>

            <div class="space-y-1">
                <span class="font-serif-luxury text-4xl sm:text-5xl font-bold text-gold-gradient block">95%</span>
                <span class="text-xs text-slate-300 font-medium tracking-wide uppercase">Positive Feedback</span>
            </div>

            <div class="space-y-1 col-span-2 md:col-span-1">
                <span class="font-serif-luxury text-4xl sm:text-5xl font-bold text-gold-gradient block">10+</span>
                <span class="text-xs text-slate-300 font-medium tracking-wide uppercase">Countries Served</span>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 7: ZODIAC / HOROSCOPE SECTION (Editorial Ivory - Matching Reference Image 1)
     ========================================== -->
<section class="py-24 lg:py-32 relative border-b border-ivory-300" style="background-color: #FDFBF7 !important; color: #17202D !important;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        
        <!-- Editorial Centered Header -->
        <div class="max-w-3xl mx-auto mb-14 lg:mb-16 space-y-3">
            <span class="block text-xs font-bold uppercase tracking-[0.25em]" style="color: #B08A2E !important;">
                EXPLORE YOUR ZODIAC
            </span>

            <h2 class="font-serif-luxury text-3xl sm:text-5xl lg:text-[48px] font-bold leading-[1.12]" style="color: #17202D !important;">
                Know What the Stars Say About You
            </h2>

            <p class="text-sm sm:text-base leading-relaxed font-normal max-w-xl mx-auto" style="color: #566171 !important;">
                Explore daily, weekly and monthly predictions for your zodiac sign.
            </p>
        </div>

        <!-- 12 Editorial Zodiac Profile Items Grid (Desktop: 6 cols × 2 rows, Tablet: 3 cols × 4 rows, Mobile: 2 cols × 6 rows) -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-6 gap-y-12 gap-x-6 sm:gap-x-8 items-start">
            @foreach($horoscopes as $zodiac)
                <x-zodiac-card :zodiac="$zodiac" />
            @endforeach
        </div>

    </div>
</section>

<!-- ==========================================
     SECTION 8: CONSULTATION PROCESS (Dark)
     ========================================== -->
<section class="bg-navy-950 text-white py-20 lg:py-28 relative overflow-hidden border-y border-gold-500/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <x-section-heading 
            eyebrow="HOW IT WORKS"
            title="Book Your Consultation in"
            highlight="Just a Few Steps"
            subtext="Simple, confidential, and seamless process to get personal Vedic guidance."
            theme="dark"
        />

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch mt-12">
            
            <!-- Left 4 Step Cards -->
            <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- Step 1 -->
                <div class="bg-navy-850 p-6 sm:p-7 rounded-2xl border border-slate-800 hover:border-gold-500/40 transition-colors flex flex-col justify-between">
                    <div>
                        <span class="font-serif-luxury text-3xl font-bold text-gold-400 block mb-3">01</span>
                        <h4 class="font-serif-luxury text-xl font-bold text-white mb-2">Choose Service</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Select the specific consultation service you need (Kundli, Marriage, Career, Vastu, etc.).</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="bg-navy-850 p-6 sm:p-7 rounded-2xl border border-slate-800 hover:border-gold-500/40 transition-colors flex flex-col justify-between">
                    <div>
                        <span class="font-serif-luxury text-3xl font-bold text-gold-400 block mb-3">02</span>
                        <h4 class="font-serif-luxury text-xl font-bold text-white mb-2">Pick Date & Time</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Choose a convenient slot that suits your schedule for video or audio session.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="bg-navy-850 p-6 sm:p-7 rounded-2xl border border-slate-800 hover:border-gold-500/40 transition-colors flex flex-col justify-between">
                    <div>
                        <span class="font-serif-luxury text-3xl font-bold text-gold-400 block mb-3">03</span>
                        <h4 class="font-serif-luxury text-xl font-bold text-white mb-2">Make Payment</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Complete your payment securely via online gateway, UPI, or PayPal.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="bg-navy-850 p-6 sm:p-7 rounded-2xl border border-slate-800 hover:border-gold-500/40 transition-colors flex flex-col justify-between">
                    <div>
                        <span class="font-serif-luxury text-3xl font-bold text-gold-400 block mb-3">04</span>
                        <h4 class="font-serif-luxury text-xl font-bold text-white mb-2">Get Confirmation</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Receive instant confirmation and meeting link on WhatsApp & Email.</p>
                    </div>
                </div>

            </div>

            <!-- Right CTA Card -->
            <div class="lg:col-span-4 bg-gradient-to-br from-navy-850 to-navy-900 border-2 border-gold-500/50 rounded-2xl p-8 flex flex-col items-center justify-center text-center gold-glow shadow-2xl">
                <div class="w-14 h-14 rounded-full bg-gold-500/10 border border-gold-500 flex items-center justify-center text-gold-400 mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                </div>

                <h3 class="font-serif-luxury text-2xl font-bold text-white leading-tight mb-3">
                    Start Your Journey Towards a <span class="text-gold-gradient italic">Better Tomorrow</span>
                </h3>

                <p class="text-xs text-slate-300 leading-relaxed mb-8 font-light">
                    Take the first step to uncover your planetary alignments and resolve life's challenges.
                </p>

                <a href="{{ route('consultation.book') }}" 
                   class="block text-center w-full py-4 text-xs font-bold uppercase tracking-widest text-navy-950 bg-gold-gradient rounded-lg shadow-xl gold-glow hover:scale-[1.02] transition-transform border border-gold-300">
                    Book a Consultation →
                </a>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 9: TESTIMONIALS (Light Background)
     ========================================== -->
<section class="bg-ivory-100 text-navy-950 py-20 lg:py-28 border-b border-ivory-300" style="background-color: #F9F6F0 !important;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-section-heading 
            eyebrow="TESTIMONIALS"
            title="What My Clients Say"
            subtext="Real experiences from people who have received guidance and remedies."
            theme="light"
        />

        <!-- 6 Testimonials Grid (Desktop: 3 cols × 2 rows, Tablet: 2 cols, Mobile: 1 col) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <x-testimonial-card :testimonial="$testimonial" />
            @endforeach
        </div>

        <!-- VIEW MORE TESTIMONIALS CTA -->
        <div class="mt-12 text-center">
            <a href="{{ route('testimonials.index') }}" 
               class="group inline-flex items-center px-8 py-4 text-xs font-bold uppercase tracking-widest text-[#17202D] border border-[#17202D]/30 rounded-lg hover:border-[#9A7422] hover:text-[#9A7422] hover:bg-gold-500/5 transition-all shadow-sm">
                <span>VIEW MORE TESTIMONIALS</span>
                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform text-[#9A7422]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>

<!-- ==========================================
     SECTION 10: ASTROLOGY BLOG (Light Background)
     ========================================== -->
<section class="bg-ivory-50 text-navy-950 py-20 lg:py-28">
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
               class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-[#17202D] hover:text-[#9A7422] transition-colors pb-2 border-b border-[#17202D] hover:border-[#9A7422] self-start md:self-auto mt-4 md:mt-0">
                <span>View All Articles</span>
                <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
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
     SECTION 12: FAQ SECTION (Light Accordion)
     ========================================== -->
<section class="bg-ivory-100 text-navy-950 py-20 lg:py-28 border-b border-ivory-300">
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
     SECTION 13: CONTACT SECTION (Premium Luxury Ivory #FDFBF7)
     ========================================== -->
<section class="pt-24 pb-28 lg:pt-32 lg:pb-36 relative border-t border-ivory-300 overflow-hidden" style="background-color: #FDFBF7 !important; color: #17202D !important;">
    
    <!-- Subtle Background Celestial Accents -->
    <div class="absolute top-12 left-10 w-72 h-72 bg-[#B08A2E]/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-12 right-10 w-80 h-80 bg-[#B08A2E]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="max-w-3xl mx-auto text-center mb-16 lg:mb-20 space-y-3">
            <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.25em] uppercase" style="color: #B08A2E !important;">
                <span class="w-2 h-2 rounded-full" style="background-color: #B08A2E !important;"></span>
                <span style="color: #B08A2E !important;">GET IN TOUCH</span>
            </div>

            <h2 class="font-serif-luxury text-3xl sm:text-5xl lg:text-[48px] font-bold leading-[1.12]" style="color: #17202D !important;">
                Let's Connect
            </h2>

            <p class="text-sm sm:text-base leading-relaxed font-normal max-w-xl mx-auto" style="color: #4B5563 !important;">
                Have a question or want to book a consultation? Reach out to us.
            </p>
        </div>

        <!-- 3-Column Premium Layout: Left Info (4) | Center Form (5) | Right Location (3) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch">
            
            <!-- LEFT COLUMN: Contact Information Panel (4 Cols) -->
            <div class="lg:col-span-4 group bg-white/90 border border-[#17202D]/16 rounded-2xl p-7 lg:p-8 shadow-sm relative overflow-hidden transition-all duration-300 hover:shadow-md hover:border-[#B08A2E]/50 flex flex-col justify-between">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B08A2E]/40 via-[#B08A2E] to-[#B08A2E]/40"></div>
                
                <div class="space-y-6">
                    
                    <!-- Website -->
                    <div class="flex items-start space-x-4">
                        <div class="w-11 h-11 rounded-full bg-[#F9F6F0] border border-[#B08A2E]/40 flex items-center justify-center text-[#B08A2E] flex-shrink-0 group-hover:scale-105 transition-transform shadow-xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        </div>
                        <div>
                            <span class="block text-[11px] uppercase font-bold tracking-widest" style="color: #B08A2E !important;">WEBSITE</span>
                            <a href="https://astrotamal.com" target="_blank" rel="noopener noreferrer" class="block font-serif-luxury text-base sm:text-lg font-bold text-[#17202D] hover:text-[#9A7422] transition-colors mt-0.5">astrotamal.com</a>
                        </div>
                    </div>

                    <div class="border-t border-[#17202D]/10"></div>

                    <!-- Email -->
                    <div class="flex items-start space-x-4">
                        <div class="w-11 h-11 rounded-full bg-[#F9F6F0] border border-[#B08A2E]/40 flex items-center justify-center text-[#B08A2E] flex-shrink-0 group-hover:scale-105 transition-transform shadow-xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[11px] uppercase font-bold tracking-widest" style="color: #B08A2E !important;">EMAIL</span>
                            <a href="mailto:support@astrotamal.com" class="block font-serif-luxury text-base sm:text-lg font-bold text-[#17202D] hover:text-[#9A7422] transition-colors mt-0.5 truncate">support@astrotamal.com</a>
                        </div>
                    </div>

                    <div class="border-t border-[#17202D]/10"></div>

                    <!-- Phone -->
                    <div class="flex items-start space-x-4">
                        <div class="w-11 h-11 rounded-full bg-[#F9F6F0] border border-[#B08A2E]/40 flex items-center justify-center text-[#B08A2E] flex-shrink-0 group-hover:scale-105 transition-transform shadow-xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <span class="block text-[11px] uppercase font-bold tracking-widest" style="color: #B08A2E !important;">CONTACT</span>
                            <a href="tel:+919647680707" class="block font-serif-luxury text-base sm:text-lg font-bold text-[#17202D] hover:text-[#9A7422] transition-colors mt-0.5">96476 80707</a>
                        </div>
                    </div>

                    <div class="border-t border-[#17202D]/10"></div>

                    <!-- Chamber Location -->
                    <div class="flex items-start space-x-4">
                        <div class="w-11 h-11 rounded-full bg-[#F9F6F0] border border-[#B08A2E]/40 flex items-center justify-center text-[#B08A2E] flex-shrink-0 group-hover:scale-105 transition-transform shadow-xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <span class="block text-[11px] uppercase font-bold tracking-widest" style="color: #B08A2E !important;">CHAMBER ADDRESS</span>
                            <span class="block font-serif-luxury text-sm font-bold text-[#17202D] mt-0.5">Kolkata | Bongaon | Ranaghat & More</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- CENTER COLUMN: Focal Contact Form Card (5 Cols) -->
            <div class="lg:col-span-5 group bg-white border border-[#17202D]/18 rounded-2xl p-7 sm:p-9 shadow-md relative overflow-hidden transition-all duration-300 hover:shadow-xl hover:border-[#B08A2E]/60 flex flex-col justify-between">
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#9A7422] via-[#B08A2E] to-[#9A7422]"></div>
                
                <div>
                    <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D] mb-1.5">Send Us a Message</h3>
                    <p class="text-xs sm:text-sm text-[#566171] leading-relaxed mb-6 font-normal">We'd love to hear from you. Send us a message and we'll get back to you.</p>
                    
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4 text-xs sm:text-sm">
                        @csrf
                        <div>
                            <label class="block text-[#17202D] font-semibold mb-1.5 text-xs">Your Name *</label>
                            <input type="text" name="name" required placeholder="e.g. Anish Roy" class="w-full bg-white border border-[#17202D]/15 rounded-xl px-4 py-3 text-[#17202D] placeholder-[#8A919C] transition-all focus:outline-none focus:border-[#B08A2E] focus:ring-1 focus:ring-[#B08A2E]/40">
                        </div>
                        <div>
                            <label class="block text-[#17202D] font-semibold mb-1.5 text-xs">Your Email *</label>
                            <input type="email" name="email" required placeholder="anish@example.com" class="w-full bg-white border border-[#17202D]/15 rounded-xl px-4 py-3 text-[#17202D] placeholder-[#8A919C] transition-all focus:outline-none focus:border-[#B08A2E] focus:ring-1 focus:ring-[#B08A2E]/40">
                        </div>
                        <div>
                            <label class="block text-[#17202D] font-semibold mb-1.5 text-xs">Phone Number</label>
                            <input type="tel" name="phone" placeholder="e.g. 96476 80707" class="w-full bg-white border border-[#17202D]/15 rounded-xl px-4 py-3 text-[#17202D] placeholder-[#8A919C] transition-all focus:outline-none focus:border-[#B08A2E] focus:ring-1 focus:ring-[#B08A2E]/40">
                        </div>
                        <div>
                            <label class="block text-[#17202D] font-semibold mb-1.5 text-xs">Your Message *</label>
                            <textarea name="message" rows="4" required placeholder="How can we assist you?" class="w-full bg-white border border-[#17202D]/15 rounded-xl px-4 py-3 text-[#17202D] placeholder-[#8A919C] transition-all focus:outline-none focus:border-[#B08A2E] focus:ring-1 focus:ring-[#B08A2E]/40"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 px-6 text-xs font-bold uppercase tracking-widest text-white bg-[#17202D] rounded-xl shadow-lg hover:bg-[#9A7422] hover:-translate-y-0.5 hover:shadow-xl transition-all duration-300 group/btn flex items-center justify-center space-x-2">
                            <span>SEND MESSAGE</span>
                            <svg class="w-4 h-4 text-[#E6CB65] transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- RIGHT COLUMN: Location / In-Person Consultation Card (3 Cols) -->
            <div class="lg:col-span-3 group bg-white/90 border border-[#17202D]/16 rounded-2xl p-6 lg:p-7 shadow-sm relative overflow-hidden transition-all duration-300 hover:shadow-md hover:border-[#B08A2E]/50 flex flex-col justify-between">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B08A2E]/40 via-[#B08A2E] to-[#B08A2E]/40"></div>
                
                <div class="space-y-5">
                    <!-- Location Visual (4:3 Aspect Ratio) -->
                    <div class="relative w-full rounded-xl overflow-hidden shadow-inner border border-[#17202D]/10 bg-[#0B0E14]" style="aspect-ratio: 4 / 3;">
                        <img src="https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?q=80&w=600&auto=format&fit=crop" 
                             alt="Kolkata Sanctuary Location" 
                             class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500 block opacity-75">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B0E14] via-[#0B0E14]/30 to-transparent"></div>
                        
                        <div class="absolute bottom-3 left-3 right-3 flex items-center space-x-2.5 bg-[#0B0E14]/90 backdrop-blur-md p-2.5 rounded-lg border border-[#B08A2E]/40 shadow-lg">
                            <div class="w-7 h-7 rounded-full bg-[#B08A2E] text-white flex items-center justify-center flex-shrink-0 text-xs font-bold shadow">📍</div>
                            <div>
                                <span class="block font-serif-luxury text-xs font-bold text-white leading-tight">Kolkata Sanctuary</span>
                                <span class="block text-[10px] text-[#E6CB65] leading-none">West Bengal, India</span>
                            </div>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="space-y-2">
                        <div class="inline-flex items-center space-x-1.5 text-[11px] font-bold uppercase tracking-wider text-[#B08A2E]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>IN-PERSON CONSULTATION</span>
                        </div>

                        <p class="text-xs sm:text-sm text-[#4B5563] leading-relaxed font-normal">
                            In-person consultations are available by prior appointment at our Kolkata sanctuary.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
