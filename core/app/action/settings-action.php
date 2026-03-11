<?php
// print_r($_POST);

if(isset($_GET["opt"]) && $_GET['opt']=="add"){

$set = new SettingData();
$set->name = $_POST['name'];
$set->label = $_POST['label'];
$set->val = $_POST['val'];
$set->add();
Core::redir("./?view=settings&opt=all");

}else if(isset($_GET["opt"]) && $_GET['opt']=="update"){

foreach ($_POST as $p => $k) {
	SettingData::updateValFromName($p,$k);
}
Core::redir("./?view=settings&opt=all");

}

?>
