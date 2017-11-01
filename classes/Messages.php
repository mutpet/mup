<?php

if(!isset($_SESSION)) { 
	session_start();
}

class Messages {
	
	public static $messageText = array(
		'_hu' => array(
					'succ_text1'  => 'Ön sikeresen bejelentkezett!',
					'succ_text2' => 'Ön sikeresen kijelentkezett!',
					
					'fail_text1' => 'A bejelentkezéshez kérem adja meg felhasználónevét!',
					'fail_text2' => 'A bejelentkezéshez kérem adja meg jelszavát!',
					'fail_text3' => 'A felhasználónév vagy jelszó nem megfelelő! Kérem próbálja meg újra!',
					
					'info_text1' => 'A bejelentkezéshez, kérem erősítse meg regisztrációját a postafiokjába küldött automatikus e-mailben található link segítségével! Majd próbálja meg újra a bejelentkezést!',
					'fail_text5' => 'Ön sikeresen kijelentkezett!',
					'fail_text6' => 'Ön sikeresen kijelentkezett!',
					'fail_text7' => 'Ön sikeresen kijelentkezett!',
					'fail_text8' => 'Ön sikeresen kijelentkezett!',
        ),
        '_en' => array(
					'succ_text1'  => 'You are successfully logged in!',
					'succ_text2' => 'You have successfully signed out!',
					
					'fail_text1' => 'Please enter your username to log in!',
					'fail_text2' => 'Please enter your password to log in!',
					'fail_text3' => 'The username or password is incorrect! Please try again!',
					
					'info_text1' => 'The user is not confirmed yet! Please try again!',
					'fail_text5' => 'Ön sikeresen kijelentkezett!',
					'fail_text6' => 'Ön sikeresen kijelentkezett!',
					'fail_text7' => 'Ön sikeresen kijelentkezett!',
					'fail_text8' => 'Ön sikeresen kijelentkezett!',
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