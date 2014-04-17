<?php 
require_once("OpenLogin.php");
foreach($_POST as $key => $value){
echo "key: $key; value: $value<br />\n";
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<script src="http://static.new.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<head>
	<meta charset="UTF-8" />
	<title>The Hustle</title>
<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  
<script type="text/javascript" src="js/jquery.history.js"></script>
<script type="text/javascript" src="js/jquery.livequery.js"></script>
<script type="text/javascript" src="js/arcade.js"></script>
    
	
	<style>
img {
	border: none;
}
#header {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	height: 98px;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/hustle_bk.png);
	padding-bottom: 0.01em;
	background-repeat: no-repeat;
}
#header #external {
	height: 38px;
}
#header #cash_cp {
	height: 20px;
	text-align: right;
	padding-top: 5px;
}
#header #level {
	height: 14px;
	font-size: 0.9em;
	text-align: right;
}
#header #energy {
	height: 15px;
}
#header #external #instructions {
	width: 250px;
	float: right;
}
#header #external #instructions #redirects {
	font-size: 0.7em;
	color: #FC0;
	padding-top: 5px;
	font-weight: bold;
}
#header #external #instructions #redirects #privacypolicy {
	width: 100px;
	display: inline;
	border-right-style: solid;
	border-right-width: 1px;
	border-right-color: #999;
	border-left-color: #CCC;
	padding-right: 2px;
}
#header #external #instructions #redirects #support {
	width: 50px;
	display: inline;
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #999;
	padding-right: 2px;
}
#header #external #instructions #redirects #terms {
	width: 30px;
	display: inline;
	padding-right: 2px;
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #999;
}
#header #external #instructions #redirects #forums {
	width: 45px;
	display: inline;
}
#header #cash_cp #cp_stat {
	color: #009;
	width: 208px;
	float: right;
	text-align: center;
	font-size: .79em;
}
#header #cash_cp #cash_stat {
	color: #060;
	width: 130px;
	font-size: .79em;
	float: right;
	text-align: center;
}
#header #level #level_number_stat {
	width: 15px;
	color: #FFF;
	text-align: center;
	float:right;
	margin-right:150px;
	font-size: 0.65em;
	font-weight: bold;
	overflow: hidden;
}
#wrapper #header #level #clock {
	width: 62px;
	font-size: 0.61em;
	color: #FFF;
	text-decoration: blink;
	margin-left: 475px;
	font-weight: bold;
}
#header #energy #nav_bar {
	width: 275px;
	margin-left: 120px;
}
#header #energy #nav_bar #inventory_butt {
	width: 72px;
	float: right;
	text-align: center;
}
#header #energy #nav_bar #store_section #points #reward_points {
	font-size: 0.73em;
	color: #FC0;
	font-weight: bold;
	vertical-align: top;
}
#header #energy #nav_bar #store_section #points {
	width: 45px;
	float: right;
	vertical-align: top;
}
#header #energy #nav_bar #store_section #store_butt {
	width: 52px;
	float: right;
}
#header #energy #nav_bar #invite_butt {
	width: 52px;
	float: right;
}
#header #energy #nav_bar #home_butt {
	width: 52px;
	float: right;
}
#header #energy #energy_stat {
	color: #FFF;
	width: 131px;
	font-size: 0.76em;
	float: right;
	text-align: center;
}
#header #energy #level_label {
	font-size: 0.76em;
	color: #FFF;
	width: 95px;
	float: right;
	text-align: center;
}
#header #energy #c_rank {
	width: 110px;
	color: #FFF;
	font-size: .76em;
	float: right;
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
	background: url(images/ajax-loader.gif) no-repeat center center;
	height:100px;
	display:none;
}
#wrapper #body .body #content #inner_page {
	background: url(http://www.12daysoffun.com/hustle/graphics/hustle_bk_bottom.png) no-repeat;
	height: 402px;
	width: 750px;
	margin-right: auto;
	margin-left: 1px;
}
#inner_page2 {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/longer_bk.png);
	height: 712px;
}
#inner_page2 #store_page #consumables {
	font-weight: bold;
	color: #FFF;
	font-size: 0.8em;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#inner_page2 #store_page #bundles {
	font-weight: bold;
	color: #FFF;
	font-size: 0.8em;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#inner_page2 #store_page #paypal {
	font-size: 0.9em;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#inner_page2 #store_page {
	padding-top: 25px;
}
#inner_page2 #store_page #consumables table tr td #ncn_image {
}
#inner_page2 #store_page #store_header table tr td table tr td #header_label {
	border-bottom-width: thin;
	border-bottom-color: #03C;
}
#inner_page2 #store_page #space_block {
	height: 10px;
}
#inner_page2 #store_page #store_header table tr td table tr td #header_label tr td {
	color: #F00;
	font-weight: bold;
}
#inner_page2 #store_page #store_header table tr td table tr td table tr td {
	font-size: 14px;
	color: #FFF;
}
.payterms {
	color: #00F;
	font-weight: bold;
}
#inner_page2 #store_page #paypal #form1 table tr td table tr td table tr td {
	color: #FFF;
}
-->
#practice_button {
	width: 268px;
}
#fight_button {
	width: 268px;
	margin-left: 70.5px;
	margin-right: 70.5px;
}
#manage_button {
	width: auto;
	margin-left: 140px;
}
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
	background-image: url(http://12daysoffun.com/hustle/graphics/tab_left_6x27_01.gif);
}

.tab_box_header .tab_middle {
	float: left;
	height: 27px;
	width:auto;
	padding-left:5px;
	padding-right:10px;
	padding-top: 2px;
	background-image: url(http://12daysoffun.com/hustle/graphics/tab_middle_1x27_01.gif);
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
	background-image: url(http://www.12daysoffun.com/hustle/graphics/tab_right_13x27_01.gif);
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
	width: 300px;
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
#earners
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
#low_display #drain {
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
	width: 72px;
	background-repeat: no-repeat;
}


#top_display #header {
	background-color:#000;
	color: #FFF;
	height: 23px;
	width: 72px;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/topearner_header.png);
}
#top_display #cash_cow {
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
#hidden {
}
-->arcade
#countrydivcontainer{
	border:1px solid gray; 
	width:715px; 
	height:280px; 
	margin-bottom: 1em; 
	padding: 10px;
	background-image:url(../graphics/gray_bk_bot.png)
}
.tabcontentiframe{
height: 280px !important;
}
-->
-->scores
#inner_page2 #leaders #title {
	color: #00F;
	padding-left: 5px;
	font-weight: bold;
}
#inner_page2 #leaders table tr td .board_header {
	font-size: 18px;
	font-weight: bold;
}
#inner_page2 #leaders table tr td .board_headerw {
	color: #FFF;
	font-size: 18px;
	font-weight: bolder;
}
#inner_page2 #leaders table tr td table tr td #top10_c {
	overflow: scroll;
	height: 150px;
}
#inner_page2 #leaders table tr td table tr td #bot10_c {
	overflow: scroll;
	height: 150px;
}
#inner_page2 #leaders table tr td table tr td #top10_p {
	overflow: scroll;
	height: 150px;
}
#inner_page2 #leaders table tr td table tr td #bot10_p {
	overflow: scroll;
	height: 150px;
}
#inner_page2 #leaders table tr td table tr td #top10_g {
	overflow: scroll;
	height: 150px;
}
#inner_page2 #leaders table tr td table tr td #bot10_g {
	overflow: scroll;
	height: 150px;
}
-->manage
#inner_page2 #manage_pg table tr td table tr td table tr td #manage_header {
	color: #FFF;
	font-size: 16px;
	width: 170px;
	font-weight: bold;
}
#inner_page2 #manage_pg table tr td table tr td table tr td #manage_header2 {
	font-size: 16px;
	font-weight: bold;
	color: #FFF;
}
#inner_page2 #manage_pg table tr td table tr td table tr td .minner_text {
	font-size: 14px;
	color: #FFF;
	width: 206px;
}
#inner_page2 #manage_pg table tr td table tr td table tr td .minner_text3 {
	font-size: 14px;
	color: #FFF;
}
#inner_page2 #manage_pg table tr td table tr td table tr td #yrank_stat {
	font-size: 13px;
	color: #CCC;
	font-weight: bold;
}
#inner_page2 #manage_pg table tr td table tr td table tr td #yorank_stat {
	font-size: 13px;
	color: #999;
	font-weight: bold;
}
#inner_page2 #manage_pg table tr td table tr td table tr td #fire_shake {
	height: 167px;
	overflow: scroll;
}
#inner_page2 #manage_pg table tr td table tr td table tr td form #quitter {
	overflow: scroll;
	height: 146px;
}
#inner_page2 #manage_pg table tr td table tr td table tr td #manage_header3 {
}
#inner_page2 #manage_pg table tr td table tr td table tr td form #coffers {
	height: 160px;
	overflow: scroll;
}
#inner_page2 #manage_pg table tr td table tr td table tr td form #new_offers {
}

-->profile
#bigger {
	font-size: 24px;
	color: #FF0;
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #FFF;
	height: 34px;
}
#inner_page2 #profile_sect table tr td #Stats_tab #stats_table {
	font-size: 13px;
	color: #CCC;
	height: 231px;
}
#inner_page2 #profile_sect table tr td #finances_tab table tr #fin_u_header {
	color: #FFF;
	border-bottom-width: thin;
	border-bottom-style: solid;

	border-bottom-color: #FFF;
	font-size: 21px;
}
#inner_page2 #profile_sect table tr td #finances_tab #finance_table {
	font-size: 13px;
	color: #CCC;
}
#inner_page2 #profile_sect table tr td #weapons_tab table tr #weapon_header {
	color: #FFF;
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #FFF;
	font-size: 21px;
}

#inner_page2 #profile_sect table tr td #muscle_tab table tr #muscle_header {
	color: #333;
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #333;
	font-size: 21px;
}
#inner_page2 #profile_sect table tr td #finances_tab table tr #assets_header {
	color: #333;
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #333;
	font-size: 21px;
}
#inner_page2 #profile_sect table tr td #Stats_tab {
	padding-bottom: 24px;
}
#inner_page2 #profile_sect table tr td #weapons_tab #weapons_hud {
	overflow: scroll;
	height: 150px;
}
#inner_page2 #profile_sect table tr td #spacer {
	height: 95px;
}
#inner_page2 #profile_sect table tr td #muscle_tab #muscle_hud {
	overflow: scroll;
	height: 151px;
}
#inner_page2 #profile_sect table tr td #finances_tab #assets_hud {
	overflow: scroll;
	height: 151px;
}
-->
.achievement_updates {
	height: 183px;
	margin-left: 10px;
	margin-right: 10px;
	overflow:auto;
}
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
	background-image: url(http://12daysoffun.com/hustle/graphics/tab_left_6x27_01.gif);
}

.tab_box_header .tab_middle {
	float: left;
	height: 27px;
	width:auto;
	padding-left:5px;
	padding-right:10px;
	padding-top: 2px;
	background-image: url(http://12daysoffun.com/hustle/graphics/tab_middle_1x27_01.gif);
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
	background-image: url(http://www.12daysoffun.com/hustle/graphics/tab_right_13x27_01.gif);
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

.achievementupdate_box {
	width: 300px;
	float: left;
	overflow-x: hidden;
}

.achievementprofile_box {
	width: 200px;
	margin-left:10px;
	float:left;
}

.achievement_updates {
	height: 230px;
	margin-left: 10px;
	margin-right: 10px;
	overflow:scroll;
	font-size: 10px;
	color: #FFF;
}
.achievementupdate_box {
	width: 500px;
	float: left;
	overflow-x: hidden;
}
.tab {	float: left;
}
.tab_box_content {
	background-color:#111111;
	border:solid 1px #666666;
}
.tab_box_header {	height:27px; 
	overflow:hidden;
}
.tab_clear {	float: left;
	width: auto;
	padding-top: 5px;
	font-size: 12px;
}
-->assets A
#inner_page2 #next_pg {
	width: 720px;
	margin-right: auto;
	margin-left: auto;
}
#inner_page2 #assets_page {
}
#inner_page2 #assets_page #space_block {
	height: 6px;
}
#maint_fee {
	color: #F00;
}
td .asset_clr {
	color: #000;
	font-size:small;
}
#neg_value_color {
	color: #F00;
}
#inner_page2 #store_page #inventoryA {
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#inner_page2 #assets_page #inventoryA #invntyA_item {
}
#inner_page2 #assets_page #inventoryA #invntyA_item table tr td table tr td table tr td .stats_div {
	color: #FFF;
	font-size:smaller;
}
#inner_page2 #assets_page #binvnty_header table tr td table tr td #totalupkeep {
	color: #000;
}
#inner_page2 #assets_page #binvnty_header table tr td table tr td .header_color {
	color: #FFF;
}
table tr td table tr td #totalupkeep #upkeep_val {
	color: #F00;
}
#inner_page2 #assets_page #inventoryA #invntyA_item table tr td table tr td table tr td table tr td .value_color {
	color: #030;
}
#inner_page2 #assets_page #inventoryA #invntyA_item table tr td table tr td table tr td #item_name {
	color: #FFF;
	font-size:smaller;
}
.cp_value_color {
	color: #FF0;
}
-->assets B
-->inventory
#inner_page2 #next_pg {
	width: 720px;
	margin-right: auto;
	margin-left: auto;
	visibility: hidden;
}
#inner_page2 #inty_page {
}
#inner_page2 #inty_page #space_block {
	height: 4px;
}
#inner_page2 #store_page #inventoryA {
	font-size: 0.6em;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#inner_page2 #inty_page #inventoryA #invntyA_item {
	font-size: .7em;
}
#inner_page2 #inty_page #inventoryA #invntyA_item table tr td table tr td table tr td .stats_div {
	color: #FFF;
}
#inner_page2 #inty_page #binvnty_header table tr td table tr td #totalupkeep {
	font-size: 14px;
	font-weight: bolder;
	color: #000;
}
#inner_page2 #inty_page #binvnty_header table tr td table tr td .header_color {
	font-weight: bolder;
	color: #FFF;
}
table tr td table tr td #totalupkeep #upkeep_val {
	color: #F00;
}
#inner_page2 #inty_page #inventoryA #invntyA_item table tr td table tr td table tr td table tr td .value_color {
	color: #030;
	font-weight: bolder;
}
#inner_page2 #inty_page #inventoryA #invntyA_item table tr td table tr td table tr td #item_name {
	font-size: 14px;
	font-weight: bolder;
	color: #FFF;
}
-->Recruit
#inner_page #fighthud table tr td #mark_header #subhead {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 33px;
	padding-left: 8px;
}
#inner_page #fighthud #fight_form table tr #marksec #mark_header .subhead1 {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 33px;
	padding-left: 8px;
}
#inner_page #fighthud #fight_form table tr #marksec .recruitheader {
	font-size: 16px;
	font-weight: bolder;
	color: #FFF;
}
#inner_page #fighthud #fight_form table tr td #bet {
	width: 175px;
	background-image: url(../graphics/store_bk_bot.png);
	margin-right: auto;
	margin-left: auto;
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
	padding-right: 8px;
	padding-left: 85px;
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
-->Muscle
#inner_page2 #muscle_pg {
}
#inner_page2 #muscle_pg #space_block {
	height: 4px;
}
#maint_fee {
	color: #F00;
	font-size: 9px;
}
td .asset_clr {
	font-size: 9px;
	color: #000;
}
#inner_page2 #store_page #inventoryA {
	font-size: 9px;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#inner_page2 #muscle_pg #inventoryA #invntyA_item {
	font-size: .9em;
}
#inner_page2 #muscle_pg #inventoryA #invntyA_item table tr td table tr td table tr td .stats_div {
	color: #FFF;
	font-size: 0.9em;
}
#inner_page2 #muscle_pg #binvnty_header table tr td table tr td #totalupkeep {
	font-size: 12px;
	color: #000;
}
#inner_page2 #muscle_pg #binvnty_header table tr td table tr td .header_color {
	color: #FFF;
	font-weight:bold;
}
table tr td table tr td #totalupkeep #upkeep_val {
	color: #F00;
}
#inner_page2 #muscle_pg #inventoryA #invntyA_item table tr td table tr td table tr td table tr td .value_color {
	color: #030;
	font-size: 11px;
}
#inner_page2 #muscle_pg #inventoryA #invntyA_item table tr td table tr td table tr td #item_name {
	font-size: 12px;
	font-weight:bold;
	color: #FFF;
}
.hope{
	font-size:12px;
}
-->
    </style>
<script src="../SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

/***********************************************
* Dynamic Ajax Content- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var bustcachevar=1 //bust potential caching of external pages after initial request? (1=yes, 0=no)
var loadedobjects=""
var rootdomain="http://"+window.location.hostname
var bustcacheparameter=""

function ajaxpage(url, containerid){
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
document.getElementById(containerid).innerHTML='<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr></<tr><tr></<tr><td width="2%" align="center"><img src="images/ajax-loader.gif" alt="LoadingData"/></td></tr></table>'
$("#example").hide();
$("#content").show();
page_request.onreadystatechange=function(){
loadpage(page_request, containerid)
}

if (bustcachevar) //if bust caching of external page
bustcacheparameter=(url.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
page_request.open('GET', url+bustcacheparameter, true)
page_request.send(null)
}

function loadpage(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML=page_request.responseText
}

function loadobjs(){
if (!document.getElementById)
return
for (i=0; i<arguments.length; i++){
var file=arguments[i]
var fileref=""
if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
if (file.indexOf(".js")!=-1){ //If object is a js file
fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript");
fileref.setAttribute("src", file);
}
else if (file.indexOf(".css")!=-1){ //If object is a css file
fileref=document.createElement("link")
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", file);
}
}
if (fileref!=""){
document.getElementsByTagName("head").item(0).appendChild(fileref)
loadedobjects+=file+" " //Remember this object as being already added to page
}
}
}

</script>  
  
</head>

<body style="margin:0;">
<div id="hidden"><?php echo $user; ?></div>
<a name="verytop" id="verytop"></a>
<script type="text/javascript">
			
$.post("example.php", {},
   function(data){
	   $('#hidden').hide();
	  var htmlStr = $("#hidden").html();

$.post("smgtrack_ajax.php", {data: htmlStr}, function(results) {
											 var user_cool = results.cool;
											 var user_stage = results.stage;
											 var user_token = results.token;
											 var user_energy = results.energy;
											 var user_cool_max = results.cool_max;
											 var user_energy_max = results.energy_max;
											 var user_cash = results.cash; 
											 var user_crew_rank = results.crew_rank;
											 var user_level_label = results.level_label;
											 var user_cash_cow = results.cash_cow;
											 var user_cow_earns = results.cow_earns;
											 var user_drain = results.cash_drain;
											 var user_drain_losses = results.drain_loss;
									 $('#u_cool').append(user_cool);
									 $('#ucool_max').append(user_cool_max);
									 $('#dollar_val').append(user_cash);
									 $('#level_number_stat').append(user_stage);
									 $('#u_energy').append(user_energy);
									 $('#uenergy_max').append(user_energy_max);
									 $('#level_label').append(user_level_label);
									 $('#c_rank').append(user_crew_rank);
									 $('#reward_points').append(user_token);
									 $('#cash_cow').append('<img src=" http://www.12daysoffun.com/hustle/file/pic/user/' + user_cash_cow + '"/>');
									 $('#profits').append(user_cow_earns);
									 $('#drain').append('<img src=" http://www.12daysoffun.com/hustle/file/pic/user/' + user_drain + '"/>');
									 $('#losses').append(user_drain_losses);
													  
									}, "json");	

   });
</script>
<div id="wrapper">
	<div id="header">
  		<div id="external">
    		<div class="header" id="instructions">
      			<div id="redirects">
        			<div id="privacypolicy">PrivacyPolicy</div>
        			<div id="support">Support</div>
        			<div id="terms">ToS</div>
        			<div id="forums">Forums</div>
      			</div>
    		</div>
  		</div>
  		<div id="cash_cp">
    		<div id="cp_stat"><span id="u_cool"></span>/<span id="ucool_max"></span></div>
    		<div id="cash_stat"><span id="dollar_sign">$</span><span id="dollar_val"></span></div>
  		</div>
        <div id="level">
        	<div id="level_number_stat"></div>
        	<div id="clock"></div>
        </div>
 		<div id="energy"><table width="340" border="0" cellpadding="0" align="right">
  <tr>
    <td><div id="energy_stat"><span id="u_energy"></span>/<span id="uenergy_max"></span></div></td>
    <td><div id="level_label"></div> </td>
    <td><div id="c_rank"></div></td>
  </tr>
</table>

          <div id="nav_bar">
            <div id="inventory_butt"><a href="javascript:ajaxpage('inventory.php?user=<? echo $user ?>', 'content');"><img src="http://www.12daysoffun.com/hustle/graphics/inventory_button.png" width="69" height="11" alt="Inventory" /></a></div>
            <div id="store_section">
            <div id="points"><span id="reward_points"></span><span><img src="http://www.12daysoffun.com/hustle/graphics/tokens_1.png" width="19" height="19" alt="reward points" /></span></div>
            <div id="store_butt"><a href="javascript:ajaxpage('store.php?user=<? echo $user ?>', 'content');"><img src="http://www.12daysoffun.com/hustle/graphics/store_button.png" width="41" height="11" alt="Get a quick boost!" /></a></div>
      	</div>
      	<div id="invite_butt"><a href="inviter.php"><img src="http://www.12daysoffun.com/hustle/graphics/invite_button.png" width="40" height="11" alt="Invite fresh blood!" /></a></div>      
      	<div id="home_butt"><a href="start.php"><img src="http://www.12daysoffun.com/hustle/graphics/home_button.png" width="36" height="11" alt="Home" /></a></div>
    	</div>
  </div>
</div>
<div class="loading"></div>
    <div id="body">
        <div class="body">
            <div id="content">
                <!-- Ajax Content -->
                <div id="inner_page">
          			<div id="home_page">
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
                          <span class="player_updates" style=" height: 183px; margin-right: 0px; overflow-x: hidden;"></span>
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
                      </tr>
                    </table></td>
                    <td width="29">
                    	<div id="side_menu">
                      		<table width="35" height="335" border="0" cellpadding="0">
                        <tr>
                          <td height="76"><a href="javascript:ajaxpage('profile.php?user=<? echo $user ?>', 'content');"><img src="http://www.12daysoffun.com/hustle/graphics/profile_button.png" width="31" height="80" alt="My Profile" /></a></td>
                          </tr>
                        <tr>
                          <td height="82"><a href="javascript:ajaxpage('assets.php?user=<? echo $user ?>', 'content');"><img src="http://www.12daysoffun.com/hustle/graphics/assets_button.png" width="31" height="82" alt="My Assets" /></a></td>
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
          <div id="crews"><a href="javascript:ajaxpage('recruit.php?user=<? echo $user ?>', 'content');"><img src="http://12daysoffun.com/hustle/graphics/recruit.png" alt="" width="93" height="32" /></a><? echo $scoretext?></div>
      </div>
        </div>
          </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" mce_src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"> </script>
<script type="text/javascript">

FB_RequireFeatures(["CanvasUtil"], function()
    {
      //You can optionally enable extra debugging logging in Facebook JavaScript client
      //FB.FBDebug.isEnabled = true;
      //FB.FBDebug.logLevel = 4;


      FB.XdComm.Server.init("http://www.12daysoffun.com/hustle/xd_receiver.htm");
      FB.CanvasClient.startTimerToSizeToContent();
    });


	FB_RequireFeatures(["XFBML"], function(){
		FB.Facebook.init("2b154bd6f13c0d2e91ee4619514aeaf9", "http://www.12daysoffun.com/hustle/xd_receiver.htm"); 
	});   
</script>

<div id="gallery">
    <div id="example">
         <ul>
              <li><a href="../arcade/pagination33.php"><span>Misc<span></a></li>
                 <li><a href="../arcade/pagination2.php"><span>Action<span></a>
                 <li><a href="../arcade/pagination3.php"><span>Shooting<span></a></li> 
                 <li><a href="../arcade/pagination4.php"><span>Sports<span></a></li> 
                 <li><a href="../arcade/pagination5.php"><span>Racing<span></a></li>
                 <li><a href="../arcade/pagination6.php"><span>Memory<span></a></li>
                 <li><a href="../arcade/pagination7.php"><span>Casino<span></a></li>
                 <li><a href="../arcade/pagination8.php"><span>Strategy<span></a></li>
                 <li><a href="../arcade/pagination9.php"><span>Classics<span></a></li>
                 <li><a href="../arcade/pagination.php"><span>Clsc Clones<span></a></li>
                 <li><a href="../arcade/pagination11.php"><span>Puzzle/Strategy<span></a></li>
                 <li><a href="../arcade/pagination12.php"><span>Random<span></a></li>
         </ul>
    </div>
</div>
</body>
</html>