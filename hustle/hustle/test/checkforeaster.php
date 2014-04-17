<?
$user = $_REQUEST['data'];

//$user = "jermongreen";
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$sql = sprintf("DELETE FROM arcade_news WHERE winner = ('%s')",
							mysql_real_escape_string ($user));
mysql_query($sql);

$query = sprintf("SELECT egg_name FROM h_users WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($egg) = mysql_fetch_row($result);
if($egg == 1){
	//
	$report = 1;
} else {
	$report = 2;
	if($egg == "race"){
		$query = sprintf("SELECT note_image FROM h_special_items WHERE name = ('%s')",
		mysql_real_escape_string($egg));
		$result = mysql_query($query);
		list($image) = mysql_fetch_row($result);
		$form = 1;
	} elseif($egg == "bribe"){
		$query = sprintf("SELECT note_image FROM h_special_items WHERE name = ('%s')",
		mysql_real_escape_string($egg));
		$result = mysql_query($query);
		list($image) = mysql_fetch_row($result);
		$form = 2;
	}else{
		$query = sprintf("SELECT note_image FROM h_special_items WHERE name = ('%s')",
		mysql_real_escape_string($egg));
		$result = mysql_query($query);
		list($image) = mysql_fetch_row($result);
		$form = 3;
	}
		
}

//check for race
//check for packages
//check for weapons
//check for assets

$poller = json_encode(array(
  "report" => $report,
  "image" => $image,
  "form" => $form,
));

echo $poller		
?>