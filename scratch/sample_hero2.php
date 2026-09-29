<?php
$im = imagecreatefromjpeg('public/images/ganesha-temple-hero.jpg');
$w = imagesx($im);
$h = imagesy($im);
echo "Width: $w, Height: $h\n";

$samples = [
    'top-left (10%,10%)' => imagecolorsforindex($im, imagecolorat($im, (int)($w*0.1), (int)($h*0.1))),
    'top-center (50%,10%)' => imagecolorsforindex($im, imagecolorat($im, (int)($w*0.5), (int)($h*0.1))),
    'top-right (90%,10%)' => imagecolorsforindex($im, imagecolorat($im, (int)($w*0.9), (int)($h*0.1))),
    'center (50%,50%)' => imagecolorsforindex($im, imagecolorat($im, (int)($w*0.5), (int)($h*0.5))),
    'bottom-left (20%,80%)' => imagecolorsforindex($im, imagecolorat($im, (int)($w*0.2), (int)($h*0.8))),
    'bottom-right (80%,80%)' => imagecolorsforindex($im, imagecolorat($im, (int)($w*0.8), (int)($h*0.8))),
];

foreach ($samples as $pos => $rgb) {
    printf("%-25s: R=%3d, G=%3d, B=%3d (Hex: #%02X%02X%02X)\n", $pos, $rgb['red'], $rgb['green'], $rgb['blue'], $rgb['red'], $rgb['green'], $rgb['blue']);
}
