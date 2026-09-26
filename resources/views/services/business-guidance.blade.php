@extends('layouts.app')

@section('title', 'Vedic Business Astrology & Commercial Guidance — Tamal Chakraborty')
@section('meta_description', 'Vedic business astrology consultation covering business decision timing, starting a business, expansion, partnerships, financial cycles, and entrepreneurial tendencies.')

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
            <span class="text-[#D4AF37] font-semibold">BUSINESS GUIDANCE</span>
        </nav>

        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#D4AF37]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#D4AF37]">VYAPARA BHAVA & COMMERCIAL TIMING</span>
            <span class="h-px w-6 bg-[#D4AF37]/40"></span>
        </div>

        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#FDFBF7]">
            Business Guidance Astrology
        </h1>

        <p class="text-xs sm:text-sm md:text-base text-[#D7DCE3] max-w-2xl mx-auto font-light leading-relaxed">
            Gain commercial clarity on business expansion, launch timing, partnership dynamics, financial time cycles, and risk evaluation through traditional Vedic astrology.
        </p>

        <div class="pt-2 flex justify-center items-center space-x-4 text-xs text-[#D4AF37] font-semibold">
            <span>Duration: {{ $service->duration ?? '45 Mins' }}</span>
            <span>•</span>
            <span>Mode: 1-on-1 Confidential Business Consultation</span>
        </div>
    </div>
</section>

<!-- MAIN CONTENT SECTION -->
<section class="bg-[#FDFBF7] text-[#17202D] py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <!-- 2. SERVICE INTRODUCTION -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E] block">COMMERCIAL PERSPECTIVE</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#17202D]">
                Evaluating Commercial Cycles Through Vedic Business Astrology
            </h2>
            <div class="prose prose-lg max-w-none text-[#596273] text-sm sm:text-base leading-relaxed space-y-4 font-normal">
                <p>
                    Building and expanding a commercial enterprise requires strategic foresight, capital management, and acute timing. In Vedic Astrology (Jyotish), business potential is mapped through the <strong>7th House (Partnerships & Public Trade)</strong>, <strong>10th House (Executive Authority)</strong>, <strong>2nd House (Accumulated Wealth)</strong>, and <strong>11th House (Commercial Gains & Revenue)</strong>.
                </p>
                <p>
                    A <strong>Business Guidance Consultation</strong> evaluates your natal chart (Janma Kundli) alongside active planetary Dasha periods and Gochar transits of <strong>Jupiter (Guru - wisdom and growth)</strong>, <strong>Mercury (Budha - trade and intellect)</strong>, and <strong>Saturn (Shani - structural governance)</strong>. This analysis helps entrepreneurs and business leaders identify growth windows, structure partnership agreements prudently, and navigate temporary financial contractions with resilience.
                </p>
            </div>
        </div>

        <!-- 3. WHAT THIS SERVICE COVERS -->
        <div class="bg-white border border-[#17202D]/15 rounded-2xl p-8 sm:p-12 shadow-sm space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">BUSINESS DOMAINS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">What This Business Consultation Covers</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">01</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">New Venture Launch Timing</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Identifying favorable astrological time windows and Muhurta principles for launching new products, services, or company registration.</p>
                </div>

                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">02</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Partnership & Trade Synergy</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Analyzing 7th house placements and planetary compatibility with business partners to ensure long-term trust and strategic alignment.</p>
                </div>

                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">03</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Expansion vs Capital Caution</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Evaluating upcoming planetary transits over financial houses to discern periods suitable for aggressive expansion versus debt consolidation.</p>
                </div>
            </div>
        </div>

        <!-- 4. WHY THIS ANALYSIS MATTERS -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E] block">STRATEGIC ADVANTAGE</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#17202D]">Why Business Timing Matters</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs sm:text-sm text-[#596273]">
                <div class="p-5 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <strong class="text-[#17202D] block font-semibold text-base font-serif-luxury">Risk Mitigation During Adverse Cycles</strong>
                    <p>Recognize planetary transit phases (such as Saturn or Rahu transits over wealth houses) early to avoid over-leveraging capital or signing rushed contracts.</p>
                </div>
                <div class="p-5 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <strong class="text-[#17202D] block font-semibold text-base font-serif-luxury">Capitalizing on Growth Windows</strong>
                    <p>Align marketing campaigns, brand launches, and equity fundraising with supportive Dasha and Jupiter transit periods for maximum planetary harmony.</p>
                </div>
            </div>
        </div>

        <!-- 5. HOW THE CONSULTATION WORKS -->
        <div class="bg-[#0B1018] text-[#FDFBF7] rounded-2xl p-8 sm:p-12 border border-[#B08A2E]/30 space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4AF37]">CONSULTATION STAGES</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#FDFBF7]">How the Business Guidance Session Works</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">1</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Entrepreneurial Kundli</h4>
                    <p class="text-xs text-[#D7DCE3]">Analyze 3rd house (initiative) & 10th house strength.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">2</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Financial Yogas</h4>
                    <p class="text-xs text-[#D7DCE3]">Evaluate Dhana Yogas & 2nd/11th lord alignments.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">3</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Timing & Transits</h4>
                    <p class="text-xs text-[#D7DCE3]">Overlay Gochar transits with commercial deadlines.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">4</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Strategic Insights</h4>
                    <p class="text-xs text-[#D7DCE3]">Deliver pragmatic advice for upcoming milestones.</p>
                </div>
            </div>
        </div>

        <!-- 6. KEY AREAS COVERED -->
        <div class="space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">BUSINESS SCENARIOS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">Key Business Scenarios Evaluated</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">1. Launching & Commercial Timing</h4>
                    <p class="text-xs text-[#596273]">Selecting favorable time windows for starting a business, registering trademarks, or opening physical premises.</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">2. Business Expansion & Scaling</h4>
                    <p class="text-xs text-[#596273]">Determining whether current planetary cycles support rapid geographical expansion or product diversification.</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">3. Co-founder & Partnership Dynamics</h4>
                    <p class="text-xs text-[#596273]">Examining 7th house interactions to foster long-term equity harmony and avoid partnership disputes.</p>
                </div>
            </div>
        </div>

        <!-- 7. WHO THIS SERVICE IS FOR -->
        <div class="bg-[#FAF8F5] border border-[#17202D]/15 rounded-2xl p-8 sm:p-10 space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D]">Who This Consultation Is For</h3>
            <ul class="space-y-2.5 text-xs sm:text-sm text-[#596273]">
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Founders, entrepreneurs, and business owners planning new ventures or expansion.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Partners considering joint business agreements, equity sharing, or commercial investments.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Business leaders experiencing commercial slowdowns and seeking planetary cycle timing clarity.</span></li>
            </ul>
        </div>

        <!-- 8. IMPORTANT QUESTIONS -->
        <div class="space-y-6">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D] text-center">Questions Explored in This Session</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-[#17202D]">
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"Is my birth chart structurally suited for entrepreneurship or corporate leadership?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"What are the most favorable months of 2026 for expanding our commercial operations?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"How do upcoming planetary transits affect capital liquidity and 11th house revenue gains?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"What planetary precautions should be taken before entering into a major partnership agreement?"</div>
            </div>
        </div>

        <!-- 9. METHODOLOGY -->
        <div class="max-w-4xl mx-auto space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D]">Astrological Methodology & Realistic Framework</h3>
            <p class="text-xs sm:text-sm text-[#596273] leading-relaxed">
                Business astrology analyzes planetary positions, Ashtakavarga scores, Dasha cycles, and Gochar transits. In full compliance with ethical standards, AstroTamal does NOT promise "guaranteed profits", "overnight wealth", or "risk-free commercial success". Astrological guidance is designed to assist your strategic decision-making, sound financial planning, and operational execution.
            </p>
        </div>

        <!-- 10. WHAT YOU CAN EXPECT -->
        <div class="bg-white border border-[#17202D]/15 rounded-xl p-6 sm:p-8 space-y-4">
            <h3 class="font-serif-luxury text-xl font-bold text-[#17202D]">What You Can Expect From the Session</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-[#596273]">
                <div><strong class="text-[#17202D] block">Pragmatic Analysis</strong> Grounded astrological perspective tailored to business reality.</div>
                <div><strong class="text-[#17202D] block">Strategic Timing Windows</strong> Identification of expansion and caution phases.</div>
                <div><strong class="text-[#17202D] block">100% Confidentiality</strong> Strict non-disclosure of all proprietary business details.</div>
            </div>
        </div>

        <!-- 11. FAQ SECTION -->
        <div class="space-y-6" x-data="{ activeFaq: null }">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">FREQUENTLY ASKED QUESTIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">Business Astrology FAQ</h3>
            </div>

            <div class="space-y-4 max-w-3xl mx-auto">
                <div class="border border-[#17202D]/15 rounded-xl overflow-hidden bg-white">
                    <button x-on:click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#17202D] flex items-center justify-between">
                        <span>Does business astrology guarantee financial returns or profits?</span>
                        <span x-text="activeFaq === 1 ? '−' : '+'" class="text-[#B08A2E] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 1" x-cloak class="px-5 pb-5 text-xs text-[#596273] leading-relaxed">
                        No. Business astrology provides timing perspective, risk assessment, and structural insights based on traditional Jyotish principles. Revenue and profits depend on market conditions, product quality, sound management, and commercial execution.
                    </div>
                </div>

                <div class="border border-[#17202D]/15 rounded-xl overflow-hidden bg-white">
                    <button x-on:click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#17202D] flex items-center justify-between">
                        <span>Should I provide both personal Kundli and business registration dates?</span>
                        <span x-text="activeFaq === 2 ? '−' : '+'" class="text-[#B08A2E] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 2" x-cloak class="px-5 pb-5 text-xs text-[#596273] leading-relaxed">
                        Yes. If your business is already registered, sharing the incorporation date and time alongside the primary founder's birth chart allows for a comprehensive dual evaluation.
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
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4AF37] block">• BUSINESS CONSULTATION •</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#FDFBF7]">Structure Your Commercial Decisions With Astrological Timing</h2>
            <p class="text-xs sm:text-sm text-[#D7DCE3] max-w-xl mx-auto font-light leading-relaxed">Book a confidential 1-on-1 business guidance session with Tamal Chakraborty to evaluate your expansion plans and commercial time cycles.</p>
            <a href="{{ route('consultation.book') }}" class="inline-flex items-center space-x-2 px-8 py-4 bg-[#B08A2E] text-[#0B1018] font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#9A7422] hover:text-[#FDFBF7] transition-all shadow-lg">
                <span>BOOK BUSINESS CONSULTATION</span>
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
  "name": "Vedic Business Astrology Consultation",
  "provider": {
    "@type": "Person",
    "name": "Tamal Chakraborty",
    "url": "https://astrotamal.com"
  },
  "areaServed": "Worldwide",
  "description": "Comprehensive Vedic business astrology consultation examining 7th house trade partnerships, 10th house authority, 2nd & 11th house financial cycles, and launch timing."
}
</script>

@endsection
