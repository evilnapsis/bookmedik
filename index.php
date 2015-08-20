<?php
/**
* @author evilnapsis
* @brief Libera la bestia ...
**/

session_start();
include "core/autoload.php";

$lb = new Lb();
$lb->loadModule("index");


?>