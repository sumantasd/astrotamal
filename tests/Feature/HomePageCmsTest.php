<?php

namespace Tests\Feature;

use App\Models\HomeFeature;
use App\Models\HomeVideo;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageCmsTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin@astrotamal.com',
            'is_admin' => true,
            'is_active' => true,
        ]);
    }

    public function test_authenticated_admin_can_access_homepage_cms_editor(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.homepage.edit'));

        $response->assertStatus(200);
        $response->assertSee('Home Page Management');
        $response->assertSee('Latest Videos');
    }

    public function test_unauthenticated_user_cannot_access_homepage_cms(): void
    {
        $response = $this->get(route('admin.homepage.edit'));

        $response->assertRedirect('/admin-tamal/login');
    }

    public function test_admin_can_update_homepage_section_settings_and_visibility(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.homepage.settings.update'), [
            'section_hero_active' => '1',
            'section_features_active' => '1',
            'section_quick_booking_active' => '1',
            'section_videos_active' => '1',
            'section_pre_footer_active' => '1',
            'homepage_hero_eyebrow' => 'CUSTOM VEDIC ASTROLOGY',
            'homepage_hero_heading' => 'Custom Ganesha Title',
            'homepage_videos_eyebrow' => 'SPECIAL VIDEOS',
            'homepage_videos_heading' => 'From the master classroom',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertEquals('CUSTOM VEDIC ASTROLOGY', SiteSetting::get('homepage_hero_eyebrow'));
        $this->assertEquals('Custom Ganesha Title', SiteSetting::get('homepage_hero_heading'));
        $this->assertEquals('SPECIAL VIDEOS', SiteSetting::get('homepage_videos_eyebrow'));
        $this->assertEquals('From the master classroom', SiteSetting::get('homepage_videos_heading'));

        // Check Home Page renders custom values
        $homeResponse = $this->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('CUSTOM VEDIC ASTROLOGY');
        $homeResponse->assertSee('Custom Ganesha Title');
        $homeResponse->assertSee('SPECIAL VIDEOS');
    }

    public function test_admin_can_crud_latest_video_cards(): void
    {
        // 1. Store Video
        $storeResponse = $this->actingAs($this->admin)->post(route('admin.homepage.videos.store'), [
            'title' => 'Understanding your birth chart',
            'tag' => 'Kundli Basics',
            'video_url' => 'https://www.youtube.com/watch?v=bYtG72jD2pE',
            'display_order' => 1,
            'is_active' => '1',
            'thumbnail_url' => 'https://img.youtube.com/vi/bYtG72jD2pE/hqdefault.jpg',
        ]);

        $storeResponse->assertRedirect();
        $this->assertDatabaseHas('home_videos', [
            'title' => 'Understanding your birth chart',
            'tag' => 'Kundli Basics',
            'video_url' => 'https://www.youtube.com/watch?v=bYtG72jD2pE',
            'display_order' => 1,
            'is_active' => true,
        ]);

        $video = HomeVideo::where('title', 'Understanding your birth chart')->first();

        // 2. Update Video
        $updateResponse = $this->actingAs($this->admin)->put(route('admin.homepage.videos.update', $video->id), [
            'title' => 'Updated Birth Chart Analysis',
            'tag' => 'Advanced Kundli',
            'video_url' => 'https://www.youtube.com/watch?v=bYtG72jD2pE',
            'display_order' => 2,
            'is_active' => '1',
            'thumbnail_url' => 'https://img.youtube.com/vi/bYtG72jD2pE/hqdefault.jpg',
        ]);

        $updateResponse->assertRedirect();
        $this->assertDatabaseHas('home_videos', [
            'id' => $video->id,
            'title' => 'Updated Birth Chart Analysis',
            'tag' => 'Advanced Kundli',
            'display_order' => 2,
        ]);

        // 3. Verify Home Page displays the image-based card (no embedded player)
        $homeResponse = $this->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Updated Birth Chart Analysis');
        $homeResponse->assertSee('Advanced Kundli');
        $homeResponse->assertSee('WATCH VIDEO');
        $homeResponse->assertDontSee('<iframe', false);

        // 4. Delete Video
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.homepage.videos.destroy', $video->id));
        $deleteResponse->assertRedirect();
        $this->assertDatabaseMissing('home_videos', ['id' => $video->id]);
    }

    public function test_home_page_shows_maximum_6_active_videos_sorted_by_display_order(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            HomeVideo::create([
                'title' => 'Video Title ' . $i,
                'tag' => 'Category ' . $i,
                'video_url' => 'https://youtube.com/watch?v=demo' . $i,
                'thumbnail' => 'https://img.youtube.com/vi/demo' . $i . '/hqdefault.jpg',
                'display_order' => $i,
                'is_active' => true,
            ]);
        }

        $response = $this->get(route('home'));
        $response->assertStatus(200);

        // First 6 videos should be visible
        for ($i = 1; $i <= 6; $i++) {
            $response->assertSee('Video Title ' . $i);
        }

        // 7th to 10th videos should not appear on Home Page
        for ($i = 7; $i <= 10; $i++) {
            $response->assertDontSee('Video Title ' . $i);
        }
    }
}
