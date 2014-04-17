<?php
//$user = "jermongreen";
$user = $_REQUEST["data"];
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
					if($arms != 1){
						$w_query2 = "SELECT * FROM h_arsenal WHERE id ='$arms'";
						$w_result2 = mysql_query($w_query2);
						$w_result_ar2 = mysql_fetch_assoc($w_result2);
						$w_image = $w_result_ar2['mini_image'];
						$name = $w_result_ar2['name'];
						if(empty($w_image)){
							$m_query2 = "SELECT * FROM h_special_items WHERE id ='$arms'";
							$m_result2 = mysql_query($m_query2);
							$m_result_ar2 = mysql_fetch_assoc($m_result2);
							$image = $m_result_ar2['image'];
							$name = $m_result_ar2['name'];
						} else {
							 $ image = $w_image;
						}
						echo "<br /><img src='http://www.12daysoffun.com/hustle/file/pic/fbimages/$image'/>";  
						echo "<br />".$name;
						echo " x "; 
						echo $weapons_ar['quantity']; ?><input type="hidden" id="dealer" name="dealer" value="arsenal"/><input type="hidden" id="image" name="image" value="<?php 
						echo $image?>"/>
					<input name="item" type="checkbox" value="<?php echo $name;?>" />
			  <?php
					}
			}
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
					echo $muscle_ar['quantity']; ?>
					<input type="hidden" id="cut" name="cut" value="muscle"/>
                    <input type="hidden" id="image" name="image" value="<?php 
						echo $m_image?>"/>
				<input name="item" type="checkbox" value="<?php 
					echo $m_result_ar2['name']?>" />
			  <?php
			}
				?>
</div>    
            
<div id="homes" style="width:120; height: 200; overflow:auto;">
        <?		
		$hquery = "SELECT * FROM h_user_assets WHERE user_id = '$userID'";
		$house = mysql_query($hquery);
			while($home_ar = mysql_fetch_assoc($house)){
					$yard = $home_ar['asset_id'];
					if($yard == 1 || $yard == 50 || $yard == 207 || $yard == 400 || $yard == 401){
						//
					} else {
						$y_query2 = "SELECT * FROM h_assets WHERE id ='$yard'";
						$y_result2 = mysql_query($y_query2);
						$y_result_ar2 = mysql_fetch_assoc($y_result2);
						$y_image = $y_result_ar2['mini_image'];
						$name = $y_result_ar2['name'];
						if(empty($y_image)){
							$y_query6 = "SELECT * FROM h_illegal_goods WHERE id ='$yard'";
							$y_result6 = mysql_query($y_query6);
							$y_result_ar6 = mysql_fetch_assoc($y_result6);
							$new_image = $y_result_ar6['image_icon'];
							$name = $y_result_ar6['name'];
							if(empty($new_image)){
								$y_query7 = "SELECT * FROM h_special_items WHERE id ='$yard'";
								$y_result7 = mysql_query($y_query7);
								$y_result_ar7 = mysql_fetch_assoc($y_result7);
								$y_image = $y_result_ar7['image'];
								$name = $y_result_ar7['name'];
							} else {
								$y_image = $new_image;
							}
						}	
						echo "<br /><img src='http://www.12daysoffun.com/hustle/file/pic/fbimages/$y_image'/>";  
						echo "<br />".$name;
						echo " x "; 
						echo $home_ar['quantity']; ?><input type="hidden" id="estate" name="estate" value="asset"/><input type="hidden" id="image" name="image" value="<?php 
						echo $y_image?>"/><input type="hidden" id="biz_id" name="biz_id" value="<?php 
						echo $y_result_ar2['id']?>"/>
					<input name="item" type="checkbox" value="<?php 
						echo $name?>" />
			  <?php
					}
			}
				?>
</div>
            
<div id="mycrew" style="width:120; height: 200; overflow:auto;">
          <?php
		  $crwquery = sprintf("SELECT * FROM h_crew_member WHERE crew_id = '%s' and user != '%s'",
							mysql_escape_string($crewID),
							mysql_escape_string($user));
		$crew_members = mysql_query($crwquery);
		while($result_ar = mysql_fetch_assoc($crew_members)){
			$query = sprintf("SELECT * FROM h_users WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string ($result_ar['user']));		
			$cresult = mysql_query($query);
			$mem_ar = mysql_fetch_assoc($cresult);
			$image = $mem_ar['image']; 
		echo "<img src='http://www.12daysoffun.com/hustle/file/pic/user/$image'/><br />";
		echo $mem_ar['user'];
		?><input name="member" type="checkbox" value="<?php	echo $result_ar['user']?>" />
        
          <?php
		  echo "<br />";
			$i+=1;
			}
			?>
</div>