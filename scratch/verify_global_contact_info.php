<?php
$baseUrl = 'http://127.0.0.1:8000';

$routes = [
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

echo "=== GLOBAL CONTACT INFORMATION CONSISTENCY CHECK ===\n\n";

$allPassed = true;

// Search targets that MUST exist
$officialValues = [
    'Website text' => 'astrotamal.com',
    'Website link' => 'href="https://astrotamal.com"',
    'Email text' => 'support@astrotamal.com',
    'Email link' => 'href="mailto:support@astrotamal.com"',
    'Phone text' => '96476 80707',
    'Phone link' => 'href="tel:+919647680707"',
    'Chamber location' => 'Kolkata | Bongaon | Ranaghat & More',
];

// Outdated targets that MUST NOT exist
$outdatedValues = [
    '98765 43210',
    'info@tamalchakraborty.com',
    'tamalchakraborty.com/contact',
];

foreach ($routes as $path => $name) {
    $url = $baseUrl . $path;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($code !== 200) {
        echo "[FAIL $code] $path ($name)\n";
        $allPassed = false;
        continue;
    }

    // Check footer contains official contact info on every page
    $hasOfficialEmail = (strpos($html, 'support@astrotamal.com') !== false);
    $hasOfficialPhone = (strpos($html, '96476 80707') !== false);
    $hasOfficialChamber = (strpos($html, 'Kolkata | Bongaon | Ranaghat & More') !== false);

    if (!$hasOfficialEmail || !$hasOfficialPhone || !$hasOfficialChamber) {
        echo "[FAIL MISSING OFFICIAL CONTACT] $path ($name)\n";
        $allPassed = false;
    } else {
        echo "[OK 200] $path ($name) - Verified official contact details present\n";
    }

    // Check no outdated values exist
    foreach ($outdatedValues as $outdated) {
        if (strpos($html, $outdated) !== false) {
            echo "[FAIL OUTDATED CONTACT FOUND] $path ($name) contains '$outdated'\n";
            $allPassed = false;
        }
    }
}

if ($allPassed) {
    echo "\n=== ALL 14 PAGES VERIFIED: 100% CONSISTENT OFFICIAL CONTACT DETAILS! ===\n";
} else {
    echo "\n=== CONSISTENCY CHECK DETECTED ISSUES! ===\n";
}
