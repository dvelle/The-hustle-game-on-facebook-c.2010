<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$patron = $_POST['customer'];
//$patron = "jermongreen";
$casino_id = $_POST['casino_id'];
//$casino_id = 47;
//$_POST['investnow_x'] = 1;
	
if(!empty($casino_id)){		
	$sql = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($patron));
	$results = mysql_query($sql);
	list($patron_id) = mysql_fetch_row($results);
	
	$sql = sprintf("SELECT user_id FROM h_user_assets WHERE id = ('%s')",
							mysql_real_escape_string($casino_id));
		$results = mysql_query($sql);
	list($owner_id) = mysql_fetch_row($results);
	
	if($_POST['buynow_x']){
							
		$query = sprintf("INSERT INTO h_patrons(casino_id,user_id,casino_oid) VALUES ('%s','%s','%s');",
							mysql_real_escape_string($casino_id),
							mysql_real_escape_string($patron_id),
							mysql_real_escape_string($owner_id));
						mysql_query($query);
		if($patron_id != $owner_id){				
		visiter($patron_id,$casino_id);
		}
		echo 1;
	} elseif($_POST['investnow_x']){
		$sql = sprintf("SELECT worth FROM h_user_assets WHERE id = ('%s')",
							mysql_real_escape_string($casino_id));
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
			$portfolio = getPortfolio($casino_id,$patron_id);
			$added = $portfolio + 1;
			setPortfolio($casino_id,$patron_id,$added);
			//add investment to worth and owner pocket
			$income = getbiz_inc($casino_id,$owner_id);
			$deposit = $income + $min;
			setbiz_inc($casino_id,$owner_id,$deposit);			
			echo 4;
		}
		
	}
} 
?>

 