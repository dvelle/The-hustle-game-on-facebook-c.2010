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


$query = sprintf("UPDATE h_cops SET busy = ('%s') WHERE UPPER(cop) = UPPER('%s')",
		mysql_real_escape_string (0),
		mysql_real_escape_string ($user));
mysql_query($query);

$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string ($user));
	$result = mysql_query($query);
list($user_ID) = mysql_fetch_row($result);
$cur = getStat("cash",$user_ID);
$debit = $cur - 50;
setStat("cash",$user_ID,$debit);


?>