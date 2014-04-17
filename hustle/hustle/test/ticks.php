<?php
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$sell = $_POST['quantity'];
$biz_id = $_POST['bid'];
$user = $_POST['who'];
//$user = "jermongreen";
if($sell == 0){
	//
} else {
	$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($patron_id) = mysql_fetch_row($result);
	$sql = sprintf("SELECT value FROM h_user_investments WHERE biz_id = ('%s') AND user_id = ('%s')",
								mysql_real_escape_string($biz_id),
								mysql_real_escape_string($patron_id));
		$results = mysql_query($sql);
	list($value) = mysql_fetch_row($results);
	if($value == 0){
		$value = 1;
	} 
	$portfolio = getPortfolio($biz_id,$patron_id);	
	
	if($portfolio > $sell){
		//
		$debit = $portfolio - $sell;
		setPortfolio($biz_id,$patron_id,$debit);
		$payout = $sell/$value;	
		$pocket = getStat("cash",$patron_id);
		$deposit = $pocket + $payout;
		setStat("cash",$patron_id,$deposit);
	} else {
		//sold all
		$pocket = getStat("cash",$patron_id);
		$deposit = $pocket + $value;
		setStat("cash",$patron_id,$deposit);
		$sql = sprintf("DELETE FROM h_user_investments WHERE user_id = ('%s') AND biz_id = ('%s')",
						mysql_real_escape_string ($patron_id),
						mysql_real_escape_string ($biz_id));
					mysql_query($sql);
	}
	echo "Success";
}								   
?>