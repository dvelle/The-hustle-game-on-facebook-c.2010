<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_REQUEST["data"];
//$user = "jermongreen";

$imagequery = sprintf("SELECT avatar FROM h_users WHERE user = '%s'",
                                  mysql_escape_string($user));
	  $user_image = mysql_query($imagequery);
list($image) = mysql_fetch_row($user_image);
$me = "url(http://www.12daysoffun.com/hustle/file/pic/avatar/".$image.".jpg)";

$sql1 = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s') AND type = ('%s')",
												 mysql_real_escape_string($user),
												 555);
		$result1=mysql_query($sql1);
		$tie1 = mysql_fetch_assoc($result1);
		
$sql2 = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s')",
							  mysql_real_escape_string($user));
		$result2=mysql_query($sql2);
		$iwin2 = mysql_fetch_assoc($result2);	
$sql3 = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s')",
								mysql_real_escape_string($user));
		$result3=mysql_query($sql3);
		$ilose3 = mysql_fetch_assoc($result3);		
		
if(is_array($tie1)){
	$direction = 555;
} elseif(is_array($iwin2)){
	$direction = 1;
	$sql2 = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s')",
								mysql_real_escape_string($user));
		$result2=mysql_query($sql2);
	while($iwin = mysql_fetch_assoc($result2)){
		$target = $iwin['loser'];
		$mulla = $iwin['score'];
		$cool = $iwin['gameid'];
	}
	$imagequery = sprintf("SELECT avatar FROM h_users WHERE user = '%s'",
                                  mysql_escape_string($target));
	  $user_image = mysql_query($imagequery);
	  list($image) = mysql_fetch_row($user_image);
	  $loser = "url(http://www.12daysoffun.com/hustle/file/pic/avatar/".$image.".jpg)";
	  $winner = $me;
	  
} elseif(is_array($ilose3)){
	$direction = 2;
	$sql3 = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s')",
								mysql_real_escape_string($user));
		$result3=mysql_query($sql3);
	while($ilose = mysql_fetch_assoc($result3)){
		$target = $ilose['winner'];
		$mulla = $ilose['score'];
		$cool = $ilose['gameid'];
	}
	$imagequery = sprintf("SELECT avatar FROM h_users WHERE user = '%s'",
                                  mysql_escape_string($target));
	  $user_image = mysql_query($imagequery);
	  list($image) = mysql_fetch_row($user_image);
	  $winner = "url(http://www.12daysoffun.com/hustle/file/pic/avatar/".$image.".jpg)";
	  $loser = $me;		
}
if(empty($mulla)){
	$cash = 0;
} else {
	$cash = number_format($mulla, 0, ',', ',');
}
if(empty($cool)){
	$cool = 0;
}
$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s') OR loser = ('%s')",
						mysql_real_escape_string ($user),
						mysql_real_escape_string ($user));
					mysql_query($sql);
$poller = json_encode(array(
  "cool" => $cool,
  "money" => $cash,
  "winner" => $winner,
  "loser" => $loser,
  "poster" => $direction,
  "name" => $user,
  "lname" => $target,
  ));

echo $poller;
?>
