<?php
$user = $_REQUEST['data'];
//$user = "jermongreen";

include 'stats.php';
require_once 'connect.php';		// our database settings
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);


$query = sprintf("SELECT award FROM h_investigations WHERE UPPER(cop) = UPPER('%s')",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
list($cpbonus) = mysql_fetch_row($result);

$query = sprintf("SELECT hood FROM h_investigations WHERE UPPER(cop) = UPPER('%s')",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
list($hood) = mysql_fetch_row($result);


$query = sprintf("SELECT title FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($hood));
	$result = mysql_query($query);
list($crew_title) = mysql_fetch_row($result);


//
//output
//
$poller = json_encode(array(
  "bonus" => $cpbonus,
  "crew" => $crew_title,
  ));

echo $poller

?>