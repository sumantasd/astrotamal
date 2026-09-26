<?php
$baseUrl = 'http://127.0.0.1:8000';

echo "=== CONTACT PAGE QA & TESTING ===\n\n";

// 1. GET /contact
$ch = curl_init($baseUrl . '/contact');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$html = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Contact Page HTTP Status: $httpCode\n";

if ($httpCode !== 200) {
    echo "FAIL: Contact page failed to load!\n";
    exit(1);
}

// 2. Check exact contact details in HTML
$checks = [
    'Hero Heading' => "Let's Begin the Conversation",
    'Hero Eyebrow' => 'GET IN TOUCH',
    'Breadcrumb Home' => 'HOME',
    'Breadcrumb Contact' => 'CONTACT',
    'Website text' => 'astrotamal.com',
    'Website link' => 'href="https://astrotamal.com"',
    'Email text' => 'support@astrotamal.com',
    'Email link' => 'href="mailto:support@astrotamal.com"',
    'Phone text' => '96476 80707',
    'Phone link' => 'href="tel:+919647680707"',
    'Chamber location' => 'Kolkata | Bongaon | Ranaghat & More',
    'Form title' => 'Send Us a Message',
    'Form button' => 'SEND MESSAGE',
    'Consultation CTA' => 'Have Questions About Your Chart?',
    'Book Consultation link' => 'href="http://127.0.0.1:8000/book-consultation"',
];

$allPassed = true;

foreach ($checks as $label => $needle) {
    if (strpos($html, $needle) !== false) {
        echo "[OK] Found: $label ($needle)\n";
    } else {
        echo "[FAIL] Missing: $label ($needle)\n";
        $allPassed = false;
    }
}

// 3. Test Form POST Submission via cURL
// First get CSRF token from the page HTML
preg_match('/<input type="hidden" name="_token" value="([^"]+)"/', $html, $matches);
$csrfToken = $matches[1] ?? '';

echo "\nExtracted CSRF Token: $csrfToken\n";

if ($csrfToken) {
    $cookieFile = sys_get_temp_dir() . '/cookie_contact_test.txt';
    
    // First request to set session cookie
    $ch = curl_init($baseUrl . '/contact');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    $getResp = curl_exec($ch);
    curl_close($ch);

    preg_match('/<input type="hidden" name="_token" value="([^"]+)"/', $getResp, $matches);
    $csrfToken = $matches[1] ?? '';

    $postData = [
        '_token' => $csrfToken,
        'name' => 'AstroTamal QA User',
        'email' => 'contact_test@astrotamal.com',
        'phone' => '96476 80707',
        'service_interest' => 'Vedic Astrology Inquiry',
        'message' => 'Testing the redesigned contact page form submission.',
    ];

    $ch = curl_init($baseUrl . '/contact');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $postHtml = curl_exec($ch);
    $postHttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "Form POST HTTP Status: $postHttpCode\n";
    if (strpos($postHtml, 'Message Received') !== false || strpos($postHtml, 'Thank you for your message') !== false) {
        echo "[OK] Form successfully submitted and returned success flash message!\n";
    } else {
        echo "[WARN] Success message not found in POST response HTML.\n";
    }
}

// Check Database Record directly
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$latestInquiry = \App\Models\ContactInquiry::where('email', 'contact_test@astrotamal.com')->latest()->first();
if ($latestInquiry) {
    echo "[OK] Database Record Verified: ID={$latestInquiry->id}, Name={$latestInquiry->name}, Phone={$latestInquiry->phone}\n";
} else {
    echo "[FAIL] ContactInquiry record not found in DB!\n";
    $allPassed = false;
}

if ($allPassed) {
    echo "\n=== ALL CONTACT PAGE QA CHECKS PASSED PERFECTLY! ===\n";
} else {
    echo "\n=== QA CHECKS FAILED! ===\n";
}
