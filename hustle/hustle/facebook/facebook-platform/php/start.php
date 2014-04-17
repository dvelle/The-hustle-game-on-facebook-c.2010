<?php
require_once("OpenLogin.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<script src="http://static.new.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<head>

 <!-- Mimic Internet Explorer 8 -->
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" >
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" type="text/css" media="all" />
    
	<link rel="stylesheet" type="text/css" href="../css/thickbox.css"/> 

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
			<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.livequery.js" charset="utf-8"></script>
	
<style type="text/css">
img {
	border: none;
}
#header {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	height: 98px;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/hustle_bk_2.png);
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
	width: 214px;
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
#wrapper #header #level #clock_energy {
	width: 62px;
	font-size: 0.61em;
	color: #FFF;
	margin-left: 475px;
	font-weight: bold;
}
#header #energy #nav_bar {
	width: 275px;
	margin-left: 120px;
}
#header #energy #nav_bar #news_butt {
	width: 72px;
	float: right;
	margin-left:5px;
	margin-right:3px;
}

#header #energy #nav_bar #store_section #manage_butt {
	width: 52px;
	float: right;
	margin-right:10px;
}
#header #energy #nav_bar #profile_butt {
	width: 52px;
	float: right;
	margin-right:5px;
}
#header #energy #nav_bar #home_butt {
	width: 52px;
	float: left;
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
#practice_button {
	position:absolute;
	width:200px;
	height:171px;
	z-index:3;
	left: 198px;
	top: 332px;
}

#fight_button {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
	left: 167px;
	top: 285px;
}
#inv_muscle_2 {
	position:absolute;
	width:169px;
	height:106px;
	z-index:4;
	left: 9px;
	top: 401px;
}
#inventory_button {
	position:absolute;
	width:148px;
	height:69px;
	z-index:5;
	left: 162px;
	top: 438px;
}
#rroffice {
	position:absolute;
	width:110px;
	height:97px;
	z-index:6;
	left: 593px;
	top: 404px;
}
#cheatmall {
	position:absolute;
	width:88px;
	height:58px;
	z-index:7;
	left: 672px;
	top: 453px;
}
#stats {
	position:absolute;
	width:187px;
	height:74px;
	z-index:8;
	left: 12px;
	top: 19px;
}
#apDiv1 {
	position:absolute;
	width:273px;
	height:206px;
	z-index:2;
	left: 198px;
	top: 302px;
}
#coliseum {
	position:absolute;
	width:561px;
	height:241px;
	z-index:1;
	left: 198px;
	top: 261px;
}
#apDiv3 {
	position:absolute;
	width:130px;
	height:115px;
	z-index:4;
	left: 169px;
	top: 383px;
}
#apDiv4 {
	position:absolute;
	width:160px;
	height:158px;
	z-index:3;
	left: 10px;
	top: 350px;
}
#crews {
	position:absolute;
	width:200px;
	height:63px;
	z-index:9;
	left: 444px;
	top: 441px;
}
#apDiv5 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:8;
	left: 443px;
	top: 379px;
}
#apDiv6 {
	position:absolute;
	width:107px;
	height:145px;
	z-index:5;
	left: 575px;
	top: 363px;
}
#apDiv7 {
	position:absolute;
	width:90px;
	height:71px;
	z-index:7;
	left: 669px;
	top: 436px;
}
#footer {
	background-image: url(graphics/hustle_bk_3.png);
	background-repeat: no-repeat;
	height: 97px;
}
#billboard {
	position:absolute;
	width:200px;
	height:115px;
	z-index:0;
	left: 57px;
	top: 306px;
}
#apDiv8 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:10;
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
	height: 51px;
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
	height: 51px;
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
	overflow: hidden;
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
	overflow: hidden;
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
#inner_page2 #assets_page1 {
}
#inner_page2 #assets_page1 #space_block {
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
#inner_page2 #assets_page1 #inventoryA #invntyA_item {
}
#inner_page2 #assets_page1 #inventoryA #invntyA_item table tr td table tr td table tr td .stats_div {
	color: #FFF;
	font-size:smaller;
}
#inner_page2 #assets_page1 #binvnty_header table tr td table tr td #totalupkeep {
	color: #000;
}
#inner_page2 #assets_page1 #binvnty_header table tr td table tr td .header_color {
	color: #FFF;
}
table tr td table tr td #totalupkeep #upkeep_val {
	color: #F00;
}
#inner_page2 #assets_page1 #inventoryA #invntyA_item table tr td table tr td table tr td table tr td .value_color {
	color: #030;
}
#inner_page2 #assets_page1 #inventoryA #invntyA_item table tr td table tr td table tr td #item_name {
	color: #FFF;
	font-size:smaller;
}
.cp_value_color {
	color: #FF0;
}
-->inventory
#inner_page2 #next_pg {
	width: 720px;
	margin-right: auto;
	margin-left: auto;
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
	padding-right: 0px;
	padding-left: 0px;
}

-->
#rooks #recruiter #crew_app table tr #marksec #mark_header .subhead1 {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 90px;
	padding-left: 0px;
}
#rooks #recruiter #crew_app table tr #marksec .recruitheader {
	font-size: 16px;
	font-weight: bolder;
	color: #FFF;
}
#rooks #recruiter #crew_app table tr td #bet {
	width: 175px;
	background-image: url(../graphics/store_bk_bot.png);
	margin-right: auto;
	margin-left: auto;
}
#rooks #recruiter #crew_app table tr td #fightrules {
	font-size: 12px;
	font-weight: bold;
}
#rooks #recruiter table tr td #mark_header #sublevel {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 0px;
	padding-left: 0px;
}
#rooks #recruiter table tr td #mark_header #subrank {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 58px;
	padding-left: 66px;
}
#rooks #recruiter #crew_app table tr td #mark_body table tr #variable_row {
	width: 138px;
	font-size: 12px;
}
#rooks #recruiter #crew_app table tr td #mark_body table tr #vrow2 {
	font-size: 12px;
	width: 53px;
}
#rooks #recruiter #crew_app table tr td #mark_body table tr #vrow1 {
	width: 120px;
	font-size: 12px;
}
#rooks #recruiter #crew_app table tr td #mark_body {
	overflow: scroll;
	height: 300px;
	width: 350px;
	background-image: url(../graphics/store_bk_bot.png);
	color: #FFF;
}
#rooks #recruiter #crew_app table tr #gamesec2 #field {
	height: 300px;
	background-image: url(../graphics/store_bk_bot.png);
	overflow: scroll;
	margin-right: 8px;
	margin-left: 8px;
	width: 155px;
}
#rooks #recruiter #crew_app table tr td .ftheader {
	font-size: 15px;
	color: #000;
	font-weight: bolder;
}

.hope{
	font-size:12px;
}
#ucool_max_note {
	font-size: 9px;
	font-weight: lighter;
}
-->
#fight_page {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(../graphics/hustle_bk_bottom.png);
	height: 404px;
}
#fight_page #fighthud table tr td #mark_header #subhead {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 23px;
	padding-left: 8px;
}

-->
#fight_page #fighthud #fight_form table tr td #bet {
	width: 175px;
	background-image: url(../graphics/store_bk_bot.png);
}
#fight_page #fighthud #fight_form table tr td #fightrules {
	font-size: 12px;
	font-weight: bold;
}
#fight_page #fighthud table tr td #mark_header #sublevel {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 8px;
	padding-left: 50px;
}
#fight_page #fighthud table tr td #mark_header #subrank {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 33px;
	padding-left: 62px;
}
#fight_page #fighthud #fight_form table tr td #mark_body table tr #variable_row {
	width: 138px;
	font-size: 12px;
}
#fight_page #fighthud #fight_form table tr td #mark_body table tr #vrow2 {
	font-size: 12px;
	width: 53px;
}
#fight_page #fighthud #fight_form table tr td #mark_body table tr #vrow1 {
	width: 120px;
	font-size: 12px;
}
#fight_page #fighthud #fight_form table tr td #body_mark {
	overflow: scroll;
	height: 300px;
	width: 353px;
	background-image: url(../graphics/store_bk_bot.png);
	color: #FFF;
}
#fight_page #fighthud #fight_form table tr #gamesec2 #arena {
	height: 270px;
	background-image: url(../graphics/store_bk_bot.png);
	overflow: scroll;
	margin-right: 8px;
	margin-left: 8px;
	width: 155px;
}
#fight_page #fighthud #fight_form table tr td .ftheader {
	font-size: 15px;
	color: #000;
	font-weight: bolder;
}
-->

#newsdesk {
height: 215px;
width: 360px;
background-color:#CCC;
}
    
    -->
#invnt_2 {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(../graphics/hustle_bk_bottom.png);
	height: 404px;
}
#invnt_2 #inty_page2 {
}
#invnt_2 #inty_page2 #space_block {
	height: 4px;
}
#invnt_2 #store_page #inventoryA {
	font-size: 0.9em;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#invnt_2 #inty_page2 #inventoryA #invntyA_item {
	font-size: .7em;
}
#invnt_2 #inty_page2 #inventoryA #invntyA_item table tr td table tr td table tr td .stats_div {
	color: #FFF;
}
#invnt_2 #inty_page2 #binvnty_header table tr td table tr td #totalupkeep {
	font-size: 14px;
	color: #000;
}
#invnt_2 #inty_page2 #binvnty_header table tr td table tr td .header_color {
	font-weight: bolder;
	color: #FFF;
}
table tr td table tr td #totalupkeep #upkeep_val {
	color: #F00;
}
#invnt_2 #inty_page2 #inventoryA #invntyA_item table tr td table tr td table tr td table tr td .value_color {
	color: #030;
	font-weight: bolder;
}
#invnt_2 #inty_page2 #inventoryA #invntyA_item table tr td table tr td table tr td #item_name {
	font-size: 14px;
	font-weight: bolder;
	color: #FFF;
}
#invnt_2 #next_pg {
	width: 720px;
	margin-right: auto;
	margin-left: auto;
	visibility: hidden;
}
-->	
#muscle_h {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/longer_bk.png);
	height: 712px;
}
#muscle_h #next_pg {
	width: 720px;
	margin-right: auto;
	margin-left: auto;
	visibility: hidden;
}
#muscle_h #muscle_pg {
}
#muscle_h #muscle_pg #space_block {
	height: 4px;
}
#maint_fee {
	color: #F00;
	font-weight: bold;
}
td .asset_clr {
	font-size: 14px;
	font-weight: bold;
	color: #000;
}
#muscle_h #store_page #inventoryA {
	font-size: 0.9em;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#muscle_h #muscle_pg #inventoryA #invntyA_item {
	font-size: .7em;
}
#muscle_h #muscle_pg #inventoryA #invntyA_item table tr td table tr td table tr td .stats_div {
	color: #FFF;
}
#muscle_h #muscle_pg #binvnty_header table tr td table tr td #totalupkeep {
	font-size: 14px;
	font-weight: bolder;
	color: #000;
}
#muscle_h #muscle_pg #binvnty_header table tr td table tr td .header_color {
	font-weight: bolder;
	color: #FFF;
}
table tr td table tr td #totalupkeep #upkeep_val {
	color: #F00;
}
#muscle_h #muscle_pg #inventoryA #invntyA_item table tr td table tr td table tr td table tr td .value_color {
	color: #030;
	font-weight: bolder;
}
#muscle_h #muscle_pg #inventoryA #invntyA_item table tr td table tr td table tr td #item_name {
	font-size: 14px;
	font-weight: bolder;
	color: #FFF;
}
-->
#boss {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/longer_bk.png);
	height: 712px;
}
#boss #next_pg {
	width: 720px;
	margin-right: auto;
	margin-left: auto;
	visibility: hidden;
}
#boss #bm {
}
#boss #bm #space_block {
	height: 3px;
}
#maint_fee {
	color: #F00;
	font-weight: bold;
}
td .asset_clr {
	font-size: 14px;
	font-weight: bold;
	color: #000;
}
#boss #store_page #inventoryA {
	font-size: 0.9em;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#boss #bm #inventoryA #invntyA_item {
	font-size: .7em;
}
#boss #bm #inventoryA #invntyA_item table tr td table tr td table tr td .stats_div {
	color: #FFF;
}
#boss #bm #binvnty_header table tr td table tr td #totalupkeep {
	font-size: 14px;
	font-weight: bolder;
	color: #000;
}
#boss #bm #binvnty_header table tr td table tr td .header_color {
	font-weight: bolder;
	color: #FFF;
}
table tr td table tr td #totalupkeep #upkeep_val {
	color: #F00;
}
#boss #bm #inventoryA #invntyA_item table tr td table tr td table tr td table tr td .value_color {
	color: #030;
	font-weight: bolder;
}
#boss #bm #inventoryA #invntyA_item table tr td table tr td table tr td #item_name {
	font-size: 14px;
	font-weight: bolder;
	color: #FFF;
}
-->
#gifts {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(../graphics/hustle_bk_bottom.png);
	height: 404px;
}
-->
#mirror {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/long_bk.png);
	height: 712px;
}
#mirror #profile_sect table tr td #Stats_tab table tr #stats_upper_header {
	color: #FFF;
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #FFF;
	height: 34px;
}
#mirror #profile_sect table tr td #Stats_tab #stats_table {
	font-size: 13px;
	color: #CCC;
	height: 208px;
}
#mirror #profile_sect table tr td #finances_tab table tr #fin_u_header {
	color: #FFF;
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #FFF;
}
#mirror #profile_sect table tr td #finances_tab #finance_table {
	font-size: 13px;
	color: #CCC;
}
#mirror #profile_sect table tr td #weapons_tab table tr #weapon_header {
	color: #FFF;
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #FFF;
}

#mirror #profile_sect table tr td #muscle_tab table tr #muscle_header {
	color: #333;
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #333;
}
#mirror #profile_sect table tr td #finances_tab table tr #assets_header {
	color: #333;
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #333;
}
#mirror #profile_sect table tr td #Stats_tab {
	padding-bottom: 24px;
}
#mirror #profile_sect table tr td #weapons_tab #weapons_hud {
	overflow: scroll;
	height: 150px;
}
#mirror #profile_sect table tr td #spacer {
	height: 95px;
}
#mirror #profile_sect table tr td #muscle_tab #muscle_hud {
	overflow: scroll;
	height: 151px;
}
#mirror #profile_sect table tr td #finances_tab #assets_hud {
	overflow: scroll;
	height: 151px;
}
-->
</style>
<style type="text/css">
<!--
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
-->
-->
#estate1 {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/long_bk.png);
	height: 712px;
}
#estate1 #next_pg {
	width: 720px;
	margin-right: auto;
	margin-left: auto;
}
#estate1 #assets_page1 #space_block {
	height: 6px;
}
#maint_fee {
	color: #F00;
	font-weight: bold;
}
td .asset_clr {
	font-size: 14px;
	font-weight: bold;
	color: #000;
}
#neg_value_color {
	font-weight: bolder;
	color: #F00;
}
#estate1 #store_page #inventoryA {
	font-size: 0.9em;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#estate1 #assets_page1 #inventoryA #invntyA_item {
	font-size: .7em;
}
#estate1 #assets_page1 #inventoryA #invntyA_item table tr td table tr td table tr td .stats_div {
	color: #FFF;
}
#estate1 #assets_page1 #binvnty_header table tr td table tr td #totalupkeep {
	font-size: 14px;
	font-weight: bolder;
	color: #000;
}
#estate1 #assets_page1 #binvnty_header table tr td table tr td .header_color {
	font-weight: bolder;
	color: #FFF;
}
table tr td table tr td #totalupkeep #upkeep_val {
	color: #F00;
}
#estate1 #assets_page1 #inventoryA #invntyA_item table tr td table tr td table tr td table tr td .value_color {
	color: #030;
	font-weight: bolder;
}
#estate1 #assets_page1 #inventoryA #invntyA_item table tr td table tr td table tr td #item_name {
	font-size: 14px;
	font-weight: bolder;
	color: #FFF;
}
.cp_value_color {
	color: #FF0;
	font-weight: bold;
}
-->
#king {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(../graphics/hustle_bk_bottom.png);
	height: 404px;
}
#king #next_pg {
	width: 720px;
	margin-right: auto;
	margin-left: auto;
	visibility: hidden;
}
#king #bassets_pg {
}
#king #bassets_pg #space_block {
	height: 4px;
}
#maint_fee {
	color: #F00;
	font-weight: bold;
}
td .asset_clr {
	font-size: 14px;
	font-weight: bold;
	color: #000;
}
#neg_value_color {
	font-weight: bolder;
	color: #F00;
}
#king #store_page #inventoryA {
	font-size: 0.9em;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#king #bassets_pg #inventoryA #invntyA_item {
	font-size: .7em;
}
#king #bassets_pg #inventoryA #invntyA_item table tr td table tr td table tr td .stats_div {
	color: #FFF;
}
#king #bassets_pg #binvnty_header table tr td table tr td #totalupkeep {
	font-size: 14px;
	font-weight: bolder;
	color: #000;
}
#king #bassets_pg #binvnty_header table tr td table tr td .header_color {
	font-weight: bolder;
	color: #FFF;
}
table tr td table tr td #totalupkeep #upkeep_val {
	color: #F00;
}
#king #bassets_pg #inventoryA #invntyA_item table tr td table tr td table tr td table tr td .value_color {
	color: #030;
	font-weight: bolder;
}
#king #bassets_pg #inventoryA #invntyA_item table tr td table tr td table tr td #item_name {
	font-size: 14px;
	font-weight: bolder;
	color: #FFF;
}
.cp_value_color {
	color: #FF0;
	font-weight: bold;
}
-->
-->
#boards {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/long_bk.png);
	height: 712px;
}
#boards #leaders #title {
	color: #00F;
	padding-left: 5px;
	font-weight: bold;
}
#boards #leaders table tr td .board_header {
	font-size: 18px;
	font-weight: bold;
}
#boards #leaders table tr td .board_headerw {
	color: #FFF;
	font-size: 18px;
	font-weight: bolder;
}
#boards #leaders table tr td table tr td #top10_c {
	overflow: scroll;
	height: 150px;
}
#boards #leaders table tr td table tr td #bot10_c {
	overflow: scroll;
	height: 150px;
}
#boards #leaders table tr td table tr td #top10_p {
	overflow: scroll;
	height: 150px;
}
#boards #leaders table tr td table tr td #bot10_p {
	overflow: scroll;
	height: 150px;
}
#boards #leaders table tr td table tr td #top10_g {
	overflow: scroll;
	height: 150px;
}
#boards #leaders table tr td table tr td #bot10_g {
	overflow: scroll;
	height: 150px;
}
-->
#mall {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/long_bk.png);
	height: 712px;
}
#mall #store_page #consumables {
	font-weight: bold;
	color: #FFF;
	font-size: 0.8em;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#mall #store_page #bundles {
	font-weight: bold;
	color: #FFF;
	font-size: 0.8em;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#mall #store_page #paypal {
	font-size: 0.9em;
	width: 725px;
	margin-right: auto;
	margin-left: auto;
}
#mall #store_page {
	padding-top: 25px;
}
#mall #store_page #consumables table tr td #ncn_image {
}
#mall #store_page #store_header table tr td table tr td #header_label {
	border-bottom-width: thin;
	border-bottom-color: #03C;
}
#mall #store_page #space_block {
	height: 10px;
}
#mall #store_page #store_header table tr td table tr td #header_label tr td {
	color: #F00;
	font-weight: bold;
}
#mall #store_page #store_header table tr td table tr td table tr td {
	font-size: 14px;
	color: #FFF;
}
.payterms {
	color: #00F;
	font-weight: bold;
}
#mall #store_page #paypal #form1 table tr td table tr td table tr td {
	color: #FFF;
}
-->
-->
#manager {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/shorter_bk_bottom.png);
	height: 465px;
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
	overflow: auto;
}
#manager #manage_pg table tr td table tr td table tr td form #quitter {
	overflow: auto;
	height: 146px;
}
#manager #manage_pg table tr td table tr td table tr td #manage_header3 {
}
#manager #manage_pg table tr td table tr td table tr td form #coffers {
	height: 160px;
	overflow: auto;
}
#manager #manage_pg table tr td table tr td table tr td form #new_offers {
	margin-bottom: 23px;
}
-->
#heist {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(../graphics/hustle_bk_bottom.png);
	height: 404px;
}
#heist #hithud table tr td #target_header #subhead {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 23px;
	padding-left: 8px;
}
#heist #hithud #hit_form table tr td #bet {
	width: 175px;
	background-image: url(../graphics/store_bk_bot.png);
}
#heist #hithud #hit_form table tr td #hitrules {
	font-size: 12px;
	font-weight: bold;
}
#heist #hithud table tr td #target_header #sublevel {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 8px;
	padding-left: 50px;
}
#heist #hithud table tr td #target_header #subrank {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
	padding-right: 33px;
	padding-left: 62px;
}
#heist #hithud #hit_form table tr td #target_body table tr #variable_row {
	width: 138px;
	font-size: 12px;
}
#heist #hithud #hit_form table tr td #target_body table tr #vrow2 {
	font-size: 12px;
	width: 53px;
}
#heist #hithud #hit_form table tr td #target_body table tr #vrow1 {
	width: 120px;
	font-size: 12px;
}
#heist #hithud #hit_form table tr td #target_body {
	overflow: scroll;
	height: 300px;
	width: 353px;
	background-image: url(../graphics/store_bk_bot.png);
	color: #FFF;
}
#heist #hithud #hit_form table tr #gamesec2 #field {
	height: 300px;
	background-image: url(../graphics/store_bk_bot.png);
	overflow: scroll;
	margin-right: 8px;
	margin-left: 8px;
	width: 155px;
}
#heist #hithud #hit_form table tr td .ftheader {
	font-size: 15px;
	color: #000;
	font-weight: bolder;
}
-->
#playingtip { 
    display:none; 
    background:url(http://static.flowplayer.org/tools/img/tooltip/black_arrow_big.png);
    padding:40px 30px 10px 30px; 
    width:310px; 
    font-size:11px; 
    color:#fff;
}
#playingtip2 { 
    display:none; 
    background:url(http://static.flowplayer.org/tools/img/tooltip/black_arrow_big.png);
    padding:40px 30px 10px 30px; 
    width:310px; 
    font-size:11px; 
    color:#fff;
}
#playingtip3 { 
    display:none; 
    background:url(http://static.flowplayer.org/tools/img/tooltip/black_arrow_big.png);
    padding:40px 30px 10px 30px; 
    width:310px; 
    font-size:11px; 
    color:#fff;
}
#playingtip4 { 
    display:none; 
    background:url(http://static.flowplayer.org/tools/img/tooltip/black_arrow_big.png);
    padding:40px 30px 10px 30px; 
    width:310px; 
    font-size:11px; 
    color:#fff;
}
#playingtip5 { 
    display:none; 
    background:url(http://static.flowplayer.org/tools/img/tooltip/black_arrow_big.png);
    padding:40px 30px 10px 30px; 
    width:310px; 
    font-size:11px; 
    color:#fff;
}
#playingtip6 { 
    display:none; 
    background:url(http://static.flowplayer.org/tools/img/tooltip/black_arrow_big.png);
    padding:40px 30px 10px 30px; 
    width:310px; 
    font-size:11px; 
    color:#fff;
}
#playingtip7 { 
    display:none; 
    background:url(http://static.flowplayer.org/tools/img/tooltip/black_arrow_big.png);
    padding:40px 30px 10px 30px; 

    width:310px; 
    font-size:11px; 
    color:#fff;
}
#playingtip8 { 
    display:none; 
    background:url(http://static.flowplayer.org/tools/img/tooltip/black_arrow_big.png);
    padding:40px 30px 10px 30px; 
    width:310px; 
    font-size:11px; 
    color:#fff;
}
#playingtip9 { 
    display:none; 
    background:url(http://static.flowplayer.org/tools/img/tooltip/black_arrow_big.png);
    padding:40px 30px 10px 30px; 
    width:310px; 
    font-size:11px; 
    color:#fff;
}
-->hit
#hit_results { 
 
    /* overlay is hidden before loading */ 
    display:none; 
 
    /* standard decorations */ 
    width:125px;
	font-size:14px;
 
    /* for modern browsers use semi-transparent color on the border. nice! */ 
    /*border:10px solid rgba(82, 82, 82, 0.698); */
 
    /* hot CSS3 features for mozilla and webkit-based browsers (rounded borders) */ 
    -moz-border-radius:8px; 
    -webkit-border-radius:8px; 
} 
 
#hit_results div { 
    padding:10px; 
    border:1px solid #3B5998; 
    background-color:#fff; 
    font-family:"lucida grande",tahoma,verdana,arial,sans-serif 
} 
 
#hit_results h2 { 
    margin:-11px; 
    margin-bottom:0px; 
    color:#fff; 
    background-color:#6D84B4; 
    padding:5px 10px; 
    border:1px solid #3B5998; 
    font-size:20px; 
}
#apDiv2 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:101;
	left: 676px;
	top: 114px;
}
#pointer {
	position:absolute;
	width:92px;
	height:33px;
	z-index:101;
	left: 433px;
	top: 360px;
}
#escalade {
	position:absolute;
	width:93px;
	height:51px;
	z-index:102;
	left: 102px;
	top: 437px;
}
#cops {
	position:absolute;
	width:93px;
	height:47px;
	z-index:4;
	left: 277px;
	top: 458px;
}
#lotto_blimp {
	position:absolute;
	width:200px;
	height:94px;
	z-index:103;
	left: 400px;
	top: 152px;
}
#lotto_pot {
	position:absolute;
	width:154px;
	height:24px;
	z-index:1;
	left: 76px;
	top: 36px;
}
#market_button {
	position:absolute;
	width:35px;
	height:213px;
	z-index:1;
	left: 727px;
	top: 288px;
}
#apDiv9 {
	position:absolute;
	width:151px;
	height:56px;
	z-index:104;
	left: 529px;
	top: 247px;
}
-->DOWNTOWN
#bridge {
	position:absolute;
	width:128px;
	height:52px;
	z-index:1;
	left: 203px;
	top: 341px;
}
#casino {
	position:absolute;
	width:182px;
	height:114px;
	z-index:1;
	left: 110px;
	top: 341px;
}
#black_market {
	position:absolute;
	width:128px;
	height:54px;
	z-index:3;
	left: 4px;
	top: 450px;
}
#nightclub {
	position:absolute;
	width:182px;
	height:114px;
	z-index:2;
	left: 470px;
	top: 398px;
}
#bm_title {
	position:absolute;
	width:128px;
	height:54px;
	z-index:2;
	left: 4px;
	top: 423px;
}
#nc_title {
	position:absolute;
	width:182px;
	height:114px;
	z-index:1;
	left: 470px;
	top: 380px;
}
-->Casino
#casino_back {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/hustle_bk_bottom.png);
	height: 404px;
}
</style>
    
<script type="text/javascript">

/***********************************************
* Dynamic Ajax Content- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
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
<script type="text/javascript">
jQuery(function() {
			$('#spree_exit').css('cursor','pointer');
			$('#wespree').css('cursor','pointer');
			$('#nospree').css('cursor','pointer');
			$('#r_exit_tks').css('cursor','pointer');
			$('#c_exit_tks').css('cursor','pointer');
			$('#recline').css('cursor','pointer');
			$('#raccept').css('cursor','pointer');
			$('#cecline').css('cursor','pointer');
			$('#caccept').css('cursor','pointer');
			$('#bm_exit').css('cursor','pointer');
			$('#namor_exit').css('cursor','pointer');			
			//downtown{
			$('#black_market')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#casino')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#purchase_casino')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#nightclub')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			//downtown}
			$('#news_butt')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#practice_button')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('.page')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#fight_button')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#fight_button')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#market_button')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#crews')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#home_butt')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#inv_muscle')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#inv_muscle_2')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#gift_button')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#manage_butt')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#hit_button')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#profile_butt')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#rroffice')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#king_button')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#billboard')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#cheatmall')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#inv_muscle2')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#gift_button2')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#inventory_butt2')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#inventory_button')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			
			$('#gift_button3')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#inventory_butt3')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			
			$('#gift_button4')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#inventory_butt4')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#inv_muscle3')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#hit_button2')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('.tab_clear')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#clear_pvt')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#impulse_exit').css('cursor','pointer');
			$('#impulse_sold').css('cursor','pointer');
			$('#impulse_exit_tks').css('cursor','pointer');
			$('#impulse_sold_tks').css('cursor','pointer');
			$('#exit_tks').css('cursor','pointer');
			$('#news_exit_tks').css('cursor','pointer');
			$('#practice_button')
			.livequery('click', function(event) {
										 gogetter("#practice");
										 tb_show("Arcade","start2.php?keepThis=true&TB_iframe=false&height=435&width=700","");
										 });
			$('#fight_button')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#fight");
										 });
			$('#manage_butt')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#manage");
										 });
			$('#news_butt')
			.livequery('click', function(event) {
						$('#news_exit_tks').show();
						$('#news_tks').show();
						newswire(htmlStr);
						$('#newsdesk').show();
						$('#news_header').show();
						$("#news_butt").html("<img src='http://www.12daysoffun.com/hustle/graphics/inventory_button.png'/>");
						$.post("beeper_off.php", {data: htmlStr});
						eandc(htmlStr);
										 });
			$('#inventory_button')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#inventory");
										 });
			$('#inventory_butt2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#inventory");
										 });
			$('#inventory_butt3')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#inventory");
										 });
			$('#inventory_butt4')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#inventory");
										 });
			$('#inv_muscle')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#muscle");
										 });
			$('#inv_muscle_2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#muscle");
										 });
			$('#inv_muscle2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#muscle");
										 });
			$('#inv_muscle3')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#muscle");
										 });
			$('#gift_button')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#gift_opt");
										 });
			$('#gift_button2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#gift_opt");
										 });
			$('#gift_button3')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#gift_opt");
										 });
			$('#gift_button4')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#gift_opt");
										 });
			$('#hit_button')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#hit_opt");
										 });
			$('#hit_button2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#hit_opt");
										 });
			$('#crews')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#recruit");
										 });
			$('#profile_butt')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 profilegetter("#profile");
										 });
			$('#rroffice')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#assets");
										 });
			$('#billboard')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#scores");
										 });
			$('#cheatmall')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 storegetter("#store");
										 });
			$('#market_button')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#downtown");
										 });
			$('#casino')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#casino_page");
										 });
			$('#nightclub')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#club_page");
										 });
			$('#home_butt')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#home");
										 });	
			$("#practice_button")
			.livequery(function(){
								$(this)
								.hover(
				  function () {
					$("#title").css("display","block");
				  }, 
				  function () {
					$("#title").css("display","none");
				  }
				);
								});
			$("#fight_button")
			.livequery(function(){
								$(this)
								.hover(
									  function () {
										$("#fight_title").css("display","block");
									  }, 
									  function () {
										$("#fight_title").css("display","none");
									  }
									);
								});
			$("#market_button")
			.livequery(function(){
								$(this)
								.hover(
									  function () {
										$("#market_title").css("display","block");
									  }, 
									  function () {
										$("#market_title").css("display","none");
									  }
									);
								});
			$("#inventory_button")
			.livequery(function(){
								$(this)
								.hover(
									  function () {
										$("#gun_title").css("display","block");
									  }, 
									  function () {
										$("#gun_title").css("display","none");
									  }
									);
								});
			$("#inv_muscle_2")
			.livequery(function(){
								$(this)
								.hover(
									  function () {
										$("#muscle_title").css("display","block");
									  }, 
									  function () {
										$("#muscle_title").css("display","none");
									  }
									);
								});
			$("#crews")
			.livequery(function(){
								$(this)
								.hover(
									  function () {
										$("#recruiters").css("display","block");
									  }, 
									  function () {
										$("#recruiters").css("display","none");
									  }
									);
								});
			$("#rroffice")
			.livequery(function(){
								$(this)
								.hover(
									  function () {
										$("#deed").css("display","block");
									  }, 
									  function () {
										$("#deed").css("display","none");
									  }
									);
								});
			$("#cheatmall")
			.livequery(function(){
								$(this)
								.hover(
									  function () {
										$("#cheats").css("display","block");
									  }, 
									  function () {
										$("#cheats").css("display","none");
									  }
									);
								});
			//downtown
			$("#black_market")
			.livequery(function(){
								$(this)
								.hover(
									  function () {
										$("#blackmarket_title").css("display","block");
									  }, 
									  function () {
										$("#blackmarket_title").css("display","none");
									  }
									);
								});
			$("#nightclub")
			.livequery(function(){
								$(this)
								.hover(
									  function () {
										$("#nightclub_title").css("display","block");
									  }, 
									  function () {
										$("#nightclub_title").css("display","none");
									  }
									);
								});
			
			$('#impulse_exit').click(function(){
					$('#impulse_exit').hide();
					$('#Impulse_Buy').hide();
					$('#impulse_sold').hide();
											  });
			$('#impulse_sold').click(function(){	  
					$('#impulse_exit').hide();
					$('#Impulse_Buy').hide();
					$('#impulse_sold').hide();
					gogetter("#store");
							   });
			$('#impulse_exit_tks').click(function(){
					$('#impulse_exit_tks').hide();
					$('#Impulse_Buy_tks').hide();
					$('#impulse_sold_tks').hide();
											  });
			$('#impulse_sold_tks').click(function(){	  
					$('#impulse_exit_tks').hide();
					$('#Impulse_Buy_tks').hide();
					$('#impulse_sold_tks').hide();
				//comeback to this after store	
							   });
			$('#exit_tks').click(function(){
					$('#exit_tks').hide();
					$('#delivery_tks').hide();
					$('#tks').hide();
										  });
			$('#news_exit_tks').click(function(){
					$('#news_exit_tks').hide();
					$('#news_tks').hide();
					$('#newsdesk').hide();
					$('#news_header').hide();
										  });
			$('#c_exit_tks').click(function(){
					$('#c_exit_tks').hide();
					$('#cops_app').hide();
					$('#c_decision').hide();
											});
			$('#r_exit_tks').click(function(){
					$('#r_exit_tks').hide();
					$('#gang_app').hide();
					$('#r_decision').hide();
											});
			$('#recline').click(function(){
					$('#r_exit_tks').hide();
					$('#gang_app').hide();
					$('#r_decision').hide();
					$.post("signup.php", {data: htmlStr, decision: "no", faction: "bad"});
											});
			$('#raccept').click(function(){
					$('#r_exit_tks').hide();
					$('#gang_app').hide();
					$('#r_decision').hide();
					$.post("signup.php", {data: htmlStr, decision: "yes", faction: "good"});
											});
			$('#cecline').click(function(){
					$('#c_exit_tks').hide();
					$('#cops_app').hide();
					$('#c_decision').hide();
					$.post("signup.php", {data: htmlStr, decision: "no", faction: "good"});
											});
			$('#caccept').click(function(){
					$('#c_exit_tks').hide();
					$('#cops_app').hide();
					$('#c_decision').hide();
					$.post("signup.php", {data: htmlStr, decision: "yes", faction: "good"});
											});
			$('#wespree').click(function(){
					$('#c_exit_tks').hide();
					$('#cops_app').hide();
					$('#c_decision').hide();
					$.post("signup.php", {data: htmlStr, decision: "yes", faction: "good"});
											});
			$('#nospree').click(function(){
					$('#c_exit_tks').hide();
					$('#cops_app').hide();
					$('#c_decision').hide();
					$.post("signup.php", {data: htmlStr, decision: "yes", faction: "good"});
											});
			$('#spree_exit').click(function(){
					$('#c_spree').hide();
					$('#spree_exit').hide();
					$('#rider').hide();
											});
			$('#black_market')
			.livequery('click', function(event) {
						$('#bm_exit').show();
						$('#bm_dealer').show();
						$('#dealer_btm').show();
						eandc(htmlStr);
										 });
			$('#purchase_casino')
			.livequery('click', function(event) {
						$("#userid")
				  .livequery(function(){
									  $(this)
									  .val(htmlStr);
									  });				 
						$('#cbuy_exit').show();
						$('#casino_buy').show();
						$('#csfloor').show();
						eandc(htmlStr);
										 });
			$('#casino_sold').css('cursor','pointer');
			$('#cbuyf_exit').css('cursor','pointer');
			$('#cbuy_exit').click(function(){
					$('#cbuy_exit').hide();
				    $('#casino_buy').hide();
		            $('#csfloor').hide();
											});
			$('#investments_exit').css('cursor','pointer');
			$('#investments_exit').click(function(){
					$('#investments').hide();
					$('#investments_exit').hide()
											});
			
			$('#new_casino_exit').css('cursor','pointer');
			$('#new_casino_exit').click(function(){
					$('#new_casino_exit').hide();
				    $('#new_casino').hide();
											});
			$('#cbuyf_exit').click(function(){
					$('#cbuyf_exit').hide();
				    $('#casino_buyf').hide();
											});
			$('#bm_exit').click(function(){
					$('#bm_dealer').hide();
					$('#bm_exit').hide();
					$('#dealer_btm').hide();
											});
			
			$('#play').css('display', 'none');
			
		
}); 
			jQuery(function() {
$.post("example.php", {},
   function(data){
	   $('#facebook_user').hide();
	  htmlStr = $("#facebook_user").html();
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
											 var first_time = results.first;
											 var user_change_per = results.change_per;
											 var user_timer = results.timer;
											 var user_news = results.newnews;
									 $('#u_cool').append(user_cool);
									 $('#ucool_max').append(user_cool_max - user_cool);
									 $('#ucool_max_note').append(" until next level");
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
									 newbie(first_time);
									 notice(htmlStr);
									 test(user_energy,user_energy_max,user_change_per,user_timer);
									 arcade_results(htmlStr);
									 newswire(htmlStr);
									 beeper(user_news);
													  
									}, "json");	
   });
});
//Timer			
function countdownTimer(timeLeft, current, maxval, every, change_per, span_id, div_refresh, div_current) {
			$('#clock_energy').attr('#clock_energy');
			if(timeLeft == 0) {
				var div;
				var div_curr;
				// ensure that we aren't operating
				// on null/empty divs
				if (div_refresh != '')
				{
					div = $('#' + div_refresh);					
				}
				if (div_current != '')
				{
					div_curr = $('#' + div_current);					
				}
				current += change_per;
				$.ajax({
					   type: "POST",
					   url: "blamo.php",
					   data: "name=" + htmlStr + "&adjust=" + change_per,
					   success: function(){
					   }
					   });
				
				//$.post("blamo.php", { name: htmlStr, adjust: update } );
				
				//Impulse Buy Lightboxes - refresh user stats automatically by updating these global JS vars
				if (div_current == 'user_energy')
		    {
		     current_energy_value = current;
		    }
		    else if (div_current == 'user_health')
		    {
		     current_health_value = current;
		    }
		    else if (div_current == 'user_stamina')
		    {
		     current_stamina_value = current;
		    }
		    else if (div_current == 'user_cash')
		    {
		     current_cash_value = current;
		    }
  			
				if (div) {
					if (maxval > 0 && current >= maxval) {
						div.css('display', 'none');
						if (div_curr) {
							div_curr.text(current);
						}
						return;

					}
				}
				if (div_curr) {
					if (maxval > 0) {
						var this_curr_text = current;
					} else {
						current = Math.max(current, 0);
						var this_curr_text = '$'+number_format(current, 0);
					}
					div_curr.text(this_curr_text);
					timeLeft = every;
				}
			}
			else {
				timeLeft--;
			}
			timeLeft = (0 > timeLeft)?0:timeLeft;

			if (timeLeft >= 86400) {
				var timeText = Math.floor(timeLeft/86400)+":";
				var hours = Math.floor(timeLeft/3600)%24;
				if (10 > hours) {
					timeText += "0"+hours+":";
				} else {
					timeText += hours+":";
				}
			} else {
				var timeText = Math.floor(timeLeft/3600)+":";
			}

			if (timeLeft >= 3600) {
				var minutes = Math.floor(timeLeft/60)%60;
				if (10 > minutes) {
					timeText += "0"+minutes+":";
				} else {
					timeText += minutes+":";
				}
			} else {
				var timeText = Math.floor(timeLeft/60)+":";
			}
//break in if loop
			var seconds = timeLeft%60;
			if (10 > seconds) {
				timeText += "0"+seconds;
			} else {
				timeText += seconds;
			}
			
			var elem = $('#'+span_id);
			if (elem) {
				elem.text(timeText);
				setTimeout(function() {countdownTimer(timeLeft, current, maxval, every, change_per, span_id, div_refresh, div_current)}, 1000);
			}
		}
//number format		
function number_format( number, decimals, dec_point, thousands_sep ) {
	var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
	var d = dec_point == undefined ? "." : dec_point;
	var t = thousands_sep == undefined ? "," : thousands_sep, s = n < 0 ? "-" : "";
	var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;

	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}
//Energy Max		
function test(current,full,some,sot){
	//here
	var current_energy = parseInt(current);
	var max_energy = parseInt(full);
	var lvl_change = parseInt(some);
	var energy_change_per = lvl_change;
	var next_energy_update = sot;
	var character_energy_update = sot;
	var cstate = $('#clock_energy').css('display');
	
	if(cstate == "none"){
	if(current_energy<max_energy)
	{	
		countdownTimer(next_energy_update, current_energy, max_energy, character_energy_update, energy_change_per, 'countdownSpanEnergy', 'clock_energy', 'u_energy');
		
		$('#clock_energy').css('display', 'block');
		
	} else {
		
		$('#clock_energy').css('display', 'none');

	}
	}
	return false;
}
//notices
function notice(htmlStr){
	$.ajax({
					   type: "POST",
					   url: "welcome.php",
					   data: "name=" + htmlStr,
					   success: function(data){
						   if(data == 1){
														  tb_show("<embed src='../file/app-8.mp3' height=0>","../graphics/upgrade_alert.png","");
							   } else if(parseInt(data) == 2) {
															  tb_show("<embed src='../file/laugh-02.mp3' height=0>","../graphics/downgrade_alert.png","");
							   }
					   }
		   });	
	return false;
}

//blinker
(function($)
{
	$.fn.blink = function(options)
	{
		var defaults = { delay:500 };
		var options = $.extend(defaults, options);
		
		return this.each(function()
		{
			var obj = $(this);
			setInterval(function()
			{
				if($(obj).css("visibility") == "visible")
				{
					$(obj).css('visibility','hidden');
				}
				else
				{
					$(obj).css('visibility','visible');
				}
			}, options.delay);
		});
	}
}(jQuery))
//news alerter
function beeper(user_news){
	if(user_news == 1){
		$("#news_butt").html("<img src='http://www.12daysoffun.com/hustle/graphics/new_news.png'/>");
	} 
	return false;
}
//newbie
function newbie(first_time){
	if(first_time == "new"){
		//Show welcome screen
		tb_show("Follow the Walk-Thru to get your rep' up!","../graphics/hustle_over.png","");
		$("#pointer").html("<img src='../graphics/arrow_green_right_50x63_01.gif' width='63' height='53' />");
		$("#pointer").blink();
		$.post("welcome.php", {data: htmlStr});
	}
	return false;
}
//stat updater
function eandc(htmlStr){
	$.getJSON("smgtrack_ajax.php", { data: htmlStr }, function(json){;
											var user_cool = json.cool;
											var user_cool_max = json.cool_max;
											var user_energy = json.energy;
											var user_energy_max = json.energy_max;
											var user_cash = json.cash;
											var user_stage = json.stage;
											var user_token = json.token;
											var user_crew_rank = json.crew_rank;
											var user_level_label = json.level_label;
											var user_cash_cow = json.cash_cow;
										    var user_cow_earns = json.cow_earns;
										    var user_drain = json.cash_drain;
										    var user_drain_losses = json.drain_loss;
											var user_change_per = json.change_per;
											var user_timer = json.timer;
											var user_news = json.newnews;
											var user_crime = json.crime;
											var user_law = json.law;
											var user_mission = json.fbi;
											var user_game = json.thegame;
											var user_task = json.tcode;
											var user_tbonus = json.tbonus;
											var user_tcash = json.tcash;
											var user_tfee = json.tfee;
											var score = json.score;
											var signup = json.signup;
											var lotto = json.lotto;
											$('#reward_points')
											.livequery(function(){
																$(this)
																.html(user_token);
																});
											$('#dollar_val').html(user_cash);
											$('#uenergy_max').html(user_energy_max);
											$('#u_cool').html(user_cool);
									 		$('#ucool_max').html(user_cool_max - user_cool);
											$('#level_number_stat').html(user_stage);
											$('#level_label').html(user_level_label);
											$('#c_rank').html(user_crew_rank);
											$('#cash_cow').html('<img src=" http://www.12daysoffun.com/hustle/file/pic/user/' + user_cash_cow + '"/>');
											$('#profits').html(user_cow_earns);
											$('#drain').html('<img src=" http://www.12daysoffun.com/hustle/file/pic/user/' + user_drain + '"/>');
											$('#losses').html(user_drain_losses);
											how_high(user_energy,htmlStr);
											notice(htmlStr);
											lotto_stat(lotto);
											test(user_energy,user_energy_max,user_change_per,user_timer);
											upgraded(user_cool);
											upgraded_wea(user_cool);
											upgraded_ass(user_cool);
											boss_settings(user_cool);
											beeper(user_news);
											first_crime(signup, user_crime);
											academy(signup, user_law);
											mission_ready(user_mission,user_game,user_task,user_tcash,user_tbonus,user_tfee,score);
											});
	
	$.post("case_stats.php", {data: htmlStr}, function(results) {
											 var weap_upkeep = results.upkeep;
											 $('.wup_keep_val')
											 .livequery(function(){
																 $(this)
																 .html("-" + weap_upkeep);
																 });
									}, "json");	
	$.ajax({
					   type: "POST",
					   url: "cp_captest.php",
					   data: "name=" + htmlStr,
					   success: function(){
					   }
					   });
	return false;
	
}
//
function how_high(user_energy,htmlStr){
	 var user_high = $('#u_energy').val();
	if(user_energy == user_high){
		$.ajax({
			   type: "POST",
			   url: "boosts.php",
			   data: "energy=" + user_energy + "name=" + htmlStr,
			   success: function(data){
				   var boost = user_energy + data;
				   $('#u_energy').html(boost);
			   }
			   });
	} else {
		$('#u_energy').html(user_energy);
	}
}
//Upgraded
function upgraded(cool){
	if(cool >= 240001){
		//upstart 1
		$('#b_next_pg')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
		$('#b_next_pg')
			.livequery('click', function(event) {
										 gogetter("#muscle_2");
										 });
		$("#b_next_pg")
		.livequery(function(){
								$(this)
								.html('<img src=" http://www.12daysoffun.com/hustle/graphics/viewmore_butt.png"/>');
								});	
	} else {
		$("#b_next_pg")
		.livequery(function(){
								$(this)
								.html('<img src=" http://www.12daysoffun.com/hustle/graphics/more_msg.png"/>');
								});
	}
	return false;
}

function upgraded_wea(cool){
	if(cool >= 240001){
		//upstart 1
		$('#next_pg')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
		$('#next_pg')
			.livequery('click', function(event) {
										 gogetter("#inventory_2");
										 });
		$("#next_pg")
		.livequery(function(){
								$(this)
								.html('<img src=" http://www.12daysoffun.com/hustle/graphics/viewmore_butt.png"/>');
								});		
	} else {
		$("#next_pg")
		.livequery(function(){
								$(this)
								.html('<img src=" http://www.12daysoffun.com/hustle/graphics/more_msg.png"/>');
								});
	}
	return false;
}

function upgraded_ass(cool){
	if(cool >= 240001){
		//upstart 1
		$('#king_button')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
		$('#king_button')
			.livequery('click', function(event) {
										 gogetter("#assets_2");
										 });
		$("#king_button")
		.livequery(function(){
								$(this)
								.html('<img src=" http://www.12daysoffun.com/hustle/graphics/viewmore_butt.png"/>');
							});
	} else {
		$("#king_button")
		.livequery(function(){
								$(this)
								.html('<img src=" http://www.12daysoffun.com/hustle/graphics/more_msg.png"/>');
							});
	}
	return false;
}
//
function boss_settings(cool){
	if(cool >= 702001){
		//upstart 1
		$('#crew_sets')
			.livequery(function(){
								$(this)
								.removeAttr('disabled');
								});
		$('#pvt_submit')
			.livequery(function(){
								$(this)
								.removeAttr('disabled');
								});
	} else {
		$('#crew_sets')
			.livequery(function(){
								$(this)
								.attr("disabled","disabled");
								});
		$('#pvt_submit')
			.livequery(function(){
								$(this)
								.attr("disabled","disabled");
								});	
	}
	return false;
}
//has the user just lost or won?
function arcade_results(user){
	$.ajax({
					   type: "POST",
					   url: "highscorer.php",
					   data: "name=" + user,
					   success: function(data){
						   if(data == 1){
														  tb_show("<embed src='../file/app-8.mp3' height=0>","../graphics/newhighscore.png","");
							   } else if(parseInt(data) == 2) {
															  tb_show("<embed src='../file/laugh-02.mp3' height=0>","../file/loser.png","");
							   }
					   }
		   });	
	return false;
}
//newsdesk
function newswire(htmlStr){
	$("#newsdesk")
	.livequery(function(){ 
    // use the helper function hover to bind a mouseover and mouseout event 
        $(this) 
            .load("msnbc.php", {data: htmlStr});
						});
	return false;
}
//load
function gogetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){			
				 eandc(htmlStr);
				 desktop(htmlStr);
				 w_stats(htmlStr);
				 m_stats(htmlStr);
				 detective(htmlStr);
				 hallmark(htmlStr);
				 thelist(htmlStr);
				 scout(htmlStr);
				 a_stats(htmlStr);	
				 theones(htmlStr);
				 ring(htmlStr);
				 fnc_casino(htmlStr);
				 fnc_club(htmlStr);
				  $("#userid")
				  .livequery(function(){
									  $(this)
									  .val(htmlStr);
									  });
				 $("#content").html(html);
		}

	});
return false;
}
function profilegetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
				 desktop(htmlStr);
				 profiler(htmlStr);
				 eandc(htmlStr);
				  $("#userid")
				  .livequery(function(){
									  $(this)
									  .val(htmlStr);
									  });
				 $("#content").html(html);
		}

	});
return false;
}
//store
function storegetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
				 desktop(htmlStr);				 
				 flags();
				 eandc(htmlStr);
				  $("#userid")
				  .livequery(function(){
									  $(this)
									  .val(htmlStr);
									  });
				 $("#content").html(html);
		}
	   });
return false;
}
//Criminal Mission ready
function mission_ready(status,game,task,user_tcash,user_tbonus,user_tfee,score){
		if(status == 1){
			$('#escalade').css('cursor','pointer');
			$('#escalade').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/escalade.png" width="95" height="49" />');		
			$('#escalade').show();
			if(task==1){
				//pickup
				url = "http://www.12daysoffun.com/hustle/graphics/pickup.png";
			} else if(task==2){
				//dropoff
				url = "http://www.12daysoffun.com/hustle/graphics/delivery.png";
			}
			$('#escalade').click(function(){				  
					$('#spree_exit').show();
					$('#rider').show();
					$('#task_n').attr("src", url);					
					$('#required').html("Min. Score Needed: " + score);
					$('#incents').html("Cash Reward: $" + user_tcash + " CP Reward: " + user_tbonus);
					$('#c_spree').show();
										  });
			$('#cops').hide();
		} else if(status == 2){
			$('#escalade').css('cursor','pointer');
			$('#escalade').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/escalade.png" width="95" height="49" />');		
			$('#escalade').show();
			if(task==1){
				//pickup
				url = "http://www.12daysoffun.com/hustle/graphics/pickup.png";
			} else if(task==2){
				//dropoff
				url = "http://www.12daysoffun.com/hustle/graphics/delivery.png";
			}
			$('#escalade').click(function(){				  
					$('#spree_exit').show();
					$('#rider').show();
					$('#task_n').attr("src", url);					
					$('#required').html("Min. Score Needed: " + score);
					$('#incents').html("Cash Reward: $" + user_tcash + " CP Reward: " + user_tbonus);
					$('#c_spree').show();
										  });
			$('#cops').hide();
		} else if(status == 3){
			//magic
			$('#escalade').css('cursor','pointer');
			$('#escalade').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/escalade.png" width="95" height="49" />');		
			$('#escalade').show();
			$('#escalade').click(function(){				  
					$('#spree_exit').show();
					$('#rider').show();
					$('#task_n').attr("src", "http://www.12daysoffun.com/hustle/graphics/shipment.png");
					$('#required').html("Min. Score Needed: " + score);
					$('#incents').html("Cost: $" + user_tfee);
					$('#c_spree').show();
											  });
			$('#cops').hide();	
		} else if(status == 4){
			//media
			$('#escalade').css('cursor','pointer');
			$('#escalade').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/escalade.png" width="95" height="49" />');		
			$('#escalade').show();
			$('#escalade').click(function(){				  
					$('#spree_exit').show();
					$('#rider').show();
					$('#task_n').attr("src", "http://www.12daysoffun.com/hustle/graphics/boot_shipment.png");
					$('#required').html("Min. Score Needed: " + score);
					$('#incents').html("Cost: $" + user_tfee);
					$('#c_spree').show();
											  });
			$('#cops').hide();
		} else if(status == 5){
			//lotto
			$('#escalade').css('cursor','pointer');
			$('#escalade').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/escalade.png" width="95" height="49" />');		
			$('#escalade').show();
			$('#escalade').click(function(){				  
					$('#spree_exit').show();
					$('#rider').show();
					$('#task_n').attr("src", "http://www.12daysoffun.com/hustle/graphics/lotto.png");
					$('#required').html("Min. Score Needed: " + score);
					$('#incents').html("Cost: $" + user_tfee);
					$('#c_spree').show();
											  });
			$('#cops').hide();	
		} else if(status == 86){
			$('#escalade').css('cursor','pointer');
			$('#escalade').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/escalade.png" width="95" height="49" />');		
			$('#escalade').show();
			$('#escalade').click(function(){				  
					$('#spree_exit').show();
					$('#rider').show();
					$('#task_n').attr("src", "http://www.12daysoffun.com/hustle/graphics/quitter.png");
					$('#incents').html("Reputation Cost: " + user_tfee);
					$('#c_spree').show();
											  });
			//give option to quit current
			$('#cops').hide();
		}
	return false;
}
//Investigation start
function chase_ready(status){
		if(status == 1){
			$('#cops').css('cursor','pointer');
			$('#cops').html('<img src="../graphics/police-car-animated.gif" width="113" height="50" />');
			$('#cops').show();
			$('#escalade').hide();
		} else if(status == 5){
			
		} else if(status == 86){
			
		}
	return false;
}
//mission signup
function first_crime(cont,initiate){
	if(cont == 0){
		if(initiate == 1){
			$('#gang_app').show();
			$('#r_exit_tks').show();
			$('#r_decision').show();
			eandc(htmlStr);
		}
	}
	return false;
}
function academy(cont,initiate){	
	if(cont == 0){
		if(initiate == 1){
			$('#cops_app').show();
			$('#c_exit_tks').show();
			$('#c_decision').show();
			eandc(htmlStr);
		}
	}
	return false;
}

// prepare the fight form when the DOM is ready 
jQuery(function() { 
    $('#fight_form')
	.livequery(function(){
	$(this)					
	.ajaxForm({ 			 
        target: '#play', 
		beforeSubmit: vform,
        success: function(data) {
			if(data==1){
				$('#Impulse_Buy').show();
				$('#impulse_exit').show();
				$('#impulse_sold').show();
			} else if(data==2) {
				$('#Impulse_Buy_tks').show();
				$('#impulse_exit_tks').show();
				$('#impulse_sold_tks').show();
			} else if(data==3){
				tb_show("Game Doesn't Exist","../graphics/sorry.png","");
			} else if(data==4){
				tb_show("SELECT a someone to play against.","../graphics/sorry_person.png","");
			} else if(data==5){
				tb_show("SELECT your style of play.","../graphics/sorry_style.png","");
			} else {		
				$('#fight_page')
				.livequery(function(){
					$(this)
					.slideUp('slow');
									});
				$('#play')
				.livequery(function(){
					$(this)
					.fadeIn('slow');
									});
				$('#play')
				.livequery(function(){
					$(this)
					.fadeOut(30000);
									});
			$.getJSON("smgtrack_ajax.php", { data: htmlStr }, function(json){
											var user_energy = json.energy;
											var user_cash = json.cash;
											var user_energy_max = json.energy_max;
											$('#dollar_val')
											.livequery(function(){
											$(this)
											.replaceWith(user_cash);
																});
										    $('#u_energy')
											.livequery(function(){
											$(this)
											.replaceWith(user_energy);
																});
											test(user_energy,user_energy_max);
									   });
			
        }
		}
			  }); 
						}); 
});
//fight form validation
function vform(){ 
    $("#fight_name_error").empty().hide(); 
    $("#wager_error").empty().hide(); 
 
    var product_name         = $("#game").val(); 
    var product_quantity    = $("#wager").val(); 
 
    var errors                 = 0; 
 
    if (product_name == null || product_name == '') 
    { 
        $("#fight_name_error").show() 
.append("Game Name is required"); 
        errors++; 
    } 
    if (product_quantity == null || product_quantity == '') 
    { 
        $("#wager_error").show() 
.append("A Wager is required"); 
        errors++; 
    } 
    else if (!isNumeric(product_quantity)) 
    { 
        $("#wager_error").show() 
.append("Wager should be numeric"); 
        errors++; 
    } 
 
    if (errors > 0) 
    { 
        alert ("Errors were found on the form"); 
        return false; 
    } 
 
}         
 
function isNumeric(form_value){ 
    if (form_value.match(/^\d+$/) == null) 
        return false; 
    else 
        return true; 
} 
//weapon page setup
function w_stats(htmlStr){
	$.post("case_stats.php", {data: htmlStr}, function(results) {
											 var user_squirt = results.squirt;
											 var user_rocks = results.rocks; 
											 var user_bbgun = results.airr;
											 var user_knife = results.knife;
											 var user_bats = results.bat;
											 var user_cbars = results.crowb;
											 var user_tommygun = results.gun;
											 var user_assaultr = results.arifle;
											 var user_ak47 = results.ak47;
											 var user_lilgun = results.lilgun;
											 var user_grenade = results.grenade;
											 var user_sniper = results.sniper;
											 var weap_upkeep = results.upkeep;
											 var user_cool = results.cool;
									 $('#squirt_owned')
									 .livequery(function(){
											$(this)
											.html("Owned:" + user_squirt);
														 });								 
									 $('#rocks_owned')
									 .livequery(function(){
											$(this)
											.html("Owned:" + user_rocks);
														 });
									 $('#bbgun_owned')
									 .livequery(function(){
											$(this)
											.html("Owned:" + user_bbgun);
														 });
									 $('#knife_owned')
									 .livequery(function(){
											$(this)
											.html("Owned:" + user_knife);
														 });
									 $('#bats_owned')
									 .livequery(function(){
											$(this)
											.html("Owned:" + user_bats);
														 });
									 $('#cbars_owned')
									 .livequery(function(){
											$(this)
											.html("Owned:" + user_cbars);
														 });
									 $('#tommygun_owned')
									 .livequery(function(){
											$(this)
											.html("Owned:" + user_tommygun);
														 });
									 $('#assaultr_owned')
									 .livequery(function(){
											$(this)
											.html("Owned:" + user_assaultr);
														 });
									 $('#ak47_owned')
									 .livequery(function(){
											$(this)
											.html("Owned:" + user_ak47);
														 });
									 $('#super_owned')
									 .livequery(function(){
											$(this)
											.html("Owned:" + user_lilgun);
														 });
									 $('#grenade_owned')
									 .livequery(function(){
											$(this)
											.html("Owned:" + user_grenade);
														 });
									 $('#sniper_owned')
									 .livequery(function(){
											$(this)
											.html("Owned:" + user_sniper);
														 });
									 $('.wup_keep_val')
									 .livequery(function(){
											$(this)
											.html("-" + weap_upkeep);
														 });
									 upgraded_wea(user_cool);
									 
													  
									}, "json");	
	return false;
}
// prepare the weapon a form when the DOM is ready 
jQuery(function() { 
				
    // bind form using ajaxForm 
    $('#squirt_gun')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#squirt_owned',
				success: function(data) {
					eandc(htmlStr);
				}
					  });
						});
});
// prepare the weapon a form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#rocks')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#rocks_owned',
				success: function(data) {
					eandc(htmlStr);
				}
					  });
						});
});
// prepare the weapon a form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#airr')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#bbgun_owned',
				success: function(data) {
					eandc(htmlStr);
				}
					  });
						});
});
// prepare the weapon a form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#knife')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#knife_owned',
				success: function(data) {
					eandc(htmlStr);
				}
					  });
						});
});
// prepare the weapon a form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#bat')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#bats_owned',
				success: function(data) {
					eandc(htmlStr);
				}
					  });
						});
});
// prepare the weapon a form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#crowb')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#cbars_owned',
				success: function(data) {
					eandc(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#tommygun')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#tommygun_owned',
				success: function(data) {
					eandc(htmlStr);
					w_stats(htmlStr);
				}
					  });
						});
}); 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#assaultr')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#assaultr_owned',
				success: function(data) {
					eandc(htmlStr);
					w_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#ak47')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#ak47_owned',
				success: function(data) {
					eandc(htmlStr);
					w_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#super')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#super_owned',
				success: function(data) {
					eandc(htmlStr);
					w_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#grenade')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#grenade_owned',
				success: function(data) {
					eandc(htmlStr);
					w_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#sniper')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sniper_owned',
				success: function(data) {
					eandc(htmlStr);
					w_stats(htmlStr);
				}
					  });
						});
});
function scout(htmlStr){
	$("#mark_body")
	.livequery(function(){
			$(this)
			.load("recruit_backing.php", {data: htmlStr}, function(){
																   });
						});
	return false;
}
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#crew_app')
	.livequery(function() {
			$(this).ajaxForm({
						target: '#suc',
						beforeSubmit: cform,
						success: function() { 
							$('#suc').fadeIn('fast');
							$('#suc').fadeOut(3000);
							eandc(htmlStr);
						}
															  });
									});
				});
function cform(){  
    $("#offer_error").empty().hide(); 
 
    var product_quantity    = $("#cashoffer").val(); 
 
    var errors                 = 0; 
 
    if (product_quantity == null || product_quantity == '') 
    { 
        $("#offer_error").show() 
.append("An Offer is required"); 
        errors++; 
    } 
    else if (!isNumeric(product_quantity)) 
    { 
        $("#offer_error").show() 
.append("Offer should be numeric"); 
        errors++; 
    } 
 
    if (errors > 0) 
    { 
        alert ("Errors were found on the form"); 
        return false; 
    } 
 
}         
//muscle page set up
function m_stats(htmlStr){
	$.post("gym_stats.php", {data: htmlStr}, function(results) {
											 var user_s = results.sguard;
											 var user_sap = results.mutt;
											 var user_sp = results.thug;
											 var user_h = results.bguard;
											 var user_lux = results.g4hire;
											 var user_hot = results.special;
											 var user_top = results.para; 
											 var user_bigq = results.bhunt;
											 var user_plant = results.hitman;
											 var user_merc = results.merc;
											 var user_state = results.war;
											 var user_castle = results.nina;
											 var user_army = results.army;
											 var muscle_upkeep = results.upkeep;
											 var user_cool = results.cool;
									 $('#sguard_owned').html("Retained:" + user_s);
									 $('#mutt_owned').html("Retained:" + user_sap);
									 $('#thug_owned').html("Retained:" + user_sp);
									 $('#bguard_owned').html("Retained:" + user_h);
									 $('#g4hire_owned').html("Retained:" + user_lux);
									 $('#special_owned').html("Retained:" + user_hot);
									 $('#para_owned').html("Retained:" + user_top);
									 $('#bhunt_owned').html("Retained:" + user_bigq);
									 $('#hitman_owned').html("Retained:" + user_plant);
									 $('#merc_owned').html("Retained:" + user_merc);
									 $('#war_owned').html("Retained:" + user_state);
									 $('#ninja_owned').html("Retained:" + user_castle);
									 $('#army_owned').html("Retained:" + user_army);
									 $('.mup_keep_val').html("-" + muscle_upkeep);
									 upgraded(user_cool);
													  
									}, "json");	
	return false;
}

// prepare the muscle form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#sguards')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sguard_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#mutts')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#mutt_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#thugs')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#thug_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#g4hires')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#g4hire_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#bguards')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#bguard_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#specials')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#special_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#paras')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#para_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#bhunts')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#bhunt_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#hitmen')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#hitman_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#mercs')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#merc_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#wars')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#war_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#ninjas')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#ninja_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#armies')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#army_owned',
				success: function(data) {
					eandc(htmlStr);
					m_stats(htmlStr);
				}
					  });
						});
});
//
function detective(htmlStr){
	$("#private_l")
	.livequery(function(){ 
    // use the helper function hover to bind a mouseover and mouseout event 
        $(this) 
            .load("detective.php", {data: htmlStr}, function(){
															 });
			eandc(htmlStr);	
						});
	return false;
}
function hallmark(htmlStr){
	$("#weapon_row")
	.livequery(function(){
        $(this) 
            .load("gift.php #weaps", {data: htmlStr});
						});
	$("#muscle_row")
	.livequery(function(){
        $(this) 
            .load("gift.php #gym", {data: htmlStr});
						});
	$("#asset_row")
	.livequery(function(){
        $(this) 
            .load("gift.php #homes", {data: htmlStr});
						});
	$("#c_members")
	.livequery(function(){
        $(this) 
            .load("gift.php #mycrew", {data: htmlStr});
						});
	return false;
}
function thelist(htmlStr){
	$("#target_body")
	.livequery(function(){
        $(this) 
            .load("hitlist_back", {data: htmlStr});
			eandc(htmlStr);	
						});
	return false;
}
jQuery(function() { 
    // bind form using ajaxForm 
    $('#pvthitlist')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#heistresults',
				success: function(data) {
					$('#heistresults').fadeIn('fast');
					$('#heistresults').fadeOut(5000);
					detective(htmlStr);
				}
					  });
						});
				});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#gifs')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#gift_card',
				success: function(data) {
			$('#gift_card').fadeIn('fast');
			$('#gift_card').fadeOut(5000);
			eandc(htmlStr);	
				}
					  });
						});
				});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#bad_guy')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#hit_status',
				success: function() {
			$('#hit_status').fadeIn('fast');
			$('#hit_status').fadeOut(5000);
			thelist(htmlStr);
				}
					  });
						});
				});
//Overlay
jQuery(function() { 
    // bind form using ajaxForm 
    $('#hit_form')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#hit_results',
				success: function() {
			$('#bad_guy').hide();
			$('#hit_results').fadeIn('fast');
			$('#hit_results').fadeOut(8000);
			$('#bad_guy').show();
			thelist(htmlStr);
			$('#hit_results').html(data);
		}
					  });
						});
				});
//profile page
function profiler(htmlStr){
	$.post("profile.php", {data: htmlStr}, function(results) {
											 var user_flow = results.flow;
											 var user_overhead = results.overhead;
											 var user_gross = results.gross;
											 var user_ch_won = results.ch_won;
											 var user_ch_lost = results.ch_lost;
											 var user_rob_won = results.rob_won;
											 var user_rob_lost = results.rob_lost; 
											 var user_robbed_tot = results.robbed_tot;
											 var user_heist_won = results.heist_won;
											 var user_heist_lost = results.heist_lost;
											 var members_fired = results.pink_slips;
											 var user_fired = results.fired;
											 var user_rank = results.my_rank;
											 var user_flight = results.my_rfs;
											 var user_crew_rank = results.crew_rank;
											 var crew_flight = results.my_crfs;
									 $('#ch_won').html(user_ch_won);
									 $('#ch_lost').html(user_ch_lost);
									 $('#fired_stat').html(user_fired);
									 $('#shrink_rate').html(members_fired);
									 $('#heists_good').html(user_heist_won);
									 $('#heists_bad').html(user_heist_lost);
									 $('#rob_good').html(user_rob_won);
									 $('#rob_bad').html(user_rob_lost);
									 $('#times_robbed_stat').html(user_robbed_tot);
									 $('#yrank_stat').html(user_rank);
									 $('#yrankfc_stat').html(user_flight);
									 $('#ycrank_stat').html(user_crew_rank);
									 $('#ycrankfs_stat').html(crew_flight);
									 $('#gross_stat').html(user_gross);
									 $('#upkeep').html(user_overhead);
									 $('#cashflow').html(user_flow);
									 
													  
									}, "json");	
	
	$("#weapons_hud")
	.livequery(function(){
        $(this) 
            .load("gifts_profile.php #weaps", {data: htmlStr});
						});
	$("#muscle_hud")
	.livequery(function(){
        $(this) 
            .load("gifts_profile.php #gym", {data: htmlStr});
						});
	$("#assets_hud")
	.livequery(function(){
        $(this) 
            .load("gifts_profile.php #homes", {data: htmlStr});
						});
	$(".achievement_updates")
	.livequery(function(){
        $(this) 
            .load("personal_achievements.php", {data: htmlStr});
						});
	return false;
}
//asset page set up
function a_stats(htmlStr){
	$.post("asset_stats.php", {data: htmlStr}, function(results) {
											 var user_sap = results.sap;
											 var user_h = results.h;
											 var user_lux = results.lux;
											 var user_hot = results.hot;
											 var user_top = results.top;
											 var user_bigq = results.bigq;
											 var user_plant = results.plant; 
											 var user_state = results.state;
											 var user_castle = results.castle;
											 var user_isle = results.isle;
											 var user_mortgage = results.upkeep;
											 var user_cool = results.cool;
									 $('#studio_owned').html("Owned:" + user_sap);
									 $('#house_owned').html("Owned:" + user_h);
									 $('#luxapar_owned').html("Owned:" + user_lux);
									 $('#condo_owned').html("Owned:" + user_hot);
									 $('#penthouse_owned').html("Owned:" + user_top);
									 $('#mansion_owned').html("Owned:" + user_bigq);
									 $('#manor_owned').html("Owned:" + user_plant);
									 $('#palace_owned').html("Owned:" + user_state);
									 $('#emppal_owned').html("Owned:" + user_castle);
									 $('#isle_owned').html("Owned:" + user_isle);
									 $('.aup_keep_val').html("-" + user_mortgage);
									 upgraded_ass(user_cool);
													  
									}, "json");	
	return false;
}
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#studio')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#studio_owned',
				success: function(data) {
					eandc(htmlStr);
					a_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#starter')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#house_owned',
				success: function(data) {
					eandc(htmlStr);
					a_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#apartment')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#luxapar_owned',
				success: function(data) {
					eandc(htmlStr);
					a_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#condo')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#condo_owned',
				success: function(data) {
					eandc(htmlStr);
					a_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#pent')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#penthouse_owned',
				success: function(data) {
					eandc(htmlStr);
					a_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#mansion')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#mansion_owned',
				success: function(data) {
					eandc(htmlStr);
					a_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#manor')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#manor_owned',
				success: function(data) {
					eandc(htmlStr);
					a_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#palace')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#palace_owned',
				success: function(data) {
					eandc(htmlStr);
					a_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#emperor')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#emppal_owned',
				success: function(data) {
					eandc(htmlStr);
					a_stats(htmlStr);
				}
					  });
						});
});
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#isle')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#isle_owned',
				success: function(data) {
					eandc(htmlStr);
					a_stats(htmlStr);
				}
					  });
						});
});
//fight screen
function ring(htmlStr){
	$("#body_mark")
	.livequery(function(){
        $(this) 
		.load("fight.php #fighters", {data: htmlStr});
						});
	return false;
}
jQuery(function() { 
	$('.page')
	.livequery('click', function(event) {
					 tb_show("Arcade","game_listing.php?keepThis=true&TB_iframe=false&height=435&width=700","");
										 });
});

function theones(htmlStr){
	$("#top10_c")	
	.livequery(function(){ 
        $(this) 
            .load("thering.php #top_crews");
						});
	$("#bot10_c")	
	.livequery(function(){ 
        $(this) 
            .load("thering.php #bot_crews");
						});
	$("#top10_p")	
	.livequery(function(){ 
        $(this) 
            .load("thering.php #top_players");
						});
	$("#bot10_p")	
	.livequery(function(){ 
        $(this) 
            .load("thering.php #bot_players");
						});
	$("#top10_g")	
	.livequery(function(){ 
        $(this) 
            .load("thering.php #top_games");
						});
	$("#bot10_g")	
	.livequery(function(){ 
        $(this) 
            .load("thering.php #bot_games");
						});
	return false;
}
function desktop(htmlStr){
	$.post("profile.php", {data: htmlStr}, function(results) {
											 var user_rank = results.my_rank;
											 var user_set = results.attack;
											 var user_win_share = results.win_sh;
											 var user_loss_share = results.loss_sh;
											 var user_cir_share = results.cw_sh;
											 var user_cirl_share = results.cl_sh;
									 $('#myrank').html(user_rank);
									 $("#nat_win_share").val(user_win_share);
									 $("#nat_loss_share").val(user_loss_share);
									 $("#circ_win_share").val(user_cir_share);
									 $("#circ_loss_share").val(user_cirl_share);
									 $('#rd').html("Current Setting: " + user_set);
									}, "json");	
	 
	
	$("#fire_shake")
	.livequery(function(){ 
    // use the helper function hover to bind a mouseover and mouseout event 
        $(this) 
		.load("management_backing.php #shrink", {data: htmlStr});						
						});
	$("#coffers")
	.livequery(function(){ 
    // use the helper function hover to bind a mouseover and mouseout event 
        $(this)
		.load("management_backing.php #offers", {data: htmlStr});
						});
	return false;
}
// prepare the fight form when the DOM is ready 
jQuery(function() { 
    // bind form using ajaxForm 
    $('#shrinkage')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#conf',
				success: function() {
					eandc(htmlStr);
					profiler(htmlStr);		
					desktop(htmlStr);
					$('#conf').fadeIn('fast');
					$('#conf').fadeOut(5000);
				} 
					  });
						});
});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#cash_offers')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#conf',
				success: function() {
					eandc(htmlStr);
					profiler(htmlStr);		
					desktop(htmlStr);
					$('#conf').fadeIn('fast');
					$('#conf').fadeOut(5000);
				} 
					  });
						});
});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#share_v')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#conf',
				success: function() {
					eandc(htmlStr);		
					desktop(htmlStr);
					$('#conf').fadeIn('fast');
					$('#conf').fadeOut(5000);
				} 
					  });
						});
});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#ridedie')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#conf',
				success: function() {		
					desktop(htmlStr);
					$('#conf').fadeIn('fast');
					$('#conf').fadeOut(5000);
				} 
					  });
						});
});
//News Clearing Section
jQuery(function() {
$('.tab_clear').click(function(){
		$.ajax({
			   type: "POST",
			   url: "news_clear.php",
			   data: "name=" + htmlStr,
			   success: function(data){
				   newswire(htmlStr);
			   }
			   });
							   });
$('#clear_pvt')
.livequery('click', function(event) {
						$.ajax({
							   type: "POST",
							   url: "hits_clear.php",
							   data: "name=" + htmlStr,
							   success: function(data){
								   detective(htmlStr);
								   alert(data);
							   }
							   });
							 });
				});
// Store Forms
function flags(){
	$("#flaglist")
	.livequery(function(){ 
    // use the helper function hover to bind a mouseover and mouseout event 
        $(this) 
		.load("flags.php", {data: htmlStr});						
						});
}
//
jQuery(function() { 
    // bind form using ajaxForm 
    $('#1uinh')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sum',
				success: function(data) {
					if(data==1){
						//buy more
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/tks_buy_alert.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();
					}else if(data==8){
						//lotto
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/lotto_picked.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();
						eandc(htmlStr);
					}
				}
					  });
						});
});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#3uinh')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sum',
				success: function(data) {
					if(data==1){
						//buy more
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/tks_buy_alert.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();
					}else if(data==7){
						//magic
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/magic_delivery.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();
						eandc(htmlStr);
					}
				}
					  });
						});
});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#1uest')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sum',
				success: function(data) {
					if(data==1){
						//buy more
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/tks_buy_alert.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();
					}else if(data==6){
						//rehab
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/rehab_cert.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();
						eandc(htmlStr);
					}
				}
					  });
						});
});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#3uest')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sum',
				success: function(data) {
					if(data==1){
						//buy more
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/tks_buy_alert.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();
					}else if(data==5){
						//crew flag
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/flag_id.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();
						eandc(htmlStr);
					}
				}
					  });
						});
});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#full_e')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sum',
				success: function(data) {
					if(data==1){
						//buy more
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/tks_buy_alert.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();
					}else if(data==4){
						//Energy refilled
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/fill_alert.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();
						$('#clock_energy').css('display', 'none');
						eandc(htmlStr);
					}
				}
					  });
						});
});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#twin')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sum',
				success: function(data) {
					if(data==1){
						//buy more
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/tks_buy_alert.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();						
					} else if(data==3){
						//Energy refilled
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/payout.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();
						eandc(htmlStr);
					}
				}
					  });
						});
});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#nname')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sum',
				success: function(data) {
					if(data==1){
						//buy more
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/tks_buy_alert.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();						
					} else if(data==2){
						//new name
						$('#namor').show();
						eandc(htmlStr);
					}
				}
					  });
						});
});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#registrar')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sum',
				success: function(data) {
					if(data==1){
						//taken
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/name_taken.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();						
					} else if(data==2){
						$('#namor').hide();
						//new name
						$("#thewords").attr("src", "http://www.12daysoffun.com/hustle/graphics/name_good.png");
						$('#delivery_tks').show();
						$('#exit_tks').show();
						eandc(htmlStr);
					}
				}
					  });
						});
});
//
jQuery(function() { 
    // bind form using ajaxForm 
    $('#mygifts')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#pointers',
				success: function(data) {
					newswire(htmlStr);
					if(data==1){
						tb_show("Gift Added.","../graphics/gift_notice.png","");
					} else if(data==2) {
						tb_show("Gift Rejected.","../graphics/gift_rejected.png","");
					}
					
				}
					  });
						});
});
//Casino
jQuery(function() { 
    // bind form using ajaxForm 
    $('#casino_sold')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#o_p2',
				success: function(data) {
					if(data==1){
							   //failed
  							   $('#cbuy_exit').hide();
							   $('#casino_buy').hide();
							   $('#csfloor').hide();
							   //
							   $('#cbuyf_exit').show();
							   $('#casino_buyf').show();
					} else if(data==2){
							   //success
							   eandc(htmlStr);
							   fnc_casino(htmlStr);
							   $('#cbuy_exit').hide();
							   $('#casino_buy').hide();
							   $('#csfloor').hide();
							   //show casino
							   $('#new_casino').show();
							   $('#new_casino_exit').show();
					}
				}
					  });
						});
				});
//
jQuery(function() { 
    // bind form using ajaxForm 
   
				});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#gamble')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#output',
				success: function(data) {
						//Make a Wager
						$('#bet').hide();
						if(data==1){
							gogetter("#practice");
							tb_show("Casino","casino_listing.php?keepThis=true&TB_iframe=false&height=435&width=700","");					
						}					
				}
					  });
						});
});
//Casino Invest

function lotto_stat(data){
	$("#lotto_pot").html("$" + data);
	$("#lotto_blimp").show();
	return false;
}
//casino screen
function fnc_casino(htmlStr){
	$("#casino_list")
	.livequery(function(){
        $(this) 
		.load("casinostrip.php", {data: htmlStr}, function(){							   
				$('#invest_casino').ajaxForm({ 
				target: '#output',
				success: function(data) {
					//share min investment
					if(data==3){
						//not enough cash
						$('#ticker').attr("src", "http://www.12daysoffun.com/hustle/file/pic/fbimages/broke_alert.png");
						$('#investments').show();
						$('#investments_exit').show();
					}else if(data==4){
						//inform
						$('#ticker').attr("src", "http://www.12daysoffun.com/hustle/file/pic/fbimages/investor_alert.png");
						$('#investments').show();
						$('#investments_exit').show()
					}
				}
													 });	
				 $('#enter_casino')
				.livequery(function(){
						$(this)
						.ajaxForm({ 
							target: '#output',
							success: function(data) {
								if(data==1){
									//Make a Wager
									$("bet_box")
									.load("casinostrip.php", {data: htmlStr}, function(){
									$('#bet').show();
									$('#bet_btm').show();
																					   });
								}
							}
								  });
									});
														   });
						});
	return false;
}
function fnc_club(htmlStr){
	$("#club_list")
	.livequery(function(){
        $(this) 
		.load("clubstrip.php", {data: htmlStr});
						});
	return false;
}
</script>
<body style="margin:0;">
<div id="pointers" style="display:none"></div>
<div id="facebook_user"><?php echo $user; ?></div>
<a name="verytop" id="verytop"></a>

<div id="wrapper">
	<div id="header">
  		<div id="external">
    		<table width="0" border="0" cellpadding="0" align="right">
    		  <tr>
    		    <td valign="top"></td>
    		    <td align="right" valign="top"><div class="header" id="instructions">
    		      <div id="redirects">
    		        <div id="privacypolicy">PrivacyPolicy</div>
    		        <div id="support">Support</div>
    		        <div id="terms">ToS</div>
    		        <div id="forums">Forums</div>
  		        </div>
  		      </div></td>
  		    </tr>
  		  </table>
	  </div>
  		<div id="cash_cp">
    		<div id="cp_stat"><span id="u_cool"></span>/<span id="ucool_max"></span><span id="ucool_max_note"></span></div>
    		<div id="cash_stat"><span id="dollar_sign">$</span><span id="dollar_val"></span></div>
  		</div>
        <div id="level">
        	<div id="level_number_stat"></div>
        	<div id="clock_energy" style="display: none;">More in <span class="more_in"><span
						id="countdownSpanEnergy" style="font-size: small"></span></span></div>
        </div>
 		<div id="energy"><table width="340" border="0" cellpadding="0" align="right">
  <tr>
    <td><div id="energy_stat"><span id="u_energy"></span>/<span id="uenergy_max"></span></div></td>
    <td><div id="level_label"></div> </td>
    <td><div id="c_rank"></div></td>
  </tr>
</table>

          <div id="nav_bar">
            <div id="store_section">
            <div id="manage_butt"><img src="http://www.12daysoffun.com/hustle/graphics/store_button.png"/></div>
      	</div>
        <div id="news_butt"><img src="http://www.12daysoffun.com/hustle/graphics/inventory_button.png"/></div>
      	<div id="profile_butt"><img src="http://www.12daysoffun.com/hustle/graphics/invite_button.png"/></a></div>      
      	<div id="home_butt"><img src="http://www.12daysoffun.com/hustle/graphics/home_button.png" width="36" height="11" alt="Home" /></div>
    	</div>
  </div>
</div>
<div class="loading"></div>
<!--Energy_Impulse_Buy_overlay-->
<div id="buynow"></div>
<div id="LoadingOverlay"
	style="position: absolute; top: 200px; left: 283px; width: 180px; text-align: center; z-index: 100; display: none;">
<div style="width: 180px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td style="background-color: #000;"><img
			src="http://12daysoffun.com/clique/graphics/MW_Loading-01.gif" />
		<div id="LoadingRefresh"
			style="text-align: center; padding-bottom: 5px; display: none;"><a
			href="http://apps.facebook.com/the_hustle" title="Try Refreshing" target="_top"
			class="sexy_button" style="float: none">Try Refreshing?</a></div>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!--Impulse_Buy_overlay-->
<div id="Impulse_Buy"
	style="position: absolute; top: 200px; left: 283px; width: 320px; text-align: center; z-index: 100; display: none;">
<div style="width: 320px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td style="background-color: #000;"><div id="impulse_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div><img
			src="http://12daysoffun.com/hustle/graphics/impulse_buy.png" />
		<div id="impulse_sold"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><img src="../../clique/graphics/btn_buynow_paypal2.gif" width="107" height="26" /></div>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!--Token_Impulse_Buy_overlay-->
<div id="Impulse_Buy_tks"
	style="position: absolute; top: 200px; left: 283px; width: 320px; text-align: center; z-index: 100; display: none;">
<div style="width: 320px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td style="background-color: #000;"><div id="impulse_exit_tks"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div><img
			src="http://12daysoffun.com/hustle/graphics/impulse_buy_tks.png" />
		<div id="impulse_sold_tks"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><img src="../graphics/recharge.gif" width="107" height="26" /></div>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!--gift acceptance_overlay-->
<div id="delivery_tks"
	style="position: absolute; top: 200px; left: 253px; width: 320px; text-align: center; z-index: 100; display: none; background:url(../graphics/impulse__bk.png);">
<div style="width: 320px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td style="background-color: #333;"><div id="exit_tks"
			style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div><img id="thewords" src="http://www.12daysoffun.com/hustle/graphics/impulse_buy_tks.png" />
		<div id="tks"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><img src="../graphics/recharge.gif" width="107" height="26" /></div>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!--news_overlay-->
<div id="news_tks"
	style="position: absolute; top: 200px; left: 253px; width: 360px; text-align: center; z-index: 200; display: none; background:url(../graphics/news__bk.png);">
<div style="width: 360px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td><div id="news_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px;"><span><img src="../graphics/news_butt.png"/></span><span class="tab_clear">[Clear All News]</span><span id="news_exit_tks" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
		<div id="newsdesk"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/news__bk.png); overflow:auto;"></div>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!--copp_app_overlay-->
<div id="cops_app"
	style="position: absolute; top: 200px; left: 253px; width: 360px; text-align: center; z-index: 100; display: none; background:url(../graphics/news__bk.png);">
<div style="width: 360px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td style="background-color: #000;"><div id="c_exit_tks"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div><img src="http://www.12daysoffun.com/hustle/graphics/new_recruit.png" />
		<div id="c_decision"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><div id="caccept"><img src="../graphics/accept.png" width="107" height="26" /></div><div id="cecline"><img src="../graphics/decline.png" width="107" height="26" /></div></div>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!--crime_app_overlay-->
<div id="gang_app"
	style="position: absolute; top: 200px; left: 253px; width: 360px; text-align: center; z-index: 100; display: none; background:url(../graphics/news__bk.png);">
<div style="width: 360px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td style="background-color: #000;"><div id="r_exit_tks"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div><img id="rhom" src="http://www.12daysoffun.com/hustle/graphics/new_criminal.png" />
		<div id="r_decision"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><div id="raccept"><img src="../graphics/accept.png" width="107" height="26" /></div><div id="recline"><img src="../graphics/decline.png" width="107" height="26" /></div></div>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!--CrimeMission_overlay-->
<div id="c_spree"
	style="position: absolute; top: 200px; left: 253px; width: 320px; text-align: center; z-index: 100; display: none; background:url(../graphics/impulse__bk.png);">
<div style="width: 320px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td><div id="spree_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div><img id="task_n" src="http://www.12daysoffun.com/hustle/graphics/new_criminal.png" /><div id="required"></div><div id="incents"></div>
		<div id="rider"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><span id="wespree"><img src="../graphics/accept.png" width="107" height="26" /></span><span id="nospree"><img src="../graphics/decline.png" width="107" height="26" /></span></div>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!--BMarket_overlay-->
<div id="bm_dealer"
	style="position: absolute; top: 125px; left: 253px; width: 413px; text-align: center; z-index: 150; display: none; background:url(../graphics/impulse__bk.png);">
<div style="width: 320px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td><div id="bm_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div><img id="task_n" src="http://www.12daysoffun.com/hustle/graphics/dealer_info.png" />
            <form action="the_fence.php" method="post" name="the_fence">
                  <p>
                    <select name="options" size="1">
                      <option value="lotto">Lotto Ticket</option>
                      <option value="dvd">Bootleg DVD</option>
                      <option value="magic" selected="selected">Blue Magic</option>
                    </select>
                    <label>
                      <br />
                      <br />
                      Quantity
                      <input name="quantity" type="text" id="quantity" size="14" maxlength="7" />
                      Your Offer $
                    </label>
                    <label>
                      <input name="d_offer" type="text" id="dealer_offer" size="12" />
                    </label> 
                    .00  </p>
                  <p>
                    <label>
                      Enter Your Dealer:
                      <input type="text" name="dealer_name" id="dealer_name" />
                    </label>
                    <label>
                      <input type="submit" name="Submit" id="post_offer" value="Submit" />
                    </label>
                  </p>
             </form>
		<div id="dealer_btm"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"></div>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!--cnn-->
<div id="namor"
	style="position: absolute; top: 125px; left: 253px; width: 213px; text-align: center; z-index: 150; display: none; background:url(../graphics/impulse__bk.png);">
<div style="width: 320px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td><div id="namor_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <form id="registrar" action="namor.php" method="post" name="registrar">
                    <label>
                      Enter Your NEW crew name:
                      <input type="text" name="crew_name" id="crew_name" />
                    </label>
                    <label>
                    <input type="hidden" id="crewname" name="crewname" value="crewname"/>
                      <input type="submit" name="Submit" id="post_name" value="Submit" />
                      <input type="hidden" id="userid" name="customer" value="$user"/>
                    </label>
             </form>
		<div id="register_btm"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"></div>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!--casino_buy-->
<div id="casino_buy"
	style="position: absolute; top: 200px; left: 253px; width: 320px; text-align: center; z-index: 100; display: none; background:url(../graphics/impulse__bk.png);">
<div style="width: 320px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td><div id="cbuy_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div><img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/casino_info.png" />
		<div id="csfloor"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><form id="casino_sold" action="franchise.php" method="post" name="casino_sold"><input type="hidden" id="userid" name="customer" value="$user"/><input type="hidden" id="casinoid" name="franchise" value="casino"/><input type="image" src="../file/pic/fbimages/buy_button.png" name="buynow"></form><div id="o_p2" style="display:none;"></div></div>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!--franchise fail-->
<div id="casino_buyf"
	style="position: absolute; top: 200px; left: 253px; width: 320px; text-align: center; z-index: 100; display: none; background:url(../graphics/impulse__bk.png);">
<div style="width: 320px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td><div id="cbuyf_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div><img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/broke_alert.png" />
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!-- New casino -->
<div id="new_casino"
	style="position: absolute; top: 200px; left: 253px; width: 320px; text-align: center; z-index: 100; display: none; background:url(../graphics/impulse__bk.png);">
<div style="width: 320px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td><div id="new_casino_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div><img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/casino_success.png" />
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!-- Wager-->
<div id="bet"
	style="position: absolute; top: 125px; left: 253px; width: 213px; text-align: center; z-index: 150; display: none; background:url(../graphics/impulse__bk.png);">
<div style="width: 320px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td><div id="bet_box"></div>
		<div id="bet_btm"
			style="text-align: center; padding-bottom: 10px; display: none; background:url(../graphics/impulse__bk.png)"></div>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!--Invester Alert -->
<div id="investments"
	style="position: absolute; top: 200px; left: 253px; width: 320px; text-align: center; z-index: 100; display: none; background:url(../graphics/impulse__bk.png);">
<div style="width: 320px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td><div id="investments_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div><img id="ticker" src="http://www.12daysoffun.com/hustle/file/pic/fbimages/broke_alert.png" />
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
<!-- Body-->
    <div id="body">
        <div class="body">
            <div id="content">
            <div id="pointer"></div>
            <div id="lotto_blimp" style="display:none"><img src="../graphics/blimp.png"/>
              <div id="lotto_pot"></div>
            </div>
            <div id="escalade" style="display:none"></div>
<div id="cops"></div>  
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
                <img src="http://www.12daysoffun.com/hustle/graphics/new_back.png" width="749" height="404" />
<div id="apDiv1"><span id="title" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/arcade_gif.png"/></span></div>
                <div id="coliseum"><span id="fight_title" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/coliseum_title.png"/></span></div>
              <div id="apDiv3"><span id="gun_title" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/gunshop_title.png"/></span></div>
                <div id="apDiv4"><span id="muscle_title" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/securityoffice_title.png"/></span></div>
                <div id="apDiv5"><span id="recruiters" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/recruit_title.png"/></span></div>
                <div id="apDiv6"><span id="deed" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/realtor_title.png"/></span></div>
                <div id="apDiv7"><span id="cheats" style="display:none"><img src="http://www.12daysoffun.com/hustle/graphics/store_title.png"/></span><span id="reward_points" style=" background-color:#333;color:#FC0; font-weight:200;"></span><span><img src="http://www.12daysoffun.com/hustle/graphics/tokens_1.png" width="19" height="19" alt="reward points" /></span></div>
              <div id="apDiv9"><span id="market_title" style="display:none"><img src="../graphics/market_title.png"/></span></div>
              <div id="practice_button"><img src="http://www.12daysoffun.com/hustle/graphics/arcade_hall_bk.png" width="272" height="174" /></div>
                  <div id="fight_button"><img src="http://www.12daysoffun.com/hustle/graphics/coliseum_bk.png"/></div>
              <div id="market_button"><img src="../graphics/market_bk.png" width="25" height="220" /></div>
<div id="inv_muscle_2"><img src="http://www.12daysoffun.com/hustle/graphics/securityoffice_bk.png" width="165" height="105" /></div>
                <div id="inventory_button"><img src="http://www.12daysoffun.com/hustle/graphics/gunshop_bk.png" width="145" height="68" /></div>
        <div id="rroffice"><img src="http://www.12daysoffun.com/hustle/graphics/recruit_realtor_bk.png" width="110" height="97" /></div>
                <div id="cheatmall"><img src="http://www.12daysoffun.com/hustle/graphics/store_office_bk.png" width="81" height="52" /></div>
    <div id="crews"><img src="http://www.12daysoffun.com/hustle/graphics/recruit_bk.png" width="198" height="64" /></div>
                <div id="billboard"><img src="http://www.12daysoffun.com/hustle/graphics/billboard_bk.png" width="229" height="156" /></div>
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
</body>
</html>