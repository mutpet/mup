<?php
if(!isset($_SESSION)) { 
	session_start();
}

if(!(class_exists('MyDatabaseConnection'))) {
	include_once 'classes/MyDatabaseConnection.php'; 
}

if(!(class_exists('Messages'))) {
	include_once 'classes/Messages.php'; 
}

if(!(class_exists('Warning'))) {
	include_once 'classes/Warning.php'; 
}

if(!(class_exists('Translator'))) {
	include_once 'classes/Translator.php'; 
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
	

	//Konstruktor:
	public function __construct($request = array()) {
		//adatbázis kapcsolat 
		if(!(self::$database instanceof \PDO)) {
			 self::$database = MyDatabaseConnection::dataBaseConnect();
		}
		$this->request = $request;
	}
	
	public function validateLogin() {
	
		//A regisztráció visszaigazolás, és a regisztrációkor kiválasztott avatar kép lekérdezése a 'user' adattáblából:	
		$user_query = self::$database->prepare( "SELECT is_confirmed, avatar FROM user WHERE username = :username AND password =  MD5( :password ) ");
		$user_query->bindValue(':username', $this->request['username']);
		$user_query->bindValue(':password', $this->request['password']);
		$user_query->execute();
		//Az Adatbázis lekérdezésének eredménye:
		$result = $user_query->fetch(\PDO::FETCH_OBJ);
		
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			/* --- A Bejelentkezéshez szükséges mezők vizsgálatai és hibakezelései: --- */
			try {
				//Felhasználónév ellenőrzései:
				if(empty($this->request['username'])) {
					//throw new \Exception('A bejelentkezéshez kérem adja meg felhasználónevét! / Please enter your username to log in!');
					throw new \Exception(Messages::getMessage('log_fail_text1'));
				}
				if(!preg_match('/^[a-zA-Z]{1}[a-zA-Z0-9._]{2,}/i', $this->request['username'])) {
					throw new \Exception(Messages::getMessage('log_fail_text2'));
				}			
			
				//Jelszó ellenőrzései:
				if(empty($this->request['password'])) {
					//throw new \Exception('A bejelentkezéshez kérem adja meg jelszavát! / Please enter your password to log in!');
					throw new \Exception(Messages::getMessage('log_fail_text3'));
				}
				if(!preg_match('/^[a-zA-Z0-9]{6,}$/', $this->request['password'])) {
					//throw new \Exception('A jelszó csak kis és nagybetűkből, számokból állhat, minimum 6 karakter!');
					throw new \Exception(Messages::getMessage('log_fail_text4'));
				}
			
				//A megadott bejelentkezési adatok ellenőrzése az adatbázis lekérdezéssel:
				if($user_query->rowCount() == 0) {
					//throw new \Exception('A felhasználónév vagy a jelszó nem megfelelő! Kérem próbálja meg újra! / The username or password is incorrect! Please try again!');
					throw new \Exception(Messages::getMessage('log_fail_text5'));
				}
				//A regisztráció megerősítés ellenőrzése:
				if($result->is_confirmed <= 0) {
					//throw new \Exception('A bejelentkezéshez, kérem erősítse meg regisztrációját a postafiókjába küldött automatikus e-mailben található link segítségével! Majd próbálja meg újra a bejelentkezést! / The user is not confirmed yet! Please try again!');
					throw new \Warning(Messages::getMessage('log_info_text1'));
				}
			}
			catch (\Warning $w) {
				$_SESSION['message_class'] = Messages::getCssClass('info');
				$_SESSION['message'] = $w->getMessage();
			}
			catch (\Exception $e) {
				$_SESSION['message'] = $e->getMessage();
				$_SESSION['message_class'] = Messages::getCssClass('error');
			}
	}	
	
	//A 'userLogin()' nevű metódus meghívása, és az adatbázis lekérdezés eredményének átadása a metódus számára:
	Login::userLogin($result);

	return;
		
}
	
	private function userLogin($result) {

			$file_name = '';
			$template_file = '';
			$message = '';
			$temp_array = array( 'login_button'=>null, 
								 'logout_button'=>null, 
								 'lang_hu'=>null, 
								 'lang_en'=>null, 
								 'menu_item'=>null,
								 'login_info' =>null,
								 'login_info_style' =>null,
								 'prefix'=>null,
								 'message'=>$message,
								 'visitors'=>null,
								 'script'=>null );

		$text = new Translator($_SESSION, $file_name);
		$text->TextTranslation($template_file, $temp_array);
	
		if(empty($this->request['rememberme'])) {
			$this->request['rememberme'] = '';
		}
		self::rememberMe($this->request['rememberme']);

		$avatar = '<img class="avatar" src="images/avatars/'.$result->avatar.'"/>';
		self::avatarDisplaying($avatar);

		if(!empty($_SESSION['username'])) {
	
			$_SESSION['avatar'] = $avatar;
			$_SESSION['message'] = Messages::getMessage('log_succ_text1');
			$_SESSION['message_class'] = Messages::getCssClass('succ');
		
			$this->closeLoginWindow();
			//exit();
		}

	return;

	}

	private static function avatarDisplaying($avatar) {
		
		if(empty($avatar)) {
			$avatar = '<img class="avatar" src="images/avatars/default_avatar.png"/>';		
		} 
		$_SESSION['avatar'] = $avatar;
		//$_SESSION['avatar'] = '<img class="avatar" src="images/avatars/'.$result->avatar.'"/>';
	return;

	}

	
	private function rememberMe($remember) {

		if($remember == "on") {
			$_SESSION['username'] = $this->request['username'];
			//$_SESSION['avatar'] =  '<img class="avatar" src="images/avatars/'.$result->avatar.'"/>';
			//Süti(Cookie) beállítása:
			setcookie('mup_user',md5($this->request['username']),time()+86400);   
		}else if($remember == "") {
			$_SESSION['username'] = $this->request['username'];
			//$_SESSION['avatar'] = '<img class="avatar" src="images/avatars/'.$result->avatar.'"/>';
		}

	return;
            
	}
	
	public function closeLoginWindow() {

		exit('<script>setTimeout(function(){ window.close(); }, 3000);</script>');

	return;

	}

	public static function checkCookie($cookie) {
		self::$database = MyDatabaseConnection::dataBaseConnect();
		$query_db_username = self::$database->prepare( "SELECT username, avatar FROM user WHERE MD5( username ) = :username ");
		$query_db_username->bindValue(':username', $cookie);
		$query_db_username->execute();
		$result = $query_db_username->fetch(\PDO::FETCH_OBJ);
			
		if($query_db_username->rowCount() == 1) {	
			$_SESSION['username'] = $result->username;
			$_SESSION['avatar'] = '<img class="avatar" src="images/avatars/'.$result->avatar.'"/>';
		}
	}	





}
?>