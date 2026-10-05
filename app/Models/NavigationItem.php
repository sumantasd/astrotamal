<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class NavigationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'label',
        'link_type',
        'route_name',
        'url',
        'icon',
        'target',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'parent_id' => 'integer',
    ];

    public function parent()
    {
        return $this->belongsTo(NavigationItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(NavigationItem::class, 'parent_id')->orderBy('sort_order');
    }

    public function activeChildren()
    {
        return $this->hasMany(NavigationItem::class, 'parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    /**
     * Get computed URL based on link type.
     */
    public function getComputedUrlAttribute(): string
    {
        if ($this->link_type === 'internal') {
            if (!empty($this->route_name) && Route::has($this->route_name)) {
                return route($this->route_name);
            }
            return !empty($this->url) ? url($this->url) : url('/');
        }

        if ($this->link_type === 'custom') {
            return !empty($this->url) ? url($this->url) : '#';
        }

        if ($this->link_type === 'external') {
            return !empty($this->url) ? $this->url : '#';
        }

        return '#';
    }

    /**
     * Check if the current route matches this item.
     */
    public function isActiveRoute(): bool
    {
        if ($this->link_type === 'internal' && !empty($this->route_name)) {
            if ($this->route_name === 'services.index') {
                return request()->routeIs('services.*');
            }
            if ($this->route_name === 'shop') {
                return request()->routeIs('shop*');
            }
            if ($this->route_name === 'contact') {
                return request()->routeIs('contact*');
            }
            return request()->routeIs($this->route_name);
        }

        if (!empty($this->url) && $this->url !== '#') {
            $path = ltrim(parse_url($this->url, PHP_URL_PATH) ?? '', '/');
            return !empty($path) && request()->is($path . '*');
        }

        return false;
    }

    /**
     * Seed initial default navigation items if table is empty.
     */
    public static function seedDefaultsIfEmpty(): void
    {
        if (static::count() > 0) {
            return;
        }

        $defaults = [
            ['label' => 'Home', 'link_type' => 'internal', 'route_name' => 'home', 'sort_order' => 1],
            ['label' => 'About', 'link_type' => 'internal', 'route_name' => 'about', 'sort_order' => 2],
            ['label' => 'Services', 'link_type' => 'internal', 'route_name' => 'services.index', 'sort_order' => 3],
            ['label' => 'Shop', 'link_type' => 'internal', 'route_name' => 'shop', 'sort_order' => 4],
            ['label' => 'Gallery', 'link_type' => 'internal', 'route_name' => 'gallery', 'sort_order' => 5],
            ['label' => 'Videos', 'link_type' => 'internal', 'route_name' => 'videos', 'sort_order' => 6],
            ['label' => 'Contact', 'link_type' => 'internal', 'route_name' => 'contact', 'sort_order' => 7],
        ];

        foreach ($defaults as $item) {
            static::create([
                'parent_id' => null,
                'label' => $item['label'],
                'link_type' => $item['link_type'],
                'route_name' => $item['route_name'],
                'url' => null,
                'icon' => null,
                'target' => '_self',
                'sort_order' => $item['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}
