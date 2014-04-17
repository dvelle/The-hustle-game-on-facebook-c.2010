<?php
include('stats.php');

include('connect.php');
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_POST['name'];
//$user = "warrior";

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
//Any Challenges I need to complete?
$ch_sql = sprintf("SELECT * FROM arcade_challenges WHERE user2 = ('%s') AND done = ('%s') ",
																									 mysql_real_escape_string($user),																						 mysql_real_escape_string(0));
$re = mysql_query($ch_sql);
?>
<div id="challenges">
<?
while($ch = mysql_fetch_assoc($re)){
	if(!is_array($ch)){
		echo "This is the best way to earn some cash, but get someone to challenge you first!";
	} else {
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
		echo $ch["user1"]." just wagered $".$ch["wager"]." they can beat your score in <img src='http://www.12daysoffun.com/hustle/arcade/images/$image' />".$gname." ".$date."<a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\">PLAY</a><br />";
	}
}
?>
</div>
<?

?>