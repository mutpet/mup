<!DOCTYPE html>
<html>
<head>
	<title>Új jelszó létrehozása/Create a new password</title>
	<!--<link rel="stylesheet" type="text/css" href="forgotpassword.css">-->
	<!--<script src="jquery-1.8.3.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="main.js"></script>
</head>

<body>
<h1>Új jelszó létrehozása</h1>
<form method="post" action="#">
<table>
	<tr>
		<td><span class="">Érvényesítő kód:</span></td>
	</tr>
	<tr>
		<td><input type="text" name="verify_code" value="" /></td>
	</tr>
	<tr>
		<td><span class="">Új jelszó:</span></td>
	</tr>
    <tr>
		<td><input type="text" name="new_password1" /></td>
	</tr>
	<tr>
		<td><span class="">Új jelszó mégegyszer:</span></td>
	</tr>
	 <tr>
		<td><input type="text" name="new_password2" value="" /></td>
	</tr>
	<tr>
		<td><input type="submit" id="" name="NewPasswordSubmit" value="Létrehozás" /></td>
	</tr>
</table>	
</form>

</body>
</html>


<?php

if(!(class_exists('NewPassword'))) {
	include_once 'classes/NewPassword.php'; 
}

if(!empty($_REQUEST['NewPasswordSubmit'])) {
$new_password = new NewPassword($_REQUEST);
$new_password->validateInputs();
$new_password->modifyPassword();
}



?>


























<?php


















?>