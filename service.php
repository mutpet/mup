<?php
/**
 * Created by PhpStorm.
 * User: mutterp
 * Date: 2017.03.24.
 * Time: 18:16
 */
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
header("Content-Type: text/html; charset=utf-8");
include 'template.php';
include 'my_database_connection_pdo.php';
include 'visitor_counter.php';
include 'menu.php';
//include 'quotes.php';
$tmp = new template("service.html");

$script = '<script language="javascript" src="jquery-1.8.3.min.js"></script>
			  
			  <script type="text/javascript" src="main.js"></script>
			  <link rel="stylesheet" type="text/css" href="main.css">
			  <link rel="stylesheet" type="text/css" href="service.css">';
			  // PDO kapcsolódás,  Csatlakozás az adatbázishoz
			  $pdo = newPdoConnection();
			  $ip = $_SERVER['REMOTE_ADDR'];
			  
			   $aktualis_nyelv = "_hu";
			   $lang_hu = '<img src="images/lang_hu.png"/>';
			   
			  if (!empty($_GET["lang"])) { 
			  $_SESSION['languages'] = $_GET["lang"];
			  }
			  if ($_SESSION['languages'] == "_hu") {
			  include (@"lang/hu.php"); 
			  $aktualis_nyelv = "_hu"; 
			   $lang_hu = '<img src="images/lang_hu.png"/>';
				   $lang_en = '<a class="nyelvkep" href="'.basename($_SERVER["PHP_SELF"]).'?lang=_en"><img onMouseOver="this.style.opacity=1; this.filters.alpha.opacity=100" onMouseOut="this.style.opacity=0.4; this.filters.alpha.opacity=40"src="images/lang_en.png"/></a>';
			  }
			  if ($_SESSION['languages'] == "_en") {
			  include (@"lang/en.php"); 
			  $aktualis_nyelv = "_en"; 
			  $lang_en =  '<img src="images/lang_en.png"/>';
				   $lang_hu = '<a class="nyelvkep" href="'.basename($_SERVER["PHP_SELF"]).'?lang=_hu"><img onMouseOver="this.style.opacity=1; this.filters.alpha.opacity=100" onMouseOut="this.style.opacity=0.4; this.filters.alpha.opacity=40"src="images/lang_hu.png"/></a>';
			  }
			  $username = '';
			  if(!empty($_SESSION['username'])) {
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
			 
			  /*
			  if ($aktualis_nyelv = "_hu"){
				  $lang_hu = '<img src="images/lang_hu.png"/>';
				   $lang_en = '<a class="nyelvkep" href="'.basename($_SERVER["PHP_SELF"]).'?lang=_en"><img onMouseOver="this.style.opacity=1; this.filters.alpha.opacity=100" onMouseOut="this.style.opacity=0.4; this.filters.alpha.opacity=40"src="images/lang_en.png"/></a>';
			  }
			  /*
			  /*
			  if ($aktualis_nyelv = "_en"){
				  $lang_en =  '<img src="images/lang_en.png"/>';
				   $lang_hu = '<a class="nyelvkep" href="'.basename($_SERVER["PHP_SELF"]).'?lang=_hu"><img onMouseOver="this.style.opacity=1; this.filters.alpha.opacity=100" onMouseOut="this.style.opacity=0.4; this.filters.alpha.opacity=40"src="images/lang_hu.png"/></a>';
			   }
			  */
			 
/*			  
// Check if this ip exist in out data
$ip_address_query = "SELECT ip_address FROM visitors WHERE ip_address = :ip ";
$selectStatement = $pdo->prepare($ip_address_query);
$selectStatement->bindValue(':ip', $ip);
$selectStatement->execute();	
$CheckIp = $selectStatement->rowCount();
if ($CheckIp == 0) {
	$ip_address_insert_query = "INSERT INTO visitors SET ip_address = :ip ";
	$insertStatement = $pdo->prepare($ip_address_insert_query);
	//$insertStatement->bindValue(':id', '');
	$insertStatement->bindValue(':ip', $ip);
	$insertStatement->execute();
}
$visitors_query = 	"SELECT ip_address FROM visitors" ;
$selectStatement = $pdo->prepare($visitors_query);
$selectStatement->execute();
$visitors = $selectStatement->rowCount();
*/	  
			  //countVisitors();
/*		  
$login_button = '<input id="login_button" type="button" value="Belépés" '.$login_visible.' onclick="openLoginWindow()">';
$logout_button = '<input id="logout_button" type="button" value="Kilépés" '.$logout_visible.' onclick="logout();">';	  
$tmp->set('login_button', $login_button);
$tmp->set('logout_button', $logout_button); */	  
$tmp->set('lang_hu', $lang_hu);	
$tmp->set('lang_en', $lang_en);

//$tmp->set('menu_item', $menu_item);
//$tmp->set('quotes', $quotes);
//$visitors = countVisitors();
//$tmp->set('username', $username);
//$tmp->set('message', $message);
//$valami = "TESZT SZÖVEG!!!!";
//$tmp->set('valami', $valami);

//$tmp->set('visitors', $visitors);

$tmp->set('script',$script);
//$tmp->set('tartalom', $tmp->get());
echo $tmp->get();
/*
ini_set('display_errors', 1);
session_start();
echo "Kapd be akkor a faszom!";
include 'visitor_counter.php';
include 'template.php'; 

countVisitors();
$html = setVisitorsForTemplate ('index.html', $visitors); 
*/


?>