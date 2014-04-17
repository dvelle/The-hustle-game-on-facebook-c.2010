<?

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
function cia($user){
	//law or criminal
	$sql = sprintf("SELECT law FROM h_users WHERE user = '%s'",
				   mysql_real_escape_string($user));
				   $results = mysql_query($sql);
				   list($law) = mysql_fetch_row($results);
	if($law == "cop"){
			//check if rap sheet full
			$query = "SELECT COUNT(id) FROM h_rap_sheet";
			$result = mysql_query($query);
			list($count) = mysql_fetch_row($result);
			if($count < 10){
				$query = sprintf("SELECT COUNT(id) FROM h_investigations WHERE UPPER(cop) = ('%s') AND done = ('%s') AND patrol > 0",				
				mysql_real_escape_string($user),
				0);
				$result = mysql_query($query);
				list($busy) = mysql_fetch_row($result);
				if($busy < 1){ 
					//ID more criminals
					return 1;
				} else {
					return 86;
				}
			} else {
				$random = rand(1,3);
				if($random == 1){					
					//investigate crew ID leader
					$stack = array();
					$mem = array();
					$querys = "SELECT * FROM h_users";
					$results = mysql_query($querys);
					while($user_arr = mysql_fetch_assoc($results)){
						$suspect = $user_arr["user"];
						$size = how_deep($suspect);
						if($size > 3){
							$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
											mysql_real_escape_string ($suspect));
							$result = mysql_query($query);
							list($crewid) = mysql_fetch_row($result);
							$query = sprintf("SELECT * FROM h_crew_member WHERE crew_id = ('%s') AND user != ('%s')",
											mysql_real_escape_string ($crewid),
											mysql_real_escape_string ($suspect));
							$result = mysql_query($query);
							while($mem_arr = mysql_fetch_assoc($result)){
								$mem_suspect = $mem_arr["user"];
								$query4 = sprintf("SELECT rob_won FROM h_users WHERE user = ('%s')",
											mysql_real_escape_string ($mem_suspect));
								$result4 = mysql_query($query4);
								list($rob_won) = mysql_fetch_row($result4);
								$query5 = sprintf("SELECT magic_sold FROM h_users WHERE user = ('%s')",
											mysql_real_escape_string ($mem_suspect));
								$result5 = mysql_query($query5);
								list($drugs) = mysql_fetch_row($result5);
								$query6 = sprintf("SELECT dvd_sold FROM h_users WHERE user = ('%s')",
											mysql_real_escape_string ($mem_suspect));
								$result6 = mysql_query($query6);
								list($dvds) = mysql_fetch_row($result6);
								$query7 = sprintf("SELECT lotto_sold FROM h_users WHERE user = ('%s')",
											mysql_real_escape_string ($mem_suspect));
								$result7 = mysql_query($query7);
								list($lotto) = mysql_fetch_row($result7);
								array_push($stack,$rob_won,$drugs,$dvds,$lotto);
								$totals = array_sum($stack);
								array_push($mem,$totals);
							}
							$crew_tot = array_sum($mem);
							$targeted = $crew_tot/$size;
							$sql = sprintf("UPDATE h_crew_main SET rap_sheet = ('%s') WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string ($targeted),
							mysql_real_escape_string ($suspect));
							mysql_query($sql);
						}
					}					
					$query8 = "SELECT user,title,MAX(rap_sheet) FROM h_crew_main";
								$result8 = mysql_query($query8);
					$row = mysql_fetch_array($result8);
					$theleader = $row['game_name'];
					$row['title'];	
					$title_id = $row['title'];
					$rap = $row['rap_sheet'];
					$award = rand(1,$rap);
					$time = time();
					$query = sprintf("INSERT INTO h_investigations(time,hood,cop,award) VALUES ('%s','%s','%s');",
								mysql_real_escape_string($time),
								mysql_real_escape_string($theleader),
								mysql_real_escape_string($user),
								mysql_real_escape_string($award));
							mysql_query($query);							
					return $title_id;
				} elseif($random == 2){
					//hot pursuit randomly pick a person of rap sheet list
					return 3;
				} else {
					return 4;
				}
			}
	}
}
?>
 