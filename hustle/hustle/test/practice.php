<?php
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
img {
	border: none;
}
#inner_page {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(../graphics/hustle_bk_bottom.png);
	height: 404px;
}
#inner_page #browser #ArcadePanels .TabbedPanelsContentGroup .TabbedPanelsContent.TabbedPanelsContentVisible {
	height: 281px;
	overflow: scroll;
}

-->
</style>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="inner_page">
  <div id="browser">
    <div id="ArcadePanels" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Random</li>
        <li class="TabbedPanelsTab" tabindex="0">Action</li>
        <li class="TabbedPanelsTab" tabindex="0">Shooting</li>
        <li class="TabbedPanelsTab" tabindex="0">Sports</li>
        <li class="TabbedPanelsTab" tabindex="0">Racing</li>
        <li class="TabbedPanelsTab" tabindex="0">Memory</li>
        <li class="TabbedPanelsTab" tabindex="0">Casino</li>
        <li class="TabbedPanelsTab" tabindex="0">Strategy</li>
        <li class="TabbedPanelsTab" tabindex="0">Classics</li>
        <li class="TabbedPanelsTab" tabindex="0">Classic Clones</li>
        <li class="TabbedPanelsTab" tabindex="0">Puzzle/Strategy</li>
        <li class="TabbedPanelsTab" tabindex="0">Uncategorized</li>
      </ul>
      <div class="TabbedPanelsContentGroup">
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
			} // if
			?>
        </table></div>
        <div class="TabbedPanelsContent">
        <table>
		<?php
		// Pagination Start
		if (isset($_GET['pageno1'])) {
			$cateno2 = $_GET['pageno1'];
			} else {
				$cateno2 = 1;
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
		$cateno2 = (int)$cateno2;
		if ($cateno2 > $lastpage) {
			$cateno2 = $lastpage;
		} // if
		if ($cateno2 < 1) {
			$cateno2 = 1;
		} // if
		//Part 5
		$limit = 'LIMIT ' .($cateno2 - 1) * $rows_per_page .',' .$rows_per_page;
		//Part 6
		//... process contents of $result ...
		$query = "SELECT * FROM arcade_games WHERE categoryid = '2' ORDER BY gameid $limit";
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
			if ($cateno2 == 1) {
				echo " FIRST PREV ";
			} else {
				echo " <a href='{$_SERVER['PHP_SELF']}?pageno1=1'>FIRST </a> ";
				$prevpage = $cateno2-1;
				echo " <a href='{$_SERVER['PHP_SELF']}?pageno1=$prevpage'> PREV</a> ";
			} // if
			echo " ( Page $cateno2 of $lastpage ) ";
			// all pages
			if ($cateno2 == $lastpage) {
				echo " NEXT LAST ";
			} else {
				$nextpage = $cateno2+1;
				echo " <a href='{$_SERVER['PHP_SELF']}?pageno1=$nextpage'>NEXT </a> "." ";
				echo " <a href='{$_SERVER['PHP_SELF']}?pageno1=$lastpage'> LAST</a> ";
			} // if
			?>
        </table></div>
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
		$query = "SELECT * FROM arcade_games WHERE categoryid = '3' ORDER BY gameid $limit";
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
			} // if
			?>
        </table></div>
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
		$query = "SELECT * FROM arcade_games WHERE categoryid = '4' ORDER BY gameid $limit";
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
			} // if
			?>
        </table></div>
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
		$query = "SELECT * FROM arcade_games WHERE categoryid = '5' ORDER BY gameid $limit";
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
			} // if
			?>
        </table></div>
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
		$query = "SELECT * FROM arcade_games WHERE categoryid = '6' ORDER BY gameid $limit";
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
			} // if
			?>
        </table></div>
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
		$query = "SELECT * FROM arcade_games WHERE categoryid = '7' ORDER BY gameid $limit";
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
			} // if
			?>
        </table></div>
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
		$query = "SELECT * FROM arcade_games WHERE categoryid = '8' ORDER BY gameid $limit";
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
			} // if
			?>
        </table></div>
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
		$query = "SELECT * FROM arcade_games WHERE categoryid = '9' ORDER BY gameid $limit";
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
			} // if
			?>
        </table></div>
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
		$query = "SELECT * FROM arcade_games WHERE categoryid = '10' ORDER BY gameid $limit";
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
			} // if
			?>
        </table></div>
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
		$query = "SELECT * FROM arcade_games WHERE categoryid = '11' ORDER BY gameid $limit";
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
			} // if
			?>
        </table></div>
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
		$query = "SELECT * FROM arcade_games WHERE categoryid = '12' ORDER BY gameid $limit";
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
			} // if
			?>
        </table></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
<!--
var ArcadePanels = new Spry.Widget.TabbedPanels("ArcadePanels");
//-->
</script>
</body>
</html>
