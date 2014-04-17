<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
//$user = "jermongreen";
$i_userID = id($user);

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

$sql = sprintf("SELECT npc FROM h_npc_fights WHERE user_id = ('%s')",
							mysql_real_escape_string($i_userID));
							$results = mysql_query($sql);
list($target) = mysql_fetch_row($results);	

$query = sprintf("SELECT strength FROM h_npcs WHERE npc = ('%s')",
						mysql_real_escape_string ($target));
$result = mysql_query($query);
list($npc_power) = mysql_fetch_row($result);

$instigator_strength = battle_prep($instigator,$ins_action);

if($instigator_strength > $npc_power){
	//give some cash
	$winnings = $instigator_strength - $npc_power;
	$hand = getStat("cash",i_userID);
	$deposit = $hand + $winnings;
	setStat("cash",i_userID,$deposit);
	//check to see if NPC dies,\
	//delete from patron list...and notify npc death
	$sql = sprintf("SELECT COUNT(id) FROM h_patrons WHERE club_id = ('%s') AND user_id = ('%s')",
			mysql_real_escape_string($biz_id),
			mysql_real_escape_string($user_ID));
		$result = mysql_query($sql);
	list($count) = mysql_fetch_row($result);
	if(!empty($count)){
	$sql = sprintf("DELETE FROM h_patrons WHERE user_id = ('%s') AND club_id = ('%s')",
		mysql_real_escape_string ($user_ID),
		mysql_real_escape_string ($casino_id));
	mysql_query($sql);
	} else {
	$sql = sprintf("DELETE FROM h_patrons WHERE user_id = ('%s') AND casino_id = ('%s')",
		mysql_real_escape_string ($user_ID),
		mysql_real_escape_string ($casino_id));
	mysql_query($sql);
	}
	$query = sprintf("SELECT mission_id FROM h_mission_central WHERE UPPER(user) = UPPER('%s') AND done = '0'",
		mysql_real_escape_string($user));
		$result = mysql_query($query);
	list($mission) = mysql_fetch_row($result);
	
	$query = sprintf("UPDATE h_mission_central SET done = ('%s') WHERE UPPER(user) = UPPER('%s') AND mission_id = ('%s')",
			1,
			mysql_real_escape_string($user),			
			mysql_real_escape_string($mission));
		mysql_query($query);
} elseif($instigator_strength <= $npc_power){
	//take cash & health, and energy
	$bias = $npc_power + 1;
	$var = $bias - $instigator_strength;
	$dammage = rand(1,$var);
	$heart = getStat("health",i_userID);
	$reset = $heart - $dammage;
	setStat("health",i_userID,$reset);
	//
	$loss = $var - $dammage;
	$hand = getStat("cash",i_userID);
	$debit = $hand - $loss;
	setStat("cash",i_userID,$debit);
	//				
}


?>

 