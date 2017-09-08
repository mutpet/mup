<?php

if(!(class_exists('MyDatabaseConnection'))) {
	include_once 'classes/MyDatabaseConnection.php'; 
}

if(!(class_exists('MailMessage'))) {
	include_once 'classes/MailMessage.php';
}
/**
 * Jelszó módosításának osztály definiciója
 *
 * @author Peter Mutter <mupetya@yahoo.co.uk>
 * @since 2017.09.08
 */
class NewPassword {
	/**
    * @var array request 
    */
	private $request = array();
	/**
    * @var null|object database 
    */
	private static $database = null;

	// Konstruktor:
	public function __construct($request = array()) {
	
	 //adatbázis kapcsolat 
	 if(!(self::$database instanceof \PDO)) {
		   self::$database = MyDatabaseConnection::dataBaseConnect();
	 }
		
	 $this->request = $request;
	 
	}

 public function validateInputs() {	
   //Hibakezelések:
   try {
			   if(empty($this->request['verify_code'])) {
					throw new \Exception('Kérem adja meg az e-mail -ben kapott érvényesítő kódját! / Please enter the verification code you received in your email!');
				  }
			   if(empty($this->request['new_password1'])) {
					throw new \Exception('Kérem adja meg új jelszavát! / Please enter your new password!');
				  }
			   if(empty($this->request['new_password2'])) {
					throw new \Exception('Kérem erősítse meg új jelszavát! / Please confirm your new password!');
				  }
			   if($this->request['new_password1'] != $this->request['new_password2']) {
					throw new \Exception('A megadott jelszó nem egyezik meg a megerősített jelszóval! Kérem ellenőrizze! / The password you entered does not match your password! Please check!');
				 }
			   if(strlen($this->request['new_password1']) < 6) {
						throw new \Exception('A jelszónak legalább 6 karakter hosszúnak kell lennie! / The password must be at least 6 characters long!');
				 }
         }	 
   catch(\Exception $e) {
		   exit($e->getMessage());	
	     }
 }
 
 
 public function modifyPassword() {
	
			$update_password = self::$database->beginTransaction();
	try  {
			$update_password = self::$database->prepare( " UPDATE `user` SET password = :password WHERE id = :id AND email = :email AND verify_code = :verify_code " );
			$update_password->bindValue(':password', md5($this->request['new_password1']));
			$update_password->bindValue(':verify_code', $this->request['verify_code']);
			$update_password->bindValue(':id', $this->request['id']);
			$update_password->bindValue(':email', $this->request['mail']);
		    $update_password->execute();
			self::$database->commit();
		    }
	catch(\Exception $e) {
			   $update_password = self::$database->rollback();
			   exit('Adatbázis művelet hiba. Új jelszó létrehozása sikertelen! Kérem próbálja meg újra! / Database operation error. Create a new password failed! Please try again!' .$e->getMessage());
		   }
 }



 
}
?>