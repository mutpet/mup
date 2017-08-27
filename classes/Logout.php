<?php

session_start();

if(!(class_exists('MyDatabaseConnection'))) {
	include_once  'classes/MyDatabaseConnection.php'; 
}
	
/**
 * A weboldalról való kijelentkezés(logout-olás) osztály definiciója
 *
 * @author Peter Mutter <mupetya@yahoo.co.uk>
 * @since 2017.08.21
 */
class Logout {
	
	/**
    * @var array request 
    */
	private $request = array();
	/**
    * @var null|object database 
    */
	private static $database = null;
	
	
	// Konstruktor:
	public function __construct ($request = array()) {
		//adatbázis kapcsolat 
		//self::$pdo = newPdoConnection();
		if(!(self::$database instanceof \PDO)) {
			  self::$database = MyDatabaseConnection::dataBaseConnect();
		}
		$this->request = $request;
		
	}
	
		public static function loggingOut() {
			
		//destroy session !
			unset($_SESSION['username']);
		//unset cookie !
			setcookie('mup_user','',time()-86400);
		//logout message	
			$_SESSION['message'] = "Ön sikeresen kijelentkezett!";
			$_SESSION['message_class'] = "success";
			header("location: index.php");
			exit();
				
		}
		
}

?>	