<?php

$brand = $_POST["brand"];
$model = $_POST["model"];
$year = $_POST["year"];
$available = $_POST["available"];

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

if($sql->query("INSERT INTO cars VALUES(NULL,'$brand',
					'$model','$year','$available')")){
					
					echo "Dodano poprawnie";
					
					sleep(5);
					header ("Location: main.php");
				}
				else{
					throw new Exception($sql->error);	
				}
}
?>