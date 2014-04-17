<?

$user = $_REQUEST['data'];

$decision = $_REQUEST['decision'];

$cpcost = $_REQUEST['balance'];

//$user = "jermongreen";
//$decision = 2;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$sql = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
$results = mysql_query($sql);
list($user_id) = mysql_fetch_row($results);

if($decision == 1){
	//retry
	$sql = sprintf("SELECT gameid FROM h_crimes WHERE UPPER(hood) = UPPER('%s') AND done = '%s'",
					   mysql_real_escape_string($user),
					   0);
		$results = mysql_query($sql);
		list($gid) = mysql_fetch_row($results);
	$query = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
										mysql_real_escape_string($gid));
					$result = mysql_query($query);
					$game = mysql_fetch_assoc($result);
					$gname = $game["shortname"];
					$image = $game['stdimage'];
					$file = $game['file'];
					$width = $game['width']; 
					$height = $game['height']; 
			echo"<a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\"><img src='../graphics/play_button.gif'></a>";
}elseif($decision == 2){
	//subtract CP
	$now = getStat("exp",$user_id);
	$debit = $now - $cpcost;
	setStat("exp",$user_id,$debit);
	$sql = sprintf("DELETE FROM h_crimes WHERE UPPER(hood) = UPPER('%s') AND done = '0'",
						mysql_real_escape_string($user));
	mysql_query($sql);

}
?>