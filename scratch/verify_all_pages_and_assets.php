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

echo "=== FULL PAGE & ASSET VERIFICATION ===\n\n";

$allPassed = true;

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

    // Check that CSS asset link is present and points to build/assets/
    $hasCss = (strpos($html, '/build/assets/app-') !== false && strpos($html, '.css') !== false);
    $hasJs = (strpos($html, '/build/assets/app-') !== false && strpos($html, '.js') !== false);

    if (!$hasCss || !$hasJs) {
        echo "[WARN - MISSING ASSET TAGS] $path ($name)\n";
        $allPassed = false;
    } else {
        echo "[OK 200] $path ($name) - Assets properly referenced\n";
    }
}

// Test Asset HTTP Status
$manifestPath = __DIR__ . '/../public/build/manifest.json';
if (file_exists($manifestPath)) {
    $manifest = json_decode(file_get_contents($manifestPath), true);
    $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
    $jsFile = $manifest['resources/js/app.js']['file'] ?? null;

    echo "\n=== MANIFEST VERIFICATION ===\n";
    echo "CSS bundle: $cssFile\n";
    echo "JS bundle: $jsFile\n";

    if ($cssFile) {
        $cssUrl = $baseUrl . '/build/' . $cssFile;
        $ch = curl_init($cssUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $cssContent = curl_exec($ch);
        $cssCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo "CSS HTTP Status: $cssCode (" . strlen($cssContent) . " bytes)\n";
        if ($cssCode !== 200 || strlen($cssContent) < 1000) {
            $allPassed = false;
        }
    }

    if ($jsFile) {
        $jsUrl = $baseUrl . '/build/' . $jsFile;
        $ch = curl_init($jsUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $jsContent = curl_exec($ch);
        $jsCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        echo "JS HTTP Status: $jsCode (" . strlen($jsContent) . " bytes)\n";
        if ($jsCode !== 200 || strlen($jsContent) < 1000) {
            $allPassed = false;
        }
    }
} else {
    echo "\n[FAIL] manifest.json missing!\n";
    $allPassed = false;
}

if ($allPassed) {
    echo "\nRESULT: ALL 14 PAGES & ASSETS ARE VERIFIED AND WORKING PERFECTLY!\n";
} else {
    echo "\nRESULT: ISSUES DETECTED!\n";
}
