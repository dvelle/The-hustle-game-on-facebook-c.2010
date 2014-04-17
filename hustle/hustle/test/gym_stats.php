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

$sguard = getMuscle("sguard",$user_ID);
if(empty($sguard)){
	$sguard = 0;
}
$mutt = getMuscle("mutt",$user_ID);
if(empty($mutt)){
	$mutt = 0;
}
$thug = getMuscle("thug",$user_ID);
if(empty($thug)){
	$thug = 0;
}
$bguard = getMuscle("bguard",$user_ID);
if(empty($bguard)){
	$bguard = 0;
}
$g4hire = getMuscle("g4hire",$user_ID);
if(empty($g4hire)){
	$g4hire = 0;
}
$special = getMuscle("special",$user_ID);
if(empty($special)){
	$special = 0;
}
$para = getMuscle("para",$user_ID);
if(empty($para)){
	$para = 0;
}
$bhunt = getMuscle("bhunt",$user_ID);
if(empty($bhunt)){
	$bhunt = 0;
}
$hitman = getMuscle("hitman",$user_ID);
if(empty($hitman)){
	$hitman = 0;
}
$merc = getMuscle("merc",$user_ID);
if(empty($merc)){
	$merc = 0;
}
$war = getMuscle("war",$user_ID);
if(empty($war)){
	$war = 0;
}
$ninja = getMuscle("ninja",$user_ID);
if(empty($ninja)){
	$ninja = 0;
}
$army = getMuscle("army",$user_ID);
if(empty($army)){
	$army = 0;
}
$cool = getStat("exp",$user_ID);

//Weapon upkeep
$upkeep = salaries($user_ID,0);
ledger($user,$upkeep);
//
//output
//
$poller = json_encode(array(
  "sguard" => $sguard,
  "mutt" => $mutt,
  "thug" => $thug,
  "bguard" => $bguard,
  "g4hire" => $g4hire,
  "special" => $special, 
  "para" => $para, 
  "bhunt" => $bhunt,
  "hitman" => $hitman,
  "merc" => $merc,
  "war" => $war,
  "nina" => $ninja,
  "army" => $army,
  "upkeep" => $upkeep,
  "cool" => $cool,
));

echo $poller

?>