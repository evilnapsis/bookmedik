<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
	$user = new PacientData();
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->gender = $_POST["gender"];
	$user->day_of_birth = $_POST["day_of_birth"];
	
	$user->sick = $_POST["sick"];
	$user->medicaments = $_POST["medicaments"];
	$user->alergy = $_POST["alergy"];
	
	$user->address = $_POST["address"];
	$user->email = $_POST["email"];
	$user->phone = $_POST["phone"];
	$user->add();

    Core::redir("./index.php?view=pacients&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="upd"){
	$user = PacientData::getById($_POST["user_id"]);
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->gender = $_POST["gender"];
	$user->day_of_birth = $_POST["day_of_birth"];
	$user->sick = $_POST["sick"];
	$user->medicaments = $_POST["medicaments"];
	$user->alergy = $_POST["alergy"];
	$user->address = $_POST["address"];
	$user->email = $_POST["email"];
	$user->phone = $_POST["phone"];
	$user->update();
    Core::redir("./index.php?view=pacients&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$pacient = PacientData::getById($_GET["id"]);
	$pacient->del();
    Core::redir("./index.php?view=pacients&opt=all");
}
?>
