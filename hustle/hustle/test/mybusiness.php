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

$id_query = sprintf("SELECT id FROM h_users WHERE user = '%s'",
			   $user);
$id_result = mysql_query($id_query);
list($userID) = mysql_fetch_row($id_result);

$sql = sprintf("SELECT * FROM h_user_assets WHERE user_id = '$userID' AND asset_id >= 400",
							mysql_real_escape_string($userID));
	$results = mysql_query($sql);
list($count) = mysql_fetch_row($results);
if($count == 0){
		echo "Earn some regular cash by owning a business";
	} else {

	$bquery = "SELECT * FROM h_user_assets WHERE user_id = '$userID' AND asset_id >= 400";
			$biz = mysql_query($bquery);
			?>
			<table>
			<?php
				while($biz_ar = mysql_fetch_assoc($biz)){
						$byard = $biz_ar['asset_id'];
						$bid = $biz_ar['id'];
						$bworth = $biz_ar['worth'];
						$change = $biz_ar['indicator'];
						$b_query2 = "SELECT * FROM h_businesses WHERE id ='$byard'";
						$b_result2 = mysql_query($b_query2);
						$b_result_ar2 = mysql_fetch_assoc($b_result2);					
						if($byard == 400){//night						  
							$bfee = $biz_ar['fee'];
							$entrance = " <td style='padding-right:10px'><span style='padding-right:10px'>$<input name='door' type='text' id='door' value='$bfee' size='5' /></span></td>";
						}elseif($byard == 401){//casino						  
							
						}
						echo "<tr><td style='padding-right:10px'><form id='biz_change3' name='biz_change3' method='post' action='bizs.php'><span style='padding-right:20px'>".$b_result_ar2['name']." #".$bid."</span></td><td style='padding-right:20px'><span style='padding-right:20px'>$".$bworth."<span style='font-size:8px'>(".$change.")</span></span></td>".$entrance."<td><input name='bid' type='hidden' value='".$bid."' /><input name='worth' type='hidden' value='".$bworth."' /><input name='who' type='hidden' value='".$user."' />SELL<br/><input name='sell' type='radio' value='1' /></td><td><span style='padding-right:10px'><input type='image' name='update' src='../graphics/bupdate'></span></td></form></tr><br />";
				}	
	}
			?>
            </table>
            