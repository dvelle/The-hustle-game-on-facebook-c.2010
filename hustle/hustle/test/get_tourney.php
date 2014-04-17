<?
$user = $_REQUEST['data'];

//$user = "jermongreen";
//$biz_id = 156;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
function getgameid($race){
	if($race ==1){
		$id = 1601;
		return $id;
	}elseif($race ==2){
		$id = 1598;
		return $id;
	}elseif($race ==3){
		$id = 1586;
		return $id;
	}elseif($race ==4){
		$id = 1587;
		return $id;
	}elseif($race ==5){
		$id = 1767;
		return $id;
	}elseif($race ==6){
		$id = 3621;
		return $id;
	}elseif($race ==7){
		$id = 1604;
		return $id;
	}elseif($race ==8){
		$id = 1678;
		return $id;
	}elseif($race ==9){
		$id = 1791;
		return $id;
	}elseif($race ==10){
		$id = 1601;
		return $id;
	}
}

$query = sprintf("SELECT * FROM h_tourney WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($user));
$result = mysql_query($query);
$row = mysql_fetch_array($result);

if(is_array($row)){
	//check scores
	$race1 = $row["race1"];
	$race2 = $row["race2"];
	$race3 = $row["race3"];
	$race4 = $row["race4"];
	$race5 = $row["race5"];
	$race6 = $row["race6"];
	$race7 = $row["race7"];
	$race8 = $row["race8"];
	$race9 = $row["race9"];
	$race10 = $row["race10"];
	if(empty($race1)){
		$leg = 1;
		$gameid = getgameid($leg);
	} elseif(empty($race2)){
		$leg = 2;
		$gameid = getgameid($leg);
	} elseif(empty($race3)){
		$leg = 3;
		$gameid = getgameid($leg);
	} elseif(empty($race4)){
		$leg = 4;
		$gameid = getgameid($leg);
	} elseif(empty($race5)){
		$leg = 5;
		$gameid = getgameid($leg);
	} elseif(empty($race6)){
		$leg = 6;
		$gameid = getgameid($leg);
	} elseif(empty($race7)){
		$leg = 7;
		$gameid = getgameid($leg);
	} elseif(empty($race8)){
		$leg = 8;
		$gameid = getgameid($leg);
	} elseif(empty($race9)){
		$leg = 9;
		$gameid = getgameid($leg);
	} elseif(empty($race10)){
		$leg = 10;
		$gameid = getgameid($leg);
	}
	
	$sql = sprintf("SELECT * FROM arcade_games WHERE gameid = ('%s')",
							   $gameid);
				$result = mysql_query($sql);
				$result_ar = mysql_fetch_array($result);
				$file = $result_ar['file'];
				$width = $result_ar['width']; 
				$height = $result_ar['height'];
				$image = $result_ar['stdimage'];
	
				echo"<a href=\"javascript:ajaxpage('../arcade/gamescreen.php?game=$file&amp;width=$width&amp;height=$height', 'content');\"><img src='../graphics/play_button.gif'></a>";
} 
?>