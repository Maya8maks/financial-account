<?php
if( $action == 'logout') {
	if(!empty($_SESSION['user'])){
			unset( $_SESSION['user'] );
			include "views/main.php";
		}
	}
	
	
