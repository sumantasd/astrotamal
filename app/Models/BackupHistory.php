<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackupHistory extends Model
{
    protected $fillable = [
        'filename',
        'path',
        'size_bytes',
        'type',
        'manifest',
    ];

    protected $casts = [
        'manifest' => 'array',
        'size_bytes' => 'integer',
    ];

    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->size_bytes;
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' Bytes';
    }
}
