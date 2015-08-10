<?php

$r = new ReservationData();
$r->title = $_POST["title"];
$r->note = $_POST["note"];
$r->pacient_id = $_POST["pacient_id"];
$r->medic_id = $_POST["medic_id"];
$r->date_at = $_POST["date_at"];
$r->time_at = $_POST["time_at"];
$r->user_id = $_SESSION["user_id"];
$r->add();

Core::redir("./index.php?view=reservations");
?>