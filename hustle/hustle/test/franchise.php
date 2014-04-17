<?
$user = $_POST['customer'];
$item = $_POST['franchise'];
$order = 1;
//$user = "jermongreen";
//$item = "casino";
//$_POST['buynow_x'] = 1;
//$value = 1;
include 'stats.php';
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//get user stats
$user_ID = id($user);

$cash = getStat('cash',$user_ID);
//$cash = 1000000;
//Inventory Stat Values
$query = sprintf("SELECT * FROM h_businesses WHERE short_name = ('%s')",
		mysql_real_escape_string($item));
$result = mysql_query($query);
$franchise_ar = mysql_fetch_assoc($result);
$aid = $franchise_ar["id"];
$price = $franchise_ar["price"];
//echo $price."<br />";
//echo $aid;

$invoice = $price * $order;

if ($_POST['buynow_x']) {
      // code to view record
	  //echo "Owned:"."100";
	  if($cash < $invoice){
		  $return = 1;
	  }else{
		  //Debit Cash
		  $debit = $cash - $invoice;
		  setStat('cash',$user_ID,$debit);
		  //
		  $bcash = getBCash();
		  $bdepot = $bcash + $invoice;
		  setBCash($bdepot);
		  if($item == "casino"){
			  //set casino values casino worth jackpot		  
			  $sql_3 = sprintf("SELECT bank FROM h_users WHERE UPPER(user) = UPPER('%s')",
									mysql_real_escape_string($user));
								$result_3 = mysql_query($sql_3);
				list($wealth) = mysql_fetch_row($result_3);
			 //set jackpot equal to %.5 of user net worth
			 $jackpot = round($wealth * .1);
			 setCasino($item,$user_ID,$jackpot);
			 $return = 2;
		  } elseif($item == "club"){
			 //add to user inventory
			 $sql_3 = sprintf("SELECT cool FROM h_users WHERE UPPER(user) = UPPER('%s')",
									mysql_real_escape_string($user));
								$result_3 = mysql_query($sql_3);
				list($cool) = mysql_fetch_row($result_3);
			 //set jackpot equal to %.5 of user net worth
			 $cworth = round($cool * .1);			 
			 setClub($item,$user_ID,$cworth);
			 $recipient_message = "<b>Set the Door Rate</b> to access your new club, using the Management area";
			 hustle_reporter($user,1,$recipient_message,"recipient");
			 $return = 3;
		  } 
		  //add cool points to user
		  $coolman = getStat("exp",$user_ID);
		  //
		  $value = 20000;
		  $boost = $coolman + $value;
		  setStat("exp",$user_ID,$boost);
	  }		  
} 

echo $return;
?>