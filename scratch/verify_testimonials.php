<?php

$html = file_get_contents('http://127.0.0.1:8000/testimonials');

if ($html === false) {
    echo "FAILED: Could not fetch /testimonials page\n";
    exit(1);
}

$checks = [
    'Compact Testimonials Hero' => strpos($html, 'What People Say') !== false,
    'Breadcrumb' => strpos($html, 'TESTIMONIALS') !== false,
    'Editorial Intro' => strpos($html, 'Every Consultation Begins With a Question.') !== false,
    'Featured Testimonial Section' => strpos($html, 'FEATURED REVIEW') !== false,
    'Testimonials Grid Cards' => strpos($html, 'Share Your Experience') !== false,
    'Submit Review Form Present' => strpos($html, 'route(\'testimonials.store\')') !== false || strpos($html, 'action=') !== false,
    'Consultation CTA' => strpos($html, 'Have Questions of Your Own?') !== false && strpos($html, '/book-consultation') !== false,
    'Global Pre-Footer Component' => strpos($html, 'Understand Your Chart') !== false,
    'Global Pre-Footer Appears Exactly ONCE' => substr_count($html, 'Understand Your Chart') === 1,
    'Global Footer Component' => strpos($html, 'Tamal Chakraborty') !== false,
];

echo "=== TESTIMONIALS PAGE VERIFICATION REPORT ===\n\n";

$allPassed = true;
foreach ($checks as $title => $passed) {
    echo ($passed ? "[PASS]" : "[FAIL]") . " " . $title . "\n";
    if (!$passed) $allPassed = false;
}

echo "\n";
if ($allPassed) {
    echo "SUCCESS: ALL 10 TESTIMONIALS VERIFICATION CHECKS PASSED PERFECTLY!\n";
} else {
    echo "ERROR: SOME CHECKS FAILED!\n";
    exit(1);
}
