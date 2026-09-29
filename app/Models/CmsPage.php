<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'seo_title',
        'meta_description',
        'content',
        'featured_image',
        'status',
        'sort_order',
    ];

    public static function getPage(string $slug): ?self
    {
        return static::where('slug', $slug)->where('status', 'published')->first();
    }
}
