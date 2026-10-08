@props(['testimonial'])

<div class="group bg-[#FFFFFF] border border-[#C8D8CF] hover:border-[#0B3D2E] rounded-xl p-7 flex flex-col justify-between h-full shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
    <!-- Background Decorative Subtle Quote Mark -->
    <div class="absolute -top-3 -right-2 text-[#C49A45]/15 font-serif text-7xl select-none pointer-events-none group-hover:text-[#C49A45]/25 transition-colors">
        “
    </div>

    <div>
        <!-- TOP: Metallic Gold Star Rating -->
        <div class="flex items-center space-x-1 text-[#C49A45] mb-5">
            @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            @endfor
        </div>

        <!-- Review Text -->
        <p class="font-serif text-sm sm:text-base text-[#17211D] leading-relaxed italic mb-6">
            "{{ $testimonial->review }}"
        </p>
    </div>

    <!-- Client Author Area -->
    <div class="pt-4 border-t border-[#C8D8CF]/60 mt-auto flex items-center justify-between">
        <div>
            <h5 class="font-serif-luxury font-bold text-[#17211D] text-base leading-snug group-hover:text-[#0B3D2E] transition-colors">
                {{ $testimonial->client_name }}
            </h5>
            <span class="text-[11px] text-[#60736B] font-medium block">
                {{ $testimonial->city }} @if($testimonial->service_tag) • <span class="text-[#C49A45] font-semibold">{{ $testimonial->service_tag }}</span> @endif
            </span>
        </div>

        <!-- Initial Avatar Circle -->
        <div class="w-9 h-9 rounded-full bg-[#0B3D2E] border border-[#C8D8CF] flex items-center justify-center font-bold text-[#FFFFFF] text-xs flex-shrink-0">
            @if(!empty($testimonial->avatar))
                <img src="{{ asset($testimonial->avatar) }}" 
                     alt="{{ $testimonial->client_name }}" 
                     class="w-full h-full object-cover rounded-full"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <span class="hidden">{{ substr($testimonial->client_name, 0, 1) }}</span>
            @else
                <span>{{ substr($testimonial->client_name, 0, 1) }}</span>
            @endif
        </div>
    </div>
</div>

