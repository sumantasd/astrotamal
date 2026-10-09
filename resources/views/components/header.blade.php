@php
    // Seed defaults if table empty
    \App\Models\NavigationItem::seedDefaultsIfEmpty();

    $headerEnabled = \App\Models\SiteSetting::get('header_enabled', '1') == '1';
    $headerLogo = \App\Models\SiteSetting::get('header_logo', 'images/astrotamal-logo.png');
    $headerLogoWidth = \App\Models\SiteSetting::get('header_logo_width', '240');
    $headerLogoHeight = \App\Models\SiteSetting::get('header_logo_height', '48');
    $headerLogoLinkSetting = \App\Models\SiteSetting::get('header_logo_link', 'home');
    $logoUrl = \Illuminate\Support\Facades\Route::has($headerLogoLinkSetting) ? route($headerLogoLinkSetting) : url($headerLogoLinkSetting);

    $headerBgColor = '#C3E8D2';
    $headerTextColor = '#0B3D2E';
    $headerActiveColor = '#0B3D2E';
    $headerBorderColor = '#BFD8C9';
    $headerHeight = \App\Models\SiteSetting::get('header_height', '74px');
    $headerSticky = \App\Models\SiteSetting::get('header_sticky', '1') == '1';
    $headerShadow = \App\Models\SiteSetting::get('header_shadow', '1') == '1';

    // Actions
    $accountEnabled = \App\Models\SiteSetting::get('header_action_account_enabled', '1') == '1';
    $accountGuestLabel = \App\Models\SiteSetting::get('header_action_account_guest_label', 'Account');
    $accountAuthLabel = \App\Models\SiteSetting::get('header_action_account_auth_label', 'Dashboard');
    $accountUrl = auth()->check() 
        ? (auth()->user()->is_admin ? route('admin.dashboard') : route('account.dashboard')) 
        : route('account.login');
    $accountLabel = auth()->check() ? $accountAuthLabel : $accountGuestLabel;

    $bookingEnabled = \App\Models\SiteSetting::get('header_action_booking_enabled', '1') == '1';
    $bookingLabel = \App\Models\SiteSetting::get('header_action_booking_label', 'Quick Booking');
    $bookingUrlSetting = \App\Models\SiteSetting::get('header_action_booking_url', 'consultation.book');
    $bookingUrl = \Illuminate\Support\Facades\Route::has($bookingUrlSetting) ? route($bookingUrlSetting) : url($bookingUrlSetting);

    // Mobile
    $mobileHeaderEnabled = \App\Models\SiteSetting::get('mobile_header_enabled', '1') == '1';
    $mobileLogoWidth = \App\Models\SiteSetting::get('mobile_logo_width', '220');
    $mobileLogoHeight = \App\Models\SiteSetting::get('mobile_logo_height', '46');
    $mobileHamburgerEnabled = \App\Models\SiteSetting::get('mobile_hamburger_enabled', '1') == '1';
    $mobileMenuBg = '#C3E8D2';
    $mobileMenuTextColor = '#0B3D2E';
    $mobileMenuActiveColor = '#0B3D2E';
    $mobileAccountVisible = \App\Models\SiteSetting::get('mobile_account_visible', '1') == '1';
    $mobileBookingVisible = \App\Models\SiteSetting::get('mobile_booking_visible', '1') == '1';

    // Navigation Tree
    $navItems = \App\Models\NavigationItem::whereNull('parent_id')
        ->where('is_active', true)
        ->with(['children' => fn($q) => $q->where('is_active', true)->orderBy('sort_order')])
        ->orderBy('sort_order')
        ->get();
@endphp

@if($headerEnabled)
<header x-data="{ scrolled: false, mobileOpen: false }" 
        x-init="$watch('mobileOpen', value => { document.body.style.overflow = value ? 'hidden' : '' })"
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        @keydown.escape.window="mobileOpen = false"
        style="background-color: {{ $headerBgColor }} !important;"
        :class="scrolled ? 'border-b border-[#BFD8C9] shadow-md py-1.5 sm:py-2' : 'border-b border-[#BFD8C9] py-2 sm:py-2.5'"
        class="{{ $headerSticky ? 'fixed top-0 left-0 right-0 z-50' : 'relative z-50' }} transition-all duration-300">
    
    <!-- DESKTOP HEADER CONTAINER (lg and above) -->
    <div class="hidden lg:flex max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 items-center justify-between min-h-[56px] sm:min-h-[66px] lg:min-h-[74px]">
        
        <!-- Logo (Left) -->
        <a href="{{ $logoUrl }}" class="group flex items-center flex-shrink-0 transition-opacity hover:opacity-95 py-0.5 mr-2 xl:mr-4">
            <img src="{{ asset($headerLogo) }}" 
                 alt="তমাল চক্রবর্তী — Ganesha Astro Consultancy" 
                 style="max-width: {{ $headerLogoWidth }}px; max-height: {{ $headerLogoHeight }}px;"
                 class="h-9 sm:h-10 lg:h-11 xl:h-12 w-auto object-contain" />
        </a>

        <!-- Main Navigation Tree (Dynamic with Dropdowns) -->
        <nav class="flex items-center space-x-3.5 xl:space-x-5 text-xs xl:text-sm font-semibold tracking-wide">
            @foreach ($navItems as $item)
                @if ($item->children->count() > 0)
                    <!-- Submenu Dropdown Container -->
                    <div x-data="{ dropdownOpen: false }" @mouseleave="dropdownOpen = false" class="relative py-1">
                        <button @click="dropdownOpen = !dropdownOpen" 
                                @mouseenter="dropdownOpen = true"
                                class="inline-flex items-center transition-colors hover:text-[#0B3D2E]/80 whitespace-nowrap {{ $item->isActiveRoute() ? 'font-bold text-[#0B3D2E] border-b-2 border-[#C49A45]' : 'text-[#0B3D2E]' }}">
                            <span>{{ $item->label }}</span>
                            <svg class="w-3.5 h-3.5 ml-1 transition-transform text-[#0B3D2E]" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu Box -->
                        <div x-show="dropdownOpen" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                             class="absolute left-0 mt-2 w-48 bg-[#FFFFFF] border border-[#BFD8C9] rounded-xl shadow-xl py-2 z-50">
                            @foreach ($item->children as $child)
                                <a href="{{ $child->computed_url }}" 
                                   target="{{ $child->target }}"
                                   class="block px-4 py-2 text-xs transition-colors hover:bg-[#E8F1EC] hover:text-[#0B3D2E] {{ $child->isActiveRoute() ? 'font-bold text-[#0B3D2E] bg-[#E8F1EC]' : 'text-[#0B3D2E]' }}">
                                    {{ $child->label }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Standard Menu Link -->
                    <a href="{{ $item->computed_url }}" 
                       target="{{ $item->target }}"
                       class="transition-colors hover:text-[#0B3D2E]/80 py-1 whitespace-nowrap {{ $item->isActiveRoute() ? 'font-bold text-[#0B3D2E] border-b-2 border-[#C49A45]' : 'text-[#0B3D2E]' }}">
                        {{ $item->label }}
                    </a>
                @endif
            @endforeach
        </nav>

        <!-- Right Side CTA Actions -->
        <div class="flex items-center space-x-2.5 xl:space-x-3 flex-shrink-0 ml-2 xl:ml-4">
            @if ($accountEnabled)
                <!-- Account Button -->
                <a href="{{ $accountUrl }}" 
                   class="inline-flex items-center space-x-1.5 text-xs xl:text-sm font-semibold text-[#0B3D2E] hover:text-[#145A43] px-2.5 xl:px-3.5 py-2 rounded-lg bg-[#FFFFFF] hover:bg-[#E8F1EC] border border-[#BFD8C9] transition-all whitespace-nowrap shadow-xs">
                    <svg class="w-4 h-4 text-[#0B3D2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>{{ $accountLabel }}</span>
                </a>
            @endif

            @if ($bookingEnabled)
                <!-- Quick Booking Button -->
                <a href="{{ $bookingUrl }}" 
                   class="relative inline-flex items-center justify-center px-3.5 xl:px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-white bg-[#0B3D2E] hover:bg-[#145A43] active:bg-[#06281F] rounded-lg shadow-sm border border-[#0B3D2E] transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] whitespace-nowrap">
                    <span>{{ $bookingLabel }}</span>
                    <svg class="w-3.5 h-3.5 ml-1.5 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>

    <!-- MOBILE HEADER CONTAINER (screens below lg) -->
    @if ($mobileHeaderEnabled)
        <style>
            @keyframes quickBookGlowPulse {
                0%, 100% {
                    box-shadow: 0 0 6px rgba(255, 215, 0, 0.6), 0 0 14px rgba(255, 215, 0, 0.4), inset 0 0 3px rgba(255, 215, 0, 0.3);
                    border-color: #FFD700;
                }
                50% {
                    box-shadow: 0 0 14px rgba(255, 215, 0, 0.95), 0 0 24px rgba(255, 215, 0, 0.75), inset 0 0 6px rgba(255, 215, 0, 0.6);
                    border-color: #FFF2A1;
                }
            }

            @keyframes menuButtonPulse {
                0%, 100% {
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08), 0 0 0 0 rgba(11, 61, 46, 0.15);
                }
                50% {
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12), 0 0 0 3px rgba(11, 61, 46, 0.25);
                }
            }

            .animate-quick-book-glow {
                animation: quickBookGlowPulse 2.4s infinite ease-in-out;
            }

            .animate-menu-pulse {
                animation: menuButtonPulse 3s infinite ease-in-out;
            }

            @media (prefers-reduced-motion: reduce) {
                .animate-quick-book-glow,
                .animate-menu-pulse {
                    animation: none !important;
                }
            }
        </style>

        <div class="lg:hidden flex items-center justify-between w-full max-w-7xl mx-auto px-2 sm:px-4 py-1.5 min-h-[58px] sm:min-h-[66px] gap-1 sm:gap-2">
            
            <!-- 1. Menu Button (Circular White Button with Larger Green Hamburger Icon & Pulse) -->
            @if ($mobileHamburgerEnabled)
                <button @click.stop="mobileOpen = !mobileOpen" 
                        type="button"
                        class="w-9.5 h-9.5 sm:w-10.5 sm:h-10.5 rounded-full bg-white border border-[#BFD8C9] flex items-center justify-center text-[#0B3D2E] shadow-sm hover:bg-[#E8F1EC] focus:outline-none transition-all flex-shrink-0 animate-menu-pulse" 
                        :aria-expanded="mobileOpen ? 'true' : 'false'"
                        aria-label="Toggle Navigation Menu">
                    <svg class="w-6 h-6 sm:w-6.5 sm:h-6.5 text-[#0B3D2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            @endif

            <!-- 2. Logo (Increased Size & Prominence) -->
            <a href="{{ $logoUrl }}" class="group flex items-center transition-opacity hover:opacity-95 py-0.5 flex-shrink min-w-0">
                <img src="{{ asset($headerLogo) }}" 
                     alt="তমাল চক্রবর্তী — Ganesha Astro Consultancy" 
                     style="max-width: {{ $mobileLogoWidth }}px; max-height: {{ $mobileLogoHeight }}px;"
                     class="h-8.5 xs:h-9.5 sm:h-11 w-auto object-contain max-w-full" />
            </a>

            <!-- 3. Quick Book Button (Pill-Shaped with Calendar Icon & Glowing Gold Accent) -->
            @if ($mobileBookingVisible && $bookingEnabled)
                <a href="{{ $bookingUrl }}" 
                   class="relative inline-flex items-center justify-center gap-1 sm:gap-1.5 px-2.5 xs:px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-[#0B3D2E] text-white font-bold text-[11px] xs:text-xs sm:text-sm border-2 border-[#FFD700] shadow-md transition-all duration-300 hover:scale-[1.03] active:scale-[0.97] whitespace-nowrap flex-shrink-0 animate-quick-book-glow">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Quick Book</span>
                    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-[#FFD700] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @endif

            <!-- 4. Account Button (Circular White Button with Larger Green User Icon) -->
            @if ($mobileAccountVisible && $accountEnabled)
                <a href="{{ $accountUrl }}" 
                   class="w-9.5 h-9.5 sm:w-10.5 sm:h-10.5 rounded-full bg-white border border-[#BFD8C9] flex items-center justify-center text-[#0B3D2E] shadow-sm hover:bg-[#E8F1EC] transition-all flex-shrink-0"
                   aria-label="Account">
                    <svg class="w-6 h-6 sm:w-6.5 sm:h-6.5 text-[#0B3D2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </a>
            @endif

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
             style="background-color: {{ $mobileMenuBg }} !important;"
             class="lg:hidden border-b border-[#BFD8C9] px-5 pt-3 pb-6 space-y-4 shadow-xl max-h-[calc(100vh-80px)] overflow-y-auto">
            
            <div class="flex flex-col space-y-1 font-semibold text-base">
                @foreach ($navItems as $item)
                    @if ($item->children->count() > 0)
                        <div x-data="{ mobSubOpen: false }" class="border-b border-[#BFD8C9]/60 pb-1">
                            <button @click="mobSubOpen = !mobSubOpen" class="flex items-center justify-between w-full min-h-[44px] px-3 rounded-lg text-[#0B3D2E] font-semibold hover:bg-[#E8F1EC]">
                                <span>{{ $item->label }}</span>
                                <svg class="w-4 h-4 transition-transform text-[#0B3D2E]" :class="mobSubOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="mobSubOpen" x-cloak class="pl-4 space-y-1 pt-1">
                                @foreach ($item->children as $child)
                                    <a href="{{ $child->computed_url }}" 
                                       target="{{ $child->target }}"
                                       @click="mobileOpen = false" 
                                       class="flex items-center min-h-[38px] px-3 rounded-lg text-sm {{ $child->isActiveRoute() ? 'text-[#0B3D2E] font-bold bg-[#FFFFFF]' : 'text-[#0B3D2E] hover:bg-[#E8F1EC]' }}">
                                        ↳ {{ $child->label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $item->computed_url }}" 
                           target="{{ $item->target }}"
                           @click="mobileOpen = false" 
                           class="flex items-center min-h-[44px] px-3 rounded-lg {{ $item->isActiveRoute() ? 'text-[#0B3D2E] font-bold bg-[#FFFFFF]' : 'text-[#0B3D2E] hover:text-[#0B3D2E] hover:bg-[#E8F1EC]' }} border-b border-[#BFD8C9]/60 transition-colors">
                            {{ $item->label }}
                        </a>
                    @endif
                @endforeach
            </div>

            <div class="pt-3 border-t border-[#BFD8C9] space-y-2.5">
                @if ($accountEnabled)
                    <!-- Account Access -->
                    <a href="{{ $accountUrl }}" 
                       @click="mobileOpen = false"
                       class="flex items-center justify-center w-full min-h-[44px] py-2.5 text-center text-xs font-bold uppercase tracking-wider text-[#0B3D2E] bg-[#FFFFFF] hover:bg-[#E8F1EC] rounded-lg border border-[#BFD8C9] transition-colors">
                        <svg class="w-4 h-4 mr-2 text-[#0B3D2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ $accountLabel }}</span>
                    </a>
                @endif

                @if ($mobileBookingVisible && $bookingEnabled)
                    <!-- Quick Booking CTA -->
                    <a href="{{ $bookingUrl }}" 
                       @click="mobileOpen = false"
                       class="flex items-center justify-center w-full min-h-[48px] py-3 text-center text-xs font-bold uppercase tracking-wider text-white bg-[#0B3D2E] hover:bg-[#145A43] active:bg-[#06281F] rounded-lg shadow border border-[#0B3D2E] active:scale-98 transition-transform">
                        <span>{{ $bookingLabel }}</span>
                        <svg class="w-4 h-4 ml-2 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    @endif
</header>
@endif
