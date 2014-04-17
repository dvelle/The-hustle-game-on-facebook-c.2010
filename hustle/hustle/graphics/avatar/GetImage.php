<?php 
require_once("../../test/connect.php");
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
require_once("../../test/OpenLogin.php");
require_once("../../test/ProfileCreator.php");


$mytone = $_GET['mytone']; 
$myeyes = $_GET['myeyes']; 
$mybrows = $_GET['mybrows']; 
$myface = $_GET['myface']; 
$myhair = $_GET['myhair']; 
$myhats = $_GET['myhat'];
$mymouth = $_GET['mymouth']; 
$mytops = $_GET['mytops']; 
$mybottoms = $_GET['mybottoms']; 
$myshoes = $_GET['myshoes']; 
$myaccess = $_GET['myaccess'];
$myneck = $_GET['myneck']; 
$mywrist = $_GET['mywrist']; 

function url_filter($url){
	//$test = "http://www.12daysoffun.com/hustle/graphics/avatar/boy_eyes/4.png";
	$r = stripos($url, ".png");
	$r = $r - 2;
	$rest = substr($url, $r);
	
	$s = stripos($rest, "/");
	$s = $s + 1;
	$a = substr($rest, $s);
	
	$final = explode(".", $a);
	return $final[0];
}

$eyes = url_filter($myeyes);
$brows = url_filter($mybrows);
$face = url_filter($myface);
$hair = url_filter($myhair);
$hats = url_filter($myhats);
$top = url_filter($mytops);
$bottom = url_filter($mybottoms);
$shoes = url_filter($myshoes);
$mouth = url_filter($mymouth);
$face_access = url_filter($myaccess);
$wrist = url_filter($mywrist);
$neck = url_filter($myneck);
$purse = url_filter($mypurse);

//echo "tone=".$mytone."\n"."eye=".$eyes."\n"."brows=".$brows."\n"."face=".$face."\n"."hair=".$hair."\n"."top=".$top."\n"."bottom=".$bottom."\n"."shoes=".$shoes."\n"."mouth=".$mouth."\n"."face accessories=".$face_access."\n"."wrist=".$wrist."\n"."neck=".$neck."\n"."hat=".$hats;

$variables = $mytone."\n".$eyes."\n".$brows."\n".$face."\n".$hair."\n".$top."\n".$bottom."\n".$shoes."\n".$mouth."\n".$face_access."\n".$wrist."\n".$neck."\n".$hats."\n".$purse;

$today = date("Ymd_His"); 

//$filename = $today.rand(0,5000).'_img.png';

//Get current user id
$sql = sprintf("SELECT uid FROM h_users WHERE UPPER(user) = UPPER('%s')",
								   mysql_real_escape_string($user));
					$result = mysql_query($sql);
list($uid) = mysql_fetch_row($result);

$filename = $uid.'.png';

$avatar = $_SERVER['DOCUMENT_ROOT']."/12daysoffun/hustle/graphics/avatar/".$filename;

$somecontent = base64_decode($_REQUEST['png']);

if ($handle = fopen($avatar, 'w+'))
if (!fwrite($handle, $somecontent) === FALSE) 	
	fclose($handle);

//update database
$query = sprintf("UPDATE h_users SET avatar = '%s' WHERE user_id = ('%s')",
		mysql_real_escape_string($filename),
		mysql_real_escape_string($uid));
$result = mysql_query($query);

$query = sprintf("UPDATE h_users SET avatar_settings = '%s' WHERE user_id = ('%s')",
		mysql_real_escape_string(9),
		mysql_real_escape_string($uid));
$result = mysql_query($query);
//update 
//echo "Success!";
//echo "result=true";
?>
