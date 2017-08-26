<?php
/**
 * Created by Notepad++
 * User: mutterp
 * Date: 2017.04.23.
 * Time: 18:55
 */
error_reporting(E_ALL);
ini_set('display_errors',1);
header("Content-Type: text/html; charset=utf-8");
if(!function_exists('newPdoConnection')){
include 'my_database_connection_pdo.php';	
}

// PDO kapcsolódás,  Csatlakozás az adatbázishoz
	$pdo = newPdoConnection();
			  
if (empty($_SESSION['languages'])){
	$_SESSION['languages'] = "_hu";
}

if (!empty($_GET["lang"])) { 
$_SESSION['languages'] = $_GET["lang"];
}
	

$query_menu = "SELECT m.menu, m.link 
						 FROM menu m
						 LEFT JOIN `language` l ON m.id_lang = l.id
						 WHERE l.country_code = :lang
						 ORDER BY m.menu_order";
$selectStatement = $pdo->prepare($query_menu);
$selectStatement->bindValue(':lang', $_SESSION['languages']);
$selectStatement->execute();	
$result_menu = $selectStatement->fetchAll();
$menu_item = '';
foreach($result_menu as $item => $menu){
	$menu_class = ($item == 0) ? ' class="active"' : '';
	$menu_item .= '<li><a'.$menu_class.' href="'.$menu["link"].'">'.$menu["menu"].'</a></li>';
} 	

	
?>
