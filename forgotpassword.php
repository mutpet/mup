<!DOCTYPE html>
<html>
<head>
	<title>Új jelszó igénylése/Request a new password</title>
	<link rel="stylesheet" type="text/css" href="forgotpassword.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!--<script src="jquery-1.8.3.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="main.js"></script>
</head>

<body>
<h1>Új jelszó igénylése</h1>
<p>
<div class="notice_container">
<img class="pw_warning" src="images/warnings/red_warning.png" />
Figyelem!<br>Új jelszó igényléséhez a regisztrációkor megadott e-mail címére lesz szüksége. Az Ön által megadott e-mail címre a: "Küldés" feliratú gomb megnyomásakor elküldésre kerül az Új jelszóhoz szükséges érvényesítő kód. Az Ön e-mail címére érkező e-mail fogja tartalmazni az új jelszóhoz szükséges érvényesítő kódot.
Kérem ellenőrizze postafiókját, és kövesse az e-mailben található utasításokat!
Érvényesítő kódját kezelje bizalmasan! Másik fél számára ne továbbítsa!   
</div>
</p>
<div class="container">
Kérem adja meg a regisztráció során megadott e-mail címét, majd nyomja meg a: 'Küldés' gombot!
</div>
<form method="post" action="forgotpassword.php">
<i class="material-icons">mail</i>
<input class="mailInput" type="email" name="email" placeholder="E-mail cím/E-mail address">
<input class="forgotPassSubmitButton" type="submit"  name="forgotPassSubmit" value="Küldés" >
</form>

</body>
</html>





<?php

if(!(class_exists('ForgotPassword'))) {
	include_once 'classes/ForgotPassword.php'; 
}

if(!empty($_REQUEST)) {
$forgot_pw = new ForgotPassword($_REQUEST);
$forgot_pw->createVerifyCode();
//$forgot_pw->();
}

/*
 $message = '';
			  if (!empty($_SESSION['message'])) {
				  $message = "<div id='error_msg' class='".$_SESSION['message_class']."'>".$_SESSION['message']."</div>";
				  unset($_SESSION['message']);
			  }
*/


?>