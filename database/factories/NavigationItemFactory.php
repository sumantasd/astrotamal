<?php

namespace Database\Factories;

use App\Models\NavigationItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class NavigationItemFactory extends Factory
{
    protected $model = NavigationItem::class;

    public function definition(): array
    {
        return [
            'parent_id' => null,
            'label' => $this->faker->words(2, true),
            'link_type' => 'internal',
            'route_name' => 'home',
            'url' => null,
            'icon' => null,
            'target' => '_self',
            'sort_order' => rand(1, 10),
            'is_active' => true,
        ];
    }
}
