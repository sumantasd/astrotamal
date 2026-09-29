<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

echo "=== ASTROTAMAL ALL PLANNED ADMIN MODULES VERIFICATION ===\n\n";

$adminUser = User::where('is_admin', true)->first();
if (!$adminUser) {
    echo "ERROR: No admin user found!\n";
    exit(1);
}

auth()->login($adminUser);

$adminRoutesToTest = [
    '/custom-admin/dashboard',
    '/custom-admin/profile',
    '/custom-admin/appointments',
    '/custom-admin/payments',
    '/custom-admin/payment-settings',
    '/custom-admin/blocked-slots',
    '/custom-admin/services',
    '/custom-admin/users',
    '/custom-admin/testimonials',
    '/custom-admin/faqs',
    '/custom-admin/contact-inquiries',
    '/custom-admin/horoscopes',
    '/custom-admin/horoscopes/create',
    '/custom-admin/horoscopes/signs',
    '/custom-admin/pages',
    '/custom-admin/pages/home/edit',
    '/custom-admin/pages/about/edit',
    '/custom-admin/pages/services/edit',
    '/custom-admin/settings',
    '/custom-admin/settings/general',
    '/custom-admin/settings/header',
    '/custom-admin/settings/footer',
    '/custom-admin/settings/seo',
    '/custom-admin/media',
    '/custom-admin/blogs',
    '/custom-admin/blogs/create',
];

foreach ($adminRoutesToTest as $uri) {
    try {
        $request = Illuminate\Http\Request::create($uri, 'GET');
        $response = $kernel->handle($request);
        $status = $response->getStatusCode();
        echo "Admin Route: $uri -> HTTP $status\n";
    } catch (\Throwable $e) {
        echo "Admin Route: $uri -> EXCEPTION: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine() . "\n";
    }
}
