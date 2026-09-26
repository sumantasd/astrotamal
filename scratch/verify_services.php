<?php

$html = file_get_contents('http://127.0.0.1:8000/services');

if ($html === false) {
    echo "FAILED: Could not fetch /services page\n";
    exit(1);
}

$checks = [
    'Compact Services Hero' => strpos($html, 'Guidance For The Important Questions In Life') !== false,
    'Breadcrumb' => strpos($html, 'SERVICES') !== false,
    'Editorial Intro' => strpos($html, 'Astrology With Context, Timing & Understanding') !== false,
    'Service 01 Birth Chart Analysis' => strpos($html, 'Birth Chart Analysis') !== false,
    'Service 02 Transit & Timing Analysis' => strpos($html, 'Transit & Timing Analysis') !== false,
    'Service 03 Career & Job Guidance' => strpos($html, 'Career & Job Guidance') !== false,
    'Service 04 Business Guidance' => strpos($html, 'Business Guidance') !== false,
    'Service 05 Life Direction Guidance' => strpos($html, 'Life Direction Guidance') !== false,
    'Service 06 Learn Astrology' => strpos($html, 'Learn Astrology') !== false,
    'Featured Birth Chart Section' => strpos($html, 'FEATURED CONSULTATION') !== false,
    'What Can We Explore?' => strpos($html, 'What Can We Explore?') !== false,
    'Consultation Journey' => strpos($html, 'A Simple Consultation Journey') !== false,
    'Services FAQ' => strpos($html, 'SERVICES FAQ') !== false,
    'Pre-Footer Component' => strpos($html, 'Understand Your Chart') !== false,
    'Footer Component' => strpos($html, 'Tamal Chakraborty') !== false,
    'Book Consultation CTA Link' => strpos($html, '/book-consultation') !== false,
];

echo "=== SERVICES PAGE VERIFICATION REPORT ===\n";
$allPassed = true;
foreach ($checks as $title => $passed) {
    echo ($passed ? "[PASS]" : "[FAIL]") . " " . $title . "\n";
    if (!$passed) $allPassed = false;
}

if ($allPassed) {
    echo "\nSUCCESS: ALL 16 VERIFICATION CHECKS PASSED PERFECTLY!\n";
} else {
    echo "\nERROR: SOME CHECKS FAILED!\n";
    exit(1);
}
