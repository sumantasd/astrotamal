<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Homepage
            ['key' => 'homepage_devotional_heading', 'group' => 'homepage', 'label' => 'Bengali Devotional Heading', 'value' => 'জয় শ্রী গণেশ', 'type' => 'text'],
            ['key' => 'homepage_devotional_mantra', 'group' => 'homepage', 'label' => 'Bengali Devotional Mantra', 'value' => "ওঁ তৎপুরুষায় বিদ্মহে, বক্রতুণ্ডায় ধীমহি, তন্নো দন্তী প্রচোদয়াৎ॥\nওঁ শ্রী গণেশায় নমঃ॥", 'type' => 'textarea'],
            ['key' => 'homepage_hero_title', 'group' => 'homepage', 'label' => 'Hero Title', 'value' => 'Tamal Chakraborty', 'type' => 'text'],
            ['key' => 'homepage_hero_subtitle', 'group' => 'homepage', 'label' => 'Hero Subtitle', 'value' => 'Vedic Astrologer & Life Guidance Consultant', 'type' => 'text'],

            // Contact
            ['key' => 'contact_phone', 'group' => 'contact', 'label' => 'Contact Phone / WhatsApp', 'value' => '8392059201', 'type' => 'text'],
            ['key' => 'contact_email', 'group' => 'contact', 'label' => 'Contact Email', 'value' => 'ganesha4astro@gmail.com', 'type' => 'text'],
            ['key' => 'contact_chambers', 'group' => 'contact', 'label' => 'Chamber Locations', 'value' => 'Chamber 1: Kolkata | Chamber 2: Online Consultation Desk', 'type' => 'textarea'],

            // Branding
            ['key' => 'brand_name_bengali', 'group' => 'branding', 'label' => 'Bengali Brand Name', 'value' => 'তমাল চক্রবর্তী', 'type' => 'text'],
            ['key' => 'brand_name_english', 'group' => 'branding', 'label' => 'English Brand Name', 'value' => 'GANESHA ASTRO CONSULTANCY', 'type' => 'text'],
            ['key' => 'official_logo_path', 'group' => 'branding', 'label' => 'Official Logo Path', 'value' => 'images/astrotamal-logo.png', 'type' => 'text'],
            ['key' => 'official_favicon_path', 'group' => 'branding', 'label' => 'Official Favicon Path', 'value' => 'images/astrotamal-logo.png', 'type' => 'text'],

            // Social Media
            ['key' => 'social_facebook', 'group' => 'social', 'label' => 'Facebook Page URL', 'value' => 'https://facebook.com/astrotamal', 'type' => 'text'],
            ['key' => 'social_youtube', 'group' => 'social', 'label' => 'YouTube Channel URL', 'value' => 'https://youtube.com/@astrotamal', 'type' => 'text'],
            ['key' => 'social_instagram', 'group' => 'social', 'label' => 'Instagram URL', 'value' => 'https://instagram.com/astrotamal', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
