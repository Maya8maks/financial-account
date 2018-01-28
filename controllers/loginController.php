<?php
if($action=='login'){
	if(!empty($_POST)){
		$name=$_POST['login'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		if($name!='' && $email !='' && $password!=''){
			$user= getUser($db, $name, $email, $password);
			if(!empty($user)){

				$_SESSION['user']=$user[0]['id'];
				$_SESSION['user_name']=$user[0]['name'];
				$_SESSION['flash_msg'] = "Привіт" ." ". $user[0]['name'];
				include "views/main.php";
				exit();
				}
		}
	}
	view('login');
}