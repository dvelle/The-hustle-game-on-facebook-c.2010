<?php
$user = $_REQUEST['data'];
//$user = "jermongreen";

include 'stats.php';
require_once 'connect.php';		// our database settings
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);


$query = sprintf("SELECT uppemail FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
list($email) = mysql_fetch_row($result);

if(empty($email)){
	
	$query = sprintf("SELECT asked FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
	list($asked) = mysql_fetch_row($result);
	if($asked == 2){
		//dont ask again
	} else {
		//never been asked
		$sql = sprintf("UPDATE h_users SET asked = ('%s') WHERE UPPER(user) = UPPER('%s')",
								2,
								mysql_real_escape_string ($user));
						mysql_query($sql);	
		echo 1;
	}
}
?>