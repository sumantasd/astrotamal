<?php
$baseUrl = 'http://127.0.0.1:8000';

$newPages = [
    '/numerology-calculator' => [
        'name' => 'Numerology Calculator',
        'needles' => ['Discover the Numbers Behind Your Birth', 'MULANK (BIRTH NUMBER)', 'BHAGYANK (LIFE PATH)', 'Calculation Methodology', 'Pythagorean'],
    ],
    '/mobile-number-calculator' => [
        'name' => 'Mobile Number Calculator',
        'needles' => ['Explore Your Mobile Number Through Numerology', 'REDUCED SINGLE DIGIT', 'Digit Addition Steps', 'Traditional Mobile Numerology Notice'],
    ],
    '/kundali-calculator' => [
        'name' => 'Kundali Calculator',
        'needles' => ['Generate Your Birth Chart', 'Lagna (Ascendant)', 'North Indian', 'GENERATE KUNDALI'],
    ],
    '/gallery' => [
        'name' => 'Astrology Gallery',
        'needles' => ['Moments & Astrological Engagements', 'Image Collection', 'tamal_hero_portrait', 'lightboxOpen'],
    ],
    '/videos' => [
        'name' => 'Astrology Videos & Talks',
        'needles' => ['Watch & Explore Astrology', 'Astrologer Tamal Chakraborty', 'Official YouTube Channel', 'youtube.com/embed'],
    ],
];

echo "=== TESTING 5 NEW MORE DROPDOWN PAGES ===\n\n";

$allPassed = true;

foreach ($newPages as $path => $info) {
    $url = $baseUrl . $path;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($code !== 200) {
        echo "[FAIL $code] $path ({$info['name']})\n";
        $allPassed = false;
        continue;
    }

    echo "[OK 200] $path ({$info['name']})\n";

    foreach ($info['needles'] as $needle) {
        if (strpos($html, $needle) !== false) {
            echo "  ✓ Found: '$needle'\n";
        } else {
            echo "  ✗ MISSING: '$needle'\n";
            $allPassed = false;
        }
    }
    echo "\n";
}

// Full site 14 routes health check
$allRoutes = [
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

echo "=== FULL SITE 14 ROUTE HEALTH TEST ===\n\n";

foreach ($allRoutes as $path => $name) {
    $url = $baseUrl . $path;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($code === 200) {
        echo "[OK 200] $path ($name)\n";
    } else {
        echo "[FAIL $code] $path ($name)\n";
        $allPassed = false;
    }
}

if ($allPassed) {
    echo "\n=== ALL 5 MORE DROPDOWN PAGES & ALL 14 SITE ROUTES PASSED PERFECTLY! ===\n";
} else {
    echo "\n=== TEST SUITE FAILED! ===\n";
}
