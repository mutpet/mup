<!DOCTYPE html>
<html>
<head>
	<title>Új jelszó létrehozása/Create a new password</title>
	<!--<link rel="stylesheet" type="text/css" href="forgotpassword.css">-->
	<!--<script src="jquery-1.8.3.min.js"></script>-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="main.js"></script>
</head>

<body>
<div class="container">
  <div class="row justify-content-center">
  <div class="col">
	<h1>Új jelszó létrehozása</h1>
  </div>
  </div>
<form method="post" action="#">
<!--
<div class="form-group">
<table class="table table-responsive">
	<tr>
	<label class="col-form-label" for="formGroupExampleInput">Example label</label>
		<td><span class="">Érvényesítő kód:</span></td>
		
	</tr>
	<tr>
		<td><input type="text" class="form-control" name="verify_code" value="" /></td>
	</tr>
	<tr>
		<td><span class="">Új jelszó:</span></td>
	</tr>
    <tr>
		<td><input type="password" class="form-control" name="new_password1" /></td>
	</tr>
	<tr>
		<td><span class="">Új jelszó megerősítése:</span></td>
	</tr>
	 <tr>
		<td><input type="password" class="form-control" name="new_password2" value="" /></td>
	</tr>
	<tr>
		<td><input class="btn btn-secondary" type="submit" id="" name="NewPasswordSubmit" value="Módosít" /></td>
	</tr>
</table>	
</form>
-->
  <div class="form-group">
	<label class="col-form-label" for="formGroupExampleInput">Érvényesítő kód:</label>
	<input type="text" class="form-control" name="verify_code" value="" />
  </div>

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput">Új jelszó:</label>
	<input type="password" class="form-control" name="new_password1" />
  </div>

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput">Új jelszó megerősítése:</label>
	<input type="password" class="form-control" name="new_password2" value="" />
  </div>

  <div class="form-group">
    <input class="btn btn-secondary" type="submit" id="" name="NewPasswordSubmit" value="Módosít" />
 </div>	
 </div>


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