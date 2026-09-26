@extends('layouts.app')

@section('title', 'Learn Vedic Astrology (Jyotish Basics & Kundli Reading) — Tamal Chakraborty')
@section('meta_description', 'Discover foundational Vedic astrology concepts, including Rashis, Bhavas (Houses), Grahas (Planets), Nakshatras, Gochar transits, and practical birth chart reading approaches.')

@section('content')

<!-- 1. PREMIUM HERO SECTION -->
<section class="relative bg-[#0B1018] text-[#FDFBF7] py-16 sm:py-20 overflow-hidden border-b border-[rgba(212,175,55,0.25)] flex items-center min-h-[380px] max-h-[460px]">
    <div class="absolute inset-0 opacity-15 pointer-events-none bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[rgba(212,175,55,0.05)] rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4">
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#9A7422]">
            <a href="{{ route('home') }}" class="hover:text-[#D4AF37] transition-colors">HOME</a>
            <span>/</span>
            <a href="{{ route('services.index') }}" class="hover:text-[#D4AF37] transition-colors">SERVICES</a>
            <span>/</span>
            <span class="text-[#D4AF37] font-semibold">LEARN ASTROLOGY</span>
        </nav>

        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#D4AF37]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#D4AF37]">JYOTISH VIDYA & FOUNDATIONAL STUDY</span>
            <span class="h-px w-6 bg-[#D4AF37]/40"></span>
        </div>

        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#FDFBF7]">
            Learn Vedic Astrology
        </h1>

        <p class="text-xs sm:text-sm md:text-base text-[#D7DCE3] max-w-2xl mx-auto font-light leading-relaxed">
            Understand the core principles of Jyotish Shastra: Rashis, Grahas, Bhavas, Nakshatras, and the art of structured birth chart (Janma Kundli) interpretation.
        </p>

        <div class="pt-2 flex justify-center items-center space-x-4 text-xs text-[#D4AF37] font-semibold">
            <span>Focus: Foundational & Practical Jyotish Study</span>
            <span>•</span>
            <span>1-on-1 Guidance Available</span>
        </div>
    </div>
</section>

<!-- MAIN CONTENT SECTION -->
<section class="bg-[#FDFBF7] text-[#17202D] py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <!-- 2. SERVICE INTRODUCTION -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E] block">THE LIGHT OF JYOTISH</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#17202D]">
                Foundational Principles of Vedic Astrology (Jyotish Shastra)
            </h2>
            <div class="prose prose-lg max-w-none text-[#596273] text-sm sm:text-base leading-relaxed space-y-4 font-normal">
                <p>
                    Vedic Astrology, traditionally known as <strong>Jyotish</strong> ("the light of knowledge"), is a vast astronomical and symbolic discipline refined over centuries in India. Learning astrology is not about memorizing sensational predictions; it is about studying the mathematical and psychological principles that connect astronomical movements with human experience.
                </p>
                <p>
                    Whether you are an absolute beginner seeking to understand your own Kundli or an enthusiast desiring a structured learning approach, mastering the core pillars—<strong>9 Grahas (Planets), 12 Rashis (Zodiac Signs), 12 Bhavas (Houses), and 27 Nakshatras (Lunar Mansions)</strong>—provides the bedrock for genuine chart synthesis.
                </p>
            </div>
        </div>

        <!-- 3. WHAT THIS SERVICE COVERS -->
        <div class="bg-white border border-[#17202D]/15 rounded-2xl p-8 sm:p-12 shadow-sm space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">CURRICULUM PILLARS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">Core Topics in Foundational Astrology Study</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">01</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Grahas, Rashis & Bhavas</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Understanding planetary significations (Karakas), the 12 zodiac signs, and the functional significations of the 12 astrological houses.</p>
                </div>

                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">02</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">27 Nakshatras & Lunar Mansions</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Exploring the foundational 27 Nakshatras that provide micro-level nuance to planetary placements and Moon sign calculations.</p>
                </div>

                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">03</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Dashas & Transit Reading</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Introduction to Vimshottari Dasha planetary periods and basic planetary transits (Gochar) for time-based observation.</p>
                </div>
            </div>
        </div>

        <!-- 4. WHY THIS ANALYSIS MATTERS -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E] block">EDUCATIONAL VALUE</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#17202D]">Why Learn Authentic Vedic Astrology?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs sm:text-sm text-[#596273]">
                <div class="p-5 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <strong class="text-[#17202D] block font-semibold text-base font-serif-luxury">Discernment Over Superstition</strong>
                    <p>Learning authentic Jyotish principles helps you see past pop-astrology cliches and understand the real astronomical logic behind birth chart readings.</p>
                </div>
                <div class="p-5 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <strong class="text-[#17202D] block font-semibold text-base font-serif-luxury">Personal Self-Knowledge</strong>
                    <p>Studying your own chart mechanics builds deep self-awareness regarding your psychological motivations, strengths, and life cycles.</p>
                </div>
            </div>
        </div>

        <!-- 5. HOW THE CONSULTATION WORKS -->
        <div class="bg-[#0B1018] text-[#FDFBF7] rounded-2xl p-8 sm:p-12 border border-[#B08A2E]/30 space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4AF37]">LEARNING PATHWAY</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#FDFBF7]">Progressive Learning Approach</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">1</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Foundations</h4>
                    <p class="text-xs text-[#D7DCE3]">Master 12 Rashis, 9 Grahas & 12 Bhavas.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">2</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Chart Mechanics</h4>
                    <p class="text-xs text-[#D7DCE3]">Learn house lordships, aspects & strength.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">3</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Time Cycles</h4>
                    <p class="text-xs text-[#D7DCE3]">Understand Dasha & Gochar transit concepts.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">4</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Practical Application</h4>
                    <p class="text-xs text-[#D7DCE3]">Practice structured chart analysis techniques.</p>
                </div>
            </div>
        </div>

        <!-- 6. KEY AREAS COVERED -->
        <div class="space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">FOUNDATIONAL MODULES</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">Core Astrological Subjects</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">1. Janma Kundli Construction</h4>
                    <p class="text-xs text-[#596273]">Learning how Ascendant (Lagna) is calculated and how house placements are mapped in North & South Indian chart styles.</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">2. Planetary Aspects & Yogas</h4>
                    <p class="text-xs text-[#596273]">Studying planetary aspects (Drishti), combustion, exaltation/debilitation, and common planetary combinations (Yogas).</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">3. Reading Transits (Gochar)</h4>
                    <p class="text-xs text-[#596273]">Understanding how slow-moving planets (Saturn, Jupiter, Rahu, Ketu) interact with natal positions over time.</p>
                </div>
            </div>
        </div>

        <!-- 7. WHO THIS SERVICE IS FOR -->
        <div class="bg-[#FAF8F5] border border-[#17202D]/15 rounded-2xl p-8 sm:p-10 space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D]">Who Can Learn Vedic Astrology?</h3>
            <ul class="space-y-2.5 text-xs sm:text-sm text-[#596273]">
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Beginners interested in understanding traditional Indian astrology (Jyotish) systematically.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Self-taught astrology enthusiasts looking to organize their knowledge and clear foundational doubts.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Anyone seeking 1-on-1 educational guidance and study recommendation from Tamal Chakraborty.</span></li>
            </ul>
        </div>

        <!-- 8. IMPORTANT QUESTIONS -->
        <div class="space-y-6">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D] text-center">Core Concepts Explored</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-[#17202D]">
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"What is the structural difference between Moon sign (Chandra Rashi) and Ascendant (Lagna)?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"How do Nakshatras modify the raw characteristics of a zodiac sign?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"What is the mathematical logic behind Vimshottari Dasha calculations?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"How do functional benefics and malefics vary for different Ascendants?"</div>
            </div>
        </div>

        <!-- 9. METHODOLOGY -->
        <div class="max-w-4xl mx-auto space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D]">Educational Methodology</h3>
            <p class="text-xs sm:text-sm text-[#596273] leading-relaxed">
                Our approach to teaching astrology is grounded in classical texts (Parashari Jyotish) combined with practical, observational case studies. We emphasize ethical learning, critical thinking, and respectful study of ancient cosmological wisdom without sensationalism.
            </p>
        </div>

        <!-- 10. WHAT YOU CAN EXPECT -->
        <div class="bg-white border border-[#17202D]/15 rounded-xl p-6 sm:p-8 space-y-4">
            <h3 class="font-serif-luxury text-xl font-bold text-[#17202D]">What You Can Expect</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-[#596273]">
                <div><strong class="text-[#17202D] block">Structured Mentoring</strong> Clear, step-by-step explanation of complex astrological principles.</div>
                <div><strong class="text-[#17202D] block">Practical Case Charts</strong> Real-world chart examples to illustrate rules and exceptions.</div>
                <div><strong class="text-[#17202D] block">Interactive Discussion</strong> Opportunity to clarify study doubts directly with Tamal Chakraborty.</div>
            </div>
        </div>

        <!-- 11. FAQ SECTION -->
        <div class="space-y-6" x-data="{ activeFaq: null }">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">FREQUENTLY ASKED QUESTIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">Learn Astrology FAQ</h3>
            </div>

            <div class="space-y-4 max-w-3xl mx-auto">
                <div class="border border-[#17202D]/15 rounded-xl overflow-hidden bg-white">
                    <button x-on:click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#17202D] flex items-center justify-between">
                        <span>Do I need prior knowledge of Sanskrit or astronomy to start learning?</span>
                        <span x-text="activeFaq === 1 ? '−' : '+'" class="text-[#B08A2E] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 1" x-cloak class="px-5 pb-5 text-xs text-[#596273] leading-relaxed">
                        No prior knowledge of Sanskrit is required. Basic astronomical concepts (such as planetary orbits and zodiac constellations) will be explained clearly during study.
                    </div>
                </div>

                <div class="border border-[#17202D]/15 rounded-xl overflow-hidden bg-white">
                    <button x-on:click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#17202D] flex items-center justify-between">
                        <span>Is 1-on-1 guidance available for learning astrology?</span>
                        <span x-text="activeFaq === 2 ? '−' : '+'" class="text-[#B08A2E] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 2" x-cloak class="px-5 pb-5 text-xs text-[#596273] leading-relaxed">
                        Yes. You can schedule educational consultation sessions with Tamal Chakraborty to discuss foundational concepts, chart reading methodology, and study resources.
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
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4AF37] block">• EDUCATIONAL SESSIONS •</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#FDFBF7]">Start Your Journey into Authentic Vedic Astrology</h2>
            <p class="text-xs sm:text-sm text-[#D7DCE3] max-w-xl mx-auto font-light leading-relaxed">Connect with Tamal Chakraborty for 1-on-1 educational guidance and structured mentoring in Jyotish principles.</p>
            <a href="{{ route('consultation.book') }}" class="inline-flex items-center space-x-2 px-8 py-4 bg-[#B08A2E] text-[#0B1018] font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#9A7422] hover:text-[#FDFBF7] transition-all shadow-lg">
                <span>INQUIRE ABOUT LEARNING ASTROLOGY</span>
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
  "name": "Learn Vedic Astrology Guidance",
  "provider": {
    "@type": "Person",
    "name": "Tamal Chakraborty",
    "url": "https://astrotamal.com"
  },
  "areaServed": "Worldwide",
  "description": "Foundational Vedic astrology learning guidance covering Rashis, Grahas, Bhavas, Nakshatras, and structured birth chart interpretation techniques."
}
</script>

@endsection
