<?php
header('Content-Type: image/png');

$filename = 'jermon.png';

$avatar = $_SERVER['DOCUMENT_ROOT']."/12daysoffun/hustle/graphics/avatar/".$filename;

$img = imagecreatefrompng($avatar);

//imagetruecolortopalette($img, false, 255);

$white = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);

// Make the background transparent
imagecolortransparent($img, $white);

imagepng($img);
?>