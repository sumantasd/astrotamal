@extends('layouts.app')

@section('title', 'Astrology Videos & Talks — Tamal Chakraborty')
@section('meta_description', 'Watch astrology discussions, zodiac forecasts, planetary transit analysis, and educational lectures by Astrologer Tamal Chakraborty.')

@section('content')

<!-- HERO SECTION (Light Green #F3F8F5 Background) -->
<section class="relative bg-[#F3F8F5] text-[#17211D] py-16 sm:py-20 overflow-hidden border-b border-[#C8D8CF] flex items-center min-h-[340px]">
    <!-- Celestial Overlay -->
    <div class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#C49A45_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-[#C49A45]/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4 z-10">
        <!-- Breadcrumb -->
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#C49A45]">
            <a href="{{ route('home') }}" class="hover:text-[#0B3D2E] transition-colors">HOME</a>
            <span class="text-[#60736B]">/</span>
            <span class="text-[#60736B]">MORE</span>
            <span class="text-[#60736B]">/</span>
            <span class="text-[#17211D] font-semibold">VIDEOS</span>
        </nav>

        <!-- Eyebrow -->
        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">ASTROTAMAL VIDEOS</span>
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
        </div>

        <!-- Heading -->
        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#0B3D2E]">
            Watch & Explore Astrology
        </h1>

        <!-- Supporting Text -->
        <p class="text-xs sm:text-sm md:text-base text-[#60736B] max-w-2xl mx-auto font-light leading-relaxed">
            Explore astrology, zodiac signs, planetary movements and educational discussions from Astrologer Tamal Chakraborty.
        </p>
    </div>
</section>

<!-- VIDEO GRID SECTION (Very Light Green #F3F8F5) -->
<section class="bg-[#F3F8F5] text-[#17211D] py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Channel Badge Header -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-b border-[#C8D8CF] pb-8">
            <div>
                <a href="https://www.youtube.com/@AstrologerTamalChakraborty" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="inline-flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-serif-luxury text-xl font-bold text-[#0B3D2E] group-hover:text-[#145A43] transition-colors">Astrologer Tamal Chakraborty</h3>
                        <span class="text-xs text-[#60736B]">Official YouTube & Video Talks</span>
                    </div>
                </a>
            </div>

            <div>
                <a href="https://www.youtube.com/@AstrologerTamalChakraborty" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-[#FFFFFF] bg-[#0B3D2E] hover:bg-[#145A43] border border-[#C49A45]/40 shadow-sm transition-all">
                    <span>Subscribe on YouTube ↗</span>
                </a>
            </div>
        </div>

        @if(isset($videos) && $videos->count() > 0)
            <!-- Responsive Video Grid (Mobile: 1 col, Tablet: 2 cols, Desktop: 3 cols) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 lg:gap-8 items-stretch">
                @foreach($videos as $video)
                    <div class="flex flex-col h-full bg-[#FFFFFF] rounded-[14px] sm:rounded-[16px] border border-[#C8D8CF] shadow-[0_4px_16px_rgba(11,61,46,0.06)] overflow-hidden transition-all duration-300 hover:shadow-md hover:border-[#C49A45] group">
                        
                        <!-- 1. Thumbnail Container (16:9 Aspect Ratio) -->
                        <a href="{{ $video->video_url }}" target="_blank" rel="noopener noreferrer" class="block relative w-full aspect-[16/9] bg-[#06281F] overflow-hidden shrink-0">
                            @if($video->thumbnail)
                                <img src="{{ asset($video->thumbnail) }}" 
                                     alt="{{ $video->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-95 group-hover:opacity-100"
                                     onerror="this.onerror=null; this.src='https://img.youtube.com/vi/bYtG72jD2pE/hqdefault.jpg';">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[#06281F] text-[#E8F1EC]/50 text-xs italic">
                                    🎬 AstroTamal Video
                                </div>
                            @endif

                            <!-- Centered Play Icon Overlay -->
                            <div class="absolute inset-0 bg-black/20 flex items-center justify-center group-hover:bg-black/10 transition-colors">
                                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#06281F]/85 text-[#FFFFFF] border border-[#C49A45]/60 flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                    <svg class="w-4 h-4 fill-current ml-0.5 text-[#C49A45]" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                        </a>

                        <!-- 2. Text Content & Watch Video Button Inside Card Body -->
                        <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between space-y-3 min-w-0">
                            <div class="space-y-2 min-w-0">
                                <h3 class="font-serif-luxury text-base sm:text-lg lg:text-[19px] font-bold text-[#0B3D2E] leading-snug line-clamp-3 group-hover:text-[#145A43] transition-colors break-words">
                                    <a href="{{ $video->video_url }}" target="_blank" rel="noopener noreferrer" class="hover:underline">
                                        {{ $video->title }}
                                    </a>
                                </h3>

                                @if($video->tag)
                                    <div>
                                        <span class="inline-block px-2.5 py-0.5 rounded-full bg-[#E8F1EC] text-[#0B3D2E] text-xs font-semibold tracking-wide border border-[#C8D8CF] max-w-full truncate">
                                            {{ $video->tag }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- 3. Premium Watch Video Button Aligned to Bottom (44px Touch Target) -->
                            <div class="pt-2 mt-auto">
                                <a href="{{ $video->video_url }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   class="flex items-center justify-between w-full min-h-[44px] px-3.5 sm:px-4 py-2.5 rounded-lg bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] text-xs font-bold uppercase tracking-wider border border-[#0B3D2E] shadow-xs transition-all duration-200 hover:scale-[1.01] active:scale-[0.99] group/btn">
                                    <span class="flex items-center space-x-1.5 min-w-0">
                                        <svg class="w-3.5 h-3.5 text-[#C49A45] fill-current shrink-0" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        <span class="truncate">WATCH VIDEO</span>
                                    </span>
                                    <svg class="w-4 h-4 text-[#C49A45] shrink-0 ml-1 group-hover/btn:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <!-- Clean Empty State if no active videos -->
            <div class="text-center py-16 px-4 rounded-2xl bg-[#E8F1EC]/40 border border-[#C8D8CF]/60">
                <p class="text-base font-bold text-[#0B3D2E]">No video discussions published yet.</p>
                <p class="text-xs text-[#60736B] mt-1">Check back soon for new video insights from Astrologer Tamal Chakraborty.</p>
            </div>
        @endif

    </div>
</section>

@endsection
