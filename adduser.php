<?php

$typeOfAccount = $_POST["typeOfAccount"];
$login = $_POST["login"];
$haslo = $_POST["haslo"];
$email = $_POST["email"];

$configs = include('config.php');

$host = $configs['host'];
$db_user = $configs['db_user'];
$db_password = $configs['db_password'];
$db_name = $configs['db_name'];

$sql = mysqli_connect($host, $db_user, $db_password, $db_name)
                     or die('Nie można się połączyć z serwerem');

$database = mysqli_select_db($sql,$db_name) 
			or die('Brak połączenia z bazą danych');

if (!$sql) {
    die("Connection failed: " . mysqli_connect_error());
}

else{

if($sql->query("INSERT INTO users VALUES(NULL,'$typeOfAccount',
					'$login','$haslo','$email')")){
					echo "Dodano poprawnie";
					echo "<br />";
					sleep(5);
					header ("Location: users.php");
				}
				else{
					throw new Exception($mysqli->error);	
				}
}
?>