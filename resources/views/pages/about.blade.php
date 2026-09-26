@extends('layouts.app')

@section('title', 'About Tamal Chakraborty | Astrologer & Vedic Astrology')
@section('meta_description', 'Learn about Astrologer Tamal Chakraborty\'s approach to astrology, birth chart analysis, planetary timing, astrology education and personalised guidance.')

@section('content')

<!-- ==========================================
     COMPACT ABOUT HERO (Dark Navy Editorial)
     ========================================== -->
<section class="relative bg-navy-950 text-white pt-10 pb-12 lg:pt-14 lg:pb-16 border-b border-gold-500/20 overflow-hidden">
    <!-- Starfield & Subtle Orbit Line Background -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gold-500/10 via-navy-900 to-navy-950 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-[11px] font-bold tracking-widest text-gold-400 uppercase mb-4">
            <a href="{{ route('home') }}" class="hover:text-gold-300 transition-colors">HOME</a>
            <span class="text-slate-600">/</span>
            <span class="text-slate-300">ABOUT TAMAL</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Hero Text Content -->
            <div class="lg:col-span-8 space-y-3">
                <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.2em] text-gold-400 uppercase">
                    <span class="w-2 h-2 rounded-full bg-gold-500"></span>
                    <span>ABOUT TAMAL CHAKRABORTY</span>
                </div>

                <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                    Understanding Astrology. <br class="hidden sm:inline"/>
                    <span class="text-gold-gradient italic">Understanding Time.</span>
                </h1>

                <p class="text-sm sm:text-base text-slate-300 max-w-2xl font-light leading-relaxed pt-1">
                    Explore the approach, philosophy and work behind Astrologer Tamal Chakraborty's journey through astrology.
                </p>
            </div>

            <!-- Optional Compact Visual (35% width on desktop) -->
            <div class="lg:col-span-4 hidden lg:flex justify-end">
                <div class="w-48 h-48 rounded-2xl overflow-hidden border-2 border-gold-500/30 shadow-xl bg-navy-900 relative">
                    <img src="{{ asset('images/tamal_hero_portrait.jpg') }}" 
                         alt="Tamal Chakraborty" 
                         class="w-full h-full object-cover object-top"
                         onerror="this.src='https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400&auto=format&fit=crop'">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-transparent to-transparent opacity-60"></div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 1: A JOURNEY THROUGH ASTROLOGY (Warm Ivory #FDFBF7)
     ========================================== -->
<section class="py-16 lg:py-24 relative border-b border-ivory-300" style="background-color: #FDFBF7 !important; color: #17202D !important;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- Left Portrait Image -->
            <div class="lg:col-span-5">
                <div class="rounded-2xl overflow-hidden shadow-xl border border-ivory-300">
                    <img src="{{ asset('images/tamal_hero_portrait.jpg') }}" 
                         alt="Tamal Chakraborty" 
                         class="w-full h-[420px] sm:h-[460px] object-cover object-top"
                         onerror="this.src='https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=800&auto=format&fit=crop'">
                </div>
            </div>

            <!-- Right Text Content -->
            <div class="lg:col-span-7 space-y-5">
                <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.2em] uppercase" style="color: #B08A2E !important;">
                    <span class="w-2 h-2 rounded-full" style="background-color: #B08A2E !important;"></span>
                    <span>OUR APPROACH</span>
                </div>

                <h2 class="font-serif-luxury text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight" style="color: #17202D !important;">
                    A Journey Through Astrology
                </h2>

                <p class="text-sm sm:text-base leading-relaxed font-normal" style="color: #4B5563 !important;">
                    Tamal Chakraborty's public work reflects a deep interest in astrology, its foundational principles, and the logic behind its interpretation. Rather than presenting astrology as rigid prophecy, his approach centers on analyzing how planetary placements, birth charts, and time interact.
                </p>

                <p class="text-sm sm:text-base leading-relaxed font-normal" style="color: #4B5563 !important;">
                    His content explores astrology not simply as prediction, but as a subject involving birth charts, planetary positions, transits, and the understanding of time. Through clear chart analysis, the goal is to provide responsible, balanced astrological guidance.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 2: UNDERSTANDING TIME (Dark Navy Editorial Quote)
     ========================================== -->
<section class="bg-navy-950 text-white py-18 lg:py-24 relative border-b border-gold-500/20 overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
        <span class="text-xs font-bold tracking-[0.3em] text-gold-400 uppercase block">
            PHILOSOPHY
        </span>

        <h2 class="font-serif-luxury text-3xl sm:text-5xl font-bold text-white leading-tight">
            “Planets are not the only thing — <br class="hidden sm:inline"/>
            <span class="text-gold-gradient italic">time speaks.</span> And I speak of time.”
        </h2>

        <p class="text-sm sm:text-base text-slate-300 max-w-2xl mx-auto font-light leading-relaxed">
            Understanding time, planetary transits, and changing periods is central to his approach to astrological guidance and decision-making clarity.
        </p>
    </div>
</section>

<!-- ==========================================
     SECTION 3: AREAS OF ASTROLOGICAL GUIDANCE (Warm Ivory #F9F6F0 Grid)
     ========================================== -->
<section class="py-16 lg:py-24 relative border-b border-ivory-300" style="background-color: #F9F6F0 !important; color: #17202D !important;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-3xl mb-12 text-center sm:text-left">
            <span class="block text-xs font-bold uppercase tracking-[0.2em] mb-1" style="color: #B08A2E !important;">CORE AREAS</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold" style="color: #17202D !important;">
                Areas of Astrological Guidance
            </h2>
        </div>

        <!-- Compact 2x3 Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="bg-white p-6 rounded-xl border border-[#17202D]/12 shadow-sm space-y-2">
                <span class="font-serif-luxury text-xl font-bold block" style="color: #B08A2E !important;">01</span>
                <h3 class="font-serif-luxury text-xl font-bold" style="color: #17202D !important;">Birth Chart Analysis</h3>
                <p class="text-xs sm:text-sm leading-relaxed" style="color: #4B5563 !important;">A detailed examination of foundational planetary placements, Lagna, and Chandra Rashi.</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-[#17202D]/12 shadow-sm space-y-2">
                <span class="font-serif-luxury text-xl font-bold block" style="color: #B08A2E !important;">02</span>
                <h3 class="font-serif-luxury text-xl font-bold" style="color: #17202D !important;">Transit & Timing</h3>
                <p class="text-xs sm:text-sm leading-relaxed" style="color: #4B5563 !important;">Understanding planetary transits and changing periods to explore phases of time.</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-[#17202D]/12 shadow-sm space-y-2">
                <span class="font-serif-luxury text-xl font-bold block" style="color: #B08A2E !important;">03</span>
                <h3 class="font-serif-luxury text-xl font-bold" style="color: #17202D !important;">Career & Job Guidance</h3>
                <p class="text-xs sm:text-sm leading-relaxed" style="color: #4B5563 !important;">Astrological perspectives on career direction and professional timing considerations.</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-[#17202D]/12 shadow-sm space-y-2">
                <span class="font-serif-luxury text-xl font-bold block" style="color: #B08A2E !important;">04</span>
                <h3 class="font-serif-luxury text-xl font-bold" style="color: #17202D !important;">Business Guidance</h3>
                <p class="text-xs sm:text-sm leading-relaxed" style="color: #4B5563 !important;">Exploring commercial opportunities and strategic timing through chart analysis.</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-[#17202D]/12 shadow-sm space-y-2">
                <span class="font-serif-luxury text-xl font-bold block" style="color: #B08A2E !important;">05</span>
                <h3 class="font-serif-luxury text-xl font-bold" style="color: #17202D !important;">Life Direction</h3>
                <p class="text-xs sm:text-sm leading-relaxed" style="color: #4B5563 !important;">Gaining clarity on key life phases and decision-making through chart and time interplay.</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-[#17202D]/12 shadow-sm space-y-2">
                <span class="font-serif-luxury text-xl font-bold block" style="color: #B08A2E !important;">06</span>
                <h3 class="font-serif-luxury text-xl font-bold" style="color: #17202D !important;">Astrology Learning</h3>
                <p class="text-xs sm:text-sm leading-relaxed" style="color: #4B5563 !important;">Exploration into classical Vedic astrology fundamentals, signs, and planetary logic.</p>
            </div>

        </div>

    </div>
</section>

<!-- ==========================================
     SECTION 4: EXPLORING THE LANGUAGE OF ASTROLOGY (Warm Ivory #FDFBF7)
     ========================================== -->
<section class="py-16 lg:py-24 relative border-b border-ivory-300" style="background-color: #FDFBF7 !important; color: #17202D !important;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- Left Educational Text -->
            <div class="lg:col-span-7 space-y-4">
                <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.2em] uppercase" style="color: #B08A2E !important;">
                    <span class="w-2 h-2 rounded-full" style="background-color: #B08A2E !important;"></span>
                    <span>FUNDAMENTALS & LOGIC</span>
                </div>

                <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold leading-tight" style="color: #17202D !important;">
                    Exploring the Language of Astrology
                </h2>

                <p class="text-sm sm:text-base leading-relaxed font-normal" style="color: #4B5563 !important;">
                    Tamal Chakraborty's public educational content explores foundational concepts such as <strong>Rashi</strong>, <strong>Lagna</strong>, <strong>Chandra Rashi</strong>, <strong>Rashichakra</strong>, planetary positions, birth charts, and transits.
                </p>

                <p class="text-sm sm:text-base leading-relaxed font-normal" style="color: #4B5563 !important;">
                    This work reflects an ongoing interest in demystifying astrological structures and encouraging a logical, thoughtful understanding of how celestial movements are interpreted.
                </p>
            </div>

            <!-- Right Visual Card -->
            <div class="lg:col-span-5">
                <div class="rounded-2xl overflow-hidden shadow-lg border border-ivory-300">
                    <img src="{{ asset('images/tamal_about_study.jpg') }}" 
                         alt="Astrology Manuscript Study" 
                         class="w-full h-80 object-cover object-center"
                         onerror="this.src='https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=800&auto=format&fit=crop'">
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
