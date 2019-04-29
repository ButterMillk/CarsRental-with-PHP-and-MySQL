<!DOCTYPE html>
<html>
<head>
	<title>Wypożyczenia</title>
	<meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="page"> 
<?php
session_start();
$login = $_SESSION['login'];
$type = $_SESSION['typeOfAccount'];

$configs = include('config.php');

$host = $configs['host'];
$db_user = $configs['db_user'];
$db_password = $configs['db_password'];
$db_name = $configs['db_name'];

$sql = mysqli_connect($host, $db_user, $db_password, $db_name)
                     or die('Nie można się połączyć z serwerem');

$database = mysqli_select_db($sql,$db_name) 
			or die('Brak połączenia z bazą danych');

$query = mysqli_query($sql,"select c.idCar, l.idLoan, u.login, u.email, c.Brand, c.Model, c.Year, l.dataStart, l.dataReturn FROM loans l INNER JOIN users u on l.idUser = u.idUser INNER JOIN cars c on l.idCar=c.idCar")
			or die('Blad zapytania'); 

?>
    <div class="naviagation">
        <ul>
            <li><a class="dodaj" href="main.php">Menu Główne</a></li>
            <li><a class="dodaj" href="formaddloan.php">Dodaj nową rezerwację</a></li>
            <li><a class="dodaj" href="users.php">Przeglądaj użytkowników</a></li>
            <li><a class="wyloguj" href="logout.php">Wyloguj się</a></li>
        </ul>
    </div>

    <div class="container">


<?
{
    /* wyświetlamy wyniki */
    if(mysqli_num_rows($query) > 0) { 
        /* jeżeli wynik jest pozytywny, to wyświetlamy dane */ 
        echo "<table cellpadding=\"2\" border=1>"; 
        //echo "<td> Id Wypożyczenia </td>";
        echo "<td> Login [Wypożyczający] </td>";
        echo "<td> Email </td>";
        echo "<td> Marka </td>";
        echo "<td> Model</td>";
        echo "<td> Rocznik </td>";
        echo "<td> Data Rozpoczęcia </td>";
        echo "<td> Data Zwrotu </td>";
        echo "<td> Usuń </td>";


       while($result = mysqli_fetch_assoc($query)) { 
            echo "<tr>"; 
            //echo "<td>".$result['idLoan']."</td>"; 
            echo "<td>".$result['login']."</td>"; 
            echo "<td>".$result['email']."</td>"; 
            echo "<td>".$result['Brand']."</td>"; 
            echo "<td>".$result['Model']."</td>"; 
            echo "<td>".$result['Year']."</td>"; 
            echo "<td>".$result['dataStart']."</td>"; 
            echo "<td>".$result['dataReturn']."</td>"; 
            echo "<td><a class='table' href=deleteloan.php?idLoan=".$result['idLoan']."&idCar=".$result['idCar'].">Usuń</a></td>";
            echo "</tr>"; 			
        }

        echo "</table>"; 
    } 
    else{
    	echo "brak danych w bazie";
    }
}

else if($type==0){
	echo "Brak dostępu";
}



?>
        </div>
    </div>
</body>
</html>