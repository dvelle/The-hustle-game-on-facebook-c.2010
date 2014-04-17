<?
$user = "jermongreen";
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
$userid = id($user);
$time = time();
?>
<div id="deed_bank"
	style="position: absolute; top: 170px; left: 203px; width: 323px; text-align: center; z-index: 100; display: block;">
<div style="width: 323px; margin: 0 auto;">
<center>
<table cellspacing="0" cellpadding="0">
	<tr class="app_border">
		<td class="app_border_top_left"></td>

		<td class="app_border_top"></td>
		<td class="app_border_top_right"></td>
	</tr>
	<tr>
		<td class="app_border_left"></td>
		<td><div id="deed_header" style="text-align: right; padding-bottom: 5px; display: block; padding-right: 5px; padding-top: 5px; background-color: #000"><span id="deed_exit" style="padding-left:100px"><img src="../../clique/graphics/button_X.gif" width="14" height="14" /></span></div><div id="lisa_words"></div><div id="deed_response" style="display:block"></div>
		<div id="tutorial_app" style="background-color:#000">
            <form id="thetut" action="tutor_lisa.php" method="post" name="thetut" style="width:213px; padding-bottom:15px; margin-left:auto; margin-right:auto;">
                    <label>
                      <input type="image" name="accept" src="../graphics/continue.png" width="55" height="22"> 
                      <input type="hidden" id="userid" name="customer" value="<?php echo $user; ?>"/>
                    </label>
             </form>
             </div>
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
<?
print "hI";
?>