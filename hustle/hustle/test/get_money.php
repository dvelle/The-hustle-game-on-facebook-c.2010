<?
$user = $_REQUEST['data'];

//$user = "jermongreen";
//$biz_id = 156;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
		
//

$query = sprintf("SELECT heist_alert FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user));
$result = mysql_query($query);
list($row) = mysql_fetch_row($result);

if($row == 2){	
	$gameid = 2285;
	
	$sql = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
							   $gameid);
				$result = mysql_query($sql);
				$result_ar = mysql_fetch_array($result);
				$file = $result_ar['file'];
				$width = $result_ar['width']; 
				$height = $result_ar['height'];
				$image = $result_ar['stdimage'];
	
				$game = "<a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\"><img src='../graphics/play_button.gif'></a>";
				$act = 1;
} elseif($row == 10) {
	$gameid = 2695;
	
	$sql = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
							   $gameid);
				$result = mysql_query($sql);
				$result_ar = mysql_fetch_array($result);
				$file = $result_ar['file'];
				$width = $result_ar['width']; 
				$height = $result_ar['height'];
				$image = $result_ar['stdimage'];
	
				$game = "<a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\"><img src='../graphics/play_button.gif'></a>";
				$act = 2;
}
$poller = json_encode(array(
  "check" => $act,
  "game" => $game,
));

echo $poller;		
?>