<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
//$user = "jermongreen";
if($_POST['accept_x']){
	$query = sprintf("UPDATE h_users SET agent = '%s' WHERE UPPER(user) = UPPER('%s')",
		1,
		mysql_real_escape_string($user));
	mysql_query($query);
	$userID = id($user);
	$tokens = getStat("rp",$userID);
	$add = $tokens + 10;
	setStat("rp",$userID,$add);
	echo 1;
}elseif($_POST['fight_x']) {
	
	$query = sprintf("UPDATE h_users SET agent = '%s' WHERE UPPER(user) = UPPER('%s')",
		3,
		mysql_real_escape_string($user));
	mysql_query($query);
	//rob player
	$user_ID = id($user);
	$cash = getStat("cash",$user_ID);
	$debit = $cash - 500;
	if($debit > 0){
		$debit = round($debit/2);
	}
	setStat("cash",$user_ID,$debit);
	
	$energy = getStat("ep",$user_ID);
	$denergy = $energy - 5;	
	setStat("ep",$user_ID,$denergy);
	setStat("health",$user_ID,75);
	echo 2;
}

?>

 