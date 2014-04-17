<?php
require_once 'connect.php';		// our database settings
include'stats.php';
include'leveler.php';
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);
$userID = "jermongreen";
?>
<table><?php
		//
		$query = sprintf("SELECT COUNT(invitee) FROM h_crew_recruit WHERE UPPER(invitee) = UPPER('%s')",
			mysql_real_escape_string ($userID));
		$result = mysql_query($query);
		list($offers) = mysql_fetch_row($result);
		echo $offers;
		if (empty($offers)){ 
		echo "You have no offers at this time.";
		} else {
			//
		$query = sprintf("SELECT * FROM h_crew_recruit WHERE UPPER(invitee) = UPPER('%s')",
			mysql_real_escape_string ($userID));
		$result = mysql_query($query);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			?>
        <tr>
        <td><?php $crew = $result_ar['crew_id'];
		$query = sprintf("SELECT * FROM h_crew_main WHERE id = ('%s')",
			mysql_real_escape_string ($crew));
		$resu = mysql_query($query);
		$crew_ar = mysql_fetch_assoc($resu);
		$crewtitle = $crew_ar['title'];
		$flag = $crew_ar['mem_image'];
		echo "<img src='http://www.12daysoffun.com/hustle/file/pic/crew/$flag' />"; echo "<br/>";
		echo $crewtitle;?></td>
          <td></td>
          <td><?php echo "Has Offered You $". $result_ar['cash_offer']." to join their crew<br />";
				?></td>
          <td></td>
          <td><?php echo "They are Ranked:<br />";
		  //
		$crewpquery = sprintf("SELECT rank FROM h_top_crew WHERE crew_name = ('%s')",
							  mysql_escape_string($crewtitle));	
		$r = mysql_query($crewpquery);
		list($crankid) = mysql_fetch_row($r);	echo $crankid;
		  ?></td>
          <td></td>
          <td><input name="Accept" type="button" value="Accept" /></td>
          <td><input name="Decline" type="button" value="Decline" /></td>
        </tr>
        <?php
			$i+=1;
			}
		}
			?>
      </table>