<?php
/*
	session_start();
	//session_destroy();
	unset($_SESSION['username']);
	$_SESSION['message'] = "Ön sikeresen kijelentkezett!";
	header("location: index.php");
	exit();
*/


/**
 * A weboldalról való kijelentkezési osztály(Logout) illetve a kijelentkezési metódus(loggingOut) meghívása
 *
 * @author Peter Mutter <mupetya@yahoo.co.uk>
 * @since 2017.08.21
 */


if(!(class_exists('Logout'))) {
	include_once  'classes/Logout.php'; 
}

Logout::loggingOut();


	
?>