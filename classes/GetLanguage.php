<?php


if(!(class_exists('Translator'))) {
	  include_once 'classes/Translator.php'; 
}

/**
 * A weboldalaim többnyelvűségének általános működési osztálya, és metódusa
 *
 * @author Peter Mutter <mupetya@yahoo.co.uk>
 * @since 2017.08.28
 */

class GetLanguage {

	public static function setLanguageForPage($template_file, $file_name, $script, $lang_hu) {
		
		$login_button_value = "Belépés";
		$logout_button_value = "Kilépés";
		
		if(empty($menu_item)){
			include_once 'menu.php';
		}
		
		 if (!isset($_SESSION)) { 
			   session_start();
		 }

		  
		//SESSION beállítása a kiválasztott nyelvre!
		 if (!empty($_GET["lang"])) {
			    $_SESSION['languages'] = $_GET["lang"];
		 }
		  
		 //Ha a user által kiválasztott nyelv a Magyar nyelv!:
		 if ($_SESSION['languages'] == "_hu") {
				//Login állapot Magyar nyelvű szövegei:
			   $login_text = "Bejelentkezve: ";
			   $default_logout_text = "Ön nincs bejelentkezve!";
			   //Login gombok Magyar feliratai:
			   $login_button_value = "Belépés";
			   $logout_button_value = "Kilépés";
			   //Nyelvválasztó zászlóképek: (ahol a Magyar zászló a látható(aktív), és az Angol zászló halvány)
			   $lang_hu = '<img src="images/lang_hu.png"/>';
			   $lang_en = '<a class="nyelvkep" href="'.basename($_SERVER["PHP_SELF"]).'?lang=_en"><img id="lang_item" onMouseOver="this.style.opacity=1; this.filters.alpha.opacity=100" onMouseOut="this.style.opacity=0.4; this.filters.alpha.opacity=40"src="images/lang_en.png"/></a>';
		}
			
		//Ha a user által kiválasztott nyelv az Angol nyelv!:
		if ($_SESSION['languages'] == "_en") {
			  //Login állapot Angol nyelvű szövegei:
			  $login_text = "Logged in as: ";
			  $default_logout_text = "You are not logged in!";
			  //Login gombok Angol feliratai:
			  $login_button_value = "Login";
			  $logout_button_value = "Logout";
			  //Nyelvválasztó zászlóképek: (ahol az Angol zászló a látható(aktív), és Magyar zászló halvány)
			  $lang_en =  '<img src="images/lang_en.png"/>';
			  $lang_hu = '<a class="nyelvkep" href="'.basename($_SERVER["PHP_SELF"]).'?lang=_hu"><img id="lang_item" onMouseOver="this.style.opacity=1; this.filters.alpha.opacity=100" onMouseOut="this.style.opacity=0.4; this.filters.alpha.opacity=40"src="images/lang_hu.png"/></a>';
		}
		
		/**
		 * Sikeres bejelentkezés ellenőrzése:
		 * Sikeres bejelentkezés után a már beállított SESSION['username'] megjelenítése a felületen, a menüsorban.
		 */
		if (!empty($_SESSION['username'])) {
			  $login_info_style = '<div class="login_container"><img id="login_img" src="images/login/login.png">';
			  $login_info = $login_text;
			  $login_visible = 'style="display:none;"';
			  $logout_visible = '';
		}else{
			  $login_info_style = '<div class="logout_default_container"><img id="logout_default_flash_img" src="images/login/logout.png">';
			  $login_info = $default_logout_text;
			  $login_visible = '';
			  $logout_visible = 'style="display:none;';
		}
		
		//Login gombok deklarálása
		$login_button = '<input id="login_button" type="button" value="'.$login_button_value.'" '.$login_visible.' onclick="openLoginWindow()">';    //Bejelentkezés gomb
		$logout_button = '<input id="logout_button" type="button" value="'.$logout_button_value.'" '.$logout_visible.' onclick="logout();">';								     //Kijelentkezés gomb
		
		//tömb feltöltése az átadandó, általánosan megjelenítendő változókkal
		$temp_array = array ( 
										  'login_button'=>$login_button, 
										  'logout_button'=>$logout_button, 
										  'lang_hu'=>$lang_hu, 
										  'lang_en'=>$lang_en, 
										  'login_info_style' =>$login_info_style,
										  'login_info' =>$login_info,
										  'menu_item'=>$menu_item,
										  'script'=>$script );
												
		//'Translator' class példányosítása, 'TextTranslation' nevű metódus meghívása, paraméterek átadása
		if(!empty($_SESSION['languages'])) {	 
			  $text = new Translator($_SESSION, $file_name);
			  $text->TextTranslation($template_file, $temp_array);
		}

	}


}

?>