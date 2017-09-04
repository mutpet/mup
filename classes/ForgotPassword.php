<?php



if(!(class_exists('MyDatabaseConnection'))) {
	include_once 'classes/MyDatabaseConnection.php'; 
}
/*
if(!(class_exists('MailMessage'))) {
	include_once 'classes/MailMessage.php';
}
*/


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
/*
	private static function errorHandling() {
	
	 try {
			if(empty($this->request['email'])) {
			   throw new \Exception('Kérem adja meg a regisztráció során megadott e-mail címét! / Please enter your e-mail address during registration!');
			}	
	catch (\Exception $e) {
			$_SESSION['message'] = $e->getMessage();
			$_SESSION['message_class'] = "fail";
	  }		
	  }
    }	 
*/
	public function validateEmail() {
	 
	 //$this->errorHandling();
	 //Hibakezelések:
	  try {
			if(empty($this->request['email'])) {
				throw new \Exception('Kérem adja meg a regisztráció során megadott e-mail címét! / Please enter your e-mail address during registration!');
			}	
		    $email_query = self::$database->prepare( "SELECT id FROM user WHERE email = :email");
		    $email_query->bindValue(':email', $this->request['email']);
		    $email_query->execute();
		    if($email_query->rowCount() == 0) {
			   throw new \Exception('A megadott e-mail címmel még nem történt regisztráció! / You have not registered yet with the given email address!');
			}
	  }	
	  catch (\Exception $e) {
		   $notice = $e->getMessage();
		   echo $notice;
			/*$_SESSION['message'] = $e->getMessage();
			$_SESSION['message_class'] = "fail";*/
	  }
	  
	  return;
	  
	}


	public function createResetURL() {
		
	$str = '0123456789qwertzuiopasdfghjklyxcvbnm';
	$str = str_shuffle($str);
	$str = substr($str, 0, 10);	
	
    $url = 'resetpassword.php?token='.$str.'&email='.$this->request["email"];
		
	}












}
?>