<?
$user = $_REQUEST['data'];
if(empty($user)){
	$user = $_POST['customer'];
}
$frame = $_REQUEST['checking'];
//$user = "jermongreen";
//$frame = "A";
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats

if($frame == 33){
$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
list($numnum) = mysql_fetch_row($result);

echo $numnum;		
} else {
	//
	if($_POST['accept_x']) {
		//
		$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($chapter) = mysql_fetch_row($result);
		
		$chapter = $chapter + 1;
		$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($chapter),
			mysql_real_escape_string($user));
		mysql_query($query);
		$query = sprintf("SELECT id FROM h_patrons WHERE user_id = ('%s') AND casino_id = '%s'",
				mysql_real_escape_string(1),
				mysql_real_escape_string(153));
			$result = mysql_query($query);
			list($jamison) = mysql_fetch_row($result);
			if(empty($jamison)){
				$query = sprintf("INSERT INTO h_patrons(casino_id,user_id) VALUES ('%s','%s')",
					mysql_real_escape_string(153),//Joe's Casino
					mysql_real_escape_string(1));//Jamison
				mysql_query($query);
			}
		$query = sprintf("SELECT id FROM h_patrons WHERE user_id = ('%s') AND club_id = '%s'",
				mysql_real_escape_string(4),//shaunV
				mysql_real_escape_string(157));
			$result = mysql_query($query);
			list($shaunV) = mysql_fetch_row($result);
			if(empty($shaunV)){
				$query = sprintf("INSERT INTO h_patrons(club_id,user_id) VALUES ('%s','%s')",
					mysql_real_escape_string(157),//Anwar's 
					mysql_real_escape_string(4));
				mysql_query($query);
			}
			if($chapter == 2){
				$time = time();
				$query = sprintf("INSERT INTO arcade_challenges(time,user1,user2,action1,score1,wager,gameid,done) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s');",
									mysql_real_escape_string($time),
									mysql_real_escape_string("LISA"),
									mysql_real_escape_string($user),
									mysql_real_escape_string("defend"),
									mysql_real_escape_string(25),
									mysql_real_escape_string(1000),
									mysql_real_escape_string(3782),					
									0);
								mysql_query($query);
			}
			if($chapter == 5){
				$userid = id($user);
				setAEggs("Mom's Car",$userid,1);
				$time = time();
				$count = $time + 600;
				$query = sprintf("INSERT INTO h_tourney(user,time_left) VALUES ('%s','%s')",
						mysql_real_escape_string($user),
						mysql_real_escape_string($count));
				mysql_query($query);
				
				$sql = sprintf("UPDATE h_users SET chopshop = '%s' WHERE user = ('%s')",
							mysql_real_escape_string(3),
							mysql_real_escape_string($user));
				mysql_query($sql);

				//insert challenge into database	
				$time = time();
				$query = sprintf("INSERT INTO h_race_challenges(user1,user2,action1,time1,score1,wager,trackid,done) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s')",
								mysql_real_escape_string("LISA"),
								mysql_real_escape_string($user),
								mysql_real_escape_string("defend"),
								mysql_real_escape_string($count),
								mysql_real_escape_string(5),
								mysql_real_escape_string(2500),
								mysql_real_escape_string(1),					
								0);
							mysql_query($query);
			}
	} 
}
//

?>
