<!-- ==========================================
     COMPACT PRE-FOOTER / CONTACT CTA SECTION
     ========================================== -->
@if(\App\Models\SiteSetting::get('section_pre_footer_active', '1') == '1')
@php
    $phone = \App\Models\SiteSetting::get('contact_phone', '8392059201');
    $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
    $whatsapp = \App\Models\SiteSetting::get('whatsapp_number', '8392059201');
    $cleanWhatsapp = preg_replace('/[^0-9]/', '', $whatsapp);
    $email = \App\Models\SiteSetting::get('contact_email', 'ganesha4astro@gmail.com');
    $siteName = \App\Models\SiteSetting::get('site_name', 'Ganesha Astro Consultancy');
@endphp
<section class="bg-[#E8F1EC] text-[#17211D] py-6 lg:py-7 border-t border-[#C8D8CF] relative w-full overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-5 lg:gap-8">
            
            <!-- Left Side: Eyebrow + Contact Heading -->
            <div class="flex flex-col shrink-0">
                <span class="text-xs font-semibold uppercase tracking-[0.25em] text-[#C49A45] block mb-1">
                    {{ \App\Models\SiteSetting::get('homepage_pf_eyebrow', 'CONTACT') }}
                </span>
                <h2 class="font-serif-luxury text-xl sm:text-2xl lg:text-[28px] font-bold text-[#0B3D2E] leading-none flex items-center gap-3 whitespace-nowrap">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#0B3D2E] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.06-.24c1.12.37 2.33.57 3.53.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.2.2 2.41.57 3.53a1 1 0 01-.24 1.06l-2.2 2.2z"/>
                    </svg>
                    <span>{{ \App\Models\SiteSetting::get('homepage_pf_heading', 'Contact ' . $siteName) }}</span>
                </h2>
            </div>

            <!-- Right Side: 3 Compact Pill Buttons (Call, WhatsApp, Email) -->
            <div class="flex flex-wrap sm:flex-nowrap items-center gap-3 shrink-0">
                
                <!-- 1. Call Button -->
                <a href="tel:{{ $cleanPhone }}" 
                   class="inline-flex items-center justify-center gap-2 h-[44px] px-5 sm:px-6 rounded-full bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] text-sm font-semibold border border-[#0B3D2E] shadow-xs transition-colors whitespace-nowrap shrink-0">
                    <svg class="w-4 h-4 text-[#C49A45] shrink-0 fill-current" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.06-.24c1.12.37 2.33.57 3.53.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.2.2 2.41.57 3.53a1 1 0 01-.24 1.06l-2.2 2.2z"/>
                    </svg>
                    <span>Call</span>
                </a>

                <!-- 2. WhatsApp Button -->
                <a href="https://wa.me/91{{ $cleanWhatsapp }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="inline-flex items-center justify-center gap-2 h-[44px] px-5 sm:px-6 rounded-full bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] text-sm font-semibold border border-[#0B3D2E] transition-colors whitespace-nowrap shrink-0">
                    <svg class="w-4 h-4 text-[#C49A45] shrink-0 fill-current" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.011 2c-5.506 0-9.969 4.463-9.969 9.969 0 1.763.459 3.487 1.332 5.006l-1.416 5.17 5.291-1.388c1.474.804 3.136 1.226 4.762 1.226 5.507 0 9.97-4.463 9.97-9.969 0-5.506-4.463-9.969-9.97-9.969zm5.461 12.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414-.074-.124-.272-.198-.57-.347z"/>
                    </svg>
                    <span>WhatsApp</span>
                </a>

                <!-- 3. Email Button -->
                <a href="mailto:{{ $email }}" 
                   class="inline-flex items-center justify-center gap-2 h-[44px] px-5 sm:px-6 rounded-full bg-[#0B3D2E] hover:bg-[#145A43] text-[#FFFFFF] text-sm font-semibold border border-[#0B3D2E] transition-colors whitespace-nowrap shrink-0">
                    <svg class="w-4 h-4 text-[#C49A45] shrink-0 fill-current" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                    <span>Email</span>
                </a>

            </div>

        </div>
    </div>
</section>
@endif
