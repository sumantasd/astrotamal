@extends('layouts.app')

@section('title', 'Kundli Birth Chart — Tamal Chakraborty')

@section('content')

<!-- 1. COMPACT KUNDLI HERO -->
<section class="bg-[#F7F0E3] text-[#29211F] py-16 lg:py-20 relative overflow-hidden border-b border-[#D8C6A8] min-h-[340px] flex items-center">
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

    <!-- Soft Ambient Golden Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-[rgba(196,154,69,0.08)] blur-3xl rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Hero Content -->
            <div class="lg:col-span-8 space-y-4">
                <!-- Breadcrumb -->
                <nav class="flex items-center space-x-2 text-xs font-semibold tracking-widest text-[#81766D] uppercase">
                    <a href="{{ route('home') }}" class="hover:text-[#C49A45] transition-colors">HOME</a>
                    <span>/</span>
                    <span class="text-[#C49A45]">KUNDLI</span>
                </nav>

                <!-- Eyebrow -->
                <div class="inline-flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                    <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">
                        KUNDLI
                    </span>
                </div>

                <!-- Heading -->
                <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold text-[#29211F] leading-tight">
                    Discover Your Birth Chart
                </h1>

                <!-- Supporting Text -->
                <p class="text-[#81766D] text-sm sm:text-base max-w-2xl font-light leading-relaxed">
                    Enter your birth details to explore your Kundli and understand the astrological patterns associated with your birth.
                </p>
            </div>

            <!-- Decorative Astrological Visual (Desktop) -->
            <div class="hidden lg:col-span-4 lg:flex items-center justify-end">
                <div class="relative w-48 h-48 sm:w-56 sm:h-56 rounded-full border border-[#D8C6A8] p-3 flex items-center justify-center bg-[#EDE3D4] shadow-md">
                    <div class="w-full h-full rounded-full border border-dashed border-[#C49A45]/50 flex items-center justify-center p-4">
                        <svg class="w-24 h-24 text-[#C49A45] opacity-80 animate-spin-slow" viewBox="0 0 100 100" fill="none" stroke="currentColor">
                            <circle cx="50" cy="50" r="45" stroke-width="1"/>
                            <polygon points="50,10 90,50 50,90 10,50" stroke-width="0.75" stroke-dasharray="3 3"/>
                            <path d="M50 5 L50 95 M5 50 L95 50 M18 18 L82 82 M18 82 L82 18" stroke-width="0.5"/>
                            <circle cx="50" cy="50" r="5" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. KUNDLI INPUT AREA & RESULT PREVIEW -->
<section class="bg-[#FDFBF7] py-16 lg:py-24" x-data="{ generated: false, name: '', gender: 'Male', dob: '', time: '', place: '' }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">BIRTH DETAILS</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">Generate Your Kundli</h2>
            <p class="text-xs sm:text-sm text-[#81766D] font-normal">Enter your birth information carefully for a more accurate chart calculation.</p>
        </div>

        <!-- Form Card Container -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-6 sm:p-10 shadow-md space-y-6">
            <form @submit.prevent="generated = true; name = $refs.name.value; gender = $refs.gender.value; dob = $refs.dob.value; time = $refs.time.value; place = $refs.place.value" 
                  class="space-y-6">
                <!-- Row 1: Full Name & Gender -->
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                    <div class="sm:col-span-8">
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">Full Name *</label>
                        <input x-ref="name" 
                               type="text" 
                               required 
                               placeholder="Enter your full name" 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-sm text-[#29211F] placeholder-slate-400 focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-colors">
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">Gender *</label>
                        <select x-ref="gender" 
                                required 
                                class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-sm text-[#29211F] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-colors">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <!-- Row 2: Date of Birth, Time of Birth, Place of Birth -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">Date of Birth *</label>
                        <input x-ref="dob" 
                               type="date" 
                               required 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-3.5 py-3 text-sm text-[#29211F] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">Time of Birth *</label>
                        <input x-ref="time" 
                               type="time" 
                               required 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-3.5 py-3 text-sm text-[#29211F] focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#29211F] mb-2">Place of Birth *</label>
                        <input x-ref="place" 
                               type="text" 
                               required 
                               placeholder="Enter birth place (City, State)" 
                               class="w-full bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg px-4 py-3 text-sm text-[#29211F] placeholder-slate-400 focus:outline-none focus:border-[#C49A45] focus:ring-1 focus:ring-[#C49A45] transition-colors">
                    </div>
                </div>

                <!-- Primary Submit CTA Button -->
                <button type="submit" 
                        class="w-full py-4 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-lg shadow border border-[#D8C6A8] transition-all">
                    GENERATE KUNDLI →
                </button>
            </form>
        </div>

        <!-- Calculated Kundli Result Presentation -->
        <div x-show="generated" 
             x-cloak 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="bg-[#351211] text-[#F7F0E3] rounded-2xl p-6 sm:p-10 border border-[#C49A45]/40 shadow-2xl space-y-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-[#C49A45]/20 pb-5 gap-3">
                <div>
                    <span class="text-xs text-[#C49A45] font-bold uppercase tracking-widest block">JANAM KUNDLI GENERATED</span>
                    <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#F7F0E3] mt-0.5" x-text="name + '\'s Birth Chart'"></h3>
                </div>
                <div class="inline-flex items-center space-x-2 text-xs bg-[#541F1D] border border-[#D8C6A8]/40 px-3.5 py-1.5 rounded-full text-[#F7F0E3] font-medium">
                    <span x-text="dob"></span>
                    <span class="text-[#C49A45]">•</span>
                    <span x-text="time"></span>
                    <span class="text-[#C49A45]">•</span>
                    <span x-text="place"></span>
                </div>
            </div>

            <!-- North Indian Diamond Chart Diagram & Summary -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- North Indian Diamond Format Chart SVG -->
                <div class="lg:col-span-5 w-full aspect-square max-w-[320px] mx-auto bg-[#541F1D] border-2 border-[#C49A45] rounded-xl p-3 relative flex items-center justify-center shadow-inner">
                    <svg viewBox="0 0 300 300" class="w-full h-full text-[#C49A45] stroke-current fill-none" stroke-width="1.5">
                        <!-- Outer Boundary Box -->
                        <rect x="10" y="10" width="280" height="280"/>
                        <!-- Inner Diagonals -->
                        <line x1="10" y1="10" x2="290" y2="290"/>
                        <line x1="290" y1="10" x2="10" y2="290"/>
                        <!-- Inner Diamond -->
                        <polygon points="150,10 290,150 150,290 10,150"/>
                        
                        <!-- House Numbers & Planetary Indicators -->
                        <text x="145" y="60" class="fill-[#C49A45] text-[10px] font-bold">1 (Lagna)</text>
                        <text x="70" y="100" class="fill-[#F7F0E3] text-[9px]">Su, Me</text>
                        <text x="210" y="100" class="fill-[#F7F0E3] text-[9px]">Ju, Ve</text>
                        <text x="145" y="240" class="fill-[#F7F0E3] text-[9px]">Sa (R)</text>
                        <text x="70" y="200" class="fill-[#F7F0E3] text-[9px]">Mo</text>
                        <text x="210" y="200" class="fill-[#F7F0E3] text-[9px]">Ma, Ra</text>
                    </svg>
                </div>

                <!-- Key Chart Observations -->
                <div class="lg:col-span-7 space-y-4 text-xs sm:text-sm text-[#EDE3D4]">
                    <h4 class="font-serif-luxury text-xl font-bold text-[#C49A45]">Key Chart Observations</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div class="p-3 bg-[#541F1D] border border-[#D8C6A8]/30 rounded-lg">
                            <span class="text-[#C49A45] block text-[10px] uppercase font-bold tracking-wider">Lagna (Ascendant)</span>
                            <span class="text-[#F7F0E3] font-semibold text-sm">Leo (Simha)</span>
                        </div>
                        <div class="p-3 bg-[#541F1D] border border-[#D8C6A8]/30 rounded-lg">
                            <span class="text-[#C49A45] block text-[10px] uppercase font-bold tracking-wider">Moon Sign (Rashi)</span>
                            <span class="text-[#F7F0E3] font-semibold text-sm">Cancer (Karka)</span>
                        </div>
                        <div class="p-3 bg-[#541F1D] border border-[#D8C6A8]/30 rounded-lg">
                            <span class="text-[#C49A45] block text-[10px] uppercase font-bold tracking-wider">Active Dasha</span>
                            <span class="text-[#F7F0E3] font-semibold text-sm">Jupiter (Guru) Mahadasha</span>
                        </div>
                        <div class="p-3 bg-[#541F1D] border border-[#D8C6A8]/30 rounded-lg">
                            <span class="text-[#C49A45] block text-[10px] uppercase font-bold tracking-wider">Prominent Yogas</span>
                            <span class="text-[#F7F0E3] font-semibold text-sm">Gajakesari & Budhaditya</span>
                        </div>
                    </div>

                    <div class="pt-3">
                        <a href="{{ route('consultation.book') }}" 
                           class="block text-center w-full py-3.5 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] border border-[#D8C6A8] rounded-lg shadow hover:bg-[#351211] transition-all">
                            GET FULL DETAILED ANALYSIS FROM TAMAL SIR →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. WHAT IS A KUNDLI? (EDUCATIONAL SECTION - SOFT BEIGE #EDE3D4) -->
<section class="bg-[#EDE3D4] text-[#29211F] py-14 lg:py-16 border-t border-[#D8C6A8] relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-4 relative z-10">
        <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45] block">
            UNDERSTANDING KUNDLI
        </span>
        
        <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">
            What Does a Kundli Show?
        </h2>

        <p class="text-sm sm:text-base text-[#81766D] leading-relaxed font-light max-w-3xl mx-auto">
            A birth chart (Kundli) is traditionally created using exact astronomical parameters calculated for the specific moment and place of birth. In Vedic astrology, it serves as a structural framework for examining planetary placements, house relationships, and time cycles.
        </p>
    </div>
</section>

<!-- 4. KEY COMPONENTS (6-ITEM EDITORIAL GRID - LIGHT IVORY #FDFBF7) -->
<section class="bg-[#FDFBF7] text-[#29211F] border-t border-[#D8C6A8] py-14 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 lg:space-y-10">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45] block">CORE CONCEPTS</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">Key Kundli Components</h2>
        </div>

        <!-- 6 Editorial Grid Cards (3 Cols Desktop, 2 Cols Tablet, 1 Col Mobile) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- 01. LAGNA -->
            <div class="bg-[#EDE3D4] p-7 rounded-2xl border border-[#D8C6A8] shadow-sm hover:shadow-md transition-shadow space-y-3">
                <span class="font-serif-luxury text-xl font-bold text-[#C49A45] block">01</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">LAGNA</h3>
                <p class="text-xs text-[#81766D] leading-relaxed font-normal">
                    The ascendant sign rising on the eastern horizon, calculated from the exact birth time and location.
                </p>
            </div>

            <!-- 02. RASHI -->
            <div class="bg-[#EDE3D4] p-7 rounded-2xl border border-[#D8C6A8] shadow-sm hover:shadow-md transition-shadow space-y-3">
                <span class="font-serif-luxury text-xl font-bold text-[#C49A45] block">02</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">RASHI</h3>
                <p class="text-xs text-[#81766D] leading-relaxed font-normal">
                    The zodiac sign associated with the Moon's position at birth, reflecting mental temperament.
                </p>
            </div>

            <!-- 03. CHANDRA RASHI -->
            <div class="bg-[#EDE3D4] p-7 rounded-2xl border border-[#D8C6A8] shadow-sm hover:shadow-md transition-shadow space-y-3">
                <span class="font-serif-luxury text-xl font-bold text-[#C49A45] block">03</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">CHANDRA RASHI</h3>
                <p class="text-xs text-[#81766D] leading-relaxed font-normal">
                    The Moon's specific placement and house position considered within the birth chart framework.
                </p>
            </div>

            <!-- 04. PLANETARY POSITIONS -->
            <div class="bg-[#EDE3D4] p-7 rounded-2xl border border-[#D8C6A8] shadow-sm hover:shadow-md transition-shadow space-y-3">
                <span class="font-serif-luxury text-xl font-bold text-[#C49A45] block">04</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">PLANETARY POSITIONS</h3>
                <p class="text-xs text-[#81766D] leading-relaxed font-normal">
                    The exact degree and house positions of key planets represented within the chart.
                </p>
            </div>

            <!-- 05. BHAVA -->
            <div class="bg-[#EDE3D4] p-7 rounded-2xl border border-[#D8C6A8] shadow-sm hover:shadow-md transition-shadow space-y-3">
                <span class="font-serif-luxury text-xl font-bold text-[#C49A45] block">05</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">BHAVA</h3>
                <p class="text-xs text-[#81766D] leading-relaxed font-normal">
                    The twelve houses traditionally used to represent different areas of life experience and growth.
                </p>
            </div>

            <!-- 06. NAKSHATRA -->
            <div class="bg-[#EDE3D4] p-7 rounded-2xl border border-[#D8C6A8] shadow-sm hover:shadow-md transition-shadow space-y-3">
                <span class="font-serif-luxury text-xl font-bold text-[#C49A45] block">06</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">NAKSHATRA</h3>
                <p class="text-xs text-[#81766D] leading-relaxed font-normal">
                    The lunar constellation associated with the Moon's exact position at the moment of birth.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 5. WHY ACCURATE BIRTH DETAILS MATTER ("Birth Time Matters" — DEEP BURGUNDY #351211) -->
<section class="bg-[#351211] text-[#F7F0E3] py-20 lg:py-24 relative overflow-hidden border-t border-[#C49A45]/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">PRECISION MATTERS</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#F7F0E3]">Birth Time Matters</h2>
            <p class="text-[#EDE3D4] text-sm font-light leading-relaxed">
                Even a small difference in recorded birth time can affect certain chart calculations. Enter the details as accurately as possible when generating your Kundli.
            </p>
        </div>

        <!-- 3 Visual Points Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
            <!-- Point 1: DATE -->
            <div class="bg-[#541F1D] border border-[#D8C6A8]/30 p-7 rounded-2xl space-y-3 text-center shadow-xl">
                <div class="w-12 h-12 rounded-full bg-[#C49A45]/10 border border-[#C49A45]/40 mx-auto flex items-center justify-center text-[#C49A45]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="font-serif-luxury text-xl font-bold text-[#F7F0E3]">DATE</h3>
                <p class="text-xs text-[#EDE3D4] font-light leading-relaxed">
                    Accurate birth date determines planetary longitudes and overall solar position.
                </p>
            </div>

            <!-- Point 2: TIME -->
            <div class="bg-[#541F1D] border border-[#D8C6A8]/30 p-7 rounded-2xl space-y-3 text-center shadow-xl">
                <div class="w-12 h-12 rounded-full bg-[#C49A45]/10 border border-[#C49A45]/40 mx-auto flex items-center justify-center text-[#C49A45]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-serif-luxury text-xl font-bold text-[#F7F0E3]">TIME</h3>
                <p class="text-xs text-[#EDE3D4] font-light leading-relaxed">
                    As precise as possible to ensure accurate calculation of Lagna (ascendant) and house cusps.
                </p>
            </div>

            <!-- Point 3: PLACE -->
            <div class="bg-[#541F1D] border border-[#D8C6A8]/30 p-7 rounded-2xl space-y-3 text-center shadow-xl">
                <div class="w-12 h-12 rounded-full bg-[#C49A45]/10 border border-[#C49A45]/40 mx-auto flex items-center justify-center text-[#C49A45]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="font-serif-luxury text-xl font-bold text-[#F7F0E3]">PLACE</h3>
                <p class="text-xs text-[#EDE3D4] font-light leading-relaxed">
                    Correct birthplace geographic coordinates for local sidereal time calculation.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 6. PERSONAL GUIDANCE CONSULTATION SECTION (LIGHT IVORY #FDFBF7) -->
<section class="bg-[#FDFBF7] text-[#29211F] py-16 lg:py-20 border-t border-[#D8C6A8]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-5">
        <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45] block">
            PERSONAL GUIDANCE
        </span>

        <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">
            Want to Explore Your Chart in Greater Detail?
        </h2>

        <p class="text-[#81766D] text-sm sm:text-base font-normal max-w-xl mx-auto leading-relaxed">
            Book a consultation to discuss your birth chart and important questions through an astrological perspective.
        </p>

        <div class="pt-4 flex justify-center">
            <a href="{{ route('consultation.book') }}" 
               class="inline-flex items-center px-8 py-3.5 rounded-lg text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#D8C6A8] shadow-xl transition-all">
                <span>BOOK A CONSULTATION</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

@endsection
