<?php
$user = $_REQUEST["data"];

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

include 'stats.php';

include 'leveler.php';

?>
<div id="fighters">
<table width="567">
        <?php
		// Gen Pop Scrub|Filter
		function array_diff_values($tab1, $tab2) 
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
		$available = array_diff_values($recruit_ar, $member_ar);		
		//
		//
		foreach($available as $key => $value) {
			foreach($value as $key => $person) {
				//Only show people active in last 24 hours.
				$time = time();
				$active = $time - 86400;
				$query_time = sprintf("SELECT * FROM h_users WHERE UPPER(user) = UPPER('%s') AND last_login > $active",
					mysql_real_escape_string ($person));
				  $result_time = mysql_query($query_time);
				while($row_time = mysql_fetch_assoc($result_time)){
					$health = getStat("health",$row_time['id']);
					if($health < 30){
						//
					} else {
						$username = $row_time['user'];
						$gname = $row_time['game_name'];
						?>
                        <tr>
                          <td width="17" id="vrow1"><?php 
                          $query = sprintf("SELECT * FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
                            mysql_real_escape_string ($username));
                          $result = mysql_query($query);
                          //
                          $war_ar = mysql_fetch_assoc($result);
                          $flag = $war_ar['mem_image'];
                          echo "<img src='http://www.12daysoffun.com/hustle/file/pic/crew/flags/$flag' ";?></td>
                          <td width="143" align="left" style="color:#FFF"><?php echo ucwords($gname);?></td>
                          <td id="variable_row" width="210"><?php 
                                $uid = id($username);
                                $cool = getStat('exp',$uid); 
                                list($stage,$l_label) = leveler($cool); 
                                echo "Level-"; echo $stage; echo " "; echo $l_label; ?></td>
                          <td id="vrow2" width="45"><?php
                                //
                                $query = sprintf("SELECT rank FROM h_top_players WHERE UPPER(user) = UPPER('%s') ORDER BY rank ASC",
                                    mysql_real_escape_string($username));
                                $result = mysql_query($query);
                                list($rank) = mysql_fetch_row($result);
                                $english_format_number = number_format($rank);
                                echo $english_format_number;						
                                ?></td>
                          <td width="63"><?php $size = how_deep($username); echo $size;?></td>      
                          <td width="61" style="padding-left:8px;"><input name="target" id="bullseye" type="radio" value="<?php echo $username?>"/></td>
                            </tr>
                            <?php
					}
				}
			}
		}
			?>
</table>            
</div>