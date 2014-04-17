<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$option = $_POST['option'];
$feen= $_POST['customer'];
$quan= $_POST['quantity'];
$offer= $_POST['d_offer'];
$name = $_POST['dealer_name'];
$theman = strtolower($name);
$dealer = str_replace (" ", "", $theman);


$sql = sprintf("SELECT id FROM h_users WHERE user = ('%s')",
					mysql_real_escape_string($feen));
	$results = mysql_query($sql);
list($userID) = mysql_fetch_row($results);
$time = time();
$test1 = $quan  * 3;
$test2 = $quan * 3;
if($test1 == 0 || $test2 == 0){
	echo 1;
} else {	
	if(!empty($dealer)){
		$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($feen));
						$result = mysql_query($query);
		list($chapter) = mysql_fetch_row($result);
					
		if($dealer == "jamesh" && $chapter == 20 && $option == "coke" && $offer == 300 && $quan == 1000){
			$chapter = $chapter + 1;
						
			$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string($chapter),
				mysql_real_escape_string($feen));
			mysql_query($query);
			
			$feenID = id($feen);
			//deposit 1000 ounces of magic
			$stash = getGoods($option,$feenID);
			$grab = $stash + $quan;
			setGoods($option,$feenID,$grab);
			
			$pocket = getStat("cash",$userID);
			$debit = $pocket - $offer;
			setStat("cash",$userID,$debit);
			echo 2;
		} else {
			//send to dealer	
			$pocket = getStat("cash",$userID);
			$debit = $pocket - $offer;
			if($debit < $offer){
				echo 1;
			} else {
				$query = sprintf("SELECT COUNT(id) FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($dealer));
					$result = mysql_query($query);			
					list($count) = mysql_fetch_row($result);
					if($count != 0){			
						setStat("cash",$userID,$debit);
						$query = sprintf("INSERT INTO h_user_requests(dealer,customer,item,quantity,offer,time) VALUES ('%s','%s','%s','%s','%s','%s')",
						mysql_real_escape_string($dealer),
						mysql_real_escape_string($feen),
						mysql_real_escape_string($option),
						mysql_real_escape_string($quan),
						mysql_real_escape_string($offer),
						mysql_real_escape_string($time));
						mysql_query($query);
						echo 2;
					} else {
						echo 4;
					}
			}
		}
	} else {
			//post to craigslist
			$pocket = getStat("cash",$userID);
			$debit = $pocket - $offer;
			if($debit < $offer || empty($option)){
				echo 1;
			} else {
				setStat("cash",$userID,$debit);
				$query = sprintf("INSERT INTO h_user_requests(customer,item,quantity,offer,time) VALUES ('%s','%s','%s','%s','%s')",
				mysql_real_escape_string($feen),
				mysql_real_escape_string($option),
				mysql_real_escape_string($quan),
				mysql_real_escape_string($offer),
				mysql_real_escape_string($time));
				mysql_query($query);
				echo 3;
			}
	}
}
?>

 