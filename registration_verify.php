<?php

session_start();

if(!(class_exists('Confirm'))) {
	include_once 'classes/Confirm2.php'; 
}

if(!(class_exists('MailMessage'))) {
	include_once 'classes/MailMessage.php'; 
}

if(!empty($_REQUEST)) {
	
	$reg_confirm = new Confirm($_REQUEST);
	$reg_confirm->registrationValidate();
	$reg_confirm->closeLoginWindow();

}

?>