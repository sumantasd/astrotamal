<?php
$html = file_get_contents('http://127.0.0.1:8000/');
$headPos = strpos($html, '</head>');
if ($headPos !== false) {
    echo substr($html, 0, $headPos + 7);
} else {
    echo "NO HEAD FOUND\n";
}
