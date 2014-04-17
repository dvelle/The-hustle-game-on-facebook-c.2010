<?

$user = $_POST['customer'];
$frame = $_POST['bribery'];
//$user = "jermongreen";
//$frame = "A";
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
$userid = id($user);

$cash = getStat("cash",$userid);

if($frame == 33){
	$amount = $_POST['mybribe'];
	if($_POST['stop_x']){
		//do nothing
	} else {
		if($amount > $cash){
			echo 1;
		} else {
			$debit = $cash - $amount;
			setStat("cash",$userid,$debit);
			$query = sprintf("UPDATE h_user_assets SET jackpot = '%s' WHERE UPPER(user) = UPPER('%s') AND asset_id = (SELECT id FROM h_special_items WHERE name = ('%s'))",
						mysql_real_escape_string($amount),
						mysql_real_escape_string($user),
						mysql_real_escape_string("bribe"));
					mysql_query($query);
			echo 2;
		}
	}
} else {
	//
	if($_POST['accept_x']) {
		//check if have cash and car
		if($cash < 10000){
			echo 1;
		} else { 
			$car1 = getAEggs("Luxury Sports Car",$userid);
			$car2 = getAEggs("Custom Sports Car",$userid);
			$car3 = getAEggs("Premium Automobile",$userid);
			$bike = getAEggs("2020 Motorcycle",$userid);
			$car4 = getAEggs("Mom's Car",$userid);
			if(!empty($car1) || !empty($car2) || !empty($car3) || !empty($bike) || !empty($car4)){
				$debit = $cash - 10000;
				setStat("cash",$userid,$debit);
				$time = time();
				$count = $time + 600;
				$query = sprintf("INSERT INTO h_tourney(user,time_left) VALUES ('%s','%s')",
						mysql_real_escape_string($user),
						mysql_real_escape_string($count));
				mysql_query($query);
				
				echo 3;
			} else {
				//offer to borrow mom's car for tokens
				echo 4;
			}
		}	
	} elseif ($_POST['stop_x']) { 
		//
		$query = sprintf("SELECT races FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($user_name));
				$result = mysql_query($query);
		list($races) = mysql_fetch_row($result);
		
		$races = $races - 1;
		
		$query = sprintf("UPDATE h_users SET races = '%s' WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($races),
			mysql_real_escape_string($user));
		mysql_query($query);
		
		echo 5;
	}
}
//

?>
