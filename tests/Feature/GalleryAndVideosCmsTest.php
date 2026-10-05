<?php

namespace Tests\Feature;

use App\Models\MediaItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryAndVideosCmsTest extends TestCase
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

    /** TEST A: Admin creates Image media with publish_gallery = 1 -> appears on /gallery */
    public function test_admin_can_create_image_and_publish_to_gallery(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('gallery_event.jpg');

        $response = $this->actingAs($this->admin)->post(route('admin.media.store'), [
            'title' => 'Consultation Event Photo',
            'caption' => 'Sanctuary',
            'type' => 'image',
            'media_file' => $file,
            'is_published' => '1',
            'publish_gallery' => '1',
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.media.index'));

        $this->assertDatabaseHas('media_items', [
            'title' => 'Consultation Event Photo',
            'type' => 'image',
            'is_published' => true,
            'publish_gallery' => true,
        ]);

        $galleryResponse = $this->get(route('gallery'));
        $galleryResponse->assertStatus(200);
        $galleryResponse->assertSee('Consultation Event Photo');
    }

    /** TEST A2: Image with publish_gallery = 0 does NOT appear on /gallery */
    public function test_image_with_publish_gallery_off_does_not_appear_on_gallery(): void
    {
        MediaItem::create([
            'title' => 'Unpublished Gallery Photo',
            'type' => 'image',
            'url' => 'https://example.com/unpub.jpg',
            'is_published' => true,
            'publish_gallery' => false,
        ]);

        $galleryResponse = $this->get(route('gallery'));
        $galleryResponse->assertStatus(200);
        $galleryResponse->assertDontSee('Unpublished Gallery Photo');
    }

    /** TEST B: YouTube video with publish_videos = 1 AND show_on_home = 1 -> appears on /videos AND Home */
    public function test_youtube_video_published_to_videos_and_home_appears_on_both(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.media.store'), [
            'title' => 'তুলা রাশি: ২০২৬ অক্টোবর Horoscope Talk',
            'tag' => 'Astrologer Tamal Chakraborty',
            'type' => 'youtube',
            'url' => 'https://www.youtube.com/watch?v=bYtG72jD2pE',
            'is_published' => '1',
            'publish_videos' => '1',
            'show_on_home' => '1',
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.media.index'));

        $this->assertDatabaseHas('media_items', [
            'title' => 'তুলা রাশি: ২০২৬ অক্টোবর Horoscope Talk',
            'type' => 'youtube',
            'is_published' => true,
            'publish_videos' => true,
            'show_on_home' => true,
        ]);

        // Check /videos page
        $videosResponse = $this->get(route('videos'));
        $videosResponse->assertStatus(200);
        $videosResponse->assertSee('তুলা রাশি: ২০২৬ অক্টোবর Horoscope Talk');

        // Check Home Page Latest Videos
        $homeResponse = $this->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('তুলা রাশি: ২০২৬ অক্টোবর Horoscope Talk');
    }

    /** TEST C: YouTube video with publish_videos = 1 AND show_on_home = 0 -> appears on /videos but NOT Home */
    public function test_youtube_video_with_home_off_appears_on_videos_but_not_home(): void
    {
        $media = MediaItem::create([
            'title' => 'Videos Page Only Talk',
            'tag' => 'Jyotish Lecture',
            'type' => 'youtube',
            'url' => 'https://www.youtube.com/watch?v=5gZtQkX0uW8',
            'is_published' => true,
            'publish_videos' => true,
            'show_on_home' => false,
            'sort_order' => 1,
        ]);

        $videosResponse = $this->get(route('videos'));
        $videosResponse->assertSee('Videos Page Only Talk');

        $homeResponse = $this->get(route('home'));
        $homeResponse->assertDontSee('Videos Page Only Talk');
    }

    /** TEST D: YouTube video with publish_videos = 0 -> does NOT appear on /videos */
    public function test_video_with_publish_videos_off_does_not_appear_on_videos_page(): void
    {
        MediaItem::create([
            'title' => 'Disabled Videos Page Item',
            'type' => 'youtube',
            'url' => 'https://www.youtube.com/watch?v=4vW7gW2d5X8',
            'is_published' => true,
            'publish_videos' => false,
            'show_on_home' => false,
        ]);

        $videosResponse = $this->get(route('videos'));
        $videosResponse->assertDontSee('Disabled Videos Page Item');
    }

    /** TEST E: Draft media item (is_published = 0) does NOT appear publicly anywhere */
    public function test_draft_media_does_not_appear_publicly_anywhere(): void
    {
        MediaItem::create([
            'title' => 'Draft Private Media',
            'type' => 'youtube',
            'url' => 'https://www.youtube.com/watch?v=draft',
            'is_published' => false,
            'publish_videos' => true,
            'show_on_home' => true,
        ]);

        $videosResponse = $this->get(route('videos'));
        $videosResponse->assertDontSee('Draft Private Media');

        $homeResponse = $this->get(route('home'));
        $homeResponse->assertDontSee('Draft Private Media');
    }

    /** TEST F: Editing publication targets updates public pages immediately */
    public function test_editing_publication_targets_updates_public_pages(): void
    {
        $media = MediaItem::create([
            'title' => 'Dynamic Toggle Video',
            'type' => 'youtube',
            'url' => 'https://www.youtube.com/watch?v=toggle',
            'is_published' => true,
            'publish_videos' => true,
            'show_on_home' => true,
        ]);

        $homeResponse = $this->get(route('home'));
        $homeResponse->assertSee('Dynamic Toggle Video');

        // Turn show_on_home OFF
        $this->actingAs($this->admin)->put(route('admin.media.update', $media->id), [
            'title' => 'Dynamic Toggle Video',
            'type' => 'youtube',
            'url' => 'https://www.youtube.com/watch?v=toggle',
            'is_published' => '1',
            'publish_videos' => '1',
            'show_on_home' => '0',
        ]);

        $homeResponse2 = $this->get(route('home'));
        $homeResponse2->assertDontSee('Dynamic Toggle Video');

        $videosResponse2 = $this->get(route('videos'));
        $videosResponse2->assertSee('Dynamic Toggle Video');
    }

    /** TEST G: Deleting media item removes public visibility immediately */
    public function test_deleting_media_item_removes_public_visibility(): void
    {
        $media = MediaItem::create([
            'title' => 'Temporary Media Item',
            'type' => 'image',
            'url' => 'https://example.com/temp.jpg',
            'is_published' => true,
            'publish_gallery' => true,
        ]);

        $this->actingAs($this->admin)->delete(route('admin.media.destroy', $media->id));

        $this->assertDatabaseMissing('media_items', ['id' => $media->id]);

        $galleryResponse = $this->get(route('gallery'));
        $galleryResponse->assertDontSee('Temporary Media Item');
    }

    /** TEST H: Responsive grid classes: 1-col mobile, 2-col tablet, 3-col desktop */
    public function test_responsive_grid_classes_exist_on_home_and_videos_pages(): void
    {
        MediaItem::create([
            'title' => 'Responsive Grid Item',
            'type' => 'youtube',
            'url' => 'https://www.youtube.com/watch?v=grid',
            'is_published' => true,
            'publish_videos' => true,
            'show_on_home' => true,
        ]);

        $homeResponse = $this->get(route('home'));
        $homeResponse->assertSee('grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3', false);

        $videosResponse = $this->get(route('videos'));
        $videosResponse->assertSee('grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3', false);
    }
}
