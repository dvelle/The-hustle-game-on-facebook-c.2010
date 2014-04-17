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

//Any New Gifts?
$gift_sql = sprintf("SELECT * FROM h_crew_gift WHERE recipient = ('%s')",
																									 mysql_real_escape_string($user));
$gresult = mysql_query($gift_sql);
?>
<div id="gifts">
<?
while($gifts = mysql_fetch_assoc($gresult)){
	if(!is_array($gifts)){
		echo "No one in your crew likes you or wants to keep you around, awwww tear tear, loser.";
	} else {
		$cid = $gifts["crew_id"];
		$query = sprintf("SELECT * FROM h_crew_main WHERE id = ('%s')",
									mysql_real_escape_string($cid));
				$result = mysql_query($query);
				$gcrew = mysql_fetch_assoc($result);
				$title = $gcrew["title"];
		$time = $g["time"];
		$date = ago($time);
		echo "The ".$title."s just offered you the gift of ".$gift_name." ".$date."ACCEPT/DECLINE<br />";
	}
}
?>
</div>
<?


?>