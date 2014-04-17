<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$patron = $_POST['customer'];
//$patron = "jermongreen";
//$club_id = 116;
//$_POST['buynow_x'] = 1;
$club_id = $_POST['club_id'];
	
if(!empty($club_id)) {
	$sql = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($patron));
	$results = mysql_query($sql);
	list($patron_id) = mysql_fetch_row($results);
	
	$sql = sprintf("SELECT user_id FROM h_user_assets WHERE id = ('%s')",
							mysql_real_escape_string($club_id));
		$results = mysql_query($sql);
	list($owner_id) = mysql_fetch_row($results);
	
	if($_POST['buynow_x']){
		$query = sprintf("INSERT INTO h_patrons(club_id,user_id,club_oid) VALUES ('%s','%s','%s');",
							mysql_real_escape_string($club_id),
							mysql_real_escape_string($patron_id),
							mysql_real_escape_string($owner_id));
						mysql_query($query);
		if($patron_id != $owner_id){				
		visiter($patron_id,$club_id);
		}
		//Enter and subtract fee
		$sql = sprintf("SELECT fee FROM h_user_assets WHERE id = ('%s')",
							mysql_real_escape_string($club_id));
						$results = mysql_query($sql);
						list($fee) = mysql_fetch_row($results);
						$pocket = getStat("cash",$patron_id);
						$debit = $pocket - $fee;
						if($debit < 0){
							echo 2;
						} else {
							if($patron_id != $owner_id){
							setStat("cash",$patron_id,$debit);							
							visiter($owner_id,$club_id);
							//cool
							$sql = sprintf("SELECT worth FROM h_user_assets WHERE id = ('%s')",
							mysql_real_escape_string($club_id));
							$results = mysql_query($sql);
							list($worth) = mysql_fetch_row($results);
							$min = round($worth * .01);
							$coolness = $min * 10;
							
							$cur = getStat("exp",$patron_id);
							$upd = $cur + $coolness;
							setStat("exp",$patron_id,$upd);
							} 
							echo 1;
						}
	} elseif($_POST['investnow_x']){
		$sql = sprintf("SELECT worth FROM h_user_assets WHERE id = ('%s')",
							mysql_real_escape_string($club_id));
						$results = mysql_query($sql);
						list($worth) = mysql_fetch_row($results);
						$min = round($worth * .01);
		//Invest minimum equals 1% of total networth
		$cash = getStat("cash",$patron_id);
		$debit = $cash - $min;
		if($debit < 0){
			echo 3;
		} else {
			setStat("cash",$patron_id,$debit);
			//add to user investments
			$portfolio = getPortfolio($club_id,$patron_id);
			$added = $portfolio + 1;
			setPortfolio($club_id,$patron_id,$added);
			//add investment to worth and owner pocket
			$income = getbiz_inc($club_id,$owner_id);
			$deposit = $income + $min;
			setbiz_inc($club_id,$owner_id,$deposit);
			$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
			$result = mysql_query($query);
			list($chapter) = mysql_fetch_row($result);
			if($chapter == 7){
				$chapter = $chapter + 1;
				$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($chapter),
					mysql_real_escape_string($user));
				mysql_query($query);
			}
			echo 4;
		}
		
	}	
}
?>

 