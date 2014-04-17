<?php
include 'connect.php';
include 'stats.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_POST['name'];
//$user = "jermongreen";

$userID =  id($user);
//funct
function purses($leg){
	if($leg == 3){
		$prize = 150;
	}elseif($leg == 4){
		$prize = 600;
	}elseif($leg == 5){
		$prize = 1050;
	}elseif($leg == 6){
		$prize = 2400;
	}elseif($leg == 7){
		$prize = 5000;
	}
	return $prize;
} 
function tow($userID,$item){
	$sql = sprintf("DELETE FROM h_user_assets WHERE asset_id = (SELECT id FROM h_special_items WHERE name = '%s') AND user_id = ('%s')",																																 						mysql_real_escape_string($item),
						mysql_real_escape_string($userID));
					mysql_query($sql);
	return;
}
function pinkslip($userID){
	//take car
	$car1 = getAEggs("Luxury Sports Car",$userID);
	$car2 = getAEggs("Custom Sports Car",$userID);
	$car3 = getAEggs("Premium Automobile",$userID);
	$bike = getAEggs("2020 Motorcycle",$userID);
	$car4 = getAEggs("Mom's Car",$userID);
	if(!empty($car4)){
		$item = "Mom's Car";
		if($car4 >= 2){
			$count = $car4 - 1;
			setAEggs($item,$userID,$count);
		} else {
			//delete
			tow($userID,$item);
		}
		cooler($userID,"subtract",0);
	} elseif(!empty($car3)){
		$item = "Premium Automobile";
		$cb = 1200;
		if($car3 >= 2){
			$count = $car3 - 1;
			setAEggs($item,$userID,$count);
		} else {
			//delete
			tow($userID,$item);
		}
		cooler($userID,"subtract",$cb);
	} elseif(!empty($car2)){
		$item = "Custom Sports Car";
		$cb = 3400;
		if($car2 >= 2){
			$count = $car2 - 1;
			setAEggs($item,$userID,$count);
		} else {
			//delete
			tow($userID,$item);
		}
		cooler($userID,"subtract",$cb);
	} elseif(!empty($car1)){
		$item = "Luxury Sports Car";
		$cb = 5000;
		if($car1 >= 2){
			$count = $car1 - 1;
			setAEggs($item,$userID,$count);
		} else {
			//delete
			tow($userID,$item);
		}
		cooler($userID,"subtract",$cb);
	} elseif(!empty($bike)){
		$item = "2020 Motorcycle";
		$cb = 1000;
		if($bike >= 2){
			$count = $bike - 1;
			setAEggs($item,$userID,$count);
		} else {
			//delete
			tow($userID,$item);
		}
		cooler($userID,"subtract",$cb);
	} 
	return;
}
function wincirc($wid,$cool,$item){
	//give car to winner
	$car4 = getAEggs($item,$wid);
	$count = $car4 + 1;
	setAEggs($item,$wid,$count);
	cooler($wid,"add",$cool);
	return;
}
function cooler($uid,$math,$cool){
	if($math == "add"){
		$exp = getStat("exp",$wid);
		$boost = $exp + $cool;
		setStat("exp",$wid,$boost);
	} else {
		$exp = getStat("exp",$wid);
		$drain = $exp - $cool;
		setStat("exp",$wid,$drain);
	}
	return;
}
function pinkrace($loser,$winner){
	$userID = id($loser);
	$winnerid = id($winner);
	//take car
	$car1 = getAEggs("Luxury Sports Car",$userID);
	$car2 = getAEggs("Custom Sports Car",$userID);
	$car3 = getAEggs("Premium Automobile",$userID);
	$bike = getAEggs("2020 Motorcycle",$userID);
	$car4 = getAEggs("Mom's Car",$userID);
	if(!empty($car4)){
		$item = "Mom's Car";
		if($car4 >= 2){
			$count = $car4 - 1;
			setAEggs($item,$userID,$count);
		} else {
			//delete
			tow($userID,$item);
		}
		cooler($userID,"subtract",0);
		wincirc($winnerid,0,$item);
	} elseif(!empty($car3)){
		$item = "Premium Automobile";
		$cb = 1200;
		if($car3 >= 2){
			$count = $car3 - 1;
			setAEggs($item,$userID,$count);
		} else {
			//delete
			tow($userID,$item);
		}
		cooler($userID,"subtract",$cb);
		wincirc($winnerid,$cb,$item);
	} elseif(!empty($car2)){
		$item = "Custom Sports Car";
		$cb = 3400;
		if($car2 >= 2){
			$count = $car2 - 1;
			setAEggs($item,$userID,$count);
		} else {
			//delete
			tow($userID,$item);
		}
		cooler($userID,"subtract",$cb);
		wincirc($winnerid,$cb,$item);
	} elseif(!empty($car1)){
		$item = "Luxury Sports Car";
		$cb = 5000;
		if($car1 >= 2){
			$count = $car1 - 1;
			setAEggs($item,$userID,$count);
		} else {
			//delete
			tow($userID,$item);
		}
		cooler($userID,"subtract",$cb);
		wincirc($winnerid,$cb,$item);
	} elseif(!empty($bike)){
		$item = "2020 Motorcycle";
		$cb = 1000;
		if($bike >= 2){
			$count = $bike - 1;
			setAEggs($item,$userID,$count);
		} else {
			//delete
			tow($userID,$item);
		}
		cooler($userID,"subtract",$cb);
		wincirc($winnerid,$cb,$item);
	} 
	return;
}
function end_race($avg,$time1,$rid,$user){		
	$query = sprintf("UPDATE h_race_challenges SET score1 = ('%s'), time1 = ('%s') WHERE id = ('%s') AND UPPER(user1) = UPPER('%s')",
			mysql_real_escape_string ($avg),
			mysql_real_escape_string ($time1),
			mysql_real_escape_string ($rid),
			mysql_real_escape_string ($user));
	mysql_query($query);
		
	$sql = sprintf("DELETE FROM h_tourney WHERE user = ('%s')",
				mysql_real_escape_string ($user));
			mysql_query($sql);
			
	$sql = sprintf("UPDATE h_users SET chopshop = '%s' WHERE user = ('%s')",
						mysql_real_escape_string(0),
						mysql_real_escape_string($user));
			mysql_query($sql);
	return;
}
//is there an egg race?
$query = sprintf("SELECT * FROM h_tourney WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user));
$result = mysql_query($query);
$row = mysql_fetch_array($result);

if(is_array($row)){
	$done = $row["completed"];
	$indy = $row["time_left"];
	$time = time();
	//
	$chop_query = sprintf("SELECT chopshop FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
	$chop_result = mysql_query($chop_query);
	list($races) = mysql_fetch_row($chop_result);
	//
	if($done == 2){
		//is this a race challenge?
		$query = sprintf("SELECT * FROM h_race_challenges WHERE UPPER(user1) = UPPER('%s') AND done = ('%s')",
				mysql_real_escape_string ($user),
				0);
		$result = mysql_query($query);
		$finish_ar = mysql_fetch_assoc($result);
		//update score
		if(is_array($finish_ar)){
			///YES THEY ARE THE INSTIGATOR!!!
			$time1 = $time - $indy;
			$rid = $finish_ar["id"];
			$total = $row["race1"] + $row["race2"] + $row["race3"] + $row["race4"] + $row["race5"] + $row["race6"] + $row["race7"];
			$avg = $total/$races;
			
			end_race($avg,$time1,$rid,$user);
			echo 12;//waiting
		} else {
			////Identify if user satisfied a challenge | Are they the defender?
			$query = sprintf("SELECT * FROM h_race_challenges WHERE UPPER(user2) = UPPER('%s') AND `done` = ('%s')",
						mysql_real_escape_string ($user),
						0);
			$result = mysql_query($query);
			$fight_ar = mysql_fetch_assoc($result);
			if(is_array($fight_ar)){
				//they are defending
				//Retrieve all fight variables
				$instigator = $fight_ar["user1"];
				$instigator_s = $fight_ar["score1"];
				$instigator_t = $fight_ar["time1"];
				$race_id = $fight_ar["id"];
				$ins_action = $fight_ar["action1"];
				$def_action = $fight_ar["action2"];
				$wager = $fight_ar["wager"];
						
				//Insert new score
				$time2 = $time - $indy;
				$rid = $finish_ar["id"];
				$total = $row["race1"] + $row["race2"] + $row["race3"] + $row["race4"] + $row["race5"] + $row["race6"] + $row["race7"];
				$avg2 = $total/$races;
				
				$query = sprintf("UPDATE h_race_challenges SET score2 = ('%s'), time2 = ('%s'), done = ('%s') WHERE id = ('%s') AND UPPER(user2) = UPPER('%s')",
						mysql_real_escape_string ($avg2),
						mysql_real_escape_string ($time2),
						1,
						mysql_real_escape_string ($race_id),
						mysql_real_escape_string ($user));
				mysql_query($query);
				
				$query = sprintf("SELECT uid FROM h_users WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($user));
						$result = mysql_query($query);
				list($tid) = mysql_fetch_row($result);
	
				$sql = sprintf("DELETE FROM h_fb_challenges WHERE user2 = ('%s')",
							mysql_real_escape_string ($tid));
						mysql_query($sql);
						
				$sql = sprintf("DELETE FROM h_tourney WHERE user = ('%s')",
					mysql_real_escape_string ($user));
				mysql_query($sql);
				
				$sql = sprintf("UPDATE h_users SET chopshop = '%s' WHERE user = ('%s')",
							mysql_real_escape_string(0),
							mysql_real_escape_string($user));
				mysql_query($sql);
				
				//Check scores	
				if($time2 > $instigator_t){
					$r_news = "you won";
					$s_news = "losing";
					$defender_win = 1;
				} else {
					$r_news = "they won";
					$s_news = "you won";
					$defender_win = 0;
				}	
				//Retrieve Instigator User ID
				$i_userID = id($instigator);
				//AND Retrieve Instigator Crew ID
				$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
								mysql_real_escape_string ($instigator));
				$result = mysql_query($query);
				list($i_crewID) = mysql_fetch_row($result);
				//
				//Retrieve action settings
				if($ins_action == "defend" && $def_action == "defend"){
					$battle = 0;
				} else {
					$battle = 1;
				}
				//BATTLE-FIELD
				if($battle == 1){
					 // ************ROBBERY************************************
					 //********************ROBBERY*****************************
					 //****************************ROBBERY*********************
					 $instigator_strength = battle_prep($instigator,$ins_action);
					 $defender_strength = battle_prep($user,$def_action);
					
					 ////FIGHT!
					 $i_tactics = $instigator_strength;
					 $sql = sprintf("UPDATE arcade_challenges SET power1 = ('%s') WHERE id = ('%s')",
							mysql_real_escape_string($i_tactics),
							mysql_real_escape_string($race_id));
							mysql_query($sql);
							
					 $d_tactics = $defender_strength;
					 $sql = sprintf("UPDATE arcade_challenges SET power2 = ('%s') WHERE id = ('%s')",
							mysql_real_escape_string($d_tactics),
							mysql_real_escape_string($race_id));
							mysql_query($sql);
					 if($i_tactics > $d_tactics){
						//****************
						//instigator wins
						//****************
						//PROFILE UPDATE
						
						//Challenge won
						$que = sprintf("SELECT race_won FROM h_users WHERE user=('%s')",
									mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($race_won) = mysql_fetch_row($result);
						
						$race_won = $race_won + 1;
						
						$sql = sprintf("UPDATE h_users SET race_won = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($race_won),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
							
						//Robbery Won
						$que = sprintf("SELECT rob_won FROM h_users WHERE user=('%s')",
									mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($rob_won) = mysql_fetch_row($result);
						
						$rob_won = $rob_won + 1;
						
						$sql = sprintf("UPDATE h_users SET rob_won = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_won),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
						//
						
						$robbery_value = $i_tactics - $d_tactics;
						//medical
						medical($robbery_value,$userID,$user);
						//
						$hit = rand(1,$robbery_value);
						//check if cleader and crew have the CASH...
						$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
										mysql_real_escape_string($user));
						$result = mysql_query($query);
						list($crewID) = mysql_fetch_row($result);
					
						$net_worth = crew_worth($user_ID, $crewID);
						//EXIT POINT
						if($net_worth <= 0){
							// just take car and wager
							pinkrace($user,$instigator);
							$pocket = getStat("cash",$i_userID);
							$dep = $pocket + $wager;
							setStat("cash",$i_userID,$dep);
							echo 103; //lost car
						} else {
							pinkrace($user,$instigator);
							
							$pocket = getStat("cash",$i_userID);
							$dep = $pocket + $wager;
							setStat("cash",$i_userID,$dep);
							
							$pocket = getStat("cash",$user_ID);
							$deb = $pocket - $wager;
							setStat("cash",$user_ID,$deb);
							
							//cool points lost
							$cool_points_lost = rand(1,$robbery_value);
							$math = "substract";
							cooler($i_userID,$math,$cool_points_lost);
							medical($cool_points_lost,$i_userID,$instigator);
							//Spread Defender's CASH Loss (and earn cool points!)
							//AND Retrieve User Crew ID
							
							//PROFILE UPDATE
							
							//Challenge Lost
							$que = sprintf("SELECT race_lost FROM h_users WHERE user=('%s')",
									mysql_real_escape_string($user));
							$result = mysql_query($que);
							list($race_lost) = mysql_fetch_row($result);
							
							$race_lost = $race_lost + 1;
							
							$sql = sprintf("UPDATE h_users SET race_lost = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string($race_lost),
								mysql_real_escape_string($user));
								mysql_query($sql);
													
							//Robbed
							$que = sprintf("SELECT robbed_tot FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($user));
							$result = mysql_query($que);
							list($rob_tot) = mysql_fetch_row($result);
							
							$rob_tot = $rob_tot + 1;
							
							$sql = sprintf("UPDATE h_users SET robbed_tot = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string($rob_tot),
								mysql_real_escape_string($user));
								mysql_query($sql);
								
							//Snitch							
							$sql_l = sprintf("UPDATE h_users SET snitch = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string(1),
								mysql_real_escape_string($user));
								mysql_query($sql_l);
							//
							
							//COOL POINTS EARNED for fighting the good fight! | maybe
							$adjusted = rand(1,$robbery_value);			
							$luck = rand(1,3);
							
							if($luck == 1){
								$math = "add";
								$report = $adjusted;
								$d_extra_news = "earning you ".$report."CP";
								cooler($user_ID,$math,$adjusted);
							} elseif($luck == 3) {
								$math = "subtract";
								$d_extra_news = "costing you ".$report."CP";
								cooler($user_ID,$math,$adjusted);
								$b_report = $adjusted;
							}		
							
							$time = time();
							//ARCADE
							
							//USER NEWS
							//********************************************
													
							$recipient_message = ucwords($instigator)." robbed you of $".$cash_stolen." after ".$r_news." the race".$d_extra_news;
							//
							reporter($user,1,$recipient_message,"recipient");
							//				
							$sender_message = "You robbed ".ucwords($user)." of $".$cash_stolen." after ".$s_news." the race costing you ".$cool_points_lost."CP";
							reporter($instigator,1,$sender_message,"recipient");			
						}
						echo 103;
					 } elseif($i_tactics < $d_tactics) {
						//defender wins
						//PROFILE UPDATE
						pinkrace($instigator,$user);
						//Challenge won
						$que = sprintf("SELECT race_won FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($user));
						$result = mysql_query($que);
						list($ch_won) = mysql_fetch_row($result);
						
						$ch_won = $ch_won + 1;
						
						$sql = sprintf("UPDATE h_users SET race_won = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_won),
							mysql_real_escape_string($user));
							mysql_query($sql);
							
						//Robbery lost
						$que = sprintf("SELECT rob_lost FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($rob_lost) = mysql_fetch_row($result);
						
						$rob_lost = $rob_lost + 1;
						
						$sql = sprintf("UPDATE h_users SET rob_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_lost),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
											
						////Challenge lost
						$que = sprintf("SELECT race_lost FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($instigator));
						$result =mysql_query($que);
						list($ch_lost) = mysql_fetch_row($result);
						
						$ch_lost = $ch_lost + 1;
						
						$sql = sprintf("UPDATE h_users SET race_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_lost),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
							
						//
						$net_take = $d_tactics - $i_tactics;
						//health
						medical($net_take,$i_userID,$instigator);
						if($def_action == "attack"){
							$cool_points_earned = rand(1,$net_take);
							$number = $net_take - $cool_points_earned;
							$cash_gain = rand(0,$number);
							// Guilty or Innocent 
							if($defender_win == 1){
								$math = "add";
								$d_extra_news = " earning you ";
							}else{
								$math = "subtract";
								$d_extra_news = " costing you ";
							}
							$adjusted = $cool_points_earned;
							cooler($user_ID,$math,$adjusted);
							//Cash Deposit
							$d_cash = getStat('cash',$user_ID);
							$net_gain = $d_cash + $wager;
							$mk_deposit = setStat('cash',$user_ID,$net_gain);
							//News
						} else {				
							$cool_points_earned = rand(1,$net_take);
							$math = "add";
							$adjusted = $cool_points_earned;
							coolpoint_adjuster($user_ID,$math,$adjusted);
							//Cash Deposit
							$d_cash = getStat('cash',$user_ID);
							$net_gain = $d_cash + $wager;
							$mk_deposit = setStat('cash',$user_ID,$net_gain);
						}
						//Instigator Lost Cool
						$cool_points_loss = rand(1,$net_take);
						$math = "subtract";
						cooler($i_userID,$math,$cool_points_loss);
						medical($cool_points_loss,$user_ID,$user);
						//BREAKING NEWS********************************************//BREAKING NEWS
						$time = time();
						$plus = $cool_points_earned."CP";
						//USER NEWS
						$recipient_message = ucwords($instigator)." tried to rob you after ".$r_news." the last race".$d_extra_news.$plus;
							//
						reporter($user,1,$recipient_message,"recipient");
						//				
						$sender_message = "Your attempted robbery of ".ucwords($user)." failed, after ".$s_news." the last race costing you ".$cool_points_loss." CP";
						reporter($instigator,1,$sender_message,"recipient");
						echo 100;
					 } elseif($i_tactics == $d_tactics){
						 if($instigator_t < $time2 || $instigator_s > $avg2){
							 //ins wins
							 pinkrace($user,$instigator);
							 $pocket = getStat("cash",$i_userID);
							 $dep = $pocket + $wager;
							 setStat("cash",$i_userID,$dep);
							 
							 $pocket = getStat("cash",$user_ID);
							 $deb = $pocket - $wager;
							 setStat("cash",$user_ID,$deb);
						 } elseif($time2 < $instigator_t || $avg2 > $instigator_s) {
							 //def wins
							 pinkrace($instigator,$user);
							 $pocket = getStat("cash",$i_userID);
							 $deb = $pocket - $wager;
							 setStat("cash",$i_userID,$deb);
							 
							 $pocket = getStat("cash",$user_ID);
							 $dep = $pocket + $wager;
							 setStat("cash",$user_ID,$dep);
						 } else {
							 //stalemate
							 $recipient_message = $instigator." attempted to over power and rob you but you <b>resisted</b>!";
							//
							reporter($user,1,$recipient_message,"recipient");
							//				
							$sender_message = $user." was stronger than you thought and <b>resisted</b> your robbery attempt!";
							reporter($instigator,1,$sender_message,"recipient");
						 }
						 echo 13;
					 }
				} else {
					 //FAIR PLAY
					 ////////////////////////////////////////////////////////////
					 ////////////FAIR PLAY//////////////////////////////////////
					 ///////////////////////FAIR PLAY///////////////////////////
					 
					 if($instigator_t < $time2){
						 //PROFILE UPDATE
					
						//Challenge won
						$que = sprintf("SELECT race_won FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($ch_won) = mysql_fetch_row($result);
						
						$ch_won = $ch_won + 1;
						
						$sql = sprintf("UPDATE h_users SET race_won = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_won),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
						
						//
						//Cash Deposit
						pinkrace($user,$instigator);
						$i_cash = getStat('cash',$i_userID);
						$net_gain = $i_cash + $wager;
						setStat('cash',$i_userID,$net_gain);
						//Earn Cool
						$cool_points_earned = rand(1,$wager);
						$math = "add";
						$adjusted = $cool_points_earned;
						cooler($i_userID,$math,$adjusted);
						//Defender Lost Cool
						
						//PROFILE UPDATE
						////Challenge loss
						$que = sprintf("SELECT race_lost FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($user));
						$result = mysql_query($que);
						list($ch_lost) = mysql_fetch_row($result);
						
						$ch_lost = $ch_lost + 1;
						
						$sql = sprintf("UPDATE h_users SET race_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_lost),
							mysql_real_escape_string($user));
							mysql_query($sql);
							
						
						$cool_points_loss = rand(1,$wager);
						$math = "subtract";
						cooler($user_ID,$math,$cool_points_loss);
						//Breaking NEws
						//ARCADE - Instigator wins
						//USER NEWS
						$recipient_message = ucwords($instigator)." was fair after you lost the race, losing you a total of $".$wager." cash and a car";
						//
						reporter($user,1,$recipient_message,"recipient");
						//				
						$sender_message = ucwords($user)." was fair after you won the race, you won a total of $".$wager." cash and a their car";
						reporter($instigator,1,$sender_message,"recipient");
						echo 103;
					 } elseif($instigator_t > $time2) {							
						 //PROFILE UPDATE
						 ////Challenge won
						 $que = sprintf("SELECT race_won FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($user));
						 $result = mysql_query($que);
						list($ch_won) = mysql_fetch_row($result);
						
						$ch_won = $ch_won + 1;
						
						$sql = sprintf("UPDATE h_users SET race_won = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_won),
							mysql_real_escape_string($user));
							mysql_query($sql);
						//Cash Deposit
						$d_cash = getStat('cash',$user_ID);
						$net_gain = $d_cash + $wager;
						$mk_deposit = setStat('cash',$user_ID,$net_gain);
						//Earn Cool
						$cool_points_earned = rand(1,$wager);
						$math = "add";
						$adjusted = $cool_points_earned;
						cooler($user_ID,$math,$adjusted);
						//Instigator Lost Cool
						
						//PROFILE UPDATE
						////Challenge loss
						$que = sprintf("SELECT race_lost FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($ch_lost) = mysql_fetch_row($result);
						
						$ch_lost = $ch_lost + 1;
						
						$sql = sprintf("UPDATE h_users SET race_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_lost),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
						
						$cool_points_loss = rand(1,$wager);
						$math = "subtract";
						cooler($i_userID,$math,$cool_points_loss);
						//BREAKING NEWS
						//ARCADE - defender win
						//USER NEWS
						$recipient_message = ucwords($instigator)." was fair after you won the race, earning you a total of $".$wager." cash and their car";
						//
						reporter($user,1,$recipient_message,"recipient");
						//				
						$sender_message = ucwords($user)." was fair after you lost the race, losing you a total of $".$wager." cash and a car";
						reporter($instigator,1,$sender_message,"recipient");
						$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($user));
						$result = mysql_query($query);
						list($chapter) = mysql_fetch_row($result);
						if($chapter == 5){
							$chapter = $chapter + 1;
							$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
								mysql_real_escape_string($chapter),
								mysql_real_escape_string($user));
							mysql_query($query);
						}
						echo 100;
					 } elseif ($instigator_t == $time2){
						 if($instigator_s > $avg2){
							 //ins wins
							 pinkrace($user,$instigator);
							 $pocket = getStat("cash",$i_userID);
							 $dep = $pocket + $wager;
							 setStat("cash",$i_userID,$dep);
							 
							 $pocket = getStat("cash",$user_ID);
							 $deb = $pocket - $wager;
							 setStat("cash",$user_ID,$deb);
						 } elseif($avg2 > $instigator_s) {
							 //def wins
							 pinkrace($instigator,$user);
							 $pocket = getStat("cash",$i_userID);
							 $deb = $pocket - $wager;
							 setStat("cash",$i_userID,$deb);
							 
							 $pocket = getStat("cash",$user_ID);
							 $dep = $pocket + $wager;
							 setStat("cash",$user_ID,$dep);
						 } else {
							 //stalemate
							 $recipient_message = "The race with".ucwords($instigator)."ended in a tie!";
							//
							reporter($user,1,$recipient_message,"recipient");
							//				
							$sender_message = "The race with ".ucwords($user)." ended in a tie!";
							reporter($instigator,1,$sender_message,"recipient");
						 }
						 echo 13;
					 }
				}
			} else {
				//check for chop shop race(Single Player)
				if(!empty($races)){
					//check to see if score too low
					$total = $row["race1"] + $row["race2"] + $row["race3"] + $row["race4"] + $row["race5"] + $row["race6"] + $row["race7"];
					$goalline = $races * 5000;
					$avg = $total/$races;
					if($avg < $goalline){
						$sql = sprintf("DELETE FROM h_tourney WHERE user = ('%s')",
									mysql_real_escape_string ($user));
								mysql_query($sql);
								
						$quer = sprintf("UPDATE h_users SET chopshop = '%s' WHERE user = ('%s')",
										mysql_real_escape_string(0),
										mysql_real_escape_string($user));
						mysql_query($quer);	
						if($races == 6 || $races == 7){
							//
							pinkslip($userID);
						}
						echo 102;//low score
					} else {
						$prize = purses($races);
						$cash = getStat("cash",$userID);
						$cash = $cash + $prize;
						setStat("cash",$userID,$cash);	
						$sql = sprintf("DELETE FROM h_tourney WHERE user = ('%s')",
									mysql_real_escape_string ($user));
								mysql_query($sql);
								
						$quer = sprintf("UPDATE h_users SET chopshop = '%s' WHERE user = ('%s')",
										mysql_real_escape_string(0),
										mysql_real_escape_string($user));
						mysql_query($quer);	
						
						echo 100;//win
					}
				} else {
					//check to see if score too low
					$total = $row["race1"] + $row["race2"] + $row["race3"] + $row["race4"] + $row["race5"] + $row["race6"] + $row["race7"] + $row["race8"] + $row["race9"] + $row["race10"];
					
					$avg = $total/10;
					if($avg < 50000){
						$sql = sprintf("DELETE FROM h_tourney WHERE user = ('%s')",
									mysql_real_escape_string ($user));
								mysql_query($sql);
						echo 102;//low score
					} else {
						$cash = getStat("cash",$userID);
						$cash = $cash + 1000000;
						setStat("cash",$userID,$cash);	
						$sql = sprintf("DELETE FROM h_tourney WHERE user = ('%s')",
									mysql_real_escape_string ($user));
								mysql_query($sql);
						echo 100;//win
					}
				}
			}
		}
	} else {
		if($time < $indy){
			//continue
			echo 199;
		} else {
			//out of time;
			$query = sprintf("SELECT * FROM h_race_challenges WHERE UPPER(user1) = UPPER('%s') OR UPPER(user2) = UPPER('%s') AND done = ('%s')",
				mysql_real_escape_string ($user),
				mysql_real_escape_string ($user),
				0);
			$result = mysql_query($query);
			$finish_ar = mysql_fetch_assoc($result);
			//update score
			if(is_array($finish_ar)){				
				//check if this is user1 or 2?
				$query = sprintf("SELECT * FROM h_race_challenges WHERE UPPER(user1) = UPPER('%s') AND done = ('%s')",
					mysql_real_escape_string ($user),
					0);
				$result = mysql_query($query);
				$fight_ar1 = mysql_fetch_assoc($result);
				//user2
				$query = sprintf("SELECT * FROM h_race_challenges WHERE UPPER(user2) = UPPER('%s') AND done = ('%s')",
					mysql_real_escape_string ($user),
					0);
				$result = mysql_query($query);
				$fight_ar = mysql_fetch_assoc($result);
				if(is_array($fight_ar1)){
					$time1 = $time - $indy;
					$rid = $finish_ar["id"];
					$total = $row["race1"] + $row["race2"] + $row["race3"] + $row["race4"] + $row["race5"] + $row["race6"] + $row["race7"];
					$avg = $total/$races;
					
					end_race($avg,$time1,$rid,$user);
				} elseif(is_array($fight_ar)){
					//they are defending
				//Retrieve all fight variables
				$instigator = $fight_ar["user1"];
				$instigator_s = $fight_ar["score1"];
				$instigator_t = $fight_ar["time1"];
				$race_id = $fight_ar["id"];
				$ins_action = $fight_ar["action1"];
				$def_action = $fight_ar["action2"];
				$wager = $fight_ar["wager"];
						
				//Insert new score
				$time2 = $time - $indy;
				$rid = $finish_ar["id"];
				$total = $row["race1"] + $row["race2"] + $row["race3"] + $row["race4"] + $row["race5"] + $row["race6"] + $row["race7"];
				$avg2 = $total/$races;
				
				$query = sprintf("UPDATE h_race_challenges SET score2 = ('%s'), time2 = ('%s'), done = ('%s') WHERE id = ('%s') AND UPPER(user2) = UPPER('%s')",
						mysql_real_escape_string ($avg2),
						mysql_real_escape_string ($time2),
						1,
						mysql_real_escape_string ($race_id),
						mysql_real_escape_string ($user));
				mysql_query($query);
				
				$query = sprintf("SELECT uid FROM h_users WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($user));
						$result = mysql_query($query);
				list($tid) = mysql_fetch_row($result);
	
				$sql = sprintf("DELETE FROM h_fb_challenges WHERE user2 = ('%s')",
							mysql_real_escape_string ($tid));
						mysql_query($sql);
						
				$sql = sprintf("DELETE FROM h_tourney WHERE user = ('%s')",
					mysql_real_escape_string ($user));
				mysql_query($sql);
				
				$sql = sprintf("UPDATE h_users SET chopshop = '%s' WHERE user = ('%s')",
							mysql_real_escape_string(0),
							mysql_real_escape_string($user));
				mysql_query($sql);
				
				//Check scores	
				if($time2 > $instigator_t){
					$r_news = "you won";
					$s_news = "losing";
					$defender_win = 1;
				} else {
					$r_news = "they won";
					$s_news = "you won";
					$defender_win = 0;
				}	
				//Retrieve Instigator User ID
				$i_userID = id($instigator);
				//AND Retrieve Instigator Crew ID
				$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
								mysql_real_escape_string ($instigator));
				$result = mysql_query($query);
				list($i_crewID) = mysql_fetch_row($result);
				//
				//Retrieve action settings
				if($ins_action == "defend" && $def_action == "defend"){
					$battle = 0;
				} else {
					$battle = 1;
				}
				//BATTLE-FIELD
				if($battle == 1){
					 // ************ROBBERY************************************
					 //********************ROBBERY*****************************
					 //****************************ROBBERY*********************
					 $instigator_strength = battle_prep($instigator,$ins_action);
					 $defender_strength = battle_prep($user,$def_action);
					
					 ////FIGHT!
					 $i_tactics = $instigator_strength;
					 $sql = sprintf("UPDATE arcade_challenges SET power1 = ('%s') WHERE id = ('%s')",
							mysql_real_escape_string($i_tactics),
							mysql_real_escape_string($race_id));
							mysql_query($sql);
							
					 $d_tactics = $defender_strength;
					 $sql = sprintf("UPDATE arcade_challenges SET power2 = ('%s') WHERE id = ('%s')",
							mysql_real_escape_string($d_tactics),
							mysql_real_escape_string($race_id));
							mysql_query($sql);
					 if($i_tactics > $d_tactics){
						//****************
						//instigator wins
						//****************
						//PROFILE UPDATE
						
						//Challenge won
						$que = sprintf("SELECT race_won FROM h_users WHERE user=('%s')",
									mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($race_won) = mysql_fetch_row($result);
						
						$race_won = $race_won + 1;
						
						$sql = sprintf("UPDATE h_users SET race_won = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($race_won),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
							
						//Robbery Won
						$que = sprintf("SELECT rob_won FROM h_users WHERE user=('%s')",
									mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($rob_won) = mysql_fetch_row($result);
						
						$rob_won = $rob_won + 1;
						
						$sql = sprintf("UPDATE h_users SET rob_won = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_won),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
						//
						
						$robbery_value = $i_tactics - $d_tactics;
						//medical
						medical($robbery_value,$userID,$user);
						//
						$hit = rand(1,$robbery_value);
						//check if cleader and crew have the CASH...
						$query = sprintf("SELECT id FROM h_crew_main WHERE user = ('%s')",
										mysql_real_escape_string($user));
						$result = mysql_query($query);
						list($crewID) = mysql_fetch_row($result);
					
						$net_worth = crew_worth($user_ID, $crewID);
						//EXIT POINT
						if($net_worth <= 0){
							// just take car and wager
							pinkrace($user,$instigator);
							$pocket = getStat("cash",$i_userID);
							$dep = $pocket + $wager;
							setStat("cash",$i_userID,$dep);
							echo 103; //lost car
						} else {
							pinkrace($user,$instigator);
							
							$pocket = getStat("cash",$i_userID);
							$dep = $pocket + $wager;
							setStat("cash",$i_userID,$dep);
							
							$pocket = getStat("cash",$user_ID);
							$deb = $pocket - $wager;
							setStat("cash",$user_ID,$deb);
							
							//cool points lost
							$cool_points_lost = rand(1,$robbery_value);
							$math = "substract";
							cooler($i_userID,$math,$cool_points_lost);
							medical($cool_points_lost,$i_userID,$instigator);
							//Spread Defender's CASH Loss (and earn cool points!)
							//AND Retrieve User Crew ID
							
							//PROFILE UPDATE
							
							//Challenge Lost
							$que = sprintf("SELECT race_lost FROM h_users WHERE user=('%s')",
									mysql_real_escape_string($user));
							$result = mysql_query($que);
							list($race_lost) = mysql_fetch_row($result);
							
							$race_lost = $race_lost + 1;
							
							$sql = sprintf("UPDATE h_users SET race_lost = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string($race_lost),
								mysql_real_escape_string($user));
								mysql_query($sql);
													
							//Robbed
							$que = sprintf("SELECT robbed_tot FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($user));
							$result = mysql_query($que);
							list($rob_tot) = mysql_fetch_row($result);
							
							$rob_tot = $rob_tot + 1;
							
							$sql = sprintf("UPDATE h_users SET robbed_tot = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string($rob_tot),
								mysql_real_escape_string($user));
								mysql_query($sql);
								
							//Snitch							
							$sql_l = sprintf("UPDATE h_users SET snitch = ('%s') WHERE user = ('%s')",
								mysql_real_escape_string(1),
								mysql_real_escape_string($user));
								mysql_query($sql_l);
							//
							
							//COOL POINTS EARNED for fighting the good fight! | maybe
							$adjusted = rand(1,$robbery_value);			
							$luck = rand(1,3);
							
							if($luck == 1){
								$math = "add";
								$report = $adjusted;
								$d_extra_news = "earning you ".$report."CP";
								cooler($user_ID,$math,$adjusted);
							} elseif($luck == 3) {
								$math = "subtract";
								$d_extra_news = "costing you ".$report."CP";
								cooler($user_ID,$math,$adjusted);
								$b_report = $adjusted;
							}		
							
							$time = time();
							//ARCADE
							
							//USER NEWS
							//********************************************
													
							$recipient_message = ucwords($instigator)." robbed you of $".$cash_stolen." after ".$r_news." the race".$d_extra_news;
							//
							reporter($user,1,$recipient_message,"recipient");
							//				
							$sender_message = "You robbed ".ucwords($user)." of $".$cash_stolen." after ".$s_news." the race costing you ".$cool_points_lost."CP";
							reporter($instigator,1,$sender_message,"recipient");			
						}
						echo 103;
					 } elseif($i_tactics < $d_tactics) {
						//defender wins
						//PROFILE UPDATE
						pinkrace($instigator,$user);
						//Challenge won
						$que = sprintf("SELECT race_won FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($user));
						$result = mysql_query($que);
						list($ch_won) = mysql_fetch_row($result);
						
						$ch_won = $ch_won + 1;
						
						$sql = sprintf("UPDATE h_users SET race_won = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_won),
							mysql_real_escape_string($user));
							mysql_query($sql);
							
						//Robbery lost
						$que = sprintf("SELECT rob_lost FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($rob_lost) = mysql_fetch_row($result);
						
						$rob_lost = $rob_lost + 1;
						
						$sql = sprintf("UPDATE h_users SET rob_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($rob_lost),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
											
						////Challenge lost
						$que = sprintf("SELECT race_lost FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($instigator));
						$result =mysql_query($que);
						list($ch_lost) = mysql_fetch_row($result);
						
						$ch_lost = $ch_lost + 1;
						
						$sql = sprintf("UPDATE h_users SET race_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_lost),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
							
						//
						$net_take = $d_tactics - $i_tactics;
						//health
						medical($net_take,$i_userID,$instigator);
						if($def_action == "attack"){
							$cool_points_earned = rand(1,$net_take);
							$number = $net_take - $cool_points_earned;
							$cash_gain = rand(0,$number);
							// Guilty or Innocent 
							if($defender_win == 1){
								$math = "add";
								$d_extra_news = " earning you ";
							}else{
								$math = "subtract";
								$d_extra_news = " costing you ";
							}
							$adjusted = $cool_points_earned;
							cooler($user_ID,$math,$adjusted);
							//Cash Deposit
							$d_cash = getStat('cash',$user_ID);
							$net_gain = $d_cash + $wager;
							$mk_deposit = setStat('cash',$user_ID,$net_gain);
							//News
						} else {				
							$cool_points_earned = rand(1,$net_take);
							$math = "add";
							$adjusted = $cool_points_earned;
							coolpoint_adjuster($user_ID,$math,$adjusted);
							//Cash Deposit
							$d_cash = getStat('cash',$user_ID);
							$net_gain = $d_cash + $wager;
							$mk_deposit = setStat('cash',$user_ID,$net_gain);
						}
						//Instigator Lost Cool
						$cool_points_loss = rand(1,$net_take);
						$math = "subtract";
						cooler($i_userID,$math,$cool_points_loss);
						medical($cool_points_loss,$user_ID,$user);
						//BREAKING NEWS********************************************//BREAKING NEWS
						$time = time();
						$plus = $cool_points_earned."CP";
						//USER NEWS
						$recipient_message = ucwords($instigator)." tried to rob you after ".$r_news." the last race".$d_extra_news.$plus;
							//
						reporter($user,1,$recipient_message,"recipient");
						//				
						$sender_message = "Your attempted robbery of ".ucwords($user)." failed, after ".$s_news." the last race costing you ".$cool_points_loss." CP";
						reporter($instigator,1,$sender_message,"recipient");
						echo 100;
					 } elseif($i_tactics == $d_tactics){
						 if($instigator_t < $time2 || $instigator_s > $avg2){
							 //ins wins
							 pinkrace($user,$instigator);
							 $pocket = getStat("cash",$i_userID);
							 $dep = $pocket + $wager;
							 setStat("cash",$i_userID,$dep);
							 
							 $pocket = getStat("cash",$user_ID);
							 $deb = $pocket - $wager;
							 setStat("cash",$user_ID,$deb);
						 } elseif($time2 < $instigator_t || $avg2 > $instigator_s) {
							 //def wins
							 pinkrace($instigator,$user);
							 $pocket = getStat("cash",$i_userID);
							 $deb = $pocket - $wager;
							 setStat("cash",$i_userID,$deb);
							 
							 $pocket = getStat("cash",$user_ID);
							 $dep = $pocket + $wager;
							 setStat("cash",$user_ID,$dep);
						 } else {
							 //stalemate
							 $recipient_message = $instigator." attempted to over power and rob you but you <b>resisted</b>!";
							//
							reporter($user,1,$recipient_message,"recipient");
							//				
							$sender_message = $user." was stronger than you thought and <b>resisted</b> your robbery attempt!";
							reporter($instigator,1,$sender_message,"recipient");
						 }
						 echo 13;
					 }
				} else {
					 //FAIR PLAY
					 ////////////////////////////////////////////////////////////
					 ////////////FAIR PLAY//////////////////////////////////////
					 ///////////////////////FAIR PLAY///////////////////////////
					 
					 if($instigator_t < $time2){
						 //PROFILE UPDATE
					
						//Challenge won
						$que = sprintf("SELECT race_won FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($ch_won) = mysql_fetch_row($result);
						
						$ch_won = $ch_won + 1;
						
						$sql = sprintf("UPDATE h_users SET race_won = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_won),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
						
						//
						//Cash Deposit
						pinkrace($user,$instigator);
						$i_cash = getStat('cash',$i_userID);
						$net_gain = $i_cash + $wager;
						setStat('cash',$i_userID,$net_gain);
						//Earn Cool
						$cool_points_earned = rand(1,$wager);
						$math = "add";
						$adjusted = $cool_points_earned;
						cooler($i_userID,$math,$adjusted);
						//Defender Lost Cool
						
						//PROFILE UPDATE
						////Challenge loss
						$que = sprintf("SELECT race_lost FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($user));
						$result = mysql_query($que);
						list($ch_lost) = mysql_fetch_row($result);
						
						$ch_lost = $ch_lost + 1;
						
						$sql = sprintf("UPDATE h_users SET race_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_lost),
							mysql_real_escape_string($user));
							mysql_query($sql);
							
						
						$cool_points_loss = rand(1,$wager);
						$math = "subtract";
						cooler($user_ID,$math,$cool_points_loss);
						//Breaking NEws
						//ARCADE - Instigator wins
						//USER NEWS
						$recipient_message = ucwords($instigator)." was fair after you lost the race, losing you a total of $".$wager." cash and a car";
						//
						reporter($user,1,$recipient_message,"recipient");
						//				
						$sender_message = ucwords($user)." was fair after you won the race, you won a total of $".$wager." cash and a their car";
						reporter($instigator,1,$sender_message,"recipient");
						echo 103;
					 } elseif($instigator_t > $time2) {							
						 //PROFILE UPDATE
						 ////Challenge won
						 $que = sprintf("SELECT race_won FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($user));
						 $result = mysql_query($que);
						list($ch_won) = mysql_fetch_row($result);
						
						$ch_won = $ch_won + 1;
						
						$sql = sprintf("UPDATE h_users SET race_won = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_won),
							mysql_real_escape_string($user));
							mysql_query($sql);
						//Cash Deposit
						$d_cash = getStat('cash',$user_ID);
						$net_gain = $d_cash + $wager;
						$mk_deposit = setStat('cash',$user_ID,$net_gain);
						//Earn Cool
						$cool_points_earned = rand(1,$wager);
						$math = "add";
						$adjusted = $cool_points_earned;
						cooler($user_ID,$math,$adjusted);
						//Instigator Lost Cool
						
						//PROFILE UPDATE
						////Challenge loss
						$que = sprintf("SELECT race_lost FROM h_users WHERE user = ('%s')",
									mysql_real_escape_string($instigator));
						$result = mysql_query($que);
						list($ch_lost) = mysql_fetch_row($result);
						
						$ch_lost = $ch_lost + 1;
						
						$sql = sprintf("UPDATE h_users SET race_lost = ('%s') WHERE user = ('%s')",
							mysql_real_escape_string($ch_lost),
							mysql_real_escape_string($instigator));
							mysql_query($sql);
						
						$cool_points_loss = rand(1,$wager);
						$math = "subtract";
						cooler($i_userID,$math,$cool_points_loss);
						//BREAKING NEWS
						//ARCADE - defender win
						//USER NEWS
						$recipient_message = ucwords($instigator)." was fair after you won the race, earning you a total of $".$wager." cash and their car";
						//
						reporter($user,1,$recipient_message,"recipient");
						//				
						$sender_message = ucwords($user)." was fair after you lost the race, losing you a total of $".$wager." cash and a car";
						reporter($instigator,1,$sender_message,"recipient");
						echo 100;
					 } elseif ($instigator_t == $time2){
						 if($instigator_s > $avg2){
							 //ins wins
							 pinkrace($user,$instigator);
							 $pocket = getStat("cash",$i_userID);
							 $dep = $pocket + $wager;
							 setStat("cash",$i_userID,$dep);
							 
							 $pocket = getStat("cash",$user_ID);
							 $deb = $pocket - $wager;
							 setStat("cash",$user_ID,$deb);
						 } elseif($avg2 > $instigator_s) {
							 //def wins
							 pinkrace($instigator,$user);
							 $pocket = getStat("cash",$i_userID);
							 $deb = $pocket - $wager;
							 setStat("cash",$i_userID,$deb);
							 
							 $pocket = getStat("cash",$user_ID);
							 $dep = $pocket + $wager;
							 setStat("cash",$user_ID,$dep);
						 } else {
							 //stalemate
							 $recipient_message = "The race with".ucwords($instigator)."ended in a tie!";
							//
							reporter($user,1,$recipient_message,"recipient");
							//				
							$sender_message = "The race with ".ucwords($user)." ended in a tie!";
							reporter($instigator,1,$sender_message,"recipient");
						 }
						 echo 13;
					 }
				}
				}
			} else {
				$sql = sprintf("DELETE FROM h_tourney WHERE user = ('%s')",
							mysql_real_escape_string ($user));
						mysql_query($sql);
						
				$sql = sprintf("UPDATE h_users SET chopshop = '%s' WHERE user = ('%s')",
									mysql_real_escape_string(0),
									mysql_real_escape_string($user));
						mysql_query($sql);
				if($races == 6 || $races == 7){
						//
						pinkslip($userID);
				}
			}
			$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string($user));
			$result = mysql_query($query);
			list($chapter) = mysql_fetch_row($result);
			if($chapter == 5){
				$chapter = $chapter - 1;
				$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($chapter),
					mysql_real_escape_string($user));
				mysql_query($query);
			}
			echo 101;
		}
	}
} else {
	// Determine if user played in the arcade in the last 10 seconds
	$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') OR winner = ('%s')",
															 mysql_real_escape_string ($user),
															 $user);
	$result=mysql_query($sql);
	$test_arr = mysql_fetch_array($result);
	
	//
	if(!is_array($test_arr)){
				 $activity = 99;// 2 no records
				 echo $activity;
	} else {
		//which one was it
		//Bank VAult Success
		$sql = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s') AND type = ('%s') AND bank = ('%s')",
															 mysql_real_escape_string ($user),
															 2,
															 1);
		$result=mysql_query($sql);
		$vault_open = mysql_fetch_array($result);
		//Bank Security Success
		$sql = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s') AND bank = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$bank_mem_warr = mysql_fetch_array($result);
		//Bank Vault Fail
		$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') AND type = ('%s') AND bank = ('%s')",
															 mysql_real_escape_string ($user),
															 5,
															 1);
		$result=mysql_query($sql);
		$vault_fail = mysql_fetch_array($result);
		//Bank Fail
		$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s') AND bank = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$bank_mem_larr = mysql_fetch_array($result);
		//security fail
		$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s') AND bank = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 3);
		$result=mysql_query($sql);
		$bank_mem_slarr = mysql_fetch_array($result);
		//Bank
		$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s') AND bank = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 2);
		$result=mysql_query($sql);
		$bank_boss_larr = mysql_fetch_array($result);
		//security fail
		$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s') AND bank = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 4);
		$result=mysql_query($sql);
		$bank_boss_slarr = mysql_fetch_array($result);
		//Business
		$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s') AND business = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$biz_arr = mysql_fetch_array($result);
		//Casino
		$sql = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s') AND casino = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$wcas_arr = mysql_fetch_array($result);
		
		//
		$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s') AND casino = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$lcas_arr = mysql_fetch_array($result);
	
		//which one was it
		//Challenge
		$sql = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s') AND fight = ('%s')",
															mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$wfig_arr = mysql_fetch_array($result);
		
		//
		$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s') AND fight = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$lfig_arr = mysql_fetch_array($result);
		
		//which one was it
		//Crime
		$sql = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s') AND crime = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$wcry_arr = mysql_fetch_array($result);
		
		//
		$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s') AND crime = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$lcry_arr = mysql_fetch_array($result);
	
		//which one was it
		//pursuit
		$sql = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s') AND police = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$wpo_arr = mysql_fetch_array($result);
		
		//
		$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s') AND police = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$lpo_arr = mysql_fetch_array($result);
		
		//which one was it
		//pursuit
		$sql = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s') AND arcade = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$warr = mysql_fetch_array($result);
		
		//
		$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s') AND arcade = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
		$result=mysql_query($sql);
		$larr = mysql_fetch_array($result);
		//waiting
		$sql = sprintf("SELECT * FROM arcade_news WHERE loser = ('%s') AND wait = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
		$result=mysql_query($sql);
		$waiting = mysql_fetch_array($result);
		//evenly matched
		$sql = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s') AND wait = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
		$result=mysql_query($sql);
		$evenly = mysql_fetch_array($result);
		//security team stopped you
		$sql = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s') AND wait = ('%s')",
															 mysql_real_escape_string ($user),
															 4);
		$result=mysql_query($sql);
		$secure = mysql_fetch_array($result);
		//broke target
		$sql = sprintf("SELECT * FROM arcade_news WHERE winner = ('%s') AND wait = ('%s')",
															 mysql_real_escape_string ($user),
															 3);
		$result=mysql_query($sql);
		$broke = mysql_fetch_array($result);
		//
		//Are they a winner?
		if(is_array($wcas_arr)){
			echo 1;
			$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
			$result=mysql_query($sql);
					
		} elseif(is_array($lcas_arr)){
				echo 2;
				$sql = sprintf("DELETE FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				$result=mysql_query($sql);
		} elseif(is_array($wfig_arr)){
			echo 3;
			$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
			$result=mysql_query($sql);
					
		} elseif(is_array($lfig_arr)){
				echo 4;
				$sql = sprintf("DELETE FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				$result=mysql_query($sql);
		} elseif(is_array($wcry_arr)){
			echo 5;
			$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
			$result=mysql_query($sql);
					
		} elseif(is_array($lcry_arr)){
				echo 6;
				$sql = sprintf("DELETE FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				$result=mysql_query($sql);
		} elseif(is_array($wpo_arr)){
			echo 7;
			$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
			$result=mysql_query($sql);
					
		} elseif(is_array($lpo_arr)){
				echo 8;
				$sql = sprintf("DELETE FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				$result=mysql_query($sql);
		} elseif(is_array($warr)){
			$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string($user));
			$result = mysql_query($query);
			list($chapter) = mysql_fetch_row($result);
			if($chapter == 3){
				$chapter = $chapter + 1;
				$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($chapter),
					mysql_real_escape_string($user));
				mysql_query($query);
			}
				echo 9;
					
		} elseif(is_array($larr)){
			$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string($user));
			$result = mysql_query($query);
			list($chapter) = mysql_fetch_row($result);
			if($chapter == 3){
				$chapter = $chapter - 1;
				$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($chapter),
					mysql_real_escape_string($user));
				mysql_query($query);
			}
				echo 10;
				$sql = sprintf("DELETE FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				$result=mysql_query($sql);
		} elseif(is_array($biz_arr)){
			$query = sprintf("SELECT tutorial_chapter FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
			$result = mysql_query($query);
			list($chapter) = mysql_fetch_row($result);
			if($chapter == 8){
				$chapter = $chapter + 1;
				$query = sprintf("UPDATE h_users SET tutorial_chapter = '%s' WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($chapter),
					mysql_real_escape_string($user));
				mysql_query($query);
			}
				echo 11;
				$sql = sprintf("DELETE FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				mysql_query($sql);
		} elseif(is_array($waiting)){
				echo 12;
				$sql = sprintf("DELETE FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				mysql_query($sql);
		} elseif(is_array($evenly)){
				echo 13;
				$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				mysql_query($sql);
		} elseif(is_array($broke)){
				echo 14;
				$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				mysql_query($sql);
		} elseif(is_array($secure)){
				echo 15;
				$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				mysql_query($sql);
		} elseif(is_array($bank_mem_larr)){
				echo 16;
				$sql = sprintf("DELETE FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				mysql_query($sql);
		} elseif(is_array($bank_boss_larr)){
				echo 17;
				$sql = sprintf("DELETE FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				mysql_query($sql);
		} elseif(is_array($bank_mem_slarr)){
				echo 18;
				$sql = sprintf("DELETE FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				mysql_query($sql);
		} elseif(is_array($bank_boss_slarr)){
				echo 19;
				$sql = sprintf("DELETE FROM arcade_news WHERE loser = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				mysql_query($sql);
		} elseif(is_array($bank_mem_warr)){
				echo 20;
				$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s')",
															 mysql_real_escape_string ($user),
															 1);
				mysql_query($sql);
		} elseif(is_array($vault_fail)){
				echo 21;
				$sql = sprintf("DELETE FROM arcade_news WHERE loser = ('%s') AND type = ('%s')",
															 mysql_real_escape_string ($user),
															 5);
				mysql_query($sql);
		} elseif(is_array($vault_open)){
				echo 22;
				$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s') AND type = ('%s')",
															 mysql_real_escape_string ($user),
															 2);
				mysql_query($sql);
		} else {
			$activity = 99;// 2 no records
			echo $activity;
		}
	}
}
?>