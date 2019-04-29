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

$idCar = $_GET['idCar'];
$deleteCar = "DELETE FROM cars WHERE idCar='$idCar'";

if(mysqli_query($sql,$deleteCar)){
	header("refresh:1; url=main.php");
}
else{
	echo"Nie udało się usunać - prawdopodobnie samochód jest wypożyczony";
	header("refresh:5; url=main.php");
}
?>