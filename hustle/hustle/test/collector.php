<?

include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats

//Update Journal

//

//Retrieve players
$sql = "SELECT * FROM h_users";
$res = mysql_query($sql);
$debit = 1;

while($collect = mysql_fetch_assoc($res)){
	$stack = array();
	$who = $collect["id"];
	$user = $collect["user"];
	//Bank
	//total bills
	$cost = mortgage($who,0);
	$account = getAccount($user);
	
	if(empty($account)){		
		$account = getStat("cash",$who);
		$debit = $account - $cost;
		setStat("cash",$who,$debit);
	} else {		
		$debit = $account - $cost;
		setAccount($debit,$user);
	}
	//
	$cur = getBCash();
	$booty = getBAss();
	$cur = $cur + $cost;
	$booty = $booty + $cost;
	setBCash($cur);
	setBAss($booty);
	//	
	if($cost > $account){		
		while($cost > $account){
			repo($who);		
			$cost = mortgage($who,0);
			if($cost == 0){
			break;
			}
		}
	}
	array_push($stack,$cost);
	
		
	//Check with union
	//total bills
	$gross = salaries($who,0);
	$account = getAccount($user);
	
	if(empty($account)){		
		$account = getStat("cash",$who);
		$debit = $account - $gross;
		setStat("cash",$who,$debit);
	} else {		
		$debit = $account - $gross;
		setAccount($debit,$user);
	}
	//
	$cur = getBCash();
	$booty = getBAss();
	$cur = $cur + $gross;
	$booty = $booty + $gross;
	setBCash($cur);
	setBAss($booty);
	//	
	if($gross > $account){		
		while($gross > $account){		
			strike($who);
			$gross = salaries($who,0);
			if($gross == 0){
				break;
			}
		}
	}
	array_push($stack,$gross);
		
	//Check with dealers
	//total bills
	$fee = upkeep($who,0);
	$account = getAccount($user);
	
	if(empty($account)){		
		$account = getStat("cash",$who);
		$debit = $account - $fee;
		setStat("cash",$who,$debit);
	} else {		
		$debit = $account - $fee;
		setAccount($debit,$user);
	}
	//
	$cur = getBCash();
	$booty = getBAss();
	$cur = $cur + $fee;
	$booty = $booty + $fee;
	setBCash($cur);
	setBAss($booty);
	//	
	if($fee > $account){
		while($fee > $account){
			lost_goods($debit);
			$fee = upkeep($who,0);
			if($fee == 0){
				break;
			}
		}
	}
	
	array_push($stack,$fee);
	
	$losses = array_sum($stack);
	if($losses > 0){
		ledger($user,$losses);
	}
	$i++;
}
//Money Train
$query = "SELECT train_pickup FROM h_bliss_bank";
$result = mysql_query($query);
list($train) = mysql_fetch_row($result);

if($train == 186){
	$train = 0;
	$query = "SELECT balance FROM h_bliss_bank";
		$result = mysql_query($query);
	list($balance) = mysql_fetch_row($result);
	$new_bal = round($balance/2);
	setBCash($new_bal);
	$cur = getBAss();
	$booty = $cur + $new_bal;
	setBAss($booty);
	$query = sprintf("UPDATE h_bliss_bank SET security = '%s'",
				 3000);
	mysql_query($query);
} else {
	$train = $train + 1;
}

if($train == 185){
	$query = sprintf("UPDATE h_bliss_bank SET security = '%s'",
				 1000);
	mysql_query($query);
} 

$query = sprintf("UPDATE h_bliss_bank SET train_pickup = '%s'",
				 $train);
mysql_query($query);


//***LOTTERY
//Check all ticket holders
$sql = sprintf("SELECT numbers FROM h_lottery WHERE done = ('%s')",
		mysql_real_escape_string (0));
$sqlr = mysql_query($sql);
list($drawing) = mysql_fetch_row($sqlr);

$sql_4 = "SELECT * FROM h_lotto_tickets";
$result_4 = mysql_query($sql_4);
while($roller = mysql_fetch_assoc($result_4)){
	$player = $roller["user_id"];
	$picks = $roller["ticket_number"];
	if($picks == $drawing){
		//pass out money
		$sql_5 = sprintf("SELECT pot FROM h_lottery WHERE done = ('%s')",
		mysql_real_escape_string (0));
		$re_5 = mysql_query($sql_5);
		list($jackpot) = mysql_fetch_row($re_5);		
		$dealer = $roller["dealer"];
		if(!empty($dealer)){			
			$sql_6 = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($dealer));
			$result_6 = mysql_query($sql_6);
			list($dealer_id) = mysql_fetch_row($result_6);
			$currency_2 = getStat("cash",$dealer_id);
			$ddeposit = $currency_2 + $dealer_fee;
			setStat("cash",$player,$ddeposit);
			$dealer_fee = round($jackpot * .20);
			$recipient_message = "The <b>Numbers Racket</b> just paid off, ".ucwords($player_name)." just paid you $".$dealer_fee." from their lotto winnings";
			hustle_reporter($dealer,1,$recipient_message,"recipient");
		}
		$currency = getStat("cash",$player);
		$net = $jackpot - $dealer_fee;
		$deposit = $currency + $net;
		setStat("cash",$player,$deposit);
		//send messages
		//ticket holder
		$sql_6 = sprintf("SELECT user FROM h_users WHERE id = ('%s')",
		mysql_real_escape_string ($player));
		$result_6 = mysql_query($sql_6);
		list($player_name) = mysql_fetch_row($result_6);
		$recipient_message = "You just won the <b>Hustle Lotto JACKPOT</b> of $".$jackpot." minus the 20% to your dealer.";
		hustle_reporter($player_name,1,$recipient_message,"recipient");
		//
		//empty h_lotto_tickets
		$query_9 = "TRUNCATE TABLE h_lotto_tickets";
		$result = mysql_query($query_9);
		break;
	}

}
//check if lotto has been won
$query = sprintf("SELECT COUNT(pot) FROM h_lottery WHERE done = ('%s')",
		0);
$result = mysql_query($query);
list($count) = mysql_fetch_row($result);
if($count==0){
	//pick a lotto number
	//start next game
	$lotto = rand(111111,999999);
	$pot = 1000;
	$time = time();
	$query = sprintf("INSERT INTO h_lottery(time,pot,numbers) VALUES ('%s','%s','%s')",
		mysql_real_escape_string($time),
		mysql_real_escape_string($pot),
		mysql_real_escape_string($lotto));
		mysql_query($query);
} else {
	//grow pot
	$query_1 = sprintf("SELECT id,pot FROM h_lottery WHERE done = ('%s')",
		mysql_real_escape_string (0));
	$result_1 = mysql_query($query_1);
	$pots = mysql_fetch_assoc($result_1);
	$pot = $pots["pot"];
	$pot_id = $pots["id"];
	$pot = $pot + 1000;
	
	$query_2 = sprintf("UPDATE h_lottery SET pot = '%s' WHERE id = ('%s')",
		mysql_real_escape_string($pot),
		mysql_real_escape_string($pot_id));
	$result_2 = mysql_query($query_2);
	//empty h_lotto_tickets
		$query_9 = "TRUNCATE TABLE h_lotto_tickets";
		$result = mysql_query($query_9);
}
//Wall Street Ticker
$sql = "SELECT * FROM h_users";
$res = mysql_query($sql);
$debit = 1;

while($collect = mysql_fetch_assoc($res)){
	$user_id = $collect["id"];
	$user = $collect["user"];
	$cool = $collect["cool"];
	//calculate everyone's bank
	$wealth = assets_valuation($user_id);
	$cash = getStat("cash",$user_id);
	$total = $wealth + $cash;
	$query = sprintf("UPDATE h_users SET bank = ('%s') WHERE id = ('%s')",
					mysql_real_escape_string ($total),
					mysql_real_escape_string ($user_id));
		mysql_query($query);
	//update casino jackpot 10% of owners networth
	$query = sprintf("SELECT COUNT(id) FROM h_user_assets WHERE asset_id = (SELECT id FROM h_businesses WHERE name = '%s' OR short_name = '%s') AND user_id ='%s'",
					   "casino",
					   "casino",
					   mysql_real_escape_string($user_id));
	$result = mysql_query($query);
	list($check2) = mysql_fetch_row($result);
	if($check2 > 0){
		$query_2 = sprintf("SELECT * FROM h_user_assets WHERE asset_id = (SELECT id FROM h_businesses WHERE name = '%s' OR short_name = '%s') AND user_id ='%s'",
					   "casino",
					   "casino",
					   mysql_real_escape_string($user_id));
	$result_2 = mysql_query($query_2);
		while($array_4 = mysql_fetch_assoc($result_2)){
			$casino_id = $array_4["id"];
			$jackpot = round($total * .1);
			$visits = $array_4["visits"];
			$last_val = $array_4["last_val"];
			$income = $array_4["income"];
			$query = sprintf("UPDATE h_user_assets SET jackpot = ('%s') WHERE id = ('%s') AND user_id = ('%s')",
					mysql_real_escape_string ($jackpot),
					mysql_real_escape_string ($casino_id),
					mysql_real_escape_string ($user_id));
			mysql_query($query);
			//
			$new_val = $income * $visits;
			if($new_val > $last_val){
				//change + and add to worth
				$pos = "+";
				quarterly($pos,$new_val,$casino_id,$income,"add",1);
			} elseif($new_val < $last_val){
				//change - and subtract from worth
				$neg = "-";
				quarterly($neg,$new_val,$casino_id,$income,"minus",1);
			} elseif($new_val == $last_val){
				//change nc update o val and new val to worth + visits
				$nc = "nc";
				quarterly($nc,$new_val,$casino_id,$income,1,1);
			}
		}
	}
	//update night club cool = previous worth + visits +/- 1% cool of owner
	$query = sprintf("SELECT COUNT(ID) FROM h_user_assets WHERE asset_id = (SELECT id FROM h_businesses WHERE name = '%s' OR short_name = '%s') AND user_id ='%s'",
					   "club",
					   "club",
					   mysql_real_escape_string ($user_id));
	$result = mysql_query($query);
	list($check) = mysql_fetch_row($result);
	if($check > 0){
		$query_3 = sprintf("SELECT * FROM h_user_assets WHERE asset_id = (SELECT id FROM h_businesses WHERE name = '%s' OR short_name = '%s') AND user_id ='%s'",
					   "club",
					   "club",
					   mysql_real_escape_string ($user_id));
	$result_3 = mysql_query($query_3);
		while($array_3 = mysql_fetch_assoc($result_3)){
			$club_id = $array_3["id"];
			$visits = $array_3["visits"];
			$last_val = $array_3["last_val"];
			$income = $array_3["income"];
			$bonus = round($cool * .01);
			$top = $bonus + $income;
			$new_val = $top * $visits;
			if($new_val > $last_val){
				//change + and add to worth
				quarterly("pos",$new_val,$club_id,$income,"add",2);
			} elseif($new_val < $last_val){
				//change - and subtract from worth
				quarterly("neg",$new_val,$club_id,$income,"minus",2);
			} elseif($new_val == $last_val) {
				//change nc update o val and new val to worth + visits
				quarterly("nc",$new_val,$club_id,$income,1,2);
			}
		}
	}	
}
//investments
$sql = "SELECT * FROM h_users";
$res = mysql_query($sql);
$debit = 1;

while($collect = mysql_fetch_assoc($res)){
	$user_id = $collect["id"];
	$user = $collect["user"];
	$cool = $collect["cool"];
	//then calculate investors share value
	$sql = sprintf("SELECT * FROM h_user_investments WHERE user_id = ('%s')",
							mysql_real_escape_string($user_id));
	$results = mysql_query($sql);
	while($dividend = mysql_fetch_assoc($results)){
		$biz_id = $dividend["biz_id"];
		if($biz_id == 500){
			$wow = getBAss();
			$wow = round($wow * .001);
			$pocket = getStat("cash",$user_id);
			$deposit = $pocket + $wow;
			setStat("cash",$user_id,$deposit);
		} else {
			$query = sprintf("SELECT worth FROM h_user_assets WHERE id = ('%s')",
				mysql_real_escape_string($biz_id));
			$result = mysql_query($query);
			list($worth) = mysql_fetch_row($result);
			$valued = round($worth * .01);
								
			$portfolio = getPortfolio($biz_id,$user_id);
			$interest = $valued * $portfolio;
			$sql_UP = sprintf("UPDATE h_user_investments SET value = ('%s') WHERE user_id = ('%s') AND biz_id = ('%s')",
									mysql_real_escape_string($interest),
									mysql_real_escape_string($user_id),
									mysql_real_escape_string($biz_id));
									mysql_query($sql_UP);
			$pocket = getStat("cash",$user_id);
			$deposit = $pocket + $interest;
			//then post dividend check to investor account
			setStat("cash",$user_id,$deposit);
		}
	}
}

//updates
$sql = "SELECT * FROM h_users";
$res = mysql_query($sql);
$debit = 1;

while($collect = mysql_fetch_assoc($res)){
	$user_id = $collect["id"];
	$user = $collect["user"];
	$time = time();
	//COOL upgrade
	$thecool = getStat("exp",$user_id);
	$sql = sprintf("UPDATE h_users SET cool = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string ($thecool),
				mysql_real_escape_string ($user));
	mysql_query($sql);	
	
	//update cool crew average
	$query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
								mysql_real_escape_string($user));
	$results = mysql_query($query);
	list($crewid) = mysql_fetch_row($results);
	
	$query = sprintf("SELECT COUNT(id) FROM h_crew_member WHERE crew_id = ('%s') AND user != ('%s')",
								mysql_real_escape_string($crewid),
								mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if($count == 0){
		$count = 1;
	}
	$query_3 = sprintf("SELECT * FROM h_crew_member WHERE crew_id = ('%s') AND user != ('%s')",
								mysql_real_escape_string($crewid),
								mysql_real_escape_string($user));
	$result_3 = mysql_query($query_3);
	
	$stacker = array();
	while($crew_arr = mysql_fetch_assoc($result_3)){
		$mem= $crew_arr["user"];
		$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
								mysql_real_escape_string($mem));
		$result = mysql_query($query);
		list($memid) = mysql_fetch_row($result);		
		$thecool = getStat("exp",$memid);
		array_push($stacker, $thecool);
	}
	$total = array_sum($stacker);
	$avg = $total/$count;
	$sql = sprintf("UPDATE h_users SET crew_cool = ('%s') WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string ($avg),
				mysql_real_escape_string ($user));
	mysql_query($sql);
}

?>