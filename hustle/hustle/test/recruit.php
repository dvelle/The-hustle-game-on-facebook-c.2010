<?php
$userID = "nacobilewis";
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

include 'stats.php';

include 'leveler.php';

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<shortname>
<style type="text/css">
<!--
img {
	border: none;
}
#rooks {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(../graphics/hustle_bk_bottom.png);
	height: 404px;
}
#rooks #recruiter table tr td #mark_header #subhead {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 33px;
	padding-left: 8px;
}

-->
#rooks #recruiter #fight_form table tr #marksec #mark_header .subhead1 {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 33px;
	padding-left: 8px;
}
#rooks #recruiter #fight_form table tr #marksec .recruitheader {
	font-size: 16px;
	font-weight: bolder;
	color: #FFF;
}
#rooks #recruiter #fight_form table tr td #bet {
	width: 175px;
	background-image: url(../graphics/store_bk_bot.png);
	margin-right: auto;
	margin-left: auto;
}
#rooks #recruiter #fight_form table tr td #fightrules {
	font-size: 12px;
	font-weight: bold;
}
#rooks #recruiter table tr td #mark_header #sublevel {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 8px;
	padding-left: 50px;
}
#rooks #recruiter table tr td #mark_header #subrank {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 8px;
	padding-left: 85px;
}
#rooks #recruiter #fight_form table tr td #mark_body table tr #variable_row {
	width: 138px;
	font-size: 12px;
}
#rooks #recruiter #fight_form table tr td #mark_body table tr #vrow2 {
	font-size: 12px;
	width: 53px;
}
#rooks #recruiter #fight_form table tr td #mark_body table tr #vrow1 {
	width: 120px;
	font-size: 12px;
}
#rooks #recruiter #fight_form table tr td #mark_body {
	overflow: scroll;
	height: 300px;
	width: 353px;
	background-image: url(../graphics/store_bk_bot.png);
	color: #FFF;
}
#rooks #recruiter #fight_form table tr #gamesec2 #field {
	height: 300px;
	background-image: url(../graphics/store_bk_bot.png);
	overflow: scroll;
	margin-right: 8px;
	margin-left: 8px;
	width: 155px;
}
#rooks #recruiter #fight_form table tr td .ftheader {
	font-size: 15px;
	color: #000;
	font-weight: bolder;
}
-->
</style>
</head>

<body>
<div id="rooks">
        <div id="recruiter">        
      <form id="fight_form" name="fight_form" method="post" action="">
      <table width="738" border="0" cellpadding="0" align="center">
  <tr>
    <td width="434" id="marksec"><span class="recruitheader"><b>STEP 1: Scout out some talent</b></span>
      <div id="mark_header"><span class="subhead1">User</span><span id="sublevel">Level</span><span id="subrank">Game Rank</span></div></td>
    <td width="12" align="center" id="gamesec">&nbsp;</td>
    <td width="284" align="center"><span class="ftheader"><b>STEP 2: Enter Your Offer</b></span></td>
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
			?>
        <tr>
          <td id="vrow1"><?php 
		  $username = $person;
		  $imagequery = sprintf("SELECT image FROM h_users WHERE user = '%s'",
							  mysql_escape_string($username));
		  $user_image = mysql_query($imagequery);
		  $image_ar = mysql_fetch_assoc($user_image);
		  $image = $image_ar['image'];
		  echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'";
		  echo $result_ar['user'];?>
          </td>
          <td id="variable_row"><?php $cool = getStat('exp',$userID); 
				list($stage,$l_label) = leveler($cool); 
				echo "Level-"; echo $stage; echo " "; echo $l_label; ?></td>
          <td id="vrow2"><?php
				//
				$query = sprintf("SELECT rank FROM h_top_players WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($username));
				$result = mysql_query($query);
				list($rank) = mysql_fetch_row($result);
				$english_format_number = number_format($rank);
				echo $english_format_number;						
				?></td>
          <td><input name="targetplay" type="checkbox" value="<?php 
				echo $username?>" /></td>
        </tr>
        <?php
			}
		}
			?>
      </table>
    </div></td>
    <td align="center" id="gamesec2">&nbsp;</td>
    <td align="center"><div id="bet">
      <p>
        $
        <input name="fightwager" type="text" size="10" maxlength="8" />
        </p>
      <p>
        <input name="Earn The Cash" type="button" value="OFFER" />
      </p>
    </div>
      <div id="fightrules">        Each  Offer acceptance earns <img src="../graphics/fbimages/shades_2.png" width="17" height="16" />Cool Points<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="What's This?" name="sprytrigger1" width="15" height="15" id="sprytrigger1" /></div></td>
  </tr>
      </table>
      </form>

  </div>
</div>
</body>
</html>
