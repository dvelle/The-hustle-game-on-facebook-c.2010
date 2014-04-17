<?php
session_start(); 	// start up our session - or recreate it if it already exists
require_once('connect.php');

	if($_POST) {
		$password = $_POST['password'];
		$confirm = $_POST['confirm'];	
		if($password != $confirm) { ?>
<span style='color:red'>Error: Passwords do not match!</span>		
<?php	} else {
			$conn = mysql_connect($dbhost,$dbuser,$dbpass)
				or die ('Error connecting to mysql');
			mysql_select_db($dbname);
			$query = sprintf("SELECT COUNT(id) FROM h_users WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string($_POST['user']));
			$result = mysql_query($query);
			list($count) = mysql_fetch_row($result);
			if($count >= 1) { ?>
<span style='color:red'>Error: that username is taken.</span>
<?php		} else {
				$query = sprintf("INSERT INTO h_users(user,password) VALUES ('%s','%s');",
					mysql_real_escape_string($_POST['user']),
					mysql_real_escape_string(md5($password)));
				mysql_query($query);
				//userid
				$userID = mysql_insert_id();
				//crew init
				$query = sprintf("INSERT INTO h_crew_main(title,user) VALUES ('%s','%s');",
					mysql_real_escape_string($_POST['user']),
					mysql_real_escape_string($_POST['user']));
				mysql_query($query);
				//member init
				$crewID = mysql_insert_id();
				//top crew init
				$query = sprintf("INSERT INTO h_top_crew(user,crew_name,rank) VALUES ('%s','%s','%s');",
					mysql_real_escape_string($_POST['user']),
					mysql_real_escape_string($_POST['user']),
					'0');
				mysql_query($query);
				//top player init
				$query = sprintf("INSERT INTO h_top_players(user,rank) VALUES ('%s','%s');",
					mysql_real_escape_string($_POST['user']),
					'0');
				mysql_query($query);
				//member init2				
				$query = sprintf("INSERT INTO h_crew_member(user,crew_id) VALUES ('%s','%s');",
					mysql_real_escape_string($_POST['user']),
					$crewID);
				mysql_query($query);
				
				//stat
				require_once 'stats.php';
					setStat('cash',$userID,'50');
					setStat('exp',$userID,'5000');			
					setStat('exp_rem',$userID,'20000');
					setStat('ep',$userID,'10');
					setStat('ep_rem',$userID,'10');
					setStat('rp',$userID,'50');
					setAssets('base',$userID,'1');
					SetArsenal('fists',$userID,'1');
			$_SESSION['authenticated'] = true;
			$_SESSION['user'] = $user;
			header('Location:login.php');
			?>
<span style='color:green'>Congratulations, you registered successfully!</span>
<?php
			}	
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<form method='post' action='registration.php'>Username: <input type='text' name='user' /><br />
Password: <input type='password' name='password' /><br />
Confirm Password: <input type='password' name='confirm' /><br />
<input type='submit' value='Register!' />
</form>

</body>
</html>