@extends('layouts.app')

@section('title', 'Astrology Videos & Talks — Tamal Chakraborty')
@section('meta_description', 'Watch astrology discussions, zodiac forecasts, planetary transit analysis, and educational lectures by Astrologer Tamal Chakraborty.')

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
            <span class="text-[#C49A45] font-semibold">VIDEOS</span>
        </nav>

        <!-- Eyebrow -->
        <div class="inline-flex items-center space-x-3">
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">ASTROTAMAL VIDEOS</span>
            <span class="h-px w-6 bg-[#C49A45]/40"></span>
        </div>

        <!-- Heading -->
        <h1 class="font-serif-luxury text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#29211F]">
            Watch & Explore Astrology
        </h1>

        <!-- Supporting Text -->
        <p class="text-xs sm:text-sm md:text-base text-[#81766D] max-w-2xl mx-auto font-light leading-relaxed">
            Explore astrology, zodiac signs, planetary movements and educational discussions from Astrologer Tamal Chakraborty.
        </p>
    </div>
</section>

<!-- VIDEO GRID & PLAYER MODAL SECTION -->
<section class="bg-[#FDFBF7] text-[#29211F] py-16 sm:py-24"
         x-data="{
             selectedCategory: 'ALL',
             playerOpen: false,
             activeVideo: null,
             categories: ['ALL', 'HOROSCOPE', 'VEDIC ASTROLOGY', 'PLANETARY TRANSITS', 'GUIDANCE'],
             videos: [
                 { id: 'bYtG72jD2pE', title: 'Monthly Horoscope & Planetary Alignment Analysis', category: 'HOROSCOPE', duration: '14:20', date: '2026' },
                 { id: '5gZtQkX0uW8', title: 'Vedic Astrology Principles & Chart Placement Guidance', category: 'VEDIC ASTROLOGY', duration: '18:45', date: '2026' },
                 { id: '4vW7gW2d5X8', title: 'Planetary Transits & Major Life Shifts Analysis', category: 'PLANETARY TRANSITS', duration: '22:10', date: '2026' },
                 { id: '9xV8wQ6m5z0', title: 'Career & Job Guidance Astrological Remedies', category: 'GUIDANCE', duration: '16:05', date: '2026' },
                 { id: '7yR3tQ9k8W2', title: 'Understanding Zodiac Signs & House Positions', category: 'HOROSCOPE', duration: '19:30', date: '2026' },
                 { id: '3wV5gH8j9K1', title: 'Spiritual Remedies for Planetary Dasha Cycles', category: 'VEDIC ASTROLOGY', duration: '15:50', date: '2026' }
             ],
             get filteredVideos() {
                 if (this.selectedCategory === 'ALL') return this.videos;
                 return this.videos.filter(v => v.category === this.selectedCategory);
             },
             openVideo(video) {
                 this.activeVideo = video;
                 this.playerOpen = true;
             },
             closeVideo() {
                 this.playerOpen = false;
                 this.activeVideo = null;
             }
         }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Channel Badge & Filters -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-b border-[#D8C6A8] pb-8">
            <div>
                <a href="https://www.youtube.com/@AstrologerTamalChakraborty" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="inline-flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-full bg-red-700 text-white flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-serif-luxury text-xl font-bold text-[#29211F] group-hover:text-[#541F1D] transition-colors">Astrologer Tamal Chakraborty</h3>
                        <span class="text-xs text-[#81766D]">Official YouTube Channel</span>
                    </div>
                </a>
            </div>

            <!-- Category Filters -->
            <div class="flex flex-wrap gap-2">
                <template x-for="cat in categories" :key="cat">
                    <button x-on:click="selectedCategory = cat" 
                            :class="selectedCategory === cat ? 'bg-[#541F1D] text-[#F7F0E3] border-[#C49A45]' : 'bg-[#FDFBF7] text-[#29211F] border-[#D8C6A8] hover:border-[#C49A45]'"
                            class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg border transition-all">
                        <span x-text="cat"></span>
                    </button>
                </template>
            </div>
        </div>

        <!-- 3-Column Desktop / 2-Column Tablet / 1-Column Mobile Video Card Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <template x-for="video in filteredVideos" :key="video.id">
                <div x-on:click="openVideo(video)" 
                     class="group bg-[#FDFBF7] border border-[#D8C6A8] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer flex flex-col justify-between">
                    
                    <!-- Thumbnail Container -->
                    <div class="relative aspect-video bg-[#351211] overflow-hidden">
                        <img :src="'https://img.youtube.com/vi/' + video.id + '/hqdefault.jpg'" 
                             :alt="video.title" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90 group-hover:opacity-100">
                        
                        <!-- Play Overlay Button -->
                        <div class="absolute inset-0 bg-[#351211]/40 flex items-center justify-center group-hover:bg-[#351211]/20 transition-colors">
                            <div class="w-14 h-14 rounded-full bg-[#541F1D] text-[#F7F0E3] border border-[#D8C6A8] flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:bg-[#351211] transition-all">
                                <svg class="w-6 h-6 fill-current ml-1 text-[#C49A45]" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>

                        <!-- Duration Badge -->
                        <span class="absolute bottom-3 right-3 px-2 py-0.5 text-[10px] font-bold text-[#F7F0E3] bg-[#351211]/80 rounded border border-[#D8C6A8]/40" x-text="video.duration"></span>
                    </div>

                    <!-- Details Container -->
                    <div class="p-6 space-y-3 flex-grow flex flex-col justify-between">
                        <div class="space-y-2">
                            <span class="inline-block px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-[#541F1D] bg-[#EDE3D4] rounded border border-[#D8C6A8]/60" x-text="video.category"></span>
                            <h4 class="font-serif-luxury text-lg font-bold text-[#29211F] group-hover:text-[#541F1D] transition-colors leading-snug" x-text="video.title"></h4>
                        </div>

                        <div class="pt-3 border-t border-[#D8C6A8]/60 flex items-center justify-between text-xs text-[#81766D]">
                            <span>Watch Discussion</span>
                            <span class="font-bold text-[#541F1D] group-hover:translate-x-1 transition-transform">PLAY →</span>
                        </div>
                    </div>
                </div>
            </template>
        </div>

    </div>

    <!-- EMBEDDED YOUTUBE VIDEO PLAYER MODAL -->
    <div x-show="playerOpen" 
         x-cloak 
         @keydown.escape.window="closeVideo()"
         class="fixed inset-0 z-50 flex items-center justify-center bg-[#351211]/95 backdrop-blur-md p-4">
        
        <!-- Close Button -->
        <button x-on:click="closeVideo()" class="absolute top-5 right-5 text-[#F7F0E3] hover:text-[#C49A45] p-2 focus:outline-none z-50">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- Player Container -->
        <div class="w-full max-w-4xl space-y-4">
            <div class="relative w-full aspect-video bg-black rounded-2xl overflow-hidden border border-[#D8C6A8] shadow-2xl">
                <template x-if="playerOpen && activeVideo">
                    <iframe class="w-full h-full" 
                            :src="'https://www.youtube.com/embed/' + activeVideo.id + '?autoplay=1'" 
                            title="AstroTamal Video" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>
                </template>
            </div>

            <div class="flex items-center justify-between text-[#F7F0E3]">
                <div>
                    <h3 class="font-serif-luxury text-xl font-bold text-[#F7F0E3]" x-text="activeVideo?.title"></h3>
                    <span class="text-xs text-[#C49A45] font-semibold uppercase tracking-wider" x-text="activeVideo?.category"></span>
                </div>
                <a :href="'https://www.youtube.com/watch?v=' + activeVideo?.id" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="px-4 py-2 text-xs font-bold uppercase tracking-wider bg-red-700 text-[#F7F0E3] rounded-lg hover:bg-red-800 transition-colors">
                    Watch on YouTube ↗
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
