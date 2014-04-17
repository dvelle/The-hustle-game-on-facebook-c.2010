<?php

if (isset($GLOBALS["HTTP_RAW_POST_DATA"]))
{
	// get bytearray
	$jpg = $GLOBALS["HTTP_RAW_POST_DATA"];
	
	function copyFile($url,$filename){
		$file = $url;
		$fc = fopen($filename, "wb");
		fwrite($fc,$file);
		fclose($fc);
		return;
	}
	
	$avatar = $_SERVER['DOCUMENT_ROOT']."/12daysoffun/hustle/graphics/avatar/jermon.jpg";
	
	copyFile($jpg,$avatar);
	// add headers for download dialog-box
	//header('Content-Type: image/jpeg');
	//header("Content-Disposition: attachment; filename=".$_GET['name']);
	//echo $jpg;
}

?>