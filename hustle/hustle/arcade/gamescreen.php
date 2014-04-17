<?php
include '../test/connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
img {
	border: none;
}
#inner_page2 {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/long_bk.png);
	height: 712px;
}

-->
</style>
</head>
<?php 
$game=$_GET['game'];
$width=$_GET['width'];
$height=$_GET['height'];
?>

<body>
<div id="inner_page2">
  <div id="game_screen" align="center">
  <object width="<? echo $width?>" height="<? echo $height;?>">
  <param name="movie" value="http://www.12daysoffun.com/hustle/arcade/swf/<? echo $game;?>">
  <embed src="http://www.12daysoffun.com/hustle/arcade/swf/<? echo $game;?>" width="<? echo $width;?>" height="<? echo $height;?>">
  </embed>
  </object>
</div>
</div>
</body>
</html>
