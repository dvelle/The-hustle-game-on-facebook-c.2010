<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['instigator'];

$target = $_POST['target'];

$shortname = $_POST['game'];

$wager = $_POST['wager'];

$style = $_POST['radio'];

if(!empty($style)){
	if(!empty($target)){
		//get user stats
		$user_ID = id($user);				
		$token = getStat('rp',$user_ID);
		//Game ID
		$query = sprintf("SELECT * FROM arcade_games WHERE UPPER(shortname) = UPPER('%s') OR UPPER(title) = UPPER('%s')",
				mysql_real_escape_string ($shortname),
				mysql_real_escape_string ($shortname));
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$gameid = $row['gameid'];
		if(!empty($gameid)){		  
			$stack = array();
			//check tokens
			if($token < 10){
				$token_l = 1;
			} else {
				$token_l = 2;
			}
			//deduct energy
			$energy = getStat('ep',$user_ID);
			$toll = $energy - 3;	
			if($toll < 0){	
				echo $token_l;
			} else {
				//check cash against wager
				$cash = getStat('cash',$user_ID);
				$debit = $cash - $wager;
				if($debit < 0){
					echo 6;
				} else {
					setStat('cash',$user_ID,$debit);
					setStat('ep',$user_ID,$toll);
				
					//insert challenge into database	
					$time = time();
					$query = sprintf("INSERT INTO arcade_challenges(time,user1,user2,action1,wager,gameid,done) VALUES ('%s','%s','%s','%s','%s','%s','%s');",
									mysql_real_escape_string($time),
									mysql_real_escape_string($user),
									mysql_real_escape_string($target),
									mysql_real_escape_string($style),
									mysql_real_escape_string($wager),
									mysql_real_escape_string($gameid),					
									0);
								mysql_query($query);
								
					//send message to challengee
					$query = sprintf("INSERT INTO h_user_news(type,time,winner,loser,wager,gameid) VALUES ('%s','%s','%s','%s','%s','%s');",
									mysql_real_escape_string("news"),
									mysql_real_escape_string($time),
									mysql_real_escape_string($user),
									mysql_real_escape_string($target),
									mysql_real_escape_string($wager),
									mysql_real_escape_string($gameid));
								mysql_query($query);
								
					$query = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
										mysql_real_escape_string($gid));
					$result = mysql_query($query);
					$game = mysql_fetch_assoc($result);
					$gname = $game["shortname"];			
								
					$mess = ucwords($user)." just bet you $".$wager." they can beat your High - Score in".ucwords($gname)." Log into Facebook and <b>THE HUSTLE</b> to accept/decline the challenge.";
					
					$query = sprintf("SELECT uppemail FROM h_users WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($target));
						$result = mysql_query($query);
					list($email) = mysql_fetch_row($result);
					
					$query = sprintf("SELECT email_on FROM h_users WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($target));
						$result = mysql_query($query);
					list($on) = mysql_fetch_row($result);
					
					if(!empty($email) && $on == 1){
						mail($email,"The Hustle Game | News Updates",$mess);
					}			
					
					//facebook data
					$query = sprintf("SELECT uid FROM h_users WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($target));
						$result = mysql_query($query);
					list($tid) = mysql_fetch_row($result);
					
					$query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($user));
						$result = mysql_query($query);
					list($firstname) = mysql_fetch_row($result);
					
					//go play game
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
					
					$query = sprintf("INSERT INTO h_fb_challenges(user1,user2,wager,image_icon,gamename) VALUES ('%s','%s','%s','%s','%s')",
									mysql_real_escape_string($firstname),
									mysql_real_escape_string($tid),
									mysql_real_escape_string($wager),
									mysql_real_escape_string($image),
									mysql_real_escape_string($shortname));
								mysql_query($query);
				}
			}
		} else {
			echo 3;
		}
	} else {
		echo 4;
	}
} else {
	echo 5;
}
?>
