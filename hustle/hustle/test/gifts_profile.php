<?php
$user = $_REQUEST["data"];
//$user = "jermongreen";
include 'connect.php';
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

include 'stats.php';

include 'leveler.php';


$id_query = sprintf("SELECT id FROM h_users WHERE user = '%s'",
			   $user);
$id_result = mysql_query($id_query);
list($userID) = mysql_fetch_row($id_result);

$cw_query = sprintf("SELECT id FROM h_crew_main WHERE UPPER(user) = UPPER('%s')",
mysql_real_escape_string ($user));
$cw_result = mysql_query($cw_query);
list($crewID) = mysql_fetch_row($cw_result);
		//
		?>
<div id="weaps" style="width:120; height: 200; overflow:auto;">
        <?
		$w_query = "SELECT * FROM h_user_arsenal WHERE user_id = '$userID' AND type = 												 				'weapon'";
		$weapons = mysql_query($w_query);	
			while($weapons_ar = mysql_fetch_assoc($weapons)){
					$arms = $weapons_ar['arsenal_id'];
						$w_query2 = "SELECT * FROM h_arsenal WHERE id ='$arms'";
						$w_result2 = mysql_query($w_query2);
						$w_result_ar2 = mysql_fetch_assoc($w_result2);
						$w_image = $w_result_ar2['mini_image'];
						if(empty($w_image)){
							$m_query2 = "SELECT * FROM h_special_items WHERE id ='$arms'";
							$m_result2 = mysql_query($m_query2);
							$m_result_ar2 = mysql_fetch_assoc($m_result2);
							$image = $m_result_ar2['image'];
							$name = $m_result_ar2['name'];
						} else {
							$image = $w_image;
						}
						echo "<br /><img src='http://www.12daysoffun.com/hustle/file/pic/fbimages/$image'/>";  
						echo "<br />".$w_result_ar2['name'];
						echo " x "; 
						echo $weapons_ar['quantity'];			}
				?>
			</div>
        
<div id="gym" style="width:120; height: 200; overflow:auto;">
        <?
		$mquery = "SELECT * FROM h_user_arsenal WHERE user_id = '$userID' AND type = 												 				'muscle'";
		$muscle = mysql_query($mquery);
			while($muscle_ar = mysql_fetch_assoc($muscle)){
					$arms = $muscle_ar['arsenal_id'];
					$m_query2 = "SELECT * FROM h_muscle WHERE id ='$arms'";
					$m_result2 = mysql_query($m_query2);
					$m_result_ar2 = mysql_fetch_assoc($m_result2);
					$m_image = $m_result_ar2['mini_image'];
					
					echo "<br /><img src='http://www.12daysoffun.com/hustle/file/pic/fbimages/$m_image'/>";  
					echo "<br />".$m_result_ar2['name'];
					echo " x "; 
					echo $muscle_ar['quantity']; 
			}
				?>
</div>    
            
<div id="homes" style="width:120; height: 200; overflow:auto;">
        <?		
		$hquery = "SELECT * FROM h_user_assets WHERE user_id = '$userID'";
		$house = mysql_query($hquery);
			while($home_ar = mysql_fetch_assoc($house)){
					$hyard = $home_ar['asset_id'];
					if($hyard <= 11){
						$y_query2 = "SELECT * FROM h_assets WHERE id ='$hyard'";
						$y_result2 = mysql_query($y_query2);
						$y_result_ar2 = mysql_fetch_assoc($y_result2);
						$y_image = $y_result_ar2['mini_image'];
						
						echo "<br /><img src='http://www.12daysoffun.com/hustle/file/pic/fbimages/$y_image'/><br />".$y_result_ar2['name']." x ".$home_ar['quantity'];
					} else {
						//
					}
			}
		$gquery = "SELECT * FROM h_user_assets WHERE user_id = '$userID'";
		$good = mysql_query($gquery);
			while($good_ar = mysql_fetch_assoc($good)){
					$gyard = $good_ar['asset_id'];
					if($gyard == 51 || $gyard == 52 || $gyard == 53){
						$w_query2 = "SELECT * FROM h_illegal_goods WHERE id ='$gyard'";
						$w_result2 = mysql_query($w_query2);
						$w_result_ar2 = mysql_fetch_assoc($w_result2);
						$w_image = $w_result_ar2['image_icon'];
						
						echo "<br /><img src='http://www.12daysoffun.com/hustle/file/pic/fbimages/$w_image'/><br />".$w_result_ar2['name']." x ".$good_ar['quantity']; 
					}						
			}	
		$bquery = "SELECT * FROM h_user_assets WHERE user_id = '$userID'";
		$biz = mysql_query($bquery);
			while($biz_ar = mysql_fetch_assoc($biz)){
					$byard = $biz_ar['asset_id'];
					if($byard >= 400){
						$b_query2 = "SELECT * FROM h_businesses WHERE id ='$byard'";
						$b_result2 = mysql_query($b_query2);
						$b_result_ar2 = mysql_fetch_assoc($b_result2);
						$b_image = $b_result_ar2['mini_image'];
						if(empty($b_image)){
							//
						} else {
							echo "<br /><img src='http://www.12daysoffun.com/hustle/file/pic/fbimages/$b_image'/>";  
							echo "<br />".$b_result_ar2['name'];
							echo " # "; 
							echo $biz_ar['id'];
						}
					}
			}
		$bquery = "SELECT * FROM h_user_assets WHERE user_id = '$userID'";
		$eiz = mysql_query($bquery);
		$chip = mysql_fetch_assoc($eiz);
		if(!is_array($chip)){
			//
		} else {
			while($biz_ar = mysql_fetch_assoc($eiz)){
					$byard = $biz_ar['asset_id'];
					if($byard >= 200){
						$b_query2 = "SELECT * FROM h_special_items WHERE id ='$byard'";
						$b_result2 = mysql_query($b_query2);
						$b_result_ar2 = mysql_fetch_assoc($b_result2);
						$b_image = $b_result_ar2['image'];
						if(empty($b_image)){
							//
						} else {
							echo "<br /><img src='http://www.12daysoffun.com/hustle/file/pic/fbimages/$b_image'/>";  
							echo "<br />".$b_result_ar2['name'];
							echo " # "; 
							echo $biz_ar['id'];
						}
					}
			}
		}
		$lquery = "SELECT COUNT(ID) FROM h_lotto_tickets WHERE user_id = '$userID'";
		$lotto = mysql_query($lquery);
		list($tot) = mysql_fetch_row($lotto);
		if($tot < 1){
		} else {
			echo "<br /><img src='http://www.12daysoffun.com/hustle/file/pic/fbimages/lotto.png'/><br/>".$tot." Lotto Tickets<br/>";  
		}			
				?>
</div>