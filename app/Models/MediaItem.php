<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    protected $fillable = [
        'title',
        'caption',
        'tag',
        'type',
        'file_path',
        'url',
        'thumbnail',
        'is_published',
        'publish_gallery',
        'publish_videos',
        'show_on_home',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'publish_gallery' => 'boolean',
        'publish_videos' => 'boolean',
        'show_on_home' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getEmbedUrlAttribute(): ?string
    {
        if ($this->type === 'youtube' && !empty($this->url)) {
            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/', $this->url, $matches);
            if (isset($matches[1])) {
                return 'https://www.youtube.com/embed/' . $matches[1];
            }
        }
        return $this->url;
    }

    public function getThumbnailAttribute($value): ?string
    {
        if (!empty($value)) {
            return $value;
        }
        if ($this->type === 'image' && !empty($this->file_path)) {
            return '/storage/' . $this->file_path;
        }
        if ($this->type === 'youtube' && !empty($this->url)) {
            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/', $this->url, $matches);
            if (isset($matches[1])) {
                return 'https://img.youtube.com/vi/' . $matches[1] . '/hqdefault.jpg';
            }
        }
        if (!empty($this->file_path)) {
            return '/storage/' . $this->file_path;
        }
        return null;
    }

    public function getVideoUrlAttribute($value): ?string
    {
        if (!empty($value)) {
            return $value;
        }
        if (!empty($this->url)) {
            return $this->url;
        }
        if (!empty($this->file_path)) {
            return '/storage/' . $this->file_path;
        }
        return '#';
    }
}
