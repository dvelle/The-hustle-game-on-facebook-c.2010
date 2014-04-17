<?

$user = $_POST['customer'];
$race = $_POST['radio'];
//$user = "jermongreen";
//$race = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
$userid = id($user);
//
if($race == 1){
	$fee = 50;
	$limit = 840;
	$legs = 3;
} elseif($race == 2){
	$fee = 100;
	$limit = 720;
	$legs = 4;
} elseif($race == 3){
	$fee = 200;
	$limit = 600;
	$legs = 5;
} elseif($race == 4){
	$fee = 350;
	$limit = 540;
	$legs = 6;
} elseif($race == 5){
	$fee = 500;
	$limit = 300;
	$legs = 7;
}

$cash = getStat("cash",$userid);
$debit = $cash - $fee;
if($debit < 0){
	echo 1;//broke
} else {
	//check energy
	$e = getStat("ep",$userid);
	$down = $e - 3;
	if($down < 0){
		echo 2;//tired
	} else {
		$car1 = getAEggs("Luxury Sports Car",$userid);
		$car2 = getAEggs("Custom Sports Car",$userid);
		$car3 = getAEggs("Premium Automobile",$userid);
		$bike = getAEggs("2020 Motorcycle",$userid);
		$car4 = getAEggs("Mom's Car",$userid);
		if(!empty($car1) || !empty($car2) || !empty($car3) || !empty($bike) || !empty($car4)){
					setStat("cash",$userid,$debit);
					//banks cutt
					  $bcash = getBCash();
					  $bdepot = $bcash + $fee;
					  setBCash($bdepot);
					// 
					setStat("ep",$userid,$down);
					$time = time();
					$count = $time + $limit;
					$query = sprintf("INSERT INTO h_tourney(user,time_left) VALUES ('%s','%s')",
							mysql_real_escape_string($user),
							mysql_real_escape_string($count));
					mysql_query($query);
					
					$sql = sprintf("UPDATE h_users SET chopshop = '%s' WHERE user = ('%s')",
								mysql_real_escape_string($legs),
								mysql_real_escape_string($user));
					mysql_query($sql);
					
					echo 4;
		} else {
			//offer to borrow mom's car for tokens
			echo 3;
		}
	}	
}
//

?>
