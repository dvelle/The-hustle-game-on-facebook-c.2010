<?php
//$user = $_REQUEST['data'];
$user = "jermongreen";

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


$sappq = getAssets("sapp",$user_ID);
if(empty($sappq)){
	$sappq = 0;
}
$hq = getAssets("house",$user_ID);
if(empty($hq)){
	$hq = 0;
}
$luxq = getAssets("luxury",$user_ID);
if(empty($luxq)){
	$luxq = 0;
}
$hotelq = getAssets("hotel",$user_ID);
if(empty($hotelq)){
	$hotelq = 0;
}
$topq = getAssets("topfloor",$user_ID);
if(empty($topq)){
	$topq = 0;
}
$bigq = getAssets("bighouse",$user_ID);
if(empty($bigq)){
	$bigq = 0;
}
$plantq = getAssets("plantation",$user_ID);
if(empty($plantq)){
	$plantq = 0;
}
$estateq = getAssets("estate",$user_ID);
if(empty($estateq)){
	$estateq = 0;
}
$castleq = getAssets("castle",$user_ID);
if(empty($castleq)){
	$castleq = 0;
}
$islandq = getAssets("island",$user_ID);
if(empty($islandq)){
	$islandq = 0;
}
$cool = getStat("exp",$user_ID);

//
//assett upkeep
function tenant($uid,$bank){
	$query = sprintf("SELECT asset_id, quantity FROM h_user_assets WHERE user_id = ('%s')",
				 $uid);
	$result = mysql_query($query);
	$tot_power = array();
	$att = array();
	$id = array();
	$total = array();
	while($assets_ar = mysql_fetch_assoc($result)){
		$asset = $assets_ar["asset_id"];
		$asset_tot = $assets_ar["quantity"];
		$asset_val = asset_rent($asset);
		if(isset($asset_val)){				 
			array_push($id, $asset);
			array_push($att, $asset_val);
			array_push($total, $asset_tot);
		}
	}
	//most valued asset 
	$amount = count($id);
	if($bank == 1){
		return $amount;
	}
	//
	$stack = array();
	while($i < $amount){
		$value = max($att);
		$key = array_search($value, $att);
		$a_value = $total[$key] * $value;
		array_push($stack, $a_value);
		unset($att[$key]);	
		$i++;
	}
	$scale = array_sum($stack);
	return $scale;
}

$upkeep = tenant($user_ID,0);
ledger($user,$upkeep);
//
//output
//
$poller = json_encode(array(
  "sap" => $sappq,
  "h" => $hq,
  "lux" => $luxq,
  "hot" => $hotelq,
  "top" => $topq,
  "bigq" => $bigq, 
  "plant" => $plantq, 
  "state" => $estateq,
  "castle" => $castleq,
  "isle" => $islandq,
  "upkeep" => $upkeep,
  "cool" => $cool,
));

echo $poller

?>