<?php

class Db_connect{
  //database connection
  protected static $connection;

  public static function connect(){
    //try and connect to database
    if(!isset(self::$connection)){
      //load configuration as an array
      global $config;
      self::$connection = new mysqli($config['host'],$config['username'],$config['password'],$config['dbname']);
    }

    //if connection was not successful, handel the error
    if(self::$connection === false){
      return false;
      echo "false";
    }
    return self::$connection;
  }
}

?>
