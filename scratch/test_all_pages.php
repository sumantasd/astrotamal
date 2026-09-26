<?php

$pages = [
    '/' => 'Home',
    '/about' => 'About',
    '/services' => 'Services',
    '/horoscope' => 'Horoscope',
    '/kundli' => 'Kundli',
    '/testimonials' => 'Testimonials',
    '/contact' => 'Contact',
    '/blog' => 'Blog',
    '/book-consultation' => 'Book Consultation',
    '/numerology-calculator' => 'Numerology Calculator',
    '/mobile-number-calculator' => 'Mobile Number Calculator',
    '/kundali-calculator' => 'Kundali Calculator',
    '/gallery' => 'Gallery',
    '/videos' => 'Videos',
];

echo "=== FULL SITE HEALTH & ROUTE TEST ===\n\n";

$allOk = true;

foreach ($pages as $route => $title) {
    $url = 'http://127.0.0.1:8000' . $route;
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($httpCode === 200) {
        echo "[OK 200] $route ($title)\n";
    } else {
        echo "[FAIL $httpCode] $route ($title) — Error: $curlError\n";
        $allOk = false;
    }
}

echo "\n";
if ($allOk) {
    echo "RESULT: ALL 14 ROUTES ARE WORKING WITH HTTP 200 OK!\n";
} else {
    echo "RESULT: SOME ROUTES FAILED!\n";
}
