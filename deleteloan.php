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

$idLoan = $_GET['idLoan'];
$idCar = $_GET['idCar'];
$delete = "DELETE FROM loans WHERE idLoan='$idLoan'";

if(mysqli_query($sql,$delete)){
	header("refresh:1; url=loans.php");
	echo "Pomyślnie usunięto rezerwacje";
}
else{
	echo"Nie udało się usunać - dlaczego???";
	header("refresh:5; url=loans.php");
}

	$available = 'true';
	$update = "UPDATE cars SET available='$available' WHERE idCar='$idCar'";

	if(mysqli_query($sql,$update)){
		header("refresh:2; url=main.php");
		
	}
	else{
		echo "Nie można zarezerwować!";
	}
?>