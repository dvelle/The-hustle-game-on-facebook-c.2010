<?php

include('config.php');

$per_page = 10; 

if($_GET)
{
$page=$_GET['page'];
}



//get table contents
$start = ($page-1)*10;
$sql = "SELECT * FROM arcade_games WHERE categoryid = '7' ORDER BY gameid LIMIT $start,$per_page";
$result = mysql_query($sql);
?>


	<table width="800px">
		
		<?php
		//Print the contents
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			$id = $result_ar['gameid'];
			$squery = sprintf("SELECT * FROM arcade_highscores WHERE gamename = ('%s') ORDER by score DESC",
																				$id);
				$sresult = mysql_query($squery);
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
				echo"<a href='#' onClick=\"parent.location.href='gamescreen.php?game=$file&amp;width=$width&amp;height=$height'\">PLAY</a>";  
				?></td>
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
			</tr>
			<?php
			$i+=1;
			} //while
		?>
	</table>

