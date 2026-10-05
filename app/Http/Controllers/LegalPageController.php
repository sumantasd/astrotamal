<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use Illuminate\Http\Request;

class LegalPageController extends Controller
{
    /**
     * Seed initial legal pages in cms_pages if missing.
     */
    public static function seedLegalPagesIfMissing(): void
    {
        $pages = [
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'seo_title' => 'Privacy Policy — Ganesha Astro Consultancy',
                'meta_description' => 'Privacy Policy for Ganesha Astro Consultancy & Tamal Chakraborty.',
                'content' => "<h2>Privacy Policy</h2><p>At Ganesha Astro Consultancy (astrotamal.com), we respect your privacy and are committed to protecting your personal information. When you book a Vedic consultation, register an account, or contact us, we collect details such as your name, date of birth, place of birth, email, and contact number solely for preparing accurate horoscope calculations and delivering consultation services.</p><p>We do not sell, rent, or share your personal information with third parties. Payment information is securely processed via PCI-DSS compliant payment gateways (Razorpay).</p>",
                'status' => 'published',
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-and-conditions',
                'seo_title' => 'Terms & Conditions — Ganesha Astro Consultancy',
                'meta_description' => 'Terms & Conditions for Ganesha Astro Consultancy services and consultations.',
                'content' => "<h2>Terms & Conditions</h2><p>Welcome to Ganesha Astro Consultancy. By accessing astrotamal.com or booking a consultation, you agree to these Terms & Conditions. Astrology readings and spiritual remedies provided by Tamal Chakraborty are intended for personal guidance and spiritual insight. Results may vary individually.</p><p>Booked consultation time slots are reserved specifically for you. Please join your consultation on time at your scheduled slot.</p>",
                'status' => 'published',
            ],
            [
                'title' => 'Refund Policy',
                'slug' => 'refund-policy',
                'seo_title' => 'Refund & Cancellation Policy — Ganesha Astro Consultancy',
                'meta_description' => 'Refund and cancellation guidelines for astrology consultation bookings.',
                'content' => "<h2>Refund Policy</h2><p>Thank you for choosing Ganesha Astro Consultancy. Consultation fee refunds or reschedules are handled under the following conditions:</p><ul><li>Cancellations requested at least 24 hours prior to the scheduled consultation time slot are eligible for rescheduling or refund.</li><li>Once a personal reading or consultation session has been conducted, fees are non-refundable.</li></ul>",
                'status' => 'published',
            ],
        ];

        foreach ($pages as $p) {
            if (!CmsPage::where('slug', $p['slug'])->exists()) {
                CmsPage::create($p);
            }
        }
    }

    public function privacyPolicy()
    {
        static::seedLegalPagesIfMissing();
        $page = CmsPage::where('slug', 'privacy-policy')->where('status', 'published')->firstOrFail();
        return view('pages.legal', compact('page'));
    }

    public function termsConditions()
    {
        static::seedLegalPagesIfMissing();
        $page = CmsPage::where('slug', 'terms-and-conditions')->where('status', 'published')->firstOrFail();
        return view('pages.legal', compact('page'));
    }

    public function refundPolicy()
    {
        static::seedLegalPagesIfMissing();
        $page = CmsPage::where('slug', 'refund-policy')->where('status', 'published')->firstOrFail();
        return view('pages.legal', compact('page'));
    }
}
