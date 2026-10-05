<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class FooterNavItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'link_type',
        'route_name',
        'url',
        'target',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getComputedUrlAttribute(): string
    {
        if ($this->link_type === 'internal') {
            if (!empty($this->route_name) && Route::has($this->route_name)) {
                return route($this->route_name);
            }
            return !empty($this->url) ? url($this->url) : url('/');
        }

        return !empty($this->url) ? $this->url : '#';
    }

    public static function seedDefaultsIfEmpty(): void
    {
        if (static::count() > 0) {
            return;
        }

        $defaults = [
            ['label' => 'Home', 'link_type' => 'internal', 'route_name' => 'home', 'url' => '/', 'sort_order' => 1],
            ['label' => 'About', 'link_type' => 'internal', 'route_name' => 'about', 'url' => '/about', 'sort_order' => 2],
            ['label' => 'Services', 'link_type' => 'internal', 'route_name' => 'services.index', 'url' => '/services', 'sort_order' => 3],
            ['label' => 'Shop', 'link_type' => 'internal', 'route_name' => 'shop', 'url' => '/shop', 'sort_order' => 4],
            ['label' => 'Gallery', 'link_type' => 'internal', 'route_name' => 'gallery', 'url' => '/gallery', 'sort_order' => 5],
            ['label' => 'Videos', 'link_type' => 'internal', 'route_name' => 'videos', 'url' => '/videos', 'sort_order' => 6],
            ['label' => 'Contact', 'link_type' => 'internal', 'route_name' => 'contact', 'url' => '/contact', 'sort_order' => 7],
        ];

        foreach ($defaults as $item) {
            static::create([
                'label' => $item['label'],
                'link_type' => $item['link_type'],
                'route_name' => $item['route_name'],
                'url' => $item['url'],
                'target' => '_self',
                'sort_order' => $item['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}
