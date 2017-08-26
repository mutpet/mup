<?php
session_start();
include_once 'classes/login.php';

if (!empty($_POST["login_gomb"])) {
			
			$username = $_POST["username"];
			$password = $_POST["jelszo"];
		
			$object = new Login();
			$object->valiDate($username, $password);
			$object->closeLoginWindow(1);
}



?>
<html>
<head>
</head>
<body>

<form method="post" action="login_teszt.php">
Username: <input type="text" name="username"/>
Password: <input type="text" name="jelszo"/>
<input type="submit" id="login_gomb" name="login_gomb" value="Belépés">
</form>
</body>
</html>