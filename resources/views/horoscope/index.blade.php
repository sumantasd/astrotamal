@extends('layouts.app')

@section('title', 'Zodiac Horoscopes & Astrology Guidance — Tamal Chakraborty')

@section('content')

<!-- 1. HOROSCOPE PAGE HERO (Dark Green #06281F Background) -->
<section class="bg-[#06281F] text-[#FFFFFF] py-16 lg:py-20 relative overflow-hidden border-b border-[#145A43] min-h-[380px] flex items-center">
    <!-- Subtle Zodiac / Orbital Constellation Background -->
    <div class="absolute inset-0 pointer-events-none opacity-15">
        <svg class="w-full h-full text-[#C49A45]" viewBox="0 0 1200 450" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="600" cy="225" r="380" stroke="currentColor" stroke-width="0.75" stroke-dasharray="4 6"/>
            <circle cx="600" cy="225" r="280" stroke="currentColor" stroke-width="0.5"/>
            <circle cx="600" cy="225" r="180" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 4"/>
            <path d="M 100,225 L 1100,225" stroke="currentColor" stroke-width="0.5" opacity="0.4"/>
            <path d="M 600,0 L 600,450" stroke="currentColor" stroke-width="0.5" opacity="0.4"/>
        </svg>
    </div>

    <!-- Soft Ambient Radial Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-[#C49A45]/10 blur-3xl rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Hero Content -->
            <div class="lg:col-span-8 space-y-4">
                <!-- Breadcrumb -->
                <nav class="flex items-center space-x-2 text-xs font-semibold tracking-widest text-[#C49A45] uppercase">
                    <a href="{{ route('home') }}" class="hover:text-[#D8B86A] transition-colors">HOME</a>
                    <span class="text-[#60736B]">/</span>
                    <span class="text-[#E8F1EC]">HOROSCOPE</span>
                </nav>

                <!-- Eyebrow -->
                <div class="inline-flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                    <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">
                        ASTROTAMAL HOROSCOPE
                    </span>
                </div>

                <!-- Heading -->
                <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold text-[#FFFFFF] leading-tight">
                    Read the Language of the Zodiac
                </h1>

                <!-- Supporting Text -->
                <p class="text-[#E8F1EC]/90 text-sm sm:text-base max-w-2xl font-normal leading-relaxed">
                    Explore the twelve zodiac signs through an astrological perspective and discover insights related to personality, tendencies, opportunities and important phases of life.
                </p>
            </div>

            <!-- Optional Celestial Decorative Visual -->
            <div class="hidden lg:col-span-4 lg:flex items-center justify-end">
                <div class="relative w-48 h-48 sm:w-56 sm:h-56 rounded-full border border-[#145A43] p-3 flex items-center justify-center bg-[#0B3D2E] shadow-md">
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

<!-- 2. INTRODUCTION SECTION (Very Light Green #F3F8F5) -->
<section class="bg-[#F3F8F5] text-[#17211D] py-16 sm:py-20 border-b border-[#C8D8CF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Left: Heading & Short Introduction -->
            <div class="lg:col-span-9 space-y-3">
                <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45] block">
                    THE TWELVE SIGNS
                </span>
                
                <h2 class="font-serif-luxury text-2xl sm:text-4xl font-bold text-[#0B3D2E] leading-snug">
                    Explore the Twelve Zodiac Signs
                </h2>

                <p class="text-sm sm:text-base text-[#60736B] leading-relaxed font-normal max-w-3xl">
                    Each zodiac sign represents a distinct astrological pattern. Explore the signs below to understand their traditional characteristics, elemental nature and associated dates.
                </p>
            </div>

            <!-- Right: Refined Editorial Visual Badge (12 ZODIAC SIGNS) -->
            <div class="lg:col-span-3 flex lg:justify-end">
                <div class="p-6 rounded-2xl border border-[#C8D8CF] bg-[#E8F1EC] text-center shadow-sm w-full sm:w-auto min-w-[200px]">
                    <span class="font-serif-luxury text-5xl sm:text-6xl font-bold text-[#0B3D2E] block leading-none">12</span>
                    <div class="w-12 h-0.5 bg-[#C49A45] mx-auto my-2.5"></div>
                    <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-[#C49A45] block">ZODIAC SIGNS</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. ZODIAC GRID (Very Light Green #F3F8F5) -->
<section class="bg-[#F3F8F5] py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <!-- 12 Zodiac Cards Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5 sm:gap-6">
            @foreach($horoscopes as $zodiac)
                <x-zodiac-card :zodiac="$zodiac" />
            @endforeach
        </div>
    </div>
</section>

<!-- 4. ELEMENTAL CLASSIFICATION (Soft Green #E8F1EC) -->
<section class="bg-[#E8F1EC] text-[#17211D] py-20 lg:py-28 border-t border-[#C8D8CF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">ELEMENTAL ASTROLOGY</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#0B3D2E]">Understanding the Four Elements</h2>
            <p class="text-xs sm:text-sm text-[#60736B] font-normal">The twelve zodiac signs are grouped into four fundamental elements, reflecting distinct personality temperaments.</p>
        </div>

        <!-- 4 Element Editorial Columns -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            <!-- FIRE -->
            <div class="bg-[#FFFFFF] p-7 rounded-2xl border border-[#C8D8CF] shadow-sm hover:shadow transition-shadow space-y-4">
                <div class="w-12 h-12 rounded-xl bg-[#0B3D2E] flex items-center justify-center text-[#C49A45]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-serif-luxury text-2xl font-bold text-[#0B3D2E]">FIRE</h3>
                    <span class="text-xs font-bold tracking-wider text-[#C49A45] uppercase block mt-1">Aries · Leo · Sagittarius</span>
                </div>
                <p class="text-xs text-[#60736B] leading-relaxed font-normal">
                    Represents passion, vital energy, leadership initiative, and dynamic enthusiasm in action.
                </p>
            </div>

            <!-- EARTH -->
            <div class="bg-[#FFFFFF] p-7 rounded-2xl border border-[#C8D8CF] shadow-sm hover:shadow transition-shadow space-y-4">
                <div class="w-12 h-12 rounded-xl bg-[#0B3D2E] flex items-center justify-center text-[#C49A45]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 002.5-2.5V7"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-serif-luxury text-2xl font-bold text-[#0B3D2E]">EARTH</h3>
                    <span class="text-xs font-bold tracking-wider text-[#C49A45] uppercase block mt-1">Taurus · Virgo · Capricorn</span>
                </div>
                <p class="text-xs text-[#60736B] leading-relaxed font-normal">
                    Represents practical grounding, stability, persistence, and material realization of long-term goals.
                </p>
            </div>

            <!-- AIR -->
            <div class="bg-[#FFFFFF] p-7 rounded-2xl border border-[#C8D8CF] shadow-sm hover:shadow transition-shadow space-y-4">
                <div class="w-12 h-12 rounded-xl bg-[#0B3D2E] flex items-center justify-center text-[#C49A45]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-serif-luxury text-2xl font-bold text-[#0B3D2E]">AIR</h3>
                    <span class="text-xs font-bold tracking-wider text-[#C49A45] uppercase block mt-1">Gemini · Libra · Aquarius</span>
                </div>
                <p class="text-xs text-[#60736B] leading-relaxed font-normal">
                    Represents intellect, communication, social perspective, and strategic conceptual reasoning.
                </p>
            </div>

            <!-- WATER -->
            <div class="bg-[#FFFFFF] p-7 rounded-2xl border border-[#C8D8CF] shadow-sm hover:shadow transition-shadow space-y-4">
                <div class="w-12 h-12 rounded-xl bg-[#0B3D2E] flex items-center justify-center text-[#C49A45]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 01-.67-.01C7.5 20.5 4 18 4 13a8 8 0 0116 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-serif-luxury text-2xl font-bold text-[#0B3D2E]">WATER</h3>
                    <span class="text-xs font-bold tracking-wider text-[#C49A45] uppercase block mt-1">Cancer · Scorpio · Pisces</span>
                </div>
                <p class="text-xs text-[#60736B] leading-relaxed font-normal">
                    Represents intuition, emotional depth, empathy, sensitivity, and subtle internal awareness.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 5. HOW HOROSCOPE WORKS (Very Light Green #F3F8F5) -->
<section class="bg-[#F3F8F5] text-[#17211D] py-20 lg:py-28 border-t border-[#C8D8CF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Column: Explanation -->
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45] block">
                    A CLOSER LOOK
                </span>

                <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#0B3D2E] leading-tight">
                    More Than Just a Sun Sign
                </h2>

                <p class="text-sm sm:text-base text-[#60736B] leading-relaxed font-normal">
                    While your Sun sign highlights foundational vitality and tendencies, a complete astrological perspective explores multiple chart components to gain balanced context.
                </p>

                <!-- Key Concepts Grid -->
                <div class="space-y-4 pt-2">
                    <div class="flex items-start space-x-3.5">
                        <div class="w-2 h-2 rounded-full bg-[#C49A45] mt-2 flex-shrink-0"></div>
                        <div>
                            <h4 class="text-sm font-bold text-[#0B3D2E]">Lagna & Janam Kundli</h4>
                            <p class="text-xs text-[#60736B] font-normal leading-relaxed">The ascendant house defines your personal perspective and life orientation at birth.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3.5">
                        <div class="w-2 h-2 rounded-full bg-[#C49A45] mt-2 flex-shrink-0"></div>
                        <div>
                            <h4 class="text-sm font-bold text-[#0B3D2E]">Chandra Rashi (Moon Sign)</h4>
                            <p class="text-xs text-[#60736B] font-normal leading-relaxed">Represents emotional temperament, mental responses, and inner character.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3.5">
                        <div class="w-2 h-2 rounded-full bg-[#C49A45] mt-2 flex-shrink-0"></div>
                        <div>
                            <h4 class="text-sm font-bold text-[#0B3D2E]">Planetary Timing (Gochar / Transits)</h4>
                            <p class="text-xs text-[#60736B] font-normal leading-relaxed">Current planetary movements and active Dasha periods provide time-based context for important life decisions.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Editorial Highlight Box (Primary Deep Green Background) -->
            <div class="lg:col-span-5">
                <div class="bg-[#06281F] text-[#FFFFFF] p-8 sm:p-10 rounded-2xl border border-[#145A43] shadow-lg space-y-6 relative overflow-hidden">
                    <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-[#C49A45] block">
                        ASTROLOGICAL TIMING & CONTEXT
                    </span>

                    <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#FFFFFF] leading-snug">
                        Understanding Time & Chart Interplay
                    </h3>

                    <p class="text-xs sm:text-sm text-[#E8F1EC]/90 font-normal leading-relaxed">
                        A personal birth chart analysis offers individual context that goes beyond general zodiac sign characteristics, examining specific house relationships and active planetary cycles.
                    </p>

                    <div class="pt-2">
                        <a href="{{ route('consultation.book') }}" 
                           class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-[#C49A45] hover:text-[#FFFFFF] transition-colors">
                            <span>Explore Birth Chart Guidance</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
