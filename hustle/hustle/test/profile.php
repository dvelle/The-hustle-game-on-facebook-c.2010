<?php
$user = $_REQUEST['data'];
//$user = "jermongreen";

include 'stats.php';
require_once 'connect.php';		// our database settings
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($userID) = mysql_fetch_row($result);

$query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($crewID) = mysql_fetch_row($result);

//How many challenges have I won 
$query = sprintf("SELECT ch_won FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($ch_won) = mysql_fetch_row($result);

//How many challenges have I lost?
$query = sprintf("SELECT ch_lost FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($ch_lost) = mysql_fetch_row($result);

//How many heists have I won?
$query = sprintf("SELECT heist_won FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($heist_won) = mysql_fetch_row($result);

//How many heists have I lost?
$query = sprintf("SELECT heist_lost FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($heist_lost) = mysql_fetch_row($result);

//How many robberies have I failed at?
$query = sprintf("SELECT rob_lost FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($rob_lost) = mysql_fetch_row($result);

//How many robberies have i pulled off?
$query = sprintf("SELECT rob_won FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($rob_won) = mysql_fetch_row($result);

//How many times have I been robbed?
$query = sprintf("SELECT robbed_tot FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($robbed_tot) = mysql_fetch_row($result);

//How many members have i fired?
$query = sprintf("SELECT pink_slip FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($pink_slips) = mysql_fetch_row($result);

//How many times have i been fired?
$query = sprintf("SELECT fired FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($fired) = mysql_fetch_row($result);

//Arcade Champ total
$query = sprintf("SELECT arcade_champ FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($champ) = mysql_fetch_row($result);

//how big is my crew
$query = sprintf("SELECT COUNT(id) FROM h_crew_member WHERE crew_id = ('%s')",
			mysql_real_escape_string($crewID));
$result = mysql_query($query);
list($size) = mysql_fetch_row($result);
$my_crew_size = $size - 1; //minus me

//How much am I grossing?
//Crew combined networth test over last hour
$worth = array();
$time = time();
$hour = 3600;
$lst_hour = $time - $hour;
$query = sprintf("SELECT * FROM h_crew_member WHERE crew_id = ('%s')AND time < ('%s')",
					mysql_real_escape_string ($crewID),
					mysql_real_escape_string ($lst_hour));
$result = mysql_query($query);

while($member_ar = mysql_fetch_assoc($result)){
	$name = $member_ar["user"];
	//what is total cash on hand for member
	$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string ($name));
	$result = mysql_query($query);
	list($memberid) = mysql_fetch_row($result);
	//id'd
	$wallet = getStat("cash",$memberid);
	array_push($worth,$wallet);		
}
$crew = array_sum($worth);
$piggy_bank = getStat("cash",$leaderid);
//
$net_worth_real = $crew - $piggy_bank;
if($net_worth_real <= 0){
	$net_worth_real = $piggy_bank;
} else {
	$net_worth_real = $crew + $piggy_bank;
}

$net_worth = number_format($net_worth_real, 0, ',', ',');

$query = sprintf("UPDATE h_users SET gross = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string ($net_worth_real),
						mysql_real_escape_string ($user));
mysql_query($query);

//How much are my total expenses?
$query = sprintf("SELECT overhead FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($out) = mysql_fetch_row($result);
$overhead = number_format($out, 0, ',', ',');
//what is my cash flow?

$flow_real = $net_worth_real - $out;

$flow = number_format($flow_real, 0, ',', ',');

$query = sprintf("UPDATE h_users SET cash_flow = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string ($flow_real),
						mysql_real_escape_string ($user));
mysql_query($query);

//What is my rank?
// (my cash total + # of Arcade high scores + my wealth + my weapons pow + my muscle pow + my successful heists + my succ robberies + my suc challenges + crew size + hourly gross) / (my times robbed + my failed challenges + my failed robberies + my failed heists)
$query = sprintf("SELECT balance FROM h_bank_accounts WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($bank_account) = mysql_fetch_row($result);

$cash = getStat("cash",$userID);
$wealth = assets_valuation($userID);
$posse = how_deep($user);
$defense_power = raw_power($userid,"defend",$posse);
$offense_power = raw_power($userid,"attack",$posse);

$raw_positives = $cash + $champ + $wealth + $defense_power + $offense_power + $heist_won + $rob_won + $ch_won + $my_crew_size + $net_worth + $bank_account;

$raw_negs = $robbed_tot + $ch_lost + $rob_lost + $heist_lost;
if($raw_negs == 0){
	$rank_score = $raw_positives/1;
} else {
	$rank_score = $raw_positives/$raw_negs;
}

$query = sprintf("UPDATE h_top_players SET rank_score = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string ($rank_score),
						mysql_real_escape_string ($user));
					$result = mysql_query($query);
					
$pquery = "SELECT * FROM `h_top_players` ORDER BY rank_score desc";
$presult = mysql_query($pquery);

$rank = 0;					
while($players_arr = mysql_fetch_assoc($presult)){
	$rank = $rank + 1;
	$time = time();
	$puser = $players_arr["user"];
	$ptime = $players_arr["time"];
	$prank = $players_arr["rank"];
	$base_s = $time - $ptime;
	if($prank > $rank){
		$rfs = $rank/$base_s * 1000;
		$rfs = -round($rfs,2);
		$query = sprintf("UPDATE h_top_players SET rank = ('%s'), time = ('%s'), flight_score = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string ($rank),
						mysql_real_escape_string ($time),
						mysql_real_escape_string ($rfs),
						mysql_real_escape_string ($puser));
					$result = mysql_query($query);
	} elseif($prank < $rank) {
		$rfs = $rank/$base_s * 1000;
		$rfs = round($rfs,2);
		$query = sprintf("UPDATE h_top_players SET rank = ('%s'), time = ('%s'), flight_score = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string ($rank),
						mysql_real_escape_string ($time),
						mysql_real_escape_string ($rfs),
						mysql_real_escape_string ($puser));
					$result = mysql_query($query);
	}			
}



//What is my crew rank?
// Crew Rank = Avg of all member ranks
$query = sprintf("SELECT * FROM h_crew_member WHERE crew_id = ('%s') AND UPPER(user) != ('%s')",
			$crewID,
			mysql_real_escape_string($user));
$result = mysql_query($query);

$stack = array();
while($member_arr = mysql_fetch_assoc($result)){
	$member = $member_arr["user"];
	$cquery = sprintf("SELECT rank FROM h_top_players WHERE UPPER(user) = ('%s')",
			mysql_real_escape_string($member));
	$cresult = mysql_query($cquery);
	list($rank) = mysql_fetch_row($cresult);
	array_push($stack,$rank);
}
$sum = array_sum($stack);
if($my_crew_size == 0){
	$crew_rank = $sum/1;
} else {
	$crew_rank = $sum/$my_crew_size;
}

$query = sprintf("UPDATE h_top_crew SET rank_score = ('%s'), time = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string ($crew_rank),
						mysql_real_escape_string ($time),
						mysql_real_escape_string ($user));
					$result = mysql_query($query);
//

$tcquery = "SELECT * FROM `h_top_crew` ORDER BY rank_score desc";
					$tcresult = mysql_query($tcquery);

$rank = 0;					
while($crew_arr = mysql_fetch_assoc($tcresult)){
	$rank = $rank +1;
	$time = time();
	$puser = $crew_arr["user"];
	$ptime = $crew_arr["time"];
	$prank = $crew_arr["rank"];
	$base_s = $time - $ptime;
	if($base_s == 0){
		$base_s = 1;
	}
	if($prank > $rank){
		$crfs = $rank/$base_s * 1000;
		$crfs = -round($crfs, 2);
		$query = sprintf("UPDATE h_top_crew SET rank = ('%s'), time = ('%s'), flight_score = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string ($rank),
						mysql_real_escape_string ($time),
						mysql_real_escape_string ($crfs),
						mysql_real_escape_string ($puser));
					$result = mysql_query($query);
	} elseif($prank < $rank) {
		$crfs = $rank/$base_s * 1000;
		$crfs = round($crfs, 2);
		$query = sprintf("UPDATE h_top_crew SET rank = ('%s'), time = ('%s'), flight_score = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string ($rank),
						mysql_real_escape_string ($time),
						mysql_real_escape_string ($crfs),
						mysql_real_escape_string ($puser));
					$result = mysql_query($query);
	}
}

//my rank is
$query = sprintf("SELECT rank FROM h_top_players WHERE UPPER(user) = ('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($rank) = mysql_fetch_row($result);

//intimidation setting
$query = sprintf("SELECT intimidate FROM h_crew_main WHERE UPPER(user) = ('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($sun) = mysql_fetch_row($result);
if($sun == "Yes"){
	$intimidate = "Ride or Die";
} else {
	$intimidate = "Sleeper";
}
//Crew Share Settings
$query = sprintf("SELECT nat_win_share FROM h_crew_main WHERE UPPER(user) = ('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($nwsh) = mysql_fetch_row($result);
//
$query = sprintf("SELECT nat_loss_share FROM h_crew_main WHERE UPPER(user) = ('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($nlsh) = mysql_fetch_row($result);
//
$query = sprintf("SELECT cir_win_share FROM h_crew_main WHERE UPPER(user) = ('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($cwsh) = mysql_fetch_row($result);
//
$query = sprintf("SELECT cir_loss_share FROM h_crew_main WHERE UPPER(user) = ('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($clsh) = mysql_fetch_row($result);
//output
//
$poller = json_encode(array(
  "flow" => $flow,
  "overhead" => $overhead,
  "gross" => $net_worth,
  "robbed_tot" => $robbed_tot,
  "rob_won" => $rob_won,
  "rob_lost" => $rob_lost, 
  "heist_lost" => $heist_lost, 
  "heist_won" => $heist_won,
  "ch_lost" => $ch_lost,
  "ch_won" => $ch_won,
   "pink_slips" => $pink_slips,
  "fired" => $fired,
  "my_rank" => $rank,
  "my_rfs" => $rfs,
  "crew_rank" => $crew_rank,
  "my_crfs" => $crfs,
  "attack" => $intimidate,
  "win_sh" => $nwsh,
  "loss_sh" => $nlsh,
  "cw_sh" => $cwsh,
  "cl_sh" => $clsh,
));

echo $poller

?>