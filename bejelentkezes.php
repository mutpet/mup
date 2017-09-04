<!DOCTYPE html>
<html>
<head>
	<title>Bejelentkezés/Login</title>
	<link rel="stylesheet" type="text/css" href="bejelentkezes.css">
	
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
			<td height="5px"></td>
		</tr>
		<tr>
			<td class="remember_td"><span class="felirat">Emlékezzen rám:</span><input type="checkbox" name="rememberme" id="rememberme"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td>
				<div class="forgotten_pw_container">
					<a  id="forgotten_pw_url" href="#" onclick="openForgotPasswordWindow();">Elfelejtette jelszavát<img id="question_mark_img" src="images/login/question_mark.png" height="19px"></a>
				</div>
			</td>
		</tr>
		<tr>
			<td height="20px"></td>
		</tr>
		<tr>
			<td><input type="submit" id="login_gomb" name="login_gomb" value="Belépés" onclick="saveCheckbox()" ></td>
			<td><input type="button" id="cancel_gomb" name="cancel_gomb" value="Mégse" onclick="updateCheckbox(); closeLoginWindow()"></td>
		</tr>
	</table>
</div>
</form>

<?php
if(!(class_exists('Login'))) {
	include_once 'classes/Login.php'; 
}

if(!empty($_REQUEST)) {
$login = new Login($_REQUEST);
$login->validate();
$login->closeLoginWindow();
}
?>

</body>
</html>