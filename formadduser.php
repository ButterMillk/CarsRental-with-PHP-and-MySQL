<!DOCTYPE html>
<html>
<head>
	<title>Dodaj użytkownika</title>
	<meta charset="utf-8" />
</head>
<body>

<?php

session_start();

echo "
	<form action='adduser.php' method='POST'>
		<label>Typ konta: </label>
		<input type='text' name='typeOfAccount' /><br />
		<label>Login: </label>
		<input type='text' name='login' /><br />
		<label>Hasło: </label>
		<input type='password' name='haslo' /><br />
		<label>Email: </label>
		<input type='text' name='email' /><br />
		<br />
		<input type='submit' name='Dodaj' />
	</form>
";
?>

</body>
</html>