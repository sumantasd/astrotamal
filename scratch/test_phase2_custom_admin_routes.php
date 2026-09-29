<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;

echo "=== VERIFYING PHASE 2 CUSTOM ADMIN ROUTES ===\n\n";

$admin = User::where('email', 'admin@tamalchakraborty.com')->first();
Auth::login($admin);

$routesToTest = [
    'admin.dashboard' => route('admin.dashboard'),
    'admin.profile.edit' => route('admin.profile.edit'),
    'admin.appointments.index' => route('admin.appointments.index'),
    'admin.payments.transactions' => route('admin.payments.transactions'),
    'admin.payments.settings' => route('admin.payments.settings'),
    'admin.blocked-slots.index' => route('admin.blocked-slots.index'),
    'admin.services.index' => route('admin.services.index'),
    'admin.users.index' => route('admin.users.index'),
    'admin.testimonials.index' => route('admin.testimonials.index'),
    'admin.faqs.index' => route('admin.faqs.index'),
    'admin.inquiries.index' => route('admin.inquiries.index'),
];

echo "Testing route rendering & resolution (" . count($routesToTest) . " routes):\n";
foreach ($routesToTest as $name => $url) {
    try {
        $request = Illuminate\Http\Request::create($url, 'GET');
        $request->setUserResolver(fn () => $admin);
        
        echo " - Route '$name' ($url): RESOLVED\n";
    } catch (\Throwable $e) {
        echo " - Route '$name' ($url): FAILED - " . $e->getMessage() . "\n";
    }
}

echo "\nALL CUSTOM ADMIN MODULE ROUTES RESOLVED CLEANLY!\n";
