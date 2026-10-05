<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$routes = [
    '/',
    '/about',
    '/services',
    '/shop',
    '/gallery',
    '/videos',
    '/contact',
    '/privacy-policy',
    '/terms-and-conditions',
    '/refund-policy',
];

echo "Checking Public Footer Routes:\n";
foreach ($routes as $route) {
    $request = Illuminate\Http\Request::create($route, 'GET');
    $response = $app->handle($request);
    $status = $response->getStatusCode();
    echo "URL: {$route} => Status: {$status}\n";
    if ($status !== 200) {
        echo "FAILED on {$route}!\n";
        exit(1);
    }
}

echo "ALL 10 PUBLIC ROUTES LOADED SUCCESSFULLY (200 OK)!\n";
