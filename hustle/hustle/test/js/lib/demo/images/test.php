<?php
session_start();
ob_start();

//EDIT these 4 variables
$per_page = 10; //rows per page
$db_name = "btr_the_hunt"; //database name
$table_name = "arcade_games"; //table name
$order_by = "id"; //sorting column - as in the table

//EDIT these 3 variables for connection
$hostname = "btr_the_hunt.db.3640907.hostedresource.com";
$username = "btr_the_hunt";
$passwd = "Jgreen87!";

//Connect to db
mysql_select_db($db_name,mysql_connect($hostname,$username,$passwd));
//getting number of rows and calculating no of pages
$sql = "select * from $table_name";
$rsd = mysql_query($sql);
$count = mysql_num_rows($rsd);
$pages = ceil($count/$per_page)
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>Ajax Load Table - Pagination -  yensdesign.com</title>
<style>
body { margin: 0; padding: 0; font-family:Verdana; font-size:10px }
#loading { width: 100%; position: absolute; text-align: center; font-family:Trebuchet MS; font-size:12px; color:#008000; font-weight:bold }
li{	list-style: none; float: left; margin-right: 16px; text-transform: uppercase;	color: #c2c2c2; }
li:hover{ color: #6fa5fd; cursor: pointer; }
</style>
</head>
<body>
	<div align="center">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" id="table1">
			<tr>
				<td>
				<ul id="menu">
				<?php
				//Show page links
				for($i=1; $i<=$pages; $i++)
				{
					echo '<li id="'.$i.'">'.$i.'</li>';
				}
				?>
				</ul>
				</td>
			</tr>
			<tr>
				<td>
				<div id="loading" style="position: absolute;">
					LOADING...
				</div>
				</td>
			</tr>
			<tr>
				<td>
				<div id="content" style="height: 200px;"></div>
				<form id="myForm">
					<input type="hidden" name="per_page" id="per_page" value="<?=$per_page?>" />
					<input type="hidden" name="db_name" id="db_name" value="<?=$db_name?>" />
					<input type="hidden" name="table_name" id="table_name" value="<?=$table_name?>" />
					<input type="hidden" name="order_by" id="order_by" value="<?=$order_by?>" />
					<input type="hidden" name="hostname" id="hostname" value="<?=$hostname?>" />
					<input type="hidden" name="username" id="username" value="<?=$username?>" />
					<input type="hidden" name="passwd" id="passwd" value="<?=$passwd?>" />
				</form>
				</td>
			</tr>
		</table>
	</div>
	<script type="text/javascript" src="jquery-1.2.6.min.js"></script>
	<script type="text/javascript" src="paging.js"></script>
</body>
</html>
</body>