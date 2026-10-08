@props(['faq', 'index'])

<div x-data="{ open: false }" 
     class="border border-[#C8D8CF] rounded-xl bg-[#FFFFFF] shadow-sm overflow-hidden transition-all duration-200">
    <button x-on:click="open = !open" 
            class="w-full px-6 py-5 text-left flex items-center justify-between font-serif-luxury text-lg font-semibold text-[#17211D] hover:text-[#0B3D2E] transition-colors focus:outline-none">
        <span>{{ $faq->question }}</span>
        <div class="w-7 h-7 rounded-full bg-[#E8F1EC] flex items-center justify-center text-[#0B3D2E] transition-transform duration-200 flex-shrink-0 ml-4"
             :class="open ? 'rotate-180 bg-[#0B3D2E] text-[#FFFFFF]' : ''">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </button>
    <div x-show="open" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 max-h-0"
         x-transition:enter-end="opacity-100 max-h-96"
         class="px-6 pb-5 pt-1 text-xs sm:text-sm text-[#60736B] leading-relaxed border-t border-[#C8D8CF]/40">
        {{ $faq->answer }}
    </div>
</div>

