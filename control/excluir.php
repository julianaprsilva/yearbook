<?php
	session_start();
	 if(!isset($_SESSION['logged'])){
		header('location:index.php');
	}
    include_once 'view/cabecalho.html';
    include_once 'control/controle.php';
    require_once 'model/banco.class.php';
    
    $login = $_SESSION['login'];
    $participante = dados($login);
	

	$login = htmlspecialchars($_POST['login']);
	$senha = md5(htmlspecialchars($_POST['senha']));
	
	if($login == $participante->login && $senha == $participante->senha) {
		$banco = new Banco();
		$stmt = $banco->conn->prepare("DELETE FROM participantes WHERE login = ? AND senha = ?");
		$stmt->execute(array($login, $senha));
	
		if($stmt->rowCount() == 1) {
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
		}else {
			echo "<p>Erro na exclusão</p>";
		}
	}

	
	
	
	
	
	
?>