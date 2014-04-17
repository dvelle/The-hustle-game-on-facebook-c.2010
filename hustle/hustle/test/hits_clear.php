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
//Retrieve Instigator User ID
$query = sprintf("SELECT id FROM h_users WHERE user = ('%s')",
		mysql_real_escape_string ($user));
$result = mysql_query($query);			
list($i_userID) = mysql_fetch_row($result);

//Get all the heists
$sql = sprintf("DELETE FROM h_heists WHERE UPPER(culprit) = UPPER('%s')",
		mysql_real_escape_string ($i_userID));
mysql_query($sql);

echo $user." Evidence Deleted.";

?>