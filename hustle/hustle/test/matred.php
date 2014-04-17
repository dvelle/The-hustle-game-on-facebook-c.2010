<?php
include('stats.php');

include('connect.php');
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_REQUEST['data'];
$biz_id = $_REQUEST['business'];
//$biz_id = 153;
//$user = "jermongreen";
$patron = $user;
//functions
function ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] 'ago' ";
}
//Rob everyone

//picture //name //crew // Attack button
$stack = array();
$sql = sprintf("SELECT COUNT(id) FROM h_patrons WHERE casino_id = ('%s') OR club_id = ('%s')",
							mysql_real_escape_string($biz_id),
							mysql_real_escape_string($biz_id));
	$result = mysql_query($sql);
list($count) = mysql_fetch_row($result);	
if($count > 0){
	$patron_id = id($user);
	
	$sql = sprintf("SELECT user_id FROM h_user_assets WHERE id = ('%s')",
							mysql_real_escape_string($biz_id));
		$results = mysql_query($sql);
	list($owner_id) = mysql_fetch_row($results);
	
	$sql = sprintf("SELECT fee FROM h_user_assets WHERE id = ('%s')",
							mysql_real_escape_string($biz_id));
						$results = mysql_query($sql);
	list($fee) = mysql_fetch_row($results);
	$pocket = getStat("cash",$patron_id);
	$debit = $pocket - $fee;
	if($debit <= 0){
		echo 2;
	} else {
		$sql = sprintf("SELECT COUNT(id) FROM h_patrons WHERE club_id = ('%s')",
							mysql_real_escape_string($biz_id));
			$result = mysql_query($sql);
		list($count1) = mysql_fetch_row($result);
		if(!empty($count1)){
			$query = sprintf("INSERT INTO h_patrons(club_id,user_id) VALUES ('%s','%s')",
								mysql_real_escape_string($biz_id),
								mysql_real_escape_string($patron_id));
							mysql_query($query);
		} else {
			$query = sprintf("INSERT INTO h_patrons(casino_id,user_id) VALUES ('%s','%s')",
							mysql_real_escape_string($biz_id),
							mysql_real_escape_string($patron_id));
						mysql_query($query);
		}
		if($patron_id != $owner_id){
			setStat("cash",$patron_id,$debit);							
			visiter($owner_id,$biz_id);
			//cool
			$sql = sprintf("SELECT worth FROM h_user_assets WHERE id = ('%s')",
			mysql_real_escape_string($biz_id));
			$results = mysql_query($sql);
			list($worth) = mysql_fetch_row($results);
			if(!empty($worth)){
				$min = round($worth * .01);
				$coolness = $min * 10;
				
				$cur = getStat("exp",$patron_id);
				$upd = $cur + $coolness;
				setStat("exp",$patron_id,$upd);
			}
			//
			$ill_sql = sprintf("SELECT * FROM h_patrons WHERE casino_id = ('%s') OR club_id = ('%s')",
							mysql_real_escape_string($biz_id),
							mysql_real_escape_string($biz_id));
			$iresult = mysql_query($ill_sql);	
			//take snap show of everyone in club after measuring owner security
			?>
			<div id='bizheist_alerts'>
            <?php
			while($goods = mysql_fetch_assoc($iresult)){
					$userid = $goods["user_id"];
					$iuid = id($user);
					$sql = sprintf("SELECT * FROM h_users WHERE id = ('%s')",
									mysql_real_escape_string($userid));
					$resulter = mysql_query($sql);
					$custs = mysql_fetch_assoc($resulter);
					if(!empty($custs)){						
						
						$patron = $custs["user"];
						
						$game_n = $custs["game_name"];
						
						$image = $custs["image"];			
						
						$face = "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'";
					} else {
						//NPC
						$sql = sprintf("SELECT * FROM h_npcs WHERE id = ('%s')",
									mysql_real_escape_string($userid));
						$resulter = mysql_query($sql);
						$npc = mysql_fetch_assoc($resulter);
						$game_n = $npc["firstname"];
						
						$patron = $npc["npc"];
						
						$image = $npc["image_icon"];			
						
						$face = "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'";
					}
					if($patron == $user){
						//
					} else {
						echo "<form id='robbery_form' name='robbery_form' method='post' action='warroom.php'><tr><td>".$face."</td><td> ".ucwords($game_n)."</td></span><input name='target' type='hidden' value='$patron' /><input name='instigator' type='hidden' 'value='$user' /><input name='submit' type='submit' value='Rob' /></tr></form><hr />";	
					}
			}
		} 
	}
} else {
	echo "No one is here...";
}
?>
</div>