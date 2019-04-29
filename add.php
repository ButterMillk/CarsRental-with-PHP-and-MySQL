<!DOCTYPE html>
<html>
<head>
	<title>Edycja samochodu</title>
	<meta charset="utf-8" />
</head>
<body>

<?php

session_start();
echo "
	<form action='addCar.php' method='POST'>
		<label>Marka samochodu: </label>
		<input type='text' name='brand' /><br />
		<label>Model samochodu: </label>
		<input type='text' name='model' /><br />
		<label>Rocznik samochodu: </label>
		<input type='text' name='year' /><br />
		<label>Dostępność samochodu: </label>
		<input type='text' name='available' /><br />
		<br />
		<input type='submit' name='Dodaj' />
	</form>
";
?>
</body>
</html>