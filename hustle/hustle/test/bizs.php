<?php
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$rate = $_POST['door'];
$biz_id = $_POST['bid'];
$worth = $_POST['worth'];
$user = $_POST['who'];
$test = $_POST['sell'];

//$user = "jermongreen";


if($test>0){
	$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($user_ID) = mysql_fetch_row($result);
	//sell property
	$pocket = getStat("cash",$user_ID);
	$deposit = $pocket + $worth;
	setStat("cash",$user_ID,$deposit);
	$sql = sprintf("DELETE FROM h_user_assets WHERE id = ('%s')",
						mysql_real_escape_string ($biz_id));
					mysql_query($sql);
	//alert all stock owners
	$sql = sprintf("SELECT * FROM h_user_investments WHERE biz_id = ('%s')",
							mysql_real_escape_string($biz_id));
	$results = mysql_query($sql);
	while($dividend = mysql_fetch_assoc($results)){
		$query = sprintf("SELECT user FROM h_users WHERE user_id = ('%s')",
		mysql_real_escape_string($ownerid));
			$result = mysql_query($query);
		list($owner) = mysql_fetch_row($result);
		$recipient_message = "Business ".$biz_id." was just sold, within the next hour your stocks in this business will all be worthless";
						//
		hustle_reporter($owner,1,$recipient_message,"recipient");
	}
} else {
	$sql = sprintf("UPDATE h_user_assets SET fee = ('%s') WHERE id = ('%s')",
							mysql_real_escape_string($rate),
							mysql_real_escape_string($biz_id));
							mysql_query($sql);
							
	echo "Changes Posted.";	
}							

?>