<?
$user = $_REQUEST["data"];
//$user = "jermongreen";
require_once 'connect.php';	// this is from our earlier article on configuration files in PHP
require_once 'stats.php';

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);
//fb share set


	
$query = sprintf("SELECT tutorial_time FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($schedule) = mysql_fetch_row($result);

$time = time();

$left = $schedule - $time;

if($left == 0){
	$uid = id($user);
	//change backdrop of init screen
	$query = sprintf("SELECT tutorial_on FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($on) = mysql_fetch_row($result);
	if($on == 1){
		//calculate how many points to award 100% 25 90% 20 80% 15 70% 10 60% 5 50% 0
		//TOTAL DONE
		$query = sprintf("SELECT tut_total FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($compl) = mysql_fetch_row($result);
		$all = $compl + $rh_tot + $count + $mine + $as + $ah_tot + rob_tot;
		$some = $all/71;
		$tpc = $some * 100;
		if($tpc == 100){
			$hustle = getStat("rp",$uid);
			$grab = $hustle + 25;
			setStat("rp",$uid,$grab);
			$token = 25;
		} elseif($tpc >= 90){
			$hustle = getStat("rp",$uid);
			$grab = $hustle + 20;
			setStat("rp",$uid,$grab);
			$token = 20;
		} elseif($tpc >= 80){
			$hustle = getStat("rp",$uid);
			$grab = $hustle + 15;
			setStat("rp",$uid,$grab);
			$token = 15;
		} elseif($tpc >= 70){
			$hustle = getStat("rp",$uid);
			$grab = $hustle + 10;
			setStat("rp",$uid,$grab);
			$token = 10;
		} elseif($tpc >= 60){
			$hustle = getStat("rp",$uid);
			$grab = $hustle + 5;
			setStat("rp",$uid,$grab);
			$token = 5;
		} 
	}
	//turn off tutorial
	$query = sprintf("UPDATE h_users SET tutorial_on = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string (0),
			mysql_real_escape_string ($user));
	mysql_query($query);
	
	$done = 555;
} else {
	$left = date("d H:i:s", $left);
	//AREAS
	$query = sprintf("SELECT area_tut FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($a) = mysql_fetch_row($result);
	if(!empty($a)){
		$sub = $a/21;
		$areas = $sub * 100;
	} else {
		$a = 0;
		$areas = 0;
	}	
	//ARCADE HUSTLES
	$query = sprintf("SELECT ch_won FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($cwon) = mysql_fetch_row($result);
	
	$query = sprintf("SELECT ch_lost FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($closs) = mysql_fetch_row($result);
	$ah_tot = $cwon + $closs;
	if(!empty($ah_tot)){
		$ah_sub = $ah_tot/10;
		$arhus = $ah_sub * 100;
	} else {
		$ah_tot = 0;
		$arhus = 0;
	}
	//ROBBERIES
	$query = sprintf("SELECT rob_won FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($robwon) = mysql_fetch_row($result);
	
	$query = sprintf("SELECT rob_lost FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($robloss) = mysql_fetch_row($result);
	$rob_tot = $robwon + $robloss;
	if(!empty($rob_tot)){
		$rob_sub = $rob_tot/20;
		$robp = $rob_sub * 100;
	} else {
		$rob_tot = 0;
		$robp = 0;
	}
	//ATTACKS
	$query = sprintf("SELECT attacks FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($as) = mysql_fetch_row($result);
	if(!empty($as)){
		$atts_sub = $as/10;
		$attacks = $atts_sub * 100;
	} else {
		$as = 0;
		$attacks = 0;
	}
	//INVESTMENTS
	$user_id = id($user);
	$query = sprintf("SELECT COUNT(id) FROM h_user_investments WHERE user_id = '%s'",
			mysql_real_escape_string($user_id));
	$result = mysql_query($query);
	list($count) = mysql_fetch_row($result);
	if(!empty($count)){
		$inv_sub = $count/2;
		$invs = $inv_sub * 100;
	} else {
		$count = 0;
		$invs = 0;
	}
	//BANK ACCOUNTS
	$query = sprintf("SELECT COUNT(id) FROM h_bank_accounts WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($mine) = mysql_fetch_row($result);
	if(!empty($mine)){
		$mine_sub = $mine/1;
		$account = $mine_sub * 100;
	} else {
		$mine = 0;
		$acount = 0;
	}
	//RACES	
	$query = sprintf("SELECT race_won FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($rwon) = mysql_fetch_row($result);
	
	$query = sprintf("SELECT race_lost FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($rloss) = mysql_fetch_row($result);
	$rh_tot = $rwon + $rloss;
	if(!empty($rh_tot)){
		$rh_sub = $rh_tot/10;
		$rahus = $rh_sub * 100;
	} else {
		$rh_tot = 0;
		$rahus = 0;
	}
	//TOTAL DONE
	$query = sprintf("SELECT tut_total FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($compl) = mysql_fetch_row($result);
	$all = $compl + $rh_tot + $count + $mine + $as + $ah_tot + rob_tot;
	$some = $all/71;
	$total_percent_complete = $some * 100;
	
	$query = sprintf("UPDATE h_users SET tut_total = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($all),
			mysql_real_escape_string ($user));
	mysql_query($query);
}
$poller = json_encode(array(
  "total" => $total_percent_complete,
  "time" => $left,
  "bonus" => $token,
  "area" => $areas,
  "areas_done" => $a,
  "arcade" => $arhus,
  "arcade_done" => $ah_tot,
  "attack" => $attacks,
  "attack_done" => $as,
  "race" => $rahus, 
  "races_done" => $rh_tot,
  "bank" => $account,
  "bank_done" => $mine,
  "invest" => $invs,
  "invest_done" => $count,
  "rob" => $robp,
  "rob_done" => $rob_tot,
  "done" => $done,
  "lisa" => "<img src='../file/tutorial/done.png' />",
));

echo $poller;
 
?>