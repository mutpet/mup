<?php
if(!(class_exists('MailMessage'))) {
include_once 'meg_nemtom.php'; 
}
//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
 $mail_test = new MailMessage();
 //$mail_test->dataForNoticeMail();
 //$mail_test->dataForConfirmMail();
 
 //$mail_test->createRegistrationNoticeMail();
 $mail_test->createConfirmMail();
 
 exit();


?>