<!DOCTYPE html>
<html>
<head>
	<title>Bejelentkezés</title>
	<link rel="stylesheet" type="text/css" href="bejelentkezes.css">
	<link rel="stylesheet" type="text/css" href="main.css">
	<!--<script src="jquery-1.8.3.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="main.js"></script>
</head>
<body>
<div id="login_container">
<div class="header">
	<h1>Bejelentkezés</h1>
</div>
<form method="post" action="bejelentkezes.php">
	<table>
		<tr>
			<td><span class="felirat">Felhasználónév:</span></td>
		</tr>
		<tr>
			<td><input type="text" name="username" class="userInput"></td>
		</tr>
		<tr>
			<td><span class="felirat">Jelszó:</span></td>
		</tr>
		<tr>
			<td><input type="password" name="password" class="passInput"></td>
		</tr>
		<tr>
			<td><span class="felirat">Emlékezzen rám:</span><input type="checkbox" name="rememberme" id="rememberme"></td>
		</tr>
		<tr>
			<td>&nbsp</td>
		</tr>
		<tr>
			<td><input type="submit" id="login_gomb" name="login_gomb" value="Belépés" onclick="saveCheckbox()" ></td>
			<td><input type="button" id="cancel_gomb" name="cancel_gomb" value="Mégse" onclick="updateCheckbox(); closeLoginWindow()"></td>
		</tr>
	</table>	
</form>
<script>


/*

function rememberCheckBox() {
	alert('Megfut betöltésre pedig a függvény!');
		if(typeof(Storage) !== 'undefined') {
			localStorage.setItem('rememberme', $("#rememberme").val());
			
		}else{
		//hibaüzenet
		 alert('Ez a böngésző nem támogatja a "Web Storage" lehetőséget!');
		}
	}	

*/	
	
/*	
 $(document).ready(function() {
	 alert('Megfut betöltésre pedig a függvény!');
	 if(document.getElementById('rememberme') !== null && localStorage.getItem('rememberme') !== null){
		document.getElementById('rememberme').value = localStorage.getItem('rememberme');
	 }
	
 }
</script>
*/


<?php

if(!(class_exists('Login'))) {
	include_once 'classes/Login.php'; 
}

if(!empty($_REQUEST)) {
$login = new Login($_REQUEST);
$login->validate();
$login->closeLoginWindow();

}

/*
 if(!empty($_SESSION['message'])) {
				  echo "<div id='error_msg'>".$_SESSION['message']."</div>";
				  unset($_SESSION['message']);
			  }
*/
?>

</body>
</html>
<?php
/*
ini_set('display_errors', 1);
session_start();
include 'my_database_connection_pdo.php';
//include "myconnection.pdo.php";
// PDO kapcsolódás,  Csatlakozás az adatbázishoz
$pdo = newPdoConnection();
*/
/* MYSQLI ab kapcsolódás
		$ab = mysqli_connect("localhost", "root", "12345", "authentikacio");
		// Adatbázis kapcsolat ellenőrzése
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
*/	
/*	
		if (!empty($_POST["login_gomb"])) {
			
			$username = $_POST["username"];
			$password = $_POST["jelszo"];
			
			
				//$password = md5($password);  // jelszó alapszintű titkosítása az eltárolása előtt
				
		 
				$felhasznalo_select =  "SELECT * FROM user WHERE username = :username AND password =  MD5( :password )";
				$selectStatement = $pdo->prepare($felhasznalo_select);
				$selectStatement->bindValue(':username', $username);
				$selectStatement->bindValue(':password', $password);
				$selectStatement->execute();
				$result_felhasznalo_select = $selectStatement->fetch();
				
				if (!empty($result_felhasznalo_select)) {
					$_SESSION['message'] = "Ön sikeresen bejelentkezett!";
					$_SESSION['message_class'] = "success";
					$_SESSION['username'] = $username;
					header("location: bejelentkezes.php?exit=1" );
					exit();
				}else{
					$_SESSION['message'] = "A felhasználónév vagy a jelszó nem megfelelő! Kérjük próbálja meg újra!";
					$_SESSION['message_class'] = "fail";
				}
		}
*/		
?>