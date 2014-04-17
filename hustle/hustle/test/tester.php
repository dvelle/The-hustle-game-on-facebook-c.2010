<meta charset="UTF-8" />
	
	
<!DOCTYPE html>
<html>
<head>
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  
 <script type="text/javascript">
	$(function() {
		$("#tabs").tabs({
			ajaxOptions: {
				error: function(xhr, status, index, anchor) {
					$(anchor.hash).html("Couldn't load this tab. We'll try to fix this as soon as possible. If this wouldn't be a demo.");
				}
			}
		});
	});
	</script>



<div class="demo">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Preloaded</a></li>
		<li><a href="ajaxfiles/external.php">Tab 1</a></li>
		<li><a href="ajaxfiles/external2.htm">Tab 2</a></li>
		<li><a href="ajaxfiles/external3.htm">Tab 3 (slow)</a></li>
		<li><a href="ajaxfiles/ferrari.jpg">Tab 4 (broken)</a></li>
	</ul>
	<div id="tabs-1">
		<p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
	</div>
</div>

</div><!-- End demo -->

<div class="demo-description">

<p>Fetch external content via Ajax for the tabs by setting an href value in the tab links.  While the Ajax request is waiting for a response, the tab label changes to say "Loading...", then returns to the normal label once loaded.</p>

<p>Tabs 3 and 4 demonstrate slow-loading and broken AJAX tabs, and how to handle serverside errors in those cases. Note: These two require a webserver to interpret PHP. They won't work from the filesystem.</p>
</div><!-- End demo-description -->