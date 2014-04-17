<?
$user = $_REQUEST["data"];

//$user = "jermongreen";
require_once 'connect.php';	// this is from our earlier article on configuration files in PHP
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

//function
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

//Retrieve Instigator User ID
$query = sprintf("SELECT id FROM h_users WHERE user = ('%s')",
		mysql_real_escape_string ($user));
$result = mysql_query($query);			
list($i_userID) = mysql_fetch_row($result);

//Get all the heists
$query = sprintf("SELECT * FROM h_heists WHERE UPPER(culprit) = UPPER('%s') and success = ('%s')",
			mysql_real_escape_string($i_userID),
			1);
$result = mysql_query($query);

while($crime_arr = mysql_fetch_array($result)){
	$target = $crime_arr["target"];
	  
	$take = $crime_arr["take"];
	$cool_e = $crime_arr["cool_earned"];
	$cool_l = $crime_arr["cool_lost"];
	if(empty($cool_e)){
		if(empty($cool_l)){$cool_l = 0;}
		$cool = "<span style='color: red'> with a loss of </span>".$cool_l;
	} else {
		if(empty($cool_e)){$cool_e = 0;}
		$cool = " with a gain of ".$cool_e;
	}
	$time = $crime_arr["time"];
	$date = ago($time);
	echo "<br>TARGET: <span style='color: blue'>".$target."</span> TAKE:$<span style='color:green'>".$take."</span>".$cool." CP, ".$date."<hr/><br />";
}
//Failures
$query = sprintf("SELECT * FROM h_heists WHERE UPPER(culprit) = UPPER('%s') and success = ('%s')",
			mysql_real_escape_string($i_userID),
			0);
$result = mysql_query($query);

while($crime_arr = mysql_fetch_array($result)){
	$target = $crime_arr["target"];	
	$cool_l = $crime_arr["cool_lost"];
	$cool = " loss of ".$cool_l;
	$time = $crime_arr["time"];
	$date = ago($time);
	
	echo "<br>".$target." FAILED" .$cool." ".$date."<hr/><br />";
}
 
?>