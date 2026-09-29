<?php
$files = glob('public/images/*');
foreach ($files as $f) {
    if (!is_dir($f)) {
        $s = @getimagesize($f);
        echo $f . ": " . ($s ? $s[0] . "x" . $s[1] : "not image") . "\n";
    }
}
