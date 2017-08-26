<?php
		//ini_set('display_errors', 1);
		session_start();
		
		/*
		// Csatlakozás az adatbázishoz
		$ab = mysqli_connect("localhost", "root", "12345", "authentikacio");
		// Adatbázis kapcsolat ellenőrzése
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
		*/
?>		
<!DOCTYPE html>
<html>
<head>
	<title>Regisztráció</title>
	<link rel="stylesheet" type="text/css" href="registration_form.css">
	<link rel="stylesheet" type="text/css" href="main.css">
	<script src="jquery-1.8.3.min.js"></script>
	<script src="main.js"></script>
</head>
<body>
<div class="header">
	<h1>Regisztráció</h1>
</div>

<form action="registration_processing.php" method="post">
	<table>
		<tr>
			<td><span class="felirat">Teljes név:</span></td>
			<td><input type="text" id="name" name="name" class="nevInput"></td>
		</tr>
		<tr>
			<td><span class="felirat">Felhasználó név:</span></td>
			<td><input class="userInput" type="text" id="username" name="username" ></td>
		</tr>
		<tr>
			<td><span class="felirat">E-mail cím:</span></td>
			<td><input type="email" id="email" name="email" class="emailInput"></td>
		</tr><tr>
			<td><span class="felirat">Jelszó:</span></td>
			<td><input type="password" id="password" name="password" class="passInput"></td>
		</tr><tr>
			<td><span class="felirat">Jelszó megerősítése:</span></td>
			<td><input type="password" id="password2" name="password2" class="passInput2"></td>
		</tr><tr>
			<td></td>
			<td><input type="submit" id="regisztral_gomb" name="regisztral_gomb" value="Regisztráció"></td>
		</tr>
	</table>	
</form>
<?php
	if(!empty($_SESSION['message'])) {
	echo "<div id='error_msg'>".$_SESSION['message']."</div>";
	unset($_SESSION['message']); 
}
?>
</body>
</html>