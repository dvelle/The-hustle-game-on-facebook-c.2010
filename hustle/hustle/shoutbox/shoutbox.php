<?php
include '../test/stats.php';

include '../test/connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_POST['customer'];
//$user = "jermongreen";
$message = $_POST['message'];
$action = $_POST['action'];
if(empty($action)){
	$action = $_REQUEST['action'];
	$user = $_REQUEST['customer'];
}
//$action = "update";
$userid = id($user);

switch($action){
	case "update":
		$sql = "SELECT * FROM h_comments ORDER BY time DESC LIMIT 20";
		$query = mysql_query($sql);
		while($row = mysql_fetch_assoc($query)){
			$sql2 = sprintf("SELECT game_name FROM h_users WHERE id = ('%s')",
									mysql_real_escape_string($row['userid']));
			$query2 = mysql_query($sql2);
			list($firstname) = mysql_fetch_row($query2);
			
			$sql2 = sprintf("SELECT user FROM h_users WHERE id = ('%s')",
									mysql_real_escape_string($row['userid']));
			$query2 = mysql_query($sql2);
			list($username) = mysql_fetch_row($query2);
			
			$query3 = sprintf("SELECT mem_image FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
                            mysql_real_escape_string ($username));
			  $result3 = mysql_query($query3);
			  //
			  list($war_ar) = mysql_fetch_row($result3);
			echo "<li><img src='../file/pic/crew/flags/$war_ar' /><strong>".ucwords($firstname)."</strong><img src=\"../shoutbox/css/images/bullet.gif\" alt=\"-\" />".$row['text']." <span class=\"date\">".$row['time']."</span></li>";
		}
		break;
	case "insert":
		if(empty($message)){
			echo 1;
		} else {
			$query = sprintf("INSERT INTO h_comments(userid, text) VALUES('%s', '%s')",
								mysql_real_escape_string(strip_tags($userid)),
								mysql_real_escape_string(strip_tags($message)));
			mysql_query($query);
		}
			break;
	case "c_update":
		$sql_id = sprintf("SELECT * FROM h_crew_member WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
		$query_id = mysql_query($sql_id);
		while($ids = mysql_fetch_assoc($query_id)){
			$crewid = $ids['crew_id'];
			$sql = sprintf("SELECT * FROM h_crew_comments WHERE crewid = ('%s') ORDER BY time DESC LIMIT 20",
							mysql_real_escape_string($crewid));
			$query = mysql_query($sql);
			while($row = mysql_fetch_assoc($query)){
				$sql2 = sprintf("SELECT game_name FROM h_users WHERE id = ('%s')",
										mysql_real_escape_string($row['userid']));
				$query2 = mysql_query($sql2);
				list($firstname) = mysql_fetch_row($query2);
				echo "<li><strong>".ucwords($firstname)."</strong><img src=\"../shoutbox/css/images/bullet.gif\" alt=\"-\" />".$row['text']." <span class=\"date\">".$row['time']."</span></li>";
			}
		}
		break;
	case "crew":
		if(empty($message)){
			echo 1;
		} else {
			$sql2 = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
										mysql_real_escape_string($user));
				$query2 = mysql_query($sql2);
			list($crewid) = mysql_fetch_row($query2);
			$query = sprintf("INSERT INTO h_crew_comments(userid, text, crewid) VALUES('%s', '%s', '%s')",
								mysql_real_escape_string(strip_tags($userid)),
								mysql_real_escape_string(strip_tags($message)),
								mysql_real_escape_string($crewid));
			mysql_query($query);
		}
			break;		
}
?>