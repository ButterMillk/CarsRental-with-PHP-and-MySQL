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

if($type==1){

		echo'<form method="POST" action="addloans.php">';
			echo'<label>ID Klienta</label><br />';
			echo'<input type="text" name="idUser" /> <br />';
			echo'<label>ID Samochodu</label><br />';
			echo'<input type="text" name="idCar" /> <br />';
			echo'<label>Data rozpoczęcia wypożyczenia</label><br />';
			echo'<input type="text" name="dataStart" /> <br />';
			echo'<label>Data zakończenia wypożyczenia</label><br />';
			echo'<input type="text" name="dataReturn" /> <br />';
			echo'<input type="submit" name="Wypożycz">';
		echo'</form>';

}

elseif ($type==0) {

$login = $_GET['login'];
$idCar = $_GET['idCar'];

		echo'<form method="POST" action="addloans.php">';
				echo'<label>Login [Nazwa Klienta]</label><br />';
				echo'<input type="text" name="login" value="'.$login.'" readonly /> <br />';
				echo'<label>ID Samochodu</label><br />';
				echo'<input type="text" name="idCar" value="'.$idCar.'" readonly /> <br />';
				echo'<label>Data rozpoczęcia wypożyczenia</label><br />';
				echo'<input type="text" name="dataStart" /> format: RRRR-MM-DD <br />';
				echo'<label>Data zakończenia wypożyczenia</label><br />';
				echo'<input type="text" name="dataReturn" /> format: RRRR-MM-DD <br />';
				echo'<input type="submit" name="Wypożycz">';
			echo'</form>';
}

else{
	echo "Nie jestś zalogowany!";
	echo '<a href=http://www.cars.buttermilk.pl/>Powrót do menu</a>';
}

?>		

</body>
</html>