<?php
include('config.php');
$per_page = 10; 

//Calculating no of pages
$sql = "SELECT COUNT(*) FROM arcade_games WHERE categoryid = '10' ";
$result = mysql_query($sql);
list($count) = mysql_fetch_row($result);
$pages = ceil($count/$per_page);
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
		
	//Display Loading Image
	function Display_Load()
	{
	    $("#loading13").fadeIn(900,0);
		$("#loading13").html("<img src='bigLoader.gif' />");
	}
	//Hide Loading Image
	function Hide_Load()
	{
		$("#loading13").fadeOut('slow');
	};
	

   //Default Starting Page Results   
	$("#pagination li:first").css({'color' : '#FF0084'}).css({'border' : 'none'});	
	Display_Load();
	$("#content13").load("../arcade/pagination_data.php?page=1", Hide_Load());


	//Pagination Click
	$("#pagination li").click(function(){
			
		Display_Load();
		
		//CSS Styles
		$("#pagination li")
		.css({'border' : 'solid #dddddd 1px'})
		.css({'color' : '#0063DC'});
		
		$(this)
		.css({'color' : '#FF0084'})
		.css({'border' : 'none'});

		//Loading Data
		var pageNum = this.id;
		$("#content13").load("../arcade/pagination_data.php?page=" + pageNum, Hide_Load());
	});
</script>

<style>
#loading13
{ 
width: 100%; 
position: absolute;
}
li
{ 
list-style: none; 
float: left; 
margin-right: 16px; 
padding:5px; 
border:solid 1px #dddddd;
color:#0063DC; 
}
li:hover
{ 
color:#FF0084; 
cursor: pointer; 
}
</style>
<body>
<div id="loading13" ></div>
<div id="content13" ></div>
<ul id="pagination">
<?php
//Pagination Numbers
for($i=1; $i<=$pages; $i++)
{
echo '<li id="'.$i.'">'.$i.'</li>';
}
?>
</ul>
</body>