<?php
//session_start();

if(!(class_exists('MyDatabaseConnection'))) {
		include_once 'classes/MyDatabaseConnection.php'; 
}

if(!(class_exists('MailMessage'))) {
		include_once 'classes/MailMessage.php'; 
}

if(!(class_exists('Messages'))) {
	include_once 'classes/Messages.php';
}

if(!(class_exists('Warning'))) {
	include_once 'classes/Warning.php'; 
}
//include_once ('classes/MyDatabaseConnection.php');
//include_once('lib/phpmailer/class.phpmailer.php');
//include_once('template.php');

/**
 * A weboldalra való regisztráció(regisztrálás) osztály definiciója
 *
 * @author Peter Mutter <mupetya@yahoo.co.uk>
 * @since 2017.07.14
 **/ 
 
class Registration {

	/**
    * @var array request 
    */
	private $request = array();
	/**
    * @var null|object database 
    */
	private static $database = null;
	/**
	* @var int confirm_code
	*/
	private static $confirm_code;

	//Konstruktor
	public function __construct($request = array()) {
		//adatbázis kapcsolat 
		if(!(self::$database instanceof \PDO)) {
			  self::$database = MyDatabaseConnection::dataBaseConnect();
			  self::$confirm_code = mt_rand();
		}
		$this->request = $request;
	}
	
	public function checkRegistration() {
		
		if($_SERVER['REQUEST_METHOD'] == "POST") {
				/* --- A Regisztrációhoz szükséges mezők vizsgálatai és hibakezelései: --- */
			try {
					if(empty($this->request['lastname'])) {
						//throw new \Exception('A regisztrációhoz kérem adja meg vezetéknevét! / Please enter your name for registration!');
						throw new \Exception(Messages::getMessage('reg_fail_text1'));
					}
					if(empty($this->request['firstname'])) {
						//throw new \Exception('A regisztrációhoz kérem adja meg keresztnevét! / Please enter your name for registration!');
						throw new \Exception(Messages::getMessage('reg_fail_text2'));
					}	

					//Felhasználónév ellenőrzései:
					if(empty($this->request['username'])) {
						//throw new \Exception('A regisztrációhoz kérem adja meg felhasználónevét! / Please enter your username to register!');
						throw new \Exception(Messages::getMessage('reg_fail_text3'));
					}
					if(!preg_match('/^[a-zA-Z]{1}[a-zA-Z0-9._]{2,}/i', $this->request['username'])) {
						throw new \Exception(Messages::getMessage('reg_fail_text4'));
					}
					if(strlen($this->request['username']) > 25 ) {
						throw new \Exception(Messages::getMessage('reg_fail_text5'));
					}

					//E-mail cím ellenőrzései:
					if(empty($this->request['email'])) {
						//throw new \Exception('A regisztrációhoz kérem adja meg e-mail címét! / Please enter your e-mail address to register!');
						throw new \Exception(Messages::getMessage('reg_fail_text6'));
					}
					if(!filter_var($this->request['email'], FILTER_VALIDATE_EMAIL)) {
						throw new \Exception(Messages::getMessage('reg_fail_text7'));
					}

					//Jelszó ellenőrzései:
					if(empty($this->request['password'])) {
						//throw new \Exception('A regisztrációhoz kérem adjon meg egy jelszót! / Please enter a password to register!');
						throw new \Exception(Messages::getMessage('reg_fail_text8'));
					}
					if(!preg_match('/^[a-zA-Z0-9]{6,}$/', $this->request['password'])) {
						//throw new \Exception('A jelszó csak kis és nagybetűkből, számokból állhat, minimum 6 karakter!');
						throw new \Exception(Messages::getMessage('reg_fail_text9'));
					}
					/*
					if(strlen($this->request['password']) < 6 ) {
							//throw new \Exception('A jelszónak legalább 6 karakter hosszúnak kell lennie! / The password must be at least 6 characters long!');
							throw new \Exception(Messages::getMessage('reg_fail_text11'));
					}*/
					//Jelszó megerősítés ellenőrzései:
					if(empty($this->request['password2'])) {
						//throw new \Exception('A regisztrációhoz kérem erősítse meg jelszavát! / Please re-enter your password to register!');
						throw new \Exception(Messages::getMessage('reg_fail_text10'));
					}
					if($this->request['password'] != $this->request['password2']) {
						//throw new \Exception('A megadott jelszó nem egyezik meg a megerősített jelszóval! Kérem ellenőrizze! / The password you entered does not match your password! Please check!');
						throw new \Exception(Messages::getMessage('reg_fail_text11'));
					}
				
				}
				catch (\Exception $e) {
						//self::$database->rollback();
						$_SESSION['message_class'] = Messages::getCssClass('error');
						$_SESSION['message'] = $e->getMessage();
						header("Refresh:0; url=registration_form.php");
						//header("location: index.php"); 	//átirányítás az index.php oldalra
						//header("Refresh:0; url=index.php");
				}
			
		}	
			// ----------------------------------------------------------------------------------------------------------------------------------------------------------------- //
			/***** Az ugyanebben az osztályban lévő: 'setRegistration()' nevű metódus meghívása. Nem lehet a függvény statikus 'static' mert nem megy át a $this->request !   *****/
			/***** Az ugyanebben az osztályban lévő metódus kétféleképpen is meghívható: osztálynév::metódusnév(); VAGY egy valtozo = $this->metódusnév(); Ha pedig a         *****/
			/***** metódus static akkor pedig: self::metódusnév(); -el lehet meghívni. De ekkor a metódusnak static kulcsszóval kell definiálva lennie az osztályon belül!    *****/
			/***** Például: private static function metódusNév(){...} Viszont a statikus metódus belül csak az osztályon belüli statikusként definiált változókat éri el!     *****/
			/***** Statikus változók szintén az osztály elején vannak definiálva static kulcsszóval! 																		  *****/
			//  Nem lehet a függvény static mert nem megy át a $this->request !
			//	Igy is meghívható az ebben az osztályban lévő metódus!: $setRegistration = $this->setRegistration();
			// ---------------------------------------------------------------------------------------------------------------------------------------------------------------- //
				Registration::setRegistration();
			
				return;
	}
	
	private function setRegistration() {
		
		//Regisztráció létrehozása a User által megadott regisztrációs adatok felvitele a 'user' adattáblába!
				$reg_sql = self::$database->beginTransaction();
		 try {	
				$reg_sql = self::$database->prepare("INSERT INTO `user` (lastname, firstname, username, email, password, is_confirmed, confirm_code, avatar) VALUES (:lastname, :firstname, :username, :email, :password, :is_confirmed, :confirm_code, :avatar)");
				$reg_sql->bindValue(':lastname', $this->request['lastname']);
				$reg_sql->bindValue(':firstname', $this->request['firstname']);
				$reg_sql->bindValue(':username', $this->request['username']);
				$reg_sql->bindValue(':email', $this->request['email']);
				$reg_sql->bindValue(':password', md5($this->request['password']));
				$reg_sql->bindValue(':is_confirmed', 0);
				$reg_sql->bindValue(':confirm_code', self::$confirm_code);
				$reg_sql->bindValue(':avatar', $this->request['avatar']);
				$reg_sql->execute();
				$last_id = self::$database->lastInsertId();
				$reg_sql = self::$database->commit();
				}
		catch(\Exception $e) {
				$reg_sql = self::$database->rollback();
				exit(Messages::getMessage('reg_fail_text12') .$e->getMessage());
				}			
				/* Ez elvileg ide még egyszer felesleges. Elég akkor kiirni hogy minden ok, ha elment reg. visszaigazoló email hiba nélkül!
				$_SESSION['message'] = Messages::getMessage('reg_succ_text1');
				$_SESSION['message_class'] = Messages::getCssClass('succ');
				*/
				
				//$_SESSION['username'] = $this->request['username'];	
				//header("location: index.php"); 										//átirányítás az index.php oldalra
				
				//A legutolsó (frissen) beszúrt rekord id-jának meghatározása
				$forward_id = $this->getDataForConfirmMail($last_id);    //Az ugyanebben az osztályban lévő: 'getDataForConfirmMail' nevű metódus meghívása paraméterátadással (átadva neki az utolsó id-ít, mint a metódus argumentuma)

				return;
					
		}
	
	private function getDataForConfirmMail($last_id) {
		
				//A regisztrációval létrejött véletlenszerűen legenerált confirm_code, user e-mail cím, user teljes név értékeinek lekérdezése 
				$confirm_query = self::$database->prepare( "SELECT lastname, firstname, email, confirm_code FROM `user` WHERE id = :last_id" );
				$confirm_query->bindValue(':last_id', $last_id);
				$confirm_query->execute();
				$result = $confirm_query->fetch(\PDO::FETCH_ASSOC);
				
				//A 'MailMessage' nevű Osztályban lévő 'createConfirmMail' nevű metódus meghívása, négy paraméterátadással. (átadva neki az utolsó id-it és a lekérdezett confirm_code -ot, user e-mail címét, user teljes nevét. Mint a meghívott metódus argumentumai)
				$send_confirm_email = (new MailMessage())->createConfirmMail($last_id, $result['confirm_code'], $result['email'],  $result['lastname'], $result['firstname'] );
		
	}
	

}
?>