<?php
$user = $_REQUEST['name'];
$value = $_REQUEST['adjust'];
//$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$sql="SELECT * FROM `arcade_games` ORDER BY `timesplayed` DESC LIMIT 1";
		$result = mysql_query($sql);
		$result_ar = mysql_fetch_assoc($result);
		$game = $result_ar['shortname'];
?>              
<script>
var message = 'Currently the Hardest Game is: <?php echo ucwords($game); ?>';
var attachment = {
	'name': '{*actor*} needs help earning CASH!',
	'href': ' http://apps.facebook.com/the_hustle',
	'caption': '{*actor*} is struggling in the Arcade',
	'description': 'Earn cash by beating Arcade high-scores',
	'properties':'null',
	'media': [{ 'type': 'image', 'src': 'http://www.12daysoffun.com/hustle/file/fb_feed.png', 'href': 'http://apps.facebook.com/the_hustle'}]
	}; 
var action_links = [{'text':'Help {*actor*} Now', 'href':'http://apps.facebook.com/the_hustle'}];  
FB.Connect.streamPublish(message, attachment, action_links);
</script>
<div id="fb-root"></div>
<script>
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