<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
//require_once 'my_database_connection_pdo.php';
//var_dump(is_callable('newPdoConnection'));
if (is_callable('newPdoConnection') == false){
	include  'my_database_connection_pdo.php';
}
function countVisitors()
{
$pdo = newPdoConnection();
// Get Ip
$ip = $_SERVER['REMOTE_ADDR'];
// Check if this ip exist in out data
$ip_address_query = "SELECT ip_address FROM visitors WHERE ip_address = :ip ";
$selectStatement = $pdo->prepare($ip_address_query);
$selectStatement->bindValue(':ip', $ip);
$selectStatement->execute();	
$CheckIp = $selectStatement->rowCount();
if ($CheckIp == 0) {
	$ip_address_insert_query = "INSERT INTO visitors SET ip_address = :ip ";
	$insertStatement = $pdo->prepare($ip_address_insert_query);
	//$insertStatement->bindValue(':id', '');
	$insertStatement->bindValue(':ip', $ip);
	$insertStatement->execute();
}
$visitors_query = 	"SELECT ip_address FROM visitors" ;
$selectStatement = $pdo->prepare($visitors_query);
$selectStatement->execute();
$visitors = $selectStatement->rowCount();

    return $visitors;
}

?>