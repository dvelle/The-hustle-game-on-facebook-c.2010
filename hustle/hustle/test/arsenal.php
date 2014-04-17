<?php
 
function getArsenal($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	createIfNotExists($statName,$userID);
	$query = sprintf("SELECT value FROM h_user_arsenal WHERE arsenal_id = (SELECT id FROM h_arsenal WHERE name = '%s' OR short_name = '%s') AND user_id = '%s'",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($value) = mysql_fetch_row($result);
	return $value;		
}
function setArsenal($statName,$userID,$quantity) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	createIfNotExists($statName,$userID);
	$query = sprintf("UPDATE h_user_arsenal SET quantity = '%s' WHERE arsenal_id = (SELECT id FROM h_arsenal WHERE name = '%s' OR short_name = '%s') AND user_id = '%s'",
		mysql_real_escape_string($quantity),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
} 
function createIfNotExists($statName,$userID) {
	include 'connect.php';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname);
	$query = sprintf("SELECT count(quantity) FROM h_user_arsenal WHERE arsenal_id = (SELECT id FROM h_arsenal WHERE name = '%s' OR short_name = '%s') AND user_id = '%s'",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if($count == 0) {
		// the stat doesn't exist; insert it into the database
		$query = sprintf("INSERT INTO h_user_arsenal(arsenal_id,user_id,quantity) VALUES ((SELECT id FROM h_arsenal WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
		mysql_real_escape_string($statName),
		mysql_real_escape_string($statName),
		mysql_real_escape_string($userID),
		'0');
		mysql_query($query);
	}	
}

?>