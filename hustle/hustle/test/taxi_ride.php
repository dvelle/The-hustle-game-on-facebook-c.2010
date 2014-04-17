<?

$user = $_REQUEST['data'];
$area = $_REQUEST['loc'];
//$user = "jermongreen";
//$area = "#downtown";

include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$id = id($user);
//get user stats
function teach($user,$area){
	$uid = id($user);
	if($area == "#downtown"){
		//check if visited before
		$query = sprintf("SELECT downtown FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET downtown = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
			$reward = 4;
		} else {
			$reward = 3;
		}
	} elseif($area == "#home"){
		//check if visited before
		$query = sprintf("SELECT midtown FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET midtown = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
			$reward = 4;
		} else {
			$reward = 3;
		}
	} elseif($area == "#northend"){
		//check if visited before
		$query = sprintf("SELECT uptown FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET uptown = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
			$reward = 4;
		} else {
			$reward = 3;
		}
	} elseif($area == "#eastend"){
		//check if visited before
		$query = sprintf("SELECT eastend FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET eastend = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
			$reward = 4;
		} else {
			$reward = 3;
		}
	} elseif($area == "#train_page"){
		//check if visited before
		$query = sprintf("SELECT train FROM h_area_tut WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
		$result = mysql_query($query);
		list($change) = mysql_fetch_row($result);
		if($change < 1){
			//cash
			cash_in($uid,100);
			//cool
			popular($uid,1);
			//
			$query = sprintf("UPDATE h_area_tut SET train = ('%s') WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string (2),
					mysql_real_escape_string ($user));
			mysql_query($query);
		    search($user);
			$reward = 4;
		} else {
			$reward = 3;
		}
	} 
	return $reward;
}
//dice
function dice($user,$area){
	$signal = teach($user,$area);
	$random = rand(1,1000);
	if($area == "#downtown"){
		//randomly select a deed from area
		$query = sprintf("SELECT deed FROM h_properties WHERE id = ('%s')",
			mysql_real_escape_string($random));
		$result = mysql_query($query);
		list($deed) = mysql_fetch_row($result);
		//check to see if owned
		$query2 = sprintf("SELECT owner FROM h_properties WHERE deed = ('%s')",
			mysql_real_escape_string($deed));
		$result2 = mysql_query($query2);
		list($owner) = mysql_fetch_row($result2);
		if(empty($owner)){
			//offer to user share deed title|price|maint|travel fee
			$query = sprintf("SELECT price FROM h_properties WHERE deed = ('%s')",
				mysql_real_escape_string($deed));
			$result = mysql_query($query);
			list($price) = mysql_fetch_row($result);
			$travel_fee = $price * .1;
			$maint = $travel_fee;
			$poller = json_encode(array(
				"signal" => $signal,
				"direction" => 5,
				"deed" => $deed,
				"price" => $price,
				"travel" => $travel_fee,
				"maint" => $maint,
				"did" => $random,
			));
		} else {
			if($owner == $user){
				$poller = json_encode(array(
				"signal" => 3,	
				"direction" => 3,
				));
			} else {
				//action
				//user can attack so as to not pay/take or pay travel fee
				//share deed title|travel fee|owner pic|owner crew size
				$query = sprintf("SELECT travel_fee FROM h_properties WHERE deed = ('%s')",
								mysql_real_escape_string($deed));
				$result = mysql_query($query);
				list($price) = mysql_fetch_row($result);
				
				$crew_size = how_deep($owner);
				
				$query = sprintf("SELECT game_name FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($owner));
				$result = mysql_query($query);
				list($owner_name) = mysql_fetch_row($result);
				
				$sql = sprintf("SELECT avatar FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($owner));
				$r = mysql_query($sql);
				list($avatar) = mysql_fetch_row($r);
				
				$travel_fee = $price * .1;
				$maint = $travel_fee;
				$poller = json_encode(array(
					"signal" => $signal,
					"direction" => 6,
					"deed" => $deed,
					"owner_name" => $owner_name,
					"owner_avatar" => $avatar,
					"crewsize" => $crew_size,
					"travel" => $travel_fee,
					"did" => $random,
				));
			}
				
		}
	} elseif($area == "#home"){
		//randomly select a deed from area
		$query = sprintf("SELECT deed FROM h_properties WHERE id = ('%s')",
			mysql_real_escape_string($random));
		$result = mysql_query($query);
		list($deed) = mysql_fetch_row($result);
		//check to see if owned
		$query2 = sprintf("SELECT owner FROM h_properties WHERE deed = ('%s')",
			mysql_real_escape_string($deed));
		$result2 = mysql_query($query2);
		list($owner) = mysql_fetch_row($result2);
		if(empty($owner)){
			//offer to user share deed title|price|maint|travel fee
			$query = sprintf("SELECT price FROM h_properties WHERE deed = ('%s')",
				mysql_real_escape_string($deed));
			$result = mysql_query($query);
			list($price) = mysql_fetch_row($result);
			$travel_fee = $price * .1;
			$maint = $travel_fee;
			$poller = json_encode(array(
				"signal" => $signal,
				"direction" => 5,
				"deed" => $deed,
				"price" => $price,
				"travel" => $travel_fee,
				"maint" => $maint,
				"did" => $random,
			));
		} else {
			if($owner == $user){
				$poller = json_encode(array(
				"signal" => 3,	
				"direction" => 3,
				));
			} else {
				//action
				//user can attack so as to not pay/take or pay travel fee
				//share deed title|travel fee|owner pic|owner crew size
				$query = sprintf("SELECT travel_fee FROM h_properties WHERE deed = ('%s')",
								mysql_real_escape_string($deed));
				$result = mysql_query($query);
				list($price) = mysql_fetch_row($result);
				
				$crew_size = how_deep($owner);
				
				$query = sprintf("SELECT game_name FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($owner));
				$result = mysql_query($query);
				list($owner_name) = mysql_fetch_row($result);
				
				$sql = sprintf("SELECT avatar FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($owner));
				$r = mysql_query($sql);
				list($avatar) = mysql_fetch_row($r);
				
				$travel_fee = $price * .1;
				$maint = $travel_fee;
				$poller = json_encode(array(
					"signal" => $signal,
					"direction" => 6,
					"deed" => $deed,
					"owner_name" => $owner_name,
					"owner_avatar" => $avatar,
					"crewsize" => $crew_size,
					"travel" => $travel_fee,
					"did" => $random,
				));
			}
				
		}
	} elseif($area == "#northend"){
		//randomly select a deed from area
		$query = sprintf("SELECT deed FROM h_properties WHERE id = ('%s')",
			mysql_real_escape_string($random));
		$result = mysql_query($query);
		list($deed) = mysql_fetch_row($result);
		//check to see if owned
		$query2 = sprintf("SELECT owner FROM h_properties WHERE deed = ('%s')",
			mysql_real_escape_string($deed));
		$result2 = mysql_query($query2);
		list($owner) = mysql_fetch_row($result2);
		if(empty($owner)){
			//offer to user share deed title|price|maint|travel fee
			$query = sprintf("SELECT price FROM h_properties WHERE deed = ('%s')",
				mysql_real_escape_string($deed));
			$result = mysql_query($query);
			list($price) = mysql_fetch_row($result);
			$travel_fee = $price * .1;
			$maint = $travel_fee;
			$poller = json_encode(array(
				"signal" => $signal,
				"direction" => 5,
				"deed" => $deed,
				"price" => $price,
				"travel" => $travel_fee,
				"maint" => $maint,
				"did" => $random,
			));
		} else {
			if($owner == $user){
				$poller = json_encode(array(
				"signal" => 3,	
				"direction" => 3,
				));
			} else {
				//action
				//user can attack so as to not pay/take or pay travel fee
				//share deed title|travel fee|owner pic|owner crew size
				$query = sprintf("SELECT travel_fee FROM h_properties WHERE deed = ('%s')",
								mysql_real_escape_string($deed));
				$result = mysql_query($query);
				list($price) = mysql_fetch_row($result);
				
				$crew_size = how_deep($owner);
				
				$query = sprintf("SELECT game_name FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($owner));
				$result = mysql_query($query);
				list($owner_name) = mysql_fetch_row($result);
				
				$sql = sprintf("SELECT avatar FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($owner));
				$r = mysql_query($sql);
				list($avatar) = mysql_fetch_row($r);
				
				$travel_fee = $price * .1;
				$maint = $travel_fee;
				$poller = json_encode(array(
					"signal" => $signal,
					"direction" => 6,
					"deed" => $deed,
					"owner_name" => $owner_name,
					"owner_avatar" => $avatar,
					"crewsize" => $crew_size,
					"travel" => $travel_fee,
					"did" => $random,
				));
			}
				
		}
	} elseif($area == "#eastend"){
		//randomly select a deed from area
		$query = sprintf("SELECT deed FROM h_properties WHERE id = ('%s')",
			mysql_real_escape_string($random));
		$result = mysql_query($query);
		list($deed) = mysql_fetch_row($result);
		//check to see if owned
		$query2 = sprintf("SELECT owner FROM h_properties WHERE deed = ('%s')",
			mysql_real_escape_string($deed));
		$result2 = mysql_query($query2);
		list($owner) = mysql_fetch_row($result2);
		if(empty($owner)){
			//offer to user share deed title|price|maint|travel fee
			$query = sprintf("SELECT price FROM h_properties WHERE deed = ('%s')",
				mysql_real_escape_string($deed));
			$result = mysql_query($query);
			list($price) = mysql_fetch_row($result);
			$travel_fee = $price * .1;
			$maint = $travel_fee;
			$poller = json_encode(array(
				"signal" => $signal,
				"direction" => 5,
				"deed" => $deed,
				"price" => $price,
				"travel" => $travel_fee,
				"maint" => $maint,
				"did" => $random,
			));
		} else {
			if($owner == $user){
				$poller = json_encode(array(
				"signal" => 3,	
				"direction" => 3,
				));
			} else {
				//action
				//user can attack so as to not pay/take or pay travel fee
				//share deed title|travel fee|owner pic|owner crew size
				$query = sprintf("SELECT travel_fee FROM h_properties WHERE deed = ('%s')",
								mysql_real_escape_string($deed));
				$result = mysql_query($query);
				list($price) = mysql_fetch_row($result);
				
				$crew_size = how_deep($owner);
				
				$query = sprintf("SELECT game_name FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($owner));
				$result = mysql_query($query);
				list($owner_name) = mysql_fetch_row($result);
				
				$sql = sprintf("SELECT avatar FROM h_users WHERE user = ('%s')",
								mysql_real_escape_string($owner));
				$r = mysql_query($sql);
				list($avatar) = mysql_fetch_row($r);
				
				$travel_fee = $price * .1;
				$maint = $travel_fee;
				$poller = json_encode(array(
					"signal" => $signal,
					"direction" => 6,
					"deed" => $deed,
					"owner_name" => $owner_name,
					"owner_avatar" => $avatar,
					"crewsize" => $crew_size,
					"travel" => $travel_fee,
					"did" => $random,
				));
			}
				
		}
	} else {	
		$poller = json_encode(array(
			"signal" => 3,	
		));	
	}
	return $poller;
}
//get user stats
$user_ID = id($user);		
$token = getStat('rp',$user_ID);
//check tokens
if($token < 10){
	$token_l = 1;
} else {
	$token_l = 2;
}
$energy = getStat('ep',$id);
if($energy == 0){
	echo $token_l;
} else {
	$trip = $energy - 1;
	setStat('ep',$id,$trip);
	$reward = dice($user,$area);
	echo $reward;
}
?>