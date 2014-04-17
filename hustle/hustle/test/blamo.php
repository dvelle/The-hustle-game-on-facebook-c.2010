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

$current = getStat('ep',$user_ID);
$max = getStat('epr',$user_ID);

$query = sprintf("UPDATE h_users SET etimeLeft = '%s' WHERE id = '%s'",
			mysql_real_escape_string($time),
			mysql_real_escape_string($user_ID));
		mysql_query($query);
		
$pu = $current + $value;
if($pu > $max){
	$pu = $max;
}	
setStat('ep',$user_ID,$pu);

$poller = json_encode(array(
  "user_max" => $max,
  "user_e" => $current,
));  

echo $poller;
?>