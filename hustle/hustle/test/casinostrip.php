<?php
$user = $_REQUEST["data"];

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

include 'stats.php';

include 'leveler.php';

//Identify all the casinos
$sql = sprintf("SELECT COUNT(user_id) FROM h_user_assets WHERE asset_id = (SELECT id FROM h_businesses WHERE name = '%s' OR short_name = '%s')",
			   "casino",
			   "casino");
			   $result = mysql_query($sql);
			   list($numbers) = mysql_fetch_row($result);
			   if(!empty($numbers)){
					//Order by owner's rank
					$sql = sprintf("SELECT * FROM h_user_assets WHERE asset_id = (SELECT id FROM h_businesses WHERE name = '%s' OR short_name = '%s') ORDER BY worth DESC",
					   "casino",
					   "casino");
					   $result = mysql_query($sql);
					   ?><table width="0" border="0" cellpadding="0"><?
					while($owners = mysql_fetch_assoc($result)){
						$casino_id = $owners["id"];
						$ownerid = $owners["user_id"];
						$jackpot = $owners["jackpot"];
						$query = sprintf("SELECT user FROM h_users WHERE id = ('%s')",
						mysql_real_escape_string ($ownerid));
						$theresult = mysql_query($query);
						list($owner_name) = mysql_fetch_row($theresult);
						$query = sprintf("SELECT biz_title FROM h_user_assets WHERE id = ('%s')",
						mysql_real_escape_string ($casino_id));
						$theresult = mysql_query($query);						
						list($bizname) = mysql_fetch_row($theresult);
						if(empty($bizname)){
							$query = sprintf("SELECT user FROM h_users WHERE id = ('%s')",
							mysql_real_escape_string ($ownerid));
							$theresult = mysql_query($query);
							list($user) = mysql_fetch_row($theresult);
							$title = $user;
						} else {
							$title = $bizname;
						}
						$sql = sprintf("SELECT worth FROM h_user_assets WHERE id = ('%s') AND user_id = ('%s')",
							mysql_real_escape_string($casino_id),
							mysql_real_escape_string($ownerid));
						$results = mysql_query($sql);
						list($worth) = mysql_fetch_row($results);
						$min = round($worth * .01);
						
						echo "<tr><td style='padding-right:75px'><b>".ucwords($title)."'s</b></td><td style='padding-right:55px; font-size:13px;'>$".$jackpot."</td><td style='padding-right:30px'><form id='enter_casino' action='thegame.php' method='post' name='enter_casino'><input type='hidden' id='casino_id' name='casino_id' value='".$casino_id."'/><input type='hidden' id='userid' name='customer' value='".$user."'/><input type='image' src='../file/pic/fbimages/enter_button.png' name='buynow'></form></td><td><form id='invest_casino' action='thegame.php' method='post' name='invest_casino'><input type='hidden' id='casino_id' name='casino_id' value='".$casino_id."'/><input type='hidden' id='userid' name='customer' value='".$user."'/><input type='image' src='../file/pic/fbimages/invest_button.png' name='investnow'><span style='font-size:13px;'>Min: $".$min."</span></form></td><td width='225px'><form id='scopeout' action='patrons.php' method='post'><input type='hidden' id='casino_id' name='casino_id' value='".$casino_id."'/><input type='hidden' id='userid' name='customer' value='".$user."'/><input name='Patrons' type='submit' value='Patrons' /></form></tr>";
					}
					?></table><?
			   } else {
				   echo "<span style='color:#000'><b>No Casinos Available, but you can open one!</b></span>";
			   }


?>
