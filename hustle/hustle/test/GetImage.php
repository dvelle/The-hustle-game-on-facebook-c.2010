<?php 
require_once("connect.php");
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
require_once("OpenLogin.php");
require_once("ProfileCreator.php");

$mytone = $_POST['mytone'];

function reveal($val){
	$b = 0;
	
	if(is_numeric($val)){
		while ($b < $val){
			$b++;
		}
	} elseif(is_string($val)){
		$b = (int)$val;
	}
	return $b;
}
function url_filter($url){
	//$url = "http://www.12daysoffun.com/hustle/graphics/avatar/boy_eyes/4.png";
	$r = stripos($url, ".png");
	$r = $r - 2;
	$rest = substr($url, $r);
	
	$s = stripos($rest, "/");
	$s = $s + 1;
	$a = substr($rest, $s);
	
	$final = explode(".", $a);
	if(empty($final)){
		$num = "null";
	} else {
		$num = reveal($final[0]);
	}
	return $num;
}
function submission($file,$filename)
{		
	$fc = fopen($filename, "wb");
	fwrite($fc,$file);
	fclose($fc);
	return;
}	
$eyes = url_filter($_POST['myeyes']);
$brows = url_filter($_POST['mybrows']);
$face = url_filter($_POST['myface']);
$hair = url_filter($_POST['myhair']);
$hats = url_filter($_POST['myhat']);
$top = url_filter($_POST['mytops']);
$bottom = url_filter($_POST['mybottoms']);
$shoes = url_filter($_POST['myshoes']);
$mouth = url_filter($_POST['mymouth']);
$face_access = url_filter($_POST['myaccess']);
$wrist = url_filter($_POST['mywrist']);
$neck = url_filter($_POST['myneck']);
$purse = url_filter($_POST['mypurse']);

$m = $eyes.":".$brows.":".$face.":".$hair.":".$top.":".$bottom.":".$shoes.":".$mouth.":".$face_access.":".$wrist.":".$neck.":".$hats;


//echo $m;
//$variables = $mytone.",".$eyes.",".$brows.",".$face.",".$hair.",".$top.",".$bottom.",".$shoes.",".$mouth.",".$face_access.",".$wrist.",".$neck.",".$hats.",".$purse;

$today = date("Ymd_His"); 
//update 
//echo "Success!";

//Get current user id

$filename = $uid.'.png';

$avatar = $_SERVER['DOCUMENT_ROOT']."/12daysoffun/hustle/graphics/avatar/".$filename;

$somecontent = base64_decode($_REQUEST['png']);

if ($handle = fopen($avatar, 'w+'))
if (!fwrite($handle, $somecontent) === FALSE) 	
	fclose($handle);

//update database
$sql = sprintf("SELECT uid FROM h_users WHERE UPPER(user) = UPPER('%s')",
							   mysql_real_escape_string($user));
			$result = mysql_query($sql);
list($uid) = mysql_fetch_row($result);

$query = sprintf("UPDATE h_users SET avatar = '%s', avatar_settings = '%s' WHERE uid = ('%s')",
		mysql_real_escape_string($filename),
		$m,
		mysql_real_escape_string($uid));
mysql_query($query);

//Report
//$filename = $uid.".txt";
			
//submission($m,$filename);

//$sData = file_get_contents($filename);



?>
