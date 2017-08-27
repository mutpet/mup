<?php
if(!isset($_SESSION)) { 
	session_start();
}

if(!(class_exists('MyDatabaseConnection'))) {
	include_once 'classes/MyDatabaseConnection.php'; 
}
	
/**
 * A weboldalra való bejelentkezés(login-olás) osztály definiciója
 *
 * @author Peter Mutter <mupetya@yahoo.co.uk>
 * @since 2017.07.14
 */
class Login {
	
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
		//$this->database = $this->database->dataBaseConnect();
	}
	
	public function validate() {
		// Adattagok beállítása a paraméterek alapján
		//$this->username = $username;
		//$this->password =  $password;
	
	/* Hibakezelés 	
		if(empty($username)){
			throw new Exception('A bejelentkezéshez kérem adja meg felhasználónevét! / Please enter your username to log in!');
			$_SESSION['message'] = "A bejelentkezéshez kérem adja meg felhasználónevét! / Please enter your username to log in!";
			$_SESSION['message_class'] = "fail";
		}	
		
		if(empty($password)){
			throw new Exception('A bejelentkezéshez kérem adja meg jelszavát! / Please enter your password to log in!');
			$_SESSION['message'] = "A bejelentkezéshez kérem adja meg jelszavát! / Please enter your password to log in!";
			$_SESSION['message_class'] = "fail";
		}
		$user_query = $this->database->beginTransaction();
			try {
					$user_query = $this->database->prepare( "SELECT * FROM user WHERE username = :username AND password =  MD5( :password )");
					$user_query->bindValue(':username', $username);
					$user_query->bindValue(':password', $password);
					$user_query->execute();
					$result = $user_query->fetch(PDO::FETCH_ASSOC);
					$user_query_sql->commit();
				}
				catch(Exception $e) {
				$user_query = $this->database->rollback();
				exit('A bejelentkezés sikertelen! / Login failed! '.$e->getMessage());
				}	
		Ez még kelleni fog majd bele: if($result['is_confirmed'] == 0) {
											throw new Exception('A bejelentkezéshez, kérem erősítse meg regisztrációját a postafiokjába küldött automatikus e-mailben található link segítségével! Majd próbálja meg újra a bejelentkezést!');
											$_SESSION['message'] = "A bejelentkezéshez, kérem erősítse meg regisztrációját a postafiokjába küldött automatikus e-mailben található link segítségével! Majd próbálja meg újra a bejelentkezést! / The username or password is incorrect! Please try again!";
											$_SESSION['message_class'] = "fail";
										}
		
		*/
		
		try {
			
			if(empty($this->request['username'])) {
				throw new \Exception('A bejelentkezéshez kérem adja meg felhasználónevét! / Please enter your username to log in!');
			}
			
			if(empty($this->request['password'])) {
				throw new \Exception('A bejelentkezéshez kérem adja meg jelszavát! / Please enter your password to log in!');
			}
			
			$user_query = self::$database->prepare( "SELECT is_confirmed FROM user WHERE username = :username AND password =  MD5( :password ) ");
			$user_query->bindValue(':username', $this->request['username']);
			$user_query->bindValue(':password', $this->request['password']);
			//$user_query->bindValue(':is_confirmed', 1, \PDO::PARAM_INT);
			$user_query->execute();
			
			if($user_query->rowCount() == 0) {
				throw new \Exception('A felhasználónév vagy a jelszó nem megfelelő! Kérem próbálja meg újra! / The username or password is incorrect! Please try again!');
			}
			
			$result = $user_query->fetch(\PDO::FETCH_OBJ);
			if($result->is_confirmed <= 0) {
				throw new \Exception('A bejelentkezéshez, kérem erősítse meg regisztrációját a postafiokjába küldött automatikus e-mailben található link segítségével! Majd próbálja meg újra a bejelentkezést! / The user is not confirmed yet! Please try again!');
			}
			
			
			self::rememberMe($this->request['rememberme']);
			
			
			/* EREDETI MŰKÖDÉS:
			
					$_SESSION['message'] = "Ön sikeresen bejelentkezett!";
					$_SESSION['message_class'] = "success";
					$_SESSION['username'] = $this->request['username'];
					
			*/	
			
			if(!empty($_SESSION['username'])) {
				
					//var_dump($_COOKIE);	
					$_SESSION['message'] = "Ön sikeresen bejelentkezett!";
					$_SESSION['message_class'] = "success";
					
					$this->closeLoginWindow();
					exit();
			}
			
			
		/*
		if(isset($_COOKIE['mup_user']) && !empty($_COOKIE['mup_user'])) {
			
			$_SESSION['username'] = $_COOKIE['mup_user'];
			$_SESSION['message'] = "Ön sikeresen bejelentkezett!";
			$_SESSION['message_class'] = "success";
			$this->closeLoginWindow();
			exit();
		}
		
		/ array(2) { ["mup_user"]=> string(32) "64e9d01c6770ed34477d916873a737d4" ["PHPSESSID"]=> string(26) "tt23eg19jm1sfqfa1gjq9ft0n0" } 
		
		*/
					
		}
		catch (\Exception $e) {
			$_SESSION['message'] = $e->getMessage();
			$_SESSION['message_class'] = "fail";
		}
		
		return;
		
	// Régi működés:
	/*	
		if(!empty($username) && !empty($password)) { 
			$user_query = $this->database->prepare( "SELECT * FROM user WHERE username = :username AND password =  MD5( :password )");
			$user_query->bindValue(':username', $username);
			$user_query->bindValue(':password', $password);
			$user_query->execute();
		
			if($user_query->rowCount() == 1){
					echo "Sikeres belépés! / Successful entry!";
					$_SESSION['message'] = "Ön sikeresen bejelentkezett! / You are successfully logged in!";
					$_SESSION['message_class'] = "success";
					$_SESSION['username'] = $username;
					header("location: bejelentkezes.php?exit=1" );
					exit();
			}else{
					echo "Sikertelen belépés! / Login failed!";
					$_SESSION['message'] = "A felhasználónév vagy a jelszó nem megfelelő! Kérem próbálja meg újra! / The username or password is incorrect! Please try again!";
					$_SESSION['message_class'] = "fail";
					}
		
		}else{
				echo "A bejelentkezéshez kérem adja meg felhasználónevét és jelszavát! / Please enter your username and password to log in!";
				$_SESSION['message'] = "A bejelentkezéshez kérem adja meg felhasználónevét és jelszavát! / Please enter your username and password to log in!";
				$_SESSION['message_class'] = "fail";
				}
	*/			
	}
	
	/*
	public static function getCookie() {	
			if(!empty($_COOKIE['mup_user'])) {
			
			$_SESSION['username'] = $_COOKIE['mup_user'];
			$_SESSION['message'] = "Ön sikeresen bejelentkezett!";
			$_SESSION['message_class'] = "success";
			
			exit();
		   }
		}	
	*/
	
	private function rememberMe($remember) {

				if($remember == "on") {
					
					$_SESSION['username'] = $this->request['username'];
					setcookie('mup_user',md5($this->request['username']),time()+86400);   

				}else if($remember == "") {
                   
					$_SESSION['username'] = $this->request['username'];

				}

				return;
            
			}
	

	public function closeLoginWindow() {
		
		exit('<script>setTimeout(function(){ window.close(); }, 3000);</script>');
						
	}

	public static function checkCookie($cookie) {
			self::$database = MyDatabaseConnection::dataBaseConnect();
			$query_db_username = self::$database->prepare( "SELECT username FROM user WHERE MD5( username ) = :username ");
			$query_db_username->bindValue(':username', $cookie);
			$query_db_username->execute();
			$result = $query_db_username->fetch(\PDO::FETCH_OBJ);
			
			if($query_db_username->rowCount() == 1) {	
				$_SESSION['username'] = $result->username;
			}
	}	
	
}

?>