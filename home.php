<?php
session_start();
echo "\xEF\xBB\xBF";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Személyes oldal</title>
	<link rel="stylesheet" type="text/css" href="regisztracio.css">
</head>
<body>
<div class="header">
	<h1>Főoldal</h1>
</div>
<h1>Home</h1>
<div><h4>Üdvözlöm <?php echo $_SESSION['usernev']; ?>!</h4></div>
</body>
</html>