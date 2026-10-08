@extends('layouts.app')

@section('title', $post->title . ' — Tamal Chakraborty')

@section('content')

<!-- Header Banner (Dark Green #06281F) -->
<section class="bg-[#06281F] text-[#FFFFFF] py-16 lg:py-20 border-b border-[#145A43] relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4 text-center">
        <span class="bg-[#0B3D2E] text-[#FFFFFF] border border-[#145A43] text-[10px] uppercase font-bold tracking-widest px-3.5 py-1 rounded-full">
            {{ $post->category }}
        </span>
        <h1 class="font-serif-luxury text-3xl sm:text-5xl font-bold leading-tight text-[#FFFFFF]">{{ $post->title }}</h1>
        <div class="flex items-center justify-center space-x-4 text-xs text-[#E8F1EC]/80 pt-2">
            <span>By {{ $post->author_name }}</span>
            <span>•</span>
            <span>{{ $post->published_at ? $post->published_at->format('d M Y') : 'Sep 2026' }}</span>
            <span>•</span>
            <span>{{ $post->read_time }}</span>
        </div>
    </div>
</section>

<!-- Reading View (Very Light Green #F3F8F5) -->
<section class="bg-[#F3F8F5] text-[#17211D] py-16 lg:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <div class="rounded-2xl overflow-hidden shadow-md border border-[#C8D8CF] h-72 sm:h-[420px]">
            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>

        <div class="bg-[#FFFFFF] border border-[#C8D8CF] rounded-2xl p-8 sm:p-10 shadow-sm space-y-6 leading-relaxed text-[#60736B]">
            <p class="font-serif-luxury text-xl italic text-[#0B3D2E] border-l-4 border-[#C49A45] pl-4 py-1">
                "{{ $post->summary }}"
            </p>

            <div class="prose prose-lg max-w-none text-[#17211D] space-y-4 text-sm sm:text-base">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Author Box -->
            <div class="pt-8 border-t border-[#C8D8CF] flex items-center space-x-4">
                <div class="w-14 h-14 rounded-full bg-[#0B3D2E] overflow-hidden border border-[#C8D8CF] flex-shrink-0">
                    <img src="{{ asset('images/tamal_hero_portrait.jpg') }}" alt="Tamal Chakraborty" class="w-full h-full object-cover">
                </div>
                <div>
                    <h4 class="font-serif-luxury text-lg font-bold text-[#0B3D2E]">Written by {{ $post->author_name }}</h4>
                    <p class="text-xs text-[#60736B]">Senior Vedic Astrologer, Vastu Consultant & Spiritual Mentor.</p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
