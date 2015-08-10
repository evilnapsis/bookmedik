<?php

$category = Categorydata::getById($_GET["id"]);

$category->del();
Core::redir("./index.php?view=categories");


?>