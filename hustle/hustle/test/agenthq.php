<?
$user = $_REQUEST["data"];
//$user = "jermongreen";
require_once 'connect.php';	// this is from our earlier article on configuration files in PHP

require_once 'crimes.php';
require_once 'collars.php';

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

function getmission($mission){
	//
	switch ($mission)
	{
	case ($mission = 1):
	  $image = "<img src='../file/pic/fbimages/agency_missions/rats.png' />";	
	  $contact = "<img src='../file/pic/fbimages/agency_missions/berneplea.png' />";
	  //Position NPCs
	  $query = sprintf("INSERT INTO h_patrons(club_id,user_id) VALUES ('%s','%s')",
			mysql_real_escape_string(144),//club winston's
			mysql_real_escape_string(121));//Berne
			mysql_query($query);
	  break;
	case ($mission = 2):
	  $image = "<img src='../file/pic/fbimages/agency_missions/family_matters.png' />";
	  $contact = "<img src='../file/pic/fbimages/agency_missions/jimmy_intro.png' />";
	  break;
	case ($mission = 3):
	  $image = "<img src='../file/pic/fbimages/agency_missions/community_trust.png' />";
	  $contact = "<img src='../file/pic/fbimages/agency_missions/Kuan-mission.png' />";
	  break;
	case ($mission = 4):
	  $image = "<img src='../file/pic/fbimages/agency_missions/observenreport.png' />";
	  break;
	default:
	  echo "err";
	}
	$two = array($image,$contact);
	return $two;
}

//activate mission hq
$query = sprintf("SELECT COUNT(mission_id) FROM h_mission_central WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($count) = mysql_fetch_row($result);
if(empty($count)){
	//insert first mission
	$time = time();	
	$query = sprintf("INSERT INTO h_mission_central(mission_id,user,time,done) VALUES ('%s','%s','%s','%s')",
			mysql_real_escape_string(1),
			mysql_real_escape_string($user),
			$time,
			0);
			mysql_query($query);
			
	$arr = getmission(1);		
	$image = $arr[0];
	$contact = $arr[1];		
	
	$query = sprintf("UPDATE h_users SET ring_phone = '%s' WHERE UPPER(user) = UPPER('%s')",
		0,
		mysql_real_escape_string($user));
	mysql_query($query);
	
} else {
	$query = sprintf("SELECT mission_id FROM h_mission_central WHERE UPPER(user) = UPPER('%s') AND done = '0'",
		mysql_real_escape_string($user));
		$result = mysql_query($query);
	list($check) = mysql_fetch_row($result);
	if(empty($check)){		
		//last mission complete
		$query = sprintf("SELECT mission_id FROM h_mission_central WHERE UPPER(user) = UPPER('%s') AND done = '1'",
			mysql_real_escape_string($user));
			$result = mysql_query($query);
		list($mission) = mysql_fetch_row($result);		
		//launch new mission according to rank
		$arr = getmission($mission);		
		$image = $arr[0];
		$contact = $arr[1];
		
		$mission = $mission + 1;
	
		$query = sprintf("UPDATE h_mission_central SET mission_id = ('%s'),done = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($mission),
			0,
			mysql_real_escape_string($user));
		mysql_query($query);
		
		$query = sprintf("SELECT completed FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
			$result = mysql_query($query);
		list($perce) = mysql_fetch_row($result);
		
		$perce = $perce + 1;
		
		$query = sprintf("UPDATE h_users SET completed = ('%s') WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($perce),
			mysql_real_escape_string($user));
		mysql_query($query);
		
		$query = sprintf("UPDATE h_users SET ring_phone = '%s' WHERE UPPER(user) = UPPER('%s')",
		0,
		mysql_real_escape_string($user));
		mysql_query($query);
	} else {
		//retrieve contact
		$query = sprintf("SELECT mission_id FROM h_mission_central WHERE UPPER(user) = UPPER('%s') AND done = '0'",
		mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($check) = mysql_fetch_row($result);
		$arr = getmission($mission);		
		$image = $arr[0];
		$contact = $arr[1];
	}
}
//what mission is the player on?
//57missions

//display the mission...

//ring the phone
//



$poller = json_encode(array(
  "image" => $image,
  "contact" => $contact,
));

echo $poller
 
?>