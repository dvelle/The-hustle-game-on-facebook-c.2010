<?php
include_once('connect.php');

require_once '../facebook/facebook-platform/php/facebook.php';
require_once '../facebook/facebook-platform/php/facebookapi_php5_restlib.php';

$facebook=new Facebook($api_key, $secret);
//$facebook->require_frame();
//$fb_user = $facebook->require_login(photo_upload, share_item, publish_stream, status_update);

if ($_GET['fb_sig_user'])
    $fb_user = $_GET['fb_sig_user'];
    
else if ($_GET['fb_sig_canvas_user'])
    $fb_user = $_GET['fb_sig_canvas_user'];
    
else if ($_GET['fb_sig_page_id'])
    $fb_user = $_GET['fb_sig_page_id'];
else{
    $fb_user=$facebook->get_loggedin_user();
};

$facebook->set_user($fb_user, $_GET['fb_sig_session_key']);

$_COOKIE=array();  //Optional -- keeps stale cookies from interfering with our GET data

$key=$facebook->api_client->session_key;

$token=md5($fb_user.$secret);

if (!$fb_user) {
  $fb_user=$_REQUEST['uid'];
  if (!$fb_user) $facebook->redirect($facebook->get_login_url('http://apps.facebook.com/the_hustle', 1));
  $key=$_REQUEST['key'];
  $token=$_REQUEST['token'];
  $check=md5($fb_user.$secret);
  if ($check!=$token) { echo "Invalid Signature"; exit(); }
  $facebook->set_user($fb_user, $key);
}
$key=$facebook->api_client->session_key;
$token=md5($fb_user.$secret);
$parms="uid=$fb_user&key=$key&token=$token";  // This parameter string must be added to all links and forms urls
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Hustle</title>
<style type="text/css">
<!--
table
{
border:1px solid lightgray;
border-style:solid;
border-bottom-style:solid;
border-top-style:none;
border-left-style:none;
border-right-style:none;
}

.cnter {
    text-align: center; 
}
#sendform div table tr td div {
    font-size: larger;
}
.footerTxt {
    font-size: x-small;
    text-align: center;
}
#FB_HiddenIFrameContainer
{
}
-->
</style>
<script src="http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
</head>

<body>
<script type="text/javascript">
//<![CDATA[
  //A helper function as shorthand for document.getElementById.
  //Most likely your app already has such helper function defined and won't need
  //it here.

 function $(id)
  {
    return document.getElementById(id);
  }

    FB_RequireFeatures(["XFBML", "CanvasUtil"], function()
    {
      // app id / api key 
      FB.init("2b154bd6f13c0d2e91ee4619514aeaf9", "xd_receiver.htm", null);

      FB.XFBML.Host.autoParseDomTree = true;

      // Add XFBML elements through JavaScript codes
      //FB.XFBML.Host.addElement(new FB.XFBML.Photo($("photo1")));
      //FB.XFBML.Host.addElement(new FB.XFBML.Name($("name1")));
      //FB.XFBML.Host.addElement(new FB.XFBML.ProfilePic($("pic1")));
      FB.CanvasClient.startTimerToSizeToContent();
    });
//]]>
</body>
</html>