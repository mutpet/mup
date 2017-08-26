<?php
//include_once ('classes/MydatabaseConnection.php');

if(!(class_exists('MyDatabaseConnection'))) {
	include_once 'classes/MyDatabaseConnection.php';
}

if(!(class_exists('MailMessage'))) {
	include_once 'classes/meg_nemtom.php';
}
	
/**
 * Regisztráció visszaigazolás osztályának definiciója
 *
 * @author Peter Mutter <mupetya@yahoo.co.uk>
 * @since 2017.07.20
 */
class Confirm {
	
	/**
    * @var integer id
    */
	private  $id = $_GET['id'];
	 /**
    * @var integer confirm_code 
    */
	private $confirm_code = $_GET['code'];
	/**
	*@ var object database
	*/
	private $database;
	
	
	// Konstruktor:
	public function __construct() {
		//adatbázis kapcsolat 
		$this->database = new MyDatabaseConnection()->dataBaseConnect();
		//$this->database = $this->database->dataBaseConnect();
		$this->id = $id;
		$this->confirm_code = $confirm_code;
	}

	public function confirmation() {

			$user_query = $this->database->prepare( "SELECT * FROM user WHERE id = :id");
			$user_query->bindValue(':id', $this->id);
			$user_query->execute();
			$result = $user_query->fetch(PDO::FETCH_ASSOC);
	
			$db_code = $result['confirm_code'];
			$db_name = $result['name'];
			$db_username = $result['username'];
			$db_email = $result['email'];
			$db_password = $result['password'];
			$db_date = $result['date'];
			$db_confirm_date = $result['confirm_date'];
			
			if($this->confirm_code == $db_code) {
				
				$update_sql = $this->database->beginTransaction();
				try{
					$update_sql = $this->database->prepare( "UPDATE user SET is_confirmed = 1");
					$update_sql->execute();
					$update_sql = $this->database->prepare( "UPDATE user SET confirm_code = 0");
					$update_sql->execute();
					$update_sql = $this->database->prepare( "UPDATE user SET confirm_date = NOW()");
					$update_sql->execute();
					$update_sql->commit();
					}
				catch(Exception $e) {
				$update_sql = $this->database->rollback();
				exit('A regisztráció megerősítése sikertelen! '.$e->getMessage());
				}
					header("location: bejelentkezes.php");
					$noticemail = new MailMessage->createRegistrationNoticeMail($db_name, $db_username, $db_email, $db_password, $db_date, $db_confirm_date);
			}else{
				//throw new Exception('A felhasználóhoz tartozó regisztráció megerősítés nem egyezik! / User and confirmation code dont match!');
				header("location: index.php");
				$_SESSION['message'] = "A felhasználóhoz tartozó regisztráció megerősítés nem egyezik! / User and confirmation code dont match!";
				$_SESSION['message_class'] = "fail";
			}
	}



}
?>
