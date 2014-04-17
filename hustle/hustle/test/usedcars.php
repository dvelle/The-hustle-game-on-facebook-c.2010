<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
//$user = "jermongreen";
$order = $_POST['option'];

if($order == 1){
	$price = 1000;
	$cp = 0;
	$item = "Mom's Car";
}elseif($order == 2){
	$price = 34000;
	$cp = 3400;
	$item = "Custom Sports Car";
}elseif($order == 3){
	$price = 12000;
	$cp = 1200;
	$item = "Premium Automobile";
}elseif($order == 4){
	$price = 50000;
	$cp = 5000;
	$item = "Luxury Sports Car";
}elseif($order == 5){
	$price = 10000;
	$cp = 1000;
	$item = "2020 Motorcycle";
}

//get user stats
$user_ID = id($user);

$cash = getStat('cash',$user_ID);
//$cash = 1000000;

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
$cash = getStat("cash",$user_ID);
$invoice = $cash - $price; 
if($invoice < 0){
  echo 1;
}else{
  //Debit Cash
  setStat('cash',$user_ID,$invoice);
  //banks cutt
  $bcash = getBCash();
  $bdepot = $bcash + $invoice;
  setBCash($bdepot);
  //add to user inventory
  $count = getAEggs($item,$user_ID);
  $count = $count + 1;
  setAEggs($item,$user_ID,$count);
  //boost cool
  $cool = getStat("exp",$user_ID);
  $up = $cool + $cp;
  setStat("exp",$user_ID,$up);
  echo 2;	  
}
?>

 