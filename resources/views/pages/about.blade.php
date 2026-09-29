@extends('layouts.app')

@section('title', 'About Tamal Chakraborty | Astrologer & Vedic Astrology')
@section('meta_description', 'Learn about Astrologer Tamal Chakraborty\'s approach to astrology, birth chart analysis, planetary timing, astrology education and personalised guidance.')

@section('content')

<!-- ==========================================
     COMPACT ABOUT HERO (Warm Cream / Soft Beige Editorial)
     ========================================== -->
<section class="relative bg-[#F7F0E3] text-[#29211F] pt-10 pb-12 lg:pt-14 lg:pb-16 border-b border-[#D8C6A8] overflow-hidden">
    <!-- Starfield & Subtle Orbit Line Background -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-[#C49A45]/10 via-[#EDE3D4] to-[#F7F0E3] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-[11px] font-bold tracking-widest text-[#C49A45] uppercase mb-4">
            <a href="{{ route('home') }}" class="hover:text-[#541F1D] transition-colors">HOME</a>
            <span class="text-[#81766D]">/</span>
            <span class="text-[#29211F]">ABOUT TAMAL</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Hero Text Content -->
            <div class="lg:col-span-8 space-y-3">
                <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.2em] text-[#C49A45] uppercase">
                    <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                    <span>ABOUT TAMAL CHAKRABORTY</span>
                </div>

                <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F] leading-tight">
                    Understanding Astrology. <br class="hidden sm:inline"/>
                    <span class="text-[#C49A45] italic">Understanding Time.</span>
                </h1>

                <p class="text-sm sm:text-base text-[#81766D] max-w-2xl font-normal leading-relaxed pt-1">
                    Explore the approach, philosophy and work behind Astrologer Tamal Chakraborty's journey through astrology.
                </p>
            </div>

            <!-- Compact Visual -->
            <div class="lg:col-span-4 hidden lg:flex justify-end">
                <div class="w-48 h-48 rounded-2xl overflow-hidden border-2 border-[#D8C6A8] shadow-md bg-[#FDFBF7] relative">
                    <img src="{{ asset('images/tamal_hero_portrait.jpg') }}" 
                         alt="Tamal Chakraborty" 
                         class="w-full h-full object-cover object-top"
                         onerror="this.src='https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400&auto=format&fit=crop'">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#29211F]/60 via-transparent to-transparent opacity-60"></div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 1: A JOURNEY THROUGH ASTROLOGY (Light Ivory #FDFBF7)
     ========================================== -->
<section class="py-16 lg:py-24 relative border-b border-[#D8C6A8] bg-[#FDFBF7] text-[#29211F]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- Left Portrait Image -->
            <div class="lg:col-span-5">
                <div class="rounded-2xl overflow-hidden shadow-md border border-[#D8C6A8]">
                    <img src="{{ asset('images/tamal_hero_portrait.jpg') }}" 
                         alt="Tamal Chakraborty" 
                         class="w-full h-[420px] sm:h-[460px] object-cover object-top"
                         onerror="this.src='https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=800&auto=format&fit=crop'">
                </div>
            </div>

            <!-- Right Text Content -->
            <div class="lg:col-span-7 space-y-5">
                <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.2em] uppercase text-[#C49A45]">
                    <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                    <span>OUR APPROACH</span>
                </div>

                <h2 class="font-serif-luxury text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight text-[#29211F]">
                    A Journey Through Astrology
                </h2>

                <p class="text-sm sm:text-base leading-relaxed font-normal text-[#81766D]">
                    Tamal Chakraborty's public work reflects a deep interest in astrology, its foundational principles, and the logic behind its interpretation. Rather than presenting astrology as rigid prophecy, his approach centers on analyzing how planetary placements, birth charts, and time interact.
                </p>

                <p class="text-sm sm:text-base leading-relaxed font-normal text-[#81766D]">
                    His content explores astrology not simply as prediction, but as a subject involving birth charts, planetary positions, transits, and the understanding of time. Through clear chart analysis, the goal is to provide responsible, balanced astrological guidance.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 2: UNDERSTANDING TIME (Primary Burgundy #541F1D Background)
     ========================================== -->
<section class="bg-[#541F1D] text-[#F7F0E3] py-18 lg:py-24 relative border-b border-[#D8C6A8]/40 overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
        <span class="text-xs font-bold tracking-[0.3em] text-[#C49A45] uppercase block">
            PHILOSOPHY
        </span>

        <h2 class="font-serif-luxury text-3xl sm:text-5xl font-bold text-[#F7F0E3] leading-tight">
            “Planets are not the only thing — <br class="hidden sm:inline"/>
            <span class="text-[#C49A45] italic">time speaks.</span> And I speak of time.”
        </h2>

        <p class="text-sm sm:text-base text-[#F7F0E3]/90 max-w-2xl mx-auto font-normal leading-relaxed">
            Understanding time, planetary transits, and changing periods is central to his approach to astrological guidance and decision-making clarity.
        </p>
    </div>
</section>

<!-- ==========================================
     SECTION 3: AREAS OF ASTROLOGICAL GUIDANCE (Warm Cream #F7F0E3 Grid)
     ========================================== -->
<section class="py-16 lg:py-24 relative border-b border-[#D8C6A8] bg-[#F7F0E3] text-[#29211F]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-3xl mb-12 text-center sm:text-left">
            <span class="block text-xs font-bold uppercase tracking-[0.2em] mb-1 text-[#C49A45]">CORE AREAS</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">
                Areas of Astrological Guidance
            </h2>
        </div>

        <!-- Compact 2x3 Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="bg-[#FDFBF7] p-6 rounded-xl border border-[#D8C6A8] shadow-sm space-y-2">
                <span class="font-serif-luxury text-xl font-bold block text-[#541F1D]">01</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">Birth Chart Analysis</h3>
                <p class="text-xs sm:text-sm leading-relaxed text-[#81766D]">A detailed examination of foundational planetary placements, Lagna, and Chandra Rashi.</p>
            </div>

            <div class="bg-[#FDFBF7] p-6 rounded-xl border border-[#D8C6A8] shadow-sm space-y-2">
                <span class="font-serif-luxury text-xl font-bold block text-[#541F1D]">02</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">Transit & Timing</h3>
                <p class="text-xs sm:text-sm leading-relaxed text-[#81766D]">Understanding planetary transits and changing periods to explore phases of time.</p>
            </div>

            <div class="bg-[#FDFBF7] p-6 rounded-xl border border-[#D8C6A8] shadow-sm space-y-2">
                <span class="font-serif-luxury text-xl font-bold block text-[#541F1D]">03</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">Career & Job Guidance</h3>
                <p class="text-xs sm:text-sm leading-relaxed text-[#81766D]">Astrological perspectives on career direction and professional timing considerations.</p>
            </div>

            <div class="bg-[#FDFBF7] p-6 rounded-xl border border-[#D8C6A8] shadow-sm space-y-2">
                <span class="font-serif-luxury text-xl font-bold block text-[#541F1D]">04</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">Business Guidance</h3>
                <p class="text-xs sm:text-sm leading-relaxed text-[#81766D]">Exploring commercial opportunities and strategic timing through chart analysis.</p>
            </div>

            <div class="bg-[#FDFBF7] p-6 rounded-xl border border-[#D8C6A8] shadow-sm space-y-2">
                <span class="font-serif-luxury text-xl font-bold block text-[#541F1D]">05</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">Life Direction</h3>
                <p class="text-xs sm:text-sm leading-relaxed text-[#81766D]">Gaining clarity on key life phases and decision-making through chart and time interplay.</p>
            </div>

            <div class="bg-[#FDFBF7] p-6 rounded-xl border border-[#D8C6A8] shadow-sm space-y-2">
                <span class="font-serif-luxury text-xl font-bold block text-[#541F1D]">06</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">Astrology Learning</h3>
                <p class="text-xs sm:text-sm leading-relaxed text-[#81766D]">Exploration into classical Vedic astrology fundamentals, signs, and planetary logic.</p>
            </div>

        </div>

    </div>
</section>

<!-- ==========================================
     SECTION 4: EXPLORING THE LANGUAGE OF ASTROLOGY (Soft Beige #EDE3D4)
     ========================================== -->
<section class="py-16 lg:py-24 relative border-b border-[#D8C6A8] bg-[#EDE3D4] text-[#29211F]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- Left Educational Text -->
            <div class="lg:col-span-7 space-y-4">
                <div class="inline-flex items-center space-x-2 text-xs font-bold tracking-[0.2em] uppercase text-[#C49A45]">
                    <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                    <span>FUNDAMENTALS & LOGIC</span>
                </div>

                <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold leading-tight text-[#29211F]">
                    Exploring the Language of Astrology
                </h2>

                <p class="text-sm sm:text-base leading-relaxed font-normal text-[#81766D]">
                    Tamal Chakraborty's public educational content explores foundational concepts such as <strong>Rashi</strong>, <strong>Lagna</strong>, <strong>Chandra Rashi</strong>, <strong>Rashichakra</strong>, planetary positions, birth charts, and transits.
                </p>

                <p class="text-sm sm:text-base leading-relaxed font-normal text-[#81766D]">
                    This work reflects an ongoing interest in demystifying astrological structures and encouraging a logical, thoughtful understanding of how celestial movements are interpreted.
                </p>
            </div>

            <!-- Right Visual Card -->
            <div class="lg:col-span-5">
                <div class="rounded-2xl overflow-hidden shadow border border-[#D8C6A8]">
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
