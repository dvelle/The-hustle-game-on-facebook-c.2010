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
<script type="text/javascript" src="jquery_pagination.js"></script>

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
<div id="loading" ></div>
<div id="content" ></div>
<ul id="pagination">
<?php
//Pagination Numbers
for($i=1; $i<=$pages; $i++)
{
echo '<li id="'.$i.'">'.$i.'</li>';
}
?>
</ul>