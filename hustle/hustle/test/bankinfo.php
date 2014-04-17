<?
$user = $_REQUEST["data"];
//$user = "jermongreen";
require_once 'connect.php';	// this is from our earlier article on configuration files in PHP

require_once 'crimes.php';
require_once 'collars.php';

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
	or die('Error connecting to mysql');
mysql_select_db($dbname);

$query = "SELECT balance FROM h_bliss_bank";
$result = mysql_query($query);
list($cash_bal) = mysql_fetch_row($result);
$cash = number_format($cash_bal, 0, ',', ',');

$query = "SELECT assets FROM h_bliss_bank";
$result = mysql_query($query);
list($ass_bal) = mysql_fetch_row($result);
$ass = number_format($ass_bal, 0, ',', ',');

$query = sprintf("SELECT balance FROM h_bank_accounts WHERE UPPER(user) = UPPER('%s')",
		mysql_real_escape_string($user));
$result = mysql_query($query);
list($mine) = mysql_fetch_row($result);
$acct = number_format($mine, 0, ',', ',');
$check = 2;
if(empty($acct)){
	$check = 1;
} 
	
$poller = json_encode(array(
  "cash" => $cash,
  "assets" => $ass,
  "myacc" => $acct,
  "test" => $check,
));

echo $poller
 
?>