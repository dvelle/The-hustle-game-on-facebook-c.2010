<?php
 
function id() {
	//userid
				$query = sprintf("SELECT id FROM phpfox_user WHERE UPPER(user) = UPPER('%s')",
				mysql_real_escape_string('user'));
				$result = mysql_query($query);
				list($coch) = mysql_fetch_row($result);
				$userID = $coch;		
}
?>