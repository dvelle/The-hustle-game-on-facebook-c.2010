<?
$user = $_REQUEST['name'];
//$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
$user_ID = id($user);

$current = getStat('exp',$user_ID);
if($current > 5000000){
	setStat('exp',$user_ID,5000000);
}

?>