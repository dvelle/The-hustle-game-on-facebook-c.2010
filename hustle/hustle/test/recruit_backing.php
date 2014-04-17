<?

$user = $_REQUEST["data"];
//$user = "jermongreen";
include 'stats.php';

require 'leveler.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

		// Gen Pop Scrub|Filter
		function recruit_scrub($tab1, $tab2) 
		{ 
		$result = array(); 
		
		foreach($tab1 as $values){
			if(! in_array($values, $tab2)) $result[] = $values;
		}
		
		return $result; 
		} 
		//
		$query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($user));
		$result = mysql_query($query);
		list($crewID) = mysql_fetch_row($result);		
		//
		// Identify recruits
		//
		$recruit_ar = array(); 
		$crwquery = sprintf("SELECT DISTINCT user FROM h_crew_member WHERE crew_id != ('%s')",
							mysql_escape_string($crewID));
		$result2 = mysql_query($crwquery);
		//
		//Muster Crew
		//
		$member_ar = array(); 
		$memquery = sprintf("SELECT DISTINCT user FROM h_crew_member WHERE crew_id = ('%s')",
							mysql_escape_string($crewID));
		$member = mysql_query($memquery);
		//
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result2)){
			array_push($recruit_ar, $result_ar);
			$i+=1;
		}
		//
		$j = 0;
		while($crew_ar = mysql_fetch_assoc($member)){
			array_push($member_ar, $crew_ar);
			$j+=1;
		}
		//
		$available = array();
		$available = recruit_scrub($recruit_ar, $member_ar);		
		//
		//
		foreach($available as $key => $value) {
			foreach($value as $key => $person) {
		//active within last 24 hours		
		$time = time();
		$active = $time - 86400;
		$query_time = sprintf("SELECT * FROM h_users WHERE UPPER(user) = UPPER('%s') AND last_login > $active",
			mysql_real_escape_string ($person));
		  $result_time = mysql_query($query_time);
		while($row_time = mysql_fetch_assoc($result_time)){
								 $username = $row_time['game_name'];
								 $them = $row_time['user'];
								 $userID = id($them); 
								 
			  $imagequery = sprintf("SELECT image FROM h_users WHERE user = '%s'",
								  mysql_escape_string($them));
			  $user_image = mysql_query($imagequery);
			  $image_ar = mysql_fetch_assoc($user_image);
			  $image = $image_ar['image'];
			  $cool = getStat('exp',$userID);
			  list($stage,$l_label) = leveler($cool);
			  $query = sprintf("SELECT rank FROM h_top_players WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($them));
					$result = mysql_query($query);
			   list($rank) = mysql_fetch_row($result);
			   $english_format_number = number_format($rank);
			   ?>
			   <table>
			   <?
			  echo "<tr><td id='vrow1'>".ucwords($username)."</td><td id='variable_row'>Level-".$stage." ".$l_label."</td><td id='vrow2'>".$english_format_number."</td> <td><input name='target' type='radio' value='".$them."'/></td></tr>";
		}
			}
		}
			?>
      </table>