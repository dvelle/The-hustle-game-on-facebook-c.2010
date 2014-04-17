<?php
require_once 'connect.php';		// our database settings
$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
img {
	border: none;
}
#inner_page2 {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(http://www.12daysoffun.com/hustle/graphics/long_bk.png);
	height: 712px;
}
#inner_page2 #leaders #title {
	color: #00F;
	padding-left: 5px;
	font-weight: bold;
}
#inner_page2 #leaders table tr td .board_header {
	font-size: 18px;
	font-weight: bold;
}
#inner_page2 #leaders table tr td .board_headerw {
	color: #FFF;
	font-size: 18px;
	font-weight: bolder;
}
#inner_page2 #leaders table tr td table tr td #top10_c {
	overflow: scroll;
	height: 150px;
}
#inner_page2 #leaders table tr td table tr td #bot10_c {
	overflow: scroll;
	height: 150px;
}
#inner_page2 #leaders table tr td table tr td #top10_p {
	overflow: scroll;
	height: 150px;
}
#inner_page2 #leaders table tr td table tr td #bot10_p {
	overflow: scroll;
	height: 150px;
}
#inner_page2 #leaders table tr td table tr td #top10_g {
	overflow: scroll;
	height: 150px;
}
#inner_page2 #leaders table tr td table tr td #bot10_g {
	overflow: scroll;
	height: 150px;
}


-->
</style>
</head>

<body>
<div id="inner_page2">
  <div id="leaders">
    <div id="title"><img src="http://www.12daysoffun.com/hustle/graphics/lboards.png"/></div>
    <table width="730" border="0" cellpadding="0" align="right">
      <tr>
        <td width="376"><div class="board_headerw">Top 10 Crews</div><table width="320" border="0" cellpadding="0">
  <tr>
    <td>Crew</td>
    <td>Rank</td>
  </tr>
</table>
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div id="top10_c"><table>
        <?php
		//
		$sql="SELECT * FROM `h_top_crew` ORDER BY `rank` ASC LIMIT 10";
		$result = mysql_query($sql);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			?>
        <tr <?php if($i%2 == 1){ echo "class='body2'"; }else{echo "class='body1'";}?>>
        <td><?php 
		// 
		$query2 = sprintf("SELECT mem_image FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($result_ar['user']));
				$result2 = mysql_query($query2);
				$result_ar2 = mysql_fetch_assoc($result2);
		$image = $result_ar2['mem_image']; echo "<img src='http://www.12daysoffun.com/hustle/file/pic/crew/$image' />";?></td>
          <td>&nbsp;</td>
        <td><?php echo $result_ar['crew_name'];?></td>
          <td>&nbsp;</td>
          <td><?php echo $result_ar['rank'];?></td>
          <td>&nbsp;</td>
          </tr>
        <?php
			$i+=1;
			}
			?>
      </table></div></td>
            </tr>
        </table></td>
        <td width="15">&nbsp;</td>
        <td width="331"><div class="board_header">Bottom 10 Crews</div><table width="320" border="0" cellpadding="0">
  <tr>
    <td>Crew </td>
    <td>Rank</td>
  </tr>
</table>
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div id="bot10_c"><table>
        <?php
		//
		$sql="SELECT * FROM `h_top_crew` ORDER BY `rank`DESC LIMIT 10";
		$result = mysql_query($sql);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			?>
        <tr <?php if($i%2 == 1){ echo "class='body2'"; }else{echo "class='body1'";}?>>
        <td><?php
		// 
		$query2 = sprintf("SELECT mem_image FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($result_ar['user']));
				$result2 = mysql_query($query2);
				$result_ar2 = mysql_fetch_assoc($result2);
		$image = $result_ar2['mem_image']; echo "<img src='http://www.12daysoffun.com/hustle/file/pic/crew/$image' />";?></td>
          <td>&nbsp;</td>
        <td><?php echo $result_ar['crew_name'];?></td>
          <td>&nbsp;</td>
          <td><?php echo $result_ar['rank'];?></td>
          <td>&nbsp;</td>
          </tr>
        <?php
			$i+=1;
			}
			?>
      </table></div></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><div class="board_headerw">Top 10 Players</div><table width="320" border="0" cellpadding="0">
  <tr>
    <td>User</td>
    <td>Rank</td>
  </tr>
</table>
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div id="top10_p"><table>
        <?php
		//
		$sql="SELECT * FROM `h_top_players` ORDER BY `rank` ASC LIMIT 10";
		$result = mysql_query($sql);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			?>
        <tr <?php if($i%2 == 1){ echo "class='body2'"; }else{echo "class='body1'";}?>>
        <td><?php
		// 
		$query2 = sprintf("SELECT image FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($result_ar['user']));
				$result2 = mysql_query($query2);
				$result_ar2 = mysql_fetch_assoc($result2);
		$image = $result_ar2['image']; echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image' />";?></td>
          <td>&nbsp;</td>
        <td><?php echo $result_ar['user'];?></td>
          <td>&nbsp;</td>
          <td><?php echo $result_ar['rank'];?></td>
          <td>&nbsp;</td>
          </tr>
        <?php
			$i+=1;
			}
			?>
      </table></div></td>
            </tr>
        </table></td>
        <td>&nbsp;</td>
        <td><div class="board_header">Bottom 10 Players</div><table width="320" border="0" cellpadding="0">
  <tr>
    <td>User</td>
    <td>Rank</td>
  </tr>
</table>
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div id="bot10_p"><table>
        <?php
		//
		$sql="SELECT * FROM `h_top_players` ORDER BY `rank` DESC LIMIT 10";
		$result = mysql_query($sql);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			?>
        <tr <?php if($i%2 == 1){ echo "class='body2'"; }else{echo "class='body1'";}?>>
        <td><?php
		// 
		$query2 = sprintf("SELECT image FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($result_ar['user']));
				$result2 = mysql_query($query2);
				$result_ar2 = mysql_fetch_assoc($result2);
		$image = $result_ar2['image']; echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image' />";?></td>
          <td>&nbsp;</td>
        <td><?php echo $result_ar['user'];?></td>
          <td>&nbsp;</td>
          <td><?php echo $result_ar['rank'];?></td>
          <td>&nbsp;</td>
          </tr>
        <?php
			$i+=1;
			}
			?>
      </table></div></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><div class="board_headerw">Top 10 Games</div><table width="320" border="0" cellpadding="0">
  <tr>
    <td>#</td>
    <td>Game</td>
  </tr>
</table>
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div id="top10_g"><table>
        <?php
		//
		$sql="SELECT * FROM `arcade_games` ORDER BY `timesplayed` ASC LIMIT 10";
		$result = mysql_query($sql);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			?>
        <tr <?php if($i%2 == 1){ echo "class='body2'"; }else{echo "class='body1'";}?>>
        <td><?php $image = $result_ar['stdimage']; echo "<img src='http://www.12daysoffun.com/hustle/arcade/images/$image' />";?></td>
          <td>&nbsp;</td>
        <td><?php echo $result_ar['tp'];?></td>
          <td>&nbsp;</td>
          <td><?php echo $result_ar['shortname'];?></td>
          <td>&nbsp;</td>
          <td><?php $file = $result_ar['file']; $width = $result_ar['width']; $height = $result_ar['height']; echo"<a href=gamescreen.php?game=$file&amp;width=$width&amp;height=$height>PLAY</a>"; 
				?></td>
          <td>&nbsp;</td>
          </tr>
        <?php
			$i+=1;
			}
			?>
      </table></div></td>
            </tr>
        </table></td>
        <td>&nbsp;</td>
        <td><div class="board_header">Bottom 10 Games</div><table width="320" border="0" cellpadding="0">
  <tr>
    <td>#</td>
    <td>Game</td>
  </tr>
</table>
          <table width="320" border="0" cellpadding="0">
            <tr>
              <td><div id="bot10_g"><table>
        <?php
		//
		$sql="SELECT * FROM `arcade_games` ORDER BY `timesplayed` DESC LIMIT 10";
		$result = mysql_query($sql);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			?>
        <tr <?php if($i%2 == 1){ echo "class='body2'"; }else{echo "class='body1'";}?>>
        <td><?php $image = $result_ar['stdimage']; echo "<img src='http://www.12daysoffun.com/hustle/arcade/images/$image' />";?></td>
          <td>&nbsp;</td>
        <td><?php echo $result_ar['user'];?></td>
          <td>&nbsp;</td>
          <td><?php echo $result_ar['shortname'];?></td>
          <td>&nbsp;</td>
          <td><?php $file = $result_ar['file']; $width = $result_ar['width']; $height = $result_ar['height']; echo"<a href=gamescreen.php?game=$file&amp;width=$width&amp;height=$height>PLAY</a>"; 
				?></td>
          <td>&nbsp;</td>     
          </tr>
        <?php
			$i+=1;
			}
			?>
      </table></div></td>
            </tr>
        </table></td>
      </tr>
    </table>
  </div>  
</div>
</body>
</html>
