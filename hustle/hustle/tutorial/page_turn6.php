<?
$user = $_REQUEST['data'];
$biz_id = $_REQUEST['casino'];

//$user = "jermongreen";
//$frame = "A";
include '../test/stats.php';
include '../test/connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
//
$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
mysql_real_escape_string($user));
$result = mysql_query($query);
list($chapter) = mysql_fetch_row($result);
if($chapter == 8){
	$chapter = $chapter + 1;
	
	$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($chapter),
		mysql_real_escape_string($user));
	mysql_query($query);
	$query = sprintf("SELECT id FROM h_patrons WHERE user_id = ('%s') AND club_id = '%s'",
				mysql_real_escape_string(2),//earvin
				mysql_real_escape_string(156));
			$result = mysql_query($query);
			list($jamison) = mysql_fetch_row($result);
	if(empty($jamison)){
		$query = sprintf("INSERT INTO h_patrons(club_id,user_id) VALUES ('%s','%s')",
			mysql_real_escape_string(156),//Mike's Casino
			mysql_real_escape_string(2));
		mysql_query($query);
	}
	$query = sprintf("SELECT id FROM h_patrons WHERE user_id = ('%s') AND club_id = '%s'",
		mysql_real_escape_string(3),//jenifer
		mysql_real_escape_string(156));
	$result = mysql_query($query);
	list($jamison) = mysql_fetch_row($result);
	if(empty($jamison)){
		$query = sprintf("INSERT INTO h_patrons(club_id,user_id) VALUES ('%s','%s')",
			mysql_real_escape_string(156),//Mike's Casino
			mysql_real_escape_string(3));
		mysql_query($query);
	}
}

?>
