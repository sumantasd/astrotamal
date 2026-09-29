@props(['zodiac'])

<a href="{{ route('horoscope.show', $zodiac->slug) }}" 
   class="group bg-[#FDFBF7] hover:bg-[#F7F0E3] p-3.5 sm:p-5 rounded-2xl border border-[#D8C6A8] hover:border-[#C49A45] shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-center text-center relative overflow-hidden h-full transform hover:-translate-y-1">
    
    <!-- Zodiac SVG Icon -->
    <div class="relative w-20 h-20 sm:w-24 sm:h-24 mb-3 sm:mb-4 flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
        <img src="{{ asset('images/zodiac/' . strtolower($zodiac->slug) . '.svg') }}" 
             alt="{{ $zodiac->zodiac_sign }} Zodiac" 
             class="w-full h-full object-contain filter drop-shadow-sm"
             onerror="this.src='https://raw.githubusercontent.com/twitter/twemoji/master/assets/svg/2648.svg'">
    </div>

    <!-- Sign Title -->
    <h3 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#29211F] group-hover:text-[#541F1D] transition-colors leading-snug">
        {{ $zodiac->zodiac_sign }}
    </h3>

    <!-- Date Range (Gold) -->
    <span class="text-[11px] font-bold tracking-widest text-[#C49A45] uppercase mt-1">
        {{ $zodiac->date_range }}
    </span>

    <!-- Element & Ruler Descriptor -->
    <span class="text-[11px] text-[#81766D] font-normal mt-1.5 mb-5">
        {{ $zodiac->element }} · {{ $zodiac->ruling_planet }}
    </span>

    <!-- Explore Sign → Link -->
    <div class="mt-auto pt-3 border-t border-[#D8C6A8]/40 w-full flex items-center justify-center text-xs font-bold text-[#541F1D] group-hover:text-[#351211] transition-colors">
        <span>Explore Sign</span>
        <svg class="w-3.5 h-3.5 ml-1.5 transform group-hover:translate-x-1 transition-transform text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
        </svg>
    </div>
</a>
