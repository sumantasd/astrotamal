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
            '/admin-tamal/dashboard',
            '/admin-tamal/profile',
            '/admin-tamal/homepage',
            '/admin-tamal/appointments',
            '/admin-tamal/payments',
            '/admin-tamal/payment-settings',
            '/admin-tamal/blocked-slots',
            '/admin-tamal/services',
            '/admin-tamal/users',
            '/admin-tamal/testimonials',
            '/admin-tamal/faqs',
            '/admin-tamal/contact-inquiries',
            '/admin-tamal/horoscopes',
            '/admin-tamal/horoscopes/create',
            '/admin-tamal/horoscopes/signs',
            '/admin-tamal/pages',
            '/admin-tamal/pages/home/edit',
            '/admin-tamal/pages/about/edit',
            '/admin-tamal/pages/services/edit',
            '/admin-tamal/services-page',
            '/admin-tamal/settings',
            '/admin-tamal/settings/general',
            '/admin-tamal/settings/header',
            '/admin-tamal/settings/footer',
            '/admin-tamal/settings/seo',
            '/admin-tamal/media',
            '/admin-tamal/blogs',
            '/admin-tamal/blogs/create',
        ];

        foreach ($routes as $url) {
            $response = $this->actingAs($admin)->get($url);
            if ($url === '/admin-tamal/pages/home/edit') {
                $response->assertRedirect(route('admin.homepage.edit'));
            } elseif ($url === '/admin-tamal/pages/about/edit') {
                $response->assertRedirect(route('admin.about.edit'));
            } elseif ($url === '/admin-tamal/pages/services/edit') {
                $response->assertRedirect(route('admin.services-page.edit'));
            } else {
                $response->assertStatus(200);
            }
        }
    }
}
