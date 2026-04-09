<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="upd"){
	if(isset($_SESSION["user_id"])){
		$user = UserData::getById($_SESSION["user_id"]);
		if($user->password == sha1(md5($_POST["password"]))){
			$user->password = sha1(md5($_POST["newpassword"]));
			$user->update_passwd();
			$_SESSION["update"] = "Contraseña actualizada exitosamente!";
			print "<script>window.location='index.php?view=configuration&opt=all';</script>";
		}else{
			$_SESSION["error"] = "La contraseña actual es incorrecta!";
			print "<script>window.location='index.php?view=configuration&opt=all';</script>";
		}
	}
}
?>
