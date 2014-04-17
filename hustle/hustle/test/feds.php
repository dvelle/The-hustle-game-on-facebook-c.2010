<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
	
$user = $_POST['customer'];
//$user = "jermongreen";
$crook = $_POST['crook_name'];
$crook = str_replace (" ", "", $crook);

$query = sprintf("SELECT user FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string ($crook));
	$result = mysql_query($query);
list($user) = mysql_fetch_row($result);

$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string ($user));
	$result = mysql_query($query);
list($user_ID) = mysql_fetch_row($result);
$cur = getStat("exp",$user_ID);
//check if matches name on h_investigation
$query = sprintf("SELECT COUNT(id) FROM h_investigations WHERE UPPER(hood) = UPPER('%s') AND UPPER(cop) = UPPER('%s')",
		mysql_real_escape_string ($crook),
		mysql_real_escape_string ($user));
$result = mysql_query($query);
list($counter) = mysql_fetch_row($result);

$query = sprintf("SELECT award FROM h_investigations WHERE UPPER(hood) = UPPER('%s') AND UPPER(cop) = UPPER('%s')",
		mysql_real_escape_string ($crook),
		mysql_real_escape_string ($user));
	$result = mysql_query($query);
list($award) = mysql_fetch_row($result);
if($counter > 0){
	//add to rap sheets
	$query = sprintf("SELECT COUNT(id) FROM h_rap_sheet WHERE UPPER(hood) = UPPER('%s')",
			mysql_real_escape_string ($crook));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if($count > 0){
		$query = sprintf("SELECT record FROM h_rap_sheet WHERE UPPER(hood) = UPPER('%s')",
				mysql_real_escape_string ($crook));
		$result = mysql_query($query);
		list($record) = mysql_fetch_row($result);
		$record = $record + 1;
		$sql = sprintf("UPDATE h_rap_sheet SET record = ('%s') WHERE UPPER(hood) = UPPER('%s')",
								mysql_real_escape_string ($record),
								mysql_real_escape_string ($crook));
						mysql_query($sql);
	} else {
		$record = 1;
		$query = sprintf("INSERT INTO h_rap_sheet(record,hood) VALUES ('%s','%s')",
		mysql_real_escape_string($record),
		mysql_real_escape_string($crook));
		mysql_query($query);
	}
	//award detective	
	$update = $cur + $award;
	setStat("exp",$user_ID,$update);
	$sql = sprintf("UPDATE h_investigations SET done = ('%s') WHERE UPPER(hood) = UPPER('%s') AND UPPER(cop) = UPPER('%s')",
								1,
								mysql_real_escape_string ($crook),
								mysql_real_escape_string ($user));
						mysql_query($sql);
	echo 1;
} else {
	$award = $award/4;
	$update = $cur - $award;
	setStat("exp",$user_ID,$update);
	echo 2;
}
?>

 