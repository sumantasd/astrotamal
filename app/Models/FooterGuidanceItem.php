<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class FooterGuidanceItem extends Model
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

        return !empty($this->url) ? url($this->url) : '#';
    }

    public static function seedDefaultsIfEmpty(): void
    {
        if (static::count() > 0) {
            return;
        }

        $defaults = [
            ['label' => 'Birth Chart Analysis', 'url' => '/services/birth-chart', 'sort_order' => 1],
            ['label' => 'Transit & Timing Analysis', 'url' => '/services/transit-timing', 'sort_order' => 2],
            ['label' => 'Career & Job Guidance', 'url' => '/services/career-guidance', 'sort_order' => 3],
            ['label' => 'Business Guidance', 'url' => '/services/business-guidance', 'sort_order' => 4],
            ['label' => 'Life Direction Guidance', 'url' => '/services/life-direction', 'sort_order' => 5],
            ['label' => 'Learn Astrology', 'url' => '/services/astrology-learning', 'sort_order' => 6],
        ];

        foreach ($defaults as $item) {
            static::create([
                'label' => $item['label'],
                'link_type' => 'custom',
                'route_name' => null,
                'url' => $item['url'],
                'target' => '_self',
                'sort_order' => $item['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}
