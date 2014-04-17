<?php
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
$choice = $_POST['target'];
if(empty($choice)){
	echo 1;
} else {
	//$user = "jermongreen";
	$query = sprintf("UPDATE h_users SET avatar = '%s' WHERE user = ('%s')",
			mysql_real_escape_string($choice),
			mysql_real_escape_string($user));
	mysql_query($query);
}
?>