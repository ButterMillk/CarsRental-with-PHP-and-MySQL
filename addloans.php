<!DOCTYPE html>
<html>
<head>
	<title>Dodaj wypożyczenie</title>
	<meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
session_start();
$login = $_SESSION['login'];
$type = $_SESSION['typeOfAccount'];

echo $_POST['auto'];

if($type==1){

	$idUser = $_POST['idUser'];
	$idCar = $_POST['idCar'];
	$dataStart = $_POST['dataStart'];
	$dataReturn = $_POST['dataReturn'];

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

	else {
	if($sql->query("INSERT INTO loans VALUES(NULL,'$idUser',
						'$idCar','$dataStart','$dataReturn')")){
						echo "Dodano poprawnie";
						sleep(5);
						header ("Location: loans.php");
					}
					else{
						throw new Exception($sql->error);
					}
	}	
	
	$available = 'false';
	$updateCar= "UPDATE cars SET available='$available' WHERE idCar='$idCar'";

	if(mysqli_query($sql,$updateCar)){
	header("refresh:2; url=main.php");
	echo "Zarezerwowano pomyślnie";
	}
	else{
		echo "Nie można zarezerwować!";
	}	
}

else if($type==0)
{
	$login = $_POST['login'];
	$idCar = $_POST['idCar'];
	$dataStart = $_POST['dataStart'];
	$dataReturn = $_POST['dataReturn'];

	$sql = mysqli_connect($host, $db_user, $db_password, $db_name)
                     or die('Nie można się połączyć z serwerem');

        $database = mysqli_select_db($sql,$db_name) 
			or die('Brak połączenia z bazą danych');
	
	$select = "SELECT * FROM users WHERE login='$login'";

	$query = mysqli_query($sql,$select ) 
        or die('Blad zapytania'); 

	$row = mysqli_fetch_array($query);
	$idUser = $row['idUser'];

	if (!$sql) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	else {
	if($sql->query("INSERT INTO loans VALUES(NULL,'$idUser',
						'$idCar','$dataStart','$dataReturn')")){
						echo "Dodano poprawnie";
						}
					else{
						throw new Exception($sql->error);
					}
	}	

	$available = 'false';
	$update = "UPDATE cars SET available='$available' WHERE idCar='$idCar'";

	if(mysqli_query($sql,$update)){
	header("refresh:2; url=main.php");
	echo "Zarezerwowano pomyślnie";
	}
	else{
		echo "Nie można zarezerwować!";
	}	
}

else{
	echo "Nie masz uprawnień!";
}
?>
</body>
</html>