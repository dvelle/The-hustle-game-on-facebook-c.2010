<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
$deed_id = $_POST['deed_id'];
//$user = "jermongreen";
//$_POST['option'] = "Mom's Car";
$user_ID = id($user);

$cash = getStat('cash',$user_ID);

$query = sprintf("SELECT price FROM h_properties WHERE id = ('%s')",
								mysql_real_escape_string($deed_id));
$result = mysql_query($query);
list($price) = mysql_fetch_row($result);

if($_POST['accept_x']){
	if($cash < $price){
		echo 1;
	} else {
		$debit = $cash - $price;
		setStat('cash',$user_ID,$debit);
		//add property to
		$bcash = getBCash();
	 	$bdepot = $bcash + $price;
	    setBCash($bdepot);
		$query = sprintf("UPDATE h_properties SET owner = '%s' WHERE id = ('%s')",
			mysql_real_escape_string($user),
			mysql_real_escape_string($deed_id));
		$result = mysql_query($query);
		echo 2;
	}
}
?>

 