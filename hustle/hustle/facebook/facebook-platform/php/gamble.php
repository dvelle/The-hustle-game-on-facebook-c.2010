<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$wager = $_POST['mybet'];
$patron= $_POST['customer'];
	
if(!empty($wager)){
	$test = $wager * 36;
	if($test > 0){
		$sql = sprintf("SELECT user_id FROM h_users WHERE user = ('%s')",
						mysql_real_escape_string($patron));
		$results = mysql_query($sql);
		list($userID) = mysql_fetch_row($results);
		
		$query = sprintf("UPDATE h_patrons SET wager = '%s' WHERE user_id = ('%s')",
		mysql_real_escape_string($wager),
		mysql_real_escape_string($userID));
		mysql_query($query);
		echo 1;				
	}
}
?>

 