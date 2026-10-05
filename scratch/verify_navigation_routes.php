<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Route;

echo "=== TESTING HOME PAGE BLADE RENDERING ===\n";

try {
    $services = \App\Models\Service::where('is_featured', true)->orderBy('sort_order')->get();
    $horoscopes = \App\Models\Horoscope::all();
    $blogPosts = \App\Models\BlogPost::where('is_featured', true)->latest()->take(3)->get();
    $testimonials = \App\Models\Testimonial::where('is_approved', true)->latest()->take(6)->get();
    $faqs = \App\Models\Faq::orderBy('sort_order')->get();

    $homeHtml = view('pages.home', compact('services', 'horoscopes', 'blogPosts', 'testimonials', 'faqs'))->render();
    echo "[OK] pages.home rendered successfully (" . strlen($homeHtml) . " bytes)\n";
} catch (\Throwable $e) {
    echo "[FAIL] pages.home render error: " . $e->getMessage() . "\n";
}
