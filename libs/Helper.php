<?php
/*
 *
 * 
 * 
 */

Class Helper{
  


  public function __construct() {
    
  }
  
  /**
* sanitize return sanitized strings
* $param $string - string to sanitize
* @return String 
*/  
  public static function sanitize($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
  }
}