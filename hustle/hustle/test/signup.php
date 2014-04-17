<?

$user = $_REQUEST['data'];

$decision = $_REQUEST['decision'];

$faction = $_REQUEST['faction'];


if($_POST['yes_x']){
	$user = $_POST['customer'];
	$faction = $_POST['faction'];
	$decision = "yes";
} else if($_POST['no_x']){
	$user = $_POST['customer'];
	$faction = $_POST['faction'];
	$decision = "no";
}

//$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

if($faction == "good"){//cops
	if($decision == "yes"){
		$query = sprintf("UPDATE h_users SET law = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ("cop"),
			mysql_real_escape_string ($user));
		mysql_query($query);
					
		$query = sprintf("UPDATE h_users SET morale = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string (20),
			mysql_real_escape_string ($user));
		mysql_query($query);
		//offer to become a Federal Agent or Dagger
		$sql_l = sprintf("UPDATE h_users SET agent = ('%s') WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string(4),
							mysql_real_escape_string($user));
							mysql_query($sql_l);
	} elseif($decision == "no"){
		//reset asker
		$ask = rand(9,50);
		$query = sprintf("UPDATE h_users SET morale = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($ask),
			mysql_real_escape_string ($user));
		mysql_query($query);
		//offer to become a Federal Agent or Dagger
		$sql_l = sprintf("UPDATE h_users SET agent = ('%s') WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string(4),
							mysql_real_escape_string($user));
							mysql_query($sql_l);
	}
}elseif($faction == "bad"){//robbers
	if($decision == "yes"){
		$query = sprintf("UPDATE h_users SET law = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ("criminal"),
			mysql_real_escape_string ($user));
		mysql_query($query);
		
		$query = sprintf("UPDATE h_users SET morale = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string (20),
			mysql_real_escape_string ($user));
		mysql_query($query);
	} elseif($decision == "no"){
		//rest asker
		$ask = rand(9,50);
		$query = sprintf("UPDATE h_users SET morale = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($ask),
			mysql_real_escape_string ($user));
		mysql_query($query);
	}
}
?>