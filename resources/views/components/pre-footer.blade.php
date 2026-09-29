<!-- ==========================================
     COMMON REUSABLE PRE-FOOTER COMPONENT (Soft Beige #EDE3D4 / Warm Cream)
     ========================================== -->
<section class="relative text-[#29211F] py-18 lg:py-22 overflow-hidden border-t border-[#D8C6A8] w-full" style="background-color: #EDE3D4 !important;">
    
    <!-- Low-Opacity Celestial Orbit Circle & Zodiac Wheel Background Artwork -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[650px] h-[650px] lg:w-[850px] lg:h-[850px] opacity-[0.06] animate-spin-slow pointer-events-none">
        <svg viewBox="0 0 500 500" class="w-full h-full text-[#C49A45] stroke-current fill-none" stroke-width="1">
            <circle cx="250" cy="250" r="240" stroke-dasharray="8 6"/>
            <circle cx="250" cy="250" r="210"/>
            <circle cx="250" cy="250" r="170" stroke-dasharray="4 4"/>
            <circle cx="250" cy="250" r="130"/>
            <line x1="250" y1="10" x2="250" y2="490" stroke-width="0.75"/>
            <line x1="10" y1="250" x2="490" y2="250" stroke-width="0.75"/>
            <line x1="80" y1="80" x2="420" y2="420" stroke-width="0.5"/>
            <line x1="80" y1="420" x2="420" y2="80" stroke-width="0.5"/>
        </svg>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-5">
        
        <!-- Eyebrow -->
        <span class="block text-xs font-bold uppercase tracking-[0.3em]" style="color: #C49A45 !important;">
            • GET GUIDANCE •
        </span>

        <!-- Main Heading -->
        <h2 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F] leading-[1.12]">
            Understand Your Chart. <br class="hidden sm:inline"/>
            <span class="text-[#C49A45] italic font-bold">Understand Your Time.</span>
        </h2>

        <!-- Supporting Text -->
        <p class="text-sm sm:text-base text-[#81766D] max-w-xl mx-auto font-normal leading-relaxed">
            Explore your birth chart, planetary timing and important life questions through an astrological perspective.
        </p>

        <!-- Primary CTA Button -->
        <div class="pt-2 flex justify-center">
            <a href="{{ route('consultation.book') }}" 
               class="group inline-flex items-center justify-center px-9 py-4 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-xl shadow-md hover:scale-[1.02] transition-all duration-300 border border-[#D8C6A8]">
                <span>BOOK A CONSULTATION</span>
                <svg class="w-4 h-4 ml-2.5 transform group-hover:translate-x-1 transition-transform text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>

<!-- Subtle Gold Divider Transition into Footer -->
<div class="w-full h-px bg-gradient-to-r from-transparent via-[#C49A45]/30 to-transparent relative z-20"></div>
