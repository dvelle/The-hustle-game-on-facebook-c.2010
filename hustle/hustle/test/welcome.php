<?

if(!empty($_REQUEST['data'])){
	$user = $_REQUEST['data'];
} else {
	$user = $_POST['name'];
}

//$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
$query = sprintf("SELECT fl_facebook FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($status) = mysql_fetch_row($result);
if($status = "new"){
	$query = sprintf("UPDATE h_users SET fl_facebook = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ("normal"),
			mysql_real_escape_string ($user));
	mysql_query($query);
	$time = time();
	$clock = $time + 129600;
	$query = sprintf("UPDATE h_users SET tutorial_time = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($clock),
			mysql_real_escape_string ($user));
	mysql_query($query);
}

//
$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($userID) = mysql_fetch_row($result);

$query = sprintf("SELECT upgrade_flag FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string ($user));
$result = mysql_query($query);
list($flag) = mysql_fetch_row($result);

echo $flag;

$query = sprintf("UPDATE h_users SET upgrade_flag = ('%s') WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string (0),
		mysql_real_escape_string ($user));
mysql_query($query);

?>