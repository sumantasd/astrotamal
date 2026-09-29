<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminModulesTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_custom_admin_modules_render_for_authenticated_admin(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@astrotamal.com',
            'is_admin' => true,
            'is_active' => true,
        ]);

        $routes = [
            '/custom-admin/dashboard',
            '/custom-admin/profile',
            '/custom-admin/appointments',
            '/custom-admin/payments',
            '/custom-admin/payment-settings',
            '/custom-admin/blocked-slots',
            '/custom-admin/services',
            '/custom-admin/users',
            '/custom-admin/testimonials',
            '/custom-admin/faqs',
            '/custom-admin/contact-inquiries',
            '/custom-admin/horoscopes',
            '/custom-admin/horoscopes/create',
            '/custom-admin/horoscopes/signs',
            '/custom-admin/pages',
            '/custom-admin/pages/home/edit',
            '/custom-admin/pages/about/edit',
            '/custom-admin/pages/services/edit',
            '/custom-admin/settings',
            '/custom-admin/settings/general',
            '/custom-admin/settings/header',
            '/custom-admin/settings/footer',
            '/custom-admin/settings/seo',
            '/custom-admin/media',
            '/custom-admin/blogs',
            '/custom-admin/blogs/create',
        ];

        foreach ($routes as $url) {
            $response = $this->actingAs($admin)->get($url);
            $response->assertStatus(200);
        }
    }
}
