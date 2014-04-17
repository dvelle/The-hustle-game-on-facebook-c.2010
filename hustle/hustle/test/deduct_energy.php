<?
$user = $_REQUEST['data'];
$tcode = $_REQUEST['deduct'];

//$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$sql = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
		$results = mysql_query($sql);
		list($user_id) = mysql_fetch_row($results);						 

$cur = getStat("ep",$user_id);
if($tcode == 1 || $tcode == 2){
	$reduce = $cur - 3;
	if($reduce < 0){
		echo 1;
	}else{
		setStat("ep",$user_id,$reduce);
	}
}elseif($tcode == 3){ 
	$reduce = $cur - 5;
	if($reduce < 0){
		echo 1;
	}else{
		setStat("ep",$user_id,$reduce);
	}
}elseif($tcode == 4){ 
	$reduce = $cur - 5;
	if($reduce < 0){
		echo 1;
	}else{
		setStat("ep",$user_id,$reduce);
	}
}


?>