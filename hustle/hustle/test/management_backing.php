<?php
$user = $_REQUEST["data"];
//$user = "jermongreen";
include 'stats.php';
include 'leveler.php';

require_once 'connect.php';		// our database settings
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

//
		$query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($crewID) = mysql_fetch_row($result);
		
		//what crews am i in?
		$crwquery = sprintf("SELECT * FROM h_crew_member WHERE UPPER(user) = UPPER('%s') AND crew_id != ('%s')",
							mysql_escape_string($user),
							mysql_escape_string($crewID));
		$crewresult = mysql_query($crwquery);
		//
		//crew
?>
<div id="shrink">
<table>
        <?php 
		while($result_ar = mysql_fetch_assoc($crewresult)){
			//
			$leader = $result_ar["crew_id"];
			//find their name
			$query4 = sprintf("SELECT user FROM h_crew_main WHERE id = ('%s')",
						mysql_real_escape_string($leader));
			$result4 = mysql_query($query4);
			list($name) = mysql_fetch_row($result4);
			//Wage
			$hourly_wage = hourly($leader);
			//RFScore
			$query9 = sprintf("SELECT flight_score FROM `h_top_players` WHERE UPPER(user) = ('%s')",
									mysql_real_escape_string($name));
			$result9 = mysql_query($query9);
			list($flight_score) = mysql_fetch_row($result9);
			
			//give me a face with that name
			$query3 = sprintf("SELECT * FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($name));
			$result3 = mysql_query($query3);
			$array = mysql_fetch_assoc($result3);
			
			$image = $array["image"];
			$uid = $array["id"];				
			$cool = getStat('exp',$user_id); 
			list($stage,$l_label) = leveler($cool);
			$game_name = gamerwho($name);
			echo "<tr><td><img src='http://www.12daysoffun.com/hustle/file/pic/user/$image' /><br /><b>".ucwords($game_name)."</b></td><td><strong>".$l_label."</strong></td><td>Has Earned You $".$result_ar['crew_earnings']."<br /> Has Cost You $".$result_ar['crew_losses']."</td><td></td><td></td><td align='center'>Rank Flight Score<br />".$flight_score."</td><td></td><td></td><td style='color:green'><b>Hourly Income<br/>$".$hourly_wage."</b></td><tr>";
		}
		?>
      </table>
      </div>
      
<div id="offers">
<table style="color:#FFF">
<?php
//
$query = sprintf("SELECT COUNT(invitee) FROM h_crew_recruit WHERE UPPER(invitee) = UPPER('%s')",
    mysql_real_escape_string ($user));
$result = mysql_query($query);
list($offers) = mysql_fetch_row($result);
if(empty($offers)){
	echo "<b>You have no offers at this time.</b>";
} else {
    $query = sprintf("SELECT * FROM h_crew_recruit WHERE UPPER(invitee) = UPPER('%s')",
    mysql_real_escape_string ($user));
	$result = mysql_query($query);
	while($result_ar = mysql_fetch_assoc($result)){
		$crew = $result_ar['crew_id'];
		
		$query = sprintf("SELECT * FROM h_crew_main WHERE id = ('%s')",
			mysql_real_escape_string ($crew));
		$resu = mysql_query($query);
		$crew_ar = mysql_fetch_assoc($resu);
		
		$crewtitle = $crew_ar['title'];
		$flag = $crew_ar['mem_image'];
		//
		$crewpquery = sprintf("SELECT rank FROM h_top_crew WHERE crew_name = ('%s')",
							  mysql_escape_string($crewtitle));	
		$r = mysql_query($crewpquery);
		list($crankid) = mysql_fetch_row($r);
		
		echo "<tr><td><img src='http://www.12daysoffun.com/hustle/file/pic/crew/flags/$flag' /><br/><b>".$crewtitle."</b></td><td>Has Offered You $".$result_ar['cash_offer']." to join their crew<br /></td><td> They are Ranked:<br />".$crankid."</td><td><input type='hidden' id='userid' name='user' value='".$user."'/><input type='hidden' name='offer' value='".$result_ar['cash_offer']."'/><input type='hidden' name='crew' value='".$crewtitle."'/><input name='accept' type='submit' value='Accept' /></td><td><input name='decline' type='submit' value='Decline' /></td></tr>";
	}
}
?>
</table>
</div>