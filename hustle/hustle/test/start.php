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
<link rel="stylesheet" type="text/css" href="../css/main.css"/>
<link rel="stylesheet" type="text/css" href="../css/thickbox.css"/>
<link rel="stylesheet" type="text/css" href="../css/tabcontent.css" />
<link rel="stylesheet" type="text/css" href="../css/mouseovertabs.css" />
<script type="text/javascript" src="../js/tabcontent.js"></script>
<script type="text/javascript" src="../js/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.livequery.js" charset="utf-8"></script>
<script type="text/javascript">
//mouseovertabsmenu.init("tabs_container_id", "submenu_container_id", "bool_hidecontentsmouseout")
mouseovertabsmenu.init("mytabsmenu", "mysubmenuarea", true)

</script>
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
<script type="text/javascript">
function PublishMessageFacebook() {
           var message = '';
var attachment = {
	'name': '<?php echo ucwords($firstname) ?> needs helping earning CASH!',
	'href': 'http://bit.ly/95SdKD',
	'caption': '{*actor*} is struggling in the Arcade',
	'description': 'Join their crew and earn cash by beating Arcade High Scores', 
	'properties': {
		'Currently the hardest game is': { 'text': 'Super Mario Bros.', 'href': 'http://bit.ly/95SdKD'}
	},
	'media': [{ 'type': 'image', 'src': 'http://www.12daysoffun.com/hustle/file/fb_feed.png', 'href': 'http://bit.ly/95SdKD'}]
	}; 
var action_links = [{'text':'Help <?php echo ucwords($firstname); ?> Now', 'href':'http://bit.ly/95SdKD'}];  
FB.Connect.streamPublish(message, attachment, action_links);
}
</script>
<script type="text/javascript">
//Fights		
function PublishChallenge() {
	<?php
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
					$result = mysql_query($query);
list($firstname) = mysql_fetch_row($result);

$sql = sprintf("SELECT * FROM h_fb_challenges WHERE user1 = ('%s')",
							   $firstname);
				$result = mysql_query($sql);
				$result_ar = mysql_fetch_array($result);
				
				$tid = $result_ar['user2'];
				$wager = $result_ar['wager']; 
				$gamename = $result_ar['gamename'];
				$image = $result_ar['image_icon']; 
				
$sql = sprintf("DELETE FROM h_fb_challenges WHERE user1 = ('%s')",
						mysql_real_escape_string ($firstname));
					mysql_query($sql); 				
?>
           var message = '';
var attachment = {
	'name': '<?php echo ucwords($firstname) ?> has just challenged you!',
	'href': ' http://bit.ly/95SdKD',
	'caption': '{*actor*} bet you $<?php echo $wager ?> they can beat your score',
	'description': 'Play fair or dirty in The Hustle Arcade and win quick $$$ or lose big!', 
	'properties': {

		'The game is': { 'text': '<?php echo ucwords($gamename) ?>', 'href': 'http://bit.ly/95SdKD'}
	},
	'media': [{ 'type': 'image', 'src': 'http://www.12daysoffun.com/hustle/arcade/images/<?php echo $image; ?>', 'href': 'http://bit.ly/95SdKD'}]
	}; 
var action_links = [{'text':'Beat <?php echo ucwords($firstname); ?> Now', 'href':'http://bit.ly/95SdKD'}]; 
var target_id = <?php echo $tid ?>;
FB.Connect.streamPublish(message, attachment, action_links,target_id);
return false;
}
</script>
<script type="text/javascript">
//Fights		
function PublishRaceChallenge() {
	<?php
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
					$result = mysql_query($query);
list($firstname) = mysql_fetch_row($result);

$sql = sprintf("SELECT * FROM h_fb_challenges WHERE user1 = ('%s')",
							   $firstname);
				$result = mysql_query($sql);
				$result_ar = mysql_fetch_array($result);
				
				$tid = $result_ar['user2'];
				$wager = $result_ar['wager']; 
				$gamename = $result_ar['gamename'];
				
$sql = sprintf("DELETE FROM h_fb_challenges WHERE user1 = ('%s')",
						mysql_real_escape_string ($firstname));
					mysql_query($sql); 				
?>
var message = '';
var attachment = {
	'name': '<?php echo ucwords($firstname) ?> has just challenged you!',
	'href': ' http://bit.ly/95SdKD',
	'caption': '{*actor*} bet you $<?php echo $wager ?> they can beat your race time',
	'description': 'PinkSlip Race: Beat their race time and score and take their car!', 
	'properties': {

		'The track is': { 'text': '<?php echo ucwords($gamename) ?>', 'href': 'http://bit.ly/95SdKD'}
	},
	'media': [{ 'type': 'image', 'src': 'http://www.12daysoffun.com/hustle/file/fb_race.png', 'href': 'http://bit.ly/95SdKD'}]
	}; 
var action_links = [{'text':'Beat <?php echo ucwords($firstname); ?> Now', 'href':'http://bit.ly/95SdKD'}]; 
var target_id = <?php echo $tid ?>;
FB.Connect.streamPublish(message, attachment, action_links,target_id);
return false;
}
</script>
<script type="text/javascript">
function PublishScore() {
	<?php
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
	mysql_select_db($dbname);
	
	$sql = sprintf("SELECT gameid FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s') AND arcade = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
	$result=mysql_query($sql);
	list($gameid) = mysql_fetch_row($result);
	
	$sql = sprintf("SELECT score FROM arcade_news WHERE winner = ('%s') AND thickbox = ('%s') AND arcade = ('%s')",
															 mysql_real_escape_string ($user),
															 1,
															 1);
	$result=mysql_query($sql);
	list($score) = mysql_fetch_row($result);
	
	$query = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
						mysql_real_escape_string ($gameid));
			$theresult = mysql_query($query);
	$result_ar = mysql_fetch_array($theresult);
	$gamename = $result_ar['shortname'];
	$image = $result_ar['stdimage'];
	
	$query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
					$result = mysql_query($query);
	list($firstname) = mysql_fetch_row($result);
?>
    var message = '';
	var attachment = {
		'name': '<?php echo ucwords($firstname) ?> just earned a new high score!',
		'href': ' http://bit.ly/95SdKD',
		'caption': 'Can you beat {*actor*}&acute;s score of <?php echo $score; ?>?',
		'description': 'The Hustle Arcade often pays out cash and cool points when you beat high scores!', 
		'properties': {
			'The game was': { 'text': '<?php echo ucwords($gamename) ?>', 'href': 'http://bit.ly/95SdKD'}
		},
		'media': [{ 'type': 'image', 'src': 'http://www.12daysoffun.com/hustle/arcade/images/<?php echo $image; ?>', 'href': 'http://bit.ly/95SdKD'}]
		}; 
	var action_links = [{'text':'Beat <?php echo ucwords($firstname); ?> Now', 'href':'http://bit.ly/95SdKD'}]; 
	FB.Connect.streamPublish(message, attachment, action_links);
	return false;
}
</script>
<script type="text/javascript">
//Recruit	
function PublishInvite() {
	<?php
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
					$result = mysql_query($query);
list($firstname) = mysql_fetch_row($result);

$sql = sprintf("SELECT * FROM h_crew_recruit WHERE UPPER(user) = UPPER('%s') AND fb_sent = '%s'",
							   mysql_real_escape_string($user),
							   2);
				$result = mysql_query($sql);
				$result_ar = mysql_fetch_array($result);
				
				$invitee = $result_ar['invitee'];
				$offer = $result_ar['cash_offer']; 
				$crewid = $result_ar['crew_id']; 
		
$sql = sprintf("SELECT uid FROM h_users WHERE UPPER(user) = UPPER('%s')",
							   mysql_real_escape_string($invitee));
				$result = mysql_query($sql);
				list($tid) = mysql_fetch_row($result); 
				
$sql = sprintf("SELECT * FROM h_crew_main WHERE id = ('%s')",
							   mysql_real_escape_string($crewid));
				$result = mysql_query($sql);
				$result_ar = mysql_fetch_array($result);
				
				$flag = $result_ar['flag'];
				$crewname = $result_ar['title'];				
?>
	var message = '';
	var attachment = {
		'name': '<?php echo ucwords($firstname) ?> wants you to join their crew!',
		'href': ' http://bit.ly/95SdKD',
		'caption': '{*actor*} has offered you $<?php echo $offer ?> to join their crew',
		'description': 'Quality crew members make crews big $$$', 
		'properties': {
			'The crew is': { 'text': '<?php echo ucwords($crewname) ?>', 'href': 'http://bit.ly/95SdKD'}
		},
		'media': [{ 'type': 'image', 'src': 'http://www.12daysoffun.com/hustle/file/fb_join.png', 'href': 'http://bit.ly/95SdKD'}]
		}; 
	var action_links = [{'text':'Join <?php echo ucwords($firstname); ?> Now', 'href':'http://bit.ly/95SdKD'}]; 
	var target_id = <?php echo $tid ?>;
	FB.Connect.streamPublish(message, attachment, action_links,target_id);
return false;
}
</script>
<script type="text/javascript">
//Gift Publish	
function PublishOffer() {
	<?php
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
	mysql_select_db($dbname);

	$query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
							mysql_real_escape_string($user));
						$result = mysql_query($query);
	list($firstname) = mysql_fetch_row($result);
	
	$sql = sprintf("SELECT * FROM h_crew_recruit WHERE UPPER(user) = UPPER('%s')",
								   mysql_real_escape_string($user));
					$result = mysql_query($sql);
					$result_ar = mysql_fetch_array($result);
					
					$who = $result_ar['recipient'];
					$giftname = $result_ar['gift']; 
					$gift_image = $result_ar['image'];
					$crewid = $result_ar['crew_id']; 
					
	$sql = sprintf("SELECT uid FROM h_users WHERE UPPER(user) = UPPER('%s')",
								   mysql_real_escape_string($who));
					$result = mysql_query($sql);
					list($tid) = mysql_fetch_row($result); 
					
	$sql = sprintf("SELECT * FROM h_crew_main WHERE id = ('%s')",
								   mysql_real_escape_string($crewid));
					$result = mysql_query($sql);
					$result_ar = mysql_fetch_array($result);
					
					$flag = $result_ar['flag'];
					$crewname = $result_ar['title'];				
?>
var message = '';
var attachment = {
	'name': '<?php echo ucwords($firstname) ?> has offered you a gift!',
	'href': ' http://bit.ly/95SdKD',
	'caption': '{*actor*} has offered you <?php echo $giftname ?> as a token of appreciation',
	'description': 'The more cash you make for a crew, the more a crew rewards you', 
	'properties': {
		'The crew is': { 'text': '<?php echo ucwords($crewname) ?>', 'href': 'http://bit.ly/95SdKD'}
	},
	'media': [{ 'type': 'image', 'src': 'http://www.12daysoffun.com/hustle/file/pic/fbimages/<?php echo $gift_image; ?>', 'href': 'http://bit.ly/95SdKD'}]
	}; 
var action_links = [{'text':'Collect your Gift', 'href':'http://bit.ly/95SdKD'}]; 
var target_id = <?php echo $tid ?>;
FB.Connect.streamPublish(message, attachment, action_links,target_id);
return false;
}
</script>
<script type="text/javascript">
//Find Publish	
function PublishFind() {
	<?php
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
					$result = mysql_query($query);
list($firstname) = mysql_fetch_row($result);

$query = sprintf("SELECT egg_name FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
		$result = mysql_query($query);
list($egg) = mysql_fetch_row($result);

$query = sprintf("SELECT mini_image FROM h_special_items WHERE name = ('%s')",
		mysql_real_escape_string($egg));
		$result = mysql_query($query);
list($item_image) = mysql_fetch_row($result);				

?>
var message = '';
var attachment = {
	'name': '<?php echo ucwords($firstname) ?> is Hustling!',
	'href': ' http://bit.ly/95SdKD',
	'caption': '{*actor*} has just found an item hidden in the Hustle Arcade',
	'description': '100s of items, weapons, and assets are hidden in the Arcade', 
	'properties': {
		'Item': { 'text': '<?php echo ucwords($egg) ?>', 'href': 'http://bit.ly/95SdKD'}
	},
	'media': [{ 'type': 'image', 'src': 'http://www.12daysoffun.com/hustle/file/pic/fbimages/easter/minis/<?php echo $item_image; ?>', 'href': 'http://bit.ly/95SdKD'}]
	}; 
var action_links = [{'text':'Finders Keepers', 'href':'http://bit.ly/95SdKD'}];
FB.Connect.streamPublish(message, attachment, action_links);
return false;
}
</script>
<script type="text/javascript">
//Find Publish	
function PublishHeist() {
	<?php
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
					$result = mysql_query($query);
list($firstname) = mysql_fetch_row($result);				

?>
var message = '';
var attachment = {
	'name': '<?php echo ucwords($firstname) ?> needs help!',
	'href': ' http://bit.ly/95SdKD',
	'caption': '{*actor*} needs help robbing a Bank in the Hustle',
	'description': 'Millions of dollars are up for grabs, they&acute;ll cut you in!', 
	'properties': {
		'Heist': { 'text': 'Bank Job', 'href': 'http://bit.ly/95SdKD'}
	},
	'media': [{ 'type': 'image', 'src': 'http://www.12daysoffun.com/hustle/graphics/bankjob_mini.png', 'href': 'http://bit.ly/95SdKD'}]
	}; 
var action_links = [{'text':'Help {*actor*}', 'href':'http://bit.ly/95SdKD'}];
FB.Connect.streamPublish(message, attachment, action_links);
return false;
}
</script>
<script type="text/javascript">
//Find New Crew	
function PublishStart() {
	<?php
	$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
					$result = mysql_query($query);
list($firstname) = mysql_fetch_row($result);

$query = sprintf("SELECT title FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
					$result = mysql_query($query);
list($title) = mysql_fetch_row($result);

?>
var message = '';
var attachment = {
	'name': '<?php echo ucwords($firstname) ?> needs help!',
	'href': ' http://bit.ly/95SdKD',
	'caption': '{*actor*} just started a crew in the Hustle',
	'description': 'Join <?php echo ucwords($firstname) ?>&acute;s crew today and earn $50!', 
	'properties': {
		'My Crew': { 'text': 'Join <?php echo ucwords($firstname) ?>', 'href': 'http://bit.ly/95SdKD'}
	},
	'media': [{ 'type': 'image', 'src': 'http://www.12daysoffun.com/hustle/graphics/bankjob_mini.png', 'href': 'http://bit.ly/95SdKD'}]
	}; 
var action_links = [{'text':'Help {*actor*}', 'href':'http://bit.ly/95SdKD'}];
FB.Connect.streamPublish(message, attachment, action_links);
return false;
}
</script>
</head>
<script type="text/javascript">
var pageLoading = 0;
var sex = 2;
jQuery(function() {	
			$('#brag').css('cursor','pointer');
			$('#terms_exit').css('cursor','pointer');
			$('#bm_pp_exit').css('cursor','pointer');	
			$('#car_pp_exit').css('cursor','pointer');
			$('#lisa_exit').css('cursor','pointer');
			$('#egg_exit').css('cursor','pointer');
			$('#taxi_cab').css('cursor','pointer');
			$('#tour_exit').css('cursor','pointer');
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
			$('#cbuy_exit').css('cursor','pointer');
			//
			$('#impulse_exit').css('cursor','pointer');
			$('#impulse_sold').css('cursor','pointer');
			$('#impulse_exit_tks').css('cursor','pointer');
			$('#exit_tks').css('cursor','pointer');
			$('#news_exit_tks').css('cursor','pointer');
			$('#paypal_exit').css('cursor','pointer');
			$('#game_area').css('cursor','pointer');
			$('#archustle_area').css('cursor','pointer');
			$('#arcade_hustle_exit').css('cursor','pointer');
			$('#race_hustle_exit').css('cursor','pointer');
			$('#track_area').css('cursor','pointer');
			$('#racehustle_area').css('cursor','pointer');
			//Building Exits
			$('#practice_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#fight_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#weapons_shop_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#weapons_shop_exit2')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#realtor_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#realtor_exit2')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#security_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#security_exit2')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#hallofame_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#bank_building_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#race_track_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#casino_building_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#club_building_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#recruit_building_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#hit_shop_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#gift_shop_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			//Tutorial
			$('#doareas')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#dorob')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#doarcade')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#dorace')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#doattack')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#doinvest')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#doaccount')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			//Internal Pages
			$('#radio1')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#radio2')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#radio3')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#radio4')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#radio5')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#radio6')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#radio7')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#radio8')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#radio9')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#radio10')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#sex_change')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#mystats')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#myinititation')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});			
			//Bank
			$('#heist_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#heist_brains')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#heist_men')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			//Uptown
			$('#clinic')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#bank_building')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#hallofame')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#wards')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#ward_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			//eastend
			$('#junkyard')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#chopshop')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#marina')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#diner')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
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
			$('#purchase_club')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			//downtown}
			$('#store_butt')
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
			$('#paying')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#heist_info_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#heist_call')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#heist_cancel_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#heist_call_cancel')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#bank_checkin_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});			
			$('#robus')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#circle_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#car_lot_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#purchase_car')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			//Exit Signs
			$('#practice_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#home");
										 });
			$('#fight_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#home");
										 });
			$('#weapons_shop_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#home");
										 });
			$('#weapons_shop_exit2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#home");
										 });
			$('#realtor_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#home");
										 });
			$('#realtor_exit2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#home");
										 });
			$('#security_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#home");
										 });
			$('#security_exit2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#home");
										 });
			$('#recruit_building_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $.post("tutor_lisa.php",{data: htmlStr});
										 gogetter("#home");
										 });
			$('#hit_shop_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#home");
										 });
			$('#gift_shop_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#home");
										 });
			$('#hallofame_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#northend");
										 });
			$('#bank_building_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#northend");
										 });
			$('#race_track_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#eastend");
										 });
			$('#casino_building_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#downtown");
										 });
			$('#club_building_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#downtown");
										 });
			//School
			$('#doareas')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 teach_them("area");
										 });
			$('#dorob')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 teach_them("rob");
										 });
			$('#doarcade')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 teach_them("arcade");
										 });
			$('#dorace')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 teach_them("race");
										 });
			$('#doattack')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 teach_them("attack");
										 });
			$('#doinvest')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 teach_them("invest");
										 });
			$('#doaccount')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 teach_them("account");
										 });
			//Internals
			$('#circle_exit')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $('#fight_feed').hide();
										 });
			$('#radio1')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $("#sex_change").hide();
										 firstget('#init');
										 });
			$('#radio2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $("#sex_change").hide();
										 internalget('#news');
										 });
			$('#radio3')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $("#sex_change").hide();
										 internalstatget('#stats');
										 });
			$('#radio5')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 avatarget('#m_avatar');
										 sex = 1;
										 });
			$('#radio6')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $("#sex_change").hide();
										 incommentget('#comments');
										 });
			$('#radio7')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $("#sex_change").hide();
										 inmenuget('#pshout');
										 });
			$('#radio8')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $("#sex_change").hide();
										 inmenuget2('#cshout');
										 });
			$('#radio9')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $("#sex_change").hide();
										 inmenuget3('#ashout');
										 });
			$('#radio10')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $("#sex_change").hide();
										 internalget('#backyard');
										 });
			$('#sex_change')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 if(sex == 1){
											 sex = 2;
                                         	 avatarget('#f_avatar');
										 } else {
											 sex = 1;
											 avatarget('#m_avatar');
										 }
										 });
			//
			$('#car_lot_exit')
			.livequery('click', function(event) {
					$('#car_lot').hide();
					$('#car_lot_exit').hide();
					$('#carlot_btm').hide();
										 });
			$('#robus')
			.livequery('click', function(event) {
			$.post("overlay_loader.php",{page:"bankwho"},function(data){						 										$(".the_pic").html(data);
										 $('#bank_heist').show();
										 $('#heist_exit').show();
										 $('#heist_btm').show();
																	  });
										 });
			$('#heist_cancel_exit')
			.livequery('click', function(event) {
										 $('#heist_cancel').hide();
										 $('#heist_cancel_exit').hide();
										 $('#heist_cancel_btm').hide();
										 });
			$('#heist_info_exit')
			.livequery('click', function(event) {
										 $('#heist_info').hide();
										 $('#heist_info_exit').hide();
										 $('#heist_info_btm').hide();
										 });
			$('#heist_call_cancel')
			.livequery('click', function(event) {
										 $('#heist_cancel').hide();
										 $('#heist_cancel_exit').hide();
										 $('#heist_cancel_btm').hide();
										 $.post("thebankjob.php",{data:htmlStr, choice:12});
										 });
			$('#heist_call')
			.livequery('click', function(event) {
										 $('#heist_info').hide();
										 $('#heist_info_exit').hide();
										 $('#heist_info_btm').hide();
										 PublishHeist();
										 });
			$('#heist_exit')
			.livequery('click', function(event) {
										 $('#bank_heist').hide();
										 $('#heist_exit').hide();
										 $('#heist_btm').hide();
										 });
			$('#heist_brains')
			.livequery('click', function(event) {
										 $('#bank_heist').hide();
										 $('#heist_exit').hide();
										 $('#heist_btm').hide();
										 $.post("thebankjob.php",{data:htmlStr},function(results){
														if(results == 1){
															//share next step
											$.post("overlay_loader.php",{page:"bankboss"},function(data){						 										
																									  															$(".the_pic").html(data);				
															$('#heist_info').show();
															$('#heist_info_exit').show();
															$('#heist_info_btm').show();
																								   });
														} else {
															//notify and offer to cancel
															$('#heist_cancel').show();
															$('#heist_cancel_exit').show();
															$('#heist_cancel_btm').show();
														}
																						 });
										 });
			$('#heist_men')
			.livequery('click', function(event) {
										 $('#bank_heist').hide();
										 $('#heist_exit').hide();
										 $('#heist_btm').hide();
										 //
				$.post("overlay_loader.php",{page:"bankcheckin"},function(data){						 										$(".the_pic").html(data);
										 $('#bank_checkin').show();
										 $('#bank_checkin_exit').show();
										 $('#bank_checkin_btm').show();
															   });
										 });
			$('#bank_checkin_exit')
			.livequery('click', function(event) {
										 $('#bank_checkin').hide();
										 $('#bank_checkin_exit').hide();
										 $('#bank_checkin_btm').hide();
										 });
			$('#joes_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#terms_exit')
			.livequery('click', function(event) {
							$('#terms_set').hide();
							$('#terms_exit').hide();
							$('#terms_btm').hide();
										 });
			$('#brag')
			.livequery('click', function(event) {
										 PublishFind();
										 });
			$('#joes_exit')
			.livequery('click', function(event) {
										 $('#joes').hide();
										$('#joes_exit').hide();
										$('#joes_btm').hide();
										 });
			$('#bank_building')
			.livequery('click', function(event) {
										 gogetter("#bank_page");
										 });
			$('#paying')
			.livequery('click', function(event) {
										 $('#paypal_box').show();
										  $('#paypal_exit').show();
										  $('#paypal_btm').show();
										 });
			$('#paypal_exit')
			.livequery('click', function(event) {
										 $('#paypal_box').hide();
										  $('#paypal_exit').hide();
										  $('#paypal_btm').hide();
										  $('#egg').hide();
											$('#egg_header').hide();
											$('#egg_exit').hide();
											$('#egg_words').hide();
											$('#egg_app2').hide();
											$('#egg_app1').hide();
										 });
			$('#game_area')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $('#arcade_hustle').hide();
										 $('#arcade_hustle_exit').hide();
										 $('#arc_hustle_btm').hide();
										 gogetter("#practice");
										 tb_show("Arcade","start2.php?keepThis=true&TB_iframe=false&height=435&width=700","");
										 });
			$('#archustle_area')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $('#arcade_hustle').hide();
										 $('#arcade_hustle_exit').hide();
										 $('#arc_hustle_btm').hide();				 
										 addemail(htmlStr);
										 archusgetter("#fight");
										 });
			$('#arcade_hustle_exit')
			.livequery('click', function(event) {
										 $('#arcade_hustle').hide();
										 $('#arcade_hustle_exit').hide();
										 $('#arc_hustle_btm').hide();
										 });
			$('#track_area')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $('#race_hustle').hide();
										 $('#race_hustle_exit').hide();
										 $('#race_hustle_btm').hide();
										 gogetter("#race_page");
										 });
			$('#racehustle_area')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $('#race_hustle').hide();
										 $('#race_hustle_exit').hide();
										 $('#race_hustle_btm').hide();				 
										 addemail(htmlStr);
										 archusgetter("#drag_race");
										 });
			$('#race_hustle_exit')
			.livequery('click', function(event) {
										 $('#race_hustle').hide();
										 $('#race_hustle_exit').hide();
										 $('#race_hustle_btm').hide();
										 });
			$('#practice_button')
			.livequery('click', function(event) {
										 pageLoading = 1;					
				$.post("overlay_loader.php",{page:"arcadehus"},function(data){
																				
										 $('.the_pic2').html(data);					 
										 $('#arcade_hustle').show();
										 $('#arcade_hustle_exit').show();
										 $('#arc_hustle_btm').show();
																		});
										 });
			
			$('#fight_button')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 attackgetter("#attack");
										 });
			$('#manage_butt')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 managegetter("#manage");
										 });
			$('#store_butt')
			.livequery('click', function(event) {
							pageLoading = 1;			 
							eandc(htmlStr);
							storegetter("#store");
										 });
			$('#express')
			.livequery('click', function(event) {
						$('#market_exit').show();
						$('#the_market').show();
						marketwire(htmlStr);
						$('#tradingpost').show();
						$('#market_header').show();
						eandc(htmlStr);
										 });		
			$('#market_exit').css('cursor','pointer');
			$('#market_exit').click(function(){
					$('#market_exit').hide();
						$('#the_market').hide();
						$('#tradingpost').hide();
						$('#market_header').hide();
											  });
			$('#deed_exit').css('cursor','pointer');
			$('#deed_exit').click(function(){
					$('#deed_bank').hide();
					$('#deed_header').hide();
					$('#deed_exit').hide();
											  });
			$('#inventory_button')
			.livequery('click', function(event) {										 
										 pageLoading = 1;
										 invgetter("#inventory");
										 });
			$('#inventory_butt2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 invgetter("#inventory");
										 });
			$('#inventory_butt3')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 invgetter("#inventory");
										 });
			$('#inventory_butt4')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 invgetter("#inventory");
										 });
			$('#inv_muscle')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 invgetter("#muscle");
										 });
			$('#inv_muscle_2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 invgetter("#muscle");
										 });
			$('#inv_muscle2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 invgetter("#muscle");
										 });
			$('#inv_muscle3')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 invgetter("#muscle");
										 });
			$('#gift_button')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 gogetter("#gift_opt");
										 });
			$('#gift_button2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 giftgetter("#gift_opt");
										 });
			$('#gift_button3')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 giftgetter("#gift_opt");
										 });
			$('#gift_button4')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 giftgetter("#gift_opt");
										 });
			$('#hit_button')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 hitlistgetter("#hit_opt");
										 });
			$('#hit_button2')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 hitlistgetter("#hit_opt");
										 });
			$('#crews')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 addemail(htmlStr);
										 talentgetter("#recruit");
										 });
			//$('#profile_butt')
			//.livequery('click', function(event) {
				//						 pageLoading = 1;
					//					 profilegetter("#profile");
						//				 });
			$('#rroffice')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 invgetter("#assets");
										 });
			$('#hallofame')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 leadergetter("#scores");
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
										 bizgetter("#casino_page");
										 });
			$('#nightclub')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 //$('#music').html('<embed src="../media/music.m3u" type="application/x-mplayer2" HIDDEN="true" AUTOSTART="true" loop="true"></embed>');	 
										 bizgetter("#club_page");
										 });
			$('#chopshop')
			.livequery('click', function(event) {
										 pageLoading = 1;					
				$.post("overlay_loader.php",{page:"arcadehus"},function(data){
																				
										 $('.the_pic2').html(data);					 
										 $('#race_hustle').show();
										 $('#race_hustle_exit').show();
										 $('#race_hustle_btm').show();
																		});
										 });
			$('#purchase_car')
			.livequery('click', function(event) {
										 pageLoading = 1;
					$.post("overlay_loader.php",{page:"carlot"},function(data){			 
										 $(".the_pic").html(data);
										 $("#car_lot").show();
										 $("#car_lot_exit").show();
										 $("#carlot_btm").show();
																		 });
										 });
			$('#taxi_downtown').css('cursor','pointer');
			$('#taxi_midtown').css('cursor','pointer');
			$('#taxi_uptown').css('cursor','pointer');
			$('#taxi_eastend').css('cursor','pointer');
			$('#taxi_trainyard').css('cursor','pointer');
			
			$('#taxi_downtown')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $('#tour').hide();
										 $('#tour_exit').hide();
										 $('#tour_header').hide();
										 taxi_fee(htmlStr,"#downtown");
										 });
			
			$('#taxi_eastend')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $('#tour').hide();
										 $('#tour_exit').hide();
										 $('#tour_header').hide();					 
										 taxi_fee(htmlStr,"#eastend");						 
										 });
			$('#taxi_uptown')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $('#tour').hide();
										 $('#tour_exit').hide();
										 $('#tour_header').hide();						 
										 taxi_fee(htmlStr,"#northend");
										 });
			$('#taxi_midtown')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $('#tour').hide();
										 $('#tour_exit').hide();
										 $('#tour_header').hide();
										 taxi_fee(htmlStr,"#home");
										 });
			$('#taxi_trainyard')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 $('#tour').hide();
										 $('#tour_exit').hide();
										 $('#tour_header').hide();
										 taxi_fee(htmlStr,"#train_page");
										 });
			$('#dbuy_exit')
			.livequery('click', function(event) {					 			 
										$('#dbuy_exit').hide();
										$('#diner_buy').hide();
										$('#dfloor').hide()
										 });
			$('#diner')
			.livequery('click', function(event) {
										 pageLoading = 1;
						$.post("the_lisa.php",{person: htmlStr, checking: "diner"});		 
						$.post("overlay_loader.php",{page:"diner"},function(data){						 										$(".the_pic").html(data);				 
										$('#joes_exit').show();
										$('#joes_btm').show();
										$('#joes').show();
										eandc(htmlStr);
																				  });
										 });
			$('#ward_exit')
			.livequery('click', function(event) {
										$('#ward_exit').hide();
										$('#theward').hide();
										$('#ward_btm').hide();
										 });
			$('#wards')
			.livequery('click', function(event) {
										$('#nurse_exit').hide();
										$('#nurse').hide();
										$('#nurse_btm').hide();
										pageLoading = 1;
										 the_patients(htmlStr);
										$('#ward_exit').show();
										$('#theward').show();
										$('#ward_btm').show();
										 });
			$('#home_butt')
			.livequery('click', function(event) {
										 pageLoading = 1;
										 profilegetter("#profile");
										 });
			$("#billboard")
			.livequery(function(){
								$(this)
								.hover(
								  function () {
									  $.post("flattered.php",function(results){
											$("#topplayer_pic").html(results);			  
																	  });
									  $.post("flattered2.php",function(results){
											$("#topplayer_name").html(results);			  
																	  });
									  $("#topplayer").css("display","block");
								  }, 
								  function () {
									$("#topplayer").css("display","none");
								  }
				);
								});
			$("#taxi_midtown")
			.livequery(function(){
								$(this)
								.hover(
				  function () {
					$(this).css("color","red");
				  }, 
				  function () {
					$(this).css("color","black");
				  }
				);
								});
			$("#taxi_uptown")
			.livequery(function(){
								$(this)
								.hover(
				  function () {
					$(this).css("color","blue");
				  }, 
				  function () {
					$(this).css("color","black");
				  }
				);
								});
			$("#taxi_eastend")
			.livequery(function(){
								$(this)
								.hover(
				  function () {
					$(this).css("color","blue");
				  }, 
				  function () {
					$(this).css("color","black");
				  }
				);
								});
			$("#taxi_downtown")
			.livequery(function(){
								$(this)
								.hover(
				  function () {
					$(this).css("color","blue");
				  }, 
				  function () {
					$(this).css("color","black");
				  }
				);
								});
			$("#taxi_trainyard")
			.livequery(function(){
								$(this)
								.hover(
				  function () {
					$(this).css("color","blue");
				  }, 
				  function () {
					$(this).css("color","black");
				  }
				);
								});
			$("#hallofame")
			.livequery(function(){
								$(this)
								.hover(
									  function () {
										$("#fame_title").css("display","block");
									  }, 
									  function () {
										$("#fame_title").css("display","none");
									  }
									);
								});
			$("#bank_building")
			.livequery(function(){
								$(this)
								.hover(
									  function () {
										$("#bank_title").css("display","block");
									  }, 
									  function () {
										$("#bank_title").css("display","none");
									  }
									);
								});
			$("#clinic")
			.livequery(function(){
								$(this)
								.hover(
									  function () {
										$("#clinic_title").css("display","block");
									  }, 
									  function () {
										$("#clinic_title").css("display","none");
									  }
									);
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
			$('#prem_button')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#prem_button').livequery('click', function(event) {
					$.post("overlay_loader.php",{page:"caroffer"},function(data){						 										$(".the_pic").html(data);						  
										$('#bm_paypal').show();
										$('#bm_pp_exit').show();
										$('#pp_btm').show();
																			  });
													 });
			$('#nurse_exit')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			$('#clinic').livequery('click', function(event) {
					$.post("the_lisa.php",{person: htmlStr, checking: "clinic"});
					$('#nurse_exit').show();
					$('#nurse_btm').show();
					$('#nurse').show();
													 });
			$('#nurse_exit').livequery('click', function(event) {
					$('#nurse_exit').hide();
					$('#nurse_btm').hide();
					$('#nurse').hide();
														 });
			$('#egg_exit').click(function(){
					$('#egg_exit').hide();
					$('#egg_header').hide();
					$('#egg').hide();
					$('#egg_app').hide();
					$('#egg_app2').hide();
											  });
			$('#lisa_exit').click(function(){
					$('#lisa_exit').hide();
					$('#lisa_header').hide();
					$('#lisa').hide();
											  });
			$('#bm_pp_exit').click(function(){
					$('#bm_pp_exit').hide();
					$('#pp_btm').hide();
					$('#bm_paypal').hide();
											  });
			$('#car_pp_exit').click(function(){
					$('#car_pp_exit').hide();
					$('#car_btm').hide();
					$('#car_paypal').hide();
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
					storegetter("#store");
							   });
			$('#impulse_exit_tks').click(function(){
					$('#impulse_exit_tks').hide();
					$('#Impulse_Buy_tks').hide();
					$('#impulse_sold_tks').hide();
											  });
			$('#exit_tks').click(function(){
					$('#exit_tks').hide();
					$('#delivery_tks').hide();
					$('#tks').hide();
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
					$.post("signup.php", {data: htmlStr, decision: "yes", faction: "bad"});
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
			$('#taxi_cab').click(function(){
					$('#tour_exit').show();
					$('#tour_header').show();
					$('#tour').show();
											  });
			$('#tour_exit').click(function(){
					$('#tour_exit').hide();
					$('#tour_header').hide();
					$('#tour').hide();
											  });
			$('#black_market')
			.livequery('click', function(event) {
						$.post("the_lisa.php",{person: htmlStr, checking: "market"});		 
						$.post("overlay_loader.php",{page:"dealerinfo"},function(data){
						$(".the_pic").html(data);				 
						$('#bm_exit').show();
						$('#bm_dealer').show();
						$('#dealer_btm').show();
						eandc(htmlStr);
																				 });
										 });
			$('#purchase_casino')
			.livequery('click', function(event) {
						$("#userid")
				  .livequery(function(){
									  $(this)
									  .val(htmlStr);
									  });
				  $.post("overlay_loader.php",{page:"casinobuy"},function(data){
						$(".the_pic").html(data);
						$('#cbuy_exit').show();
						$('#casino_buy').show();
						$('#csfloor').show();
						eandc(htmlStr);
																		  });
										 });
			$('#casino_sold').css('cursor','pointer');
			$('#cbuyf_exit').css('cursor','pointer');
			$('#cbuy_exit').click(function(){
					$('#cbuy_exit').hide();
				    $('#casino_buy').hide();
		            $('#csfloor').hide();
											});	
			$('#purchase_club')
			.livequery('click', function(event) {
						$("#userid")
				  .livequery(function(){
									  $(this)
									  .val(htmlStr);
									  });
				  pageLoading = 1;
				  $.post("overlay_loader.php",{page:"clubbuy"},function(data){
							$(".the_pic").html(data);
						$('#clbuy_exit').show();
						$('#club_buy').show();
						$('#clfloor').show();
						eandc(htmlStr);
																		});
										 });
			$('#club_sold').css('cursor','pointer');
			$('#clbuy_exit').css('cursor','pointer');
			$('#clbuy_exit').click(function(){
					$('#clbuy_exit').hide();
				    $('#club_buy').hide();
		            $('#clfloor').hide();
											});
			$('#bm_exit').click(function(){
					$('#bm_dealer').hide();
					$('#bm_exit').hide();
					$('#dealer_btm').hide();
											});
			$('#ra_exit').click(function(){				  
					$('#ra_exit').hide();
					$('#rad').hide();
					$('#ridealong').hide();
											  });
			$('#badge').click(function(){
					//show current investigations
					$.post("overlay_loader.php",{page:"federal"},function(data){						 							$(".the_pic").html(data);
							$('#federal').show();
							$('#federal_exit').show();
							$('#federal_btm').show();
																			  });
											});
			$('#cellphone')
			.livequery('click', function(event) {
					$.getJSON("agenthq.php", { data: htmlStr }, function(json){
											var orders = json.image;
											var contact = json.contact;
											//if there are orders
											$('#agent_words').html(orders);
											$('#agent_header').show();
											$('#agent_arcade').show();
											$('#agent_exit').show();
											$('#agency_app').hide();
														 });
										 });
			$('#biz_control_exit').css('cursor','pointer');
			$('#stock_control_exit').css('cursor','pointer');
			$('#b_owner')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
			
			$('#biz_control_exit').click(function(){				  
					$('#the_business').hide();
					$('#biz_header').hide();
					$('#biz_control_exit').hide();
					$('#biz_hud').hide();
											  });
			
			$('#b_owner')
			.livequery('click', function(event) {
						$('#the_business').show();
						$('#biz_header').show();
						$('#biz_control_exit').show();
						$('#biz_hud').show();
						entre(htmlStr);
						eandc(htmlStr);
										 });
			$('#patrons_exit').css('cursor','pointer');
			$('#patrons_exit').click(function(){
					$.post("leave_biz.php", {data: htmlStr});						  
					$('#patrons_exit').hide();
					$('#the_patrons').hide();
					$('#patrons_header').hide();
					$('#traffic_report').hide();
										  });			
			$('#play').css('display', 'none');
			
		
}); 
jQuery(function() {
	  htmlStr = $("#facebook_user").html();
	   $('#facebook_user').hide();
	   pageLoading == 1;
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
											 var user_time_left = results.time_left;
											 var user_news = results.newnews;
											 var user_health = results.health;
											 var shield = results.shield;
											 var user_health_per = results.health_per;
											 var user_health_timer = results.health_timer;
											 var user_health_update = results.health_update;
											 var tutorial = results.teachme;
											 var pro = results.robbery;
											 var signature = results.sign;
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
									 $('#level_bar').css('width', user_health+'%');				 
									 newbie(first_time);
									 beeper(user_news);
									 bankjob_heist(pro,htmlStr);
									 notice(htmlStr);
									 test(user_energy,user_energy_max,user_change_per,user_timer,user_time_left);
									 health_test(user_health,user_health_per,user_health_timer,user_health_update);
									 arcade_results(htmlStr);
									 agree(htmlStr,signature);
													  
									}, "json");	
});
function agree(user,agreed){
	if(agreed == 1){
		$('#terms_set').show();
		$('#terms_exit').show();
		$('#terms_btm').show();
		
	}
	return false;
}
//Timer
function countdownTimer(timeLeft, current, maxval, every, change_per, span_id, div_refresh, div_current) {
	//check if energy refilled?
	var user_energy;
	var user_energy_max;
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
				current += change_per
				
				//Impulse Buy Lightboxes - refresh user stats automatically by updating these global JS vars
				if (div_current == 'u_energy')
		    {
				 
			 	 $.post("blamo.php", {name: htmlStr, adjust: change_per, left: timeLeft},function(results) {
								 user_energy_max = results.user_max;
								 user_energy = results.user_e;
								 if(user_energy == user_energy_max){
									 current = maxval;
									 div.css('display', 'none');
									 return;
								 } else {
								 $('#u_energy').html(current);
								 }
																								  },"json");
		    }
		    else if (div_current == 'user_health')
		    {
		     $('#level_bar').css('width', current+'%');
			 $.post("time_keeper.php", {name: htmlStr, adjust: change_per, left: timeLeft});
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
							//alert(htmlStr);
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
				if (div_current == 'u_energy')
				{				
				$.post("blamo.php", {name: htmlStr, left: timeLeft});
				}
				else if (div_current == 'user_health')
				{				 
				$.post("time_keeper.php", {name: htmlStr, left: timeLeft});
				}
				setTimeout(function() {countdownTimer(timeLeft, current, maxval, every, change_per, span_id, div_refresh, div_current)}, 1000);
				pageLoading = 0;
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

// For all AJAX calls, show the overlay and refresh divs
$(document).ajaxStart(function () {
	setTimeout(function () {
		if (pageLoading == 1) {
			$('#LoadingOverlay').show();
			$('#LoadingRefresh').show();
		}
	}, 1000);
}).ajaxStop(function (){
	$('#LoadingOverlay').hide();
	$('#LoadingRefresh').hide();
});
//Energy Max		
function test(current,full,some,sot,time_left){
	//here
	var current_energy = parseInt(current);
	var max_energy = parseInt(full);
	var lvl_change = parseInt(some);
	var energy_change_per = lvl_change;
	var next_energy_update = time_left;
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
function bankjob_heist(pro,htmlStr){
	var thesignal = parseInt(pro);
	if(thesignal == 2){
		robthebank(htmlStr);
	}else if(thesignal == 10){
		robthebank(htmlStr);
	}
	return false;
}
function health_test(current,some,sot,mot){
	//here
	var current_health = parseInt(current);
	var lvl_change = parseInt(some);
	var health_change_per = lvl_change;
	var next_health_update = mot;
	var character_health_update = sot;
	var hstate = $('#clock_health').css('display');
	
	if(hstate == "none"){
	if(current_health < 100)
	{	
		countdownTimer(next_health_update, current_health, 100, character_health_update, health_change_per, 'countdownSpanHealth', 'clock_health', 'user_health');
		
		$('#clock_health').css('display', 'block');
		
	} else {
		
		$('#clock_health').css('display', 'none');

	}
	}
	return false;
}
//notices
function bankinfo(htmlStr){
	$.getJSON("bankinfo.php",{ data:htmlStr },function(results){
						  var bcash = results.cash;
						  var bass = results.assets;
						  var myacct = results.myacc;
						  var check = results.test;
							if(check == 1){								
						  		$("#mybal").html("Open an account!");
							} else {								
						   		$("#mybal").html("$" + myacct);
							}
						   $("#bank_cash").html("$" + bcash);
						   $("#bank_assets").html("$" + bass);
									  },"json");
	return false;
}
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
		$("#radio_9").blink();
	} 
	return false;
}
//newbie
function newbie(first_time){
	if(first_time == "new"){
		//Show welcome screen
		//tb_show("Follow the Walk-Thru to get your rep' up!","../graphics/hustle_over.png","");
		//$("#pointer").html("<img src='../graphics/arrow_green_left_50x63_02.png' width='63' height='53' />");
		//$("#pointer").blink();
		$('#header').hide();
		$.post("welcome.php", {data: htmlStr});
		backgetter('#start');
		flags();		
		$('#custom_me').show();
		$('#custom_me_btm').show();		
	} else {
		$('#header').show();
		profilegetter('#profile');
	}
	return false;
}
function teach_them(book){			
		if(book == "area"){		
			tb_show("Lisa Says","../file/tutorials/jpg/50.jpg","");
		} else if(book == "account") {
			tb_show("Lisa Says","../file/tutorials/jpg/51.jpg","");
		} else if(book == "invest") {
			tb_show("Lisa Says","../file/tutorials/jpg/52.jpg","");
		} else if(book == "attack") {
			tb_show("Lisa Says","../file/tutorials/jpg/53.jpg","");
		} else if(book == "arcade") {
			tb_show("Lisa Says","../file/tutorials/jpg/54.jpg","");
		} else if(book == "race") {
			tb_show("Lisa Says","../file/tutorials/jpg/55.jpg","");
		} else if(book == "rob") {
			tb_show("Lisa Says","../file/tutorials/jpg/56.jpg","");
		} 																  
	return false;
}
function tutor(arcade){
	$.post("tutor_lisa.php",{data: htmlStr,checking: 33},function(results){
						var pagenum = parseInt(results);
	if(pagenum == 1){
				$('#lisa_words').html('<img src="../file/tutorials/jpg/'+ pagenum + '.jpg"/>');
									$('#lisa').show();
									$('#tutorial_app').show();
									$('#lisa_header').hide();
									$('#lisa_exit').hide();
	} else if(pagenum == 2){
				$('#lisa_words').html('<img src="../file/tutorials/jpg/basics.jpg"/>');
									$('#lisa').show();
									$('#tutorial_app').show();
									$('#lisa_header').hide();
									$('#lisa_exit').hide();	
	} else if(pagenum == 3){
			tb_show("...you still got it?","../file/tutorials/jpg/58.jpg","");
			$.post("example.php", {data: htmlStr}, function(user_game){
								$('#content')
								.livequery(function(){
													$(this)
													.html(user_game);
													});
								$('#mission').show();						   
														   });								
	} else if(pagenum == 4){
			$('#lisa_words').html('<img src="../file/tutorials/jpg/'+ 59 + '.jpg"/>');
			$('#lisa').show();
			$('#tutorial_app').show();
			$('#lisa_header').hide();
			$('#lisa_exit').hide();
		taxi_fee(htmlStr,"#eastend");
	} else  if(pagenum == 5){
		tb_show("The Rules","../file/graphics/race_rules.jpg","");
		egg_race(htmlStr);
	} else if(pagenum == 6){
		$('#lisa_words').html('<img src="../file/tutorials/jpg/'+ 60 + '.jpg"/>');
			$('#lisa').show();
			$('#tutorial_app').show();
			$('#lisa_header').hide();
			$('#lisa_exit').hide();
		gogetter("#bank_page");	
	} else if(pagenum == 7){
		$('#lisa_words').html('<img src="../file/tutorials/jpg/'+ 61 + '.jpg"/>');
			$('#lisa').show();
			$('#tutorial_app').show();
			$('#lisa_header').hide();
			$('#lisa_exit').hide();
		bizgetter("#club_page");
	} else if(pagenum == 8){
		$('#lisa_words').html('<img src="../file/tutorials/jpg/'+ 16 + '.jpg"/>');
			$('#lisa').show();
			$('#tutorial_app').show();
			$('#lisa_header').hide();
			$('#lisa_exit').hide();
	} else if(pagenum == 9){
		$('#lisa_words').html('<img src="../file/tutorials/jpg/'+ 17 + '.jpg"/>');
			$('#lisa').show();
			$('#tutorial_app').show();
			$('#lisa_header').hide();
			$('#lisa_exit').hide();	
	} else if(pagenum == 10){
		tb_show("Ouch","../file/tutorials/jpg/18.jpg","");
		talentgetter("#recruit");
	} else if(pagenum == 11){
		tb_show("Hustle","../file/tutorials/jpg/62.jpg","");
		startgetter("#profile")	
	} else {
		$('#lisa_words').html('<img src="../file/tutorials/jpg/'+ pagenum + '.jpg"/>');
						$('#lisa').show();
						$('#tutorial_app').hide();
						$('#lisa_header').show();
						$('#lisa_exit').show();
	}
																  });	
	return false;
}
//stat updater
function eandc(htmlStr){
	pageLoading == 1;
	$.getJSON("monitor.php", { data: htmlStr }, function(json){
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
											var user_time_left = json.time_left;
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
											var igoods = json.igoods;
											var user_pain = json.pain;
											var csi = json.csi;
											var target_them = json.them;
											var pursuit = json.pursuit;
											var charge = json.charged;
											var the_crime = json.felony;
											var activity = json.ongoing;
											var busysock = json.busysock;
											var warningsock = json.cautionsock;
											var runmanrun = json.runsock;
											var thatdope = json.coke;
											var thepatrol = json.patrol;
											var psleft = json.patrols_left;
											var agent = json.agent;
											var user_health = json.health;
											var shield = json.shield;
											var user_health_per = json.health_per;
											var user_health_timer = json.health_timer;
											var user_health_update = json.health_update;
											var supersecret = json.icons;
											var chapters = json.teachme;
											var pro = json.robbery;
											$('#reward_points')
											.livequery(function(){
																$(this)
																.html(user_token);
																});
											$('#dollar_val').html(user_cash);
											$('#u_energy').html(user_energy);
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
											$('#level_bar').css('width', user_health+'%');
											beeper(user_news);
											how_high(user_energy,htmlStr,thatdope,user_energy_max);
											strung_out(user_energy_max);
											bankjob_heist(pro,htmlStr);
											stars(warningsock);
											getaway(runmanrun,user_game);											
											notice(htmlStr);
											lotto_stat(lotto);
											snitch(user_pain,htmlStr);
											test(user_energy,user_energy_max,user_change_per,user_timer,user_time_left);
											health_test(user_health,user_health_per,user_health_timer,user_health_update);
											upgraded(user_cool);
											upgraded_wea(user_cool);
											upgraded_ass(user_cool);
											boss_settings(user_cool);
											shieldup(shield);
											first_crime(signup, user_crime);
											academy(signup, user_law);
											hookups(igoods);
											active_is(activity);
											agent_task(agent);
											show_secret(supersecret);
											mission_ready(user_mission,user_game,user_task,user_tcash,user_tbonus,user_tfee,score);
											law_ready(csi,target_them,pursuit,charge,the_crime,busysock,thepatrol,psleft);
											});
	$.ajax({
					   type: "POST",
					   url: "cp_captest.php",
					   data: "name=" + htmlStr,
					   success: function(){
					   }
					   });
	return false;
	
}
//Taxi Fee
function taxi_fee(htmlStr,area){
	$.getJSON("taxi_ride.php",{data: htmlStr, loc: area},function(result){
			if(result == 1){
				tb_show("Too tired to travel","../file/tired_fighter.png","");
				$('#Impulse_Buy').show();
				$('#impulse_exit').show();
				$('#impulse_sold').show();
			} else if(result == 2) {
				tb_show("Too tired to travel","../file/tired_fighter.png","");
				$('#Impulse_Buy_tks').show();
				$('#impulse_exit_tks').show();
				$('#impulse_sold_tks').show();
			} else {
				var signal = result.signal;
				var direction = result.direction;
				if(signal == 3){
					//go
					if(direction == 5){
						//offer						
						var deed = result.deed;
						var price = result.price;
						var travel = result.travel;
						var maint  = result.maint;
						var deed_id  = result.did;						
						buy_land(deed,price,maint,travel,deed_id);
						gogetter(area);
					} else if(direction == 6){
						//attack or pay						
						var deed = result.deed;
						var owner_name = result.owner_name;
						var avatar = result.owner_avatar;
						var owner_backup = result.crewsize;
						var travel = result.travel;
						var deed_id  = result.did;
						$("#deed_id").val(deed_id);
						neighbor_fight(deed,owner_name,avatar,owner_backup,travel,deed_id);
						gogetter(area);
					} else if(direction == 3){
						gogetter(area);
					}
				} else if(signal == 4){
					tb_show("<embed src='../file/app-8.mp3' height=0>","../file/tutorials/jpg/57.jpg","");
					if(direction == 5){
						//offer						
						var deed = result.deed;
						var price = result.price;
						var travel = result.travel;
						var maint  = result.maint;
						var deed_id  = result.did;						
						buy_land(deed,price,maint,travel,deed_id);
						gogetter(area);
					} else if(direction == 6){
						//attack or pay						
						var deed = result.deed;
						var owner_name = result.owner_name;
						var avatar = result.owner_avatar;
						var owner_backup = result.crewsize;
						var travel = result.travel;
						var deed_id  = result.did;
						$("#deed_id").val(deed_id);
						neighbor_fight(deed,owner_name,avatar,owner_backup,travel,deed_id);
						gogetter(area);
					} else if(direction == 3){
						gogetter(area);
					}
				}
			}
													   });
	eandc(htmlStr);
	return false;
}
//The Change
function buy_land(deed,price,maint,travel,deed_id){
	$("#deed_title").html(deed);
	$("#deed_price").html(price);
	$("#deed_maint").html(maint);
	$("#deed_fee").html(travel);
	$("#deed_id").val(deed_id);
	$('#deed_bank').show();
	$('#deed_header').show();
	$('#deed_exit').show();
	return;
}
//The Neighborhood Battle
function neighbor_fight(deed,owner_name,avatar,owner_backup,travel,deed_id){
	$("#deed_avatar").html('<img src=" http://www.12daysoffun.com/hustle/file/pic/avatar/' + avatar + '"/>');
	$("#deed_crew_name").html(owner_name);
	$("#deed_crew_size").html(owner_backup);
	$("#deed_title2").html(deed);
	$("#a_deed_fee").html(travel);
	$("#deed_id2").val(deed_id);
	$('#deed_contest').show();
	$('#deed_attack_header').show();
	return;
}
//Strung Out Alert
function strung_out(needle){
	//
	if(needle < 2){
		//alert("Intervention!!!!!");
		tb_show("You're a Magic Feen ...Damn, dude!WTF","../file/strung_out.png","");
		//set health to 10 give option to go cold turkey or enter rehab
		$.post("time_keeper.php",{name: htmlStr, left:"O"});
		var sout = 10;
		$('#level_bar').css('width', sout+'%');
		$.post("overlay_loader.php",{page:"junkieopt"},function(data){						 										$(".the_pic").html(data);
										$('#junkie_option').show();
										$('#junkie_btm').show();
																});
		//rehab 1hr all stats fully restored wait and all magic destroyed
		//or instant rehab
	}
	return false;
}
//Secrets
function show_secret(odds){
	//randomly display one of 3 icons..with message
	return false;
}
//security health
function shieldup(shield){
	if(shield > 0){
		$('#bonus_container').html('<span><img src="../graphics/healthbonus_title.png" /></span>');
		$('#bonus_bar').css('width', shield+'%');
	} else {
		$('#bonus_container').html('<span></span>');
		$('#bonus_bar').css('width', 0+'%');
	}
	return false;
}
//
function agent_task(agent){
	if(agent == 1){
		$('#cellphone').html('<img src="../graphics/cellphone.png" />');		
		$('#cellphone').css('cursor','pointer');
		$('#cellphone').show();
		tb_show("Head to midtown<embed src='../media/phonering.mp3' height=0>","../file/pic/fbimages/ringring.png","");
		
	}
	return false;
}
//run man run
function getaway(runmanrun,user_game){
	if(runmanrun == 1){		
		tb_show("You are going to jail?","../graphics/notified.png","");
		
		$('#content')
		.livequery(function(){
							$(this)
							.html(user_game);
							});
		$('#mission').show();
							
	}
}
function stars(warningsock){
	if(warningsock == 1){
		tb_show("Someone snitched on you","../graphics/warning.png","");
	}
}
function active_is(activity){
	if(activity == 1){
		$('#badge').html('<img src="../file/pic/fbimages/policebadge.png" />');
		$('#badge').show();
	}
	return false;
}
function law_ready(csi,target_them,pursuit,charge,the_crime,busysock,thepatrol,psleft){
	if(csi == 1){
		//Investigate target_them
		$('#federal_exit').css('cursor','pointer');
		$('#badge').css('cursor','pointer');
		$('#badge').html('<img src="../file/pic/fbimages/policebadge.png" />');
		$('#badge').show();
		$('#cops').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/police-car-animated.gif" width="113" height="50" />');
		$("#cops").show();
		
		$('#federal_exit').click(function(){
					$('#federal').hide();
				    $('#federal_exit').hide();
		            $('#federal_btm').hide();
					$("#cops").hide();
											});
		$('#cops').click(function(){
					$.post("orders.php",{data: htmlStr},function(results){
							var crew = results.crew;
							var bonus = results.bonus;
							$('#suspect_crew').html("Suspect Crew: " + crew);
							$('#id_bonus').html("CP Bonus: " + bonus);
							$('#suspect_crew').show();
							$('#id_bonus').show();
							$('#federal').show();
							$('#federal_exit').show();
							$('#federal_btm').show();
										});
											});
		$('#badge').click(function(){
					$('#federal').show();
				    $('#federal_exit').show();
		            $('#federal_btm').show();
											});
	}else if(pursuit == 1){
		//Show pursuit board
		the_apb(htmlStr);
		$('#chase_exit').css('cursor','pointer');
		$('#chase_exit').click(function(){
						$('#the_chase').hide();
						$('#chase_exit').hide();
						$('#chase_header').hide();
						$('#apb_report').hide();
												});
		$('#cops').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/police-car-animated.gif" width="113" height="50" />');
		$("#cops").show();
		$('#cops').css('cursor','pointer');
		$('#cops').click(function(){
						$('#the_chase').show();
						$('#chase_exit').show();
						$('#chase_header').show();
						$('#apb_report').show();
												});
	}else if(charge == 1){
		if(the_crime == 1){
			var url = '<img src="../file/pic/fbimages/5lotto.png" />';
		}else if(the_crime == 2){ 
			var url = '<img src="../file/pic/fbimages/5boots.png" />';
		}else if(the_crime == 3){
			var url = '<img src="../file/pic/fbimages/5dealers.png" />';
		}
		$('#judges_exit').css('cursor','pointer');
			$('#judges_exit').click(function(){
						$('#judges').hide();
						$('#judges_exit').hide();
						$('#judges_btm').hide();
						$("#cops").hide();
												});	
		$('#badge').css('cursor','pointer');			
		$('#badge').html('<img src="../file/pic/fbimages/policebadge.png" />');
		$('#badge').show();
		$('#badge').click(function(){
						$('#judges').show();
						$('#patrols_left').html("<img src='http://www.12daysoffun.com/hustle/graphics/patrols.png' /> " + psleft);
						$('#suspect_img').html("<img src='http://www.12daysoffun.com/hustle/graphics/crashcourse.png' /> " );
						$('#judges_exit').show();
						$('#judges_btm').show();
												});
		if(busysock == 86){
			//give chance to stop investigation
			$('#cops').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/police-car-animated.gif" width="113" height="50" />');
			$("#cops").show();
			$('#cops').css('cursor','pointer');
			
			$('#si_exit').css('cursor','pointer');
			$('#continue').css('cursor','pointer');
			$('#haltall').css('cursor','pointer');
			$('#si_exit').click(function(){
						$('#stopin').hide();
						$('#si_exit').hide();
						$('#si_btm').hide();
												});
			$('#continue').click(function(){
						$('#stopin').hide();
						$('#si_exit').hide();
						$('#si_btm').hide();
												});
			$('#haltall').click(function(){
						$('#stopin').hide();
						$('#si_exit').hide();
						$('#si_btm').hide();
						//
						$.post("haltall.php", {data: htmlStr});
						eandc(htmlStr);
												});
			$('#cops').click(function(){
						pageLoading = 1;			  
					$.post("overlay_loader.php",{page:"stopcop"},function(data){				  						$(".the_pic").html(data);
						$('#stopin').show();
						$('#si_exit').show();
						$('#si_btm').show();
																		  });
												});
			
		} else {
			$('#cops').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/police-car-animated.gif" width="113" height="50" />');
			$("#cops").show();
			$('#cops').css('cursor','pointer');
					
			if(the_crime==1){
				//ID number runners
				$('#cops').click(function(){
						$('#judges').show();
						$('#suspect_img').html('<img src="../file/pic/fbimages/5lotto.png" />');
						$('#patrols_left').html("Patrols Left: " + psleft);
						$('#judges_exit').show();
						$('#judges_btm').show();
												});		
			}else if(the_crime==2){
				//ID bootleggers
			$('#cops').click(function(){
						$('#judges').show();
						$('#suspect_img').html('<img src="../file/pic/fbimages/5boots.png" />');
						$('#patrols_left').html("Patrols Left: " + psleft);
						$('#judges_exit').show();
						$('#judges_btm').show();
												});
			}else if(the_crime==3){
				//ID drug dealers
			$('#cops').click(function(){
						$('#judges').show();
						$('#suspect_img').html('<img src="../file/pic/fbimages/5dealers.png" />');
						$('#patrols_left').html("Patrols Left: " + psleft);
						$('#judges_exit').show();
						$('#judges_btm').show();
												});
			}
		}
	}
	return false;
}
//
jQuery(function() { 
    $('#feds')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#o_p24',
				success: function(data) {
					$('#federal').hide();
				    $('#federal_exit').hide();
		            $('#federal_btm').hide();
					if(data == 1){
						//good job
						tb_show("Detective","../file/pic/fbimages/apb.png","");
					}else if(data == 2){
						//false accusation loss of quarter cool punish
						tb_show("Rookie Move","../file/pic/fbimages/accused.png","");
					}
				}
					  });
						});
});
//
jQuery(function() { 
    $('#municipal')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#o_p26',
				success: function(data) {
					$('#judges').hide();
				    $('#judges_exit').hide();
		            $('#judges_btm').hide();
					eandc(htmlStr);
					if(data == 1){
						//good job
						tb_show("Special Unit","../file/pic/fbimages/apb_lower.png","");
						$('#cops').hide();
					}else if(data == 2){
						//false accusation loss of quarter cool punish
						tb_show("Rookie Move","../file/pic/fbimages/accused_reg.png","");
						$('#cops').hide();
					}else if(data == 3){
						//mission completed
						tb_show("Officer","../file/pic/fbimages/greatjob.png","");
						$('#cops').hide();
					}
				}
					  });
						});
});
//
function snitch(user_pain,htmlStr){
	var mysnitch = parseInt(user_pain);
	if(mysnitch == 9){
		//tired
		$("#snitch_exit").css('cursor','pointer');
		pageLoading = 1;
		$.post("overlay_loader.php",{page:"snitch"},function(data){
		$(".the_pic").html(data);													 
		$("#snitching").show();
		$("#snitch_exit").show();
		$("#snitch_btm").show();
															 });
		$('#snitch_exit').click(function(){
					$("#snitching").hide();
					$("#snitch_exit").hide();
					$("#snitch_btm").hide();
					$("#cops").hide();
											  });
		$('#cops') .html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/police-car-animated.gif" width="113" height="50" />');
		$("#cops").show();
	}
	return false;
}
//
jQuery(function() {				
    // bind form using ajaxForm 
    $('#snitched')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#o_p22',
				success: function(data) {
					$("#snitching").hide();
					$("#snitch_exit").hide();
					$("#snitch_btm").hide();
					$("#cops").hide();
					alert("Thanks for your assistance.");
				}
					  });
						});
});

//
function hookups(igoods){
	if(igoods == "dealer"){
		//upstart 1
		marketwire(htmlStr);
		$('#express').css('cursor','pointer');
			$('#express').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../file/pic/fbimages/hookup_express_bus.png" width="95" height="49" />');		
			$('#express').show();
	} else if(igoods == "citizen"){
		$('#express').hide();
	}
	return false;
}
//
function marketwire(htmlStr){
	$("#tradingpost")
	.livequery(function(){ 
    // use the helper function hover to bind a mouseover and mouseout event 
        $(this) 
		.load("tradingpost.php", {data: htmlStr}, function(){
			$('#myfeens').ajaxForm({ 
				target: '#pointers',
				success: function(data) {
					$('#market_exit').hide();
					$('#the_market').hide();
					$('#tradingpost').hide();
					$('#market_header').hide();
					marketwire(htmlStr);
					newswire(htmlStr);
					eandc(htmlStr);
					if(data==1){
						tb_show("Get da F** outta here!!!","../file/pic/fbimages/offer_rejected.png","");
					} else if(data==2) {
						//cant cover
						tb_show("You're a small fish","../file/pic/fbimages/cantcover.png","");
					} else if(data==3) {
						//covered
						tb_show("Good Deal.","../file/pic/fbimages/getmoney.png","");
					}
					
				}
								   });
														   });											   
						});
	return false;
}
//
function how_high(user_energy,htmlStr,thatdope,user_energy_max){
	if(thatdope > 0){
		 var chec = parseInt(user_energy_max);
		 var user_high = parseInt(user_energy);
		if(user_high <= chec){
			$.post("boosts.php", {data: htmlStr},
								   function(kite){
									   var boost = parseInt(user_energy) + parseInt(kite);
										$('#u_energy').html(boost);
								   });
		}
	}
	return false;
}
//Upgraded
function upgraded(cool){
	if(cool >= 2258){
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
	if(cool >= 2258){
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
	if(cool >= 2258){
		//upstart 1
		$('#king_button')
			.livequery(function(){
								$(this)
								.css('cursor','pointer');
								});
		$('#king_button')
			.livequery('click', function(event) {
										 invgetter("#assets_2");
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
	if(cool >= 30625){
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
							   //casino win
							   tb_show("You made some money!","../file/graphics/casino_win.jpg","");
							   } else if(parseInt(data) == 2) {
								   //casino loss
								   tb_show("Get Outta here!","../file/graphics/casino_loser.jpg","");
							   } else if(parseInt(data) == 3) {
								   //fight win
								   tb_show("Stick up Kid","../file/graphics/robber_win.jpg","");
							   } else if(parseInt(data) == 4) {
								   //fight loss
								   tb_show("You were Robbed!","../file/graphics/robber_lost.jpg","");
							   }else if(parseInt(data) == 5) {
								   //crime succ
								   tb_show("Good Job.","../file/graphics/progress.jpg","");
							   }else if(parseInt(data) == 6) {
								   //crime failure
								   tb_show("Chump, you couldn't even do this right","../file/graphics/loser.jpg","");
							   }else if(parseInt(data) == 7) {
								   //police
								   tb_show("You got away!","../file/graphics/escaped.jpg","");
							   }else if(parseInt(data) == 8) {
								   //police loss
								   tb_show("You were captured!","../file/graphics/capture.jpg","");
							   }else if(parseInt(data) == 9) {
								   //arcade win
								   $('#facebook_user')
									.livequery(function(){
											PublishScore();
														});
									tb_show("<embed src='../file/app-8.mp3' height=0>","../file/graphics/newhighscore.jpg","");
			 						gta(htmlStr);
									tutor();
							   }else if(parseInt(data) == 10) {
								   //arcade loss
								   tb_show("<embed src='../file/laugh-02.mp3' height=0>","../file/graphics/loser.jpg","");
								   tutor();
							   }else if(parseInt(data) == 11) {
								   //heist loss
								  tb_show("You got knocked the F@%K Out!","../file/graphics/knockedout.jpg","");
							   }else if(parseInt(data) == 12) {
								   //heist loss
								  tb_show("Now just pray they play fair...","../file/graphics/waiting.jpg","");
							   }else if(parseInt(data) == 13) {
								   //heist loss
								  tb_show("Evenly Matched","../file/graphics/matched.jpg","");
							   }else if(parseInt(data) == 14) {
								   //heist loss
								  tb_show("Can't rob the poor","../file/graphics/bankrupt_player.jpg","");
							   }else if(parseInt(data) == 15) {
								   //heist loss
								  tb_show("Damn Security","../file/graphics/security_block.jpg","");
							   }else if(parseInt(data) == 16) {
								   //heist loss
								  tb_show("Idiot!","../file/graphics/alarm_sys_fail.jpg","");
							   }else if(parseInt(data) == 17) {
								   //heist loss
								  tb_show("Damn...","../file/graphics/alarm_sys_fail_boss.jpg","");
							   }else if(parseInt(data) == 18) {
								   //heist loss
								  tb_show("Damn...","../file/graphics/bank_security.jpg","");
							   }else if(parseInt(data) == 19) {
								   //heist loss
								  tb_show("Damn...","../file/graphics/bank_security_boss.jpg","");
							   }else if(parseInt(data) == 20) {
								   //heist loss
								  tb_show("Not so fast...","../file/graphics/bankvault_success.jpg","");
							   }else if(parseInt(data) == 21) {
								   //heist loss
								  tb_show("<embed src='../file/laugh-02.mp3' height=0>","../file/graphics/bankvault_fail.jpg","");
							   }else if(parseInt(data) == 22) {
								   //heist loss
								  tb_show("<embed src='../file/app-8.mp3' height=0>","../file/graphics/bankvault_open.jpg","");
							   }else if(parseInt(data) == 100) {
								   //won $1000000
								  tb_show("You Won!","../file/graphics/Racewin.jpg","");
								  tutor();
							   }else if(parseInt(data) == 101) {
								   //Out of time!
								  tb_show("You didnt move fast enough","../file/graphics/tooslow.jpg","");
								  tutor();
							   }else if(parseInt(data) == 102) {
								   //Completed but score too low
								  tb_show("You didn't meet the score challenge","../file/graphics/lowscore.jpg","");
							   }else if(parseInt(data) == 103) {
								   //Completed but score too low
								  tb_show("Hand over the keys!","../file/graphics/lostcar.jpg","");
							   }else if(parseInt(data) == 199) {
								   //heist loss
								  egg_race(htmlStr);	
							   }
					   }
		   });	
	return false;
}
//Bank Job
function robthebank(htmlStr){		
	$.getJSON("get_money.php", {data: htmlStr}, function(results){
								var data = results.check;
								var user_game = results.game;
								if(data == 1){
									tb_show("It's Time...Let's Get This Money","../file/graphics/bankjob_start.jpg","");	
									//member
									bankjobgetter("#practice",user_game);
									
								} else if(data == 2){
									//boss
									tb_show("Time to Crack the Vault!","../file/graphics/bankjob_start.jpg","");
									bankjobgetter("#practice",user_game);
								}													   
														 },"json");	
	return false;
}
//Egg Race
function egg_race(htmlStr){
	$.post("get_tourney.php", {data:htmlStr}, function(result){	
									$('#content').html(result);		   
														   });
	return false;
}
//Extras
function gta(htmlStr){
	$.getJSON("checkforeaster.php",{data: htmlStr},function(results){
	   var saved = results.form;
	   var picture = results.image;
	   var gates = results.report;
		if(gates == 2){
			if(saved == 1){
				$('#egg_words').html('<img src="../file/pic/fbimages/easter/'+ picture + '"/>');
				$('#egg').show();
				$('#egg_app').show();
				$('#egg_app2').hide();
				$('#egg_header').show();
				$('#egg_exit').show();
			} else if(saved == 2) {
				$('#egg_words').html('<img src="../file/pic/fbimages/easter/'+ picture + '"/>');
				$('#egg').show();
				$('#egg_app').hide();
				$('#egg_app2').show();
				$('#egg_header').show();
				$('#egg_exit').show();
			} else if(saved == 3) {
				$('#egg_words').html('<img src="../file/pic/fbimages/easter/'+ picture + '"/>');
				$('#egg').show();
				$('#egg_app2').hide();
				$('#egg_app').hide();
				$('#egg_header').show();
				$('#egg_exit').show();
			}
		}
												   },"json");
	return false;
}
//fight_results
function match_results(data){
	if(data == 5){
	   //fight win
	   tb_show("Stick up Kid","../file/graphics/robber_win.jpg","");
   } else if(parseInt(data) == 4) {
	   //fight loss
	   tb_show("You were Robbed!","../file/graphics/robber_lost.jpg","");
   }else if(parseInt(data) == 55) {
	   //crime succ
	   tb_show("Good Job...","../file/graphics/npc_dead.jpg","");
   }else if(parseInt(data) == 6) {
	   //crime failure
	   tb_show("Chump, you couldn't even do this right","../file/graphics/team_dead.jpg","");
   }else if(parseInt(data) == 1) {
	   //police
	   tb_show("Damn fool...","../file/graphics/tired_fighter.jpg","");
	   $('#impulse_exit_tks').show();
		$('#Impulse_Buy_tks').show();
		$('#impulse_sold_tks').show();
   }else if(parseInt(data) == 7) {
	   //police
	   tb_show("Tired","../file/graphics/coma.jpg","");
   }else if(parseInt(data) == 3) {
	   //police
	   tb_show("Evenly Matched","../file/graphics/matched.jpg","");
   }else if(parseInt(data) == 123) {
	   //police
	   tb_show("Can't rob the poor","../file/graphics/bankrupt_player.jpg","");
   }
	return false;
						   
}
//newsdesk
function newswire(htmlStr){
     $('#a_news')
		.livequery(function(){ 
        $(this) 
            .load("msnbc.php #arcadia", {data: htmlStr});
						}); 
		$('#chall')
		.livequery(function(){ 
        $(this) 
            .load("msnbc.php #challenges", {data: htmlStr});
						}); 
		$('#c_news')
		.livequery(function(){ 
        $(this) 
            .load("msnbc.php #crew_up", {data: htmlStr});
						});
		$('#h_news')
		.livequery(function(){ 
        $(this) 
            .load("msnbc.php #hustle_up", {data: htmlStr});
						});
		$('#g_news')
            .load("msnbc.php #gift_up", {data: htmlStr}, function(){
			$('#myfeens').ajaxForm({ 
				target: '#pointers',
				success: function(data) {
					$('#market_exit').hide();
					$('#the_market').hide();
					$('#tradingpost').hide();
					$('#market_header').hide();
					newswire(htmlStr);
					eandc(htmlStr);
					if(data==1){
						tb_show("Get da F** outta here!!!","../file/pic/fbimages/offer_rejected.png","");
					} else if(data==2) {
						//cant cover
						tb_show("You're a small fish","../file/pic/fbimages/cantcover.png","");
					} else if(data==3) {
						//covered
						tb_show("Good Deal.","../file/pic/fbimages/getmoney.png","");
					}
					
				}
								   });
			//Gifts
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
	return false;
}
//Internal load
function internalget(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			updateShoutbox();
			 eandc(htmlStr);
			  $("#userid")
			  .livequery(function(){
								  $(this)
								  .val(htmlStr);
								  });
			 $("#profile_sect").html(html);
		}

	});
return false;
}
function incommentget(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			updateCrewShout();
			 eandc(htmlStr);
			  $("#userid")
			  .livequery(function(){
								  $(this)
								  .val(htmlStr);
								  });
			 $("#profile_sect").html(html);
		}

	});
return false;
}
function avatarget(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			game_faces();
			$("#sex_change").show();
			 eandc(htmlStr);
			  $("#userid")
			  .livequery(function(){
								  $(this)
								  .val(htmlStr);
								  });
			 $("#profile_sect").html(html);
		}

	});
return false;
}
//
function game_faces(){
		//send the post to shoutbox.php
		$("#malelist")
	.livequery(function(){ 
    // use the helper function hover to bind a mouseover and mouseout event 
        $(this) 
		.load("faces.php #men", {data: htmlStr});						
						});
	$("#femalelist")
	.livequery(function(){ 
    // use the helper function hover to bind a mouseover and mouseout event 
        $(this) 
		.load("faces.php #women", {data: htmlStr});						
						});
		return false;
}
//
function updateCrewShout(){
		//send the post to shoutbox.php
		$.post("../shoutbox/shoutbox.php",{action:"c_update", customer:htmlStr},function(results){
				$("#shout_loading").fadeOut();
				$("#messagelist").html(results);	
																	 });
		return false;
}
function inmenuget2(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			updateCrewShout();
			 eandc(htmlStr);
			  $("#userid")
			  .livequery(function(){
								  $(this)
								  .val(htmlStr);
								  });
			 $("#shout_area").html(html);
		}

	});
return false;
}
function inmenuget3(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			 newswire(htmlStr);
			 eandc(htmlStr);
			  $("#userid")
			  .livequery(function(){
								  $(this)
								  .val(htmlStr);
								  });
			 $("#shout_area").html(html);
			 $("#shout_loading").fadeOut();
		}

	});
return false;
}
function inmenuget(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			updateShoutbox();
			 eandc(htmlStr);
			  $("#userid")
			  .livequery(function(){
								  $(this)
								  .val(htmlStr);
								  });
			 $("#shout_area").html(html);
		}

	});
return false;
}
//
function internalstatget(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			 profiler(htmlStr);
			 eandc(htmlStr);
			  $("#userid")
			  .livequery(function(){
								  $(this)
								  .val(htmlStr);
								  });
			 $("#profile_sect").html(html);
		}

	});
return false;
}
function firstget(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			$.getJSON("school.php", { data: htmlStr }, function(json){
											var total = json.total;
											var time_prog = json.time;
											var point_bonus = json.bonus;
											var area = json.area;
											var a_done = json.areas_done;
											var arc = json.arcade;
											var arc_done = json.arcade_done;
											var rob = json.rob;
											var rob_done = json.rob_done;
											var race = json.race;
											var race_done = json.races_done;
											var bank = json.bank;
											var bank_done = json.bank_done;
											var invest = json.invest;
											var inv_done = json.invest_done;
											var attack = json.attack;
											var tt_done = json.attack_done;
											var over = json.done;
											var lisa = json.lisa;
											if(over == 555){
												 tb_show("You're done","../file/tutorials/40.png","");
												 backgetter("#start");
											} else {
												$('#startp_bar')
												.livequery(function(){
																	$(this)
																	.css('width', total+'%');
																	});
												$('#tour_bar')
												.livequery(function(){
																	$(this)
																	.css('width', area+'%');
																	});
												$('#area_notice')
												.livequery(function(){
																	$(this)
																	.html(a_done + " of 21");
																	});
												$('#rob_bar')
												.livequery(function(){
																	$(this)
																	.css('width', rob+'%');
																	});
												$('#rob_notice')
												.livequery(function(){
																	$(this)
																	.html(rob_done + " of 20");
																	});
												$('#archus_bar')
												.livequery(function(){
																	$(this)
																	.css('width', arc+'%');
																	});
												$('#arc_notice')
												.livequery(function(){
																	$(this)
																	.html(arc_done + " of 10");
																	});
												$('#chhus_bar')
												.livequery(function(){
																	$(this)
																	.css('width', race+'%');
																	});
												$('#race_notice')
												.livequery(function(){
																	$(this)
																	.html(race_done + " of 10");
																	});
												$('#bank_bar')
												.livequery(function(){
																	$(this)
																	.css('width', bank+'%');
																	});
												$('#account_notice')
												.livequery(function(){
																	$(this)
																	.html(bank_done + " of 1");
																	});
												$('#invest_bar')
												.livequery(function(){
																	$(this)
																	.css('width', invest+'%');
																	});
												$('#invest_notice')
												.livequery(function(){
																	$(this)
																	.html(inv_done + " of 2");
																	});
												$('#attack_bar')
												.livequery(function(){
																	$(this)
																	.css('width', attack+'%');
																	});
												$('#attack_notice')
												.livequery(function(){
																	$(this)
																	.html(tt_done + " of 10");
																	});
												$("#time_rem_num")
												.livequery(function(){
																	$(this)
																	.html(time_prog);
																	});
												$("#xtra").html(23);
												 $("#userid")
												  .livequery(function(){
																	  $(this)
																	  .val(htmlStr);
																	  });
												 $("#profile_sect").html(html);
											}
														 });
		}

	});
return false;
}
//load
function backgetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
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
function startgetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			  $("#userid")
			  .livequery(function(){
								  $(this)
								  .val(htmlStr);
								  });
			 $("#content").html(html);
			 firstget('#init');
		}

	});
return false;
}
function gogetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			$.post("the_lisa.php",{person: htmlStr, checking: data});
			 $.post("leave_biz.php", {data: htmlStr});
			 bankinfo(htmlStr);
			 marshall(htmlStr);
			 agent_trial(htmlStr);
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
function giftgetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
				 hallmark(htmlStr);
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
function invgetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			$.post("the_lisa.php",{person: htmlStr, checking: data});
				 w_stats(htmlStr);
				 a_stats(htmlStr);
				 m_stats(htmlStr);				 
				 detective(htmlStr);
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
function managegetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			$.post("leave_biz.php", {data: htmlStr});
				 desktop(htmlStr);
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
function hitlistgetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
				 thelist(htmlStr);
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
function leadergetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			$.post("the_lisa.php",{person: htmlStr, checking: data});
				 theones(htmlStr);
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
function talentgetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			$.post("the_lisa.php",{person: htmlStr, checking: data});
				 scout(htmlStr);
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
function attackgetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			$.post("the_lisa.php",{person: htmlStr, checking: data});
				 coliseum(htmlStr);
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
function archusgetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			$.post("the_lisa.php",{person: htmlStr, checking: data});
				 ring(htmlStr);
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
function bizgetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			$.post("the_lisa.php",{person: htmlStr, checking: data});
				 fnc_casino(htmlStr);
				 fnc_club(htmlStr);
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
function profilegetter(data){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
			$.post("leave_biz.php", {data: htmlStr});
				 eandc(htmlStr);
				  $("#userid")
				  .livequery(function(){
									  $(this)
									  .val(htmlStr);
									  });
				 $("#content").html(html);
			internalget('#news');
		}

	});
return false;
}
function bankjobgetter(data,game){
$.ajax({
		type: "GET",
		url: "loader.php",
		dataType: 'html',
		data: {page: data},											
		success: function(html){
				  $("#userid")
				  .livequery(function(){
									  $(this)
									  .val(htmlStr);
									  });
				 $("#content").html(html);
				 $('#mission').show();
										$('#mission')
										.livequery(function(){
															$(this)
															.html(game);
															});	
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
			$.post("the_lisa.php",{person: htmlStr, checking: data});
				 flags();
				 eandc(htmlStr);
				  $("#userid")
				  .livequery(function(){
									  $(this)
									  .val(htmlStr);
									  });				  
				   $("#item_number")
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
	$('#ra_exit').css('cursor','pointer');
	$('#escalade').css('cursor','pointer');
	$('#escalade').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/escalade.png" width="95" height="49" />');
	$('#rago').css('cursor','pointer');
	$('#rano').css('cursor','pointer');
	$('#rago').click(function(){
					$('#ra_exit').hide();
					$('#rad').hide();
					$('#ridealong').hide();
					//start mission
					$.post("deduct_energy.php", {data: htmlStr, deduct: task}, 
						   function(results) { 
						   if(results == 1){
							   $('#Impulse_Buy_tks').show();
							   $('#impulse_exit_tks').show();
							   $('#impulse_sold_tks').show();
						   } else {
								gogetter("#practice");
								$('#mission').show();
								$('#mission')
											.livequery(function(){
												$(this)
												.html(game);
																});
								$('#mission')
											.livequery(function(){
												$(this)
												.fadeIn('slow');
																});
										   
						   }
						   });
											  });
	$('#rano').click(function(){				  
					$('#ra_exit').hide();
					$('#rad').hide();
					$('#ridealong').hide();
					$('#escalade').hide();
					//quit and delete mission
					$.post("crime_decide.php", {data: htmlStr, decision: 2});
											  });
		if(status == 1){
			$('#escalade').show();
			if(task==1){
				//pickup
				url = "<img src='http://www.12daysoffun.com/hustle/graphics/pickup.png' />";
			} else if(task==2){
				//dropoff
				url = "<img src='http://www.12daysoffun.com/hustle/graphics/delivery.png' />";
			}
			$('#escalade').show();
			$('#escalade').click(function(){				  
					$('#ra_exit').show();
					
					$('#job_n').html(url);
					$('#rad').show();
					$('#requireds').html("Min. Score Needed: " + score);
					$('#racosts').html("Cash Reward: $" + user_tcash + " CP Reward: " + user_tbonus);
					$('#ridealong').show();
											  });
		} else if(status == 2){		
			$('#escalade').show();
			if(task==1){
				//pickup
				$('#job_n').html("<img src='http://www.12daysoffun.com/hustle/graphics/pickup.png' />");
			} else if(task==2){
				//dropoff
				$('#job_n').html("<img src='http://www.12daysoffun.com/hustle/graphics/delivery.png' />");
			}
			$('#escalade').show();
			$('#escalade').click(function(){				  
					$('#ra_exit').show();
					
					
					$('#rad').show();
					$('#requireds').html("Min. Score Needed: " + score);
					$('#racosts').html("Cash Reward: $" + user_tcash + " CP Reward: " + user_tbonus);
					$('#ridealong').show();
											  });
		} else if(status == 3){
			//magic		
			$('#escalade').show();
			$('#escalade').click(function(){				  
					$('#ra_exit').show();
					
					$('#job_n').html("<img src='http://www.12daysoffun.com/hustle/graphics/shipment.png' />");
					$('#rad').show();
					$('#requireds').html("Min. Score Needed: " + score);
					$('#racosts').html("Cost: $" + user_tfee);
					$('#ridealong').show();
											  });	
		} else if(status == 4){
			//media	
			$('#escalade').show();
			$('#escalade').click(function(){				  
					$('#ra_exit').show();
					
					$('#job_n').html("<img src='http://www.12daysoffun.com/hustle/graphics/boot_shipment.png' />");
					$('#rad').show();
					$('#requireds').html("Min. Score Needed: " + score);
					$('#racosts').html("Cost: $" + user_tfee);
					$('#ridealong').show();
											  });
		} else if(status == 5){
			//lotto		
			$('#escalade').show();
			$('#escalade').click(function(){				  
					$('#ra_exit').show();
					
					$('#job_n').html("<img src='http://www.12daysoffun.com/hustle/graphics/lotto.png' />");
					$('#ridealong').show();
											  });
		} else if(status == 86){		
			$('#escalade').show();
			//
			$('#escalade').click(function(){				  
					$('#cquit_exit').show();
					$('#cquit_exit').css('cursor','pointer');
					$('#cretry').css('cursor','pointer');
					$('#cquit').css('cursor','pointer');
					$('#cincents').css('color','#FFF').html("<b>CP Cost</b>: " + user_tfee);
					$('#c_quit').show();
					$('#cqd').show();
											  });
			$('#cquit_exit').click(function(){				  
					$('#cquit_exit').hide();
					$('#c_quit').hide();
					$('#cqd').hide();
					$('#escalade').hide();
											  });
			$('#cretry').click(function(){				  
					$('#cquit_exit').hide();
					$('#c_quit').hide();
					$('#cqd').hide();
					//mission rety
					$.post("crime_decide.php", {data: htmlStr, decision: 1},
							   function(happening){
								   gogetter("#practice");
								 $('#mission').show();
								$('#mission')
									.livequery(function(){
										$(this)
										.html(happening);
														});
								$('#mission')
								.livequery(function(){
									$(this)
									.fadeIn('slow');
													});
								$('#mission')
								.livequery(function(){
									$(this)
									.fadeOut(30000);
													});
											   });
														});
			$('#cquit').click(function(){				  
					$('#cquit_exit').hide();
					$('#c_quit').hide();
					$('#cqd').hide();
					$('#escalade').hide();
					//mission quit
					$.post("crime_decide.php", {data: htmlStr, decision: 2, balance: user_tfee});
					
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
			$('#cops').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/police-car-animated.gif" width="113" height="50" />');
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
			$.post("overlay_loader.php",{page:"crook"},function(data){
			$(".the_pic").html(data);
			$('#gang_app').show();
			$('#r_exit_tks').show();
			$('#r_decision').show();
			eandc(htmlStr);
																});
		}
	}
	return false;
}
function academy(cont,initiate){	
	if(cont == 0){
		if(initiate == 1){
			$.post("overlay_loader.php",{page:"cop"},function(data){
			$(".the_pic").html(data);
			$('#cops_app').show();
			$('#c_exit_tks').show();
			$('#c_decision').show();
			eandc(htmlStr);
															  });
		}
	}
	return false;
}
//Drag Race
jQuery(function() { 
    $('#race_form')
	.livequery(function(){
	$(this)					
	.ajaxForm({ 			 
        target: '#play', 
		beforeSubmit: vform,
        success: function(data) {
			eandc(htmlStr);
			if(data==1){
				$('#Impulse_Buy').show();
				$('#impulse_exit').show();
				$('#impulse_sold').show();
			} else if(data==2) { 
				$('#Impulse_Buy_tks').show();
				$('#impulse_exit_tks').show();
				$('#impulse_sold_tks').show();
			} else if(data==10){
				tb_show("You need some wheels!","../file/pic/fbimages/broke_alert_fees.png","");
			} else if(data==20){
				tb_show("You need some wheels!","../file/pic/fbimages/broke_alert_wager.png","");
			} else if(data==3){
				tb_show("You need some wheels!","../file/graphics/buy_car.jpg","");
			} else if(data==4){
				tb_show("SELECT a someone to play against.","../file/graphics/sorry_person.jpg","");
			} else if(data==5){
				tb_show("SELECT your style of play.","../file/graphics/sorry_style.jpg","");
			} else if(data==40) {				
				PublishRaceChallenge();	
				tb_show("The Rules","../file/graphics/race_rules.jpg","");
				egg_race(htmlStr);
			
			}
		}
			  }); 
						}); 
});
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
				tb_show("Game Doesn't Exist","../file/graphics/sorry.jpg","");
			} else if(data==4){
				tb_show("SELECT a someone to play against.","../file/graphics/sorry_person.jpg","");
			} else if(data==5){
				tb_show("SELECT your style of play.","../file/graphics/sorry_style.jpg","");
			} else if(data==6){
				tb_show("Uhh-uuuh","../file/pic/fbimages/broke_alert.png","");
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
			
			PublishChallenge();	
			eandc(htmlStr);
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
						success: function(result) { 
							PublishInvite();
							tb_show("Invite Sent","../file/graphics/offersent.jpg","");
							eandc(htmlStr);
							tutor();
						}
															  });
									});
				});
   
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
            .load("hitlist_back.php", {data: htmlStr}, function(){;
			$('#hit_form')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#hit_results',
				success: function(data) {
					thelist(htmlStr);
					eandc(htmlStr);
					if(data==1){
						tb_show("Damn, fool...","../file/tired_fighter.png","");
						$('#impulse_exit_tks').show();
						$('#Impulse_Buy_tks').show();
						$('#impulse_sold_tks').show();
					} else if(data==8){
						tb_show("Hitman","../file/hitman.png","");
					} else if(data==4){
						tb_show("You were Robbed!","../file/robber_lost.png","");		
					} else if(data==3){
						tb_show("Evenly Matched","../file/matched.png","");						
					} else if(data==6){
						tb_show("You put them in a Coma!","../file/loser_coma.png","");
					}					
				}
					  });
						});
			eandc(htmlStr);	
															});
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
					if(data==1){
						tb_show("Damn, fool...","../file/graphics/tired_fighter.jpg","");
						detective(htmlStr);
						$('#impulse_exit_tks').show();
						$('#Impulse_Buy_tks').show();
						$('#impulse_sold_tks').show();
					} else if(data==8){
						tb_show("Hitman","../file/graphics/hitman.jpg","");
					detective(htmlStr);
					} else if(data==4){
						tb_show("You were Robbed!","../file/graphics/robber_lost.jpg","");		
					} else if(data==3){
						tb_show("Evenly Matched","../file/graphics/matched.jpg","");						
					}
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
					PublishOffer();
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
					$("#target").val(" ");
					$("#bounty").val(" ");
					$('#hit_status').fadeIn('fast');
					$('#hit_status').fadeOut(5000);
					thelist(htmlStr);
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
function attacker(who){
	$.getJSON("fight_results.php", { data: who }, function(json){
											var winner = json.winner;
											var loser = json.loser;
											var money = json.money;
											var cool = json.cool;
											var twist = json.poster;
											var name = json.name;
											var them = json.lname;
											if(twist == 555){
												tb_show("It's a Tie!","../file/matched.png","");
											} else {		
												$('#winner_circle').css("background-image",winner);
												$('#winner_cash').html(money);
												$('#winner_cool').html(cool);
												 $('#loser_circle').css("background-image",loser);
												 $('#loser_cash').html(money);
												 $('#loser_cool').html(cool);
												 $('#myname').html(name);
												 $('#theirname').html(them);
												$('#fight_feed').show();
											}
														   });
	return false;
}
	
//attack screen
function coliseum(htmlStr){	
		pageLoading = 1;	
	$("#gloves")
	.livequery(function(){				
        $(this) 
		.load("attack.php #fighters", {data: htmlStr}, function(){					
			$('#attack_form').ajaxForm({ 
				target: '#sum',
				success: function(info) {
					coliseum(htmlStr);
					eandc(htmlStr);
					if(info == 1){
						tb_show("Too tired to fight","../file/tired_fighter.png","");
						$('#impulse_exit_tks').show();
						$('#Impulse_Buy_tks').show();
						$('#impulse_sold_tks').show();
					} else {
						//avatars, money, cool, extras, clear win or loss
						attacker(info);
					}
				}
								   });
														   });											   
						});
	return false;
}
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
            .load("thering.php #top_players", {data: htmlStr});
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
		.load("management_backing.php #offers", {data: htmlStr}, function(){
			$('#cash_offers')
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
					desktop(htmlStr);
					$('#conf').fadeIn('fast');
					$('#conf').fadeOut(5000);
				} 
					  });
						});
});
//
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
$('.tab_clear')
.livequery('click', function(event) {
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
						tb_show("Buy More Tokens","../graphics/tks_buy_alert.png","");
					}else if(data==8){
						//lotto
						tb_show("You the next winner?","../graphics/lotto_picked.png","");
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
						tb_show("Buy More Tokens","../graphics/tks_buy_alert.png","");
					}else if(data==7){
						//magic
						tb_show("Get rid of this in a hurry","../graphics/magic_delivery.png","");
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
						tb_show("Buy More Tokens","../graphics/tks_buy_alert.png","");
					}else if(data==6){
						//rehab
						tb_show("Don't get strung out again, we love you...","../graphics/rehab_cert.png","");
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
						tb_show("Buy More Tokens","../graphics/tks_buy_alert.png","");
					}else if(data==5){
						//crew flag
						tb_show("New threads","../graphics/flag_id.png","");
						eandc(htmlStr);
					}else if(data==10){
						//crew flag
						tb_show("Choose A flag first","../graphics/flag_id.png","");
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
				success: function(nume) {
					$('#impulse_exit_tks').hide();
					$('#Impulse_Buy_tks').hide();
					$('#impulse_sold_tks').hide();
					if(nume==1){
						//buy more
						tb_show("Buy More Tokens","../graphics/tks_buy_alert.png","");
					}else if(nume==4){
						//Energy refilled
						tb_show("Aight you topped off","../graphics/fill_alert.png","");
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
						tb_show("Buy More Tokens","../graphics/tks_buy_alert.png","");						
					} else if(data==3){
						//Energy refilled
						tb_show("Aight you got dat paper now","../graphics/payout.png","");
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
						tb_show("Buy More Tokens","../graphics/tks_buy_alert.png","");						
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
						tb_show("Sorry", "../graphics/name_taken.png","");	
					} else if(data==2){
						$('#namor').hide();
						//new name
						tb_show("Your Crew is re-born","../graphics/name_good.png","");
						eandc(htmlStr);
					}
				}
					  });
						});
});
//last store item
jQuery(function() { 
    // bind form using ajaxForm 
    $('#jail')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sum',
				success: function(data) {
					if(data==1){
						//buy more
						tb_show("Buy More Tokens","../graphics/tks_buy_alert.png","");
					}else if(data==9){
						//record
						tb_show("You're free...for now","../graphics/destroyed_rec.png","");
						eandc(htmlStr);
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
							   tb_show("Uh-uhh","../file/pic/fbimages/broke_alert.png","");
					} else if(data==2){
							   //success
							   eandc(htmlStr);
							   fnc_casino(htmlStr);
							   $('#cbuy_exit').hide();
							   $('#casino_buy').hide();
							   $('#csfloor').hide();
							   //show casino
							   tb_show("Congrats","../file/pic/fbimages/casino_success.png","");
					}
				}
					  });
						});
				});
//
jQuery(function() { 
    // bind form using ajaxForm 
    $('#gamble')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#output',
				success: function(data) {
						//Make a Wager
						if(data==1){							
							$('#bet').hide();
							tb_show("Casino","vegas.php?keepThis=true&TB_iframe=false&height=435&width=700","");
							gogetter("#practice");					
						} else if(data==2) {
							tb_show("Uh-uhhh","../file/pic/fbimages/broke_alert.png","");
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
						tb_show("Sorry", "../file/pic/fbimages/broke_alert.png","");
					}else if(data==4){
						//inform
						eandc(htmlStr);
						fnc_casino(htmlStr);
						tb_show("Congrats", "../file/pic/fbimages/investor_alert.png","");
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
									pageLoading = 1;
									$.post("overlay_loader.php",{page:"entercasino"},function(data){
									$(".the_pic").html(data);
									$('#bet').show();
																							  });
								}
							}
								  });
									});
				$('#scopeout')
				.livequery(function(){
						$(this)
						.ajaxForm({ 
							target: '#output',
							success: function(biz_id) {
								eandc(htmlStr);
								the_customers(htmlStr,biz_id);
								$('#the_patrons').show();
								$('#patrons_exit').show();
								$('#patrons_header').show();
								$('#traffic_report').show();
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
		.load("clubstrip.php", {data: htmlStr}, function(){							   
				$('#invest_club')
				.livequery(function(){
				$(this)
				.ajaxForm({ 
				target: '#output',
				success: function(data) {
					//share min investment
					if(data==3){
						//not enough cash
						tb_show("Broke Ass", "../file/pic/fbimages/broke_alert.png","");
					}else if(data==4){
						//inform
						eandc(htmlStr);
						fnc_club(htmlStr);
						tb_show("Investor?", "../file/pic/fbimages/investor_alert.png","");
						tutor();
					}
				}
													 });
									});
				 $('#enter_club')
				.livequery(function(){
						$(this)
						.ajaxForm({ 
							target: '#output',
							success: function(data) {
								if(data==1){
									//Open Forum								
									tb_show("Club","../nightworld/phpchat/123flashchat.php?keepThis=true&TB_iframe=true&height=435&width=700","");
								}else if(data==2){
									tb_show("Uhhh-uhh", "../file/pic/fbimages/broke_alert.png","");
								}
							}
								  });
									});
				$('#scopeout')
				.livequery(function(){
						$(this)
						.ajaxForm({ 
							target: '#output',
							success: function(data) {
								eandc(htmlStr);
								if(data==2){
									tb_show("Broke Ass","../file/pic/fbimages/broke_alert.png","");
								}else {
									the_customers(htmlStr,data);
									$('#the_patrons').show();
									$('#patrons_exit').show();
									$('#patrons_header').show();
									$('#traffic_report').show();
									eandc(htmlStr);
									
								}
								
							}
								  });
									});
														   });
						});
	return false;
}

jQuery(function() { 
    // bind form using ajaxForm 
    $('#club_sold')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#o_p3',
				success: function(data) {
					if(data==1){
							   //failed
  							   $('#clbuy_exit').hide();
							   $('#club_buy').hide();
							   $('#clfloor').hide();
							   //
							   tb_show("Uh-uhhh","../file/pic/fbimages/broke_alert.png","");
					} else if(data==3){
							   //success
							   eandc(htmlStr);
							   fnc_club(htmlStr);
							   $('#clbuy_exit').hide();
							   $('#club_buy').hide();
							   $('#clfloor').hide();
							   //show club
							   tb_show("Congrats","../file/pic/fbimages/club_success.png","");
					}
				}
					  });
						});
				});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#the_fence')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#not',
				success: function(data) {
					if(data==1){
							   //failed
  							   $('#bm_dealer').hide();
							   $('#bm_exit').hide();
							   $('#dealer_btm').hide();
							   //
							   tb_show("Uh-uhhh","../file/pic/fbimages/broke_alert.png","");
					} else if(data==2){
							   //success dealer
							   eandc(htmlStr);
							   $('#bm_dealer').hide();
							   $('#bm_exit').hide();
							   $('#dealer_btm').hide();
							   //show club
							   tb_show("Be Right Back","../file/pic/fbimages/dealer_success.png","");
					} else if(data==3){
							   //reg post
							   eandc(htmlStr);
							   $('#bm_dealer').hide();
							   $('#bm_exit').hide();
							   $('#dealer_btm').hide();
							   //show club
							   tb_show("I'll Call you...","../file/pic/fbimages/post_success.png","");
					} else if(data==4){
							   //no one
							   eandc(htmlStr);
							   $('#bm_dealer').hide();
							   $('#bm_exit').hide();
							   $('#dealer_btm').hide();
							   //show club
							   tb_show("Try Again, You a N.A.R.C or something?","../file/pic/fbimages/no_one.png","");
					}
				}
					  });
						});
				});
//The Chases
function the_apb(htmlStr){
	$("#apb_report")
	.livequery(function(){
        $(this) 
		.load("operator.php", {data: htmlStr}, function(){
				$('#pursue')
				.livequery(function(){
									$(this).append('#apbs');
									});
				$('#offer')
				.livequery(function(){								
									$(this).append('#apbs');
									});
				$('#iden')
				.livequery(function(){
								$(this).append('#apbs');
								});	
				$('#who')
				.livequery(function(){
								$(this).append('#apbs');
								});	
				$('#apbs')
				.livequery(function(){
        		$(this)
				.ajaxForm({ 
				target: '#content' ,
				success: function(data) {
					//share min investment
					$('#the_chase').hide();
					$('#chase_exit').hide();
					$('#chase_header').hide();
					$('#apb_report').hide();
					if(isNumeric(data)){
						//offer bribe
						$.post("overlay_loader.php",{page:"gotbribe"},function(news){						 						$(".the_pic").html(news);
						$('#bamount').html("$" + data);					  
						$('#bribeme').show();
						$('#bribe_btm').show();
																			   });
					} else {
						gogetter("#practice");
						$('#mission').show();
							$('#mission')
							.livequery(function(){
												$(this)
												.html(data);
												});
							$('#mission')
							.livequery(function(){
												$(this)
												.fadeIn('slow');
												});
					}
				}
													 });	
									});
														   });
						});
	return false;
}
//Business Controls
function entre(htmlStr){
	$("#biz_hud")
	.livequery(function(){
        $(this) 
		.load("mybusiness.php", {data: htmlStr}, function(){							   
				$('#biz_change3')
				.livequery(function(){
				$(this)
				.ajaxForm({ 
				target: '#hoioi',
				success: function(data) {
					//share min investment
					$('#hoioi').html(data);
					$('#hoioi').fadeIn('fast');
					$('#hoioi').fadeOut(1500);
					entre(htmlStr);
				}
													 });	
									});
														  });
						});
	$("#huh_hud")
	.livequery(function(){
        $(this) 
		.load("mystocks.php", {data: htmlStr}, function(){							   
				$('#stockchange')
				.livequery(function(){
				$(this)
				.ajaxForm({ 
				target: '#hoioi2',
				success: function(data) {
					//share min investment
					$('#hoioi2').html(data);
					$('#hoioi2').fadeIn('fast');
					$('#hoioi2').fadeOut(1500);
					entre(htmlStr);
				}
													 });
									});
														   });
						});
	return false;
}
function marshall(htmlStr){
	$.getJSON("monitor.php", { data: htmlStr }, function(json){
											var noman = json.rejected;
											if(noman == 3){
												$('#carlos_words').html('<img src="../graphics/fed_job.png"/>');
												$('#fed_arcade').show();
												$('#fed_header').show();
											}
														 });
	return false;
}
//BG Music
jQuery(function() {
$('#music_box').css('cursor','pointer');
$('#music_box').click(function(){					
		$('#music').html('<embed src="../media/music.m3u" type="application/x-mplayer2" HIDDEN="true" AUTOSTART="true" loop="true"></embed>');
		$('#music_box2').show();
		$('#music_box').hide();
							   });
$('#music_box2').css('cursor','pointer');
$('#music_box2').click(function(){
		$('#music').html(' ');
		$('#music_box').show();
		$('#music_box2').hide();
							   });
				});

function addemail(htmlStr){
	//
	$.post("mailbox.php",{data: htmlStr},function(results){
			if(results == 1){
				$('#email_set').show();
				$('#email_btm').show();
			}
						});
	
	return false;
}
function agent_trial(htmlStr){
	$.getJSON("monitor.php", { data: htmlStr }, function(json){
											var theagent = json.agent;
											var isagent = parseInt(theagent);
											if(isagent == 2){
												$('#agency_init').html('<img src="../graphics/readyicon_yellow_51x27_01.gif" width="51" height="23" /><img src="../graphics/agent_contact.png" width="12" height="37" />');
											}
														 });
	return false;
}
//Federal Offer
jQuery(function() {
//
$('#thefeds')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#carlos_response',
				success: function(data) {
					eandc(htmlStr);
					$('#fed_arcade').hide();
					$('#fed_header').hide();
				} 
					  });
						});

				});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#email_u')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#emailhide',
				success: function(data) {
					if(data==1){
						//buy more
						alert("Thank You.");
						$('#email_set').hide();
						$('#email_btm').hide();
					}else if(data==2){
						alert("Change your mind, head to MANAGE BUTTON");
						$('#email_set').hide();
						$('#email_btm').hide();
					}
				}
					  });
						});
});
//Live Stream
jQuery(function() {
$('#lobby')
.livequery(function(){
					$(this)
					.css('cursor','pointer');
					});
$('#lobby')
			.livequery('click', function(event) {
						$('#stream_header').show();				 
						$('#stream_exit').show();
						$('#live_stream').show();
										 });	
$('#stream_exit').css('cursor','pointer');
$('#stream_exit').click(function(){
					$('#stream_header').hide();			 
					$('#live_stream').hide();
					$('#stream_exit').hide();
							   });
				});
//Agent's Errand
jQuery(function() {
$('#agency_init')
.livequery(function(){
					$(this)
					.css('cursor','pointer');
					});
$('#agency_init')
			.livequery('click', function(event) {
						agentready(htmlStr);				 
										 });	
$('#agent_exit').css('cursor','pointer');
$('#agent_exit').click(function(){
					$('#agent_header').hide();			 
					$('#agent_arcade').hide();
					$('#agent_exit').hide();
							   });

//agent activation
function agent_orders(htmlStr){
	
	return false;
}
//agent start
function agentready(htmlStr){
	$.getJSON("monitor.php", { data: htmlStr }, function(json){
											var user_cash = json.cash;
											var your_cash = parseInt(user_cash);
											if(your_cash > 500){
												$('#agent_words').html('<img src="../graphics/agents_offer.png" width="323" height="217" />');
												$('#agent_arcade').show();				 
												$('#agent_exit').show();
												$('#agent_header').show();
												$('#agency_app').show();
											} else {
												$('#agent_words').html('<img src="../graphics/agents_job.png" width="323" height="217" />');
												$('#agent_arcade').show();				 
												$('#agent_exit').show();
												$('#agent_header').show();
												$('#agency_app').hide();
											}
														 });
	return false;
}
//
$('#theagent')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#app_response',
				success: function(data) {
					eandc(htmlStr);	
					$('#agent_arcade').hide();				 
					$('#agent_exit').hide();
					$('#agent_header').hide();
					$('#agency_app').hide();
					$('#agency_init').html('');
					if(data == 1){
						//cell phone message
						tb_show("You're not a full Agent, yet.","../graphics/agents_phone.png","");
					} else if(data == 2){
						//attack
						tb_show("Bad Move","../graphics/agents_no.png","");
						eandc(htmlStr);
					}
					
				} 
					  });
						});

				});
//Feed Story
jQuery(function() {
				$('#false_fb_foreg')
				.livequery(function(){
								$(this)
								.css('cursor','pointer');
									});
				$('#false_fb_foreg')
			.livequery('click', function(event) {
										 PublishMessageFacebook();
									
										 });
				});
function the_customers(htmlStr,biz_id){
	$("#traffic_report")
	.livequery(function(){
        $(this) 
		.load("matred.php", {data: htmlStr, business: biz_id}, function(result){
		var resultant = parseInt(result);																
		if(resultant != 2){
			$('#instigator')
			.livequery(function(){
								$(this).append('#robbery_form');
								});
			$('#decision')
			.livequery(function(){								
								$(this).append('#robbery_form');
								});
			$('#target')
			.livequery(function(){
								$(this).append('#robbery_form');
								});
				 $('#robbery_form')
				.livequery(function(){
					$(this)
					.ajaxForm({ 
				target: '#output',
				success: function(decisions) {
					match_results(decisions);
					eandc(htmlStr);
					//share min investment
					$('#the_patrons').hide();
					$('#patrons_exit').hide();
					$('#patrons_header').hide();
					$('#traffic_report').hide();
					if(decisions==99){
						$.getJSON("agenthq.php", { data: htmlStr }, function(json){
											var orders = json.image;
											var contact = json.contact;
											//if there are orders
											$('#contact_words').html(contact);
											$('#contact_header').hide();
											$('#agent_contact').show();
											$('#contact_exit').hide();
											$('#contact_app').show();
														 });
						
					} else if(decisions==88){
						tb_show("Security is on your ASS!","../graphics/securityfight.png","");
						tutor();						
						$.post("example.php", {data: htmlStr}, function(user_game){
								$('#content')
								.livequery(function(){
													$(this)
													.html(user_game);
													});
								$('#mission').show();						   
														   });						
					} 
				}
							  });
									});
		} else {
			$('#the_patrons').hide();
			$('#patrons_exit').hide();
			$('#patrons_header').hide();
			$('#traffic_report').hide();
			tb_show("Uh-uhhh","../file/pic/fbimages/broke_alert.png","");
		}
																		});
						});
	return false;
}
function the_patients(htmlStr){
	$("#bed_report")
	.livequery(function(){
        $(this) 
		.load("nursestation.php", {data: htmlStr}, function(result){
		var resultant = parseInt(result);																
		if(resultant != 2){															
				 $('#kill_form')
				.livequery(function(){
					$(this)
					.ajaxForm({ 
				target: '#kill_results',
				success: function(decisions) {
					match_results(decisions);
					eandc(htmlStr);
					//share min investment
					$('#theward').hide();
					$('#ward_exit').hide();
					$('#ward_btm').hide();
					$('#bed_report').hide();
					if(decisions==88){
						tb_show("Security is on your ASS!","../graphics/securityfight.png","");
						$.post("example.php", {data: htmlStr}, function(user_game){
								$('#content')
								.livequery(function(){
													$(this)
													.html(user_game);
													});
								$('#mission').show();						   
														   });						
					}
				}
							  });
									});
		}
																		});
						});
	return false;
}
//NPC Interactions
//Overlay
jQuery(function() { 
    // bind form using ajaxForm 	
	$('#thecontact')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#contact_response',
				success: function(data) {
					eandc(htmlStr);	
				}
					  });
						});
	$('#thetut')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#student_response',
				success: function(data) {
					eandc(htmlStr);	
					$('#lisa').hide();
					$('#tutorial_app').hide();
					$.post("tutor_lisa.php",{data: htmlStr,checking: 33},function(results){
						var pagenum = parseInt(results);
						if((pagenum == 1)||(pagenum == 2)||(pagenum == 3)||(pagenum == 4)||(pagenum == 5)||(pagenum == 9)){
							tutor();
						}
																				  });
				}
					  });
						});
				});
jQuery(function() {
	$('#theegg')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#egg_response',
				success: function(data) {
					eandc(htmlStr);
					if(data == 1){
						$('#egg').hide();
						$('#egg_header').hide();
						$('#egg_exit').hide();
						$('#egg_words').hide();
						$('#egg_app2').hide();
						$('#egg_app1').hide();
						tb_show("Take your broke ass outta here...","../file/pic/fbimages/broke_alert.png","");
					} else if(data == 3){
						$('#egg').hide();
						$('#egg_header').hide();
						$('#egg_exit').hide();
						$('#egg_words').hide();
						$('#egg_app2').hide();
						$('#egg_app1').hide();
						//start race, set clock, and show first game						
						//show game
						egg_race(htmlStr);								
					} else if(data == 4){
						//offer mom's car
						$.post("overlay_loader.php",{page:"caroffer"},function(data){						 										$(".the_pic").html(data);
										$('#car_paypal').show();
										$('#car_pp_exit').show();
										$('#car_btm').show();
																				  });
					} else if(data == 5){
						$('#egg').hide();
						$('#egg_header').hide();
						$('#egg_exit').hide();
						$('#egg_words').hide();
						$('#egg_app2').hide();
						$('#egg_app1').hide();
					}
				}
					  });
						});
				});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#thepp_fence')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sunm',
				success: function(data) {
					if(data==1){
						//buy more
						tb_show("Buy More Tokens","../graphics/tks_buy_alert.png","");
					}else if(data==20){
						//mom's car
						tb_show("Damn","../file/pic/fbimages/easter/station.png","");
						eandc(htmlStr);
					}else if(data==21){
						//Tank
						tb_show("Nearly Invincible, Sorta'","../file/pic/fbimages/easter/tank.png","");
						eandc(htmlStr);
					}else if(data==22){
						//Adrenaline Shot
						tb_show("Walking Dead, Not","../file/pic/fbimages/easter/adrenaline.png","");
						eandc(htmlStr);
					}else if(data==23){
						//Yacht
						tb_show("Big Pimpin'","../file/pic/fbimages/easter/yacht.png","");
						eandc(htmlStr);
					}else if(data==24){
						//Gatling Gun
						tb_show("Got a Big F@%kin Gun!","../file/pic/fbimages/easter/gatling.png","");
						eandc(htmlStr);
					}else if(data==25){
						//Motorcycle
						tb_show("Got a Bike!","../file/pic/fbimages/easter/motorcycle.png","");
						eandc(htmlStr);
					}
				}
					  });
						});
});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#thepp_fence2')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sunm2',
				success: function(data) {
					$('#car_paypal').hide();
					$('#car_pp_exit').hide();
					$('#car_btm').hide();
					if(data==1){
						//buy more
						alert("You need more Reward Points!");
						$('#paypal_box').show();
    					$('#paypal_exit').show();
					    $('#paypal_btm').show();
					}else if(data==20){
						//mom's car
						$('#egg').hide();
						$('#egg_header').hide();
						$('#egg_exit').hide();
						$('#egg_words').hide();
						$('#egg_app2').hide();
						$('#egg_app1').hide();
						tb_show("Damn","../file/pic/fbimages/easter/station.png","");
						eandc(htmlStr);
						
					}
				}
					  });
						});
});
jQuery(function() {
	$('#theegg2')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#egg_response',
				success: function(data) {
					eandc(htmlStr);
					if(data == 1){
						$('#egg').hide();
						$('#egg_header').hide();
						$('#egg_exit').hide();
						$('#egg_words').hide();
						$('#egg_app2').hide();
						$('#egg_app1').hide();
						tb_show("Take your broke ass outta here...","../file/pic/fbimages/broke_alert.png","");
					} else if(data == 2){
						$('#egg').hide();
						$('#egg_header').hide();
						$('#egg_exit').hide();
						$('#egg_words').hide();
						$('#egg_app2').hide();
						$('#egg_app1').hide();
						//start race, set clock, and show first game						
						//show game
						tb_show("Savings","../file/pic/fbimages/easter/bribe_info.png","");								
					} 
				}
					  });
						});
				});
jQuery(function() {
	$('#bribes')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sunm3',
				success: function(data) {
					eandc(htmlStr);
					if(data == 1){
						$('#bribeme').hide();
						$('#bribe_exit').hide();
						$('#bribe_btm').hide();
						tb_show("Internal Affairs","../file/pic/fbimages/easter/internal_affairs.png","");
					} else {
						$('#egg').hide();
						$('#egg_header').hide();
						$('#egg_exit').hide();
						$('#egg_words').hide();
						$('#egg_app2').hide();
						$('#egg_app1').hide();
						//start race, set clock, and show first game						
						//show game
						tb_show("Savings","../file/pic/fbimages/easter/bribe_info.png","");								
					} 
				}
					  });
						});
				});
jQuery(function() {
	$('#thenurse')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sunm9',
				success: function(data) {
					eandc(htmlStr);
					$('#nurse').hide();
					$('#nurse_exit').hide();
					$('#nurse_btm').hide();
					if(data == 1){
						tb_show("Uh-uhhh","../file/pic/fbimages/broke_alert.png","");
					} else if(data == 2) {
						tb_show("MMMMM Feels Good","../graphics/healing.png","");								
					} else if(data == 3) {
						tb_show("They're Feeling better","../graphics/team_healing.png","");								
					} 
				}
					  });
						});
				});
jQuery(function() {
	$('#eatup')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sunm12',
				success: function(data) {
					eandc(htmlStr);
					$('#joes').hide();
					$('#joes_exit').hide();
					$('#joes_btm').hide();
					if(data == 1){
						tb_show("Uh-uhhh","../file/pic/fbimages/broke_alert.png","");
					} else if(data == 2) {
						tb_show("MMMMMmm tastes like cardboard","../graphics/healing.png","");								
					} else if(data == 3) {
						alert("You're already full of it, ha! ha!");								
					}
				}
					  });
						});
				});
jQuery(function() {
	$('#toohigh')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#high12',
				success: function(data) {
					eandc(htmlStr);
					$('#junkie_option').hide();
					$('#junkie_btm').hide();
					if(data == 1){
						storegetter("#store");						
					}
				}
					  });
						});
				});
//bank trans
jQuery(function() {
	$('#bankaccount')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#output',
				success: function(data) {
					bankinfo(htmlStr);
					eandc(htmlStr);
					if(data == 1){
						tb_show("Uh-uhhh","../graphics/bank_broke_alert.png","");
					} else if(data == 2){
						tb_show("Congrats","../graphics/bank_welcome.png","");
					} else if(data == 3){
						tb_show("Slow poke","../graphics/bank_account.png","");
					}
					tutor();
				}
					  });
						});
				});
jQuery(function() {
	$('#bankdeposit')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#output',
				success: function(data) {
					$('#in').val(' ');
					bankinfo(htmlStr);
					eandc(htmlStr);
					if(data == 2){
						tb_show("Uh-uhhh","../file/pic/fbimages/broke_alert.png","");
					} else if(data == 6){
						tb_show("No Commas","../file/pic/fbimages/nocommas.png","");
					}

				}
					  });
						});
				});
jQuery(function() {
	$('#bankwithdraw')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#output',
				success: function(data) {
					$('#out').val(' ');
					bankinfo(htmlStr);
					eandc(htmlStr);
					if(data == 3){
						tb_show("Uh-uhhh","../graphics/bank_broke_acct.png","");
					} else if(data == 4){
						tb_show("Uh-uhhh","../graphics/bank_closed.png","");
					} else if(data == 6){
						tb_show("No commas","../file/pic/fbimages/nocommas.png","");
					}

				}
					  });
						});
				});
jQuery(function() {
	$('#bankinvest')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#output',
				success: function(data) {
					bankinfo(htmlStr);
					eandc(htmlStr);
					if(data == 66){
						tb_show("Congrats","../graphics/bank_investor.png","");
					} else if(data == 2){
						tb_show("Uh-uhhh","../graphics/bank_min.png","");
					}
				}
					  });
						});
				});
jQuery(function() {
	$('#signmeup')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#output',
				success: function(data) {					
					eandc(htmlStr);
					$('#bank_checkin').hide();
     				$('#bank_checkin_exit').hide();
				    $('#bank_checkin_btm').hide();
					if(data == 1){
						tb_show("No one by that name","../graphics/bank_noname.png","");
					} else if(data == 2){
						tb_show("Waiting","../graphics/bankjob_checkin.png","");
					} else if(data == 3){						//tb_show("Ready","../graphics/bankjob_start.png","");
						
					} else if(data == 4){
						tb_show("Need a car","../graphics/bankjob_car.png","");
					}
				}
					  });
						});
				});
jQuery(function() { 
    // bind form using ajaxForm 
    $('#character')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#imin',
				success: function(data) {
					if(data==1){
						//taken
						tb_show("Sorry", "../file/graphics/crew_name_taken.jpg","");	
					} else if(data==2){
						//new name
						tb_show("Sorry", "../file/graphics/my_name_taken.jpg","");
					} else if(data==4){	
						//new flags
						tb_show("Chose your colors!", "../file/graphics/sorry_no_flag.jpg","");
					} else {						
						$('#custom_me').hide();
						$('#custom_me_btm').hide();	
						PublishStart();
						tutor();
					}
				}
					  });
						});
});
function updateShoutbox(){
		//send the post to shoutbox.php
		$.post("../shoutbox/shoutbox.php",{action:"update"},function(results){
				$("#shout_loading").fadeOut();
				$("#messagelist").html(results);	
																	 });
		return false;
}
jQuery(function() {
	$('#public_shout')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sum',
				success: function(data) {
					updateShoutbox();
					$('#two_cents').val(' ');
					if(data==1){
						alert("Please fill all fields!");	
					}
				}
					  });
						});	
				});
jQuery(function() {
	$('#crew_shout')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sum',
				success: function(data) {
					updateCrewShout();
					$('#two_cents').val(' ');
					if(data==1){
						alert("Please fill all fields!");	
					}
				}
					  });
						});	
				});
jQuery(function() {
	$('#tempfaces')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#sum',
				success: function(data) {
					if(data == 1){
						alert("Make a Choice");
					} else {
						alert('Congrats. This face is temporary until customizable AVATARS are done.');
					}
				}
					  });
						});	
				});
jQuery(function() {
	$('#terms_u')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#acceptance',
				success: function() {
					//
					$('#terms_exit').hide();
					$('#terms_set').hide();
					$('#terms_btm').hide();
				}
					  });
						});	
				});
jQuery(function() {
	$('#raceway')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#engines',
				success: function(data) {
					//
					eandc(htmlStr);
					if(data == 1){
						tb_show("Uh-uhhh","../file/pic/fbimages/broke_alert.png","");
					} else if(data == 2){
						tb_show("Too tired to travel","../file/graphics/tired_fighter.jpg","");
						$('#impulse_exit_tks').show();
						$('#Impulse_Buy_tks').show();
						$('#impulse_sold_tks').show();
					} else if(data == 3){
						tb_show("You need some wheels!","../file/graphics/buy_car.jpg","");
					} else if(data == 4){
						tb_show("The Rules","../file/graphics/race_rules.jpg","");
						egg_race(htmlStr);
					} 
				}
					  });
						});	
				});
jQuery(function() {
	$('#dealership')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#nosale',
				success: function(data) {
					eandc(htmlStr);
					$('#car_lot').hide();
					$('#car_lot_exit').hide();
					$('#carlot_btm').hide();
					//					
					if(data == 1){
						tb_show("Uh-uhhh","../file/pic/fbimages/broke_alert.png","");
					} else if(data == 2){
						tb_show("Congrats you have a car!","../file/graphics/car_purchase.jpg","");
					}
				}
					  });
						});	
				});
jQuery(function() {
	$('#deedatt')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#deed_attack_response',
				success: function(data) {
					eandc(htmlStr);		
					$('#deed_contest').hide();
					$('#deed_attack_header').hide();
					//					
					if(data == 1){
						tb_show("Uh-uhhh","../file/pic/fbimages/broke_alert.png","");
						//send back to homepage | Cant pay
						internalget('#backyard');
					} else if(data == 2){
						tb_show("Thank You, Come Again","../file/graphics/you_can_pass.jpg","");
						//let pass
					} else if(data == 3){
						tb_show("Congrats","../file/graphics/land_purchase.jpg","");
						//take land
					} else if(data == 4){
						tb_show("Thank You, Come Again","../file/graphics/robber_lost.jpg","");
						//take and  send home
						internalget('#backyard');
					}
				}
					  });
						});	
				});
jQuery(function() {
	$('#deedsale')
	.livequery(function(){
			$(this)
			.ajaxForm({ 
				target: '#deed_response',
				success: function(data) {
					eandc(htmlStr);		
					$('#deed_bank').hide();
					$('#deed_header').hide();
					$('#deed_exit').hide();
					//					
					if(data == 1){
						tb_show("Uh-uhhh","../file/pic/fbimages/broke_alert.png","");
					} else if(data == 2){
						tb_show("Gettin' Your hustle on","../file/graphics/land_purchase.jpg","");
					}
				}
					  });
						});	
				});
</script>
<body style="margin:0;">
<script type="text/javascript">
<?php if ($loginUrl) { ?>
	var newwindow;
	var intId;
	function login(){
		var  screenX    = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
			 screenY    = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
			 outerWidth = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.body.clientWidth,
			 outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
			 width    = 500,
			 height   = 270,
			 left     = parseInt(screenX + ((outerWidth - width) / 2), 10),
			 top      = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
			 features = (
				'width=' + width +
				',height=' + height +
				',left=' + left +
				',top=' + top
			  );

		newwindow=window.open('<?=$loginUrl?>','Login by facebook',features);

		 if (window.focus) {newwindow.focus()}
		return false;
	}

	<?php } ?>
</script>
<?php if (!$fbme) { ?>
 <a href="#" onClick="login();return false;"> <img src="../graphics/hustle_over2.jpg" border="0"> </a>
 <h3>Welcome to <b>The HUSTLE</b></h3>
 <p>Use and improve your 12 HUSTLES or ways to generate money as you </p>
 <p>Take over the CITY OF BLISS one neighborhood at a time and protect your turf from other crews</p>
  <?php } ?>
  
  <?php if($debug){?>
  <style type="text/css">
    .box{
        margin: 5px;
        border: 1px solid #60729b;
        padding: 5px;
        width: 500px;
        height: 200px;
        overflow:auto;
        background-color: #e6ebf8;
    }
</style>
</div>
<table border="0" cellspacing="3" cellpadding="3">
    <tr>
            <td>
                <!-- Data retrived from user profile are shown here -->
                <div class="box">
                    <b>User Information using Graph API</b>
                    <?php d($fbme); ?>
                </div>
            </td>
            <td>
                <div class="box">
                    <b>User likes these movies | using graph api</b>
                     <?php d($movies); ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="box">
                    <b>User Information by Calling Legacy API method "users.getinfo"</b>
                    <?php d($userInfo); ?>
                </div>
            </td>
            <td>
                <div class="box">
                    <b>FQL Query Example by calling Legacy API method "fql.query"</b>
                    <?php d($fqlResult); ?>
                </div>
            </td>
        </tr>
    </table>
    <div class="box">
        <form name="" action="<?=$config['baseurl']?>" method="post">
            <label for="tt">Status update using Graph API</label>
            <br />
            <textarea id="tt" name="tt" cols="50" rows="5">Write your status here and click 'Update My Status'</textarea>
            <br />
            <input type="submit" value="Update My Status" />
        </form>
        <?php if (isset($statusUpdate)) { ?>
            <br />
            <b style="color: red">Status Updated Successfully! Status id is <?=$statusUpdate['id']?></b>
         <?php } ?>
    </div>
<?php } ?>
<?php if ($fbme && $debug == 0){ require_once("ProfileCreator.php");?>
<div id="pointers" style="display:none"></div>
<div id="facebook_user" style="color:#FFF"><?php echo $user; ?></div>
<a name="verytop" id="verytop"></a>
<div id="music_box2" style="display:none"><img src="../graphics/mute2_button.png" /></div>
<div id="music_box"><img src="../graphics/mute_button.png" /></div>
<div id="wrapper">
  <div id="header">
    <div id="external">
      <table width="0" border="0" cellpadding="0" align="right">
        <tr>
          <td valign="top"></td>
          <td align="right" valign="top"><div class="header" id="instructions">
              <div id="redirects">
                <div id="privacypolicy"><a href="../privacyPolicy.html" target="_blank">PrivacyPolicy</a></div>
                <div id="terms"><a href="../terms.html" target="_blank">ToS</a></div>
                <div id="forums"><a href="http://www.facebook.com/apps/application.php?id=314391455964&v=app_2373072738" target="_parent"> Forums</a></div>
              </div>
            </div></td>
        </tr>
      </table>
    </div>
    <div id="taxi_cab"><img src="../graphics/taxi.png" width="51" height="16" /></div>
    <div id="bonus_container"></div>
    <div id="bonus_bar_container">
      <div id="bonus_bar" style="overflow: hidden; text-align:left; float: left; width: 0%;">&nbsp;</div>
    </div>
    <div id="health_container">
      <div id="clock_health" style="display: none; color:#FFF; font-size: small">More in <span class="more_in"><span
						id="countdownSpanHealth" style="font-size: small"></span></span></div>
    </div>
    <div id="level_bar_container">
      <div id="level_bar" style="overflow: hidden; text-align:left; float: left; width: 0%;">&nbsp;</div>
    </div>
    <div id="cash_cp">
      <div id="cp_stat"><span id="u_cool"></span>/<span id="ucool_max"></span><span id="ucool_max_note"></span></div>
      <div id="cash_stat"><span id="dollar_sign">$</span><span id="dollar_val"></span></div>
    </div>
    <div id="level">
      <div id="level_number_stat" style="color:#FFF; padding-top:2px; font-weight:bold;"></div>
      <div id="clock_energy" style="display: none;">More in <span class="more_in"><span
						id="countdownSpanEnergy" style="font-size: small"></span></span></div>
    </div>
    <div id="energy">
      <table width="340" border="0" cellpadding="0" align="right">
        <tr>
          <td><div id="energy_stat"><span id="u_energy"></span>/<span id="uenergy_max"></span></div></td>
          <td><div id="level_label"></div></td>
          <td><div id="c_rank"></div></td>
        </tr>
      </table>
      <div id="nav_bar">
        <div id="store_section">
          <div id="manage_butt"><img src="../graphics/manage_h_button.png"/></div>
        </div>
        <div id="store_butt"><img src="../graphics/store_button.png"/></div>
        <div id="home_butt"><img src="../graphics/home_button.png" width="36" height="11" alt="Home" /></div>
      </div>
    </div>
  </div>
  <div class="loading"></div>
  <!--Money_loader_overlay-->
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
			src="http://12daysoffun.com/hustle/graphics/AnimatedMoney.gif" />
              <div id="LoadingRefresh"
			style="text-align: center; padding-bottom: 5px; display: none;"><a
			href="http://apps.facebook.com/the_hustle" title="Try Refreshing" target="_top"
			class="sexy_button" style="float: none">Try Refreshing?</a></div></td>
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
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <img
			src="http://12daysoffun.com/hustle/graphics/impulse_buy.png" />
              <div id="impulse_sold"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><img src="../../clique/graphics/btn_buynow_paypal2.gif" width="107" height="26" /></div></td>
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
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <img
			src="http://12daysoffun.com/hustle/graphics/impulse_buy_tks.png" />
              <div align="center" style="background-color:#333">
                <form id="full_e" name="full_e" method="post" action="store_clerk.php">
                  <input type="hidden" id="energyfill" name="energyfill" value="energyfill"/>
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user?>"/>
                  <input type="image" src="../graphics/recharge.gif" name="buynow">
                </form>
              </div>
              <div id="sum" style="display:none"></div></td>
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
			style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <img id="thewords" src="../graphics/impulse_buy_tks.png" />
              <div id="tks"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><img src="../graphics/recharge.gif" width="107" height="26" /></div></td>
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
	style="position: absolute; top: 100px; left: 253px; width: 360px; text-align: center; z-index: 100; display: none; background:url(../graphics/news__bk.png);">
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
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <div class="the_pic"></div>
              <div id="c_decision"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><span id="caccept"><img src="../graphics/accept.png" width="107" height="26" /></span><span id="cecline"><img src="../graphics/decline.png" width="107" height="26" /></span></div></td>
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
	style="position: absolute; top: 115px; left: 163px; width: 360px; text-align: center; z-index: 100; display: none; background:url(../graphics/news__bk.png);">
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
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <div class="the_pic"></div>
              <div id="r_decision"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><span id="raccept"><img src="../graphics/accept.png" width="107" height="26" /></span><span id="recline"><img src="../graphics/decline.png" width="107" height="26" /></span></div></td>
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
  <!--Quit mission -->
  <div id="c_quit"
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
            <td><div id="cquit_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <img src="../graphics/quitter.png" />
              <div id="cincents"></div>
              <div id="cqd"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><span id="cretry"><img src="../graphics/retry.png" width="107" height="26" /></span><span id="cquit"><img src="../graphics/quit.png" width="107" height="26" /></span></div></td>
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
  <!--Accept crime mission -->
  <div id="ridealong"
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
            <td><div id="ra_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <div id="job_n"></div>
              <div id="racosts"></div>
              <div id="requireds"></div>
              <div id="rad"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><span id="rago"><img src="../graphics/accept.png" width="107" height="26" /></span><span id="rano"><img src="../graphics/decline.png" width="107" height="26" /></span></div></td>
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
	style="position: absolute; top: 125px; left: 153px; width: 433px; text-align: center; z-index: 150; display: none; background:url(../graphics/impulse__bk.png);">
    <div style="width: 433px; margin: 0 auto;">
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
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <div class="the_pic"></div>
              <form id="the_fence" action="thefence.php" method="post" name="the_fence" style="width:auto">
                <p>
                  <select name="option" size="1">
                    <option value="lotto">Lotto Ticket</option>
                    <option value="dvd">Bootleg DVD</option>
                    <option value="roids">Steroids</option>
                    <option value="coke" selected="selected">Blue Magic</option>
                  </select>
                  <label> <br />
                    <br />
                    Quantity
                    <input name="quantity" type="text" id="quantity" size="14" maxlength="7" />
                    Your Offer $ </label>
                  <label>
                    <input name="d_offer" type="text" id="dealer_offer" size="12" />
                  </label>
                  .00 </p>
                <p>
                  <label> Enter Your Dealer:
                    <input type="text" name="dealer_name" id="dealer_name" />
                  </label>
                  <label>
                    <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                    <input type="submit" name="Submit" id="post_offer" value="Submit" />
                  </label>
                </p>
              </form>
              <div id="dealer_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background:url(../graphics/impulse__bk.png)"></div>
              <div id="not" style="display:none;"></div></td>
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
	style="position: absolute; top: 334px; left: 253px; width: 213px; text-align: center; z-index: 150; display: none; background-color:#FFF;">
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
                <label> Enter Your NEW crew name:
                  <input type="text" name="crew_name" id="crew_name" />
                </label>
                <label>
                  <input type="submit" name="Submit" id="post_name" value="Submit" />
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                </label>
              </form>
              <div id="register_btm"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"></div></td>
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
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <div class="the_pic"></div>
              <div id="csfloor"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)">
                <form id="casino_sold" action="franchise.php" method="post" name="casino_sold">
                  <input type="hidden" id="userid" name="customer" value="$user"/>
                  <input type="hidden" id="casinoid" name="franchise" value="casino"/>
                  <input type="image" src="../file/pic/fbimages/buy_button.png" name="buynow">
                </form>
                <div id="o_p2" style="display:none;"></div>
              </div></td>
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
	style="position: absolute; top: 125px; left: 253px; width: 323px; text-align: center; z-index: 150; display: none; background:url(../graphics/impulse__bk.png);">
    <div style="width: 323px; margin: 0 auto;">
      <center>
        <table cellspacing="0" cellpadding="0">
          <tr class="app_border">
            <td class="app_border_top_left"></td>
            <td class="app_border_top"></td>
            <td class="app_border_top_right"></td>
          </tr>
          <tr>
            <td class="app_border_left"></td>
            <td><div class="the_pic"></div>
              <form id="gamble" action="gamble.php" method="post" name="gamble" style="width:213px; padding-bottom:15px; margin-left:auto; margin-right:auto;">
                <label>
                <b>Enter Your Wager:</b>
                <p> $
                  <input type="text" name="mybet" id="mybet" />
                  </label>
                  <label>
                    <input type="submit" name="submit" id="submit" value="Submit" />
                    <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                  </label>
              </form>
              <div id="bet_btm"
			style="text-align: center; padding-bottom: 10px; display: none; background:url(../graphics/impulse__bk.png); width:323px;"></div></td>
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
  <!--club_buy-->
  <div id="club_buy"
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
            <td><div id="clbuy_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <div class="the_pic"></div>
              <div id="clfloor"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)">
                <form id="club_sold" action="franchise.php" method="post" name="club_sold">
                  <input type="hidden" id="userid" name="customer" value="$user"/>
                  <input type="hidden" id="clubid" name="franchise" value="club"/>
                  <input type="image" src="../file/pic/fbimages/buy_button.png" name="buynow">
                </form>
                <div id="o_p3" style="display:none;"></div>
              </div></td>
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
  <!--market_overlay-->
  <div id="the_market"
	style="position: absolute; top: 105px; left: 253px; width: 360px; text-align: center; z-index: 200; display: none; background:url(../graphics/news__bk.png);">
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
            <td><div id="market_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px;"><span><img src="../graphics/hookup_butt.png"/></span><span id="market_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
              <div id="tradingpost"
			style="overflow:auto; text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/news__bk.png);"></div></td>
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
  <!--snitch box-->
  <div id="snitching"
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
            <td><div id="snitch_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background-color:#000; padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <div class="the_pic"></div>
              <div id="snitch_btm"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png);">
                <form id="snitched" action="precint.php" method="post" name="snitched">
                  <label> Enter the Crook's Name:
                    <input type="text" name="crook_name" id="crook_name" />
                  </label>
                  <label>
                    <input type="submit" name="Submit" id="post_name" value="Submit" />
                    <input type="submit" name="Submit" id="post_name" value="No, Thanks" />
                    <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                  </label>
                </form>
              </div>
              <div id="o_p22" style="display:none"></div></td>
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
  <!--courts box-->
  <div id="federal"
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
            <td><div id="federal_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background-color: #333; padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <div class="the_pic"></div>
              <div id="federal_btm"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png);">
                <div id="suspect_crew"></div>
                <div id="id_bonus"></div>
                <form id="feds" action="feds.php" method="post" name="feds">
                  <label> Enter Your Suspect's Name:
                    <input type="text" name="crook_name" id="crook_name" />
                  </label>
                  <label>
                    <input type="submit" name="Submit" id="post_name" value="Submit" />
                    <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                  </label>
                </form>
              </div>
              <div id="o_p24" style="display:none"></div></td>
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
  <!--csi NY box-->
  <div id="judges"
	style="position: absolute; top: 125px; left: 253px; width: 320px; text-align: center; z-index: 150; display: none; background:url(../graphics/impulse__bk.png);">
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
            <td><div id="bench" style="padding:5px;"><span id="patrols_left"></span><span id="judges_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background-color: #333; padding-left: 100px; padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
              <div id="suspect_img"></div>
              <div id="judges_btm"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png);">
                <div id="id_bonus"></div>
                <form id="municipal" action="municipal.php" method="post" name="municipal">
                  <label> Enter Your Suspect's Name:
                    <input type="text" name="crook_name" id="crook_name" />
                  </label>
                  <label>
                    <input type="submit" name="Submit" id="post_name" value="Submit" />
                    <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                  </label>
                </form>
              </div>
              <div id="o_p26" style="display:none"></div></td>
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
  <!--stop cop mission -->
  <div id="stopin"
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
            <td><div id="si_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
              <div class="the_pic"></div>
              <div id="si_btm"
			style="text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png)"><span id="continue"><img src="../file/pic/fbimages/continue.png" width="107" height="26" /></span><span id="haltall"><img src="../file/pic/fbimages/stopi.png" width="107" height="26" /></span></div></td>
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
  <!--hot_pursuit_overlay-->
  <div id="the_chase"
	style="position: absolute; top: 105px; left: 253px; width: 360px; text-align: center; z-index: 200; display: none; background:url(../graphics/news__bk.png);">
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
            <td><div id="chase_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px;"><span><img src="../file/pic/fbimages/apb_butt.png"/></span><span id="chase_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
              <div id="apb_report"
			style="overflow:auto; text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/news__bk.png);"></div></td>
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
  <!--Business Control Overlay-->
  <div id="the_business"
	style="position: absolute; top: 105px; left: 153px; width: 460px; text-align: center; z-index: 200; display: none; background-color:#333;">
    <div style="width: 460px; margin: 0 auto;">
      <center>
        <table cellspacing="0" cellpadding="0">
          <tr class="app_border">
            <td class="app_border_top_left"></td>
            <td class="app_border_top"></td>
            <td class="app_border_top_right"></td>
          </tr>
          <tr>
            <td class="app_border_left"></td>
            <td><div id="biz_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px;"><span><img src="../graphics/invest_title.png"/></span><span id="biz_control_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
              <table>
                <tr>
                  <td style="padding-right:59px; padding-left:6px;">Business</td>
                  <td style="padding-right:40px">Value</td>
                  <td style="padding-right:10px">Door Fee</td>
                  <td><div id='hoioi' style="color:#FFF;"></div></td>
                </tr>
              </table>
              <div id="biz_hud"
			style="height: 150px; overflow:auto; text-align: center; padding-bottom: 5px; display: none; background:url(../graphics/news__bk.png);"></div>
              <table>
                <tr>
                  <td style="padding-right:59px; padding-left:6px;">Stocks</td>
                  <td style="padding-right:40px">Value</td>
                  <td style="padding-right:10px">Quantity</td>
                  <td><div id='hoioi' style="color:#FFF;"></div></td>
                  <td><div id='hoioi2' style="color:#FFF;"></div></td>
                </tr>
              </table>
              <div id="huh_hud"
			style=" height: 150px; overflow:auto; text-align: center; padding-bottom: 5px; background:url(../graphics/news__bk.png);"></div></td>
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
  <!--payment_overlay-->
  <div id="paypal_box"
	style="position: absolute; top: 105px; left: 253px; width: 260px; text-align: center; z-index: 200; display: none; background-color:#FFF;">
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
          <td><span id="paypal_exit" style="padding-left:190px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span>
        </div>
        
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="width:260px;" target="_blank">
          <input type="hidden" name="cmd" value="_xclick">
          <input type="hidden" name="business" value="8G8ND6UVAUDHY">
          <input type="hidden" name="lc" value="US">
          <input type="hidden" name="item_name" value="Buy More Rewards Points">
          <input type="hidden" name="item_number" value="<?php echo $user; ?>">
          <input type="hidden" name="button_subtype" value="services">
          <input type="hidden" name="no_note" value="1">
          <input type="hidden" name="no_shipping" value="1">
          <input type="hidden" name="rm" value="1">
          <input type="hidden" name="return" value="../test">
          <input type="hidden" name="cancel_return" value="../test/">
          <input type="hidden" name="currency_code" value="USD">
          <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
          <table>
            <tr>
              <td><input type="hidden" name="on0" value="Rewards Points">
                Rewards Points</td>
            </tr>
            <tr>
              <td><select name="os0">
                  <option value="3 Rewards  Points">3 Rewards  Points $0.99</option>
                  <option value="8 Rewards  Points">8 Rewards  Points $1.99</option>
                  <option value="21 Rewards  Points">21 Rewards  Points $5.00</option>
                  <option value="42 Rewards  Points">42 Rewards  Points $10.00</option>
                  <option value="85 Rewards  Points">85 Rewards  Points $20.00</option>
                  <option value="170 Rewards  Points">170 Rewards  Points $40.00</option>
                  <option value="215 Rewards  Points">215 Rewards  Points $50.00</option>
                  <option value="440 Rewards  Points">440 Rewards  Points $100.00</option>
                  <option value="700 Rewards  Points">700 Rewards  Points $150.00</option>
                </select></td>
            </tr>
          </table>
          <input type="hidden" name="currency_code" value="USD">
          <input type="hidden" name="option_select0" value="3 Rewards  Points">
          <input type="hidden" name="option_amount0" value="0.99">
          <input type="hidden" name="option_select1" value="8 Rewards  Points">
          <input type="hidden" name="option_amount1" value="1.99">
          <input type="hidden" name="option_select2" value="21 Rewards  Points">
          <input type="hidden" name="option_amount2" value="5.00">
          <input type="hidden" name="option_select3" value="42 Rewards  Points">
          <input type="hidden" name="option_amount3" value="10.00">
          <input type="hidden" name="option_select4" value="85 Rewards  Points">
          <input type="hidden" name="option_amount4" value="20.00">
          <input type="hidden" name="option_select5" value="170 Rewards  Points">
          <input type="hidden" name="option_amount5" value="40.00">
          <input type="hidden" name="option_select6" value="215 Rewards  Points">
          <input type="hidden" name="option_amount6" value="50.00">
          <input type="hidden" name="option_select7" value="440 Rewards  Points">
          <input type="hidden" name="option_amount7" value="100.00">
          <input type="hidden" name="option_select8" value="700 Rewards  Points">
          <input type="hidden" name="option_amount8" value="150.00">
          <input type="hidden" name="option_index" value="0">
          <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
          <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
        <div id="paypal_btm"
			style="overflow:auto; text-align: center; padding-bottom: 5px; display: none;"></div>
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
<!-- Email Overlay-->
<div id="email_set"
	style="position: absolute; top: 125px; left: 253px; width: 323px; text-align: center; z-index: 150; display: none; background:url(../graphics/impulse__bk.png);">
  <div style="width: 323px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><img src="../graphics/email_opt.png" width="323" height="217" />
            <form id="email_u" action="emailer.php" method="post" name="email_u" style="width:213px; padding-bottom:15px; margin-left:auto; margin-right:auto;">
              <label>
              <b>Enter Your Email:</b>
              <p>
                <input type="text" name="myemail" id="myemail" />
                </label>
                <label>
                  <input type="submit" name="submit" id="submit" value="Submit" />
                  <input type="submit" name="Submit" id="post_name" value="No, Thanks" />
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                </label>
            </form>
            <div id="email_btm"
			style="text-align: center; padding-bottom: 10px; display: none; background:url(../graphics/impulse__bk.png); width:323px;"><span id="emailhide" style="display:none;"></span></div></td>
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
<!--livestream_overlay-->
<div id="live_stream"
	style="position: absolute; top: 70px; left: 203px; width: 360px; text-align: center; z-index: 200; display: none; background:url(../graphics/news__bk.png);">
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
          <td><div id="stream_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px; background-color: #184781"><span id="stream_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
            <iframe src="http://www.facebook.com/plugins/livefeed.php?app_id=314391455964&amp;width=400&amp;height=400&amp;xid" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:400px; height:400px;" allowTransparency="true"></iframe></td>
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
<!--agent_arcade_overlay-->
<div id="agent_arcade"
	style="position: absolute; top: 170px; left: 203px; width: 323px; text-align: center; z-index: 200; display: none;">
  <div style="width: 323px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="agent_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px; background-color: #000"><span id="agent_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
            <div id="agent_words"></div>
            <div id="app_response" style="display:none"></div>
            <div id="agency_app" style="background-color:#000">
              <form id="theagent" action="agent.php" method="post" name="theagent" style="width:213px; padding-bottom:15px; margin-left:auto; margin-right:auto;">
                <label>
                  <input type="image" name="accept" src="../graphics/accept.png" width="55" height="22">
                  <input type="image" name="fight" src="../graphics/decline.png" width="55" height="22">
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                </label>
              </form>
            </div></td>
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
<!--agent_contact_overlay-->
<div id="agent_contact"
	style="position: absolute; top: 170px; left: 203px; width: 323px; text-align: center; z-index: 200; display: none;">
  <div style="width: 323px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="contact_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px; background-color: #000"><span id="contact_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
            <div id="contact_words"></div>
            <div id="contact_response" style="display:none"></div>
            <div id="contact_app" style="background-color:#000">
              <form id="thecontact" action="agentcontact.php" method="post" name="thecontact" style="width:213px; padding-bottom:15px; margin-left:auto; margin-right:auto;">
                <label>
                  <input type="image" name="accept" src="../graphics/continue.png" width="55" height="22">
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                </label>
              </form>
            </div></td>
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
<!-- Feds offer-->
<div id="fed_arcade"
	style="position: absolute; top: 100px; left: 203px; width: 323px; text-align: center; z-index: 200; display: none;">
  <div style="width: 323px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="feds_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px; background-color: #000"><span id="federal_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
            <div id="carlos_words"></div>
            <div id="carlos_response" style="display:none"></div>
            <div id="federal_app" style="background-color:#000">
              <form id="thefeds" action="signup.php" method="post" name="thefeds" style="width:213px; padding-bottom:15px; margin-left:auto; margin-right:auto;">
                <label>
                  <input type="image" name="yes" src="../graphics/accept.png" width="55" height="22">
                  <input type="image" name="no" src="../graphics/decline.png" width="55" height="22">
                  <input type="hidden" id="govt" name="faction" value="good"/>
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                </label>
              </form>
            </div></td>
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
<!--attack_patrons_overlay-->
<div id="the_patrons"
	style="position: absolute; top: 105px; left: 253px; width: 360px; text-align: center; z-index: 90; display: none; background-color:#FFF;">
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
          <td><div id="patrons_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px;"><span><img src="../file/pic/fbimages/guests_butt.png"/></span><span id="patrons_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
            <div id="traffic_report"
			style="height:200px; overflow:auto; text-align: center; padding-bottom: 5px; display: none; background-color:#FFF;"></div></td>
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
<!--taxi_cab_overlay-->
<div id="tour"
	style="position: absolute; top: 105px; left: 253px; width: 360px; text-align: center; z-index: 200; display: none; background-color:#FFF;">
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
          <td><div id="tour_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px;"><span><img src="../graphics/taxi_title.png"/></span><span id="tour_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
            <div id="cabbie" align="right">
              <div id="taxi_midtown"><b>Mid-Town</b></div>
              <div id="taxi_uptown"><b>Up-Town</b></div>
              <div id="taxi_eastend"><b>East End</b></div>
              <div id="taxi_downtown"><b>DownTown</b></div>
              <div id="taxi_shipyard"><b>ShipYard</b></div>
              <div id="taxi_trainyard"><b>Subway</b></div>
            </div></td>
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
<!--tutorial_overlay-->
<div id="lisa"
	style="position: absolute; top: 170px; left: 203px; width: 323px; text-align: center; z-index: 100; display: none;">
  <div style="width: 323px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="lisa_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px; background-color: #000"><span id="lisa_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
            <div id="lisa_words"></div>
            <div id="student_response" style="display:none"></div>
            <div id="tutorial_app" style="background-color:#000">
              <form id="thetut" action="tutor_lisa.php" method="post" name="thetut" style="width:213px; padding-bottom:15px; margin-left:auto; margin-right:auto;">
                <label>
                  <input type="image" name="accept" src="../graphics/continue.png" width="55" height="22">
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                </label>
              </form>
            </div></td>
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
<!-- GTA -->
<div id="egg"
	style="position: absolute; top: 170px; left: 203px; width: 323px; text-align: center; z-index: 100; display: none;">
  <div style="width: 323px; margin: 0 auto; background-color: #333">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="egg_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px; background-color: #333"><span id="egg_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
            <div id="egg_words"></div>
            <div id="egg_response" style="display:none"></div>
            <div id="egg_app" style="background-color:#000">
              <form id="theegg" action="easter.php" method="post" name="theegg" style="width:213px; padding-bottom:15px; margin-left:auto; margin-right:auto;">
                <label>
                  <input type="image" name="accept" src="../graphics/accept.png" width="55" height="22">
                  <input type="image" name="stop" src="../graphics/decline.png" width="55" height="22">
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                </label>
              </form>
            </div>
            <div id="egg_app2" style="background-color:#000">
              <form id="theegg2" action="easter.php" method="post" name="theegg" style="width:213px; padding-bottom:15px; margin-left:auto; margin-right:auto;">
                <label>
                  <input type="text" name="mybribe" id="mybribe" />
                  <input type="image" name="stop" src="../graphics/decline.png" width="55" height="22">
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                  <input type="hidden" id="bribery" name="bribery" value="33"/>
                </label>
              </form>
            </div>
            <div id="brag" align="center"><img src="../graphics/bragger.png" /></div></td>
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
<!--Pay_pal_Market_overlay-->
<div id="bm_paypal"
	style="position: absolute; top: 425px; left: 153px; width: 433px; text-align: center; z-index: 150; display: none; background:url(../graphics/impulse__bk.png);">
  <div style="width: 433px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="bm_pp_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <div class="the_pic"></div>
            <div id="sunm" style="display:none;"></div>
            <form id="thepp_fence" action="store_clerk.php" method="post" name="thepp_fence" style="width:auto">
              <p>
                <select name="option" size="1">
                  <option value="car" selected="selected">Borrow Mom's Car | 25 Reward Points</option>
                  <option value="tank">Tank | 105 Reward Points</option>
                  <option value="cycle">Motorcycle | 120 Reward Points</option>
                  <option value="yacht">Yacht | 230 Reward Points</option>
                  <option value="gun">Gatling Gun | 40 Reward Points</option>
                  <option value="shot">Adrenaline Shot | 35 Reward Points</option>
                </select>
                <label>
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                  <input type="submit" name="Submit" id="post_offer" value="Submit" />
                </label>
              </p>
            </form>
            <div id="pp_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background:url(../graphics/impulse__bk.png)"></div>
            <div id="not" style="display:none;"></div></td>
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
<!--Car offer overlay-->
<div id="car_paypal"
	style="position: absolute; top: 125px; left: 153px; width: 433px; text-align: center; z-index: 190; display: none; background:url(../graphics/impulse__bk.png);">
  <div style="width: 433px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="car_pp_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <div class="the_pic"></div>
            <div id="sunm2" style="display:none;"></div>
            <form id="thepp_fence2" action="store_clerk.php" method="post" name="thepp_fence2" style="width:auto">
              <p>
                <select name="option" size="1">
                  <option value="car" selected="selected">Borrow Mom's Car | 25 Reward Points</option>
                </select>
                <label>
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                  <input type="submit" name="Submit" id="post_offer" value="Submit" />
                </label>
              </p>
            </form>
            <div id="car_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background:url(../graphics/impulse__bk.png)"></div>
            <div id="not" style="display:none;"></div></td>
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
<!--Bribery offer overlay-->
<div id="bribeme"
	style="position: absolute; top: 125px; left: 153px; width: 433px; text-align: center; z-index: 190; display: none; background:url(../graphics/impulse__bk.png);">
  <div style="width: 433px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="bribe_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <div class="the_pic"></div>
            <div id="bamount" style="background:url(../graphics/impulse__bk.png);"></div>
            <div id="sunm3" style="display:none;"></div>
            <form id="bribes" action="birdy.php" method="post" name="bribes" style="width:auto">
              <label>
                <input type="image" name="accept" src="../graphics/accept.png" width="55" height="22">
                <input type="image" name="stop" src="../graphics/decline.png" width="55" height="22">
                <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
              </label>
            </form>
            <div id="bribe_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background:url(../graphics/impulse__bk.png)"></div>
            <div id="not" style="display:none;"></div></td>
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
<!--Clinical overlay-->
<div id="nurse"
	style="position: absolute; top: 125px; left: 153px; width: 303px; text-align: center; z-index: 190; display: none; background:url(../graphics/impulse__bk.png);">
  <div style="width: 303px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="nurse_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <img src="../graphics/bliss_general.png" />
            <div id="wards" style="background:url(../graphics/impulse__bk.png);"><img src="../graphics/coma_ward.png" /></div>
            <div id="sunm9" style="display:none;"></div>
            <form id="thenurse" action="er.php" method="post" name="thenurse" style="width:auto">
              <p>
                <select name="option" size="1">
                  <option value="me" selected="selected">Heal Me</option>
                  <option value="them" selected="selected">Heal my team</option>
                </select>
                <label>
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                  <input type="submit" name="Submit" id="post_offer" value="Submit" />
                </label>
              </p>
            </form>
            <div id="nurse_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background:url(../graphics/impulse__bk.png)"></div>
            <div id="not" style="display:none;"></div></td>
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
<!--Coma Wards overlay-->
<div id="theward"
	style="position: absolute; top: 125px; left: 153px; width: 303px; text-align: center; z-index: 190; display: none; background:url(../graphics/impulse__bk.png);">
  <div style="width: 303px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="ward_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <img src="../graphics/patient_list.png"/>
            <div id="bed_report" style="background:url(../graphics/impulse__bk.png); overflow:auto; height:150px; width: 250px; padding-top:5px;"></div>
            <div id="kill_results" style="display:none;"></div>
            <div id="ward_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background:url(../graphics/impulse__bk.png)"></div>
            <div id="not" style="display:none;"></div></td>
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
<!--Diner overlay-->
<div id="joes"
	style="position: absolute; top: 125px; left: 153px; width: 423px; text-align: center; z-index: 99; display: none; background-color:#000;">
  <div style="width: 423px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="joes_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background-color:#000; padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <div class="the_pic"></div>
            <div id="sunm12" style="display:none;"></div>
            <form id="eatup" action="stomach.php" method="post" name="eatup" style="width:auto">
              <p>
                <select name="option" size="1">
                  <option value="dog">Hot Dog</option>
                  <option value="salad">Salad</option>
                  <option value="penne">Penne Surprise</option>
                  <option value="meal" selected="selected">Imported Meal</option>
                </select>
                <label>
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                  <input type="submit" name="Submit" id="post_offer" value="Submit" />
                </label>
              </p>
            </form>
            <div id="joes_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background-color:#000"></div>
            <div id="not" style="display:none;"></div></td>
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
<!--Magic Feen overlay-->
<div id="junkie_option"
	style="position: absolute; top: 125px; left: 153px; width: 423px; text-align: center; z-index: 99; display: none; background-color:#000;">
  <div style="width: 423px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="high12"
			style="text-align: right; padding-bottom: 5px; display: none; background-color:#000; padding-right: 5px; padding-top: 5px;"></div>
            <div class="the_pic"></div>
            <form id="toohigh" action="needles.php" method="post" name="toohigh">
              <label>
                <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                <input type="image" name="turkey" src="../graphics/turkey.png" width="55" height="26">
                <input type="image" name="rehab" src="../graphics/rehab_button.png" width="55" height="26">
              </label>
            </form>
            <div id="junkie_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background-color:#000"></div>
            <div id="not" style="display:none;"></div></td>
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
<!--Bank Heist overlay-->
<div id="bank_heist"
	style="position: absolute; top: 125px; left: 153px; width: 423px; text-align: center; z-index: 99; display: none; background-color:#000;">
  <div style="width: 423px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="heist_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background-color:#000; padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <div class="the_pic"></div>
            <div id="heist_brains"><img src="../graphics/bankjob_brains.png" /></div>
            <div id="heist_men"><img src="../graphics/bankjob_men.png" /></div>
            <div id="heist_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background-color:#000"></div>
            <div id="not" style="display:none;"></div></td>
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
<!--Bank Heist Info overlay-->
<div id="heist_info"
	style="position: absolute; top: 125px; left: 153px; width: 423px; text-align: center; z-index: 99; display: none; background-color:#000;">
  <div style="width: 423px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="heist_info_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background-color:#000; padding-right: 5px; padding-top: 5px;">
              <div class="the_pic"></div>
            </div>
            <div id="heist_info_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background-color:#000"><img id="heist_call" src="../graphics/bankjob_helpme.png" /></div></td>
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
<!--Bank Heist Cancel overlay-->
<div id="heist_cancel"
	style="position: absolute; top: 125px; left: 153px; width: 423px; text-align: center; z-index: 99; display: none; background-color:#000;">
  <div style="width: 423px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="heist_cancel_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background-color:#000; padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <img src="../graphics/bankjob_quit.png" />
            <div id="heist_cancel_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background-color:#000"><img id="heist_call_cancel" src="../graphics/quit.png" /></div></td>
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
<!--Bank Job Checkin-->
<div id="bank_checkin"
	style="position: absolute; top: 125px; left: 153px; width: 423px; text-align: center; z-index: 99; display: none; background-color:#000;">
  <div style="width: 423px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="bank_checkin_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background-color:#000; padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <div class="the_pic"></div>
            <form id="signmeup" action="thebankjob.php" method="post" name="signmeup">
              <label>
                <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                </p>
                <input name="brains" type="text" />
                <input type="submit" name="submit" value="Enter">
              </label>
            </form>
            <div id="bank_checkin_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background-color:#000"></div>
            <div id="not" style="display:none;"></div></td>
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
<!--Initial Customization Overlay-->
<div id="custom_me"
	style="position: absolute; top: 125px; left: 253px; width: 323px; text-align: center; z-index: 150; display: none; background-color:#000;">
  <div style="width: 323px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><p style="color:#FFF; background-color:#000; padding-right: 5px; padding-left: 5px;">
            <div id="imin" style="display:none"></div>
            <div align="center" style="color:#FFF">
              <form id="character" action="customme.php" method="post" name="character">
                <p>
                  <label> What's your crew gonna be called?
                    <input type="text" name="crew_name" id="crew_name" />
                  </label>
                  <label>
                    <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                  </label>
                </p>
                <table>
                  <tr>
                    <td><span align="center" style=" font-size:16px; padding-bottom:8px; color:#FFF">Chose your crew's colors</span></td>
                    <td><div align="center" id="flaglist" style="overflow:auto; height:38px; padding-bottom:5px; padding-top:5px; width:120px; margin-left:auto; margin-right:auto"></div>
                      <div style="height:19px;"></div></td>
                  </tr>
                </table>
                <p>
                  <label> What name will you go by?
                    <input type="text" name="my_name" id="my_name" />
                  </label>
                </p>
                <p>
                  <input type="submit" name="Submit" id="post_name" value="Submit" />
                </p>
              </form>
            </div>
            <div id="custom_me_btm"
			style="text-align: center; padding-bottom: 10px; display: none; background-color:#000; width:323px;"></div></td>
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
<!--Arcade/Hustle overlay-->
<div id="arcade_hustle"
	style="position: absolute; top: 125px; left: 153px; width: 423px; text-align: center; z-index: 99; display: none; background-color:#000;">
  <div style="width: 423px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="arcade_hustle_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background-color:#000; padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <div class="the_pic2"></div>
            <div><span id="game_area"><img src="../graphics/arcade_link.png" /></span> <span id="archustle_area"><img src="../graphics/hustle_button.png" /></span></div>
            <div id="arc_hustle_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background-color:#000"></div>
            <div id="not" style="display:none;"></div></td>
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
<!-- Terms Overlay-->
<div id="terms_set"
	style="position: absolute; top: 125px; left: 253px; width: 323px; text-align: center; z-index: 150; display: none; background-color:#000;">
  <div style="width: 323px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="terms_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background-color:#000; padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <p style="color:#FFF; background-color:#000; padding-right: 5px; padding-left: 5px;"> Thanks for coming back to play The HUSTLE. We want to remind you of the game's Terms of Service<a href="../terms.html" target="_blank">("Terms")</a>. These terms govern your use of the game. I understand that the continued use of the game shall constitute acceptance of these Terms.</p>
            <p id="acceptance"style="display:none"></p>
            <form id="terms_u" action="accept_terms.php" method="post" name="terms_u" style="width:213px; padding-bottom:15px; margin-left:auto; margin-right:auto;">
              <label>
                <input type="submit" name="submit" id="submit" value="Ok" />
                <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
              </label>
            </form>
            <div id="terms_btm"
			style="text-align: center; padding-bottom: 10px; display: none; background-color:#000; width:323px;"></div></td>
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
<!--Car_Market_overlay-->
<div id="car_lot"
	style="position: absolute; top: 125px; left: 153px; width: 433px; text-align: center; z-index: 150; display: none; background:url(../graphics/impulse__bk.png);">
  <div style="width: 433px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="car_lot_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background:url(../graphics/impulse__bk.png); padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <div class="the_pic"></div>
            <div id="nosale" style="display:none;"></div>
            <form id="dealership" action="usedcars.php" method="post" style="width:auto">
              <p>
                <select name="option" size="1">
                  <option value="1" selected="selected">Borrow Mom's Car</option>
                  <option value="2">Custom Sports Car</option>
                  <option value="3">Premium Car </option>
                  <option value="4">Luxury Sports Car</option>
                  <option value="5">Motorcycle</option>
                </select>
                <label>
                  <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                  <input type="submit" name="Submit" value="Submit" />
                </label>
              </p>
            </form>
            <div id="carlot_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background:url(../graphics/impulse__bk.png)"></div>
            <div id="not" style="display:none;"></div></td>
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
<!--ChopShop/Hustle overlay-->
<div id="race_hustle"
	style="position: absolute; top: 125px; left: 153px; width: 423px; text-align: center; z-index: 99; display: none; background-color:#000;">
  <div style="width: 423px; margin: 0 auto;">
    <center>
      <table cellspacing="0" cellpadding="0">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="race_hustle_exit"
			style="text-align: right; padding-bottom: 5px; display: none; background-color:#000; padding-right: 5px; padding-top: 5px;"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></div>
            <div class="the_pic2"></div>
            <div><span id="track_area"><img src="../graphics/arcade_link.png" /></span> <span id="racehustle_area"><img src="../graphics/hustle_button.png" /></span></div>
            <div id="race_hustle_btm"
			style="text-align: center; padding-bottom: 15px; display: none; background-color:#000"></div>
            <div id="not" style="display:none;"></div></td>
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
<!--deed_overlay-->
<div id="deed_bank"
	style="position: absolute; top: 50px; left: 203px; width: 323px; text-align: center; z-index: 100; display: none;">
  <div style="width: 323px; margin: 0 auto;">
    <center>
      <table width="316" cellpadding="0" cellspacing="0" bgcolor="#000000">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="deed_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px; background-color: #000"><span id="deed_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>
            <div id="deed_response" style="display:none"></div>
            <div><img src="../graphics/deed_buy.jpg" width="292" height="160" /></div>
            <table width="292" style="color:#FFF">
              <tr>
                <td width="135" id="deed_title" align="center"></td>
              </tr>
              <tr>
                <td>PRICE</td>
                <td width="145" id="deed_price" align="center"></td>
              </tr>
              <tr>
                <td>Travel Fee<img src="../../clique/graphics/icon_help_16x16_01.gif" id="deedtip" title="This is how much you earn per time a player comes through your area" /></td>
                <td id="deed_fee" align="center"></td>
              </tr>
              <tr>
                <td>Your Hourly Fee</td>
                <td id="deed_maint" align="center"></td>
              </tr>
            </table>
            <div id="deed_app" style="background-color:#000" align="center">
              <form id="deedsale" action="deedsale.php" method="post" name="deedsale" style="width:213px; padding-bottom:15px; margin-left:auto; margin-right:auto;">
                <table>
                  <tr>
                    <td><input type="image" name="accept" src="../graphics/buy_land.jpg"></td>
                  </tr>
                </table>
                <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                <input type="hidden" id="deed_id" name="deed_id" value=""/>
                </label>
              </form>
            </div></td>
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
<!--Deed Fight Overlay-->
<div id="deed_contest"
	style="position: absolute; top: 10px; left: 203px; width: 358px; text-align: center; z-index: 100; display: none;">
  <div style="width: 323px; margin: 0 auto;">
    <center>
      <table width="332" cellpadding="0" cellspacing="0" bgcolor="#000000">
        <tr class="app_border">
          <td class="app_border_top_left"></td>
          <td class="app_border_top"></td>
          <td class="app_border_top_right"></td>
        </tr>
        <tr>
          <td class="app_border_left"></td>
          <td><div id="deed_attack_header" style="text-align: right; padding-bottom: 5px; display: block; padding-right: 5px; padding-top: 5px; background-color: #000"><img src="../graphics/controlled_land.jpg" width="292" height="28" /></div>
            <div id="deed_attack_response" style="display:none"></div>
            <div>
              <table width="310">
                <tr>
                  <td><table style="color:#FFF">
                      <tr>
                        <td id="deed_crew_name"></td>
                      </tr>
                      <tr>
                        <td id="deed_avatar">&nbsp;</td>
                      </tr>
                    </table></td>
                  <td><table style="color:#FFF">
                      <tr>
                        <td>Crew Size</td>
                      </tr>
                      <tr>
                        <td id="deed_crew_size" align="center">&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </div>
            <table width="310" style="color:#FFF">
              <tr>
                <td width="160" id="deed_title2"></td>
              </tr>
              <tr>
                <td style="font-size:15px">Pay My Fee to Pass<img src="../../clique/graphics/icon_help_16x16_01.gif" id="deedtip" title="This is how much you earn per time a player comes through your area" /></td>
                <td width="138" align="center" id="a_deed_fee">&nbsp;</td>
              </tr>
            </table>
            <div id="deed_app" style="background-color:#000" align="center">
              <form id="deedatt" action="deedattack.php" method="post" name="deedatt" style="width:213px; padding-bottom:15px; margin-left:auto; margin-right:auto;">
                <table>
                  <tr>
                    <td><input type="image" name="accept" src="../graphics/pay_fee.jpg"></td>
                    <td><input type="image" name="attack" src="../graphics/attack_land.jpg"></td>
                  </tr>
                </table>
                <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                <input type="hidden" id="deed_id2" name="deed_id" value=""/>
                </label>
              </form>
            </div></td>
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
    <div id="content"></div>
  </div>
</div>
</div>
</div>
</div>
<div id="music" style="display:none"></div>
<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" mce_src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"> </script>
<script type="text/javascript">

FB_RequireFeatures(["CanvasUtil"], function()
    {
      //You can optionally enable extra debugging logging in Facebook JavaScript client
      //FB.FBDebug.isEnabled = true;
      //FB.FBDebug.logLevel = 4;


      FB.XdComm.Server.init("../xd_receiver.htm");
      FB.CanvasClient.startTimerToSizeToContent();
    });


	FB_RequireFeatures(["XFBML"], function(){
		FB.Facebook.init("2b154bd6f13c0d2e91ee4619514aeaf9", "../xd_receiver.htm"); 
	});
	
	window.fbAsyncInit = function() {
    FB.init({appId: '314391455964', status: true, cookie: true,
             xfbml: true});
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +
      '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
</script>
<?php } ?>
</body>
</html>