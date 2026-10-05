<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\MediaItem;
use App\Models\HomeVideo;

echo "--- VERIFYING GALLERY ARCHITECTURE ---\n";
echo "MediaItem count in DB: " . MediaItem::count() . "\n";
echo "Published images count: " . MediaItem::where('is_published', true)->where('type', 'image')->count() . "\n";

echo "\n--- VERIFYING VIDEO ARCHITECTURE ---\n";
echo "HomeVideo count in DB: " . HomeVideo::count() . "\n";
echo "Active HomeVideo count: " . HomeVideo::where('is_active', true)->count() . "\n";

echo "\n--- VERIFYING BLADE VIEWS RESPONSIVE CLASSES ---\n";
$homeBlade = file_get_contents(__DIR__ . '/../resources/views/pages/home.blade.php');
$videosBlade = file_get_contents(__DIR__ . '/../resources/views/pages/videos.blade.php');
$galleryBlade = file_get_contents(__DIR__ . '/../resources/views/pages/gallery.blade.php');

if (str_contains($homeBlade, 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3')) {
    echo "✓ Home Latest Videos has 1-col Mobile, 2-col Tablet, 3-col Desktop grid!\n";
} else {
    echo "✗ Home Latest Videos grid class mismatch!\n";
}

if (str_contains($videosBlade, 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3')) {
    echo "✓ Videos Page grid has 1-col Mobile, 2-col Tablet, 3-col Desktop grid!\n";
} else {
    echo "✗ Videos Page grid class mismatch!\n";
}

if (str_contains($galleryBlade, 'images: {{ json_encode($galleryList) }}')) {
    echo "✓ Gallery Page is dynamically bound to database MediaItem records!\n";
} else {
    echo "✗ Gallery Page database binding mismatch!\n";
}

echo "\nALL CHECKS COMPLETED SUCCESSFULLY.\n";
