<?php
include '../connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

?>

<head></head>
<body>
<div class="TabbedPanelsContent">
        <table>
		<?php
		// Pagination Start
		if (isset($_GET['pageno'])) {
			$pageno = $_GET['pageno'];
			} else {
				$pageno = 1;
			} // if
		//Part 2
		$query = "SELECT COUNT(*) FROM arcade_games";
		$result = mysql_query($query);
		list($query_data) = mysql_fetch_row($result);
		$numrows = $query_data;
		//Part 3
		$rows_per_page = 10;
		$lastpage      = ceil($numrows/$rows_per_page);
		// Part 4
		$pageno = (int)$pageno;
		if ($pageno > $lastpage) {
			$pageno = $lastpage;
		} // if
		if ($pageno < 1) {
			$pageno = 1;
		} // if
		//Part 5
		$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
		//Part 6
		//... process contents of $result ...
		$query = "SELECT * FROM arcade_games ORDER BY gameid $limit";
		$result = mysql_query($query);
		$squery = "SELECT * FROM arcade_highscores";
		$sresult = mysql_query($squery);
		$i = 0;
		while($result_ar = mysql_fetch_assoc($result)){
			?>
            <tr>
				<td><?php $image = $result_ar['stdimage']; echo "<img src='http://www.12daysoffun.com/hustle/arcade/images/$image' />";?></td>
				<td><?php echo ucwords($result_ar['shortname']); 
				echo "<br />";
				$file = $result_ar['file']; $width = $result_ar['width']; $height = $result_ar['height']; echo"<a href=gamescreen.php?game=$file&amp;width=$width&amp;height=$height>PLAY</a>"; 
				?></td>
                <td><?php echo " "; ?></td>
                <td><?php echo " "; ?></td>
                <td><?php $sresult_ar = mysql_fetch_assoc($sresult); 
				if ($result_ar['gameid'] = $sresult_ar['gamename']){
					echo "<b>Champion: </b>";
					echo $sresult_ar['username'];
					echo "<br />";
					echo "High Score: ";
					echo $sresult_ar['score'];
				}else{
					echo "<b>Champion: </b>";
					echo "None<br />";
					echo "High Score: ";
					echo 0;
				}
					?> </td>
                <td><?php echo " "; ?></td>
                <td><?php echo " "; ?></td>
                <td><?php echo"<a href=fight.php?game=$file&amp;user=$width>CHALLENGE</a>";?> </td>
			</tr>
			<?php
			$i+=1;
			}
			//Pagination
			if ($pageno == 1) {
				echo " FIRST PREV ";
			} else {
				echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1'>FIRST </a> ";
				$prevpage = $pageno-1;
				echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage'> PREV</a> ";
			} // if
			echo " ( Page $pageno of $lastpage ) ";
			// all pages
			if ($pageno == $lastpage) {
				echo " NEXT LAST ";
			} else {
				$nextpage = $pageno+1;
				echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage'>NEXT </a> "." ";
				echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage'> LAST</a> ";
			} // if<a href="ajaxfiles/external.php">
			?>
        </table></div>
</body>


