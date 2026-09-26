@extends('layouts.app')

@section('title', 'Career Astrology & Job Guidance Consultation — Tamal Chakraborty')
@section('meta_description', 'Professional career astrology reading analyzing the 10th house, Saturn, Dasha periods, career timing, job changes, promotions, and vocational direction in Vedic astrology.')

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
            <span class="text-[#D4AF37] font-semibold">CAREER & JOB GUIDANCE</span>
        </nav>

        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#D4AF37]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#D4AF37]">KARMA BHAVA & VOCATIONAL ASTROLOGY</span>
            <span class="h-px w-6 bg-[#D4AF37]/40"></span>
        </div>

        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#FDFBF7]">
            Career & Job Guidance
        </h1>

        <p class="text-xs sm:text-sm md:text-base text-[#D7DCE3] max-w-2xl mx-auto font-light leading-relaxed">
            Gain astrological perspective on professional direction, job transitions, workplace dynamics, and optimal career timing windows through Vedic astrology.
        </p>

        <div class="pt-2 flex justify-center items-center space-x-4 text-xs text-[#D4AF37] font-semibold">
            <span>Duration: {{ $service->duration ?? '45 Mins' }}</span>
            <span>•</span>
            <span>Mode: 1-on-1 Confidential Consultation</span>
        </div>
    </div>
</section>

<!-- MAIN CONTENT SECTION -->
<section class="bg-[#FDFBF7] text-[#17202D] py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <!-- 2. SERVICE INTRODUCTION -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E] block">VOCATIONAL PERSPECTIVE</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#17202D]">
                Navigating Professional Life Through Vedic Career Astrology
            </h2>
            <div class="prose prose-lg max-w-none text-[#596273] text-sm sm:text-base leading-relaxed space-y-4 font-normal">
                <p>
                    Career decisions are among the most impactful choices in adult life. In traditional Vedic astrology (Jyotish), vocational trajectory is examined primarily through the <strong>10th House (Karma Bhava)</strong>, its ruling lord, and key planetary significators like <strong>Sun (authority and public standing)</strong>, <strong>Saturn (work discipline and perseverance)</strong>, and <strong>Mercury (commerce and intellect)</strong>.
                </p>
                <p>
                    A comprehensive <strong>Career & Job Guidance Consultation</strong> provides structured insights into your natural professional strengths, favorable work environments, and key planetary time cycles (Dasha and Gochar transits). Rather than offering fatalistic predictions, career astrology serves as a strategic compass to evaluate job switch timing, promotion readiness, and long-term vocational alignment.
                </p>
            </div>
        </div>

        <!-- 3. WHAT THIS SERVICE COVERS -->
        <div class="bg-white border border-[#17202D]/15 rounded-2xl p-8 sm:p-12 shadow-sm space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">CORE DIMENSIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">What This Career Analysis Covers</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">01</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">10th House & Dashamsha (D-10)</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Detailed analysis of the 10th house of profession, 6th house of service, 2nd house of income, and divisional D-10 chart for professional clarity.</p>
                </div>

                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">02</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Job Switch & Career Timing</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Evaluation of active Vimshottari Dasha periods and Gochar transits of Saturn and Jupiter to identify optimal timing windows for career transitions.</p>
                </div>

                <div class="p-6 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#B08A2E] block">03</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Employment vs Entrepreneurship</h4>
                    <p class="text-xs text-[#596273] leading-relaxed">Comparing 6th house (employment/service) and 7th/10th houses (business/independent authority) to understand natural career orientation.</p>
                </div>
            </div>
        </div>

        <!-- 4. WHY THIS ANALYSIS MATTERS -->
        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E] block">PRACTICAL VALUE</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#17202D]">Why Career Astrology Guidance Matters</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs sm:text-sm text-[#596273]">
                <div class="p-5 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <strong class="text-[#17202D] block font-semibold text-base font-serif-luxury">Clarity During Career Transitions</strong>
                    <p>When facing crossroads, job stagnation, or organizational changes, astrological timing offers perspective on whether to hold steady or pursue new opportunities.</p>
                </div>
                <div class="p-5 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <strong class="text-[#17202D] block font-semibold text-base font-serif-luxury">Understanding Workplace Dynamics</strong>
                    <p>Discover planetary influences affecting relationships with superiors (Sun), colleagues (Mercury/Venus), and long-term job stability (Saturn).</p>
                </div>
            </div>
        </div>

        <!-- 5. HOW THE CONSULTATION WORKS -->
        <div class="bg-[#0B1018] text-[#FDFBF7] rounded-2xl p-8 sm:p-12 border border-[#B08A2E]/30 space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4AF37]">STEP-BY-STEP PROCESS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#FDFBF7]">How the Career Session Unfolds</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">1</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Natal Assessment</h4>
                    <p class="text-xs text-[#D7DCE3]">Reviewing 10th lord, Lagna, and planetary strengths.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">2</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Divisional D-10 Chart</h4>
                    <p class="text-xs text-[#D7DCE3]">Examining Dashamsha chart for professional micro-details.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">3</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Dasha & Transit Synergy</h4>
                    <p class="text-xs text-[#D7DCE3]">Analyzing current time cycles for job changes.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#B08A2E] text-[#0B1018] font-bold mx-auto flex items-center justify-center">4</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#FDFBF7]">Actionable Guidance</h4>
                    <p class="text-xs text-[#D7DCE3]">Addressing specific questions and career planning.</p>
                </div>
            </div>
        </div>

        <!-- 6. KEY AREAS COVERED -->
        <div class="space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">CAREER THEMES</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">Key Professional Areas Explored</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">1. Career Direction & Aptitude</h4>
                    <p class="text-xs text-[#596273]">Identifying industries and roles aligned with your planetary disposition (e.g., technical, executive, creative, advisory).</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">2. Job Change & Promotion Timing</h4>
                    <p class="text-xs text-[#596273]">Mapping periods of planetary emphasis for job applications, internal movements, or salary negotiations.</p>
                </div>
                <div class="p-6 bg-white border border-[#17202D]/10 rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">3. Work-Life Balance & Stress</h4>
                    <p class="text-xs text-[#596273]">Understanding challenging Saturn or Rahu transits affecting workload and workplace harmony.</p>
                </div>
            </div>
        </div>

        <!-- 7. WHO THIS SERVICE IS FOR -->
        <div class="bg-[#FAF8F5] border border-[#17202D]/15 rounded-2xl p-8 sm:p-10 space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D]">Who This Consultation Is For</h3>
            <ul class="space-y-2.5 text-xs sm:text-sm text-[#596273]">
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Working professionals considering a job switch, role change, or career pivot.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Job seekers seeking perspective on upcoming planetary timing windows for employment search.</span></li>
                <li class="flex items-start space-x-3"><span class="text-[#B08A2E] font-bold mt-0.5">✓</span><span>Mid-career individuals evaluating long-term growth, leadership potential, or entrepreneurship.</span></li>
            </ul>
        </div>

        <!-- 8. IMPORTANT QUESTIONS -->
        <div class="space-y-6">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D] text-center">Questions Explored in This Session</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-[#17202D]">
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"Is the current planetary period favorable for switching my job or company?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"What planetary indicators in my Kundli point toward long-term executive growth?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"Should I focus on corporate service (6th house) or start an independent consulting practice (7th/10th house)?"</div>
                <div class="p-4 bg-white border border-[#17202D]/10 rounded-lg">"How can I navigate current Saturn/Rahu transit phases affecting workplace stability?"</div>
            </div>
        </div>

        <!-- 9. METHODOLOGY -->
        <div class="max-w-4xl mx-auto space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#17202D]">Astrological Methodology & Ethical Standards</h3>
            <p class="text-xs sm:text-sm text-[#596273] leading-relaxed">
                Career astrology in Jyotish combines natal chart analysis (D-1), vocational divisional chart (D-10 Dashamsha), Mahadasha / Antardasha timing, and Gochar transits. In line with professional ethics, AstroTamal does NOT make absolute promises of "guaranteed 100% placement" or "instant promotions". All insights are presented as traditional astrological guidance to complement your personal effort, skills, and decision-making.
            </p>
        </div>

        <!-- 10. WHAT YOU CAN EXPECT -->
        <div class="bg-white border border-[#17202D]/15 rounded-xl p-6 sm:p-8 space-y-4">
            <h3 class="font-serif-luxury text-xl font-bold text-[#17202D]">What You Can Expect From the Consultation</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-[#596273]">
                <div><strong class="text-[#17202D] block">Objective Vocational Insights</strong> Realistic evaluation of planetary strengths and career house lords.</div>
                <div><strong class="text-[#17202D] block">Time Window Mapping</strong> Clear identification of favorable timing phases for career decisions.</div>
                <div><strong class="text-[#17202D] block">100% Confidentiality</strong> Complete privacy assured for all career and personal information.</div>
            </div>
        </div>

        <!-- 11. FAQ SECTION -->
        <div class="space-y-6" x-data="{ activeFaq: null }">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B08A2E]">FREQUENTLY ASKED QUESTIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D]">Career Astrology FAQ</h3>
            </div>

            <div class="space-y-4 max-w-3xl mx-auto">
                <div class="border border-[#17202D]/15 rounded-xl overflow-hidden bg-white">
                    <button x-on:click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#17202D] flex items-center justify-between">
                        <span>Can astrology guarantee a specific job offer or promotion?</span>
                        <span x-text="activeFaq === 1 ? '−' : '+'" class="text-[#B08A2E] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 1" x-cloak class="px-5 pb-5 text-xs text-[#596273] leading-relaxed">
                        No ethical astrologer guarantees specific real-world events. Astrology identifies favorable planetary periods and structural tendencies. Actual success depends on your qualifications, preparation, and actions taken during those opportunity windows.
                    </div>
                </div>

                <div class="border border-[#17202D]/15 rounded-xl overflow-hidden bg-white">
                    <button x-on:click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#17202D] flex items-center justify-between">
                        <span>What birth details are needed for a career astrology consultation?</span>
                        <span x-text="activeFaq === 2 ? '−' : '+'" class="text-[#B08A2E] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === 2" x-cloak class="px-5 pb-5 text-xs text-[#596273] leading-relaxed">
                        Accurate Date of Birth, Time of Birth, and Place of Birth are required to construct your Janma Kundli and D-10 Dashamsha chart accurately.
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
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#D4AF37] block">• CAREER GUIDANCE •</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#FDFBF7]">Align Your Career Path With Planetary Time Cycles</h2>
            <p class="text-xs sm:text-sm text-[#D7DCE3] max-w-xl mx-auto font-light leading-relaxed">Schedule a private 1-on-1 career astrology consultation with Tamal Chakraborty for professional clarity and timing guidance.</p>
            <a href="{{ route('consultation.book') }}" class="inline-flex items-center space-x-2 px-8 py-4 bg-[#B08A2E] text-[#0B1018] font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#9A7422] hover:text-[#FDFBF7] transition-all shadow-lg">
                <span>BOOK CAREER CONSULTATION</span>
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
  "name": "Career & Job Guidance Astrology Consultation",
  "provider": {
    "@type": "Person",
    "name": "Tamal Chakraborty",
    "url": "https://astrotamal.com"
  },
  "areaServed": "Worldwide",
  "description": "Professional Vedic career astrology consultation analyzing the 10th house Karma Bhava, Dashamsha chart, and Dasha transits for job guidance and career timing."
}
</script>

@endsection
