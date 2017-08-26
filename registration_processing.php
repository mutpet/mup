<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

if(!(class_exists('MailMessage'))) {
	include_once 'classes/MailMessage.php'; 
}

if(!(class_exists('Registration'))) {
	include_once 'classes/Registration.php'; 
}

if(!empty($_REQUEST)) {
	
$new_reg = new Registration($_REQUEST);
$new_reg->setRegistration();

}

?>