<?php
$user = $_REQUEST['user'];
require_once 'connect.php';		// our database settings
include 'stats.php';
include 'leveler.php';
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<script src="http://static.new.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<head>
	<meta charset="UTF-8" />
	<title>The Hustle</title>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  
<script type="text/javascript" src="js/jquery.history.js"></script>
<script type="text/javascript" src="js/jquery.livequery.js"></script>

<script type="text/javascript" src="js/arcade.js"></script>

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
			earners();
	
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
	
		
	$('a[rel*=ajax]') 
    .livequery('click', function(event) { 
        var hash = this.href;
			hash = hash.replace(/^.*#/, '');
	 		$.history.load(hash);	
	 		
	 		$('a[rel=ajax]').removeClass('selected');
	 		$(this).addClass('selected');
	 		$('#body').hide();
	 		$('.loading').show();
	 		
			getPage();
			earners();
	
			return false; 
								 });
	function earners(){
		$.post("smgtrack_ajax.php", {data: htmlStr}, function(results) {
											 var user_cash_cow = results.cash_cow;
											 var user_cow_earns = results.cow_earns;
											 var user_drain = results.cash_drain;
											 var user_drain_losses = results.drain_loss;
									 $('#cash_cow').append('<img src=" http://www.12daysoffun.com/hustle/file/pic/user/' + user_cash_cow + '"/>');
									 $('#profits').append(user_cow_earns);
									 $('#drain').append('<img src=" http://www.12daysoffun.com/hustle/file/pic/user/' + user_drain + '"/>');
									 $('#losses').append(user_drain_losses);
									 
									}, "json");
	}
	
	</script>
<?php
// Crew Cash Cow
//
$query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($user));
$result = mysql_query($query);
list($crewID) = mysql_fetch_row($result);

$query1 = sprintf("SELECT user,MAX(crew_earnings) FROM h_crew_member WHERE crew_id = ('%s')",
			mysql_real_escape_string($crewID));
$result1 = mysql_query($query1);
$row = mysql_fetch_array($result1);
//
$username1 = $row['user'];
$gross_earnings = $row['MAX(crew_earnings)'];

$query2 = sprintf("SELECT image FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($username1));
$result2 = mysql_query($query2);
list($cash_cow) = mysql_fetch_row($result2);

//
// Crew Cash Drain
//
$query1 = sprintf("SELECT user,MIN(crew_earnings) FROM h_crew_member WHERE crew_id = ('%s')",
			mysql_real_escape_string($crewID));
$result1 = mysql_query($query1);
$r = mysql_fetch_array($result1);
//
$username3 = $r['user'];
$gross_losses = $r['MIN(crew_earnings)'];

$query4 = sprintf("SELECT image FROM h_users WHERE UPPER(user) = UPPER('%s')",
			mysql_real_escape_string($username3));
$result4 = mysql_query($query4);
list($cash_drain) = mysql_fetch_row($result4);
?>    
<head>
<style type="text/css">
<!--
img {
	border: none;
}
body {
	
	margin-right: auto;
	margin-left: auto; 
	text-align:center;
	background:#000;
}
		
#wrapper {
	width:750px; 
	margin-right: auto;
	margin-left: auto; 
}
			
#body {
	clear:both; 
	margin:0;
}
				
#body .body {
	width:750px;
	margin:0;
}			
.loading {
	background: url(images/load.gif) no-repeat center center;
	height:48px;
	display:none;
}
#wrapper #body .body #content #base {
	background: url(http://www.12daysoffun.com/hustle/graphics/hustle_bk_bottom.png) no-repeat;
	height: 402px;
	width: 750px;
	margin-right: auto;
	margin-left: 1px;
}
#base {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/long_bk.png);
	height: 712px;
}
#base #manage_pg table tr td table tr td table tr td #manage_header {
	color: #FFF;
	font-size: 16px;
	width: 170px;
	font-weight: bold;
}
#base #manage_pg table tr td table tr td table tr td #manage_header2 {
	font-size: 16px;
	font-weight: bold;
	color: #FFF;
}
#base #manage_pg table tr td table tr td table tr td .minner_text {
	font-size: 14px;
	color: #FFF;
	width: 206px;
}
#base #manage_pg table tr td table tr td table tr td .minner_text3 {
	font-size: 14px;
	color: #FFF;
}
#base #manage_pg table tr td table tr td table tr td #yrank_stat {
	font-size: 13px;
	color: #CCC;
	font-weight: bold;
}
#base #manage_pg table tr td table tr td table tr td #yorank_stat {
	font-size: 13px;
	color: #999;
	font-weight: bold;
}
#base #manage_pg table tr td table tr td table tr td #fire_shake {
	height: 167px;
	overflow: scroll;
}
#base #manage_pg table tr td table tr td table tr td form #quitter {
	overflow: scroll;
	height: 146px;
}
#base #manage_pg table tr td table tr td table tr td #manage_header3 {
}
#base #manage_pg table tr td table tr td table tr td form #coffers {
	height: 160px;
	overflow: scroll;
}
#base #manage_pg table tr td table tr td table tr td form #new_offers {
	margin-bottom: 23px;
}

-->
</style>
</head>

<body style="margin:0;">    
<a name="verytop" id="verytop"></a>   
<div id="base">
          			<div id="home">
           			  <table width="751" height="344" border="0" cellpadding="0">
             		 	<tr>
                		<td width="409" height="340"><table width="409" height="333" border="0" cellpadding="0">
                  		<tr>
                   		<td width="405" height="107" valign="top"><div id="practice_button"><img src="http://www.12daysoffun.com/hustle/graphics/practice_button.png" width="268" height="62" alt="Practice in the Arcade" /></a></div></td>
                 		</tr>
                        <tr>
                    <td height="98" valign="top"><div id="fight_button"><a href="javascript:ajaxpage('fight.php?user=<? echo $user ?>', 'content');"><img src="http://www.12daysoffun.com/hustle/graphics/fight_button.png" width="268" height="62" alt="Make some Cash" /></a></div></td>
                  </tr>
                  <tr>
                    <td valign="top"><div id="manage_button"><a href="javascript:ajaxpage('manage.php?user=<? echo $user ?>', 'content');"><img src="http://www.12daysoffun.com/hustle/graphics/manage_button.png" width="268" height="61" alt="Manage Your Crew" /></a></div></td>
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
                            <div class="tab_clear">[ Clear Updates ]</div>
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
      <div id="drain"><img src="http://www.12daysoffun.com/hustle/file/pic/user/<? echo $cash_drain?>" alt="Top Earner"></div>
      <div id="footer"><span>-$</span><span id="losses"><? echo $gross_losses?></span></div>
    </div>
  <div id="top_display">
      <div id="header"></div>
      <div id="cash_cow"><img src="http://www.12daysoffun.com/hustle/file/pic/user/<? echo $cash_cow?>" alt="Top Earner"></div>
      <div id="footer"><span>+$</span><span id="profits"><? echo $gross_earnings?></span></div>
    </div>
</div>
    </td>
                      </tr>
                    </table></td>
                    <td width="29">
                    	<div id="side_menu">
                      		<table width="35" height="335" border="0" cellpadding="0">
                        <tr>
                          <td height="76"><a href="javascript:ajaxpage('profile.php?user=<? echo $user ?>', 'content');"><img src="http://www.12daysoffun.com/hustle/graphics/profile_button.png" width="31" height="80" alt="My Profile" /></a></td>
                          </tr>
                        <tr>
                          <td height="82"><a href="#assets" rel="ajax"><img src="http://www.12daysoffun.com/hustle/graphics/assets_button.png" width="31" height="82" alt="My Assets" /></a></td>
                          </tr>
                        <tr>
                          <td valign="top"><a href="javascript:ajaxpage('leaderboards.php', 'content');"><img src="http://www.12daysoffun.com/hustle/graphics/leaderboards_button.png" width="31" height="149" alt="Score Boards" /></a></td>
                          </tr>
                      </table>
                    </div></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div>
          <div class="footer">
          <div id="crews"><a href="javascript:ajaxpage('recruit.php?user=<? echo $user ?>', 'content');"><img src="http://12daysoffun.com/hustle/graphics/recruit.png" alt="" width="93" height="32" /></a></div>
      </div>
        </div>
        </body>