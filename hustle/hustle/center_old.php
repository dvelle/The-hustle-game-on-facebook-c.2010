<?php
include('settings.php');
include('functions.php');
$this_file = "ipn.php";

if ($paypal_sandbox == 1) {
	$paypal_url = "www.sandbox.paypal.com/cgi-bin/webscr";
	$paypal_ipn_url = "www.sandbox.paypal.com";
}
else {
	$paypal_url = "www.paypal.com/cgi-bin/webscr";
	$paypal_ipn_url = "www.paypal.com";
} 

$script_uri = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

// -- GENERATING THE PAYPAL ORDER BUTTON -- //

if ($_SERVER['QUERY_STRING'] == 'buy')
{
	$thankyou_page_url = str_replace($this_file, 'page.php?thankyou', $script_uri);
    ?>
<html><body <?php if ($debug != 1) { ?>onload="form1.submit()"<?php } ?>>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="8G8ND6UVAUDHY">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="Buy More Rewards Points">
<input type="hidden" name="item_number" value="<?php echo $user; ?>">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="notify_url" value="http://www.12daysoffun.com/hustle/center.php">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.12daysoffun.com/hustle/test">
<input type="hidden" name="cancel_return" value="http://www.12daysoffun.com/hustle/test/">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
<table>
<tr><td><input type="hidden" name="on0" value="Rewards Points">Rewards Points</td></tr><tr><td><select name="os0">
	<option value="3 Rewards  Points">3 Rewards  Points $0.99</option>
	<option value="8 Rewards  Points">8 Rewards  Points $1.99</option>
	<option value="21 Rewards  Points">21 Rewards  Points $5.00</option>
	<option value="42 Rewards  Points">42 Rewards  Points $10.00</option>
	<option value="85 Rewards  Points">85 Rewards  Points $20.00</option>
	<option value="170 Rewards  Points">170 Rewards  Points $40.00</option>
	<option value="215 Rewards  Points">215 Rewards  Points $50.00</option>
	<option value="440 Rewards  Points">440 Rewards  Points $100.00</option>
	<option value="700 Rewards  Points">700 Rewards  Points $150.00</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="option_select0" value="3 Rewards  Points">
<input type="hidden" name="option_amount0" value="0.99">
<input type="hidden" name="option_select1" value="8 Rewards  Points">
<input type="hidden" name="option_amount1" value="1.99">
<input type="hidden" name="option_select2" value="21 Rewards  Points">
<input type="hidden" name="option_amount2" value="5.00">
<input type="hidden" name="option_select3" value="42 Rewards  Points">
<input type="hidden" name="option_amount3" value="10.00">
<input type="hidden" name="option_select4" value="85 Rewards  Points">
<input type="hidden" name="option_amount4" value="20.00">
<input type="hidden" name="option_select5" value="170 Rewards  Points">
<input type="hidden" name="option_amount5" value="40.00">
<input type="hidden" name="option_select6" value="215 Rewards  Points">
<input type="hidden" name="option_amount6" value="50.00">
<input type="hidden" name="option_select7" value="440 Rewards  Points">
<input type="hidden" name="option_amount7" value="100.00">
<input type="hidden" name="option_select8" value="700 Rewards  Points">
<input type="hidden" name="option_amount8" value="150.00">
<input type="hidden" name="option_index" value="0">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php if ($debug != 1) { ?><h3 align="center">Please wait while we transfer you to Paypal.</h3><?php } ?>
<body>
</html>
<?php
    exit();
}


// assign posted variables to local variables
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['business'];
$payer_email = $_POST['payer_email'];

$download_page_url = str_replace($this_file, 'page.php?dl-'.$txn_id, $script_uri);

if ($debug == 1) {
	$fpx = fopen('ipnlog.txt', 'a');
	fwrite($fpx, "===================================\n");
	fwrite($fpx, "DOWNLOAD PAGE: $download_page_url\n\n");
	
	$ipn_log .= "===================================\n";
	$ipn_log .= "DOWNLOAD PAGE: $download_page_url\n\n";
}

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $req .= "&$key=$value";
}

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$fp = fsockopen ($paypal_ipn_url, 80, $errno, $errstr, 30);

if (!$fp)
{
    print "<b>Error Communicating with Paypal.<br>";
    $ipn_log .= "Error connecting to Paypal\n";
    if ($debug == 1) { fwrite($fpx, "Error connecting to Paypal\n"); }

}
else
{
    fputs ($fp, $header . $req);
    while (!feof($fp))
    {
        $res = fgets ($fp, 1024);
        if (strcmp ($res, "VERIFIED") == 0)
        {
	    $ipn_log .= "Paypal IPN VERIFIED\n";
	    if ($debug == 1) { fwrite($fpx, "Paypal IPN VERIFIED\n"); }

	if (trim($receiver_email) == '') { $receiver_email = $_POST['receiver_email']; }


	$ipn_log .= "\nPRODUCT DETAILS CHECK\n";
	$ipn_log .= "|$receiver_email| : |$paypal_email_address|\n";
	$ipn_log .= "|$payment_amount| : |$product_price|\n";
	$ipn_log .= "|$payment_currency| : |$price_currency\n";
	$ipn_log .= "|$payment_status| : |Completed|\n\n";

	if ($debug == 1) {
		fwrite($fpx, "\nPRODUCT DETAILS CHECK\n");
		fwrite($fpx, "|$receiver_email| : |$paypal_email_address|\n");
		fwrite($fpx, "|$payment_amount| : |$product_price|\n");
		fwrite($fpx, "|$payment_currency| : |$price_currency|\n");
		fwrite($fpx, "|$payment_status| : |Completed|\n\n");
	}
	

            if (
                ($receiver_email == $paypal_email_address) &&
                ($payment_amount == $product_price) &&
		($payment_currency == $price_currency) &&
		($payment_status == 'Completed')
            ) {
		$ipn_log .= "Paypal IPN DATA OK\n";
		if ($debug == 1) { fwrite($fpx, "Paypal IPN DATA OK\n"); }
		
		$expire_date = time() + ($expire_in_hours * 60 * 60);
                $ipx = create_download_file(
			array(
				'customer_name' => $_POST['first_name'].' '.$_POST['last_name'],
				'business_name' => $_POST['payer_business_name'],
				'customer_email' => $_POST['payer_email'],
				'txn_id' => $_POST['txn_id'],
				'expire_date' => $expire_date,
				'expire_time' => $expire_in_hours,
				'purchase_date' => $_POST['payment_date'],
				'purchase_amount' => $payment_amount,
				'download_page_url' => $download_page_url,
				'product_name' => $_POST['item_name']
			)
		);
		
		$ipn_log .= $ipx;
		if ($debug == 1) { fwrite($fpx, "$ipx\n"); }

		$ipx = send_customer_email(
			array(
				'from_email' => $support_email_address,
				'from_email_name' => $support_email_name,
				'customer_email' => $_POST['payer_email'],
				'email_subject' => $email_subject,
				'email_body' => $email_body,
				'customer_name' => $_POST['first_name'].' '.$_POST['last_name'],
				'download_page' => $download_page_url,
				'expire_in_hours' => $expire_in_hours,
				'product_name' => $product_name,
				'product_code' => $product_code,
				'expire_in_hours' => $expire_in_hours
			)
		);
		
		$ipn_log .= $ipx;
		if ($debug == 1) { fwrite($fpx, "$ipx\n"); }

            } else {
                print "<b>Purchase does not match product details.<br>";
		$ipn_log .= "Purchase does not match product details\n";
		if ($debug == 1) { fwrite($fpx, "Purchase does not match product details\n"); }
            }
        }
        else if (strcmp ($res, "INVALID") == 0)
        {
            print "<b>We cannot verify your purchase<br>";
		$ipn_log .= "INVALID: We cannot verify your purchase\n";		
		if ($debug == 1) { fwrite($fpx, "INVALID: We cannot verify your purchase\n"); }
        }
    }
    fclose ($fp);
}

$ipn_log .= "\nPOST DATA\n";
if ($debug == 1) { fwrite($fpx, "\nPOST DATA\n"); }

foreach ($_POST as $key => $value)
{
	$ipn_log .= "$key: $value\n";
	if ($debug == 1) { fwrite($fpx, "$key: $value\n"); }
}

if ($debug == 1) {
	fclose($fpx);
	echo "<h3>Debug Mode. Here are IPN data and transaction result.</h3>\n";
	echo "<pre>\n";
	echo $ipn_log;
	echo "</pre>\n";
}
?>