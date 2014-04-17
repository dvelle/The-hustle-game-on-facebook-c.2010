<?php
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

function getStat($statName,$userID) {
	$query = sprintf("SELECT value FROM h_user_stats WHERE stat_id = (SELECT id FROM h_stats WHERE display_name = '%s' OR short_name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;		
}
function setStat($statName,$userID,$value) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	createIfNotExistsval($statName,$userID);
	$query = sprintf("UPDATE h_user_stats SET value = '%s' WHERE stat_id = (SELECT id FROM h_stats WHERE display_name = '%s' OR short_name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($value),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
}
function createIfNotExistsval($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT count(value) FROM h_user_stats WHERE stat_id = (SELECT id FROM h_stats WHERE display_name = '%s' OR short_name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if($count == 0) {
		// the stat doesn't exist; insert it into the database
		$query = sprintf("INSERT INTO h_user_stats(stat_id,user_id,value) VALUES ((SELECT id FROM h_stats WHERE display_name = '%s' OR short_name = '%s'),'%s','%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID),
		'0');
		mysql_query($query);
	}	
}
//arsenal
function getArsenal($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT quantity FROM h_user_arsenal WHERE arsenal_id = (SELECT id FROM h_arsenal WHERE name = '%s' OR short_name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;		
}
function setArsenal($statName,$userID,$quantity) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	createIfNotExistsA($statName,$userID);
	$query = sprintf("UPDATE h_user_arsenal SET quantity = '%s' WHERE arsenal_id = (SELECT id FROM h_arsenal WHERE name = '%s' OR short_name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($quantity),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	return $result;
} 
function createIfNotExistsA($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT count(quantity) FROM h_user_arsenal WHERE arsenal_id = (SELECT id FROM h_arsenal WHERE name = '%s' OR short_name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if($count == 0) {
		// the stat doesn't exist; insert it into the database
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_arsenal WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID),
		'0');
		mysql_query($query);
	}	
}
//muscle
function getMuscle($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT quantity FROM h_user_arsenal WHERE arsenal_id = (SELECT id FROM h_muscle WHERE name = '%s' OR short_name = '%s') AND user_id = ('%s') AND type = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID),
		"muscle");
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;		
}
function getHealth($arsenal_id) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT health FROM h_muscle WHERE id = '%s' ",
		mysql_real_escape_string($arsenal_id));
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;		
}
function setMuscle($statName,$userID,$quantity) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	
	$query = sprintf("SELECT health FROM h_muscle WHERE name = '%s' OR short_name = '%s'",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName));
	$result = mysql_query($query);
	list($health) = mysql_fetch_row($result);
	
	createIfNotExistsZ($statName,$userID,$health);
	$query = sprintf("UPDATE h_user_arsenal SET quantity = '%s', type = 'muscle', rem_health = ('%s') WHERE arsenal_id = (SELECT id FROM h_muscle WHERE name = '%s' OR short_name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($quantity),
		mysql_real_escape_string($health),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	
	return $result;
} 
function createIfNotExistsZ($statName,$userID,$health) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT count(quantity) FROM h_user_arsenal WHERE arsenal_id = (SELECT id FROM h_muscle WHERE name = '%s' OR short_name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if($count == 0) {
		// the stat doesn't exist; insert it into the database
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity,type,rem_health) VALUES ((SELECT id FROM h_muscle WHERE name = '%s' OR short_name = '%s'),'%s','%s','%s','%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID),
		'0',
		"muscle",
		$health);
		mysql_query($query);
	}	
}
function getShield($userid) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT shield FROM h_users WHERE id = '%s' ",
		mysql_real_escape_string($userid));
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;		
}
function setShield($userID,$quantity) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	$query = sprintf("UPDATE h_users SET shield = '%s' WHERE id = '%s'",
		mysql_real_escape_string($quantity),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	return;
} 
function piss_test($user_name){
	$userID = id(user_name);
	$roids = getGoods("roids",$userID);
	
	if($roids > 0){
	//count roids
	$shot = rand(1,$roids);
	$roids = $roids - $shot;
	setGoods("roids",$userID,$roids);
	$now = getShield($userID);
	$var = rand(0,10);
	$pain = $shot * $var;
	$ouch = $now - $pain;
	if($ouch == 0){
		$weaking = "weakening them by $pain!";
	} else {
		$weaking = "strengthing them by $shot, but the 'roids hurt them by $pain!";
	}
	setShield($userID,$ouch);
	$recipient_message = "Your security force just popped ".$shot." pills before going into the fight".$weaking;
						//
	crime_reporter($user_name,1,$recipient_message,"recipient");
	return $shot;
}
}
function kill_off($uid, $dammage){
	$query = sprintf("SELECT arsenal_id, quantity, rem_health FROM h_user_arsenal WHERE user_id = ('%s') AND type = 'muscle'",
				 $uid);
	$result = mysql_query($query);
	$tot_power = array();
	$att = array();
	$id = array();
	$total = array();
	while($arsenal_ar = mysql_fetch_assoc($result)){
		$arsenal = $arsenal_ar["arsenal_id"];
		$arsenal_tot = $arsenal_ar["quantity"];
		$arsenal_val = $arsenal_ar["rem_health"];
		if(isset($arsenal_val)){				 
			array_push($id, $arsenal);
			array_push($att, $arsenal_val);
			array_push($total, $arsenal_tot);
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
		$pain = $a_value - $dammage;
		if($pain > 0){
			//individual death
			$hurt = round($dammage/$value);
			
			$a_id = array_search($value, $id);
			$que = sprintf("SELECT name FROM h_muscle WHERE id = ('%s')",
								mysql_real_escape_string($a_id));
				$result = mysql_query($que);
			list($name) = mysql_fetch_row($result);
			
			if($hurt == 1){
				$hired = getMuscle($name,$uid);
				$jump = $hired - 1;
				setMuscle($name,$uid,$jump);
				$pro = getShield($uid);
				$pro = $pro - $value;
				setShield($uid,$pro);
				$recipient_message = "You just lost 1 of your ".ucwords($name)."'s as they defended you.";
							//
				hustle_reporter($user_name,1,$recipient_message,"recipient");
				
				$recipient_message = "You just killed 1 of ".ucwords($user_name)." ".ucwords($name)."'s!";
							//
				hustle_reporter($instigator,1,$recipient_message,"recipient");
			} else {
				//how many to delete and how much energy to reduce				
				$spear = $dammage/$value;
				$killed = round($spear);
				$sick = abs($spear - $killed);
				
				if($sick > 0){
					//reduce energy
					$scratch = $value - $sick;
					if($scratch <= 0){
						$hired = getMuscle($name,$uid);
						$jump = $hired - $killed;
						setMuscle($name,$uid,$jump);
						$pro = getShield($uid);
						$pro = $pro - $value;
						setShield($uid,$pro);
						$recipient_message = "You just lost $killed of your ".ucwords($name)."'s as they defended you.";
								//
						hustle_reporter($user_name,1,$recipient_message,"recipient");
						//
						$recipient_message = "You just killed $killed of ".ucwords($user_name)." ".ucwords($name)."'s!";
									//
						hustle_reporter($instigator,1,$recipient_message,"recipient");
					} else {
						$query = sprintf("UPDATE h_user_arsenal SET rem_health = '%s' WHERE arsenal_id = ('%s') AND user_id = ('%s')",
							mysql_real_escape_string($scratch),
							mysql_real_escape_string($a_id),
							mysql_real_escape_string($userID));
						mysql_query($query);
						$pro = getShield($uid);
						$pro = $pro - $sratch;
						setShield($uid,$pro);
					}
				} else {				
					//delete 1 of each til dammage zero
					$hired = getMuscle($name,$uid);
					$jump = $hired - $killed;
					setMuscle($name,$uid,$jump);
					$pro = getShield($uid);
					$pro = $pro - $value;
					setShield($uid,$pro);
					
					$recipient_message = "You just lost $killed of your ".ucwords($name)."'s as they defended you.";
							//
					hustle_reporter($user_name,1,$recipient_message,"recipient");
					//
					$recipient_message = "You just killed $killed of ".ucwords($user_name)." ".ucwords($name)."'s!";
								//
					hustle_reporter($instigator,1,$recipient_message,"recipient");
				}
			break;
			}
		} else {
			//remove security
			$a_id = array_search($value, $id);
			$sql = sprintf("DELETE FROM h_user_arsenal WHERE type = 'muscle' AND user_id = ('%s') AND arsenal_id = ('%s')",
						mysql_real_escape_string ($userID),
						mysql_real_escape_string ($a_id));
					mysql_query($sql);
			setShield($uid,0);		
			$recipient_message = "You just lost <b>ALL</b> of your ".ucwords($name)."'s as they defended you.";
						//
			hustle_reporter($user_name,1,$recipient_message,"recipient");
			//
			$recipient_message = "You just killed <b>ALL</b> of ".ucwords($user_name)." ".ucwords($name)."'s!";
						//
			hustle_reporter($instigator,1,$recipient_message,"recipient");
		}
		unset($att[$key]);	
		$i++;
	}
	return $pain;
}

function medical($dammage,$userID,$user_name){
	//What is total health of user muscle
	$user_health = getStat("health",$userID);
	
	$sql = sprintf("SELECT shield FROM h_users WHERE id = ('%s')",
				mysql_real_escape_string ($userID));
	$results = mysql_query($sql);
	list($shield) = mysql_fetch_row($results);
	if($shield > 0){
		$pain = kill_off($userID, $dammage);
		$reduce = $user_health - $pain;
		if($reduce <= 0){
			$reduce = 0;
			//check for adrenalin shot
			$count = getAEggs("adrenaline shot",$userID);
			if($count > 0){
				$count = $count - 1;
				setAEggs("adrenaline shot",$userID,$count);
				setStat("health",$userID,100);
				$max = getStat("max_ep",$userID);
				setStat("ep",$userID,$max);
				$recipient_message = "Your <b>Adrenaline Shot/b> saved you!";
							//
				hustle_reporter($user_name,1,$recipient_message,"recipient");
				//
				$recipient_message = "You nearly left ".ucwords($user_name)." in a <b>COMA</b>!";
							//
				hustle_reporter($instigator,1,$recipient_message,"recipient");
			}else{
				//add to Coma Ward
				$query = sprintf("SELECT COUNT(id) FROM h_patients WHERE user_id = ('%s')",
					mysql_real_escape_string($userID));
				$resukt = mysql_query($query);
				list($bed) = mysql_fetch_row($resukt);
				if(empty($bed)){
					$query = sprintf("INSERT INTO h_patients(user_id) VALUES ('%s')",
						mysql_real_escape_string($userID));
					mysql_query($query);
				}
				
				$recipient_message = "You are now in a <b>COMA</b> after your entire <b>Security Force</b> was wiped out!";
						//
				hustle_reporter($user_name,1,$recipient_message,"recipient");
				//
				$recipient_message = "You just left ".ucwords($user_name)." in a <b>COMA</b> after killing everyone their Security Team!";
							//
				hustle_reporter($instigator,1,$recipient_message,"recipient");
			}
		}
		setStat("health",$userID,$reduce);
	} else	{
		//no shield
		if($dammage >= $user_health){
			//check for adrenalin shot
			$count = getAEggs("adrenaline shot",$userID);
			if($count > 0){
				$count = $count - 1;
				setAEggs("adrenaline shot",$userID,$count);
				setStat("health",$userID,100);
				$max = getStat("max_ep",$userID);
				setStat("ep",$userID,$max);
				$recipient_message = "Your <b>Adrenaline Shot/b> saved you!";
							//
				hustle_reporter($user_name,1,$recipient_message,"recipient");
				//
				$recipient_message = "You nearly left ".ucwords($user_name)." in a <b>COMA</b>!";
							//
				hustle_reporter($instigator,1,$recipient_message,"recipient");
			}else{
				//
				$query = sprintf("SELECT COUNT(id) FROM h_patients WHERE user_id = ('%s')",
					mysql_real_escape_string($userID));
				$resukt = mysql_query($query);
				list($bed) = mysql_fetch_row($resukt);
				if(empty($bed)){
					$query = sprintf("INSERT INTO h_patients(user_id) VALUES ('%s')",
						mysql_real_escape_string($userID));
					mysql_query($query);
				}				
				setStat("health",$userID,0);
				setStat("ep",$userID,1);
				//leave user in coma state
				$recipient_message = "You are now in a <b>COMA</b>!";
							//
				hustle_reporter($user_name,1,$recipient_message,"recipient");
				//
				$recipient_message = "You just left ".ucwords($user_name)." in a <b>COMA</b>!";
							//
				hustle_reporter($instigator,1,$recipient_message,"recipient");
			}
		} elseif($dammage < $user_health){
			$reduce = $user_health - $dammage;
			setStat("health",$userID,$reduce);
			//$energy = getStat("ep",$userID);
			//if($energy >= 5){
				//$tired = $energy - 4;
				//setStat("ep",$userID,$tired);
			//} elseif($energy > 0) {
				//$tired = $energy;
				//setStat("ep",$userID,1);
			//}
		}	
	}
return;
}	
//Assets
function getAssets($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT `quantity` FROM `h_user_assets` WHERE `asset_id` = (SELECT `id` FROM `h_assets` WHERE `name` = '%s' OR `short_name` = '%s') AND `user_id` = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;		
}
function setAssets($statName,$userID,$quantity) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	createIfNotExistsB($statName,$userID);
	$query = sprintf("UPDATE h_user_assets SET quantity = '%s' WHERE asset_id = (SELECT id FROM h_assets WHERE name = '%s' OR short_name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($quantity),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	return $result;
} 
function createIfNotExistsB($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT count(quantity) FROM h_user_assets WHERE asset_id = (SELECT id FROM h_assets WHERE name = '%s' OR short_name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if($count == 0) {
		// the stat doesn't exist; insert it into the database
		$query = sprintf("INSERT INTO h_user_assets(asset_id,user_id,quantity) VALUES ((SELECT id FROM h_assets WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID),
		'0');
		mysql_query($query);
	}	
}
//ranks
function getCRank($user) {
$query = sprintf("SELECT rank FROM h_top_crew WHERE UPPER(user) = ('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($rank) = mysql_fetch_row($result);
	return $rank;		
}
function setID($userID){
		$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",mysql_real_escape_string($_SESSION['user']));
		$result = mysql_query($query);
		list($userID) = mysql_fetch_row($result);
		return $userID;
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
		if($asset == 50 || $asset == 51 ||  $asset == 52 || $asset == 53 || $asset == 400 || $asset == 401){
			//
		} else {
			$asset_tot = $assets_ar["quantity"];
			$asset_val = asset_atts($asset);
			if(isset($asset_val)){				 
				array_push($id, $asset);
				array_push($att, $asset_val);
				array_push($total, $asset_tot);
			}
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
	if($amount == 1){
	$scale = -1;
	}
	return $scale;
}

// MUSCLE ATTRIBUTES //
function muscle_atts($muscle, $state){
	if($state == "attack"){
		$query = sprintf("SELECT attack FROM h_muscle WHERE id = ('%s')",
						 $muscle);
		$result = mysql_query($query);
		list($stat) = mysql_fetch_row($result);
		return $stat;
	} elseif($state == "defend"){
		$query = sprintf("SELECT defense FROM h_muscle WHERE id = ('%s')",
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
		if(empty($stat)){
			$query = sprintf("SELECT attack FROM h_special_items WHERE id = ('%s') AND type = 'weapon'",
						 $weapon);
			$result = mysql_query($query);
			list($stat) = mysql_fetch_row($result);
		}
		return $stat;
	} elseif($state == "defend"){
		$query = sprintf("SELECT defense FROM h_arsenal WHERE id = ('%s') AND type = 'weapon'",
						 $weapon);
		$result = mysql_query($query);
		list($stat) = mysql_fetch_row($result);
		if(empty($stat)){
			$query = sprintf("SELECT defense FROM h_special_items WHERE id = ('%s') AND type = 'weapon'",
						 $weapon);
			$result = mysql_query($query);
			list($stat) = mysql_fetch_row($result);
		}
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
// Total weapons available<br>
function raw_power($userid,$state,$posse){ 
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
		$total_power = $muscle_power + $weapon_power;
		return $total_power;
		
	} else {
		
		$muscle_power = 0;
		$total_power = $muscle_power + $weapon_power;
		return $total_power;
	}
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
	
	if($posse <= 0){
		$posse = 1;
	}
	return $posse;
}


//Hourly worth
function hourly($crewID){
	$worth = array();
	$time = time();
	$hour = 3600;
	$lst_hour = $time - $hour;
	$query = sprintf("SELECT * FROM h_crew_member WHERE crew_id = ('%s')AND time < ('%s')",
						mysql_real_escape_string ($crewID),
						mysql_real_escape_string ($lst_hour));
	$result = mysql_query($query);
	
	while($member_ar = mysql_fetch_assoc($result)){
		$name = $member_ar["user"];
		//what is total cash on hand for member
		$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string ($name));
		$result = mysql_query($query);
		list($memberid) = mysql_fetch_row($result);
		//id'd
		$wallet = getStat("cash",$memberid);
		array_push($worth,$wallet);		
	}
	$crew = array_sum($worth);
	$piggy_bank = getStat("cash",$leaderid);
	//
	$net_worth = $crew - $piggy_bank;
	if($net_worth <= 0){
		$net_worth = $piggy_bank;
	} else {
		$net_worth = $crew + $piggy_bank;
	}
	return $networth_hr;
}

//GET bonus history
function getBonus($user_name,$crewID) {
	$query = sprintf("SELECT bonus_pay FROM h_crew_member WHERE user = ('%s') AND crew_id = ('%s')",
		mysql_real_escape_string($user_name),
		mysql_real_escape_string($crewID));
	$result = mysql_query($query);
	list($bonus) = mysql_fetch_row($result);
	return $bonus;		
}
//SET crew bonus history
function setBonus($crewID,$mem_name,$record) {
$query = sprintf("UPDATE h_crew_member SET bonus_pay = ('%s') WHERE crew_id = ('%s') AND user = ('%s')",
						mysql_real_escape_string ($record),
						mysql_real_escape_string ($crewid),
						mysql_real_escape_string ($mem_name));
					$result = mysql_query($query);
					return;
}

//GET general earnings history
function getGE($user_name,$crewID) {
	$query = sprintf("SELECT crew_earnings FROM h_crew_member WHERE user = ('%s') AND crew_id = ('%s')",
		mysql_real_escape_string($user_name),
		mysql_real_escape_string($crewID));
	$result = mysql_query($query);
	list($ge) = mysql_fetch_row($result);
	return $ge;		
}
//SET general earnings history
function setGE($crewid,$mem_name,$record){
	$query = sprintf("UPDATE h_crew_member SET crew_earnings = ('%s') WHERE crew_id = ('%s') AND user = ('%s')",
						mysql_real_escape_string ($record),
						mysql_real_escape_string ($crewid),
						mysql_real_escape_string ($mem_name));
					$result = mysql_query($query);
					return;
}
//GET general loss history
function getGL($user_name,$crewID) {
	$query = sprintf("SELECT crew_losses FROM h_crew_member WHERE user = ('%s') AND crew_id = ('%s')",
		mysql_real_escape_string($user_name),
		mysql_real_escape_string($crewID));
	$result = mysql_query($query);
	list($ge) = mysql_fetch_row($result);
	return $ge;		
}
//SET general loss history
function setGL($crewid,$mem_name,$record){
	$query = sprintf("UPDATE h_crew_member SET crew_losses = ('%s') WHERE crew_id = ('%s') AND user = ('%s')",
						mysql_real_escape_string ($record),
						mysql_real_escape_string ($crewid),
						mysql_real_escape_string ($mem_name));
					$result = mysql_query($query);
					return;
}
//GET CREW DEBIT HISTORY
function getDebit($user_name,$crewID) {
	$query = sprintf("SELECT bonus_bank FROM h_crew_member WHERE user = ('%s') AND crew_id = ('%s')",
		mysql_real_escape_string($user_name),
		mysql_real_escape_string($crewID));
	$result = mysql_query($query);
	list($bank) = mysql_fetch_row($result);
	return $bank;		
}
//Set debit history
function setDebit($record,$crewid,$mem_name){
						$query = sprintf("UPDATE h_crew_member SET bonus_bank = ('%s') WHERE crew_id = ('%s') AND user = ('%s')",
						mysql_real_escape_string ($record),
						mysql_real_escape_string ($crewid),
						mysql_real_escape_string ($mem_name));
					$result = mysql_query($query);
					return;
}
//Crew combined networth test
function crew_worth($leaderid,$crewid){
	$worth = array();
	$query = sprintf("SELECT * FROM h_crew_member WHERE crew_id = ('%s')",
						mysql_real_escape_string ($crewid));
	$result = mysql_query($query);
	
	while($member_ar = mysql_fetch_assoc($result)){
		$name = $member_ar["user"];
		//what is total cash on hand for member
		$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string ($name));
		$result = mysql_query($query);
		list($memberid) = mysql_fetch_row($result);
		//id'd
		$wallet = getStat("cash",$memberid);
		array_push($worth,$wallet);		
	}
	$crew = array_sum($worth);
	$piggy_bank = getStat("cash",$leaderid);
	//
	$total = $crew - $piggy_bank;
	if($total == 0){
		$total = $piggy_bank;
	} else {
		$total = $crew + $piggy_bank;
	}
	return $total;
}

//PAYROLL center
//postive circle
function pc_pay($crewid,$cash_stolen,$user,$posse,$who,$flow){
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
			if($split_test == 0){
				$posse = $posse - 1;
			} else {
				$sql = sprintf("SELECT * FROM h_crew_member WHERE crew_id = ('%s') AND party = ('%s') AND user != ('%s') ORDER BY crew_losses", $crewid,1, $user);
				$re = mysql_query($sql);
				// Update Member Private Account
				while($l_member_ar = mysql_fetch_assoc($re)){
					$mem_name = $l_member_ar["user"];
					
					$query = sprintf("SELECT * FROM h_users WHERE UPPER(user) = UPPER('%s')",
								mysql_real_escape_string ($mem_name));
					$result = mysql_query($query);
					$new_ar = mysql_fetch_assoc($result);
					$memID = $new_ar["id"];
										
					$member_cash = getStat('cash',$memID);
					$deposit = $member_cash + $split_test;
					setStat('cash',$memID,$deposit);	
					// Update Member Crew Bonus Record
					//Get current member bonus history
					$member_bonus = getBonus($mem_name,$crewid);
					//
					$record = $member_bonus + $split_test;
					//
					setBonus($crewid,$mem_name,$record);
				}
					
				//notify member
					$recipient_message = $user." has just earned you $".$deposit."!";
				//
				fin_reporter($mem_name,1,$recipient_message,"recipient");
				
				$posse = 0;
			}
		}
		$circle_gross = $inner_circle_gross * posse;
		return $circle_gross;
}
//postive general
function pg_pay($crewid,$cash_stolen,$user,$posse,$who,$flow){
	$query = sprintf("SELECT nat_win_share FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($percentage) = mysql_fetch_row($result);
		$perct = $percentage/100;
		$pay = $cash_stolen*$perct;
		$general_pop_gross = round($pay);
		while($posse > 0){
			$split_test = round($general_pop_gross/$posse);
			if($split_test == 0){
				$posse = $posse - 1;
			} else {
				$ser_query = sprintf("SELECT * FROM h_crew_member WHERE crew_id = ('%s') AND party = ('%s') AND user != ('%s') ORDER BY crew_losses", $crewid,1, $user);
				$ser = mysql_query($ser_query);
				// Update Member Private Account
				while($member_ar = mysql_fetch_assoc($ser)){
					$mem_name = $member_ar["user"];
					
					$query = sprintf("SELECT * FROM h_users WHERE UPPER(user) = UPPER('%s')",
								mysql_real_escape_string ($mem_name));
					$result = mysql_query($query);
					$new_ar = mysql_fetch_assoc($result);
					$memID = $new_ar["id"];
										
					$member_cash = getStat('cash',$memID);
					$deposit = $member_cash + $split_test;
					setStat('cash',$memID,$deposit);
					// Update Member Crew General Record					
					//Get current member general history
					$member_ge = getGE($mem_name,$crewid);
					//
					$record = $member_ge + $split_test;
					//
					setGE($crewid,$mem_name,$record);
				}
				//notify member
					$recipient_message = $user." has just earned you $".$deposit."!";
				//
				fin_reporter($mem_name,1,$recipient_message,"recipient");
				
				$posse = 0;
			}
		}
		$gen_gross = $general_pop * $posse;
		return $gen_gross;
}
//negative circle
function nc_pay($crewid,$cash_stolen,$user,$posse,$who,$flow){
//
	$query = sprintf("SELECT cir_loss_share FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($percentage) = mysql_fetch_row($result);
		$perct = $percentage/100;
		$gross_loss = $cash_stolen*$perct;
		$debit = round($gross_loss);
		while($gross_loss > 0){
			//debit test
			$split_test = $debit/$posse;
			$split_test = round($split_test);
			if($split_test == 0){
				$posse = $posse - 1;
			} else {
				$query = sprintf("SELECT * FROM h_crew_member WHERE crew_id = ('%s') AND party = ('%s') AND user != ('%s') ORDER BY crew_losses", $crewid,1, $user);
				$result = mysql_query($query);
				// Update Member Private Account
				while($member_ar = mysql_fetch_assoc($result)){
					$mem_name = $member_ar["user"];
					
					$query = sprintf("SELECT * FROM h_users WHERE UPPER(user) = UPPER('%s')",
								mysql_real_escape_string ($mem_name));
					$result = mysql_query($query);
					$new_ar = mysql_fetch_assoc($result);
					$memID = $new_ar["id"];
										
					$member_cash = getStat('cash',$memID);
					$debit = $member_cash - $split_test;
					setStat('cash',$memID,$debit);
					// Update Member Crew Bank | Debit Record
					//Get current member bonus history
					$member_debit = getDebit($mem_name,$crewid);
					//
					$record = $member_debit + $split_test;
					//
					setDebit($record,$crewid,$mem_name);
				}
				//notify member
					$recipient_message = $user." just cost you $".$debit."!";
				//
				fin_reporter($mem_name,1,$recipient_message,"recipient");
								
				$gross_loss = 0;
			}
		}
		return $debit;
}
//negative general
function ng_pay($crewid,$cash_stolen,$user,$posse,$who,$flow){
	
	$query = sprintf("SELECT nat_loss_share FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($percentage) = mysql_fetch_row($result);
		$perct = $percentage/100;
		$gross_loss = $cash_stolen*$perct;
		$debit = round($gross_loss);
		if($debit == 0){
			return $debit;
		} else {			
			while($gross_loss > 0){
				//debit test
				$split_test = $debit/$posse;
				$split_test = round($split_test);
				if($split_test == 0){
					$posse = $posse - 1;
				} else {
					$sqll = sprintf("SELECT * FROM h_crew_member WHERE crew_id = ('%s') AND party = ('%s') AND user != ('%s') ORDER BY crew_losses", $crewid,1, $user);
					$sqresult = mysql_query($sqll);
					// Update Member Private Account
					while($member_ar = mysql_fetch_assoc($sqresult)){
						$mem_name = $member_ar["user"];
						
						$acct_query = sprintf("SELECT * FROM h_users WHERE UPPER(user) = UPPER('%s')",
									mysql_real_escape_string ($mem_name));
						$acct_result = mysql_query($acct_query);
						$new_ar = mysql_fetch_assoc($acct_result);
						$memID = $new_ar["id"];
											
						$member_cash = getStat('cash',$memID);
						$debit = $member_cash - $split_test;
						setStat('cash',$memID,$debit);
						// Update Member Crew Bank | General Debit Record					
						//Get current member GL history
						$member_gl = getGL($mem_name,$crewid);
						//
						$record = $member_gl + $split_test;
						//
						setGL($mem_name,$crewid,$record);
					}
					//notify member
					$recipient_message = $user." just cost you $".$debit."!!!";
				//
				fin_reporter($mem_name,1,$recipient_message,"recipient");
					
					$gross_loss = 0;
				}
			}
			return $debit;
		}
}

//Crew News Reporter
//Finance News Reporter
function fin_reporter($user,$category,$msg,$towhom){
	$time = time();
	if($towhom == "sender"){
		$query = sprintf("INSERT INTO h_user_news(sender,crew,message,time) VALUES ('%s','%s','%s','%s');",
						mysql_real_escape_string($user),
						mysql_real_escape_string($category),
						mysql_real_escape_string($msg),
						mysql_real_escape_string($time));
					mysql_query($query);
	} elseif($towhom == "recipient"){
		$query = sprintf("INSERT INTO h_user_news(receiver,crew,message,time) VALUES ('%s','%s','%s','%s');",
						mysql_real_escape_string($user),
						mysql_real_escape_string($category),
						mysql_real_escape_string($msg),
						mysql_real_escape_string($time));
					mysql_query($query);
	}
	return;
}
//Arcade News Reporter
function reporter($user,$category,$msg,$towhom){
	$time = time();
	if($towhom == "sender"){
		$query = sprintf("INSERT INTO h_user_news(sender,arcade,message,time) VALUES ('%s','%s','%s','%s');",
						mysql_real_escape_string($user),
						mysql_real_escape_string($category),
						mysql_real_escape_string($msg),
						mysql_real_escape_string($time));
					mysql_query($query);
	} elseif($towhom == "recipient"){
		$query = sprintf("INSERT INTO h_user_news(receiver,arcade,message,time) VALUES ('%s','%s','%s','%s');",
						mysql_real_escape_string($user),
						mysql_real_escape_string($category),
						mysql_real_escape_string($msg),
						mysql_real_escape_string($time));
					mysql_query($query);
	}
	return;
}
//Crime News Repoter
function crime_reporter($user,$category,$msg,$towhom){
	$time = time();
	if($towhom == "sender"){
		$query = sprintf("INSERT INTO h_user_news(sender,criminal,message,time) VALUES ('%s','%s','%s','%s');",
						mysql_real_escape_string($user),
						mysql_real_escape_string($category),
						mysql_real_escape_string($msg),
						mysql_real_escape_string($time));
					mysql_query($query);
	} elseif($towhom == "recipient"){
		$query = sprintf("INSERT INTO h_user_news(receiver,criminal,message,time) VALUES ('%s','%s','%s','%s');",
						mysql_real_escape_string($user),
						mysql_real_escape_string($category),
						mysql_real_escape_string($msg),
						mysql_real_escape_string($time));
					mysql_query($query);
	}
	return;
}
//Hustle News Repoter
function hustle_reporter($user,$category,$msg,$towhom){
	$time = time();
	if($towhom == "sender"){
		$query = sprintf("INSERT INTO h_user_news(sender,hustle,message,time) VALUES ('%s','%s','%s','%s');",
						mysql_real_escape_string($user),
						mysql_real_escape_string($category),
						mysql_real_escape_string($msg),
						mysql_real_escape_string($time));
					mysql_query($query);
	} elseif($towhom == "recipient"){
		$query = sprintf("INSERT INTO h_user_news(receiver,hustle,message,time) VALUES ('%s','%s','%s','%s');",
						mysql_real_escape_string($user),
						mysql_real_escape_string($category),
						mysql_real_escape_string($msg),
						mysql_real_escape_string($time));
					mysql_query($query);
	}
	return;
}

//*************************************BILL COLLECTOR************************//
//                                                                           //
//               This script collects all hourly fees using cron job         //
//                                                                           //
//***************************************************************************//

//SELECT all the items from each user that has bills owed every hour
//Retrieve mortgage values
function asset_rent($asset){
		$query = sprintf("SELECT rent FROM h_assets WHERE id = ('%s')",
						 $asset);
		$result = mysql_query($query);
		list($value) = mysql_fetch_row($result);
		return $value;
} 
//mortgage property
function mortgage($uid,$bank){
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
		$asset_val = asset_rent($asset);
		if(isset($asset_val)){				 
			array_push($id, $asset);
			array_push($att, $asset_val);
			array_push($total, $asset_tot);
		}
	}
	//most valued asset 
	$amount = count($id);
	if($bank == 1){
		return $amount;
	}
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
	if($amount == 1){
	$old_C = getStat("exp",$uid);
	$new_cool = $old_C - 1;
	setStat("exp",$uid,$new_cool);	
	}
	return $scale;
}
//Repo man
function repo($uid){
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
		$asset_val = asset_rent($asset);
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
		$a_id = $id[$key];
		if($a_id == 1){
			break;
		}
		//find arsenal name
		$query = sprintf("SELECT name FROM h_assets WHERE id = ('%s')",
					 $a_id);
		$result = mysql_query($query);
		list($item_name) = mysql_fetch_row($result);
		//News to:
		$query = sprintf("SELECT user FROM h_users WHERE id = ('%s')",
					 $uid);
		$result = mysql_query($query);
		list($user_name) = mysql_fetch_row($result);
		// submit to user news
		$recipient_message = "After defaulting on the hourly mortgage, your ".$item_name." was repo'd!";
		fin_reporter($user_name,1,$recipient_message,"recipient");
		
		//repo a property		
		$query = sprintf("SELECT quantity FROM h_user_assets WHERE user_id = ('%s') AND asset_id = ('%s')",
																			 $uid,
																			 $a_id);
			$result = mysql_query($query);
			list($quantity) = mysql_fetch_row($result);
			if($quantity == 1){
				$sql = sprintf("DELETE FROM h_user_assets WHERE user_id = ('%s') AND asset_id = ('%s')",
						mysql_real_escape_string ($uid),
						mysql_real_escape_string ($a_id));
				mysql_query($sql);
			} else {				
				$quantity = $quantity - 1;
				$sql = sprintf("UPDATE h_user_assets SET quantity = ('%s') WHERE user_id = ('%s') AND asset_id = ('%s')",
						mysql_real_escape_string ($quantity),
						mysql_real_escape_string ($uid),
						mysql_real_escape_string ($a_id));
				mysql_query($sql);
				//deduct cool points
				//
				$cpval = asset_atts($a_id);
				$current = getStat("exp",$uid);
				$newc = $current - $cpval;
				setStat("exp",$uid,$newc);
				//
				$home = 0;
			}
		
		return;	
	}	 
}

//Retrieve muscle salaries
function contracts($muscle){
		$query = sprintf("SELECT maint_fee FROM h_muscle WHERE id = ('%s')",
						 $muscle);
		$result = mysql_query($query);
		list($value) = mysql_fetch_row($result);
		return $value;
} 
//security force
function salaries($uid,$bank){
	$query = sprintf("SELECT arsenal_id, quantity FROM h_user_arsenal WHERE user_id = ('%s')",
				 $uid);
	$result = mysql_query($query);
	$tot_power = array();
	$att = array();
	$id = array();
	$total = array();
	while($assets_ar = mysql_fetch_assoc($result)){
		$asset = $assets_ar["arsenal_id"];
		$asset_tot = $assets_ar["quantity"];
		$asset_val = contracts($asset);
		if(isset($asset_val)){				 
			array_push($id, $asset);
			array_push($att, $asset_val);
			array_push($total, $asset_tot);
		}
	}
	//most valued asset 
	$amount = count($id);
	if($bank == 1){
		return $amount;
	}
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
//union man
function strike($uid){
	$query = sprintf("SELECT arsenal_id, quantity FROM h_user_arsenal WHERE user_id = ('%s')",
				 $uid);
	$result = mysql_query($query);
	$tot_power = array();
	$att = array();
	$id = array();
	$total = array();
	while($assets_ar = mysql_fetch_assoc($result)){
		$asset = $assets_ar["arsenal_id"];
		$asset_tot = $assets_ar["quantity"];
		$asset_val = contracts($asset);
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
		$a_id = $id[$key];
		//repo a property
		if($a_id == 1){
			$home = 1;
			return;
		} else { 
			//find arsenal name
			$query = sprintf("SELECT name FROM h_muscle WHERE id = ('%s')",
						 $a_id);
			$result = mysql_query($query);
			list($item_name) = mysql_fetch_row($result);
			//News to:
			$query = sprintf("SELECT user FROM h_users WHERE id = ('%s')",
						 $uid);
			$result = mysql_query($query);
			list($user_name) = mysql_fetch_row($result);
			// submit to user news
			$recipient_message = "After missing their hourly paycheck, your ".$item_name." just quit!";
			fin_reporter($user_name,1,$recipient_message,"recipient");
			
			//repo a property		
			$query = sprintf("SELECT quantity FROM h_user_arsenal WHERE user_id = ('%s') AND arsenal_id = ('%s')",
																			 $uid,
																			 $a_id);
			$result = mysql_query($query);
			list($quantity) = mysql_fetch_row($result);
			if($quantity == 1){
				$sql = sprintf("DELETE FROM h_user_arsenal WHERE user_id = ('%s') AND arsenal_id = ('%s')",
						mysql_real_escape_string ($uid),
						mysql_real_escape_string ($a_id));
				mysql_query($sql);
			} else {				
				$quantity = $quantity - 1;
				$sql = sprintf("UPDATE h_user_arsenal SET quantity = ('%s') WHERE user_id = ('%s') AND arsenal_id = ('%s')",
						mysql_real_escape_string ($quantity),
						mysql_real_escape_string ($uid),
						mysql_real_escape_string ($a_id));
				mysql_query($sql);
				
				//deduct cool points
				//
				$cpval = asset_atts($a_id);
				$cpval = rand(1,$cpval);
				$current = getStat("exp",$uid);
				$newc = $current - $cpval;
				setStat("exp",$uid,$newc);
				//
				$home = 0;
			}
			return;	
		}
	}	 
}


//Retrieve dealer fees
function fees($arsenal){
		$query = sprintf("SELECT maint_fee FROM h_arsenal WHERE id = ('%s')",
						 $arsenal);
		$result = mysql_query($query);
		list($value) = mysql_fetch_row($result);
		return $value;
} 
//weapon upkeep
function upkeep($uid,$bank){
	$query = sprintf("SELECT arsenal_id, quantity FROM h_user_arsenal WHERE user_id = ('%s')",
				 $uid);
	$result = mysql_query($query);
	$tot_power = array();
	$att = array();
	$id = array();
	$total = array();
	while($assets_ar = mysql_fetch_assoc($result)){
		$asset = $assets_ar["arsenal_id"];
		$asset_tot = $assets_ar["quantity"];
		$asset_val = fees($asset);
		if(isset($asset_val)){				 
			array_push($id, $asset);
			array_push($att, $asset_val);
			array_push($total, $asset_tot);
		}
	}
	//most valued asset 
	$amount = count($id);
	if($bank == 1){
		return $amount;
	}
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
//get jacked?
function lost_goods($uid){
	$query = sprintf("SELECT arsenal_id, quantity FROM h_user_arsenal WHERE user_id = ('%s')",
				 $uid);
	$result = mysql_query($query);
	$tot_power = array();
	$att = array();
	$id = array();
	$total = array();
	while($assets_ar = mysql_fetch_assoc($result)){
		$asset = $assets_ar["arsenal_id"];
		$asset_tot = $assets_ar["quantity"];
		$asset_val = fees($asset);
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
		$a_id = $id[$key];
		//find arsenal name
		$query = sprintf("SELECT name FROM h_arsenal WHERE id = ('%s')",
					 $a_id);
		$result = mysql_query($query);
		list($item_name) = mysql_fetch_row($result);
		//News to:
		$query = sprintf("SELECT user FROM h_users WHERE id = ('%s')",
					 $uid);
		$result = mysql_query($query);
		list($user_name) = mysql_fetch_row($result);
		// submit to user news
		$recipient_message = "After missing you missed the hourly main't fee, your ".$item_name." was repo'd!";
		fin_reporter($user_name,1,$recipient_message,"recipient");
		
		//repo a property		
			$query = sprintf("SELECT quantity FROM h_user_arsenal WHERE user_id = ('%s') AND arsenal_id = ('%s')",
																			 $uid,
																			 $a_id);
			$result = mysql_query($query);
			list($quantity) = mysql_fetch_row($result);
			if($quantity == 1){
				$sql = sprintf("DELETE FROM h_user_arsenal WHERE user_id = ('%s') AND arsenal_id = ('%s')",
						mysql_real_escape_string ($uid),
						mysql_real_escape_string ($a_id));
				mysql_query($sql);
			} else {				
				$quantity = $quantity - 1;
				$sql = sprintf("UPDATE h_user_arsenal SET quantity = ('%s') WHERE user_id = ('%s') AND arsenal_id = ('%s')",
						mysql_real_escape_string ($quantity),
						mysql_real_escape_string ($uid),
						mysql_real_escape_string ($a_id));
				mysql_query($sql);
				//
				$cp_val = fees($a_id);
				$cp_val = rand(1,$cp_val);
				$current = getStat("exp",$uid);
				$newc = $current - $cpval;
				setStat("exp",$uid,$newc);
				//
				$alone = 0;
			}
		return;
	}
}

//Ledger
function ledger($name,$invoice){
	$overhead = 0;
	$query = sprintf("SELECT overhead FROM h_users WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string($name));
	$result = mysql_query($query);
	list($overhead) = mysql_fetch_row($result);
	
	$overhead = $overhead + $invoice;
	$sql = "UPDATE `h_users` SET `overhead` = '$overhead' WHERE `user` = '$user'";
				$result = mysql_query($sql);
	return;
}
//Appraiser
function cp_val($home){
$query = sprintf("SELECT `cp_value` FROM `h_assets` WHERE `name` = ('%s') OR `short_name` = ('%s')",
				mysql_real_escape_string($home),
				mysql_real_escape_string($home));
			$result = mysql_query($query);
			list($value) = mysql_fetch_row($result);
			return $value;
}
//Illegal Goods -- Assets
function getGoods($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT `quantity` FROM `h_user_assets` WHERE `asset_id` = (SELECT `id` FROM `h_illegal_goods` WHERE `name` = '%s' OR `short_name` = '%s') AND `user_id` = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;		
}
function setGoods($statName,$userID,$quantity) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	createIfNotExistsko($statName,$userID);
	$query = sprintf("UPDATE h_user_assets SET quantity = '%s' WHERE asset_id = (SELECT id FROM h_illegal_goods WHERE name = '%s' OR short_name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($quantity),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	return $result;
} 
function createIfNotExistsko($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT count(quantity) FROM h_user_assets WHERE asset_id = (SELECT id FROM h_illegal_goods WHERE name = '%s' OR short_name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if($count == 0) {
		// the stat doesn't exist; insert it into the database
		$query = sprintf("INSERT INTO h_user_assets(asset_id,user_id,quantity) VALUES ((SELECT id FROM h_illegal_goods WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID),
		'0');
		mysql_query($query);
	}	
}
//Easter Eggs -- Assets
function getAEggs($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT `quantity` FROM `h_user_assets` WHERE `asset_id` = (SELECT `id` FROM `h_special_items` WHERE `name` = '%s') AND `user_id` = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;		
}
function setAEggs($statName,$userID,$quantity) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	createIfNotExistskool($statName,$userID);
	$query = sprintf("UPDATE h_user_assets SET quantity = '%s' WHERE asset_id = (SELECT id FROM h_special_items WHERE name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($quantity),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	return $result;
} 
function createIfNotExistskool($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT count(quantity) FROM h_user_assets WHERE asset_id = (SELECT id FROM h_special_items WHERE name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if($count == 0) {
		// the stat doesn't exist; insert it into the database
		$query = sprintf("INSERT INTO h_user_assets(asset_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID),
		'0');
		mysql_query($query);
	}	
}
//Easter Eggs -- Weapons
function getWeggs($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT `quantity` FROM `h_user_arsenal` WHERE `arsenal_id` = (SELECT `id` FROM `h_special_items` WHERE `name` = '%s') AND `user_id` = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;		
}
function setWeggs($statName,$userID,$quantity) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	createIfNotExistskyo($statName,$userID);
	$query = sprintf("UPDATE h_user_arsenal SET quantity = '%s' WHERE arsenal_id = (SELECT id FROM h_special_items WHERE name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($quantity),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	return $result;
} 
function createIfNotExistskyo($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT count(quantity) FROM h_user_arsenal WHERE arsenal_id = (SELECT id FROM h_special_items WHERE name = '%s') AND user_id = ('%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if($count == 0) {
		// the stat doesn't exist; insert it into the database
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_special_items WHERE name = '%s'),'%s','%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID),
		'0');
		mysql_query($query);
	}	
}
//Franchises -- Assets
function getBiz($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT `id` FROM `h_user_assets` WHERE `asset_id` = (SELECT `id` FROM `h_businesses` WHERE `name` = '%s' OR `short_name` = '%s') AND `user_id` = ('%s') ORDER BY worth ASC LIMIT 1",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;		
}
 
function setClub($statName,$userID,$cool) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	// the stat doesn't exist; insert it into the database
	$query = sprintf("INSERT INTO h_user_assets(asset_id,user_id,worth) VALUES ((SELECT id FROM h_businesses WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
	mysql_real_escape_string($statName),
	mysql_real_escape_string($statName),
	mysql_real_escape_string($userID),
	mysql_real_escape_string($cool));
	mysql_query($query);
}
function setCasino($statName,$userID,$jackpot) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	// the stat doesn't exist; insert it into the database
	$query = sprintf("INSERT INTO h_user_assets(asset_id,user_id,jackpot) VALUES ((SELECT id FROM h_businesses WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
	mysql_real_escape_string($statName),
	mysql_real_escape_string($statName),
	mysql_real_escape_string($userID),
	mysql_real_escape_string($jackpot));
	mysql_query($query);
}

//Investor Center
function getPortfolio($biz_id,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT quantity FROM h_user_investments WHERE biz_id = ('%s') AND user_id = ('%s')",
		mysql_real_escape_string($biz_id),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($quantity) = mysql_fetch_row($result);
	return $quantity;		
}
//setPortfolio($casino_id,$patron_id,$added,$deposit);
function setPortfolio($biz_id,$userID,$quantity) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	createIfNotExistsIn($biz_id,$userID);
	$query = sprintf("UPDATE h_user_investments SET quantity = '%s' WHERE biz_id = ('%s') AND user_id = ('%s')",
		mysql_real_escape_string($quantity),
		mysql_real_escape_string($biz_id),
		mysql_real_escape_string($userID));
	mysql_query($query);
	return $result;
} 
function createIfNotExistsIn($biz_id,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT count(quantity) FROM h_user_investments WHERE biz_id = ('%s') AND user_id = ('%s')",
		mysql_real_escape_string($biz_id),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if($count == 0) {
		// the stat doesn't exist; insert it into the database
		$query = sprintf("INSERT INTO h_user_investments(biz_id,user_id,quantity) VALUES ('%s','%s','%s')",
		mysql_real_escape_string($biz_id),
		mysql_real_escape_string($userID),
		'0');
		mysql_query($query);
	}
}
function visiter($owner_id,$biz_id){				
			$sql = sprintf("SELECT visits FROM h_user_assets WHERE user_id = ('%s') AND id = ('%s')",
							mysql_real_escape_string($owner_id),
							mysql_real_escape_string($biz_id));
			$results = mysql_query($sql);
			list($visits) = mysql_fetch_row($results);
			$visits = $visits + 1;
			$query = sprintf("UPDATE h_user_assets SET visits = ('%s') WHERE id = ('%s') AND user_id = ('%s')",
						mysql_real_escape_string ($visits),
						mysql_real_escape_string ($biz_id),
						mysql_real_escape_string ($owner_id));
				mysql_query($query);
				return;
}
function getbiz_inc($biz_id,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT `income` FROM `h_user_assets` WHERE `id` = ('%s') AND `user_id` = ('%s')",
		mysql_real_escape_string($biz_id),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($income) = mysql_fetch_row($result);
	return $income;		
}
function setbiz_inc($biz_id,$userID,$income) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("UPDATE h_user_assets SET income = ('%s') WHERE id = ('%s') AND user_id = ('%s')",
						mysql_real_escape_string ($income),
						mysql_real_escape_string ($biz_id),
						mysql_real_escape_string ($userID));
				mysql_query($query);
	return;
}
function getbiz_val($biz_id,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT `worth` FROM `h_user_assets` WHERE `id` = ('%s') AND `user_id` = ('%s')",
		mysql_real_escape_string($biz_id),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($worth) = mysql_fetch_row($result);
	return $worth;		
}
function setbiz_val($biz_id,$userID,$worth) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("UPDATE h_user_assets SET worth = ('%s') WHERE id = ('%s') AND user_id = ('%s')",
						mysql_real_escape_string ($worth),
						mysql_real_escape_string ($biz_id),
						mysql_real_escape_string ($owner_id));
				mysql_query($query);
	return;
}
function pandl($new_val,$sign,$biz_id){
	$query = sprintf("UPDATE h_user_assets SET last_val = '%s' WHERE id = ('%s')",
		mysql_real_escape_string($new_val),
		mysql_real_escape_string($biz_id));
		mysql_query($query);
	$query = sprintf("UPDATE h_user_assets SET indicator = '%s' WHERE id = ('%s')",
		mysql_real_escape_string($sign),
		mysql_real_escape_string($biz_id));
		mysql_query($query);	
		
	return;
}
function nhour($biz_id){
	$query = sprintf("UPDATE h_user_assets SET visits = '%s', income = '%s' WHERE id = ('%s')",
		mysql_real_escape_string(0),
		mysql_real_escape_string(0),
		mysql_real_escape_string($biz_id));
		mysql_query($query);
	return;
}
function owner_wealth($owner_id,$casino_id,$wager,$owner_name,$x){
		//give to owner
				$wealth = getStat("cash",$owner_id);
				$deposit = $wealth + $wager;
				setStat("cash",$owner_id,$deposit);
				//record to asset valuation
				$query = sprintf("SELECT worth FROM h_user_assets WHERE id = ('%s') AND user_id = ('%s')",
								mysql_real_escape_string($casino_id),
								mysql_real_escape_string($owner_id));
				$result = mysql_query($query);
				list($worth) = mysql_fetch_row($result);
				$worth = $worth + $wager;
				$query = sprintf("UPDATE h_user_assets SET worth = '%s' WHERE id = '%s' AND user_id = ('%s')",
					mysql_real_escape_string($worth),
					mysql_real_escape_string($casino_id),
					mysql_real_escape_string($owner_id));
				mysql_query($query);
				//
				if($x == 2){
					if($wager ==0){
						//
					} else {
						$recipient_message = "Your <b>Night Club Empire</b> is growing income last hour was $".$wager;
						
						hustle_reporter($owner_name,1,$recipient_message,"recipient");
					}
				} else {
					if($wager == 0){
						//
					} else {
						$recipient_message = "Your <b>Casino Empire</b> is growing income last hour was $".$wager;
						
						hustle_reporter($owner_name,1,$recipient_message,"recipient");
					}
				}
				//
				return;
}
function quarterly($sign,$new_val,$biz_id,$income,$action,$x){
	$query = sprintf("SELECT `user_id` FROM `h_user_assets` WHERE `id` = ('%s')",
		mysql_real_escape_string($biz_id));
	$result = mysql_query($query);
	list($owner_id) = mysql_fetch_row($result);
	$query = sprintf("SELECT `user` FROM `h_users` WHERE `id` = ('%s')",
		mysql_real_escape_string($owner_id));
	$result = mysql_query($query);
	list($owner_name) = mysql_fetch_row($result);
	pandl($new_val,$sign,$biz_id);
	if($action == "add"){
		//add new val to last val and worth set sign to +
		$crt = getbiz_val($biz_id,$owner_id);
		$rating = $crt + $new_val;
		setbiz_val($biz_id,$owner_id,$rating);
		//Zero visits and income
		nhour($biz_id);
	}elseif($action=="minus"){
		//add new val to last val and worth set sign to +
		$crt = getbiz_val($biz_id,$owner_id);
		$rating = $crt - $new_val;
		setbiz_val($biz_id,$owner_id,$rating);
		//Zero visits and income
		nhour($biz_id);
	}elseif($action==1){
		//add new val to last val and worth set sign to +
		//Zero visits and income
		nhour($biz_id);
	}	
	owner_wealth($owner_id,$biz_id,$income,$owner_name,$x);
	return;
}
function id($user){
	$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($userID) = mysql_fetch_row($result);
	return $userID;
}
//Medical Records

function totalHealth($userID) {
	$stack = array();
	$query = sprintf("SELECT * FROM h_user_arsenal WHERE user_id = ('%s') AND type = 'muscle'",
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	while($mitchell = mysql_fetch_assoc($result)){
		$rh = $mitchell["remain_health"];
		$quan = $mitchell["quantity"];
		$new = $rh * $quan;
		array_push($stack,$new);
	}
	$value = array_sum($stack);
	return $value;		
}
//Bank system

function getBCash(){
	$query = "SELECT balance FROM h_bliss_bank ";
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;
}

function setBCash($amount){
	$query = sprintf("UPDATE h_bliss_bank SET balance = '%s'",
		mysql_real_escape_string($amount));
	mysql_query($query);
}

function getBAss(){
	$query = "SELECT assets FROM h_bliss_bank ";
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;
}

function setBAss($amount){
	$query = sprintf("UPDATE h_bliss_bank SET assets = '%s'",
		mysql_real_escape_string($amount));
	mysql_query($query);
}

//Personal Accounts
function getAccount($user){
	$query = sprintf("SELECT balance FROM h_bank_accounts WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;
}

function setAccount($amount,$user){
	$query = sprintf("UPDATE h_bank_accounts SET balance = '%s' WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($amount),
		mysql_real_escape_string($user));
	mysql_query($query);
}
//Tutorial Areas
function cash_in($uid,$money){
	$cash = getStat("cash",$uid);
	$deposit = $cash + $money;
	setStat("cash",$uid,$deposit);
	return;
}
function popular($uid,$class){
	$cool = getStat("exp",$uid);
	$up = $cool + $class;
	setStat("exp",$uid,$up);
	return;
}

function search($user){
	$query = sprintf("SELECT area_tut FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($itstime) = mysql_fetch_row($result);
			
	$newtime = $itstime + 1;
	
	$query = sprintf("UPDATE h_users SET area_tut = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($newtime),
			mysql_real_escape_string ($user));
	mysql_query($query);
	//
	$query = sprintf("SELECT tut_total FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($me) = mysql_fetch_row($result);
			
	$n = $me + 1;
	
	$query = sprintf("UPDATE h_users SET tut_total  = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($n),
			mysql_real_escape_string ($user));
	mysql_query($query);
	return;
}
function gamerwho($user){
	$query = sprintf("SELECT game_name FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($gamename) = mysql_fetch_row($result);
	return $gamename;
}
?>