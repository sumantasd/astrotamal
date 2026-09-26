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
<section class="relative bg-[#0B1018] text-[#FDFBF7] py-16 sm:py-20 overflow-hidden border-b border-[rgba(212,175,55,0.25)] flex items-center min-h-[360px] max-h-[440px]">
    <!-- Celestial Overlay -->
    <div class="absolute inset-0 opacity-15 pointer-events-none bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-[rgba(212,175,55,0.05)] rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4">
        <!-- Breadcrumb -->
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#9A7422]">
            <a href="{{ route('home') }}" class="hover:text-[#D4AF37] transition-colors">HOME</a>
            <span>/</span>
            <a href="{{ route('horoscope.index') }}" class="hover:text-[#D4AF37] transition-colors">HOROSCOPE</a>
            <span>/</span>
            <span class="text-[#D4AF37] font-semibold">{{ strtoupper($horoscope->zodiac_sign) }}</span>
        </nav>

        <!-- Eyebrow -->
        <div class="inline-flex items-center space-x-3">
            <span class="text-3xl">{{ $horoscope->symbol }}</span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#D4AF37]">{{ $horoscope->date_range }} • {{ $horoscope->element }} ELEMENT</span>
        </div>

        <!-- Heading -->
        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#FDFBF7]">
            {{ $horoscope->zodiac_sign }} {{ $periodLabel }} Horoscope
        </h1>

        <!-- Supporting Info -->
        <p class="text-xs sm:text-sm text-[#D7DCE3] max-w-2xl mx-auto font-light">
            Ruling Planet: <strong class="text-[#D4AF37]">{{ $horoscope->ruling_planet }}</strong> | Lucky Color: <strong class="text-[#D4AF37]">{{ $horoscope->lucky_color }}</strong> | Lucky Number: <strong class="text-[#D4AF37]">{{ $horoscope->lucky_number }}</strong>
        </p>
    </div>
</section>

<!-- PERIOD SELECTION TABS & DETAILED FORECAST -->
<section class="bg-[#FDFBF7] text-[#17202D] py-16 sm:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- 4 PERIOD NAVIGATION TABS -->
        <div class="flex flex-wrap items-center justify-center gap-3 border-b border-[#17202D]/15 pb-6">
            @foreach(['daily' => 'DAILY', 'weekly' => 'WEEKLY', 'monthly' => 'MONTHLY', 'yearly' => 'YEARLY'] as $key => $label)
                <a href="{{ route('horoscope.show', ['slug' => $horoscope->slug, 'period' => $key]) }}"
                   class="px-6 py-3 rounded-lg text-xs font-bold uppercase tracking-widest transition-all {{ $period === $key ? 'bg-[#0B1018] text-[#FDFBF7] shadow-md border border-[#B08A2E]' : 'bg-white text-[#17202D] border border-[#17202D]/15 hover:border-[#B08A2E]' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <!-- FORECAST CONTENT CARD -->
        <div class="bg-white border border-[#17202D]/15 rounded-2xl p-6 sm:p-10 shadow-sm space-y-8">
            
            <!-- Forecast Header -->
            <div class="border-b border-[#17202D]/10 pb-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-[#B08A2E] block">{{ $periodLabel }} FORECAST — 2026</span>
                    <h2 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#17202D] mt-0.5">
                        {{ $currentForecast?->title ?? ($horoscope->zodiac_sign . " {$periodLabel} Horoscope") }}
                    </h2>
                </div>
                @if($currentForecast?->period_start && $currentForecast?->period_end)
                    <div class="inline-flex items-center space-x-2 text-xs bg-[#FAF8F5] border border-[#17202D]/15 px-3.5 py-1.5 rounded-full text-[#596273] font-medium">
                        <span>{{ $currentForecast->period_start->format('M d') }}</span>
                        <span>–</span>
                        <span>{{ $currentForecast->period_end->format('M d, Y') }}</span>
                    </div>
                @endif
            </div>

            <!-- 1. OVERVIEW -->
            @if($currentForecast?->overview)
                <div class="space-y-3">
                    <h3 class="font-serif-luxury text-xl font-bold text-[#17202D]">Astrological Overview</h3>
                    <p class="text-xs sm:text-sm text-[#596273] leading-relaxed font-normal">
                        {{ $currentForecast->overview }}
                    </p>
                </div>
            @endif

            <!-- 2. GRID OF CATEGORY FORECASTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-[#17202D]/10">
                
                <!-- CAREER -->
                @if($currentForecast?->career)
                    <div class="p-5 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-[#B08A2E]"></span>
                            <h4 class="font-serif-luxury text-base font-bold text-[#17202D]">Career & Profession</h4>
                        </div>
                        <p class="text-xs text-[#596273] leading-relaxed font-normal">{{ $currentForecast->career }}</p>
                    </div>
                @endif

                <!-- FINANCE -->
                @if($currentForecast?->finance)
                    <div class="p-5 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-[#B08A2E]"></span>
                            <h4 class="font-serif-luxury text-base font-bold text-[#17202D]">Finance & Wealth</h4>
                        </div>
                        <p class="text-xs text-[#596273] leading-relaxed font-normal">{{ $currentForecast->finance }}</p>
                    </div>
                @endif

                <!-- LOVE -->
                @if($currentForecast?->love)
                    <div class="p-5 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-[#B08A2E]"></span>
                            <h4 class="font-serif-luxury text-base font-bold text-[#17202D]">Love & Relationships</h4>
                        </div>
                        <p class="text-xs text-[#596273] leading-relaxed font-normal">{{ $currentForecast->love }}</p>
                    </div>
                @endif

                <!-- HEALTH -->
                @if($currentForecast?->health)
                    <div class="p-5 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-[#B08A2E]"></span>
                            <h4 class="font-serif-luxury text-base font-bold text-[#17202D]">Health & Vitality</h4>
                        </div>
                        <p class="text-xs text-[#596273] leading-relaxed font-normal">{{ $currentForecast->health }}</p>
                    </div>
                @endif

                <!-- EDUCATION -->
                @if($currentForecast?->education)
                    <div class="p-5 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-[#B08A2E]"></span>
                            <h4 class="font-serif-luxury text-base font-bold text-[#17202D]">Education & Academics</h4>
                        </div>
                        <p class="text-xs text-[#596273] leading-relaxed font-normal">{{ $currentForecast->education }}</p>
                    </div>
                @endif

                <!-- FAMILY & TRAVEL -->
                @if($currentForecast?->family || $currentForecast?->travel)
                    <div class="p-5 bg-[#FAF8F5] border border-[#17202D]/10 rounded-xl space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-[#B08A2E]"></span>
                            <h4 class="font-serif-luxury text-base font-bold text-[#17202D]">Family & Travel</h4>
                        </div>
                        <p class="text-xs text-[#596273] leading-relaxed font-normal">{{ $currentForecast?->family }} {{ $currentForecast?->travel }}</p>
                    </div>
                @endif

            </div>

            <!-- 3. PLANETARY INFLUENCES & IMPORTANT DATES -->
            <div class="bg-[#0B1018] text-[#FDFBF7] rounded-xl p-6 border border-[#B08A2E]/30 space-y-4">
                <h4 class="font-serif-luxury text-lg font-bold text-[#D4AF37]">Planetary Influences & Important Dates</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-[#D7DCE3]">
                    @if($currentForecast?->important_dates)
                        <div>
                            <strong class="text-[#B08A2E] block uppercase tracking-wider mb-1">Key Astrological Dates:</strong>
                            <p>{{ $currentForecast->important_dates }}</p>
                        </div>
                    @endif
                    @if($currentForecast?->lucky_day || $currentForecast?->lucky_colour)
                        <div>
                            <strong class="text-[#B08A2E] block uppercase tracking-wider mb-1">Lucky Alignment:</strong>
                            <p>Day: {{ $currentForecast?->lucky_day ?? $horoscope->lucky_day }} | Color: {{ $currentForecast?->lucky_colour ?? $horoscope->lucky_color }} | Number: {{ $currentForecast?->lucky_number ?? $horoscope->lucky_number }}</p>
                        </div>
                    @endif
                </div>
                @if($currentForecast?->advice)
                    <div class="pt-3 border-t border-[rgba(212,175,55,0.2)]">
                        <strong class="text-[#D4AF37] block font-serif-luxury text-base">Astrological Advice:</strong>
                        <p class="text-xs text-[#D7DCE3] font-light leading-relaxed mt-0.5">{{ $currentForecast->advice }}</p>
                    </div>
                @endif
            </div>

            <!-- PERSONAL READINGS CTA -->
            <div class="pt-6 border-t border-[#17202D]/10 flex flex-col sm:flex-row items-center justify-between gap-4 bg-[#FAF8F5] p-6 rounded-xl border border-[#17202D]/10">
                <div>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#17202D]">Want a More Personal Reading?</h4>
                    <p class="text-xs text-[#596273] mt-0.5">Explore your personalized Janam Kundli chart and Dasha cycles with Tamal Chakraborty.</p>
                </div>
                <a href="{{ route('consultation.book') }}" 
                   class="px-6 py-3.5 text-xs font-bold uppercase tracking-widest text-[#0B1018] bg-[#B08A2E] hover:bg-[#9A7422] hover:text-[#FDFBF7] rounded-lg shadow transition-all flex-shrink-0">
                    BOOK A CONSULTATION →
                </a>
            </div>

        </div>

        <!-- DISCLAIMER -->
        <div class="p-4 bg-[#FAF8F5] border border-[#17202D]/10 rounded-lg text-xs text-[#596273] leading-relaxed text-center">
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
