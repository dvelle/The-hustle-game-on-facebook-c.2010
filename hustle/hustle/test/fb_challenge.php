<?
$user = $_REQUEST["data"];
//$user = "jermongreen";
require_once 'connect.php';	// this is from our earlier article on configuration files in PHP

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$query = sprintf("SELECT firstname FROM h_users WHERE UPPER(user) = UPPER('%s')",
						mysql_real_escape_string($user));
					$result = mysql_query($query);
list($firstname) = mysql_fetch_row($result);

$sql = sprintf("SELECT * FROM h_fb_challenges WHERE user1 = ('%s')",
							   $firstname);
				$result = mysql_query($sql);
				$result_ar = mysql_fetch_array($result);
				
				$tid = $result_ar['user2'];
				$wager = $result_ar['wager']; 
				$gamename = $result_ar['gamename'];
				$image = $result_ar['image_icon'];

$poller = json_encode(array(
  "firstname" => $firstname,
  "wager" => $wager,
  "gamename" => $gamename,
  "image" => $image,
  "tid" => $tid,

));

echo $poller;

$sql = sprintf("DELETE FROM h_fb_challenges WHERE user1 = ('%s')",
						mysql_real_escape_string ($firstname));
					mysql_query($sql); 
?>