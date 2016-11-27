<?php

$client = MedicData::getById($_GET["id"]);
$client->del();
Core::redir("./index.php?view=medics");

?>