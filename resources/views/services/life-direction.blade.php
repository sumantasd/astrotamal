@extends('layouts.app')

@section('title', 'Life Direction & Purpose Astrology — Tamal Chakraborty')
@section('meta_description', 'Gain clarity on life direction, karmic purpose, personal growth phases, and planetary period transitions with Tamal Chakraborty.')

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
            <span class="text-[#29211F] font-semibold">LIFE DIRECTION</span>
        </nav>

        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">KARMIC PURPOSE & CLARITY</span>
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
        </div>

        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F]">
            Life Direction Guidance
        </h1>

        <p class="text-xs sm:text-sm md:text-base text-[#81766D] max-w-2xl mx-auto font-normal leading-relaxed">
            Astrological insights into core life phases, karmic inclinations, 9th & 12th house themes, and personal transformation.
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
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">HOLISTIC PERSPECTIVE</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">
                Navigating Life Transitions With Astrological Wisdom
            </h2>
            <div class="prose prose-lg max-w-none text-[#81766D] text-sm sm:text-base leading-relaxed space-y-4 font-normal">
                <p>
                    Every individual experiences times of reflection, shift in personal priorities, or uncertainty regarding life direction. In Vedic Astrology, <strong>Dharma houses (1st, 5th, 9th)</strong> and <strong>Moksha houses (4th, 8th, 12th)</strong> reveal underlying spiritual inclinations, personal growth arcs, and changing internal motivations.
                </p>
                <p>
                    A <strong>Life Direction Guidance</strong> session evaluates your Kundli to help clarify core strengths, navigate major Dasha transitions, understand personal calling, and cultivate peace during transformative phases.
                </p>
            </div>
        </div>

        <!-- PROCESS / HIGHLIGHT CARD (Primary Burgundy #541F1D Background) -->
        <div class="bg-[#541F1D] text-[#F7F0E3] rounded-2xl p-8 sm:p-12 border border-[#D8C6A8]/40 space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">LIFE PURPOSE DIMENSIONS</span>
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#F7F0E3]">How Life Direction Is Analyzed</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center">
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">1</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Atmakaraka Analysis</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Soul significator planet evaluation.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">2</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Dharma Trikona Strength</h4>
                    <p class="text-xs text-[#F7F0E3]/90">1st, 5th & 9th house harmony.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">3</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Rahu-Ketu Axis</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Karmic lessons & future growth focus.</p>
                </div>
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">4</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">Dasha Transitions</h4>
                    <p class="text-xs text-[#F7F0E3]/90">Understanding major inner shift periods.</p>
                </div>
            </div>
        </div>

        <!-- BOOK CONSULTATION CTA (Primary Burgundy #541F1D Background) -->
        <div class="bg-[#541F1D] text-[#F7F0E3] rounded-2xl p-8 sm:p-12 text-center space-y-6 border border-[#D8C6A8]">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">• LIFE DIRECTION CONSULTATION •</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#F7F0E3]">Find Perspective & Clarity On Your Journey</h2>
            <p class="text-xs sm:text-sm text-[#F7F0E3]/90 max-w-xl mx-auto font-normal leading-relaxed">Book a 1-on-1 private life direction consultation with Tamal Chakraborty to gain insights into your chart and timing.</p>
            <a href="{{ route('consultation.book') }}" class="inline-flex items-center space-x-2 px-8 py-4 bg-[#F7F0E3] text-[#541F1D] border border-[#D8C6A8] font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#EDE3D4] hover:text-[#351211] transition-all shadow-lg">
                <span>BOOK LIFE DIRECTION CONSULTATION</span>
                <span class="text-[#C49A45]">→</span>
            </a>
        </div>

    </div>
</section>

@endsection
