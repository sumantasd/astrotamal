@extends('layouts.app')

@section('title', 'Astrology Gallery — Tamal Chakraborty')
@section('meta_description', 'Explore moments, consultation sessions, lectures, and events with Astrologer Tamal Chakraborty.')

@section('content')

<!-- HERO SECTION -->
<section class="relative bg-[#F7F0E3] text-[#29211F] py-16 sm:py-20 overflow-hidden border-b border-[#D8C6A8] flex items-center min-h-[340px]">
    <!-- Celestial Overlay -->
    <div class="absolute inset-0 opacity-15 pointer-events-none bg-[radial-gradient(#C49A45_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-[rgba(196,154,69,0.08)] rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center space-y-4">
        <!-- Breadcrumb -->
        <nav class="flex justify-center items-center space-x-2 text-xs uppercase tracking-widest text-[#81766D]">
            <a href="{{ route('home') }}" class="hover:text-[#C49A45] transition-colors">HOME</a>
            <span>/</span>
            <span class="text-[#81766D]">MORE</span>
            <span>/</span>
            <span class="text-[#C49A45] font-semibold">GALLERY</span>
        </nav>

        <!-- Eyebrow -->
        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">PHOTO GALLERY</span>
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
        </div>

        <!-- Heading -->
        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F]">
            Moments & Astrological Engagements
        </h1>

        <!-- Supporting Text -->
        <p class="text-xs sm:text-sm md:text-base text-[#81766D] max-w-2xl mx-auto font-light leading-relaxed">
            Explore visual moments, consultation sessions, media talks and events featuring Astrologer Tamal Chakraborty.
        </p>
    </div>
</section>

@php
    $galleryList = isset($mediaItems) && $mediaItems->count() > 0 
        ? $mediaItems->map(function($item) {
            $src = $item->file_path ? asset('storage/' . $item->file_path) : ($item->url ?? asset('images/tamal_hero_portrait.jpg'));
            return [
                'id' => $item->id,
                'src' => $src,
                'title' => $item->title,
                'category' => $item->caption ?: 'Gallery',
            ];
        })->values()
        : collect([
            ['id' => 1, 'src' => asset('images/tamal_hero_portrait.jpg'), 'title' => 'Tamal Chakraborty — Professional Portrait', 'category' => 'Portrait'],
            ['id' => 2, 'src' => asset('images/tamal_about_study.jpg'), 'title' => 'Consultation & Chart Analysis Study', 'category' => 'Sanctuary'],
            ['id' => 3, 'src' => 'https://img.youtube.com/vi/bYtG72jD2pE/maxresdefault.jpg', 'title' => 'Planetary Transit & Astrological Discussion', 'category' => 'Talks'],
            ['id' => 4, 'src' => 'https://img.youtube.com/vi/5gZtQkX0uW8/maxresdefault.jpg', 'title' => 'Zodiac Analysis & Vedic Guidance Video', 'category' => 'Media'],
            ['id' => 5, 'src' => 'https://img.youtube.com/vi/4vW7gW2d5X8/maxresdefault.jpg', 'title' => 'Veda & Jyotish Discourse', 'category' => 'Talks'],
            ['id' => 6, 'src' => 'https://img.youtube.com/vi/9xV8wQ6m5z0/maxresdefault.jpg', 'title' => 'Client Guidance & Horoscope Session', 'category' => 'Consultation'],
        ]);
@endphp

<!-- GALLERY GRID & LIGHTBOX MODAL -->
<section class="bg-[#FDFBF7] text-[#29211F] py-16 sm:py-24"
         x-data="{
             lightboxOpen: false,
             activeIdx: 0,
             images: {{ json_encode($galleryList) }},
             openLightbox(index) {
                 this.activeIdx = index;
                 this.lightboxOpen = true;
             },
             next() {
                 if (this.images.length === 0) return;
                 this.activeIdx = (this.activeIdx + 1) % this.images.length;
             },
             prev() {
                 if (this.images.length === 0) return;
                 this.activeIdx = (this.activeIdx - 1 + this.images.length) % this.images.length;
             }
         }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Grid Header -->
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#C49A45]">VISUAL MOMENTS</span>
            <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#29211F]">Image Collection</h2>
            <p class="text-xs sm:text-sm text-[#81766D]">Click on any image to view in high-resolution lightbox format.</p>
        </div>

        <!-- 4-Column Desktop / 3-Column Tablet / 2-Column Mobile Masonry Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            <template x-for="(img, idx) in images" :key="idx">
                <div x-on:click="openLightbox(idx)" 
                     class="group relative bg-[#EDE3D4] rounded-xl overflow-hidden cursor-pointer shadow-sm hover:shadow-xl transition-all duration-300 border border-[#D8C6A8] aspect-square">
                    <img :src="img.src" 
                         :alt="img.title" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90 group-hover:opacity-100">
                    
                    <!-- Overlay Glow & Info -->
                    <div class="absolute inset-0 bg-gradient-to-t from-[#351211] via-transparent to-transparent opacity-60 group-hover:opacity-85 transition-opacity"></div>
                    
                    <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-1 group-hover:translate-y-0 transition-transform">
                        <span class="inline-block px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] rounded mb-1 border border-[#D8C6A8]" x-text="img.category"></span>
                        <h4 class="text-xs font-serif-luxury font-bold text-[#F7F0E3] truncate" x-text="img.title"></h4>
                    </div>

                    <!-- Zoom Icon -->
                    <div class="absolute top-3 right-3 w-8 h-8 rounded-full bg-[#541F1D]/80 text-[#C49A45] border border-[#D8C6A8]/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                    </div>
                </div>
            </template>
        </div>

    </div>

    <!-- LIGHTBOX MODAL -->
    <div x-show="lightboxOpen" 
         x-cloak 
         @keydown.escape.window="lightboxOpen = false"
         class="fixed inset-0 z-50 flex items-center justify-center bg-[#351211]/95 backdrop-blur-md p-4">
        
        <!-- Close Button -->
        <button x-on:click="lightboxOpen = false" class="absolute top-5 right-5 text-[#F7F0E3] hover:text-[#C49A45] p-2 focus:outline-none z-50">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- Prev Button -->
        <button x-on:click="prev()" class="absolute left-4 sm:left-8 text-[#F7F0E3] hover:text-[#C49A45] p-3 focus:outline-none z-50 bg-[#541F1D]/80 border border-[#D8C6A8]/30 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>

        <!-- Next Button -->
        <button x-on:click="next()" class="absolute right-4 sm:right-8 text-[#F7F0E3] hover:text-[#C49A45] p-3 focus:outline-none z-50 bg-[#541F1D]/80 border border-[#D8C6A8]/30 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>

        <!-- Image Container -->
        <div class="max-w-4xl max-h-[85vh] flex flex-col items-center space-y-4">
            <img :src="images[activeIdx]?.src" 
                 :alt="images[activeIdx]?.title" 
                 class="max-h-[75vh] w-auto object-contain rounded-xl border border-[#D8C6A8] shadow-2xl">
            <div class="text-center space-y-1">
                <h3 class="font-serif-luxury text-lg font-bold text-[#F7F0E3]" x-text="images[activeIdx]?.title"></h3>
                <span class="text-xs text-[#C49A45] uppercase tracking-widest font-semibold" x-text="images[activeIdx]?.category"></span>
            </div>
        </div>
    </div>
</section>

@endsection
