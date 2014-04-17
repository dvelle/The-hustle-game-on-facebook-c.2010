<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_POST['leader'];


$wshare = $_POST['nat_win_share'];
$lshare = $_POST['nat_loss_share'];
$cwshare = $_POST['circ_win_share'];
$clshare = $_POST['circ_loss_share'];

//get user stats
	$query = sprintf("UPDATE h_crew_main SET nat_win_share = ('%s'),nat_loss_share = ('%s'),cir_win_share = ('%s'),cir_loss_share = ('%s') WHERE user = ('%s')",
						mysql_real_escape_string ($wshare),
						mysql_real_escape_string ($lshare),
						mysql_real_escape_string ($cwshare),
						mysql_real_escape_string ($clshare),
						mysql_real_escape_string ($user));
					$result = mysql_query($query);
echo "Settings Saved";					
?>
 