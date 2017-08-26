<?php

if(!(class_exists('template'))) {
	include_once('template.php');
}

if(!(class_exists('MyMailer'))){
	include_once('classes/MyMailer.php');
}


class MailMessage {
	
	private  $user_agent = array();
	
	public function __construct(){
		$this->user_agent = $_SERVER['HTTP_USER_AGENT'];
		
	}
	
	private function dataForConfirmMail($letter_name, $last_id, $confirm_code) {
		
		$temp_confirm = new template("mail_template.html");
		$header_title = 'Regisztráció aktiválása / Activate registration:';
		$regverify_message_hu  = '<p>Kedves ' . $letter_name . '!</p>Köszönöm, hogy regisztrált weboldalamra!<br>Kérem, hogy az alábbi linkre való kattintással hagyja jóvá regisztrációját:</br>';
		$regverify_url_hu = '<p><a href="registration_verify.php?id=' . $last_id . '&code=' . $confirm_code . '">Regisztráció megerősítése</a></p>';
		$signature_hu = 'Üdvözlettel!<br>Mutter Péter</br><p></p><p></p><hr>';
		$regverify_message_en = '<p>Dear ' . $letter_name . '!</p>Thank you for registering at my website!<br>To activate your account, please click the link below:</br>';
		$regverify_url_en = '<p><a href="registration_verify.php?id=' . $last_id . '&code=' . $confirm_code . '">Confirmation of registration</a></p>';
		$signature_en = 'Regards!<br>Peter Mutter</br>';
		
		$temp_confirm->set('header_title', $header_title);
		$temp_confirm->set('regverify_message_hu', $regverify_message_hu);
		$temp_confirm->set('regverify_url_hu', $regverify_url_hu);
		$temp_confirm->set('signature_hu', $signature_hu);
		$temp_confirm->set('regverify_message_en', $regverify_message_en);
		$temp_confirm->set('regverify_url_en', $regverify_url_en);
		$temp_confirm->set('signature_en', $signature_en);
		
		//$forward_address = $this->createConfirmMail($address);
		
	return $temp_confirm->get();
		
	}
	

	private function dataForNoticeMail($result) {
		
		$temp_regnotice = new template("mail_template.html");
		//Táblázat fejlécének összeállítása:
		$header_title = 'Új, sikeres felhasználói regisztráció:';
		var_dump($result);
		$table = '<table border="1" cellspacing="0" cellpadding="0" width="100%">';
		$table .= '<thead><tr>';
		$table .= '<th bgcolor="#a9a9a9"><b>Teljes Név</b></th>';
		$table .= '<th bgcolor="#a9a9a9"><b>Felhasználónév</b></th>';
		$table .= '<th bgcolor="#a9a9a9"><b>E-mail</b></th>';
		$table .= '<th bgcolor="#a9a9a9"><b>Jelszó(MD5)</b></th>';
		$table .= '<th bgcolor="#a9a9a9"><b>Regisztráció Időpontja</b></th>';
		$table .= '<th bgcolor="#a9a9a9"><b>Visszaigazolás Időpontja</b></th>';
	
		$table .= '<th bgcolor="#a9a9a9"><b>Operációs rendszer</b></th>';
		$table .= '<th bgcolor="#a9a9a9"><b>Böngésző</b></th>';
		$table .= '<th bgcolor="#a9a9a9"><b>IP Cím</b></th>';
		$table .= '</thead>';
								
		//Táblázat cellák és adataik összeállítása:
		$table .= '<tbody>';
		$table .= '<tr>';
		$table .= '<td align="center" bgcolor="#faebd7">'. $result["name"] .'</td>';
		$table .= '<td align="center" bgcolor="#faebd7">' .$result["username"]. '</td>';
		$table .= '<td align="center" bgcolor="#faebd7">' .$result["email"]. '</td>';
		$table .= '<td align="center" bgcolor="#faebd7">' .$result["password"]. '</td>';
		$table .= '<td align="center" bgcolor="#faebd7">' .$result["date"]. '</td>';
		$table .= '<td align="center" bgcolor="#faebd7">' .$result["confirm_date"]. '</td>';
		
		$table .= '<td align="center" bgcolor="#faebd7">' . $this->getOS();  '</td>';
		$table .= '<td align="center" bgcolor="#faebd7">' . $this->getBrowser();  '</td>';
		$table .= '<td align="center" bgcolor="#faebd7">' . $this->getClientIp();  '</td>';
		$table .= '</tr>';
		$table .= '</tbody>';
		$table .= '</table>';

		$temp_regnotice->set('header_title', $header_title);
		$temp_regnotice->set('table', $table);
		

	return $temp_regnotice->get(); 

	}

	public function createRegistrationNoticeMail($result) {
		
	  $mail = new MyMailer(true);
	  $mail->From = "mupetike@gmail.com";
	  $mail->Subject = "Új regisztráció weboldalamon! / New user registration my own website!" ;
	  $mail->Body = $this->dataForNoticeMail($result);
	  $mail->AddAddress("mupetike@gmail.com");
	  //$mail->AddCC("mupetya@yahoo.co.uk");

	  if(!$mail->Send()) {
		echo "E-mail küldési hiba: " . $mail->ErrorInfo;
	  }else{
		echo "Az E-mail sikeresen elküldésre került! :)";
	  }
	  
	  return;
	  
	}

	public function createConfirmMail($last_id, $confirm_code, $address, $letter_name) {
		
	  $mail = new MyMailer(true);
	  $mail->From = "mupetike@gmail.com";
	  $mail->Subject = "Sikeres regisztráció visszaigazolás. (Kérem ne válaszoljon erre a levélre!) / Successful registration confirmation. (Please don't reply to this e-mail message!)" ;
	  $mail->Body = $this->dataForConfirmMail($letter_name, $last_id, $confirm_code);
	  //var_dump($address);
	  $mail->AddAddress($address);
	  
	  //$mail->AddCC("mupetya@yahoo.co.uk");
	  
	  if(!$mail->Send()) {
		echo "E-mail küldési hiba: " . $mail->ErrorInfo;
	  }else{
		echo "Az E-mail sikeresen elküldésre került! :)";
	  }
	  
	  return;

	}

	function getOS() { 

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$os_platform    =   "Unknown OS Platform";

		$os_array       =   array(
								'/windows nt 10/i'     =>  'Windows 10',
								'/windows nt 6.3/i'     =>  'Windows 8.1',
								'/windows nt 6.2/i'     =>  'Windows 8',
								'/windows nt 6.1/i'     =>  'Windows 7',
								'/windows nt 6.0/i'     =>  'Windows Vista',
								'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
								'/windows nt 5.1/i'     =>  'Windows XP',
								'/windows xp/i'         =>  'Windows XP',
								'/windows nt 5.0/i'     =>  'Windows 2000',
								'/windows me/i'         =>  'Windows ME',
								'/win98/i'              =>  'Windows 98',
								'/win95/i'              =>  'Windows 95',
								'/win16/i'              =>  'Windows 3.11',
								'/macintosh|mac os x/i' =>  'Mac OS X',
								'/mac_powerpc/i'        =>  'Mac OS 9',
								'/linux/i'              =>  'Linux',
								'/ubuntu/i'             =>  'Ubuntu',
								'/iphone/i'             =>  'iPhone',
								'/ipod/i'               =>  'iPod',
								'/ipad/i'               =>  'iPad',
								'/android/i'            =>  'Android',
								'/blackberry/i'         =>  'BlackBerry',
								'/webos/i'              =>  'Mobile'
							);

		foreach ($os_array as $regex => $value) { 

			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}

		}   

		return $os_platform;

	}
	
	
	function getBrowser() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Mozilla Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Google Chrome',
                            '/edge/i'       =>  'Edge',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

	}
	
	// Function to get the client IP address
	function getClientIp() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'ISMERETLEN IP CÍM!';
		return $ipaddress;
	}
	
}	
?>