<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
$crewname = $_POST['crew_name'];
$who = $_POST['my_name'];
$flag = $_POST['flag'];

$name = str_replace (" ", "", $crewname);

$citizen = str_replace (" ", "", $who);

$query = sprintf("SELECT COUNT(id) FROM h_crew_main WHERE UPPER(title) = UPPER('%s')",
				mysql_real_escape_string($name));
			$result = mysql_query($query);			
			list($count) = mysql_fetch_row($result);
			
$query = sprintf("SELECT COUNT(id) FROM h_users WHERE UPPER(game_name) = UPPER('%s')",
				mysql_real_escape_string($citizen));
			$result = mysql_query($query);			
			list($taken) = mysql_fetch_row($result);
			
			if($count >= 1) {
				echo 1;				
			} else {
				if($taken >= 1) {
					echo 2;
				} else {
					if(empty($flag)){
						echo 4;
					} else {
						$query = sprintf("UPDATE h_crew_main SET title = '%s' WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($crewname),
							mysql_real_escape_string($user));
						mysql_query($query);
						$query = sprintf("UPDATE h_crew_main SET mem_image = '%s' WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($flag),
							mysql_real_escape_string($user));
						mysql_query($query);
						$query = sprintf("UPDATE h_top_crew SET crew_name = '%s' WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($crewname),
							mysql_real_escape_string($user));
						mysql_query($query);
						$query = sprintf("UPDATE h_users SET game_name = '%s' WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($who),
							mysql_real_escape_string($user));
						mysql_query($query);
						echo 3;
					}
				}
			}			
?>

 