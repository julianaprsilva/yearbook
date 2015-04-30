<?php
	session_start();
	 if(!isset($_SESSION['logged'])){
		header('location:index.php');
	}
    require_once '../model/banco.class.php';
    
	$login = htmlspecialchars($_POST['login']);
	$senha = md5(htmlspecialchars($_POST['senha']));
	
	if($login == $_SESSION['login'] && $senha == $_SESSION['senha']) {
		$banco = new Banco();
		$stmt = $banco->conn->prepare("DELETE FROM participantes WHERE login = ? AND senha = ?");
		$stmt->execute(array($login, $senha));
	
		if($stmt->rowCount() == 1) {
			//Apaga foto do participante
			$caminho = '../imagens/perfil/'.$login.'.png'; 
			unlink($caminho);
			
			$_SESSION = array();  //Limpa a sessão

			if (ini_get("session.use_cookies")) {					//verifica se a sessão usa cookies
				$params = session_get_cookie_params();				//carrega todos os parâmetros do cookie da sessão
				setcookie(session_name(), '', time() - 42000,		//configura um cookie exatamente igual para 42000seg (700h) atrás
					$params["path"], $params["domain"],
					$params["secure"], $params["httponly"]
				);
				//Apagando todos cookies criados na sessão
				foreach($_COOKIE as $key=>$ck){
    				setcookie($key, $ck, time() -42000); 
				}
			}
			session_destroy();
			
			//Vai para página principal
			header("location:../index.php");	
		}else {
			echo "<p>Erro na exclusão</p>";
		}
		$banco->conn = null;
	}

	
	
	
	
	
	
?>