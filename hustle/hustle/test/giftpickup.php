<?php
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_POST['who'];
//$user = "jermongreen";
$cid = $_POST['crew'];
$item = $_POST['item'];


//functions
function item_name($id){
	$j_query = sprintf("SELECT name FROM h_special_items WHERE id = '%s'",
						  mysql_real_escape_string($id));
			$egg = mysql_query($j_query);
	list($item) = mysql_fetch_row($egg);
	return $item;
}
//get user stats
$query = sprintf("SELECT * FROM h_users WHERE user = ('%s')",
		mysql_real_escape_string ($user));
$result = mysql_query($query);
$user_ar = mysql_fetch_assoc($result);
$user_ID = $user_ar["id"];

//Who was giver?
$fuery = sprintf("SELECT user FROM h_crew_gift WHERE gift = '%s' AND recipient = 												 				'%s' AND crew_id = '%s'",
					  mysql_real_escape_string($item),
					  mysql_real_escape_string($user),
					  mysql_real_escape_string($cid));
$result = mysql_query($fuery);
list($giver) = mysql_fetch_row($result);

$fuery = sprintf("SELECT id FROM h_users WHERE user = '%s'",
					  mysql_real_escape_string($giver));
$result = mysql_query($fuery);
list($giver_id) = mysql_fetch_row($result);

//what is the item?
	$w_query = sprintf("SELECT id FROM h_arsenal WHERE name = '%s' OR short_name = 												 				'%s'",
					  mysql_real_escape_string($item),
					  mysql_real_escape_string($item));
	$weapons = mysql_query($w_query);
	list($gun_id) = mysql_fetch_row($weapons);
	
	$w_query = sprintf("SELECT id FROM h_muscle WHERE name = '%s' OR short_name = 												 				'%s'",
					  mysql_real_escape_string($item),
					  mysql_real_escape_string($item));
	$muscle = mysql_query($w_query);
	list($gift_id) = mysql_fetch_row($muscle);
	
	$a_query = sprintf("SELECT id FROM h_assets WHERE name = '%s' OR short_name = 												 				'%s'",
						  mysql_real_escape_string($item),
				 		 mysql_real_escape_string($item));
	$house = mysql_query($a_query);
	list($house_id) = mysql_fetch_row($house);
	//blue magic distribute to crew
	$i_query = sprintf("SELECT id FROM h_illegal_goods WHERE name = '%s' OR short_name = 												 				'%s'",
						  mysql_real_escape_string($item),
				 		 mysql_real_escape_string($item));
	$good = mysql_query($i_query);
	list($good_id) = mysql_fetch_row($good);
	
	$i_query = sprintf("SELECT id FROM h_special_items WHERE name = '%s'",
						  mysql_real_escape_string($item),
				 		 mysql_real_escape_string($item));
	$egg = mysql_query($i_query);
	list($egg_id) = mysql_fetch_row($egg);

if($_POST['decision'] == "Decline") {
	
	$sql = sprintf("DELETE FROM `h_crew_gift` WHERE `crew_id` = '%s' AND `recipient` = '%s' AND `gift` = '%s'",
						mysql_real_escape_string($cid),
						mysql_real_escape_string($user),
						mysql_real_escape_string($item));
	$result=mysql_query($sql);
	//Return to giver
	if(!empty($gun_id)){
		$currentq = getArsenal($item,$giver_id);
		$newq = $currentq + amount;
		SetArsenal($item,$giver_id,$newq);
	}elseif(!empty($gift_id)){
		$currentq = getMuscle($item,$giver_id);
		$newq = $currentq + amount;
		SetMuscle($item,$giver_id,$newq);
	}elseif(!empty($house_id)){
		$currentq = getAssets($item,$giver_id);
		$newq = $currentq + amount;
		SetAssets($item,$giver_id,$newq);		
		//subtract cool points from giver
		$coolman = getStat("exp",$giver_id);
		$value = cp_val($item);
		$boost = $coolman + $value;
		setStat("exp",$giver_id,$boost);		
	}elseif(!empty($good_id)){
		if($good_id == 51){
			$item = "magic";
			$stash = getGoods($item,$giver_ID);
			$grab = $stash + $amount;
			setGoods($item,$user_ID,$grab);
		}else($good_id == 52){
			$item = "dvd";
			$stash = getGoods($item,$giver_ID);
			$grab = $stash + $amount;
			setGoods($item,$user_ID,$grab);
		}
	}elseif(!empty($egg_id)){
		$j_query = sprintf("SELECT cp_value FROM h_special_items WHERE id = '%s'",
						  mysql_real_escape_string($egg_id));
		$egg = mysql_query($j_query);
		list($cp_value) = mysql_fetch_row($egg);
		
		$coolman = getStat("exp",$user_ID);
		$ooo = $cp_value * $amount;
		$drop = $coolman + $ooo;
		setStat("exp",$user_ID,$boost);	
		
		//weapon
		$j_query = sprintf("SELECT quantity FROM h_user_assets WHERE id = '%s'",
					  mysql_real_escape_string($egg_id));
		$egg = mysql_query($j_query);
		list($quantity) = mysql_fetch_row($egg);
		if(!empty($quantity)){
			$quantity = $quantity + $amount;
			$query = sprintf("UPDATE h_user_arsenal SET quantity = '%s' WHERE arsenal_id = ('%s') AND user_id = ('%s')",
				mysql_real_escape_string($quantity),
				mysql_real_escape_string($egg_id),
				mysql_real_escape_string($user_ID));
			mysql_query($query);
		} else {
			$j_query = sprintf("SELECT quantity FROM h_user_arsenal WHERE id = '%s'",
					  mysql_real_escape_string($egg_id));
			$egg = mysql_query($j_query);
			list($quantity) = mysql_fetch_row($egg);
			$quantity = $quantity + $amount;
			$query = sprintf("UPDATE h_user_arsenal SET quantity = '%s' WHERE arsenal_id = ('%s') AND user_id = ('%s')",
				mysql_real_escape_string($quantity),
				mysql_real_escape_string($egg_id),
				mysql_real_escape_string($user_ID));
			mysql_query($query);
		}
	}
	//
	$recipient_message = ucwords($user)." <b>rejected</b> your ".ucwords($item)." gift!";
	//
	fin_reporter($giver,1,$recipient_message,"recipient");
	echo 2;
} elseif($_POST['decision'] == "Accept") {	
	if(!empty($gun_id)){
		$currentq = getArsenal($item,$user_ID);
		$newq = $currentq + amount;
		SetArsenal($item,$user_ID,$newq);
	}elseif(!empty($gift_id)){
		$currentq = getMuscle($item,$user_ID);
		$newq = $currentq + amount;
		SetMuscle($item,$user_ID,$newq);
	}elseif(!empty($house_id)){
		$currentq = getAssets($item,$user_ID);
		$newq = $currentq + amount;
		SetAssets($item,$user_ID,$newq);		
		//add cool points to user
		$coolman = getStat("exp",$user_ID);
		$value = cp_val($item);
		$boost = $coolman + $value;
		setStat("exp",$user_ID,$boost);	
	}elseif(!empty($good_id)){
		if($good_id == 51){
			$item = "magic";
			$stash = getGoods($item,$user_ID);
			$grab = $stash + $amount;
			setGoods($item,$user_ID,$grab);
		}else($good_id == 52){
			$item = "dvd";
			$stash = getGoods($item,$user_ID);
			$grab = $stash + $amount;
			setGoods($item,$user_ID,$grab);
		}
	}elseif(!empty($egg_id)){
		$j_query = sprintf("SELECT cp_value FROM h_special_items WHERE id = '%s'",
						  mysql_real_escape_string($egg_id));
		$egg = mysql_query($j_query);
		list($cp_value) = mysql_fetch_row($egg);
		
		$coolman = getStat("exp",$user_ID);
		$ooo = $cp_value * $amount;
		$drop = $coolman + $ooo;
		setStat("exp",$user_ID,$boost);	
		if($egg_id >= 90){
			//weapon
			$item = item_name($egg_id);			
			$cur = getWeggs($item,$user_ID);
			$new = $cur + $amount;
			setWeggs($item,$user_ID,$new);
		}elseif($egg_id >= 200){
			//asset
			$item = item_name($egg_id);			
			$cur = getAEggs($item,$user_ID);
			$new = $cur + $amount;
			setAEggs($item,$user_ID,$new);
		}
	}
	//give giver credit
	$sql = sprintf("SELECT philanthropy FROM h_users WHERE id = ('%s')",
			mysql_real_escape_string($giver_id));
	$result = mysql_query($query);
	list($total) = mysql_fetch_row($result);
	
	$total = $total + 1;
	
	$query = sprintf("UPDATE h_users SET philanthropy = '%s' WHERE id = ('%s')",
		mysql_real_escape_string($total),
		mysql_real_escape_string($giver_id));
	mysql_query($query);
	
	$sql = sprintf("DELETE FROM `h_crew_gift` WHERE `crew_id` = '%s' AND `recipient` = '%s' AND `gift` = '%s'",
						mysql_real_escape_string($cid),
						mysql_real_escape_string($user),
						mysql_real_escape_string($item));
	$result=mysql_query($sql);
	
	echo 1;		
}							   
											   
?>