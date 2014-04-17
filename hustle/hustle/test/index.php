<?

//$gameresults = array();
//foreach ($_POST as $key => $value){
//array_push($gameresults,$value);
//}
//$gname = $gameresults[1];
//$gscore = $gameresults[0];
//if ($gname || $_GET['do'] == "newscore" || $_GET['autocom']) { 
//	 $gscore = $_POST['thescore'];
//	 if ($_GET['do'] == newscore) {
//	  $gname=htmlspecialchars($_POST['gname'], ENT_QUOTES);
//	  $gscore = $_POST['gscore'];
//	 }
//	
//	if ($_GET['autocom']) {
//	
//	$gname=htmlspecialchars($_COOKIE['gname'], ENT_QUOTES);
//	$gscore = $_POST['gscore'];
//	}
//}
if ($gname || $_GET['do'] == "newscore" || $_GET['do'] == 'savescore' || $_GET['autocom'] == 'arcade' || $_POST['autocom'] == 'arcade'|| isset($_POST['gname']) || isset($_REQUEST['id']) || $_GET['autocom'] || $_GET['act'] || $_POST['autocom'] || $_GET['do'] || $_POST['thescore'] || $_POST['gscore'] || $_GET['scoreVar'] || isset($_POST['sessdo'])) {
	//For other games
	$gscore = $_POST['thescore'];
	if ($_GET['do'] == newscore) {
		$gname=htmlspecialchars($_POST['gname'], ENT_QUOTES);
	    $gscore = $_POST['gscore'];
	}
	if($gname==NULL) $gname= $_REQUEST['id'];
	if($gname==NULL) $gname=htmlspecialchars($_COOKIE['gname'], ENT_QUOTES);
	
	//For v32 games
	if($_GET['autocom'] == 'arcade' || $_POST['autocom'] == 'arcade' || $_GET['act'] == 'arcade' || $_POST['act'] == 'arcade'){
		if ($_GET['do'] == 'savescore' || $_GET['do'] == 'newscore') {
			$gscore = $_POST['gscore'];
			if ($gscore==NULL) $gscore= $_POST['thescore'];
			if ($gscore==NULL) $gscore= $_GET['scoreVar'];
		}
	}
	
	//For v2 games
	if ($_GET['do'] == 'savescore' || $_GET['do'] == 'newscore') {
		$gscore = $_POST['gscore'];
		if ($gscore==NULL) $gscore= $_POST['thescore'];
		if ($gscore==NULL) $gscore= $_GET['scoreVar'];
	}
}


?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>

<script type="text/javascript">
function onConnected(user_id) {
	document.write('<IMG SRC="images/loading.gif">');
	
	window.location = "http://www.12daysoffun.com/hustle/test/gamehq.php?data=" + user_id + ":<?php echo $gname ?>:<?php echo $gscore ?>";
	
	
} 
function move(user_id,gname,gscore){
}
function onNotConnected() { 
     FB.ensureInit(function() {
        FB.Connect.get_status().waitUntilReady(function(status) {
            if (status == FB.ConnectState.userNotLoggedIn )    {
                alert("User is not logged into FB");
            }
            if (status == FB.ConnectState.appNotAuthorized)    {
                alert("User is logged into FB but this app is not authorized");
            }
        });
    });
}
</script>
</head>
<body>

<div align="center">
  <p>
    <script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" mce_src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"> </script>
    
    
    <script type="text/javascript">
FB.init("2b154bd6f13c0d2e91ee4619514aeaf9", "http://www.12daysoffun.com/hustle/xd_receiver.htm",{"ifUserConnected":onConnected, "ifUserNotConnected":onNotConnected});
  </script>
    
    <img src="images/loading.gif" alt="" width="245" height="248"/></p>
  <p>
    PLEASE WAIT PROCESSING YOUR SCORE</p>
</div>
</body>
</html>