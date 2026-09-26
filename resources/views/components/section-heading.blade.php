@props([
    'eyebrow' => '',
    'title' => '',
    'highlight' => '',
    'subtext' => '',
    'centered' => true,
    'theme' => 'dark'
])

<div class="space-y-3 {{ $centered ? 'text-center max-w-3xl mx-auto' : 'text-left' }} mb-12 lg:mb-16">
    @if($eyebrow)
        <div class="inline-flex items-center space-x-2 text-[11px] font-bold tracking-[0.25em] uppercase {{ $theme === 'light' ? 'text-[#B08A2E]' : 'text-gold-400' }}">
            <span class="w-1.5 h-1.5 rounded-full {{ $theme === 'light' ? 'bg-[#B08A2E]' : 'bg-gold-500' }}"></span>
            <span>{{ $eyebrow }}</span>
            <span class="w-1.5 h-1.5 rounded-full {{ $theme === 'light' ? 'bg-[#B08A2E]' : 'bg-gold-500' }}"></span>
        </div>
    @endif

    @if($title)
        <h2 class="font-serif-luxury text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight {{ $theme === 'light' ? 'text-[#17202D]' : 'text-white' }} leading-tight">
            {!! $title !!}
            @if($highlight)
                <span class="text-gold-gradient italic">{!! $highlight !!}</span>
            @endif
        </h2>
    @endif

    @if($subtext)
        <p class="text-sm sm:text-base {{ $theme === 'light' ? 'text-[#5B6472]' : 'text-slate-400' }} leading-relaxed font-normal pt-1">
            {{ $subtext }}
        </p>
    @endif
</div>
