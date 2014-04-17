<?php
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_POST['who'];
//$user = "jermongreen";
$offer = $_POST['offer'];
$item = $_POST['item'];
$amount = $_POST['quantity'];
$feen = $_POST['feen'];
$id = $_POST['id'];
$decision = $_POST['decision'];
//get user stats
$userID = id($user);

$sql = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($sql);
list($crewID) = mysql_fetch_row($result);

$feenID = id($feen);
$time = time();
//Can dealer cover amount

if($decision  == "Decline") {	
	$sql = sprintf("DELETE FROM `h_user_requests` WHERE `id` = '%s'",
						mysql_real_escape_string($id));
	mysql_query($sql);
	//
	$recipient_message = ucwords($user)." rejected your cash offer for the <b>".ucwords($item)."</b>!";
	//
	hustle_reporter($feen,1,$recipient_message,"recipient");
	echo 1;
} else {
	//what is the item?
	//can dealer cover?
	$onhand = getGoods($item,$userID);
	$trans = $onhand - $amount;
	if($trans < 0 || empty($onhand)){
		echo 2;
	} else {
		setGoods($item,$userID,$trans);
		//Share cash with crew
		$i_cash = getStat("cash",$userID);			
		//gotta share sorry					
		$net_take = $offer;
		$posse = how_deep($user);
		if($posse == 1){
			$mine = $net_take;
			$report = $cash_bonus;
		} else {
			//*************
			$who = "general";
			$flow = "positive";
			//*************
			$c_take = pg_pay($crewID,$net_take,$user,$posse,$who,$flow);
			$mine = $net_take - $c_take;
			$report = $mine;			
		}
		$deposit = $i_cash + $mine;
		setStat('cash',$userID,$deposit);//setStat('cash',$userID,'50');
		//add to criminal record
		if($item == "roids"){
			$sql = sprintf("SELECT roids_sold FROM h_users WHERE id = ('%s')",
					mysql_real_escape_string($userID));
			$result = mysql_query($query);
			list($total) = mysql_fetch_row($result);
			
			$total = $total + 1;
			
			$query = sprintf("UPDATE h_users SET magic_sold = '%s' WHERE id = ('%s')",
			mysql_real_escape_string($total),
			mysql_real_escape_string($userID));
			mysql_query($query);
			$stash = getGoods($item,$feenID);
			$grab = $stash + $amount;
			setGoods($item,$feenID,$grab);
		} elseif($item == "coke"){
			$sql = sprintf("SELECT magic_sold FROM h_users WHERE id = ('%s')",
					mysql_real_escape_string($userID));
			$result = mysql_query($query);
			list($total) = mysql_fetch_row($result);
			
			$total = $total + 1;
			
			$query = sprintf("UPDATE h_users SET magic_sold = '%s' WHERE id = ('%s')",
			mysql_real_escape_string($total),
			mysql_real_escape_string($userID));
			mysql_query($query);
			$stash = getGoods($item,$feenID);
			$grab = $stash + $amount;
			setGoods($item,$feenID,$grab);
		} elseif($item == "dvd"){
			$sql = sprintf("SELECT dvd_sold FROM h_users WHERE id = ('%s')",
					mysql_real_escape_string($userID));
			$result = mysql_query($query);
			list($total) = mysql_fetch_row($result);
			
			$total = $total + 1;
			
			$query = sprintf("UPDATE h_users SET dvd_sold = '%s' WHERE id = ('%s')",
			mysql_real_escape_string($total),
			mysql_real_escape_string($userID));
			mysql_query($query);
			$stash = getGoods($item,$feenID);
			$grab = $stash + $amount;
			setGoods($item,$feenID,$grab);
		} elseif($item == "lotto"){
			$sql = sprintf("SELECT lotto_sold FROM h_users WHERE id = ('%s')",
					mysql_real_escape_string($userID));
			$result = mysql_query($query);
			list($total) = mysql_fetch_row($result);
			
			$total = $total + 1;
			
			$query = sprintf("UPDATE h_users SET lotto_sold = '%s' WHERE id = ('%s')",
			mysql_real_escape_string($total),
			mysql_real_escape_string($userID));
			mysql_query($query);
			//pick a lotto number
			$i = $amount;
			
			while($i > 0){
				$lotto = rand(111111,999999);
				$pot = 1000;
				$time = time();
				$query = sprintf("INSERT INTO h_lotto_tickets(time,user_id,ticket_number,dealer) VALUES ('%s','%s','%s','%s')",
					mysql_real_escape_string($time),
					mysql_real_escape_string($feenID),
					mysql_real_escape_string($lotto),
					mysql_real_escape_string($user));
					mysql_query($query);
				$i = $i - 1;
			}
			$stash = getGoods($item,$feenID);
			$grab = $stash + $amount;
			setGoods($item,$feenID,$grab);
		}			
		//
		$sql = sprintf("DELETE FROM h_user_requests WHERE id = '%s'",
						mysql_real_escape_string($id));
		$result=mysql_query($sql);	
		$recipient_message = ucwords($user)." came through with the <b>".ucwords($item)."</b>!";
		//
		hustle_reporter($feen,1,$recipient_message,"recipient");
		echo 3;
	}
}					   
											   
?>