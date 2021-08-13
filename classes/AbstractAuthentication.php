<?php
abstract class AbstractAuthentication
{
    /**
    * @var array request 
    */
	protected $request = array();
	/**
    * @var null|object database 
    */
    protected static $database = null;
    
    protected static function CleanUsername(){
        
        trim($this->request['username']);
        strip_tags($this->request['username']);
        stripslashes($this->request['username']);
        //htmlentities($this->request['username']);

    return $this->request['username'];
 }

    protected static function CleanPassword(){
        
        trim($this->request['password']);
        
    return $this->request['password'];
}

}

?>