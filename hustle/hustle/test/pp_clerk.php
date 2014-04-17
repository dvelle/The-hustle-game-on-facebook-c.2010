<?php

$user = $_POST['customer'];
//$user = "jermongreen";
$price = $_POST['order'];

//$price = 40.00;
$debug = 1;
$paypal_sandbox = 2;  // 1 for test more, 0 for production mode
$paypal_email_address = 'jermon.green@bethereondemand.com';  // your paypal email address
$support_email_address = 'support@betheresmg.com';   // your email address for support
$support_email_name = 'The Hustle - Support Team';   // name to appear in the From when email is sent

$product_name = 'Rewards Points';   // Product name, will appear in Paypal
$product_code = 'SPL101';   // Code, will appear in Paypal
$product_price = $price;   // product price, will appear in Paypal
$price_currency = 'USD';    // currency, Paypal only supports
                            // AUD CAD EUR GBP JPY USD NZD CHF HKD
                            // SGD SEK DKK PLN NOK HUF CZK ILS MXN

$email_subject = 'Your Rewards Point Purchase'; // subject line for your email

// email body. you cannot have anything, even blank spaces after EOT

$email_body = <<<EOT

Thank you for purchasing Hustle - Rewards Points.

Should you need any assistance, just reply to this email.


The Hustle - Support Team
BeThereSMG

EOT;

// ALL DONE!!

if ($paypal_sandbox == 1) {
	$paypal_url = "www.sandbox.paypal.com/cgi-bin/webscr";
	$paypal_ipn_url = "www.sandbox.paypal.com";
}
else {
	$paypal_url = "www.paypal.com/cgi-bin/webscr";
	$paypal_ipn_url = "www.paypal.com";
} 

$script_uri = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$notices = "http://www.12daysoffun.com/hustle/center.php";

// -- GENERATING THE PAYPAL ORDER BUTTON -- //

    ?>
<html><body <?php if ($debug != 1) { ?>onload="form1.submit()"<?php } ?>>
<form name="form1" action="https://<?php echo $paypal_url ?>" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo $paypal_email_address; ?>">
<input type="hidden" name="item_name" value="<?php echo $user; ?>">
<select name="order" size="1" id="order">
                        <option value="0.99">3 rewards points | $0.99</option>
                        <option value="1.99">8 rewards points | $1.99</option>
                        <option value="5.00">21 rewards points | $5</option>
                        <option value="10.00" selected="selected">42 rewards points | $10</option>
                        <option value="20.00">85 rewards points | $20</option>
                        <option value="40.00">170 rewards points | $40</option>
                        <option value="50.00">215 rewards points | $50</option>
                        <option value="100.00">440 rewards points | $100</option>
                        <option value="150.00">700 rewards points | $150</option>
                      </select>
<input type="hidden" name="item_number" value="<?php echo $user; ?>">
<input type="hidden" name="amount" value="<?php echo $product_price; ?>">
	
<?php if ($debug == 1) { ?><input type="hidden" name="return" value="<?php echo $script_uri; ?>">
<?php } ?>

<input type="hidden" name="notify_url" value="<?php echo $notices; ?>">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="<?php echo $price_currency; ?>">
<input type="hidden" name="rm" value="2">

<?php if ($debug == 1) { ?>
<h3 align="center">Debug Mode. View Source to See Paypal Button Form.</h3>
<input type="submit" value="Click To Proceed To Paypal">
<?php } ?>	
	
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php if ($debug != 1) { ?><h3 align="center">Please wait while we transfer you to Paypal.</h3><?php } ?>
</html>
<?php
    exit();
?>

 