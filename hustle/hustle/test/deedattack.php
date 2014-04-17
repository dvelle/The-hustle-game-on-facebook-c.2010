<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
$deed_id = $_POST['deed_id'];
//$user = "jermongreen";
//$_POST['option'] = "Mom's Car";
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
$user_ID = id($user);

$cash = getStat('cash',$user_ID);

$query = sprintf("SELECT maint_fee FROM h_properties WHERE id = ('%s')",
								mysql_real_escape_string($deed_id));
$result = mysql_query($query);
list($fee) = mysql_fetch_row($result);

$query = sprintf("SELECT owner FROM h_properties WHERE id = ('%s')",
								mysql_real_escape_string($deed_id));
$result = mysql_query($query);
list($owner) = mysql_fetch_row($result);

$query = sprintf("SELECT deed FROM h_properties WHERE id = ('%s')",
								mysql_real_escape_string($deed_id));
$result = mysql_query($query);
list($deed) = mysql_fetch_row($result);

$que = sprintf("SELECT game_name FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($user));
				$result = mysql_query($que);
list($gamename) = mysql_fetch_row($result);

$que = sprintf("SELECT game_name FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($owner));
				$result = mysql_query($que);
list($owner_gname) = mysql_fetch_row($result);

$owner_id = id($owner);

if($_POST['accept_x']){
	if($cash < $fee){
		echo 1;
	} else {
		$debit = $cash - $fee;
		setStat('cash',$user_ID,$debit);
		//add to owner
		$o_cash = getStat('cash',$owner_id);
		$dep = $o_cash + $fee;
		setStat('cash',$owner_id,$dep);
		echo 2;
	}
} elseif($_POST['attack_x']){
	$ins_action = "attack";
	//Identify Defender crew settings
	$query = sprintf("SELECT * FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string ($owner));
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
	$instigator_strength = battle_prep($user,$ins_action);
	$defender_strength = battle_prep($owner,$def_action);
	
	if($instigator_strength > $defender_strength){
		//take land
		$query = sprintf("UPDATE h_properties SET owner = '%s' WHERE id = ('%s')",
			mysql_real_escape_string($user),
			mysql_real_escape_string($deed_id));
		$result = mysql_query($query);
		
		$que = sprintf("SELECT attacks FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($user));
						$result = mysql_query($que);
						list($rob_won) = mysql_fetch_row($result);
						
						$rob_won = $rob_won + 1;
						
		$sql = sprintf("UPDATE h_users SET attacks = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_won),
							mysql_real_escape_string($user));
							mysql_query($sql);	
		//let old owner know		
		$loss = $instigator_strength - $defender_strength;
		medical($loss,$owner_id,$owner);
		$cash_stolen = rand(1,$loss);
		coolpoint_adjuster($owner_id,"subtract",$cash_stolen);
		//check if cleader and crew have the CASH...
		$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
						mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($i_crewID) = mysql_fetch_row($result);
		
		$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
						mysql_real_escape_string($owner));
		$result = mysql_query($query);
		list($tcrewID) = mysql_fetch_row($result);
	
		$net_worth = crew_worth($owner_id, $tcrewID);
		//
		if($cash_stolen > $net_worth){
			$cash_stolen = $net_worth;
			$extra = " Additionally, player is now financially ruined...";
		}
		
		$posse = how_deep($user);
		
		if($posse == 1){
			$mine = $cash_stolen;
		} else {
			//*************
			$who = "circle";
			$flow = "positive";
			//*************
			$c_take = pc_pay($i_crewID,$cash_stolen,$user,$posse,$who,$flow);
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
				
		$i_cash = getStat('cash',$user_ID);
		$net_take = $i_cash + $mine;
		setStat('cash',$user_ID,$net_take);
		//
		//cool points lost			
		$cool_points_lost = rand(1,$cash_stolen);
		$clost = $cool_points_lost;
		medical($cool_points_lost,$user_ID,$user);
		coolpoint_adjuster($user_ID,"add",$cool_points_lost);
		//cash and health
		$recipient_message = ucwords($gamename)." just robbed you, and ran you out of your hood ".ucwords($deed);
		//
		crime_reporter($owner,1,$recipient_message,"recipient");
		echo 3;
	} elseif($instigator_strength < $defender_strength){
		//take money
		$loss = $defender_strength - $instigator_strength;
		$cool_points_lost = rand(1,$loss);
		medical($cool_points_lost,$user_ID,$user);
		coolpoint_adjuster($user_ID,"subtract",$cool_points_lost);
		
		$cool_points_lost2 = rand(1,$loss);
		coolpoint_adjuster($owner_ID,"add",$cool_points_lost2);
		
		$mine = rand(1,$cool_points_lost2);
		$net_worth = crew_worth($user_ID, $i_crewID);
		//
		if($mine > $net_worth){
			$mine = $net_worth;
			$extra = " Additionally, player is now financially ruined...";
		}
		
		$i_cash = getStat('cash',$user_ID);
		$net_loss = $i_cash - $mine;
		setStat('cash',$user_ID,$net_loss);
		
		//cash and health
		
		$cash = getStat('cash',$owner_id);
		$net_take = $cash + $mine;
		setStat('cash',$user_ID,$net_take);
		$recipient_message = ucwords($gamename)." just tried run you out of your hood ".ucwords($deed);
		//
		crime_reporter($owner,1,$recipient_message,"recipient");
		echo 4;
		
	} elseif($instigator_strength == $defender_strength){
		//let pass
		echo 2;
	}
}
?>

 