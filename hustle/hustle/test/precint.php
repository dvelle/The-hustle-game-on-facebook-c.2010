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

//check for prior record
$query = sprintf("SELECT COUNT(id) FROM h_users WHERE UPPER(hood) = UPPER('%s')",
		mysql_real_escape_string ($crook));
$result = mysql_query($query);
list($counter) = mysql_fetch_row($result);
if($counter > 0){
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
		$sql = sprintf("UPDATE h_users SET snitch = ('%s') WHERE UPPER(user) = UPPER('%s')",
								0,
								mysql_real_escape_string ($user));
						mysql_query($sql);				
	} else {
		$record = 1;
		$query = sprintf("INSERT INTO h_rap_sheet(record,hood) VALUES ('%s','%s')",
		mysql_real_escape_string($record),
		mysql_real_escape_string($crook));
		mysql_query($query);
		$sql = sprintf("UPDATE h_users SET snitch = ('%s') WHERE UPPER(user) = UPPER('%s')",
								0,
								mysql_real_escape_string ($user));
						mysql_query($sql);
	}
}
$sql = sprintf("UPDATE h_users SET snitch = ('%s') WHERE UPPER(user) = UPPER('%s')",
								0,
								mysql_real_escape_string ($user));
						mysql_query($sql);
?>

 