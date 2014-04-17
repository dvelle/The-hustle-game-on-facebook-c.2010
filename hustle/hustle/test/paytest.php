<script type="text/javascript">
// set this to the id of the blackbox hidden input field
var io_bbout_element_id = "blackbox";
// need to set this to the id of the form to submit to buyswitch.php
var buy_form_id = "paypal_interstitial";

// iovation        
var io_install_stm = false;
var io_exclude_stm = 12;
var io_operation = "ioBegin";
var blackbox_value;
var nojs = false;                                   

window.onload = function() {
    io_soap(0);
}

function io_soap(pass) {
    var blackbox = document.getElementById(io_bbout_element_id);
    if (blackbox.value == '') {
        if (pass < 30) {
            setTimeout( 'io_soap('+(pass + 1)+')', 100 );
        } else {
            // timeout error
            nojs = true;
            redirect_from_interstitial();
        }
    } else {
        blackbox_value = blackbox.value;
        redirect_from_interstitial();
    }
}

function redirect_from_interstitial () {
    var form = document.getElementById(buy_form_id);
	// form.target = "_blank";
    form.submit();
	
}
// function rerender () {
// 	window.location = "";
// }
</script>
<script type="text/javascript" src="https://mpsnare.iesnare.com/snare.js"></script>


<form method="POST" id="paypal_interstitial" action="/zbillr/paypal/checkout" >
    <input type="hidden" id="blackbox" name="blackbox" value="" />
    <input type="hidden" name="zugid" value="1:503600754:43:20100520012118:ddb7afa781af00c2f4276be23b233f2f" />
    <input type="hidden" name="aid" value="1" />
    <input type="hidden" name="provider_id" value="3" />
    <input type="hidden" name="pkg_id" value="551" />

    
        <input id="authenticity_token" name="authenticity_token" type="hidden" value="MTWfMFDlacRONa8BVi1jsiGM2TRwAf6dJkzwMT6HLWE=" />
    
</form>

<div style="text-align:center; margin: 250 auto;font-family:arial">
	<p>Redirecting you to PayPal.</p>
    <img alt="Spinner" src="/zbillr/images/spinner.gif?1273794302" />
	<p>Please wait.</p>
</div>