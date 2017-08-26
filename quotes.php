<?php
/**
 * Created by Notepad++
 * User: mutterp
 * Date: 2017.06.03.
 * Time: 23:10
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
	

$query_quotes = "SELECT q.id, q.id_web, q.text 
						  FROM quotes q
						  LEFT JOIN `language` l ON q.id_lang = l.id
						  WHERE l.country_code = :lang
						  AND q.id_web = 0
						  ORDER BY q.id ASC";				  
$selectStatement = $pdo->prepare($query_quotes);
$selectStatement->bindValue(':lang', $_SESSION['languages']);
$selectStatement->execute();	
$result_quotes = $selectStatement->fetchAll();

//$quotes_class = '';
/*
foreach($result_quotes as $item => $quote){
	
	
	//$quotes = '<span class="item-3">'. $quote["text"] .'</span>';
	$quotes = $quote["text"];
	
	
} 	
*/
	
	foreach($result_quotes as $key){
	
	
	//$quotes = '<span class="item-3">'. $quote["text"] .'</span>';
	$quotes = $key["text"];
	
	
} 	
?>
