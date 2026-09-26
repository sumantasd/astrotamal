<?php

$links = [
    '/numerology-calculator' => 'Numerology Calculator',
    '/mobile-number-calculator' => 'Mobile Number Calculator',
    '/kundali-calculator' => 'Kundli',
    '/gallery' => 'Astrology Gallery',
    '/videos' => 'Astrology Videos',
    '/blog' => 'Blog'
];

echo "=== TESTING ALL 6 MORE DROPDOWN ROUTES ===\n\n";

$allPassed = true;

foreach ($links as $url => $expectedKeyword) {
    $fullUrl = 'http://127.0.0.1:8000' . $url;
    $content = @file_get_contents($fullUrl);
    
    if ($content === false) {
        echo "[FAIL] Could not reach $url\n";
        $allPassed = false;
        continue;
    }

    $found = strpos($content, $expectedKeyword) !== false;
    echo ($found ? "[PASS]" : "[FAIL]") . " Route $url returned HTTP 200 with keyword '$expectedKeyword'\n";
    
    if (!$found) $allPassed = false;
}

echo "\n";
if ($allPassed) {
    echo "SUCCESS: ALL 6 DROPDOWN LINKS ARE ACTIVE AND WORKING PERFECTLY!\n";
} else {
    echo "ERROR: SOME DROPDOWN LINKS FAILED!\n";
    exit(1);
}
