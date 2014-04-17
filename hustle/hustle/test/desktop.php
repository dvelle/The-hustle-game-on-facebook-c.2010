<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_POST['leader'];
//$user = "jermongreen";
$the_name = $_POST['member'];
//$member = "nacobilewis";


$sql = sprintf("SELECT user FROM h_users WHERE UPPER(game_name) = ('%s')",
									mysql_real_escape_string ($the_name));
$result = mysql_query($sql);
list($member) = mysql_fetch_row($result);

//Leader UserId
$sql = sprintf("SELECT id FROM h_users WHERE UPPER(user) = ('%s')",
									mysql_real_escape_string ($member));
$result = mysql_query($sql);
list($memberID) = mysql_fetch_row($result);

//Leader UserId
$sql = sprintf("SELECT id FROM h_users WHERE UPPER(user) = ('%s')",
									mysql_real_escape_string ($user));
$result = mysql_query($sql);
list($leaderID) = mysql_fetch_row($result);

//alright whats my crew id, now that im in there crew?
$query = sprintf("SELECT id FROM h_crew_main WHERE user = UPPER('%s')",
mysql_real_escape_string($user));
$result = mysql_query($query);	
list($crewID) = mysql_fetch_row($result);

//their crew ID
$query = sprintf("SELECT id FROM h_crew_main WHERE user = UPPER('%s')",
mysql_real_escape_string($member));
$result = mysql_query($query);	
list($mem_crewID) = mysql_fetch_row($result);
//**********BODY*************************************
//**************BODY*********************************
//******************BODY*****************************
if(!empty($_POST['fire'])){
	$action = $_POST['fire'];
	//delete member from my ranks
	$query = sprintf("DELETE FROM h_crew_member WHERE user = ('%s') AND crew_id = ('%s');",
		mysql_real_escape_string($member),
		mysql_real_escape_string($crewID));
	mysql_query($query);
	
	//delete me from their ranks
	$query = sprintf("DELETE FROM h_crew_member WHERE user = ('%s') AND crew_id = ('%s');",
		mysql_real_escape_string($user),
		mysql_real_escape_string($mem_crewID));
	mysql_query($query);
	
	//Set stats fired
	$sql = "UPDATE `h_users` SET `fired` = `fired`+1 WHERE `user` = '$member' LIMIT 1";
            $result=mysql_query($sql);
	//Set fired records		
	$sql2 = "UPDATE `h_users` SET `pink_slip` = `pink_slip`+1 WHERE `user` = '$user' LIMIT 1";
            $result=mysql_query($sql2);
	//
	$drain_query = sprintf("SELECT crew_losses FROM h_crew_member WHERE user = ('%s') AND crew_id = ('%s')",
			mysql_real_escape_string($user),
			mysql_real_escape_string($mem_crewID));
	$d_result = mysql_query($drain_query);
	list($losses) = mysql_fetch_row($d_result);
	//Cool point loss = crew_losses
	$records = getStat("exp",$memberID);
	$deficit = rand(0,$losses);
	$adjust = $records - $deficit;
	setStat("exp",$memberID,$adjust);
	//Notify ex-member of cool point lost
	$msg = "You were just fired from the".$crewtitle." crew and lost ".$adjust." Cool Points.";
	$query = sprintf("INSERT INTO h_user_news(message) VALUES ('%s') WHERE member = ('%s')",
		mysql_real_escape_string($msg),
		mysql_real_escape_string($member));
	mysql_query($query);
	//
	echo $member." was Successfully Fired!";		
}elseif(!empty($_POST['shakedown'])){
	$action = $_POST['shakedown'];
	//0 posse' shakedown just use weapons and muscle to defend or fight
	
	//Total weapons available
	function theshake($userID,$state,$posse){
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
	return $weapon_power;
	}
	//Do the dirt
	$state = "attack";
	$posse = 1;
	$leader_weapon = theshake($leaderID,$state,$posse);
	$defender_weapon = theshake($memberID,$state,$posse);
	if($leader_weapon > $defender_weapon){
		//How many times is this?		
		//leader successful
		$diff = $leader_weapon - $defender_weapon;
		$account = getStat("cash",$leaderID);
		$deposit = $account + $diff;
		setStat("cash",$leaderID,$deposit);
		//subtract from member
		$mem_acc = getStat("cash",$memberID);
		$mem_debit = $mem_acc - $diff;
		setStat("cash",$memberID,$debit);
		//notify parties involved
		$sql = "UPDATE `h_crew_members` SET `shakedown` = `shakedown`+1 WHERE `user` = '$member' AND `crew_id` = `$crewID` LIMIT 1";
            $result=mysql_query($sql);
	    echo "You shook down ".$member." for $".$diff;
	} else {
		//defender safe, this time
		//notify parties
		echo "You were UNsuccessful";
	}
}
?>