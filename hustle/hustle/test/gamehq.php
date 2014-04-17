<?php
$data = $_GET["data"];

list($fb_user, $name, $score) = explode(":", $data);

require_once('stats.php');

require_once('connect.php');

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s')",
													 mysql_real_escape_string ($user),
													 1);
mysql_query($sql); 

//
//Variable Test /Capture zone
//
$gname = $name;
$score = $score + 1;
if(is_numeric($score)){
	$gscore = $score;
} else {
	$gscore = 1;
}
//functions
function bonus($level, $rank_title){
	if($rank_title == "Rookie"){
		$r = 7;
	} elseif($rank_title == "Amateur"){
		$r = 6;
	} elseif($rank_title == "Upstart"){
		$r = 5;
	} elseif($rank_title == "Pro"){
		$r = 4;
	} elseif($rank_title == "Boss"){
		$r = 3;
	} elseif($rank_title == "Mastermind"){
		$r = 2;
	} else {
		$r = 1;
	}
	//do the biz!
	$level = $level + $r;
	$level_number = rand(0,$level);
	if($level_number > 10){
		$level_number = 9;
	}
	$cpb = rand($level_number,10);
	if($cpb > 10){
		$cpb = 10;
	}
	return $cpb;
}
//packages
function egg($total,$username){
	$userID = id($username); 
	if($total == 10){
		//molotov cocktail
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
		mysql_real_escape_string("Molotov Cocktail"),
		mysql_real_escape_string($userID),
		mysql_real_escape_string(10));
		mysql_query($query);
		
		$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("Molotov Cocktail"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
		return;
	} elseif($total == 20){
		//chainsaw
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
		mysql_real_escape_string("Chainsaw"),
		mysql_real_escape_string($userID),
		mysql_real_escape_string(1));
		mysql_query($query);
		
		$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("Chainsaw"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
		return;
	} elseif($total == 30){
		//barbarian sword
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
		mysql_real_escape_string("Barbarian's Sword"),
		mysql_real_escape_string($userID),
		mysql_real_escape_string(1));
		mysql_query($query);
		//add cool points
		$cool = getStat("exp",$userID);
		$up = $cool + 500;
		setStat("exp",$userID,$up);
		
		$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("Barbarian's Sword"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
		return;
	} elseif($total == 40){
		//Grenades
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
		mysql_real_escape_string("Grenades"),
		mysql_real_escape_string($userID),
		mysql_real_escape_string(10));
		mysql_query($query);
		
		$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("Grenades"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
		return;
	} elseif($total == 50){
		//M16
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
		mysql_real_escape_string("M-16"),
		mysql_real_escape_string($userID),
		mysql_real_escape_string(1));
		mysql_query($query);
		
		$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("M-16"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
		return;
	} elseif($total == 60){
		//Flame Thrower
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
		mysql_real_escape_string("Flame Thrower"),
		mysql_real_escape_string($userID),
		mysql_real_escape_string(1));
		mysql_query($query);
		
		$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("Flame Thrower"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
		return;
	} elseif($total == 70){
		//Rocket Launcher
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
		mysql_real_escape_string("Rocket Launcher"),
		mysql_real_escape_string($userID),
		mysql_real_escape_string(1));
		mysql_query($query);
		$cool = getStat("exp",$userID);
		$up = $cool + 100;
		setStat("exp",$userID,$up);
		
		$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("Rocket Launcher"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
		return;
	} elseif($total == 80){
		//Plasma Rifle
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
		mysql_real_escape_string("Plasma Rifle"),
		mysql_real_escape_string($userID),
		mysql_real_escape_string(1));
		mysql_query($query);
		$cool = getStat("exp",$userID);
		$up = $cool + 600;
		setStat("exp",$userID,$up);
		
		$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("Plasma Rifle"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
		return;
	} elseif($total == 90){
		//gatling Gun
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
		mysql_real_escape_string("Gatling Gun"),
		mysql_real_escape_string($userID),
		mysql_real_escape_string(1));
		mysql_query($query);
		$cool = getStat("exp",$userID);
		$up = $cool + 300;
		setStat("exp",$userID,$up);
		
		$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("Gatling Gun"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
		return;
	} elseif($total == 100){
		//Tank
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
		mysql_real_escape_string("Tank"),
		mysql_real_escape_string($userID),
		mysql_real_escape_string(1));
		mysql_query($query);
		$cool = getStat("exp",$userID);
		$up = $cool + 990;
		setStat("exp",$userID,$up);
		
		$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("Tank"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
		return;
	}
	return;
}
//BATTLE PREPARATION FUNCTION
function battle_prep($user,$state){
	//Retrieve fighter ID
	$query = sprintf("SELECT id FROM h_users WHERE user = ('%s')",
		mysql_real_escape_string ($user));
	$result = mysql_query($query);
	list($userID) = mysql_fetch_row($result);
	//Retrieve instigator account details(Cash, Cool, Crew fight status, Muscle, 	   
	//Weapons, crew id, crew members)
		//$i_energy = getStat('ep',$userID);
	$i_cool = getStat('exp',$userID);
	$i_cash = getStat('cash',$userID);
		//$token = getStat('rp',$userID);
		//$crew_rank = getCRank($userID);
	//Retrieve level
	require_once('leveler.php');
	$rank = leveler($i_cool);
	$stage = $rank[0];
	$title = $rank[1];
	//Retrieve Ride or Die Crew Members and Total weapons | total weapons available  = 
	//total number crew fighting
	$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
		mysql_real_escape_string ($user));
	$result = mysql_query($query);
	list($crewID) = mysql_fetch_row($result);
	//Muster members
	$query = sprintf("SELECT COUNT(id) FROM h_crew_member WHERE crew_id = ('%s') AND party = ('%s')",
		mysql_real_escape_string ($crewID),
		1);
	$result = mysql_query($query);
	list($posse) = mysql_fetch_row($result);
	if(!isset($posse)){
		$posse = 1;
	}
	//****************Total weapons available<br>
	//***************************************************
	//*************************************************************
	$query = sprintf("SELECT arsenal_id, quantity FROM h_user_arsenal WHERE user_id = ('%s')",
				 $userID);
	$result = mysql_query($query);
	$strength = array();
	$tot_power = array();
	$id = array();
	$att = array();
	$total = array();
	while($weapons_ar = mysql_fetch_assoc($result)){
		$weapon = $weapons_ar["arsenal_id"];
		$weapon_tot = $weapons_ar["quantity"];
		$weapon_pow = weapon_atts($weapon, $state);
		if(isset($weapon_pow)){				 
			array_push($id, $weapon);
			array_push($att, $weapon_pow);
			array_push($total, $weapon_tot);
			if($weapon == 90){
				$rambo = getWeggs("Molotov Cocktail",$userID);
				if($rambo == 1){
					$sql = sprintf("DELETE FROM `h_user_arsenal` WHERE `user_id` = ('%s') AND `arsenal_id` = ('%s')",
							mysql_real_escape_string ($userID),
							mysql_real_escape_string ($weapon));
					mysql_query($sql);
				} else {
					$rambo = $rambo - 1;
					setWeggs("Molotov Cocktail",$userID,$rambo);
				}
			} else if ($weapon == 93){
				$rambo = getWeggs("Grenades",$userID);
				if($rambo == 1){
					$sql = sprintf("DELETE FROM `h_user_arsenal` WHERE `user_id` = ('%s') AND `arsenal_id` = ('%s')",
							mysql_real_escape_string ($userID),
							mysql_real_escape_string ($weapon));
					mysql_query($sql);
				} else {
					$rambo = $rambo - 1;
					setWeggs("Grenades",$userID,$rambo);
				}
			}
		}
	}
	//strongest weapon for current state
	$amount = count($att);
	//////////////////////////////////
	$stack = array();
	while($i < $amount){
		$value = max($att);
		$key = array_search($value, $att);
		$weaptot = $total[$key];
		$w_strength = assessment($value,$weaptot,$posse);
		if(!is_array($w_strength)){
			$extra = $w_strength;
		   break;
		}
		array_push($stack, $w_strength[1]);
		$posse = $w_strength[0];
		unset($att[$key]);	
		$i++;
	}
	$scale = array_sum($stack);
	$weapon_power = $scale + $extra;
	//****************Total MUSCLE available<br>
	//*****************************MUSCLE*****************
	//************************************MUSCLE*******************
	$query = sprintf("SELECT arsenal_id, quantity FROM h_user_arsenal WHERE user_id = ('%s')",
				 $userID);
	$result = mysql_query($query);
	$strength = array();
	$tot_power = array();
	$att = array();
	$total = array();
	$muscle_ar = mysql_fetch_assoc($result);
	if(is_array($muscle_ar)){
		while($muscle_ar = mysql_fetch_assoc($result)){
			$muscle = $muscle_ar["arsenal_id"];
			$muscle_tot = $muscle_ar["quantity"];
			$muscle_pow = muscle_atts($muscle, $state);
			if(isset($muscle_pow)){				 
				array_push($id, $muscle);
				array_push($att, $muscle_pow);
				array_push($total, $muscle_tot);
			}
		}
		//strongest muscle for current state
		$amount = count($att);
		//////////////////////////////////
		$stack = array();
		while($i < $amount){
			$value = max($att);
			$key = array_search($value, $att);
			$muscletot = $total[$key];
			$w_strength = $muscletot * $value;
			array_push($stack, $w_strength);
			unset($att[$key]);	
			$i++;
		}
		
		$muscle_power = array_sum($stack);
		$drug = piss_test($user);
		$muscle_power = muscle_power + $drug;
		$subtot_power = $muscle_power + $weapon_power;
		//Strength Multiplier Bonus
		//Retrieve level
		require_once('leveler.php');
		$rank = leveler($i_cool);
		$stage = $rank[0];
		$title = $rank[1];
		$coolbonus = bonus($stage,$title);
		
		$total_power = $coolbonus * $subtot_power;
		return $total_power;
		
	} else {
		
		$muscle_power = 0;
		$subtot_power = $muscle_power + $weapon_power;
		//Strength Multiplier Bonus
		 $coolbonus = bonus($stage,$title);
		 $total_power = $coolbonus * $subtot_power;
		return $total_power;
	}
}

//COOL POINT ADJUSTER
function coolpoint_adjuster($userID,$math,$adjusted){
	$current_cool = getStat('exp',$userID);
	if($math == "add"){
		$cool = $current_cool + $adjusted;
		$complete = setStat('exp',$userID,$cool);
	} else {
		//check adjusted cool against assets make sure not lower than assets allow
		$wealth_barrier = assets_valuation($userID);
		$basement_test = $current_cool - adjusted;
		$variable_c = $basement_test - $wealth_barrier;
		if($variable_c <= 0){
			return;
		} else {
			// Deduct
			$complete = setStat('exp',$userID,$basement_test);
		}
	}
	return;
}

//
////Identify User name
$query = sprintf("SELECT * FROM h_users WHERE uid = ('%s')",
			mysql_real_escape_string ($fb_user));
$result = mysql_query($query);
$defender_ar = mysql_fetch_assoc($result);
$user_name = $defender_ar["user"];
$user_ID = $defender_ar["id"];

////Identify Game ID
$query = sprintf("SELECT * FROM arcade_games WHERE shortname = ('%s') OR title = ('%s')",
			mysql_real_escape_string ($gname),
			mysql_real_escape_string ($gname));
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$gameid = $row['gameid'];
$isreverse = $row['isreverse'];
$gid = $gameid;

//TIMES PLAYED UPDATE
$que = sprintf("SELECT timesplayed FROM arcade_games WHERE shortname = ('%s')",
							mysql_real_escape_string($gname));
$result = mysql_query($que);
list($tp) = mysql_fetch_row($result);

$tp = $tp + 1;

$sql = sprintf("UPDATE arcade_games SET timesplayed = ('%s') WHERE shortname = ('%s')",
	mysql_real_escape_string($tp),
	mysql_real_escape_string($gname));
	mysql_query($sql);
//Is this a casino game?
$query = sprintf("SELECT categoryid FROM arcade_games WHERE gameid = ('%s')",
			mysql_real_escape_string ($gid));
$result = mysql_query($query);
list($catid) = mysql_fetch_row($result);
if($catid != 7){
	//Is user a challenge instigator?
	$query = sprintf("SELECT * FROM arcade_challenges WHERE UPPER(user1) = UPPER('%s') AND gameid = ('%s') AND done = ('%s')",
				mysql_real_escape_string ($user_name),
				mysql_real_escape_string ($gid),
				0);
	$result = mysql_query($query);
	$finish_ar = mysql_fetch_assoc($result);
	///YES THEY ARE THE INSTIGATOR!!!
	//update score
	if(is_array($finish_ar)){
		$time = time();
		$challenge_id = $finish_ar["id"];
		$query = sprintf("UPDATE arcade_challenges SET score1 = ('%s'), time = ('%s') WHERE id = ('%s') AND UPPER(user1) = UPPER('%s')",
				mysql_real_escape_string ($gscore),
				mysql_real_escape_string ($time),
				mysql_real_escape_string ($challenge_id),
				mysql_real_escape_string ($user_name));
		mysql_query($query);
		
		$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `loser`, `score`, `wager`,`wait`) VALUES ('1', '$time', '$user_name', '$gscore','$wager','1')";
					mysql_query($sql);
					
		header('Location: start.php');
	} else {
		////Identify if user satisfied a challenge | Are they the defender?
		$query = sprintf("SELECT * FROM arcade_challenges WHERE UPPER(user2) = UPPER('%s') AND gameid = ('%s') AND `done` = ('%s')",
					mysql_real_escape_string ($user_name),
					mysql_real_escape_string ($gid),
					0);
		$result = mysql_query($query);
		$fight_ar = mysql_fetch_assoc($result);
	
		//////Battle Prep!
		if(is_array($fight_ar)){
			//Retrieve all fight variables
			$instigator = $fight_ar["user1"];
			$instigator_s = $fight_ar["score1"];
			$challenge_id = $fight_ar["id"];
			
			$ia_query = sprintf("SELECT action1 FROM arcade_challenges WHERE UPPER(user2) = UPPER('%s') AND gameid = ('%s') AND `done` = ('%s')",
					mysql_real_escape_string ($user_name),
					mysql_real_escape_string ($gid),
					0);
			$ia_result = mysql_query($ia_query);
			list($ins_action) = mysql_fetch_row($ia_result);
		
			$da_query = sprintf("SELECT action2 FROM arcade_challenges WHERE UPPER(user2) = UPPER('%s') AND gameid = ('%s') AND `done` = ('%s')",
						mysql_real_escape_string ($user_name),
						mysql_real_escape_string ($gid),
						0);
			$da_result = mysql_query($da_query);
			list($def_action) = mysql_fetch_row($da_result);
			
			$wquery = sprintf("SELECT wager FROM arcade_challenges WHERE UPPER(user2) = UPPER('%s') AND gameid = ('%s') AND `done` = ('%s')",
					mysql_real_escape_string ($user_name),
					mysql_real_escape_string ($gid),
					0);
			$da_result = mysql_query($wquery);
			list($wager) = mysql_fetch_row($da_result);
			
			//Insert new score
			$time = time();
			$query = sprintf("UPDATE arcade_challenges SET score2 = ('%s'), time = ('%s'), done = ('%s') WHERE id = ('%s') AND UPPER(user2) = UPPER('%s')",
					mysql_real_escape_string ($gscore),
					mysql_real_escape_string ($time),
					1,
					mysql_real_escape_string ($challenge_id),
					mysql_real_escape_string ($user_name));
			mysql_query($query);
			
			$query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user_name));
					$result = mysql_query($query);
			list($firstname) = mysql_fetch_row($result);

			$sql = sprintf("DELETE FROM h_fb_challenges WHERE user1 = ('%s')",
						mysql_real_escape_string ($firstname));
					mysql_query($sql);
			//Check scores	
			if($gscore > $instigator_s){
				$r_news = "you won";
				$s_news = "losing";
				$defender_win = 1;
			} else {
				$r_news = "they won";
				$s_news = "you won";
				$defender_win = 0;
			}	
			//Retrieve Instigator User ID
			$i_userID = id($instigator);
			if(!empty($i_userID)){
				//AND Retrieve Instigator Crew ID
				$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
								mysql_real_escape_string ($instigator));
				$result = mysql_query($query);
				list($i_crewID) = mysql_fetch_row($result);
				//
				//Retrieve action settings
				if($ins_action == "defend" && $def_action == "defend"){
					$battle = 0;
				} else {
					$battle = 1;
				}
				//BATTLE-FIELD
			} else {
				$battle = 0;
			}
			if($battle == 1){
				 // ************ROBBERY************************************
				 //********************ROBBERY*****************************
				 //****************************ROBBERY*********************
				 $instigator_strength = battle_prep($instigator,$ins_action);
				 $defender_strength = battle_prep($user_name,$def_action);
				
				 ////FIGHT!
				 $i_tactics = $instigator_strength;
				 $sql = sprintf("UPDATE arcade_challenges SET power1 = ('%s') WHERE id = ('%s')",
						mysql_real_escape_string($i_tactics),
						mysql_real_escape_string($challenge_id));
						mysql_query($sql);
						
				 $d_tactics = $defender_strength;
				 $sql = sprintf("UPDATE arcade_challenges SET power2 = ('%s') WHERE id = ('%s')",
						mysql_real_escape_string($d_tactics),
						mysql_real_escape_string($challenge_id));
						mysql_query($sql);
				 if($i_tactics > $d_tactics){
					//****************
					//instigator wins
					//****************
					$sql = sprintf("UPDATE arcade_challenges SET done = ('%s') WHERE id = ('%s')",
						mysql_real_escape_string(1),
						mysql_real_escape_string($challenge_id));
						mysql_query($sql);
						$query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($instigator));
					$result = mysql_query($query);
					list($firstname) = mysql_fetch_row($result);

					$sql = sprintf("DELETE FROM h_fb_challenges WHERE user1 = ('%s')",
						mysql_real_escape_string ($firstname));
					mysql_query($sql);
					//PROFILE UPDATE
					
					//Challenge won
					$que = sprintf("SELECT ch_won FROM h_users WHERE user=('%s')",
								mysql_real_escape_string($instigator));
					$result = mysql_query($que);
					list($ch_won) = mysql_fetch_row($result);
					
					$ch_won = $ch_won + 1;
					
					$sql = sprintf("UPDATE h_users SET ch_won = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string($ch_won),
						mysql_real_escape_string($instigator));
						mysql_query($sql);
						
					//Robbery Won
					$que = sprintf("SELECT rob_won FROM h_users WHERE user=('%s')",
								mysql_real_escape_string($instigator));
					$result = mysql_query($que);
					list($rob_won) = mysql_fetch_row($result);
					
					$rob_won = $rob_won + 1;
					
					$sql = sprintf("UPDATE h_users SET rob_won = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string($rob_won),
						mysql_real_escape_string($instigator));
						mysql_query($sql);
					//
					
					$robbery_value = $i_tactics - $d_tactics;
					//medical
					medical($robbery_value,$userID,$user_name);
					//
					$hit = rand(1,$robbery_value);
					//check if cleader and crew have the CASH...
					$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
									mysql_real_escape_string($user_name));
					$result = mysql_query($query);
					list($crewID) = mysql_fetch_row($result);
				
					$net_worth = crew_worth($user_ID, $crewID);
					//EXIT POINT
					if($net_worth <= 0){
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `winner`, `score`, `wager`,`wait`) VALUES ('1', '$time', '$instigator', '$gscore','$wager','3')";
							mysql_query($sql);
							$pocket = getStat("cash",$i_userID);
							$dep = $pocket + $wager;
							setStat("cash",$i_userID,$dep);
							header('Location: start.php');
					} else {
						$paper = $net_worth - $hit;
						if($paper <= 0){
							$hit = $net_worth;
							$extra = " Additionally, you bankrupt them...";
						}
					
						$cash_stolen = $hit + $wager;
						//record robbery
						$time = time();
						//
						//cash awarded, Cool Points adjusted and then loss and winnings split
						
						$posse = how_deep($instigator);
						if($posse == 1){
							$mine = $cash_stolen;
						} else {
							//*************
							$who = "circle";
							$flow = "positive";
							//*************
							$c_take = pc_pay($i_crewID,$cash_stolen,$instigator,$posse,$who,$flow);
							$left = $cash_stolen - $c_take;
							//*************
							$who = "general";
							$flow = "positive";
							//***************
							
							//Muster members
							$query = sprintf("SELECT COUNT(id) FROM h_crew_member WHERE crew_id = ('%s')",
								mysql_real_escape_string ($i_crewID));
							$result = mysql_query($query);
							list($posse) = mysql_fetch_row($result);
							//
							$gen_share = pg_pay($i_crewID,$left,$instigator,$posse,$who,$flow);
							$mine = $left - $gen_share;
						}
							
						$i_cash = getStat('cash',$i_userID);
						$net_take = $i_cash + $mine;
						$mk_deposit = setStat('cash',$i_userID,$net_take);
						//
						//cool points lost
						$cool_points_lost = rand(1,$cash_stolen);
						$math = "substract";
						$finished = coolpoint_adjuster($i_userID,$math,$cool_points_lost);
						medical($cool_points_lost,$i_userID,$instigator);
						//Spread Defender's CASH Loss (and earn cool points!)
						//AND Retrieve User Crew ID
						
						//PROFILE UPDATE
						
						//Challenge Lost
						$que = sprintf("SELECT ch_lost FROM h_users WHERE user=('%s')",
								mysql_real_escape_string($user_name));
						$result = mysql_query($que);
						list($ch_lost) = mysql_fetch_row($result);
						
						$ch_lost = $ch_lost + 1;
						
						$sql = sprintf("UPDATE h_users SET ch_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_lost),
							mysql_real_escape_string($user_name));
							mysql_query($sql);
												
						//Robbed
						$que = sprintf("SELECT robbed_tot FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($user_name));
						$result = mysql_query($que);
						list($rob_tot) = mysql_fetch_row($result);
						
						$rob_tot = $rob_tot + 1;
						
						$sql = sprintf("UPDATE h_users SET robbed_tot = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_tot),
							mysql_real_escape_string($user_name));
							mysql_query($sql);
							
						//Snitch
						
						$sql_l = sprintf("UPDATE h_users SET snitch = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string(1),
							mysql_real_escape_string($user_name));
							mysql_query($sql_l);
						//
						
						$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
										mysql_real_escape_string($user_name));
						$result = mysql_query($query);
						list($crewID) = mysql_fetch_row($result);
					
						//DEFENDER POSSE
						$d_posse = how_deep($user_name);
						
						//Debit
						
						if($cash_stolen <= 1){
							$their_loss = 1; 
						} else {
							//*************
							$who = "circle";
							$flow = "negative";
							//*************	
							$circle_debit = nc_pay($crewID,$cash_stolen,$user_name,$d_posse,$who,$flow);
							$now_owed = $cash_stolen - $circle_debit;
							//*************
							$who = "general";
							$flow = "negative";
							//*************	
							$general_debit = ng_pay($crewID,$now_owed,$user_name,$d_posse,$who,$flow);
							$i_owe = $cash_stolen - $general_debit;
							$their_loss = $i_owe;
						}
						$d_cash = getStat('cash',$user_ID);
						$net_loss = $d_cash - $their_loss;
						$mk_debit = setStat('cash',$user_ID,$net_loss);
						
						//COOL POINTS EARNED for fighting the good fight! | maybe
						$adjusted = rand(1,$cash_stolen);			
						$luck = rand(1,3);
						
						if($luck == 1){
							$math = "add";
							$report = $adjusted;
							$d_extra_news = "earning you ".$report."CP";
							$finished = coolpoint_adjuster($user_ID,$math,$adjusted);
						} elseif($luck == 3) {
							$math = "subtract";
							$d_extra_news = "costing you ".$report."CP";
							$finished = coolpoint_adjuster($user_ID,$math,$adjusted);
							$b_report = $adjusted;
						}		
						
						$time = time();
						//ARCADE
						
						//USER NEWS
						//********************************************
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `loser`, `score`,`fight`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
					$result=mysql_query($sql);
					
						$recipient_message = $instigator." robbed you of $".$cash_stolen." after ".$r_news." a game of ".$gname.$d_extra_news;
						//
						reporter($user_name,1,$recipient_message,"recipient");
						//				
						$sender_message = "You robbed ".$user_name." of $".$cash_stolen." after ".$s_news." a game of ".$gname. " costing you ".$cool_points_lost."CP";
						reporter($instigator,1,$sender_message,"recipient");			
					}
					header('Location: start.php');
				 } elseif($i_tactics < $d_tactics) {
					$sql = sprintf("UPDATE arcade_challenges SET done = ('%s') WHERE id = ('%s')",
							mysql_real_escape_string(1),
							mysql_real_escape_string($challenge_id));
							mysql_query($sql);
					//defender wins
					//PROFILE UPDATE
					
					//Challenge won
					$que = sprintf("SELECT ch_won FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($user_name));
					$result = mysql_query($que);
					list($ch_won) = mysql_fetch_row($result);
					
					$ch_won = $ch_won + 1;
					
					$sql = sprintf("UPDATE h_users SET ch_won = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string($ch_won),
						mysql_real_escape_string($user_name));
						mysql_query($sql);
						
					//Robbery lost
					$que = sprintf("SELECT rob_lost FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
					$result = mysql_query($que);
					list($rob_lost) = mysql_fetch_row($result);
					
					$rob_lost = $rob_lost + 1;
					
					$sql = sprintf("UPDATE h_users SET rob_lost = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string($rob_lost),
						mysql_real_escape_string($instigator));
						mysql_query($sql);
										
					////Challenge lost
					$que = sprintf("SELECT ch_lost FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
					$result =mysql_query($que);
					list($ch_lost) = mysql_fetch_row($result);
					
					$ch_lost = $ch_lost + 1;
					
					$sql = sprintf("UPDATE h_users SET ch_lost = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string($ch_lost),
						mysql_real_escape_string($instigator));
						mysql_query($sql);
						
					//
					$net_take = $d_tactics - $i_tactics;
					//health
					medical($net_take,$i_userID,$instigator);
					if($def_action == "attack"){
						$cool_points_earned = rand(1,$net_take);
						$number = $net_take - $cool_points_earned;
						$cash_gain = rand(0,$number);
						// Guilty or Innocent 
						if($defender_win == 1){
							$math = "add";
							$d_extra_news = " earning you ";
						}else{
							$math = "subtract";
							$d_extra_news = " costing you ";
						}
						$adjusted = $cool_points_earned;
						coolpoint_adjuster($user_ID,$math,$adjusted);
						//Cash Deposit
						$d_cash = getStat('cash',$user_ID);
						$cash_gain = $wager + $cash_gain;
						$net_gain = $d_cash + $cash_gain;
						$mk_deposit = setStat('cash',$user_ID,$net_gain);
						//News
					} else {				
						$cool_points_earned = rand(1,$net_take);
						$math = "add";
						$adjusted = $cool_points_earned;
						coolpoint_adjuster($user_ID,$math,$adjusted);
						//Cash Deposit
						$d_cash = getStat('cash',$user_ID);
						$net_gain = $d_cash + $wager;
						$mk_deposit = setStat('cash',$user_ID,$net_gain);
					}
					//Instigator Lost Cool
					$cool_points_loss = rand(1,$net_take);
					$math = "subtract";
					coolpoint_adjuster($i_userID,$math,$cool_points_loss);
					medical($cool_points_loss,$user_ID,$user_name);
					//BREAKING NEWS********************************************//BREAKING NEWS
					$time = time();
					$plus = $cool_points_earned."CP";
					//ARCADE
					$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `winner`, `loser`, `score`, `wager`,`fight`) VALUES ('1', '$time', '$user_name', '$instigator', '$gscore','$wager','1')";
					$result=mysql_query($sql);
					//USER NEWS
					$recipient_message = $instigator." tried to rob you after ".$r_news." a game of ".$gname.$d_extra_news.$plus;
						//
					reporter($user_name,1,$recipient_message,"recipient");
					//				
					$sender_message = "Your robbery of ".$user_name." failed, after ".$s_news." a game of ".$gname. " costing you ".$cool_points_loss." CP";
					reporter($instigator,1,$sender_message,"recipient");
					header('Location: start.php');
				 } elseif($i_tactics == $d_tactics){
					 //stalemate
					 $recipient_message = $instigator." attempted to over power and rob you but you <b>resisted</b>!";
					//
					reporter($user_name,1,$recipient_message,"recipient");
					//				
					$sender_message = $user_name." was stronger than you thought and <b>resisted</b> your robbery attempt!";
					reporter($instigator,1,$sender_message,"recipient");
				 }
			} else {
				 //FAIR PLAY
				 ////////////////////////////////////////////////////////////
				 ////////////FAIR PLAY//////////////////////////////////////
				 ///////////////////////FAIR PLAY///////////////////////////
				 $sql = sprintf("UPDATE arcade_challenges SET done = ('%s') WHERE id = ('%s')",
						mysql_real_escape_string(1),
						mysql_real_escape_string($challenge_id));
				 mysql_query($sql);
				 $query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($instigator));
					$result = mysql_query($query);
list($firstname) = mysql_fetch_row($result);

			$sql = sprintf("DELETE FROM h_fb_challenges WHERE user1 = ('%s')",
						mysql_real_escape_string ($firstname));
					mysql_query($sql);
				 if($instigator_s > $gscore){
					 //PROFILE UPDATE
				
					//Challenge won
					$que = sprintf("SELECT ch_won FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
					$result = mysql_query($que);
					list($ch_won) = mysql_fetch_row($result);
					
					$ch_won = $ch_won + 1;
					
					$sql = sprintf("UPDATE h_users SET ch_won = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string($ch_won),
						mysql_real_escape_string($instigator));
						mysql_query($sql);
					
					//
					$query = sprintf("UPDATE arcade_challenges SET winner = ('%s') WHERE id = ('%s') AND UPPER(user2) = UPPER('%s')",
						mysql_real_escape_string ($instigator),
						mysql_real_escape_string ($challenge_id),
						mysql_real_escape_string ($user_name));
					mysql_query($query);
					//Cash Deposit
					$i_cash = getStat('cash',$i_userID);
					$net_gain = $i_cash + $wager;
					setStat('cash',$i_userID,$net_gain);
					//Earn Cool
					$cool_points_earned = rand(1,$wager);
					$math = "add";
					$adjusted = $cool_points_earned;
					coolpoint_adjuster($i_userID,$math,$adjusted);
					//Defender Lost Cool
					
					//PROFILE UPDATE
					////Challenge loss
					$que = sprintf("SELECT ch_lost FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($user_name));
					$result = mysql_query($que);
					list($ch_lost) = mysql_fetch_row($result);
					
					$ch_lost = $ch_lost + 1;
					
					$sql = sprintf("UPDATE h_users SET ch_lost = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string($ch_lost),
						mysql_real_escape_string($user_name));
						mysql_query($sql);
						
					
					$cool_points_loss = rand(1,$wager);
					$math = "subtract";
					coolpoint_adjuster($user_ID,$math,$cool_points_loss);
					//Breaking NEws
					$time = time();
					//ARCADE - Instigator wins
					//USER NEWS
					$recipient_message = $instigator." was fair after you lost a game of ".ucwords($gname). ", losing you a total of $".$wager." cash";
					//
					reporter($user_name,1,$recipient_message,"recipient");
					//				
					$sender_message = $user_name." was fair after you won a game of ".ucwords($gname). ", you won a total of $".$wager." cash";
					reporter($instigator,1,$sender_message,"recipient");
					
					$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `loser`, `score`,`arcade`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
					$result=mysql_query($sql);
					
					header('Location: start.php');
				 } elseif($instigator_s < $gscore) {							
					 //PROFILE UPDATE
					 ////Challenge won
					 $que = sprintf("SELECT ch_won FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($user_name));
					 $result = mysql_query($que);
					list($ch_won) = mysql_fetch_row($result);
					
					$ch_won = $ch_won + 1;
					
					$sql = sprintf("UPDATE h_users SET ch_won = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string($ch_won),
						mysql_real_escape_string($user_name));
						mysql_query($sql);
					//
					$query = sprintf("UPDATE arcade_challenges SET winner = ('%s') WHERE id = ('%s') AND UPPER(user2) = UPPER('%s')",
						mysql_real_escape_string ($user_name),
						mysql_real_escape_string ($challenge_id),
						mysql_real_escape_string ($user_name));
					mysql_query($query);
					//Cash Deposit
					$d_cash = getStat('cash',$user_ID);
					$net_gain = $d_cash + $wager;
					$mk_deposit = setStat('cash',$user_ID,$net_gain);
					//Earn Cool
					$cool_points_earned = rand(1,$wager);
					$math = "add";
					$adjusted = $cool_points_earned;
					coolpoint_adjuster($user_ID,$math,$adjusted);
					//Instigator Lost Cool
					
					//PROFILE UPDATE
					////Challenge loss
					$que = sprintf("SELECT ch_lost FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
					$result = mysql_query($que);
					list($ch_lost) = mysql_fetch_row($result);
					
					$ch_lost = $ch_lost + 1;
					
					$sql = sprintf("UPDATE h_users SET ch_lost = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string($ch_lost),
						mysql_real_escape_string($instigator));
						mysql_query($sql);
					
					$cool_points_loss = rand(1,$wager);
					$math = "subtract";
					coolpoint_adjuster($i_userID,$math,$cool_points_loss);
					//BREAKING NEWS
					$time = time();
					//ARCADE - defender win
					//USER NEWS
					$recipient_message = $instigator." was fair after you won a game of ".ucwords($gname). ", earning you a total of $".$wager." cash";
					//
					reporter($user_name,1,$recipient_message,"recipient");
					//				
					$sender_message = $user_name." was fair after you lost a game of ".ucwords($gname). ", losing you a total of $".$wager." cash";
					reporter($instigator,1,$sender_message,"recipient");
					
					$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `winner`, `score`,`arcade`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
					$result=mysql_query($sql);
					
					header('Location: start.php');
				 }
			}
		}
	}
	//Check for Business Heist
	$query = sprintf("SELECT * FROM h_heists WHERE UPPER(culprit) = UPPER('%s')",
				mysql_real_escape_string ($user_name));
	$result = mysql_query($query);
	$fight_ar = mysql_fetch_assoc($result);
	///YES THEY ARE THE robber!!!
	//update score
	if(is_array($fight_ar)){
		//Retrieve all fight variables
		$victim = $fight_ar["target"];
		$instigator = $user_name;
		$defender = $fight_ar["biz_owner"];
		$challenge_id = $fight_ar["id"];
		$owner_score = $fight_ar["owner_score"];
		if($defender == "hospital"){
			$owner_score == 6001;
			$que = sprintf("SELECT attacks FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($rob_won) = mysql_fetch_row($result);
						
						$rob_won = $rob_won + 1;
						
			$sql = sprintf("UPDATE h_users SET attacks = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string($rob_won),
								mysql_real_escape_string($instigator));
								mysql_query($sql);	
		}
		$ins_action = "attack";
		$def_action = "attack";
		if($gscore > $owner_score){
			//Retrieve Instigator User ID			
			$i_userID = id($instigator);
			//AND Retrieve Instigator Crew ID
			$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
							mysql_real_escape_string ($instigator));
			$result = mysql_query($query);
			list($i_crewID) = mysql_fetch_row($result);
			//
			//Retrieve action settings
			// ************HEIST************************************
			//********************HEIST*****************************
			//****************************HEIST*********************
			$Duser_ID = id($defender);
			$Vuser_ID = id($victim);
			if(empty($Duser_ID)){
				//Business is robot owned
				$instigator_strength = battle_prep($user_name,$ins_action);
				$defender_strength = round($instigator_strength/2);
				////FIGHT!
				$i_tactics = $instigator_strength;
				$d_tactics = $defender_strength;
				//
				$deduct = rand(1,$d_tactics);
				$Duser_ID = id($defender);
				medical($deduct,$i_userID,$instigator);
				//****************
				//robber wins
				//****************
				//Award robber with access to victim
				if(empty($Vuser_ID)){
					//victim is robot
					$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($instigator));
						$result = mysql_query($query);
					list($chapter) = mysql_fetch_row($result);
					
					if($chapter == 17){
						
						$chapter = $chapter + 1;
						
						$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($chapter),
							mysql_real_escape_string($instigator));
						mysql_query($query);
					}
					
					$query = sprintf("SELECT strength FROM h_npcs WHERE npc = ('%s')",
								mysql_real_escape_string ($victim));
					$result = mysql_query($query);
					list($npc_power) = mysql_fetch_row($result);
					$v_tactics = $npc_power;
					if($i_tactics > $v_tactics){
						$deduct = $i_tactics - $v_tactics;
						//****************
						//robbery success
						//****************
						$que = sprintf("SELECT heist_won FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($user_name));
							$result = mysql_query($que);
							list($rob_tot) = mysql_fetch_row($result);
							
						$rob_tot = $rob_tot + 1;
						
						$sql = sprintf("UPDATE h_users SET heist_won = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string($rob_tot),
								mysql_real_escape_string($user_name));
								mysql_query($sql);
								
						$cash_stolen = 400;
						
						//record robbery
						$time = time();
						//
						//cash awarded, Cool Points adjusted and then loss and winnings split
						
						$posse = how_deep($instigator);
						if($posse == 1){
							$mine = $cash_stolen;
						} else {
							//*************
							$who = "circle";
							$flow = "positive";
							//*************
							$c_take = pc_pay($i_crewID,$cash_stolen,$instigator,$posse,$who,$flow);
							$left = $cash_stolen - $c_take;
							//*************
							$who = "general";
							$flow = "positive";
							//***************
							
							//Muster members
							$query = sprintf("SELECT COUNT(id) FROM h_crew_member WHERE crew_id = ('%s')",
								mysql_real_escape_string ($i_crewID));
							$result = mysql_query($query);
							list($posse) = mysql_fetch_row($result);
							//
							$gen_share = pg_pay($i_crewID,$left,$instigator,$posse,$who,$flow);
							$mine = $left - $gen_share;
						}
							
						$i_cash = getStat('cash',$i_userID);
						$net_take = $i_cash + $mine;
						$mk_deposit = setStat('cash',$i_userID,$net_take);
						//
						//cool points lost
						$cool_points_lost = rand(1,$cash_stolen);
						$math = "substract";
						$finished = coolpoint_adjuster($i_userID,$math,$cool_points_lost);
						medical($cool_points_lost,$i_userID,$instigator);					
						//PROFILE UPDATE											
						//Victim Robbed
						$que = sprintf("SELECT robbed_tot FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($victim));
						$result = mysql_query($que);
						list($rob_tot) = mysql_fetch_row($result);
						
						$rob_tot = $rob_tot + 1;
						
						$sql = sprintf("UPDATE h_users SET robbed_tot = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_tot),
							mysql_real_escape_string($victim));
							mysql_query($sql);
						//biz owner
						$que = sprintf("SELECT robbed_tot FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($defender));
						$result = mysql_query($que);
						list($rob_tot) = mysql_fetch_row($result);
						
						$rob_tot = $rob_tot + 1;
						
						$sql = sprintf("UPDATE h_users SET robbed_tot = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_tot),
							mysql_real_escape_string($defender));
							mysql_query($sql);
						$time = time();
						//ARCADE
						
						//USER NEWS
						//********************************************
						//
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `winner`, `score`,`fight`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
						mysql_query($sql);
						//
						$sender_message = "You robbed ".$victim." of $".$cash_stolen." after ".$s_news." a game of ".$gname. " costing you ".$cool_points_lost."CP";
						reporter($instigator,1,$sender_message,"recipient");
						
						$sql = sprintf("DELETE FROM h_heists WHERE id = ('%s')",
								mysql_real_escape_string($challenge_id));
								mysql_query($sql);
						header('Location: start.php');
					} elseif($i_tactics < $v_tactics) {
						$sql = sprintf("DELETE FROM h_heists WHERE id = ('%s')",
								mysql_real_escape_string($challenge_id));
								mysql_query($sql);
						//Victim wins and escapes					
						//Robbery lost
						$que = sprintf("SELECT rob_lost FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($rob_lost) = mysql_fetch_row($result);
						
						$rob_lost = $rob_lost + 1;
						
						$sql = sprintf("UPDATE h_users SET rob_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_lost),
							mysql_real_escape_string($instigator));
							mysql_query($sql);					
						//
						$net_take = $v_tactics - $i_tactics;
						//health
						medical($net_take,$i_userID,$instigator);
						
						//Instigator Lost Cool
						$cool_points_loss = rand(1,$net_take);
						$math = "subtract";
						coolpoint_adjuster($i_userID,$math,$cool_points_loss);
						//BREAKING NEWS********************************************//BREAKING NEWS
						$time = time();
						$plus = $cool_points_earned."CP";
						//ARCADE
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `loser`, `score`, `wager`,`fight`) VALUES ('1', '$time', '$instigator', '$gscore','$wager','1')";
						mysql_query($sql);
						
						//USER NEWS
						//
						$sender_message = "Your robbery of ".ucwords($victim)." failed, costing you ".$cool_points_loss."CP";
						reporter($instigator,1,$sender_message,"recipient");
						header('Location: start.php');
					} elseif($i_tactics == $v_tactics){
						 //stalemate//				
						$sender_message = ucwords($victim)." was stronger than you thought and <b>resisted</b> your robbery attempt!";
						reporter($instigator,1,$sender_message,"recipient");
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `winner`, `score`, `wager`,`wait`) VALUES ('1', '$time', '$instigator', '$gscore','$wager','1')";
						mysql_query($sql);
						header('Location: start.php');
					}
				} else {
					//human victim
					$v_tactics = battle_prep($victim,$def_action);
					if($i_tactics > $v_tactics){
						$deduct = $i_tactics - $v_tactics;
						$Vuser_ID =	id($victim);		
						medical($deduct,$Vuser_ID,$victim);
						//****************
						//robbery success
						//****************
						$que = sprintf("SELECT heist_won FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($user_name));
							$result = mysql_query($que);
							list($rob_tot) = mysql_fetch_row($result);
							
						$rob_tot = $rob_tot + 1;
						
						$sql = sprintf("UPDATE h_users SET heist_won = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string($rob_tot),
								mysql_real_escape_string($user_name));
								mysql_query($sql);
								
						$hit = rand(1,$deduct);
						//check if cleader and crew have the CASH...
						$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
										mysql_real_escape_string($victim));
						$result = mysql_query($query);
						list($VcrewID) = mysql_fetch_row($result);
						$net_worth = crew_worth($Vuser_ID, $VcrewID);
						//EXIT POINT
						if($net_worth <= 0){
							$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `winner`, `score`, `wager`,`wait`) VALUES ('1', '$time', '$instigator', '$gscore','$wager','3')";
							mysql_query($sql);
							header('Location: start.php');
						} else {
							$paper = $net_worth - $hit;
							if($paper <= 0){
								$hit = $net_worth;
								$extra = " Additionally, you bankrupt them...";
							}
						}
					
						$cash_stolen = $hit;
						//record robbery
						$time = time();
						//
						//cash awarded, Cool Points adjusted and then loss and winnings split
						
						$posse = how_deep($instigator);
						if($posse == 1){
							$mine = $cash_stolen;
						} else {
							//*************
							$who = "circle";
							$flow = "positive";
							//*************
							$c_take = pc_pay($i_crewID,$cash_stolen,$instigator,$posse,$who,$flow);
							$left = $cash_stolen - $c_take;
							//*************
							$who = "general";
							$flow = "positive";
							//***************
							
							//Muster members
							$query = sprintf("SELECT COUNT(id) FROM h_crew_member WHERE crew_id = ('%s')",
								mysql_real_escape_string ($i_crewID));
							$result = mysql_query($query);
							list($posse) = mysql_fetch_row($result);
							//
							$gen_share = pg_pay($i_crewID,$left,$instigator,$posse,$who,$flow);
							$mine = $left - $gen_share;
						}
							
						$i_cash = getStat('cash',$i_userID);
						$net_take = $i_cash + $mine;
						$mk_deposit = setStat('cash',$i_userID,$net_take);
						//
						//cool points lost
						$cool_points_lost = rand(1,$cash_stolen);
						$math = "substract";
						$finished = coolpoint_adjuster($i_userID,$math,$cool_points_lost);
						medical($cool_points_lost,$i_userID,$instigator);					
						//PROFILE UPDATE											
						//Victim Robbed
						$que = sprintf("SELECT robbed_tot FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($victim));
						$result = mysql_query($que);
						list($rob_tot) = mysql_fetch_row($result);
						
						$rob_tot = $rob_tot + 1;
						
						$sql = sprintf("UPDATE h_users SET robbed_tot = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_tot),
							mysql_real_escape_string($victim));
							mysql_query($sql);
						//Snitch
						
						$sql_l = sprintf("UPDATE h_users SET snitch = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string(1),
							mysql_real_escape_string($victim));
							mysql_query($sql_l);
						//				
						//DEFENDER POSSE
						$v_posse = how_deep($victim);					
						//Debit					
						if($cash_stolen <= 1){
							$their_loss = 1; 
						} else {
							//*************
							$who = "circle";
							$flow = "negative";
							//*************	
							$circle_debit = nc_pay($VcrewID,$cash_stolen,$victim,$v_posse,$who,$flow);
							$now_owed = $cash_stolen - $circle_debit;
							//*************
							$who = "general";
							$flow = "negative";
							//*************	
							$general_debit = ng_pay($VcrewID,$now_owed,$victim,$v_posse,$who,$flow);
							$i_owe = $cash_stolen - $general_debit;
							$their_loss = $i_owe;
						}
						$d_cash = getStat('cash',$Vuser_ID);
						$net_loss = $d_cash - $their_loss;
						$mk_debit = setStat('cash',$Vuser_ID,$net_loss);
						
						//COOL POINTS EARNED for fighting the good fight! | maybe
						$adjusted = rand(1,$cash_stolen);			
						$luck = rand(1,3);
						
						if($luck == 1){
							$math = "add";
							$report = $adjusted;
							$d_extra_news = " earning you ".$report."CP";
							$finished = coolpoint_adjuster($Vuser_ID,$math,$adjusted);
						} elseif($luck == 3) {
							$math = "subtract";
							$d_extra_news = " costing you ".$report."CP";
							$finished = coolpoint_adjuster($Vuser_ID,$math,$adjusted);
							$b_report = $adjusted;
						}	
						
						$time = time();
						//ARCADE
						
						//USER NEWS
						//********************************************
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `loser`, `score`,`fight`) VALUES ('1', '$gid', '$time', '$victim', '$gscore','1')";
						mysql_query($sql);
					
						$recipient_message = ucwords($user_name)." robbed you of $".$cash_stolen.$d_extra_news;
						//
						reporter($victim,1,$recipient_message,"recipient");
						//
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `winner`, `score`,`fight`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
						mysql_query($sql);
						//
						$sender_message = "You robbed ".ucwords($victim)." of $".$cash_stolen."  costing you ".$cool_points_lost."CP";
						reporter($user_name,1,$sender_message,"recipient");
						
						$sql = sprintf("DELETE FROM h_heists WHERE id = ('%s')",
								mysql_real_escape_string($challenge_id));
								mysql_query($sql);
						header('Location: start.php');							
					} elseif($i_tactics < $v_tactics) {
						$sql = sprintf("DELETE FROM h_heists WHERE id = ('%s')",
								mysql_real_escape_string($challenge_id));
								mysql_query($sql);
						//Victim wins and escapes					
						//Robbery lost
						$que = sprintf("SELECT rob_lost FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($user_name));
						$result = mysql_query($que);
						list($rob_lost) = mysql_fetch_row($result);
						
						$rob_lost = $rob_lost + 1;
						
						$sql = sprintf("UPDATE h_users SET rob_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_lost),
							mysql_real_escape_string($user_name));
							mysql_query($sql);					
						//
						$net_take = $v_tactics - $i_tactics;
						//health
						medical($net_take,$i_userID,$user_name);
						
						$cool_points_earned = rand(1,$net_take);
						$math = "add";
						$adjusted = $cool_points_earned;
						coolpoint_adjuster($Vuser_ID,$math,$adjusted);
						
						//Instigator Lost Cool
						$cool_points_loss = rand(1,$net_take);
						$math = "subtract";
						coolpoint_adjuster($i_userID,$math,$cool_points_loss);
						medical($cool_points_loss,$Vuser_ID,$victim);
						//BREAKING NEWS********************************************//BREAKING NEWS
						$time = time();
						$plus = $cool_points_earned."CP";
						//ARCADE
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `loser`, `score`, `wager`,`fight`) VALUES ('1', '$time', '$instigator', '$gscore','$wager','1')";
						mysql_query($sql);
						
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `winner`, `score`, `wager`,`fight`) VALUES ('1', '$time', '$victim', '$gscore','$wager','1')";
						mysql_query($sql);
						//USER NEWS
						$recipient_message = ucwords($instigator)." tried to rob you after ".$r_news.$d_extra_news.$plus;
							//
						reporter($victim,1,$recipient_message,"recipient");
						//
						//
						$sender_message = "Your robbery of ".ucwords($victim)." failed, costing you ".$cool_points_loss." CP";
						reporter($user_name,1,$sender_message,"recipient");
						header('Location: start.php');
					} elseif($i_tactics == $v_tactics){
						 //stalemate
						 $recipient_message = ucwords($user_name)." attempted to over power and rob you but you <b>resisted</b>!";
						//
						reporter($victim,1,$recipient_message,"recipient");
						//				
						$sender_message = ucwords($victim)." was stronger than you thought and <b>resisted</b> your robbery attempt!";
						reporter($user_name,1,$sender_message,"recipient");
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `winner`, `score`, `wager`,`wait`) VALUES ('1', '$time', '$instigator', '$gscore','$wager','1')";
						mysql_query($sql);
						header('Location: start.php');
					}
				}
			} else {
				//everyone is human
				$defender_strength = battle_prep($defender,$def_action);
				$instigator_strength = battle_prep($user_name,$ins_action);
				////FIGHT!
				$i_tactics = $instigator_strength;
				$d_tactics = $defender_strength;
				//
				if($i_tactics > $d_tactics){
					$deduct = $i_tactics - $d_tactics;
					$Duser_ID = id($defender);
					medical($deduct,$Duser_ID,$defender);
					//****************
					//robber wins
					//****************
					//Award robber with access to victim
					$v_tactics = battle_prep($victim,$def_action);
					if($i_tactics > $v_tactics){
						$deduct = $i_tactics - $v_tactics;
						$Vuser_ID =	id($victim);		
						medical($deduct,$Vuser_ID,$victim);
						//****************
						//robbery success
						//****************
						$que = sprintf("SELECT heist_won FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($user_name));
							$result = mysql_query($que);
							list($rob_tot) = mysql_fetch_row($result);
							
						$rob_tot = $rob_tot + 1;
						
						$sql = sprintf("UPDATE h_users SET heist_won = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string($rob_tot),
								mysql_real_escape_string($user_name));
								mysql_query($sql);
								
						$hit = rand(1,$deduct);
						//check if cleader and crew have the CASH...
						$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
										mysql_real_escape_string($victim));
						$result = mysql_query($query);
						list($VcrewID) = mysql_fetch_row($result);
						$net_worth = crew_worth($Vuser_ID, $VcrewID);
						//EXIT POINT
						if($net_worth <= 0){
							$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `winner`, `score`, `wager`,`wait`) VALUES ('1', '$time', '$user_name', '$gscore','$wager','3')";
							mysql_query($sql);
							header('Location: start.php');
						} else {
							$paper = $net_worth - $hit;
							if($paper <= 0){
								$hit = $net_worth;
								$extra = " Additionally, you bankrupt them...";
							}
						
							$cash_stolen = $hit;
							//record robbery
							$time = time();
							//
							//cash awarded, Cool Points adjusted and then loss and winnings split
							
							$posse = how_deep($instigator);
							if($posse == 1){
								$mine = $cash_stolen;
							} else {
								//*************
								$who = "circle";
								$flow = "positive";
								//*************
								$c_take = pc_pay($i_crewID,$cash_stolen,$instigator,$posse,$who,$flow);
								$left = $cash_stolen - $c_take;
								//*************
								$who = "general";
								$flow = "positive";
								//***************
								
								//Muster members
								$query = sprintf("SELECT COUNT(id) FROM h_crew_member WHERE crew_id = ('%s')",
									mysql_real_escape_string ($i_crewID));
								$result = mysql_query($query);
								list($posse) = mysql_fetch_row($result);
								//
								$gen_share = pg_pay($i_crewID,$left,$instigator,$posse,$who,$flow);
								$mine = $left - $gen_share;
							}
								
							$i_cash = getStat('cash',$i_userID);
							$net_take = $i_cash + $mine;
							$mk_deposit = setStat('cash',$i_userID,$net_take);
							//
							//cool points lost
							$cool_points_lost = rand(1,$cash_stolen);
							$math = "substract";
							$finished = coolpoint_adjuster($i_userID,$math,$cool_points_lost);
							medical($cool_points_lost,$i_userID,$instigator);					
							//PROFILE UPDATE											
							//Victim Robbed
							$que = sprintf("SELECT robbed_tot FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($victim));
							$result = mysql_query($que);
							list($rob_tot) = mysql_fetch_row($result);
							
							$rob_tot = $rob_tot + 1;
							
							$sql = sprintf("UPDATE h_users SET robbed_tot = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string($rob_tot),
								mysql_real_escape_string($victim));
								mysql_query($sql);
							//biz owner
							$que = sprintf("SELECT robbed_tot FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($defender));
							$result = mysql_query($que);
							list($rob_tot) = mysql_fetch_row($result);
							
							$rob_tot = $rob_tot + 1;
							
							$sql = sprintf("UPDATE h_users SET robbed_tot = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string($rob_tot),
								mysql_real_escape_string($defender));
								mysql_query($sql);	
							//Snitch
							
							$sql_l = sprintf("UPDATE h_users SET snitch = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string(1),
								mysql_real_escape_string($victim));
								mysql_query($sql_l);
								
							$sql_l = sprintf("UPDATE h_users SET snitch = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string(1),
								mysql_real_escape_string($defender));
								mysql_query($sql_l);	
							//				
							//DEFENDER POSSE
							$v_posse = how_deep($victim);					
							//Debit					
							if($cash_stolen <= 1){
								$their_loss = 1; 
							} else {
								//*************
								$who = "circle";
								$flow = "negative";
								//*************	
								$circle_debit = nc_pay($VcrewID,$cash_stolen,$victim,$v_posse,$who,$flow);
								$now_owed = $cash_stolen - $circle_debit;
								//*************
								$who = "general";
								$flow = "negative";
								//*************	
								$general_debit = ng_pay($VcrewID,$now_owed,$victim,$v_posse,$who,$flow);
								$i_owe = $cash_stolen - $general_debit;
								$their_loss = $i_owe;
							}
							$d_cash = getStat('cash',$Vuser_ID);
							$net_loss = $d_cash - $their_loss;
							$mk_debit = setStat('cash',$Vuser_ID,$net_loss);
							
							//COOL POINTS EARNED for fighting the good fight! | maybe
							$adjusted = rand(1,$cash_stolen);			
							$luck = rand(1,3);
							
							if($luck == 1){
								$math = "add";
								$report = $adjusted;
								$d_extra_news = " earning you ".$report."CP";
								$finished = coolpoint_adjuster($Vuser_ID,$math,$adjusted);
							} elseif($luck == 3) {
								$math = "subtract";
								$d_extra_news = " costing you ".$report."CP";
								$finished = coolpoint_adjuster($Vuser_ID,$math,$adjusted);
								$b_report = $adjusted;
							}		
							
							$time = time();
							//ARCADE
							
							//USER NEWS
							//********************************************
							$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `loser`, `score`,`fight`) VALUES ('1', '$gid', '$time', '$victim', '$gscore','1')";
							mysql_query($sql);
						
							$recipient_message = ucwords($instigator)." just robbed you of $".$cash_stolen.$d_extra_news;
							//
							reporter($victim,1,$recipient_message,"recipient");
							//
							$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `winner`, `score`,`fight`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
							mysql_query($sql);
							//
							$sender_message = "You just robbed ".ucwords($victim)." of $".$cash_stolen." after beating out the ".ucwords($defender)."'s security team, costing you ".$cool_points_lost."CP";
							reporter($user_name,1,$sender_message,"recipient");
							
							$sql = sprintf("DELETE FROM h_heists WHERE id = ('%s')",
									mysql_real_escape_string($challenge_id));
									mysql_query($sql);
						}
						header('Location: start.php');	
					} elseif($i_tactics < $v_tactics) {
						$sql = sprintf("DELETE FROM h_heists WHERE id = ('%s')",
								mysql_real_escape_string($challenge_id));
								mysql_query($sql);
						//Victim wins and escapes					
						//Robbery lost
						$que = sprintf("SELECT rob_lost FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($rob_lost) = mysql_fetch_row($result);
						
						$rob_lost = $rob_lost + 1;
						
						$sql = sprintf("UPDATE h_users SET rob_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_lost),
							mysql_real_escape_string($instigator));
							mysql_query($sql);					
						//
						$net_take = $v_tactics - $i_tactics;
						//health
						medical($net_take,$i_userID,$instigator);
						
						$cool_points_earned = rand(1,$net_take);
						$math = "add";
						$adjusted = $cool_points_earned;
						coolpoint_adjuster($Vuser_ID,$math,$adjusted);
						
						//Instigator Lost Cool
						$cool_points_loss = rand(1,$net_take);
						$math = "subtract";
						coolpoint_adjuster($i_userID,$math,$cool_points_loss);
						medical($cool_points_loss,$Vuser_ID,$victim);
						//BREAKING NEWS********************************************//BREAKING NEWS
						$time = time();
						$plus = $cool_points_earned."CP";
						//ARCADE
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `loser`, `score`, `wager`,`fight`) VALUES ('1', '$time', '$instigator', '$gscore','$wager','1')";
						mysql_query($sql);
						
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `winner`, `score`, `wager`,`fight`) VALUES ('1', '$time', '$victim', '$gscore','$wager','1')";
						mysql_query($sql);
						//USER NEWS
						$recipient_message = ucwords($instigator)." just tried to rob you";
							//
						reporter($victim,1,$recipient_message,"recipient");
						//
						//
						$sender_message = "Your robbery of ".ucwords($victim)." failed, costing you ".$cool_points_loss." CP";
						reporter($instigator,1,$sender_message,"recipient");
						header('Location: start.php');
					} elseif($i_tactics == $v_tactics){
						 //stalemate
						 $recipient_message = ucwords($instigator)." attempted to over power and rob you but you <b>resisted</b>!";
						//
						reporter($victim,1,$recipient_message,"recipient");
						//				
						$sender_message = ucwords($user_name)." was stronger than you thought and <b>resisted</b> your robbery attempt!";
						reporter($instigator,1,$sender_message,"recipient");
						
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `winner`, `score`, `wager`,`wait`) VALUES ('1', '$time', '$instigator', '$gscore','$wager','1')";
						mysql_query($sql);
						header('Location: start.php');
					}				
				} elseif($i_tactics < $d_tactics) {
					 // could not get past security
					 $sql = sprintf("DELETE FROM h_heists WHERE id = ('%s')",
								mysql_real_escape_string($challenge_id));
								mysql_query($sql);
					 //defender wins
					 //PROFILE UPDATE
					
					 //Challenge won
					 $que = sprintf("SELECT ch_won FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($defender));
					 $result = mysql_query($que);
					 list($ch_won) = mysql_fetch_row($result);
					
					 $ch_won = $ch_won + 1;
					
					 $sql = sprintf("UPDATE h_users SET ch_won = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string($ch_won),
						mysql_real_escape_string($defender));
						mysql_query($sql);
						
					 //Robbery lost
					 $que = sprintf("SELECT rob_lost FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
					 $result = mysql_query($que);
					 list($rob_lost) = mysql_fetch_row($result);
					
					 $rob_lost = $rob_lost + 1;
					
					 $sql = sprintf("UPDATE h_users SET rob_lost = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string($rob_lost),
						mysql_real_escape_string($instigator));
						mysql_query($sql);
										
					 ////Challenge lost
					 $que = sprintf("SELECT ch_lost FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
					 $result =mysql_query($que);
					 list($ch_lost) = mysql_fetch_row($result);
					
					 $ch_lost = $ch_lost + 1;
					
					 $sql = sprintf("UPDATE h_users SET ch_lost = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string($ch_lost),
						mysql_real_escape_string($instigator));
						mysql_query($sql);
						
					 //
					 $net_take = $d_tactics - $i_tactics;
					 //health
					 medical($net_take,$i_userID,$instigator);
					 if($def_action == "attack"){
						$cool_points_earned = rand(1,$net_take);
						$number = $net_take - $cool_points_earned;
						$cash_gain = rand(0,$number);
						// Guilty or Innocent
						$math = "add";
						$adjusted = $cool_points_earned;
						coolpoint_adjuster($Duser_ID,$math,$adjusted);
						//Cash Deposit
						$d_cash = getStat('cash',$Duser_ID);
						$net_gain = $d_cash + $cash_gain;
						$mk_deposit = setStat('cash',$Duser_ID,$net_gain);
					 }
					//Instigator Lost Cool
					$cool_points_loss = rand(1,$net_take);
					$math = "subtract";
					coolpoint_adjuster($i_userID,$math,$cool_points_loss);
					medical($cool_points_loss,$Duser_ID,$defender);
					//BREAKING NEWS********************************************//BREAKING NEWS
					$time = time();
					$plus = $cool_points_earned."CP";
					//ARCADE					
					$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `loser`, `score`, `wager`,`fight`) VALUES ('1', '$time', '$instigator', '$gscore','$wager','1')";
					mysql_query($sql);
					//USER NEWS
					$recipient_message = ucwords($instigator)." tried to rob customers of your business but your security team stopped them!";
						//
					reporter($defender,1,$recipient_message,"recipient");
					//				
					$sender_message = "Your robbery attempt of ".ucwords($victim)." failed, after ".ucwords($defender)."'s security team stopped you, costing you ".$cool_points_loss." CP";
					reporter($instigator,1,$sender_message,"recipient");
					header('Location: start.php');
				} elseif($i_tactics == $d_tactics){
					//stalemate
					 $recipient_message = ucwords($instigator)." attempted to over power and rob your business but you <b>resisted</b>!";
					//
					reporter($defender,1,$recipient_message,"recipient");
					//				
					$sender_message = ucwords($defender)."'s business security team was stronger than you thought and <b>resisted</b> your robbery attempt!";
					reporter($instigator,1,$sender_message,"recipient");
					$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `winner`, `score`, `wager`,`wait`) VALUES ('1', '$time', '$instigator', '$gscore','$wager','4')";
						mysql_query($sql);
					header('Location: start.php');
				}
			}
		} else {
			//Couldnt beat owner's score
			$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `loser`, `score`, `wager`,`business`) VALUES ('1', '$time', '$instigator', '$gscore','$wager','1')";
					mysql_query($sql);		
		}
		$sql = sprintf("DELETE FROM h_heists WHERE UPPER(culprit) = ('%s')",
									mysql_real_escape_string ($user_name));
		mysql_query($sql); 
		header('Location: start.php');
	}
	//Check for High Speed Chase
	//Is user the officer?
	$query = sprintf("SELECT * FROM h_chases WHERE UPPER(user1) = UPPER('%s') AND gameid = ('%s') AND done = ('%s')",
				mysql_real_escape_string ($user_name),
				mysql_real_escape_string ($gid),
				0);
	$result = mysql_query($query);
	$finish_ar = mysql_fetch_assoc($result);
	///YES THEY ARE THE Officer!!!
	//update score
	if(is_array($finish_ar)){
		$time = time();
		$challenge_id = $finish_ar["id"];
		$query = sprintf("UPDATE h_chases SET score1 = ('%s'), time = ('%s') WHERE UPPER(user1) = UPPER('%s')",
				mysql_real_escape_string ($gscore),
				mysql_real_escape_string ($time),
				mysql_real_escape_string ($user_name));
		mysql_query($query);
		header('Location: start.php');
	} else {
		////Identify if user satisfied a challenge | Are they the crook?
		$query = sprintf("SELECT * FROM h_chases WHERE UPPER(hood) = UPPER('%s') AND gameid = ('%s') AND done = ('%s')",
					mysql_real_escape_string ($user_name),
					mysql_real_escape_string ($gid),
					0);
		$result = mysql_query($query);
		$fight_ar = mysql_fetch_assoc($result);
	
		//////Battle Prep!
		if(is_array($fight_ar)){
			//Retrieve all fight variables
			$instigator = $fight_ar["user1"];
			$instigator_s = $fight_ar["score1"];
			$challenge_id = $fight_ar["id"];
			$ins_action = "attack";
			$def_action = "attack";
			$wager = $fight_ar["prize"];
				
			//Retrieve Instigator User ID
			$query = sprintf("SELECT id FROM h_users WHERE user = ('%s')",
					mysql_real_escape_string ($instigator));
			$result = mysql_query($query);			
			list($i_userID) = mysql_fetch_row($result);
			//AND Retrieve Instigator Crew ID
			$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
							mysql_real_escape_string ($instigator));
			$result = mysql_query($query);
			list($i_crewID) = mysql_fetch_row($result);
			//
			//Retrieve action settings
			 // ************CHASE************************************
			 //********************CHASE*****************************
			 //****************************CHASE*********************
			 $instigator_strength = battle_prep($instigator,$ins_action);
			 $defender_strength = battle_prep($user_name,$def_action);
			
			 //Strength Multiplier Bonus
			 $coolbonus = bonus($stage,$title);
			 ////FIGHT!
			 $i_tactics = $instigator_strength * $coolbonus;
			 $d_tactics = $defender_strength * $coolbonus;
			 if($i_tactics > $d_tactics){
				$deduct = $i_tactics - $d_tactics;
				medical($deduct,$userID,$user_name);
				//****************
				//officer wins
				//****************
				//Award officer salary
				$pocket = getStat("cash",$i_userID);
				$salary = $pocket + $wager;
				setStat("cash",$i_userID,$salary);
				//delete rap sheet entry
				$sql = sprintf("DELETE FROM h_rap_sheet WHERE UPPER(hood) = UPPER('%s')",
					mysql_real_escape_string ($user_name));
				mysql_query($sql);
				//zero criminals current energy			
				//subtract 25,000 cool points
				$cur = getStat("exp",$user_ID);
				$degrade = $cur - 2500;
				setStat("exp",$user_ID,$degrade);
				//take all weapons
				$query = sprintf("DELETE FROM h_user_arsenal WHERE user_id = '%s' AND type = 'weapon'",
					mysql_real_escape_string($user_ID));
				mysql_query($query);
				
				SetArsenal('fists',$user_ID,'1');
				//delete chase entry
				$sql = sprintf("DELETE FROM h_chases WHERE UPPER(hood) = UPPER('%s')",
					mysql_real_escape_string ($user_name));
				mysql_query($sql);
				//take all property
				$query = sprintf("DELETE FROM h_user_assets WHERE user_id = '%s' AND asset_id < 400",
					mysql_real_escape_string($user_ID));
				mysql_query($query);
				
				setAssets('base',$user_ID,'1');
				//alert to arrest
				$recipient_message = "A N.A.R.C just captured you and the court confiscated all your assets and property";
					//
				hustle_reporter($user_name,1,$recipient_message,"recipient");
				//
				$recipient_message = "You just successfully captured and subdued the criminal ".ucwords($user_name);
					//
				hustle_reporter($instigator,1,$recipient_message,"recipient");
				
				$que = sprintf("SELECT arrests FROM h_users WHERE user = ('%s')",
							mysql_real_escape_string($instigator));
				$result = mysql_query($que);
				list($arrests) = mysql_fetch_row($result);
				
				$arrests = $arrests + 1;
				
				$sql = sprintf("UPDATE h_users SET arrests = ('%s') WHERE user = ('%s')",
					mysql_real_escape_string($arrests),
					mysql_real_escape_string($instigator));
					mysql_query($sql);
					
				$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `loser`, `score`,`police`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
					$result=mysql_query($sql);	
					
			 } elseif($i_tactics < $d_tactics) {
				$sql = sprintf("UPDATE h_chases SET done = ('%s') WHERE id = ('%s')",
						mysql_real_escape_string(1),
						mysql_real_escape_string($challenge_id));
						mysql_query($sql);
				//Crook wins and escapes
				$net_gain = $d_tactics - $i_tactics;
				medical($net_gain,$i_userID,$instigator);
				//PROFILE UPDATE					
				
				//Instigator Lost Cool
				$cool_points_loss = rand(1,$net_gain);
				$math = "subtract";
				coolpoint_adjuster($i_userID,$math,$cool_points_loss);
				//BREAKING NEWS********************************************//BREAKING NEWS				
				$sql = sprintf("SELECT record FROM h_rap_sheet WHERE UPPER(hood) = UPPER('%s')",
						mysql_real_escape_string($user_name));
						$result = mysql_query($sql);
						list($record) = mysql_fetch_row($result);
						
						$record = $record + $net_gain;
				
				$sql = sprintf("UPDATE h_rap_sheet SET record = ('%s') WHERE UPPER(hood) = UPPER('%s')",
						mysql_real_escape_string($record),
						mysql_real_escape_string($user_name));
						mysql_query($sql);
				//USER NEWS
				$recipient_message = " You barely escaped <b>ARREST<b/>, they will be back";
					//
				hustle_reporter($user_name,1,$recipient_message,"recipient");
				//				
				$sender_message = "Your failed to capture and arrest the assailant and lost CP because of it.";
				hustle_reporter($instigator,1,$sender_message,"recipient");
				
				$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `winner`, `score`,`police`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
					$result=mysql_query($sql);
					
			 }
			 //Insert new score
			$time = time();
			$query = sprintf("UPDATE h_chases SET score2 = ('%s'), time = ('%s'), done = ('%s') WHERE UPPER(hood) = UPPER('%s')",
					mysql_real_escape_string ($gscore),
					mysql_real_escape_string ($time),
					1,
					mysql_real_escape_string ($user_name));
			mysql_query($query);
		}
		header('Location: start.php');
	}
	//Check for crime mission
	$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user_name));
						$result = mysql_query($query);
	list($chapter) = mysql_fetch_row($result);
	
	if($chapter == 33){
		
	$chapter = $chapter + 1;
	
	$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($chapter),
		mysql_real_escape_string($user_name));
	mysql_query($query);
	}
	$query_2 = sprintf("SELECT * FROM h_crimes WHERE UPPER(hood) = UPPER('%s') AND gameid = ('%s') AND done = ('%s')",
				mysql_real_escape_string ($user_name),
				mysql_real_escape_string ($gid),
				0);
	$result_2 = mysql_query($query_2);
	$finish_ar_2 = mysql_fetch_assoc($result_2);
	//update score
	if(is_array($finish_ar_2)){
		$task = $finish_ar_2["task_code"];
		if($task < 5){
			$time = time();
			$challenge_id = $finish_ar_2["id"];
			$query = sprintf("UPDATE h_crimes SET score2 = ('%s'), time = ('%s'), done = ('%s') WHERE id = ('%s') AND UPPER(hood) = UPPER('%s')",
					mysql_real_escape_string ($gscore),
					mysql_real_escape_string ($time),
					1,
					mysql_real_escape_string ($challenge_id),
					mysql_real_escape_string ($user_name));
			mysql_query($query);
			
			//1drop off, 2pick up, 3bm, 4shipment, 5lottery	
			$goal = $finish_ar_2["score1"];
			$gfee = $finish_ar_2["fee"];
			$anum = rand(1,4);
			$gfee = $gfee/$anum;
			if($goal >= $gscore){
				if($task == 1){
					//delivery success
					$prize = $finish_ar_2["prize"];
					$cp_bonus = $finish_ar_2["cp_bonus"];
					//
					$pocket = getStat("cash",$user_ID);
					$deposit = $pocket + $prize;
					setStat("cash",$user_ID,$deposit);
					$rep = getStat("exp",$user_ID);
					$ups = $rep + $cp_bonus;
					setStat("exp",$user_ID,$ups);
					//send message
					$recipient_message = "Delivery complete earning you $".$prize." and ".$cp_bonus."CP";
					//
					crime_reporter($user_name,1,$recipient_message,"recipient");
					
					$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `winner`, `score`,`crime`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
					$result=mysql_query($sql);
					
				} elseif($task == 2){
					//delivery success
					$prize = $finish_ar_2["prize"];
					$cp_bonus = $finish_ar_2["cp_bonus"];
					//
					$pocket = getStat("cash",$user_ID);
					$deposit = $pocket + $prize;
					setStat("cash",$user_ID,$deposit);
					$rep = getStat("exp",$user_ID);
					$ups = $rep + $cp_bonus;
					setStat("exp",$user_ID,$ups);
					//send message
					//random
					$coin1 = rand(1,50);
					$coin2 = rand(1,50);
					if($coin1 == $coin2){
						//give roids
						$grab = rand(1,800);
						$onhand = getGoods("roids",$userID);
						$trans = $onhand - $grab;
						setGoods("roids",$userID,$trans);
						$recipient_message = "Steroid Pick-up complete earning you $".$prize." and ".$cp_bonus."CP and ".$grab." pills";
						//
						crime_reporter($user_name,1,$recipient_message,"recipient");
						
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `winner`, `score`,`crime`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
						$result=mysql_query($sql);
					} else {
						$recipient_message = "Pick-up complete earning you $".$prize." and ".$cp_bonus."CP";
						//
						crime_reporter($user_name,1,$recipient_message,"recipient");
						
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `winner`, `score`,`crime`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
						$result=mysql_query($sql);
					}
				} elseif($task == 3){
					//deposit dvd
					$ounces = rand(1,$gfee);
					$onhand = getGoods("media",$user_ID);
					$reup = $onhand + $ounces;
					setGoods("media",$user_ID,$reup);
					//send message
					$recipient_message = "You've got your shipment of <b>BootLeg DVDs</b> ".$ounces." Units";
					//
					crime_reporter($user_name,1,$recipient_message,"recipient");
					
					$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `winner`, `score`,`crime`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
					$result=mysql_query($sql);
					
				} elseif($task == 4){
					//deposit blue magic
					$ounces = rand(1,$gfee);
					$onhand = getGoods("coke",$user_ID);
					$reup = $onhand + $ounces;
					setGoods("coke",$user_ID,$reup);
					//send message
					$recipient_message = "You've got your shipment of <b>Blue Magic</b> ".$ounces." Units";
					//
					crime_reporter($user_name,1,$recipient_message,"recipient");
					
					$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `winner`, `score`,`crime`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
					$result=mysql_query($sql);
					
				}
			} else {
				//failure
				$suck = rand(1,10);
				$cp_bonus = $finish_ar_2["cp_bonus"];
				$degrade = round($cp_bonus/$suck);
				$rep = getStat("exp",$user_ID);
				$down = $rep - $degrade;
				setStat("exp",$user_ID,$down);
				$recipient_message = "<b>You Suck</b> and you didn't complete the job. Losing you ".$degrade."CP";
					//
				crime_reporter($user_name,1,$recipient_message,"recipient");
				
				$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `loser`, `score`,`crime`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
					$result=mysql_query($sql);						
			}
			
			header('Location: start.php');
		}	
	} 
	//Is this Egg tourney?
	//
	function arewethereyet($user_name,$leg){
		$query = sprintf("SELECT chopshop FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user_name));
		$result = mysql_query($query);
		list($races) = mysql_fetch_row($result);
		
		if($races == $leg){
			$sql = sprintf("UPDATE h_tourney SET completed = '%s' WHERE user = ('%s')",
								mysql_real_escape_string(2),
								mysql_real_escape_string($user_name));
				mysql_query($sql);
			//is this a challenge tourney?	
		}
		return;
	}
	$query = sprintf("SELECT * FROM h_tourney WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user_name));
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	
	if(is_array($row)){
		$race1 = $row["race1"];
		$race2 = $row["race2"];
		$race3 = $row["race3"];
		$race4 = $row["race4"];
		$race5 = $row["race5"];
		$race6 = $row["race6"];
		$race7 = $row["race7"];
		$race8 = $row["race8"];
		$race9 = $row["race9"];
		$race10 = $row["race10"];
		if(empty($race1)){
			$query = sprintf("UPDATE h_tourney SET race1 = '%s' WHERE user = ('%s')",
							mysql_real_escape_string($gscore),
							mysql_real_escape_string($user_name));
			mysql_query($query);
		} elseif(empty($race2)){
			$query = sprintf("UPDATE h_tourney SET race2 = '%s' WHERE user = ('%s')",
							mysql_real_escape_string($gscore),
							mysql_real_escape_string($user_name));
			mysql_query($query);
		} elseif(empty($race3)){
			$query = sprintf("UPDATE h_tourney SET race3 = '%s' WHERE user = ('%s')",
							mysql_real_escape_string($gscore),
							mysql_real_escape_string($user_name));
			mysql_query($query);
			arewethereyet($user_name,3);
		} elseif(empty($race4)){
			$query = sprintf("UPDATE h_tourney SET race4 = '%s' WHERE user = ('%s')",
							mysql_real_escape_string($gscore),
							mysql_real_escape_string($user_name));
			mysql_query($query);
			arewethereyet($user_name,4);
		} elseif(empty($race5)){
			$query = sprintf("UPDATE h_tourney SET race5 = '%s' WHERE user = ('%s')",
							mysql_real_escape_string($gscore),
							mysql_real_escape_string($user_name));
			mysql_query($query);
			arewethereyet($user_name,5);
		} elseif(empty($race6)){
			$query = sprintf("UPDATE h_tourney SET race6 = '%s' WHERE user = ('%s')",
							mysql_real_escape_string($gscore),
							mysql_real_escape_string($user_name));
			mysql_query($query);
			arewethereyet($user_name,6);
		} elseif(empty($race7)){
			$query = sprintf("UPDATE h_tourney SET race7 = '%s' WHERE user = ('%s')",
							mysql_real_escape_string($gscore),
							mysql_real_escape_string($user_name));
			mysql_query($query);
			arewethereyet($user_name,7);
		} elseif(empty($race8)){
			$query = sprintf("UPDATE h_tourney SET race8 = '%s' WHERE user = ('%s')",
							mysql_real_escape_string($gscore),
							mysql_real_escape_string($user_name));
			mysql_query($query);
		} elseif(empty($race9)){
			$query = sprintf("UPDATE h_tourney SET race9 = '%s' WHERE user = ('%s')",
							mysql_real_escape_string($gscore),
							mysql_real_escape_string($user_name));
			mysql_query($query);
		} elseif(empty($race10)){
			$query = sprintf("UPDATE h_tourney SET race10 = '%s' WHERE user = ('%s')",
							mysql_real_escape_string($gscore),
							mysql_real_escape_string($user_name));
			mysql_query($query);
			
			$sql = sprintf("UPDATE h_tourney SET completed = '%s' WHERE user = ('%s')",
								mysql_real_escape_string(2),
								mysql_real_escape_string($user_name));
			mysql_query($sql);
			
		}
		header('Location: start.php');
	} 		
	//Is this a Bank Job?
	if($gid == 2285 || $gid == 2692){
		//right game
		$query = sprintf("SELECT * FROM h_bankjobs WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string ($user_name));
		$result = mysql_query($query);
		$finish_ar = mysql_fetch_assoc($result);
		
		if(is_array($finish_ar)){
			//right person
			//Is user the brains?
			$query = sprintf("SELECT brains FROM h_bankjobs WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string ($user_name));
			$result = mysql_query($query);
			list($boss_name) = mysql_fetch_row($result);
			///YES THEY ARE THE Boss!!!
			if($boss_name == $user_name){
				//is this the first challenge or second?
				$query = sprintf("SELECT heist_alert FROM h_users WHERE UPPER(user) = UPPER('%s') AND UPPER(brains) = UPPER('%s')",
							mysql_real_escape_string ($user_name),
							mysql_real_escape_string ($user_name));
				$result = mysql_query($query);
				list($ready) = mysql_fetch_row($result);
				if($ready == 10){
					//this is second challenge
					//was score met?
					if($gscore < 7000){
						// submit to arcade_news
						$sql = "INSERT INTO `arcade_news` (`type`, `time`, `loser`, `score`,`gameid`,`bank`) VALUES ('5', '$time', '$user_name', '$gscore','$gid','1')";
						$result=mysql_query($sql);
				
						//send mesage to entire team
						$query = sprintf("SELECT * FROM h_bankjobs WHERE UPPER(user) = UPPER('%s')",
									mysql_real_escape_string ($user_name));
						$result = mysql_query($query);
						while($team_arr = mysql_fetch_assoc($result)){
							$pim = $team_arr['user'];
							if($pim == $user_name){
								//
							} else {
								//
								$recipient_message = ucwords($user_name)." couldn't crack the F$%Kin' the Vault, heist failure!";
								//
								reporter($pim,1,$recipient_message,"recipient");
								$query = sprintf("UPDATE h_users SET heist_alert = '%s' WHERE UPPER(user) = UPPER('%s')",
									mysql_real_escape_string(0),
									mysql_real_escape_string($pim));
								mysql_query($query);
							}
						}
						//delete everyone from bank job
						$query = sprintf("DELETE FROM h_bankjobs WHERE brains = ('%s')",
							mysql_real_escape_string($boss_name));
						mysql_query($query);
						header('Location: start.php');
					} else {
						//winners!
						//divide cash by 6
						$query = "SELECT balance FROM h_bliss_bank";
						$result = mysql_query($query);
						list($bank_cash) = mysql_fetch_row($result);
						$heist_share = $bank_cash/6;
						//divide cash
						$query = sprintf("SELECT * FROM h_bankjobs WHERE UPPER(user) = UPPER('%s')",
									mysql_real_escape_string ($user_name));
						$result = mysql_query($query);
						while($team_arr = mysql_fetch_assoc($result)){
								$pim = $team_arr['user'];
								$pimid = id($pim);
								$poc = getStat("cash",$pimid);
								
								$query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
											mysql_real_escape_string ($pim));
								$result = mysql_query($query);
								list($pcrewID) = mysql_fetch_row($result);
								
								$net_take = $heist_share;
								$posse = how_deep($pim);
								if($posse == 1){
									$mine = $poc + $net_take;
									$report = $net_take;
								} else {
									//*************
									$who = "circle";
									$flow = "positive";
									//*************
									$c_take = pg_pay($pcrewID,$net_take,$pim,$posse,$who,$flow);
									$mycutt = $net_take - $c_take;
									$mine = $poc + $mycutt;
									$report = $mycutt;			
								}								
								$mk_deposit = setStat('cash',$pimid,$mine);
								
								$recipient_message = ucwords($user_name)." cracked the safe! Your cut is $".$mycutt." after sharing with your crew.";
								//
								reporter($pim,1,$recipient_message,"recipient");
								
								$sql = "INSERT INTO `arcade_news` (`type`, `time`, `winner`, `score`,`gameid`,`bank`) VALUES ('2', '$time', '$pim', '$gscore','$gid','1')";
								$result=mysql_query($sql);
								
								$query = sprintf("UPDATE h_users SET heist_alert = '%s' WHERE UPPER(user) = UPPER('%s')",
									mysql_real_escape_string(0),
									mysql_real_escape_string($pim));
								mysql_query($query);
						}
						//delete everyone from bank job
						$query = sprintf("DELETE FROM h_bankjobs WHERE brains = ('%s')",
							mysql_real_escape_string($boss_name));
						mysql_query($query);
						//delete all investor shares
						$sql = sprintf("DELETE FROM h_user_investments WHERE biz_id = ('%s')",
							mysql_real_escape_string (500));
						mysql_query($sql);
						
						$sql = "SELECT * FROM h_users";
						$res = mysql_query($sql);
						
						while($collect = mysql_fetch_assoc($res)){
							$user = $collect["user"];
							
							$recipient_message = "The Bank of Bliss was just robbed, stock holders are in panic as all record of shares have been lost.";
									//
							hustle_reporter($user,1,$recipient_message,"recipient");	
							
						}
						//divide the bank assets in half to cover cash loss
						$query = "SELECT assets FROM h_bliss_bank";
						$result = mysql_query($query);
						list($assets) = mysql_fetch_row($result);
						$new_bal = round($assets/2);
						setBCash($new_bal);
						setBAss($new_bal);
					}
					header('Location: start.php');
				} else {
					//first
					if($gscore < 7000){
						// submit to arcade_news
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `type`, `time`, `loser`, `score`,`gameid`,`bank`) VALUES ('1', '1', '$time', '$user_name', '$gscore','$gid','1')";
						$result=mysql_query($sql);
						
						//send mesage to entire team
						$query = sprintf("SELECT * FROM h_bankjobs WHERE UPPER(user) = UPPER('%s')",
									mysql_real_escape_string ($user_name));
						$result = mysql_query($query);
						while($team_arr = mysql_fetch_assoc($result)){
							$pim = $team_arr['user'];
							if($pim == $user_name){
								//
							} else {
								$recipient_message = ucwords($user_name)." couldn't get past the Bank's Alarm System ending the bank heist; everyone must make it to the Vault.";
								//
								reporter($pim,1,$recipient_message,"recipient");
								$query = sprintf("UPDATE h_users SET heist_alert = '%s' WHERE UPPER(user) = UPPER('%s')",
									mysql_real_escape_string(0),
									mysql_real_escape_string($pim));
								mysql_query($query);
							}
						}
						//delete everyone from bank job
						$query = sprintf("DELETE FROM h_bankjobs WHERE brains = ('%s')",
							mysql_real_escape_string($boss_name));
						mysql_query($query);
						header('Location: start.php');
					} else {
						//are they strong enough?
						$ins_action = "attack";
						$instigator_strength = battle_prep($user_name,$ins_action);
						//get bank security
						$query = "SELECT security FROM h_bliss_bank";
						$result = mysql_query($query);
						list($thehurt) = mysql_fetch_row($result);
						if($instigator_strength > $thehurt){
							//success
							$win = $instrigator_strength - $thehurt;
							$cool = rand(1,$win);
							$me = getStat("exp",$user_ID);
							$boost = $cool + $me;
							setStat("exp",$user_ID,$boost);
							$sql = sprintf("UPDATE h_bankjobs SET my_success = ('%s') WHERE UPPER(user) = UPPER('%s')",
										mysql_real_escape_string (2),
										mysql_real_escape_string ($user_name));
							mysql_query($sql);
							$sql = "INSERT INTO `arcade_news` (`thickbox`, `type`, `time`, `winner`, `score`,`gameid`,`bank`) VALUES ('1', '1', '$time', '$user_name', '$gscore','$gid','1')";
							$result=mysql_query($sql);
							//check to see if everyone is done
							$query = sprintf("UPDATE h_users SET heist_alert = '%s' WHERE UPPER(user) = UPPER('%s')",
									mysql_real_escape_string(0),
									mysql_real_escape_string($user_name));
								mysql_query($query);
								
							$query = sprintf("SELECT COUNT(id) FROM h_bankjobs WHERE UPPER(brains) = UPPER('%s') AND my_success = ('%s')",
										   mysql_real_escape_string($brain),
										   mysql_real_escape_string(2));
								$result = mysql_query($query);
							list($count) = mysql_fetch_row($result);
							if($count == 6){
								//bank job success stage 2
								$sql = sprintf("UPDATE h_users SET heist_alert = ('%s') WHERE UPPER(user) = UPPER('%s')",
										mysql_real_escape_string (10),
										mysql_real_escape_string ($boss_name));
								mysql_query($sql);
							}
						} else {
							$pain = $thehurt - $instigator_strength;
							medical($pain,$userID,$user_name);
							//a.p.b report
							//add to rap sheets
							$query = sprintf("SELECT COUNT(id) FROM h_rap_sheet WHERE UPPER(hood) = UPPER('%s')",
									mysql_real_escape_string ($user_name));
							$result = mysql_query($query);
							list($count) = mysql_fetch_row($result);
							if($count > 0){
								$query = sprintf("SELECT record FROM h_rap_sheet WHERE UPPER(hood) = UPPER('%s')",
										mysql_real_escape_string ($user_name));
								$result = mysql_query($query);
								list($record) = mysql_fetch_row($result);
								$record = $record + 1;
								$sql = sprintf("UPDATE h_rap_sheet SET record = ('%s'), bank = ('%s') WHERE UPPER(hood) = UPPER('%s')",
														mysql_real_escape_string ($record),
														1,
														mysql_real_escape_string ($user_name));
												mysql_query($sql);
							} else {
								$record = 1;
								$rank_score = 1000;
								$query = sprintf("INSERT INTO h_rap_sheet(record,hood,rank_score,bank) VALUES ('%s','%s','%s','%s')",
									mysql_real_escape_string($record),
									mysql_real_escape_string($user_name),
									mysql_real_escape_string($rank_score),
									1);
								mysql_query($query);
							}
							//they failed
							$sql = "INSERT INTO `arcade_news` (`thickbox`, `type`, `time`,`loser`, `score`,`gameid`,`bank`) VALUES ('1', '1', '$time', '$user_name', '$gscore','$gid','3')";
							$result=mysql_query($sql);
							//send mesage to entire team
							$query = sprintf("SELECT * FROM h_bankjobs WHERE UPPER(user) = UPPER('%s')",
										mysql_real_escape_string ($user_name));
							$result = mysql_query($query);
							while($team_arr = mysql_fetch_assoc($result)){
								$pim = $team_arr['user'];
								if($pim == $user_name){
									//
								} else {
									$recipient_message = ucwords($user_name)." couldn't get past the Bank's Security Team ending the bank heist; everyone MUST make it to the Vault.";
									//
									reporter($pim,1,$recipient_message,"recipient");
									$query = sprintf("UPDATE h_users SET heist_alert = '%s' WHERE UPPER(user) = UPPER('%s')",
										mysql_real_escape_string(0),
										mysql_real_escape_string($pim));
									mysql_query($query);
								}
							}
							//delete everyone from bank job
							$query = sprintf("DELETE FROM h_bankjobs WHERE brains = ('%s')",
								mysql_real_escape_string($boss_name));
							mysql_query($query);							
							header('Location: start.php');
						}
					}
				}				
			} else {
				//muscle
				//Are they already done?
				$query = sprintf("SELECT * FROM h_bankjobs WHERE UPPER(user) = UPPER('%s') AND my_success = '%s'",
							mysql_real_escape_string ($user_name),
							2);
				$result = mysql_query($query);
				$hen_ar = mysql_fetch_assoc($result);
				if(!is_array($hen_ar)){
					//Did they make it through the gate?
					if($gscore < 7000){
						// submit to arcade_news
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `type`, `time`, `loser`, `score`,`gameid`,`bank`) VALUES ('1', '1', '$time', '$user_name', '$gscore','$gid','1')";
						$result=mysql_query($sql);
						//let boss know
						$sql = "INSERT INTO `arcade_news` (`thickbox`, `type`, `time`, `loser`, `score`,`gameid`,`bank`) VALUES ('1', '1', '$time', '$boss_name', '$gscore','$gid','2')";
						$result=mysql_query($sql);
						//send mesage to entire team
						$query = sprintf("SELECT * FROM h_bankjobs WHERE UPPER(user) = UPPER('%s')",
									mysql_real_escape_string ($user_name));
						$result = mysql_query($query);
						while($team_arr = mysql_fetch_assoc($result)){
							$pim = $team_arr['user'];
							if($pim == $user_name){
								//
							} else {
								$recipient_message = ucwords($user_name)." couldn't get past the Bank's Alarm System ending the bank heist; everyone must make it to the Vault.";
								//
								reporter($pim,1,$recipient_message,"recipient");
								$query = sprintf("UPDATE h_users SET heist_alert = '%s' WHERE UPPER(user) = UPPER('%s')",
										mysql_real_escape_string(0),
										mysql_real_escape_string($pim));
									mysql_query($query);								
							}
						}
						//delete everyone from bank job
						$query = sprintf("DELETE FROM h_bankjobs WHERE brains = ('%s')",
							mysql_real_escape_string($boss_name));
						mysql_query($query);
						header('Location: start.php');
					} else {
						//are they strong enough?
						$ins_action = "attack";
						$instigator_strength = battle_prep($user_name,$ins_action);
						//get bank security
						$query = "SELECT security FROM h_bliss_bank";
						$result = mysql_query($query);
						list($thehurt) = mysql_fetch_row($result);
						if($instigator_strength > $thehurt){
							//success
							$win = $instrigator_strength - $thehurt;
							$cool = rand(1,$win);
							$me = getStat("exp",$user_ID);
							$boost = $cool + $me;
							setStat("exp",$user_ID,$boost);
							$sql = sprintf("UPDATE h_bankjobs SET my_success = ('%s') WHERE UPPER(user) = UPPER('%s')",
										mysql_real_escape_string (2),
										mysql_real_escape_string ($user_name));
							mysql_query($sql);
							$sql = "INSERT INTO `arcade_news` (`thickbox`, `type`, `time`, `winner`, `score`,`gameid`,`bank`) VALUES ('1', '1', '$time', '$user_name', '$gscore','$gid','1')";
							$result=mysql_query($sql);
							//let boss know
							$recipient_message = ucwords($user_name)." is waiting at the Bank Vault on everyone else to arrive.";
							//
							reporter($boss_name,1,$recipient_message,"recipient");
							//check to see if everyone is done
							$query = sprintf("UPDATE h_users SET heist_alert = '%s' WHERE UPPER(user) = UPPER('%s')",
								mysql_real_escape_string(0),
								mysql_real_escape_string($user_name));
							mysql_query($query);
									
							$query = sprintf("SELECT COUNT(id) FROM h_bankjobs WHERE UPPER(brains) = UPPER('%s') AND my_success = ('%s')",
										   mysql_real_escape_string($brain),
										   mysql_real_escape_string(2));
								$result = mysql_query($query);
							list($count) = mysql_fetch_row($result);
							if($count == 6){
								//bank job success stage 2
								$sql = sprintf("UPDATE h_users SET heist_alert = ('%s') WHERE UPPER(user) = UPPER('%s')",
										mysql_real_escape_string (10),
										mysql_real_escape_string ($boss_name));
								mysql_query($sql);
							}
						} else {
							$pain = $thehurt - $instigator_strength;
							medical($pain,$userID,$user_name);
							//a.p.b report
							//add to rap sheets
							$query = sprintf("SELECT COUNT(id) FROM h_rap_sheet WHERE UPPER(hood) = UPPER('%s')",
									mysql_real_escape_string ($user_name));
							$result = mysql_query($query);
							list($count) = mysql_fetch_row($result);
							if($count > 0){
								$query = sprintf("SELECT record FROM h_rap_sheet WHERE UPPER(hood) = UPPER('%s')",
										mysql_real_escape_string ($user_name));
								$result = mysql_query($query);
								list($record) = mysql_fetch_row($result);
								$record = $record + 1;
								$sql = sprintf("UPDATE h_rap_sheet SET record = ('%s'), bank = ('%s') WHERE UPPER(hood) = UPPER('%s')",
														mysql_real_escape_string ($record),
														1,
														mysql_real_escape_string ($user_name));
												mysql_query($sql);
							} else {
								$record = 1;
								$rank_score = 1000;
								$query = sprintf("INSERT INTO h_rap_sheet(record,hood,rank_score,bank) VALUES ('%s','%s','%s','%s')",
									mysql_real_escape_string($record),
									mysql_real_escape_string($user_name),
									mysql_real_escape_string($rank_score),
									1);
								mysql_query($query);
							}
							//they failed
							$sql = "INSERT INTO `arcade_news` (`thickbox`, `type`, `time`,`loser`, `score`,`gameid`,`bank`) VALUES ('1', '1', '$time', '$user_name', '$gscore','$gid','3')";
							$result=mysql_query($sql);
							//let boss know
							$sql = "INSERT INTO `arcade_news` (`thickbox`, `type`, `time`, `loser`, `score`,`gameid`,`bank`) VALUES ('1', '1', '$time', '$boss_name', '$gscore','$gid','4')";
							$result=mysql_query($sql);
							//send mesage to entire team
							$query = sprintf("SELECT * FROM h_bankjobs WHERE UPPER(user) = UPPER('%s')",
										mysql_real_escape_string ($user_name));
							$result = mysql_query($query);
							while($team_arr = mysql_fetch_assoc($result)){
								$pim = $team_arr['user'];
								if($pim == $user_name){
									//
								} else {
									$recipient_message = ucwords($user_name)." couldn't get past the Bank's Security Team ending the bank heist; everyone MUST make it to the Vault.";
									//
									reporter($pim,1,$recipient_message,"recipient");
									
									$query = sprintf("UPDATE h_users SET heist_alert = '%s' WHERE UPPER(user) = UPPER('%s')",
										mysql_real_escape_string(0),
										mysql_real_escape_string($pim));
									mysql_query($query);
								}
							}							
							//delete everyone from bank job
							$query = sprintf("DELETE FROM h_bankjobs WHERE brains = ('%s')",
								mysql_real_escape_string($boss_name));
							mysql_query($query);
						}
						header('Location: start.php');
					}
				}
			}
			header('Location: start.php');
		}
	}
	//Bonus Randomizer| maybe
	function b_random($gscore,$user_name){
		$user_ID = id($user_name);
		$luck = rand(0,80);
		$cash_bonus = 0;
		$adjusted = 0;
		
		$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
								mysql_real_escape_string($user_name));
		$result = mysql_query($query);
		list($crewID) = mysql_fetch_row($result);
		
		if($luck == 1){
			//cash only	
			$p = rand(1,55);
			$p = $p/100;
			$ascore = $gscore * $p;
			$gscore = abs($ascore);
			$cash_bonus = rand(0,$gscore);
			if($p == $luck){
				$cash_bonus = 20000;
			}
			$i_cash = getStat('cash',$user_ID);
			
			//gotta share sorry					
			$net_take = $cash_bonus;
			$posse = how_deep($user_name);
			if($posse == 1){
				$mine = $i_cash + $net_take;
				$report = $cash_bonus;
			} else {
				//*************
				$who = "general";
				$flow = "positive";
				//*************
				$c_take = pg_pay($crewID,$net_take,$user_name,$posse,$who,$flow);
				$mycutt = $net_take - $c_take;
				$mine = $i_cash + $mycutt;
				$report = $mycutt;			
			}		
			
			$mk_deposit = setStat('cash',$user_ID,$mine);//setStat('cash',$user_ID,'50');
			$free = array($cash_bonus,$adjusted,$report);
			return $free;
		} elseif($luck == 2){
			//cash and cool	
			$p = rand(1,25);
			$p = $p/100;
			$dollar = $gscore * $p;		
			$dollar = abs($dollar);
			$cash_bonus = rand(0,$dollar);
			$i_cash = getStat('cash',$user_ID);
			
			//gotta share sorry
			$net_take = $cash_bonus;
			$posse = how_deep($user_name);
			if($posse == 1){
				$mine = $i_cash + $net_take;
				$report = $cash_bonus;
			} else {
				//*************
				$who = "general";
				$flow = "positive";
				//*************
				$c_take = pg_pay($crewID,$net_take,$user_name,$posse,$who,$flow);
				$mycutt = $net_take - $c_take;
				$mine = $i_cash + $mycutt;
				$report = $mine;			
			}		
			
			$mk_deposit = setStat('cash',$user_ID,$mine);//setStat('cash',$user_ID,'50');
			//CP
			$math = "add";	
			$cp = $gscore - $dollar;
			$adjusted = rand(0,$cp);
			$finished = coolpoint_adjuster($user_ID,$math,$adjusted);
			
			$free = array($cash_bonus,$adjusted,$report);
			return $free;
		} elseif($luck == 3){
			//cool only
			$math = "add";
			$ascore = abs($gscore);
			$adjusted = rand(0,$ascore);
			$finished = coolpoint_adjuster($user_ID,$math,$adjusted);
			$free = array($cash_bonus,$adjusted);
			return $free;
		}  elseif($luck == 5){
			//Million Dollar Race
			$c1 = rand(1,2);
			$c2 = rand(1,2);
			if($c1 == $c2){
				$query = sprintf("SELECT races FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($user_name));
				$result = mysql_query($query);
				list($races) = mysql_fetch_row($result);
				
				if($races == 3){
					//give race invite
					$races = $races + 1;
					$sql = sprintf("UPDATE h_users SET races = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string(1),
					mysql_real_escape_string($user_name));
					mysql_query($sql);
					
					$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string("race"),
					mysql_real_escape_string($user_name));
					mysql_query($sql);
				}
			}
			return $free;
		} elseif($luck == 6){
			//Packages
			$sql = sprintf("SELECT packages FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user_name));
			$results = mysql_query($sql);
			list($packages) = mysql_fetch_row($results);
			if($packages < 101){
				$packages = $packages + 1;
				$sql = sprintf("UPDATE h_users SET packages = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string($packages),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
				
				$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("package"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
				
				egg($packages,$user_name);
			}
			return $free;
		} elseif($luck == 7){
			//Bribes
			$query = sprintf("SELECT quantity FROM h_user_assets WHERE asset_id = (SELECT id FROM h_special_items WHERE name = '%s') AND UPPER(user) = UPPER('%s')",
								mysql_real_escape_string("bribe"),
								mysql_real_escape_string($user_name));
				$result = mysql_query($query);
				list($quantity) = mysql_fetch_row($result);
				if($quantity < 1){
					if(empty($quantity)){
						$query = sprintf("INSERT INTO h_user_assets(asset_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
						mysql_real_escape_string("bribe"),
						mysql_real_escape_string($user_ID),
						mysql_real_escape_string(1));
						mysql_query($query);
					} else {
						$quantity = $quantity + 1;
						$sql = sprintf("UPDATE h_user_assets SET quantity = ('%s') WHERE asset_id = (SELECT id FROM h_special_items WHERE name = '%s') AND UPPER(user) = UPPER('%s')",
						mysql_real_escape_string("bribe"),
						mysql_real_escape_string($user_name));
						mysql_query($sql);
					}
					
					$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string("bribe"),
						mysql_real_escape_string($user_name));
						mysql_query($sql);
				}
			return $free;
		} elseif($luck == 8){
			//Adrenaline Shot
			$c1 = rand(1,2);
			$c2 = rand(1,2);
			if($c1 == $c2){
				//give shot
				$count = getAEggs("adrenaline shot",$user_ID);
				if($count <= 20){
					$count = $count + 1;
					setAEggs("adrenaline shot",$user_ID,$count);
					
					$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string("adrenaline shot"),
					mysql_real_escape_string($user_name));
					mysql_query($sql);
				}
			}
			return $free;
		} elseif($luck == 9){
			//Fish
			$c1 = rand(1,2);
			$c2 = rand(1,2);
			$c3 = rand(1,2);
			if($c1 == $c2 && $c1 == $c3 && $c2 == $c3){
				//give shot
				$count = getAEggs("Fishing Boat",$user_ID);
				if($count < 1){
					$count = $count + 1;
					setAEggs("Fishing Boat",$user_ID,$count);
					$cool = getStat("exp",$user_ID);
					$up = $cool + 3500;
					setStat("exp",$user_ID,$up);
					
					$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string("Fishing Boat"),
					mysql_real_escape_string($user_name));
					mysql_query($sql);
				}
			}
			return $free;
		} elseif($luck == 10){
			//Art
			$c1 = rand(1,2);
			$c2 = rand(1,2);
			$c3 = rand(1,2);
			if($c1 == $c2 && $c1 == $c3 && $c2 == $c3){
				//give shot
				$count = getAEggs("Art Collection",$user_ID);
				$count = $count + 1;
				setAEggs("Art Collection",$user_ID,$count);
				$cool = getStat("exp",$user_ID);
				$up = $cool + 600;
				setStat("exp",$user_ID,$up);
				
				$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("Art Collection"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
			}
			return $free;
		} elseif($luck == 11){
			//cycle
			$c1 = rand(1,2);
			$c2 = rand(1,2);
			$c3 = rand(1,100);
			if($c1 == $c2 && $c3 == $luck){
				//give shot
				$count = getAEggs("2020 Motorcycle",$user_ID);
				$count = $count + 1;
				setAEggs("2020 Motorcycle",$user_ID,$count);
				$cool = getStat("exp",$user_ID);
				$up = $cool + 1000;
				setStat("exp",$user_ID,$up);
				
				$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("2020 Motorcycle"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
			}
			return $free;
		} elseif($luck == 42){
			//Prem
			$c1 = rand(1,2);
			$c2 = rand(1,2);
			$c3 = rand(1,100);
			if($c1 == $c2 && $c3 == $luck){
				$count = getAEggs("Premium Automobile",$user_ID);
				$count = $count + 1;
				setAEggs("Premium Automobile",$user_ID,$count);
				$cool = getStat("exp",$user_ID);
				$up = $cool + 1200;
				setStat("exp",$user_ID,$up);
				
				$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string("Premium Automobile"),
				mysql_real_escape_string($user_name));
				mysql_query($sql);
			}
			return $free;
		} elseif($luck == 66){
			//sports car
			$c1 = rand(1,2);
			$c2 = rand(1,2);
			$c3 = rand(1,200);
			if($c1 == $c2 && $c3 == $luck){
				$count = getAEggs("Custom Sports Car",$user_ID);
				if($count < 1){
					$count = $count + 1;
					setAEggs("Custom Sports Car",$user_ID,$count);
					$cool = getStat("exp",$user_ID);
					$up = $cool + 3400;
					setStat("exp",$user_ID,$up);
					
					$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string("Custom Sports Car"),
					mysql_real_escape_string($user_name));
					mysql_query($sql);
				}
			}
			return $free;
		} elseif($luck == 75){
			//lux car
			$c1 = rand(1,2);
			$c1 = rand(1,2);
			$c2 = rand(1,2);
			$c3 = rand(1,200);
			$c4 = rand(1,200);
			$c5 = rand(1,200);
			if($c1 == $c2 && $c3 == $c4 && $c5 == $luck){
				//give shot
				$count = getAEggs("Luxury Sports Car",$user_ID);
				if($count < 1){
					$count = $count + 1;
					setAEggs("Luxury Sports Car",$user_ID,$count);
					$cool = getStat("exp",$user_ID);
					$up = $cool + 5000;
					setStat("exp",$user_ID,$up);
					
					$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string("Luxury Sports Car"),
					mysql_real_escape_string($user_name));
					mysql_query($sql);
				}
			}
			return $free;
		} elseif($luck == 15){
			//Jet
			$c1 = rand(1,2);
			$c1 = rand(1,2);
			$c2 = rand(1,2);
			$c3 = rand(1,100);
			$c4 = rand(0,300);
			$c5 = rand(1,200);
			$c6 = rand(0,30);
			if($c1 == $c2 && $c3 == $c4 && $c5 == $luck && $c5 == $c6){
				//give shot
				$count = getAEggs("Private Jet",$user_ID);
				if($count < 1){
					$count = $count + 1;
					setAEggs("Private Jet",$user_ID,$count);
					$cool = getStat("exp",$user_ID);
					$up = $cool + 8500;
					setStat("exp",$user_ID,$up);
					
					$sql = sprintf("UPDATE h_users SET egg_name = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string("Private Jet"),
					mysql_real_escape_string($user_name));
					mysql_query($sql);
				}
			}
			return $free;
		} else {
			$free = array($cash_bonus,$adjusted);
			return $free;
		}
	}
	//JUST PRACTICE!!!
	$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($instigator));
						$result = mysql_query($query);
	list($chapter) = mysql_fetch_row($result);
					
	if($chapter == 31){
						
		$chapter = $chapter + 1;
						
		$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($chapter),
							mysql_real_escape_string($instigator));
		mysql_query($query);
	}
	
	//check to see if we have a new high score
	//first time score check
	
	$sql = "SELECT COUNT(scoreid) FROM `arcade_highscores` WHERE `gamename` = '$gameid'";
	$result=mysql_query($sql);
	list($sum) = mysql_fetch_row($result);
	
	if($sum > 0){
		//there are prior records
		$sql = "SELECT MAX(score) FROM `arcade_highscores` WHERE `gamename` = '$gameid'";
		
		$result=mysql_query($sql);
		list($scoreA) = mysql_fetch_row($result);
		
		if($scoreA < $gscore || empty($scoreA)){
			// remove credit from old highscorer
			
			$sql = "SELECT username,MAX(score) FROM `arcade_highscores` WHERE `gamename` = '$gameid'";
			
			$result=mysql_query($sql);
			$num = mysql_fetch_array($result);
			if(!empty($num)){
				$row = mysql_fetch_array($result);
				$huser = $num['username'];		
				
				$query = sprintf("SELECT arcade_champ FROM h_users WHERE UPPER(user) = UPPER('%s')",
																				 $huser);
				$result = mysql_query($query);
				list($champ) = mysql_fetch_row($result);
				$champ = $champ - 1;
				$sql = sprintf("UPDATE h_users SET arcade_champ = ('%s') WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string ($champ),
						mysql_real_escape_string ($huser));
				mysql_query($sql);
			}
			// add credit to new highscorer
			$query = sprintf("SELECT arcade_champ FROM h_users WHERE UPPER(user) = UPPER('%s')",
																				 $huser);
				$result = mysql_query($query);
				list($champ) = mysql_fetch_row($result);
				$champ = $champ + 1;
				$sql = sprintf("UPDATE h_users SET arcade_champ = ('%s') WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string ($champ),
						mysql_real_escape_string ($huser));
				mysql_query($sql);
		
			// submit to arcade_news				
			$sql = "INSERT INTO `arcade_news` (`thickbox`, `type`, `time`, `winner`, `loser`, `score`,`gameid`,`arcade`) VALUES ('1', '1', '$time', '$user_name', '$huser', '$gscore','$gid','1')";
					$result=mysql_query($sql);
			//record score
			$time = time();
			
			$query = sprintf("SELECT game_name FROM h_users WHERE UPPER(user) = UPPER('%s')",
											mysql_real_escape_string ($user_name));
				$result = mysql_query($query);
				list($new_user) = mysql_fetch_row($result);
				
			$sql = "INSERT INTO `arcade_highscores` (`gamename`,`username`,`score`,`time`) VALUES ('$gameid', '$new_user', '$gscore', '$time')";
			$result=mysql_query($sql);
			
			$sup = b_random($gscore,$user_name);
			$payout = $sup[0];
			$upgrade = $sup[1];
			$left = $sup[2];
	
			// submit to user news
			//USER NEWS
			$recipient_message = "Your score of ".$gscore." on ".ucwords($gname)." EARNED you ".$upgrade."CP & $".$payout;
		//
			reporter($user_name,1,$recipient_message,"recipient");
					
			header('Location: start.php');
			
		} else {
			//$err = "nothing special on ".$gname;
			//echo "You did ".$err;
			//submit to thickbox news
			$time = time();
			$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `loser`,`gameid`, `score`,`arcade`) VALUES ('1', '$time', '$user_name', '$gameid', '$gscore','1')";
					$result=mysql_query($sql);
			
			header('Location: start.php');
		}
	} else {
		$err = "you are the first time scorer";
		///first time record for game
		$query = sprintf("SELECT arcade_champ FROM h_users WHERE UPPER(user) = UPPER('%s')",
																				 $user_name);
		$result = mysql_query($query);
		list($champ) = mysql_fetch_row($result);
		$champ = $champ + 1;
		$sql = sprintf("UPDATE h_users SET arcade_champ = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string ($champ),
				mysql_real_escape_string ($user_name));
		mysql_query($sql);
		
		$time = time();
		$sql = "INSERT INTO `arcade_highscores` (`gamename`,`username`,`score`,`time`) VALUES ('$gameid', '$user_name', '$gscore', '$time')";
		$result=mysql_query($sql);
		
		$sup = b_random($user_ID,$gscore,$user_name);			
		$payout = $sup[0];
		$upgrade = $sup[1];
		$left = $sup[2];
	
		// submit to user news
		$recipient_message = "Your score of ".$gscore." on ".ucwords($gname)." EARNED YOU ".$upgrade." CP & $".$payout;
		//
		reporter($user_name,1,$recipient_message,"recipient");
		// submit to arcade_news
			$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `winner`, `score`,`arcade`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
					$result=mysql_query($sql);
		
		//echo "You are ".$user_name." and you played ".$gname." and scored ".$score." ".$err." and have a bonus of".$upgrade."plus $".$payout." but after your crew you have $".$left;
		header('Location: start.php');
	}
} else {
	//Casino Bonus Randomizer| maybe
	function jackpot($user_ID,$gscore,$user_name,$wager,$owner_id,$casino_id){
		$luck = rand(1,3);
		$cash_bonus = 0;
		$adjusted = 0;
		
		$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
								mysql_real_escape_string($user_name));
		$result = mysql_query($query);
		list($crewID) = mysql_fetch_row($result);
		
		$query = sprintf("SELECT user FROM h_users WHERE id = ('%s')",
						mysql_real_escape_string ($owner_id));
				$result = mysql_query($query);
		list($owner_name) = mysql_fetch_row($result);
		
		if($luck == 1){
			//cash only	
			$p = rand(1,100);
			$p = $p/100;
			$ascore = $gscore * $p;
			$gscore = abs($ascore) + $wager;
			$cash_bonus = rand(0,$gscore);			
			if($cash_bonus == $jackpot){
				//report jackpot win to winner
				$recipient_message = "You just won the <b>$".$jackpot." JACKPOT </b> in ".ucwords($owner_name)."&acute;s Casino, & you shared the winnings with you crew too.";
				reporter($user_name,1,$recipient_message,"recipient");
				
				//report jackpot win to owner 
				$recipient_message = ucwords($user_name)." just won the <b>$".$jackpot." JACKPOT </b> in one of your Casinos.";
				//
				hustle_reporter($owner_name,1,$recipient_message,"recipient");
				//subtract jackpot from income of biz
				$income = getbiz_inc($casino_id,$owner_id);				
				if($jackpot > $income){
					$payout = $jackpot - $income;
					//zero out income
					setbiz_inc($casino_id,$owner_id,0);
					$pocket = getStat("cash",$owner_id);
					$debit = $pocket - $payout;
					setStat("cash",$owner_id,$debit);
				} elseif($jackpot==$income) {
					setbiz_inc($casino_id,$owner_id,0);
				} elseif($jackpot < $income){
					$diff = $income - $jackpot;				
					setbiz_inc($casino_id,$owner_id,$diff);
				}
			}
			if($cash_bonus < $wager){
				$diff = $wager - $cash_bonus;
				$income = getbiz_inc($casino_id,$owner_id);
				$deposit = $income + $diff;
				setbiz_inc($casino_id,$owner_id,$deposit);
			}
			$i_cash = getStat('cash',$user_ID);
			
			//gotta share sorry					
			$net_take = $cash_bonus;
			$posse = how_deep($user_name);
			if($posse == 1){
				$mine = $i_cash + $net_take;
				$report = $cash_bonus;
			} else {
				//*************
				$who = "general";
				$flow = "positive";
				//*************
				$c_take = pg_pay($crewID,$net_take,$user_name,$posse,$who,$flow);
				$mycutt = $net_take - $c_take;
				$mine = $i_cash + $mycutt;
				$report = $mycutt;			
			}		
			
			$mk_deposit = setStat('cash',$user_ID,$mine);//setStat('cash',$userID,'50');
			$free = array($cash_bonus,$adjusted,$report);
			return $free;
		} else {
			$income = getbiz_inc($casino_id,$owner_id);
			$deposit = $income + $wager;
			setbiz_inc($casino_id,$owner_id,$deposit);
			$free = array($cash_bonus,$adjusted);
			return $free;
		}
	}
	
	//Who owns the Casino?
	$query = sprintf("SELECT casino_oid,casino_id FROM h_patrons WHERE user_id = ('%s')",
			mysql_real_escape_string ($user_ID));
	$result = mysql_query($query);
	$details = mysql_fetch_assoc($result);
	$owner_id = $details["casino_oid"];
	$casino_id = $details["casino_id"];
	//
	$query = sprintf("SELECT user FROM h_users WHERE id = ('%s')",
			mysql_real_escape_string ($owner_id));
	$result = mysql_query($query);
	list($ownername) = mysql_fetch_row($result);
	//Was a wager made?
	$query = sprintf("SELECT wager FROM h_patrons WHERE user_id = ('%s') AND casino_oid",
			mysql_real_escape_string ($user_ID),
			mysql_real_escape_string ($owner_id));
	$result = mysql_query($query);
	list($wager) = mysql_fetch_row($result);
	//check to see if we have a new high score
	//first time score check
	
	$sql = "SELECT COUNT(scoreid) FROM `arcade_highscores` WHERE `gamename` = '$gameid'";
	$result=mysql_query($sql);
	list($sum) = mysql_fetch_row($result);
	
	if($sum > 0){
		//there are prior records
		$sql = "SELECT MAX(score) FROM `arcade_highscores` WHERE `gamename` = '$gameid'";
		
		$result=mysql_query($sql);
		list($scoreA) = mysql_fetch_row($result);
		
		if($scoreA < $gscore || empty($scoreA)){
			// remove credit from old highscorer
			
			$sql = "SELECT username,MAX(score) FROM `arcade_highscores` WHERE `gamename` = '$gameid'";
			
			$result=mysql_query($sql);
			$num = mysql_fetch_array($result);
			if(!empty($num)){
				$row = mysql_fetch_array($result);
				$huser = $num['username'];
				$query = sprintf("SELECT arcade_champ FROM h_users WHERE UPPER(user) = UPPER('%s')",
																				 $huser);
				$result = mysql_query($query);
				list($champ) = mysql_fetch_row($result);
				$champ = $champ - 1;
				$sql = sprintf("UPDATE h_users SET arcade_champ = ('%s') WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string ($champ),
						mysql_real_escape_string ($huser));
				mysql_query($sql);
			}
			// add credit to new highscorer
			$query = sprintf("SELECT arcade_champ FROM h_users WHERE UPPER(user) = UPPER('%s')",
																				 $user_name);
				$result = mysql_query($query);
				list($champ) = mysql_fetch_row($result);
				$champ = $champ + 1;
				$sql = sprintf("UPDATE h_users SET arcade_champ = ('%s') WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string ($champ),
						mysql_real_escape_string ($user_name));
				mysql_query($sql);
		
			// submit to arcade_news
			$sql = "INSERT INTO `arcade_news` (`thickbox`, `type`, `time`, `winner`, `loser`, `score`,`gameid`,`casino`) VALUES ('1', '1', '$time', '$user_name', '$huser', '$gscore','$gid','1')";
					$result=mysql_query($sql);
			//record score
			$time = time();
			$sql = "INSERT INTO `arcade_highscores` (`gamename`,`username`,`score`,`time`) VALUES ('$gameid', '$user_name', '$gscore', '$time')";
			$result=mysql_query($sql);
			
			$sup = jackpot($user_ID,$gscore,$user_name,$wager,$owner_id,$casino_id);
			$payout = $sup[0];
			$upgrade = $sup[1];
			$left = $sup[2];
	
			// submit to user news
			//USER NEWS
			$recipient_message = "Your score of ".$gscore." in ".ucwords($ownername)."'s Casino <b>EARNED</b> you ".$upgrade."CP & $".$payout;
		//
			reporter($user_name,1,$recipient_message,"recipient");
			
			$sql = sprintf("DELETE FROM h_patrons WHERE user_id = ('%s') AND casino_id = ('%s')",
						mysql_real_escape_string ($user_ID),
						mysql_real_escape_string ($casino_id));
				mysql_query($sql);
				
			header('Location: start.php');
			
		} else {
			//$err = "nothing special on ".$gname;
			//echo "You did ".$err;
			//submit to thickbox news
			$time = time();
			$sql = "INSERT INTO `arcade_news` (`thickbox`, `time`, `loser`,`gameid`, `score`,`casino`) VALUES ('1', '$time', '$user_name', '$gameid', '$gscore','1')";
					$result=mysql_query($sql);
			
			$sql = sprintf("DELETE FROM h_patrons WHERE user_id = ('%s') AND casino_id = ('%s')",
						mysql_real_escape_string ($user_ID),
						mysql_real_escape_string ($casino_id));
				mysql_query($sql);
				
			header('Location: start.php');
		}
	} else {
		//$err = "you are the first time scorer";
		///first time record for game
		$query = sprintf("SELECT arcade_champ FROM h_users WHERE UPPER(user) = UPPER('%s')",
																				 $user_name);
		$result = mysql_query($query);
		list($champ) = mysql_fetch_row($result);
		$champ = $champ + 1;
		$sql = sprintf("UPDATE h_users SET arcade_champ = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string ($champ),
				mysql_real_escape_string ($user_name));
		mysql_query($sql);
		
		$time = time();
		$sql = "INSERT INTO `arcade_highscores` (`gamename`,`username`,`score`,`time`) VALUES ('$gameid', '$user_name', '$gscore', '$time')";
		$result=mysql_query($sql);
		
		$sup = jackpot($user_ID,$gscore,$user_name,$wager,$owner_id,$casino_id);			
		$payout = $sup[0];
		$upgrade = $sup[1];
		$left = $sup[2];
	
		// submit to user news
		$recipient_message = "Your score of ".$gscore." on ".ucwords($ownername)."'s Casino <b>EARNED</b> YOU ".$upgrade." CP & $".$payout;
		//
		reporter($user_name,1,$recipient_message,"recipient");
		// submit to arcade_news
			$sql = "INSERT INTO `arcade_news` (`thickbox`, `gameid`, `time`, `winner`, `score`,`casino`) VALUES ('1', '$gid', '$time', '$user_name', '$gscore','1')";
					$result=mysql_query($sql);
		
		//echo "You are ".$user_name." and you played ".$gname." and scored ".$score." ".$err." and have a bonus of".$upgrade."plus $".$payout." but after your crew you have $".$left;
		$sql = sprintf("DELETE FROM h_patrons WHERE user_id = ('%s') AND casino_id = ('%s')",
						mysql_real_escape_string ($user_ID),
						mysql_real_escape_string ($casino_id));
				mysql_query($sql);
				
		header('Location: start.php');
	}

}


?>
<img src="images/loading.gif" alt="" width="245" height="248"/>