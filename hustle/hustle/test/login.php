<?php
session_start(); 	// start up our session - or recreate it if it already exists
	if($_POST) {
		require_once 'connect.php';	// this is from our earlier article on configuration files in PHP
		$user = $_POST['user'];
		$password = $_POST['password'];		
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);
		$query = sprintf("SELECT COUNT(id) FROM h_users WHERE UPPER(user) = UPPER('%s') AND password='%s'",
			mysql_real_escape_string($user),
			mysql_real_escape_string(md5($password)));
		$result = mysql_query($query);
		list($count) = mysql_fetch_row($result);
		if($count == 1) {
			$_SESSION['authenticated'] = true;
			$_SESSION['user'] = $user;
			header('Location:index.php');
		?>        
<span style='color:green'>Login Successful.</span>
<?php	} else {	?>
<span style='color:red'>Error: that username and password combination does not match any currently within our database.</span>
<?php	}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action='login.php' method='post'>
Username: <input type='text' name='user' /><br />
Password: <input type='password' name='password' /><br />
<input type='submit' value='Login' />
</form>
</body>
</html>