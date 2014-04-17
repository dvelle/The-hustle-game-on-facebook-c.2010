<?
require_once("stats.php");
// with the user id from facebook retrived with the API,
// search for a user already registered with this process:
$fb_user = $uid;

$query = sprintf("SELECT COUNT(id) FROM h_users WHERE uid = ('%s')",
							 mysql_real_escape_string($fb_user));
$result = mysql_query($query);

list($osh) = mysql_fetch_row($result);

if ($osh > 0){	
	// this is a user connected with facebook
	// and already existing on your community.
	$query = sprintf("SELECT * FROM h_users WHERE uid = UPPER('%s')",
	mysql_real_escape_string($fb_user));
	$result = mysql_query($query);
	$result_ar = mysql_fetch_assoc($result);
	$user = $result_ar['user'];
	$_SESSION['user'] = $user;
	
	
	$name = $fqlResult[0]["name"];
	$name_filter = explode(" ", $name);
	$firstname = strtolower($name_filter[0]); 
	
	$query = sprintf("UPDATE h_users SET firstname = '%s' WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($firstname),
		mysql_real_escape_string($user));
	mysql_query($query);
	
	$activity = time();
	$query = sprintf("UPDATE h_users SET last_login = '%s' WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($activity),
		mysql_real_escape_string($user));
	mysql_query($query);
	//Returning user update
	$query = sprintf("SELECT game_name FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	list($gname) = mysql_fetch_row($result);
	
	if(empty($gname)){
		$time_left = $activity + 129600;
		
		$query = sprintf("UPDATE h_users SET fl_facebook = ('%s'), tutorial_on = ('%s'),tutorial_chapter = ('%s'),tutorial_time = ('%s')  WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string("new"),
			mysql_real_escape_string(1),
			mysql_real_escape_string(1),
			mysql_real_escape_string($time_left),
			mysql_real_escape_string($user));
		mysql_query($query);
		
		//Tutorial
		$query = sprintf("INSERT INTO h_area_tut(user) VALUES ('%s')",
					mysql_real_escape_string($user));
			mysql_query($query);
	}
} else {
	//
	// this is a user logged in on facebook
	// but it doesn't exists on your community,
	// it's new!
	function copyFile($url,$filename){
		$file = fopen ($url, "rb");
		if (!$file) return false; else {
			$fc = fopen($filename, "wb");
			while (!feof ($file)) {
				$line = fread ($file, 1028);
				fwrite($fc,$line);
			}
			fclose($fc);
			return true;
		}
	}
	//
	// you need also the picture, not only the name:
	
	//
	$name = $fqlResult[0]["name"];
	$name_filter = explode(" ", $name);
	$firstname = strtolower($name_filter[0]);
	$tempuser  = strtolower($name_filter[0].$name_filter[1]);
	
	// get the id of the user just created
	// and copy the file on your avatar_imgs directory
	// (this code supposes that you store the avatars with
	// the id of the user on the database)
	$avatar = $_SERVER['DOCUMENT_ROOT']."/12daysoffun/hustle/file/pic/user/" . $tempuser . ".jpg";
	copyFile( $fqlResult[0]['pic_square'] , $avatar);
	
	// generate random password for new user:
	$pass = md5("fb".rand(1000,2000));
	//
	// empty email:
	$email = "";
	// date:
	$date = time();
	$time_left = $time + 129600;
	//create the user on your table
	$query = sprintf("INSERT INTO h_users(user,password,uid,image,firstname,fl_facebook,activationdate,last_login,tutorial_time) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s')",
					mysql_real_escape_string($tempuser),
					mysql_real_escape_string($pass),
					mysql_real_escape_string($fb_user),
					mysql_real_escape_string($tempuser.".jpg"),
					mysql_real_escape_string($firstname),
					mysql_real_escape_string("new"),
					$date,
					$date,
					$time_left);
				mysql_query($query);
	//
	// new user created, log him in:
	//crew init
	$query = sprintf("INSERT INTO h_crew_main(title,user) VALUES ('%s','%s');",
		mysql_real_escape_string($tempuser),
		mysql_real_escape_string($tempuser));
	mysql_query($query);
	
	//member init
	$query = sprintf("SELECT id FROM h_crew_main WHERE user = UPPER('%s')",
	mysql_real_escape_string($tempuser));
	$result = mysql_query($query);	
	list($crewID) = mysql_fetch_row($result);
	
	//top crew init
	$query = "SELECT COUNT(id) FROM h_top_crew";
	$result = mysql_query($query);
	list($len) = mysql_fetch_row($result);
	$len = $len + 1;
	//
	$query = sprintf("INSERT INTO h_top_crew(user,crew_name,rank) VALUES ('%s','%s','%s');",
		mysql_real_escape_string($tempuser),
		mysql_real_escape_string($tempuser),
		$len);
	mysql_query($query);
	
	//top player init
	$query = mysql_query("SELECT COUNT(scoreid) FROM h_top_players");
	list($length) = mysql_fetch_row($query);
	$lenth = $length+1;
	//
	$query = sprintf("INSERT INTO h_top_players(user,rank) VALUES ('%s','%s');",
		mysql_real_escape_string($tempuser),
		$length);
	mysql_query($query);
	
	//member init2				
	$query = sprintf("INSERT INTO h_crew_member(user,crew_id) VALUES ('%s','%s');",
		mysql_real_escape_string($tempuser),
		$crewID);
	mysql_query($query);

	$query = sprintf("SELECT id FROM h_users WHERE user = UPPER('%s')",
	mysql_real_escape_string($tempuser));
	$result = mysql_query($query);	
	list($userID) = mysql_fetch_row($result);
	//Tutorial
	$query = sprintf("INSERT INTO h_area_tut(user) VALUES ('%s')",
				mysql_real_escape_string($tempuser));
		mysql_query($query);
	
	//stat	
	setStat('cash',$userID,'50');
	setStat('exp',$userID,'0');			
	setStat('exp_rem',$userID,'9');
	setStat('ep',$userID,'10');
	setStat('epr',$userID,'10');
	setStat('rp',$userID,'25');
	setStat('health',$userID,'100');
	setAssets('base',$userID,'1');
	SetArsenal('fists',$userID,'1');
	
	$user = $tempuser;
	$debug = 0;
}
?>