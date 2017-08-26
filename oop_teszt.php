<?php

class Myclass {
	
	
	public function __construct ($message){
		echo 'Életem első OOP construct függvénye! :) ' .  $message . '<br>';
		
		
	}
	


}

$myobject_1 = new Myclass('plusz üzenet első osztály példány');
$myobject_2 = new Myclass('plusz üzenet első második példány');
$myobject_3 = new Myclass('plusz üzenet első harmadik példány');

?>