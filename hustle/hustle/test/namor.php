<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
$who = $_POST['crew_name'];
	
$bigwho = str_replace (" ", "", $who);
$crew = strtolower($bigwho);

$query = sprintf("SELECT COUNT(id) FROM h_crew_main WHERE UPPER(title) = UPPER('%s')",
				mysql_real_escape_string($crew));
			$result = mysql_query($query);			
			list($count) = mysql_fetch_row($result);			
			if($count >= 1) {
				echo 1;
			} else {
				$query = sprintf("UPDATE h_crew_main SET title = '%s' WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($who),
					mysql_real_escape_string($user));
				$result = mysql_query($query);
				$query = sprintf("UPDATE h_top_crew SET crew_name = '%s' WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($who),
					mysql_real_escape_string($user));
				$result = mysql_query($query);
				echo 2;
			}
?>

 