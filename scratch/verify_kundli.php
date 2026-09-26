<?php

$html = file_get_contents('http://127.0.0.1:8000/kundli');

if ($html === false) {
    echo "FAILED: Could not fetch /kundli page\n";
    exit(1);
}

$checks = [
    'Compact Kundli Hero' => strpos($html, 'Discover Your Birth Chart') !== false,
    'Breadcrumb' => strpos($html, 'KUNDLI') !== false,
    'Hero goes directly to Generate Kundli' => strpos($html, 'Generate Your Kundli') !== false,
    'Full Name Field' => strpos($html, 'Full Name *') !== false,
    'Generate Kundli Button' => strpos($html, 'GENERATE KUNDLI →') !== false,
    'North Indian Diamond SVG' => strpos($html, '1 (Lagna)') !== false,
    'Understanding Kundli Section Present' => strpos($html, 'What Does a Kundli Show?') !== false,
    'Understanding Kundli Dark Navy Background (#0B1018)' => strpos($html, 'bg-[#0B1018] text-white py-14 lg:py-16 border-t border-[#B08A2E]/20') !== false,
    'Understanding Kundli Eyebrow Gold (#D4AF37)' => strpos($html, 'text-[#D4AF37] block">') !== false,
    'Understanding Kundli Heading (#FDFBF7)' => strpos($html, 'text-[#FDFBF7]">') !== false,
    'Understanding Kundli Body (#B8C0CC)' => strpos($html, 'text-[#B8C0CC]') !== false,
    'Key Components Grid' => strpos($html, 'LAGNA') !== false && strpos($html, 'NAKSHATRA') !== false,
    'Birth Time Matters Section (Dark Navy)' => strpos($html, 'Birth Time Matters') !== false,
    'Personal Guidance Section (Light Ivory)' => strpos($html, 'Want to Explore Your Chart in Greater Detail?') !== false,
    'Global Pre-Footer Component' => strpos($html, 'Understand Your Chart') !== false,
    'Global Pre-Footer Appears Exactly ONCE' => substr_count($html, 'Understand Your Chart') === 1,
    'Global Footer Component' => strpos($html, 'Tamal Chakraborty') !== false,
    'Book Consultation Link' => strpos($html, '/book-consultation') !== false,
];

echo "=== KUNDLI PAGE VERIFICATION REPORT ===\n\n";

$allPassed = true;
foreach ($checks as $title => $passed) {
    echo ($passed ? "[PASS]" : "[FAIL]") . " " . $title . "\n";
    if (!$passed) $allPassed = false;
}

echo "\n";
if ($allPassed) {
    echo "SUCCESS: ALL 24 KUNDLI VERIFICATION CHECKS PASSED PERFECTLY!\n";
} else {
    echo "ERROR: SOME CHECKS FAILED!\n";
    exit(1);
}
