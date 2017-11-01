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
	
	private function checkRegistration() {
		
		//Regisztrációhoz szükséges mezők vizsgálatai és hibakezelései
		try {
				
				if(empty($this->request['name'])) {
					throw new \Exception('A regisztrációhoz kérem adja meg nevét! / Please enter your name for registration!');
				}
				
				if(empty($this->request['username'])) {
					throw new \Exception('A regisztrációhoz kérem adja meg felhasználónevét! / Please enter your username to register!');
				}
				
				if(empty($this->request['email'])) {
					throw new \Exception('A regisztrációhoz kérem adja meg e-mail címét! / Please enter your e-mail address to register!');
				}
				
				if(empty($this->request['password'])) {
					throw new \Exception('A regisztrációhoz kérem adjon meg egy jelszót! / Please enter a password to register!');
				}
				
				if(empty($this->request['password2'])) {
					throw new \Exception('A regisztrációhoz kérem erősítse meg jelszavát! / Please re-enter your password to register!');
				}
				
				if(strlen($this->request['password']) < 6 ) {
					throw new \Exception('A jelszónak legalább 6 karakter hosszúnak kell lennie! / The password must be at least 6 characters long!');
				}
				
				if($this->request['password'] != $this->request['password2']) {
					throw new \Exception('A megadott jelszó nem egyezik meg a megerősített jelszóval! Kérem ellenőrizze! / The password you entered does not match your password! Please check!');
				}
			
				}
				catch (\Exception $e) {
				//self::$database->rollback();
				$_SESSION['message'] = $e->getMessage();
				$_SESSION['message_class'] = "error";
				//header("location: index.php"); 										//átirányítás az index.php oldalra
				
				}
				
				return;
	}
	
	public function setRegistration() {
		
		$registration_validation = $this->checkRegistration();				//Az ugyanebben az osztályban lévő: 'checkRegistration' nevű metódus meghívása
		
		
		//Regisztráció létrehozása, a User által megadott regisztrációs adatok felvitele a 'user' adattáblába
				$reg_sql = self::$database->beginTransaction();
		 try {	
				$reg_sql = self::$database->prepare("INSERT INTO `user` (name, username, email, password, is_confirmed, confirm_code) VALUES (:name, :username, :email, :password, :is_confirmed, :confirm_code)");
				$reg_sql->bindValue(':name', $this->request['name']);
				$reg_sql->bindValue(':username', $this->request['username']);
				$reg_sql->bindValue(':email', $this->request['email']);
				$reg_sql->bindValue(':password', md5($this->request['password']));
				$reg_sql->bindValue(':is_confirmed', 0);
				$reg_sql->bindValue(':confirm_code', self::$confirm_code);
				$reg_sql->execute();
				$last_id = self::$database->lastInsertId();
				$reg_sql = self::$database->commit();
				}
		catch(\Exception $e) {
				$reg_sql = self::$database->rollback();
				exit('Sikertelen regisztráció! A regisztráció nem jött létre. A művelet visszavonásra került. Kérem próbálja újra! / Registration failed! Registration was not created. The operation was canceled. Please try again!' .$e->getMessage());
				}			
		
				$_SESSION['message'] = "Sikeres regisztráció! Kérem erősítse meg regisztrációját a postafiókjába küldött e-mailben található link segítségével! / Successful registration! Please confirm your registration with the link in your email account!" ;
				$_SESSION['message_class'] = "success";
				//$_SESSION['username'] = $this->request['username'];	
				//header("location: index.php"); 										//átirányítás az index.php oldalra
				
				//A legutolsó (frissen) beszúrt rekord id-jának meghatározása
				$forward_id = $this->getDataForConfirmMail($last_id);    //Az ugyanebben az osztályban lévő: 'getDataForConfirmMail' nevű metódus meghívása paraméterátadással (átadva neki az utolsó id-ít, mint a metódus argumentuma)
						//var_dump($last_id);
				return;
					
		}
	
	private function getDataForConfirmMail($last_id) {
		
				//A regisztrációval létrejött véletlenszerűen legenerált confirm_code, user e-mail cím, user teljes név értékeinek lekérdezése 
				$confirm_query = self::$database->prepare( "SELECT name, email, confirm_code FROM `user` WHERE id = :last_id" );
				$confirm_query->bindValue(':last_id', $last_id);
				$confirm_query->execute();
				$result = $confirm_query->fetch(\PDO::FETCH_ASSOC);
				
				//A 'MailMessage' nevű Osztályban lévő 'createConfirmMail' nevű metódus meghívása, négy paraméterátadással. (átadva neki az utolsó id-it és a lekérdezett confirm_code -ot, user e-mail címét, user teljes nevét. Mint a meghívott metódus argumentumai)
				$send_confirm_email = (new MailMessage())->createConfirmMail($last_id, $result['confirm_code'], $result['email'],  $result['name']);
		
	}
	

}
?>