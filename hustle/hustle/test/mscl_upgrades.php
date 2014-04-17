<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
//$user = "jermongreen";
$order = $_POST['order'];


if(!empty($_POST['sguard'])){
	$item = $_POST['sguard'];
}elseif(!empty($_POST['mutt'])){
	$item = $_POST['mutt'];
}elseif(!empty($_POST['thug'])){
	$item = $_POST['thug'];
}elseif(!empty($_POST['bguard'])){
	$item = $_POST['bguard'];
}elseif(!empty($_POST['g4hire'])){
	$item = $_POST['g4hire'];
}elseif(!empty($_POST['special'])){
	$item = $_POST['special'];
}elseif(!empty($_POST['para'])){
	$item = $_POST['para'];
}elseif(!empty($_POST['bhunt'])){
	$item = $_POST['bhunt'];
}elseif(!empty($_POST['hitman'])){
	$item = $_POST['hitman'];
}elseif(!empty($_POST['merc'])){
	$item = $_POST['merc'];
}elseif(!empty($_POST['war'])){
	$item = $_POST['war'];
}elseif(!empty($_POST['ninja'])){
	$item = $_POST['ninja'];
}elseif(!empty($_POST['army'])){
	$item = $_POST['army'];
}

//get user stats
$query = sprintf("SELECT id FROM h_users WHERE user = ('%s')",
		mysql_real_escape_string ($user));
$result = mysql_query($query);
list($user_ID) = mysql_fetch_row($result);

$cash = getStat('cash',$user_ID);


//Inventory Stat Values
$query = sprintf("SELECT * FROM h_muscle WHERE short_name = ('%s') or name =('%s')",
		mysql_real_escape_string ($item),
		mysql_real_escape_string ($item));
$result = mysql_query($query);
$muscle_ar = mysql_fetch_assoc($result);
$a_id = $muscle_ar["id"];
$price = $muscle_ar["price"];
$hbx = $muscle_ar["health"];

$booster = $hbx * $order;

if ($_POST['buynow_x']) {
	  $discount = getGoods("media",$user_ID);
	  if($discount > 0){
		$discount =  $discount - 1;
		setGoods("media",$user_ID,$discount);
		$var = rand(1,2);
		$price = round($price/$var);
		//send message
		if($var == 2){
			$recipient_message = "Your <b>Bootleg DVD</b> saved you $".$price." on your ".ucwords($item)." new hire!";
			//
			hustle_reporter($user,1,$recipient_message,"recipient");
		} else {
			$recipient_message = "Your <b>Bootleg DVD</> was jacked the F** up, SUCKER! HaHa!";
			//
			hustle_reporter($user,1,$recipient_message,"recipient");
		}
	  }
	  $invoice = $price * $order;
      // code to view record
	  //echo "Owned:"."100";
	  if($cash < $invoice){
		  $currentq = getMuscle($item,$user_ID);
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
		  $currentq = getMuscle($item,$user_ID);
		  $newq = $currentq + $order;
		  setMuscle($item,$user_ID,$newq);
		  $return = $newq;
		  //health
		  $cure = getShield($user_ID);
		  $upg = $cure + $booster;
		  setShield($user_ID,$upg);
	  }
} else if ($_POST['sell_x']) {
      // code to edit record
	  //health
	  $cure = getShield($user_ID);
	  $deg = $cure - $booster;
	  setShield($user_ID,$deg);
	  //Credit Cash
	  $currentq = getMuscle($item,$user_ID);
	  $newq = $currentq - $order;
	  if($currentq == 0 || $newq < 0){
		  $return = $currentq;
	  }else{
		  $rval = $muscle_ar["resell_val"];
		  $earn = $rval * $order;
		  $credit = $earn + $cash;
		  setStat('cash',$user_ID,$credit);
		  //subtract from user inventory
		  setMuscle($item,$user_ID,$newq);
		  if($currentq == 1){
				$sql = sprintf("DELETE FROM h_user_arsenal WHERE user_id = ('%s') AND arsenal_id = ('%s')",
						mysql_real_escape_string ($user_ID),
						mysql_real_escape_string ($a_id));
				mysql_query($sql);
		  }
		  $return = $newq;
	  }
}

echo "Retained:".$return;
?>

 