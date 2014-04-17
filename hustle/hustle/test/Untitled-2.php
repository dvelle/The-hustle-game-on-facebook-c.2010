<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Hustle</title>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
 	$("#example").tabs();					   
});
</script>

</head>
<body>

<div id="example">
     <ul>
         <li><a href="#first-tab"><span>Content 1</span></a></li>
         <li><a href="../arcade/category1.php"><span>Content 2</span></a></li>
         <li><a href="#third-tab"><span>Content 3</span></a></li>
     </ul>
	 
	 <div id="first-tab">
	 This is the first tab.
	 </div>

	 <div id="third-tab">
	 This is the third tab.
	 </div>

</div>

</body>
</html>