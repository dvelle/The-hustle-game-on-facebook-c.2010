<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
//$user = "jermongreen";

$sql = sprintf("UPDATE h_users SET terms_on = ('%s') WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string (2),
							mysql_real_escape_string ($user));
					mysql_query($sql);
		
?>

 