<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$query = "SELECT train_pickup FROM h_bliss_bank";
$result = mysql_query($query);
list($train) = mysql_fetch_row($result);

if($train == 185){
	$train = '<div id="train"></div>';
} else {
	$train = '<div id="tracks"></div>';
}

switch($_GET['page'])  {
	case '#start' : $page = '<div id="basics"></div>'; break;
		
	case '#home' : $page = '<div id="topplayer" style="display:none"><div id="topplayer_pic"></div><span id="topplayer_name" style="color:#FFF; font-weight:400;"></span></div>
			<div id="lotto_blimp" style="display:none"><img src="../graphics/blimp.png" title="Why not buy a ticket, in the store or a dealer in the Black Market"/>
              <div id="lotto_pot"></div>
            </div>
            <div id="escalade" style="display:none"></div>
            <div id="cops"></div><div id="apDiv8"> <tr>
                    <td height="37" valign="bottom">
                  <div id="earners">
                    <div id="low_display">
                      <div id="header"></div>
                      <div id="drain"></div>
                      <div id="footer"><span>-$</span><span id="losses"></span></div>
                    </div>
                    <div id="top_display">
                      <div id="header"></div>
                      <div id="cash_cow"></div>
                      <div id="footer"><span>+$</span><span id="profits"></span></div>
                    </div>
                    <div id="badge" align="left"></div>
					<div id="cellphone" align="left"></div>
                  </div>
                    </td>
                    </tr></div>
                <img src="../file/graphics/strip.jpg" width="749" height="404" />
            <div id="apDiv1"><span id="title" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/arcade_gif.png"/></span></div>
                <div id="coliseum"><span id="fight_title" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/attack_title.png"/></span></div>
                <div id="apDiv3"><span id="gun_title" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/gunshop_title.png"/></span></div>
                <div id="apDiv4"><span id="muscle_title" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/securityoffice_title.png"/></span></div>
                <div id="apDiv5"><span id="recruiters" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/recruit_title.png"/></span></div>
                <div id="apDiv6"><span id="deed" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/realtor_title.png"/></span></div>
                <div id="apDiv7"><span id="cheats" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/store_title.png"/></span><span id="reward_points" style=" background-color:#333;color:#FC0; font-weight:200;"></span><span><img src="http://www.12daysoffun.com/hustle/graphics/tokens_1.png" width="19" height="19" alt="reward points" /></span></div>
				<div id="apDiv9"><span id="market_title" style="display:none"><img src="../graphics/market_title.png"/></span></div>
                <div id="practice_button"><img src="../file/graphics/spacer_box.png" width="272" height="174" /></div>
                  <div id="fight_button"><img src="../file/graphics/spacer_box.png"width="551" height="220" /></div>
				  <div id="market_button"><img src="../file/graphics/spacer_box.png" width="25" height="220" /></div>
              <div id="inv_muscle_2"><img src="../file/graphics/spacer_box.png" width="165" height="105" /></div>
                <div id="inventory_button"><img src="../file/graphics/spacer_box.png" width="145" height="68" /></div>
                <div id="rroffice"><img src="../file/graphics/spacer_box.png" width="110" height="97" /></div>
                <div id="cheatmall"><img src="../file/graphics/spacer_box.png" width="81" height="52" /></div>
                <div id="crews"><img src="../file/graphics/spacer_box.png" width="198" height="64" /></div>
                <div id="billboard"><img src="../file/graphics/spacer_box.png" width="229" height="156" /></div><div id="false_fb_foreg">
                  <p>&nbsp;</p>
                  <p><img src="../file/fb_help.png"/></p>
                </div>'; break;

	case '#downtown' : $page = '<div id="lotto_blimp" style="display:none"><img src="../graphics/blimp.png" title="A dealer in the Black Market"/>
              <div id="lotto_pot"></div>
</div><div id="express" style="display:none"></div>
              <div id="apDiv8"> <tr>
                    <td height="37" valign="bottom">
                  <div id="earners">
                    <div id="low_display">
                      <div id="header"></div>
                      <div id="drain"></div>
                      <div id="footer"><span>-$</span><span id="losses"></span></div>
                    </div>
                    <div id="top_display">
                      <div id="header"></div>
                      <div id="cash_cow"></div>
                      <div id="footer"><span>+$</span><span id="profits"></span></div>
                    </div>
                  </div>
                    </td>
                    </tr></div>
          <img src="../file/graphics/dtown_strip.jpg" width="749" height="404" />
          <div id="bridge"></div>
          <div id="black_market"><img src="../file/graphics/spacer_box.png" width="128" height="52" /></div>
<div id="nightclub"><img src="../file/graphics/spacer_box.png" width="162" height="106" />
			  </div><span id="agency_init"></span>
		  <div id="casino"><img src="../file/graphics/spacer_box.png" width="362" height="164" /></div>
		  <div id="bm_title"><span id="blackmarket_title" style="display:none"><img src="../graphics/blackmarket_title.png"/></span></div>
		  <div id="nc_title"><span id="nightclub_title" style="display:none"><img src="../graphics/nightclub_title.png"/></span></div>'; break;
		  
	case '#northend' : $page = '<div id="holdings"><span id="bank_title" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/bank_title.png"/></span></div>
	<div id="famouspeople"><span id="fame_title" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/fame_title.png"/></span></div>
	<div id="healthem"><span id="clinic_title" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/clinic_title.png"/></span></div>
	<div id="bank_building"><img src="../file/graphics/spacer_box.png" width="106" height="117" /></div>
	<div id="hallofame"><img src="../file/graphics/spacer_box.png" width="97" height="69" /></div>
	<div id="clinic"><img src="../file/graphics/spacer_box.png" width="143" height="29" /></div>
	<div id="topbottoms"> <tr>
                    <td height="37" valign="bottom">
                  <div id="earners">
                    <div id="low_display">
                      <div id="header"></div>
                      <div id="drain"></div>
                      <div id="footer"><span>-$</span><span id="losses"></span></div>
                    </div>
                    <div id="top_display">
                      <div id="header"></div>
                      <div id="cash_cow"></div>
                      <div id="footer"><span>+$</span><span id="profits"></span></div>
                    </div>
                  </div>
                    </td>
                    </tr></div>
          <img src="../file/graphics/suptown_back.jpg" width="749" height="404" />'; break;	
		  
	case '#eastend' : $page = '<div id="lotto_blimp" style="display:none"><img src="../graphics/blimp.png"/>
              <div id="lotto_pot"></div>
</div>
              <div id="apDiv8"> <tr>
                    <td height="37" valign="bottom">
                  <div id="earners">
                    <div id="low_display">
                      <div id="header"></div>
                      <div id="drain"></div>
                      <div id="footer"><span>-$</span><span id="losses"></span></div>
                    </div>
                    <div id="top_display">
                      <div id="header"></div>
                      <div id="cash_cow"></div>
                      <div id="footer"><span>+$</span><span id="profits"></span></div>
                    </div>
                  </div>
                    </td>
                    </tr></div>
          <img src="../file/graphics/trainyard.jpg" width="749" height="404" />
          <div id="bridge"></div>
		  <div id="chopshop"><img src="../file/graphics/spacer_box.png" width="213" height="122" /></div>
            <div id="junkyard"><img src="../file/graphics/spacer_box.png" width="177" height="110" /></div>
			
            <div id="marina"><img src="../file/graphics/spacer_box.png" width="137" height="94" /></div>
			<div id="diner"><img src="../file/graphics/spacer_box.png" width="157" height="64" /></div>'; break;	  

	case '#store' : $page ='<div id="mall">
    	<div id="store_page">
          <div id="store_header">
            <table width="720" border="0" cellpadding="0" align="center">
              <tr>
                <td><table width="725" border="0" cellpadding="0">
                  <tr>
                    <td width="427"><table width="86" border="0" cellpadding="0" id="header_label" >
                      <tr>
                        <td>THE STORE</td>
                      </tr>
                    </table>
                      <table width="352" border="0" cellpadding="0">
                        <tr>
                          <td>Use Reward Points to purchase rare items, special upgrades, extra energy and much more.</td>
                        </tr>
                    </table></td>
                    <td width="292">Currently you have:<span id="reward_points" style=" background-color:#333;color:#FC0; font-weight:200;"></span><span><img src="http://www.12daysoffun.com/hustle/graphics/tokens_1.png" width="19" height="19" alt="reward points" /></span> Rewards Points</td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div>
          <div id="paypal">
            
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td><table width="420" border="0" cellpadding="0">
                    <tr>
                      <td width="217"><table width="346" border="0" cellpadding="0">
                        <tr>
                          <td><img src="http://www.12daysoffun.com/hustle/graphics/ccLogo.gif" width="168" height="24" alt="Credit Cards" /></td>
                          <td>Buy<img src="http://www.12daysoffun.com/hustle/graphics/tokens_1.png" width="19" height="19" alt="reward points" />rewards points</td>
                        </tr>
                      </table></td>
                    </tr>
					<form id="invoice" name="invoice" action="pp_clerk.php">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
                  <td><span class="payterms"></span> <img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/paypal.png" width="55" height="23" alt="paypal" /><img id="paying" src="http://www.12daysoffun.com/hustle/graphics/btn_buynow_ccbill2.gif" width="107" height="26" /></td>
                </tr></form>
              </table>
            
          </div>
          <div id="space_block"></div>
          <div id="bundles">
            <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
              <tr>
                <td><div align="center">10 Lotto Tickets</div>
                  <div align="center"><img src="http://www.12daysoffun.com/hustle/graphics/lottery_image.png" width="75" height="75"/> </div>
                  
                  <div align="center"><form id="1uinh" name="1uinh" method="post" action="store_clerk.php"><input type="hidden" id="onein" name="ticket" value="ticket"/><input type="hidden" id="userid" name="customer" value="$user"/><input type="image" src="http://www.12daysoffun.com/hustle/file/pic/fbimages/12_points.png" name="buynow"></form></div></td>


                <td><div align="center">50lbs of Blue Magic <span>(800 Units)</span></div>
                  <div align="center"><img src="http://www.12daysoffun.com/hustle/graphics/bmagic.png" width="75" height="75"></div>
                  
                  <div align="center"><form id="3uinh" name="3uinh" method="post" action="store_clerk.php"><input type="hidden" id="threein" name="magic" value="magic"/><input type="hidden" id="userid" name="customer" value="$user"/><input type="image" src="http://www.12daysoffun.com/hustle/file/pic/fbimages/35_points.png" name="buynow"></form></div></td>
                <td><div align="center">Energy Rehab</div>
                  <div align="center"><img src="http://www.12daysoffun.com/hustle/graphics/rehab.png" width="75" height="75"/></div>
                  
                  <div align="center"><form id="1uest" name="1uest" method="post" action="store_clerk.php"><input type="hidden" id="onest" name="rehab" value="rehab"/><input type="hidden" id="userid" name="customer" value="$user"/><input type="image" src="http://www.12daysoffun.com/hustle/file/pic/fbimages/20_points.png" name="buynow"></form></div></td>
              </tr>
              <tr>
                <td><div align="center" style="padding-bottom:8px;">New Crew Flag</div>
                  <form id="3uest" name="3uest" method="post" action="store_clerk.php"><div align="center" id="flaglist" style="overflow:auto; height:38px; padding-bottom:5px; padding-top:5px; width:120px; margin-left:auto; margin-right:auto"></div><div style="height:19px;"></div>
                  
                  <div align="center"><input type="hidden" id="threest" name="flag" value="flag"/><input type="hidden" id="userid" name="customer" value="$user"/><input type="image" src="http://www.12daysoffun.com/hustle/file/pic/fbimages/12_points.png" name="buynow"></form></td>
                <td><td><div align="center">Destroy Criminal Record</div><div align="center"><img src="../graphics/jailbreak.jpg" width="75" height="75" /></div>
                  <form id="jail" name="jail" method="post" action="store_clerk.php">
                    <div align="center">
                  <input type="hidden" id="jailbreak" name="jailbreak" value="jailbreak"/><input type="hidden" id="userid" name="customer" value="$user"/><input type="image" src="http://www.12daysoffun.com/hustle/file/pic/fbimages/35_points.png" name="buynow"></form></td></td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </div>
          <div id="space_block"></div>
          <div id="consumables">
            <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
              <tr>
                <td width="215"><div align="center">Full Energy Refill</div><div align="center"><img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/buy_energy_75x75_01.gif" width="75" height="75" alt="Refill Your Enegy!" /></div>
                                  <div align="center"><form id="full_e" name="full_e" method="post" action="store_clerk.php"><input type="hidden" id="energyfill" name="energyfill" value="energyfill"/><input type="hidden" id="userid" name="customer" value="$user"/><input type="image" src="http://www.12daysoffun.com/hustle/file/pic/fbimages/10_points.png" name="buynow"></form></div></td>
                <td width="256"><div id="twentyk" align="center">$20,000 Cash</div><div id="twentyk_image" align="center"><img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/buy_cash_75x75_01.gif" width="75" height="75" alt="$20,000 Cash! " /></div><div align="center"><form id="twin" name="twin" method="post" action="store_clerk.php"><input type="hidden" id="cashloan" name="cashloan" value="cashloan"/><input type="hidden" id="userid" name="customer" value="$user"/><input type="image" src="http://www.12daysoffun.com/hustle/file/pic/fbimages/10_points.png" name="buynow"></form></div></td>
                <td width="225"><div id="crew_name" align="center">New Crew Name</div><div id="ncn_image" align="center"><img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/buy_newname_75x75_01.gif" width="75" height="75" alt="Rename Your Crew!" /> </div><div align="center"><form id="nname" name="nname" method="post" action="store_clerk.php"><input type="hidden" id="crewname" name="crewname" value="crewname"/><input type="hidden" id="userid" name="customer" value="$user"/><input type="image" src="http://www.12daysoffun.com/hustle/file/pic/fbimages/15_points.png" name="buynow"></form></div></td>
              </tr>
            </table>
          </div><div id="sum" style="display:none;"></div><div id="prem_button"><img src="../graphics/premium.png" width="138" height="28" /></div>
    	</div>        
	</div>'; break;

	case '#invite' : $page = '<b>About</b><br/>This is a simple AJAX-Based website created by Kevin from Queness.com. General speaking, we shouldn\'t call this as AJAX (Asynchronous Javascript and XML) because there is no XML data. Instead of AJAX, we should call it as AHAH.<br/><br/><b>Asychronous HTML and HTTP aka AHAH</b><br/>AHAH is a technique for dynamically updating web pages using JavaScript, involving usage of XMLHTTPRequest to retrieve (X)HTML fragments which are then inserted directly into the web page. Inspite of retreiving XML, AHAH stands for retreiving (X)HTML. It\'s a subset of AJAX.'; break;
	
	case '#practice' : $page = '<div id="inner_page2"><div id="mission" style="display:block;"><img id="practice_exit" src="../graphics/exit.gif" /></div></div>'; break;
	
	case '#fight' : $page = '<div id="fight_page">
        <div id="fighthud">
        <form id="fight_form" name="fight_form" action="fightq.php" method="post"> 
        <table width="738" border="0" cellpadding="0" align="center">
        <tr>
        <td width="357" id="marksec"><span class="ftheader"><b>STEP 1: Choose the Mark</b></span>
      <div id="mark_header"><span id="subhead">User</span><span id="subhead">Crew</span><span id="sublevel">Level</span><span id="subrank">Game Rank</span></div></td>
    <td width="171" align="center" id="gamesec"><span class="ftheader"><b>STEP 2: Choose Your Game</b></span></td>
    <td width="202" align="center"><span class="ftheader"><b>STEP 3: Enter Your Wager</b></span></td>
  </tr>
  <tr>
    <td><div id="body_mark" style="overflow:auto"></div></td>
    <td align="center" id="gamesec2" valign="top" style="color:#FFF"><div id="arena" style="overflow:auto"><p>
        Select a game from below
        </p><p><div class="page"><img src="http://www.12daysoffun.com/hustle/graphics/game_list.png"/></div></p><p>Then enter the game&acute;s name below</p><input name="game" id="game" type="text" size="14" maxlength="25" /><br /><span class="error" id="fight_name_error" style="color:#F00; font-size:12px"></span> 
        </p></div></td>
    <td align="center"><div id="bet">
      <p>
        $
        <input name="wager" id="wager" type="text" size="10" maxlength="8" />.00<br />
        <span class="error" id="wager_error" style="color:#F00; font-size:12px;"></span>
        </p>
        <!-- the tooltip --> 
        <div id="playingtip">&nbsp;</div>
      <div id="manage_header">Playing...<img src="../../clique/graphics/icon_help_16x16_01.gif" id="fighttip" title="If you feel your score will be enough to win the wager, select FAIR. Play DIRTY if you don&acute;t mind robbing the player of valuables at the end of the contest; keep in mind your crew,muscle, and weapons have to be stronger than your opponent&acute;s and you risk losing cool points playing DIRTY." /></div>
      <p>
      <label><input type="radio" name="radio" id="radio" value="attack"/>
                  Dirty</label>
                  <label><br>
                    <input type="radio" name="radio" id="radio" value="defend" />
                  Fair</label>
      <p>
        <input type="hidden" id="userid" name="instigator" value="<? echo $user?>"/>
        <input name="submit" type="submit" class="button" id="submit_btn" value="Submit" />
      </p>
    </div>
    
      <div id="fightrules">Each Challenge Costs x3 <img src="http://12daysoffun.com/hustle/file/pic/fbimages/buy_energy_75x75_01.gif" width="17" height="21" />Energy<img src="../../clique/graphics/icon_help_16x16_01.gif" id="fighttip2" title="Every fight costs you 3 energy points. If you lose, you risk more than cash, also reputation or cool points; but if you win, fairly, you not only gain cash but cool points!" /><br />
        Each  WIN earns <img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/shades_2.png" width="17" height="16" />Cool Points<br />
        Each LOSS costs <img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/shades_2.png" alt="" width="17" height="16" />Cool Points</div></td>
  </tr>
      </table>
      </form>
  </div><img id="practice_exit" src="../graphics/exit.gif" />
</div><div id="play"></div>'; break;

	case '#attack' : $page = '<table width="750" style="background-image:url(../file/graphics/long_bk.jpg)"><td width="669" align="left"><h2><img src="../graphics/fight.png" width="80" height="24" /><img src="../../clique/graphics/icon_help_16x16_01.gif" id="attacktip" title="Fighting
Fight other Crews to show your strength.
Be careful of users with a Crew size bigger than yours. They will be much tougher to defeat." /></h2></td><td width="230"><table><tr><td width="83" id="hit_button"><img src="../graphics/hitlist_butt.png" width="75" height="23" /></td><td width="83" id="fightleaders_button"><img src="../graphics/fightleaders_butt.png" /></td></tr></table></td></table><div id="fight_feed" style="display:none; background-image: url(../graphics/slong_bk.png);"><img id="circle_exit" src="../graphics/exit.gif" /><table width="726" height="238" border="0" cellpadding="0" align="center" style="background-image: url(../graphics/store_bk.png);">
    <tr>
      <td width="111">
        <table width="360" height="219" border="0" cellpadding="0">
          <tr>
            <td width="154" id="winner_circle" style="background-repeat: no-repeat;"><img id="exit_circle" src="../graphics/winner_art.png" /></td>
            <td width="200"><table width="200" height="215" border="0" cellpadding="0" style="color:#0F0">
              <tr>
                <td width="98" height="23" id="myname">&nbsp;</td>
                </tr>
              <tr>
                <td height="22">Earnings</td>
                </tr>
              <tr>
                <td><table width="168" height="104" border="0" cellpadding="0" style="color:#0F0">
                  <tr>
                    <td width="59">Cash</td>
                    <td width="103" id="winner_cash">&nbsp;</td>
                    </tr>
                  <tr>
                    <td>Cool</td>
                    <td id="winner_cool">&nbsp;</td>
                    </tr>
                  </table></td>
                </tr>
              </table>
  </td>
            </tr>
          </table></td>
      <td width="115"><table width="360" height="219" border="0" cellpadding="0">
        <tr>
          <td width="154" id="loser_circle" style="background-repeat: no-repeat;">&nbsp;</td>
          <td width="200"><table width="200" height="215" border="0" cellpadding="0" style="color:#FFF">
            <tr>
              <td width="98" height="23" id="theirname">&nbsp;</td>
              </tr>
            <tr>
              <td height="22">Losses</td>
              </tr>
            <tr>
              <td><table width="168" height="104" border="0" cellpadding="0" style="color:#FFF">
                <tr>
                  <td width="59">Cash</td>
                  <td width="103" id="loser_cash">&nbsp;</td>
                  </tr>
                <tr>
                  <td>Cool</td>
                  <td id="loser_cool">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
  </table>
</div>
<div id="fight_page">
        <div id="fighthud">
        <form id="attack_form" name="attack_form" action="attack_arena.php" method="post">
        <table width="750px" height="300"b order="0" cellpadding="0" align="center" style="background-image: url(../graphics/store_bk.png)">
        <tr>
        <td width="550" height="30" id="marksec"><table width="570" style="color:white">
          <tr>
            <td width="187" align="left">User</td>
            <td width="164">Level</td>
            <td width="66">Ranking</td>
            <td width="88">Crew Size</td>
            <td width="41">HIT!</td>
          </tr>
        </table></td>
    <td width="150" align="center" id="gamesec" style="background-image: url(../graphics/store_bk.png); color:white;">Check the Coma Ward UPTOWN</td>
    </tr>
  <tr>
    <td valign="top"><div id="gloves" style="height:300px; overflow:auto"></div></td>
    <td align="center" id="gamesec2" valign="top" style="color:#FFF; background-image: url(../graphics/store_bk.png)"><div id="bet2">
      <p>
        <input type="hidden" id="userid" name="instigator" value="<? echo $user?>"/>
        <input name="submit" type="submit" class="button" id="submit_btn" value="ATTACK" />
        </p>
      </div>
      <div id="fightrules" style="font-size:11px;">Each Attack Costs x3 <img src="http://12daysoffun.com/hustle/file/pic/fbimages/buy_energy_75x75_01.gif" width="17" height="21" />Energy<img src="../../clique/graphics/icon_help_16x16_01.gif" id="fighttip2" title="Every fight costs you 3 energy points. If you lose, you risk more than cash, also reputation or cool points; but if you win you not only gain cash but cool points!" /><br />
        Each  WIN earns <img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/shades_2.png" width="17" height="16" />Cool Points<br />
        Each LOSS costs <img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/shades_2.png" alt="" width="17" height="16" />Cool Points</div></td>
    </tr>
      </table>
      </form>
  </div>
<img id="fight_exit" src="../graphics/exit.gif" /></div>'; break;
	
	case '#manage' : $page = '<div id="manager">
  <div id="manage_pg"><table width="730" border="0" cellpadding="0" align="center">
  <tr>
    <td width="520"><table width="512" height="450" border="0" cellpadding="0">
      <tr>
        <td width="528" height="198" valign="top"><table width="512" height="177" border="0" cellpadding="0" background="../graphics/store_bk_bot.png">
          <tr></tr>
          <tr><div id="playingtip8">&nbsp;</div><div id="playingtip9">&nbsp;</div>
            <td height="25"><div id="manage_header">Manage Your Crew<span class="hope"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="managetip" title="This is your file on each member. Are they making more than they are sharing? If the Flight score is low and (+)positive this indicates the member is active and growing in rank rapidly and adding to your crew overall ranking but if its negative and high they are losing and/or inactive in the game." /></span></div></td>
          </tr>
          <tr>
            <td height="146" valign="top"><div id="fire_shake" style="color:#FFF; font-size:13px;"></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="233"><table width="512" height="138" border="0" cellpadding="0" background="../graphics/store_bk_bot.png">
          <tr>
            <td height="20"><div id="manage_header3" align="left" style="color:#FFF;">New Crew Offers<span class="hope"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="managetip4" title="Earn some cash, by accepting offers to join other crews. If you don&acute;t have any, just means you cool points are too low...hit the arcade to improve or just rob people." /></span></div></td>
            </tr>
          <tr>
            <td valign="top"><form id="cash_offers" name="cash_offers" method="post" action="growth.php">
              <div id="coffers"></div>
              </form></td>
            </tr>
          </table></td>
      </tr>
      </table></td>
    <td width="204" valign="top"><table width="212" height="351" border="0" cellpadding="0">
      <tr>
        <td width="208" height="53" valign="top"><table width="206" border="0" cellpadding="0" background="../graphics/store_bk_bot.png">
          <tr>
            <td><div id="manage_header">You&acute;re Ranked!<span class="hope"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="managetip2" title="This is Your Overall Game Rank decided by your cool points, cash level, crew level, and arcade record." /></span></div></td>
          </tr>
        </table>
          <table width="206" border="0" cellpadding="0" background="../graphics/store_bk_bot.png">
            <tr>
              <td width="75"><div class="minner_text3">Your Rank</div></td>
              <td width="125"><div id="myrank"></div></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="165" valign="top"><table width="210" border="0" cellpadding="0" background="../graphics/store_bk_bot.png">
          <tr>
            <td><div id="manage_header">Your Cash Settings<span class="hope"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="managetip3" title="&acute;NATIONAL WIN SHARE&acute; is how much of your gross earnings from the ARCADE and ROBBERIES you plan to share with all members of your crew. Inner Circle is a bonus you give to the Ride-or-Die members SEE CREW SETTINGS " /></span></div></td>
          </tr>
        </table>
          <form id="share_v" name="share_v" method="post" action="accountant.php">
            <table width="206" border="0" cellpadding="0" background="../graphics/store_bk_bot.png">
              <tr>
                <td width="190" align="right"><label><div class="minner_text">National Win Share
                  <input name="nat_win_share" type="text" id="nat_win_share" value="25" size="5" />
                %</label></div></td>
              </tr>
              <tr>
                <td align="right"><div class="minner_text">National Loss Share
                  <input name="nat_loss_share" type="text" id="nat_loss_share" value="25" size="5" />
%</div></td>
              </tr>
              <tr>
                <td align="right"><div class="minner_text">Inner Circle Win Share
                  <input name="circ_win_share" type="text" id="circ_win_share" value="25" size="5" />
%</div></td>
              </tr>
              <tr>
                <td align="right"><div class="minner_text">Inner Circle Loss Share
                  <input name="circ_loss_share" type="text" id="circ_loss_share" value="25" size="5" />
%</div></td>
              </tr>
            </table>
            <input type="hidden" id="userid" name="leader" value="<? echo $user ?>"/>
            <input type="submit" name="Submit" id="crew_sets" value="Submit" disabled="disabled" />
          </form></td>
      </tr>
      <tr>
        <td valign="top"><table width="206" border="0" cellpadding="0" background="../graphics/store_bk_bot.png">
          <tr>
            <td><div id="manage_header">Your Crew Settings<span class="hope"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="managetip5" title="Setting your Crew Settings to &acute;RIDE OR DIE&acute; means you are going to help all of your crew in robberies and to fend off robbery attempts. SLEEPER means you aren&acute;t helping anyone, and you won&acute;t lose as much cash as the Ride-or-Die members of who are a bit to ambitious in their robbery attempts." /></span></div></td>
          </tr>
        </table>
          <form id="ridedie" name="ridedie" method="post" action="boutit.php">
            <table width="206" border="0" cellpadding="0" background="../graphics/store_bk_bot.png">
              <tr>
                <td align="center"><label>
                  <input type="checkbox" name="rdie" id="rob" value="rob" />
                  Ride or Die
                </label></td>
              </tr>
              <tr>
                <td align="center"><label>
                  <input type="checkbox" name="sleep" id="protect" value="protect" />
                  Sleeper</label></td>
              </tr>
            </table>
            <input type="hidden" id="userid" name="leader" value="<? echo $user ?>"/>
            <div id="rd"></div>
            <input type="submit" name="submit" id="submit" value="Submit" />
          </form></td><div id="conf"></div>
      </tr>
      <tr>
        <td valign="top"><table width="206" border="0" cellpadding="0" background="../graphics/store_bk_bot.png">
          <tr>
            <td><div id="manage_header">DISCIPLINE<span class="hope"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="managetip6" title="Shakedown is a nice way of saying &acute;ROB&acute;, discipline crew members who aren&acute;t sharing money or losing to much money by doing a SHAKEDOWN, if that doesn&acute;t work fire them, but be WARNED you lose cool points when you fire a crew member." /></span></div></td>
          </tr>
        </table>
          <form id="shrinkage" name="shrinkage" method="post" action="desktop.php">
            <table width="206" border="0" cellpadding="0" background="../graphics/store_bk_bot.png">
              <tr>
                <td align="center">Enter the member&acute;s name<input name="member" type="text" size="20" maxlength="35" /></td>
              </tr>
              <tr>
                <td align="center"><span><input type="submit" name="shakedown" id="submit" value="Shakedown" /></span><span><input type="submit" name="fire" id="submit" value="Fire" /></span></td>
              </tr>
            </table>
            <input type="hidden" id="userid" name="leader" value="$user"/>
            <div id="rd"></div>
          </form></td><div id="conf"></div>
      </tr>
    </table></td>
  </tr>
</table>
<span id="b_owner"><img src="../graphics/investment_butt.png" width="107" height="26" /></span><span></span>
</div>
  
</div>'; break;
	
	case '#profile' : $page = '
	<div id="mirror">
		<div id="mytabsmenu" class="tabsmenuclass">
			<ul>
				<li><a id="radio1" rel="gotsubmenu">Initiation</a></li>
				<li><a id="radio10">My Home</a></li>
				<li><a id="radio2" rel="gotsubmenu">News</a></li>
				<li><a id="radio3">Stats</a></li>
				<li><a id="radio4">Trophies</a></li>
				<li><a id="radio5">Avatar</a></li>
				<li><a id="radio6">Comments</a></li>
				<li id="sex_change" style="display:none; color:red; font-weight:bold; ">Switch Sex</li>
			</ul>
		</div>
	</div>
	<div id="profile_sect" style="background-color:white"></div>'; break;

	case '#inventory' : $page = '<div id="inner_page2">
    	<div id="inty_page">
          <div id="binvnty_header">
            <table width="720" border="0" cellpadding="0" align="center">
              <tr>
                <td><table width="725" border="0" cellpadding="0">
                  <tr>
                    <td width="87"><div class="header_color">Weapons</div></td>
                    <td width="355"><div id="totalupkeep">(Total Upkeep:<span class="wup_keep_val" style="color:#F00; font-size:13px"></span>)</div></td>
                    <td width="275" align="center"><table width="253" border="0" cellpadding="0">
                      <tr>
                        <td id="gift_button"><img src="../graphics/gift_butt.png" width="75" height="23" alt="Gift" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="60" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="502" height="59" border="0" cellpadding="0">
                        <tr>
                          <td width="76"><img src="../file/pic/fbimages/fist.png" alt="Fist" /></td>
                          <td width="96" align="center"><div id="item_name">Your Fists</div></td>
                          <td width="317" align="center"><div class="stats_div"><table width="320" border="0" cellpadding="0">
                            <tr>
                              <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 2 Attack</td>
                              <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 2 Defense</td>
                              <td width="134"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> - 1 Cool Points</td>
                            </tr>
                          </table></div></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="83"><img src="../file/pic/fbimages/waterpistol_2.png" alt="Squirt Gun" /></td>
                          <td width="89" align="center"><div id="item_name">Squirt Gun</div></td>
                          <td width="323" align="center"><div class="stats_div"><table width="321" border="0" cellpadding="0">
                            <tr>
                              <td width="80"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 1 Attack</td>
                              <td width="98"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 0 Defense</td>
                              <td width="135"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> - 0 Cool Points</td>
                            </tr>
                          </table></div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$2</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="squirt_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="squirt_gun" name="squirt_gun" method="post" action="upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="$user"/><input type="image" src="../file/pic/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="squirt" name="squirt" value="squirt"/><input type="image" src="../file/pic/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="76"><img src="../file/pic/fbimages/rock.png" alt="Ha!, a Bag of Rocks" /></td>
                          <td width="95" align="center"><div id="item_name">Bag of Rocks</div></td>
                          <td width="325" align="center"><div class="stats_div"><table width="323" height="27" border="0" cellpadding="0">
                            <tr>
                              <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 7 Attack</td>
                              <td width="98"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 7 Defense</td>
                              <td width="136"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> - 2 Cool Points</td>
                            </tr>
                          </table></div></td>
                          <td width="64"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$5</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="rocks_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="rocks" name="rocks" method="post" action="upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td id><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../file/pic/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td id><input type="hidden" id="rocks" name="rocks" value="rocks"/><input type="image" src="../file/pic/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="76"><img src="../file/pic/fbimages/air rifle.png" alt="Air Rifle" /></td>
                          <td width="94" align="center"><div id="item_name">Air Rifle</div></td>
                          <td width="326" align="center"><div class="stats_div">
                            <table width="324" height="23" border="0" cellpadding="0">
                              <tr>
                                <td width="83"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 5 Attack</td>
                                <td width="96"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 6 Defense</td>
                                <td width="137"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> - 10 Cool Points</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="64"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$50</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="bbgun_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="airr" name="airr" method="post" action="upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../file/pic/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="airr" name="airr" value="airr"/><input type="image" src="../file/pic/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="75"><img src="../file/pic/fbimages/knife.png" alt="Knife" /></td>
                          <td width="95" align="center"><div id="item_name">Knife</div></td>
                          <td width="326" align="center"><div class="stats_div"><table width="322" height="30" border="0" cellpadding="0">
                            <tr>
                              <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 10 Attack</td>
                              <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 5 Defense</td>
                              <td width="136"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> - 5 Cool Points</td>
                            </tr>
                          </table></div></td>
                          <td width="64"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$20</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="knife_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="knife" name="knife" method="post" action="upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../file/pic/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="knife" name="knife" value="knife"/><input type="image" src="../file/pic/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="76"><img src="../file/pic/fbimages/baseballbat.png" alt="Wooden Bat" /></td>
                          <td width="94" align="center"><div id="item_name">Baseball Bat</div></td>
                          <td width="326" align="center"><div class="stats_div"><table width="321" border="0" cellpadding="0">
                            <tr>
                              <td width="80"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 12 Attack</td>
                              <td width="95"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 8 Defense</td>
                              <td width="138"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> - 10 Cool Points</td>
                            </tr>
                          </table></div></td>
                          <td width="64"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$20</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="bats_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="bat" name="bat" method="post" action="upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../file/pic/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="bat" name="bat" value="bat"/><input type="image" src="../file/pic/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="75"><img src="../file/pic/fbimages/item_crowbar.gif" alt="Sharp CrowBar" /></td>
                          <td width="89" align="center"><div id="item_name">Crow Bar</div></td>
                          <td width="331" align="center"><div class="stats_div"><table width="322" height="42" border="0" cellpadding="0">
                            <tr>
                              <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 10 Attack</td>
                              <td width="99"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 3 Defense</td>
                              <td width="134"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> - 15 Cool Points</td>
                            </tr>
                          </table></div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$25</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="cbars_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="crowb" name="crowb" method="post" action="upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../file/pic/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="crowb" name="crowb" value="crowb"/><input type="image" src="../file/pic/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
    	</div>
    <div id="next_pg"></div><img id="weapons_shop_exit" src="../graphics/exit.gif" />
</div>'; break;

	case '#inventory_2' : $page = '<div id="inner_page2">
    	<div id="inty_page">
          <div id="binvnty_header">
            <table width="720" border="0" cellpadding="0" align="center">
              <tr>
                <td><table width="725" border="0" cellpadding="0">
                  <tr>
                    <td width="87"><div class="header_color">Weapons</div></td>
                    <td width="355"><div id="totalupkeep">(Total Upkeep:<span class="wup_keep_val" style="color:#F00; font-size:13px"></span>)</div></td>
                    <td width="275" align="center"><table width="253" border="0" cellpadding="0">
                      <tr>
                        <td><div id="inventory_butt2"><img src="../graphics/weapons_button.png" width="75" height="23" alt="Weapons" /></div></td>
                        <td><div id="gift_button2"><img src="../graphics/gift_butt.png" width="75" height="23" alt="Gift" /></div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="60" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="59" border="0" cellpadding="0">
                        <tr>
                          <td width="83"><img src="../file/pic/fbimages/item_tommy.gif" width="75" height="75" /></td>
                          <td width="89" align="center"><div id="item_name">Tommy Gun</div>
                          <p style="color:#F00">$160 Upkeep</p></td>
                          <td width="323" align="center"><div class="stats_div"><table width="320" border="0" cellpadding="0">
                            <tr>
                              <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 25 Attack</td>
                              <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 25 Defense</td>
                              <td width="134"><img src="../graphics/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> - 501 Cool Points</td>
                            </tr>
                          </table></div></td>
                          <td width="65" align="center"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$300</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div">
                                <div id="tommygun_owned"></div>
                              </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="581"><form id="tommygun" name="tommygun" method="post" action="upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="gun" name="gun" value="gun"/>                            <input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="83"><img src="../file/pic/fbimages/item_assualt_rifle.png" width="75" height="75" /></td>
                          <td width="89" align="center"><div id="item_name">Assault&nbsp;Rifle</div>
                          <p style="color:#F00">$100 Upkeep</p></td>
                          <td width="323" align="center"><div class="stats_div"><table width="321" border="0" cellpadding="0">
                            <tr>
                              <td width="80"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 25 Attack</td>
                              <td width="98"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 35 Defense</td>
                              <td width="135"><img src="../graphics/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> - 600 Cool Points</td>
                            </tr>
                          </table></div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$450</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="assaultr_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="assaultr" name="assaultr" method="post" action="upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="arifle" name="arifle" value="arifle"/><input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
			<div id="space_block"></div>
			 <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="60" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="59" border="0" cellpadding="0">
                        <tr>
                          <td width="83"><img src="../file/pic/fbimages/ak47.png" width="75" height="75" /></td>
                          <td width="89" align="center"><div id="item_name">AK-47</div>
                          <p style="color:#F00">$398 Upkeep</p></td>
                          <td width="323" align="center"><div class="stats_div"><table width="320" border="0" cellpadding="0">
                            <tr>
                              <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 111 Attack</td>
                              <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 99 Defense</td>
                              <td width="134"><img src="../graphics/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> - 801 Cool Points</td>
                            </tr>
                          </table></div></td>
                          <td width="65" align="center"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$1500</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div">
                                <div id="ak47_owned"></div>
                              </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="581"><form id="ak47" name="ak47" method="post" action="upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="ak47" name="ak47" value="ak47"/>                            <input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
		  <div id="space_block"></div>
			 <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="60" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="59" border="0" cellpadding="0">
                        <tr>
                          <td width="83"><img src="../file/pic/fbimages/kriss super v.png" width="75" height="75" /></td>
                          <td width="89" align="center"><div id="item_name">Kriss Super V</div>
                          <p style="color:#F00">$100 Upkeep</p></td>
                          <td width="323" align="center"><div class="stats_div"><table width="320" border="0" cellpadding="0">
                            <tr>
                              <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 66 Attack</td>
                              <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 54 Defense</td>
                              <td width="134"><img src="../graphics/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> - 101 Cool Points</td>
                            </tr>
                          </table></div></td>
                          <td width="65" align="center"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$1346</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div">
                                <div id="super_owned"></div>
                              </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="581"><form id="super" name="super" method="post" action="upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="super" name="super" value="super"/>                            <input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
		  <div id="space_block"></div>
			 <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="60" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="59" border="0" cellpadding="0">
                        <tr>
                          <td width="83"><img src="../file/pic/fbimages/grenade.png" width="75" height="75" /></td>
                          <td width="89" align="center"><div id="item_name">Grenade Launcher</div>
                          <p style="color:#F00">$900 Upkeep</p></td>
                          <td width="323" align="center"><div class="stats_div"><table width="320" border="0" cellpadding="0">
                            <tr>
                              <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 160 Attack</td>
                              <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 160 Defense</td>
                              <td width="134"><img src="../graphics/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> - 51 Cool Points</td>
                            </tr>
                          </table></div></td>
                          <td width="65" align="center"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$3000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div">
                                <div id="grenade_owned"></div>
                              </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="581"><form id="grenade" name="grenade" method="post" action="upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="grenade" name="grenade" value="grenade"/>                            <input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
		  <div id="space_block"></div>
			 <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="60" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="59" border="0" cellpadding="0">
                        <tr>
                          <td width="83"><img src="../file/pic/fbimages/sniper.png" width="75" height="75" /></td>
                          <td width="89" align="center"><div id="item_name">.50 Sniper Rifle</div>
                          <p style="color:#F00">$2000 Upkeep</p></td>
                          <td width="323" align="center"><div class="stats_div"><table width="320" border="0" cellpadding="0">
                            <tr>
                              <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 200 Attack</td>
                              <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 160 Defense</td>
                              <td width="134"><img src="../graphics/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /> -50 Cool Points</td>
                            </tr>
                          </table></div></td>
                          <td width="65" align="center"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$13600</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div">
                                <div id="sniper_owned"></div>
                              </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="581"><form id="sniper" name="sniper" method="post" action="upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="sniper" name="sniper" value="sniper"/>                            <input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          </div>        
    	</div></div><img id="weapons_shop_exit2" src="../graphics/exit.gif" />
</div>'; break;
	
	case '#assets' : $page = '<div id="estate1">
    	<div id="assets_page1">
          <div id="binvnty_header">
            <table width="720" border="0" cellpadding="0" align="center">
              <tr>
                <td><table width="725" border="0" cellpadding="0">
                  <tr>
                    <td width="71"><div class="header_color">Assets</div></td>
                    <td width="371"><div class="totalupkeep">(Total Mortgages:<span class="aup_keep_val" style="color:#F00; font-size:13px"></span>)</div></td><div id="playingtip7">&nbsp;</div>
                    <td width="275" align="center"><div class="asset_clr">Your Assets Maintain Your Level<span class="hope"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="assettip" title="Buy ASSETS so your COOL POINTS don&acute;t fluctuate; whatever the cool point value listed is, that is the lowest level your total cool points will drop; that is as long as you can afford it." /></span></div></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="60" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="502" height="59" border="0" cellpadding="0">
                        <tr>
                          <td width="115"><img src="../file/pic/fbimages/parents_basement_75.jpg" width="115" height="60" alt="Parent&acute;s Basement" /></td>
                          <td width="126" align="center"><div id="item_name">Your Parent&acute;s Basement</div></td>
                          <td width="253" align="center"><div class="stats_div"><table width="166" border="0" cellpadding="0">
                            <tr>
                              <td width="20"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /></td>
                              <td width="140">Cool Point Value:<span id="neg_value_color"> -1</span></td>
                              </tr>
                          </table></div></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="115"><img src="../file/pic/fbimages/studio_apartment_75.jpg" width="115" height="60" /></td>
                          <td width="126" align="center"><div id="item_name">Studio Apartment</div>
                          <div id="maint_fee">Upkeep: -$600</div></td>
                          <td width="254" align="center"><div class="stats_div">
                            <table width="166" border="0" cellpadding="0">
                              <tr>
                                <td width="20"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /></td>
                                <td width="140">Cool Point Value: <span class="cp_value_color">1,000</span></td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$9,000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="studio_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="studio" name="studio" method="post" action="realtor.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="sapp" name="sapp" value="sapp"/><input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="112"><img src="../file/pic/fbimages/starter_home_75.jpg" width="112" height="60" /></td>
                          <td width="130" align="center"><div id="item_name">Starter House</div>
                          <div id="maint_fee">Upkeep: -$2,000</div></td>
                          <td width="253" align="center"><div class="stats_div">
                            <table width="166" border="0" cellpadding="0">
                              <tr>
                                <td width="20"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /></td>
                                <td width="140">Cool Point Value: <span class="cp_value_color">1,500</span></td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$2,900</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="house_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="starter" name="starter" method="post" action="realtor.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>


                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="house" name="house" value="house"/><input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="115"><img src="../file/pic/fbimages/lux_apartment_75.jpg" width="115" height="60" /></td>
                          <td width="126" align="center"><div id="item_name">Luxury Apartment</div>
                          <div id="maint_fee">Upkeep: -$3,499</div></td>
                          <td width="254" align="center"><div class="stats_div">
                            <table width="166" border="0" cellpadding="0">
                              <tr>
                                <td width="20"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /></td>
                                <td width="140">Cool Point Value: <span class="cp_value_color">8,000</span></td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$6,590</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="luxapar_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="apartment" name="apartment" method="post" action="realtor.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="luxury" name="luxury" value="luxury"/><input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
                </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="115"><img src="../file/pic/fbimages/condo_75.jpg" width="115" height="60" /></td>
                          <td width="126" align="center"><div id="item_name">Condo</div>
                          <div id="maint_fee">Upkeep: -$5,600</div></td>
                          <td width="252" align="center"><div class="stats_div">
                            <table width="166" border="0" cellpadding="0">
                              <tr>
                                <td width="20"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /></td>
                                <td width="140">Cool Point Value: <span class="cp_value_color">18,400</span></td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="67"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$12,900</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="condo_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="condo" name="condo" method="post" action="realtor.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="hotel" name="hotel" value="hotel"/><input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="115"><img src="../file/pic/fbimages/lux_condo.png" width="115" height="60" /></td>
                          <td width="127" align="center"><div id="item_name">Penthouse</div>
                          <div id="maint_fee">Upkeep: -$15,600</div></td>
                          <td width="251" align="center"><div class="stats_div">
                            <table width="166" border="0" cellpadding="0">
                              <tr>
                                <td width="20"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /></td>
                                <td width="140">Cool Point Value: <span class="cp_value_color">37,000</span></td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="67"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$67,890</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="penthouse_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="pent" name="pent" method="post" action="realtor.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="topfloor" name="topfloor" value="topfloor"/><input type="image" src="../graphics/fbimages/sell_button.png" name="sell"</td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="115"><img src="../file/pic/fbimages/mansion_75.jpg" width="115" height="60" /></td>
                          <td width="127" align="center"><div id="item_name">Mansion</div>
                          <div id="maint_fee">Upkeep: -$23,099</div></td>
                          <td width="237" align="center"><div class="stats_div">
                            <table width="166" border="0" cellpadding="0">
                              <tr>
                                <td width="20" style="padding-left:8px;"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /></td>
                                <td width="140">Cool Point Value: <span class="cp_value_color">52,000</span></td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="81"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color" style="padding-left:18px;">$95,020</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="mansion_owned" style="padding-left:18px;"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="mansion" name="mansion" method="post" action="realtor.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="bighouse" name="bighouse" value="bighouse"/><input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
    	</div>
    <div id="king_button"></div><img id="realtor_exit" src="../graphics/exit.gif" />
</div>'; break;

	case '#assets_2' : $page = '<div id="king">
    	<div id="bassets_pg">
          <div id="binvnty_header">
            <table width="720" border="0" cellpadding="0" align="center">
              <tr>
                <td><table width="725" border="0" cellpadding="0">
                  <tr>
                    <td width="71"><div class="header_color">Assets</div></td>
                    <td width="371"><div class="totalupkeep">(Total Mortgages:<span class="aup_keep_val" style="color:#F00; font-size:13px"></span>)</div></td>
                    <td width="275" align="center"><div class="asset_clr" style="color:#09F">Your Assets Maintain Your Level</div></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="60" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="569" height="59" border="0" cellpadding="0">
                        <tr>
                          <td width="115"><img src="../file/pic/fbimages/palace_75.jpg" width="115" height="62" /></td>
                          <td width="128" align="center"><div id="item_name">Manor</div>
                          <div id="maint_fee">Upkeep: -$53,004</div></td>
                          <td width="252" align="center"><div class="stats_div">
                            <table width="166" border="0" cellpadding="0">
                              <tr>
                                <td width="20"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /></td>
                                <td width="140">Cool Point Value: <span class="cp_value_color">130,000</span></td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="64" align="center"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$750,333</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div">
                                <div id="manor_owned"></div>
                              </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="581"><form id="manor" name="manor" method="post" action="realtor.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="plantation" name="plantation" value="plantation"/><input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="115"><img src="../file/pic/fbimages/lux_mansion_75.jpg" width="115" height="62" /></td>
                          <td width="127" align="center"><div id="item_name">Palace</div>
                          <div id="maint_fee">Upkeep: -$100,000</div></td>
                          <td width="253" align="center"><div class="stats_div">
                            <table width="166" border="0" cellpadding="0">
                              <tr>
                                <td width="20"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /></td>
                                <td width="140">Cool Point Value: <span class="cp_value_color">500,000</span></td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$234,343</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="palace_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="palace" name="palace" method="post" action="realtor.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" name="estate" value="estate"/><input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="112"><img src="../file/pic/fbimages/emperors_palace_75.jpg" width="115" height="62" /></td>
                          <td width="130" align="center"><div id="item_name">Emperor&acute;s Palace</div>
                          <div id="maint_fee">Upkeep: -$150,000</div></td>
                          <td width="253" align="center"><div class="stats_div">
                            <table width="182" border="0" cellpadding="0">
                              <tr>
                                <td width="22"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /></td>
                                <td width="95">Cool Point Value: </td>
                                <td width="57"><span class="cp_value_color">872,000</span></td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$999,000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="emppal_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="emperor" name="emperor" method="post" action="realtor.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="castle" name="castle" value="castle"/><input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="115"><img src="../file/pic/fbimages/item_private_island.jpg" width="115" height="62" /></td>
                          <td width="126" align="center"><div id="item_name">Private Island</div>
                          <div id="maint_fee">Upkeep: -$248,980</div></td>
                          <td width="252" align="center"><div class="stats_div">
                            <table width="182" border="0" cellpadding="0">
                              <tr>
                                <td width="18"><img src="../file/pic/fbimages/shades_2.png" width="17" height="16" alt="Cool Point" /></td>
                                <td width="104">Cool Point Value: </td>
                                <td width="52"><span class="cp_value_color">1,000,000</span></td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="67"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$1,500,000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="isle_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="isle" name="isle" method="post" action="realtor.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="island" name="island" value="island"/><input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
    	</div><img id="realtor_exit2" src="../graphics/exit.gif" />
</div>'; break;

	case '#muscle' : $page = '<div id="muscle_h">
    	<div id="muscle_pg">
          <div id="binvnty_header">
            <table width="720" border="0" cellpadding="0" align="center">
              <tr>
                <td><table width="725" border="0" cellpadding="0">
                  <tr>
                    <td width="71"><div class="header_color">Muscle</div></td>
                    <td width="322"><div class="totalupkeep">(Total Upkeep:<span class="mup_keep_val" style="color:#F00; font-size:13px"></span>)</div></td>
                    <td width="324" align="center"><table width="231" border="0" cellpadding="0">
  <tr>
    <td width="10">&nbsp;</td>
    <td width="10" id="gift_button3"><img src="../graphics/gift_butt.png" width="75" height="23" /></td>
  </tr>
</table>
</td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="60" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="59" border="0" cellpadding="0">
                        <tr>
                          <td width="65"><img src="../file/pic/fbimages/item_security_guard.png" width="63" height="65" /></td>
                          <td width="110" align="center"><div id="item_name">Security Guard</div>
                          <div id="maint_fee">Upkeep: -$1,200</div></td>
                          <td width="320" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td class="hope" width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 8 Attack</td>
                                <td class="hope" width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 8 Defense</td>
                                <div id="playingtip3">&nbsp;</div>
                                <td class="hope" width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Health Bonus" /> 10 Health Bonus<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="muscletip" title="Each security personnel you hire, boosts your total Health per hire by the value listed" /></td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65" align="center"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$16,000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="sguard_owned"></div>
                              </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="581"><form id="sguards" name="sguards" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="sguard" name="sguard" value="Security Guard"/><input type="image" src="../graphics/fbimages/fire_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="70"><img src="../file/pic/fbimages/item_mutt_75.png" width="63" height="65" /></td>
                          <td width="106" align="center"><div id="item_name">Mutt</div>
                          <div id="maint_fee">Upkeep: -$600</div></td>
                          <td width="319" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td class="hope" width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 12 Attack</td>
                                <td class="hope" width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 12 Defense</td>
                                <td class="hope" width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Cool Point" /> +5 Health Bonus</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$3,500</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="mutt_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="mutts" name="mutts" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="mutt" name="mutt" value="mutt"/><input type="image" src="../graphics/fbimages/fire_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="70"><img src="../file/pic/fbimages/item_thug.png" width="54" height="65" /></td>
                          <td width="172" align="center"><div id="item_name">Thug</div>
                          <div id="maint_fee">Upkeep: -$3,000</div></td>
                          <td width="253" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td class="hope" width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 20 Attack</td>
                                <td class="hope" width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 12 Defense</td>
                                <td class="hope" width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Cool Point" /> +10 Health Bonus</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$59,000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="thug_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="thugs" name="thugs" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="thug" name="thug" value="thug"/><input type="image" src="../graphics/fbimages/fire_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="71"><img src="../file/pic/fbimages/body_guard.png" width="63" height="65" /></td>
                          <td width="170" align="center"><div id="item_name">Bodyguard</div>
                          <div id="maint_fee">Upkeep: -$13,000</div></td>
                          <td width="254" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td class="hope" width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 30 Attack</td>
                                <td class="hope" width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 45 Defense</td>
                                <td class="hope" width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Cool Point" /> +15 Health Bonus</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$169,900</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="bguard_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="bguards" name="bguards" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="bguard" name="bguard" value="bguard"/><input type="image" src="../graphics/fbimages/fire_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
                </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="71"><img src="../file/pic/fbimages/gang_75.png" width="63" height="65" /></td>
                          <td width="170" align="center"><div id="item_name">Guns 4 Hire</div>
                          <div id="maint_fee">Upkeep: -$25,000</div></td>
                          <td width="252" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td class="hope" width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 50 Attack</td>
                                <td class="hope" width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 67 Defense</td>
                                <td class="hope" width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Cool Point" /> +25 Health Bonus</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="67"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$109,000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="g4hire_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="g4hires" name="g4hires" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="g4hire" name="g4hire" value="g4hire"/><input type="image" src="../graphics/fbimages/fire_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="72"><img src="../file/pic/fbimages/item_specialist.png" width="63" height="65" /></td>
                          <td width="170" align="center"><div id="item_name">Specialist</div>
                          <div id="maint_fee">Upkeep: -$53,000</div></td>
                          <td width="251" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 90 Attack</td>
                                <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 90 Defense</td>
                                <td width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Cool Point" /> +50 Health Bonus</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="67"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$295,000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="special_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="specials" name="specials" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="special" name="special" value="special"/><input type="image" src="../graphics/fbimages/fire_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="66"><img src="../file/pic/fbimages/future_soldier_75.png" width="63" height="65" /></td>
                          <td width="108" align="center"><div id="item_name">Para-Military</div>
                          <div id="maint_fee">Upkeep: -$130,000</div></td>
                          <td width="323" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td class="hope" width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 120 Attack</td>
                                <td class="hope" width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 155 Defense</td>
                                <td class="hope" width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Cool Point" /> +125 Health Bonus</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="63"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$716,2000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="para_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="paras" name="paras" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="para" name="para" value="para"/><input type="image" src="../graphics/fbimages/fire_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
    	</div>
    <div id="b_next_pg"></div><img id="security_exit" src="../graphics/exit.gif" />
</div>'; break;

	case '#muscle_2' : $page = '<div id="boss">
  <div id="bm">
          <div id="binvnty_header">
            <table width="720" border="0" cellpadding="0" align="center">
              <tr>
                <td><table width="725" border="0" cellpadding="0">
                  <tr>
                    <td width="71"><div class="header_color">Muscle</div></td>
                    <td width="322"><div class="totalupkeep">(Total Salaries:<span class="mup_keep_val" style="color:#F00; font-size:13px"></span>)</div></td>
                    <td width="324" align="center"><table width="231" border="0" cellpadding="0">
  <tr>
    <td width="10" id="inv_muscle3"><img src="../graphics/muscle_butt.png" width="75" height="23" /></td>
    <td width="10" id="gift_button4"><img src="../graphics/gift_butt.png" width="75" height="23" /></td>
  </tr>
</table>
</td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="60" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="59" border="0" cellpadding="0">
                        <tr>
                          <td width="74"><img src="../file/pic/fbimages/image_bounty_hunter_75.jpg" width="63" height="65" /></td>
                          <td width="101" align="center"><div id="item_name">Bounty Hunter</div>
                          <div id="maint_fee">Upkeep: -$99,000</div></td>
                          <td width="320" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 225 Attack</td>
                                <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 0 Defense</td>
                                <td width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Cool Point" /> +900 Health Bonus</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65" align="center"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$500,000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div">
                                <div id="bhunt_owned"></div>
                              </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="581"><form id="bhunts" name="bhunts" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="bhunt" name="bhunt" value="bhunt"/><input type="image" src="../graphics/fbimages/fire_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="70"><img src="../file/pic/fbimages/item_hitman2.png" width="75" height="65" /></td>
                          <td width="106" align="center"><div id="item_name">Hitman</div>
                          <div id="maint_fee">Upkeep: -$100,000</div></td>
                          <td width="319" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 278 Attack</td>
                                <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 0 Defense</td>
                                <td width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Cool Point" /> +1000 Health Bonus</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$503,000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="hitman_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="hitmen" name="hitmen" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="hitman" name="hitman" value="hitman"/><input type="image" src="../graphics/fbimages/sell_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="70"><img src="../file/pic/fbimages/mercenary_75.png" width="63" height="65" /></td>
                          <td width="172" align="center"><div id="item_name">Merc</div>
                          <div id="maint_fee">Upkeep: -$13,000</div></td>
                          <td width="253" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 367 Attack</td>
                                <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 367 Defense</td>
                                <td width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Cool Point" /> +130 Health Bonus</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$59,000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="merc_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="mercs" name="mercs" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="merc" name="merc" value="merc"/><input type="image" src="../graphics/fbimages/fire_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="71"><img src="../file/pic/fbimages/armyoftwo_75.png" width="63" height="65" /></td>
                          <td width="170" align="center"><div id="item_name">Warlords</div>
                          <div id="maint_fee">Upkeep: -$130,000</div></td>
                          <td width="254" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 450 Attack</td>
                                <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 350 Defense</td>
                                <td width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Cool Point" /> +1,300 Health Bonus</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="65"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$339,900</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="war_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="wars" name="wars" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="war" name="war" value="war"/><input type="image" src="../graphics/fbimages/fire_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="66"><img src="../file/pic/fbimages/item_cash_assassin_75.png" width="63" height="65" /></td>
                          <td width="106" align="center"><div id="item_name">Ninja</div>
                          <div id="maint_fee">Upkeep: -$250,000</div></td>
                          <td width="322" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 600 Attack</td>
                                <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 0 Defense</td>
                                <td width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Cool Point" /> +2500 Health Bonus</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="66"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$2,509,000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="ninja_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="ninjas" name="ninjas" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="ninja" name="ninja" value="ninja"/><input type="image" src="../graphics/fbimages/fire_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
          <div id="space_block"></div>
          <div id="inventoryA">
            <div id="invntyA_item">
              <table width="725" border="0" cellpadding="0" align="center" background="http://www.12daysoffun.com/hustle/graphics/store_bk_bot.png">
                <tr>
                  <td width="581"><table width="574" height="67" border="0" cellpadding="0">
                    <tr>
                      <td width="467"><table width="570" height="61" border="0" cellpadding="0">
                        <tr>
                          <td width="72"><img src="../file/pic/fbimages/armykl.jpg" width="63" height="65" /></td>
                          <td width="170" align="center"><div id="item_name">Personal Army</div>
                          <div id="maint_fee">Upkeep: -$1,030,000</div></td>
                          <td width="251" align="center"><div class="stats_div">
                            <table width="320" border="0" cellpadding="0">
                              <tr>
                                <td width="81"><img src="../../clique/graphics/icon-attack.gif" width="13" height="13" alt="Attack" /> 1000 Attack</td>
                                <td width="97"><img src="../../clique/graphics/icon_protect_16x16_01.gif" width="16" height="16" alt="Defense" /> 1000 Defense</td>
                                <td width="134"><img src="../file/pic/fbimages/icon_health_16x16_01.gif" width="17" height="16" alt="Cool Point" /> +10,000 Health Bonus</td>
                              </tr>
                            </table>
                          </div></td>
                          <td width="67"><table width="50" border="0" cellpadding="0">
                            <tr>
                              <td align="center"><div class="value_color">$23,095,000</div></td>
                            </tr>
                            <tr>
                              <td><div class="stats_div"><div id="army_owned"></div></div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="138"><form id="armies" name="armies" method="post" action="mscl_upgrades.php"><table width="100" border="0" cellpadding="0">
                    <tr>
                      <td><select name="order" size="1" id="order">
                        <option>1</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                      </select></td>
                      <td><table width="70" border="0" cellpadding="0">
                        <tr>
                          <td><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input type="image" src="../graphics/fbimages/buy_button.png" name="buynow"></td>
                        </tr>
                        <tr>
                          <td><input type="hidden" id="army" name="army" value="army"/><input type="image" src="../graphics/fbimages/fire_button.png" name="sell"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form></td>
                </tr>
              </table>
            </div>
          </div>
    	</div>
  <div align="center">
    <table width="537" height="77" border="0" cellpadding="0">
      <tr><div id="playingtip4">&nbsp;</div>
        <td height="25" style="font-style:oblique;">Private Hit List<span class="hope"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="pvthittip" title="Now that you&acute;ve made it to the BOSS level, you can carry out secret robberies against whomever you choose, and earn cool points for style whenever you&acute;re not caught! You can only be caught by other bosses(or great ranks) who have hired muscle from this page." /></span></td>
      </tr>
      <tr>
        <td><div align="center">
          <table width="534" height="124" border="0" cellpadding="0">
            <tr>
              <td width="297" valign="top"><div>Heist History<span id="clear_pvt" style="color:#FFF; font-size:13px;"> [Clear History]</span></div>
                <div id="private_l" style="background-color:#FFF; overflow:auto; height:95px; font-size:12px;"></div></td>
              <td width="231"><form id="pvthitlist" name="pvthitlist" method="post" action="private.php">
                <div align="center"><div id="heistresults"></div>
                  <p>Enter Target Name                   </p>
                  <p>
                    <input type="text" name="textfield" id="textfield" />
                    <br />
                    <input type="hidden" id="userid" name="instigator" value="<? echo $user?>"/>
                    <input type="hidden" id="set" name="public" value="<? echo $set?>"/>
                    <input type="submit" name="button" id="pvt_submit" value="Submit" />
                  </p>
                  <div id="rule" style="font-size:12px;">Each Heists Costs x5 <img src="http://12daysoffun.com/hustle/file/pic/fbimages/buy_energy_75x75_01.gif" width="17" height="21" />Energy</div>
                </div>
              </form></td>
              </tr>
            </table>
        </div></td>
      </tr>
    </table>
  </div><img id="security_exit2" src="../graphics/exit.gif" />
</div>'; break;
	
	case '#scores' : $page = '<div id="boards">
  <div id="leaders">
    <div id="title"><img src="http://www.12daysoffun.com/hustle/graphics/lboards.png"/></div>
    <table width="730" border="0" cellpadding="0" align="right">
      <tr>
        <td width="376"><div class="board_headerw">Top 10 Crews</div><table width="320" border="0" cellpadding="0">
  <tr>
    <td>Crew</td>
    <td>Rank</td>
  </tr>
</table>
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div id="top10_c" style="overflow:auto"></div></td>
            </tr>
        </table></td>
        <td width="15">&nbsp;</td>
        <td width="331"><div class="board_header">Bottom 10 Crews</div><table width="320" border="0" cellpadding="0">
  <tr>
    <td>Crew </td>
    <td>Rank</td>
  </tr>
</table>
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div id="bot10_c" style="overflow:auto"></div></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><div class="board_headerw">Top 10 Players</div><table width="320" border="0" cellpadding="0">
  <tr>
    <td align="left"><span style="padding-right:50px">User</span><span style="padding-left:68px;">Rank</span></td>
	<td><div id="suc"></div><span id="offer_error" style="font-size:9px; color:red;"></span></td>
  </tr>
</table>
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div id="top10_p" style="overflow:auto"></div></td>
            </tr>
        </table></td>
        <td>&nbsp;</td>
        <td><div class="board_header">Bottom 10 Players</div><table width="320" border="0" cellpadding="0">
  <tr>
    <td>User</td>
    <td>Rank</td>
  </tr>
</table>
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div id="bot10_p" style="overflow:auto"></div></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><div class="board_headerw">Top 10 Games</div><table width="320" border="0" cellpadding="0">
  <tr>
    <td>#</td>
    <td>Game</td>
  </tr>
</table>
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div id="top10_g" style="overflow:auto"></div></td>
            </tr>
        </table></td>
        <td>&nbsp;</td>
        <td><div class="board_header">Bottom 10 Games</div><table width="320" border="0" cellpadding="0">
  <tr>
    <td>#</td>
    <td>Game</td>
  </tr>
</table>
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div id="bot10_g" style="overflow:auto"></div></td>
            </tr>
        </table></td>
      </tr>
    </table>
  </div><img id="hallofame_exit" src="../graphics/exit.gif" />  
</div>'; break;

	case '#recruit' : $page = '<div id="rooks" style="background-image:url(../file/graphics/hustle_bk_bottom.jpg);">
        <div id="recruiter">        
      <form id="crew_app" name="crew_app" method="post" action="recruiter.php">
      <table width="738" border="0" cellpadding="0" align="center">
  <tr>
    <td width="434" id="marksec"><span class="recruitheader"><b>STEP 1: Scout out some talent</b></span>
      <div id="mark_header"><span class="subhead1">User</span><span id="sublevel">Level</span><span id="subrank">Game Rank</span></div></td>
    <td width="12" align="center" id="gamesec">&nbsp;</td>
    <td width="284" align="center"><span class="ftheader"><b>STEP 2: Enter Your Offer</b></span></td>
  </tr>
  <tr>
    <td><div id="mark_body"></div></td>
    <td align="center" id="gamesec2">&nbsp;</td>
    <td align="center"><div id="bet">
      <p>
        $
        <input name="cashoffer" id="cashoffer" type="text" size="10" maxlength="8" /><br />
        <span class="error" id="offer_error" style="color:#F00; font-size:12px"></span>
        </p>
      <p><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/>
        <input name="submit" type="submit" class="button" id="submit_btn" value="Offer" />
      </p>
    </div>
    <div id="playingtip2">&nbsp;</div>
      <div id="fightrules">        Each  Offer acceptance earns <img src="../graphics/fbimages/shades_2.png" width="17" height="16" />Cool Points<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="recruittip" title="Grow your crew wisely, you need quality crew members to earn you big cash, every accepted offer earns you cool points. Remember, bigger offers, gets the attention of real talent." /></div><div id="suc"></div></td>
  </tr>
      </table>
      </form>

  </div><table><tr><td><span style="padding-right:130px"><img id="recruit_building_exit" src="../graphics/exit.gif" /></span></td><td><div style="padding-top:10px;"><img src="../graphics/worthy_words.png" width="358" height="12" /><br/><span><a href="inviter.php"><img src="../graphics/recruit.png" width="169" height="32" /></a></span></div></td></tr></table>
</div>'; break;

	case '#gift_opt' : $page = '<div id="gifts">

<div id="giftshop">
  <form id="gifs" name="gifs" method="post" action="giftshop.php">
      <table width="738" height="302" border="0" align="center" cellpadding="0">
        <tr>
    <td width="355" id="giftsec"><b style="font-size:20px; color:#00F">Gifting</b>
      <div id="mark_header" style="font-size:13px"><b>Reward your profitable crew members</b></div></td>
    <td width="142" align="center" id="gamesec">&nbsp;</td>
    <td width="233" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-size:14px; color:#FFF;"><b>Choose a Gift</b></td>
    <td align="center" id="gamesec2" style="font-size:14px; color:#000;"><b>Select a member</b></td>
    <td align="center"><div id="bet">
      <p style="font-size:14px; color:#000;">&nbsp;</p>
    </div></td>
  </tr>
  <tr>
    <td><table width="365" height="272" border="0" cellpadding="0" align="center">
      <tr>
        <td width="120"><div id="weapon_row" style="overflow:auto; height:272px;"></div></td>
        <td width="120"><div id="muscle_row" style="overflow:auto; height:272px;"></div></td>
        <td width="120"><div id="asset_row" style="overflow:auto; height:272px;"></div></td>
      </tr>
    </table></td>
    <td align="center"><div id="c_members" style="overflow:auto; height:272px;"></div></td>
    <td align="center"><div id="gift_card"></div>
      Amount
      <input name="quantity" type="text" size="11" /><div id="bet2">
      <p><input type="hidden" id="userid" name="giver" value="<? echo $user?>"/><input type="image" src="../file/pic/fbimages/send_gift_button.png" name="sendnow"/>
      </p>
    </div>
    <div id="playingtip5">&nbsp;</div>
      <div id="giftrules" style="font-size:13px; color:#000;"><b>Each Gift sents earns <img src="../graphics/fbimages/shades_2.png" alt="Cool ic" width="17" height="16" />Cool Points</b><span class="hope"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="gifttip" title="As your crew members earn you cash and cool points realize they can leave you at any time, just like you can fire them at any time; reward the profitable members of your crew to keep them earning you cash." /></span></div></td>
  </tr>
      </table>
      </form>

  </div><img id="gift_shop_exit" src="../graphics/exit.gif" />
</div>'; break;

	case '#hit_opt' : $page = '<div id="heist">
<div id="hithud">        
      
      <table width="672" border="0" cellpadding="0" align="center">
        <tr>
          <div id="playingtip6">&nbsp;</div>
          <td width="374" id="targetsec"><span class="ftheader"><b style="color:#FFF; font-size:15px;">HIT LIST</b></span><span class="hope"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="publichittip2" title="This is an easy way to make some cash...just click HEIST and get the bounty plus any other money you win by defeating the MARK. Once a gamer is placed on the HIT LIST, they can be robbed by anyone at anytime, but only once." /></span>
            <div id="target_header"><span id="subhead">User</span><span id="sublevel"> Level</span><span id="subrank"> Bounty</span></div></td>
          <td width="292" align="center"><span class="ftheader"><b style="font-size:14px;">OR: Add a name to the list</b></span>
          </td>
        </tr>
        <tr>
          <td><form id="hit_form" name="hit_form" method="post"  action="warroom.php">
    <div id="target_body" style="height:272px; width:300; overflow:auto;"></div></form></td>
          <td align="center"><div id="hit_results" style="display:none"></div><form id="bad_guy" name="bad_guy" method="post" action="hitadder.php"><div id="bet">
            <div id="hit_status"></div><p>Target 
              <input name="target" id="target" type="text" size="20" maxlength="30" />
            </p>
            <p>Bounty$
              <input name="bounty" type="text" id="bounty" size="20" maxlength="11" />
            </p>
            <p>
              <input type="hidden" id="userid" name="instigator" value="<? echo $user?>"/>
              <input name="submit" type="submit" value="SUBMIT" />
            </p>
          </div></form>
            <div id="hitrules" style="font-size:12px">Each Hit Request Costs x7 <img src="http://12daysoffun.com/hustle/file/pic/fbimages/buy_energy_75x75_01.gif" alt="" width="17" height="21" />Energy<span class="hope"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="publichittip" title="Take your revenge against anyone who has robbed you in the arcade or you just dont care for; enter a player&acute;s name and put a bounty on them, but it will cost you." /></span><br />
              COST -15,000 <img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/shades_2.png" alt="" width="17" height="16" />Cool Points</div></td>
        </tr>
      </table>
  </div><img id="hit_shop_exit" src="../graphics/exit.gif" />
</div>'; break;

	case '#casino_page' : $page = '<div id="rooks" style="background-image:url(../file/graphics/hustle_bk_bottom.jpg);>
  <table width="747" height="347" border="0" cellpadding="0">
    <tr>
      <td width="703" valign="top"><table width="663" border="0" cellpadding="0" style="color:#FFF">
  <tr>
    <td width="166" align="left">Casino<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="casinotip1" title="Invest in a casino to get paid hourly." /></td>
    <td width="291" align="left">Jackpot<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="casinotip2" title="The odds of you winning the posted JACKPOT go up the higher your score in any particular game within the casino." /></td>
	<td width="198" style="color:black;">Patron List<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="casinotip3" title="View everyone in a particular establishment at a particular time, each attack costs you 4 energy." /></td>
  </tr>
</table>
<div id="casino_list" style="overflow:auto;overflow:auto; background-image:url(../graphics/gray_bk_bot.png);"></div>
</td>
      <td width="220">&nbsp;<div id="output" style="display:none;"></div></td>
    </tr>
  </table>
  <div id="patron_actions" align="center"><span id="purchase_casino"><img src="../graphics/p_casino.png" width="138" height="28" /></span></div><img id="casino_building_exit" src="../graphics/exit.gif" /></div>'; break;

	case '#club_page' : $page = '<div id="rooks" style="background-image:url(../file/graphics/hustle_bk_bottom.jpg);>
  <table width="747" height="347" border="0" cellpadding="0">
    <tr>
      <td width="703" valign="top"><table width="651" border="0" cellpadding="0" style="color:#FFF">
  <tr>
    <td width="173" align="left">Club<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="clubtip" title="Invest in a night club to recieve hourly income, beyond what your crew earns you." /></td>
    <td width="138" align="left">Cool Bonus<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="coolclubtip" title="Recieve a boost to your Cool Points for every club you enter, the higher ranked the club the more cool points it will give you for entering." /></td>
    <td width="220" align="left">Entry&nbsp;Fee</td>
	<td width="109" style="color:black;">Patron List<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="casinotip3" title="View everyone in a particular establishment at a particular time, each attack costs you 4 energy." /></td>
  </tr>
</table>
<div id="club_list" style="overflow:auto; background-image:url(../graphics/gray_bk_bot.png);"></div>
</td>
      <td width="138" valign="bottom"><div id="output" style="display:none;"></div><div id="lobby"><img src="../graphics/lobby_button2.png" width="82" height="31" /></div></td>
    </tr>
  </table>

  <div id="patron_actions" align="center"><span id="purchase_club"><img src="../graphics/p_club.png" width="138" height="28" /></span></div><img id="club_building_exit" src="../graphics/exit.gif" />
</div>'; break;
	
	case '#bank_page' : $page = '<div id="banks">
  <div id="banktitle" align="center" style="background-color:#000"><img src="../graphics/bankobliss.png" width="138" height="28" /></div>
  <table width="747" height="347" border="0" cellpadding="0">
    <tr>
      <td width="429" valign="top" align="center"><table width="340" height="30" border="0" cellpadding="0" style="font-size:14px; font-weight: bold;">
        <tr>
          <td width="117" style="background-image: url(../graphics/gray_bk_bot.png)">Fees<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="banktip2" title="It&acute;s better to own a business" /></td>
          <td width="224" style="background-image: url(../graphics/gray_bk_bot.png)"><p>8% Deposit Fee for Legit&acute; Patrons</p>
		  <p>20% Deposit Fee for all others</p></td>
        </tr>
        </table>
        <p align="center"><form id="bankaccount" name="account" method="post" action="bankteller.php"><input type="image" src="../graphics/bank_oaccount.png" name="oaccount" /><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="banktip3" title="It&acute;s $500 to open an account; Can&acute;t get robbed if you have no cash on you" /></form></p>
        <table width="343" height="31" border="0" cellpadding="0" align="center" style="font-size:14px; font-weight: bold;">
  <tr>
    <td width="165" style="background-image: url(../graphics/gray_bk_bot.png)"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="banktip4" title="This is how much money you can withdraw from the bank" />My Current Balance =</td>
    <td width="172" style="background-image: url(../graphics/gray_bk_bot.png); color: #FFF" align="center" id="mybal"></td>
  </tr>
  </table></p><table width="0" border="0" cellpadding="0">
  <tr>
    <td><table width="0" border="0" cellpadding="0" style="background-image: url(../graphics/gray_bk_bot.png); font-size:14px">
          <tr align="center">
            <td><form id="bankdeposit" name="deposit" method="post" action="bankteller.php">
      <p>
        <label><strong>Deposit Amount</strong><br />
          <input name="in" type="text" id="in" size="12" />.00
        </label></p>
        <input type="hidden" id="userid" name="customer" value="<? echo $user?>"/>
      <input type="image" src="../graphics/bank_deposit.png" name="deposit" />
      </p>
            </form></td>
          </tr>
      </table></td>
    <td><table width="0" border="0" cellpadding="0" style="background-image: url(../graphics/gray_bk_bot.png); font-size:14px">
          <tr align="center">
            <td><form id="bankwithdraw" name="withdraw" method="post" action="bankteller.php">
      <p>
        <label><strong>Withdrawal Amount</strong><br />
          <input name="out" type="text" id="out" size="12" />.00
        </label></p>
        <input type="hidden" id="userid" name="customer" value="<? echo $user?>"/>
        <input type="image" src="../graphics/bank_withdraw.png" name="take"></p>
</form></td>
          </tr>
      </table></td>
  </tr>
</table>        
      </td>
      <td width="312"><div id="output" style="display:none;"></div> <table width="275" border="0" cellpadding="0" style="font-size:14px; font-weight: bold;">
  <tr>
    <td width="101">Cash on Hand<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="banktip" title="Amount of Cash Bliss Bank has inbetween Money Train pickups." /></td>
    <td width="168" id="bank_cash" style="color:white"></td>
  </tr>
  <tr>
    <td>Bank Assets<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="banktip1" title="This is the total mortgages, fees, properties the bank has and you invest in" /></td>
    <td id="bank_assets" style="color:white"></td>
  </tr>
</table>
<p align="center"><img src="../graphics/bankvault.png"/></p>
      <div id="bankjob">
        <p align="center"><img id="robus" src="../graphics/bankrob_butt.png"/><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="banktip6" title="You&acute;ll need 6 people, at least one of you smart and a getaway car...that&acute;s if you succeed." /></p>
      </div></td>
    </tr>
  </table>
  <table><tr><td><span style="padding-right:230px"><img id="bank_building_exit" src="../graphics/exit.gif" /></span></td><td><div id="actions" align="center"><span id="ownbank"><form id="bankinvest" name="account" method="post" action="bankteller.php"><input type="image" src="../graphics/bankinvest_butt.png" name="invest" /><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="banktip5" title="Invest in the bank to recieve hourly income, beyond what your crew earns you, the assets the bank has the more you earn" /></form></span></div></td></tr></table>
</div>'; break;

	case '#race_page' : $page = '<div id="rooks" style="background-image:url(../file/graphics/long_bk.jpg); height:440px">
  <div align="center"><img src="../graphics/chopshop_sign.png" width="178" height="58" /></div><form method="post" id="raceway" action="vroom.php">
  <table width="747" height="265" border="0" cellpadding="0" style="background-image:url(../graphics/store_bk.png);">
    <tr>
      <td width="688" height="250" valign="top"><table width="651" border="0" cellpadding="0" style="color:#FFF">
  <tr>
    <td width="243" align="left">Race<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="racetip" title="Beat a series of skill challenges before time runs out; losers of PinkSlip Races also lose their car" /></td>
    <td width="132" align="left">Entry&nbsp;Fee</td>
    <td width="156" align="left">Time Limit</td>
	<td width="110" style="color:black;">Cash Prize<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="racetip3" title="Beat the time, win the prize" /></td>
  </tr>
</table>
<div id="race_list" style="overflow:auto; background-image:url(../graphics/gray_bk_bot.png);"><table width="688" height="216" border="0" cellpadding="0">
  <tr>
    <td width="242" style="font-size:12px" align="center"><img src="../graphics/northstar.png" width="197" height="41" /><div align="center">(3 Legs)</div></td>
    <td width="135" bgcolor="#FF0000" align="center" style="color:#FFF">$50</td>
    <td width="154" bgcolor="#FFFF00" align="center">14 min</td>
    <td width="112" bgcolor="#00CC00" align="center">$150</td>
    <td width="33"><label>
      <input type="radio" name="radio" id="radio" value="1" />
    </label></td>
  </tr>
  <tr>
    <td style="font-size:12px" align="center"><img src="../graphics/tourub_g.png" width="197" height="41" /><div align="center">(4 Legs)</div></td>
    <td bgcolor="#FF0000" align="center" style="color:#FFF">$100</td>
    <td bgcolor="#FFFF00" align="center">12 min</td>
    <td bgcolor="#00CC00" align="center">$600</td>
    <td><input type="radio" name="radio" id="radio2" value="2" /></td>
  </tr>
  <tr>
    <td style="font-size:12px" align="center"><img src="../graphics/oceanic.png" width="197" height="41" /><div align="center">(5 Legs)</div></td>
    <td bgcolor="#FF0000" align="center" style="color:#FFF">$200</td>
    <td bgcolor="#FFFF00" align="center">10 min</td>
    <td bgcolor="#00CC00" align="center">$1050</td>
    <td><input type="radio" name="radio" id="radio3" value="3" /></td>
  </tr>
  <tr>
    <td style="font-size:12px" align="center"><img src="../graphics/hilldrop.png" width="197" height="41" /><div align="center">(6 Legs)</div></td>
    <td bgcolor="#FF0000" align="center" style="color:#FFF">$350<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="racetip2" title="Lose this race, lose your car" /></td>
    <td bgcolor="#FFFF00" align="center">9 min</td>
    <td bgcolor="#00CC00" align="center">$2400</td>
    <td><input type="radio" name="radio" id="radio4" value="4" /></td>
  </tr>
  <tr>
    <td style="font-size:12px" align="center" background="../graphics/jailbreak.jpg"><img src="../graphics/deadman.png" width="197" height="41" />      <div align="center" style="color:#FFF">(6 Legs)</div></td>
    <td bgcolor="#FF0000" align="center" style="color:#FFF">$500<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="racetip2" title="Lose this race, lose your car" /></td>
    <td bgcolor="#FFFF00" align="center">5 min</td>
    <td bgcolor="#00CC00" align="center">$5000</td>
    <td><input type="radio" name="radio" id="radio5" value="5" /></td>
  </tr>
</table>
</div>
</td>
      <td width="53" valign="middle"><input type="hidden" id="userid" name="customer" value="<? echo $user?>"/><input name="submit" type="submit" value="Race!" />Requires 3<img src="http://12daysoffun.com/hustle/file/pic/fbimages/buy_energy_75x75_01.gif" width="17" height="21" /> Energy</td>
    </tr>
  </table></form><div id="engines" style="display:none;"></div>

  <table><tr><td><span style="padding-right:230px"><img id="race_track_exit" src="../graphics/exit.gif" /></span></td><td><div id="patron_actions" align="center"><span id="purchase_car"><img src="../graphics/buy_car.png" /></span></div></td></tr></table>
</div>'; break;

	case '#drag_race' : $page = '<div id="fight_page">
        <div id="fighthud">
        <form id="race_form" name="race_form" action="dragrace.php" method="post"> 
        <table width="738" border="0" cellpadding="0" align="center">
        <tr>
        <td width="357" id="marksec"><span class="ftheader"><b>STEP 1: Choose the Mark</b></span>
      <div id="mark_header"><span id="subhead">User</span><span id="subhead">Crew</span><span id="sublevel">Level</span><span id="subrank">Game Rank</span></div></td>
    <td width="171" align="center" id="gamesec"><span class="ftheader"><b>STEP 2: Choose Your Race<img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="racetip6" title="Be Careful each race is a pinkslip race, so you lose you lose your car to your opponent." /></b></span></td>
    <td width="202" align="center"><span class="ftheader"><b>STEP 3: Enter Your Wager</b></span></td>
  </tr>
  <tr>
    <td><div id="body_mark" style="overflow:auto; color:white;"></div></td>
    <td align="center" id="gamesec2" valign="top" style="color:#FFF"><div id="arena" style=" color:#000; background-color:#00F">
      <p>
        <label>
        NorthStar | $50  Fee</label>
        <input type="radio" name="game" value="1"/>
      </p>
	  <p>
        <label>
        Tourub G | $100  Fee</label>
        <input type="radio" name="game" value="2"/>
	  </p>
	  <p>
        <label>
        Oceanic | $200 Fee</label>
        <input type="radio" name="game" value="3"/>
	  </p>
      <p>
        <label>
        HillDrop | $350 Fee</label>
        <input type="radio" name="game" value="4"/>
      </p>
      <p>
        <label>
        Deadman</label>
        &acute;s Mile | $500 Fee
        <input type="radio" name="game" value="5"/>
      </p>
    </div></td>
    <td align="center"><div id="bet">
      <p>
        $
        <input name="wager" id="wager" type="text" size="10" maxlength="8" />.00<br />
        <span class="error" id="wager_error" style="color:#F00; font-size:12px;"></span>
        </p>
        <!-- the tooltip --> 
        <div id="playingtip">&nbsp;</div>
      <div id="manage_header">Playing...<img src="../../clique/graphics/icon_help_16x16_01.gif" id="racetip" title="If you feel your score and time will be enough to win the wager, select FAIR. Play DIRTY if you don&acute;t mind robbing the player of valuables at the end of the contest; keep in mind your crew,muscle, and weapons have to be stronger than your opponent&acute;s and you risk losing cool points playing DIRTY." /></div>
      <p>
      <label><input type="radio" name="radio" id="radio" value="attack"/>
                  Dirty</label>
                  <label><br>
                    <input type="radio" name="radio" id="radio" value="defend" />
                  Fair</label>
      <p>
        <input type="hidden" id="userid" name="instigator" value="<? echo $user?>"/>
        <input name="submit" type="submit" class="button" id="submit_btn" value="Submit" />
      </p>
    </div>
    
      <div id="driverules">Each Challenge Costs x3 <img src="http://12daysoffun.com/hustle/file/pic/fbimages/buy_energy_75x75_01.gif" width="17" height="21" />Energy<img src="../../clique/graphics/icon_help_16x16_01.gif" id="racetip2" title="Every race costs you 3 energy points. If you lose, you risk more than cash, also reputation or cool points; but if you win, fairly, you not only gain cash but cool points!" /><br />
        Each  WIN earns <img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/shades_2.png" width="17" height="16" />Cool Points<br />
        Each LOSS costs <img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/shades_2.png" alt="" width="17" height="16" />Cool Points</div></td>
  </tr>
      </table>
      </form>
  </div><img id="race_track_exit" src="../graphics/exit.gif" />
</div><div id="play" style="display:none"></div>'; break;

	case '#train_page' : $page = $train; break;
//Internal Pages
	case '#stats' : $page = '<table width="720" height="689" border="0" align="center" cellpadding="0"style="background-image:url(../file/graphics/long_bk.jpg);">
      <tr>
        <td width="394" valign="top"><div id="Stats_tab"><table width="393" border="0" cellpadding="0">
  <tr>
    <td id="stats_upper_header"><img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/stats.png" width="120" height="12" /></td>
  </tr>
</table>
            <table width="393" border="0" cellpadding="0" id="stats_table">
              <tr>
                <td width="300">Challenges (Won/Lost)</td>
                <td width="87"><span id="ch_won"></span>/<span id="ch_lost"></span></td>
              </tr>
              <tr>
                <td>Times You Were Fired </td>
                <td><span id="fired_stat"></span></td>
              </tr>
              <tr>
                <td>Total Members Fired</td>
                <td><span id="shrink_rate"></span></td>
              </tr>
              <tr>
                <td>Heists (Successes/Failures)</td>
                <td><span id="heists_good"></span>/<span id="heists_bad"></span></td>
              </tr>
              <tr>
                <td>Robbery Attempts (Successes/Failures)</td>
                <td><span id="rob_good"></span>/<span id="rob_bad"></span></td>
              </tr>
              <tr>
                <td>Times Robbed</td>
                <td><span id="times_robbed_stat"></span></td>
              </tr>
              <tr>
                <td>Your Rank</td>
                <td><span id="yrank_stat"></span></td>
              </tr>
              <tr>
                <td>Your Rank Flight Score</td>
                <td><span id="yrankfc_stat"></span></td>
              </tr>
              <tr>
                <td>Your Crew Rank</td>
                <td><span id="ycrank_stat"></span></td>
              </tr>
              <tr>
                <td>Your Crew Rank Flight Score</td>
                <td><span id="ycrankfs_stat"></span></td>
              </tr>
            </table>
        </div>
        <div id="finances_tab">
          <table width="393" border="0" cellpadding="0">
            <tr>
              <td id="fin_u_header">Finances</td>
            </tr>
          </table>
          <table width="393" border="0" cellpadding="0" id="finance_table">
            <tr>
              <td width="296">Total Income</td>
              <td width="91"><div id="gross_stat" style="color:#FFF"></div></td>
            </tr>
            <tr>
              <td>Total Upkeep</td>
              <td><div id="upkeep" style="color:#0CF">-</div></td>
            </tr>
            <tr>
              <td>Cash Flow</td>
              <td><div id="cashflow" style="color:#FFF"></div></td>
            </tr>
          </table>
        </div>
        <div id="spacer"></div>
        <div id="weapons_tab">
          <table width="393" border="0" cellpadding="0">
            <tr>
              <td id="weapon_header">Weapons</td>
            </tr>
          </table>
          <div id="weapons_hud" style="overflow:auto;"></div>
        </div></td>
        <td width="320" valign="top" style="padding-left:30px;"><div id="achieve_table">
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div class="achievementupdate_box" style="width: 310px;">
                <div class="tab_box_header" style="height: 35px">
                  <div class="tab" style="padding-top: 8px">
                    <div class="tab_start"> &nbsp; </div>
                    <div class="tab_middle"><table width="120" border="0" cellpadding="0">
  <tr>
    <td><img src="../../clique/graphics/icon_achievement_12x16_01.gif" width="12" height="16" /></td>
    <td><img src="../graphics/achievements.png" width="110" height="21" /></td>
  </tr>
                    </table>
                      
                      <table width="120" border="0" cellpadding="0">
                        <tr> </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="tab_box_content">
                  <div class="achievement_updates" style="overflow:auto; padding-left:5px;"></div>
                </div>
              </div></td>
            </tr>
          </table>
        </div>
        <div id="finances_tab">
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td id="assets_header">Assets</td>
            </tr>
          </table>
          <div id="assets_hud" style="overflow:auto;"></div>
        </div>
        <div id="muscle_tab">
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td id="muscle_header">Muscle</td>
            </tr>
          </table>
          <div id="muscle_hud" style="overflow:auto;"></div>
        </div></td>
      </tr>
    </table>
  </div>'; break;

	case '#init' : $page = '<div id="topwords"><div style="color:#FC0; font-size:18px">Initiation Progress:<span id="init_num"></span></div></div>
  <div id="init_pbar"><div id="startp_bar" style="overflow: hidden; text-align:left; float: left; height:30px; width: 0%;">&nbsp;</div></div>
  <div id="init_tleft" style="color:#FC0; font-size:14px">Time Remaining:<div id="time_rem_num" style="font-size:16px; color:#FFF"></div></div>
  <div id="init_goal" style="color:#FC0; font-size:14px">Reward Point Bonus:<div id="xtra_points" style="font-size:16px; color:#FFF">25</div></div>
  <div id="area_title" style="font-weight:100; font-size:14px" align="center"><strong>Areas:</strong><span id="area_notice">0 out of 21</span></div>
  <div id="robbery_title" style="font-weight:100; font-size:14px" align="center"><strong>Robberies:</strong><span id="rob_notice"> 0 out of 20</span></div>
  <div id="archus_title" style="font-weight:100; font-size:14px" align="center"><strong>Hustles:</strong><span id="arc_notice"> 0 out of 10</span></div>
  <div id="chhus_title" style="font-weight:100; font-size:14px" align="center"><strong>Races:</strong><span id="race_notice"> 0 out of 10</span></div>
  <div id="att_title" style="font-weight:100; font-size:14px" align="center"><strong>Attacks:</strong><span id="attack_notice"> 0 out of 10</span></div>
  <div id="myinv_title" style="font-weight:100; font-size:14px" align="center"><strong>Investments:</strong><span id="invest_notice"> 0 out of 2</span></div>
   <div id="myacct_title" style="font-weight:100; font-size:14px" align="center"><strong>Accounts:</strong><span id="account_notice"> 0 out of 1</span></div>
<img src="../file/tutorials/lisa_page_1.jpg" width="749" height="192" />
<div id="firstsale" style="display:none"><table width="703" border="0" cellpadding="0" align="center">
<tr><td width="94">  </td></tr>
  <tr>
  	<td>Extra Time:</td>
    <td width="307" style="font-size:14px"><strong>Damn you been away too long...get it together already</strong></td>
    <td width="249" align="center"><img id="moretimesale" src="../graphics/moretime_butt.png" width="214" height="33" /></td>
  </tr>
</table>
</div>
<div><p style="margin-left:90px;">Do these things to complete your Initiation:</p>
<table height="750px" width="750px" border="0" cellpadding="0" align="center" style="color:white;
	background-image:url(../file/tutorials/lisa_back.jpg);background-repeat: no-repeat;">
  <tr>
    <td width="128"><img src="../graphics/map.png" width="127" height="119" /></td>
    <td width="406"><table width="249" border="0" cellpadding="0">
      <tr>
        <td width="245" height="28"><table width="244" border="0" cellpadding="0">
  <tr>
    <td width="181">Roam The City Freely</td>
    <td width="57" align="right"><img src="../../clique/graphics/icon_help_16x16_01.gif" id="tuttip" title="Knowing your way around the City of Bliss is pivotal to game success" /></td>
  </tr>
</table></td>
      </tr>
      <tr>
        <td><div class="container_bar"><div id="tour_bar" style="overflow: hidden; text-align:left; float: left; width: 0%;">&nbsp;</div></div></td>
      </tr>
    </table></td>
    <td width="98"><div id="doareas"><img src="../graphics/domission.png" width="107" height="26" /></div></td>
  </tr>
  <tr>
    <td><img src="../graphics/robbed_icon2.png" width="127" height="119" /></td>
    <td><table width="249" border="0" cellpadding="0">
      <tr>
        <td width="245"><table width="244" border="0" cellpadding="0">
          <tr>
            <td width="181">20 Robberies</td>
            <td width="57" align="right"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="tuttip2" title="One of many ways to stack your paper in the Hustle" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><div class="container_bar"><div id="rob_bar" style="overflow: hidden; text-align:left; float: left; width: 0%;">&nbsp;</div></div></td>
      </tr>
    </table></td>
    <td><div id="dorob"><img src="../graphics/domission.png" alt="" width="107" height="26" /></div></td>
  </tr>
  <tr>
    <td><img src="../graphics/arcade_icon2.png" width="127" height="119" /></td>
    <td><table width="249" border="0" cellpadding="0">
      <tr>
        <td width="245"><table width="244" border="0" cellpadding="0">
          <tr>
            <td width="181">10 Arcade Hustles</td>
            <td width="57" align="right"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="tuttip3" title="The arcade is a gold mine once you figure out which games you&acute;re good at" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><div class="container_bar"><div id="archus_bar" style="overflow: hidden; text-align:left; float: left; width: 0%;">&nbsp;</div></div></td>
      </tr>
    </table></td>
    <td><div id="doarcade"><img src="../graphics/domission.png" alt="" width="107" height="26" /></div></td>
  </tr>
  <tr>
    <td><img src="../graphics/drag_race.png" width="127" height="119" /></td>
    <td><table width="249" border="0" cellpadding="0">
      <tr>
        <td width="245"><table width="244" border="0" cellpadding="0">
          <tr>
            <td width="181">10 Chop Shop Hustles</td>
            <td width="57" align="right"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="tuttip4" title="Drag Racing is the name of the game" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><div class="container_bar"><div id="chhus_bar" style="overflow: hidden; text-align:left; float: left; width: 0%;">&nbsp;</div></div></td>
      </tr>
    </table></td>
    <td><div id="dorace"><img src="../graphics/domission.png" alt="" width="107" height="26" /></div></td>
  </tr>
  <tr>
    <td><img src="../graphics/attack_icon.png" width="127" height="119" /></td>
    <td><table width="249" border="0" cellpadding="0">
      <tr>
        <td width="245"><table width="244" border="0" cellpadding="0">
          <tr>
            <td width="181">10 Attacks</td>
            <td width="57" align="right"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="tuttip5" title="Get out there and shine on a few crews, but ahh word to the wise bigger crews will crush you..." /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><div class="container_bar"><div id="attack_bar" style="overflow: hidden; text-align:left; float: left; width: 0%;">&nbsp;</div></div></td>
      </tr>
    </table></td>
    <td><div id="doattack"><img src="../graphics/domission.png" alt="" width="107" height="26" /></div></td>
  </tr>
  <tr>
    <td><img src="../graphics/invest_icon.png" width="127" height="119" /></td>
    <td><table width="249" border="0" cellpadding="0">
      <tr>
        <td width="245"><table width="244" border="0" cellpadding="0">
          <tr>
            <td width="181">2 Investments</td>
            <td width="57" align="right"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="tuttip6" title="You need regular cash so invest in a business" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><div class="container_bar"><div id="invest_bar" style="overflow: hidden; text-align:left; float: left; width: 0%;">&nbsp;</div></div></td>
      </tr>
    </table></td>
    <td><div id="doinvest"><img src="../graphics/domission.png" alt="" width="107" height="26" /></div></td>
  </tr>
  <tr>
    <td><img src="../graphics/vault_icon.png" width="127" height="119" /></td>
    <td><table width="249" border="0" cellpadding="0">
      <tr>
        <td width="245"><table width="244" border="0" cellpadding="0">
          <tr>
            <td width="181">Open a Bank Account</td>
            <td width="57" align="right"><img src="../../clique/graphics/icon_help_16x16_01.gif" alt="" id="tuttip7" title="Your money can&acute;t be stolen if ain&acute;t on you..." /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><div class="container_bar"><div id="bank_bar" style="overflow: hidden; text-align:left; float: left; width: 0%;">&nbsp;</div></div></td>
      </tr>
    </table></td>
    <td><div id="doaccount"><img src="../graphics/domission.png" alt="" width="107" height="26" /></div></td>
  </tr>
</table>
</div>'; break;

	case '#news' : $page = '<div id="newsy">
<div "invitations" style="display:none">Someone has Invited you to their crew. View and Accept.</div><div align="center">
<table width="0" border="0" cellpadding="0" align="center" style="background-image: url(../graphics/store_bk.png);">
  <tr>
    <td><div><img src="../file/graphics/news_backgrounds.jpg" width="355" height="176" /></div></td>
    <td><img src="../file/graphics/gifts_backgrounds.jpg" width="180" height="176" /></td>
  </tr>
  <tr>
    <td align="left" id="commentarea"><div id="sum" style="display:none"></div>
    <div id="mytabsmenu" class="tabsmenuclassA">
<ul>
<li><a id="radio7" title="Give the Hustle Community your 2 cents!">Public</a></li>
<li><a id="radio8" title="Communicate with members of your crew">My Crew</a></li>
<li><a id="radio9" title="...while you were away">Attacks</a></li>
</ul>
</div>
<div id="shout_area"><form method="post" id="public_shout" action="../shoutbox/shoutbox.php">
		<table>
			<tr>
				<td style="color:white"><label>MESSAGE</label></td>
				<td><input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
				<input type="hidden" name="action" value="insert"/>
                <input type="text" id="two_cents" name="message" MAXLENGTH="160" /> <input type="submit" value="Shout it!" /></td>
			</tr>
		</table></form>
        <div id="shout_container">
		<span class="shout_clear"></span>
		<div class="shout_content" style="height:200px; overflow:auto">
			<h1>Latest Messages</h1>
			<div id="shout_loading"><img src="loading.gif" alt="Loading..." /></div>
			<ul id="messagelist">
			<ul>
		</div>
	</div></div></td>
    <td valign="top"><img src="../file/graphics/avatars_back.jpg" /></td>
  </tr>
</table></div>'; break;

	case '#pshout' : $page = '<form method="post" id="public_shout" action="../shoutbox/shoutbox.php">
		<table>
			<tr>
				<td style="color:white"><label>MESSAGE</label></td>
				<td><input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
				<input type="hidden" name="action" value="insert"/>
                <input type="text" id="two_cents" name="message" MAXLENGTH="160" /> <input type="submit" value="Shout it!" /></td>
			</tr>
		</table></form>
        <div id="shout_container">
		<span class="shout_clear"></span>
		<div class="shout_content" style="height:200px; overflow:auto">
			<h1>Rants & Raves</h1>
			<div id="shout_loading"><img src="loading.gif" alt="Loading..." /></div>
			<ul id="messagelist">
			<ul>
		</div>
	</div>'; break;

	case '#cshout' : $page = '<form method="post" id="crew_shout" action="../shoutbox/shoutbox.php">
		<table>
			<tr>
				<td style="color:white"><label>MESSAGE</label></td>
				<td><input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
				<input type="hidden" name="action" value="insert"/>
				<input type="hidden" name="action" value="crew"/>
                <input type="text" id="two_cents" name="message" MAXLENGTH="160" /> <input type="submit" value="Shout it!" /></td>
			</tr>
		</table></form>
        <div id="shout_container">
		<span class="shout_clear"></span>
		<div class="shout_content" style="height:200px; overflow:auto">
			<h1>My Crew Messages</h1>
			<div id="shout_loading"><img src="loading.gif" alt="Loading..." /></div>
			<ul id="messagelist">
			<ul>
		</div>
	</div>'; break;
	
	case '#ashout' : $page = '<span class="tab_clear">[Clear All News]<img src="../../clique/graphics/icon_help_16x16_01.gif" id="newstip56" title="Check here often, arcade results, hit notices, challenges, gifts and more all appear below!" /></span></td>
        <div id="shout_container">
		<span class="shout_clear"></span>
		<div class="shout_content" style="height:200px; overflow:auto">
			<h1>Attacks</h1>
			<div id="shout_loading"><img src="loading.gif" alt="Loading..." /></div>
			<ul id="h_news">
			<ul>
		</div>
	</div>'; break;
	
	case '#comments' : $page = '<div id="newsy">
	<table width="750px">
        <tr style="background-image: url(../graphics/store_bk.png); color:white;">
            <td><div align="left"><strong><h1>Crew   Comments</h1></strong></div>
                  <div align="left">Crew Comments will be broadcast to your entire   crew. Comments made on this page will show up on your crew members&acute; Crew   Comments page. All comments are free. Check here often for news from your crew!</div></td>
                  </tr>
				  <tr></tr>
                  <tr style="background-image: url(../graphics/store_bk.png);">
                  <td><form method="post" id="crew_shout" action="../shoutbox/shoutbox.php">
            <table align="center">
                <tr>
                    <td style="color:white"><label>MESSAGE</label></td>
                    <td><input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                    <input type="hidden" name="action" value="insert"/>
                    <input type="hidden" name="action" value="crew"/>
                    <input type="text" id="two_cents" name="message" MAXLENGTH="160" /> <input type="submit" value="Shout it!" /></td>
                </tr>
            </table></form>
            <div id="shout_container">
            <span class="shout_clear"></span>
            <div class="shout_content" style="height:200px; overflow:auto">
                <h1>My Crew Messages</h1>
                <div id="shout_loading"><img src="loading.gif" alt="Loading..." /></div>
                <ul id="messagelist">
                <ul>
            </div>
        </div></td>
        </tr>
    </table>
</div>'; break;

	case '#m_avatar' : $page = '<script src="../../../Scripts/swfobject_modified.js" type="text/javascript"></script>
<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="750" height="500">
  <param name="movie" value="../graphics/avatar/male_setup.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="opaque" />
  <param name="swfversion" value="6.0.65.0" />
  <param name="FlashVars" value="userName=permadi&score=80">
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
  <param name="expressinstall" value="../../../Scripts/expressInstall.swf" />
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="../graphics/avatar/male_setup.swf" width="750" height="500" FlashVars="userName=permadi&score=80">
    <!--<![endif]-->
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="6.0.65.0" />
	<param name="FlashVars" value="userName=permadi&score=80">
    <param name="expressinstall" value="../../../Scripts/expressInstall.swf" />
    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
    <div>
      <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>
<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
</script>'; break;

	case '#f_avatar' : $page = '<script src="../../../Scripts/swfobject_modified.js" type="text/javascript"></script>
<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="750" height="500">
  <param name="movie" value="../graphics/avatar/female_setup.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="opaque" />
  <param name="swfversion" value="6.0.65.0" />
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
  <param name="expressinstall" value="../../../Scripts/expressInstall.swf" />
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="../graphics/avatar/female_setup.swf" width="750" height="500">
    <!--<![endif]-->
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="6.0.65.0" />
    <param name="expressinstall" value="../../../Scripts/expressInstall.swf" />
    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
    <div>
      <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>
<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
</script>'; break;
	
	case '#backyard' : $page = '<div><table width="749" border="0" cellpadding="0" background="../realestate/3D Wooden Wall.jpg">
  <tr>
    <td><table width="749" border="0" cellpadding="0">
      <tr>
        <td><table width="749" border="0" cellpadding="0">
          <tr>
            <td width="401" id="avatar_house" align="center"><img src="http://www.12daysoffun.com/hustle/graphics/avatar/jermongreen.png" alt=""/></td>
            <td width="342" align="center"><table width="323" height="113" border="0" cellpadding="0">
              <tr>
                <td width="319" height="54" align="center"><img src="../realestate/influence_title.jpg" width="322" height="54" /></td>
              </tr>
              <tr>
                <td align="center"><div id="city_influences"><table width="333" height="202" border="0" cellpadding="0">
  <tr>
    <td height="117"><table width="163" height="116" border="0" cellpadding="0">
      <tr>
        <td height="25" bgcolor="#000000"><table width="161" border="0" cellpadding="0">
          <tr>
            <td><img src="../file/graphics/north_side.jpg" width="95" height="18" /></td>
            <td style="color:#FFF">10%</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="162" border="0" cellpadding="0">
  <tr>
    <td id="my_north_butt"><img src="../graphics/prop_tab.png" alt="" width="95" height="18" /></td>
  </tr>
  <tr>
    <td id="north_side_bar">&nbsp;</td>
  </tr>
</table>
</td>
      </tr>
    </table></td>
    <td><table width="165" height="116" border="0" cellpadding="0">
      <tr>
        <td height="21" bgcolor="#000000"><table width="161" border="0" cellpadding="0">
          <tr>
            <td><img src="../file/graphics/east_side.jpg" alt="" width="95" height="18" /></td>
            <td style="color:#FFF">0%</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="162" border="0" cellpadding="0">
          <tr>
            <td id="my_east_butt"><img src="../graphics/prop_tab.png" alt="" width="95" height="18" /></td>
          </tr>
          <tr>
            <td id="east_side_bar">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="165" height="116" border="0" cellpadding="0">
      <tr>
        <td height="26" bgcolor="#000000"><table width="161" border="0" cellpadding="0">
          <tr>
            <td height="22"><img src="../file/graphics/middle_side.jpg" alt="" width="95" height="18" /></td>
            <td style="color:#FFF">70%</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="162" border="0" cellpadding="0">
          <tr>
            <td id="my_midtown_butt"><img src="../graphics/prop_tab.png" alt="" width="95" height="18" /></td>
          </tr>
          <tr>
            <td id="mid_town_bar">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td><table width="165" height="116" border="0" cellpadding="0">
      <tr>
        <td height="26" bgcolor="#000000"><table width="161" border="0" cellpadding="0">
          <tr>
            <td><img src="../file/graphics/down_side.jpg" alt="" width="95" height="18" /></td>
            <td style="color:#FFF">0%</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="162" border="0" cellpadding="0">
          <tr>
            <td id="my_downtown_butt"><img src="../graphics/prop_tab.png" alt="" width="95" height="18" /></td>
          </tr>
          <tr>
            <td id="down_town_bar">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</div></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="747" border="0" cellpadding="0">
          <tr>
            <td width="402" align="center"><table width="407" border="0" cellpadding="0">
              <tr>
                <td width="96" id="my_mirror_butt" align="left"><img src="../realestate/house_button.jpg" /></td>
                <td width="203" align="center"><img src="../realestate/skills_button.jpg" id="my_skillset_butt" title="View Your skills" /></td>
                <td width="100">&nbsp;</td>
              </tr>
            </table></td>
            <td width="324"><table width="331" border="0" cellpadding="0">
  <tr>
    <td width="95"><img src="../realestate/deeds_ticker_title.jpg" width="95" height="28" title="Purchase Deeds to Expand Your Influence" /></td>
    <td width="221"><div id="deed_ticker"></div></td>
  </tr>
</table>
</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>'; break;
}

echo $page;
?>
