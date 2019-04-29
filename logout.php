<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8" />
</head>
<body>
<?php
	session_start();
	
	if (isset($_SESSION['user'])) 
	{
		
		$_SESSION = array();
		if (isset($_COOKIE[session_name()])) 
		{
			setcookie(session_name(), '', time()-50000, '/');
		}
	}
	session_destroy();
	header('Location: index.html');
?>
</body>
</html>