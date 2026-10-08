@php
    use App\Models\SiteSetting;
    use App\Models\FooterNavItem;
    use App\Models\FooterGuidanceItem;
    use App\Models\FooterSocialLink;
    use App\Models\CmsPage;
    use App\Http\Controllers\LegalPageController;

    FooterNavItem::seedDefaultsIfEmpty();
    FooterGuidanceItem::seedDefaultsIfEmpty();
    FooterSocialLink::seedDefaultsIfEmpty();
    LegalPageController::seedLegalPagesIfMissing();

    $footerEnabled = SiteSetting::get('footer_enabled', '1') == '1';
    $footerLogo = SiteSetting::get('footer_logo', 'images/astrotamal-logo.png');
    $footerLogoWidth = SiteSetting::get('footer_logo_width', '260');
    $footerLogoVisible = SiteSetting::get('footer_logo_visible', '1') == '1';
    $footerDescription = SiteSetting::get('footer_description', "Empowering individuals globally with ancient Vedic wisdom, accurate birth chart readings, and practical spiritual remedies for life's challenges.");

    // Column Titles & Visibility
    $col1Enabled = SiteSetting::get('footer_col1_enabled', '1') == '1';
    $col2Title = SiteSetting::get('footer_col2_title', 'Quick Navigation');
    $col2Enabled = SiteSetting::get('footer_col2_enabled', '1') == '1';
    $col3Title = SiteSetting::get('footer_col3_title', 'Our Guidance');
    $col3Enabled = SiteSetting::get('footer_col3_enabled', '1') == '1';
    $col4Title = SiteSetting::get('footer_col4_title', 'Consultation Office');
    $col4Enabled = SiteSetting::get('footer_col4_enabled', '1') == '1';

    // Contact Details
    $contactBrand = SiteSetting::get('footer_contact_brand', 'Ganesha Astro Consultancy');
    $contactPhone = SiteSetting::get('footer_contact_phone', '8392059201');
    $contactWhatsApp = SiteSetting::get('footer_contact_whatsapp', '8392059201');
    $contactEmail = SiteSetting::get('footer_contact_email', 'ganesha4astro@gmail.com');
    $contactAddress = SiteSetting::get('footer_contact_address', 'Kolkata | Bongaon | Ranaghat & More');
    $contactWebsite = SiteSetting::get('footer_contact_website', 'astrotamal.com');
    $contactMapUrl = SiteSetting::get('footer_contact_map_url', '');

    // Copyright
    $copyrightEnabled = SiteSetting::get('footer_copyright_enabled', '1') == '1';
    $rawCopyright = SiteSetting::get('footer_copyright_text', '© {current_year} Ganesha Astro Consultancy. All Rights Reserved.');
    $copyrightText = str_replace(['{current_year}', '{year}'], date('Y'), $rawCopyright);

    // Dynamic Collections
    $navItems = FooterNavItem::where('is_active', true)->orderBy('sort_order')->get();
    $guidanceItems = FooterGuidanceItem::where('is_active', true)->orderBy('sort_order')->get();
    $socialLinks = FooterSocialLink::where('is_active', true)->orderBy('sort_order')->get();
    $legalPages = CmsPage::whereIn('slug', ['privacy-policy', 'terms-and-conditions', 'refund-policy'])
        ->where('status', 'published')
        ->get();
@endphp

@if($footerEnabled)
<!-- ==========================================
     SITE FOOTER (Darkest Green #06281F Theme)
     ========================================== -->
<footer class="pt-16 pb-8 relative overflow-hidden text-[#DDE8E2]" style="background-color: #06281F !important; color: #DDE8E2 !important;">
    
    <!-- Subtle Background Zodiac Radial Glow -->
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-[#C49A45]/5 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Fine Celestial Line Accent -->
    <div class="absolute top-10 right-10 w-48 h-48 opacity-[0.06] pointer-events-none">
        <svg viewBox="0 0 200 200" class="w-full h-full text-[#C49A45] stroke-current fill-none">
            <circle cx="100" cy="100" r="90" stroke-dasharray="4 4"/>
            <circle cx="100" cy="100" r="60"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 pb-14 border-b border-[#D8CDBD]/20">
            
            {{-- Col 1: Brand Info & Social --}}
            @if($col1Enabled || $footerLogoVisible)
                <div class="space-y-4">
                    @if($footerLogoVisible)
                        <a href="{{ route('home') }}" class="group flex items-center transition-opacity hover:opacity-95">
                            <img src="{{ asset($footerLogo) }}" 
                                 alt="{{ $contactBrand }}" 
                                 style="max-width: {{ $footerLogoWidth }}px;"
                                 class="h-12 sm:h-14 lg:h-16 w-auto object-contain brightness-105" />
                        </a>
                    @endif
                    @if($col1Enabled)
                        <p class="text-xs text-[#DDE8E2] leading-relaxed">
                            {{ $footerDescription }}
                        </p>
                    @endif
                    
                    <!-- Dynamic Social Media Icons -->
                    @if($col1Enabled && $socialLinks->isNotEmpty())
                        <div class="flex items-center space-x-3 pt-2">
                            @foreach ($socialLinks as $s)
                                @php
                                    $pName = strtolower($s->platform);
                                @endphp
                                <a href="{{ $s->url }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   title="{{ $s->platform }}"
                                   class="w-9 h-9 rounded-full bg-[#0B3D2E] border border-[#D8CDBD]/30 flex items-center justify-center text-[#F7F0E3] hover:text-[#C49A45] hover:border-[#C49A45] transition-all">
                                    <span class="sr-only">{{ $s->platform }}</span>
                                    @if(str_contains($pName, 'facebook'))
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                                    @elseif(str_contains($pName, 'instagram'))
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    @elseif(str_contains($pName, 'youtube'))
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                    @elseif(str_contains($pName, 'whatsapp'))
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    @elseif(str_contains($pName, 'twitter') || str_contains($pName, 'x'))
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    @elseif(str_contains($pName, 'linkedin'))
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                                    @else
                                        <span class="text-xs font-bold">{{ strtoupper(substr($s->platform, 0, 1)) }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            {{-- Col 2: Quick Navigation --}}
            @if($col2Enabled)
                <div>
                    <h4 class="font-serif-luxury text-lg font-semibold text-[#C49A45] tracking-wide border-b border-[#D8CDBD]/25 pb-2 mb-4 inline-block">{{ $col2Title }}</h4>
                    <ul class="space-y-2.5 text-xs text-[#F7F0E3]">
                        @foreach ($navItems as $item)
                            <li>
                                <a href="{{ $item->computed_url }}" 
                                   target="{{ $item->target }}"
                                   class="hover:text-[#C49A45] transition-colors flex items-center">
                                    <span class="text-[#C49A45] mr-2">›</span> {{ $item->label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Col 3: Our Guidance --}}
            @if($col3Enabled)
                <div>
                    <h4 class="font-serif-luxury text-lg font-semibold text-[#C49A45] tracking-wide border-b border-[#D8CDBD]/25 pb-2 mb-4 inline-block">{{ $col3Title }}</h4>
                    <ul class="space-y-2.5 text-xs text-[#F7F0E3]">
                        @foreach ($guidanceItems as $g)
                            <li>
                                <a href="{{ $g->computed_url }}" 
                                   target="{{ $g->target }}"
                                   class="hover:text-[#C49A45] transition-colors">
                                    {{ $g->label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Col 4: Consultation Office / Contact Info --}}
            @if($col4Enabled)
                <div class="space-y-3">
                    <h4 class="font-serif-luxury text-lg font-semibold text-[#C49A45] tracking-wide border-b border-[#D8CDBD]/25 pb-2 mb-4 inline-block">{{ $col4Title }}</h4>
                    <div class="text-xs space-y-3 text-[#F7F0E3]">
                        <!-- Address -->
                        @if(!empty($contactAddress))
                            <p class="flex items-start space-x-3">
                                <svg class="w-4 h-4 text-[#C49A45] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                @if(!empty($contactMapUrl))
                                    <a href="{{ $contactMapUrl }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#C49A45] transition-colors">{{ $contactAddress }}</a>
                                @else
                                    <span>{{ $contactAddress }}</span>
                                @endif
                            </p>
                        @endif

                        <!-- Phone -->
                        @if(!empty($contactPhone))
                            <p class="flex items-center space-x-3">
                                <svg class="w-4 h-4 text-[#C49A45] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $contactPhone) }}" class="hover:text-[#C49A45] transition-colors">{{ $contactPhone }}</a>
                            </p>
                        @endif

                        <!-- Email -->
                        @if(!empty($contactEmail))
                            <p class="flex items-center space-x-3">
                                <svg class="w-4 h-4 text-[#C49A45] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <a href="mailto:{{ $contactEmail }}" class="hover:text-[#C49A45] transition-colors">{{ $contactEmail }}</a>
                            </p>
                        @endif

                        <!-- Website -->
                        @if(!empty($contactWebsite))
                            <p class="flex items-center space-x-3">
                                <svg class="w-4 h-4 text-[#C49A45] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                <a href="https://{{ ltrim($contactWebsite, 'http://https://') }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#C49A45] transition-colors">{{ $contactWebsite }}</a>
                            </p>
                        @endif
                    </div>
                </div>
            @endif

        </div>

        <!-- Copyright & Legal -->
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-[#DDE8E2]/80 space-y-4 md:space-y-0">
            @if($copyrightEnabled)
                <div>
                    {{ $copyrightText }}
                </div>
            @else
                <div></div>
            @endif

            <!-- Legal Pages Links -->
            @if($legalPages->isNotEmpty())
                <div class="flex items-center space-x-6 flex-wrap justify-center">
                    @foreach ($legalPages as $page)
                        <a href="{{ url($page->slug) }}" class="hover:text-[#C49A45] transition-colors">
                            {{ $page->title }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</footer>
@endif
