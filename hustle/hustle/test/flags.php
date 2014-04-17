<?
$i = 1;
while($i <= 61){
	$value = $i;
	echo "<br/>";
	echo "<img src='http://www.12daysoffun.com/hustle/file/pic/crew/flags/".$value.".jpg' />";
	?><input name="flag" id="bullseye" type="radio" value="<?php echo $value.".jpg";?>"/>
	<?
	echo "<br/>";
	$i++;
}
?>