<?php
/**
 * Az adatbázis kapcsolódás osztály definiciója
 *
 * @author Peter Mutter <mupetya@yahoo.co.uk>
 * @since 2017.07.22
 * Special thanks to: Csesznegi Dénes
 */
class MyDatabaseConnection{

		public function dataBaseConnect() {
			$pdo = null;
			$options = array(
										\PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
										\PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
										\PDO::ATTR_EMULATE_PREPARES => false,
										\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
									);
			try{
				$pdo = new \PDO("mysql:host=localhost; dbname=web", "root", "", $options);
			}
			catch(\PDOException $e) {
				$_SESSION['message'] = $e->getMessage();
				$_SESSION['message_class'] = "fail";
			}
			
			return $pdo;
			
		}

}
?>