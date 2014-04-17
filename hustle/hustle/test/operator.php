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

//Any New Requests?
$dealer = "none";

//Any New requests?
$ill_sql = "SELECT * FROM h_rap_sheet ORDER BY rank DESC";
$iresult = mysql_query($ill_sql);

while($goods = mysql_fetch_assoc($iresult)){
	
		$goffer = $goods["rank_score"];
		$crook = $goods["hood"];
		$multiplier = $goods["record"];
		$divider = $goods["rank"];
		$id = $goods["id"];
		if($divider == 0){
			$divider = 1;
		}
		$time = $goods["time"];
		$date = ago($time);
		$one = $goffer * $multiplier;
		$salary = $one/$divider;
		
		echo "<div id='apb_alerts'><form id='apbs' name='apbs' method='post' action='apbs.php'> The capture of ".ucwords($crook)." pays <span style='color:#00F;'><strong>$".$salary."</strong></span><input name='crook' id='crook' type='hidden' value='".$crook."' /><input name='offer' id='offer' type='hidden' value='".$salary."' /><input id= 'ident' name='id' type='hidden' value='".$id."' /><input id='who' name='who' type='hidden' value='".$user."' /><input id='pursue' name='decision' type='submit' value='Pursue' /></form><hr /><br /></div>";
	
}
?>