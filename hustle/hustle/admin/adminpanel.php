<?
include("../test/connect.php");
 
$db = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname); 

$user = "jermongreen";

$query = sprintf("SELECT id FROM  h_users WHERE user = '%s'",
					$user);
				$result = mysql_query($query);	
list($user_id) = mysql_fetch_row($result);

//member init
$query = sprintf("SELECT id FROM h_crew_main WHERE user = UPPER('%s')",
mysql_real_escape_string($user));
$result = mysql_query($query);	
list($crewID) = mysql_fetch_row($result);

// new user created, log him in:
//crew init
$query = sprintf("DELETE FROM h_crew_main WHERE user = '%s'",
	mysql_real_escape_string($user));
mysql_query($query);


//top crew init
$query = sprintf("DELETE FROM h_top_crew WHERE user = '%s'",
			mysql_real_escape_string($user));	 
mysql_query($query);

$query = sprintf("DELETE FROM h_top_players WHERE user = '%s'",
	mysql_real_escape_string($user));
mysql_query($query);

//member init2				
$query = sprintf("DELETE FROM h_crew_member WHERE user = '%s'",
	mysql_real_escape_string($user));
mysql_query($query);

$query = sprintf("DELETE FROM h_user_stats WHERE user_id = '%s'",
	mysql_real_escape_string($user_id));
mysql_query($query);

$query = sprintf("DELETE FROM h_user_assets WHERE user_id = '%s'",
	mysql_real_escape_string($user_id));
mysql_query($query);

$query = sprintf("DELETE FROM h_user_arsenal WHERE user_id = '%s'",
	mysql_real_escape_string($user_id));
mysql_query($query);

$query = sprintf("DELETE FROM h_user_news WHERE reciever = '%s'",
	mysql_real_escape_string($user));
mysql_query($query);

$query = sprintf("DELETE FROM h_user_achievements WHERE user_id = '%s'",
	mysql_real_escape_string($user_id));
mysql_query($query);

$query = sprintf("DELETE FROM h_crimes WHERE user2 = '%s'",
	mysql_real_escape_string($user));
mysql_query($query);

$query = sprintf("DELETE FROM arcade_challenges WHERE user2 = '%s'",
	mysql_real_escape_string($user));
mysql_query($query);

$query = sprintf("DELETE FROM h_user_investments WHERE user_id = '%s'",
	mysql_real_escape_string($user_id));
mysql_query($query);

$query = sprintf("DELETE FROM h_crimes WHERE hood = '%s'",
	mysql_real_escape_string($user));
mysql_query($query);

$query = sprintf("DELETE FROM h_investigations WHERE cop= '%s'",
	mysql_real_escape_string($user));
mysql_query($query);

//create the user on your table
$query = sprintf("DELETE FROM h_users WHERE id = '%s'",
				$user_id);
			mysql_query($query);
//
?>