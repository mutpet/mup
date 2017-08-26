<?php

if(!isset($_SESSION)) { 
	session_start();
}

if(!(class_exists('MyDatabaseConnection'))) {
	include_once 'classes/MyDatabaseConnection.php'; 
}

class CheckCookie {



	public static function getCookie($cookie) {
		
		$database = new MyDatabaseConnection();
		$database->dataBaseConnect();
		
			$query_db_username = $database->prepare( "SELECT username FROM user WHERE MD5( username ) = :username ");
			$query_db_username->bindValue(':username', $cookie);
			$query_db_username->execute();
			$result = $query_db_username->fetch(\PDO::FETCH_OBJ);
			
			if($query_db_username->rowCount() == 1) {	
				$_SESSION['username'] = $result->username;
			}
	}


	
	

	
}	
?>