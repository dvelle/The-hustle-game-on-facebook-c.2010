<?
$user = $_REQUEST['name'];
//$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//

$sql = sprintf("DELETE FROM h_user_news WHERE UPPER(receiver) = UPPER('%s')",
		mysql_real_escape_string ($user));
mysql_query($sql);
echo $user." News Deleted.";

?>