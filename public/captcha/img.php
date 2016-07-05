<?php

session_start();
$string = md5(time());
$string = substr($string, 0, 6);

$_SESSION['verify'] = md5(md5($string));

$img = imagecreate(65, 30);
$background = imagecolorallocate($img, 32, 128, 176);
$text_color = imagecolorallocate($img, 255, 255, 255);
imagestring($img, 6, 5, 5, $string, $text_color);

header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
?>