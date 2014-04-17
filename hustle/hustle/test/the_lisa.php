<?
$user = $_REQUEST['person'];

$frame = $_REQUEST['checking'];
//$user = "jermongreen";
//$frame = "A";
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
$uid = id($user);
if($frame == "#store") {	
	//check if visited before
		$query = sprintf("SELECT store FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET store = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "#fight") {
	//check if visited before
		$query = sprintf("SELECT archus FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET archus = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "#attack") {
	//check if visited before
		$query = sprintf("SELECT coliseum FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET coliseum = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "#recruit") {
	//check if visited before
		$query = sprintf("SELECT recruit FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET recruit = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "#scores") {
	//check if visited before
		$query = sprintf("SELECT hallofame FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET hallofame = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "#inventory") {
	//check if visited before
		$query = sprintf("SELECT weapons FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET weapons = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "#muscle") {
	//check if visited before
		$query = sprintf("SELECT security FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET security = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "#assets") {
	//check if visited before
		$query = sprintf("SELECT realtor FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET realtor = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "#casino_page") {
	//check if visited before
		$query = sprintf("SELECT casino FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET casino = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "#club_page") {
	//check if visited before
		$query = sprintf("SELECT club FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET club = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "#race_page") {
	//check if visited before
		$query = sprintf("SELECT chopshop FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET chopshop = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "#bank_page") {
	//check if visited before
		$query = sprintf("SELECT bank FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET bank = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "#practice") {
	//check if visited before
		$query = sprintf("SELECT arcade FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET arcade = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "clinic") {
	//check if visited before
		$query = sprintf("SELECT clinic FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET clinic = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "diner") {
	//check if visited before
		$query = sprintf("SELECT diner FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET diner = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} elseif($frame == "market") {
	//check if visited before
		$query = sprintf("SELECT market FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET market = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
		}
} else {
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
}

?>
