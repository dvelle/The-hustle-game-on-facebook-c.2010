<?
//$user = "nacobilewis";
$user = $_REQUEST["data"];
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

include 'stats.php';

include 'leveler.php';

		
		// Identify targets
		//
		$targets = "SELECT * FROM h_hitlist WHERE completed = '0'";
		$available = mysql_query($targets);
		//
		?>
        <table style="width:380; font-size:14px; color:#FFF;">
        <?
		while($target_ar = mysql_fetch_assoc($available)){
		$username = $target_ar["target"];
		  //
		  $sql = "SELECT id FROM h_users WHERE user = '$username'";
		  $result = mysql_query($sql);
		  list($userID) = mysql_fetch_row($result);
		  //
		  $cool = getStat('exp',$userID); 
		  list($stage,$l_label) = leveler($cool);
		  echo "<tr><td style='padding-right:50px;'>".ucwords($username)."</td><td> Level-".$stage." ".$l_label."</td><td style='padding-right:30px; padding-left:40px'> $".$target_ar["bounty"]."</td><td><input name='submit' type='submit' value='Attack'/><input type='hidden' name='target' value='".$username."'/><input type='hidden' name='public' value='1'/><input type='hidden' id='userid' name='instigator' value='".$user."'/><td></tr>";
		}
?>
		</table>