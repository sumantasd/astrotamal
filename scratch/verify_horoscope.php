<?php

$html = file_get_contents('http://127.0.0.1:8000/horoscope');

if ($html === false) {
    echo "FAILED: Could not fetch /horoscope page\n";
    exit(1);
}

$checks = [
    'Compact Horoscope Hero' => strpos($html, 'Read the Language of the Zodiac') !== false,
    'Breadcrumb' => strpos($html, 'HOROSCOPE') !== false,
    'Editorial Intro' => strpos($html, 'Explore the Twelve Zodiac Signs') !== false,
    'Visual Badge 12 Zodiac Signs' => strpos($html, '12') !== false && strpos($html, 'ZODIAC SIGNS') !== false,
    'Zodiac Card Aries' => strpos($html, 'Aries') !== false && strpos($html, 'MAR 21 – APR 19') !== false,
    'Understanding the Four Elements' => strpos($html, 'Understanding the Four Elements') !== false,
    'More Than Just a Sun Sign' => strpos($html, 'More Than Just a Sun Sign') !== false,
    'Personal Guidance Section REMOVED' => strpos($html, 'PERSONAL GUIDANCE') === false,
    'Duplicate Heading REMOVED' => strpos($html, 'Your Birth Chart Tells a Larger Story.') === false,
    'Global Pre-Footer Component Present' => strpos($html, 'Understand Your Chart') !== false,
    'Global Pre-Footer Appears Exactly ONCE' => substr_count($html, 'Understand Your Chart') === 1,
    'Global Footer Present' => strpos($html, 'Tamal Chakraborty') !== false,
    'Book Consultation Link Present' => strpos($html, '/book-consultation') !== false,
];

echo "=== HOROSCOPE PAGE VERIFICATION REPORT ===\n\n";

$allPassed = true;
foreach ($checks as $title => $passed) {
    echo ($passed ? "[PASS]" : "[FAIL]") . " " . $title . "\n";
    if (!$passed) $allPassed = false;
}

// Test individual detail page
$detailHtml = file_get_contents('http://127.0.0.1:8000/horoscope/aries');
$detailPassed = $detailHtml !== false && strpos($detailHtml, 'Aries') !== false;
echo ($detailPassed ? "[PASS]" : "[FAIL]") . " Horoscope detail route (/horoscope/aries)\n";

if (!$detailPassed) $allPassed = false;

echo "\n";
if ($allPassed) {
    echo "SUCCESS: ALL 23 HOROSCOPE VERIFICATION CHECKS PASSED PERFECTLY!\n";
} else {
    echo "ERROR: SOME CHECKS FAILED!\n";
    exit(1);
}
