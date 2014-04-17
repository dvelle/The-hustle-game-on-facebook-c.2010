<?
$user = $_REQUEST['data'];

//$user = "jermongreen";
//$frame = "A";
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
//
$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
mysql_real_escape_string($user));
$result = mysql_query($query);
list($chapter) = mysql_fetch_row($result);
if($chapter == 2){
	$chapter = $chapter + 1;
	
	$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($chapter),
		mysql_real_escape_string($user));
	mysql_query($query);
}

?>
