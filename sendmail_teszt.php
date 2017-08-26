<?php

include_once('lib/phpmailer/class.phpmailer.php');
//require 'PHPMailerAutoload.php';

	  $mail = new PHPMailer(true);
      //$mail->IsSMTP();
	  $mail->SMTPDebug = 4; // debugging: 1 = errors and messages, 2 = messages only
	  //$mail->Debugoutput = 'html';
	  $mail->SMTPAuth = true; // authentication enabled
	  $mail->SMTPSecure = "tls"; // secure transfer enabled REQUIRED for Gmail
      //$mail->FromName = "New success registration!";
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 587; //587
	  $mail->Username = "mupetike@gmail.com"; // GMAIL username
      $mail->Password = "samba123"; // GMAIL password
      //$mail->Encoding = "8bit";
      //$mail->CharSet = "utf-8";
      $mail->IsHTML(true);
      $mail->From = "sajat_teszt@gmail.com";
      $mail->Subject = "Teszt" ;
      $mail->Body = "Helló Peti ! :)";
      $mail->AddAddress("mupetike@gmail.com");
      $mail->AddCC("mupetya@yahoo.co.uk");
	  //$mail->addAttachment('images/my_logo.png');
      //$mail->AddBCC("","");
	  
	 if(!$mail->Send()) {
			echo "E-mail küldési hiba: " . $mail->ErrorInfo;
	  } else {
			echo "Az E-mail sikeresene elküldésre került!";
	}

/*
 cony69 commented on Feb 6 2016 :
It's an incredibly, but I remove $mail->IsSMTP(); and all work fine

https://github.com/PHPMailer/PHPMailer/issues/270
*/


















?>