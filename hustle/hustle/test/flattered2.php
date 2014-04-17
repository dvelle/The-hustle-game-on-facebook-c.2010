<?php
$user = $_REQUEST["data"];

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

include 'stats.php';

include 'leveler.php';


//
$sql="SELECT * FROM `h_top_players` ORDER BY `rank` ASC LIMIT 1";
$result = mysql_query($sql);
$i = 0;
while($result_ar = mysql_fetch_assoc($result)){			
	// 
	$query2 = sprintf("SELECT * FROM h_users WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string($result_ar['user']));
			$result2 = mysql_query($query2);
			$result_ar2 = mysql_fetch_assoc($result2);
	$image = $result_ar2['image']; 
	$first = $result_ar2['game_name'];
	$target = $result_ar2['user'];
	echo $first;
	break;
}

?>
      