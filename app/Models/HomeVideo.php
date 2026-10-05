<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'thumbnail',
        'tag',
        'video_url',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(function ($homeVideo) {
            MediaItem::updateOrCreate(
                ['url' => $homeVideo->video_url],
                [
                    'title' => $homeVideo->title,
                    'tag' => $homeVideo->tag,
                    'type' => 'youtube',
                    'thumbnail' => $homeVideo->thumbnail,
                    'is_published' => $homeVideo->is_active,
                    'publish_videos' => $homeVideo->is_active,
                    'show_on_home' => $homeVideo->is_active,
                    'sort_order' => $homeVideo->display_order,
                ]
            );
        });

        static::deleted(function ($homeVideo) {
            MediaItem::where('url', $homeVideo->video_url)->delete();
        });
    }
}
