<?
include 'stats.php';

include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);


$user = $_POST['customer'];
//$user = "jermongreen";
//$_POST['option'] = "Mom's Car";

if(!empty($_POST['crewname'])){
	$item = $_POST['crewname'];
	$price = 15;
}elseif(!empty($_POST['cashloan'])){
	$item = $_POST['cashloan'];
	$price = 10;
}elseif(!empty($_POST['energyfill'])){
	$item = $_POST['energyfill'];
	$price = 10;
}elseif(!empty($_POST['flag'])){
	$item = $_POST['flag'];
	$price = 0;
}elseif(!empty($_POST['rehab'])){
	$item = $_POST['rehab'];
	$price = 20;
}elseif(!empty($_POST['magic'])){
	$item = $_POST['magic'];
	$price = 35;
}elseif(!empty($_POST['ticket'])){
	$item = $_POST['ticket'];
	$price = 12;
}elseif(!empty($_POST['jailbreak'])){
	$item = $_POST['jailbreak'];
	$price = 35;
}elseif(!empty($_POST['option'])){
	//premium list
	$item = $_POST['option'];
	if($item == "car"){
		$price = 25;
	}elseif($item == "tank"){
		$price = 105;
	}elseif($item == "shot"){		
		$price = 35;
	}elseif($item == "yacht"){		
		$price = 230;
	}elseif($item == "gun"){		
		$price = 40;
	}elseif($item == "cycle"){		
		$price = 120;
	}
}
function easy_pick(){
	$digits = rand(111111,999999);
	return $digits;
}

//get user stats
$user_ID = id($user);

$tokens = getStat('rp',$user_ID);
//$tokens = 12;
//In stock

if($tokens < $price){
  //buy more tokens alert
  echo 1;
}else{
  //Debit Tokens
  $debit = $tokens - $price;
  //echo $price." price <br />";
  //echo $debit." debit <br />";
  setStat('rp',$user_ID,$debit);
  //delivery
  if(!empty($_POST['crewname'])){
	  echo 2;
  }elseif(!empty($_POST['cashloan'])){
	  $cash = getStat('cash',$user_ID);
	  $deposit = $cash + 20000;
	  setStat('cash',$user_ID,$deposit);
	  echo 3;
  }elseif(!empty($_POST['energyfill'])){
	  $energy_max = getStat('epr',$user_ID);
	  setStat('ep',$user_ID,$energy_max);
	  echo 4;
  }elseif(!empty($_POST['flag'])){
	  $flag = $_POST['target'];
	  if(empty($flag)){
		  echo 10;
	  } else {
		  $debit = $tokens - 12;
		  setStat('rp',$user_ID,$debit);
		  $flag = $flag.".png";
		  $query = sprintf("UPDATE h_crew_main SET mem_image = '%s' WHERE user = ('%s')",
			mysql_real_escape_string($flag),
			mysql_real_escape_string($user));
			$result = mysql_query($query);
		  echo 5;
	  }
  }elseif(!empty($_POST['rehab'])){
	  //rehab
	  setStat("epr",$user_ID,10);
	  echo 6;
  }elseif(!empty($_POST['magic'])){
	  //magic
	  $onhand = getGoods("coke",$user_ID);
	  $deposit = $onhand + 800;
	  setGoods("coke",$user_ID,$deposit);
	  echo 7;
  }elseif(!empty($_POST['ticket'])){
	  //pick ten lotto numbers
	  $i = 1;
	  while($i <= 10){
		  $time = time();
		  $ticket = easy_pick();
		  $query = sprintf("INSERT INTO h_lotto_tickets(time,user_id,ticket_number) VALUES ('%s','%s','%s')",
		mysql_real_escape_string($time),
		mysql_real_escape_string($user_ID),		
		mysql_real_escape_string($ticket));
		mysql_query($query);
		$i++;  
	  } 
	  echo 8;//10 Easy Pick Tickets purchased
	
  }elseif(!empty($_POST['jailbreak'])){
	  $sql = sprintf("DELETE FROM h_rap_sheet WHERE hood = ('%s')",
						mysql_real_escape_string ($user));
					mysql_query($sql);
	  $sql = sprintf("DELETE FROM h_chases WHERE hood = ('%s')",
						mysql_real_escape_string ($user));
					mysql_query($sql);
	  echo 9;//10 Easy Pick Tickets purchased
	
  }elseif(!empty($_POST['option'])){
	    $item = $_POST['option'];
		if($item == "car"){
			setAEggs("Mom's Car",$user_ID,1);
			$cool = getStat("exp",$user_ID);
			$cool = $cool - 5000;
			setStat("exp",$user_ID,$cool);
			echo 20;
		}elseif($item == "tank"){
			$count = getWEggs("Tank",$user_ID);
		    $count = $count + 1;
		    setWEggs("Tank",$user_ID,$count);
		    echo 21;
		}elseif($item == "shot"){		
			$count = getAEggs("adrenaline shot",$user_ID);
    	    $count = $count + 1;
		    setAEgg("adrenaline shot",$user_ID,$count);
		    echo 22;
		}elseif($item == "yacht"){		
			setAEggs("Yacht",$user_ID,1);
	        $cool = getStat("exp",$user_ID);
	        $cool = $cool + 900000;
	        setStat("exp",$user_ID,$cool);
	        echo 23;
		}elseif($item == "gun"){		
			$count = getWEggs("Gatling Gun",$user_ID);
		    $count = $count + 1;
		    setWEggs("Gatling Gun",$user_ID,$count);
		    echo 24;
		}elseif($item == "cycle"){		
			setAEggs("2020 Motorcycle",$user_ID,1);
		    $cool = getStat("exp",$user_ID);
		    $cool = $cool + 100000;
		    setStat("exp",$user_ID,$cool);
		    echo 25;
		}
  }  
}
?>

 