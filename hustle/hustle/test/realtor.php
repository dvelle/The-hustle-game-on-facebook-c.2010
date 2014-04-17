<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
//$user = "jermongreen";
$order = $_POST['order'];
//$order = 1;
//function
			

if(!empty($_POST['sapp'])){
	$item = $_POST['sapp'];
}elseif(!empty($_POST['house'])){
	$item = $_POST['house'];
}elseif(!empty($_POST['luxury'])){
	$item = $_POST['luxury'];
}elseif(!empty($_POST['hotel'])){
	$item = $_POST['hotel'];
}elseif(!empty($_POST['topfloor'])){
	$item = $_POST['topfloor'];
}elseif(!empty($_POST['bighouse'])){
	$item = $_POST['bighouse'];
}elseif(!empty($_POST['plantation'])){
	$item = $_POST['plantation'];
}elseif(!empty($_POST['estate'])){
	$item = $_POST['estate'];
}elseif(!empty($_POST['castle'])){
	$item = $_POST['castle'];
}elseif(!empty($_POST['island'])){
	$item = $_POST['island'];
}
//$item = "plantation";
//get user stats
$query = sprintf("SELECT * FROM h_users WHERE user = ('%s')",
		mysql_real_escape_string ($user));
$result = mysql_query($query);
list($user_ID) = mysql_fetch_row($result);

$cash = getStat('cash',$user_ID);
//$cash = 100000000;

//Inventory Stat Values
$query = sprintf("SELECT * FROM h_assets WHERE short_name = ('%s') OR name = '%s'",
		mysql_real_escape_string ($item),
		mysql_real_escape_string ($item));
$result = mysql_query($query);
$asset_ar = mysql_fetch_assoc($result);
$aid = $asset_ar["id"];
$price = $asset_ar["price"];

$invoice = $price * $order;

if ($_POST['buynow_x']) {
      // code to view record
	  //echo "Owned:"."100";
	  if($cash < $invoice){
		  $currentq = getAssets($item,$user_ID);
		  $return = $currentq;
	  }else{
		  //Debit Cash
		  $debit = $cash - $invoice;
		  setStat('cash',$user_ID,$debit);
		  //
		  $bcash = getBCash();
		  $bdepot = $bcash + $invoice;
		  setBCash($bdepot);
		  //add to user inventory
		  $currentq = getAssets($item,$user_ID);
		  $newq = $currentq + $order;
		  setAssets($item,$user_ID,$newq);
		  $return = $newq;
		  //add cool points to user
		  $coolman = getStat("exp",$user_ID);
		  //
		  $value = cp_val($item);
		  $boost = $coolman + $value;
		  setStat("exp",$user_ID,$boost);
	  }
} else if ($_POST['sell_x']) {
      // code to edit record
	  //echo "Owned:"."0";
	  //Credit Cash
	  $currentq = getAssets($item,$user_ID);
	  $newq = $currentq - $order;
	  if($currentq == 0 || $newq < 0){
		  $return = $currentq;
	  }else{
		  $rval = $asset_ar["resell_val"];
		  $earn = $rval * $order;
		  $credit = $earn + $cash;
		  setStat('cash',$user_ID,$credit);
		  //
		  $bcash = getBCash();
		  $bdepot = $bcash - $earn;
		  setBCash($bdepot);
		  //subtract from user inventory
		  setAssets($item,$user_ID,$newq);
		  $return = $newq;
		  //
		  //add cool points to user
		  $coolman = getStat("exp",$user_ID);
		  //
		  $value = cp_val($item);
		  $boost = $coolman - $value;
		  setStat("exp",$user_ID,$boost);
		  //
		  if($currentq == 1){
				$sql = sprintf("DELETE FROM h_user_assets WHERE user_id = ('%s') AND asset_id = ('%s')",
						mysql_real_escape_string ($user_ID),
						mysql_real_escape_string ($aid));
				mysql_query($sql);
		  }
	  }
}

echo "Owned:".$return;
?>

 