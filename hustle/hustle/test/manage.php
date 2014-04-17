<?php
$userID = $_GET['user'];
require_once 'connect.php';		// our database settings
include 'stats.php';
include 'leveler.php';
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
img {
	border: none;
}
#manager {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/shorter_bk_bottom.png);
	height: 712px;
	background-repeat: no-repeat;
}
#manager #manage_pg table tr td table tr td table tr td #manage_header {
	color: #FFF;
	font-size: 16px;
	width: 170px;
	font-weight: bold;
}
#manager #manage_pg table tr td table tr td table tr td #manage_header2 {
	font-size: 16px;
	font-weight: bold;
	color: #FFF;
}
#manager #manage_pg table tr td table tr td table tr td .minner_text {
	font-size: 14px;
	color: #FFF;
	width: 206px;
}
#manager #manage_pg table tr td table tr td table tr td .minner_text3 {
	font-size: 14px;
	color: #FFF;
}
#manager #manage_pg table tr td table tr td table tr td #yrank_stat {
	font-size: 13px;
	color: #CCC;
	font-weight: bold;
}
#manager #manage_pg table tr td table tr td table tr td #yorank_stat {
	font-size: 13px;
	color: #999;
	font-weight: bold;
}
#manager #manage_pg table tr td table tr td table tr td #fire_shake {
	height: 167px;
	overflow: scroll;
}
#manager #manage_pg table tr td table tr td table tr td form #quitter {
	overflow: scroll;
	height: 146px;
}
#manager #manage_pg table tr td table tr td table tr td #manage_header3 {
}
#manager #manage_pg table tr td table tr td table tr td form #coffers {
	height: 160px;
	overflow: scroll;
}
#manager #manage_pg table tr td table tr td table tr td form #new_offers {
	margin-bottom: 23px;
}

-->
</style>
</head>

<body>
<div id="manager">
  <div id="manage_pg"><table width="730" border="0" cellpadding="0" align="center">
  <tr>
    <td width="520"><table width="512" height="437" border="0" cellpadding="0">
      <tr>
        <td width="528" height="198" valign="top"><table width="512" height="177" border="0" cellpadding="0" background="../file/graphics/store_bk_bot.png">
          <tr></tr>
          <tr>
            <td height="25"><div id="manage_header">Manage Your Crew<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="What's This?" name="sprytrigger1" width="15" height="15" id="sprytrigger1" /></div></td>
          </tr>
          <tr>
            <td height="146" valign="top"><form action="" method="post" enctype="multipart/form-data" name="crew_form"><div id="fire_shake"><table>
        <?php
		//
		$query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($userID));
		$result = mysql_query($query);
		list($crewID) = mysql_fetch_row($result);		
		//
		$crwquery = sprintf("SELECT * FROM h_crew_member WHERE crew_id = '%s'",
							mysql_escape_string($crewID));
		$result2 = mysql_query($crwquery);
		//
		$toppquery = "SELECT * FROM h_top_players";
		$topuser = mysql_query($toppquery);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result2)){
			?>
        <tr>
        <td><?php $query = sprintf("SELECT * FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($result_ar['user']));		
		$cresult = mysql_query($query);
		$mem_ar = mysql_fetch_assoc($cresult);
		$image = $mem_ar['image']; 
		echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image' /><br />";
		echo $mem_ar['user'];
		echo "<br />";
		$user_id = $mem_ar['id'];
		?></td>
          <td></td>
          <td><?php $cool = getStat('exp',$user_id); 
				list($stage,$l_label) = leveler($cool); 
				echo "Level-"; echo $stage; echo " "; echo $l_label; echo " ";?></td>
                <td><?php echo "Has Earned You $"; echo $result_ar['crew_earnings']; echo "<br />"; 
				echo "Has Cost You $";echo $result_ar['crew_losses']
				?></td>
          <td></td>
          <td>&nbsp;</td>
          <td></td>
          <td><?php echo "Fire"; ?><input name="targetplay" type="checkbox" value="<?php 
				echo $result_ar['user_fire']?>" /><?php echo "<br />"?>
				<?php echo "Shakedown"; ?><input name="targetplay" type="checkbox" value="<?php 
				echo $result_ar['user_shake']?>" /></td>
          <td><input name="Execute" type="button" value="Execute" /></td>
        </tr>
        <?php
			$i+=1;
			}
			?>
      </table></div></form></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="233"><table width="512" height="138" border="0" cellpadding="0" background="../file/graphics/store_bk_bot.png">
          <tr>
            <td height="20"><div id="manage_header3">New Crew Offers<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="What's This?" name="sprytrigger1" width="15" height="15" id="sprytrigger3" /></div></td>
            </tr>
          <tr>
            <td valign="top"><form action="" method="post" enctype="multipart/form-data" name="casfoffer_form">
              <div id="coffers">
                <table>
                  <?php
		//
		$query = sprintf("SELECT COUNT(invitee) FROM h_crew_recruit WHERE UPPER(invitee) = UPPER('%s')",
			mysql_real_escape_string ($userID));
		$result = mysql_query($query);
		list($offers) = mysql_fetch_row($result);
		if (empty($offers)){ 
		echo "You have no offers at this time.";
		} else {
			//
		$query = sprintf("SELECT * FROM h_crew_recruit WHERE UPPER(invitee) = UPPER('%s')",
			mysql_real_escape_string ($userID));
		$result = mysql_query($query);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			?>
                  <tr>
                    <td><?php $crew = $result_ar['crew_id'];
		$query = sprintf("SELECT * FROM h_crew_main WHERE id = ('%s')",
			mysql_real_escape_string ($crew));
		$resu = mysql_query($query);
		$crew_ar = mysql_fetch_assoc($resu);
		$crewtitle = $crew_ar['title'];
		$flag = $crew_ar['mem_image'];
		echo "<img src='http://www.12daysoffun.com/hustle/file/pic/crew/$flag' />"; echo "<br/>";
		echo $crewtitle;?></td>
                    <td></td>
                    <td><?php echo "Has Offered You $". $result_ar['cash_offer']." to join their crew<br />";
				?></td>
                    <td></td>
                    <td><?php echo "They are Ranked:<br />";
		  //
		$crewpquery = sprintf("SELECT rank FROM h_top_crew WHERE crew_name = ('%s')",
							  mysql_escape_string($crewtitle));	
		$r = mysql_query($crewpquery);
		list($crankid) = mysql_fetch_row($r);	echo $crankid;
		  ?></td>
                    <td></td>
                    <td><input name="Accept" type="button" value="Accept" /></td>
                    <td><input name="Decline" type="button" value="Decline" /></td>
                    </tr>
                  <?php
			$i+=1;
			}
		}
			?>
                  </table>
                </div>
              </form></td>
            </tr>
          </table></td>
      </tr>
      </table></td>
    <td width="204" valign="top"><table width="212" height="351" border="0" cellpadding="0">
      <tr>
        <td width="208" height="53" valign="top"><table width="206" border="0" cellpadding="0" background="../file/graphics/store_bk_bot.png">
          <tr>
            <td><div id="manage_header">You're Ranked!<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="What's This?" name="sprytrigger1" width="15" height="15" id="sprytrigger2" /></div></td>
          </tr>
        </table>
          <table width="206" border="0" cellpadding="0" background="../file/graphics/store_bk_bot.png">
            <tr>
              <td width="75"><div class="minner_text3">Your  Rank</div></td>
              <td width="125"><div id="yrank_stat"><?php $query = sprintf("SELECT * FROM h_top_players WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string ($userID));
		$result = mysql_query($query);
		$result_ar = mysql_fetch_assoc($result);
		echo $result_ar['rank'];
		?></div></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="165" valign="top"><table width="210" border="0" cellpadding="0" background="../file/graphics/store_bk_bot.png">
          <tr>
            <td><div id="manage_header">Your Cash Settings<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="What's This?" name="sprytrigger1" width="15" height="15" id="sprytrigger1" /></div></td>
          </tr>
        </table>
          <form id="form1" name="form1" method="post" action="">
            <table width="206" border="0" cellpadding="0" background="../file/graphics/store_bk_bot.png">
              <tr>
                <td width="190" align="right"><label><div class="minner_text">National Win Share
                  <input name="Nat_win_share" type="text" id="Nat_win_share" value="25" size="5" />
                %</label></div></td>
              </tr>
              <tr>
                <td align="right"><div class="minner_text">National Loss Share
                  <input name="Nat_win_share2" type="text" id="Nat_win_share2" value="25" size="5" />
%</div></td>
              </tr>
              <tr>
                <td align="right"><div class="minner_text">Inner Circle Win Share
                  <input name="Nat_win_share3" type="text" id="Nat_win_share3" value="25" size="5" />
%</div></td>
              </tr>
              <tr>
                <td align="right"><div class="minner_text">Inner Circle Loss Share
                  <input name="Nat_win_share4" type="text" id="Nat_win_share4" value="25" size="5" />
%</div></td>
              </tr>
            </table>
            <input type="submit" name="Submit" id="crew_sets" value="Submit" disabled="disabled" />
          </form></td>
      </tr>
      <tr>
        <td valign="top"><table width="206" border="0" cellpadding="0" background="../file/graphics/store_bk_bot.png">
          <tr>
            <td><div id="manage_header">Your Crew Settings<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="What's This?" name="sprytrigger1" width="15" height="15" id="sprytrigger1" /></div></td>
          </tr>
        </table>
          <form id="form2" name="form2" method="post" action="">
            <table width="206" border="0" cellpadding="0" background="../file/graphics/store_bk_bot.png">
              <tr>
                <td align="center"><label>
                  <input type="radio" name="radio" id="rob" value="rob" />
                  Ride or Die
                </label></td>
              </tr>
              <tr>
                <td align="center"><label>
                  <input type="radio" name="radio" id="protect" value="protect" />
                  Sleeper</label></td>
              </tr>
            </table>
            <input type="submit" name="robbery_set" id="robbery_set" value="Submit" />
          </form></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
  
</div>
</body>
</html>