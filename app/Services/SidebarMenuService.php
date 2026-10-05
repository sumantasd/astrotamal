<?php

namespace App\Services;

use App\Models\SiteSetting;

class SidebarMenuService
{
    /**
     * Get default menu definitions with group labels and child items.
     */
    public static function getMenuDefinitions(): array
    {
        return [
            'dashboard' => [
                'label' => 'Dashboard',
                'items' => [
                    'main' => 'Dashboard',
                ],
            ],
            'bookings' => [
                'label' => 'Bookings & Revenue',
                'items' => [
                    'appointments' => 'Appointments',
                    'blocked_slots' => 'Blocked Dates & Slots',
                    'booking_schedule' => 'Booking Time Schedule',
                    'payments' => 'Payments & Transactions',
                    'payment_settings' => 'Payment Gateway Settings',
                ],
            ],
            'astrology' => [
                'label' => 'Astrology Services',
                'items' => [
                    'services' => 'Services Management',
                    'horoscopes' => 'Horoscope Management',
                    'daily_horoscope' => 'Daily Horoscope',
                    'weekly_horoscope' => 'Weekly / Monthly / Yearly',
                    'zodiac_signs' => 'Zodiac Signs',
                ],
            ],
            'content' => [
                'label' => 'Website Content',
                'items' => [
                    'page_manager' => 'Page & Section Manager',
                    'homepage' => 'Home Page Management',
                    'about_page' => 'About Page Editor',
                    'services_page' => 'Services Page Editor',
                    'shop' => 'Shop Management',
                    'blogs' => 'Blog Management',
                    'media' => 'Gallery & Videos',
                    'testimonials' => 'Testimonials',
                    'faqs' => 'FAQs',
                    'inquiries' => 'Contact Inquiries',
                ],
            ],
            'config' => [
                'label' => 'Website Configuration',
                'items' => [
                    'header' => 'Header & Navigation',
                    'footer' => 'Footer Manager',
                    'general' => 'General Settings',
                    'seo' => 'SEO Settings',
                ],
            ],
            'admin' => [
                'label' => 'Administration',
                'items' => [
                    'users' => 'Admin Users',
                    'profile' => 'My Profile & Security',
                    'sidebar_settings' => 'Sidebar Menu Visibility',
                    'backups' => 'Backup & Restore',
                    'view_website' => 'View Live Website',
                ],
            ],
        ];
    }

    /**
     * Get active visibility array.
     */
    public static function getVisibility(): array
    {
        $raw = SiteSetting::get('sidebar_menu_visibility');
        if (empty($raw)) {
            return [];
        }

        $decoded = json_decode($raw, true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Save visibility settings into database.
     */
    public static function setVisibility(array $visibility): void
    {
        SiteSetting::set('sidebar_menu_visibility', json_encode($visibility), 'admin');
    }

    /**
     * Check if a parent group is visible.
     */
    public static function isGroupVisible(string $groupKey): bool
    {
        $visibility = self::getVisibility();
        if (isset($visibility['groups'][$groupKey])) {
            return (bool) $visibility['groups'][$groupKey];
        }

        return true; // Default ON
    }

    /**
     * Check if a child menu item is visible.
     */
    public static function isItemVisible(string $groupKey, string $itemKey): bool
    {
        if (!self::isGroupVisible($groupKey)) {
            return false;
        }

        $visibility = self::getVisibility();
        if (isset($visibility['items'][$groupKey][$itemKey])) {
            return (bool) $visibility['items'][$groupKey][$itemKey];
        }

        return true; // Default ON
    }
}
