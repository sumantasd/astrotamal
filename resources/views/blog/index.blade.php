@extends('layouts.app')

@section('title', 'Astrology Insights & Articles — Tamal Chakraborty')

@section('content')

<!-- Header Banner -->
<section class="bg-navy-950 text-white py-16 lg:py-24 border-b border-gold-500/20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="text-xs font-bold uppercase tracking-[0.25em] text-gold-400">ASTROLOGY INSIGHTS</span>
        <h1 class="font-serif-luxury text-4xl sm:text-6xl font-bold">Articles & Wisdom</h1>
        <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto font-light">
            Stay updated with planetary transits, Vastu principles, relationship advice, and spiritual remedies.
        </p>
    </div>
</section>

<!-- Blog Grid -->
<section class="bg-ivory-50 text-navy-950 py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filter Pills -->
        <div class="flex items-center justify-center flex-wrap gap-2.5 mb-12">
            <a href="{{ route('blog.index') }}" 
               class="px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-colors {{ !request()->has('category') ? 'bg-navy-950 text-white' : 'bg-ivory-200 text-slate-700 hover:bg-ivory-300' }}">
                All Articles
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('blog.index', ['category' => $cat]) }}" 
                   class="px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-colors {{ request('category') === $cat ? 'bg-navy-950 text-white' : 'bg-ivory-200 text-slate-700 hover:bg-ivory-300' }}">
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
