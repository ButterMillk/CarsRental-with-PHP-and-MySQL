<?php

$configs = include('config.php');

$host = $configs['host'];
$db_user = $configs['db_user'];
$db_password = $configs['db_password'];
$db_name = $configs['db_name'];

$sql = mysqli_connect($host, $db_user, $db_password, $db_name)
                     or die('Nie można się połączyć z serwerem');

$database = mysqli_select_db($sql,$db_name) 
			or die('Brak połączenia z bazą danych');

$idCar = $_POST['idCar'];
$brand = $_POST['brand'];    
$model = $_POST['model'];      
$year = $_POST['year'];      
$available = $_POST['available'];              

$update = "UPDATE cars SET brand='$brand', model='$model', year='$year', available='$available' WHERE idCar='$idCar'";

if(mysqli_query($sql,$update)){
	header("refresh:2; url=main.php");
	echo "zmodyfikowano pomyślnie";
}
else{
	echo "Nie można zmodyfikować!";
}
?>