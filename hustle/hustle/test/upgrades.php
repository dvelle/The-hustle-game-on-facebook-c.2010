<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
//$user = "jermongreen";
$order = $_POST['order'];

if(!empty($_POST['squirt'])){
	$item = $_POST['squirt'];
}elseif(!empty($_POST['rocks'])){
	$item = $_POST['rocks'];
}elseif(!empty($_POST['airr'])){
	$item = $_POST['airr'];
}elseif(!empty($_POST['knife'])){
	$item = $_POST['knife'];
}elseif(!empty($_POST['bat'])){
	$item = $_POST['bat'];
}elseif(!empty($_POST['crowb'])){
	$item = $_POST['crowb'];
}elseif(!empty($_POST['gun'])){
	$item = $_POST['gun'];
}elseif(!empty($_POST['arifle'])){
	$item = $_POST['arifle'];
}elseif(!empty($_POST['ak47'])){
	$item = $_POST['ak47'];
}elseif(!empty($_POST['super'])){
	$item = $_POST['super'];
}elseif(!empty($_POST['grenade'])){
	$item = $_POST['grenade'];
}elseif(!empty($_POST['sniper'])){
	$item = $_POST['sniper'];
}

//get user stats
$query = sprintf("SELECT * FROM h_users WHERE user = ('%s')",
		mysql_real_escape_string ($user));
$result = mysql_query($query);
$user_ar = mysql_fetch_assoc($result);
$user_ID = $user_ar["id"];

$cash = getStat('cash',$user_ID);
//$cash = 1000000;
//Inventory Stat Values
$query = sprintf("SELECT * FROM h_arsenal WHERE short_name = ('%s')",
		mysql_real_escape_string ($item));
$result = mysql_query($query);
$arsenal_ar = mysql_fetch_assoc($result);
$aid = $arsenal_ar["id"];
$price = $arsenal_ar["price"];
//echo $price."<br />";
//echo $aid;
//$invoice = $price * $order;

if ($_POST['buynow_x']) {
      // code to view record
	  //echo "Owned:"."100";
	  $discount = getGoods("media",$user_ID);
	  if($discount > 0){
		$discount =  $discount - 1;
		setGoods("media",$user_ID,$discount);
		$var = rand(1,2);
		$price = round($price/$var);
		//send message
		if($var == 2){
			$recipient_message = "Your <b>Bootleg DVD</b> saved you $".$price." on your ".ucwords($item)." purchase!";
			//
			hustle_reporter($user,1,$recipient_message,"recipient");
		} else {
			$recipient_message = "Your <b>Bootleg DVD</> was jacked the F** up, SUCKER! HaHa!";
			//
			hustle_reporter($user,1,$recipient_message,"recipient");
		}
	  }
	  $invoice = $price * $order;
	  if($cash < $invoice){
		  $currentq = getArsenal($item,$user_ID);
		  $return = $currentq;
	  }else{
		  //Debit Cash
		  $debit = $cash - $invoice;
		  setStat('cash',$user_ID,$debit);
		  //banks cutt
		  $bcash = getBCash();
		  $bdepot = $bcash + $invoice;
		  setBCash($bdepot);
		  //add to user inventory
		  $currentq = getArsenal($item,$user_ID);
		  
		  $newq = $currentq + $order;
		  SetArsenal($item,$user_ID,$newq);
		  $return = $newq;	  
	  }
} else if ($_POST['sell_x']) {
      // code to edit record
	  //echo "Owned:"."0";
	  //Credit Cash
	  $currentq = getArsenal($item,$user_ID);
	  $newq = $currentq - $order;
	  
	  if($currentq == 0 || $newq < 0){
		  $return = $currentq;
	  }else{
		  $rval = $arsenal_ar["resell_val"];
		  $earn = $rval * $order;
		  $credit = $earn + $cash;
		  setStat('cash',$user_ID,$credit);
		  //Bank Cutt
		  $bcash = getBCash();
		  $bdebit = $bcash - $earn;
		  setBCash($bdebit);
		  //subtract from user inventory
		  SetArsenal($item,$user_ID,$newq);
		  if($currentq == 1){
			$sql = sprintf("DELETE FROM `h_user_arsenal` WHERE `user_id` = ('%s') AND `arsenal_id` = ('%s')",
					mysql_real_escape_string ($user_ID),
					mysql_real_escape_string ($aid));
			mysql_query($sql);
		  }
		  $return = $newq;
	  }
}
$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string($user));
		$result = mysql_query($query);
list($chapter) = mysql_fetch_row($result);
if($chapter == 12){
	$chapter = $chapter + 1;
	$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($chapter),
		mysql_real_escape_string($user));
	mysql_query($query);
}
echo "Owned:".$return;
?>

 