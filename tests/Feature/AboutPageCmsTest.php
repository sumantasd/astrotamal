<?php

namespace Tests\Feature;

use App\Models\AboutGuidanceItem;
use App\Models\CmsPage;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutPageCmsTest extends TestCase
{
    use RefreshDatabase;

    private function createAdminUser(): User
    {
        return User::create([
            'name' => 'Admin Test',
            'email' => 'admin.about@example.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
            'is_active' => true,
        ]);
    }

    /** @test */
    public function test_authenticated_admin_can_access_about_page_cms_editor()
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->get(route('admin.about.edit'));
        $response->assertStatus(200);
        $response->assertSee('About Page Management');
    }

    /** @test */
    public function test_unauthenticated_user_cannot_access_about_cms()
    {
        $response = $this->get(route('admin.about.edit'));
        $response->assertRedirect('/admin-tamal/login');
    }

    /** @test */
    public function test_admin_can_update_about_section_settings_and_visibility()
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->post(route('admin.about.settings.update'), [
            'about_hero_title' => 'Custom Hero Title Test',
            'about_hero_title_highlight' => 'Custom Highlight Test',
            'about_approach_heading' => 'Custom Approach Heading',
            'section_about_hero_active' => '1',
            'section_about_approach_active' => '1',
            'seo_title' => 'Custom About SEO Title',
        ]);

        $response->assertRedirect();

        $this->assertEquals('Custom Hero Title Test', SiteSetting::get('about_hero_title'));
        $this->assertEquals('Custom Highlight Test', SiteSetting::get('about_hero_title_highlight'));
        $this->assertEquals('Custom Approach Heading', SiteSetting::get('about_approach_heading'));

        $page = CmsPage::where('slug', 'about')->first();
        $this->assertEquals('Custom About SEO Title', $page->seo_title);
    }

    /** @test */
    public function test_admin_can_crud_about_guidance_cards()
    {
        $admin = $this->createAdminUser();

        // 1. Create
        $response = $this->actingAs($admin)->post(route('admin.about.guidance.store'), [
            'item_number' => '07',
            'title' => 'New Guidance Area',
            'description' => 'Test guidance description.',
            'display_order' => 7,
            'is_active' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('about_guidance_items', [
            'title' => 'New Guidance Area',
            'item_number' => '07',
        ]);

        $item = AboutGuidanceItem::where('title', 'New Guidance Area')->first();

        // 2. Update
        $response = $this->actingAs($admin)->put(route('admin.about.guidance.update', $item->id), [
            'item_number' => '07',
            'title' => 'Updated Guidance Area',
            'description' => 'Updated description text.',
            'display_order' => 7,
            'is_active' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('about_guidance_items', [
            'title' => 'Updated Guidance Area',
        ]);

        // 3. Delete
        $response = $this->actingAs($admin)->delete(route('admin.about.guidance.destroy', $item->id));
        $response->assertRedirect();
        $this->assertDatabaseMissing('about_guidance_items', [
            'id' => $item->id,
        ]);
    }

    /** @test */
    public function test_public_about_page_renders_dynamic_cms_content_and_guidance_items()
    {
        SiteSetting::set('about_hero_title', 'Dynamic Astrology Heading', 'about');
        AboutGuidanceItem::create([
            'item_number' => '01',
            'title' => 'Dynamic Card Title',
            'description' => 'Dynamic Card Description',
            'display_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get(route('about'));
        $response->assertStatus(200);
        $response->assertSee('Dynamic Astrology Heading');
        $response->assertSee('Dynamic Card Title');
        $response->assertSee('Dynamic Card Description');
    }
}
