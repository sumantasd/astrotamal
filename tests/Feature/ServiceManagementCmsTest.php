<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceManagementCmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);
        $this->artisan('db:seed', ['--class' => 'ServicesContentSeeder']);
    }

    protected function getAdminUser(): User
    {
        return User::factory()->create([
            'is_admin' => true,
            'is_active' => true,
        ]);
    }

    public function test_existing_services_are_available()
    {
        $services = Service::all();
        $this->assertGreaterThan(0, $services->count());
        $this->assertTrue(Service::where('slug', 'birth-chart')->exists());
    }

    public function test_admin_can_access_service_edit_page()
    {
        $admin = $this->getAdminUser();
        $service = Service::where('slug', 'birth-chart')->first();

        $response = $this->actingAs($admin)->get(route('admin.services.edit', $service));
        $response->assertStatus(200);
        $response->assertSee('Edit: ' . $service->title);
    }

    public function test_admin_can_update_service_details_and_content()
    {
        $admin = $this->getAdminUser();
        $service = Service::where('slug', 'birth-chart')->first();

        $payload = [
            'title' => 'Vedic Birth Chart Analysis UPDATED',
            'slug' => 'birth-chart',
            'badge' => 'JANMA KUNDLI EXCELLENCE',
            'price' => 'Consultation',
            'duration' => '60 Mins',
            'short_description' => 'Updated short description text.',
            'full_description' => '<p>Updated full detailed description for Kundli.</p>',
            'is_active' => '1',
            'is_featured' => '1',
            'sort_order' => 1,

            'hero_eyebrow' => 'UPDATED HERO EYEBROW',
            'hero_title' => 'Updated Hero Title',
            'hero_description' => 'Updated Hero Description Text',
            'hero_visible' => '1',

            'intro_eyebrow' => 'UPDATED INTRO EYEBROW',
            'intro_heading' => 'Updated Intro Heading',
            'main_content_visible' => '1',

            'covers_eyebrow' => 'UPDATED SCOPE',
            'covers_title' => 'Updated Covers Scope',
            'covers_items' => [
                ['number' => '01', 'title' => 'Updated Lagna Card', 'description' => 'Desc for lagna card.']
            ],
            'covers_visible' => '1',

            'faqs_eyebrow' => 'UPDATED FAQ EYEBROW',
            'faqs_title' => 'Updated FAQ Title',
            'faqs_items' => [
                ['question' => 'What is the updated question?', 'answer' => 'This is the updated answer.']
            ],
            'faqs_visible' => '1',

            'cta_title' => 'Ready for Updated Kundli Session?',
            'cta_button_text' => 'BOOK UPDATED SESSION',
            'cta_visible' => '1',
        ];

        $response = $this->actingAs($admin)->put(route('admin.services.update', $service), $payload);
        $response->assertRedirect(route('admin.services.index'));

        $service->refresh();
        $this->assertEquals('Vedic Birth Chart Analysis UPDATED', $service->title);
        $this->assertEquals('Updated Hero Title', $service->hero_title);
        $this->assertEquals('Updated Lagna Card', $service->covers_items[0]['title']);

        // Check public page renders updated data
        $publicResponse = $this->get('/services/birth-chart');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('Vedic Birth Chart Analysis UPDATED');
        $publicResponse->assertSee('Updated Hero Title');
        $publicResponse->assertSee('Updated Lagna Card');
    }

    public function test_section_visibility_off_hides_section_on_public_page()
    {
        $service = Service::where('slug', 'birth-chart')->first();

        // Turn OFF hero section and faqs section
        $service->update([
            'hero_visible' => false,
            'faqs_visible' => false,
            'faqs_title' => 'UNIQUE_HIDDEN_FAQ_TITLE_XYZ',
            'hero_title' => 'UNIQUE_HIDDEN_HERO_TITLE_XYZ'
        ]);

        $response = $this->get('/services/birth-chart');
        $response->assertStatus(200);
        $response->assertDontSee('UNIQUE_HIDDEN_HERO_TITLE_XYZ');
        $response->assertDontSee('UNIQUE_HIDDEN_FAQ_TITLE_XYZ');

        // Turn ON again
        $service->update([
            'hero_visible' => true,
            'faqs_visible' => true,
        ]);

        $responseOn = $this->get('/services/birth-chart');
        $responseOn->assertStatus(200);
        $responseOn->assertSee('UNIQUE_HIDDEN_HERO_TITLE_XYZ');
        $responseOn->assertSee('UNIQUE_HIDDEN_FAQ_TITLE_XYZ');
    }

    public function test_inactive_service_is_hidden_from_public_list()
    {
        $service = Service::where('slug', 'birth-chart')->first();
        $service->update(['is_active' => false]);

        $response = $this->get('/services');
        $response->assertStatus(200);
        
        $activeServices = $response->viewData('services');
        $this->assertFalse($activeServices->contains('slug', 'birth-chart'));

        // Re-enable
        $service->update(['is_active' => true]);
    }
}
