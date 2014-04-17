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

$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
mysql_real_escape_string($user));
$result = mysql_query($query);
list($chapter) = mysql_fetch_row($result);
if($chapter == 27){
	$chapter = $chapter + 1;
	
	$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($chapter),
		mysql_real_escape_string($user));
	mysql_query($query);
	$offer = 1500;
	$feen = "RicardoSmalls";
	$option = "coke";
	$quan = "900";
	$old = time();
	$time = $old - 3600;
	$query = sprintf("INSERT INTO h_user_requests(dealer,customer,item,quantity,offer,time) VALUES ('%s','%s','%s','%s','%s','%s')",
					mysql_real_escape_string($dealer),
					mysql_real_escape_string($feen),
					mysql_real_escape_string($option),
					mysql_real_escape_string($quan),
					mysql_real_escape_string($offer),
					mysql_real_escape_string($time));
	mysql_query($query);
	//
	$offer = 1000;
	$feen = "Amber";
	$option = "coke";
	$quan = "50";
	$old = time();
	$time = $old - 600;
	$dealer = $user;
	$query = sprintf("INSERT INTO h_user_requests(dealer,customer,item,quantity,offer,time) VALUES ('%s','%s','%s','%s','%s','%s')",
					mysql_real_escape_string($dealer),
					mysql_real_escape_string($feen),
					mysql_real_escape_string($option),
					mysql_real_escape_string($quan),
					mysql_real_escape_string($offer),
					mysql_real_escape_string($time));
	mysql_query($query);
}

//Any New requests?
$ill_sql = sprintf("SELECT * FROM h_user_requests WHERE dealer = ('%s') ORDER BY offer DESC",
						mysql_real_escape_string($dealer));
$iresult = mysql_query($ill_sql);

while($goods = mysql_fetch_assoc($iresult)){
	
		$goffer = $goods["offer"];
		$item = $goods["item"];
		$customer = $goods["customer"];
		$amount = $goods["quantity"];
		$time = $goods["time"];
		$id = $goods["id"];
		$date = ago($time);
		if($item == "roids"){
			$var = " steroid pill(s)";
		}elseif($item == "coke"){
			$var = " ounce(s) of that <b>Blue</b>";
		} elseif($item == "dvd"){
			$var = " copy(s) of those new DVDs";
		} elseif($item =="lotto"){
			$var = " number(s) to play on the next Lotto drawing";
		}				
		echo "<div id='good_alerts'><form id='myfeens' name='myfeens' method='post' action='goodsdelivery.php'>".ucwords($customer)." just offered <span style='color:#00F;'><strong>$".$goffer."</strong></span> for ".$amount.$var."<br />
<input name='item' type='hidden' value='$item' /><input name='offer' type='hidden' value='$goffer' /><input name='quantity' type='hidden' value='$amount' /><input name='feen' type='hidden' value='$customer' /><input name='id' type='hidden' value='$id' /><input name='who' type='hidden' value='$user' /><input name='decision' type='submit' value='Accept' /></form><hr /><br /></div>";
	
}
?>