<header x-data="{ scrolled: false, mobileOpen: false }" 
        x-init="$watch('mobileOpen', value => { document.body.style.overflow = value ? 'hidden' : '' })"
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        @keydown.escape.window="mobileOpen = false"
        style="background-color: #080B12 !important;"
        :class="scrolled ? 'border-b border-gold-500/30 shadow-2xl backdrop-blur-md py-2 sm:py-2.5' : 'border-b border-white/10 py-2.5 sm:py-3.5'"
        class="fixed top-0 left-0 right-0 z-50 bg-[#080B12] transition-all duration-300">
    <div class="max-w-7xl mx-auto px-3.5 sm:px-6 lg:px-8 flex items-center justify-between min-h-[64px] sm:min-h-[76px] lg:min-h-[88px]">
        
        <!-- Brand / Original Logo -->
        <a href="{{ route('home') }}" class="group flex items-center flex-shrink-0 transition-opacity hover:opacity-95">
            <img src="{{ asset('images/astrotamal-logo.png') }}" 
                 alt="AstroTamal - Tamal Chakraborty" 
                 class="h-12 xs:h-14 sm:h-16 md:h-18 lg:h-20 w-auto max-w-[170px] xs:max-w-[210px] sm:max-w-[270px] md:max-w-[320px] lg:max-w-[360px] object-contain py-1" />
        </a>

        <!-- Desktop Navigation (Exact order: Home -> About -> Services -> Horoscope -> Kundli -> Testimonials -> More -> Contact) -->
        <nav class="hidden lg:flex items-center space-x-5 xl:space-x-7 text-sm font-medium tracking-wide">
            <!-- 1. Home -->
            <a href="{{ route('home') }}" 
               class="transition-colors hover:text-gold-400 {{ request()->routeIs('home') ? 'text-gold-400 font-semibold border-b-2 border-gold-500 pb-1' : 'text-slate-200' }}">
                Home
            </a>

            <!-- 2. About -->
            <a href="{{ route('about') }}" 
               class="transition-colors hover:text-gold-400 {{ request()->routeIs('about') ? 'text-gold-400 font-semibold border-b-2 border-gold-500 pb-1' : 'text-slate-200' }}">
                About
            </a>

            <!-- 3. Services -->
            <a href="{{ route('services.index') }}" 
               class="transition-colors hover:text-gold-400 {{ request()->routeIs('services.*') ? 'text-gold-400 font-semibold border-b-2 border-gold-500 pb-1' : 'text-slate-200' }}">
                Services
            </a>

            <!-- 4. Horoscope -->
            <a href="{{ route('horoscope.index') }}" 
               class="transition-colors hover:text-gold-400 {{ request()->routeIs('horoscope.*') ? 'text-gold-400 font-semibold border-b-2 border-gold-500 pb-1' : 'text-slate-200' }}">
                Horoscope
            </a>

            <!-- 5. Kundli -->
            <a href="{{ route('kundli') }}" 
               class="transition-colors hover:text-gold-400 {{ request()->routeIs('kundli') || request()->routeIs('kundali.calculator') ? 'text-gold-400 font-semibold border-b-2 border-gold-500 pb-1' : 'text-slate-200' }}">
                Kundli
            </a>

            <!-- 6. Testimonials -->
            <a href="{{ route('testimonials.index') }}" 
               class="transition-colors hover:text-gold-400 {{ request()->routeIs('testimonials.*') ? 'text-gold-400 font-semibold border-b-2 border-gold-500 pb-1' : 'text-slate-200' }}">
                Testimonials
            </a>

            <!-- 7. More ▾ (Dropdown containing 6 items, Blog is LAST) -->
            @php
                $isMoreActive = request()->routeIs('blog.*') || request()->routeIs('numerology.calculator') || request()->routeIs('mobile.calculator') || request()->routeIs('gallery') || request()->routeIs('videos') || request()->is('numerology-calculator', 'mobile-number-calculator', 'kundali-calculator', 'gallery', 'videos', 'blog*');
            @endphp
            <div class="relative" x-data="{ desktopMoreOpen: false }" @click.outside="desktopMoreOpen = false">
                <button @click="desktopMoreOpen = !desktopMoreOpen" 
                        type="button"
                        class="inline-flex items-center space-x-1.5 transition-colors hover:text-gold-400 focus:outline-none {{ $isMoreActive ? 'text-gold-400 font-semibold border-b-2 border-gold-500 pb-1' : 'text-slate-200' }}">
                    <span>More</span>
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 text-[#D4AF37]" :class="{ 'rotate-180': desktopMoreOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu Box -->
                <div x-show="desktopMoreOpen" 
                     x-cloak
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                     class="absolute right-0 mt-2 w-60 rounded-xl bg-[#0B1018] border border-[#B08A2E]/30 shadow-2xl py-2 z-50">
                    <div class="py-1">
                        <!-- 1. Numerology Calculator -->
                        <a href="{{ route('numerology.calculator') }}" 
                           class="group flex items-center px-4 py-2.5 text-xs font-medium text-slate-200 hover:text-[#D4AF37] hover:bg-[#B08A2E]/10 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B08A2E]/50 group-hover:bg-[#D4AF37] mr-3 transition-colors"></span>
                            <span>Numerology Calculator</span>
                        </a>

                        <!-- 2. Mobile Number Calculator -->
                        <a href="{{ route('mobile.calculator') }}" 
                           class="group flex items-center px-4 py-2.5 text-xs font-medium text-slate-200 hover:text-[#D4AF37] hover:bg-[#B08A2E]/10 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B08A2E]/50 group-hover:bg-[#D4AF37] mr-3 transition-colors"></span>
                            <span>Mobile Number Calculator</span>
                        </a>

                        <!-- 3. Kundali Calculator -->
                        <a href="{{ route('kundali.calculator') }}" 
                           class="group flex items-center px-4 py-2.5 text-xs font-medium text-slate-200 hover:text-[#D4AF37] hover:bg-[#B08A2E]/10 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B08A2E]/50 group-hover:bg-[#D4AF37] mr-3 transition-colors"></span>
                            <span>Kundali Calculator</span>
                        </a>

                        <!-- 4. Gallery -->
                        <a href="{{ route('gallery') }}" 
                           class="group flex items-center px-4 py-2.5 text-xs font-medium text-slate-200 hover:text-[#D4AF37] hover:bg-[#B08A2E]/10 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B08A2E]/50 group-hover:bg-[#D4AF37] mr-3 transition-colors"></span>
                            <span>Gallery</span>
                        </a>

                        <!-- 5. Videos -->
                        <a href="{{ route('videos') }}" 
                           class="group flex items-center px-4 py-2.5 text-xs font-medium text-slate-200 hover:text-[#D4AF37] hover:bg-[#B08A2E]/10 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B08A2E]/50 group-hover:bg-[#D4AF37] mr-3 transition-colors"></span>
                            <span>Videos</span>
                        </a>

                        <!-- 6. Blog (LAST / FINAL ITEM IN MORE DROPDOWN) -->
                        <a href="{{ route('blog.index') }}" 
                           class="group flex items-center px-4 py-2.5 text-xs font-medium text-slate-200 hover:text-[#D4AF37] hover:bg-[#B08A2E]/10 transition-colors border-t border-[#17202D]/60 mt-1 pt-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37] mr-3"></span>
                            <span class="font-semibold text-[#D4AF37]">Blog</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 8. Contact -->
            <a href="{{ route('contact') }}" 
               class="transition-colors hover:text-gold-400 {{ request()->routeIs('contact*') ? 'text-gold-400 font-semibold border-b-2 border-gold-500 pb-1' : 'text-slate-200' }}">
                Contact
            </a>
        </nav>

        <!-- Right Side CTA Button (BOOK CONSULTATION - Desktop) -->
        <div class="hidden lg:flex items-center space-x-4 flex-shrink-0">
            <a href="{{ route('consultation.book') }}" 
               class="relative inline-flex items-center justify-center px-5 xl:px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-navy-950 bg-gold-gradient rounded-md shadow-lg gold-glow transition-all duration-300 hover:scale-[1.03] active:scale-[0.98] border border-gold-300/60">
                <span>Book Consultation</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

        <!-- Mobile Controls: [ BOOK ] [ ☰ ] -->
        <div class="lg:hidden flex items-center space-x-2 xs:space-x-3 flex-shrink-0">
            <a href="{{ route('consultation.book') }}" 
               class="px-2.5 xs:px-3 py-1.5 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-navy-950 bg-gold-gradient rounded shadow-md border border-gold-300 active:scale-95 transition-transform min-h-[36px] flex items-center justify-center">
                Book
            </a>
            <button @click.stop="mobileOpen = !mobileOpen" 
                    type="button"
                    class="w-10 h-10 xs:w-11 xs:h-11 flex items-center justify-center rounded-lg text-slate-200 hover:text-gold-400 hover:bg-white/5 active:bg-white/10 focus:outline-none transition-colors" 
                    :aria-expanded="mobileOpen ? 'true' : 'false'"
                    aria-label="Toggle Navigation Menu">
                <svg class="w-6 h-6 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div x-show="mobileOpen" 
         x-cloak
         @click.outside="mobileOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         style="background-color: #080B12 !important;"
         class="lg:hidden bg-[#080B12] border-b border-gold-500/30 px-5 pt-3 pb-6 space-y-4 shadow-2xl max-h-[calc(100vh-80px)] overflow-y-auto">
        <div class="flex flex-col space-y-1 font-medium text-base">
            <!-- 1. Home -->
            <a href="{{ route('home') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-slate-100 hover:text-gold-400 hover:bg-white/5 border-b border-slate-800/40 transition-colors">Home</a>
            
            <!-- 2. About -->
            <a href="{{ route('about') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-slate-100 hover:text-gold-400 hover:bg-white/5 border-b border-slate-800/40 transition-colors">About</a>
            
            <!-- 3. Services -->
            <a href="{{ route('services.index') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-slate-100 hover:text-gold-400 hover:bg-white/5 border-b border-slate-800/40 transition-colors">Services</a>
            
            <!-- 4. Horoscope -->
            <a href="{{ route('horoscope.index') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-slate-100 hover:text-gold-400 hover:bg-white/5 border-b border-slate-800/40 transition-colors">Horoscope</a>
            
            <!-- 5. Kundli -->
            <a href="{{ route('kundli') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-slate-100 hover:text-gold-400 hover:bg-white/5 border-b border-slate-800/40 transition-colors">Kundli</a>
            
            <!-- 6. Testimonials -->
            <a href="{{ route('testimonials.index') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-slate-100 hover:text-gold-400 hover:bg-white/5 border-b border-slate-800/40 transition-colors">Testimonials</a>

            <!-- 7. More ▾ (Expandable Accordion) -->
            <div class="border-b border-slate-800/40 py-1" x-data="{ mobileMoreOpen: false }">
                <button @click.stop="mobileMoreOpen = !mobileMoreOpen" 
                        type="button"
                        class="w-full flex items-center justify-between min-h-[44px] px-3 rounded-lg text-slate-100 hover:text-gold-400 hover:bg-white/5 text-left focus:outline-none transition-colors">
                    <span class="font-medium">More</span>
                    <svg class="w-4 h-4 transform transition-transform duration-200 text-[#D4AF37]" :class="{ 'rotate-180': mobileMoreOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="mobileMoreOpen" 
                     x-cloak 
                     x-transition
                     class="pl-4 pr-2 py-2 space-y-1 bg-[#05070D]/90 rounded-lg mt-1 border border-[#B08A2E]/20 text-sm">
                    <a href="{{ route('numerology.calculator') }}" @click="mobileOpen = false" class="flex items-center min-h-[40px] px-2 text-slate-300 hover:text-gold-400">Numerology Calculator</a>
                    <a href="{{ route('mobile.calculator') }}" @click="mobileOpen = false" class="flex items-center min-h-[40px] px-2 text-slate-300 hover:text-gold-400">Mobile Number Calculator</a>
                    <a href="{{ route('kundali.calculator') }}" @click="mobileOpen = false" class="flex items-center min-h-[40px] px-2 text-slate-300 hover:text-gold-400">Kundali Calculator</a>
                    <a href="{{ route('gallery') }}" @click="mobileOpen = false" class="flex items-center min-h-[40px] px-2 text-slate-300 hover:text-gold-400">Gallery</a>
                    <a href="{{ route('videos') }}" @click="mobileOpen = false" class="flex items-center min-h-[40px] px-2 text-slate-300 hover:text-gold-400">Videos</a>
                    <a href="{{ route('blog.index') }}" @click="mobileOpen = false" class="flex items-center min-h-[40px] px-2 text-[#D4AF37] font-semibold border-t border-[#17202D] pt-2 mt-1">Blog</a>
                </div>
            </div>
            
            <!-- 8. Contact -->
            <a href="{{ route('contact') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-slate-100 hover:text-gold-400 hover:bg-white/5 transition-colors">Contact</a>
        </div>

        <div class="pt-3 border-t border-slate-800/60">
            <a href="{{ route('consultation.book') }}" 
               @click="mobileOpen = false"
               class="flex items-center justify-center w-full min-h-[48px] py-3 text-center text-sm font-bold uppercase tracking-wider text-navy-950 bg-gold-gradient rounded-lg shadow-lg active:scale-98 transition-transform">
                Book a Consultation →
            </a>
        </div>
    </div>
</header>

