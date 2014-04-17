<?PHP 

// Get these from http://developers.facebook.com 
$api_key = '2b154bd6f13c0d2e91ee4619514aeaf9'; 
$secret = '7fc8a6d46f6e752178aa9c6f99d2cb3e'; 
// Names and links 
$app_name = "The Hustle"; 
$app_url = "the_hustle"; // Assumes application is at http://apps.facebook.com/app-url/ 
$invite_href = "invite.php"; // Rename this as needed 

require_once 'facebook/facebook-platform/php/facebook.php'; 

$facebook = new Facebook($api_key, $secret); 
$facebook->require_frame(); 
$user = $facebook->require_login(); 

if(isset($_POST["ids"])) { echo "<center>Thank you for inviting ".sizeof($_POST["ids"])." of your friends on <b><a href=\"http://apps.facebook.com/".$app_url."/\">".$app_name."</a></b>.<br><br>\n"; echo "<h2><a href=\"http://apps.facebook.com/".$app_url."/\">Click here to return to ".$app_name."</a>.</h2></center>"; 
} else { 

// Retrieve array of friends who've already authorized the app. 
$fql = 'SELECT uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1='.$user.') AND is_app_user = 1'; 
$_friends = $facebook->api_client->fql_query($fql); 

// Extract the user ID's returned in the FQL request into a new array. 

$friends = array(); 
if (is_array($_friends) && count($_friends)) { 
foreach ($_friends as $friend) { 
$friends[] = $friend['uid']; 
} 
} 
// Convert the array of friends into a comma-delimeted string. 
$friends = implode(',', $friends); 
// Prepare the invitation text that all invited users will receive. 
$content = 
"<fb:name uid=\"".$user."\" firstnameonly=\"true\" shownetwork=\"false\"/> has started playing <a href=\"http://apps.facebook.com/".$app_url."/\">".$app_name."</a> and wants to invite you to Hustle up some cash with them!\n". 
"<fb:req-choice url=\"".$facebook->get_add_url()."\" label=\"Put ".$app_name." on your profile\"/>"; 
?> 
<fb:request-form 
action="<? echo $invite_href; ?>" 
method="post" 
type="<? echo $app_name; ?>" 
content="<? echo htmlentities($content,ENT_COMPAT,'UTF-8'); ?>">  

<fb:multi-friend-selector 
actiontext="Here are your friends who don't have <? echo $app_name; ?> yet. Invite whoever you want -it's free!" 
exclude_ids="<? echo $friends; ?>" /> 
</fb:request-form> 
<?PHP 

} 

?> 