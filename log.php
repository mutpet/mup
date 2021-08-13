<?php

abstract class Logger {

/**
*@param string logText
*@access public
*/

 public static function WriteLogError($logText)
 {
     $logDate = date('Y-m-d H:i:s');
     $logFile = fopen("errors.log","a+");
     fwrite($logFile, $logDate." ".$logText.PHP_EOL);
     fclose($logFile);
 }

 public static function WriteLogDebug($logText)
 {
     $logDate = date('Y-m-d H:i:s');
     $logFile = fopen("debug.log","a+");
     fwrite($logFile, $logDate." ".$logText.PHP_EOL);
     fclose($logFile);
 } 
}

Logger::WriteLogError('Hiba van! :)');
Logger::WriteLogDebug('Hibakeresés, ez lefutott? :)');
?>