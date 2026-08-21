<?php
/**
 * BookMedik v5 - Autoloader Principal del Core
 * Basado en la arquitectura LegoBox v5 (lb-min-5)
 */

include __DIR__ . "/controller/Database.php";
include __DIR__ . "/controller/LbModel.php";
include __DIR__ . "/controller/Session.php";
include __DIR__ . "/controller/Request.php";
include __DIR__ . "/controller/Response.php";
include __DIR__ . "/controller/ViewEngine.php";

if (file_exists(__DIR__ . "/controller/class.upload.php")) {
    include __DIR__ . "/controller/class.upload.php";
}

include __DIR__ . "/app/autoload.php";
?>