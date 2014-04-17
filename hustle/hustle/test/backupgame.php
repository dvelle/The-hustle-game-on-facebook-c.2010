<?php
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$crook= $_POST['crook'];
//$user = "jermongreen";
$salary = $_POST['offer'];
$id = $_POST['id'];
$user = $_POST['who'];

$rnd_game = rand(55,3802);
$sql = sprintf("SELECT * FROM arcade_games WHERE gameid = '%s'",
			   $rnd_game);
$result = mysql_query($sql);
while($result_arr = mysql_fetch_assoc($result)){
	$file = $result_arr["file"];
	if(!empty($file)){
		break;
	}
}

$squery = sprintf("SELECT gameid FROM arcade_games WHERE file = ('%s')",
					$file);
	$sresult = mysql_query($squery);
list($gameid) = mysql_fetch_row($sresult);
		
		$time = time();
$query = sprintf("INSERT INTO h_chases(hood,user1,prize,gameid,time,caseid) VALUES ('%s','%s','%s','%s','%s','%s')",
	mysql_real_escape_string($crook),
	mysql_real_escape_string($user),
	mysql_real_escape_string($salary),
	mysql_real_escape_string($gameid),
	mysql_real_escape_string($time),
	mysql_real_escape_string($id));
	mysql_query($query);
	
	$query = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
										mysql_real_escape_string($gameid));
					$result = mysql_query($query);
					$game = mysql_fetch_assoc($result);
					$gname = $game["shortname"];
					$image = $game['stdimage'];
					$file = $game['file'];
					$width = $game['width']; 
					$height = $game['height']; 
			echo  "<a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\">CLICK HERE IF NOT WORKING</a>"; 
											   
?>