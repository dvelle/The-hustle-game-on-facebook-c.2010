<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
	
$user = $_POST['customer'];
//$user = "jermongreen";
$who = $_POST['crook_name'];
$bigwho = str_replace (" ", "", $who);
$crook = strtolower($bigwho);

$query = sprintf("SELECT user FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string ($crook));
	$result = mysql_query($query);
list($user) = mysql_fetch_row($result);

$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string ($user));
	$result = mysql_query($query);
list($user_ID) = mysql_fetch_row($result);
$cur = getStat("exp",$user_ID);
//check if matches name on h_investigation
$query = sprintf("SELECT COUNT(dvd_sold) FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string ($crook));
	$result = mysql_query($query);
list($dvd) = mysql_fetch_row($result);

$query = sprintf("SELECT COUNT(magic_sold) FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string ($crook));
	$result = mysql_query($query);
list($coke) = mysql_fetch_row($result);

$query = sprintf("SELECT COUNT(lotto_sold) FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string ($crook));
	$result = mysql_query($query);
list($lotto) = mysql_fetch_row($result);

$query = sprintf("SELECT COUNT(roids_sold) FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string ($crook));
	$result = mysql_query($query);
list($roids) = mysql_fetch_row($result);


if($dvd > 0 || $coke > 0 || $lotto > 0 || $roids > 0){
	//add to rap sheets
	$query = sprintf("SELECT COUNT(id) FROM h_rap_sheet WHERE UPPER(hood) = UPPER('%s')",
			mysql_real_escape_string ($crook));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if($count > 0){
		$query = sprintf("SELECT record FROM h_rap_sheet WHERE UPPER(hood) = UPPER('%s')",
				mysql_real_escape_string ($crook));
		$result = mysql_query($query);
		list($record) = mysql_fetch_row($result);
		$record = $record + 1;
		$sql = sprintf("UPDATE h_rap_sheet SET record = ('%s') WHERE UPPER(hood) = UPPER('%s')",
								mysql_real_escape_string ($record),
								mysql_real_escape_string ($crook));
						mysql_query($sql);
		echo 2;				
	} else {
		$record = 1;
		$rank_score = $dvd + $coke + $lotto;
		$query = sprintf("INSERT INTO h_rap_sheet(record,hood,cop,rank_score) VALUES ('%s','%s','%s','%s')",
		mysql_real_escape_string($record),
		mysql_real_escape_string($crook),
		mysql_real_escape_string($user),
		mysql_real_escape_string($rank_score));
		mysql_query($query);
		//
		$query = sprintf("SELECT patrol_count FROM h_investigations WHERE UPPER(cop) = UPPER('%s')",
		mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($counted) = mysql_fetch_row($result);
		
		$counted = $counted + 1;
		
		$query = sprintf("UPDATE h_investigations SET patrol_count = ('%s') WHERE UPPER(cop) = UPPER('%s')",
			mysql_real_escape_string ($counted),
			mysql_real_escape_string ($user));
		mysql_query($query);
		//
		$query = sprintf("SELECT patrol_count FROM h_investigations WHERE UPPER(cop) = UPPER('%s')",
		mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($counted) = mysql_fetch_row($result);
		
		if($counted >= 5){
			$query = sprintf("DELETE FROM h_investigations WHERE UPPER(cop) = UPPER('%s') AND patrol > 0",
			mysql_real_escape_string ($user));
			mysql_query($query);
			
			
			$stack = array();
			//total crimes and award as cp bonus * 10
			$query = sprintf("SELECT * FROM h_rap_sheet WHERE UPPER(cop) = UPPER('%s')",
			mysql_real_escape_string ($user));
			$result = mysql_query($query);
			while($case_arr = mysql_fetch_assoc($result)){
				$records = $case_arr["record"];
				$rank_s = $case_arr["rank_score"];
				$rank = $case_arr["rank"];
				$caseid = $case_arr["id"];
				$sum = $records + $rank_s;
				$divide = $sum/$rank;
				array_push($stack,$divide);
				$sql = sprintf("UPDATE h_rap_sheet SET cop = ('%s') WHERE id = ('%s')",
								"the force",
								mysql_real_escape_string ($caseid));
						mysql_query($sql);
			}
			$update = array_sum($stack);
			if($update == 0){
				$update = 2500;
			}
			$change = $cur + $update;
			setStat("exp",$user_ID,$update);
			$recipient_message = "Your success on the force is apparent, gaining you ".$update."CP";
			hustle_reporter($user,1,$recipient_message,"recipient");
			echo 3;
		} else {
			echo 1;
		}
	}
} else {
	//false
	$award = rand(1,1000);
	$update = $cur - $award;
	setStat("exp",$user_ID,$update);
	echo 2;
}
?>

 