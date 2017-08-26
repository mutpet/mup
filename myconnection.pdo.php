<?php
/**
	* PDO kapcsolódás 
	* Csatlakozás az lokális 'authentikacio' nevű adatbázishoz
	* Created by Peter Mutter
	* Date: 2017.03.07.
	*/
function newPdoConnection()
{	
	try {
    $dsn = 'mysql:host=localhost;dbname=authentikacio;charset=utf8';
    $options = array(
        \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false,
		\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		);
	$pdo = new \PDO($dsn, 'root', '12345', $options);
		} 
		catch(PDOException $eConn) {
			throw new Exception('PDO - Az adatbázis-kapcsolat létrehozása sikertelen: ' . $eConn->getMessage());
		}
		
    return $pdo;
}
?>