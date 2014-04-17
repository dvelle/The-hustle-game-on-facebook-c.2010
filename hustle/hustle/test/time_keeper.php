<?
$user = $_REQUEST['name'];
$value = $_REQUEST['adjust'];
$time = $_REQUEST['left'];
//$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


//get user stats
$user_ID = id($user);

if($time == "O"){
	setStat('health',$user_ID,10);
	setStat('epr',$user_ID,2);
} else {
	
	$current = getStat('health',$user_ID);
	
	$powerup = $current + $value;
	if($powerup >= 50){
					$query = sprintf("DELETE FROM h_patients WHERE user_id =('%s')",
						mysql_real_escape_string($user_ID));
					mysql_query($query);
	}
	setStat('health',$user_ID,$powerup);

	$query = sprintf("UPDATE h_users SET timeLeft = '%s' WHERE id = '%s'",
			mysql_real_escape_string($time),
			mysql_real_escape_string($user_ID));
		mysql_query($query);
	//Check for junkie
	$sick = getStat('epr',$user_ID);
	if($sick == 2 && $current == 100){
		setStat('epr',$user_ID,10);
	}
}

?>
