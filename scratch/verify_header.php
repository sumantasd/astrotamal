<?php

$html = file_get_contents('http://127.0.0.1:8000/');

if ($html === false) {
    echo "FAILED: Could not fetch home page\n";
    exit(1);
}

// Extract nav HTML
$dom = new DOMDocument();
@$dom->loadHTML($html);

$xpath = new DOMXPath($dom);

// Find desktop top-level nav links
$desktopNavLinks = [];
$nodes = $xpath->query('//nav[contains(@class, "hidden lg:flex")]/a | //nav[contains(@class, "hidden lg:flex")]/div/button | //nav[contains(@class, "hidden lg:flex")]/div/a');
foreach ($nodes as $node) {
    // Only pick direct children of nav or direct button/a inside relative div (not inside dropdown container)
    if ($node->parentNode->nodeName === 'nav' || ($node->parentNode->nodeName === 'div' && $node->parentNode->parentNode->nodeName === 'nav')) {
        $text = trim($node->textContent);
        if ($text !== '') {
            $desktopNavLinks[] = preg_replace('/\s+/', ' ', $text);
        }
    }
}

// Find dropdown links
$dropdownLinks = [];
$dropdownNodes = $xpath->query('//div[contains(@class, "w-60")]//a');
foreach ($dropdownNodes as $node) {
    $text = trim($node->textContent);
    if ($text !== '') {
        $dropdownLinks[] = preg_replace('/\s+/', ' ', $text);
    }
}

$expectedMain = [
    'Home',
    'About',
    'Services',
    'Horoscope',
    'Kundli',
    'Testimonials',
    'More',
    'Contact'
];

$expectedDropdown = [
    'Numerology Calculator',
    'Mobile Number Calculator',
    'Kundali Calculator',
    'Gallery',
    'Videos',
    'Blog'
];

echo "=== GLOBAL HEADER VERIFICATION REPORT ===\n\n";

echo "Main Navigation Order:\n";
print_r($desktopNavLinks);

echo "\nMore Dropdown Items:\n";
print_r($dropdownLinks);

$allPassed = true;

// Check Main items count
if (count($desktopNavLinks) === 8) {
    echo "\n[PASS] Main menu has exactly 8 items";
} else {
    echo "\n[FAIL] Main menu count is " . count($desktopNavLinks) . " (expected 8)";
    $allPassed = false;
}

// Check Main items order
if ($desktopNavLinks === $expectedMain) {
    echo "\n[PASS] Main menu order matches Home -> About -> Services -> Horoscope -> Kundli -> Testimonials -> More -> Contact";
} else {
    echo "\n[FAIL] Main menu order mismatch!";
    $allPassed = false;
}

// Check Blog NOT in main nav
$blogInMain = false;
foreach ($desktopNavLinks as $item) {
    if (trim($item) === 'Blog') $blogInMain = true;
}
if (!$blogInMain) {
    echo "\n[PASS] Blog is NOT in the main navigation row";
} else {
    echo "\n[FAIL] Blog is present in the main navigation row!";
    $allPassed = false;
}

// Check Dropdown items count
if (count($dropdownLinks) === 6) {
    echo "\n[PASS] More dropdown contains exactly 6 items";
} else {
    echo "\n[FAIL] More dropdown count is " . count($dropdownLinks) . " (expected 6)";
    $allPassed = false;
}

// Check Dropdown order and Blog as last
if ($dropdownLinks === $expectedDropdown) {
    echo "\n[PASS] Dropdown items match exact order with Blog as the LAST item";
} else {
    echo "\n[FAIL] Dropdown order mismatch!";
    $allPassed = false;
}

// Check Book Consultation link
if (strpos($html, '/book-consultation') !== false) {
    echo "\n[PASS] Book Consultation CTA links to /book-consultation";
} else {
    echo "\n[FAIL] Book Consultation CTA link missing!";
    $allPassed = false;
}

echo "\n\n";
if ($allPassed) {
    echo "SUCCESS: ALL HEADER NAVIGATION VERIFICATION CHECKS PASSED PERFECTLY!\n";
} else {
    echo "ERROR: SOME CHECKS FAILED!\n";
    exit(1);
}
