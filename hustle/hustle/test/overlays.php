<?php
//$user = "jermongreen";
$user = $_REQUEST["data"];
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

include 'stats.php';

include 'leveler.php';


$id_query = sprintf("SELECT id FROM h_users WHERE user = '%s'",
			   $user);
$id_result = mysql_query($id_query);
list($userID) = mysql_fetch_row($id_result);

$cw_query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
mysql_real_escape_string ($user));
$cw_result = mysql_query($cw_query);
list($crewID) = mysql_fetch_row($cw_result);
		//
		?>
<!--news_overlay-->
<div id="news_tks"
	style="position: absolute; top: 200px; left: 253px; width: 390px; text-align: center; z-index: 200; display: none; background:url(../graphics/news__bk.png);">
<div style="width: 390px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td><div id="news_header" style="text-align: right; padding-bottom: 5px; display: none; padding-right: 5px; padding-top: 5px;"><span><img src="../graphics/news_butt.png"/></span><span class="tab_clear">[Clear All News]</span><span id="news_exit_tks" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div>

<div id="pettabs" class="indentmenu">
<ul>
<li><a href="#" rel="dog1">Arcade News</a></li>
<li><a href="#" rel="dog2" class="selected">Challenges</a></li>
<li><a href="#" rel="dog3">Crew Updates</a></li>
<li><a href="#" rel="dog4">Extra,Extra</a></li>
<li><a href="#" rel="dog5">Hustle Updates</a></li>
</ul>
<br style="clear: left" />
</div>

<div style="border:1px solid gray; width:375px; height: 150px; padding: 5px; margin-bottom:1em">

<div id="dog1" class="tabcontent" style="overflow:auto;">
<div id="a_news" style="text-align: center; padding-bottom: 5px; overflow:auto; height:147px"></div>
</div>

<div id="dog2" class="tabcontent" style="overflow:auto;">
<div id="chall" style="text-align: center; padding-bottom: 5px; overflow:auto; height:147px"></div>
</div>

<div id="dog3" class="tabcontent" style="overflow:auto;">
<div id="c_news" style="text-align: center; padding-bottom: 5px; overflow:auto; height:147px"></div>
</div>

<div id="dog4" class="tabcontent" style="overflow:auto;">
<div id="h_news" style="text-align: center; padding-bottom: 5px; overflow:auto; height:147px"></div>
</div>

<div id="dog5" class="tabcontent" style="overflow:auto;">
<div id="readall" style="text-align: center; padding-bottom: 5px; overflow:auto; height:147px"></div>
</div>


</div>


<script type="text/javascript">

var mypets=new ddtabcontent("pettabs")
mypets.setpersist(true)
mypets.setselectedClassTarget("link")
mypets.init(2000)

</script>
		</td>

		<td class="app_border_right"></td>
	</tr>
	<tr class="app_border">
		<td class="app_border_bottom_left"></td>
		<td class="app_border_bottom"></td>
		<td class="app_border_bottom_right"></td>
	</tr>
</table>
</center>
</div>

</div>
        
