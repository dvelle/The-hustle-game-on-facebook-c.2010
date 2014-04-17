<?
$user = $_POST['customer'];
//$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$userID = id($user);
//get user stats
if ($_POST['turkey_x']) {
	//delete blue magic
	$sql = sprintf("DELETE FROM h_user_assets WHERE asset_id = ('%s') AND user_id = ('%s')",
						mysql_real_escape_string (51),
						mysql_real_escape_string ($userID));
					mysql_query($sql);
	setStat("ep_rem",$userID,2);				
}else if ($_POST['rehab_x']) {
	echo 1;
}
?>