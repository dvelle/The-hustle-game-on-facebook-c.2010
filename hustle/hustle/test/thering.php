<?php
$user = $_REQUEST["data"];

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

include 'stats.php';

include 'leveler.php';

?>
      <div id="top_crews">
      <table>
                <?php
                //
                $sql="SELECT * FROM `h_top_crew` ORDER BY `rank` ASC LIMIT 10";
                $result = mysql_query($sql);
                $i = 0;
                while($result_ar = mysql_fetch_assoc($result)){
                    ?>
                <tr>
                <td><?php 
                // 
                $query2 = sprintf("SELECT mem_image FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
                            mysql_real_escape_string($result_ar['user']));
                        $result2 = mysql_query($query2);
                        $result_ar2 = mysql_fetch_assoc($result2);
                $image = $result_ar2['mem_image']; echo "<img src='http://www.12daysoffun.com/hustle/file/pic/crew/flags/$image' />";?></td>
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
              </table>
      </div>
      <div id="bot_crews">
      <table>
        <?php
		//
		$sql="SELECT * FROM `h_top_crew` ORDER BY `rank`DESC LIMIT 10";
		$result = mysql_query($sql);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			?>
        <tr>
        <td><?php
		// 
		$query2 = sprintf("SELECT mem_image FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($result_ar['user']));
				$result2 = mysql_query($query2);
				$result_ar2 = mysql_fetch_assoc($result2);
		$image = $result_ar2['mem_image']; echo "<img src='http://www.12daysoffun.com/hustle/file/pic/crew/flags/$image' />";?></td>
          <td>&nbsp;</td>
        <td><?php echo $result_ar['crew_name'];?></td>
          <td>&nbsp;</td>
          <td style="padding-left:62px;"><?php echo $result_ar['rank'];?></td>
          <td>&nbsp;</td>
          </tr>
        <?php
			$i+=1;
			}
			?>
      </table>
      </div>
      <div id="top_players">
      <table>
        <?php
		//
		$sql="SELECT * FROM `h_top_players` ORDER BY `rank` ASC LIMIT 10";
		$result = mysql_query($sql);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			?>
        <tr>
        <td><?php
		// 
		$query2 = sprintf("SELECT * FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($result_ar['user']));
				$result2 = mysql_query($query2);
				$result_ar2 = mysql_fetch_assoc($result2);
		$image = $result_ar2['image']; 
		$first = $result_ar2['firstname'];
		$target = $result_ar2['user'];
		echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image' />";?></td>
          <td>&nbsp;</td>
        <td><?php echo ucwords($first);?></td>
          <td>&nbsp;</td>
          <td><?php echo $result_ar['rank'];?></td>
          <td>&nbsp;</td>
          <td><form id="crew_app" name="crew_app" method="post" action="recruiter.php"><input type="hidden" id="userid" name="customer" value="<? echo $user;?>"/><input type="hidden" id="target" name="target" value="<? echo $target;?>"/>$
        <input name="cashoffer" id="cashoffer" type="text" size="10" maxlength="8" />
        <input name="submit" type="submit" class="button" id="submit_btn" value="Recruit" /></form></td>
          </tr>
        <?php
			$i+=1;
			}
			?>
      </table>
      </div>
      <div id="bot_players">
      <table>
        <?php
		//
		$sql="SELECT * FROM `h_top_players` ORDER BY `rank` DESC LIMIT 10";
		$result = mysql_query($sql);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			?>
        <tr>
        <td><?php
		// 
		$query2 = sprintf("SELECT * FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($result_ar['user']));
				$result2 = mysql_query($query2);
				$result_ar2 = mysql_fetch_assoc($result2);
		$image = $result_ar2['image']; 
		$name = $result_ar2['firstname'];
		echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image' />";?></td>
          <td>&nbsp;</td>
        <td><?php echo ucwords($name);?></td>
          <td>&nbsp;</td>
          <td style="padding-left:89px;"><?php echo $result_ar['rank'];?></td>
          <td>&nbsp;</td>
          </tr>
        <?php
			$i+=1;
			}
			?>
      </table>
      </div>
      <div id="bot_games">
      <table>
        <?php
		//
		$sql="SELECT * FROM `arcade_games` ORDER BY `timesplayed` ASC LIMIT 10";
		$result = mysql_query($sql);
		while($result_ar = mysql_fetch_assoc($result)){
			$file = $result_ar['file'];
			$query = sprintf("SELECT categoryid FROM arcade_games WHERE file = ('%s')",
						mysql_real_escape_string ($file));
			$theresult = mysql_query($query);
			list($catid) = mysql_fetch_row($theresult);
			if($catid != 7){
				?>
			<tr>
			<td><?php $image = $result_ar['stdimage']; echo "<img src='http://www.12daysoffun.com/hustle/arcade/images/$image' />";?></td>
			  <td>&nbsp;</td>
			<td><?php echo $result_ar['tp'];?></td>
			  <td>&nbsp;</td>
			  <td><?php echo $result_ar['shortname'];?></td>
			  <td>&nbsp;</td>
			  <td><?php $width = $result_ar['width']; $height = $result_ar['height']; echo"<a href=gamescreen.php?game=$file&amp;width=$width&amp;height=$height>PLAY</a>"; 
					?></td>
			  <td>&nbsp;</td>
			  </tr>
			<?php
			}
		}
			?>
      </table>
      </div>
      <div id="top_games">
      <table>
        <?php
		//
		$sql="SELECT * FROM `arcade_games` ORDER BY `timesplayed` DESC LIMIT 13";
		$result = mysql_query($sql);
		while($result_ar = mysql_fetch_assoc($result)){
			$file = $result_ar['file'];
			$query = sprintf("SELECT categoryid FROM arcade_games WHERE file = ('%s')",
				mysql_real_escape_string ($file));
			$theresult = mysql_query($query);
			list($catid) = mysql_fetch_row($theresult);
			if($catid != 7){
				?>
			<tr>
			<td><?php $image = $result_ar['stdimage']; echo "<img src='http://www.12daysoffun.com/hustle/arcade/images/$image' />";?></td>
			  <td>&nbsp;</td>
			<td><?php echo $result_ar['tp'];?></td>
			  <td>&nbsp;</td>
			  <td><?php echo $result_ar['shortname'];?></td>
			  <td>&nbsp;</td>
			  <td><?php $width = $result_ar['width']; $height = $result_ar['height']; echo"<a href=gamescreen.php?game=$file&amp;width=$width&amp;height=$height>PLAY</a>"; 
					?></td>
			  <td>&nbsp;</td>
			  </tr>
			<?php
			}
		}
			?>
      </table>
      </div>