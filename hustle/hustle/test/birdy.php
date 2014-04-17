<?

$user = $_POST['customer'];
//$user = "jermongreen";
//$frame = "A";
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
$userid = id($user);

$cash = getStat("cash",$userid);

	
$sql = sprintf("SELECT * FROM h_rap_sheet WHERE UPPER(cop) = UPPER('%s')",
				  mysql_real_escape_string($user));
$result = mysql_query($sql);	
$row = mysql_fetch_array($result);
$id = $row["caseid"];
$crook = $row["hood"];
$salary = $row["reward"];
$cid = id($crook);

if($_POST['accept_x']) {
	//bribed;
	$sql = sprintf("SELECT rob_won FROM h_users WHERE UPPER(user) = UPPER('%s')",
				  mysql_real_escape_string($user));
	$result = mysql_query($sql);	
	list($tot) = mysql_fetch_row($result);
	$tot = $tot + 1;
	$query = sprintf("UPDATE h_users SET rob_won = '%s' WHERE UPPER(user) = ('%s')",
		mysql_real_escape_string($tot),
		mysql_real_escape_string($user));
	mysql_query($query);
	
	$sql = sprintf("SELECT jackpot FROM h_user_assets WHERE asset_id = (SELECT id FROM h_special_items WHERE name = ('%s')) AND user_id = ('%s')",
				  mysql_real_escape_string("bribe"),
				  mysql_real_escape_string($cid));
	$result = mysql_query($sql);	
	list($bribe) = mysql_fetch_row($result);
	$cash = getStat("cash",$userid);
	$deposit = $cash + $bribe;
	setStat("cash",$userid,$deposit);
	
	$sql = sprintf("DELETE FROM `h_user_arsenal` WHERE `user_id` = ('%s') AND `arsenal_id` = (SELECT id FROM h_special_items WHERE name = ('%s'))",
					mysql_real_escape_string ($cid),
					mysql_real_escape_string ("bribe"));
			mysql_query($sql);
			
	$recipient_message = "Your bribe just saved you the trouble of losing everything, for now";
						//
	hustle_reporter($crook,1,$recipient_message,"recipient");		
	echo 1;
} elseif ($_POST['stop_x']) { 
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
					
	$query = sprintf("UPDATE h_rap_sheet SET cop = '%s' WHERE UPPER(hood) = ('%s')",
		mysql_real_escape_string("Police"),
		mysql_real_escape_string($crook));
	mysql_query($query);
	
	echo  "<a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\"><img src='../graphics/play_button.gif'></a>";
}
//

?>
