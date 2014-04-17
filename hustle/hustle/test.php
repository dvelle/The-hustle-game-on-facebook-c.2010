<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Hustle</title> 
<style type="text/css">
<!--
img {
	border: none;
}
#header {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	height: 98px;
	background-image: url(graphics/hustle_bk.png);
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
	text-align: right;
}
#header #external #instructions {
	width: 200px;
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
#header #energy #nav_bar {
	width: 275px;
	text-align: left;
	float: right;
	padding-right: 8px;
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
#body {
	clear:both; 
	display:none;
}	
#body .body {
}		
.loading {
background: url(images/load.gif) no-repeat center center;
height:48px;
display:none;
}
</style>
<script type="text/javascript" src="http://www.12daysoffun.com/js/jquery-1.3.1.min.js"></script>

<link type="text/css" rel="stylesheet" href="http://12daysoffun.com/hustle/css/jquery/ui-lightness/jquery-ui-1.7.2.custom.css" />

  <script src="http://12daysoffun.com/hustle/js/jquery-1.3.1.min.js?checksum=3dc9f7c2642efff4482e68c9d9df874bf98f5bcb" type="text/javascript"></script>

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
</head>

<body style="margin:0;">

<a name="verytop" id="verytop"></a>

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
    <div id="cp_stat">2</div>
    <div id="cash_stat"><span id="dollar_sign">$</span><span id="dollar_val">765757876876865</span></div>
  </div>
  <div id="level">
    <div id="level_number_stat">1</div>
  </div>
  <div id="energy">  
    <div id="c_rank">1000000</div>
    <div id="level_label">Mastermind</div>    
    <div id="energy_stat">50/100</div>
    <div id="nav_bar">
      <div id="inventory_butt"><a href="#inventory" rel="ajax"><img src="graphics/inventory_button.png" width="69" height="11" alt="Inventory" /></a></div>
      <div id="store_section">
      <div id="points"><span id="reward_points">150 </span><span><img src="graphics/tokens_1.png" width="19" height="19" alt="reward points" /></span></div>
      <div id="store_butt"><a href="#store" rel="ajax"><img src="graphics/store_button.png" width="41" height="11" alt="Get a quick boost!" /></a></div>
      </div>
      <div id="invite_butt"><a href="#invite" rel="ajax"><img src="graphics/invite_button.png" width="40" height="11" alt="Invite fresh blood!" /></a></div>      
      <div id="home_butt"><a href="#home" rel="ajax"><img src="graphics/home_button.png" width="36" height="11" alt="Home" /></a></div>
    </div>
  </div>
</div>
<div class="loading"></div>
<div id="body">
		<div class="header"></div>
		<div class="body">
			<div id="content">
			<!-- Ajax Content -->
			</div>
		</div>
		<div class="footer"></div>
	</div>
</div>
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