<?php
$uid = $_REQUEST["data"];

require_once('connect.php');
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$query = sprintf("SELECT id FROM h_users WHERE uid = ('%s')",
			mysql_real_escape_string ($uid));
$result = mysql_query($query);
list($userID) = mysql_fetch_row($result);

echo $userID
?>
