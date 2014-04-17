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

$query = sprintf("SELECT id FROM h_users WHERE user = ('%s')",
				mysql_real_escape_string ($user));
		$result = mysql_query($query);			
list($user_ID) = mysql_fetch_row($result);

$crew_sql = sprintf("SELECT * FROM h_user_achievements WHERE user = ('%s')",																									 		mysql_real_escape_string($user));
$cresult = mysql_query($crew_sql);

while($mysuccess = mysql_fetch_assoc($cresult)){
		$time = $mysuccess["time"];		
		$date = ago($time);
		$aid = $mysuccess["a_id"];
		$sql = sprintf("SELECT * FROM h_achievements WHERE id = '%s'",
				mysql_real_escape_string($aid));
		$result = mysql_query($sql);
		$bonus_ar = mysql_fetch_assoc($result);
		$title_n = $bonus_ar["name"];
		$image = $bonus_ar["image_icon"];
		$descr = $bonus_ar["description"];
		echo "<div id='my_progress'><img src='http://www.12daysoffun.com/hustle/file/pic/fbimages/".$image."' /><span> <b>".ucwords($title_n)."</b></span> ".$descr."<br/>".$date."<hr /><br /></div>";
		
}


?>