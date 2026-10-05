<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShopCategory;

class ShopCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $defaultCategories = [
            [
                'name' => 'Gemstone / Ratna',
                'slug' => 'gemstone-ratna',
                'icon' => '💎',
                'description' => 'Coming to the shop soon',
                'url' => '/contact',
                'link_type' => 'internal',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Rudraksha',
                'slug' => 'rudraksha',
                'icon' => '📿',
                'description' => 'Coming to the shop soon',
                'url' => '/contact',
                'link_type' => 'internal',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Bracelet',
                'slug' => 'bracelet',
                'icon' => '📿',
                'description' => 'Coming to the shop soon',
                'url' => '/contact',
                'link_type' => 'internal',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Ganesh Products',
                'slug' => 'ganesh-products',
                'icon' => '🐘',
                'description' => 'Coming to the shop soon',
                'url' => '/contact',
                'link_type' => 'internal',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Spiritual Products',
                'slug' => 'spiritual-products',
                'icon' => '🕉️',
                'description' => 'Coming to the shop soon',
                'url' => '/contact',
                'link_type' => 'internal',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Other Products',
                'slug' => 'other-products',
                'icon' => '✨',
                'description' => 'Coming to the shop soon',
                'url' => '/contact',
                'link_type' => 'internal',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($defaultCategories as $cat) {
            ShopCategory::firstOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
