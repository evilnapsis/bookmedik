<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
	$user = new CategoryData();
	$user->name = $_POST["name"];
	$user->add();
	$_SESSION["success"] = "Categoria agregada con exito!";
    Core::redir("./index.php?view=categories&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="upd"){
	$user = CategoryData::getById($_POST["user_id"]);
	$user->name = $_POST["name"];
	$user->update();
	$_SESSION["update"] = "Categoria actualizada con exito!";
    Core::redir("./index.php?view=categories&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$category = CategoryData::getById($_GET["id"]);
	$category->del();
	$_SESSION["delete"] = "Categoria eliminada con exito!";
    Core::redir("./index.php?view=categories&opt=all");
}
?>
