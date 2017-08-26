<?php
/**
 * Created by PhpStorm.
 * User: mutterp
 * Date: 2017.03.24.
 * Time: 18:16
 */
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
header("Content-Type: text/html; charset=utf-8");
//include 'template.php'; 			html template behúzása, a régi, eredeti működés része!
include 'my_database_connection_pdo.php';
include 'visitor_counter.php';
include 'menu.php';

if(!(class_exists('Translator'))) {
	include_once 'classes/Translator.php'; 
}

//Ez még a Süti vizsgálata miatt kelleni fog!

if(!(class_exists('Login'))) {
	include_once 'classes/Login.php'; 
}

/*
if(!(class_exists('CheckCookie'))) {
	include_once 'classes/CheckCookie.php'; 
}
*/
//Login COOKIE vizsgálata
if(!empty($_COOKIE['mup_user'])) {
	
	//CheckCookie::getCookie($_COOKIE['mup_user']);
	
	//$check = new Login();
	//$check->checkCookie($_COOKIE['mup_user']);
	
	//Login::checkCookie($_COOKIE['mup_user']);
}

//$tmp = new template("index.html");   A html template fájl az index.html,  a régi, eredeti működés része!

$script = '<script language="javascript" src="jquery-1.8.3.min.js"></script>
			  <script type="text/javascript" src="index.js"></script>
			  <script type="text/javascript" src="main.js"></script>
			  <link rel="stylesheet" type="text/css" href="main.css">
			  <link rel="stylesheet" type="text/css" href="index.css">';
			  
			  // PDO kapcsolódás,  Csatlakozás az adatbázishoz
			 $pdo = newPdoConnection();
			 $ip = $_SERVER['REMOTE_ADDR'];
			 
			 //Alapértelmezett nyelvi beállítások: (Az alapértelmezett nyelv a Magyar nyelv.)
			 $aktualis_nyelv = "_hu";
			 $lang_hu = '<img src="images/lang_hu.png"/>';
			 $login_button_value = "Belépés";
			 $logout_button_value = "Kilépés";
			
			  //SESSION beállítása a kiválasztott nyelvre
			  if (!empty($_GET["lang"])) { 
				  $_SESSION['languages'] = $_GET["lang"];
			   }
			  
			  //Ha a user által kiválasztott nyelv a Magyar:
			  if ($_SESSION['languages'] == "_hu") {
				  //include (@"lang/hu.php"); 			  
				  $aktualis_nyelv = "_hu"; 
				  $login_button_value = "Belépés";
				  $logout_button_value = "Kilépés";
				  $lang_hu = '<img src="images/lang_hu.png"/>';
				  $lang_en = '<a class="nyelvkep" href="'.basename($_SERVER["PHP_SELF"]).'?lang=_en"><img id="lang_item" onMouseOver="this.style.opacity=1; this.filters.alpha.opacity=100" onMouseOut="this.style.opacity=0.4; this.filters.alpha.opacity=40"src="images/lang_en.png"/></a>';
			   }
				
				//Ha a user által kiválasztott nyelv az Angol:
			  if ($_SESSION['languages'] == "_en") {
				  //include (@"lang/en.php");
				  $aktualis_nyelv = "_en";
				  $login_button_value = "Login";
				  $logout_button_value = "Logout";
				  $lang_en =  '<img src="images/lang_en.png"/>';
				  $lang_hu = '<a class="nyelvkep" href="'.basename($_SERVER["PHP_SELF"]).'?lang=_hu"><img id="lang_item" onMouseOver="this.style.opacity=1; this.filters.alpha.opacity=100" onMouseOut="this.style.opacity=0.4; this.filters.alpha.opacity=40"src="images/lang_hu.png"/></a>';
				}
				
				//Sikeres bejelentkezés után a már beállított SESSION['username'] megjelenítése a felületen. A látogató a felhasználó nevével való Üdvözlése
				$username = '';
			  if (!empty($_SESSION['username'])) {
				  $username = 'Tisztelt '.$_SESSION['username'].' ! ';
				  $login_visible = 'style="display:none;"';
				  $logout_visible = '';
			  }else{
				  $username ='';
				  $login_visible = '';
				  $logout_visible = 'style="display:none;';
			  }
			  
			  $message = '';
			  if (!empty($_SESSION['message'])) {
				  $message = "<div id='error_msg' class='".$_SESSION['message_class']."'>".$_SESSION['message']."</div>";
				  unset($_SESSION['message']);
			  }
			  //A template html -nek átadandó állandó elemek deklarálása
			  $login_button = '<input id="login_button" type="button" value="'.$login_button_value.'" '.$login_visible.' onclick="openLoginWindow()">'; //Bejelentkezés gomb
			  $logout_button = '<input id="logout_button" type="button" value="Kilépés" '.$logout_visible.' onclick="logout();">';								//Kijelentkezés gomb
			  $visitors = countVisitors();																																								//IP cím alapú látogató számláló metódus meghívása
			  $fb_script = '<script>
								(function(d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0];
								if (d.getElementById(id)) return;
								js = d.createElement(s); js.id = id;
								js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v2.9";
								fjs.parentNode.insertBefore(js, fjs);
								}
								(document, "script", "facebook-jssdk"));
								</script>';
			  
			  $temp_array = array( 'login_button'=>$login_button, 
												'logout_button'=>$logout_button, 
												'lang_hu'=>$lang_hu, 
												'lang_en'=>$lang_en, 
												'menu_item'=>$menu_item,
												'username'=>$username,
												'message'=>$message,
												'visitors'=>$visitors,
												'script'=>$script );
												//'fb_script'=>$fb_script 
			  
			  
			 //TODO: Még viszgálni kell az oldal betöltődésekor, hogy van e a kliens gépen beállított, még élő süti!! Ha van akkor akkor a 'sikeresen bejelentkezett' message nélkül a: $_SESSION['username'] legyen egyenlő a sütibe beállított 'mup_user' indexű tömbelemmel a $_COOKIE szuperglobális tömbből!
			 //if(!empty($_COOKIE['mup_user'])){ $_SESSION['username'] = $_COOKIE['mup_user']} else {$_SESSION['username'] = ""}
			 //Login::getCookie();
			 
			 //Itt példányosítom a Translator class-t és adom neki át az aktuális nyelvet és aktuális fájl nevet. Tudom hogy egyértelmű dolgokat nem kommentelünk. Csak a fejlesztés idejére van ide írva, hogy segítsem magamat !!!
			 if(!empty($_SESSION['languages'])) {
				 $template_file = 'index.html';
				 $text = new Translator($_SESSION, basename(__FILE__));
				 $text->TextTranslation($template_file, $temp_array);
			 }
			 
			
//A változók átadása az index.html templatenek  a régi, eredeti működés része! Egyelőre még megtartva!
/*
$login_button = '<input id="login_button" type="button" value="Belépés" '.$login_visible.' onclick="openLoginWindow()">';
$logout_button = '<input id="logout_button" type="button" value="Kilépés" '.$logout_visible.' onclick="logout();">';	  
$tmp->set('login_button', $login_button);
$tmp->set('logout_button', $logout_button);	  
$tmp->set('lang_hu', $lang_hu);	
$tmp->set('lang_en', $lang_en);
$tmp->set('menu_item', $menu_item);
//$tmp->set('quotes', $quotes);
 $visitors = countVisitors();
$tmp->set('username', $username);
$tmp->set('message', $message);
$valami = "TESZT SZÖVEG!!!!";
$tmp->set('valami', $valami);

$tmp->set('visitors', $visitors);

$tmp->set('script',$script);

echo $tmp->get();
*/

?>