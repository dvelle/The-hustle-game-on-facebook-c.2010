<?php
include('stats.php');

include('connect.php');
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

$user = $_REQUEST['data'];
//$user = "jermongreen";
$id_query = sprintf("SELECT id FROM h_users WHERE user = '%s'",
			   $user);
$id_result = mysql_query($id_query);
list($userID) = mysql_fetch_row($id_result);

$sql = sprintf("SELECT * FROM h_user_investments WHERE user_id = ('%s')",
							mysql_real_escape_string($userID));
	$results = mysql_query($sql);
list($count) = mysql_fetch_row($results);
if($count == 0){
		echo "Earn some regular cash by purchasing some stock in a business";
	} else {
		$sql = sprintf("SELECT * FROM h_user_investments WHERE user_id = ('%s')",
									mysql_real_escape_string($userID));
			$results = mysql_query($sql);
			?>
			<table>
			<?php
			while($dividend = mysql_fetch_assoc($results)){
							$bid = $dividend['biz_id'];
							$quan = $dividend['quantity'];
							$bworth = $dividend['value'];
							
							$b_query2 = "SELECT * FROM h_user_assets WHERE id ='$bid'";
							$b_result2 = mysql_query($b_query2);
							$b_result_ar2 = mysql_fetch_assoc($b_result2);					
							$change = $b_result_ar2["indicator"];
							$aid= $b_result_ar2["asset_id"];
							$query = "SELECT name FROM h_businesses WHERE id = '$aid'";
							$result = mysql_query($query);
							list($bname) = mysql_fetch_row($result);
							
							echo "<tr><td style='padding-right:10px'><form id='stockchange' name='stockchange' method='post' action='ticks.php'><span style='padding-right:20px'>".$bname." #".$bid."</span></td><td style='padding-right:20px'><span style='padding-right:20px'>$".$bworth."<span style='font-size:8px'>(".$change.")</span><span></td><td style='width:35px;'>".$quan."</td><td><input name='bid' type='hidden' value='".$bid."' />Quantity<input name='quantity' type='text' size='5' /><input name='worth' type='hidden' value='".$bworth."' /><input name='who' type='hidden' value='".$user."' /></td><td><span style='padding-right:10px'><input type='image' name='update' src='../graphics/bsell'></span></td></form></tr><br /></span>";
			}	
	}
			?>
            </table>