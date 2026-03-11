<?php
// access-action.php
// este archivo sirve para procesar las opciones de login y logout

if(isset($_GET["opt"]) && $_GET["opt"]=="login"){

if(!isset($_SESSION["user_id"])) {

$user_var = htmlentities($_POST["email"]);
$password_var = htmlentities($_POST['password']);


$user = $user_var;
$pass = sha1(md5($password_var));
$base = new Database();
$con = $base->connect();

$sql = "select * from user where (email= \"".$user."\" or username= \"".$user."\" ) and password= \"".$pass."\" and status=1";
//print $sql;
$query = $con->query($sql);
$found = false;
$userid = null;
while($r = $query->fetch_array()){
	$found = true ;
	$userid = $r['id'];
}

if($found==true) {
	$_SESSION['user_id']=$userid ;
	// Si todo sale bien
	print "Cargando ... $user";
	Core::redir("./");
}else {
	// Si la contrase~a es incorrecta
	//Core::redir("./?view=login");
}
}else{
	// si ya esta logeado
	Core::redir("./");	
}

}
if(isset($_GET["opt"]) && $_GET["opt"]=="logout"){
	unset($_SESSION);
	session_destroy();
	Core::redir("./");
}

?>