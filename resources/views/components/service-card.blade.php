@props(['service', 'index' => null])

@php
    $num = $index !== null ? sprintf('%02d', $index) : sprintf('%02d', $service->sort_order ?? 1);
    $imageUrl = Str::startsWith($service->image, ['http://', 'https://']) 
        ? $service->image 
        : asset($service->image);
@endphp

<div class="group relative rounded-2xl overflow-hidden border border-[#D8C6A8] hover:border-[#C49A45] transition-all duration-300 hover:shadow-xl flex flex-col h-full w-full bg-[#FDFBF7]">
    <!-- Image Container with 4:3 Aspect Ratio -->
    <div class="relative w-full overflow-hidden flex-shrink-0 aspect-[4/3] bg-[#351211]">
        <img src="{{ $imageUrl }}" 
             alt="{{ $service->title }}" 
             class="w-full h-full object-cover object-center group-hover:scale-[1.03] transition-transform duration-500 block"
             onerror="this.src='https://images.unsplash.com/photo-1532012197267-da84d127e765?q=80&w=1200&h=900&auto=format&fit=crop'">
        
        <!-- Service Number Badge (Top Left over Image) -->
        <div class="absolute top-3.5 left-3.5 bg-[#351211]/90 border border-[#D8C6A8] px-2.5 py-0.5 rounded-md shadow-md z-10">
            <span class="text-[11px] font-serif-luxury font-bold text-[#C49A45] tracking-widest">
                {{ $num }}
            </span>
        </div>
    </div>

    <!-- Content Area -->
    <div class="p-6 sm:p-7 flex flex-col flex-grow relative z-10">
        <!-- Service Title -->
        <h3 class="font-serif-luxury text-xl sm:text-[23px] font-bold transition-colors leading-snug mb-3 text-[#29211F]">
            <a href="{{ route('services.show', $service->slug) }}" class="focus:outline-none hover:text-[#541F1D] hover:underline decoration-[#C49A45]/40 underline-offset-4">
                {{ $service->title }}
            </a>
        </h3>

        <!-- Short Description -->
        <p class="text-xs sm:text-sm leading-relaxed mb-6 font-normal text-[#81766D] flex-grow">
            {{ $service->short_description }}
        </p>

        <!-- Divider Line & EXPLORE SERVICE → CTA -->
        <div class="pt-4 border-t border-[#D8C6A8]/40 flex items-center justify-between mt-auto">
            <a href="{{ route('services.show', $service->slug) }}" 
               class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-[#541F1D] group-hover:text-[#351211] transition-colors">
                <span>EXPLORE SERVICE</span>
                <svg class="w-3.5 h-3.5 ml-1.5 transform group-hover:translate-x-1 transition-transform text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</div>
