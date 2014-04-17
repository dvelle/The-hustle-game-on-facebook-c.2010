<?php
require_once('connect.php');
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$uid = 10;
$posse = 1;
echo "Crew is ".$posse." deep!</br>";
//
function asset_atts($asset){
		$query = sprintf("SELECT cp_value FROM h_assets WHERE id = ('%s')",
						 $asset);
		$result = mysql_query($query);
		list($value) = mysql_fetch_row($result);
		return $value;
}
function property_assess($value,$asstot){
	$j = 0;
	while($j <= $posse){
		if($posse > $weaptot){
			$posse_left = $posse - $weaptot;
			$first_strength = $weaptot * $value;
			$w_strength = array($posse_left, $first_strength);
			return $w_strength;
		} else {
			$assets_left = $posse;
			$w_strength = $assets_left * $value;
			return $w_strength;
		}
		$j++;
	}
}
	
$query = sprintf("SELECT asset_id, quantity FROM h_user_assets WHERE user_id = ('%s')",
				 $uid);
$result = mysql_query($query);
$strength = array();
$tot_power = array();
$att = array();
$id = array();
$total = array();
while($assets_ar = mysql_fetch_assoc($result)){
	$asset = $assets_ar["asset_id"];
	$asset_tot = $assets_ar["quantity"];
	$asset_val = asset_atts($asset);
	if(isset($asset_val)){				 
	    array_push($id, $asset);
	    array_push($att, $asset_val);
	    array_push($total, $asset_tot);
	}
}
//most valued asset 
$amount = count($id);
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

	print_r($stack);
	echo $a_value."</br>";
	$scale = array_sum($stack);
	echo $scale;
			

?>