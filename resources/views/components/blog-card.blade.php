@props(['post'])

<div class="group bg-[#FDFBF7] rounded-2xl overflow-hidden border border-[#D8C6A8] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lg hover:border-[#C49A45] flex flex-col h-full">
    <!-- Image Header -->
    <div class="relative h-48 sm:h-52 overflow-hidden bg-[#351211]">
        @if($post->image)
            <img src="{{ asset($post->image) }}" 
                 alt="{{ $post->title }}" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                 onerror="this.src='https://images.unsplash.com/photo-1506703719100-a0f3a48c0f86?q=80&w=800&auto=format&fit=crop'">
        @else
            <div class="w-full h-full bg-gradient-to-br from-[#351211] to-[#541F1D] flex items-center justify-center text-[#C49A45]">
                <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
        @endif

        <!-- Category Tag -->
        <span class="absolute top-4 left-4 bg-[#541F1D]/90 backdrop-blur-md text-[#F7F0E3] text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded shadow-md border border-[#D8C6A8]">
            {{ $post->category }}
        </span>
    </div>

    <!-- Body -->
    <div class="p-6 flex flex-col flex-grow">
        <!-- Date & Read Time -->
        <div class="flex items-center space-x-3 text-[11px] font-semibold text-[#81766D] mb-2">
            <span>{{ $post->published_at ? $post->published_at->format('d M Y') : 'Sep 2026' }}</span>
            <span>•</span>
            <span>{{ $post->read_time }}</span>
        </div>

        <h3 class="font-serif-luxury text-xl font-bold text-[#29211F] group-hover:text-[#541F1D] transition-colors leading-tight mb-3">
            <a href="{{ route('blog.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h3>

        <p class="text-xs text-[#81766D] leading-relaxed flex-grow mb-5">
            {{ Str::limit($post->summary, 110) }}
        </p>

        <!-- Read More Link -->
        <a href="{{ route('blog.show', $post->slug) }}" 
           class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-[#541F1D] group-hover:text-[#351211] transition-colors mt-auto">
            <span>Read Article</span>
            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
    </div>
</div>
