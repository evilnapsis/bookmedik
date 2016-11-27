<?php

$client = PacientData::getById($_GET["id"]);
$client->del();
Core::redir("./index.php?view=pacients");

?>