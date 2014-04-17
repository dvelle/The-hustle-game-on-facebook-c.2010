<?php
/*
This page will go out to a database, and grab a selection of rows.
Because we dont want to display hundreds of rows at a time we will
create dynamic paging.
*/

//############################################
//First get the page value passed to this page
$pageNum='1';
if (isset($_GET["p"])) {
	$pageNum=$_GET["p"];
}

$type='';
if (isset($_GET["t"])) {
	$type=$_GET["t"];
}

//############################################
//Now import the settings
include_once("settings.php");

//############################################
//Connect to the db
mysql_connect($db_host,$MySqlUN,$MySqlPW);
mysql_select_db($database) or die( "Unable to select databases");

//############################################
//Get a quick count of all the rows
$querys   = "SELECT COUNT(*) AS numrows FROM $tablename";
$results  = mysql_query($querys) or die('Error, query failed');
$row     = mysql_fetch_array($results, MYSQL_ASSOC);
$num = $row['numrows'];

//############################################
//If there are some rows then start the pagination
if ($num>0) {
	//Determine the maxpage and the offset for the query
	$maxPage = ceil($num/$RPP);
	$offset = ($pageNum - 1) * $RPP;

	//Initiate the navigation bar
	$nav  = '';

	//get low end
	$page = $pageNum-3;

	//get upperbound
	$upper =$pageNum+3;

	if ($page <=0) {
		$page=1;
	}

	if ($upper >$maxPage) {
		$upper =$maxPage;
	}

	//Make sure there are 7 numbers (3 before, 3 after and current
	if ($upper-$page <6){

		//We know that one of the page has maxed out
		//check which one it is
		//echo "$upper >=$maxPage<br>";
		if ($upper >=$maxPage){
			//the upper end has maxed, put more on the front end
			//echo "to begining<br>";
			$dif =$maxPage-$page;
			//echo "$dif<br>";
				if ($dif==3){
					$page=$page-3;
				}elseif ($dif==4){
					$page=$page-2;
				}elseif ($dif==5){
					$page=$page-1;
				}
		}elseif ($page <=1) {
			//its the low end, add to upper end
			//echo "to upper<br>";
			$dif =$upper-1;

			if ($dif==3){
				$upper=$upper+3;
			}elseif ($dif==4){
				$upper=$upper+2;
			}elseif ($dif==5){
				$upper=$upper+1;
			}
		}
	}

	if ($page <=0) {
		$page=1;
	}

	if ($upper >$maxPage) {
		$upper =$maxPage;
	}

	//These are the numbered links
	for($page; $page <=  $upper; $page++) {
		if ($page == $pageNum){
			//If this is the current page then disable the link
			$nav .= " <font color='red'>$page</font> ";
		}else{
			//If this is a different page then link to it
			$nav .= " <a onclick='showPage(\"".$page."\")'>$page</a> ";
		}
	}

	//These are the button links for first/previous enabled/disabled
	if ($pageNum > 1){
		$page  = $pageNum - 1;
		$prev  = "<img border='0' src='$PrevIc' onclick='showPage(\"".$page."\")'> ";
		$first = "<img border='0' src='$FirstIc' onclick='showPage(\"1\")'> ";
	}else{
		$prev  = "<img border='0' src='$dPrevIc' > ";
		$first = "<img border='0' src='$dFirstIc'  > ";
	}

	//These are the button links for next/last enabled/disabled
	if ($pageNum < $maxPage AND $upper <= $maxPage) {
		$page = $pageNum + 1;
		$next = " <img border='0' src='$NextIc' onclick='showPage(\"".$page."\")'>";
		$last = " <img border='0' src='$LastIc'  onclick='showPage(\"".$maxPage."\")'>";
	} else {
		$next = " <img border='0' src='$dNextIc' >";
		$last = " <img border='0' src='$dLastIc' >";
	}

	if ($maxPage>1 AND $type=='nav') {
		// print the navigation link
		echo $first . $prev . $nav . $next . $last;
	}elseif ($maxPage>1 AND $type=='con') {
		//Build the header

		//Get all the rows
		$query="SELECT * FROM $tablename ORDER BY 'gameid' LIMIT $offset, $RPP";
		$result=mysql_query($query) or die('Failed selecting applications: ' . mysql_error());
		$num=mysql_numrows($result);
		$squery = "SELECT * FROM arcade_highscores";
		$sresult = mysql_query($squery);

		//Echo each row
		while($row = mysql_fetch_array($result)) {
			$image = $row['stdimage'];
			$file = $row['file']; 
			$width = $row['width']; 
			$height = $row['height'];
			$name = $row['shortname'];
			$sresult_ar = mysql_fetch_assoc($sresult);
			 echo "<tr>";
			 echo "<td>" . "<img src='http://www.12daysoffun.com/hustle/arcade/images/$image' />". "</td>";
			 echo '<td>' . $name . '<br />' ?> <input name="targetplay2" type="checkbox" value="<? $name ?>" /> <? echo '</td>';
			 echo "</tr>";
		}

		//Close table
		echo "</table>";
	}else{
		echo "Table doesn't contain records.";
	}
}



//Close the db connection
mysql_close();
?>
