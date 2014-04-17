<?php

require_once '../facebook/facebook-platform/php/facebook.php';
require_once '../facebook/facebook-platform/php/facebookapi_php5_restlib.php'; #Load the Facebook API

$appapikey = '2b154bd6f13c0d2e91ee4619514aeaf9'; 
#Your API Key
$appsecret = '7fc8a6d46f6e752178aa9c6f99d2cb3e'; 
#Your Secret
//$facebook = new Facebook($appapikey, $appsecret); 
$fb = $facebook;
$secret='zyngabegotme';

$dbhost = "btr_the_hunt.db.3640907.hostedresource.com";
$dbuser = "btr_the_hunt";
$dbpass = "Jgreen87!";
$dbname = "btr_the_hunt";

$redirect = 'http://apps.facebook.com/the_hustle/';

define('FACEBOOK_APP_ID', '314391455964');
define('FACEBOOK_SECRET', '7fc8a6d46f6e752178aa9c6f99d2cb3e');
define('FACEBOOK_KEY', '2b154bd6f13c0d2e91ee4619514aeaf9');
?>
