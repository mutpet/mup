<?php
/*
$messages_by_lang = array(
	'_hu' => array(
		'uzenet1' =>'Uzenet',
		'uzenet2' =>'Masik Uzenet',
	),
	'_en' => array(
		'uzenet1' =>'Msg',
		'uzenet2' =>'Other Msg',
	),
);

$messages_by_lang[$_SESSION['language']]['uzenet_cimke']
*/

// OOP
class MessagesByLang
{
	public static $messages = array(
		'_hu' => array(
			'log_success' =>'Ön sikeresen bejelentkezett!',
			'hu_log_' =>'Masik Uzenet',
			'hu_log_' =>'Masik Uzenet',
			'hu_log_' =>'Masik Uzenet',
			'hu_log_' =>'Masik Uzenet',
			'hu_log_' =>'Masik Uzenet',
			'hu_log_' =>'Masik Uzenet',
			'hu_reg_' =>'Masik Uzenet',
			'hu_reg_' =>'Masik Uzenet',
			'hu_reg_' =>'Masik Uzenet',
			'hu_reg_' =>'Masik Uzenet',
			'hu_reg_' =>'Masik Uzenet',
			'hu_reg_' =>'Masik Uzenet',
			'hu_reg_' =>'Masik Uzenet',
			'hu_reg_' =>'Masik Uzenet',
		),
		'_en' => array(
			'log_success' =>'You are successfully logged in!',
			'en_log_' =>'Other Msg',
			'en_log_' =>'Other Msg',
			'en_log_' =>'Other Msg',
			'en_log_' =>'Other Msg',
			'en_log_' =>'Other Msg',
			'en_log_' =>'Other Msg',
			'en_log_' =>'Other Msg',
			'en_log_' =>'Other Msg',
			'en_reg_' =>'Other Msg',
			'en_reg_' =>'Other Msg',
			'en_reg_' =>'Other Msg',
			'en_reg_' =>'Other Msg',
			'en_reg_' =>'Other Msg',
			'en_reg_' =>'Other Msg',
			'en_reg_' =>'Other Msg',
			'en_reg_' =>'Other Msg',
			'en_reg_' =>'Other Msg',
		),
	);
}

//MessagesByLang::$messages[$_SESSION['language']]['uzenet_cimke'];

//MessagesByLang::$messages[$_SESSION['message']]['uzenet_cimke'];

?>