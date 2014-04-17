<?
$user = $_REQUEST['data'];

//$user = "jermongreen";
//$biz_id = 156;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$query = sprintf("SELECT biz_owner FROM h_heists WHERE UPPER(culprit) = UPPER('%s')",
					mysql_real_escape_string($user));
$result = mysql_query($query);
list($owner) = mysql_fetch_row($result);

$query = sprintf("SELECT id FROM arcade_challenges WHERE UPPER(user2) = UPPER('%s') AND user1 = '%s'",
					mysql_real_escape_string($user),
					"LISA");
$result = mysql_query($query);
list($id) = mysql_fetch_row($result);
if(!empty($owner)){
	$query = sprintf("SELECT gamename,MAX(score) FROM arcade_highscores WHERE username = ('%s') LIMIT 1",
						mysql_real_escape_string($owner));
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$gameid = $row["$gamename"];
	
	if(!empty($game_id)){
		$sql = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
								   $gameid);
					$result = mysql_query($sql);
					$result_ar = mysql_fetch_array($result);
					$file = $result_ar['file'];
					$width = $result_ar['width']; 
					$height = $result_ar['height'];
					$image = $result_ar['stdimage'];
					$message = json_encode(array(
												 "file" => $file,
												 "width" => $width,
												 "height" => $height,
												 ));
					echo"<a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\"><img src='../graphics/play_button.gif'></a>";
	} else {
		$gameid = 3782;
		$sql = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
								   $gameid);
					$result = mysql_query($sql);
					$result_ar = mysql_fetch_array($result);
					$file = $result_ar['file'];
					$width = $result_ar['width']; 
					$height = $result_ar['height'];
					$image = $result_ar['stdimage'];
					$message = json_encode(array(
												 "file" => $file,
												 "width" => $width,
												 "height" => $height,
												 ));
					echo"<a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\"><img src='../graphics/play_button.gif'></a>";
	}
} elseif(!empty($id)) {
	$gameid = 3782;
		$sql = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
								   $gameid);
					$result = mysql_query($sql);
					$result_ar = mysql_fetch_array($result);
					$file = $result_ar['file'];
					$width = $result_ar['width']; 
					$height = $result_ar['height'];
					$image = $result_ar['stdimage'];
					$message = json_encode(array(
												 "file" => $file,
												 "width" => $width,
												 "height" => $height,
												 ));
					echo"<a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\"><img src='../graphics/play_button.gif'></a>";
}
?>