<?
session_start();
$name=$_SESSION['user'];
 
require_once 'connect.php';		// our database settings
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);
$query = sprintf("SELECT id FROM phpfox_user WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($_SESSION['user']));
$result = mysql_query($query);
list($userID) = mysql_fetch_row($result);
 
require_once 'stats.php';
$energy=getStat('ep',$userID);
$cool_max=getStat('exp_rem',$userID);
$cool=getStat('exp',$userID);
$energy_max=getStat('ep_rem',$userID);
$cash=getStat('cash',$userID);
$tokens=getStat('rp',$userID);
$crew_rank=getCRank($userID);

switch ($cool)
{
case ($cool <= 20000):
  $stage=1;
  $l_label="Rookie";
  break;
case ($cool <= 52000):
  $stage=2;
  $l_label="Rookie";
  setStat('exp_rem',$userID,'52000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 90000):
  $stage=3;
  $l_label="Rookie";
  setStat('exp_rem',$userID,'90000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 134000):
  $stage=1;
  $l_label="Amateur";
  setStat('exp_rem',$userID,'134000');
  $energy_max+6;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 184000):
  $stage=2;
  $l_label="Amateur";
  setStat('exp_rem',$userID,'184000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 240000):
  $stage=3;
  $l_label="Amateur";
  setStat('exp_rem',$userID,'240000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 302000):
  $stage=1;
  $l_label="UpStart";
  setStat('exp_rem',$userID,'302000');
  $energy_max+6;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 370000):
  $stage=2;
  $l_label="UpStart";
  setStat('exp_rem',$userID,'370000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 444000):
  $stage=3;
  $l_label="UpStart";
  setStat('exp_rem',$userID,'444000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 524000):
  $stage=1;
  $l_label="Pro";
  setStat('exp_rem',$userID,'524000');
  $energy_max+6;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 610000):
  $stage=2;
  $l_label="Pro";
  setStat('exp_rem',$userID,'610000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 702000):
  $stage=3;
  $l_label="Pro";
  setStat('exp_rem',$userID,'702000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 800000):
  $stage=1;
  $l_label="Boss";
  setStat('exp_rem',$userID,'800000');
  $energy_max+6;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 904000):
  $stage=2;
  $l_label="Boss";
  setStat('exp_rem',$userID,'904000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 1024000):
  $stage=3;
  $l_label="Boss";
  setStat('exp_rem',$userID,'1024000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 1130000):
  $stage=1;
  $l_label="Mastermind";
  setStat('exp_rem',$userID,'1130000');
  $energy_max+9;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 1266000):
  $stage=2;
  $l_label="Mastermind";
  setStat('exp_rem',$userID,'1266000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 1405000):
  $stage=3;
  $l_label="Mastermind";
  setStat('exp_rem',$userID,'1405000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;  
case ($cool <= 1570000):
  $stage=1;
  $l_label="Kingpin";
  setStat('exp_rem',$userID,'1570000');
  $energy_max+10;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 1752000):
  $stage=2;
  $l_label="Kingpin";
  setStat('exp_rem',$userID,'1752000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
case ($cool <= 1935000):
  $stage=3;
  $l_label="Kingpin";
  setStat('exp_rem',$userID,'1935000');
  $energy_max+3;
  setStat('ep_rem',$userID,$energy_max);
  break;
default:
  echo "err";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Hustle</title>
<script type="text/javascript" src="http://www.12daysoffun.com/jquery/jquery-1.4.1.min.js"></script>

<link type="text/css" rel="stylesheet" href="http://12daysoffun.com/hustle/css/jquery/ui-lightness/jquery-ui-1.7.2.custom.css" />

  <script src="http://12daysoffun.com/hustle/js/jquery-1.3.2.min.js?checksum=3dc9f7c2642efff4482e68c9d9df874bf98f5bcb" type="text/javascript"></script>
  <script src="http://12daysoffun.com/hustle/js/jquery-ui-1.7.2.custom.min.js?checksum=3dc9f7c2642efff4482e68c9d9df874bf98f5bcb" type="text/javascript"></script>

  <script src="http://12daysoffun.com/hustle/js/swfobject.js" type="text/javascript"></script>
  
  <script type="text/javascript" src="http://12daysoffun.com/hustle/js/jquery.history.js"></script>
  
<script type="text/javascript">
	
	$(document).ready(function () {


	    $.history.init(pageload);	
	    
		$('a[href=' + window.location.hash + ']').addClass('selected');
		
		$('a[rel=ajax]').click(function () {
		
			var hash = this.href;
			hash = hash.replace(/^.*#/, '');
	 		$.history.load(hash);	
	 		
	 		$('a[rel=ajax]').removeClass('selected');
	 		$(this).addClass('selected');
	 		$('#body').hide();
	 		$('.loading').show();
	 		
			getPage();
	
			return false;
		});	
	});
	
	function pageload(hash) {
		if (hash) getPage();    
	}
		
	function getPage() {
		var data = 'page=' + encodeURIComponent(document.location.hash);
		$.ajax({
			url: "loader.php",	
			type: "GET",		
			data: data,		
			cache: false,
			success: function (html) {	
				$('.loading').hide();				
				$('#content').html(html);
				$('#body').fadeIn('slow');		
		
			}		
		});
	}

	</script>
    
<style type="text/css">
/* global hustle css */

/****************************************************************************
												UTILITY STYLES
****************************************************************************/

.clearfix:after
{
	content: ".";
	display:block;
	clear:both;
	visibility:hidden;
	line-height:0;
	height:0;
}

* html .clearfix,
.clearfix
{
	display: block;
	zoom: 1; /* Probably move this to a separate stylesheet isolated by IE6/7 conditional comments */
}

body {
	background-color: #FFFFFF;
}
img {
	border: none;
}

table.layout tr
{
	margin: 0;
	border: 0;
	padding: 0;
}

table.layout td
{
	margin: 0;
	border: 0;
	padding: 0;
}

<!--
#wrapper {
}
#wrapper #backing {
	background-image: url(http://www.12daysoffun.com/hustle/graphics/hustle_bk_tot.png);
	height: 500px;
	width: 750px;
	margin-right: auto;
	margin-left: auto;
}
#wrapper #backing #instructions {
	text-align: right;
	width: 200px;
	float: right;
}
table.layout
{
	margin: 0;
	border: 0;
	padding: 0;
	border-spacing: 0;
}
#wrapper #backing #instructions #redirects {
	padding: 5px;
	font-size: 12px;
	font-style: normal;
	font-family: "Times New Roman", Times, serif;
	color: #FC0;
}
#wrapper #backing #instructions #redirects #support {
	width: 50px;
	display: inline;
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #999;
	padding-right: 2px;
}
#wrapper #backing #instructions #redirects #privacypolicy {
	width: 100px;
	display: inline;
	border-right-style: solid;
	border-right-width: 1px;
	border-right-color: #999;
	border-left-color: #CCC;
	padding-right: 2px;
}
#wrapper #backing #instructions #redirects #terms {
	width: 30px;
	display: inline;
	padding-right: 2px;
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #999;
}
#wrapper #backing #instructions #redirects #forums {
	width: 45px;
	display: inline;
}
#wrapper #backing #user_stats {
	text-align: right;
	padding-top: 36px;
	font-size: 14px;
	font-family: "Times New Roman", Times, serif;
	font-style: normal;
}
#wrapper #backing #user_stats #cash_stat {
	width: 100px;
	color: #090;
	text-align: center;
}
#wrapper #backing #user_stats #cp_stat {
	color: #009;
	overflow: hidden;
	width: 200px;
	text-align: center;
}
#wrapper #backing #user_stats table tr td #energy_stat {
	color: #FFF;
	width: 70px;
	text-align: center;
	margin-left: 34px;
	height: 14px;
}
#wrapper #backing #user_stats #navbar #navnstat {
	margin-top: 31px;
}
#wrapper #backing #user_stats table tr td #store {
	width: 43px;
	float: left;
	padding-top: 2px;
}
#wrapper #backing #user_stats #navbar #navnstat tr td #coins {
	width: 40px;
	float: right;
}
#wrapper #backing #user_stats table tr td #invite {
	text-align: left;
}
#wrapper #backing #user_stats table tr td #level_number_stat {
	width: 15px;
	margin-left: 42px;
	color: #FFF;
	text-align: center;
	top: 3px;
}
#wrapper #backing #user_stats table tr td #level_label {
	font-size: 0.9em;
	color: #FFF;
	width: 60px;
}
#wrapper #backing #user_stats #navbar #navnstat tr td #coins #reward_points {
	color: #F90;
	font-weight: bold;
}
#wrapper #backing #user_stats table tr td #crew_rank_stat {
	width: 80px;
	color: #FFF;
	font-size: 0.9em;
	height: 10px;
}
#energy_clock {
	width: 62px;
	font-size: 0.8em;
	color: #FFF;
	text-decoration: blink;
	margin-left: 65px;
	top: 6px;
}
#wrapper #backing #inner_page #home_page {
	padding-top: 60px;
}
#wrapper #backing #inner_page #home_page table tr td table tr td #practice_button {
	width: 268px;
}
#wrapper #backing #inner_page #home_page table tr td table tr td #fight_button {
	width: 268px;
	margin-left: auto;
	margin-right: auto;
}
#wrapper #backing #inner_page #home_page table tr td table tr td #manage_button {
	width: auto;
	margin-left: 140px;
}
#wrapper #backing #inner_page {
	height: 404px;
	width: 750px;
}
#wrapper #backing #inner_page #home_page table {
}
.loading {
	background: url(http://www.12daysoffun.com/hustle/graphics/load.gif) no-repeat center center;
	height:48px;
	display:none;
}
-->
-->
.tab_box_header {
	height:27px; 
	overflow:hidden;
}
.tab {
	float: left;
}

.tab_box_header .tab_start {
	width: 6px;
	height: 27px;
	float: left;
	background-image: url(http://12daysoffun.com/hustle/http://www.12daysoffun.com/hustle/graphics/tab_left_6x27_01.gif);
}

.tab_box_header .tab_middle {
	float: left;
	height: 27px;
	width:auto;
	padding-left:5px;
	padding-right:10px;
	padding-top: 2px;
	background-image: url(http://12daysoffun.com/hustle/http://www.12daysoffun.com/hustle/graphics/tab_middle_1x27_01.gif);
}
.tab_box_header .tab_middle a:link, .tab_middle a:visited{
	color:#FFFFFF;  
	font-size:16px;
	text-decoration: none;
}
.tab_box_header .tab_middle a:hover{
	text-decoration: underline;
}

.tab_box_header .tab_end {
	width: 13px;
	height:27px;
	float: left;
	background-image: url(http://www.12daysoffun.com/hustle/http://www.12daysoffun.com/hustle/graphics/tab_right_13x27_01.gif);
}

.tab_box_header .tab_help {
	float: left; 
	height: 27px;
	padding-left:10px;
	padding-top:5px;
	color: #ccc; 
	font-size:12px; 	
}

.tab_help a:link, .tab_help a:visited{
	font-size:10px; 
	color:#FFD927; 
	text-decoration: none;
}
.tab_help a:hover{
	text-decoration: underline;
}

.tab_box_header .send_all_box {
	float: right;  
	width:auto;	
}
.send_all_box a:link, .send_all_box a:visited {
	text-decoration: none; 
	font-size:12px;
	color: #FFD927;
}
.send_all_box a:hover {
	text-decoration: underline; 
}
.send_all_box a img{
	text-decoration: none;
	vertical-align: middle; 
	border: none;
}

.tab_clear {
	float: left;
	width: auto;
	padding-top: 5px;
	font-size: 12px;
}

.tab_box_header .tab_recruit {
	float: left;  
	width:auto;	
	padding-top: 3px;
	padding-left: 10px;
}
.tab_recruit a:link, .tab_recruit a:visited {
	text-decoration: none; 
	font-size:12px;
	color: #FFD927;
}
.tab_recruit a:hover {
	text-decoration: underline; 
}
.tab_recruit a img{
	text-decoration: none;
	vertical-align: middle; 
	border: none;
}

.tab_box_content {
	background-color:#111111; 
	border:solid 1px #666666; 
	overflow: hidden;
}

.playerupdate_box {
	width: 522px;
	float: left;
	overflow-x: hidden;
}

.playerprofile_box {
	width: 200px;
	margin-left:10px;
	float:left;
}

.player_updates {
	height: 230px;
	margin-left: 10px;
	margin-right: 10px;
	overflow:auto;
}
-->#earners
 {
	width: 200px;
	height: 90px;
	margin-right: auto;
	margin-left: auto;
}

#low_display {
	height: 88px;
	width: 72px;
	background-repeat: no-repeat;
	float: right;
}


#low_display #header {
	background-color:#000;
	color: #FFF;
	height: 23px;
	width: 72px;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/lowearner_header.png);
}
#low_display #body {
	height: 49px;
	width: 72px;
}
#low_display #footer {
	width: 72px;
	color: #F00;
	background-color: #000;
	font-size: 0.67em;
	height: 16px;
	font-weight: bold;
	text-align:center;
}
#top_display {
	height: 88px;
	width: 72px;
}


#top_display #header {
	background-color:#000;
	color: #FFF;
	height: 23px;
	width: 72px;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/topearner_header.png);
}
#top_display #body {
	height: 49px;
	width: 72px;
}
#top_display #footer {
	width: 72px;
	color:#0C0;
	background-color: #000;
	font-size: 0.67em;
	height: 16px;
	font-weight: bold;
	text-align:center;
}
#wrapper #backing .footer #crews {
	width: 98px;
	margin: auto;
	height: 55px;
}
</style>
</head>
<body style="margin:0;">

<a name="verytop" id="verytop"></a>


<div style="display: none;">&nbsp;</div>

<div id="wrapper">
	<div class="loading"></div>
  <div class="background" id="backing">
    <div class="header" id="instructions">
      <div id="redirects">
        <div id="privacypolicy">PrivacyPolicy</div>
        <div id="support">Support</div>
        <div id="terms">ToS</div>
        <div id="forums">Forums</div>
      </div>
    </div>
    <div class="stats" id="user_stats">
    <table width="340" border="0" align="right">
  <tr>
    <td width="135" height="18"><div id="cash_stat">$<? echo $cash?></div></td>
    <td width="200"><div id="cp_stat"><? echo $cool?>/<? echo $cool_max?></div></td>
  </tr>
  <tr>
    <td height="18"><div id="energy_clock"><? $stage ?></div></td>
    <td valign="bottom"><div id="level_number_stat"><? echo $stage?></div></td>
  </tr>
  <tr>
    <td valign="top"><div id="energy_stat"><?  echo $energy?>/<? echo $energy_max?></div></td>
    <td><table width="200" height="22" border="0" cellpadding="0">
  <tr>
    <td width="86" valign="middle"><div id="level_label"><? echo $l_label?></div></td>
    <td width="108" valign="top"><div id="crew_rank_stat"><? echo $crew_rank?></div></td>
  </tr>
</table>
</td>
  </tr>
    </table>
      <div id="navbar">
        <table width="275" border="0" align="right" id="navnstat">
          <tr>
            <td width="45" valign="middle"><div class="buttons" id="home"><img src="http://www.12daysoffun.com/hustle/graphics/home_button.png" alt="Home" width="36" height="11" hspace="3" align="middle" /></div></td>
            <td width="55" valign="middle"><div class="buttons" id="invite"><img src="http://www.12daysoffun.com/hustle/graphics/invite_button.png" alt="Invite" width="40" height="11" hspace="3" align="middle" /></div></td>
            <td width="99" valign="bottom"><div class="buttons" id="store"><img src="http://www.12daysoffun.com/hustle/graphics/store_button.png" alt="Store" width="41" height="11" align="middle"/></div>
              <div id="coins"><span id="reward_points"><? echo $token?></span><span><img src="http://www.12daysoffun.com/hustle/graphics/tokens_1.png" width="19" height="19" alt="reward points" /></span></div></td>
            <td width="74" valign="middle"><div class="button" id="inventory"><img src="http://www.12daysoffun.com/hustle/graphics/inventory_button.png" alt="inventory" width="69" height="11" hspace="3" align="middle" /></div></td>
          </tr>
        </table>
      </div>

      
    </div>
    <div id="inner_page">
      <div id="home_page">
        <table width="751" height="344" border="0" cellpadding="0">
          <tr>
            <td width="409" height="340"><table width="409" height="333" border="0" cellpadding="0">
              <tr>
                <td width="405" height="107" valign="top"><div id="practice_button"><img src="http://www.12daysoffun.com/hustle/graphics/practice_button.png" width="268" height="62" alt="Practice in the Arcade" /></div></td>
              </tr>
              <tr>
                <td height="98" valign="top"><div id="fight_button"><img src="http://www.12daysoffun.com/hustle/graphics/fight_button.png" width="268" height="62" alt="Make some Cash" /></div></td>
              </tr>
              <tr>
                <td valign="top"><div id="manage_button"><img src="http://www.12daysoffun.com/hustle/graphics/manage_button.png" width="268" height="61" alt="Manage Your Crew" /></div></td>
              </tr>
            </table></td>
            <td width="336"><table width="335" height="334" border="0" cellpadding="0">
              <tr>
                <td width="300"><table width="293" height="320" border="0" cellpadding="0">
                  <tr>
                    <td height="221" valign="top">
                    <div class="playerupdate_box" style="width: 289px;">
                      <div class="tab_box_header" style="height: 35px">
                        <div class="tab" style="padding-top: 8px">
                          <div class="tab_start"> &nbsp; </div>
                          <div class="tab_middle"> Updates </div>
                          <div class="tab_end"> &nbsp; </div>
                        </div>
                        <div class="tab_clear"> <a href="http://mwfb.zynga.com/mwfb/remote/html_server.php?xw_controller=index&xw_action=deletenews&xw_city=1&tmp=b87a04a9e1718c3c499a9ad203c2463c&cb=5036007541267149873" onclick="  return do_ajax('inner_page', 'remote/html_server.php?xw_controller=index&xw_action=deletenews&xw_city=1&tmp=b87a04a9e1718c3c499a9ad203c2463c&cb=5036007541267149873', 1, 1, 0, 0); return false;  " >[ Clear Updates ]</a> </div>
                        <div id="clock_energy_pack"></div>
                      </div>
                      <div class="tab_box_content">
                        <div class="player_updates" style=" height: 183px; margin-right: 0px; overflow-x: hidden;"></div>
                      </div>
                    </div></td>
                  </tr>
                  <tr>
                    <td height="37" valign="bottom">
                    <div id="earners">
<div id="low_display">
  <div id="header"></div>
  <div id="body"></div>
  <div id="footer"><span>-$</span><span id="losses"> 5000000</span></div>
</div>
<div id="top_display">
  <div id="header"></div>
  <div id="body"></div>
  <div id="footer"><span>+$</span><span id="profits"> 5000000</span></div>
</div>
</div>
</td>
                  </tr>
                </table></td>
                <td width="29"><div id="side_menu">
                  <table width="35" height="335" border="0" cellpadding="0">
                    <tr>
                      <td height="76"><img src="http://www.12daysoffun.com/hustle/graphics/profile_button.png" width="31" height="80" alt="My Profile" /></td>
                      </tr>
                    <tr>
                      <td height="82"><img src="http://www.12daysoffun.com/hustle/graphics/assets_button.png" width="31" height="82" alt="My Assets" /></td>
                      </tr>
                    <tr>
                      <td valign="top"><img src="http://www.12daysoffun.com/hustle/graphics/leaderboards_button.png" width="31" height="149" alt="Score Boards" /></td>
                      </tr>
                  </table>
                </div></td>
              </tr>
            </table></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="footer">
      <div id="crews"><img src="http://www.12daysoffun.com/hustle/graphics/recruit.png" alt="" width="93" height="32" /></div>
    </div>
  </div>
</div>
<!--/****************************************************************************
											Facebook JS API
****************************************************************************/
-->
<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" mce_src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"> </script>
<script type="text/javascript">

FB_RequireFeatures(["CanvasUtil"], function()
    {
      //You can optionally enable extra debugging logging in Facebook JavaScript client
      //FB.FBDebug.isEnabled = true;
      //FB.FBDebug.logLevel = 4;


      FB.XdComm.Server.init("http://12daysoffun.com/hustle/xd_receiver.htm");
      FB.CanvasClient.startTimerToSizeToContent();
    });


	FB_RequireFeatures(["XFBML"], function(){
		FB.Facebook.init("2b154bd6f13c0d2e91ee4619514aeaf9", "http://12daysoffun.com/hustle/xd_receiver.htm"); 
	});   
</script>
</body>
</html>