@extends('layouts.app')

@php
    $periodLabel = ucfirst($period);
    $seoTitle = $currentForecast?->seo_title ?? ($horoscope->zodiac_sign . " {$periodLabel} Horoscope 2026 — Vedic Guidance | Tamal Chakraborty");
    $seoDescription = $currentForecast?->seo_description ?? ("Read the official 2026 {$periodLabel} horoscope for " . $horoscope->zodiac_sign . ". Explore career, finance, love, health, and planetary transit insights.");
@endphp

@section('title', $seoTitle)
@section('meta_description', $seoDescription)

@section('content')

<!-- COMPACT HERO BANNER -->
<section class="relative bg-[#F7F0E3] text-[#29211F] py-16 sm:py-20 overflow-hidden border-b border-[#D8C6A8] flex items-center min-h-[340px]">
    <!-- Celestial Overlay -->
    <div class="absolute inset-0 opacity-15 pointer-events-none bg-[radial-gradient(#C49A45_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-[rgba(196,154,69,0.08)] rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4">
        <!-- Breadcrumb -->
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#81766D]">
            <a href="{{ route('home') }}" class="hover:text-[#C49A45] transition-colors">HOME</a>
            <span>/</span>
            <a href="{{ route('horoscope.index') }}" class="hover:text-[#C49A45] transition-colors">HOROSCOPE</a>
            <span>/</span>
            <span class="text-[#C49A45] font-semibold">{{ strtoupper($horoscope->zodiac_sign) }}</span>
        </nav>

        <!-- Eyebrow -->
        <div class="inline-flex items-center space-x-3">
            <span class="text-3xl">{{ $horoscope->symbol }}</span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">{{ $horoscope->date_range }} • {{ $horoscope->element }} ELEMENT</span>
        </div>

        <!-- Heading -->
        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F]">
            {{ $horoscope->zodiac_sign }} {{ $periodLabel }} Horoscope
        </h1>

        <!-- Supporting Info -->
        <p class="text-xs sm:text-sm text-[#81766D] max-w-2xl mx-auto font-light">
            Ruling Planet: <strong class="text-[#541F1D]">{{ $horoscope->ruling_planet }}</strong> | Lucky Color: <strong class="text-[#541F1D]">{{ $horoscope->lucky_color }}</strong> | Lucky Number: <strong class="text-[#541F1D]">{{ $horoscope->lucky_number }}</strong>
        </p>
    </div>
</section>

<!-- PERIOD SELECTION TABS & DETAILED FORECAST -->
<section class="bg-[#FDFBF7] text-[#29211F] py-16 sm:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- 4 PERIOD NAVIGATION TABS -->
        <div class="flex flex-wrap items-center justify-center gap-3 border-b border-[#D8C6A8] pb-6">
            @foreach(['daily' => 'DAILY', 'weekly' => 'WEEKLY', 'monthly' => 'MONTHLY', 'yearly' => 'YEARLY'] as $key => $label)
                <a href="{{ route('horoscope.show', ['slug' => $horoscope->slug, 'period' => $key]) }}"
                   class="px-6 py-3 rounded-lg text-xs font-bold uppercase tracking-widest transition-all {{ $period === $key ? 'bg-[#541F1D] text-[#F7F0E3] shadow-md border border-[#C49A45]' : 'bg-[#FDFBF7] text-[#29211F] border border-[#D8C6A8] hover:border-[#C49A45]' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <!-- FORECAST CONTENT CARD -->
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl p-6 sm:p-10 shadow-sm space-y-8">
            
            <!-- Forecast Header -->
            <div class="border-b border-[#D8C6A8]/60 pb-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-[#C49A45] block">{{ $periodLabel }} FORECAST — 2026</span>
                    <h2 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F] mt-0.5">
                        {{ $currentForecast?->title ?? ($horoscope->zodiac_sign . " {$periodLabel} Horoscope") }}
                    </h2>
                </div>
                @if($currentForecast?->period_start && $currentForecast?->period_end)
                    <div class="inline-flex items-center space-x-2 text-xs bg-[#EDE3D4] border border-[#D8C6A8] px-3.5 py-1.5 rounded-full text-[#541F1D] font-medium">
                        <span>{{ $currentForecast->period_start->format('M d') }}</span>
                        <span>–</span>
                        <span>{{ $currentForecast->period_end->format('M d, Y') }}</span>
                    </div>
                @endif
            </div>

            <!-- 1. OVERVIEW -->
            @if($currentForecast?->overview)
                <div class="space-y-3">
                    <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">Astrological Overview</h3>
                    <p class="text-xs sm:text-sm text-[#81766D] leading-relaxed font-normal">
                        {{ $currentForecast->overview }}
                    </p>
                </div>
            @endif

            <!-- 2. GRID OF CATEGORY FORECASTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-[#D8C6A8]/60">
                
                <!-- CAREER -->
                @if($currentForecast?->career)
                    <div class="p-5 bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                            <h4 class="font-serif-luxury text-base font-bold text-[#29211F]">Career & Profession</h4>
                        </div>
                        <p class="text-xs text-[#81766D] leading-relaxed font-normal">{{ $currentForecast->career }}</p>
                    </div>
                @endif

                <!-- FINANCE -->
                @if($currentForecast?->finance)
                    <div class="p-5 bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                            <h4 class="font-serif-luxury text-base font-bold text-[#29211F]">Finance & Wealth</h4>
                        </div>
                        <p class="text-xs text-[#81766D] leading-relaxed font-normal">{{ $currentForecast->finance }}</p>
                    </div>
                @endif

                <!-- LOVE -->
                @if($currentForecast?->love)
                    <div class="p-5 bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                            <h4 class="font-serif-luxury text-base font-bold text-[#29211F]">Love & Relationships</h4>
                        </div>
                        <p class="text-xs text-[#81766D] leading-relaxed font-normal">{{ $currentForecast->love }}</p>
                    </div>
                @endif

                <!-- HEALTH -->
                @if($currentForecast?->health)
                    <div class="p-5 bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                            <h4 class="font-serif-luxury text-base font-bold text-[#29211F]">Health & Vitality</h4>
                        </div>
                        <p class="text-xs text-[#81766D] leading-relaxed font-normal">{{ $currentForecast->health }}</p>
                    </div>
                @endif

                <!-- EDUCATION -->
                @if($currentForecast?->education)
                    <div class="p-5 bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                            <h4 class="font-serif-luxury text-base font-bold text-[#29211F]">Education & Academics</h4>
                        </div>
                        <p class="text-xs text-[#81766D] leading-relaxed font-normal">{{ $currentForecast->education }}</p>
                    </div>
                @endif

                <!-- FAMILY & TRAVEL -->
                @if($currentForecast?->family || $currentForecast?->travel)
                    <div class="p-5 bg-[#EDE3D4] border border-[#D8C6A8] rounded-xl space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-[#C49A45]"></span>
                            <h4 class="font-serif-luxury text-base font-bold text-[#29211F]">Family & Travel</h4>
                        </div>
                        <p class="text-xs text-[#81766D] leading-relaxed font-normal">{{ $currentForecast?->family }} {{ $currentForecast?->travel }}</p>
                    </div>
                @endif

            </div>

            <!-- 3. PLANETARY INFLUENCES & IMPORTANT DATES -->
            <div class="bg-[#351211] text-[#F7F0E3] rounded-xl p-6 border border-[#C49A45]/30 space-y-4">
                <h4 class="font-serif-luxury text-lg font-bold text-[#C49A45]">Planetary Influences & Important Dates</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-[#EDE3D4]">
                    @if($currentForecast?->important_dates)
                        <div>
                            <strong class="text-[#C49A45] block uppercase tracking-wider mb-1">Key Astrological Dates:</strong>
                            <p>{{ $currentForecast->important_dates }}</p>
                        </div>
                    @endif
                    @if($currentForecast?->lucky_day || $currentForecast?->lucky_colour)
                        <div>
                            <strong class="text-[#C49A45] block uppercase tracking-wider mb-1">Lucky Alignment:</strong>
                            <p>Day: {{ $currentForecast?->lucky_day ?? $horoscope->lucky_day }} | Color: {{ $currentForecast?->lucky_colour ?? $horoscope->lucky_color }} | Number: {{ $currentForecast?->lucky_number ?? $horoscope->lucky_number }}</p>
                        </div>
                    @endif
                </div>
                @if($currentForecast?->advice)
                    <div class="pt-3 border-t border-[#C49A45]/20">
                        <strong class="text-[#C49A45] block font-serif-luxury text-base">Astrological Advice:</strong>
                        <p class="text-xs text-[#EDE3D4] font-light leading-relaxed mt-0.5">{{ $currentForecast->advice }}</p>
                    </div>
                @endif
            </div>

            <!-- PERSONAL READINGS CTA -->
            <div class="pt-6 border-t border-[#D8C6A8]/60 flex flex-col sm:flex-row items-center justify-between gap-4 bg-[#EDE3D4] p-6 rounded-xl border border-[#D8C6A8]">
                <div>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">Want a More Personal Reading?</h4>
                    <p class="text-xs text-[#81766D] mt-0.5">Explore your personalized Janam Kundli chart and Dasha cycles with Tamal Chakraborty.</p>
                </div>
                <a href="{{ route('consultation.book') }}" 
                   class="px-6 py-3.5 text-xs font-bold uppercase tracking-widest text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-lg shadow transition-all flex-shrink-0 border border-[#D8C6A8]">
                    BOOK A CONSULTATION →
                </a>
            </div>

        </div>

        <!-- DISCLAIMER -->
        <div class="p-4 bg-[#F7F0E3] border border-[#D8C6A8] rounded-lg text-xs text-[#81766D] leading-relaxed text-center">
            Horoscope readings are presented from a traditional astrological perspective and are intended for general guidance and reflection. They should not be treated as certainty or as a substitute for professional medical, legal or financial advice.
        </div>

    </div>
</section>

<!-- SCHEMA.ORG JSON-LD -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "Article",
  "headline": "{{ $seoTitle }}",
  "description": "{{ $seoDescription }}",
  "author": {
    "@type": "Person",
    "name": "Tamal Chakraborty"
  },
  "publisher": {
    "@type": "Organization",
    "name": "AstroTamal",
    "url": "https://astrotamal.com"
  }
}
</script>

@endsection
