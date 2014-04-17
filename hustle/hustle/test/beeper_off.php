<?

if(!empty($_REQUEST['data'])){
	$user = $_REQUEST['data'];
} else {
	$user = $_POST['name'];
}

//$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$query = sprintf("UPDATE h_user_news SET checked = ('%s') WHERE UPPER(receiver) = UPPER('%s')",
		mysql_real_escape_string (2),
		mysql_real_escape_string ($user));
mysql_query($query);

?>