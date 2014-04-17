<?php 
require_once("connect.php");
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
require_once("OpenLogin.php");
require_once("ProfileCreator.php");

//Get current user id

$filename = $uid.'.png';

$avatar = $_SERVER['DOCUMENT_ROOT']."/12daysoffun/hustle/graphics/avatar/".$filename;

$somecontent = base64_decode($_REQUEST['png']);

if ($handle = fopen($avatar, 'w+'))
if (!fwrite($handle, $somecontent) === FALSE) 	
	fclose($handle);
	
echo "result=success";
?>
