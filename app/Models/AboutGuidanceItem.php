<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutGuidanceItem extends Model
{
    protected $fillable = [
        'item_number',
        'title',
        'description',
        'icon',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];
}
