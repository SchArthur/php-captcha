<?php

session_start();

$_SESSION["captcha"] = mt_rand(1000, 9999);
$img = imagecreate(100, 30);
$font_folder = $_SERVER["DOCUMENT_ROOT"] . "/fonts/captcha/";
$fonts = array_diff(scandir($font_folder), array('..', '.'));

$bg_color = mt_rand(220, 255);
$bg = imagecolorallocate($img, $bg_color, $bg_color, $bg_color);

$font_color = mt_rand(0, 30);
$textcolor = imagecolorallocate($img, $font_color, $font_color, $font_color);

$captcha_array = str_split($_SESSION["captcha"]);
$x_delta = 0;
foreach ($captcha_array as $digit) {
    $font = $font_folder . $fonts[array_rand($fonts)];

    $size_min = 17; // 17
    $size_max = 21; // 21
    $size = mt_rand($size_min, $size_max);

    $x_min = 0 + $x_delta; // 0
    $x_max = 25 - $size + $x_delta; // 50
    $x = mt_rand($x_min, $x_max);

    $y_min = $size; // 18
    $y_max = 30; // 28
    $y = mt_rand($y_min, $y_max);

    imagettftext($img, $size, 0, $x, $y, $textcolor, $font, $digit);

    $x_delta += 25;
}

header("Content-type:image/jpeg");
imagejpeg($img);
imagedestroy($img);

?>