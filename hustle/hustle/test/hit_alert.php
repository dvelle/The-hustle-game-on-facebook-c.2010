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

//Any Hits on me?
$hit_sql = sprintf("SELECT * FROM h_hitlist WHERE target = ('%s') AND completed = ('%s') ",
																									 mysql_real_escape_string($user),																						 mysql_real_escape_string(0));
$hresult = mysql_query($hit_sql);
?>
<div id="hit_warning">
<?
while($hits = mysql_fetch_assoc($hresult)){
	if(!is_array($hits)){
		echo "You haven't pissed anyone off so far...";
	} else {
		$time = $hits["time"];
		$date = ago($time);
		echo $hits["instigator"]." just put a $".$hits["bounty"]."on you! ".$date."<br />";
	}
}
?>
</div>
<?





?>