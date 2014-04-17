<?php
$mysql_hostname = "btr_the_hunt.db.3640907.hostedresource.com";
$mysql_user = "btr_the_hunt";
$mysql_password = "Jgreen87!";
$mysql_database = "btr_the_hunt";

$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");

?>