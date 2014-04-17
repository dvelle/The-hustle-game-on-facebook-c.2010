<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['leader'];

if(!empty($_POST['sleep'])){
	$action = "no";
}elseif(!empty($_POST['rdie'])){
	$action = "yes";
}

//update sleep/
	$query = sprintf("UPDATE h_crew_main SET intimidate = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string ($action),
						mysql_real_escape_string ($user));
					$result = mysql_query($query);
echo "Settings Saved";
?>
 