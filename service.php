<?php
/**
 * Created by PhpStorm.
 * User: mutterp
 * Date: 2017.03.24.
 * Time: 18:16
 */
session_start();
//Hiba ellenőrzések beépített függvényei:
error_reporting(E_ALL);
ini_set('display_errors',1);
header("Content-Type: text/html; charset=utf-8");
//include 'template.php';
//include 'my_database_connection_pdo.php';
//include 'visitor_counter.php';
//include 'menu.php';
//include 'quotes.php';
//$tmp = new template("service.html");

if(!(class_exists('GetLanguage'))) {
	include_once 'classes/GetLanguage.php'; 
}


$script = '<script language="javascript" src="jquery-1.8.3.min.js"></script>			  
			  <script type="text/javascript" src="main.js"></script>
			  <link rel="stylesheet" type="text/css" href="main.css">
			  <link rel="stylesheet" type="text/css" href="service.css">';

//Alapértelmezett nyelvi beállítási érték. (Az alapértelmezett nyelv a Magyar nyelv.)
$lang_hu = '<img src="images/lang_hu.png"/>';

//Template html fájl (felület) meghatározása
$template_file = 'service.html';


//A 'setLanguageForPage' nevű statikus metódus meghívása. (a többnyelvűség általános működésének végrehajtása)  
GetLanguage::setLanguageForPage($template_file, basename(__FILE__), $script, $lang_hu);

?>