<?php
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$offer = $_POST['cashoffer'];

$user = $_POST['customer'];

$recruit = $_POST['target'];

$test = $offer * 3;
if(empty($offer) || $test == 0){
	echo "Error, Try Again";
} else {
	//get user stats
	$query = sprintf("SELECT * FROM h_users WHERE user = ('%s')",
			mysql_real_escape_string ($user));
	$result = mysql_query($query);
	$user_ar = mysql_fetch_assoc($result);
	$user_ID = $user_ar["id"];
	
	$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
								mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($crewID) = mysql_fetch_row($result);
	
	$cash = getStat('cash',$user_ID);
	
	if($cash < $offer){
		$debit = $offer;
	} else {
		$debit = $cash - $offer;
	}
	
	setStat('cash',$user_ID,$debit);
	
	//Send cash offer news as alert | crew_id	user	invitee	cash_offer	time
	$time = time();
		
	$query = sprintf("INSERT INTO h_crew_recruit(crew_id,user,invitee,cash_offer,time,fb_sent) VALUES ('%s','%s','%s','%s','%s','%s');",
						mysql_real_escape_string($crewID),
						mysql_real_escape_string($user),
						mysql_real_escape_string($recruit),
						mysql_real_escape_string($offer),					
						mysql_real_escape_string($time),
							mysql_real_escape_string(2));
					mysql_query($query);
	
	$sql = sprintf("SELECT tot_offers FROM h_users WHERE user = ('%s')",
							mysql_real_escape_string ($recruit));
				$result = mysql_query($sql);
				list($tots) = mysql_fetch_row($result);
				$tots = $tots + 1;
	
	$sql = sprintf("UPDATE h_users SET tot_offers = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string ($tots),
							mysql_real_escape_string ($recruit));
				mysql_query($sql);
				
	//send email
	$query = sprintf("SELECT title FROM h_crew_main WHERE id = ('%s')",
			mysql_real_escape_string($crewID));
		$result = mysql_query($query);
	list($title) = mysql_fetch_row($result);
	
	$mess = ucwords($title)." offered you $".$offer." to join their crew.<a href='http://apps.facebook.com/the_hustle'><b>The Hustle</b></a>  to accept or reject their offer.";
	
	$query = sprintf("SELECT uppemail FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($recruit));
		$result = mysql_query($query);
	list($email) = mysql_fetch_row($result);
	
	$query = sprintf("SELECT email_on FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($recruit));
		$result = mysql_query($query);
	list($on) = mysql_fetch_row($result);
	
	if(!empty($email) && $on == 1){
		mail($email,"The Hustle Game | News Updates",$mess);
	}
	$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
			$result = mysql_query($query);
			list($chapter) = mysql_fetch_row($result);
			if($chapter == 10){
				$chapter = $chapter + 1;
				$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($chapter),
					mysql_real_escape_string($user));
				mysql_query($query);
			}			
	echo 1;
}
?>