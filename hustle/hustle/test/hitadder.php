<?php
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
		
include 'stats.php';		

$target = $_POST['target'];
//$user = "jermongreen";
$bounty = $_POST['bounty'];
//$bounty = 10;
$user = $_POST['instigator'];
//$target = "nacobilewis";
$time = time();
	
//get user stats
$query = sprintf("SELECT * FROM h_users WHERE user = ('%s')",
		mysql_real_escape_string ($user));
$result = mysql_query($query);
$user_ar = mysql_fetch_assoc($result);
$user_ID = $user_ar["id"];
$i_userID = $user_ID;
	


// subtract cool points and cash

$cash = getStat('cash',$user_ID);
$energy = getStat('ep',$user_ID);
$current_cool = getStat('exp',$user_ID);

//deduct energy
$toll = $energy - 7;
$withdrawal = $cash - $bounty;
$wealth_barrier = assets_valuation($user_ID);
$basement_test = $current_cool - 15000;
$variable_c = $basement_test - $wealth_barrier;

//echo $withdrawal."<br/>";
//echo $basement_test."<br/>";
//verify user can move forward...

if($toll < 0 || $withdrawal < 0 || $variable_c <= 0){
	echo "You don't have enough something, read below.";
	
} else {		
		
	//check adjusted cool against assets make sure not lower than assets allow
	// Deduct
	
	setStat('exp',$user_ID,$basement_test);
	setStat('cash',$user_ID,$withdrawal);
	setStat('ep',$user_ID,$toll);
	
	//insert hit request	
	$sql = sprintf("INSERT INTO h_hitlist(bounty,perp,target,time)VALUES('%s','%s','%s','%s');",
							mysql_real_escape_string($bounty),
							mysql_real_escape_string($user),
							mysql_real_escape_string($target),
							mysql_real_escape_string($time));
					mysql_query($sql);
					
	$recipient_message = "A $".$bounty." was jut put out on you !";
		//
	crime_reporter($target,1,$recipient_message,"recipient");
	echo "Request Saved";
}										   
											   
?>