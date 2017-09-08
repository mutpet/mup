<!DOCTYPE html>
<html>
<head>
	<title>Új jelszó igénylése/Request a new password</title>
	<!--<link rel="stylesheet" type="text/css" href="forgotpassword.css">-->
	<!--<script src="jquery-1.8.3.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="main.js"></script>
</head>

<body>
<h1>Új jelszó igénylése</h1>
<form method="post" action="forgotpassword.php">
<input type="text" name="email" placeholder="E-mail cím">
<input type="submit" id="forgotPassSubmit" name="forgotPassSubmit" value="Küldés">
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