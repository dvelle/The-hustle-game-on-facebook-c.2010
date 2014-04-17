<?php
$fb_user = $_GET["data"];
$gname = $_GET["var1"];
$gscore = $_GET["var2"];

require_once('stats.php');

require_once('connect.php');

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

//
//Variable Test /Capture zone
//

$orientation = $gname * 1;
if($orientation > 0){
	$gname = $gameresults[1];
	$gscore = $gameresults[0];
}

//functions
function bonus($level, $rank_title){
	if($rank_title == "Rookie"){
		$r = 1;
	} elseif($rank_title == "Amateur"){
		$r = 2;
	} elseif($rank_title == "Upstart"){
		$r = 3;
	} elseif($rank_title == "Pro"){
		$r = 4;
	} elseif($rank_title == "Boss"){
		$r = 5;
	} elseif($rank_title == "Mastermind"){
		$r = 6;
	} else {
		$r = 7;
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
// MUSCLE ATTRIBUTES //
function muscle_atts($muscle, $state){
	if($state == "attack"){
		$query = sprintf("SELECT attack FROM h_muscle WHERE id = ('%s') AND type = 'muscle'",
						 $muscle);
		$result = mysql_query($query);
		list($stat) = mysql_fetch_row($result);
		return $stat;
	} elseif($state == "defense"){
		$query = sprintf("SELECT defense FROM h_muscle WHERE id = ('%s') AND type = 'muscle'",
						 $muscle);
		$result = mysql_query($query);
		list($stat) = mysql_fetch_row($result);
		return $stat;
	} else{
		echo "muscle err";
	}
}

// WEAPON ATTRIBUTES //
function weapon_atts($weapon, $state){
	if($state == "attack"){
		$query = sprintf("SELECT attack FROM h_arsenal WHERE id = ('%s') AND type = 'weapon'",
						 $weapon);
		$result = mysql_query($query);
		list($stat) = mysql_fetch_row($result);
		return $stat;
	} elseif($state == "defense"){
		$query = sprintf("SELECT defense FROM h_arsenal WHERE id = ('%s') AND type = 'weapon'",
						 $weapon);
		$result = mysql_query($query);
		list($stat) = mysql_fetch_row($result);
		return $stat;
	} else{
		echo "weapon err";
	}
}
// WEAPON STRENGTH ASSESSMENT //
function assessment($value,$weaptot,$posse){
	$j = 0;
	while($j <= $posse){
		if($posse > $weaptot){
			$posse_left = $posse - $weaptot;
			$first_strength = $weaptot * $value;
			$w_strength = array($posse_left, $first_strength);
			return $w_strength;
		} else {
			$weapons_left = $posse;
			$w_strength = $weapons_left * $value;
			return $w_strength;
		}
		$j++;
	}
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
		$total_power = $muscle_power + $weapon_power;
		return $total_power;
		
	} else {
		
		$muscle_power = 0;
		$total_power = $muscle_power + $weapon_power;
		return $total_power;
	}
}
//*************************************************************
//*****************************************************
//*******************************************
//GET bonus history
function getBonus($userID) {
	$query = sprintf("SELECT bonus_pay FROM h_crew_member WHERE user = ('%s')",
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($bonus) = mysql_fetch_row($result);
	return $bonus;		
}

//GET CREW DEBIT HISTORY
////
//
function getDebit($userID) {
	$query = sprintf("SELECT bonus_bank FROM h_crew_member WHERE user = ('%s')",
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($bank) = mysql_fetch_row($result);
	return $bank;		
}

//PAYROLL
function payroll($crewid,$cash_stolen,$user,$posse,$who,$flow){
	if($flow == "positive" && $who == "circle"){
		//winning circle split
		$query = sprintf("SELECT cir_win_share FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($percentage) = mysql_fetch_row($result);
		$perct = $percentage/100;
		$pay = $cash_stolen*$perct;
		$inner_circle_gross = round($pay);
		while($posse > 0){
			$split_test = round($inner_circle_gross/$posse);
			if($split_test = 0){
				$posse = $posse - 1;
			} else {
				$query = sprintf("SELECT * FROM h_crew_members WHERE crew_id = ('%s') AND party = ('%s') LIMIT 0, ('%s')",
						mysql_real_escape_string ($crew_id),
						1,
						$posse);
				$result = mysql_query($query);
				// Update Member Private Account
				while($member_ar = mysql_fetch_assoc($result)){
					$memID = $member_ar["user"];
					$member_cash = getStat('cash',$memID);
					$deposit = $member_cash + $split_test;
					setStat('cash',$memID,$deposit);	
				}
				//
				// Update Member Crew Bonus Record
				while($member_ar = mysql_fetch_assoc($result)){
					$memID = $member_ar["user"];
					//Get current member bonus history
					$member_bonus = getBonus($memID);
					//
					$record = $member_bonus + $split_test;
					//
					$query = sprintf("UPDATE h_crew_members SET bonus_pay = ('%s') WHERE crew_id = ('%s') AND user = ('%s')",
						mysql_real_escape_string ($record),
						mysql_real_escape_string ($crewid),
						mysql_real_escape_string ($memID));
					$result = mysql_query($query);
				}
				$posse = 0;
			}
		}
		$circle_gross = $inner_circle_gross * posse;
		return $circle_gross;
	} elseif($flow == "positive" && $who == "general"){
		//winning general split
		$query = sprintf("SELECT nat_win_share FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($percentage) = mysql_fetch_row($result);
		$perct = $percentage/100;
		$pay = $cash_stolen*$perct;
		$general_pop_gross = round($pay);
		while($posse > 0){
			$split_test = round($general_pop_gross/$posse);
			if($split_test = 0){
				$posse = $posse - 1;
			} else {
				$query = sprintf("SELECT * FROM h_crew_members WHERE crew_id = ('%s') AND party = ('%s') LIMIT 0, ('%s')",
						mysql_real_escape_string ($crew_id),
						1,
						$posse);
				$result = mysql_query($query);
				// Update Member Private Account
				while($member_ar = mysql_fetch_assoc($result)){
					$memID = $member_ar["user"];
					$member_cash = getStat('cash',$memID);
					$deposit = $member_cash + $split_test;
					setStat('cash',$memID,$deposit);	
				}
				//
				// Update Member Crew Bonus Record
				while($member_ar = mysql_fetch_assoc($result)){
					$memID = $member_ar["user"];
					//Get current member bonus history
					$member_bonus = getBonus($memID);
					//
					$record = $member_bonus + $split_test;
					//
					$query = sprintf("UPDATE h_crew_members SET crew_earnings = ('%s') WHERE crew_id = ('%s') AND user = ('%s')",
						mysql_real_escape_string ($record),
						mysql_real_escape_string ($crewid),
						mysql_real_escape_string ($memID));
					$result = mysql_query($query);
				}
				$posse = 0;
			}
		}
		$gen_gross = $general_pop * $posse;
		return $gen_gross;
	} elseif($flow == "negative" && $who == "circle"){
		//loss circle split
		$query = sprintf("SELECT cir_loss_share FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($percentage) = mysql_fetch_row($result);
		$perct = $percentage/100;
		$gross_loss = $cash_stolen*$perct;
		$debit = round($pay);
		while($gross_loss > 0){
			//debit test
			$split_test = round($debit/$posse);
			if($split_test = 0){
				$posse = $posse - 1;
			} else {
				$query = sprintf("SELECT * FROM h_crew_members WHERE crew_id = ('%s') AND party = ('%s') ORDER BY id DESC LIMIT 0, ('%s')",
						mysql_real_escape_string ($crew_id),
						1,
						$posse);
				$result = mysql_query($query);
				// Update Member Private Account
				while($member_ar = mysql_fetch_assoc($result)){
					$memID = $member_ar["user"];
					$member_cash = getStat('cash',$memID);
					$withdrawal = $member_cash - $split_test;
					setStat('cash',$memID,$withdrawal);	
				}
				//
				// Update Member Crew Bank | Debit Record
				while($member_ar = mysql_fetch_assoc($result)){
					$memID = $member_ar["user"];
					//Get current member bonus history
					$member_debit = getDebit($memID);
					//
					$record = $member_debit - $split_test;
					//
					$query = sprintf("UPDATE h_crew_members SET bonus_bank = ('%s') WHERE crew_id = ('%s') AND user = ('%s')",
						mysql_real_escape_string ($record),
						mysql_real_escape_string ($crewid),
						mysql_real_escape_string ($memID));
					$result = mysql_query($query);
				}
				$gross_loss = 0;
			}
		}
		return $debit;
	} elseif($flow == "negative" && $who == "general"){
		//loss general split
		$query = sprintf("SELECT nat_loss_share FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($percentage) = mysql_fetch_row($result);
		$perct = $percentage/100;
		$gross_loss = $cash_stolen*$perct;
		$debit = round($pay);
		while($gross_loss > 0){
			//debit test
			$split_test = round($debit/$posse);
			if($split_test = 0){
				$posse = $posse - 1;
			} else {
				$query = sprintf("SELECT * FROM h_crew_members WHERE crew_id = ('%s') ORDER BY id DESC LIMIT 0, ('%s')",
						mysql_real_escape_string ($crew_id),
						$posse);
				$result = mysql_query($query);
				// Update Member Private Account
				while($member_ar = mysql_fetch_assoc($result)){
					$memID = $member_ar["user"];
					$member_cash = getStat('cash',$memID);
					$withdrawal = $member_cash - $split_test;
					setStat('cash',$memID,$withdrawal);	
				}
				//
				// Update Member Crew Bank | Debit Record
				while($member_ar = mysql_fetch_assoc($result)){
					$memID = $member_ar["user"];
					//Get current member bonus history
					$member_debit = getDebit($memID);
					//
					$record = $member_debit - $split_test;
					//
					$query = sprintf("UPDATE h_crew_members SET bonus_bank = ('%s') WHERE crew_id = ('%s') AND user = ('%s')",
						mysql_real_escape_string ($record),
						mysql_real_escape_string ($crewid),
						mysql_real_escape_string ($memID));
					$result = mysql_query($query);
				}
				$gross_loss = 0;
			}
		}
		return $debit;
	}else{
		//Error
	  return "payroll err";
	}
	return;
}

//HOW DEEP IS the CREW?
function how_deep($user){
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
	return $posse;
}

//Retrieve Property values
function asset_atts($asset){
		$query = sprintf("SELECT cp_value FROM h_assets WHERE id = ('%s')",
						 $asset);
		$result = mysql_query($query);
		list($value) = mysql_fetch_row($result);
		return $value;
} 

//Assess property
function assets_valuation($uid){
	$query = sprintf("SELECT asset_id, quantity FROM h_user_assets WHERE user_id = ('%s')",
				 $uid);
	$result = mysql_query($query);
	$tot_power = array();
	$att = array();
	$id = array();
	$total = array();
	while($assets_ar = mysql_fetch_assoc($result)){
		$asset = $assets_ar["asset_id"];
		$asset_tot = $assets_ar["quantity"];
		$asset_val = asset_atts($asset);
		if(isset($asset_val)){				 
			array_push($id, $asset);
			array_push($att, $asset_val);
			array_push($total, $asset_tot);
		}
	}
	//most valued asset 
	$amount = count($id);
	//
	$stack = array();
	while($i < $amount){
		$value = max($att);
		$key = array_search($value, $att);
		$a_value = $total[$key] * $value;
		array_push($stack, $a_value);
		unset($att[$key]);	
		$i++;
	}
	$scale = array_sum($stack);
	return $scale;
}

//COOL POINT ADJUSTER
function coolpoint_adjuster($userID,$math,$adjusted){
	$current_cool = getStat('exp',$userID);
	if($math == "add"){
		$cool = $current_cool + $adjusted;
		$done = setStat('exp',$userID,$cool);
	} else {
		//check adjusted cool against assets make sure not lower than assets allow
		$wealth_barrier = assets_valuation($userID);
		$variable_c = $current_cool - $wealth_barrier;
		if($variable_c < 0){
			return;
		}
		// Deduct
		$cool = $current_cool - $variable_c;
		$done = setStat('exp',$userID,$cool);
	}
	return;
}

//ACHIEVEMENTS TEST
function achievements(){}
//sessionize arcade challenge id if one is set{
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
$query = sprintf("SELECT timesplayed FROM arcade_games WHERE shortname = ('%s')",
			mysql_real_escape_string ($gname));
$result = mysql_query($query);
list($activity) = mysql_fetch_row($result);

$activity = $activity + 1;

$query = sprintf("UPDATE arcade_games SET timesplayed ('%s') WHERE shortname = ('%s')",
			$activity,																	
			mysql_real_escape_string ($gname));
mysql_query($query);

////Identify if user satisfied a challenge
$query = sprintf("SELECT * FROM arcade_challenges WHERE UPPER(user2) = UPPER('%s') AND gameid = (%s) AND done = ('%s')",
			mysql_real_escape_string ($user_name),
			mysql_real_escape_string ($gid),
			0);
$result = mysql_query($query);
$fight_ar = mysql_fetch_assoc($result);

//////Battle Prep!
if(isset($fight_ar)){
	//Retrieve all fight variables
	$instigator = $fight_ar["user1"];
	$instigator_s = $fight_ar["score1"];
	$challenge_id = $fight_ar["id"];
	$ins_action = $fight_ar["action1"];
	$def_action = $fight_ar["action2"];
	$wager = $fight["wager"];
	
	//Insert new score
	$query = sprintf("UPDATE arcade_challenges SET score2 = ('%s'), time = ('%s') WHERE id = ('%s') AND UPPER(user2) = UPPER('%s')",
			mysql_real_escape_string ($gscore),
			mysql_real_escape_string ($fb_time),
			mysql_real_escape_string ($challenge_id),
			mysql_real_escape_string ($user_name));
	mysql_query($query);
	
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
	if($ins_action = "attack" && $def_action ="defend"){
		$battle = 1;
	}
	if($ins_action = "defend" || $def_action = "attack"){
		$battle = 1;
	}
	if($ins_action = "attack" || $def_action = "attack"){
		$battle = 1;
	}
	//BATTLE-FIELD
	if($battle = 1){
		 // ************ROBBERY************************************
		 //********************ROBBERY*****************************
		 //****************************ROBBERY*********************
		 $instigator_strength = battle_prep($instigator,$ins_action);
		 $defender_strength = battle_prep($user_name,$def_action);
		
		 //Strength Multiplier Bonus
		 $coolbonus = bonus($stage,$title);
		 ////FIGHT!
		 $i_tactics = $instigator_strength * $coolbonus;
		 $d_tactics = $defender_strength * $coolbonus;
		 if($i_tactics > $d_tactics){
			//****************
			//instigator wins
			//****************
			$sql = "UPDATE `arcade_challenges` SET `done` = 1 WHERE `id` = '$challenge_id' LIMIT 1";
            $result=mysql_query($sql);
			//PROFILE UPDATE
			
			//Challenge won
			$sql = "UPDATE `h_users` SET `ch_won` = `ch_won`+1 WHERE `user` = '$instigator' LIMIT 1";
            $result=mysql_query($sql);
			
			//Robbery Won
			$sql = "UPDATE `h_users` SET `rob_won` = `rob_won`+1 WHERE `user` = '$instigator' LIMIT 1";
            $result=mysql_query($sql);
			//
			
			$robbery_value = $i_tactics - $d_tactics;	
			$hit = rand(1,$robbery_value);
			$cash_stolen = $hit + $wager;
			//cash awarded, Cool Points adjusted and then loss and winnings split
			
			$posse = how_deep($instigator);
			if($posse = 1){
				$mine = 0;
			} else {
				//*************
				$who = "circle";
				$flow = "positive";
				//*************
				$c_take = payroll($i_crewID,$cash_stolen,$instigator,$posse,$who,$flow);
				$left = $cash_stolen - $c_take;
				//*************
				$who = "general";
				$flow = "positive";
				//Muster members
				$query = sprintf("SELECT COUNT(id) FROM h_crew_member WHERE crew_id = ('%s')",
					mysql_real_escape_string ($i_crewID));
				$result = mysql_query($query);
				list($posse) = mysql_fetch_row($result);
				//
				$gen_share = payroll($i_crewID,$left,$instigator,$posse,$who,$flow);
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
			
			//Spread Defender's CASH Loss (and earn cool points!)
			//AND Retrieve User Crew ID
			
			//PROFILE UPDATE
			
			//Challenge Lost
			$sql = "UPDATE `h_users` SET `ch_lost` = `ch_lost`+1 WHERE `user` = '$user_name' LIMIT 1";
            $result=mysql_query($sql);
			
			//Robbed
			$sql = "UPDATE `h_users` SET `robbed_tot` = `robbed_tot`+1 WHERE `user` = '$user_name' LIMIT 1";
            $result=mysql_query($sql);
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
				$circle_debit = payroll($crewID,$cash_stolen,$user_name,$d_posse,$who,$flow);
				$now_owed = $cash_stolen - $circle_debit;
				//*************
				$who = "general";
				$flow = "negative";
				//*************	
				$general_debit = payroll($crewID,$now_owed,$user_name,$d_posse,$who,$flow);
				$i_owe = $cash_stolen - $general_debit;
				$their_loss = $i_owe;
			}
			$d_cash = getStat('cash',$user_ID);
			$net_loss = $d_cash - $their_loss;
			$mk_debit = setStat('cash',$user_ID,$net_loss);
			
			//COOL POINTS EARNED for fighting the good fight! | maybe
			$adjusted = rand(1,$net_loss);			
			$luck = rand(1,3);
			
			if($luck = 1){
				$math = "add";
				$report = $adjusted;
				$finished = coolpoint_adjuster($user_ID,$math,$adjusted);
			} elseif($luck = 3) {
				$math = "subtract";
				$finished = coolpoint_adjuster($user_ID,$math,$adjusted);
				$b_report = $adjusted;
			}		
			//no cp
			
			//BREAKING NEWS********************************************//BREAKING NEWS
			$time = time();
			//ARCADE
			$sql = "INSERT INTO `arcade_news` (`type`, `time`, `winner`, `loser`, `score`, `wager`) VALUES ('1', '$time', '$instigator', '$user_name', `$gscore`, `$wager`)";
            $result=mysql_query($sql);
			//USER NEWS
			$sql = "INSERT INTO `h_user_news` (`fair`, `time`, `winner`, `loser`, `score`, `take`, `wager`,`cool_lost`,`extra`,`ouch`) VALUES ('0', '$time', '$instigator', '$user_name', '$gscore', `$robbery_value`, `$wager`,`$cool_points_lost`,`$report`,`b_report`)";
            $result=mysql_query($sql);
			
		 } elseif($i_tactics < $d_tactics) {
			 $sql = "UPDATE `arcade_challenges` SET `done` = 1 WHERE `id` = '$challenge_id' LIMIT 1";
            $result=mysql_query($sql);
			//defender wins
			//PROFILE UPDATE
			
			//Challenge won
			$sql = "UPDATE `h_users` SET `ch_won` = `ch_won`+1 WHERE `user` = '$user_name' LIMIT 1";
            $result=mysql_query($sql);
			
			//Robbery lost
			$sql = "UPDATE `h_users` SET `rob_won` = `rob_lost`+1 WHERE `user` = '$instigator' LIMIT 1";
            $result=mysql_query($sql);
			
			////Challenge lost
			$sql = "UPDATE `h_users` SET `rob_won` = `ch_lost`+1 WHERE `user` = '$instigator' LIMIT 1";
            $result=mysql_query($sql);
			//
			$net_take = $d_tactics - $i_tactics;
			$cool_points_earned = rand(1,$net_take);
			$math = "add";
			$adjusted = $cool_points_earned;
			coolpoint_adjuster($user_ID,$math,$adjusted);
			//Cash Deposit
			$d_cash = getStat('cash',$user_ID);
			$net_gain = $d_cash + $wager;
			$mk_deposit = setStat('cash',$user_ID,$net_gain);
			//Instigator Lost Cool
			$cool_points_loss = rand(1,$net_take);
			$math = "subtract";
			coolpoint_adjuster($i_userID,$math,$cool_points_loss);
			//BREAKING NEWS********************************************//BREAKING NEWS
			$time = time();
			//ARCADE
			$sql = "INSERT INTO `arcade_news` (`type`, `time`, `winner`, `loser`, `score`, `wager`) VALUES ('1', '$time', '$user_name', '$instigator', `$gscore`, `$wager`)";
            $result=mysql_query($sql);
			//USER NEWS
			$sql = "INSERT INTO `h_user_news` (`fair`, `time`, `winner`, `loser`, `score`, `take`,`wager`,`cool_earned`,`cool_lost`) VALUES ('0', '$time', '$user_name', '$instigator', '$gscore', `$robbery_value`, `$wager`, `$cool_points_earned`,`$cool_points_loss`)";	
				
		 } else {
			 //FAIR PLAY
			 if($instigator_s > $gscore){
				 $sql = "UPDATE `arcade_challenges` SET `done` = 1 WHERE `id` = '$challenge_id' LIMIT 1";
            	$result=mysql_query($sql);
			
				 //PROFILE UPDATE
			
				//Challenge won
				$sql = "UPDATE `h_users` SET `ch_won` = `ch_won`+1 WHERE `user` = '$instigator' LIMIT 1";
				$result=mysql_query($sql);
				
				//
				$query = sprintf("UPDATE arcade_challenges SET winner = ('%s') WHERE id = ('%s') AND UPPER(user2) = UPPER('%s')",
					mysql_real_escape_string ($instigator),
					mysql_real_escape_string ($challenge_id),
					mysql_real_escape_string ($user_name));
				mysql_query($query);
				//Cash Deposit
				$i_cash = getStat('cash',$i_userID);
				$net_gain = $i_cash + $wager;
				$mk_deposit = setStat('cash',$i_userID,$net_gain);
				//Earn Cool
				$cool_points_earned = rand(1,$wager);
				$math = "add";
				$adjusted = $cool_points_earned;
				coolpoint_adjuster($i_userID,$math,$adjusted);
				//Defender Lost Cool
				
				//PROFILE UPDATE
				////Challenge loss
				$sql = "UPDATE `h_users` SET `ch_lost` = `ch_lost`+1 WHERE `user` = '$user_name' LIMIT 1";
				$result=mysql_query($sql);
				
				$cool_points_loss = rand(1,$wager);
				$math = "subtract";
				coolpoint_adjuster($user_ID,$math,$cool_points_loss);
				//Breaking NEws
				$time = time();
				//ARCADE
				$sql = "INSERT INTO `arcade_news` (`type`, `time`, `winner`, `loser`, `score`, `wager`) VALUES ('1', '$time', '$instigator', '$user_name', `$gscore`, `$wager`)";
				$result=mysql_query($sql);
				//USER NEWS
				$sql = "INSERT INTO `h_user_news` (`time`, `winner`, `loser`, `score`,`wager`,`cool_earned`,`cool_lost`) VALUES ('$time', '$instigator', '$user_name', '$gscore',`$wager`,`$cool_points_earned`,`$cool_points_loss`)";
				
			 } else {
				 $sql = "UPDATE `arcade_challenges` SET `done` = 1 WHERE `id` = '$challenge_id' LIMIT 1";
            $result=mysql_query($sql);
			
				 //PROFILE UPDATE
				 ////Challenge won
				$sql = "UPDATE `h_users` SET `ch_won` = `ch_lost`+1 WHERE `user` = '$user_name' LIMIT 1";
				$result=mysql_query($sql);
				
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
				$sql = "UPDATE `h_users` SET `ch_lost` = `ch_lost`+1 WHERE `user` = '$instigator' LIMIT 1";
				$result=mysql_query($sql);
				
				$cool_points_loss = rand(1,$wager);
				$math = "subtract";
				coolpoint_adjuster($i_userID,$math,$cool_points_loss);
				//BREAKING NEWS
				$time = time();
				//ARCADE
				$sql = "INSERT INTO `arcade_news` (`type`, `time`, `winner`, `loser`, `score`, `wager`) VALUES ('1', '$time', '$user_name', '$instigator', `$gscore`, `$wager`)";
				$result=mysql_query($sql);
				//USER NEWS
				$sql = "INSERT INTO `h_user_news` (`time`, `winner`, `loser`, `score`,`wager`,`cool_earned`,`cool_lost`) VALUES ('$time', '$user_name', '$instigator', '$gscore',`$wager`,`$cool_points_earned`,`$cool_points_loss`)";
			 }
		 }
	} else {
		// ************FAIR************************************
		//********************FAIR*****************************
		//****************************FAIR*********************
		$sql = "UPDATE `arcade_challenges` SET `done` = 1 WHERE `id` = '$challenge_id' LIMIT 1";
            $result=mysql_query($sql);
		//compare scores
		
		if($instigator_s > $gscore){
			//PROFILE UPDATE
			////Challenge win
			$sql = "UPDATE `h_users` SET `ch_won` = `ch_won`+1 WHERE `user` = '$instigator' LIMIT 1";
			$result=mysql_query($sql);
			
			$query = sprintf("UPDATE arcade_challenges SET winner = ('%s') WHERE id = ('%s') AND UPPER(user2) = UPPER('%s')",
				mysql_real_escape_string ($instigator),
				mysql_real_escape_string ($challenge_id),
				mysql_real_escape_string ($user_name));
			mysql_query($query);
			//Cash Deposit
			$i_cash = getStat('cash',$i_userID);
			$net_gain = $i_cash + $wager;
			$mk_deposit = setStat('cash',$i_userID,$net_gain);
			//Earn Cool
			$cool_points_earned = rand(1,$wager);
			$math = "add";
			$adjusted = $cool_points_earned;
			coolpoint_adjuster($i_userID,$math,$adjusted);
			//Defender Lost Cool
			
			//PROFILE UPDATE
			////Challenge LOST
			$sql = "UPDATE `h_users` SET `ch_lost` = `ch_lost`+1 WHERE `user` = '$user_name' LIMIT 1";
			$result=mysql_query($sql);
			
			$cool_points_loss = rand(1,$wager);
			$math = "subtract";
			coolpoint_adjuster($user_ID,$math,$cool_points_loss);
			//Breaking NEws
			$time = time();
			//ARCADE
			$sql = "INSERT INTO `arcade_news` (`type`, `time`, `winner`, `loser`, `score`, `wager`) VALUES ('1', '$time', '$instigator', '$user_name', `$gscore`, `$wager`)";
			$result=mysql_query($sql);
			//USER NEWS
			$sql = "INSERT INTO `h_user_news` (`time`, `winner`, `loser`, `score`,`wager`,`cool_earned`,`cool_lost`) VALUES ('$time', '$instigator', '$user_name', '$gscore',`$wager`,`$cool_points_earned`,`$cool_points_loss`)";
			
		} else {
			$sql = "UPDATE `arcade_challenges` SET `done` = 1 WHERE `id` = '$challenge_id' LIMIT 1";
            $result=mysql_query($sql);
			//PROFILE UPDATE
			////Challenge win
			$sql = "UPDATE `h_users` SET `ch_won` = `ch_won`+1 WHERE `user` = '$user_name' LIMIT 1";
			$result=mysql_query($sql);
			
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
			////Challenge LOST
			$sql = "UPDATE `h_users` SET `ch_lost` = `ch_lost`+1 WHERE `user` = '$instigator' LIMIT 1";
			$result=mysql_query($sql);
			
			$cool_points_loss = rand(1,$wager);
			$math = "subtract";
			coolpoint_adjuster($i_userID,$math,$cool_points_loss);
			//BREAKING NEWS
			$time = time();
			//ARCADE
			$sql = "INSERT INTO `arcade_news` (`type`, `time`, `winner`, `loser`, `score`, `wager`) VALUES ('1', '$time', '$user_name', '$instigator', `$gscore`, `$wager`)";
			$result=mysql_query($sql);
			//USER NEWS
			$sql = "INSERT INTO `h_user_news` (`time`, `winner`, `loser`, `score`,`wager`,`cool_earned`,`cool_lost`) VALUES ('$time', '$user_name', '$instigator', '$gscore',`$wager`,`$cool_points_earned`,`$cool_points_loss`)";
		}
	}		
}


//JUST PRACTICE!!!
//check to see if we have a new high score

if($isreverse == 1){
	$sql = "SELECT * FROM `arcade_highscores` WHERE `gamename` = '$gameid' AND `score` < '$gscore' ORDER BY `score`, `time` ASC, `scoreid` ASC, `scoreid` ASC LIMIT 1";
} else {
	$sql = "SELECT * FROM `arcade_highscores` WHERE `gamename` = '$gameid' AND `score` > '$gscore' ORDER BY `score`, `time` ASC, `scoreid` ASC, `scoreid` ASC LIMIT 1";
}

$result=mysql_query($sql);
$num = mysql_num_rows($result);

if($num < 1){
	// remove credit from old highscorer
	if($isreverse == 1){
		$sql = "SELECT * FROM `arcade_highscores` WHERE `gamename` = '$gameid' ORDER BY `score` ASC, `time` ASC, `scoreid` ASC LIMIT 1";
	} else {
		$sql = "SELECT * FROM `arcade_highscores` WHERE `gamename` = '$gameid' ORDER BY `score` DESC, `time` ASC, `scoreid` ASC LIMIT 1";
	}
	
	$result=mysql_query($sql);
    $num2 = mysql_num_rows($result);
    if($num2 == 1){
		$row = mysql_fetch_array($result);
        $huser = $row['username'];
        $sql = "UPDATE `h_users` SET `arcade_champ` = `arcade_champs`-1 WHERE `user` = '$huser' LIMIT 1";
                $result=mysql_query($sql);
	}
	// add credit to new highscorer
    $sql = "UPDATE `h_users` SET `arcade_champ` = `arcade_champs`+1 WHERE `user` = '$user_name' LIMIT 1";
            $result=mysql_query($sql);
            $time = time();

    // submit to news
    $sql = "INSERT INTO `arcade_news` (`type`, `time`, `winner`, `loser`, `score`) VALUES ('1', '$time', '$user_name', '$huser', '$gscore')";
            $result=mysql_query($sql);
}
echo $fb_user;
echo $gname;
echo $gscore;	
?>