<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_POST['customer'];
$item = $_POST['option'];


$userid = id($user);
$cash = getStat("cash",$userid);

if($item == "dog"){
	$sick = getStat("health",$userid);
	if($sick != 100){
		if($cash < 3){
			echo 1;
		} else {
			$debit = $cash - 3;
			setStat("cash",$userid,$debit);
			
			$cool = getStat("exp",$userid);
			$boost = $cool + 10;
			setStat("exp",$userid,$boost);
			echo 2;
		}
	}
} elseif($item == "salad"){
	$sick = getStat("health",$userid);
	if($sick != 100){
		if($cash < 25){
			echo 1;
		} else {
			$debit = $cash - 25;
			setStat("cash",$userid,$debit);
			
			$cool = getStat("exp",$userid);
			$boost = $cool + 25;
			setStat("exp",$userid,$boost);
			
			$sick = getStat("health",$userid);
			$heal = $sick + 3;
			if($heal >= 50){
				$query = sprintf("DELETE FROM h_patients WHERE user_id =('%s')",
					mysql_real_escape_string($userid));
				mysql_query($query);
			}
			setStat("health",$userid,$heal);
			echo 2;
		}
	} else {
		echo 3;
	}
} elseif($item == "penne"){
	$sick = getStat("health",$userid);
	if($sick != 100){
		if($cash < 100){
			echo 1;
		} else {
			$debit = $cash - 100;
			setStat("cash",$userid,$debit);
			
			$cool = getStat("exp",$userid);
			$boost = $cool + 100;
			setStat("exp",$userid,$boost);
			
			$sick = getStat("health",$userid);
			$heal = $sick + 4;
			if($heal >= 50){
				$query = sprintf("DELETE FROM h_patients WHERE user_id =('%s')",
					mysql_real_escape_string($userid));
				mysql_query($query);
			}
			setStat("health",$userid,$heal);
			echo 2;
		}
	} else {
		echo 3;
	}
} elseif($item == "meal"){
	$sick = getStat("health",$userid);
	if($sick != 100){
		if($cash < 250){
			echo 1;
		} else {
			$debit = $cash - 250;
			setStat("cash",$userid,$debit);
			
			$cool = getStat("exp",$userid);
			$boost = $cool + 500;
			setStat("exp",$userid,$boost);
			
			$sick = getStat("health",$userid);
			$heal = $sick + 5;
			if($heal >= 50){
				$query = sprintf("DELETE FROM h_patients WHERE user_id =('%s')",
					mysql_real_escape_string($userid));
				mysql_query($query);
			}
			setStat("health",$userid,$heal);
			echo 2;
		}
	} else {
		echo 3;
	}
} 
?>