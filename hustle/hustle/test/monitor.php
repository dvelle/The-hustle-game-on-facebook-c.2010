<?
$user = $_REQUEST["data"];
//$user = "jermongreen";
require_once 'connect.php';	// this is from our earlier article on configuration files in PHP

require_once 'crimes.php';
require_once 'collars.php';
require_once 'leveler_sec.php';
require_once 'stats.php';

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);
//fb share set
$query = sprintf("UPDATE h_crew_recruit SET fb_sent = '%s' WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string(1),
						mysql_real_escape_string($user));
mysql_query($query);
//
$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s')",
													 mysql_real_escape_string ($user),
													 1);
mysql_query($sql);


$userID = id($user);

$query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($crewID) = mysql_fetch_row($result);

//News Alert
$query2 = sprintf("SELECT checked FROM h_user_news WHERE UPPER(receiver) = UPPER('%s')",
				mysql_real_escape_string($user));
$result2 = mysql_query($query2);
list($news_checked) = mysql_fetch_row($result2);

$energy = getStat('ep',$userID);
$cool_max = getStat('exp_rem',$userID);
$cool = getStat('exp',$userID);
$energy_max = getStat('epr',$userID);
$mulla = getStat('cash',$userID);
$cash = number_format($mulla, 0, ',', ',');
$token = getStat('rp',$userID);
$health = getStat('health',$userID);
$crew_rank = getCRank($user);

$row = mycool($user,$cool);
$stage=$row[0];
$l_label=$row[1];
// Crew Cash Cow
//which file has the largest earnings record?
$query = sprintf("SELECT MAX(crew_earnings) FROM h_crew_member WHERE user = ('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($test) = mysql_fetch_row($result);
if($test == 0){
	$cash_cow = "recruit.png";
} else {
	$query = sprintf("SELECT * FROM h_crew_member WHERE crew_earnings = ('%s') AND user = ('%s')",
			mysql_real_escape_string($test),
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	$work = mysql_fetch_assoc($result);
	//which crew leader is paying out the most?
	$crew_lead = $work["crew_id"];
	$earnings = $test;
	$bonuses = $work["bonus_pay"];	
	$gross_earnings = $earnings + $bonuses;
	
	//find their name
	$query2 = sprintf("SELECT user FROM h_crew_main WHERE id = ('%s')",
				mysql_real_escape_string($crew_lead));
	$result2 = mysql_query($query2);
	list($cow) = mysql_fetch_row($result2);
	
	//give me a face with that name
	$query2 = sprintf("SELECT image FROM h_users WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string($cow));
	$result2 = mysql_query($query2);
	list($cash_cow) = mysql_fetch_row($result2);
}


//
// Crew Cash Drain
//
//which crew leader is paying out the most?
$drain_query = sprintf("SELECT MAX(crew_losses) FROM h_crew_member WHERE user = ('%s')",
			mysql_real_escape_string($user));
$d_result = mysql_query($drain_query);
list($d_test) = mysql_fetch_row($d_result);
if($d_test == 0){
	$cash_drain = "recruit.png";
} else {
	$info_query = sprintf("SELECT * FROM h_crew_member WHERE crew_losses = ('%s') AND user = '%s'",
			mysql_real_escape_string($d_test),
			mysql_real_escape_string($user));
	$info_result = mysql_query($info_query);
	$file_work = mysql_fetch_assoc($info_result);
	//which crew leader is paying out the most?
	$d_leader = $file_work["crew_id"];
	$losses = $d_test;
	$extra = $file_work["bonus_bank"];	
	$gross_losses = $losses + $extra;
	
	//find their name
	$query2 = sprintf("SELECT user FROM h_crew_main WHERE id = ('%s')",
				mysql_real_escape_string($d_leader));
	$result2 = mysql_query($query2);
	list($drain) = mysql_fetch_row($result2);
	
	//give me a face with that name
	$query2 = sprintf("SELECT image FROM h_users WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string($drain));
	$result2 = mysql_query($query2);
	list($cash_drain) = mysql_fetch_row($result2);
}

$query = sprintf("SELECT fl_facebook FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($fl_facebook) = mysql_fetch_row($result);
 
//
//output
//
$query = sprintf("SELECT cur_level FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($cur_lvl) = mysql_fetch_row($result);
if($cur_lvl > 0){	
	$query = sprintf("SELECT * FROM h_levels WHERE id = ('%s')",
				mysql_real_escape_string($cur_lvl));
	$result = mysql_query($query);
	$lvl_arr = mysql_fetch_assoc($result);	
	$eplus = $lvl_arr["energy"];	
	$clock = $lvl_arr["time_cycle"];
	$interval = $lvl_arr["change_per"];	
	$health_per = $lvl_arr["health_per"];	
	$health_timer = $lvl_arr["health_cycle"];

} else {
	$interval = 1;	
	$clock = 260;
	$health_per = 10;
	$health_timer = 360;
}
$sql = sprintf("SELECT morale FROM h_users WHERE user = '%s'",
			   mysql_real_escape_string($user));
	$results = mysql_query($sql);
	list($morale) = mysql_fetch_row($results);

//Mission central
$sql = sprintf("SELECT rob_won FROM h_users WHERE UPPER(user) = UPPER('%s')",
			   mysql_real_escape_string($user));
	$results = mysql_query($sql);
	list($rob) = mysql_fetch_row($results);
	
$sql = sprintf("SELECT robbed_tot FROM h_users WHERE UPPER(user) = UPPER('%s')",
			   mysql_real_escape_string($user));
	$results = mysql_query($sql);
	list($victim) = mysql_fetch_row($results);
	if(empty($victim)){
		$victim = 0;
	}
	
$sql = sprintf("SELECT snitch FROM h_users WHERE UPPER(user) = UPPER('%s')",
			   mysql_real_escape_string($user));
	$results = mysql_query($sql);
	list($bub) = mysql_fetch_row($results);

$sql = sprintf("SELECT law FROM h_users WHERE UPPER(user) = UPPER('%s')",
			   mysql_real_escape_string($user));
	$results = mysql_query($sql);
	list($bad) = mysql_fetch_row($results);
	
if($rob == $morale){
	$crime = 1;
	$stopit = 0;
}

if($victim >= $morale){
	$law = 1;
	$stopit = 0;
}
if($rob >= $victim){
	$law = 0;
}
//snitch
$snitch = 0;
$pain = 0;
if($bub == 1){
	$sql_l = sprintf("UPDATE h_users SET snitch = ('%s') WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string(0),
							mysql_real_escape_string($user));
							mysql_query($sql_l);
	$snitch = rand(0,$victim);
	
	if($victim == $snitch){
	$pain = 9;
	}
}
function pickgame($gid){
	$query = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
										mysql_real_escape_string($gid));
					$result = mysql_query($query);
					$game = mysql_fetch_assoc($result);
					$gname = $game["shortname"];
					$image = $game['stdimage'];
					$file = $game['file'];
					$width = $game['width']; 
					$height = $game['height']; 
			$thegame =  "<a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\"><img src='../graphics/play_button.gif'></a>";
			return $thegame;
}
function newcase($user,$patrol_task){
	$query = sprintf("INSERT INTO h_investigations(cop,patrol,patrol_count,done) VALUES ('%s','%s','%s','%s')",
					mysql_real_escape_string($user),
					mysql_real_escape_string($patrol_task),
					0,
					0);
					mysql_query($query);
	return;				
}
if($bad == "criminal"){
	$stopit = 1;
	$fbi = gangland($user);//86quit 23getlost 5lotto 1mission 
	if($fbi <= 2){
		$query = sprintf("SELECT * FROM h_crimes WHERE UPPER(hood) = UPPER('%s') AND done = '%s'",
				mysql_real_escape_string($user),
				0);
		$result = mysql_query($query);
		$result_arr = mysql_fetch_assoc($result);
			$gid = $result_arr["gameid"];
			$tcode = $result_arr["task_code"];
			$cp_bonus = $result_arr["cp_bonus"];
			$cash_p = $result_arr["prize"];
			$score = $result_arr["score1"];
			$thegame = pickgame($gid);
	} elseif($fbi == 3){
		$sql = sprintf("SELECT * FROM h_crimes WHERE UPPER(hood) = UPPER('%s') AND done = '%s'",
					   mysql_real_escape_string($user),
					   0);
		$results = mysql_query($sql);
		$result_arr = mysql_fetch_assoc($results);
			$gid = $result_arr["gameid"];
			$tcode = $result_arr["task_code"];
			$fee = $result_arr["fee"];
			$score = $result_arr["score1"];
			$thegame = pickgame($gid);
	} elseif($fbi == 4){
		$sql = sprintf("SELECT * FROM h_crimes WHERE UPPER(hood) = UPPER('%s') AND done = '%s'",
					   mysql_real_escape_string($user),
					   0);
		$results = mysql_query($sql);
		$result_arr = mysql_fetch_assoc($results);
			$gid = $result_arr["gameid"];
			$tcode = $result_arr["task_code"];
			$fee = $result_arr["fee"];
			$score = $result_arr["score1"];
			$thegame = pickgame($gid);
	} elseif($fbi == 86){
		$sql = sprintf("SELECT fee FROM h_crimes WHERE UPPER(hood) = UPPER('%s') AND done = '%s'",
					   mysql_real_escape_string($user),
					   0);
		$results = mysql_query($sql);
		list($fee) = mysql_fetch_row($results);
	}
}elseif($bad == "cop"){
	$stopit = 1;
	$pursuit = 0;
	$charged = 0;
	$csi = 0;
	$police = cia($user);//1quit getlost 3lotto 4mission
	$named = $police * 2;
	if($named == 0){// investigate for crew leader
		$csi = 1;
		$them = $police;
	} elseif($police == 1){
		//build rap sheet
		//pick a crime type
		$felony = rand(1,3);
		if($felony == 1){
			//id numbers runners
			newcase($user,$felony);
			$patrols_left = 5;		
		} elseif($felony == 2) {
			//id bootleggers
			newcase($user,$felony);
			$patrols_left = 5;		
		} elseif($felony == 3) {
			//id drug runners
			newcase($user,$felony);
			$patrols_left = 5;		
		}
		$charged = 1;
	}elseif($police == 3 || $police == 4){
		//hot pursuit...present rap sheet
		$pursuit = 1;
	}elseif($police == 86){
		$query = sprintf("SELECT patrol FROM h_investigations WHERE UPPER(cop) = UPPER('%s')",
		mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($patrol) = mysql_fetch_row($result);
		
		$query = sprintf("SELECT patrol_count FROM h_investigations WHERE UPPER(cop) = UPPER('%s')",
		mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($count) = mysql_fetch_row($result);
		
		$patrols_left = 5 - $count;
		
		$dock = 50;
		$busy = 86;
		$charged = 1;
	}
}
//Trading post
$dvd = getGoods("dvd",$userID);
$lotto = getGoods("lotto",$userID);
$magic = getGoods("coke",$userID);
$roids = getGoods("roids",$userID);

if($dvd > 0 || $lotto > 0 || $magic > 0 || $roids > 0){
	$type = "dealer";
} else {
	$type = "citizen";
}
if(empty($magic)){
	$magic = 0;
}
//check if lotto has been won
$query = sprintf("SELECT pot FROM h_lottery WHERE done = ('%s')",
		0);
$result = mysql_query($query);
list($pot) = mysql_fetch_row($result);
$lotto_pot = number_format($pot, 0, ',', ',');
//ongoing investigations
$query = sprintf("SELECT COUNT(id) FROM h_investigations WHERE UPPER(cop) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($ongoing) = mysql_fetch_row($result);
if($ongoing > 0){
	$active = 1;
} else {
	$active = 0;
}
$query = sprintf("SELECT COUNT(id) FROM h_rap_sheet WHERE UPPER(hood) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($ouch) = mysql_fetch_row($result);

$query = sprintf("SELECT warned FROM h_rap_sheet WHERE UPPER(hood) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($warned) = mysql_fetch_row($result);
if($warned == 0){
	if($ouch > 0){
		$onthelist = 1;
		$sql = sprintf("UPDATE h_rap_sheet SET warned = ('%s') WHERE UPPER(hood) = UPPER('%s')",
							mysql_real_escape_string(1),
							mysql_real_escape_string($user));
							mysql_query($sql);
	} else {
		$onthelist = 0;
	}
}
$run = 0;
$query = sprintf("SELECT * FROM h_chases WHERE UPPER(hood) = UPPER('%s') AND done = ('%s')",
		mysql_real_escape_string($user),
		0);
$result = mysql_query($query);
$thea = mysql_fetch_assoc($result);
if(is_array($thea)){
	$gid = $thea["gameid"];
	$thegame = pickgame($gid);
	$run = 1;
}

//force shield
$shield = getShield($userID);

$query = sprintf("SELECT timeLeft FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($health_update) = mysql_fetch_row($result);
if($health_update == 0){
	$health_update = $health_timer;
}

$query = sprintf("SELECT etimeLeft FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($eclock) = mysql_fetch_row($result);
if($eclock == 0){
	$eclock = $clock;
}

$query = sprintf("SELECT agent FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($federali) = mysql_fetch_row($result);
if($federali == 3 && law == "citizen"){
	$reject = 3;
}
$query = sprintf("SELECT ring_phone FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($call) = mysql_fetch_row($result);

$query = sprintf("SELECT tutorial_on FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($teach) = mysql_fetch_row($result);
if($teach == 1){
	$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($chapter) = mysql_fetch_row($result);
	$call = 4;
} else {
	$chapter = 0;
}

$query = sprintf("SELECT heist_alert FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($itstime) = mysql_fetch_row($result);

$poller = json_encode(array(
  "cool" => $cool,
  "stage" => $stage,
  "token" => $token,
  "energy" => $energy,
  "cool_max" => $cool_max,
  "energy_max" => $energy_max, 
  "cash" => $cash, 
  "crew_rank" => $crew_rank,
  "level_label" => $l_label,
  "cash_cow" => $cash_cow,
  "cow_earns" => $gross_earnings,
  "cash_drain" => $cash_drain,
  "drain_loss" => $gross_losses,
  "first" => $fl_facebook,
  "change_per" => $interval,
  "time_left" => $eclock,
  "timer" => $clock,
  "newnews" => $news_checked,
  "crime" => $crime,
  "law" => $law,
  "signup" => $stopit,
  "fbi" => $fbi,
  "tcode" => $tcode,
  "thegame" => $thegame,
  "tbonus" => $cp_bonus,
  "tcash" => $cash_p,
  "tfee" => $fee,
  "score" => $score,
  "lotto" => $lotto_pot,
  "igoods" => $type,
  "pain" => $pain,
  "csi" => $csi,
  "them" => $them,
  "pursuit" => $pursuit,
  "charged" => $charged,
  "felony" => $felony,
  "ongoing" => $active,
  "busysock" => $busy,
  "cautionsock" => $onthelist,
  "runsock" => $run,
  "coke" => $magic,
  "patrol" => $patrol,
  "patrols_left" => $patrols_left,
  "agent" => $call,
  "health" => $health,
  "shield" => $shield,
  "health_per" => $health_per,
  "health_timer" => $health_timer,
  "health_update" => $health_update,
  "rejected" => $federali,
  "teachme" => $chapter,
  "icons" => $rampage,
  "robbery" => $itstime,
));

echo $poller
 
?>