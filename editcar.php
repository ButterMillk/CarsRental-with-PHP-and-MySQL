<!DOCTYPE html>
<html>
<head>
	<title>Edycja samochodu</title>
	<meta charset="utf-8" />
</head>
<body>

<?php
session_start();
$login = $_SESSION['login'];
$type = $_SESSION['typeOfAccount'];

if($type==1){

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

$update = "SELECT * FROM cars WHERE idCar='$idCar'";

$query = mysqli_query($sql,$update) 
    or die('Blad zapytania'); 

if(mysqli_num_rows($query) > 0) { 
	$result = mysqli_fetch_assoc($query);
	echo "<form method='POST' action='updatecar.php'>";
	echo "<label>ID</label><br />";
	echo '<input type="text" name="idCar" value="'.$result['idCar'].'" readonly /><br />';
	echo "<label>Marka: </label><br />";
	echo '<input type="text" name="brand" value="'.$result['brand'].'" /><br />';
	echo "<label>Model: </label><br />";
	echo '<input type="text" name="model" value="'.$result['model'].'" /><br />';
	echo "<label>Rocznik: </label><br />";
	echo '<input type="text" name="year" value="'.$result['year'].'" /><br />';
	echo "<label>Dostępność: </label><br />";
	echo '<input type="text" name="available" value="'.$result['available'].'" /><br /><br />';

	echo '<input type="submit" value="Zmień">';

	echo "</form>";

	echo "<a href=main.php>Powrót do przeglądu samochdów</a>";
	}
}
else{
	echo "Nie masz uprawinień!";
}
?>
</body>
</html>