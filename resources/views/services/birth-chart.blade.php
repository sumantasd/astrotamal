@extends('layouts.app')

@section('title', 'Vedic Birth Chart Analysis & Janma Kundli Reading — Tamal Chakraborty')
@section('meta_description', 'In-depth Vedic birth chart analysis (Janma Kundli reading). Explore planetary positions, Lagna, Rashi, Nakshatras, Mahadasha cycles, and personalized life guidance with Tamal Chakraborty.')

@section('content')

<!-- 1. HERO SECTION (Warm Cream #F7F0E3 Background) -->
<section class="relative bg-[#F7F0E3] text-[#29211F] py-16 sm:py-20 overflow-hidden border-b border-[#D8C6A8] flex items-center min-h-[380px] max-h-[460px]">
    <div class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#C49A45_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#C49A45]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4">
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#C49A45]">
            <a href="{{ route('home') }}" class="hover:text-[#541F1D] transition-colors">HOME</a>
            <span>/</span>
            <a href="{{ route('services.index') }}" class="hover:text-[#541F1D] transition-colors">SERVICES</a>
            <span>/</span>
            <span class="text-[#29211F] font-semibold">BIRTH CHART ANALYSIS</span>
        </nav>

        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">JANMA KUNDLI READING</span>
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
        </div>

        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F]">
            Vedic Birth Chart Analysis
        </h1>

        <p class="text-xs sm:text-sm md:text-base text-[#81766D] max-w-2xl mx-auto font-normal leading-relaxed">
            Understand your birth chart, planetary positions, Lagna, Rashi, and major Dasha cycles through classical Vedic astrology interpretation.
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
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">DEEP ASTROLOGICAL EXAMINATION</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">
                Beyond Generic Horoscope Readings: The Power of a Personalized Janma Kundli
            </h2>
            <div class="prose prose-lg max-w-none text-[#81766D] text-sm sm:text-base leading-relaxed space-y-4 font-normal">
                <p>
                    A <strong>Vedic birth chart (Janma Kundli)</strong> is a precise astronomical snapshot of the cosmos calculated for the exact moment and geographic coordinates of your birth. Unlike generic sun-sign horoscopes found in popular media, an authentic <strong>birth chart analysis</strong> examines the twelve houses (Bhavas), nine primary grahas (planets), Lagna (ascendant), Chandra Rashi (Moon sign), and twenty-seven Nakshatras (lunar mansions).
                </p>
                <p>
                    In classical Parashari Vedic Astrology, your birth chart serves as a structural blueprint of your life’s potential, innate inclinations, karmic timing, and emotional disposition. A comprehensive Kundli reading evaluates how planetary forces interact within your specific chart to influence career growth, relationship harmony, financial stability, health tendencies, and spiritual development.
                </p>
            </div>
        </div>

        <!-- 3. WHAT THIS SERVICE COVERS -->
        <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl p-8 sm:p-12 shadow-sm space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">ANALYTICAL SCOPE</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F]">What This Consultation Covers</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#541F1D] block">01</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">Lagna & Ascendant Lord</h4>
                    <p class="text-xs text-[#81766D] leading-relaxed">Detailed assessment of your 1st house, ascendant sign, and Lagnesha to understand physical vitality, temperament, and core life orientation.</p>
                </div>

                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#541F1D] block">02</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">Chandra Rashi & Nakshatra</h4>
                    <p class="text-xs text-[#81766D] leading-relaxed">Evaluation of Moon placement and lunar constellation to analyze psychological patterns, emotional resilience, and instinctual responses.</p>
                </div>

                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#541F1D] block">03</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">Vimshottari Dasha Cycles</h4>
                    <p class="text-xs text-[#81766D] leading-relaxed">In-depth calculation of your major (Mahadasha) and minor (Antardasha) planetary periods to determine active time windows for major life developments.</p>
                </div>
            </div>
        </div>

        <!-- 4. WHY THIS ANALYSIS MATTERS -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">PRACTICAL VALUE</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">Why a Birth Chart Analysis Matters</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs sm:text-sm text-[#81766D]">
                <div class="p-5 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <strong class="text-[#29211F] block font-semibold text-base font-serif-luxury">Clarity During Transition Periods</strong>
                    <p>When facing career shifts, business decisions, or personal crossroads, your chart reveals underlying planetary timing, helping you act with confidence rather than uncertainty.</p>
                </div>
                <div class="p-5 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <strong class="text-[#29211F] block font-semibold text-base font-serif-luxury">Understanding Natural Strengths</strong>
                    <p>Identify innate planetary Yogas and favorable house placements that indicate professional aptitude, financial avenues, and personal gifts.</p>
                </div>
            </div>
        </div>

        <!-- 5. HOW THE CONSULTATION WORKS (Primary Burgundy #541F1D Background) -->
        <div class="bg-[#541F1D] text-[#F7F0E3] rounded-2xl p-8 sm:p-12 border border-[#D8C6A8]/40 space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">CONSULTATION PROCESS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#F7F0E3]">How the Janma Kundli Session Works</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">1</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Birth Details</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Submit date, exact time, and birthplace.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">2</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Chart Calculation</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Sidereal computation of Kundli & Dashas.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">3</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">1-on-1 Consultation</h4>
                    <p class="text-xs text-[#F7F0E3]/90">45-minute live audio/video discussion.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">4</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Practical Remedies</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Time-tested lifestyle & gemstone guidance.</p>
                </div>
            </div>
        </div>

        <!-- 6. KEY AREAS COVERED -->
        <div class="space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">LIFE DIMENSIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F]">Key Life Dimensions Analyzed</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">1. Career & Profession (10th House)</h4>
                    <p class="text-xs text-[#81766D]">Evaluation of career direction, job stability, leadership capacity, and professional timing.</p>
                </div>
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">2. Wealth & Finances (2nd & 11th)</h4>
                    <p class="text-xs text-[#81766D]">Analysis of income potential, financial stability, asset accumulation, and financial timing.</p>
                </div>
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">3. Relationships & Marriage (7th House)</h4>
                    <p class="text-xs text-[#81766D]">Understanding partnership compatibility, marital harmony, and interpersonal relationship dynamics.</p>
                </div>
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">4. Health & Vitality (1st & 6th)</h4>
                    <p class="text-xs text-[#81766D]">Astrological indications regarding constitution, stress management, and physical vitality windows.</p>
                </div>
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">5. Higher Education & Wisdom (5th & 9th)</h4>
                    <p class="text-xs text-[#81766D]">Guidance for academic focus, higher learning, intellectual aptitude, and mentorship opportunities.</p>
                </div>
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">6. Spiritual Growth & Life Direction (9th & 12th)</h4>
                    <p class="text-xs text-[#81766D]">Understanding your inner life purpose, philosophical inclinations, and personal growth periods.</p>
                </div>
            </div>
        </div>

        <!-- 7. WHO THIS SERVICE IS FOR -->
        <div class="bg-[#EDE3D4] border border-[#D8C6A8] rounded-2xl p-8 sm:p-10 space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F]">Who This Consultation Is For</h3>
            <ul class="space-y-2.5 text-xs sm:text-sm text-[#81766D]">
                <li class="flex items-start space-x-3"><span class="text-[#541F1D] font-bold mt-0.5">✓</span><span>Individuals seeking a comprehensive foundational understanding of their birth chart.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#541F1D] font-bold mt-0.5">✓</span><span>Anyone navigating major career, business, relationship, or relocation decisions.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#541F1D] font-bold mt-0.5">✓</span><span>People experiencing period changes (Dasha Sandhi) or major transit shifts.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#541F1D] font-bold mt-0.5">✓</span><span>Seekers who want authentic, practical Vedic advice without fear-based assertions.</span></li>
            </ul>
        </div>

        <!-- 8. IMPORTANT QUESTIONS THIS CONSULTATION CAN EXPLORE -->
        <div class="space-y-6">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F] text-center">Questions Frequently Explored in This Session</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-[#29211F]">
                <div class="p-4 bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg">"What are the most prominent planetary strengths and Yogas in my birth chart?"</div>
                <div class="p-4 bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg">"Which planetary Mahadasha period am I running and what life areas does it activate?"</div>
                <div class="p-4 bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg">"What career paths align best with my 10th house, Saturn, and Mercury placements?"</div>
                <div class="p-4 bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg">"What practical remedies can help harmonize challenging planetary positions?"</div>
            </div>
        </div>

        <!-- 9. ASTROLOGICAL APPROACH & METHODOLOGY -->
        <div class="max-w-4xl mx-auto space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F]">Astrological Approach & Methodology</h3>
            <p class="text-xs sm:text-sm text-[#81766D] leading-relaxed">
                Tamal Chakraborty practices classical Parashara and Jaimini Vedic Astrology using Lahiri Ayanamsha (Sidereal Zodiac). Every consultation combines rigorous astronomical calculation with compassionate, realistic guidance. Predictions are never presented as unalterable fatalism; rather, astrology is treated as an enlightening mirror to understand timing and exercise conscious free will.
            </p>
        </div>

        <!-- 10. WHAT YOU CAN EXPECT -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl p-6 sm:p-8 space-y-4 shadow-sm">
            <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">What You Can Expect From the Session</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-[#81766D]">
                <div><strong class="text-[#29211F] block">100% Confidentiality</strong> Your personal details and discussion remain strictly private.</div>
                <div><strong class="text-[#29211F] block">Clear Answers</strong> Direct answers to your specific queries without ambiguity.</div>
                <div><strong class="text-[#29211F] block">Authentic Remedies</strong> Practical, non-superstitious remedial guidance.</div>
            </div>
        </div>

        <!-- 11. FAQ SECTION -->
        <div class="space-y-6" x-data="{ activeFaq: null }">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">FREQUENTLY ASKED QUESTIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F]">Birth Chart FAQ</h3>
            </div>

            <div class="space-y-4 max-w-3xl mx-auto">
                <div class="border border-[#D8C6A8] rounded-xl overflow-hidden bg-[#FDFBF7]">
                    <button x-on:click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#29211F] flex items-center justify-between">
                        <span>What information do I need to provide for a birth chart reading?</span>
                        <span x-text="activeFaq === 1 ? '−' : '+'" class="text-[#C49A45] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 1" x-cloak class="px-5 pb-5 text-xs text-[#81766D] leading-relaxed border-t border-[#D8C6A8]/40 pt-3">
                        You need to provide your exact Date of Birth, exact Time of Birth (including AM/PM), and Place of Birth (City/State). Accurate birth time is important for calculating the precise Lagna (ascendant) and house cusps.
                    </div>
                </div>

                <div class="border border-[#D8C6A8] rounded-xl overflow-hidden bg-[#FDFBF7]">
                    <button x-on:click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#29211F] flex items-center justify-between">
                        <span>What if I do not know my exact birth time?</span>
                        <span x-text="activeFaq === 2 ? '−' : '+'" class="text-[#C49A45] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 2" x-cloak class="px-5 pb-5 text-xs text-[#81766D] leading-relaxed border-t border-[#D8C6A8]/40 pt-3">
                        If your birth time is approximate, planetary positions in Rashis and major Dasha cycles can still be calculated. For exact house placements, birth time rectification or Prashna (Horary) methods can be applied during the consultation.
                    </div>
                </div>

                <div class="border border-[#D8C6A8] rounded-xl overflow-hidden bg-[#FDFBF7]">
                    <button x-on:click="activeFaq = (activeFaq === 3 ? null : 3)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#29211F] flex items-center justify-between">
                        <span>How is Vedic Birth Chart Analysis different from Western astrology?</span>
                        <span x-text="activeFaq === 3 ? '−' : '+'" class="text-[#C49A45] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 3" x-cloak class="px-5 pb-5 text-xs text-[#81766D] leading-relaxed border-t border-[#D8C6A8]/40 pt-3">
                        Vedic Astrology (Jyotish) utilizes the Sidereal Zodiac based on fixed star constellations and incorporates Nakshatras and Vimshottari Dasha planetary periods for precise predictive timing, whereas Western astrology uses the Tropical Zodiac.
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
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">• SCHEDULE YOUR SESSION •</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#F7F0E3]">Ready to Explore Your Janma Kundli?</h2>
            <p class="text-xs sm:text-sm text-[#F7F0E3]/90 max-w-xl mx-auto font-normal leading-relaxed">Book a 1-on-1 private consultation with Tamal Chakraborty to understand your birth chart, Dashas, and key life directions.</p>
            <a href="{{ route('consultation.book') }}" class="inline-flex items-center space-x-2 px-8 py-4 bg-[#F7F0E3] text-[#541F1D] border border-[#D8C6A8] font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#EDE3D4] hover:text-[#351211] transition-all shadow-lg">
                <span>BOOK BIRTH CHART CONSULTATION</span>
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
  "name": "Vedic Birth Chart Analysis & Janma Kundli Reading",
  "provider": {
    "@type": "Person",
    "name": "Tamal Chakraborty",
    "url": "https://astrotamal.com"
  },
  "areaServed": "Worldwide",
  "description": "Comprehensive Vedic birth chart analysis examining planetary placements, Lagna, Chandra Rashi, Nakshatras, and Vimshottari Dasha timing."
}
</script>

@endsection
