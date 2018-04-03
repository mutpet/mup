<?php

if(!(class_exists('Translator'))) {
	include_once 'classes/Translator.php'; 
}

if(!(class_exists('Registration'))) {
	include_once 'classes/Registration.php'; 
}

if(!(class_exists('MailMessage'))) {
	include_once 'classes/MailMessage.php'; 
}

if(!isset($_SESSION)) { 
	session_start();
}

$file_name = basename(__FILE__);
$template_file = 'registration_form.html';
$message = '';
if(!empty($_SESSION['message'])) {
		$message = "<div id='error_msg' class='".$_SESSION['message_class']."'>".$_SESSION['message']."</div>";
		unset($_SESSION['message']);
}

$temp_array = array( 							'login_button'=>null, 
												'logout_button'=>null, 
												'lang_hu'=>null, 
												'lang_en'=>null, 
												'menu_item'=>null,
												'login_info' =>null,
												'login_info_style' =>null,
												'prefix'=>null,
												'message'=>$message,
												'visitors'=>null,
												'script'=>null );

if(!empty($_REQUEST)) {
$new_signup = new Registration($_REQUEST);
$new_signup->checkRegistration();
//$new_signup->setRegistration();
}

if(!empty($_SESSION['languages'])) {
	//A 'Translator' nevű osztály példányosítása(átadva a $_SESSION szuperglobális tömbböt, és ennek az aktuális php fájlnak a nevét). 
	//A 'TextTranslation' nevű metódus meghívása. (Átadva a metódusnak az ehhez a fájlhoz tartozó template html nevét, és mivel vár még egy tömbböt a metódus, amire a bejelentkező ablak esetén nincsen szükségünk, ezért azt NULL kezdeti értékkel adjuk át.)  	
	$text = new Translator($_SESSION, $file_name);
	$text->TextTranslation($template_file, $temp_array);
}






?>
