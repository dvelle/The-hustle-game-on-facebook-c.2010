<div id="men">
<?

$i = 20;
while($i <= 28){
	$value = $i;
	echo "<br/>";
	echo "<img src='http://www.12daysoffun.com/hustle/file/pic/avatar/".$value.".jpg' />";
	?><input name="target" id="bullseye" type="radio" value="<?php echo $value;?>"/>
	<?
	echo "<br/>";
	$i++;
}
?>
</div>

<div id="women">
<?

$i = 1;
while($i <= 14){
	$value = $i;
	echo "<br/>";
	echo "<img src='http://www.12daysoffun.com/hustle/file/pic/avatar/".$value.".jpg' />";
	?><input name="target" id="bullseye" type="radio" value="<?php echo $value;?>"/>
	<?
	echo "<br/>";
	$i++;
}
?>
</div>
