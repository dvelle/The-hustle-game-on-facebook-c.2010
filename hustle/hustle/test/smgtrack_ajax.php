<?
$user = $_REQUEST["data"];
//$user = "jermongreen";
require_once 'connect.php';	// this is from our earlier article on configuration files in PHP

require_once 'crimes.php';
require_once 'collars.php';

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);


$query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($crewID) = mysql_fetch_row($result);

//News Alert
$query2 = sprintf("SELECT checked FROM h_user_news WHERE UPPER(receiver) = UPPER('%s')",
				mysql_real_escape_string($user));
$result2 = mysql_query($query2);
list($news_checked) = mysql_fetch_row($result2);


require_once 'stats.php';
require_once 'leveler_sec.php';

$userID = id($user);
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
	$query = sprintf("SELECT * FROM h_crew_member WHERE crew_earnings = ('%s')",
			mysql_real_escape_string($test));
	$result = mysql_query($query);
	$work = mysql_fetch_assoc($result);
	//which crew leader is paying out the most?
	$leader = $work["crew_id"];
	$earnings = $test;
	$bonuses = $work["bonus_pay"];	
	$gross_earnings = $earnings + $bonuses;
	
	//find their name
	$query2 = sprintf("SELECT user FROM h_crew_main WHERE id = ('%s')",
				mysql_real_escape_string($leader));
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
	$info_query = sprintf("SELECT * FROM h_crew_member WHERE crew_losses = ('%s')",
			mysql_real_escape_string($d_test));
	$info_result = mysql_query($info_query);
	$file_work = mysql_fetch_assoc($info_result);
	//which crew leader is paying out the most?
	$d_leader = $file_work["crew_id"];
	$losses = $d_test;
	$extra = $file_work["bonus_bank"];	
	$gross_losses = $losses + $extra;
	
	//find their name
	$query2 = sprintf("SELECT user FROM h_crew_main WHERE id = ('%s')",
				mysql_real_escape_string($leader));
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
//Timer
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
	$clock = $lvl_arr["time_cycle"];
	$health_per = $lvl_arr["health_per"];	
	$health_timer = $lvl_arr["health_cycle"];
} else {
	$interval = 1;	
	$clock = 260;
	$health_per = 10;
	$health_timer = 360;
}

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

$query = sprintf("SELECT heist_alert FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($itstime) = mysql_fetch_row($result);


$query = sprintf("SELECT tutorial_on FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($teach) = mysql_fetch_row($result);
if($teach == 1){
	$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($chapter) = mysql_fetch_row($result);
} else {
	$chapter = 0;
}

$query = sprintf("SELECT terms FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($terms) = mysql_fetch_row($result);

$terms = $terms + 1;

$query = sprintf("UPDATE h_users SET terms = '%s' WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($terms),
		mysql_real_escape_string($user));
mysql_query($query);

$query = sprintf("SELECT terms_on FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($terms_on) = mysql_fetch_row($result);
if($terms > 2 && $terms_on == 1){
	$welcome = 1;
}

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
  "health" => $health,
  "shield" => $shield,
  "health_per" => $health_per,
  "health_timer" => $health_timer,
  "health_update" => $health_update,
  "teachme" => $chapter,
  "robbery" => $itstime,
  "sign" => $welcome,
));

echo $poller
 
?>