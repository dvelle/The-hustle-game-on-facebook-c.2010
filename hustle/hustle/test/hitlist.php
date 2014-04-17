<?php
//$userID = $_GET['user'];
$userID = "jermongreen";
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

include 'stats.php';

include 'leveler.php';

$user = $_POST['instigator'];

$target = $_POST['target'];

$shortname = $_POST['game'];

$wager = $_POST['wager'];

$style = $_POST['radio'];
if (!isset($_POST['submit'])) { // if page is not submitted to itself echo the form
?>
<html>
<head>
<style type="text/css">
<!--
img {
	border: none;
}
#inner_page {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(../graphics/hustle_bk_bottom.png);
	height: 404px;
}
#inner_page #fighthud table tr td #mark_header #subhead {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 23px;
	padding-left: 8px;
}

-->
#inner_page #fighthud #fight_form table tr td #bet {
	width: 175px;
	background-image: url(../graphics/store_bk_bot.png);
}
#inner_page #fighthud #fight_form table tr td #fightrules {
	font-size: 12px;
	font-weight: bold;
}
#inner_page #fighthud table tr td #mark_header #sublevel {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 8px;
	padding-left: 50px;
}
#inner_page #fighthud table tr td #mark_header #subrank {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 33px;
	padding-left: 62px;
}
#inner_page #fighthud #fight_form table tr td #mark_body table tr #variable_row {
	width: 138px;
	font-size: 12px;
}
#inner_page #fighthud #fight_form table tr td #mark_body table tr #vrow2 {
	font-size: 12px;
	width: 53px;
}
#inner_page #fighthud #fight_form table tr td #mark_body table tr #vrow1 {
	width: 120px;
	font-size: 12px;
}
#inner_page #fighthud #fight_form table tr td #mark_body {
	overflow: scroll;
	height: 300px;
	width: 353px;
	background-image: url(../graphics/store_bk_bot.png);
	color: #FFF;
}
#inner_page #fighthud #fight_form table tr #gamesec2 #field {
	height: 300px;
	background-image: url(../graphics/store_bk_bot.png);
	overflow: scroll;
	margin-right: 8px;
	margin-left: 8px;
	width: 155px;
}
#inner_page #fighthud #fight_form table tr td .ftheader {
	font-size: 15px;
	color: #000;
	font-weight: bolder;
}
-->
</style>
</head>

<body>
<div id="inner_page">
        <div id="fighthud">        
      <form id="fight_form" name="fight_form" method="post"  action="fight.php">
      <table width="636" border="0" cellpadding="0" align="center">
  <tr>
    <td width="353" id="marksec"><span class="ftheader"><b style="color:#FFF;">Take out a crew leader and earn some cash</b></span>
      <div id="mark_header"><span id="subhead">User</span><span id="sublevel"> Level</span><span id="subrank"> Bounty</span></div></td>
    <td width="219" align="center"><span class="ftheader"><b>OR: Add a name to the list</b></span></td>
    </tr>
  <tr>
    <td><div id="mark_body">
      <table>
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
			mysql_real_escape_string ($userID));
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
		//
		$username = $person;
			?>
        <tr>
          <td width="119" id="vrow1"><?php $imagequery = sprintf("SELECT image FROM h_users WHERE user = '%s'",
							  mysql_escape_string($username));
		  $user_image = mysql_query($imagequery);
		  $image_ar = mysql_fetch_assoc($user_image);
		  $image = $image_ar['image'];
		  echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'";
		  echo ucwords($username);?></td>
         
          <td width="136" id="variable_row"><?php $cool = getStat('exp',$userID); 
				list($stage,$l_label) = leveler($cool); 
				echo "Level-"; echo $stage; echo " "; echo $l_label; ?></td>
          <td width="53" id="vrow2"><?php
				//
				$query = sprintf("SELECT rank FROM h_top_players WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($username));
				$result = mysql_query($query);
				list($rank) = mysql_fetch_row($result);
				$english_format_number = number_format($rank);
				echo $english_format_number;						
				?></td>
          <td width="25"><input name="target" id="bullseye" type="button" value="Heist"/></td>
          </tr>
        <?php
			}
		}
			?>
        </table>
    </div></td>
    <td align="center"><div id="bet">
      <p>Add a name to the list
        <input name="hitee" id="hitee" type="text" size="20" maxlength="8" />
      </p>
      <p>Bounty
        <input name="bounty" type="text" id="bounty" value="$" size="20" maxlength="8" />
      </p>
      <p>
        <input type="hidden" id="userid" name="instigator" value="<? echo $userID?>"/>
        <input name="submit" type="submit" class="button" value="SUBMIT" />
      </p>
    </div>
      <div id="fightrules">Each Hit Request Costs x5 <img src="http://12daysoffun.com/hustle/file/pic/fbimages/buy_energy_75x75_01.gif" alt="" width="17" height="21" />Energy<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="What's This?" name="sprytrigger1" width="15" height="15" id="sprytrigger1" /><br />
        COST -15,000 <img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/shades_2.png" alt="" width="17" height="16" />Cool Points</div></td>
    </tr>
      </table>
      </form>
<?
} else {
	//get user stats
	$query = sprintf("SELECT * FROM h_users WHERE user = ('%s')",
			mysql_real_escape_string ($user));
	$result = mysql_query($query);
	$user_ar = mysql_fetch_assoc($result);
	$user_ID = $user_ar["id"];

	$cash = getStat('cash',$user_ID);
	$energy = getStat('ep',$user_ID);
	
	//check cash against wager
	if($cash < $wager){
		$wager = $cash;
		$debit = 0;
		setStat('cash',$user_ID,$debit);
	} else {
		$debit = $cash - $wager;
		//debit acount		
		setStat('cash',$user_ID,$debit);
	}
	//Game ID
	$query = sprintf("SELECT * FROM arcade_games WHERE shortname = ('%s') OR title = ('%s')",
			mysql_real_escape_string ($shortname),
			mysql_real_escape_string ($shortname));
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$gameid = $row['gameid'];
	
	//deduct energy
	$toll = $energy - 3;	
	if($toll < 0){
		$query = sprintf("INSERT INTO h_user_news(alert,time,winner,loser,wager,gameid) VALUES ('%s','%s','%s','%s','%s','%s');",
					1,
					mysql_real_escape_string($time),
					mysql_real_escape_string($user),
					mysql_real_escape_string($target),
					mysql_real_escape_string($wager),
					mysql_real_escape_string($gameid));
				mysql_query($query);
		header('Location: http://www.google.com');
	} else {
		setStat('ep',$user_ID,$toll);
	}
	
	//insert challenge into database	
	$time = time();
	$query = sprintf("INSERT INTO arcade_challenges(time,user1,user2,action1,wager,gameid,done) VALUES ('%s','%s','%s','%s','%s','%s','%s');",
					mysql_real_escape_string($time),
					mysql_real_escape_string($user),
					mysql_real_escape_string($target),
					mysql_real_escape_string($style),
					mysql_real_escape_string($wager),
					mysql_real_escape_string($gameid),					
					0);
				mysql_query($query);
				
	//send message to challengee
	$query = sprintf("INSERT INTO h_user_news(type,time,winner,loser,wager,gameid) VALUES ('%s','%s','%s','%s','%s','%s');",
					mysql_real_escape_string("news"),
					mysql_real_escape_string($time),
					mysql_real_escape_string($user),
					mysql_real_escape_string($target),
					mysql_real_escape_string($wager),
					mysql_real_escape_string($gameid));
				mysql_query($query);
	
	//go play game
	$sql = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
				   $gameid);
	$result = mysql_query($sql);
	$result_ar = mysql_fetch_array($result);
	$file = $result_ar['file'];
	$width = $result_ar['width']; 
	$height = $result_ar['height'];
	?>
	<script type="text/javascript">
	ajaxpage('../arcade/gamescreen.php?game=<? echo $file?>&amp;width=<? echo $width?>&amp;height=<? echo $height?>', 'content') //load "test.htm" into "rightcolumn" DIV
	</script>
<?
}

?>
  </div>
</div>
</body>
</html>
