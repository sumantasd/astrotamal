<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ShopCategory;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShopPageCmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder']);
        $this->artisan('db:seed', ['--class' => 'ShopCategoriesSeeder']);
    }

    protected function getAdminUser(): User
    {
        return User::factory()->create([
            'is_admin' => true,
            'is_active' => true,
        ]);
    }

    public function test_existing_shop_categories_are_available()
    {
        $categories = ShopCategory::all();
        $this->assertEquals(6, $categories->count());
        $this->assertTrue(ShopCategory::where('slug', 'gemstone-ratna')->exists());
        $this->assertTrue(ShopCategory::where('slug', 'rudraksha')->exists());
    }

    public function test_public_shop_page_renders_hero_grid_and_cta_below_grid()
    {
        $response = $this->get('/shop');
        $response->assertStatus(200);
        $response->assertSee('Gemstone / Ratna');
        $response->assertSee('Need Guidance on Gemstones or Remedies?');

        $content = $response->getContent();
        $gridPos = strpos($content, 'Gemstone / Ratna');
        $ctaPos = strpos($content, 'Need Guidance on Gemstones or Remedies?');

        $this->assertTrue($gridPos < $ctaPos, 'CTA section must appear BELOW the category grid');
    }

    public function test_admin_can_access_shop_cms_editor()
    {
        $admin = $this->getAdminUser();
        $response = $this->actingAs($admin)->get(route('admin.shop.edit'));
        $response->assertStatus(200);
        $response->assertSee('Shop Page Management');
    }

    public function test_admin_can_update_shop_settings()
    {
        $admin = $this->getAdminUser();

        $updateData = [
            'shop_hero_visible' => '1',
            'shop_hero_eyebrow' => 'CUSTOM SHOP EYEBROW',
            'shop_hero_title' => 'Custom Shop Title',
            'shop_hero_description' => 'Custom shop intro text.',

            'shop_grid_visible' => '1',

            'shop_cta_visible' => '1',
            'shop_cta_eyebrow' => 'CUSTOM CTA EYEBROW',
            'shop_cta_title' => 'Custom CTA Title Heading',
            'shop_cta_description' => 'Custom CTA description paragraph.',
            'shop_cta_button_text' => 'CUSTOM BOOK CTA',
            'shop_cta_button_url' => '/custom-booking-url',
        ];

        $response = $this->actingAs($admin)->post(route('admin.shop.settings.update'), $updateData);
        $response->assertRedirect(route('admin.shop.edit'));

        $this->assertEquals('Custom Shop Title', SiteSetting::get('shop_hero_title'));
        $this->assertEquals('Custom CTA Title Heading', SiteSetting::get('shop_cta_title'));

        $publicResponse = $this->get('/shop');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('CUSTOM SHOP EYEBROW');
        $publicResponse->assertSee('Custom Shop Title');
        $publicResponse->assertSee('Custom CTA Title Heading');
        $publicResponse->assertSee('CUSTOM BOOK CTA');
        $publicResponse->assertSee('/custom-booking-url');
    }

    public function test_admin_can_crud_shop_categories()
    {
        $admin = $this->getAdminUser();

        // 1. Store
        $storeResponse = $this->actingAs($admin)->post(route('admin.shop.categories.store'), [
            'name' => 'Kavach & Yantras',
            'icon' => 'item-icon',
            'description' => 'Energized protective Kavach',
            'url' => '/contact',
            'sort_order' => 7,
            'is_active' => '1',
        ]);
        $storeResponse->assertRedirect(route('admin.shop.edit'));

        $newCat = ShopCategory::where('slug', 'kavach-yantras')->first();
        $this->assertNotNull($newCat);
        $this->assertEquals('Kavach & Yantras', $newCat->name);

        // 2. Update
        $updateResponse = $this->actingAs($admin)->put(route('admin.shop.categories.update', $newCat), [
            'name' => 'Kavach & Yantras UPDATED',
            'icon' => 'item-icon',
            'description' => 'Updated Kavach desc',
            'url' => '/contact',
            'sort_order' => 7,
            'is_active' => '1',
        ]);
        $updateResponse->assertRedirect(route('admin.shop.edit'));

        $newCat->refresh();
        $this->assertEquals('Kavach & Yantras UPDATED', $newCat->name);

        // Check public render
        $publicResponse = $this->get('/shop');
        $publicResponse->assertSee('Kavach &amp; Yantras UPDATED', false);

        // 3. Destroy
        $destroyResponse = $this->actingAs($admin)->delete(route('admin.shop.categories.destroy', $newCat));
        $destroyResponse->assertRedirect(route('admin.shop.edit'));

        $this->assertDatabaseMissing('shop_categories', ['id' => $newCat->id]);
    }

    public function test_section_visibility_toggles_work()
    {
        // 1. Turn Hero OFF
        SiteSetting::set('shop_hero_visible', '0', 'shop');

        $response1 = $this->get('/shop');
        $response1->assertSee('Gemstone / Ratna');

        // 2. Turn CTA OFF
        SiteSetting::set('shop_cta_visible', '0', 'shop');

        $response2 = $this->get('/shop');
        $response2->assertDontSee('Need Guidance on Gemstones or Remedies?');

        // Restore
        SiteSetting::set('shop_hero_visible', '1', 'shop');
        SiteSetting::set('shop_cta_visible', '1', 'shop');
    }

    public function test_inactive_category_is_hidden_from_grid()
    {
        $cat = ShopCategory::where('slug', 'bracelet')->first();
        if (!$cat) {
            $cat = ShopCategory::create([
                'name' => 'Bracelet',
                'slug' => 'bracelet',
                'icon' => 'item-icon',
                'description' => 'Test',
                'url' => '/contact',
                'sort_order' => 1,
                'is_active' => true,
            ]);
        }
        $cat->update(['is_active' => false]);

        $response = $this->get('/shop');
        $response->assertStatus(200);

        $categoriesOnView = $response->viewData('categories');
        $this->assertFalse($categoriesOnView->contains('slug', 'bracelet'));
    }
}
