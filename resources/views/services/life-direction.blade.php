@extends('layouts.app')

@section('title', 'Life Direction & Personal Astrology Consultation — Tamal Chakraborty')
@section('meta_description', 'Gain clarity on major life transitions, personal uncertainty, relationships, family balance, and core life purpose through comprehensive Vedic astrology life guidance.')

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
            <span class="text-[#D4AF37] font-semibold">LIFE DIRECTION GUIDANCE</span>
        </nav>

        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#D4AF37]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#D4AF37]">DHARMA BHAVA & LIFE TRANSITIONS</span>
            <span class="h-px w-6 bg-[#D4AF37]/40"></span>
        </div>

        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#FDFBF7]">
            Life Direction Guidance
        </h1>

        <p class="text-xs sm:text-sm md:text-base text-[#D7DCE3] max-w-2xl mx-auto font-light leading-relaxed">
            Gain thoughtful, empowering perspective during major life transitions, personal crossroads, relationship changes, and family decisions through traditional Vedic astrology.
        </p>

        <div class="pt-2 flex justify-center items-center space-x-4 text-xs text-[#D4AF37] font-semibold">
            <span>Duration: {{ $service->duration ?? '45 Mins' }}</span>
            <span>•</span>
            <span>Mode: 1-on-1 Confidential Guidance Session</span>
        </div>
    </div>
</section>

<!-- MAIN CONTENT SECTION -->
<section class="bg-[#FDFBF7] text-[#17202D] py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <!-- 2. SERVICE INTRODUCTION -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E] block">HOLISTIC LIFE PERSPECTIVE</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#17202D]">
                Navigating Life Phases & Decisions With Vedic Guidance
            </h2>
            <div class="prose prose-lg max-w-none text-[#596273] text-sm sm:text-base leading-relaxed space-y-4 font-normal">
                <p>
                    Life rarely moves in a straight line. Periodically, everyone experiences phases of uncertainty, shift in personal priorities, relationship evolution, or career-life balance challenges. In Vedic Astrology (Jyotish), these life chapters are understood through the <strong>9th House (Dharma Bhava - purpose and higher guidance)</strong>, <strong>1st House (Lagna - core self and vitality)</strong>, <strong>4th House (Sukha Bhava - emotional peace and family)</strong>, and active <strong>Vimshottari Dasha cycles</strong>.
                </p>
                <p>
                    A <strong>Life Direction Guidance Consultation</strong> offers a compassionate, balanced, and non-fatalistic environment to examine your birth chart. Rather than generating anxiety or rigid predictions, this consultation helps you understand the deeper astrological themes at play, empowering you to navigate transitions with clarity, self-awareness, and personal responsibility.
                </p>
            </div>
        </div>

        <!-- 3. WHAT THIS SERVICE COVERS -->
        <div class="bg-white border border-[#17202D]/15 rounded-2xl p-8 sm:p-12 shadow-sm space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">HOLISTIC COVERAGE</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">What This Life Guidance Consultation Covers</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">01</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Navigating Major Transitions</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Understanding major Dasha phase transitions (e.g., Mahadasha shifts) that signal fundamental changes in personal focus and environment.</p>
                </div>

                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">02</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Relationships & Family Dynamics</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Evaluating 7th house (partnerships) and 4th house (domestic harmony) to foster mutual understanding and balance.</p>
                </div>

                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">03</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Personal Growth & Well-being</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Identifying planetary influences affecting mental calm, self-confidence, and long-term personal alignment.</p>
                </div>
            </div>
        </div>

        <!-- 4. WHY THIS ANALYSIS MATTERS -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E] block">EMPOWERING VALUE</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#17202D]">Why Personal Guidance Matters</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs sm:text-sm text-[#596273]">
                <div class="p-5 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <strong class="text-[#17202D] block font-semibold text-base font-serif-luxury">Constructive Self-Awareness</strong>
                    <p>Gain objective understanding of your inherent tendencies, emotional patterns, and response mechanisms during stressful time cycles.</p>
                </div>
                <div class="p-5 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <strong class="text-[#17202D] block font-semibold text-base font-serif-luxury">Balanced Life Decisions</strong>
                    <p>Reconcile professional ambitions with family responsibilities by understanding the planetary emphasis across your chart's life houses.</p>
                </div>
            </div>
        </div>

        <!-- 5. HOW THE CONSULTATION WORKS -->
        <div class="bg-[#0B1018] text-[#FDFBF7] rounded-2xl p-8 sm:p-12 border border-[#B08A2E]/30 space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4AF37]">SESSION STRUCTURE</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#FDFBF7]">How the Guidance Session Process Unfolds</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">1</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Birth Chart Overview</h4>
                    <p class="text-xs text-[#D7DCE3]">Review Lagna, Moon sign, and core house lords.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">2</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Life Phase Mapping</h4>
                    <p class="text-xs text-[#D7DCE3]">Analyze active Mahadasha and Antardasha themes.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">3</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Transit Perspective</h4>
                    <p class="text-xs text-[#D7DCE3]">Examine current Gochar shifts (Saturn/Jupiter/Rahu-Ketu).</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">4</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Personal Dialogue</h4>
                    <p class="text-xs text-[#D7DCE3]">Discuss specific questions and practical steps.</p>
                </div>
            </div>
        </div>

        <!-- 6. KEY AREAS COVERED -->
        <div class="space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">LIFE DIMENSIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">Key Life Dimensions Explored</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">1. Life Direction & Crossroads</h4>
                    <p class="text-xs text-[#596273]">Finding orientation when feeling uncertain about career choices, location moves, or long-term goals.</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">2. Relationship & Family Balance</h4>
                    <p class="text-xs text-[#596273]">Understanding house influences related to domestic harmony, partnership communication, and family responsibilities.</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">3. Emotional Peace & Resilience</h4>
                    <p class="text-xs text-[#596273]">Identifying planetary periods affecting peace of mind (4th house/Moon) and developing practical coping strategies.</p>
                </div>
            </div>
        </div>

        <!-- 7. WHO THIS SERVICE IS FOR -->
        <div class="bg-[#FAF8F5] border border-[#17202D]/15 rounded-2xl p-8 sm:p-10 space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D]">Who This Consultation Is For</h3>
            <ul class="space-y-2.5 text-xs sm:text-sm text-[#596273]">
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Individuals going through major life decisions, career transitions, or personal uncertainty.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Anyone seeking deeper understanding of their birth chart patterns, Dasha phases, and life timing.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>People wanting grounded, practical astrological guidance without fear-based or fatalistic claims.</span></li>
            </ul>
        </div>

        <!-- 8. IMPORTANT QUESTIONS -->
        <div class="space-y-6">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D] text-center">Questions Explored in This Session</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-[#17202D]">
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"Why am I experiencing significant uncertainty during this current planetary period?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"How can I better align my daily life with my birth chart's core potential?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"What astrological factors are influencing my relationship and domestic dynamics right now?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"What key life themes are emphasized in my upcoming Dasha phase?"</div>
            </div>
        </div>

        <!-- 9. METHODOLOGY -->
        <div class="max-w-4xl mx-auto space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D]">Astrological Approach & Ethical Code</h3>
            <p class="text-xs sm:text-sm text-[#596273] leading-relaxed">
                Life direction guidance in Jyotish integrates natal Lagna, Moon sign placement, house lord relationships, Dasha cycles, and major Gochar transits. AstroTamal operates strictly under an ethical, supportive framework—refraining from fear-inducing predictions, deterministic claims, or superstition. The objective is always clarity, constructive self-awareness, and peace of mind.
            </p>
        </div>

        <!-- 10. WHAT YOU CAN EXPECT -->
        <div class="bg-white border border-[#17202D]/15 rounded-xl p-6 sm:p-8 space-y-4">
            <h3 class="font-serif-luxury text-xl font-bold text-[#17202D]">What You Can Expect From the Consultation</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-[#596273]">
                <div><strong class="text-[#17202D] block">Empowering Perspective</strong> Grounded insights focusing on personal growth and self-reliance.</div>
                <div><strong class="text-[#17202D] block">Clear Life Phase Mapping</strong> Understanding current Dasha themes and planetary influences.</div>
                <div><strong class="text-[#17202D] block">100% Confidentiality</strong> Complete privacy for all personal life discussions.</div>
            </div>
        </div>

        <!-- 11. FAQ SECTION -->
        <div class="space-y-6" x-data="{ activeFaq: null }">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">FREQUENTLY ASKED QUESTIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">Life Direction Guidance FAQ</h3>
            </div>

            <div class="space-y-4 max-w-3xl mx-auto">
                <div class="border border-[#17202D]/15 rounded-xl overflow-hidden bg-white">
                    <button x-on:click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#17202D] flex items-center justify-between">
                        <span>Is this consultation suitable if I don't have a single specific question?</span>
                        <span x-text="activeFaq === 1 ? '−' : '+'" class="text-[#B08A2E] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 1" x-cloak class="px-5 pb-5 text-xs text-[#596273] leading-relaxed">
                        Yes. Many clients seek guidance when feeling general uncertainty or during major transitional phases. The consultation will review your overall chart structure, active Dasha, and key life areas.
                    </div>
                </div>

                <div class="border border-[#17202D]/15 rounded-xl overflow-hidden bg-white">
                    <button x-on:click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#17202D] flex items-center justify-between">
                        <span>Does astrology replace personal effort or professional counseling?</span>
                        <span x-text="activeFaq === 2 ? '−' : '+'" class="text-[#B08A2E] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 2" x-cloak class="px-5 pb-5 text-xs text-[#596273] leading-relaxed">
                        No. Astrology offers reflective, symbolic perspective on time cycles and natural tendencies. It is designed to complement—not replace—personal effort, thoughtful judgment, or qualified medical/legal advice.
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
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4AF37] block">• LIFE DIRECTION CONSULTATION •</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#FDFBF7]">Gain Clarity & Perspective on Your Life Journey</h2>
            <p class="text-xs sm:text-sm text-[#D7DCE3] max-w-xl mx-auto font-light leading-relaxed">Schedule a private 1-on-1 life guidance consultation with Tamal Chakraborty to explore your birth chart and active Dasha cycles.</p>
            <a href="{{ route('consultation.book') }}" class="inline-flex items-center space-x-2 px-8 py-4 bg-[#B08A2E] text-[#0B1018] font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#9A7422] hover:text-[#FDFBF7] transition-all shadow-lg">
                <span>BOOK LIFE DIRECTION CONSULTATION</span>
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
  "name": "Life Direction & Personal Astrology Guidance",
  "provider": {
    "@type": "Person",
    "name": "Tamal Chakraborty",
    "url": "https://astrotamal.com"
  },
  "areaServed": "Worldwide",
  "description": "Personal Vedic astrology consultation offering life direction guidance, transition analysis, relationship harmony, and Dasha period interpretation."
}
</script>

@endsection
