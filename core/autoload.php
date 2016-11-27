<?php
/**
* @author evilnapsis
* @brief Llama todos los archivos del framework LegoBox
**/

include "controller/Core.php";
include "controller/View.php";
include "controller/Module.php";
include "controller/Database.php";
include "controller/Executor.php";
//# include "controller/Session.php"; [remplazada]

include "controller/forms/lbForm.php";
include "controller/forms/lbInputText.php";
include "controller/forms/lbInputPassword.php";
include "controller/forms/lbValidator.php";

// 10 octubre 2014
include "controller/Model.php";
include "controller/Bootload.php";
include "controller/Action.php";

// 13 octubre 2014
include "controller/Request.php";


// 14 octubre 2014
include "controller/Get.php";
include "controller/Post.php";
include "controller/Cookie.php";
include "controller/Session.php";
include "controller/Lb.php";



?>