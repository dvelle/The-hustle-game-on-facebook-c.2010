<?
$user = $_REQUEST['data'];
if(empty($_REQUEST['data'])){
	$user = $_POST['customer'];
	$leader = $_POST['brains'];
}

$up = $_REQUEST['choice'];

//$user = "jermongreen";
//$leader = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
if(!empty($leader)){
	//make sure leader exists
	$brain = str_replace (" ", "", $leader);
	$brain = strtolower($brain);
	$query = sprintf("SELECT COUNT(id) FROM h_bankjobs WHERE UPPER(brains) = UPPER('%s')",
									   mysql_real_escape_string($brain));
		$result = mysql_query($query);
	list($exist) = mysql_fetch_row($result);
	if(!empty($exist) && $brain != $user){
		$query = sprintf("INSERT INTO h_bankjobs(brains,user) VALUES ('%s','%s')",
					mysql_real_escape_string($brain),
					mysql_real_escape_string($user));
		mysql_query($query);
		//check number 
		$query = sprintf("SELECT COUNT(id) FROM h_bankjobs WHERE UPPER(brains) = UPPER('%s')",
										   mysql_real_escape_string($brain));
			$result = mysql_query($query);
		list($count) = mysql_fetch_row($result);
		if($count >= 6){
			$query = sprintf("SELECT * FROM h_bankjobs WHERE UPPER(brains) = UPPER('%s')",
											   mysql_real_escape_string($brain));
			$result = mysql_query($query);			
			//set up skill challenge
			while($row = mysql_fetch_array($result)){
				$heist_mem = $row['user'];
				$memid = id($heist_mem);
				$car1 = getAEggs("Luxury Sports Car",$userid);
				$car2 = getAEggs("Custom Sports Car",$memid);
				$car3 = getAEggs("Premium Automobile",$memid);
				$bike = getAEggs("2020 Motorcycle",$memid);
				$car4 = getAEggs("Mom's Car",$memid);
				if(!empty($car1) || !empty($car2) || !empty($car3) || !empty($bike) || !empty($car4)){
					break;
				} 
			}
			if(!empty($car1) || !empty($car2) || !empty($car3) || !empty($bike) || !empty($car4)){
				//proceed with heist
				$query = sprintf("SELECT * FROM h_bankjobs WHERE UPPER(brains) = UPPER('%s')",
											   mysql_real_escape_string($brain));
				$result = mysql_query($query);			
				//set up skill challenge
				while($row = mysql_fetch_array($result)){
					$heist_mem = $row['user'];
					$brains = $row['brains'];
					$query = sprintf("UPDATE h_users SET heist_alert = '%s' WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string(2),
						mysql_real_escape_string($heist_mem));
					mysql_query($query);
				}
				echo 3;// ready
			} else {
				//let brains know offer to borrow mom's car for tokens
				$query = sprintf("SELECT * FROM h_bankjobs WHERE UPPER(brains) = UPPER('%s')",
							mysql_real_escape_string ($brain));
				$result = mysql_query($query);
				while($team_arr = mysql_fetch_assoc($result)){
					$pim = $team_arr['user'];
					$recipient_message = "Ahh you need a Getaway CAR to rob a bank...get one in the cheat section or find one in the arcade, come back when you got one.";
						//
						hustle_reporter($pim,1,$recipient_message,"recipient");
						
						$query = sprintf("UPDATE h_users SET heist_alert = '%s' WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string(0),
							mysql_real_escape_string($pim));
						mysql_query($query);
				}							
				//delete everyone from bank job
				$query = sprintf("DELETE FROM h_bankjobs WHERE brains = ('%s')",
					mysql_real_escape_string($brain));
				mysql_query($query);
				
				echo 4;
			}
		} else {
			echo 2;//waiting
		}
	} else {
		echo 1;//try again
	}
} else {
	if($up == 12){
		$query = sprintf("DELETE FROM h_bankjobs WHERE UPPER(brains) = UPPER('%s')",
				mysql_real_escape_string($user));
			mysql_query($query);
	} else {
		$user_ID = id($user);
		$query = sprintf("SELECT COUNT(id) FROM h_bankjobs WHERE brains = '%s'",
									   mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($count) = mysql_fetch_row($result);
		
		if(empty($count)){
			$query = sprintf("INSERT INTO h_bankjobs(brains,user) VALUES ('%s','%s')",
				mysql_real_escape_string($user),
				mysql_real_escape_string($user));
			mysql_query($query);
			echo 1;
		} else {
			echo 2;
		}
	}
}
?>