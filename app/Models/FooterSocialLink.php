<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSocialLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'url',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function seedDefaultsIfEmpty(): void
    {
        if (static::count() > 0) {
            return;
        }

        $defaults = [
            ['platform' => 'Facebook', 'url' => 'https://facebook.com', 'icon' => 'facebook', 'sort_order' => 1],
            ['platform' => 'Instagram', 'url' => 'https://instagram.com', 'icon' => 'instagram', 'sort_order' => 2],
            ['platform' => 'YouTube', 'url' => 'https://youtube.com', 'icon' => 'youtube', 'sort_order' => 3],
            ['platform' => 'WhatsApp', 'url' => 'https://wa.me/918392059201', 'icon' => 'whatsapp', 'sort_order' => 4],
        ];

        foreach ($defaults as $item) {
            static::create([
                'platform' => $item['platform'],
                'url' => $item['url'],
                'icon' => $item['icon'],
                'sort_order' => $item['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}
