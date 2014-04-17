<?php
require_once('connect.php');
require_once 'stats.php';

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die('Error connecting to mysql');
		mysql_select_db($dbname);

$this_file = "center.php";

// assign posted variables to local variables
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['business'];
$payer_email = $_POST['payer_email'];


//read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
    $req .= "&$key=$value";
}
// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$fp = fsockopen ("www.paypal.com", 80, $errno, $errstr, 30);

if (!$fp){
	mail("dvelle@yahoo.com","Paypal Error","<b>Error Communicating with Paypal.<br>");
    $ipn_log .= "Error connecting to Paypal\n";
    if ($debug == 1){ 
		fwrite($fpx, "Error connecting to Paypal\n");
	}
}else{
    fputs ($fp, $header . $req);
    while (!feof($fp)){
        $res = fgets ($fp, 1024);
        if (strcmp ($res, "VERIFIED") == 0){
			$ipn_log .= "Paypal IPN VERIFIED\n";
			if ($debug == 1){
				fwrite($fpx, "Paypal IPN VERIFIED\n");
			}
			if (trim($receiver_email) == ''){
			$receiver_email = $_POST['receiver_email'];
			}
			if ($debug == 1){
					fwrite($fpx, "Paypal IPN DATA OK\n"); 
				}		
				//success
				$qry="INSERT INTO paypal_table VALUES (0 , '$payer_id', '$payment_date', '$txn_id', '$first_name', '$last_name', '$payer_email', '$payer_status', '$payment_type', '$memo', '$item_name', '$item_number', $quantity, $mc_gross, '$mc_currency', '$address_name', '$address_city', '$address_state', '$address_zip', '$address_country', '$address_status', '$payer_business_name', '$payment_status', '$pending_reason', '$reason_code', '$txn_type')";
				
				mysql_query($qry);
				
				$payment_amount;
				
				switch ($payment_amount){
					case ($payment_amount == 0.99):
					$tokens=3;
					break;
					case ($payment_amount == 1.99):
					  $tokens=8;
					  break;
					case ($payment_amount == 5.00):
					  $tokens=21;
					  break;  
					case ($payment_amount == 10.00):
					  $tokens=42;
					  break;
					case ($payment_amount == 20.00):
					  $tokens=85;
					  break;  
					case ($payment_amount == 40.00):
					  $tokens=170;
					  break;
					case ($payment_amount == 50.00):
					  $tokens=215;
					  break;  
					case ($payment_amount == 100.00):
					  $tokens=440;
					  break;
					case ($payment_amount == 150.00):
					  $tokens=700;
					  break;
					default:
					  echo "err";
				}
		
				$query = sprintf("SELECT id FROM h_users WHERE UPPER(user) = UPPER('%s')",
					mysql_real_escape_string($item_number));
				$result = mysql_query($query);
				list($userID) = mysql_fetch_row($result);
				$current = getStat("rp",$userID);
				$deposit = $current + $tokens;
				setStat("rp",$userID,$deposit);
				//
	
			
		}else if (strcmp ($res, "INVALID") == 0){
			mail("dvelle@yahoo.com","Paypal Error","We cannot verify your purchase<br/>".$req);
			$ipn_log .= "INVALID: We cannot verify your purchase\n";		
			if ($debug == 1){
				fwrite($fpx, "INVALID: We cannot verify your purchase\n");
			}
		}
	}
	
    fclose ($fp);
}
echo $ipn_log;
?>