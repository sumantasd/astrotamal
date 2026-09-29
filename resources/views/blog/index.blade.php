@extends('layouts.app')

@section('title', 'Astrology Insights & Articles — Tamal Chakraborty')

@section('content')

<!-- Header Banner -->
<section class="bg-[#F7F0E3] text-[#29211F] py-16 lg:py-24 border-b border-[#D8C6A8] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#C49A45]">ASTROLOGY INSIGHTS</span>
        <h1 class="font-serif-luxury text-4xl sm:text-6xl font-bold text-[#29211F]">Articles & Wisdom</h1>
        <p class="text-[#81766D] text-sm sm:text-base max-w-2xl mx-auto font-normal">
            Stay updated with planetary transits, Vastu principles, relationship advice, and spiritual remedies.
        </p>
    </div>
</section>

<!-- Blog Grid -->
<section class="bg-[#FDFBF7] text-[#29211F] py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filter Pills -->
        <div class="flex items-center justify-center flex-wrap gap-2.5 mb-12">
            <a href="{{ route('blog.index') }}" 
               class="px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-colors border border-[#D8C6A8] {{ !request()->has('category') ? 'bg-[#541F1D] text-[#F7F0E3]' : 'bg-[#F7F0E3] text-[#29211F] hover:bg-[#EDE3D4]' }}">
                All Articles
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('blog.index', ['category' => $cat]) }}" 
                   class="px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-colors border border-[#D8C6A8] {{ request('category') === $cat ? 'bg-[#541F1D] text-[#F7F0E3]' : 'bg-[#F7F0E3] text-[#29211F] hover:bg-[#EDE3D4]' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
                <x-blog-card :post="$post" />
            @endforeach
        </div>

        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</section>

@endsection
