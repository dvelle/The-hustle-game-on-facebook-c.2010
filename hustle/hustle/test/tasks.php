<?
$user = $_REQUEST['name'];

//$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
$query = sprintf("SELECT * FROM h_crimes WHERE UPPER(hood) = UPPER('%s') AND done = '%s'",
		mysql_real_escape_string ($user),
		0);
$result = mysql_query($query);
$user_ar = mysql_fetch_assoc($result);
$code = $user_ar["task_code"];
echo $code;
?>