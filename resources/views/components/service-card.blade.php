@props(['service', 'index' => null])

@php
    $num = $index !== null ? sprintf('%02d', $index) : sprintf('%02d', $service->sort_order ?? 1);
    $imageUrl = Str::startsWith($service->image, ['http://', 'https://']) 
        ? $service->image 
        : asset($service->image);
@endphp

<div class="group relative rounded-2xl overflow-hidden border border-[#17202D]/18 hover:border-[#B08A2E]/60 transition-all duration-300 hover:shadow-xl flex flex-col h-full w-full" style="background-color: #FDFBF7;">
    <!-- Image Container with 4:3 Aspect Ratio -->
    <div class="relative w-full overflow-hidden flex-shrink-0 aspect-[4/3]" style="aspect-ratio: 4 / 3; width: 100%; background-color: #070A10;">
        <img src="{{ $imageUrl }}" 
             alt="{{ $service->title }}" 
             class="w-full h-full object-cover object-center group-hover:scale-[1.03] transition-transform duration-500 block"
             style="width: 100%; height: 100%; object-fit: cover; display: block;"
             onerror="this.src='https://images.unsplash.com/photo-1532012197267-da84d127e765?q=80&w=1200&h=900&auto=format&fit=crop'">
        
        <!-- Service Number Badge (Top Left over Image) -->
        <div class="absolute top-3.5 left-3.5 bg-[#070A10]/90 border border-[#B08A2E]/70 px-2.5 py-0.5 rounded-md shadow-md z-10">
            <span class="text-[11px] font-serif-luxury font-bold text-[#D4AF37] tracking-widest" style="color: #D4AF37;">
                {{ $num }}
            </span>
        </div>
    </div>

    <!-- Content Area -->
    <div class="p-6 sm:p-7 flex flex-col flex-grow relative z-10" style="display: flex; flex-direction: column; flex: 1 1 auto;">
        <!-- Service Title (Dark Navy #17202D) -->
        <h3 class="font-serif-luxury text-xl sm:text-[23px] font-bold transition-colors leading-snug mb-3" style="color: #17202D;">
            <a href="{{ route('services.show', $service->slug) }}" class="focus:outline-none hover:underline decoration-[#9A7422]/40 underline-offset-4" style="color: #17202D;">
                {{ $service->title }}
            </a>
        </h3>

        <!-- Short Description (Dark Gray #4B5563) -->
        <p class="text-xs sm:text-sm leading-relaxed mb-6 font-normal" style="color: #4B5563; flex: 1 1 auto;">
            {{ $service->short_description }}
        </p>

        <!-- Divider Line & EXPLORE SERVICE → CTA -->
        <div class="pt-4 border-t border-[#17202D]/10 flex items-center justify-between" style="margin-top: auto;">
            <a href="{{ route('services.show', $service->slug) }}" 
               class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-[#9A7422] group-hover:text-[#B08A2E] transition-colors" style="color: #9A7422;">
                <span>EXPLORE SERVICE</span>
                <svg class="w-3.5 h-3.5 ml-1.5 transform group-hover:translate-x-1 transition-transform text-[#9A7422]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</div>



