<?php

include "controllers/mainController.php";
include "controllers/loginController.php";
include "controllers/logoutController.php";
include "controllers/accountController.php";


/*if( isset($_SESSION['user']) && $_SESSION['user_role']=='admin'){
	$method = $_GET['method'] ?? null;
	
	if ($subAction!=null){
		$controllerFileName = 'controllers/admin/' . $subAction . 'Controller.php';

			include_once $controllerFileName;
		
	}
	else {
		view('admin/main');
	}

}*/
/*else {
	header('location: /login');
	exit();
}*/