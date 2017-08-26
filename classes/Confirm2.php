<?php
//include_once ('classes/MydatabaseConnection.php');
ini_set('display_errors', 1);
if(!(class_exists('MyDatabaseConnection'))) {
	include_once 'classes/MyDatabaseConnection.php';
}

if(!(class_exists('MailMessage'))) {
	include_once 'classes/MailMessage.php';
}
	
/**
 * Regisztráció visszaigazolás osztályának definiciója
 *
 * @author Peter Mutter <mupetya@yahoo.co.uk>
 * @since 2017.07.20
 */
class Confirm {
	/**
    * @var array request 
    */
	private $request = array();
	
	/**
	*@ var object database
	*/
	private static $database = null;	
	
	// Konstruktor:
	public function __construct($request = array()) {
		//adatbázis kapcsolat 
		if(!(self::$database instanceof \PDO)) {
			  self::$database = (new MyDatabaseConnection())->dataBaseConnect();
		}
		$this->request = $request;
	
	}

	public function registrationValidate() {
			
			$confirm_query = self::$database->prepare( "SELECT confirm_code FROM user WHERE id = :id AND confirm_code = :code");
			$confirm_query->bindValue(':id', $this->request['id']);
			$confirm_query->bindValue(':code', $this->request['code']);
			$confirm_query->execute();
	
			if($confirm_query->rowCount() > 0) {
	
				$this->setConfirm();
				$this->getRegistrationData();
				
				header("location: index.php");
				$_SESSION['message'] = "Sikeres regisztráció megerősítés! Kérem jelentkezzen be./Successful registration confirmation! Please log in.";
				$_SESSION['message_class'] = "success";
				
				//Itt ezután hívnám meg az ebben a class-ban lévő getRegistrationData() metódust! 
				
	
			}else{
				header("location: index.php");
				$_SESSION['message'] = "A felhasználóhoz tartozó regisztráció megerősítés nem egyezik! / User and confirmation code dont match!";
				$_SESSION['message_class'] = "fail";
				
			}
			
			return;
	}
	
	
	private function setConfirm() {
	
			  self::$database->beginTransaction();
		try{
			  $update_sql = self::$database->prepare( "UPDATE `user` SET confirm_code = :reset,  confirm_date = NOW(), is_confirmed = :approve WHERE  id = :id AND confirm_code = :code");
			  $update_sql->bindValue(':reset', 0);
			  $update_sql->bindValue(':approve', 1);
			  $update_sql->bindValue(':id', $this->request['id']);
			  $update_sql->bindValue(':code', $this->request['code']);
			  $update_sql->execute();
			  self::$database->commit();
			}
		catch(Exception $e) {
			 self::$database->rollback();
			 header("location: index.php");
			 $_SESSION['message'] = 'Adatbázis hiba! A regisztráció megerősítése sikertelen! '.$e->getMessage();
			 $_SESSION['message_class'] = "fail";
			 }
			 
			 return;
	
	}
	
	
	public function getRegistrationData() {
			
			$user_details_query = self::$database->prepare("SELECT u.* FROM `user` u WHERE u.id = :id");
			$user_details_query->bindValue(':id', $this->request['id'], \PDO::PARAM_INT);
			$user_details_query->execute();
			$result = $user_details_query->fetch(\PDO::FETCH_ASSOC);
			
			$send_notice_email = (new MailMessage())->createRegistrationNoticeMail($result);
			
	}


}
?>
