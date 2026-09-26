<?php
$cssUrl = 'http://127.0.0.1:8000/build/assets/app-BFYdqMHK.css';
$jsUrl = 'http://127.0.0.1:8000/build/assets/app-WC-ZjLzv.js';

function checkUrl($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headers = substr($response, 0, $headerSize);
    $body = substr($response, $headerSize);
    curl_close($ch);
    
    echo "URL: $url\n";
    echo "HTTP Status: $httpCode\n";
    echo "Body length: " . strlen($body) . " bytes\n";
    echo "First 100 bytes of body:\n" . substr($body, 0, 100) . "\n\n";
}

checkUrl($cssUrl);
checkUrl($jsUrl);
