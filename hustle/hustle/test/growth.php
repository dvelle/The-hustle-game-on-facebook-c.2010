<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$offer = $_POST['offer'];

$offering_crew = $_POST['crew'];

$user = $_POST['user'];

//Offering CrewID
	$query = sprintf("SELECT * FROM h_crew_main WHERE UPPER(title) = UPPER('%s')",
	mysql_real_escape_string($offering_crew));
	$result = mysql_query($query);	
	$them = mysql_fetch_assoc($result);
	$o_crewID = $them["id"];
	$new_mem = $them["user"];

if(!empty($_POST['accept'])){
	$action = $_POST['accept'];
	//UserId
	$sql = sprintf("SELECT id FROM h_users WHERE UPPER(user) = ('%s')",
									mysql_real_escape_string ($user));
	$result = mysql_query($sql);
	list($userID) = mysql_fetch_row($result);	
	//add the cash
	$account = getStat("cash",$userID);
	$deposit = $account + $offer;
	setStat("cash",$userID,$deposit);
	//update crews
	//insert the offerd first
	//
	$query = sprintf("INSERT INTO h_crew_member(user,crew_id) VALUES ('%s','%s');",
		mysql_real_escape_string($user),
		$o_crewID);
	mysql_query($query);
	//alright whats my crew id, now that im in there crew?
	$query = sprintf("SELECT id FROM h_crew_main WHERE user = UPPER('%s')",
	mysql_real_escape_string($user));
	$result = mysql_query($query);	
	list($crewID) = mysql_fetch_row($result);
	//insert them into my crew
	$query = sprintf("INSERT INTO h_crew_member(user,crew_id) VALUES ('%s','%s');",
		mysql_real_escape_string($new_mem),
		$crewID);
	mysql_query($query);
	//delete offer from table
	$query = sprintf("DELETE FROM h_crew_recruit WHERE invitee = ('%s') AND crew_id = ('%s');",
		mysql_real_escape_string($user),
		mysql_real_escape_string($o_crewID));
	mysql_query($query);
	//Notify offerer
}elseif(!empty($_POST['decline'])){
	$action = $_POST['decline'];
	//Delete offer
	$query = sprintf("DELETE FROM h_crew_recruit WHERE invitee = ('%s') AND crew_id = ('%s');",
		mysql_real_escape_string($user),
		mysql_real_escape_string($o_crewID));
	mysql_query($query);
	
}
echo "Success";
?>