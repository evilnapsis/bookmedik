<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
	$rx = ReservationData::getRepeated($_POST["pacient_id"],$_POST["medic_id"],$_POST["date_at"],$_POST["time_at"]);
	if($rx==null){
		$r = new ReservationData();
		$r->title = $_POST["title"];
		$r->note = $_POST["note"];
		$r->pacient_id = $_POST["pacient_id"];
		$r->medic_id = $_POST["medic_id"];
		$r->date_at = $_POST["date_at"];
		$r->time_at = $_POST["time_at"];
		$r->user_id = $_SESSION["user_id"];

		$r->status_id = $_POST["status_id"];
		$r->payment_id = $_POST["payment_id"];
		$r->price = $_POST["price"];
		$r->sick = $_POST["sick"];
		$r->symtoms = $_POST["symtoms"];
		$r->medicaments = $_POST["medicaments"];

		$r->add();

		Core::alert("Agregado exitosamente!");
	}else{
		Core::alert("Error al agregar, Cita Repetida!");
	}
	Core::redir("./index.php?view=reservations&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="upd"){
	$user = ReservationData::getById($_POST["id"]);
	$user->title = $_POST["title"];
	$user->pacient_id = $_POST["pacient_id"];
	$user->medic_id = $_POST["medic_id"];
	$user->date_at = $_POST["date_at"];
	$user->time_at = $_POST["time_at"];
	$user->note = $_POST["note"];

	$user->status_id = $_POST["status_id"];
	$user->payment_id = $_POST["payment_id"];
	$user->price = $_POST["price"];
	$user->sick = $_POST["sick"];
	$user->symtoms = $_POST["symtoms"];
	$user->medicaments = $_POST["medicaments"];

	$user->update();

	Core::alert("Actualizado exitosamente!");
	Core::redir("./index.php?view=reservations&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$user = ReservationData::getById($_GET["id"]);
	$user->del();
	Core::redir("./index.php?view=reservations&opt=all");
}
?>
