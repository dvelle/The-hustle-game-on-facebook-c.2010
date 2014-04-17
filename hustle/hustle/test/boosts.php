<?
$user = $_REQUEST['data'];
//$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


//get user stats
$user_ID = id($user);

//blue magic
$units = getGoods("coke",$user_ID);

if(!empty($units)){
	//check if high over
	$max = getStat('epr',$user_ID);
	echo $max;
		if($max > 0){
			$downer = $max - 1;
			setStat("epr",$user_ID,$downer);			
		}
		$units = $units - 1;
		setGoods("coke",$user_ID,$units);
		$high = getStat("ep",$user_ID);
		$kite = $high + 3;
		setStat("ep",$user_ID,$kite);
}
//dvd


?>