<?php
$debug= true;

if($debug){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}else{
error_reporting(0);

}


include "core/autoload.php";
ob_start();
session_start();

// si quieres que se muestre las consultas SQL debes decomentar la siguiente linea
// Core::$debug_sql = true;


$lb = new Lb();
$lb->start();

?>