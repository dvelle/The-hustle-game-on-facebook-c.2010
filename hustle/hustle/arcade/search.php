<?php

include '../test/connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

if(isset($_GET['query'])) { $query = $_GET['query']; } else { $query = ""; }
if(isset($_GET['type'])) { $type = $_GET['type']; } else { $query = "count"; }

if($type == "count"){
	$sql = mysql_query("SELECT count(gameid) FROM arcade_games WHERE MATCH(shortname, description, title) AGAINST('$query*' IN BOOLEAN MODE)");
	$total = mysql_fetch_array($sql);
	$num = $total[0];
	
	echo $num;
	
}
?>


	<table width="300px">
		
		<?php
if($type == "results"){
	$sql = mysql_query("SELECT shortname, title, description FROM arcade_games WHERE MATCH(shortname, title, description) AGAINST('$query*' IN BOOLEAN MODE)");
	while($result_ar = mysql_fetch_array($sql)) {
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
    <?
	
}

mysql_close($conn);

?>