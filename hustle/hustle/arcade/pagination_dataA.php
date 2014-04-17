<?php

include('config.php');

$per_page = 10; 

if($_GET)
{
$page=$_GET['page'];
}



//get table contents
$start = ($page-1)*10;
$sql = "SELECT * FROM arcade_games ORDER BY gameid LIMIT $start,$per_page";
$result = mysql_query($sql);
$squery = "SELECT * FROM arcade_highscores";
$sresult = mysql_query($squery);
?>


	<table width="800px">
		
		<?php
		//Print the contents
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			$sresult_ar = mysql_fetch_assoc($sresult);
			$image = $result_ar['stdimage'];
			$name = $result_ar['shortname'];
			$file = $result_ar['file'];
			$width = $result_ar['width']; 
			$height = $result_ar['height']; 
			$champ = $sresult_ar['username'];
			$cscore = $sresult_ar['score'];
		?>
		<tr>
				<td><?php echo "<img src='http://www.12daysoffun.com/hustle/arcade/images/$image' />";?></td>
				<td><?php echo ucwords($name); 
				echo "<br />";
				echo"<a href=http://www.12daysoffun.com/hustle/test/gamescreen.php?game=$file&amp;width=$width&amp;height=$height target='_parent'>PLAY</a>"; 
				?></td>
                <td><?php echo " "; ?></td>
                <td><?php echo " "; ?></td>
                <td><?php  
				if ($result_ar['gameid'] = $sresult_ar['gamename']){
					echo "<b>Champion: </b>";
					echo $champ;
					echo "<br />";
					echo "High Score: ";
					echo $cscore;
				}else{
					$champ = "None";
					$cscore = 0;
					echo "<b>Champion: </b>";
					echo "none";
					echo "<br />";
					echo "High Score: ";
					echo 0;
				}
					?> </td>
                <td><?php echo " "; ?></td>
                <td><?php echo " "; ?></td>
                <td><?php echo"<a href=fight.php?game=$file&amp;user=$width target='_parent'>CHALLENGE</a>";?> </td> 
			</tr>
			<?php
			$i+=1;
			} //while
		?>
	</table>

