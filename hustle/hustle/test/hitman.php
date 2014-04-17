<?php
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
		
include 'stats.php';		

$target = $_POST['target'];
$user = $_POST['instigator'];

$user = "jermongreen";
$target = "berneclaude";


$time = time();
$instigator = $user;

//get user stats
	$query = sprintf("SELECT * FROM h_users WHERE user = ('%s')",
			mysql_real_escape_string ($instigator));
	$result = mysql_query($query);
	$user_ar = mysql_fetch_assoc($result);
	$i_userID = $user_ar["id"];
	
//functions

//BATTLE PREPARATION FUNCTION
function battle_prep($user,$state){
	//Retrieve fighter ID
	$userID = id($user);
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
	if(empty($posse)){
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
		$total_power = $muscle_power + $weapon_power;
		return $total_power;
		
	} else {
		
		$muscle_power = 0;
		$total_power = $muscle_power + $weapon_power;
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
	
	
$set = 1;
//$set = 0;


//echo $anonymous;
//deduct energy
//Retrieve Instigator User ID
$i_userID = id($instigator);

$energy = getStat('ep',$i_userID);

$toll = $energy - 4;	

if($toll < 0){
	echo "You don't have enough energy";
} else {
	//AND Retrieve Instigator Crew ID
	$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
					mysql_real_escape_string ($instigator));
	$result = mysql_query($query);
	list($i_crewID) = mysql_fetch_row($result);
	//
	////Identify Target ID
	$user_ID = id($target);
	
	$ins_action = "attack";
	//Identify Defender crew settings
	$query = sprintf("SELECT * FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string ($target));
	$result = mysql_query($query);
	$defcrew_ar = mysql_fetch_assoc($result);
	$action = $defcrew_ar["intimidate"]; 
	
	if($action == "yes"){
		$def_action = "attack";
	}else{
		$def_action = "defend";
	}
	// ************ROBBERY************************************
	//********************ROBBERY*****************************
	//****************************ROBBERY*********************
	$instigator_strength = battle_prep($instigator,$ins_action);
	$defender_strength = battle_prep($target,$def_action);
	$defender_strength = 100;
	if($instigator_strength > $defender_strength){
		//****************
		//instigator wins
		//****************
		
		//Heist Won
		$que = sprintf("SELECT heist_won FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($heist_won) = mysql_fetch_row($result);
						
						$heist_won = $heist_won + 1;
						
		$sql = sprintf("UPDATE h_users SET robbed_tot = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($heist_won),
							mysql_real_escape_string($instigator));
							mysql_query($sql);

		//
		//What's the DAMMAGE?
		$robbery_value = $instigator_strength - $defender_strength;	
		medical($robbery_value,$user_ID,$target);
		$hit = rand(1,$robbery_value);
		//check if cleader and crew have the CASH...
		$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
						mysql_real_escape_string($target));
		$result = mysql_query($query);
		list($crewID) = mysql_fetch_row($result);
	
		$net_worth = 12;
		//EXIT POINT
		if($net_worth <= 0){
			echo $target." is currently bankrupt! Nothing to steal.";
		} else {
			if($net_worth < $hit){
				$hit = $net_worth;
				$extra = " Additionally, player is now financially ruined...";
				//set new energy level
				setStat('ep',$i_userID,$toll);
				//retrieve the bounty
				$query = sprintf("SELECT bounty FROM h_hitlist WHERE target = ('%s')",
							mysql_real_escape_string ($target));
				$result = mysql_query($query);
				list($bounty) = mysql_fetch_row($result);
			
				if($bounty > 0){
					$cash_stolen = $hit + $bounty;
				} else {
					$cash_stolen = $hit;
				}
				//
				//cash awarded, Cool Points adjusted and then loss and winnings split
				
				$posse = how_deep($instigator);
				if($posse == 1){
					$mine = 0;
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
				$clost = $cool_points_lost;
				medical($cool_points_lost,$i_userID,$instigator);
				coolpoint_adjuster($i_userID,$math,$cool_points_lost);
				//record robbery
				$time = time();
				//Spread Defender's CASH Loss (and earn cool points!)
				//AND Retrieve User Crew ID
				
				//PROFILE UPDATE
				
				//Robbed
				$que = sprintf("SELECT robbed_tot FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($target));
						$result = mysql_query($que);
						list($rob_tot) = mysql_fetch_row($result);
						
						$rob_tot = $rob_tot + 1;
						
				$sql = sprintf("UPDATE h_users SET robbed_tot = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_tot),
							mysql_real_escape_string($target));
							mysql_query($sql);
				
				$sql_l = sprintf("UPDATE h_users SET snitch = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string(1),
							mysql_real_escape_string($target));
							mysql_query($sql_l);
				//Debit
				$cash_stolen = $cash_stolen - $bounty;
				if($cash_stolen <= 1){
					$their_loss = 1; 
				} else {
					//*************
					$who = "circle";
					$flow = "negative";
					//*************	
					//DEFENDER POSSE
					$d_posse = how_deep($target);					
					$circle_debit = nc_pay($crewID,$cash_stolen,$target,$d_posse,$who,$flow);
					$now_owed = $cash_stolen - $circle_debit;
					//*************
					$who = "general";
					$flow = "negative";
					//*************	
					$general_debit = ng_pay($crewID,$now_owed,$target,$d_posse,$who,$flow);
					$i_owe = $cash_stolen - $general_debit;
					$their_loss = $i_owe;
				}
				$d_cash = getStat('cash',$user_ID);
				$net_loss = $d_cash - $their_loss;
				$mk_debit = setStat('cash',$user_ID,$net_loss);
				
				//COOL POINTS EARNED for fighting the good fight! | maybe
				$adjusted = rand(1,$net_loss);			
				$luck = rand(1,3);
				
				if($luck == 1){
					$math = "add";
					$report = $adjusted;
					$finished = coolpoint_adjuster($user_ID,$math,$adjusted);
				} elseif($luck == 3) {
					$math = "subtract";
					$finished = coolpoint_adjuster($user_ID,$math,$adjusted);
					$b_report = $adjusted;
				}		
				//no cp
				
				//WINNER NEWS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				$query = sprintf("UPDATE h_hitlist SET time = ('%s'), instigator = ('%s'), completed = ('%s') WHERE completed = ('%s') AND target = ('%s')",
				mysql_real_escape_string($time),
				mysql_real_escape_string($instigator),
				1,
				0,
				mysql_real_escape_string($target));
				mysql_query($query);
			
				$recipient_message = "You were just robbed of $".$cash_stolen."!".$instigator." was the culprit";
				//
				crime_reporter($target,1,$recipient_message,"recipient");
				$sender_message = "Target: ".$target." Take: $".$cash_stolen." CP: -".$cool_points_lost;
				//
				crime_reporter($instigator,1,$recipient_message,"sender");
				
				echo "You just pulled off a $".$cash_stolen." Heist!".$extra;
			}
		}
	} elseif($instigator_strength < $defender_strength) {
			
		//defender wins
		//PROFILE UPDATE
		
		//Robbery lost
		$que = sprintf("SELECT heist_lost FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($r) = mysql_fetch_row($result);
						
						$r = $r + 1;
						
		$sql = sprintf("UPDATE h_users SET heist_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($r),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
		
		
		$net_take = $defender_strength - $instigator_strength;
		medical($net_take,$user_ID,$target);
		$cool_points_earned = rand(1,$net_take);
		$math = "add";
		$adjusted = $cool_points_earned;
		coolpoint_adjuster($user_ID,$math,$adjusted);
		
		//Instigator Lost Cool
		$cool_points_loss = rand(1,$net_gain);
		$math = "subtract";
		coolpoint_adjuster($i_userID,$math,$cool_points_loss);
		medical($cool_points_loss,$i_userID,$instigator);
		//BREAKING NEWS********************************************//BREAKING NEWS
		$time = time();
		$query = sprintf("UPDATE h_hitlist SET time = ('%s'), instigator = ('%s'), completed = ('%s') WHERE completed = ('%s') AND target = ('%s')",
			mysql_real_escape_string($time),
			mysql_real_escape_string($instigator),
			1,
			0,
			mysql_real_escape_string($target));
		mysql_query($query);
		
		$recipient_message = "Your name is now off the list, ".$instigator."tried to rob you but couldn&acute;t pull it off...";
				//
				crime_reporter($target,1,$recipient_message,"recipient");
				$sender_message = "You failed to at the robbery attempt on".$target." CP: -".$cool_points_lost;
				//
				crime_reporter($instigator,1,$recipient_message,"sender");
		
		echo $instigator.",you just fail at this, and lost ".$cool_points_lost." CP, why'd you even try?";
	}
}		
	
	
											   
?>