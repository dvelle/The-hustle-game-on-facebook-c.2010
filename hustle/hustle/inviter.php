<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head></head>
	 
<body>
 
 <script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/en_US" type="text/javascript"></script><script type="text/javascript">FB.init("2b154bd6f13c0d2e91ee4619514aeaf9");</script>
	 
    <fb:profile-pic uid="loggedinuser" size="square" facebook-logo="true"></fb:profile-pic>
    <fb:name uid="loggedinuser" useyou="false" linked="true"></fb:name>
    
    <div id="profile_pics"></div>
<script type="text/javascript">
var widget_div = document.getElementById("profile_pics");
FB.ensureInit(function () {
  FB.Facebook.get_sessionState().waitUntilReady(function() {
  FB.Facebook.apiClient.friends_get(null, function(result) {
    var markup = "";
    var num_friends = result ? Math.min(5, result.length) : 0;
    if (num_friends > 0) {
      for (var i=0; i<num_friends; i++) {
        markup += 
          '<fb:profile-pic size="square" uid="'+result[i]+'" facebook-logo="true"></fb:profile-pic>';
      }
    }
    widget_div.innerHTML = markup;
    FB.XFBML.Host.parseDomElement(widget_div);
  });
	</body>
</html>