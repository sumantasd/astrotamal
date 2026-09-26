@extends('layouts.app')

@section('title', 'Vedic Birth Chart Analysis & Janma Kundli Reading — Tamal Chakraborty')
@section('meta_description', 'In-depth Vedic birth chart analysis (Janma Kundli reading). Explore planetary positions, Lagna, Rashi, Nakshatras, Mahadasha cycles, and personalized life guidance with Tamal Chakraborty.')

@section('content')

<!-- 1. HERO SECTION -->
<section class="relative bg-[#0B1018] text-[#FDFBF7] py-16 sm:py-20 overflow-hidden border-b border-[rgba(212,175,55,0.25)] flex items-center min-h-[380px] max-h-[460px]">
    <div class="absolute inset-0 opacity-15 pointer-events-none bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[rgba(212,175,55,0.05)] rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4">
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#9A7422]">
            <a href="{{ route('home') }}" class="hover:text-[#D4AF37] transition-colors">HOME</a>
            <span>/</span>
            <a href="{{ route('services.index') }}" class="hover:text-[#D4AF37] transition-colors">SERVICES</a>
            <span>/</span>
            <span class="text-[#D4AF37] font-semibold">BIRTH CHART ANALYSIS</span>
        </nav>

        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#D4AF37]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#D4AF37]">JANMA KUNDLI READING</span>
            <span class="h-px w-6 bg-[#D4AF37]/40"></span>
        </div>

        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#FDFBF7]">
            Vedic Birth Chart Analysis
        </h1>

        <p class="text-xs sm:text-sm md:text-base text-[#D7DCE3] max-w-2xl mx-auto font-light leading-relaxed">
            Understand your birth chart, planetary positions, Lagna, Rashi, and major Dasha cycles through classical Vedic astrology interpretation.
        </p>

        <div class="pt-2 flex justify-center items-center space-x-4 text-xs text-[#D4AF37] font-semibold">
            <span>Duration: {{ $service->duration ?? '45 Mins' }}</span>
            <span>•</span>
            <span>Mode: 1-on-1 Confidential Video/Audio</span>
        </div>
    </div>
</section>

<!-- MAIN CONTENT SECTION -->
<section class="bg-[#FDFBF7] text-[#17202D] py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <!-- 2. SERVICE INTRODUCTION -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E] block">DEEP ASTROLOGICAL EXAMINATION</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#17202D]">
                Beyond Generic Horoscope Readings: The Power of a Personalized Janma Kundli
            </h2>
            <div class="prose prose-lg max-w-none text-[#596273] text-sm sm:text-base leading-relaxed space-y-4 font-normal">
                <p>
                    A <strong>Vedic birth chart (Janma Kundli)</strong> is a precise astronomical snapshot of the cosmos calculated for the exact moment and geographic coordinates of your birth. Unlike generic sun-sign horoscopes found in popular media, an authentic <strong>birth chart analysis</strong> examines the twelve houses (Bhavas), nine primary grahas (planets), Lagna (ascendant), Chandra Rashi (Moon sign), and twenty-seven Nakshatras (lunar mansions).
                </p>
                <p>
                    In classical Parashari Vedic Astrology, your birth chart serves as a structural blueprint of your life’s potential, innate inclinations, karmic timing, and emotional disposition. A comprehensive Kundli reading evaluates how planetary forces interact within your specific chart to influence career growth, relationship harmony, financial stability, health tendencies, and spiritual development.
                </p>
            </div>
        </div>

        <!-- 3. WHAT THIS SERVICE COVERS -->
        <div class="bg-white border border-[#17202D]/15 rounded-2xl p-8 sm:p-12 shadow-sm space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">ANALYTICAL SCOPE</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">What This Consultation Covers</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">01</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Lagna & Ascendant Lord</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Detailed assessment of your 1st house, ascendant sign, and Lagnesha to understand physical vitality, temperament, and core life orientation.</p>
                </div>

                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">02</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Chandra Rashi & Nakshatra</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Evaluation of Moon placement and lunar constellation to analyze psychological patterns, emotional resilience, and instinctual responses.</p>
                </div>

                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">03</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Vimshottari Dasha Cycles</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">In-depth calculation of your major (Mahadasha) and minor (Antardasha) planetary periods to determine active time windows for major life developments.</p>
                </div>
            </div>
        </div>

        <!-- 4. WHY THIS ANALYSIS MATTERS -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E] block">PRACTICAL VALUE</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#17202D]">Why a Birth Chart Analysis Matters</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs sm:text-sm text-[#596273]">
                <div class="p-5 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <strong class="text-[#17202D] block font-semibold text-base font-serif-luxury">Clarity During Transition Periods</strong>
                    <p>When facing career shifts, business decisions, or personal crossroads, your chart reveals underlying planetary timing, helping you act with confidence rather than uncertainty.</p>
                </div>
                <div class="p-5 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <strong class="text-[#17202D] block font-semibold text-base font-serif-luxury">Understanding Natural Strengths</strong>
                    <p>Identify innate planetary Yogas and favorable house placements that indicate professional aptitude, financial avenues, and personal gifts.</p>
                </div>
            </div>
        </div>

        <!-- 5. HOW THE CONSULTATION WORKS -->
        <div class="bg-[#0B1018] text-[#FDFBF7] rounded-2xl p-8 sm:p-12 border border-[#B08A2E]/30 space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4AF37]">CONSULTATION PROCESS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#FDFBF7]">How the Janma Kundli Session Works</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">1</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Birth Details</h4>
                    <p class="text-xs text-[#D7DCE3]">Submit date, exact time, and birthplace.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">2</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Chart Calculation</h4>
                    <p class="text-xs text-[#D7DCE3]">Sidereal computation of Kundli & Dashas.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">3</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">1-on-1 Consultation</h4>
                    <p class="text-xs text-[#D7DCE3]">45-minute live audio/video discussion.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">4</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Practical Remedies</h4>
                    <p class="text-xs text-[#D7DCE3]">Time-tested lifestyle & gemstone guidance.</p>
                </div>
            </div>
        </div>

        <!-- 6. KEY AREAS COVERED -->
        <div class="space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">LIFE DIMENSIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">Key Life Dimensions Analyzed</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">1. Career & Profession (10th House)</h4>
                    <p class="text-xs text-[#596273]">Evaluation of career direction, job stability, leadership capacity, and professional timing.</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">2. Wealth & Finances (2nd & 11th)</h4>
                    <p class="text-xs text-[#596273]">Analysis of income potential, financial stability, asset accumulation, and financial timing.</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">3. Relationships & Marriage (7th House)</h4>
                    <p class="text-xs text-[#596273]">Understanding partnership compatibility, marital harmony, and interpersonal relationship dynamics.</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">4. Health & Vitality (1st & 6th)</h4>
                    <p class="text-xs text-[#596273]">Astrological indications regarding constitution, stress management, and physical vitality windows.</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">5. Higher Education & Wisdom (5th & 9th)</h4>
                    <p class="text-xs text-[#596273]">Guidance for academic focus, higher learning, intellectual aptitude, and mentorship opportunities.</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">6. Spiritual Growth & Life Direction (9th & 12th)</h4>
                    <p class="text-xs text-[#596273]">Understanding your inner life purpose, philosophical inclinations, and personal growth periods.</p>
                </div>
            </div>
        </div>

        <!-- 7. WHO THIS SERVICE IS FOR -->
        <div class="bg-[#FAF8F5] border border-[#17202D]/15 rounded-2xl p-8 sm:p-10 space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D]">Who This Consultation Is For</h3>
            <ul class="space-y-2.5 text-xs sm:text-sm text-[#596273]">
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Individuals seeking a comprehensive foundational understanding of their birth chart.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Anyone navigating major career, business, relationship, or relocation decisions.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>People experiencing period changes (Dasha Sandhi) or major transit shifts.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Seekers who want authentic, practical Vedic advice without fear-based assertions.</span></li>
            </ul>
        </div>

        <!-- 8. IMPORTANT QUESTIONS THIS CONSULTATION CAN EXPLORE -->
        <div class="space-y-6">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D] text-center">Questions Frequently Explored in This Session</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-[#17202D]">
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"What are the most prominent planetary strengths and Yogas in my birth chart?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"Which planetary Mahadasha period am I running and what life areas does it activate?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"What career paths align best with my 10th house, Saturn, and Mercury placements?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"What practical remedies can help harmonize challenging planetary positions?"</div>
            </div>
        </div>

        <!-- 9. ASTROLOGICAL APPROACH & METHODOLOGY -->
        <div class="max-w-4xl mx-auto space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D]">Astrological Approach & Methodology</h3>
            <p class="text-xs sm:text-sm text-[#596273] leading-relaxed">
                Tamal Chakraborty practices classical Parashara and Jaimini Vedic Astrology using Lahiri Ayanamsha (Sidereal Zodiac). Every consultation combines rigorous astronomical calculation with compassionate, realistic guidance. Predictions are never presented as unalterable fatalism; rather, astrology is treated as an enlightening mirror to understand timing and exercise conscious free will.
            </p>
        </div>

        <!-- 10. WHAT YOU CAN EXPECT -->
        <div class="bg-white border border-[#17202D]/15 rounded-xl p-6 sm:p-8 space-y-4">
            <h3 class="font-serif-luxury text-xl font-bold text-[#17202D]">What You Can Expect From the Session</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-[#596273]">
                <div><strong class="text-[#17202D] block">100% Confidentiality</strong> Your personal details and discussion remain strictly private.</div>
                <div><strong class="text-[#17202D] block">Clear Answers</strong> Direct answers to your specific queries without ambiguity.</div>
                <div><strong class="text-[#17202D] block">Authentic Remedies</strong> Practical, non-superstitious remedial guidance.</div>
            </div>
        </div>

        <!-- 11. FAQ SECTION -->
        <div class="space-y-6" x-data="{ activeFaq: null }">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">FREQUENTLY ASKED QUESTIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">Birth Chart FAQ</h3>
            </div>

            <div class="space-y-4 max-w-3xl mx-auto">
                <div class="border border-[#17202D]/15 rounded-xl overflow-hidden bg-white">
                    <button x-on:click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#17202D] flex items-center justify-between">
                        <span>What information do I need to provide for a birth chart reading?</span>
                        <span x-text="activeFaq === 1 ? '−' : '+'" class="text-[#B08A2E] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 1" x-cloak class="px-5 pb-5 text-xs text-[#596273] leading-relaxed">
                        You need to provide your exact Date of Birth, exact Time of Birth (including AM/PM), and Place of Birth (City/State). Accurate birth time is important for calculating the precise Lagna (ascendant) and house cusps.
                    </div>
                </div>

                <div class="border border-[#17202D]/15 rounded-xl overflow-hidden bg-white">
                    <button x-on:click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#17202D] flex items-center justify-between">
                        <span>What if I do not know my exact birth time?</span>
                        <span x-text="activeFaq === 2 ? '−' : '+'" class="text-[#B08A2E] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 2" x-cloak class="px-5 pb-5 text-xs text-[#596273] leading-relaxed">
                        If your birth time is approximate, planetary positions in Rashis and major Dasha cycles can still be calculated. For exact house placements, birth time rectification or Prashna (Horary) methods can be applied during the consultation.
                    </div>
                </div>

                <div class="border border-[#17202D]/15 rounded-xl overflow-hidden bg-white">
                    <button x-on:click="activeFaq = (activeFaq === 3 ? null : 3)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#17202D] flex items-center justify-between">
                        <span>How is Vedic Birth Chart Analysis different from Western astrology?</span>
                        <span x-text="activeFaq === 3 ? '−' : '+'" class="text-[#B08A2E] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 3" x-cloak class="px-5 pb-5 text-xs text-[#596273] leading-relaxed">
                        Vedic Astrology (Jyotish) utilizes the Sidereal Zodiac based on fixed star constellations and incorporates Nakshatras and Vimshottari Dasha planetary periods for precise predictive timing, whereas Western astrology uses the Tropical Zodiac.
                    </div>
                </div>
            </div>
        </div>

        <!-- 12. RELATED SERVICES -->
        <div class="space-y-6 pt-6 border-t border-[#17202D]/10">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D] text-center">Related Astrology Services</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($otherServices as $oth)
                    <a href="{{ route('services.show', $oth->slug) }}" class="block bg-white border border-[#17202D]/10 rounded-xl p-5 hover:border-[#B08A2E] transition-all group">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#B08A2E] block">{{ $oth->badge }}</span>
                        <h4 class="font-serif-luxury text-base font-bold text-[#17202D] group-hover:text-[#9A7422] transition-colors mt-1">{{ $oth->title }}</h4>
                        <p class="text-xs text-[#596273] mt-1 line-clamp-2">{{ $oth->short_description }}</p>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- 13. BOOK CONSULTATION CTA -->
        <div class="bg-[#0B1018] text-[#FDFBF7] rounded-2xl p-8 sm:p-12 text-center space-y-6 border border-[#B08A2E]/30">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4AF37] block">• SCHEDULE YOUR SESSION •</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#FDFBF7]">Ready to Explore Your Janma Kundli?</h2>
            <p class="text-xs sm:text-sm text-[#D7DCE3] max-w-xl mx-auto font-light leading-relaxed">Book a 1-on-1 private consultation with Tamal Chakraborty to understand your birth chart, Dashas, and key life directions.</p>
            <a href="{{ route('consultation.book') }}" class="inline-flex items-center space-x-2 px-8 py-4 bg-[#B08A2E] text-[#0B1018] font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#9A7422] hover:text-[#FDFBF7] transition-all shadow-lg">
                <span>BOOK BIRTH CHART CONSULTATION</span>
                <span>→</span>
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
