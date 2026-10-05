@php
    use App\Models\SiteSetting;
    use App\Models\NavigationItem;
    use Illuminate\Support\Facades\Route;

    // Seed defaults if table empty
    NavigationItem::seedDefaultsIfEmpty();

    $headerEnabled = SiteSetting::get('header_enabled', '1') == '1';
    $headerLogo = SiteSetting::get('header_logo', 'images/astrotamal-logo.png');
    $headerLogoWidth = SiteSetting::get('header_logo_width', '240');
    $headerLogoHeight = SiteSetting::get('header_logo_height', '48');
    $headerLogoLinkSetting = SiteSetting::get('header_logo_link', 'home');
    $logoUrl = Route::has($headerLogoLinkSetting) ? route($headerLogoLinkSetting) : url($headerLogoLinkSetting);

    $headerBgColor = SiteSetting::get('header_bg_color', '#F7F0E3');
    $headerTextColor = SiteSetting::get('header_text_color', '#29211F');
    $headerActiveColor = SiteSetting::get('header_active_color', '#541F1D');
    $headerBorderColor = SiteSetting::get('header_border_color', '#D8C6A8');
    $headerHeight = SiteSetting::get('header_height', '74px');
    $headerSticky = SiteSetting::get('header_sticky', '1') == '1';
    $headerShadow = SiteSetting::get('header_shadow', '1') == '1';

    // Actions
    $accountEnabled = SiteSetting::get('header_action_account_enabled', '1') == '1';
    $accountGuestLabel = SiteSetting::get('header_action_account_guest_label', 'Account');
    $accountAuthLabel = SiteSetting::get('header_action_account_auth_label', 'Dashboard');
    $accountUrl = auth()->check() 
        ? (auth()->user()->is_admin ? route('admin.dashboard') : route('account.dashboard')) 
        : route('account.login');
    $accountLabel = auth()->check() ? $accountAuthLabel : $accountGuestLabel;

    $bookingEnabled = SiteSetting::get('header_action_booking_enabled', '1') == '1';
    $bookingLabel = SiteSetting::get('header_action_booking_label', 'Quick Booking');
    $bookingUrlSetting = SiteSetting::get('header_action_booking_url', 'consultation.book');
    $bookingUrl = Route::has($bookingUrlSetting) ? route($bookingUrlSetting) : url($bookingUrlSetting);

    // Mobile
    $mobileHeaderEnabled = SiteSetting::get('mobile_header_enabled', '1') == '1';
    $mobileLogoWidth = SiteSetting::get('mobile_logo_width', '170');
    $mobileLogoHeight = SiteSetting::get('mobile_logo_height', '36');
    $mobileHamburgerEnabled = SiteSetting::get('mobile_hamburger_enabled', '1') == '1';
    $mobileMenuBg = SiteSetting::get('mobile_menu_bg', '#F7F0E3');
    $mobileMenuTextColor = SiteSetting::get('mobile_menu_text_color', '#29211F');
    $mobileMenuActiveColor = SiteSetting::get('mobile_menu_active_color', '#541F1D');
    $mobileAccountVisible = SiteSetting::get('mobile_account_visible', '1') == '1';
    $mobileBookingVisible = SiteSetting::get('mobile_booking_visible', '1') == '1';

    // Navigation Tree
    $navItems = NavigationItem::whereNull('parent_id')
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
        :class="scrolled ? 'border-b shadow-md py-1.5 sm:py-2' : 'border-b py-2 sm:py-2.5'"
        class="{{ $headerSticky ? 'fixed top-0 left-0 right-0 z-50' : 'relative z-50' }} transition-all duration-300 border-[{{ $headerBorderColor }}]">
    
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
        <nav class="flex items-center space-x-3.5 xl:space-x-5 text-xs xl:text-sm font-medium tracking-wide">
            @foreach ($navItems as $item)
                @if ($item->children->count() > 0)
                    <!-- Submenu Dropdown Container -->
                    <div x-data="{ dropdownOpen: false }" @mouseleave="dropdownOpen = false" class="relative py-1">
                        <button @click="dropdownOpen = !dropdownOpen" 
                                @mouseenter="dropdownOpen = true"
                                class="inline-flex items-center transition-colors hover:text-[{{ $headerActiveColor }}] whitespace-nowrap {{ $item->isActiveRoute() ? 'font-bold border-b-2 border-[#C49A45]' : '' }}"
                                style="color: {{ $item->isActiveRoute() ? $headerActiveColor : $headerTextColor }};">
                            <span>{{ $item->label }}</span>
                            <svg class="w-3.5 h-3.5 ml-1 transition-transform" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                             class="absolute left-0 mt-2 w-48 bg-[#FDFBF7] border border-[#D8C6A8] rounded-xl shadow-xl py-2 z-50">
                            @foreach ($item->children as $child)
                                <a href="{{ $child->computed_url }}" 
                                   target="{{ $child->target }}"
                                   class="block px-4 py-2 text-xs transition-colors hover:bg-[#EDE3D4] hover:text-[{{ $headerActiveColor }}] {{ $child->isActiveRoute() ? 'font-bold text-[#541F1D] bg-[#EDE3D4]/50' : 'text-[#29211F]' }}">
                                    {{ $child->label }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Standard Menu Link -->
                    <a href="{{ $item->computed_url }}" 
                       target="{{ $item->target }}"
                       class="transition-colors hover:opacity-80 py-1 whitespace-nowrap {{ $item->isActiveRoute() ? 'font-bold border-b-2 border-[#C49A45]' : '' }}"
                       style="color: {{ $item->isActiveRoute() ? $headerActiveColor : $headerTextColor }};">
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
                   class="inline-flex items-center space-x-1.5 text-xs xl:text-sm font-semibold text-[#541F1D] hover:text-[#351211] px-2.5 xl:px-3.5 py-2 rounded-lg bg-[#EDE3D4]/60 hover:bg-[#EDE3D4] border border-[#D8C6A8] transition-all whitespace-nowrap">
                    <svg class="w-4 h-4 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>{{ $accountLabel }}</span>
                </a>
            @endif

            @if ($bookingEnabled)
                <!-- Quick Booking Button -->
                <a href="{{ $bookingUrl }}" 
                   class="relative inline-flex items-center justify-center px-3.5 xl:px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-lg shadow-sm border border-[#D8C6A8] hover:border-[#C49A45] transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] whitespace-nowrap">
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
        <div class="lg:hidden flex items-center justify-between w-full max-w-7xl mx-auto px-4 sm:px-6 min-h-[56px] sm:min-h-[66px]">
            
            <!-- Left: Logo -->
            <a href="{{ $logoUrl }}" class="group flex items-center transition-opacity hover:opacity-95 py-0.5">
                <img src="{{ asset($headerLogo) }}" 
                     alt="তমাল চক্রবর্তী — Ganesha Astro Consultancy" 
                     style="max-width: {{ $mobileLogoWidth }}px; max-height: {{ $mobileLogoHeight }}px;"
                     class="h-8 xs:h-9 sm:h-10 w-auto object-contain" />
            </a>

            <!-- Right: Account Button/Icon & Hamburger Toggle -->
            <div class="flex items-center space-x-2 xs:space-x-3">
                @if ($mobileAccountVisible && $accountEnabled)
                    <a href="{{ $accountUrl }}" 
                       class="px-2.5 py-1.5 rounded-lg bg-[#EDE3D4] border border-[#D8C6A8] text-[#541F1D] flex items-center space-x-1 hover:border-[#C49A45] active:bg-[#D8C6A8] transition-all text-xs font-semibold shadow-2xs"
                       aria-label="Account">
                        <svg class="w-4 h-4 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="hidden xs:inline">{{ $accountLabel }}</span>
                    </a>
                @endif

                @if ($mobileHamburgerEnabled)
                    <!-- Hamburger Button -->
                    <button @click.stop="mobileOpen = !mobileOpen" 
                            type="button"
                            class="w-9 h-9 xs:w-10 xs:h-10 rounded-lg bg-[#EDE3D4] border border-[#D8C6A8] flex items-center justify-center text-[#541F1D] shadow-2xs hover:border-[#C49A45] active:bg-[#D8C6A8] focus:outline-none transition-all" 
                            :aria-expanded="mobileOpen ? 'true' : 'false'"
                            aria-label="Toggle Navigation Menu">
                        <svg class="w-5 h-5 text-[#541F1D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                @endif
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
             style="background-color: {{ $mobileMenuBg }} !important;"
             class="lg:hidden border-b border-[#D8C6A8] px-5 pt-3 pb-6 space-y-4 shadow-xl max-h-[calc(100vh-80px)] overflow-y-auto">
            
            <div class="flex flex-col space-y-1 font-medium text-base">
                @foreach ($navItems as $item)
                    @if ($item->children->count() > 0)
                        <div x-data="{ mobSubOpen: false }" class="border-b border-[#D8C6A8]/40 pb-1">
                            <button @click="mobSubOpen = !mobSubOpen" class="flex items-center justify-between w-full min-h-[44px] px-3 rounded-lg text-[#29211F] font-medium hover:bg-[#EDE3D4]/60">
                                <span>{{ $item->label }}</span>
                                <svg class="w-4 h-4 transition-transform" :class="mobSubOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="mobSubOpen" x-cloak class="pl-4 space-y-1 pt-1">
                                @foreach ($item->children as $child)
                                    <a href="{{ $child->computed_url }}" 
                                       target="{{ $child->target }}"
                                       @click="mobileOpen = false" 
                                       class="flex items-center min-h-[38px] px-3 rounded-lg text-sm {{ $child->isActiveRoute() ? 'text-[#541F1D] font-bold bg-[#EDE3D4]' : 'text-[#29211F] hover:bg-[#EDE3D4]/40' }}">
                                        ↳ {{ $child->label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $item->computed_url }}" 
                           target="{{ $item->target }}"
                           @click="mobileOpen = false" 
                           class="flex items-center min-h-[44px] px-3 rounded-lg {{ $item->isActiveRoute() ? 'text-[#541F1D] font-bold bg-[#EDE3D4]' : 'text-[#29211F] hover:text-[#541F1D] hover:bg-[#EDE3D4]/60' }} border-b border-[#D8C6A8]/40 transition-colors"
                           style="color: {{ $item->isActiveRoute() ? $mobileMenuActiveColor : $mobileMenuTextColor }};">
                            {{ $item->label }}
                        </a>
                    @endif
                @endforeach
            </div>

            <div class="pt-3 border-t border-[#D8C6A8] space-y-2.5">
                @if ($accountEnabled)
                    <!-- Account Access -->
                    <a href="{{ $accountUrl }}" 
                       @click="mobileOpen = false"
                       class="flex items-center justify-center w-full min-h-[44px] py-2.5 text-center text-xs font-bold uppercase tracking-wider text-[#541F1D] bg-[#EDE3D4] hover:bg-[#D8C6A8] rounded-lg border border-[#D8C6A8] transition-colors">
                        <svg class="w-4 h-4 mr-2 text-[#C49A45]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ $accountLabel }}</span>
                    </a>
                @endif

                @if ($mobileBookingVisible && $bookingEnabled)
                    <!-- Quick Booking CTA -->
                    <a href="{{ $bookingUrl }}" 
                       @click="mobileOpen = false"
                       class="flex items-center justify-center w-full min-h-[48px] py-3 text-center text-xs font-bold uppercase tracking-wider text-[#F7F0E3] bg-[#541F1D] hover:bg-[#351211] rounded-lg shadow border border-[#D8C6A8] active:scale-98 transition-transform">
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
