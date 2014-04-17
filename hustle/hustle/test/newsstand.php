<?php
include('stats.php');

include('connect.php');
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//$user = $_POST['name'];
$user = "jermongreen";

//COOL POINT ADJUSTER
function coolpoint_adjuster($userID,$math,$adjusted){
	$current_cool = getStat('exp',$userID);
	if($math == "add"){
		$cool = $current_cool + $adjusted;
		$complete = setStat('exp',$userID,$cool);
	} else {
		//check adjusted cool against assets make sure not lower than assets allow
		$wealth_barrier = assets_valuation($userID);
		$variable_c = $current_cool - $wealth_barrier;
		if($variable_c < 0){
			return;
		}
		// Deduct
		$cool = $current_cool - $variable_c;
		$complete = setStat('exp',$userID,$cool);
	}
	return;
}

//Who just made me or lost me some money?
function earnings_report($user){
	$query = sprintf("SELECT * FROM h_user_news WHERE member = ('%s')",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	
	while($news_ar = mysql_fetch_assoc($result)){
		$member = $news_ar["cleader"];
		$costu = $new_ar["ouch"];
		$madeu = $news_ar["take"];
		$imagequery = sprintf("SELECT image FROM h_users WHERE user = '%s'",
					  mysql_escape_string($member));
			$user_image = mysql_query($imagequery);
			$image_ar = mysql_fetch_assoc($user_image);
			$image = $image_ar['image'];
			//echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'>";
		echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image' />".$member." just made you $".$madeu."<div id='santa'>Give a gift</div>";
		if(!empty($costu)){
			echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image' />".$member." just cost you $".$costu."<div id='scrooge'>Punish them!</div>";
		}
	}
}

//Any Hits on me?
function eyes($user){
	$query = sprintf("SELECT * FROM h_hitlist WHERE target = ('%s') ORDER BY time ASC",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	$hit_ar = mysql_fetch_assoc($result);
	if(is_array($hit_ar)){
		while($hit_ar = mysql_fetch_assoc($result)){			
			$culprit = $hit_ar["user_id"];
			$bounty = $hit_ar["bounty"];
			echo "<img src='../graphics/hit_icon.png' /> ".$culprit." just put out a $".$bounty."bounty on you!";
			
		}
	} else {
		
		$hit = "You're in the clear";
	}
}

//Any Successful Robberies against me
function blackmarket($user){
	$query = sprintf("SELECT * FROM h_heists WHERE target = ('%s') ORDER BY time ASC",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	$heist_ar = mysql_fetch_assoc($result);
	
	if(is_array($heist_ar)){
		while($heist_ar = mysql_fetch_assoc($result)){
			$take = $heist_ar["take"];
			$success = $heist_ar["success"];
			$pp = $heist_ar["public"];
			$culprit = $heist_ar["culprit"];
			$imagequery = sprintf("SELECT image FROM h_users WHERE user = '%s'",
					  mysql_escape_string($culprit));
			$user_image = mysql_query($imagequery);
			$image_ar = mysql_fetch_assoc($user_image);
			$image = $image_ar['image'];
			if($success = 1){
				//successful robbery against you
				if($pp = 0){
					//private hit
					$heist =  "<img src='../graphics/robbed_icon.png' /> You were just anonymously robbed and they got away with $".$take;
				} else {
					//public hit					
					//echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'>";
					$heist =  "<img src='../graphics/robbed_icon.png' /> You were just robbed by"."<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image' />".$culprit." they got away with $".$take."<div id='revenge'>Get revenge!</div>";
				}
			} else {
				//failed robbery attempts
				if($pp = 0){
					//private hit
					$heist =  "<img src='../graphics/robbed_icon.png' /> There was a failed robbery attempt made against you";
				} else {
					//public hit		
					//echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'>";
					$heist =  "<img src='../graphics/robbed_icon.png'>"."<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image' />".$culprit." just tried to rob you but failed"."<div id='revenge'>Get revenge!</div>";
				}
			}
		}
	}
	//Was I successful at any robberies?
	//
	$query = sprintf("SELECT * FROM h_heists WHERE culprit = ('%s') ORDER BY time ASC",
			mysql_real_escape_string($user));
	$result = mysql_query($query);
	$heist_ar = mysql_fetch_assoc($result);
	
	if(is_array($heist_ar)){
		while($heist_ar = mysql_fetch_assoc($result)){
			$target = $heist_ar["target"];
			$take = $heist_ar["take"];
			$coole = $heist_ar["cool_earned"];
			$cool_l = $heist_ar["cool_lost"];
			$success = $heist_ar["success"];
			$pp = $heist_ar["public"];
			
			$imagequery = sprintf("SELECT image FROM h_users WHERE user = '%s'",
					  mysql_escape_string($target));
			$user_image = mysql_query($imagequery);
			$image_ar = mysql_fetch_assoc($user_image);
			$image = $image_ar['image'];
			if($success = 1){
				//successful robbery
				if($pp = 0){
					//private hit
					$heist =  "<img src='../graphics/robbed_icon.png' /> You just anonymously robbed ".$target." and you got away with $".$take."earning ".$coole."<img src='../file/pic/fbimages/shades_2.png' /> Cool Points for silent style!";
				} else {
					//public hit		
					//echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'>";
					$heist =  "<img src='../graphics/robbed_icon.png' /> You just robbed "."<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image' />".$target." and got away with $".$take." and only lost ".$cool_l."<img src='../file/pic/fbimages/shades_2.png' /> Cool Points...";
				}
			} else {
				//failed robbery attempts
				if($pp = 0){
					//private hit
					$heist =  "<img src='../graphics/robbed_icon.png' />You failed to anonymously rob ".$target." costing you ".$cool_l."<img src='../file/pic/fbimages/shades_2.png' />Cool Points!";
				} else {
					//public hit
					//echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'>";
					$heist =  "<img src='../graphics/robbed_icon.png' /> You just failed your attempt to rob "."<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image' />".$target." and it cost you ".$cool_l."<img src='../file/pic/fbimages/shades_2.png' />Cool Points!";
				}
			}
		}
	}	
}
//Any Challenges I need to complete?
$query = sprintf("SELECT * FROM arcade_challenges WHERE UPPER(user2) = UPPER('%s')",
			mysql_real_escape_string ($user));
$result = mysql_query($query);
$fight_ar = mysql_fetch_assoc($result);

if(is_array($fight_ar)){
	while($fight_ar = mysql_fetch_assoc($result)){
		$gid = $fight_ar['gameid'];
		$sql = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
																   $gid);
		$result = mysql_query($sql);
		$result_ar = mysql_fetch_assoc($result);
		$image = $result_ar['stdimage'];
		$name = $result_ar['shortname'];
		$file = $result_ar['file'];
		$width = $result_ar['width']; 
		$height = $result_ar['height'];
		$challenger = $fight_ar['user1'];
		$wager = $fight_ar['wager'];
		$imagequery = sprintf("SELECT image FROM h_users WHERE user = '%s'",
					  mysql_escape_string($challenger));
			$user_image = mysql_query($imagequery);
			$image_ar = mysql_fetch_assoc($user_image);
			$image = $image_ar['image'];
		//echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'>";
		echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'>".$challenger." just put up $".$wager." saying they can score higher than you in a game of <img src='http://www.12daysoffun.com/hustle/arcade/images/$image' />".$name."<a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\">Win the cash</a>";  
	}
}	
//Is Your crew shrinking? <----HOLD OFF

//Any crew Offers?
function accept($user,$offer,$crew,$leader){
	//deposit cash
	$query = sprintf("SELECT * FROM h_users WHERE user = ('%s')",
			mysql_real_escape_string ($user));
	$result = mysql_query($query);
	list($userID) = mysql_fetch_row($result);
	
	$i_cash = getStat('cash',$userID);
	$net_take = $i_cash + $offer;
	$mk_deposit = setStat('cash',$userID,$net_take);
	
	//add to roster
	$query = sprintf("INSERT INTO h_crew_member(user,crew_id) VALUES ('%s','%s');",
		mysql_real_escape_string($user),
		$crew);
	mysql_query($query);
	
	//Add cool points to offerer
	$query = sprintf("SELECT * FROM h_users WHERE user = ('%s')",
			mysql_real_escape_string ($leader));
	$result = mysql_query($query);
	list($leaderID) = mysql_fetch_row($result);
	
	$new_cool = rand(1,$offer);
	$math = "add";
	$finished = coolpoint_adjuster($leaderID,$math,$new_cool);
	//notify offerer of news
	$time = time();
	$query = sprintf("INSERT INTO h_user_news(time,new_member,cleader) VALUES ('%s','%s');",
		mysql_real_escape_string($time),
		mysql_real_escape_string($user),
		mysql_real_escape_string($leader));
	mysql_query($query);
	return;
}
function decline($user,$crew){
	//delete offer
	$query = sprintf("DELETE FROM h_crew_recruit WHERE invitee = ('%s') AND crew_id('%s')",
		mysql_real_escape_string($user),
		$crew);
	mysql_query($query);

	return;
}

$query = sprintf("SELECT * FROM h_crew_recruit WHERE invitee = ('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
$offer_ar = mysql_fetch_assoc($result);
//
if(is_array($offer_ar)){
	while($offer_ar = mysql_fetch_assoc($result)){
		$crew = $offer_ar["crew_id"];
		$offer = $offer_ar["cash_offer"];
		$query = sprintf("SELECT * FROM h_crew_main WHERE id = ('%s')",
			mysql_real_escape_string ($crew));
		  $result = mysql_query($query);
		  //
		  $war_ar = mysql_fetch_assoc($result);
		  $flag = $war_ar['mem_image'];
		  $leader = $war_ar['user'];
		  $title = $war_ar['title'];
		  echo "<img src='http://www.12daysoffun.com/hustle/file/pic/crew/$flag'".$title." just offered you $".$offer." to join their crew <div class='accept'>ACCEPT</div>|<div class='decline'>DECLINE</div>";
	}
}
//Any New Gifts?
function keepit($user,$cleader,$gift){
	// decide what the gift is
	// update user stats of new weapon, cash, asset, or muscle
	
	//update achievements record of cleader
	
	//give cleader cool points
	return;
}
function reject_it($user,$cleader){
	//delete gift offer
	
	return;
}

$query = sprintf("SELECT * FROM h_crew_gift WHERE recipient = ('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
$gift_ar = mysql_fetch_assoc($result);
// Any thing for me?
if(is_array($gift_ar)){
	while($offer_ar = mysql_fetch_assoc($result)){
		$crew = $offer_ar["crew_id"];
		$gift_id = $offer_ar["gift"];
		$query = sprintf("SELECT * FROM h_crew_main WHERE id = ('%s')",
			mysql_real_escape_string ($crew));
		  $result = mysql_query($query);
		  //
		  $war_ar = mysql_fetch_assoc($result);
		  $flag = $war_ar['mem_image'];
		  $leader = $war_ar['user'];
		  $title = $war_ar['title'];
		  echo "<img src='http://www.12daysoffun.com/hustle/file/pic/crew/$flag'".$title." just offered you $".$gift."<div class='accept'>ACCEPT</div>|<div class='decline'>DECLINE</div>";
	}
}

//Any score news?
$query = sprintf("SELECT * FROM h_user_news WHERE winner = ('%s') OR loser = ('%s')",
		mysql_real_escape_string($user),
		mysql_real_escape_string($user));
$result = mysql_query($query);
$news_ar = mysql_fetch_assoc($result);
//
if(is_array($news_ar)){
	$activity = "You have to play a game first!";// 2 no records
	//winning news? unfair
	$query = sprintf("SELECT * FROM h_user_news WHERE winner = ('%s') AND type = 'news'",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	$news_ar = mysql_fetch_assoc($result);
	while($news_ar = mysql_fetch_assoc($result)){
		echo "You just defeated ".$user." at a game of".$gamename." playing".$fair.", Earning you $".$take." for your crew and $".$wages." for yourself and a ".$gain." of ".$coolp."Cool Points!";
	}
	//defeated news unfair
	$query = sprintf("SELECT * FROM h_user_news WHERE loser = ('%s') AND type = 'news'",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	$news_ar = mysql_fetch_assoc($result);
	while($news_ar = mysql_fetch_assoc($result)){
		echo "You were just defeated by".$instigator." at a game of".$gamename." you played".$fair.", and they ".$did." You lost $".$take." for your crew and personally lost $".$wages." and a ".$gain." of ".$coolp."Cool Points...";
	}
	//challenge win fair
	$query = sprintf("SELECT * FROM h_user_news WHERE winner = ('%s') AND type = 'gen'",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	$news_ar = mysql_fetch_assoc($result);
	while($news_ar = mysql_fetch_assoc($result)){
		echo "You just defeated ".$user." at a game of".$gamename." playing".$fair.", Earning you $".$take." for your crew and $".$wages." for yourself and a ".$gain." of ".$coolp."Cool Points!";
	}
	//new high score
	$query = sprintf("SELECT * FROM h_user_news WHERE winner = ('%s') AND type = 'news'",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	$news_ar = mysql_fetch_assoc($result);
	while($news_ar = mysql_fetch_assoc($result)){
		echo "You played ".$gname." and scored ".$score." ".$err." and received a bonus of".$upgrade."plus $".$payout." but after your crew you have $".$left;
	}
}
?>