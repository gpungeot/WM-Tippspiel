<?php
header("Content-type: image/png");

$rankstring = $_GET["ranks"];
$max = $_GET["max"];
$ranks = preg_split("/[,]/", $rankstring);

// Create image and define colors
$width = 400; $height = 300;
$image=imagecreate($width, $height);
$colorWhite=imagecolorallocate($image, 255, 255, 255);
$colorBlack=imagecolorallocate($image, 0, 0, 0);
// Drawing

$intervals = sizeof($ranks) - 1;
//print("Abschnitte ".$intervals);
$intervalwidth = $width / $intervals;
//print("Abschnittsbreite ".$intervalwidth);
$intervalheight = $height / $max;
//print("Abschnittshoehe ".$intervalheight."<br>");
for($i = 0; $i < ($intervals - 1); $i++) {
	$r = $ranks[$i];
	
	$x1 = ($i * $intervalwidth);
	$y1 = (($r-1) * $intervalheight);
	$x2 = (($i+1) * $intervalwidth);
	$y2 = (($ranks[$i + 1]-1) * $intervalheight);
	//print("Von (".$x1.",".$y1.") nach (".$x2.",".$y2.")<br>");
	imageline($image, $x1, $y1, $x2, $y2, $colorBlack);
	imagestring($image, 4, $x2, $y2, $ranks[$i + 1], $colorBlack);
}
// Output graph and clear image from memory
imagepng($image);
imagedestroy($image);
?>