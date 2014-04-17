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
//Who just made me or lost me some money?
$crew_sql = sprintf("SELECT * FROM h_user_news WHERE sender = ('%s') OR receiver = ('%s') AND crew = ('%s')",
																									 mysql_real_escape_string($user),																									 mysql_real_escape_string($user),																						 mysql_real_escape_string(1));
$cresult = mysql_query($crew_sql);
?>
<div id="crew_news">
<?
while($crew_news = mysql_fetch_assoc($cresult)){
		$time = $crew_news["time"];
		$date = ago($time);
		echo $crew_news["message"]." ".$date."<br />";
}
?>
</div>
<?


?>