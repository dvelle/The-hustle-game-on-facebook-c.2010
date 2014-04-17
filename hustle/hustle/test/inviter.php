<?php
$fb_user=$_REQUEST['uid'];
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head></head>
	 
<body style="margin:0;">

<a name="verytop" id="verytop"></a>
 
 <script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/en_US" type="text/javascript"></script><script type="text/javascript">FB.init("2b154bd6f13c0d2e91ee4619514aeaf9");</script>
 
<fb:serverfbml style="max-width: 750px;max-height: 500px">
    <script type="text/fbml">
        <fb:fbml>
            <fb:request-form 
				target="_top"
                action="http://www.12daysoffun.com/hustle/test" 
                method="POST" 
                invite="true" 
                type="The Hustle" 
                content="Try out for my crew on The Hustle or you can start out as a rookie and hustle your way to the top, making your crew work for you!,&lt;fb:req-choice url=&quot;http://apps.facebook.com/the_hustle&quot; label=&quot;Join The Hustle&quot; /&gt;"> 
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

	</body>
</html>
