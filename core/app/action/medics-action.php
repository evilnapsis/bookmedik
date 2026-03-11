<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
	$user = new MedicData();
	$user->category_id = $_POST["category_id"];
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->address = $_POST["address"];
	$user->email = $_POST["email"];
	$user->phone = $_POST["phone"];
	$user->add();

    Core::redir("./index.php?view=medics&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="upd"){
	$user = MedicData::getById($_POST["user_id"]);
	$user->category_id = $_POST["category_id"];
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->address = $_POST["address"];
	$user->email = $_POST["email"];
	$user->phone = $_POST["phone"];
	$user->update();
    Core::redir("./index.php?view=medics&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$medic = MedicData::getById($_GET["id"]);
	$medic->del();
    Core::redir("./index.php?view=medics&opt=all");
}
?>
