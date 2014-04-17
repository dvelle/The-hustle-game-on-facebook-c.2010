<?php
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
		
include 'stats.php';		

$target = $_POST['target'];
$user = $_POST['instigator'];

$clinic = $_POST['hospital'];
$public = $_POST['public'];
$crazy = $_POST['crazy'];

$user = "jermongreen";
$target = "jamison";
//$attack = 1;

$time = time();
$instigator = $user;

//get user stats
	$query = sprintf("SELECT * FROM h_users WHERE user = ('%s')",
			mysql_real_escape_string ($instigator));
	$result = mysql_query($query);
	$user_ar = mysql_fetch_assoc($result);
	$i_userID = $user_ar["id"];
	
					 
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
function fight_npc($user,$target){
	$instigator = $user;
	$i_userID = id($user);
	$user_ID = id($target);
	//no security 		   
	//what mission is user on
	$query = sprintf("SELECT mission_id FROM h_mission_central WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string ($user));
	$result = mysql_query($query);
	list($m_id) = mysql_fetch_row($result);
	if(empty($m_id)){
		//this is a robot fight user doesnt have mission
		$query = sprintf("SELECT strength FROM h_npcs WHERE npc = ('%s')",
					mysql_real_escape_string ($target));
		$result = mysql_query($query);
		list($npc_power) = mysql_fetch_row($result);
		$ins_action = "attack";
		$instigator_strength = battle_prep($instigator,$ins_action);
		if($instigator_strength > $npc_power){
			//give some cash
			$winnings = $instigator_strength - $npc_power;
			$hand = getStat("cash",i_userID);
			$deposit = $hand + $winnings;
			setStat("cash",i_userID,$deposit);
			//check to see if NPC dies, 
			$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user));
			$result = mysql_query($query);
			list($chapter) = mysql_fetch_row($result);
			if($chapter >= 5){
				if($chapter == 6){
					$cash = getStat("cash",$i_userID);
					$cash = $cash + 105;//Jamison billfold
					setStat("cash",$i_userID,$cash);
				}
				//delete from patron list...and notify npc death
				$sql = sprintf("SELECT COUNT(id) FROM h_patrons WHERE club_id = ('%s') AND user_id = ('%s')",
						mysql_real_escape_string($biz_id),
						mysql_real_escape_string($user_ID));
					$result = mysql_query($sql);
				list($count) = mysql_fetch_row($result);
				if(!empty($count)){
					$sql = sprintf("DELETE FROM h_patrons WHERE user_id = ('%s') AND club_id = ('%s')",
						mysql_real_escape_string ($user_ID),
						mysql_real_escape_string ($biz_id));
					mysql_query($sql);
				} else {
					$sql = sprintf("DELETE FROM h_patrons WHERE user_id = ('%s') AND casino_id = ('%s')",
						mysql_real_escape_string ($user_ID),
						mysql_real_escape_string ($biz_id));
					mysql_query($sql);
				}
				//tutorial advances...
				$query = sprintf("SELECT id FROM h_patrons WHERE user_id = ('%s') AND club_id = '%s'",
							mysql_real_escape_string(2),//earvin
							mysql_real_escape_string(156));
						$result = mysql_query($query);
						list($earvin) = mysql_fetch_row($result);
				$query = sprintf("SELECT id FROM h_patrons WHERE user_id = ('%s') AND club_id = '%s'",
							mysql_real_escape_string(3),//earvin
							mysql_real_escape_string(156));
						$result = mysql_query($query);
						list($jen) = mysql_fetch_row($result);
				$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
						$result = mysql_query($query);
						list($chapter) = mysql_fetch_row($result);		
				if(empty($earvin) && empty($jen) && $chapter == 14){
					$chapter = $chapter + 1;

					$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($chapter),
						mysql_real_escape_string($user));
					mysql_query($query);
				}
				$action = 55;// NPC DEAD
			}
		} elseif($instigator_strength <= $npc_power){
			//take cash & health, and energy
			$bias = $npc_power + 1;
			$var = $bias - $instigator_strength;
			$dammage = rand(1,$var);
			$heart = getStat("health",i_userID);
			$shield = getShield(i_userID);
			if($shield > 0){
				$down = $shield - $dammage;
				if($down < 0){
					setShield(i_userID,$down);
					$action = 6;
				} else {
					setShield(i_userID,$down);
					$reset = $heart - $down;
					if($rest < 0){
						setStat("health",i_userID,$reset);
						$action = 7;
					} else {
						setStat("health",i_userID,$reset);
					}
				}				
			}
			//
			$hand = getStat("cash",i_userID);
			$debit = $hand - $npc_power;
			setStat("cash",i_userID,$debit);
			//
			$action = 4;//they win
		}
	} else {
	//this is a mission fight
	//store npc name for fight reference
	$query = sprintf("INSERT INTO h_npc_fights(npc,user_id) VALUES ('%s','%s')",
						mysql_real_escape_string($target),
						mysql_real_escape_string($i_userID));
					mysql_query($query);
	$action = 99;//show message then fight
	
	}
	return $action;
}
function user($id){
	$query = sprintf("SELECT user FROM h_users WHERE id = ('%s')",
				mysql_real_escape_string($id));
			$result = mysql_query($query);
	list($user) = mysql_fetch_row($result);
	return $user;			
}
function fight_ring($instigator,$target){
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
	
	if($instigator_strength > $defender_strength){
		//****************
		//instigator wins
		//****************
		
		//Heist Won
		$que = sprintf("SELECT rob_won FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($rob_won) = mysql_fetch_row($result);
						
						$rob_won = $rob_won + 1;
						
		$sql = sprintf("UPDATE h_users SET rob_won = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_won),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
							
		$que = sprintf("SELECT rob_lost FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($target));
						$result = mysql_query($que);
						list($rob_lost) = mysql_fetch_row($result);
						
						$rob_lost = $rob_lost + 1;
						
		$sql = sprintf("UPDATE h_users SET rob_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_lost),
							mysql_real_escape_string($target));
							mysql_query($sql);									

		//IDS
		$tid = id($target);
		$i_userID = id($user);
		//What's the DAMMAGE?
		$robbery_value = $instigator_strength - $defender_strength;	
		medical($robbery_value,$tid,$target);
		$hit = rand(1,$robbery_value);
		//check if cleader and crew have the CASH...
		$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
						mysql_real_escape_string($instigator));
		$result = mysql_query($query);
		list($i_crewID) = mysql_fetch_row($result);
		
		$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
						mysql_real_escape_string($target));
		$result = mysql_query($query);
		list($tcrewID) = mysql_fetch_row($result);
	
		$net_worth = crew_worth($tid, $tcrewID);
		//EXIT POINT
		if($net_worth <= 0){
			return 123;				
		} else {
			if($net_worth < $hit){
				$cash_stolen = $net_worth;
				$extra = " Additionally, player is now financially ruined...";
				
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
				setStat('cash',$i_userID,$net_take);
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
				$sql_l = sprintf("UPDATE h_users SET snitch = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string(1),
							mysql_real_escape_string($target));
							mysql_query($sql_l);
				//Debit
				if($cash_stolen <= 1){
					$their_loss = 1; 
				} else {
					//*************
					$who = "circle";
					$flow = "negative";
					//*************	
					//DEFENDER POSSE
					$d_posse = how_deep($target);
					if($d_posse == 1){
						$their_loss = $cash_stolen;
					} else {
						$circle_debit = nc_pay($tcrewID,$cash_stolen,$target,$d_posse,$who,$flow);
						$now_owed = $cash_stolen - $circle_debit;
						//*************
						$who = "general";
						$flow = "negative";
						//*************	
						$general_debit = ng_pay($tcrewID,$now_owed,$target,$d_posse,$who,$flow);
						$i_owe = $cash_stolen - $general_debit;
						$their_loss = $i_owe;
					}
				}
				$d_cash = getStat('cash',$tid);
				$net_loss = $d_cash - $their_loss;
				setStat('cash',$tid,$net_loss);
				
				//COOL POINTS EARNED for fighting the good fight! | maybe
				$adjusted = rand(1,$cash_stolen);			
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
				$recipient_message = ucwords($instigator);" just robbed you of $".$cash_stolen."!";
				//
				crime_reporter($target,1,$recipient_message,"recipient");
				$sender_message = "Target: ".$target." Take: $".$cash_stolen." CP: -".$cool_points_lost;
				//
				crime_reporter($instigator,1,$recipient_message,"sender");
				$action = 5;// i win
			}
		}
	} elseif($instigator_strength < $defender_strength) {
			
		//defender wins
		//PROFILE UPDATE
		
		//Robbery lost
		$que = sprintf("SELECT rob_lost FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($r) = mysql_fetch_row($result);
						
						$r = $r + 1;
						
		$sql = sprintf("UPDATE h_users SET rob_lost = ('%s') WHERE user = ('%s')",
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
		$cool_points_loss = rand(1,$net_take);
		$math = "subtract";
		coolpoint_adjuster($i_userID,$math,$cool_points_loss);
		medical($cool_points_loss,$i_userID,$instigator);
		//BREAKING NEWS********************************************//BREAKING NEWS
		$time = time();
		
		$recipient_message = ucwords($instigator)." tried to rob you but couldn&acute;t pull it off...";
				//
				crime_reporter($target,1,$recipient_message,"recipient");
				$sender_message = "You failed the robbery attempt on ".ucwords($target)." CP: -".$cool_points_lost;
				//
				crime_reporter($instigator,1,$recipient_message,"recipient");
		$action = 4;//they win
	} elseif($instigator_strength == $defender_strength) {
		$action = 3;//tie
	}
		return $action;
}

function i_win($instigator,$target,$cash_stolen,$i_crewID,$tcrewID){
	$i_userID = id($instigator);
	$tid = id($target);
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
	setStat('cash',$i_userID,$net_take);
	//
	//cool points lost			
	$cool_points_lost = rand(1,$cash_stolen);
	$clost = $cool_points_lost;
	$math = "subtract";
	medical($cool_points_lost,$i_userID,$instigator);
	coolpoint_adjuster($i_userID,$math,$cool_points_lost);
	//record robbery
	$time = time();
	//Spread Defender's CASH Loss (and earn cool points!)
	//AND Retrieve User Crew ID
	
	//PROFILE UPDATE
	
	//Robbed				
	$sql_l = sprintf("UPDATE h_users SET snitch = ('%s') WHERE user = ('%s')",
				mysql_real_escape_string(1),
				mysql_real_escape_string($target));
	mysql_query($sql_l);
	//Debit
	if($cash_stolen <= 1){
		$their_loss = 1; 
	} else {
		//*************
		$who = "circle";
		$flow = "negative";
		//*************	
		//DEFENDER POSSE
		$d_posse = how_deep($target);
		if($d_posse == 1){
			$their_loss = $cash_stolen;
		} else {
			$circle_debit = nc_pay($tcrewID,$cash_stolen,$target,$d_posse,$who,$flow);
			$now_owed = $cash_stolen - $circle_debit;
			//*************
			$who = "general";
			$flow = "negative";
			//*************	
			$general_debit = ng_pay($tcrewID,$now_owed,$target,$d_posse,$who,$flow);
			$i_owe = $cash_stolen - $general_debit;
			$their_loss = $i_owe;
		}
	}
	$d_cash = getStat('cash',$tid);
	$net_loss = $d_cash - $their_loss;
	setStat('cash',$tid,$net_loss);
	
	//COOL POINTS EARNED for fighting the good fight! | maybe
	$adjusted = rand(1,$cash_stolen);			
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
	return;
}
function public_hit($user,$target,$bounty){
	$instigator = $user;
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
	if($instigator_strength > $defender_strength){
		//****************
		//instigator wins
		//****************
		
		//Heist Won
		$que = sprintf("SELECT rob_won FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($rob_won) = mysql_fetch_row($result);
						
						$rob_won = $rob_won + 1;
						
		$sql = sprintf("UPDATE h_users SET rob_won = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_won),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
							
		$que = sprintf("SELECT rob_lost FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($target));
						$result = mysql_query($que);
						list($rob_lost) = mysql_fetch_row($result);
						
						$rob_lost = $rob_lost + 1;
						
		$sql = sprintf("UPDATE h_users SET rob_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_lost),
							mysql_real_escape_string($target));
							mysql_query($sql);									

		//IDS
		$tid = id($target);
		$i_userID = id($user);
		//What's the DAMMAGE?
		$robbery_value = $instigator_strength - $defender_strength;	
		medical($robbery_value,$tid,$target);
		$hit = rand(1,$robbery_value);
		//check if cleader and crew have the CASH...
		$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
						mysql_real_escape_string($instigator));
		$result = mysql_query($query);
		list($i_crewID) = mysql_fetch_row($result);
		
		$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
						mysql_real_escape_string($target));
		$result = mysql_query($query);
		list($tcrewID) = mysql_fetch_row($result);
	
		//EXIT POINT		
		$dead = getStat("health",$tid);
		if($dead < 10){			
			$net_worth = crew_worth($tid, $tcrewID);
			if($net_worth <= 0){
				//just get bounty
				$cash_stolen = $bounty;
				i_win($instigator,$target,$cash_stolen,$i_crewID,$tcrewID);
				
				$recipient_message = ucwords($instigator);" just put you in a coma for a bounty of $".$cash_stolen."!";
				//
				crime_reporter($target,1,$recipient_message,"recipient");
				$sender_message = "Target: ".$target." Take: $".$cash_stolen." CP: -".$cool_points_lost;
				//
				crime_reporter($instigator,1,$recipient_message,"sender");
				
				$action = 6;// target now in coma
				$sql = sprintf("DELETE FROM h_hitlist WHERE target = ('%s')",
						mysql_real_escape_string ($target));
					mysql_query($sql);
			} else {
				if($net_worth < $hit){
					$cash_stolen = $net_worth + $bounty;
					i_win($instigator,$target,$cash_stolen,$i_crewID,$tcrewID);
					//no cp
					
					//WINNER NEWS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!			
					$recipient_message = ucwords($instigator);" just robbed you of $".$net_worth."!";
					//
					crime_reporter($target,1,$recipient_message,"recipient");
					$sender_message = "Target: ".$target." Take: $".$cash_stolen." CP: -".$cool_points_lost;
					//
					crime_reporter($instigator,1,$recipient_message,"sender");
					
					$action = 7;// coma i win
				}
			}
		} else {
			// failed hit
			$action = 8;
		}
	} elseif($instigator_strength < $defender_strength) {			
		//defender wins
		//PROFILE UPDATE
		
		//Robbery lost
		$que = sprintf("SELECT rob_lost FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($r) = mysql_fetch_row($result);
						
						$r = $r + 1;
						
		$sql = sprintf("UPDATE h_users SET rob_lost = ('%s') WHERE user = ('%s')",
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
		$cool_points_loss = rand(1,$net_take);
		$math = "subtract";
		coolpoint_adjuster($i_userID,$math,$cool_points_loss);
		medical($cool_points_loss,$i_userID,$instigator);
		//BREAKING NEWS********************************************//BREAKING NEWS
		$time = time();
		
		$recipient_message = ucwords($instigator)." tried to rob you but couldn&acute;t pull it off...";
				//
				crime_reporter($target,1,$recipient_message,"recipient");
				$sender_message = "You failed the robbery attempt on ".ucwords($target)." CP: -".$cool_points_lost;
				//
				crime_reporter($instigator,1,$recipient_message,"recipient");
		
		$action = 4;//they win
	} elseif($instigator_strength < $defender_strength) {
		$action = 3;//tie
	}
		return $action;
}

//echo $anonymous;
//deduct energy
//Retrieve Instigator User ID
$i_userID = id($instigator);

$energy = getStat('ep',$i_userID);

$toll = $energy - 3;	

if($toll < 0){
	echo 1;
} else {
	//hospital run
	if($clinic == 999){
		$query = sprintf("INSERT INTO h_heists(culprit,target,biz_owner) VALUES ('%s','%s','%s')",
					mysql_real_escape_string($user),
					mysql_real_escape_string($target),
					mysql_real_escape_string("hospital"));
				mysql_query($query);
				
		setStat('ep',$i_userID,$toll);	
		$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
			$result = mysql_query($query);
			list($chapter) = mysql_fetch_row($result);
			if($chapter == 8){
				$chapter = $chapter + 1;
				$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($chapter),
					mysql_real_escape_string($user));
				mysql_query($query);
			}
		echo 88;
	} else {
		setStat('ep',$i_userID,$toll);
		//AND Retrieve Instigator Crew ID
		$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
						mysql_real_escape_string ($instigator));
		$result = mysql_query($query);
		list($i_crewID) = mysql_fetch_row($result);
		
		////Identify Target ID
		$user_ID = id($target);
		if(empty($user_ID)){
			//Check to see if target is NPC
			$query = sprintf("SELECT id FROM h_npcs WHERE npc = ('%s')",
							mysql_real_escape_string ($target));
			$result = mysql_query($query);
			list($user_ID) = mysql_fetch_row($result);
			//Check for business security
			$query = sprintf("SELECT club_id FROM h_patrons WHERE user_id = ('%s')",
					mysql_real_escape_string($user_ID));
				$result = mysql_query($query);
			list($club) = mysql_fetch_row($result);
	
			$query = sprintf("SELECT casino_id FROM h_patrons WHERE user_id = ('%s')",
						mysql_real_escape_string($user_ID));
					$result = mysql_query($query);
			list($cas) = mysql_fetch_row($result);
			 //check for tutorial chapter
			 $query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user));
				$result = mysql_query($query);
			list($chapter) = mysql_fetch_row($result);
			if($chapter == 16){
				//club anwar has security
				$club = 157;
			}
			if(!empty($club)){
				//find owner see security
				$query = sprintf("SELECT user_id FROM h_user_assets WHERE id = ('%s')",
					mysql_real_escape_string($club));
				$result = mysql_query($query);
				list($owner_id) = mysql_fetch_row($result);
				
				$query = sprintf("SELECT COUNT(id) FROM h_user_arsenal WHERE user_id = ('%s') AND type = ('muscle')",
					mysql_real_escape_string($owner_id));
				$result = mysql_query($query);
				list($count) = mysql_fetch_row($result);
				//check for tutorial chapter
				 $query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
					$result = mysql_query($query);
				list($chapter) = mysql_fetch_row($result);
				if($chapter == 16){
					
					$chapter = $chapter + 1;
					
					$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($chapter),
						mysql_real_escape_string($user));
					mysql_query($query);
					
					//club anwar has security
					$count = 1;
				}
				if($count > 0){
					$owner = user($owner_id);
					$query = sprintf("INSERT INTO h_heists(culprit,target,biz_owner) VALUES ('%s','%s','%s')",
						mysql_real_escape_string($user),
						mysql_real_escape_string($target),
						mysql_real_escape_string($owner));
					mysql_query($query);
					echo 88;
				} else {
					$action = fight_npc($user,$target);
					echo $action;
				}
			} elseif(!empty($cas)){
				//find owner see security
				$query = sprintf("SELECT user_id FROM h_user_assets WHERE id = ('%s')",
					mysql_real_escape_string($cas));
				$result = mysql_query($query);
				list($owner_id) = mysql_fetch_row($result);
				
				$query = sprintf("SELECT COUNT(id) FROM h_user_arsenal WHERE user_id = ('%s') AND type = ('muscle')",
					mysql_real_escape_string($owner_id));
				$result = mysql_query($query);
				list($count) = mysql_fetch_row($result);
				if($count > 0){
					$owner = user($owner_id);
					$query = sprintf("INSERT INTO h_heists(culprit,target,biz_owner) VALUES ('%s','%s','%s')",
						mysql_real_escape_string($user),
						mysql_real_escape_string($target),
						mysql_real_escape_string($owner));
					mysql_query($query);
					echo 88;
				} else {
					$action = fight_npc($user,$target);
					echo $action;
				}
			} else {
				//call NPC function
				$action = fight_npc($user,$target);
				echo $action;
			}		
		} else {
			//Check for business security
			$query = sprintf("SELECT club_id FROM h_patrons WHERE user_id = ('%s')",
					mysql_real_escape_string($user_ID));
				$result = mysql_query($query);
			list($club) = mysql_fetch_row($result);
	
			$query = sprintf("SELECT casino_id FROM h_patrons WHERE user_id = ('%s')",
						mysql_real_escape_string($user_ID));
					$result = mysql_query($query);
			list($cas) = mysql_fetch_row($result);
			 
			if(!empty($club)){
				//find owner see security
				$query = sprintf("SELECT user_id FROM h_user_assets WHERE id = ('%s')",
					mysql_real_escape_string($club));
				$result = mysql_query($query);
				list($owner_id) = mysql_fetch_row($result);
				
				$query = sprintf("SELECT COUNT(id) FROM h_user_arsenal WHERE user_id = ('%s') AND type = ('muscle')",
					mysql_real_escape_string($owner_id));
				$result = mysql_query($query);
				list($count) = mysql_fetch_row($result);
				if($count > 0){
					$owner = user($owner_id);
					$query = sprintf("INSERT INTO h_heists(culprit,target,biz_owner) VALUES ('%s','%s','%s')",
						mysql_real_escape_string($user),
						mysql_real_escape_string($target),
						mysql_real_escape_string($owner));
					mysql_query($query);
					echo 88;
				} else {
					$action = fight_ring($user,$target);
					echo $action;
				}
			} elseif(!empty($cas)){
				//find owner see security
				$query = sprintf("SELECT user_id FROM h_user_assets WHERE id = ('%s')",
					mysql_real_escape_string($cas));
				$result = mysql_query($query);
				list($owner_id) = mysql_fetch_row($result);
				
				$query = sprintf("SELECT COUNT(id) FROM h_user_arsenal WHERE user_id = ('%s') AND type = ('muscle')",
					mysql_real_escape_string($owner_id));
				$result = mysql_query($query);
				list($count) = mysql_fetch_row($result);
				if($count > 0){
					$owner = user($owner_id);
					$query = sprintf("INSERT INTO h_heists(culprit,target,biz_owner) VALUES ('%s','%s','%s')",
						mysql_real_escape_string($user),
						mysql_real_escape_string($target),
						mysql_real_escape_string($owner));
					mysql_query($query);
					echo 88;
				} else {
					$action = fight_ring($user,$target);
					echo $action;
				}
			} else {
				//call fight function
				//check if this is private or public hit
				if(!empty($public)) {
					//this is a public hit
					$sql = sprintf("SELECT bounty FROM h_hitlist WHERE upper(target) = UPPER('%s')",
										mysql_real_escape_string($target));
					$result = mysql_query($query);
					list($bounty) = mysql_fetch_row($result);
					
					$action = public_hit($user,$target,$bounty);
					echo $action;
				}  else {
					$action = fight_ring($user,$target);
					echo $action;
					
				}
			}		
		}
	}
}
?>