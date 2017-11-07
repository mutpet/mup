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
 *  ('dictionary' nevű adattáblából a megfelelő rekordok lekérdezése, ás átadása a meghatározott template html felületnek)
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
			  self::$database = MyDatabaseConnection::dataBaseConnect();
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
		//	$text_item = '';
			
			foreach($text_result as $text) {
				//$text_item .= $text['text']; ciklus tesztelése miatt, az összes tömbelem kiiratása
				$tmp->set($text['text_no'], $text['text']);
			}
			
			switch ($template_file) {
			    //Ha a template html fájl az index.html, akkor további html elemek beállítása az index felületére
			//if($template_file == 'index.html') {
				case 'index.html':
				$tmp->set('login_button', $temp_array['login_button']);
				$tmp->set('logout_button', $temp_array['logout_button']);
				$tmp->set('lang_hu', $temp_array['lang_hu']);	
				$tmp->set('lang_en', $temp_array['lang_en']);
				$tmp->set('login_info_style', $temp_array['login_info_style']);
				$tmp->set('menu_item', $temp_array['menu_item']);
			//	$tmp->set('username', $temp_array['username']);
				$tmp->set('prefix', $temp_array['prefix']);
				$tmp->set('login_info', $temp_array['login_info']);
				if(!empty($this->session['username'])) {	
					$tmp->set('username', $this->session['username']);
				}else{
					$tmp->set('username', '');
				}
				$tmp->set('message', $temp_array['message']);
				$tmp->set('visitors', $temp_array['visitors']);
				$tmp->set('script', $temp_array['script']);
				$tmp->set('lang', $this->session['languages']);
				break;
				
			//}elseif($template_file == 'service.html') {
				case 'service.html':	
				$tmp->set('lang_hu', $temp_array['lang_hu']);	
				$tmp->set('lang_en', $temp_array['lang_en']);
				$tmp->set('script', $temp_array['script']);
				$tmp->set('lang', $this->session['languages']);
				break;
				
			//}else{
				default:
				//általános, állandó html elemek beállítása a megadott html template felületre
				$tmp->set('login_button', $temp_array['login_button']);
				$tmp->set('logout_button', $temp_array['logout_button']);
				$tmp->set('lang_hu', $temp_array['lang_hu']);	
				$tmp->set('lang_en', $temp_array['lang_en']);
				$tmp->set('login_info_style', $temp_array['login_info_style']);
				$tmp->set('login_info', $temp_array['login_info']);
				$tmp->set('menu_item', $temp_array['menu_item']);
				$tmp->set('script', $temp_array['script']);
				if(!empty($this->session['username'])) {	
					$tmp->set('username', $this->session['username']);
				}else{
				$tmp->set('username', '');
				}
				$tmp->set('lang', $this->session['languages']);
			}
			
			//A beállított html elemek átadása a meghatározott HTML (template) fájlnak
			echo $tmp->get();
			
		}
	
}

?>	

