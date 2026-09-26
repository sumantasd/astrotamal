@extends('layouts.app')

@section('title', ($title ?? 'Astrology Feature') . ' — Tamal Chakraborty')

@section('content')
<section class="bg-[#0B1018] text-white py-24 lg:py-32 relative overflow-hidden border-b border-[#B08A2E]/20 min-h-[500px] flex items-center">
    <!-- Subtle Zodiac Orbital Lines Background -->
    <div class="absolute inset-0 pointer-events-none opacity-15">
        <svg class="w-full h-full text-[#D4AF37]" viewBox="0 0 1200 500" fill="none">
            <circle cx="600" cy="250" r="380" stroke="currentColor" stroke-width="0.75" stroke-dasharray="4 6"/>
            <circle cx="600" cy="250" r="280" stroke="currentColor" stroke-width="0.5"/>
            <path d="M 100,250 L 1100,250" stroke="currentColor" stroke-width="0.5" opacity="0.4"/>
            <path d="M 600,0 L 600,500" stroke="currentColor" stroke-width="0.5" opacity="0.4"/>
        </svg>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center relative z-10 space-y-6">
        <div class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full bg-[#070A10]/90 border border-[#B08A2E]/40 text-[#D4AF37] text-xs font-bold uppercase tracking-[0.25em]">
            <span>ASTROTAMAL GUIDANCE</span>
        </div>

        <h1 class="font-serif-luxury text-4xl sm:text-5xl lg:text-6xl font-bold text-[#FDFBF7]">
            {{ $title ?? 'Feature Coming Soon' }}
        </h1>

        <p class="text-slate-300 text-base sm:text-lg font-light max-w-2xl mx-auto leading-relaxed">
            {{ $subtitle ?? 'This feature is currently being updated with authentic astrological calculation tools and curated guidance.' }}
        </p>

        <div class="pt-6 flex flex-wrap justify-center gap-4">
            <a href="{{ route('consultation.book') }}" 
               class="inline-flex items-center px-8 py-3.5 rounded-lg text-xs font-bold uppercase tracking-widest text-slate-950 bg-gradient-to-r from-[#D4AF37] to-[#B08A2E] hover:brightness-110 shadow-xl transition-all">
                <span>BOOK A CONSULTATION</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>

            <a href="{{ route('home') }}" 
               class="inline-flex items-center px-8 py-3.5 rounded-lg text-xs font-bold uppercase tracking-widest text-[#D4AF37] border border-[#B08A2E]/60 hover:bg-[#B08A2E]/10 transition-colors">
                <span>RETURN HOME</span>
            </a>
        </div>
    </div>
</section>
@endsection
