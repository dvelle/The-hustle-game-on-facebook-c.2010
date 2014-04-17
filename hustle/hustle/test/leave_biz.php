<?

$user = $_REQUEST['data'];

//$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user_ID = id($user);

$sql = sprintf("DELETE FROM h_patrons WHERE user_id = ('%s')",
						mysql_real_escape_string ($user_ID));
				mysql_query($sql);

//update egg status
$query = sprintf("UPDATE h_users SET egg_name = '%s' WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string(1),
		mysql_real_escape_string($user));
mysql_query($query);						

?>