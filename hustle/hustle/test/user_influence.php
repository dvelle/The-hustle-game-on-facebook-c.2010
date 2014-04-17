<?
$user = $_REQUEST["data"];
//$user = "jermongreen";
require_once 'connect.php';	// this is from our earlier article on configuration files in PHP
require_once 'stats.php';

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

//calculate how many properties downtown current user has and return
// " user's/1000 = X * 100 "enum('up', 'down', 'east', 'mid')
$down = "down";
$mid = "mid";
$east = "east";
$up = "up";
$query = sprintf("SELECT count(id) FROM h_properties WHERE UPPER(owner) = UPPER('%s') AND type = ('%s')",
		mysql_real_escape_string($user),
		$down);
$result = mysql_query($query);
list($total_owned) = mysql_fetch_row($result);

$decimal = $total_owned/1000;

$downtown_percentage = $decimal * 100;

//calculate how many properties downtown current user has and return
// " user's/1000 = X * 100 "

$query = sprintf("SELECT count(id) FROM h_properties WHERE UPPER(owner) = UPPER('%s') AND type = ('%s')",
		mysql_real_escape_string($user),
		$mid);
$result = mysql_query($query);
list($total_owned) = mysql_fetch_row($result);

$decimal = $total_owned/1000;

$midtown_percentage = $decimal * 100;

//calculate how many properties downtown current user has and return
// " user's/1000 = X * 100 "

$query = sprintf("SELECT count(id) FROM h_properties WHERE UPPER(owner) = UPPER('%s') AND type = ('%s')",
		mysql_real_escape_string($user),
		$up);
$result = mysql_query($query);
list($total_owned) = mysql_fetch_row($result);

$decimal = $total_owned/1000;

$northside_percentage = $decimal * 100;


//calculate how many properties downtown current user has and return
// " user's/1000 = X * 100 "

$query = sprintf("SELECT count(id) FROM h_properties WHERE UPPER(owner) = UPPER('%s')",
		mysql_real_escape_string($user),
		$east);
$result = mysql_query($query);
list($total_owned) = mysql_fetch_row($result);

$decimal = $total_owned/1000;

$eastside_percentage = $decimal * 100;


$poller = json_encode(array(
  "midtown" => $midtown_percentage,
  "eastside" => $eastside_percentage,
  "northside" => $northside_percentage,
  "downtown" => $downtown_percentage,
));

echo $poller;
 
?>