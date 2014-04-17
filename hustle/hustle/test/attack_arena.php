<?
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
$instigator = $_POST['instigator'];

$target = $_POST['target'];

//$user = "jermongreen";
//$instigator = $user;
//functions
function arcade_news($type,$winner,$loser,$cash_stolen,$cool){
	$query = sprintf("INSERT INTO arcade_news(type,winner,loser,score,gameid) VALUES ('%s','%s','%s','%s','%s')",
		mysql_real_escape_string($type),
		mysql_real_escape_string($winner),
		mysql_real_escape_string($loser),
		mysql_real_escape_string($cash_stolen),
		mysql_real_escape_string($cool));
	mysql_query($query);
	return;
}
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

$i_userID = id($instigator);
$iGamer = gamerwho($instigator);
$TGamer = gamerwho($target);
$energy = getStat('ep',$i_userID);

$toll = $energy - 3;	

if($toll < 0){
	echo 1;
} else {
	setStat('ep',$i_userID,$toll);
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
		$que = sprintf("SELECT attacks FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($rob_won) = mysql_fetch_row($result);
						
						$rob_won = $rob_won + 1;
						
		$sql = sprintf("UPDATE h_users SET attacks = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_won),
							mysql_real_escape_string($instigator));
							mysql_query($sql);		

		//IDS
		$tid = id($target);
		$i_userID = id($user);
		//What's the DAMMAGE?
		$robbery_value = $instigator_strength - $defender_strength;	
		medical($robbery_value,$tid,$target);
		$cash_stolen = rand(1,$robbery_value);
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
		//
		if($cash_stolen > $net_worth){
			$cash_stolen = $net_worth;
			$extra = " Additionally, player is now financially ruined...";
		}
		
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
		$recipient_message = ucwords($iGamer);" just robbed you of $".$cash_stolen."!";
		//
		crime_reporter($target,1,$recipient_message,"recipient");
		$sender_message = "Target: ".$TGamer." Take: $".$cash_stolen." CP: -".$cool_points_lost;
		//
		crime_reporter($instigator,1,$recipient_message,"sender");
		
		arcade_news(1,$instigator,$target,$cash_stolen,$cool_points_lost);
		
		$action = 5;// i win
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
		
		$recipient_message = ucwords($iGamer)." tried to attack you but couldn&acute;t pull it off...";
				//
				crime_reporter($target,1,$recipient_message,"recipient");
				$sender_message = ucwords($TGamer)."just beat you, costing you CP: -".$cool_points_lost;
				//
				crime_reporter($instigator,1,$recipient_message,"recipient");
				
		arcade_news(1,$target,$instigator,0,$cool_points_lost);
		
		$action = 4;//they win
	} elseif($instigator_strength == $defender_strength) {
		arcade_news(555,$instigator,$target,0,0);
		$action = 3;//tie
	}
	echo $instigator;
}
?>