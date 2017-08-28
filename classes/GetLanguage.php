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
		
		if(empty($menu_item)){
			include_once 'menu.php';
		}
		
		 if (!isset($_SESSION)) { 
			   session_start();
		 }

		  
		//SESSION beállítása a kiválasztott nyelvre
		 if (!empty($_GET["lang"])) {
			    $_SESSION['languages'] = $_GET["lang"];
		 }
		  
		 //Ha a user által kiválasztott nyelv a Magyar:
		 if ($_SESSION['languages'] == "_hu") {
			   $lang_hu = '<img src="images/lang_hu.png"/>';
			   $lang_en = '<a class="nyelvkep" href="'.basename($_SERVER["PHP_SELF"]).'?lang=_en"><img id="lang_item" onMouseOver="this.style.opacity=1; this.filters.alpha.opacity=100" onMouseOut="this.style.opacity=0.4; this.filters.alpha.opacity=40"src="images/lang_en.png"/></a>';
		}
			
		//Ha a user által kiválasztott nyelv az Angol:
		if ($_SESSION['languages'] == "_en") {
			  $lang_en =  '<img src="images/lang_en.png"/>';
			  $lang_hu = '<a class="nyelvkep" href="'.basename($_SERVER["PHP_SELF"]).'?lang=_hu"><img id="lang_item" onMouseOver="this.style.opacity=1; this.filters.alpha.opacity=100" onMouseOut="this.style.opacity=0.4; this.filters.alpha.opacity=40"src="images/lang_hu.png"/></a>';
		}

		$temp_array = array ( 
										  'lang_hu'=>$lang_hu, 
										  'lang_en'=>$lang_en, 
										  'menu_item'=>$menu_item,
										  'script'=>$script );
												
		//'Translator' class példányosítása, 'TextTranslation' nevű metódus meghívása
		if(!empty($_SESSION['languages'])) {	 
			  $text = new Translator($_SESSION, $file_name);
			  $text->TextTranslation($template_file, $temp_array);
		}

	}


}

?>