<?php
include('stats.php');

include('connect.php');
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_REQUEST['data'];
//$user = "jermongreen";

//functions
//Rob everyone

//picture //name //crew // Attack button
$stack = array();
$sql = "SELECT COUNT(id) FROM h_patients";
	$result = mysql_query($sql);
list($count) = mysql_fetch_row($result);	
if($count > 0){
	//
	$ill_sql = "SELECT * FROM h_patients";
	$iresult = mysql_query($ill_sql);	
	//take snap show of everyone in club after measuring owner security
	?>
	<div id='hospital_alerts' style='overflow:scroll; height:150px;'>
	<?php
	while($goods = mysql_fetch_assoc($iresult)){
			$userid = $goods["user_id"];
			$iuid = id($user);
			$sql = sprintf("SELECT * FROM h_users WHERE id = ('%s')",
							mysql_real_escape_string($userid));
			$resulter = mysql_query($sql);
			$custs = mysql_fetch_assoc($resulter);
			if(!empty($custs)){
				
				$name = $custs["game_name"];
				
				$patron = $custs["user"];
				
				$image = $custs["image"];			
				
				$face = "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'";
			}				
			echo "<form id='kill_form' name='kill_form' method='post' action='warroom.php'><td>".$face."</td><td> ".ucwords($name)."</td></span><input name='target' type='hidden' value='".$patron."' /><input name='instigator' type='hidden' value='".$user."' />					<input name='hospital' type='hidden' value='999' /><input name='decision' type='submit' value='Attack' /></form><hr /><br /><div id='hit_results'></div>";		
	}
} else {
	echo "No one is here...";
}
?>
</div>