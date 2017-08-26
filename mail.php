<?php

include_once('lib/phpmailer/class.phpmailer.php');
//
 function registrationMailNotice(){
	  $mail = new PHPMailer(true);
      //$mail->IsSMTP();
	  $mail->SMTPDebug = 4; // debugging: 1 = errors and messages, 2 = messages only
	  //$mail->Debugoutput = 'html';
	  $mail->SMTPAuth = true; // authentication enabled
	  $mail->SMTPSecure = "ssl"; // secure transfer enabled REQUIRED for Gmail
      //$mail->FromName = "New success registration!";
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 587; //587
	  $mail->Username = "mupetike@gmail.com"; // GMAIL username
      $mail->Password = "samba123"; // GMAIL password
      //$mail->Encoding = "8bit";
      $mail->CharSet = "utf-8";
      $mail->IsHTML(true);
      $mail->From = "sajat_teszt@gmail.com";
      $mail->Subject = "Új regisztráció a weboldalamon!/New user registration my own website!" ;
      $mail->Body = dataForMailNotice();
      $mail->AddAddress("mupetike@gmail.com");
      $mail->AddCC("mupetya@yahoo.co.uk");
	  //$mail->addAttachment('images/my_logo.png');
      //$mail->AddBCC("","");
	  
	 if(!$mail->Send()) {
			echo "E-mail küldési hiba: " . $mail->ErrorInfo;
	  } else {
			echo "Az E-mail sikeresen elküldésre került! :)";
	}
}
/*
//e-mail törzsben lévő html táblázat fejlécének összeállítása
				$body = '<strong>Új sikeres felhasználói regisztráció a weboldalamon!:</strong><br><br>';
				$body .= '<table border="1" cellspacing="0" cellpadding="0" width="100%">';
				$body .= '<thead>';
				$body .= '<tr>';
				$body .= '<th bgcolor="#a9a9a9"><b>Teljes Név</b></th>';
				$body .= '<th bgcolor="#a9a9a9"><b>Felhasználónév</b></th>';
				$body .= '<th bgcolor="#a9a9a9"><b>E-mail</b></th>';
				$body .= '<th bgcolor="#a9a9a9"><b>Jelszó(MD5)</b></th>';
				$body .= '</thead>';
				
				//Táblázat cellák és adataik összeállítása:
				$body .= '<tbody>';
				$body .= '<tr>';
				$body .= '<td align="center" bgcolor="#faebd7"> tesztadat_1 </td>';
				$body .= '<td align="center" bgcolor="#faebd7"> tesztadat_2 </td>';
				$body .= '<td align="center" bgcolor="#faebd7"> tesztadat_3 </td>';
				$body .= '<td align="center" bgcolor="#faebd7"> tesztadat_4 </td>';
				$body .= '</tr>';
				$body .= '</tbody>';
				$body .= '</table>';
*/				$body = "";
				//levélküldő függvény meghívása!:
				dataForMailNotice();
				registrationMailNotice();
				
				function dataForMailNotice(){
						//e-mail törzsben lévő html táblázat fejlécének összeállítása
						$body = '<strong>Új sikeres felhasználói regisztráció a weboldalamon!:</strong><br><br>';
						$body .= '<table border="1" cellspacing="0" cellpadding="0" width="100%">';
						$body .= '<thead>';
						$body .= '<tr>';
						$body .= '<th bgcolor="#a9a9a9"><b>Teljes Név</b></th>';
						$body .= '<th bgcolor="#a9a9a9"><b>Felhasználónév</b></th>';
						$body .= '<th bgcolor="#a9a9a9"><b>E-mail</b></th>';
						$body .= '<th bgcolor="#a9a9a9"><b>Jelszó(MD5)</b></th>';
						$body .= '</thead>';
						
						//Táblázat cellák és adataik összeállítása:
						$body .= '<tbody>';
						$body .= '<tr>';
						$body .= '<td align="center" bgcolor="#faebd7"> tesztadat_1 </td>';
						$body .= '<td align="center" bgcolor="#faebd7"> tesztadat_2 </td>';
						$body .= '<td align="center" bgcolor="#faebd7"> tesztadat_3 </td>';
						$body .= '<td align="center" bgcolor="#faebd7"> tesztadat_4 </td>';
						$body .= '</tr>';
						$body .= '</tbody>';
						$body .= '</table>';
				
				return $body;		
					
					
				}


























?>