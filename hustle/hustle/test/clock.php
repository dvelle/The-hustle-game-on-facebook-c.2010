<html>
<head>
<title></title>
<script language="JavaScript">
<!--
// ask.metafilter.com/63799/Time-left-in-the-title
var timerID = 0;
var tStart  = null;
var msRefresh = 1000;
var startTimeObject = new Object();
var minutesTotal = 0;
var msTotal = 0;
var alertString = '';

function initTimer() {
  startTimeObject = document.getElementById ?
	document.getElementById("started") : document.all.started;
  donateBlock = document.getElementById ?
	document.getElementById("donate") : document.all.donate;
  hideBlock = document.getElementById ?
	document.getElementById("pleaseconsider") : document.all.pleaseconsider;
  thanksBlock = document.getElementById ?
	document.getElementById("kindpeople") : document.all.kindpeople;

  var args = getArguments();
  minutesTotal = (args.minutes) ? parseFloat(args.minutes) : get_cookie('minutes');
  //minutesTotal = get_cookie('minutes');
  if (minutesTotal.length <= 0){
    minutesTotal = 60;
  } else {
    document.adjustTimer.minutes.value = minutesTotal;
  }
  msTotal = (60000 * minutesTotal);
  alertString = minutesTotal + ' minute(s) are up';
  resetTimer();
  goTimer();
}

function setMinutes() {
  minutesTotal = document.adjustTimer.minutes.value;
  document.cookie = "minutes=" + minutesTotal;
  msTotal = (60000 * minutesTotal);
  alertString = minutesTotal + ' minutes are up';
  resetTimer();
  goTimer();
}

function getArguments() {
  var args = new Object();
  window.location.search.replace(
    new RegExp( "([^?=&]+)(=([^&]*))?","g"), function($0,$1,$2,$3){
      args[$1] = $3;
    }
  );
  return args;
}

function get_cookie(cookieName) {
  var search = cookieName + '=';
  var returnvalue = '';
  if (document.cookie.length > 0) {
    offset = document.cookie.indexOf(search);
    if (offset != -1) { // if cookie exists
      offset += search.length
      end = document.cookie.indexOf(';', offset);
      if (end == -1) end = document.cookie.length;
      returnvalue=unescape(document.cookie.substring(offset,end));
    }
  }
  return returnvalue;
}

function UpdateTimer() {
   if (timerID) clearTimeout(timerID);
   if (!tStart) {
     tStart = new Date();
     startTimeObject.innerHTML = 'started at: ' + tStart; 
   }
   var tDate = new Date();				//get time now
   var tDiff = tDate.getTime() - tStart.getTime();	//ms since start
   var tLeft = (msTotal - tDiff) / 1000;		//secs remaining
   if (tLeft <= 0) {
     if (document.adjustTimer.alertme.checked) {
       alert(alertString);
     }
     document.theTimer.countdown.value = '00:00';
     document.title = '00:00';
   } else {
     var theMins = Math.floor(tLeft / 60);
     var theSecs = Math.floor(tLeft % 60);
     if (theMins < 10) theMins = '0' + theMins;
     if (theSecs < 10) theSecs = '0' + theSecs;
     document.theTimer.countdown.value = theMins + ':' + theSecs;
     document.title = theMins + ':' + theSecs;
   
     timerID = setTimeout("UpdateTimer()", msRefresh);
  }
}

function goTimer() {
   if (!tStart) {
     tStart = new Date();
     startTimeObject.innerHTML = 'started at: ' + tStart; 
   }
   timerID  = setTimeout("UpdateTimer()", msRefresh);
}

function resetTimer() {
   if (timerID) clearTimeout(timerID);
   tStart = null;
   document.adjustTimer.minutes.value = minutesTotal;
   goTimer();
}

function cleanExit() {
   if(timerID) { clearTimeout(timerID); timerID  = 0; }
}

function hideDonate() {
  donateBlock.style.display = 'none';
  hideBlock.style.display = 'block';
}

function showDonate() {
  donateBlock.style.display = 'block';
  hideBlock.style.display = 'none';
}

function hideThanks() {
  thanksBlock.style.display = 'none';
}
function showThanks() {
  thanksBlock.style.display = 'block';
}


//-->
</script>
<style type="text/css"><!--
div.timer { width:320px; font:bold 15px Verdana; padding:.5em .5em; margin-bottom:1em; }
div#title { border: 2px solid #141430; background-color:#000014;}
div#adjuster { background-color:transparent; }
div#timer { border: 2px solid #40404C; background-color:#202028; }
div#started { font-size:.8em; font-weight:normal; }
div#donate { border: 2px solid #141430; background-color:#000014;}
div#pleaseconsider { border: 2px solid #0c0c28; background-color:#00001c;}
div#pleaseconsider a {font-size:.6em; font-weight:normal; color:#43435a;}
div.small {margin-top:.5em;}
.small {font-size:.6em; font-weight:normal;color:#43435a;}
.small a {color:#43435a;}
.credit {position: absolute; bottom: 0px; right: 0px; z-index: 99;}
.credit, .credit a { font: 9px Verdana, sans-serif; color: #8080A0; }
--></style>
</head>
<body onload="initTimer();" onunload="cleanExit();" bgcolor="#000020" text="#8080A0">
<table width="100%" height="95%" border="0"><tr><td align="center" valign="middle">

<div class="timer" id="title">
&larr; countdown timer &rarr;
<div class="small">a simple browser-based egg timer.</div>
<div class="small">enter a number of minutes to count down, and "go". the 
running time will be displayed in the browser title bar (or tab).
cross-platform, does just what it says it will. enjoy.</div>
</div>


<div class="timer" id="adjuster">
<form name="adjustTimer" onSubmit="setMinutes();return false;blur();">
<p>minutes to count down:
<input type="text" name="minutes" value="60" size=5 maxlength=3>
<input type="button" name="go" value="go" onClick="setMinutes();"></p>
<p style="width:300px; text-align:right; font-size:0.8em;">alert me? 
<input type="checkbox" 
name="alertme" value="1" checked></p>
</form>
</div>

<div class="timer" id="timer">
<form name="theTimer">
<div id="started" name="started">started at: </div><br>
<p>minutes remaining: 
  <input type="text" value="00:00" name="countdown" size=5 onFocus="blur();">
<input type="button" name="reset" value="reset" onClick="resetTimer();"></p>
</form>
</div>

<div class="timer" id="donate">
<table border="0" cellpadding="0" cellspacing="0"><tr><td class="small">
thank you for visiting! i first put up this page to help a fellow <a 
href="http://ask.metafilter.com/63799/Time-left-in-the-title" 
target="_blank">ask.metafilter</a> user, and i'm glad to know that so
many people around the world are using it. i'm just a proverbial starving 
<a href="http://myrrhmusic.com/" target="_blank">artist</a>, so <em>please</em>,
consider donating (any small amount helps!) to help offset my hosting 
expenses. thank you!</td>
<td align="right" valign="bottom" class="small">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="paypal@myrrhmusic.com">
<input type="hidden" name="item_name" value="i think the countdown timer is just swell, thank you!">
<input type="hidden" name="buyer_credit_promo_code" value="">
<input type="hidden" name="buyer_credit_product_category" value="">
<input type="hidden" name="buyer_credit_shipping_method" value="">
<input type="hidden" name="buyer_credit_user_address_change" value="">
<input type="hidden" name="no_shipping" value="0">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="tax" value="0">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="bn" value="PP-DonationsBF">
<input type="image" src="timer-paypal.gif" hspace="2"
 width="62" height="31" border="0" name="submit"
 alt="Make payments with PayPal - it's fast, free and secure!"
 style="vertical-align:bottom;">
<!img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form><br>
<a href="#" onClick="hideDonate();">(hide)</a></td></tr></table></div>

<div class="timer" id="pleaseconsider" style="display:none;">
<a href="#" onClick="showDonate();">(please consider helping me out - click for more info)</a>
</div>
</td></tr></table>


<div class="credit" align="right">
  <div id="kindpeople" style="display:none;">
  original <a href="http://ask.metafilter.com/63799/Time-left-in-the-title" 
target="_blank">ask.metafilter.com</a> post<br>
  linked on <a href="http://lifehacker.com/software/timer/title-bar-browser-timer-305058.php"
target="_blank">lifehacker</a> 01-oct-2007<br>
  <a href="http://www.thesavvyboomer.com/the_savvy_boomer/2007/10/countdown-timer.html"
target="_blank">the savvy boomer</a> 02-oct-2007<br>
  <a href="http://d.hatena.ne.jp/feedtailor/20071002"
target="_blank">haetana</a> (japan) 02-oct-2007<br>
  <a href="http://www.downloadblog.it/post/4848/un-timer-nella-tab-e-nella-barra-del-titolo-del-browser"
target="_blank">downloadblog</a> (italy) 02-oct-2007<br>
  <a href="http://dayray.org/" target="_blank">danray.org</a> 03-oct-2007<br>
  <a href="http://pea-nuts.org/2007/10/04/web-timer/"
target="_blank">nutspress</a> (japan) 04-oct-2007<br>
  <a href="http://pocitace.sme.sk/c/3522532/Tipy-na-vikendove-surfovanie.html"
target="_blank">sme: pocitace</a> (slovakia) 06-oct-2007<br>
  <a href="http://www.bookofjoe.com/2007/10/countdown-timer.html"
target="_blank">the bookofjoe</a> 11-oct-2007<br>
  <a href="http://www.ideaxidea.com/archives/2007/10/post_240.html"
target="_blank">idea*idea</a> (japan) 14-oct-2007<br>
  <a href="http://www.devilbatghost.com/article/60873182.html"
target="_blank">genk blog</a> (Japan) 16-oct-2007<br>
  and <a href="http://technodigits.wordpress.com/2007/10/18/countdown-timer-for-hanging-on-the-pc/"
target="_blank">technodigits</a> 18-oct-2007.<br>

  let me know if you put up a link!
  <a href="#" onClick="hideThanks();">(hide)</a><br><br>
  </div>
<span style="text-decoration: line-through;">dumb</span> simple javascript countdown timer.
<a rel="license" 
href="http://creativecommons.org/licenses/by/3.0/" target="_blank">cc-by</a> 
<a href="http://www.theinsomniacsociety.com/" target="_blank">m 
larsen</a> 2007. <span id="showlinks"><a href="#" onClick="showThanks();">(thank you)</a></span>
</div>

</body>
</html>