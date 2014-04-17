<?php
include('stats.php');

include('connect.php');
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_REQUEST['data'];
//$user = "jermongreen";

//Check news
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
//Who just made me or lost me some money?

?>
<div id="hustle_up">
<table>
<?php
//Any crew Offers?
//Any New Gifts?
$gift_sql = sprintf("SELECT * FROM h_crew_gift WHERE recipient = ('%s') ORDER BY id DESC",
																									 mysql_real_escape_string($user));
$gresult = mysql_query($gift_sql);

while($gifts = mysql_fetch_assoc($gresult)){
	
		$cid = $gifts["crew_id"];
		$gift_name = $gifts["gift"];
		$amount = $gifts["quantity"];
		if($gift_name == "coke"){
			$var = " ounces of ";
			$var3 = " to distribute ";
		} elseif($gift_name=="dvd"){
			$var = " copies of ";
			$var3 = " to distribute ";
		}
		$query = sprintf("SELECT title FROM h_crew_main WHERE id = ('%s')",
									mysql_real_escape_string($cid));
				$result = mysql_query($query);
				list($title) = mysql_fetch_row($result);
		$time = $gifts["time"];
		$date = ago($time);
		echo "<div id='gifts_alerts'><form id='mygifts' name='mygifts' method='post' action='giftpickup.php'> Your crew the ".$title."'s, just offered you".$amount.$var."<span style='color:#00F;'><strong>".$gift_name."</strong></span>".$var3.$date."<br />
<input name='item' type='hidden' value='".$gift_name."' /><input name='crew' type='hidden' value='".$cid."' /><input name='quantity' type='hidden' value='".$amount."' /><input name='who' type='hidden' value='".$user."' /><input name='decision' type='submit' value='Accept' /><input name='decision' type='submit' value='Decline' /></form><hr /><br /></div>";
	
}
//Hustle Achievements

//Any New requests?
$ill_sql = sprintf("SELECT * FROM h_user_requests WHERE dealer = ('%s') ORDER BY id DESC",
						mysql_real_escape_string($user));
$iresult = mysql_query($ill_sql);

while($goods = mysql_fetch_assoc($iresult)){
	
		$goffer = $goods["offer"];
		$item = $goods["item"];
		$customer = $goods["customer"];
		$amount = $goods["quantity"];
		$time = $goods["time"];
		$id = $goods["id"];
		$date = ago($time);
		if($item == "coke"){
			$var = " ounce(s) of that <b>Blue</b>";
		} elseif($item == "dvd"){
			$var = " copy(s) of those new DVDs";
		} elseif($item =="lotto"){
			$var = " numbers to play on the next Lotto drawing";
		}				
		echo "<div id='good_alerts'><form id='myfeens' name='myfeens' method='post' action='goodsdelivery.php'>".ucwords($customer)." just offered you <span style='color:#00F;'><strong>$".$goffer."</strong></span> for ".$amount.$var."<br />
<input name='item' type='hidden' value='".$item."' /><input name='offer' type='hidden' value='".$goffer."' /><input name='quantity' type='hidden' value='".$amount."' /><input name='feen' type='hidden' value='".$customer."' /><input name='id' type='hidden' value='".$id."' /><input name='who' type='hidden' value='".$user."' /><input name='decision' type='submit' value='Accept' /><input name='decision' type='submit' value='Decline' /></form><hr /><br /></div>";
	
}
$crew_sql = sprintf("SELECT * FROM h_user_news WHERE sender = ('%s') OR receiver = ('%s') AND criminal = ('%s') ORDER BY id DESC",
																									 mysql_real_escape_string($user),																									 mysql_real_escape_string($user),																						 mysql_real_escape_string(1));
$cresult = mysql_query($crew_sql);
while($crew_news = mysql_fetch_assoc($cresult)){
		$time = $crew_news["time"];
		$date = ago($time);
		echo "<div id='crew_news' style='width:360px'><img src='http://www.12daysoffun.com/hustle/graphics/crew_icon.png' /><br />".$crew_news["message"]." ".$date."<hr /><br /></div>";
}

$crew_sql = sprintf("SELECT * FROM h_user_news WHERE sender = ('%s') OR receiver = ('%s') AND hustle = ('%s') ORDER BY id DESC",
																									 mysql_real_escape_string($user),																									 mysql_real_escape_string($user),																						 mysql_real_escape_string(1));
$cresult = mysql_query($crew_sql);
while($crew_news = mysql_fetch_assoc($cresult)){
		$time = $crew_news["time"];
		$date = ago($time);
		echo "<div id='crew_news' style='width:360px'><img src='http://www.12daysoffun.com/hustle/graphics/crew_icon.png' /><br />".$crew_news["message"]." ".$date."<hr /><br /></div>";
}
?>
</table>
<?php
$crew_sql = sprintf("SELECT * FROM h_user_news WHERE sender = ('%s') OR receiver = ('%s') AND crew = ('%s') ORDER BY id DESC",
																									 mysql_real_escape_string($user),																									 mysql_real_escape_string($user),																						 mysql_real_escape_string(1));
$cresult = mysql_query($crew_sql);
while($crew_news = mysql_fetch_assoc($cresult)){
		$time = $crew_news["time"];
		$date = ago($time);
		echo "<div id='crew_news'><img src='http://www.12daysoffun.com/hustle/graphics/crew_icon.png' /><br />".$crew_news["message"]." ".$date."<hr /><br /></div>";
}


//Any Successful Robberies against me
$arc_sql = sprintf("SELECT * FROM h_user_news WHERE sender = ('%s') OR receiver = ('%s') AND arcade = ('%s') ORDER BY id DESC",
																									 mysql_real_escape_string($user),																									 mysql_real_escape_string($user),																						 mysql_real_escape_string(1));
$aresult = mysql_query($arc_sql);
while($arcade_news = mysql_fetch_assoc($aresult)){
	if(!is_array($arcade_news)){
		echo "Recruit some talent first, for some news!";
	} else {
		$time = $arcade_news["time"];
		$date = ago($time);
		echo "<div id='arcade_news'><img src='http://www.12daysoffun.com/hustle/graphics/arcade_icon.png' /><br />".$arcade_news["message"]." ".$date."<hr /><br /></div>";
	}
}

//Any Challenges I need to complete?
$ch_sql = sprintf("SELECT * FROM arcade_challenges WHERE user2 = ('%s') AND done = ('%s') ORDER BY id DESC",
																									 mysql_real_escape_string($user),																						 mysql_real_escape_string(0));
$re = mysql_query($ch_sql);
while($ch = mysql_fetch_assoc($re)){
	
		$time = $ch["time"];
		$date = ago($time);
		$gid = $ch["gameid"];
		$query = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
									mysql_real_escape_string($gid));
				$result = mysql_query($query);
				$game = mysql_fetch_assoc($result);
				$gname = $game["shortname"];
				$image = $game['stdimage'];
				$file = $game['file'];
				$width = $game['width']; 
				$height = $game['height']; 
		echo "<div id='challenges' style='color:#000'>".$ch["user1"]." bet you $".$ch["wager"]." to play ".ucwords($gname)." <a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\">PLAY</a><hr /><br /></div>";
	
}
?>
</div>