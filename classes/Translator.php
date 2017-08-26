<?php

header("Content-Type: text/html; charset=utf-8");

if(!(class_exists('MyDatabaseConnection'))) {
	include_once 'classes/MyDatabaseConnection.php'; 
}	
//include 'template.php';	
if(!(class_exists('template'))) {
	include_once 'classes/template.php'; 
}
	
/**
 * A weboldalon található szöveg elemek lefordítására szolgáló általános osztály definiciója
 *
 * @author Peter Mutter <mupetya@yahoo.co.uk>
 * @since 2017.08.25
 */
class Translator {
	
	/**
    * @var array session
    */
	private $session = array();
	/**
    * @var null|object database 
    */
	private static $database = null;
	/**
	* @var null|string
	*/
	private $filename = null;
	
	// Konstruktor:
	public function __construct ($session = array(), $filename = null) {
		//adatbázis kapcsolat 
		if(!(self::$database instanceof \PDO)) {
			  self::$database = (new MyDatabaseConnection())->dataBaseConnect();
		}
		$this->session = $session;
		$this->filename = $filename;
	}
	
	
		public function textTranslation($template_file, $temp_array) {
			
			$tmp = new template($template_file);
			
			$translate_query = self::$database->prepare( " SELECT d.text_no, d.text 
																				  FROM dictionary d
																				  LEFT JOIN `language` lan ON d.id_lang = lan.id 	
																				  WHERE lan.country_code = :languages AND filename = :filename ");
			$translate_query->bindValue(':languages', $this->session['languages']);
			$translate_query->bindValue(':filename', $this->filename);
			$translate_query->execute();
			$text_result = $translate_query->fetchAll();
			$text_item = '';
			
			foreach($text_result as $text) {
				//$text_item .= $text['text'];
				$tmp->set($text['text_no'], $text['text']);
			}
			
			// $login_button = '<input id="login_button" type="button" value="Belépés" '.$login_visible.' onclick="openLoginWindow()">';
			// $logout_button = '<input id="logout_button" type="button" value="Kilépés" '.$logout_visible.' onclick="logout();">';
			
			$tmp->set('login_button', $temp_array['login_button']);
			$tmp->set('logout_button', $temp_array['logout_button']);
			$tmp->set('lang_hu', $temp_array['lang_hu']);	
			$tmp->set('lang_en', $temp_array['lang_en']);
			$tmp->set('menu_item', $temp_array['menu_item']);
			$tmp->set('username', $temp_array['username']);
			$tmp->set('message', $temp_array['message']);
			$tmp->set('visitors', $temp_array['visitors']);
			$tmp->set('script', $temp_array['script']);
			$tmp->set('lang', $this->session['languages']);

			echo $tmp->get();
			
		}
	
}

?>	

