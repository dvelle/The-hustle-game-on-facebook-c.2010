<?php
$user = $_REQUEST['data'];
//$user = "jermongreen";

include 'stats.php';
require_once 'connect.php';		// our database settings
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$query = sprintf("SELECT * FROM h_users WHERE user = ('%s')",
							mysql_real_escape_string ($user));
$result = mysql_query($query);
$user_ar = mysql_fetch_assoc($result);
$user_ID = $user_ar["id"]; 

$squirt = getArsenal("squirt",$user_ID);
if(empty($squirt)){
	$squirt = 0;
}
$rocks = getArsenal("rocks",$user_ID);
if(empty($rocks)){
	$rocks = 0;
}
$airr = getArsenal("airr",$user_ID);
if(empty($airr)){
	$airr = 0;
}
$knife = getArsenal("knife",$user_ID);
if(empty($knife)){
	$knife = 0;
}
$bat = getArsenal("bat",$user_ID);
if(empty($bat)){
	$bat = 0;
}
$crowb = getArsenal("crowb",$user_ID);
if(empty($crowb)){
	$crowb = 0;
}
$gun = getArsenal("gun",$user_ID);
if(empty($gun)){
	$gun = 0;
}
$arifle = getArsenal("arifle",$user_ID);
if(empty($arifle)){
	$arifle = 0;
}
$ak47 = getArsenal("ak47",$user_ID);
if(empty($ak47)){
	$ak47 = 0;
}
$super = getArsenal("super",$user_ID);
if(empty($super)){
	$super = 0;
}
$grenade = getArsenal("grenade",$user_ID);
if(empty($grenade)){
	$grenade = 0;
}
$sniper = getArsenal("sniper",$user_ID);
if(empty($sniper)){
	$sniper = 0;
}
$cool = getStat("exp",$user_ID);

//Weapon upkeep
$upkeep = upkeep($user_ID,0);
ledger($user,$upkeep);
//
//output
//
$poller = json_encode(array(
  "squirt" => $squirt,
  "rocks" => $rocks,
  "airr" => $airr,
  "knife" => $knife,
  "bat" => $bat,
  "crowb" => $crowb, 
  "gun" => $gun, 
  "arifle" => $arifle,
  "ak47" => $ak47,
  "lilgun" => $super,
  "grenade" => $grenade,
  "sniper" => $sniper,
  "upkeep" => $upkeep,
  "cool" => $cool,
));

echo $poller

?>