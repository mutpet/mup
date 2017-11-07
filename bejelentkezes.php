<?php

if(!(class_exists('Login'))) {
	include_once 'classes/Login.php'; 
}

if(!(class_exists('Translator'))) {
	include_once 'classes/Translator.php'; 
}

if(!isset($_SESSION)) { 
	session_start();
}

$file_name = basename(__FILE__);
$template_file = 'bejelentkezes.html';

if(!empty($_SESSION['message'])) {
		$message = "<div id='error_msg' class='".$_SESSION['message_class']."'>".$_SESSION['message']."</div>";
		 unset($_SESSION['message']);


if(!empty($_SESSION['languages'])) {
//A 'Translator' nevű osztály példányosítása(átadva a $_SESSION szuperglobális tömbböt, és ennek az aktuális php fájlnak a nevét). 
//A 'TextTranslation' nevű metódus meghívása. (Átadva a metódusnak az ehhez a fájlhoz tartozó template html nevét, és mivel vár még egy tömbböt a metódus, amire a bejelentkező ablak esetén nincsen szükségünk, ezért azt NULL kezdeti értékkel adjuk át.)  	
			  $text = new Translator($_SESSION, $file_name);
			  $text->TextTranslation($template_file, $temp_array = null);
		}

if(!empty($_REQUEST)) {
$login = new Login($_REQUEST);
$login->validate();
$login->closeLoginWindow();
}

?>

