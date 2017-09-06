<?php

if(!(class_exists('MyDatabaseConnection'))) {
	include_once 'classes/MyDatabaseConnection.php'; 
}

if(!(class_exists('MailMessage'))) {
	include_once 'classes/MailMessage.php';
}



/**
 * Elfelejtett jelszó igénylés osztály definiciója
 *
 * @author Peter Mutter <mupetya@yahoo.co.uk>
 * @since 2017.09.04
 */
 
class ForgotPassword {
	
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

 public function createVerifyCode() {

   // Hibakezelések:
   try {
			 if(empty($this->request['email'])) {
			    throw new \Exception('Kérem adja meg a regisztráció során megadott e-mail címét! / Please enter your e-mail address during registration!');
			 }
		     $email_query = self::$database->prepare( "SELECT id, name, email FROM `user` WHERE email = :email" );
		     $email_query->bindValue(':email', $this->request['email']);
		     $email_query->execute();
		     if($email_query->rowCount() == 0) {
			    throw new \Exception('A megadott e-mail címmel még nem történt regisztráció! / You have not registered yet with the given email address!');
			 }
	
			 $result = $email_query->fetch(\PDO::FETCH_ASSOC);
			 
	     }
   catch(\Exception $e) {
		    exit($e->getMessage());
	    }
  //Érvényesítő kód előállítása:
	$verify_code = '0123456789qwertzuiopasdfghjklyxcvbnm';
	$verify_code = str_shuffle($verify_code);
	$verify_code = substr($verify_code, 0, 10);
	
  //Érvényesítő kód eltárolása a 'user' adattáblába:
	$update_verify_code = self::$database->beginTransaction();
	try  {
		
			$update_verify_code = self::$database->prepare( "UPDATE `user` SET verify_code = :verify_code WHERE id = :id AND email = :email" );
			$update_verify_code->bindValue(':verify_code', $verify_code);
			$update_verify_code->bindValue(':id', $result['id']);
			$update_verify_code->bindValue(':email', $result['email']);
		    $update_verify_code->execute();
			self::$database->commit();
		   }
	catch(\Exception $e) {
			   $update_verify_code = self::$database->rollback();
			   exit('Adatbázis művelet hiba. Az ellenőrző kód létrehozása sikertelen! Kérem próbálja meg újra! / Database operation error. Unable to create verification code! Please try again!' .$e->getMessage());
		   }
  //Jelszó módosításhoz szükséges e-mail küldési metódus meghívása, a létrehozott érvényesítő kóddal	
		$send_reset_pw_email = (new MailMessage())->createResetPasswordMail($result, $verify_code);
		   
 }












}
?>