<?php

if(!isset($_SESSION)) { 
	session_start();
}

class Messages {
	
	public static $messageText = array(
		'_hu' => array(
					/************** HU ************/
					//Bejelentkezés magyar nyelvű üzenetei   (classes\Login.php, classes\Logout.php) 
					'log_succ_text1'  => 'Ön sikeresen bejelentkezett!',
					'log_succ_text2' => 'Ön sikeresen kijelentkezett!',
					
					'log_fail_text1' => 'A bejelentkezéshez kérem adja meg felhasználónevét!',
					'log_fail_text2' => 'A bejelentkezéshez kérem adja meg jelszavát!',
					'log_fail_text3' => 'A felhasználónév vagy jelszó nem megfelelő! Kérem próbálja meg újra!',
					
					'log_info_text1' => 'A bejelentkezéshez, kérem erősítse meg regisztrációját a postafiokjába küldött automatikus e-mailben található link segítségével! Majd próbálja meg újra a bejelentkezést!',
					//Regisztráció magyar nyelvű üzenetei:   (classes\Registration.php)
					'reg_succ_text1' => 'Sikeres regisztráció! Kérem erősítse meg regisztrációját a postafiókjába küldött e-mailben található link segítségével!',
					'reg_fail_text1' => 'A regisztrációhoz kérem adja meg Vezetéknevét!',
					'reg_fail_text2' => 'A regisztrációhoz kérem adja meg Keresztnevét!',
					'reg_fail_text3' => 'A regisztrációhoz kérem adja meg Felhasználónevét!',
					'reg_fail_text4' => 'Nem megfelelő felhasználónév! A felhasználónév csak betűket,számokat,pontot,alulvonást tartalmazhat!',
					'reg_fail_text5' => 'Nem megfelelő felhasználónév! A felhasználónév maximum 20 karakter lehet!',
					'reg_fail_text6' => 'A regisztrációhoz kérem adja meg E-mail címét!',
					'reg_fail_text7' =>	'Nem megfelelő/érvényes e-mail cím! Kérem ellenőrizze!',
					'reg_fail_text8' => 'A regisztrációhoz kérem adjon meg egy Jelszót!',
					'reg_fail_text9' => 'A jelszó csak kis és nagybetűkből, számokból állhat, minimum 6 karakter!',
					'reg_fail_text10' => 'A regisztrációhoz kérem erősítse meg Jelszavát!',
					'reg_fail_text11' => 'A megadott jelszó nem egyezik meg a megerősített jelszóval! Kérem ellenőrizze!',
					'reg_fail_text12' => 'Sikertelen regisztráció! A regisztráció nem jött létre. A művelet visszavonásra került. Kérem próbálja újra!',
					'reg_fail_text13' => 'Sikertelen regisztráció! Regisztráció nem jött létre. Kérem próbálja újra!',
					//Elfelejtette jelszavát? Bejelentkező ablakról elérhető funkció üzenetei   (classes\ForgotPassword.php Felülete: \forgotpassword.php)
					'forg_pw_fail_text1' => 'A megadott e-mail címmel még nem történt regisztráció!',
					'forg_pw_fail_text2' => 'Adatbázis művelet hiba. Az ellenőrző kód létrehozása sikertelen! Kérem próbálja meg újra!',
        ),
        '_en' => array(
					/************** EN *************/
					//Bejelentkezés angol nyelvű üzenetei   (classes\Login.php, classes\Logout.php)
					'log_succ_text1'  => 'You are successfully logged in!',
					'log_succ_text2' => 'You have successfully signed out!',
					
					'log_fail_text1' => 'Please enter your username to log in!',
					'log_fail_text2' => 'Please enter your password to log in!',
					'log_fail_text3' => 'The username or password is incorrect! Please try again!',
					
					'log_info_text1' => 'To sign in, please confirm your registration using the link in your automated email sent to your mailbox! Then try logging in again!', //The user is not confirmed yet! Please try again!
					//Regisztráció angol nyelvű üzenetei:   (classes\Registration.php)
					'reg_succ_text1' => 'Successful registration! Please confirm your registration with the link in your email account!',
					'reg_fail_text1' => 'Please enter your name for registration!',
					'reg_fail_text2' => 'Please enter your username to register!',
					'reg_fail_text3' => 'Please enter your e-mail address to register!',
					'reg_fail_text4' => 'Please enter a password to register!',
					'reg_fail_text5' => 'Please re-enter your password to register!',
					'reg_fail_text6' => 'The password must be at least 6 characters long!',
					'reg_fail_text7' => 'The password you entered does not match your password! Please check!',
					'reg_fail_text8' => 'Registration failed! Registration was not created. The operation was canceled. Please try again!',
					'reg_fail_text9' => 'Registration failed! Registration was not created. Please try again! ',
					//Elfelejtette jelszavát? Bejelentkező ablakról elérhető funkció üzenetei   (classes\ForgotPassword.php Felülete: \forgotpassword.php)
					'forg_pw_fail_text1' => 'You have not registered yet with the given email address!',
					'forg_pw_fail_text2' => 'Database operation error. Unable to create verification code! Please try again!',
        ),
    );
		
	
	public static $cssMessageClass = array(
        'succ'  => 'success',
        'error' => 'fail',
        'info' => 'info',
    );


	public static function getMessage($textIndex) {
	 
	 return Messages::$messageText[$_SESSION['languages']][$textIndex];

	}

	
	public static function getCssClass($cssClassIndex) {
		
	 return Messages::$cssMessageClass[$cssClassIndex];	
		
	}
		
}


?>