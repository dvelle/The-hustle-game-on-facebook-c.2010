<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_POST['customer'];
$item = $_POST['option'];

function heal_up($uid, $dammage){
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
		$value = min($att);
		$key = array_search($value, $att);
		
		$a_id = array_search($value, $id);
		$que = sprintf("SELECT * FROM h_muscle WHERE id = ('%s')",
							mysql_real_escape_string($a_id));
			$result = mysql_query($que);
		$row = mysql_fetch_array($result);
		$name = $row['name'];
		$max_health = $row['health'];
		
		$a_value = $total[$key] * $value;
		$pain = $a_value + $dammage;
		
		if($pain < $max_health){
			$query = sprintf("UPDATE h_user_arsenal SET rem_health = '%s' WHERE arsenal_id = ('%s') AND user_id = ('%s')",
							mysql_real_escape_string($pain),
							mysql_real_escape_string($a_id),
							mysql_real_escape_string($userID));
						mysql_query($query);
		}
		unset($att[$key]);	
		$i++;
	}
	return;
}

$userid = id($user);
$cash = getStat("cash",$userid);

if($item == "me"){
	$sick = getStat("health",$userid);
	if($sick != 100){
		if($cash < 500){
			echo 1;
		} else {
			$debit = $cash - 500;
			setStat("cash",$userid,$debit);
			
			$sick = getStat("health",$userid);
			$heal = $sick + 10;
			if($heal >= 50){
				$query = sprintf("DELETE FROM h_patients WHERE user_id =('%s')",
					mysql_real_escape_string($userid));
				mysql_query($query);
			}
			setStat("health",$userid,$heal);
			echo 2;
		}
	}
} elseif($item == "them"){
	//do they have security?
	$s = getShield($userid);
	if(empty($s)){
		echo 4;
	} else {
		 if($cash < 450){
			echo 1;
		} else {
			$debit = $cash - 500;
			setStat("cash",$userid,$debit);
			//
			$sick = getShield($userid);
			$heal = $sick + 10;
			setShield($userid,$heal);
			//crew
			heal_up($userid,10);
			echo 3;
		}
	}
} 
?>

 