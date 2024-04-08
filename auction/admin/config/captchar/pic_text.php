<?php
	$font ="RAVIE.TTF";
	$image = imagecreate(153,30);
	$bg = imagecolorallocate($image, 200, 200, 200);
	$black = imagecolorallocate($image, 0, 0, 0);
	imagettftext($image, 14, 0, 32, 20, $black, $font, $_GET['str']);
	header("Content-type:image/png");
	imagepng($image);
	imagedestroy($image);
?>