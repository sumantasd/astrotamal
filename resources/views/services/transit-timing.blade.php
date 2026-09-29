@extends('layouts.app')

@section('title', 'Planetary Transit & Timing Analysis (Gochar Astrology) — Tamal Chakraborty')
@section('meta_description', 'Explore planetary transits (Gochar), Saturn transit, Jupiter transit, Rahu-Ketu shifts, and astrological timing for major career and life decisions with Tamal Chakraborty.')

@section('content')

<!-- HERO SECTION (Warm Cream #F7F0E3 Background) -->
<section class="relative bg-[#F7F0E3] text-[#29211F] py-16 sm:py-20 overflow-hidden border-b border-[#D8C6A8] flex items-center min-h-[380px] max-h-[460px]">
    <div class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#C49A45_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#C49A45]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4">
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#C49A45]">
            <a href="{{ route('home') }}" class="hover:text-[#541F1D] transition-colors">HOME</a>
            <span>/</span>
            <a href="{{ route('services.index') }}" class="hover:text-[#541F1D] transition-colors">SERVICES</a>
            <span>/</span>
            <span class="text-[#29211F] font-semibold">TRANSIT & TIMING ANALYSIS</span>
        </nav>

        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">GOCHAR & PLANETARY TIMING</span>
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
        </div>

        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F]">
            Transit & Timing Analysis
        </h1>

        <p class="text-xs sm:text-sm md:text-base text-[#81766D] max-w-2xl mx-auto font-normal leading-relaxed">
            Understand planetary transits (Gochar), major planetary shifts, and timing cycles to navigate key decisions with astrological perspective.
        </p>

        <div class="pt-2 flex justify-center items-center space-x-4 text-xs text-[#C49A45] font-semibold">
            <span>Duration: {{ $service->duration ?? '45 Mins' }}</span>
            <span>•</span>
            <span>Mode: 1-on-1 Confidential Video/Audio</span>
        </div>
    </div>
</section>

<!-- MAIN CONTENT SECTION -->
<section class="bg-[#FDFBF7] text-[#29211F] py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <!-- 2. SERVICE INTRODUCTION -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">TIMING THE WHEEL OF TIME</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">
                Understanding Gochar: How Current Planetary Movements Interact With Your Natal Chart
            </h2>
            <div class="prose prose-lg max-w-none text-[#81766D] text-sm sm:text-base leading-relaxed space-y-4 font-normal">
                <p>
                    While your birth chart represents the static blueprint of your life, <strong>planetary transits (Gochar)</strong> represent the dynamic, ever-moving cosmos. In Vedic Astrology, transits of major slow-moving planets—specifically <strong>Jupiter (Guru), Saturn (Shani), and the nodal axis of Rahu and Ketu</strong>—act as triggers that activate the promises dormant in your Janma Kundli.
                </p>
                <p>
                    A dedicated <strong>Transit & Timing Analysis</strong> evaluates how current planetary movements form aspects and house placements relative to your ascendant (Lagna) and Moon sign (Chandra Rashi). This analysis provides valuable perspective during times of transition, helping you discern periods that favor bold initiative versus phases that require patience and preparation.
                </p>
            </div>
        </div>

        <!-- 3. WHAT THIS SERVICE COVERS -->
        <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl p-8 sm:p-12 shadow-sm space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">ANALYTICAL SCOPE</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F]">What This Transit Consultation Covers</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#541F1D] block">01</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">Saturn Transit (Shani Gochar)</h4>
                    <p class="text-xs text-[#81766D] leading-relaxed">Evaluation of Saturn’s 2.5-year house transit, Sade Sati phases, or Dhaiya to understand areas requiring discipline and structural focus.</p>
                </div>

                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#541F1D] block">02</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">Jupiter Transit (Guru Gochar)</h4>
                    <p class="text-xs text-[#81766D] leading-relaxed">Assessment of Jupiter’s annual transit aspects to identify growth opportunities, wisdom, financial expanding phases, and mentorship.</p>
                </div>

                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#541F1D] block">03</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">Rahu & Ketu Axis Shifts</h4>
                    <p class="text-xs text-[#81766D] leading-relaxed">Analysis of the 18-month lunar node transits highlighting innovative opportunities, karmic adjustments, and areas of focus.</p>
                </div>
            </div>
        </div>

        <!-- 4. WHY THIS ANALYSIS MATTERS -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">PRACTICAL VALUE</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">Why Astrological Timing Matters</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs sm:text-sm text-[#81766D]">
                <div class="p-5 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <strong class="text-[#29211F] block font-semibold text-base font-serif-luxury">Opportunity Windows</strong>
                    <p>Identify time windows when planetary transits harmonize with your Dasha periods, optimizing career moves, business launches, or financial investments.</p>
                </div>
                <div class="p-5 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <strong class="text-[#29211F] block font-semibold text-base font-serif-luxury">Caution & Preparation Phases</strong>
                    <p>Recognize challenging transit aspects in advance, allowing you to avoid unnecessary friction and maintain patience during temporary slowdowns.</p>
                </div>
            </div>
        </div>

        <!-- 5. HOW THE CONSULTATION WORKS (Primary Burgundy #541F1D Background) -->
        <div class="bg-[#541F1D] text-[#F7F0E3] rounded-2xl p-8 sm:p-12 border border-[#D8C6A8]/40 space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">CONSULTATION PROCESS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#F7F0E3]">How the Timing Session Works</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">1</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Natal Chart Setup</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Establish birth chart baselines.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">2</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Gochar Mapping</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Calculate current & upcoming transits.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">3</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Dasha & Transit Synergy</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Overlay planetary periods with transits.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">4</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Actionable Windows</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Identify optimal timing windows.</p>
                </div>
            </div>
        </div>

        <!-- 6. KEY AREAS COVERED -->
        <div class="space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">TIMING DIMENSIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F]">Key Life Decisions & Timing Windows</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">1. Career & Job Switch Timing</h4>
                    <p class="text-xs text-[#81766D]">Evaluating 10th house transits of Jupiter and Saturn for optimal job transitions.</p>
                </div>
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">2. Business Expansion Windows</h4>
                    <p class="text-xs text-[#81766D]">Timing commercial launches, expansion, and partnerships relative to planetary Gochar.</p>
                </div>
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">3. Financial Decisions & Assets</h4>
                    <p class="text-xs text-[#81766D]">Identifying periods for major asset acquisitions, investments, or capital preservation.</p>
                </div>
            </div>
        </div>

        <!-- 7. WHO THIS SERVICE IS FOR -->
        <div class="bg-[#EDE3D4] border border-[#D8C6A8] rounded-2xl p-8 sm:p-10 space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F]">Who This Consultation Is For</h3>
            <ul class="space-y-2.5 text-xs sm:text-sm text-[#81766D]">
                <li class="flex items-start space-x-3"><span class="text-[#541F1D] font-bold mt-0.5">✓</span><span>Professionals planning a major job change, promotion request, or career pivot.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#541F1D] font-bold mt-0.5">✓</span><span>Entrepreneurs timing new venture launches or strategic business expansion.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#541F1D] font-bold mt-0.5">✓</span><span>Anyone undergoing Sade Sati, Dhaiya, or major Rahu-Ketu transit phases.</span></li>
            </ul>
        </div>

        <!-- 8. IMPORTANT QUESTIONS -->
        <div class="space-y-6">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F] text-center">Questions Explored in This Session</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-[#29211F]">
                <div class="p-4 bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg">"How does current Saturn transit affect my career and financial house placements?"</div>
                <div class="p-4 bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg">"Which months of 2026 offer the most favorable planetary support for a job switch?"</div>
                <div class="p-4 bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg">"How is Jupiter's transit influencing my overall stability and personal relationships?"</div>
            </div>
        </div>

        <!-- 9. METHODOLOGY -->
        <div class="max-w-4xl mx-auto space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F]">Astrological Approach & Methodology</h3>
            <p class="text-xs sm:text-sm text-[#81766D] leading-relaxed">
                Transits are always evaluated in direct reference to your natal birth chart (Janma Kundli) and active Vimshottari Dasha. Transits never act in isolation; rather, a transit can only deliver results that are supported by your natal chart and active Dasha period.
            </p>
        </div>

        <!-- 10. WHAT YOU CAN EXPECT -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl p-6 sm:p-8 space-y-4 shadow-sm">
            <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">What You Can Expect From the Session</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-[#81766D]">
                <div><strong class="text-[#29211F] block">Objective Analysis</strong> Realistic evaluation of planetary timing without fear.</div>
                <div><strong class="text-[#29211F] block">Actionable Windows</strong> Clear identification of favorable and cautious time periods.</div>
                <div><strong class="text-[#29211F] block">100% Privacy</strong> Strict confidentiality assured for all personal details.</div>
            </div>
        </div>

        <!-- 11. FAQ SECTION -->
        <div class="space-y-6" x-data="{ activeFaq: null }">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">FREQUENTLY ASKED QUESTIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F]">Transit & Timing FAQ</h3>
            </div>

            <div class="space-y-4 max-w-3xl mx-auto">
                <div class="border border-[#D8C6A8] rounded-xl overflow-hidden bg-[#FDFBF7]">
                    <button x-on:click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#29211F] flex items-center justify-between">
                        <span>What is the difference between birth chart analysis and transit analysis?</span>
                        <span x-text="activeFaq === 1 ? '−' : '+'" class="text-[#C49A45] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 1" x-cloak class="px-5 pb-5 text-xs text-[#81766D] leading-relaxed border-t border-[#D8C6A8]/40 pt-3">
                        Your birth chart is the permanent blueprint of your life's potential, whereas transits (Gochar) represent the movement of planets today. Transits indicate *when* specific natal chart themes are activated.
                    </div>
                </div>

                <div class="border border-[#D8C6A8] rounded-xl overflow-hidden bg-[#FDFBF7]">
                    <button x-on:click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#29211F] flex items-center justify-between">
                        <span>Does astrology guarantee future events during transits?</span>
                        <span x-text="activeFaq === 2 ? '−' : '+'" class="text-[#C49A45] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 2" x-cloak class="px-5 pb-5 text-xs text-[#81766D] leading-relaxed border-t border-[#D8C6A8]/40 pt-3">
                        No. Astrology provides a traditional interpretation of time phases and opportunities. Outcomes depend on your choices, efforts, and free will exercised during those planetary windows.
                    </div>
                </div>
            </div>
        </div>

        <!-- 12. RELATED SERVICES -->
        <div class="space-y-6 pt-6 border-t border-[#D8C6A8]">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F] text-center">Related Astrology Services</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($otherServices as $oth)
                    <a href="{{ route('services.show', $oth->slug) }}" class="block bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl p-5 hover:border-[#C49A45] transition-all group">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#C49A45] block">{{ $oth->badge }}</span>
                        <h4 class="font-serif-luxury text-base font-bold text-[#29211F] group-hover:text-[#541F1D] transition-colors mt-1">{{ $oth->title }}</h4>
                        <p class="text-xs text-[#81766D] mt-1 line-clamp-2">{{ $oth->short_description }}</p>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- 13. BOOK CONSULTATION CTA (Primary Burgundy #541F1D Background) -->
        <div class="bg-[#541F1D] text-[#F7F0E3] rounded-2xl p-8 sm:p-12 text-center space-y-6 border border-[#D8C6A8]">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">• TIMING CONSULTATION •</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#F7F0E3]">Understand Your Time & Planetary Cycles</h2>
            <p class="text-xs sm:text-sm text-[#F7F0E3]/90 max-w-xl mx-auto font-normal leading-relaxed">Book a 1-on-1 private timing consultation with Tamal Chakraborty to evaluate your current Gochar and Dasha cycles.</p>
            <a href="{{ route('consultation.book') }}" class="inline-flex items-center space-x-2 px-8 py-4 bg-[#F7F0E3] text-[#541F1D] border border-[#D8C6A8] font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#EDE3D4] hover:text-[#351211] transition-all shadow-lg">
                <span>BOOK TRANSIT CONSULTATION</span>
                <span class="text-[#C49A45]">→</span>
            </a>
        </div>

    </div>
</section>

<!-- 14. SCHEMA.ORG JSON-LD -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "Service",
  "name": "Planetary Transit & Timing Analysis (Gochar Astrology)",
  "provider": {
    "@type": "Person",
    "name": "Tamal Chakraborty",
    "url": "https://astrotamal.com"
  },
  "areaServed": "Worldwide",
  "description": "Vedic Gochar planetary transit analysis examining Saturn, Jupiter, and Rahu-Ketu transit timing for career and business decisions."
}
</script>

@endsection
