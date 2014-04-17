<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" 
	"http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Ajax Loader - Simplified Version</title>
	<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.history.js"></script>

	<script type="text/javascript">
$(document).ready(function () {
	
	//Check if url hash value exists (for bookmark)
	$.history.init(pageload);	
	    
	//highlight the selected link
	$('a[href=' + document.location.hash + ']').addClass('selected');
	
	//Seearch for link with REL set to ajax
	$('a[rel=ajax]').click(function () {
		
		//grab the full url
		var hash = this.href;
		
		//remove the # value
		hash = hash.replace(/^.*#/, '');
		
		//for back button
	 	$.history.load(hash);	
	 	
	 	//clear the selected class and add the class class to the selected link
	 	$('a[rel=ajax]').removeClass('selected');
	 	$(this).addClass('selected');
	 	
	 	//hide the content and show the progress bar
	 	$('#content').hide();
	 	$('#loading').show();
	 	
	 	//run the ajax
		getPage();
	
		//cancel the anchor tag behaviour
		return false;
	});	
});
	

function pageload(hash) {
	//if hash value exists, run the ajax
	if (hash) getPage();    
}
		
function getPage() {
	
	//generate the parameter for the php script
	var data = 'page=' + encodeURIComponent(document.location.hash);
	$.ajax({
		url: "loader.php",	
		type: "GET",		
		data: data,		
		cache: false,
		success: function (html) {	
		
			//hide the progress bar
			$('#loading').hide();	
			
			//add the content retrieved from ajax and put it in the #content div
			$('#content').html(html);
			
			//display the body with fadeIn transition
			$('#content').fadeIn('slow');		
		}		
	});
}
	</script>
	
	<style>		
	#loading {
		background: url(images/load.gif) no-repeat;
		display:none;
	}
			
	#content {
		font-family:arial;
		font-size:11px;
	}		
	</style>
	
</head>
<body>


<ul id="menu">
	<li><a href="#page1" rel="ajax">Page 1</a></li> 
	<li><a href="#page2" rel="ajax">Page 2</a></li> 
	<li><a href="#page3" rel="ajax">Page 3</a></li>
	<li><a href="#page4" rel="ajax">Page 4</a></li>
</ul>

<div id="loading"></div>

<div id="content">
<!-- Ajax Content -->
</div>
	

</body>
</html>