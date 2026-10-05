@extends('layouts.app')

@section('title', 'Astro Shop & Sacred Remedies — Tamal Chakraborty')
@section('meta_description', 'Explore energized gemstones, authentic Rudraksha, Yantras, and customized astrological remedies recommended by Vedic Astrologer Tamal Chakraborty.')

@section('content')

<!-- 1. SHOP HERO / INTRO SECTION -->
@if(\App\Models\SiteSetting::get('shop_hero_visible', '1') == '1')
<section class="relative bg-[#F7F0E3] text-[#29211F] py-12 sm:py-16 overflow-hidden border-b border-[#D8C6A8] flex items-center min-h-[260px]">
    <!-- Celestial Background Overlay -->
    <div class="absolute inset-0 opacity-15 pointer-events-none bg-[radial-gradient(#C49A45_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-[rgba(196,154,69,0.08)] rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full space-y-3 z-10">
        <!-- Eyebrow -->
        <div class="inline-flex items-center space-x-2 text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">
            <span>{{ \App\Models\SiteSetting::get('shop_hero_eyebrow', '🛍 SHOP') }}</span>
        </div>

        <!-- Main Bengali / English Heading -->
        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#541F1D] leading-tight">
            {{ \App\Models\SiteSetting::get('shop_hero_title', 'দোকান') }}
        </h1>

        <!-- Supporting Text -->
        <p class="text-xs sm:text-sm md:text-base text-[#81766D] max-w-2xl font-normal leading-relaxed">
            {{ \App\Models\SiteSetting::get('shop_hero_description', 'Products are being added. For any product enquiry please call or WhatsApp us.') }}
        </p>
    </div>
</section>
@endif

<!-- MAIN CONTENT SECTION (CATEGORY GRID & CTA) -->
@php
    $showGrid = \App\Models\SiteSetting::get('shop_grid_visible', '1') == '1' && isset($categories) && $categories->count() > 0;
    $showCta = \App\Models\SiteSetting::get('shop_cta_visible', '1') == '1';
@endphp

@if($showGrid || $showCta)
<section class="bg-[#FDFBF7] text-[#29211F] py-12 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- 2. PRODUCT CATEGORY GRID -->
        @if($showGrid)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 lg:gap-8">
            @foreach($categories as $cat)
                @if($cat->url)
                    <a href="{{ $cat->url }}" class="group bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl p-6 sm:p-8 space-y-4 hover:border-[#C49A45] hover:shadow-md transition-all flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="text-3xl sm:text-4xl text-[#C49A45]">
                                @if($cat->image)
                                    <img src="{{ asset($cat->image) }}" alt="{{ $cat->name }}" class="w-10 h-10 object-contain">
                                @else
                                    {{ $cat->icon ?: '📦' }}
                                @endif
                            </div>
                            <h2 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#29211F] group-hover:text-[#541F1D] transition-colors">
                                {{ $cat->name }}
                            </h2>
                            <p class="text-xs sm:text-sm text-[#81766D] leading-relaxed font-normal">
                                {{ $cat->description ?: 'Coming to the shop soon' }}
                            </p>
                        </div>
                    </a>
                @else
                    <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl p-6 sm:p-8 space-y-4 flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="text-3xl sm:text-4xl text-[#C49A45]">
                                @if($cat->image)
                                    <img src="{{ asset($cat->image) }}" alt="{{ $cat->name }}" class="w-10 h-10 object-contain">
                                @else
                                    {{ $cat->icon ?: '📦' }}
                                @endif
                            </div>
                            <h2 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#29211F]">
                                {{ $cat->name }}
                            </h2>
                            <p class="text-xs sm:text-sm text-[#81766D] leading-relaxed font-normal">
                                {{ $cat->description ?: 'Coming to the shop soon' }}
                            </p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @endif

        <!-- 3. PERSONALIZED RECOMMENDATION CTA (BELOW CATEGORY GRID) -->
        @if($showCta)
        <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 shadow-xs">
            <div class="space-y-2 text-left max-w-3xl">
                <span class="inline-block px-3 py-1 bg-[#EDE3D4] text-[#C49A45] text-[10px] font-bold uppercase tracking-widest rounded-full border border-[#D8C6A8]">
                    {{ \App\Models\SiteSetting::get('shop_cta_eyebrow', 'PERSONALIZED RECOMMENDATION') }}
                </span>
                
                <h3 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#541F1D] leading-snug">
                    {{ \App\Models\SiteSetting::get('shop_cta_title', 'Need Guidance on Gemstones or Remedies?') }}
                </h3>
                
                <p class="text-xs sm:text-sm text-[#81766D] font-normal leading-relaxed">
                    {{ \App\Models\SiteSetting::get('shop_cta_description', 'Gemstones and Yantras work best when prescribed strictly according to your horoscope\'s planetary periods (Dasha) and planetary strength.') }}
                </p>
            </div>

            <a href="{{ \App\Models\SiteSetting::get('shop_cta_button_url', '/book-consultation') }}" 
               class="flex-shrink-0 inline-flex items-center px-6 py-3.5 rounded-xl text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] border border-[#D8C6A8] transition-all shadow-md">
                <span>{{ \App\Models\SiteSetting::get('shop_cta_button_text', 'BOOK HOROSCOPE ANALYSIS') }}</span>
                <span class="ml-2 text-[#C49A45] font-bold">→</span>
            </a>
        </div>
        @endif

    </div>
</section>
@endif

@endsection
