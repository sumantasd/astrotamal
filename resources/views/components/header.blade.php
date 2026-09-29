<header x-data="{ scrolled: false, mobileOpen: false }" 
        x-init="$watch('mobileOpen', value => { document.body.style.overflow = value ? 'hidden' : '' })"
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        @keydown.escape.window="mobileOpen = false"
        style="background-color: #F7F0E3 !important;"
        :class="scrolled ? 'border-b border-[#D8C6A8] shadow-md py-1.5 sm:py-2' : 'border-b border-[#D8C6A8]/60 py-2 sm:py-2.5'"
        class="fixed top-0 left-0 right-0 z-50 bg-[#F7F0E3] transition-all duration-300">
    <!-- DESKTOP HEADER CONTAINER (hidden on mobile, flex on desktop) -->
    <div class="hidden lg:flex max-w-7xl mx-auto px-3.5 sm:px-6 lg:px-8 items-center justify-between min-h-[56px] sm:min-h-[66px] lg:min-h-[74px]">
        
        <!-- Brand / Official Ganesha Astro Consultancy Logo -->
        <a href="{{ route('home') }}" class="group flex items-center flex-shrink-0 transition-opacity hover:opacity-95 py-0.5">
            <img src="{{ asset('images/astrotamal-logo.png') }}" 
                 alt="তমাল চক্রবর্তী — Ganesha Astro Consultancy" 
                 class="h-9 sm:h-11 lg:h-12 w-auto max-w-[180px] sm:max-w-[240px] lg:max-w-[290px] object-contain" />
        </a>

        <!-- Desktop Navigation (Exact order: Home -> About -> Services -> Horoscope -> Kundli -> Testimonials -> More -> Contact) -->
        <nav class="flex items-center space-x-5 xl:space-x-7 text-sm font-medium tracking-wide">
            <!-- 1. Home -->
            <a href="{{ route('home') }}" 
               class="transition-colors hover:text-[#541F1D] {{ request()->routeIs('home') ? 'text-[#541F1D] font-bold border-b-2 border-[#C49A45] pb-1' : 'text-[#29211F]' }}">
                Home
            </a>

            <!-- 2. About -->
            <a href="{{ route('about') }}" 
               class="transition-colors hover:text-[#541F1D] {{ request()->routeIs('about') ? 'text-[#541F1D] font-bold border-b-2 border-[#C49A45] pb-1' : 'text-[#29211F]' }}">
                About
            </a>

            <!-- 3. Services -->
            <a href="{{ route('services.index') }}" 
               class="transition-colors hover:text-[#541F1D] {{ request()->routeIs('services.*') ? 'text-[#541F1D] font-bold border-b-2 border-[#C49A45] pb-1' : 'text-[#29211F]' }}">
                Services
            </a>

            <!-- 4. Horoscope -->
            <a href="{{ route('horoscope.index') }}" 
               class="transition-colors hover:text-[#541F1D] {{ request()->routeIs('horoscope.*') ? 'text-[#541F1D] font-bold border-b-2 border-[#C49A45] pb-1' : 'text-[#29211F]' }}">
                Horoscope
            </a>

            <!-- 5. Kundli -->
            <a href="{{ route('kundli') }}" 
               class="transition-colors hover:text-[#541F1D] {{ request()->routeIs('kundli') || request()->routeIs('kundali.calculator') ? 'text-[#541F1D] font-bold border-b-2 border-[#C49A45] pb-1' : 'text-[#29211F]' }}">
                Kundli
            </a>

            <!-- 6. Testimonials -->
            <a href="{{ route('testimonials.index') }}" 
               class="transition-colors hover:text-[#541F1D] {{ request()->routeIs('testimonials.*') ? 'text-[#541F1D] font-bold border-b-2 border-[#C49A45] pb-1' : 'text-[#29211F]' }}">
                Testimonials
            </a>

            <!-- 7. More ▾ (Dropdown containing 6 items, Blog is LAST) -->
            @php
                $isMoreActive = request()->routeIs('blog.*') || request()->routeIs('numerology.calculator') || request()->routeIs('mobile.calculator') || request()->routeIs('gallery') || request()->routeIs('videos') || request()->is('numerology-calculator', 'mobile-number-calculator', 'kundali-calculator', 'gallery', 'videos', 'blog*');
            @endphp
            <div class="relative" x-data="{ desktopMoreOpen: false }" @click.outside="desktopMoreOpen = false">
                <button @click="desktopMoreOpen = !desktopMoreOpen" 
                        type="button"
                        class="inline-flex items-center space-x-1.5 transition-colors hover:text-[#541F1D] focus:outline-none {{ $isMoreActive ? 'text-[#541F1D] font-bold border-b-2 border-[#C49A45] pb-1' : 'text-[#29211F]' }}">
                    <span>More</span>
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 text-[#C49A45]" :class="{ 'rotate-180': desktopMoreOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                     class="absolute right-0 mt-2 w-60 rounded-xl bg-[#FDFBF7] border border-[#D8C6A8] shadow-xl py-2 z-50">
                    <div class="py-1">
                        <!-- 1. Numerology Calculator -->
                        <a href="{{ route('numerology.calculator') }}" 
                           class="group flex items-center px-4 py-2.5 text-xs font-medium text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/50 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C49A45] mr-3 transition-colors"></span>
                            <span>Numerology Calculator</span>
                        </a>

                        <!-- 2. Mobile Number Calculator -->
                        <a href="{{ route('mobile.calculator') }}" 
                           class="group flex items-center px-4 py-2.5 text-xs font-medium text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/50 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C49A45] mr-3 transition-colors"></span>
                            <span>Mobile Number Calculator</span>
                        </a>

                        <!-- 3. Kundali Calculator -->
                        <a href="{{ route('kundali.calculator') }}" 
                           class="group flex items-center px-4 py-2.5 text-xs font-medium text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/50 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C49A45] mr-3 transition-colors"></span>
                            <span>Kundali Calculator</span>
                        </a>

                        <!-- 4. Gallery -->
                        <a href="{{ route('gallery') }}" 
                           class="group flex items-center px-4 py-2.5 text-xs font-medium text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/50 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C49A45] mr-3 transition-colors"></span>
                            <span>Gallery</span>
                        </a>

                        <!-- 5. Videos -->
                        <a href="{{ route('videos') }}" 
                           class="group flex items-center px-4 py-2.5 text-xs font-medium text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/50 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C49A45] mr-3 transition-colors"></span>
                            <span>Videos</span>
                        </a>

                        <!-- 6. Blog -->
                        <a href="{{ route('blog.index') }}" 
                           class="group flex items-center px-4 py-2.5 text-xs font-medium text-[#541F1D] hover:text-[#351211] hover:bg-[#EDE3D4]/50 transition-colors border-t border-[#D8C6A8]/50 mt-1 pt-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#541F1D] mr-3"></span>
                            <span class="font-semibold text-[#541F1D]">Blog</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 8. Contact -->
            <a href="{{ route('contact') }}" 
               class="transition-colors hover:text-[#541F1D] {{ request()->routeIs('contact*') ? 'text-[#541F1D] font-bold border-b-2 border-[#C49A45] pb-1' : 'text-[#29211F]' }}">
                Contact
            </a>
        </nav>

        <!-- Right Side CTA Button (BOOK CONSULTATION - Desktop) -->
        <div class="flex items-center space-x-4 flex-shrink-0">
            <a href="{{ route('consultation.book') }}" 
               class="relative inline-flex items-center justify-center px-5 xl:px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-lg shadow-sm border border-[#D8C6A8] hover:border-[#C49A45] transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                <span>Book Consultation</span>
                <svg class="w-4 h-4 ml-2 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- MOBILE HEADER CONTAINER (grid 1fr auto 1fr: Left Hamburger, Center Logo, Right QUICK BOOK) -->
    <div class="lg:hidden grid grid-cols-[1fr_auto_1fr] items-center w-full max-w-7xl mx-auto px-4 sm:px-6 min-h-[56px] sm:min-h-[66px]">
        
        <!-- LEFT: Circular Hamburger Menu Button -->
        <div class="justify-self-start flex items-center">
            <button @click.stop="mobileOpen = !mobileOpen" 
                    type="button"
                    class="w-9 h-9 xs:w-10 xs:h-10 rounded-full bg-[#EDE3D4] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D] shadow-2xs hover:border-[#C49A45] active:bg-[#D8C6A8] focus:outline-none transition-all" 
                    :aria-expanded="mobileOpen ? 'true' : 'false'"
                    aria-label="Toggle Navigation Menu">
                <svg class="w-5 h-5 text-[#541F1D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- CENTER: Centered Official Master Logo -->
        <div class="justify-self-center text-center flex items-center justify-center px-1">
            <a href="{{ route('home') }}" class="group flex items-center justify-center transition-opacity hover:opacity-95 py-0.5">
                <img src="{{ asset('images/astrotamal-logo.png') }}" 
                     alt="তমাল চক্রবর্তী — Ganesha Astro Consultancy" 
                     class="h-8 xs:h-9 sm:h-10 w-auto max-w-[135px] xs:max-w-[170px] sm:max-w-[210px] object-contain" />
            </a>
        </div>

        <!-- RIGHT: QUICK BOOK Button -->
        <div class="justify-self-end flex items-center">
            <a href="{{ route('consultation.book') }}" 
               class="px-2.5 xs:px-3.5 py-1.5 text-[10px] xs:text-[11px] sm:text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-lg shadow-xs border border-[#D8C6A8] active:scale-95 transition-all min-h-[34px] xs:min-h-[36px] flex items-center justify-center whitespace-nowrap">
                QUICK BOOK
            </a>
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
         style="background-color: #F7F0E3 !important;"
         class="lg:hidden bg-[#F7F0E3] border-b border-[#D8C6A8] px-5 pt-3 pb-6 space-y-4 shadow-xl max-h-[calc(100vh-80px)] overflow-y-auto">
        <div class="flex flex-col space-y-1 font-medium text-base">
            <!-- 1. Home -->
            <a href="{{ route('home') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/60 border-b border-[#D8C6A8]/40 transition-colors">Home</a>
            
            <!-- 2. About -->
            <a href="{{ route('about') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/60 border-b border-[#D8C6A8]/40 transition-colors">About</a>
            
            <!-- 3. Services -->
            <a href="{{ route('services.index') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/60 border-b border-[#D8C6A8]/40 transition-colors">Services</a>
            
            <!-- 4. Horoscope -->
            <a href="{{ route('horoscope.index') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/60 border-b border-[#D8C6A8]/40 transition-colors">Horoscope</a>
            
            <!-- 5. Kundli -->
            <a href="{{ route('kundli') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/60 border-b border-[#D8C6A8]/40 transition-colors">Kundli</a>
            
            <!-- 6. Testimonials -->
            <a href="{{ route('testimonials.index') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/60 border-b border-[#D8C6A8]/40 transition-colors">Testimonials</a>

            <!-- 7. More ▾ (Expandable Accordion) -->
            <div class="border-b border-[#D8C6A8]/40 py-1" x-data="{ mobileMoreOpen: false }">
                <button @click.stop="mobileMoreOpen = !mobileMoreOpen" 
                        type="button"
                        class="w-full flex items-center justify-between min-h-[44px] px-3 rounded-lg text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/60 text-left focus:outline-none transition-colors">
                    <span class="font-medium">More</span>
                    <svg class="w-4 h-4 transform transition-transform duration-200 text-[#C49A45]" :class="{ 'rotate-180': mobileMoreOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="mobileMoreOpen" 
                     x-cloak 
                     x-transition
                     class="pl-4 pr-2 py-2 space-y-1 bg-[#FDFBF7] rounded-lg mt-1 border border-[#D8C6A8] text-sm">
                    <a href="{{ route('numerology.calculator') }}" @click="mobileOpen = false" class="flex items-center min-h-[40px] px-2 text-[#29211F] hover:text-[#541F1D]">Numerology Calculator</a>
                    <a href="{{ route('mobile.calculator') }}" @click="mobileOpen = false" class="flex items-center min-h-[40px] px-2 text-[#29211F] hover:text-[#541F1D]">Mobile Number Calculator</a>
                    <a href="{{ route('kundali.calculator') }}" @click="mobileOpen = false" class="flex items-center min-h-[40px] px-2 text-[#29211F] hover:text-[#541F1D]">Kundali Calculator</a>
                    <a href="{{ route('gallery') }}" @click="mobileOpen = false" class="flex items-center min-h-[40px] px-2 text-[#29211F] hover:text-[#541F1D]">Gallery</a>
                    <a href="{{ route('videos') }}" @click="mobileOpen = false" class="flex items-center min-h-[40px] px-2 text-[#29211F] hover:text-[#541F1D]">Videos</a>
                    <a href="{{ route('blog.index') }}" @click="mobileOpen = false" class="flex items-center min-h-[40px] px-2 text-[#541F1D] font-semibold border-t border-[#D8C6A8]/50 pt-2 mt-1">Blog</a>
                </div>
            </div>
            
            <!-- 8. Contact -->
            <a href="{{ route('contact') }}" @click="mobileOpen = false" class="flex items-center min-h-[44px] px-3 rounded-lg text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/60 transition-colors">Contact</a>
        </div>

        <div class="pt-3 border-t border-[#D8C6A8]">
            <a href="{{ route('consultation.book') }}" 
               @click="mobileOpen = false"
               class="flex items-center justify-center w-full min-h-[48px] py-3 text-center text-sm font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] rounded-lg shadow border border-[#D8C6A8] active:scale-98 transition-transform">
                Book a Consultation →
            </a>
        </div>
    </div>
</header>
