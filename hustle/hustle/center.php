<?

// made by robin kohli (robin@19.5degs.com) for 19.5 Degrees (http://www.19.5degs.com)

// ----- edit these settings

// database settings
$host="localhost";
$ln="";
$pw="";
$db="";

// paypal email
$paypal_email = "jermon.green@bethereondemand.com";

// email address where script should send notifications
$error_email = "dvellle@yahoo.address";

// email header
$em_headers  = "From: The Hustle Support Team\n";		
$em_headers .= "Reply-To: support@betheresmg.com\n";
$em_headers .= "Return-Path: support@bethersmg.com\n";
$em_headers .= "Organization: BeThereSMG\n";
$em_headers .= "X-Priority: 3\n";


// -----------------


require("ipn_cls.php");

$paypal_info = $HTTP_POST_VARS;
$paypal_ipn = new paypal_ipn($paypal_info);

foreach ($paypal_ipn->paypal_post_vars as $key=>$value) {
	if (getType($key)=="string") {
		eval("\$$key=\$value;");
	}
}

$paypal_ipn->send_response();
$paypal_ipn->error_email = $error_email;

if (!$paypal_ipn->is_verified()) {
	$paypal_ipn->error_out("Bad order (PayPal says it's invalid)" . $paypal_ipn->paypal_response , $em_headers);
	die();
}


switch( $paypal_ipn->get_payment_status() )
{
	case 'Pending':
		
		$pending_reason=$paypal_ipn->paypal_post_vars['pending_reason'];
					
		if ($pending_reason!="intl") {
			$paypal_ipn->error_out("Pending Payment - $pending_reason", $em_headers);
			break;
		}


	case 'Completed':
		
		require_once('http://www.12daysoffun.com/hustle/test/connect.php');

		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die('Error connecting to mysql');
		mysql_select_db($dbname);
		
	
		if ($paypal_ipn->paypal_post_vars['txn_type']=="reversal") {
			$reason_code=$paypal_ipn->paypal_post_vars['reason_code'];
			$paypal_ipn->error_out("PayPal reversed an earlier transaction.", $em_headers);
			// you should mark the payment as disputed now
		} else {
					
			if (
				(strtolower(trim($paypal_ipn->paypal_post_vars['business'])) == $paypal_email) && (trim($mc_currency)==$config['mc_currency']) && (trim($mc_gross)-$tax == $quantity*$config['mc_gross']) 
				) {

				$qry="INSERT INTO paypal_table VALUES (0 , '$payer_id', '$payment_date', '$txn_id', '$first_name', '$last_name', '$payer_email', '$payer_status', '$payment_type', '$memo', '$item_name', '$item_number', $quantity, $mc_gross, '$mc_currency', '$address_name', '".nl2br($address_street)."', '$address_city', '$address_state', '$address_zip', '$address_country', '$address_status', '$payer_business_name', '$payment_status', '$pending_reason', '$reason_code', '$txn_type')";
				
				
				if (mysql_query($qry)) {

					$paypal_ipn->error_out("This was a successful transaction", $em_headers);			
					//success
					require_once 'http://www.12daysoffun.com/hustle/test/stats.php';
					$mc_gross;
					
					switch ($mc_gross)
					{
					case ($mc_gross == 0.99):
					  $tokens=3;
					  break;
					case ($mc_gross == 1.99):
					  $tokens=8;
					  break;
					case ($mc_gross == 5.00):
					  $tokens=21;
					  break;  
					case ($mc_gross == 10.00):
					  $tokens=42;
					  break;
					case ($mc_gross == 20.00):
					  $tokens=85;
					  break;  
					case ($mc_gross == 40.00):
					  $tokens=170;
					  break;
					case ($mc_gross == 50.00):
					  $tokens=215;
					  break;  
					case ($mc_gross == 100.00):
					  $tokens=440;
					  break;
					case ($mc_gross == 150.00):
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

				} else {
					$paypal_ipn->error_out("This was a duplicate transaction", $em_headers);
				} 
			} else {
				$paypal_ipn->error_out("Someone attempted a sale using a manipulated URL", $em_headers);
			}
		}
		break;
		
	case 'Failed':
		// this will only happen in case of echeck.
		$paypal_ipn->error_out("Failed Payment", $em_headers);
	break;

	case 'Denied':
		// denied payment by us
		$paypal_ipn->error_out("Denied Payment", $em_headers);
	break;

	case 'Refunded':
		// payment refunded by us
		$paypal_ipn->error_out("Refunded Payment", $em_headers);
	break;

	case 'Canceled':
		// reversal cancelled
		// mark the payment as dispute cancelled		
		$paypal_ipn->error_out("Cancelled reversal", $em_headers);
	break;

	default:
		// order is not good
		$paypal_ipn->error_out("Unknown Payment Status - " . $paypal_ipn->get_payment_status(), $em_headers);
	break;

} 

?>