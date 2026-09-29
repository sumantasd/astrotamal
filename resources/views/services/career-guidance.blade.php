@extends('layouts.app')

@section('title', 'Career & Job Guidance Astrology — Tamal Chakraborty')
@section('meta_description', 'Astrological career guidance, job switch timing, professional growth evaluation, and 10th house Janam Kundli analysis with Tamal Chakraborty.')

@section('content')

<!-- HERO SECTION -->
<section class="relative bg-[#F7F0E3] text-[#29211F] py-16 sm:py-20 overflow-hidden border-b border-[#D8C6A8] flex items-center min-h-[380px] max-h-[460px]">
    <div class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#C49A45_1px,transparent_1px)] [background-size:24px_24px]"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4">
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#C49A45]">
            <a href="{{ route('home') }}" class="hover:text-[#541F1D] transition-colors">HOME</a>
            <span>/</span>
            <a href="{{ route('services.index') }}" class="hover:text-[#541F1D] transition-colors">SERVICES</a>
            <span>/</span>
            <span class="text-[#29211F] font-semibold">CAREER GUIDANCE</span>
        </nav>

        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">CAREER & PROFESSION</span>
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
        </div>

        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F]">
            Career & Job Guidance
        </h1>

        <p class="text-xs sm:text-sm md:text-base text-[#81766D] max-w-2xl mx-auto font-normal leading-relaxed">
            Astrological insights into professional aptitude, 10th house planetary placements, Dasha timing, and job transition periods.
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

        <div class="max-w-4xl mx-auto space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">PROFESSIONAL ALIGNMENT</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">
                Astrological Perspectives on Career Growth & Job Transitions
            </h2>
            <div class="prose prose-lg max-w-none text-[#81766D] text-sm sm:text-base leading-relaxed space-y-4 font-normal">
                <p>
                    Career decisions—whether changing jobs, seeking promotions, managing workplace friction, or choosing an academic stream—are deeply influenced by <strong>10th house (Karma Bhava)</strong>, Saturn (Karmakaraka), Mercury (intellect/commerce), Sun (authority), and active Dasha cycles.
                </p>
                <p>
                    A personalized <strong>Career & Job Guidance</strong> consultation provides objective astrological evaluation of your professional inclinations, leadership potential, favorable employment sectors, and timing windows for career moves.
                </p>
            </div>
        </div>

        <!-- PROCESS / HIGHLIGHT CARD (Primary Burgundy #541F1D Background) -->
        <div class="bg-[#541F1D] text-[#F7F0E3] rounded-2xl p-8 sm:p-12 border border-[#D8C6A8]/40 space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">CAREER EVALUATION</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#F7F0E3]">Key Career Dimensions Analyzed</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">1</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">10th House Strength</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Karma Bhava, house lord & planet placements.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">2</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Amatyakaraka Position</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Jaimini career significator analysis.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">3</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">D10 Dasamsha Chart</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Divisional chart for professional destiny.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">4</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Dasha & Transit Windows</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Timing windows for job changes & growth.</p>
                </div>
            </div>
        </div>

        <!-- BOOK CONSULTATION CTA (Primary Burgundy #541F1D Background) -->
        <div class="bg-[#541F1D] text-[#F7F0E3] rounded-2xl p-8 sm:p-12 text-center space-y-6 border border-[#D8C6A8]">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">• CAREER CONSULTATION •</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#F7F0E3]">Get Astrological Clarity On Your Career Path</h2>
            <p class="text-xs sm:text-sm text-[#F7F0E3]/90 max-w-xl mx-auto font-normal leading-relaxed">Book a 1-on-1 private career guidance consultation with Tamal Chakraborty to evaluate your 10th house, D10 chart, and timing.</p>
            <a href="{{ route('consultation.book') }}" class="inline-flex items-center space-x-2 px-8 py-4 bg-[#F7F0E3] text-[#541F1D] border border-[#D8C6A8] font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#EDE3D4] hover:text-[#351211] transition-all shadow-lg">
                <span>BOOK CAREER CONSULTATION</span>
                <span class="text-[#C49A45]">→</span>
            </a>
        </div>

    </div>
</section>

@endsection
