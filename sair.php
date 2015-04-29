<?php
	session_start();
	 if(!isset($_SESSION['logged'])){
		header('location:index.php');
	}
	
	$_SESSION = array();  //Limpa a sessão

	if (ini_get("session.use_cookies")) {					//verifica se a sessão usa cookies
		$params = session_get_cookie_params();				//carrega todos os parâmetros do cookie da sessão
		setcookie(session_name(), '', time() - 42000,		//configura um cookie exatamente igual para 42000seg (700h) atrás
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
	session_destroy();		
	header("location:index.php");	

    
?>