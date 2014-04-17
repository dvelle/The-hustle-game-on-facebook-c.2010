<?php
include('config.php');
$per_page1 = 10; 

//Calculating no of pages
$sql1 = "SELECT COUNT(*) FROM arcade_games WHERE categoryid = '2' ";
$result1 = mysql_query($sql1);
list($count1) = mysql_fetch_row($result1);
$pages = ceil($count1/$per_page1);
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
		
	//Display Loading Image
	function Display_Load()
	{
	    $("#loading").fadeIn(900,0);
		$("#loading").html("<img src='bigLoader.gif' />");
	}
	//Hide Loading Image
	function Hide_Load()
	{
		$("#loading").fadeOut('slow');
	};
	

   //Default Starting Page Results   
	$("#pagination li:first").css({'color' : '#FF0084'}).css({'border' : 'none'});	
	Display_Load();
	$("#content22").load("../arcade/pagination_data2.php?page=1", Hide_Load());


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
		$("#content22").load("../arcade/pagination_data2.php?page=" + pageNum, Hide_Load());
	});
</script>

<style>
#loading
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

<div id="loading" ></div>
<div id="content22" ></div>
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