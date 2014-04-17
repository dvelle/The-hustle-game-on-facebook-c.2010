
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
 
<link rel="stylesheet" type="text/css" href="ajaxtabs.css" /> 
 
<script type="text/javascript" src="js/ajaxtabs.js"> 
 
/***********************************************
* Ajax Tabs Content script v2.2- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/
 
</script> 
<style type="text/css">
<!--
img {
	border: none;
}
#inner_page {
	width: 750px;
	margin-right: auto;
	margin-left: auto;
	background-image: url(../graphics/hustle_bk_bottom.png);
	height: 404px;
}
#inner_page #browser #ArcadePanels .TabbedPanelsContentGroup .TabbedPanelsContent.TabbedPanelsContentVisible {
	height: 281px;
	overflow: scroll;
}
#countrydivcontainer{
	border:1px solid gray; 
	width:715px; 
	height:280px; 
	margin-bottom: 1em; 
	padding: 10px;
	background-image:url(../graphics/gray_bk_bot.png)
}
.tabcontentiframe{
height: 280px !important;
}
-->
</style>
</head> 
 
<body>
<div id="inner_page">
  <div id="browser" style="padding: 5px">
<ul id="countrytabs" class="shadetabs"> 
<li><a href="../arcade/category1.php" class="selected" rel="#iframe">Misc</a></li>
<li><a href="../arcade/category2.php" rel="#iframe">Action</a>
<li><a href="../arcade/category3.php" rel="#iframe">Shooting</a></li> 
<li><a href="../arcade/category4.php" rel="#iframe">Sports</a></li> 
<li><a href="../arcade/category5.php" rel="#iframe">Racing</a></li>
<li><a href="../arcade/category6.php" rel="#iframe">Memory</a></li>
<li><a href="../arcade/category7.php" rel="#iframe">Casino</a></li>
<li><a href="../arcade/category8.php" rel="#iframe">Strategy</a></li>
<li><a href="../arcade/category9.php" rel="#iframe">Classics</a></li>
<li><a href="../arcade/category10.php" rel="#iframe">Clsc Clones</a></li>
<li><a href="../arcade/category11.php" rel="#iframe">Puzzle/Strategy</a></li>
<li><a href="../arcade/category12.php" rel="#iframe">Random</a></li>
</ul> 

<div id="countrydivcontainer"> 
<p>This is some default tab content, embedded directly inside this space and not via Ajax. It can be shown when no tabs are automatically selected, or associated with a certain tab, in this case, the first tab.</p> 
</div>
</div> 
</div>
 
<script type="text/javascript"> 
 
var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
 
</script> 
</body> 