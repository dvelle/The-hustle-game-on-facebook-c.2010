<?php
require_once('connect.php');

$prefix = ($_REQUEST['fb_sig_user']) ? 'fb_sig' : $appapikey ;

 if( isset($_REQUEST[$prefix.'_session_key']) ){
    session_name( $_REQUEST[$prefix.'_session_key'] );
    session_start();

    $_SESSION['fb_user']        = $_REQUEST[$prefix.'_user'];
    $_SESSION['fb_session_key'] = $_REQUEST[$prefix.'_session_key'];
    $_SESSION['fb_expires']     = $_REQUEST[$prefix.'_expires'];
    $_SESSION['fb_in_canvas']   = $_REQUEST[$prefix.'_in_canvas'];
    $_SESSION['fb_time']        = $_REQUEST[$prefix.'_time'];
    $_SESSION['fb_profile_update_time'] = $_REQUEST[$prefix.'_profile_update_time'];
    $_SESSION['fb_api_key']     = $_REQUEST[$prefix.'_api_key'];
 } else {
    // Just so there *is* a session for times when there is no fb session
    session_start();
 }
 $user='loggedinuser';

?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>

<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/en_US" type="text/javascript"></script>
<script type="text/javascript">

FB.init("2b154bd6f13c0d2e91ee4619514aeaf9", "xd_receiver.htm",{"reloadIfSessionStateChanged":true});
</script>
</head>

<body>
<script type="text/javascript"> 
function update_user_box() 
{ var user_box = document.getElementById("user"); // add in some XFBML. note that we set useyou=false so it doesn't display "you" 
user_box.innerHTML = "<span>" + "<fb:profile-pic uid=loggedinuser facebook-logo=true></fb:profile-pic>" + "Welcome, <fb:name uid=loggedinuser useyou=false></fb:name>. You are signed in with your Facebook account." + "</span>"; // because this is XFBML, we need to tell Facebook to re-process the document 
} 
</script> 

<h4>The Usual Suspects</h4>
 <fb:login-button onlogin="update_user_box();"></fb:login-button> 
<p>Hi <fb:name useyou=false uid='<?php echo $user; ?>' firstnameonly=true></fb:name>, welcome to Pygoscelis P. Ellsworthy's Suspect Tracker</p>
<fb:profile-pic uid='<?php echo $user; ?>' size="square" facebook-logo="true"></fb:profile-pic>
Hello <fb:name uid='<?php echo $user; ?>' useyou='false' possessive='true'></fb:name>!
Wellcome to Yummie Tester!


<fb:serverfbml style="max-width: 750px;max-height: 500px">
    <script type="text/fbml">
        <fb:fbml>
<fb:request-form type="invite" content="Would you like to eat yummie?" action="index.php" method="POST" invite="true">
<fb:multi-friend-selector showborder="false" actiontext="Invite your friends to eat yummie" />
</fb:request-form>
</fb:fbml>
    </script>

</fb:serverfbml>

</body>
</html>