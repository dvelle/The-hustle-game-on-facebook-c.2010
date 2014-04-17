<?

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
function gangland($user){
	//law or criminal
	$sql = sprintf("SELECT law FROM h_users WHERE user = '%s'",
				   mysql_real_escape_string($user));
				   $results = mysql_query($sql);
				   list($law) = mysql_fetch_row($results);
	if($law == "criminal"){
			//check if in the middle of a mission
			$sql = sprintf("SELECT id FROM h_crimes WHERE hood = '%s' AND done = '%s'",
						   mysql_real_escape_string($user),
						   0);
						   $results = mysql_query($sql);
						   list($current) = mysql_fetch_row($results);
			if(empty($current)){
				//get next mission
				//Pick random game see if there is a high score, if not set score challenge to 1000
				$rnd_game = rand(55,3802);
				
				$query = sprintf("SELECT categoryid FROM arcade_games WHERE gameid = ('%s')",
							mysql_real_escape_string ($rnd_game));
				$result = mysql_query($query);
				list($catid) = mysql_fetch_row($result);
				
				$sql = sprintf("SELECT * FROM arcade_games WHERE gameid = '%s'",
						   $rnd_game);
				$result = mysql_query($sql);
				$odds = rand(0,100);
				//make sure game not empty
				$result_arr = mysql_fetch_assoc($result);
				if(is_array($result_arr) && $odds >= 50 && $catid != 7){
					//choose task
					//1drop off, 2pick up, 3bm, 4shipment, 5lottery
					$task_code = rand(1,5);
					if($task_code < 3){
						$task_time_limit = rand(260,650);
						$cp_bonus = rand(25,500);
						$prize = rand(0,2500);
						$squery = sprintf("SELECT * FROM arcade_highscores WHERE gamename = ('%s') ORDER by score DESC",
											$rnd_game);
							$sresult = mysql_query($squery);
							$sresult_ar = mysql_fetch_assoc($sresult);
						$challenge_score = $sresult_ar['score'];
						if(empty($challenge_score)){
							$challenge_score = 1000;
						}
						$time = time();
						$query = sprintf("INSERT INTO h_crimes(time,score1,hood,tlimit,prize,cp_bonus,gameid,task_code,done) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s');",
								mysql_real_escape_string($time),
								mysql_real_escape_string($challenge_score),
								mysql_real_escape_string($user),
								mysql_real_escape_string($task_time_limit),
								mysql_real_escape_string($prize),
								mysql_real_escape_string($cp_bonus),
								mysql_real_escape_string($rnd_game),
								mysql_real_escape_string($task_code),
								0);
							mysql_query($query);
						
						//"Complete this mission";
						$return = 1;
						return $return;
					} elseif($task_code == 5) {
						//lottery ticket challenge SELL X tickets
						$amount = rand(1,11);
						$sql = sprintf("SELECT id FROM h_users WHERE user = '%s'",
						mysql_real_escape_string($user));
						$results = mysql_query($sql);
						list($userID) = mysql_fetch_row($results);
						$onhand = getGoods("lotto",$userID);
						$new = $onhand + $amount;
						setGoods("lotto",$userID,$new);
						//let them know
						$lotto = 5;
						return $lotto;
					} elseif($task_code == 4) {
						//pick up blue magic
						$task_time_limit = rand(260,650);
						$cp_bonus = rand(25,500);
						$cost = rand(0,2500);
						$squery = sprintf("SELECT * FROM arcade_highscores WHERE gamename = ('%s') ORDER by score DESC",
											$rnd_game);
							$sresult = mysql_query($squery);
							$sresult_ar = mysql_fetch_assoc($sresult);
						$challenge_score = $sresult_ar['score'];
						if(empty($challenge_score)){
							$challenge_score = 1000;
						}
						$time = time();
						$query = sprintf("INSERT INTO h_crimes(time,score1,hood,tlimit,fee,gameid,task_code,done) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s');",
								mysql_real_escape_string($time),
								mysql_real_escape_string($challenge_score),
								mysql_real_escape_string($user),
								mysql_real_escape_string($task_time_limit),
								mysql_real_escape_string($cost),
								mysql_real_escape_string($rnd_game),
								mysql_real_escape_string($task_code),
								0);
							mysql_query($query);
						
						//"Complete this mission";
						$return = 4;
						return $return;
					} elseif($task_code == 3) {
						//pick up media shipment
						$task_time_limit = rand(260,650);
						$cost = rand(0,2500);
						$squery = sprintf("SELECT * FROM arcade_highscores WHERE gamename = ('%s') ORDER by score DESC",
											$rnd_game);
							$sresult = mysql_query($squery);
							$sresult_ar = mysql_fetch_assoc($sresult);
						$challenge_score = $sresult_ar['score'];
						if(empty($challenge_score)){
							$challenge_score = 1000;
						}
						$time = time();
						$query = sprintf("INSERT INTO h_crimes(time,score1,hood,tlimit,fee,gameid,task_code,done) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s');",
								mysql_real_escape_string($time),
								mysql_real_escape_string($challenge_score),
								mysql_real_escape_string($user),
								mysql_real_escape_string($task_time_limit),
								mysql_real_escape_string($cost),
								mysql_real_escape_string($rnd_game),
								mysql_real_escape_string($task_code),
								0);
							mysql_query($query);
						
						//"Complete this mission";
						$return = 3;
						return $return;
					}
				} else {
					//look for another game
					$return = 23;
					return $return;
				}
			} else {
				//give option to quit current mission lose cool point too
				$return = 86;
				return $return;
			}
	}
}
?>
 