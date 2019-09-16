<?php

function my_autoloader($class){
  include 'class_lib/' . $class . '.php';
  if(file_exists("class_lib/".$class.".php")){
    require_once("class_lib/".$class.".php");
  } else{
    throw new Exception("Error: Cannot load ". $class ." class.");
  }
}

spl_autoload_register('my_autoloader');

?>
