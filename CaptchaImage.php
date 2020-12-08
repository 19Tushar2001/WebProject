<?php

//image.php

session_start();

$number = md5(rand());

$number_code = substr($number, 0, 6);

$_SESSION['captcha_code'] = $number_code;

header('Content-Type: image/png');

$image = imagecreatetruecolor(200, 38);

$background_color = imagecolorallocate($image, 231, 100, 18);

$text_color = imagecolorallocate($image, 255, 255, 255);

imagefilledrectangle($image, 0, 0, 200, 38, $background_color);

$font = dirname(__FILE__) . '/arial.ttf';

imagettftext($image, 20, 0, 60, 28, $text_color, $font, $number_code);

imagepng($image);

imagedestroy($image);

?>