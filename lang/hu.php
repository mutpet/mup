<?php
/**
 * Created by Notepad++
 * @author: Mutter Peter <mupetya@yahoo.co.uk>
 * Date: 2017.04.02.
 * Time: 15:39
 */
//session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
header("Content-Type: text/html; charset=utf-8");
//include '/../template.php';
/*
$tmp = new template("index.html");
	$language_query = "SELECT * FROM ";
	$selectStatement = $pdo->prepare($language_query);
	//$selectStatement->bindValue(':munkalapszam', $munkalapszam);
	$selectStatement->execute();
	$language_result = $selectStatement->fetchAll();

//Munkalap adatok megjelenitese
	$lang_temp_labels = array(
		'introduce' => '<(introduce)>',
		'references' => '<(references)>',
		'documents' => '<(documents)>',
		'contact' => '<(contact)>',
		'head_name' => '<(head_name)>',
		'developer' => '<(developer)>',
		'text_article' => '<(text_article)>',
		'text_section_1' => '<(text_section_1)>',
		'text_section_2' => '<(text_section_2)>',
		'text_section_3' => '<(text_section_3)>',
		'author' => '<(author)>',
		'author_name' => '<(author_name)>',
		
	);
	$munkalap_adatok_tabla = "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"5\">";
	foreach ($lang_temp_labels as $index => $tmp_label) {
		$munkalap_adatok_tabla .= "<tr>";
		$munkalap_adatok_tabla .= "<td>";
		$munkalap_adatok_tabla .= "<strong>".$tmp_label."</strong>";
		$munkalap_adatok_tabla .= "</td>";
		$munkalap_adatok_tabla .= "<td>&nbsp;</td>";
		$munkalap_adatok_tabla .= "<td>&nbsp;</td>";
		$munkalap_adatok_tabla .= "<td>";
		$munkalap_adatok_tabla .= $lang_temp_labels[$index];
		$munkalap_adatok_tabla .= "</td>";
		$munkalap_adatok_tabla .= "</tr>";
	}
	$munkalap_adatok_tabla .= "</table>";
	$tmp_tartalom = new template('temp/munkalap/service_action_work_eredmeny_felvitel.html');
	
	$tmp_tartalom->set('munkalap_adatok_tabla', $munkalap_adatok_tabla);
	$tmp_tartalom->set('munkalapszam', '<input type="hidden" id="munkalapszam" name="munkalapszam" value="'.$munkalapszam.'"" />');
}
$tmp->set('script',$script);
$tmp->set('tartalom', $tmp_tartalom->get());
echo $tmp->get();

*/
?>