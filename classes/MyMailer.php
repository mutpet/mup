<?php

if(!(class_exists('PHPMailer'))) {
	include_once 'lib/phpmailer/class.phpmailer.php';
}

/**
 * Automatikus E-mail küldés osztályának definiciója
 *
 * @author Peter Mutter <mupetya@yahoo.co.uk>
 * @since 2017.07.16
 */
class MyMailer extends PHPMailer {
	
	public function __construct($exceptions = null) {
	//	if($exceptions !== null) {
	//		parent:: __construct($exceptions);
	//	}
		$this->mailSettings();
	}	
/**
* E-mail beállítások
*
* SMTPDebug:  Enable SMTP debugging: 1 = errors and messages, 2 = messages only, 4 = to get more feedback on connection errors. (0 = off (for production use), 1 = client messages,  2 = client and server messages)
* SMTPAuth: SMTP authentication enabled
* SMTPSecure SSL : secure transfer enabled REQUIRED for Gmail
* Host: Specify main and backup SMTP servers
* Port: SMTP port
* Username: GMAIL username (SMTP username)
* Password: GMAIL password (SMTP password)
* CharSet: character coding
* IsHTML(true): Set email format to HTML
*/		
	public function mailSettings() {
		
		$this->SMTPDebug = 4; 
		$this->SMTPAuth = true;
		$this->SMTPSecure = "ssl";
		$this->Host = "smtp.gmail.com";
		$this->Port = 587;
		$this->Username = "mupetike@gmail.com";
		$this->Password = "samba123";
		$this->CharSet = "utf-8";
		$this->IsHTML(true);
		
		return;
	}

 
}

?>


