<html lang="pl">
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<?php

$configs = include('config.php');

$host = $configs['host'];
$db_user = $configs['db_user'];
$db_password = $configs['db_password'];
$db_name = $configs['db_name'];

if((isset($_POST['login'])) && (isset($_POST['password'])))
{
	$login=$_POST['login'];
	$password=$_POST['password'];          

	function validate_user($login, $password)
	{
		$return_value = false;
                global $host;
                global $db_user;
                global $db_password;
                global $db_name;
                 
		$sql = mysqli_connect($host, $db_user, $db_password, $db_name)
                     or die('Nie można się połączyć z serwerem');

		$query = "SELECT * FROM users
			WHERE login = '$login' AND password = '$password'";

		$result = mysqli_query($sql,$query) 
			or die('Query failed 1. ' . mysqli_error()); 

		if (mysqli_num_rows($result) == 1){
			
			$return_value = true;
			echo "Zostałeś zalogowany do serwisu";
		}
			echo $return_value;
		return $return_value;
	}	

	session_start();
	// zebezpieczenie przed "session fixation"
	session_regenerate_id(true);
	
	if (isset($_POST['login']) && isset($_POST['password'])) {
		if (validate_user($_POST['login'], $_POST['password'])){

			global $host;
                        global $db_user;
                        global $db_password;
                        global $db_name;
			$_SESSION['login'] = $_POST['login'];

			$sql_type = mysqli_connect($host, $db_user, $db_password, $db_name)
                     or die('Nie można się połączyć z serwerem');

			$query_type = "SELECT * FROM users
			WHERE login = '$login'";

			$result_type = mysqli_query($sql_type,$query_type) 
			or die('Query 2 failed. ' . mysqli_error()); 

			$row = mysqli_fetch_array($result_type);

			$_SESSION['typeOfAccount'] = $row['typeOfAccount'];	
			header("Location:main.php");

		} 
		else {
			echo '<div class="div-login">';
			echo "Wprowadziłeś złe dane! Spróbuj jeszcze raz! <br /><br />";
			echo '<a class="button-index" href="#"> Powrót do menu głównego </a>';
			echo '</div>';
		}
	}

}
?>
</html>