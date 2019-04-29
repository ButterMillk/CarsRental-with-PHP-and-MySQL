<!DOCTYPE html>
<html>
<head>
    <title>Panel Główny</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="page"> 
<?php
$configs = include('config.php');

session_start();
$login = $_SESSION['login'];
$type = $_SESSION['typeOfAccount'];

echo '<div class="header">';
echo "Witaj: ".$login;
//echo "Twój typ konta: ".$type;
echo "</div>";

$mysqli = mysqli_connect($configs['host'],$configs['db_user'],$configs['db_password'],$configs['db_name'])
			or die('Nie można się połączyć z serwerem MySQL!!!');
$database = mysqli_select_db($mysqli,$configs['db_name']) 
            or die('Brak połączenia z bazą danych');

$query = mysqli_query($mysqli,"SELECT * FROM cars") 
    or die('Blad zapytania'); 
?>
    <div class="naviagation col-sm-12 col-md-3">
        <ul>
            <li><a class="btn btn-primary button-navigation" href="add.php">Dodaj nowy samochód</a></li>
            <li><a class="btn btn-primary button-navigation" href="loans.php">Przeglądaj rezerwacje</a></li>
            <li><a class="btn btn-primary button-navigation" href="users.php">Przeglądaj użytkowników</a></li>
            <li><a class="btn btn-primary button-navigation" href="logout.php">Wyloguj się</a></li>
        </ul>

    </div>
	
    <div class="col-sm-12 col-md-9 container">
<?

if($type==1)
{

    if(mysqli_num_rows($query) > 0) { 
        echo "<table cellpadding=\"2\" border=1>"; 
        echo "<th> Marka </th>";
        echo "<th> Model </th>";
        echo "<th> Rocznik </th>";
        echo "<th> Dostępność </th>";
        echo "<th> Edycja </th>";
        echo "<th> Usuwanie </th>";
        while($result = mysqli_fetch_assoc($query)) { 

            if($result['available']=='TRUE' || $result['available']=='true' || $result['available']=='True'){
                 echo "<tr class='table-success'>";    
            }
            else{
                echo "<tr class='table-danger'>";  
            }
            
            echo "<td>".$result['brand']."</td>"; 
            echo "<td>".$result['model']."</td>"; 
            echo "<td>".$result['year']."</td>"; 
            echo "<td>".$result['available']."</td>"; 
            echo "<td><a class='btn btn-warning' href=editcar.php?idCar=".$result['idCar'].">Edytuj</a> </td>";
            echo "<td><a class='btn btn-danger ' href=deletecar.php?idCar=".$result['idCar'].">Usuń</a></td>";
            echo "</tr>"; 
        } 
        echo "</table>"; 
    } 
    else {
        echo "brak danych w bazie";
    }
}

else if($type==0){
    if(mysqli_num_rows($query) > 0) { 
        echo "<table cellpadding=\"2\" border=1>"; 
        echo "<td> Marka </td>";
        echo "<td> Model </td>";
        echo "<td> Rocznik </td>";
        echo "<td> Dostępność </td>";
        echo "<td> Rezerwacja </td>";
        
        while($result = mysqli_fetch_assoc($query)) { 
            if($result['available']=='TRUE' || $result['available']=='true' || $result['available']=='True'){
                 echo "<tr class='table-success'>";    
            }
            else{
                echo "<tr class='table-danger'>";  
            }

            echo "<td>".$result['brand']."</td>"; 
            echo "<td>".$result['model']."</td>"; 
            echo "<td>".$result['year']."</td>"; 
            echo "<td>".$result['available']."</td>"; 
            if($result['available']=='TRUE' || $result['available']=='true' || $result['available']=='True'){
            	echo "<td><a href=formaddloan.php?idCar=".$result['idCar']."&login=".$login." class='btn btn-danger' >Zarezerwuj</a></td>";
            	}
            echo "</tr>"; 
        } 
        echo "</table>"; 
    } 
    else {
        echo "brak danych w bazie";
    }
}

$query = mysqli_query($mysqli,"SELECT * FROM cars WHERE available='True'") 
    or die('Blad zapytania'); 

$query_user = mysqli_query($mysqli,"SELECT * FROM users WHERE login='$login'");
$result_user= mysqli_fetch_assoc($query_user);
$idUser = $result_user['idUser'];
//echo $idUser;
	
echo '<form action="addloans.php" method="post">';

echo '<br /><br />';
			
echo'Wybierz auto: <br /><select name="idCar" required><br /><br />';
   if(mysqli_num_rows($query) > 0){
	while($result = mysqli_fetch_assoc($query)) {
		echo '<option name="idCar" type="submit" value="'.$result['idCar'].'">'.$result['brand'].' '.$result['model'].'</option> <br /><br />' ;
		
	}

echo '<br /><br />';
echo '</select>
<br /><br />';
echo'<label> Data rozpoczęcia wypożyczenia </label><br />
        <input type="text" name="dataStart" /><br />';
    
        echo'<label>Data zakończenia wypożyczenia</label><br />
        <input type="text" name="dataReturn" /><br />';
        //echo 'idUser <br />';
        echo'<input type="hidden" name="idUser" value="'.$idUser.'" readonly  /> <br /><br />

<input class="btn btn-success" value="Zarezerwuj" type="submit"/></form>';

   }
?>
    </div>
</div>


<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- END OF SCRIPTS -->

</body>
</html>
