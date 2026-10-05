@extends('layouts.app')

@section('title', $service->seo_title ?: ($service->title . ' — Tamal Chakraborty'))
@section('meta_description', $service->seo_meta_description ?: $service->short_description)

@section('content')

<!-- 1. HERO SECTION (White Background per design standard) -->
@if($service->hero_visible)
<section class="relative bg-white text-[#29211F] py-16 sm:py-20 overflow-hidden border-b border-[#D8C6A8] flex items-center min-h-[380px] max-h-[460px]">
    <div class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#C49A45_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#C49A45]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4 z-10">
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#C49A45]">
            <a href="{{ route('home') }}" class="hover:text-[#541F1D] transition-colors">HOME</a>
            <span>/</span>
            <a href="{{ route('services.index') }}" class="hover:text-[#541F1D] transition-colors">SERVICES</a>
            <span>/</span>
            <span class="text-[#29211F] font-semibold">{{ strtoupper($service->title) }}</span>
        </nav>

        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">
                {{ $service->hero_eyebrow ?: strtoupper($service->badge ?: $service->title) }}
            </span>
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
        </div>

        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F]">
            {{ $service->hero_title ?: $service->title }}
        </h1>

        <p class="text-xs sm:text-sm md:text-base text-[#81766D] max-w-2xl mx-auto font-normal leading-relaxed">
            {{ $service->hero_description ?: $service->short_description }}
        </p>

        <div class="pt-2 flex justify-center items-center space-x-4 text-xs text-[#C49A45] font-semibold">
            <span>Duration: {{ $service->duration ?: '45 Mins' }}</span>
            <span>•</span>
            <span>Mode: 1-on-1 Confidential Video/Audio</span>
            @if($service->price)
            <span>•</span>
            <span>Fee: {{ $service->price }}</span>
            @endif
        </div>
    </div>
</section>
@endif

<!-- MAIN CONTENT SECTION -->
<section class="bg-[#FDFBF7] text-[#29211F] py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

        <!-- 2. SERVICE INTRODUCTION -->
        @if($service->main_content_visible && ($service->intro_heading || $service->full_description))
        <div class="max-w-4xl mx-auto space-y-6">
            @if($service->intro_eyebrow)
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">{{ $service->intro_eyebrow }}</span>
            @endif
            
            @if($service->intro_heading)
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">
                {{ $service->intro_heading }}
            </h2>
            @endif

            @if($service->full_description)
            <div class="prose prose-lg max-w-none text-[#81766D] text-sm sm:text-base leading-relaxed space-y-4 font-normal">
                {!! $service->full_description !!}
            </div>
            @endif
        </div>
        @endif

        <!-- 3. WHAT THIS SERVICE COVERS -->
        @if($service->covers_visible && !empty($service->covers_items) && is_array($service->covers_items))
        <div class="bg-[#F7F0E3] border border-[#D8C6A8] rounded-2xl p-8 sm:p-12 shadow-sm space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                @if($service->covers_eyebrow)
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">{{ $service->covers_eyebrow }}</span>
                @endif
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F]">{{ $service->covers_title ?: 'What This Consultation Covers' }}</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($service->covers_items as $index => $item)
                @if(is_array($item) && !empty($item['title']))
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-3">
                    <span class="text-lg font-serif-luxury font-bold text-[#541F1D] block">{{ $item['number'] ?? sprintf('%02d', $index + 1) }}</span>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">{{ $item['title'] }}</h4>
                    <p class="text-xs text-[#81766D] leading-relaxed">{{ $item['description'] ?? '' }}</p>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- 4. WHY THIS ANALYSIS MATTERS (BENEFITS) -->
        @if($service->benefits_visible && !empty($service->benefits_items) && is_array($service->benefits_items))
        <div class="max-w-4xl mx-auto space-y-6">
            @if($service->benefits_eyebrow)
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">{{ $service->benefits_eyebrow }}</span>
            @endif
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">{{ $service->benefits_title ?: 'Why This Analysis Matters' }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs sm:text-sm text-[#81766D]">
                @foreach($service->benefits_items as $item)
                @if(is_array($item) && !empty($item['title']))
                <div class="p-5 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <strong class="text-[#29211F] block font-semibold text-base font-serif-luxury">{{ $item['title'] }}</strong>
                    <p>{{ $item['description'] ?? '' }}</p>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- 5. HOW THE CONSULTATION WORKS (PROCESS) -->
        @if($service->process_visible && !empty($service->process_items) && is_array($service->process_items))
        <div class="bg-[#541F1D] text-[#F7F0E3] rounded-2xl p-8 sm:p-12 border border-[#D8C6A8]/40 space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                @if($service->process_eyebrow)
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">{{ $service->process_eyebrow }}</span>
                @endif
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#F7F0E3]">{{ $service->process_title ?: 'How the Session Works' }}</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center">
                @foreach($service->process_items as $idx => $item)
                @if(is_array($item) && !empty($item['title']))
                <div class="space-y-2">
                    <div class="w-10 h-10 rounded-full bg-[#C49A45] text-[#351211] font-bold mx-auto flex items-center justify-center">{{ $item['step'] ?? ($idx + 1) }}</div>
                    <h4 class="font-serif-luxury text-base font-bold text-[#F7F0E3]">{{ $item['title'] }}</h4>
                    <p class="text-xs text-[#F7F0E3]/90">{{ $item['description'] ?? '' }}</p>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- 6. KEY LIFE DIMENSIONS -->
        @if($service->dimensions_visible && !empty($service->dimensions_items) && is_array($service->dimensions_items))
        <div class="space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                @if($service->dimensions_eyebrow)
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">{{ $service->dimensions_eyebrow }}</span>
                @endif
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F]">{{ $service->dimensions_title ?: 'Key Life Dimensions Analyzed' }}</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($service->dimensions_items as $item)
                @if(is_array($item) && !empty($item['title']))
                <div class="p-6 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl space-y-2">
                    <h4 class="font-serif-luxury text-lg font-bold text-[#29211F]">{{ $item['title'] }}</h4>
                    <p class="text-xs text-[#81766D]">{{ $item['description'] ?? '' }}</p>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- 7. WHO THIS SERVICE IS FOR -->
        @if($service->who_for_visible && !empty($service->who_for_items) && is_array($service->who_for_items))
        <div class="bg-[#EDE3D4] border border-[#D8C6A8] rounded-2xl p-8 sm:p-10 space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F]">{{ $service->who_for_title ?: 'Who This Consultation Is For' }}</h3>
            <ul class="space-y-2.5 text-xs sm:text-sm text-[#81766D]">
                @foreach($service->who_for_items as $point)
                @if(!empty($point))
                <li class="flex items-start space-x-3">
                    <span class="text-[#541F1D] font-bold mt-0.5">✓</span>
                    <span>{{ is_array($point) ? ($point['text'] ?? '') : $point }}</span>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
        @endif

        <!-- 8. IMPORTANT QUESTIONS EXPLORED -->
        @if($service->questions_visible && !empty($service->questions_items) && is_array($service->questions_items))
        <div class="space-y-6">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F] text-center">{{ $service->questions_title ?: 'Questions Frequently Explored' }}</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-[#29211F]">
                @foreach($service->questions_items as $q)
                @if(!empty($q))
                <div class="p-4 bg-[#FDFBF7] border border-[#D8C6A8] rounded-lg">
                    {{ is_array($q) ? ($q['text'] ?? '') : $q }}
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- 9. METHODOLOGY -->
        @if($service->methodology_visible && $service->methodology_content)
        <div class="max-w-4xl mx-auto space-y-4">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F]">{{ $service->methodology_title ?: 'Astrological Approach & Methodology' }}</h3>
            <div class="text-xs sm:text-sm text-[#81766D] leading-relaxed">
                {!! nl2br(e($service->methodology_content)) !!}
            </div>
        </div>
        @endif

        <!-- 10. WHAT YOU CAN EXPECT -->
        @if($service->expectations_visible && !empty($service->expectations_items) && is_array($service->expectations_items))
        <div class="bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl p-6 sm:p-8 space-y-4 shadow-sm">
            <h3 class="font-serif-luxury text-xl font-bold text-[#29211F]">{{ $service->expectations_title ?: 'What You Can Expect From the Session' }}</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-[#81766D]">
                @foreach($service->expectations_items as $exp)
                @if(is_array($exp) && !empty($exp['title']))
                <div>
                    <strong class="text-[#29211F] block">{{ $exp['title'] }}</strong>
                    {{ $exp['description'] ?? '' }}
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- 11. FAQ SECTION -->
        @if($service->faqs_visible && !empty($service->faqs_items) && is_array($service->faqs_items))
        <div class="space-y-6" x-data="{ activeFaq: null }">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                @if($service->faqs_eyebrow)
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">{{ $service->faqs_eyebrow }}</span>
                @endif
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#29211F]">{{ $service->faqs_title ?: 'Frequently Asked Questions' }}</h3>
            </div>

            <div class="space-y-4 max-w-3xl mx-auto">
                @foreach($service->faqs_items as $fIndex => $faq)
                @if(is_array($faq) && !empty($faq['question']))
                <div class="border border-[#D8C6A8] rounded-xl overflow-hidden bg-[#FDFBF7]">
                    <button x-on:click="activeFaq = (activeFaq === {{ $fIndex + 1 }} ? null : {{ $fIndex + 1 }})" class="w-full p-5 text-left font-serif-luxury font-bold text-base text-[#29211F] flex items-center justify-between">
                        <span>{{ $faq['question'] }}</span>
                        <span x-text="activeFaq === {{ $fIndex + 1 }} ? '−' : '+'" class="text-[#C49A45] text-xl"></span>
                    </button>
                    <div x-show="activeFaq === {{ $fIndex + 1 }}" x-cloak class="px-5 pb-5 text-xs text-[#81766D] leading-relaxed border-t border-[#D8C6A8]/40 pt-3">
                        {{ $faq['answer'] ?? '' }}
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- 12. RELATED SERVICES -->
        @if(!empty($otherServices) && count($otherServices) > 0)
        <div class="space-y-6 pt-6 border-t border-[#D8C6A8]">
            <h3 class="font-serif-luxury text-2xl font-bold text-[#29211F] text-center">Related Astrology Services</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($otherServices as $oth)
                <a href="{{ route('services.show', $oth->slug) }}" class="block bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl p-5 hover:border-[#C49A45] transition-all group">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#C49A45] block">{{ $oth->badge ?: $oth->title }}</span>
                    <h4 class="font-serif-luxury text-base font-bold text-[#29211F] group-hover:text-[#541F1D] transition-colors mt-1">{{ $oth->title }}</h4>
                    <p class="text-xs text-[#81766D] mt-1 line-clamp-2">{{ $oth->short_description }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- 13. BOOK CONSULTATION CTA -->
        @if($service->cta_visible)
        <div class="bg-[#541F1D] text-[#F7F0E3] rounded-2xl p-8 sm:p-12 text-center space-y-6 border border-[#D8C6A8]">
            @if($service->cta_eyebrow)
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45] block">{{ $service->cta_eyebrow }}</span>
            @endif
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#F7F0E3]">{{ $service->cta_title ?: ('Ready for ' . $service->title . '?') }}</h2>
            <p class="text-xs sm:text-sm text-[#F7F0E3]/90 max-w-xl mx-auto font-normal leading-relaxed">
                {{ $service->cta_description ?: 'Book a 1-on-1 private consultation with Tamal Chakraborty.' }}
            </p>
            <a href="{{ $service->cta_url ?: route('consultation.book') }}" class="inline-flex items-center space-x-2 px-8 py-4 bg-[#F7F0E3] text-[#541F1D] border border-[#D8C6A8] font-bold text-xs uppercase tracking-widest rounded-lg hover:bg-[#EDE3D4] hover:text-[#351211] transition-all shadow-lg">
                <span>{{ $service->cta_button_text ?: 'BOOK CONSULTATION' }}</span>
                <span class="text-[#C49A45]">→</span>
            </a>
        </div>
        @endif

    </div>
</section>

<!-- SCHEMA.ORG JSON-LD -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Service",
  "name": "{{ $service->title }}",
  "provider": {
    "@@type": "Person",
    "name": "Tamal Chakraborty",
    "url": "{{ url('/') }}"
  },
  "areaServed": "Worldwide",
  "description": "{{ $service->short_description }}"
}
</script>

@endsection
