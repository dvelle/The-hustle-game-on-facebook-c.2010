<?php
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

include 'stats.php';

$user = $_POST['giver'];
//$user = "jermongreen";
$member = $_POST['member'];
$item = $_POST['item'];
$amount = $_POST['quantity'];
$biz_id = $_POST['biz_id'];
$image = $_POST['image'];
$tester = $amount * 3;
if($amount == 0 || $tester == 0){
	$amount = 1;
}
if(!empty($_POST['dealer'])){
	$type = $_POST['dealer'];
}elseif(!empty($_POST['cut'])){
	$type = $_POST['cut'];
}elseif(!empty($_POST['estate'])){
	$type = $_POST['estate'];
}

//get user stats
$query = sprintf("SELECT * FROM h_users WHERE user = ('%s')",
		mysql_real_escape_string ($user));
$result = mysql_query($query);
$user_ar = mysql_fetch_assoc($result);
$user_ID = $user_ar["id"];
$time = time();

if ($_POST['sendnow_x']) {
	$query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
	mysql_real_escape_string ($user));
	$result = mysql_query($query);
	list($crewID) = mysql_fetch_row($result);
	
	$sql = sprintf("INSERT INTO h_crew_gift(crew_id,user,recipient,gift,quantity,time,image)VALUES('%s','%s','%s','%s','%s','%s');",
						mysql_real_escape_string($crewID),
						mysql_real_escape_string($user),
						mysql_real_escape_string($member),
						mysql_real_escape_string($item),
						mysql_real_escape_string($amount),
						mysql_real_escape_string($time),
						mysql_real_escape_string($image));
				mysql_query($sql);
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
	//easter eggs
	$j_query = sprintf("SELECT id FROM h_special_items WHERE name = '%s' OR short_name = 												 				'%s'",
						  mysql_real_escape_string($item),
				 		 mysql_real_escape_string($item));
	$egg = mysql_query($j_query);
	list($egg_id) = mysql_fetch_row($egg);
	
	if(!empty($gun_id)){
		$currentq = getArsenal($item,$user_ID);
		$newq = $currentq - $amount;
		SetArsenal($item,$user_ID,$newq);
	}elseif(!empty($gift_id)){
		$currentq = getMuscle($item,$user_ID);
		$newq = $currentq - $amount;
		SetMuscle($item,$user_ID,$newq);
	}elseif(!empty($house_id)){
		$currentq = getAssets($item,$user_ID);
		$newq = $currentq - $amount;
		SetAssets($item,$user_ID,$newq);		
		//add cool points to user
		$coolman = getStat("exp",$user_ID);
		$value = cp_val($item);
		$boost = $coolman - $value;
		setStat("exp",$user_ID,$boost);		
	}elseif(!empty($good_id)){
		if($good_id == 51){
			$item = "magic";
			$stash = getGoods($item,$user_ID);
			$grab = $stash - $amount;
			setGoods($item,$user_ID,$grab);
		}else($good_id == 52){
			$item = "dvd";
			$stash = getGoods($item,$user_ID);
			$grab = $stash - $amount;
			setGoods($item,$user_ID,$grab);
		}
	}elseif(!empty($egg_id)){
		$j_query = sprintf("SELECT cp_value FROM h_special_items WHERE id = '%s'",
						  mysql_real_escape_string($egg_id));
		$egg = mysql_query($j_query);
		list($cp_value) = mysql_fetch_row($egg);
		
		$coolman = getStat("exp",$user_ID);
		$ooo = $cp_value * $amount;
		$drop = $coolman - $ooo;
		setStat("exp",$user_ID,$boost);	
		
		//weapon
		$j_query = sprintf("SELECT quantity FROM h_user_assets WHERE id = '%s'",
					  mysql_real_escape_string($egg_id));
		$egg = mysql_query($j_query);
		list($quantity) = mysql_fetch_row($egg);
		if(!empty($quantity)){
			$quantity = $quantity - $amount;
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
			$quantity = $quantity - $amount;
			$query = sprintf("UPDATE h_user_arsenal SET quantity = '%s' WHERE arsenal_id = ('%s') AND user_id = ('%s')",
				mysql_real_escape_string($quantity),
				mysql_real_escape_string($egg_id),
				mysql_real_escape_string($user_ID));
			mysql_query($query);
		}
	}
}
echo "Gift Delivered. ";									   
											   
?>