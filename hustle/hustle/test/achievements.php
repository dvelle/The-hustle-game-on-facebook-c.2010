<?php
require_once 'stats.php';

//Achievements Cron
//************************************************************
// Robber Baron Award
$sql = "SELECT * FROM h_users ORDER BY rob_won DESC LIMIT 1";
$results = mysql_query($sql);
$winner_ar = mysql_fetch_assoc($results);
$baron_who = $winner_ar["id"];
$baron_theuser = $winner_ar["user"];
//Check for previous title holder
$sql = sprintf("SELECT user_id FROM h_user_achievements WHERE a_id = (SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s')",
			mysql_real_escape_string("baron"),
			mysql_real_escape_string("baron"));
$result = mysql_query($sql);
list($baron_champ) = mysql_fetch_row($result);
if($baron_champ != $baron_who){			
	//Give award
	$query = sprintf("INSERT INTO h_user_achievements(a_id,user_id,time) VALUES ((SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
	mysql_real_escape_string("baron"),
	mysql_real_escape_string("baron"),
	mysql_real_escape_string($baron_who),
	$time);
	mysql_query($query);
	//Bonuses
	$sql = sprintf("SELECT * FROM h_achievements WHERE name = '%s' OR short_name = '%s'",
			mysql_real_escape_string("baron"),
			mysql_real_escape_string("baron"));
	$result = mysql_query($sql);
	$bonus_ar = mysql_fetch_assoc($result);		
	$title_n = $bonus_ar["name"];
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$baron_who);
	$boost = $coolman + $cppush;
	setStat("exp",$baron_who,$boost);
	//Cash
	$prize = $bonus_ar["cash_bonus"];
	$pocket = getStat("cash",$baron_who);
	$yipee = $prize + $pocket;
	setStat("cash",$baron_who,$yipee);
	//Send good news
	$recipient_message = "Achievement Unlocked <b>".ucwords($title_n)."</b> with a prize of ".$cppush."CP and $".$prize;
	//
	hustle_reporter($theuser,1,$recipient_message,"recipient");
	//Bad NEWS
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$baron_champ);
	$boost = $coolman - $cppush;
	setStat("exp",$baron_champ,$boost);
	//Send bad news
	$sql = sprintf("SELECT user FROM h_users WHERE id = '%s'",
			mysql_real_escape_string($baron_champ));
	$result = mysql_query($sql);
	list($baron_user_name) = mysql_fetch_row($result);
	//
	$recipient_message = "You just lost both the title of <b>".ucwords($title_n)."</b> and the title's CP Bonus of ".$cppush;
	//
	hustle_reporter($baron_user_name,1,$recipient_message,"recipient");
}

//***********************************************************
//rank flight score
$sql = "SELECT * FROM h_top_players ORDER BY flight_score ASC LIMIT 1";
$results = mysql_query($sql);
$winner_ar = mysql_fetch_assoc($results);
$wuser = $winner_ar["user"];
$sql = sprintf("SELECT id FROM h_users WHERE user = '%s'",
			mysql_real_escape_string($wuser));
$result = mysql_query($sql);
list($star_who) = mysql_fetch_row($result);
//Check for previous title holder
$sql = sprintf("SELECT user_id FROM h_user_achievements WHERE a_id = (SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s')",
			mysql_real_escape_string("star"),
			mysql_real_escape_string("star"));
$result = mysql_query($sql);
list($star_champ) = mysql_fetch_row($result);
if($star_champ != $star_who){			
	//Give award
	$query = sprintf("INSERT INTO h_user_achievements(a_id,user_id,time) VALUES ((SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
	mysql_real_escape_string("star"),
	mysql_real_escape_string("star"),
	mysql_real_escape_string($star_who),
	$time);
	mysql_query($query);
	//Bonuses
	$sql = sprintf("SELECT * FROM h_achievements WHERE name = '%s' OR short_name = '%s'",
			mysql_real_escape_string("star"),
			mysql_real_escape_string("star"));
	$result = mysql_query($sql);
	$bonus_ar = mysql_fetch_assoc($result);
	
	$title_n = $bonus_ar["name"];
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$star_who);
	$boost = $coolman + $cppush;
	setStat("exp",$star_who,$boost);
	//Cash
	$prize = $bonus_ar["cash_bonus"];
	$pocket = getStat("cash",$star_who);
	$yipee = $prize + $pocket;
	setStat("cash",$star_who,$yipee);
	//Send good news
	$recipient_message = "Achievement Unlocked <b>".ucwords($title_n)."</b> with a prize of ".$cppush."CP and $".$prize;
	//
	hustle_reporter($wuser,1,$recipient_message,"recipient");
	//Bad NEWS
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$star_champ);
	$boost = $coolman - $cppush;
	setStat("exp",$champ,$boost);
	//Send bad news
	$sql = sprintf("SELECT user FROM h_users WHERE id = '%s'",
			mysql_real_escape_string($star_champ));
	$result = mysql_query($sql);
	list($star_user_name) = mysql_fetch_row($result);
	//
	$recipient_message = "You just lost both the title of <b>".ucwords($title_n)."</b> and the title's CP Bonus of ".$cppush;
	//
	hustle_reporter($star_user_name,1,$recipient_message,"recipient");
}

//*********************************************************
//Celebrity
$sql = "SELECT * FROM h_users ORDER BY tot_offers DESC LIMIT 1";
$results = mysql_query($sql);
$winner_ar = mysql_fetch_assoc($results);
$cel_who = $winner_ar["id"];	
$cel_theuser = $winner_ar["user"];
//Check for previous title holder
$sql = sprintf("SELECT user_id FROM h_user_achievements WHERE a_id = (SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s')",
			mysql_real_escape_string("cel"),
			mysql_real_escape_string("cel"));
$result = mysql_query($sql);
list($cel_champ) = mysql_fetch_row($result);
if($cel_champ != $cel_who){			
	//Give award
	$query = sprintf("INSERT INTO h_user_achievements(a_id,user_id,time) VALUES ((SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
	mysql_real_escape_string("cel"),
	mysql_real_escape_string("cel"),
	mysql_real_escape_string($cel_who),
	$time);
	mysql_query($query);
	//Bonuses
	$sql = sprintf("SELECT * FROM h_achievements WHERE name = '%s' OR short_name = '%s'",
			mysql_real_escape_string("cel"),
			mysql_real_escape_string("cel"));
	$result = mysql_query($sql);
	$bonus_ar = mysql_fetch_assoc($result);
	$title_n = $bonus_ar["name"];
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$cel_who);
	$boost = $coolman + $cppush;
	setStat("exp",$cel_who,$boost);
	//Cash
	$prize = $bonus_ar["cash_bonus"];
	$pocket = getStat("cash",$cel_who);
	$yipee = $prize + $pocket;
	setStat("cash",$cel_who,$yipee);
	//Send good news
	$recipient_message = "Achievement Unlocked <b>".ucwords($title_n)."</b> with a prize of ".$cppush."CP and $".$prize;
	//
	hustle_reporter($cel_theuser,1,$recipient_message,"recipient");
	//Bad NEWS
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$cel_champ);
	$boost = $coolman - $cppush;
	setStat("exp",$cel_champ,$boost);
	//Send bad news
	$sql = sprintf("SELECT user FROM h_users WHERE id = '%s'",
			mysql_real_escape_string($cel_champ));
	$result = mysql_query($sql);
	list($cel_user_name) = mysql_fetch_row($result);
	//
	$recipient_message = "You just lost both the title of <b>".ucwords($title_n)."</b> and the title's CP Bonus of ".$cppush;
	//
	hustle_reporter($cel_user_name,1,$recipient_message,"recipient");
}

//**********************************************************
//arcade champ
$sql = "SELECT * FROM h_users ORDER BY arcade_champ DESC LIMIT 1";
$results = mysql_query($sql);
$winner_ar = mysql_fetch_assoc($results);
$arc_who = $winner_ar["id"];
$arc_theuser = $winner_ar["user"];
//Check for previous title holder
$sql = sprintf("SELECT user_id FROM h_user_achievements WHERE a_id = (SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s')",
			mysql_real_escape_string("arc"),
			mysql_real_escape_string("arc"));
$result = mysql_query($sql);
list($arc_champ) = mysql_fetch_row($result);
if($arc_champ != $arc_who){			
	//Give award
	$query = sprintf("INSERT INTO h_user_achievements(a_id,user_id,time) VALUES ((SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
	mysql_real_escape_string("arc"),
	mysql_real_escape_string("arc"),
	mysql_real_escape_string($arc_who),
	$time);
	mysql_query($query);
	//Bonuses
	$sql = sprintf("SELECT * FROM h_achievements WHERE name = '%s' OR short_name = '%s'",
			mysql_real_escape_string("arc"),
			mysql_real_escape_string("arc"));
	$result = mysql_query($sql);
	$bonus_ar = mysql_fetch_assoc($result);
	$title_n = $bonus_ar["name"];
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$arc_who);
	$boost = $coolman + $cppush;
	setStat("exp",$arc_who,$boost);
	//Cash
	$prize = $bonus_ar["cash_bonus"];
	$pocket = getStat("cash",$who);
	$yipee = $prize + $pocket;
	setStat("cash",$arc_who,$yipee);
	//Send good news
	$recipient_message = "Achievement Unlocked <b>".ucwords($title_n)."</b> with a prize of ".$cppush."CP and $".$prize;
	//
	hustle_reporter($arc_theuser,1,$recipient_message,"recipient");
	//Bad NEWS
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$arc_champ);
	$boost = $coolman - $cppush;
	setStat("exp",$arc_champ,$boost);
	//Send bad news
	$sql = sprintf("SELECT user FROM h_users WHERE id = '%s'",
			mysql_real_escape_string($arc_champ));
	$result = mysql_query($sql);
	list($arc_user_name) = mysql_fetch_row($result);
	//
	$recipient_message = "You just lost both the title of <b>".ucwords($title_n)."</b> and the title's CP Bonus of ".$cppush;
	//
	hustle_reporter($arc_user_name,1,$recipient_message,"recipient");
}

//********************************************************
//philantropy
$sql = "SELECT * FROM h_users ORDER BY philanthropy DESC LIMIT 1";
$results = mysql_query($sql);
$winner_ar = mysql_fetch_assoc($results);
$gift_who = $winner_ar["id"];
$gift_theuser = $winner_ar["user"];
//Check for previous title holder
$sql = sprintf("SELECT user_id FROM h_user_achievements WHERE a_id = (SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s')",
			mysql_real_escape_string("gift"),
			mysql_real_escape_string("gift"));
$result = mysql_query($sql);
list($gift_champ) = mysql_fetch_row($result);
if($gift_champ != $gift_who){			
	//Give award
	$query = sprintf("INSERT INTO h_user_achievements(a_id,user_id,time) VALUES ((SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
	mysql_real_escape_string("gift"),
	mysql_real_escape_string("gift"),
	mysql_real_escape_string($gift_who),
	$time);
	mysql_query($query);
	//Bonuses
	$sql = sprintf("SELECT * FROM h_achievements WHERE name = '%s' OR short_name = '%s'",
			mysql_real_escape_string("gift"),
			mysql_real_escape_string("gift"));
	$result = mysql_query($sql);
	$bonus_ar = mysql_fetch_assoc($result);
	$title_n = $bonus_ar["name"];
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$gift_who);
	$boost = $coolman + $cppush;
	setStat("exp",$gift_who,$boost);
	//Cash
	$prize = $bonus_ar["cash_bonus"];
	$pocket = getStat("cash",$gift_who);
	$yipee = $prize + $pocket;
	setStat("cash",$gift_who,$yipee);
	//Send good news
	$recipient_message = "Achievement Unlocked <b>".ucwords($title_n)."</b> with a prize of ".$cppush."CP and $".$prize;
	//
	hustle_reporter($gift_theuser,1,$recipient_message,"recipient");
	//Bad NEWS
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$gift_champ);
	$boost = $coolman - $cppush;
	setStat("exp",$gift_champ,$boost);
	//Send bad news
	$sql = sprintf("SELECT user FROM h_users WHERE id = '%s'",
			mysql_real_escape_string($champ));
	$result = mysql_query($sql);
	list($gift_user_name) = mysql_fetch_row($result);
	//
	$recipient_message = "You just lost both the title of <b>".ucwords($title_n)."</b> and the title's CP Bonus of ".$cppush;
	//
	hustle_reporter($gift_user_name,1,$recipient_message,"recipient");
}

//********************************************************
//Coolest Player
$sql = "SELECT * FROM h_users ORDER BY cool DESC LIMIT 1";
$results = mysql_query($sql);
$winner_ar = mysql_fetch_assoc($results);
$lcool_who = $winner_ar["id"];
$lcool_theuser = $winner_ar["user"];
//Check for previous title holder
$sql = sprintf("SELECT user_id FROM h_user_achievements WHERE a_id = (SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s')",
			mysql_real_escape_string("lcool"),
			mysql_real_escape_string("lcool"));
$result = mysql_query($sql);
list($lcool_champ) = mysql_fetch_row($result);

if($lcool_champ != $lcool_who){			
	//Give award
	$query = sprintf("INSERT INTO h_user_achievements(a_id,user_id,time) VALUES ((SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
	mysql_real_escape_string("lcool"),
	mysql_real_escape_string("lcool"),
	mysql_real_escape_string($who),
	$time);
	mysql_query($query);
	//Bonuses
	$sql = sprintf("SELECT * FROM h_achievements WHERE name = '%s' OR short_name = '%s'",
			mysql_real_escape_string("lcool"),
			mysql_real_escape_string("lcool"));
	$result = mysql_query($sql);
	$bonus_ar = mysql_fetch_assoc($result);
	$title_n = $bonus_ar["name"];
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$lcool_who);
	$boost = $coolman + $cppush;
	setStat("exp",$lcool_who,$boost);
	//Cash
	$prize = $bonus_ar["cash_bonus"];
	$pocket = getStat("cash",$lcool_who);
	$yipee = $prize + $pocket;
	setStat("cash",$lcool_who,$yipee);
	//Send good news
	$recipient_message = "Achievement Unlocked <b>".ucwords($title_n)."</b> with a prize of ".$cppush."CP and $".$prize;
	//
	hustle_reporter($theuser,1,$recipient_message,"recipient");
	//Bad NEWS
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$lcool_champ);
	$boost = $coolman - $cppush;
	setStat("exp",$lcool_champ,$boost);
	//Send bad news
	$sql = sprintf("SELECT user FROM h_users WHERE id = '%s'",
			mysql_real_escape_string($lcool_champ));
	$result = mysql_query($sql);
	list($lcool_user_name) = mysql_fetch_row($result);
	//
	$recipient_message = "You just lost both the title of <b>".ucwords($title_n)."</b> and the title's CP Bonus of ".$cppush;
	//
	hustle_reporter($lcool_user_name,1,$recipient_message,"recipient");
}	

//********************************************************
//Coolest Crew
$sql = "SELECT * FROM h_users ORDER BY crew_cool DESC LIMIT 1";
$results = mysql_query($sql);
$winner_ar = mysql_fetch_assoc($results);
$ccool_who = $winner_ar["id"];
$leader = $winner_ar["user"];
//Check for previous title holder
$sql = sprintf("SELECT user_id FROM h_user_achievements WHERE a_id = (SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s')",
			mysql_real_escape_string("ccool"),
			mysql_real_escape_string("ccool"));
$result = mysql_query($sql);
list($ccool_champ) = mysql_fetch_row($result);

if($ccool_champ != $ccool_who){			
	//Give award
	$query = sprintf("INSERT INTO h_user_achievements(a_id,user_id,time) VALUES ((SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
	mysql_real_escape_string("ccool"),
	mysql_real_escape_string("ccool"),
	mysql_real_escape_string($ccool_who),
	$time);
	mysql_query($query);
	//Bonuses
	$sql = sprintf("SELECT * FROM h_achievements WHERE name = '%s' OR short_name = '%s'",
			mysql_real_escape_string("ccool"),
			mysql_real_escape_string("ccool"));
	$result = mysql_query($sql);
	$bonus_ar = mysql_fetch_assoc($result);
	$title_n = $bonus_ar["name"];
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$ccool_who);
	$boost = $coolman + $cppush;
	setStat("exp",$ccool_who,$boost);
	//Cash
	$prize = $bonus_ar["cash_bonus"];
	$pocket = getStat("cash",$ccool_who);
	$yipee = $prize + $pocket;
	setStat("cash",$who,$yipee);
	//Send good news
	$recipient_message = "Achievement Unlocked <b>".ucwords($title_n)."</b> with a prize of ".$cppush."CP and $".$prize;
	//
	hustle_reporter($leader,1,$recipient_message,"recipient");
	//Bad NEWS
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$ccool_champ);
	$boost = $coolman - $cppush;
	setStat("exp",$ccool_champ,$boost);
	
	//Send bad news
	$sql = sprintf("SELECT user FROM h_users WHERE id = '%s'",
			mysql_real_escape_string($ccool_champ));
	$result = mysql_query($sql);
	list($ccool_user_name) = mysql_fetch_row($result);
	//
	$recipient_message = "You just lost both the title of <b>".ucwords($title_n)."</b> and the title's CP Bonus of ".$cppush;
	//
	hustle_reporter($ccool_user_name,1,$recipient_message,"recipient");
	///**********///
	//Award MEMBErs
	$query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($leader));
	$results = mysql_query($query);
	list($crewid) = mysql_fetch_row($result);
	
	$query_2 = sprintf("SELECT * FROM h_crew_member WHERE crew_id = ('%s') AND user != ('%s')",
								mysql_real_escape_string($crewid),
								mysql_real_escape_string($user));
	$result_2 = mysql_query($query_2);
	
	$stacker = array();
	while($crew_arr = mysql_fetch_assoc($result_2)){
		$mem= $crew_arr["user"];
		$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
								mysql_real_escape_string($mem));
		$result = mysql_query($query);
		list($memid) = mysql_fetch_row($result);
		//Member Bonuses
		$sql = sprintf("SELECT * FROM h_achievements WHERE name = '%s' OR short_name = '%s'",
				mysql_real_escape_string("memcool"),
				mysql_real_escape_string("memcool"));
		$result = mysql_query($sql);
		$bonus_ar = mysql_fetch_assoc($result);
		$title_n = $bonus_ar["name"];
		$cppush = $bonus_ar["cp_bonus"];
		$coolman = getStat("exp",$memid);
		$boost = $coolman + $cppush;
		setStat("exp",$memid,$boost);
		//Cash
		$prize = $bonus_ar["cash_bonus"];
		$pocket = getStat("cash",$memid);
		$yipee = $prize + $pocket;
		setStat("cash",$memid,$yipee);
		//Send good news
	$recipient_message = "Achievement Unlocked <b>".ucwords($title_n)."</b> with a prize of ".$cppush."CP and $".$prize;
	//
	hustle_reporter($mem,1,$recipient_message,"recipient");
	}
}

//********************************************************
//Wealthiest Player
$sql = "SELECT * FROM h_users ORDER BY bank DESC LIMIT 1";
$results = mysql_query($sql);
$winner_ar = mysql_fetch_assoc($results);
$wdollar_who = $winner_ar["id"];
$wdollar_theuser = $winner_ar["user"];
//Check for previous title holder
$sql = sprintf("SELECT user_id FROM h_user_achievements WHERE a_id = (SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s')",
			mysql_real_escape_string("wdollar"),
			mysql_real_escape_string("wdollar"));
$result = mysql_query($sql);
list($wdollar_champ) = mysql_fetch_row($result);

if($wdollar_champ != $wdollar_who){			
	//Give award
	$query = sprintf("INSERT INTO h_user_achievements(a_id,user_id,time) VALUES ((SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
	mysql_real_escape_string("wdollar"),
	mysql_real_escape_string("wdollar"),
	mysql_real_escape_string($wdollar_who),
	$time);
	mysql_query($query);
	//Bonuses
	$sql = sprintf("SELECT * FROM h_achievements WHERE name = '%s' OR short_name = '%s'",
			mysql_real_escape_string("wdollar"),
			mysql_real_escape_string("wdollar"));
	$result = mysql_query($sql);
	$bonus_ar = mysql_fetch_assoc($result);
	$title_n = $bonus_ar["name"];
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$wdollar_who);
	$boost = $coolman + $cppush;
	setStat("exp",$wdollar_who,$boost);
	//Cash
	$prize = $bonus_ar["cash_bonus"];
	$pocket = getStat("cash",$wdollar_who);
	$yipee = $prize + $pocket;
	setStat("cash",$wdollar_who,$yipee);
	//Send good news
	$recipient_message = "Achievement Unlocked <b>".ucwords($title_n)."</b> with a prize of ".$cppush."CP and $".$prize;
	//
	hustle_reporter($wdollar_theuser,1,$recipient_message,"recipient");
	//Bad NEWS
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$wdollar_champ);
	$boost = $coolman - $cppush;
	setStat("exp",$wdollar_champ,$boost);
	//Send bad news
	$sql = sprintf("SELECT user FROM h_users WHERE id = '%s'",
			mysql_real_escape_string($champ));
	$result = mysql_query($sql);
	list($wdollar_user_name) = mysql_fetch_row($result);
	//
	$recipient_message = "You just lost both the title of <b>".ucwords($title_n)."</b> and the title's CP Bonus of ".$cppush;
	//
	hustle_reporter($wdollar_user_name,1,$recipient_message,"recipient");
}

//********************************************************
//Legendary Player
$sql = "SELECT * FROM h_users ORDER BY legend_rec DESC LIMIT 1";
$results = mysql_query($sql);
$winner_ar = mysql_fetch_assoc($results);
$leg_who = $winner_ar["id"];
$leg_theuser = $winner_ar["user"];
//Check for previous title holder
$sql = sprintf("SELECT user_id FROM h_user_achievements WHERE a_id = (SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s')",
			mysql_real_escape_string("leg"),
			mysql_real_escape_string("leg"));
$result = mysql_query($sql);
list($leg_champ) = mysql_fetch_row($result);
if($leg_champ != $leg_who){			
	//Give award
	$query = sprintf("INSERT INTO h_user_achievements(a_id,user_id,time) VALUES ((SELECT id FROM h_achievements WHERE name = '%s' OR short_name = '%s'),'%s','%s')",
	mysql_real_escape_string("leg"),
	mysql_real_escape_string("leg"),
	mysql_real_escape_string($leg_who),
	$time);
	mysql_query($query);
	//Bonuses
	$sql = sprintf("SELECT * FROM h_achievements WHERE name = '%s' OR short_name = '%s'",
			mysql_real_escape_string("leg"),
			mysql_real_escape_string("leg"));
	$result = mysql_query($sql);
	$bonus_ar = mysql_fetch_assoc($result);
	$title_n = $bonus_ar["name"];
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$leg_who);
	$boost = $coolman + $cppush;
	setStat("exp",$leg_who,$boost);
	//Cash
	$prize = $bonus_ar["cash_bonus"];
	$pocket = getStat("cash",$leg_who);
	$yipee = $prize + $pocket;
	setStat("cash",$leg_who,$yipee);
	//Send good news
	$recipient_message = "Achievement Unlocked <b>".ucwords($title_n)."</b> with a prize of ".$cppush."CP and $".$prize;
	//
	hustle_reporter($leg_theuser,1,$recipient_message,"recipient");
	//Bad NEWS
	$cppush = $bonus_ar["cp_bonus"];
	$coolman = getStat("exp",$leg_champ);
	$boost = $coolman - $cppush;
	setStat("exp",$leg_champ,$boost);
	//Send bad news
	$sql = sprintf("SELECT user FROM h_users WHERE id = '%s'",
			mysql_real_escape_string($leg_champ));
	$result = mysql_query($sql);
	list($leg_user_name) = mysql_fetch_row($result);
	//
	$recipient_message = "You just lost both the title of<b>".ucwords($title_n)."</b> and the title's CP Bonus of ".$cppush;
	//
	hustle_reporter($leg_user_name,1,$recipient_message,"recipient");
}
?>