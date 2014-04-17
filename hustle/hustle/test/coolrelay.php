<?php
include 'connect.php';
include 'stats.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//COOL POINT ADJUSTER
function coolpoint_adjuster($userID,$math,$adjusted){
	$current_cool = getStat('exp',$userID);
	if($math == "add"){
		$cool = $current_cool + $adjusted;
		$complete = setStat('exp',$userID,$cool);
	} else {
		//check adjusted cool against assets make sure not lower than assets allow
		$wealth_barrier = assets_valuation($userID);
		$variable_c = $current_cool - $wealth_barrier;
		if($variable_c < 0){
			return;
		}
		// Deduct
		$cool = $current_cool - $variable_c;
		$complete = setStat('exp',$userID,$cool);
	}
	return;
}
?>