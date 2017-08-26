<?php

ini_set('display_errors', 1);
/**
	* PDO kapcsolódás 
	* Csatlakozás az lokális 'web' nevű adatbázishoz
	* Created by: Peter Mutter
	* Create Date: 2017.03.29.
	*/
	
function newPdoConnection()
{	
	try {
    $dsn = 'mysql:host=localhost;dbname=web;charset=utf8';
    $options = array(
        \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false,
		\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		);
	$pdo = new \PDO($dsn, 'root', '', $options);
		} 
		catch(PDOException $eConn) {
			throw new Exception('PDO - Az adatbázis-kapcsolat létrehozása sikertelen: ' . $eConn->getMessage());
		}
		
    return $pdo;
}

/*
$host = 'localhost';
$user = 'root'
$pass = '12345';
$db = 'web';
try{
	$pdo = new pdo("mysql:host = $host; dbname = $db", $user, $pass);
}catch(PDOException $e){
	echo "Not Connected..".$e->getMessage();
}
*/
?>