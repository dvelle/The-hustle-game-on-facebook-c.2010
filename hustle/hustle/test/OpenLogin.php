<?
//
// this file includes FB_API_KEY and FB_SECRET constants and the ConnectDB function
// to connect to your mysql database.
require_once("connect.php");
 
$db = mysql_connect($dbhost,$dbuser,$dbpass)
		or die ('Error connecting to mysql:');
	mysql_select_db($dbname); 
//

$fbconfig['appid' ]  = FACEBOOK_APP_ID;
$fbconfig['api'   ]  = FACEBOOK_KEY;
$fbconfig['secret']  = FACEBOOK_SECRET;

// Create our Application instance.
$facebook = new Facebook(array(
  'appId'  => $fbconfig['appid'],
  'secret' => $fbconfig['secret'],
  'cookie' => true,
));

// We may or may not have this data based on a $_GET or $_COOKIE based session.
// If we get a session here, it means we found a correctly signed session using
// the Application Secret only Facebook and the Application know. We dont know
// if it is still valid until we make an API call using the session. A session
// can become invalid if it has already expired (should not be getting the
// session back in this case) or if the user logged out of Facebook.
$session = $facebook->getSession();

$fbme = null;
// Session based graph API call.
if ($session) {
  try {
	$uid = $facebook->getUser();
	$fbme = $facebook->api('/me');
  } catch (FacebookApiException $e) {
	  d($e);
  }
}

function d($d){
	echo '<pre>';
	print_r($d);
	echo '</pre>';
}

$config['baseurl']  =   "http://www.12daysoffun.com/hustle/test/start.php";

// login or logout url will be needed depending on current user state.
if ($fbme) {
  $logoutUrl = $facebook->getLogoutUrl(
	array(
		'next'      => $config['baseurl'],
	)
  );
} else {
  $loginUrl = $facebook->getLoginUrl(
	array(
		'display'   => 'popup',
		'next'      => $config['baseurl'] . '?loginsucc=1',
		'cancel_url'=> $config['baseurl'] . '?cancel=1',
		'req_perms' => 'email,user_birthday',
	)
  );
}

// if user click cancel in the popup window
if (isset($_REQUEST['cancel'])){
	echo "<script>
		window.close();
		</script>";
}

if ($fbme && isset($_REQUEST['loginsucc'])){
	//only if valid session found and loginsucc is set

	//after facebook redirects it will send a session parameter as a json value
	//now decode them, make them array and sort based on keys
	$sortArray = get_object_vars(json_decode($_GET['session']));
	ksort($sortArray);

	$strCookie  =   "";
	$flag       =   false;
	foreach($sortArray as $key=>$item){
		if ($flag) $strCookie .= '&';
		$strCookie .= $key . '=' . $item;
		$flag = true;
	}

	//now set the cookie so that next time user don't need to click login again
	setCookie('fbs_' . "{$fbconfig['appid']}", $strCookie);

	echo "<script>
		window.close();
		window.opener.location.reload();
		</script>";
}

//if user is logged in and session is valid.
if ($fbme){
	//Retriving movies those are user like using graph api
	try{
		$movies = $facebook->api('/me/movies');
	}
	catch(Exception $o){
		d($o);
	}

	//Calling users.getinfo legacy api call example
	try{
		$param  =   array(
			'method'  => 'users.getinfo',
			'uids'    => $fbme['id'],
			'fields'  => 'name,current_location,profile_url',
			'callback'=> ''
		);
		$userInfo   =   $facebook->api($param);
	}
	catch(Exception $o){
		d($o);
	}

	//fql query example using legacy method call and passing parameter
	try{
		//get user id
		$uid    = $facebook->getUser();
		//or you can use $uid = $fbme['id'];

		$fql    =   "select name, hometown_location, sex, pic_square from user where uid=" . $uid;
		$param  =   array(
			'method'    => 'fql.query',
			'query'     => $fql,
			'callback'  => ''
		);
		$fqlResult   =   $facebook->api($param);
	}
	catch(Exception $o){
		d($o);
	}
}
?>