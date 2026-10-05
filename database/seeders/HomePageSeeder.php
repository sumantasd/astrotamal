<?php

namespace Database\Seeders;

use App\Models\HomeFeature;
use App\Models\HomeVideo;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Default Home Videos if none exist
        if (HomeVideo::count() === 0) {
            $defaultVideos = [
                [
                    'title' => 'Understanding your birth chart',
                    'tag' => 'Kundli basics',
                    'video_url' => 'https://www.youtube.com/watch?v=bYtG72jD2pE',
                    'thumbnail' => 'https://img.youtube.com/vi/bYtG72jD2pE/hqdefault.jpg',
                    'display_order' => 1,
                    'is_active' => true,
                ],
                [
                    'title' => 'Ganesha mantra & its meaning',
                    'tag' => 'Devotional',
                    'video_url' => 'https://www.youtube.com/watch?v=5gZtQkX0uW8',
                    'thumbnail' => 'https://img.youtube.com/vi/5gZtQkX0uW8/hqdefault.jpg',
                    'display_order' => 2,
                    'is_active' => true,
                ],
                [
                    'title' => 'Remedies explained simply',
                    'tag' => 'Remedy',
                    'video_url' => 'https://www.youtube.com/watch?v=4vW7gW2d5X8',
                    'thumbnail' => 'https://img.youtube.com/vi/4vW7gW2d5X8/hqdefault.jpg',
                    'display_order' => 3,
                    'is_active' => true,
                ],
                [
                    'title' => 'Career & Job Guidance Astrological Remedies',
                    'tag' => 'Career Guidance',
                    'video_url' => 'https://www.youtube.com/watch?v=9xV8wQ6m5z0',
                    'thumbnail' => 'https://img.youtube.com/vi/9xV8wQ6m5z0/hqdefault.jpg',
                    'display_order' => 4,
                    'is_active' => true,
                ],
                [
                    'title' => 'Understanding Zodiac Signs & House Positions',
                    'tag' => 'Zodiac Analysis',
                    'video_url' => 'https://www.youtube.com/watch?v=7yR3tQ9k8W2',
                    'thumbnail' => 'https://img.youtube.com/vi/7yR3tQ9k8W2/hqdefault.jpg',
                    'display_order' => 5,
                    'is_active' => true,
                ],
                [
                    'title' => 'Spiritual Remedies for Planetary Dasha Cycles',
                    'tag' => 'Spiritual Remedies',
                    'video_url' => 'https://www.youtube.com/watch?v=3wV5gH8j9K1',
                    'thumbnail' => 'https://img.youtube.com/vi/3wV5gH8j9K1/hqdefault.jpg',
                    'display_order' => 6,
                    'is_active' => true,
                ],
            ];

            foreach ($defaultVideos as $v) {
                HomeVideo::create($v);
            }
        }

        // 2. Seed Default Home Features if none exist
        if (HomeFeature::count() === 0) {
            $defaultFeatures = [
                ['icon' => 'book', 'title' => 'Vedic Astrology', 'description' => 'Authentic Knowledge', 'display_order' => 1, 'is_active' => true],
                ['icon' => 'shield', 'title' => 'Personalized Guidance', 'description' => 'Solutions for Your Life', 'display_order' => 2, 'is_active' => true],
                ['icon' => 'lock', 'title' => 'Confidential & Secure', 'description' => 'Your Privacy Is Priority', 'display_order' => 3, 'is_active' => true],
                ['icon' => 'remedy', 'title' => 'Practical Remedies', 'description' => 'Easy & Effective', 'display_order' => 4, 'is_active' => true],
                ['icon' => 'globe', 'title' => 'Global Consultation', 'description' => 'Serving Worldwide', 'display_order' => 5, 'is_active' => true],
            ];

            foreach ($defaultFeatures as $f) {
                HomeFeature::create($f);
            }
        }

        // 3. Seed Default Section Visibility & Home Settings
        $defaults = [
            'homepage_hero_eyebrow' => 'AUDIO CONSULTATION',
            'homepage_hero_heading' => 'জয় শ্রী গণেশ',
            'homepage_hero_mantra' => "ওঁ তৎপুরুষায় বিদ্মহে,\nবক্রতুণ্ডায় ধীমহি।\nতন্নো দন্তী প্রচোদয়াৎ।",
            'homepage_hero_description' => 'Auspicious Vedic guidance & remedies by Astrologer Tamal Chakraborty.',
            'homepage_hero_primary_btn_text' => 'QUICK BOOKING',
            'homepage_hero_primary_btn_url' => '/book-consultation',
            'homepage_hero_secondary_btn_text' => 'Explore services',
            'homepage_hero_secondary_btn_url' => '/services',
            'homepage_hero_stat1_number' => '15+',
            'homepage_hero_stat1_label' => 'Years Experience',
            'homepage_hero_stat2_number' => '10,000+',
            'homepage_hero_stat2_label' => 'Satisfied Clients',
            'homepage_hero_stat3_number' => '100%',
            'homepage_hero_stat3_label' => 'Confidential',

            'homepage_qb_eyebrow' => 'BOOKING',
            'homepage_qb_heading' => 'QUICK BOOKING',
            'homepage_qb_description' => 'Select your preferred consultation package.',
            'homepage_qb_urgent_title' => 'URGENT CONSULTATION',
            'homepage_qb_urgent_price' => '₹5,000',
            'homepage_qb_normal_title' => 'NORMAL CONSULTATION',
            'homepage_qb_normal_price' => '₹3,000',

            'homepage_videos_eyebrow' => '🎬  LATEST VIDEOS',
            'homepage_videos_heading' => 'From the consultation room',
            'homepage_videos_btn_text' => 'View all videos →',

            'homepage_pf_eyebrow' => 'CONTACT',
            'homepage_pf_heading' => 'Contact Ganesha Astro Consultancy',
            'homepage_pf_description' => 'Feel free to reach out to our desk support team for any queries.',
            'homepage_pf_call_text' => 'Call 8392059201',
            'homepage_pf_whatsapp_text' => 'WhatsApp 8392059201',
            'homepage_pf_email_text' => 'Email ganesha4astro@gmail.com',

            'section_hero_active' => '1',
            'section_features_active' => '1',
            'section_quick_booking_active' => '1',
            'section_videos_active' => '1',
            'section_pre_footer_active' => '1',
        ];

        foreach ($defaults as $k => $v) {
            if (SiteSetting::get($k) === null) {
                SiteSetting::set($k, $v, 'homepage');
            }
        }
    }
}
