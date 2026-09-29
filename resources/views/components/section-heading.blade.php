@props([
    'eyebrow' => '',
    'title' => '',
    'highlight' => '',
    'subtext' => '',
    'centered' => true,
    'theme' => 'light'
])

<div class="space-y-3 {{ $centered ? 'text-center max-w-3xl mx-auto' : 'text-left' }} mb-12 lg:mb-16">
    @if($eyebrow)
        <div class="inline-flex items-center space-x-2 text-[11px] font-bold tracking-[0.25em] uppercase text-[#C49A45]">
            <span class="w-1.5 h-1.5 rounded-full bg-[#C49A45]"></span>
            <span>{{ $eyebrow }}</span>
            <span class="w-1.5 h-1.5 rounded-full bg-[#C49A45]"></span>
        </div>
    @endif

    @if($title)
        <h2 class="font-serif-luxury text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight text-[#29211F] leading-tight">
            {!! $title !!}
            @if($highlight)
                <span class="text-[#C49A45] italic">{!! $highlight !!}</span>
            @endif
        </h2>
    @endif

    @if($subtext)
        <p class="text-sm sm:text-base text-[#81766D] leading-relaxed font-normal pt-1">
            {{ $subtext }}
        </p>
    @endif
</div>
