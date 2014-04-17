<?php
session_start();
//THIS FILE NAME//////////////////////////////////////////
$this_file_name = 'Untitled-8.php';
//Facebook Details///////////////////////////////////////////
include_once('connect.php');
global $facebook;
$fb_user=$facebook->get_loggedin_user();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head></head>
<body>
<table width="750" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="174"><?=$fb_user?> :uid</td>
    <td width="259">
    <?php
//CHECK FOR FORM SUBMISSION/////////////////////
if ($_POST[_test_check] == 1){
    if ($_POST[friend_selector_id]){
    $posted_id = $_POST[friend_selector_id];
    echo"something posted";
    echo("$posted_id");
    }else{
        echo"friend selector data not received";
    }
}else{
    echo"post check not received";
}
?>
</td>
    <td width="309"><?=$posted_id?></td>
  </tr>
</table>


<table width="750" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="186">&nbsp;
    <?php
//TESTING JS FB STYLE EMULATION/////////////////
echo '
Testing JS FB div emulation<br />
<p>
<span id="name1" uid="'.$fb_user.'" ></span>
</p>
<div style="">
<div id="pic1" uid="'.$fb_user.'"></div>
</div>

';
?>
</td>
    <td width="290">&nbsp;testing xfbml<br />
    <?php
//TESTING XFBML RENDERING///////////////////////////////////////
//Echo'd from php////////////////
echo 'Hello <fb:name uid="'.$fb_user.'" useyou="false"></fb:name>
<fb:profile-pic uid="'.$fb_user.'" facebook-logo="true" linked="false" ></fb:profile-pic>';
?>
</td>
    <td width="274">
    testing xfbml<br />
<?php //Rendered in HTML//////////////// ?>
This is
  <fb:name uid=<?=$fb_user?> useyou="false"> </fb:name>
My photo
<fb:profile-pic uid=<?=$fb_user?> size="square" facebook-logo="true"></fb:profile-pic></td>
  </tr>
</table>
<hr />
 
<?php //TESTING XFBML FRIEND SELECTOR IN A FORM/////////////// ?>

<form action="<?=$this_file_name?>" method="POST" name="test_form">
testing fb:serverfbml<br />

<fb:serverfbml style="max-width: 750px;max-height: 500px">
    <script type="text/fbml">
        <fb:fbml>
            <fb:request-form 
				target="_top"
                action="http://www.12daysoffun.com/hustle/test" 
                method="POST" 
                invite="true" 
                type="The Hustle" 
                content="&lt;fb:name uid=&quot;605869619&quot; firstnameonly=&quot;true&quot; shownetwork=&quot;false&quot; /&gt;wants to invite you to try out for their crew on The Hustle. Start out as a rookie and chose your way to the top, having and running the top crew!,&lt;fb:req-choice url=&quot;http://apps.facebook.com/the_hustle&quot; label=&quot;Join The Hustle&quot; /&gt;"> 
                <fb:multi-friend-selector 
                    max="20" 
                    actiontext="Invite your friends to try out for your crew." 
                    showborder="false" 
                    rows="3">
                </fb:multi-friend-selector>
            </fb:request-form>
        </fb:fbml>
    </script>

</fb:serverfbml>
<input name="_test_check" type="hidden" value="1" />
<input name="Submit" type="submit" value="Submit" />
</form>

<hr />
testing canvas page resize
<img name="resize test" src="http://www.celebnewswire.com/wp-content/uploads/import/Elle_Macpherson_Surf.jpg"  />

<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" mce_src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"> </script>
<script type="text/javascript">

//<![CDATA[
  //A helper function as shorthand for document.getElementById.
  //Most likely your app already has such helper function defined and won't need
  //it here.

 function $(id)
  {
    return document.getElementById(id);
  }

FB_RequireFeatures(["CanvasUtil"], function()
    {
      //You can optionally enable extra debugging logging in Facebook JavaScript client
      //FB.FBDebug.isEnabled = true;
      //FB.FBDebug.logLevel = 4;


      FB.XdComm.Server.init("http://12daysoffun.com/hustle/xd_receiver.htm");
      FB.CanvasClient.startTimerToSizeToContent();
    });


	FB_RequireFeatures(["XFBML"], function(){
		FB.Facebook.init("2b154bd6f13c0d2e91ee4619514aeaf9", "http://12daysoffun.com/hustle/xd_receiver.htm",{"reloadIfSessionStateChanged":true}); 
	});   
</script>
</body>
</html>