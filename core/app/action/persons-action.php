<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
if(count($_POST)>0){



	$user = new PersonData();

	$user->addExtraFieldString("name", htmlentities($_POST["name"]));
	$user->addExtraFieldString("lastname", htmlentities($_POST["lastname"]));
	$user->addExtraFieldString("email", htmlentities($_POST["email"]));
	$user->addExtraFieldString("phone", htmlentities($_POST["phone"]));
	$user->addExtraFieldString("address", htmlentities($_POST["address"]));

	$user->add();
	$_SESSION["success"] = "Contacto agregado!";
	Core::redir("./?view=persons&opt=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
if(count($_POST)>0){

	$user = PersonData::getById($_POST["_id"]);
	$user->addExtraFieldString("name", htmlentities($_POST["name"]));
	$user->addExtraFieldString("lastname", htmlentities($_POST["lastname"]));
	$user->addExtraFieldString("email", htmlentities($_POST["email"]));
	$user->addExtraFieldString("phone", htmlentities($_POST["phone"]));
	$user->addExtraFieldString("address", htmlentities($_POST["address"]));

	$user->update();

	$_SESSION["update"] = "Contacto actualizado!";
	Core::redir("./?view=persons&opt=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$user = PersonData::getById($_GET["id"]);
	$user->del();
	$_SESSION["delete"] = "Contacto eliminado!";
	Core::redir("./?view=persons&opt=all");
}



?>