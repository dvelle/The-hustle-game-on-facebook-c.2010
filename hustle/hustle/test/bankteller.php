<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];

if(empty($_POST['out'])){
	$amount = $_POST['in'];
} else {
	$amount = $_POST['out'];
}

//$user = "jermongreen";
//$_POST['invest_x'] = 1;
$userid = id($user);

function rates($user){
	$userid = id($user);
	//check to see if illegal
	$query = sprintf("SELECT COUNT(dvd_sold) FROM h_users WHERE UPPER(user) = UPPER('%s')",
	mysql_real_escape_string ($user));
		$result = mysql_query($query);
	list($dvd) = mysql_fetch_row($result);
	
	$query = sprintf("SELECT COUNT(magic_sold) FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($user));
		$result = mysql_query($query);
	list($coke) = mysql_fetch_row($result);
	
	$query = sprintf("SELECT COUNT(lotto_sold) FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($user));
		$result = mysql_query($query);
	list($lotto) = mysql_fetch_row($result);
	
	$query = sprintf("SELECT COUNT(roids_sold) FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($user));
		$result = mysql_query($query);
	list($roids) = mysql_fetch_row($result);
	
	
	if($dvd > 0 || $coke > 0 || $lotto > 0 || $roids > 0){
		//
		$query = sprintf("SELECT COUNT(id) FROM h_user_investments WHERE user_id = ('%s')",
		mysql_real_escape_string($userid));
		$res = mysql_query($query);
		list($count) = mysql_fetch_row($res);
		
		//check for legal activities
		$bquery = "SELECT id FROM h_user_assets WHERE user_id = '$userID' AND asset_id = 400 OR asset_id = 401";
			$biz = mysql_query($bquery);
		$biz_ar = mysql_fetch_row($biz);
		if(!empty($biz_ar) || !empty($count)){
			$perc = .08;
		} else {
			$perc = .2;	
		}		
	} else {
		$perc = .08;
	}
	return $perc;
}

if ($_POST['oaccount_x']) {
	//account
	$query = sprintf("SELECT COUNT(id) FROM h_bank_accounts WHERE UPPER(user) = UPPER('%s')",
						 mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if(!empty($count)){
		//already have account 
		echo 3;
	} else {
		//opening account
		$cash = getStat("cash",$userid);
		$debit = $cash - 500;
		if($debit < 0){
			echo 1;//broke alert minimum $500 deposit
		} else {
			//proceed
			setStat("cash",$userid,$debit);
			//
			$perc = rates($user);
			$banks = 500 * $perc;
			$yours = 500 - $banks;
			//
			$query = sprintf("INSERT INTO h_bank_accounts(user,balance) VALUES ('%s','%s')",
				mysql_real_escape_string($user),
				mysql_real_escape_string($yours));
			mysql_query($query);
			//
			$cur = getBCash();
			$booty = getBAss();
			$cur = $cur + $banks;
			$booty = $booty + $banks;
			setBCash($cur);
			setBAss($booty);
			echo 2;
		}
	}
} elseif ($_POST['deposit_x']) {
	$test = $amount * 3;
	if($test == 0){
		echo 6;
	} else {
		//deposit
		$cash = getStat("cash",$userid);
		$debit = $cash - $amount;
		if($debit < 0){
			echo 2;//Don't have that!
		} else {
			//proceed
			setStat("cash",$userid,$debit);
			//
			$perc = rates($user);
			$banks = round($amount * $perc);
			$yours = $amount - $banks;
			//
			$onhand = getAccount($user);
			$onhand = $onhand + $yours;
			setAccount($onhand,$user);
			//
			$cur = getBCash();
			$booty = getBAss();
			$cur = $cur + $banks;
			$booty = $booty + $banks;
			setBCash($cur);
			setBAss($booty);
		}
	}
} elseif ($_POST['take_x']) {
	$test = $amount * 3;
	if($test == 0){
		echo 6;
	} else {
	//withdraw
	$onhand = getAccount($user);
	$debit = $onhand - $amount;
	if($onhand < $amount){
		echo 3;//Don't have that!
	} else {
		//proceed
		$cash = getStat("cash",$userid);
		$deposit = $cash + $amount;
		setStat("cash",$userid,$deposit);
		//
		if($debit == 0){
			//delete account
			$sql = sprintf("DELETE FROM h_bank_accounts WHERE user = ('%s')",
					mysql_real_escape_string ($user));
			mysql_query($sql);
			echo 4;
		} else {
			setAccount($debit,$user);
		}
	}
	}
} elseif ($_POST['invest_x']) {
	//
	$cash = getStat("cash",$userid);
	$debit = $cash - 100000;
	if($debit < 0){
		echo 2;//Don't have that!
	} else {
		//bank id 500
		setStat("cash",$userid,$debit);
		$portfolio = getPortfolio(500,$userid);
		$added = $portfolio + 1;
		setPortfolio(500,$userid,$added);
		//
		$cur = getBCash();
		$booty = getBAss();
		$cur = $cur + 100000;
		$booty = $booty + 100000;
		setBCash($cur);
		setBAss($booty);
		echo 66;
	}
}

?>

 