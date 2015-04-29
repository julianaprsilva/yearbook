<?php
	session_start();
	if(!isset($_SESSION['logged']))
		header('location:index.php');
	$loginDono = $_SESSION['login'];
	if(!isset($_GET['login']))
		header('location:index.php');
	$login = $_GET['login'];
	
	//Verifica se não é perfil do dono e cria cookie
	if($login != $loginDono) {
		$visitados[$login] = $login;
		if(isset($_COOKIE['ultimos_visitados'])) {
			$visitados = unserialize($_COOKIE['ultimos_visitados']);
			$visitados[$login] = $login;
			setcookie("ultimos_visitados", serialize($visitados));
		}
		setcookie("ultimos_visitados", serialize($visitados));
		print_r($_COOKIE['ultimos_visitados']);
	}
	
	require_once 'control/controle.php';
	include_once 'view/cabecalho.html';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Turma Desenvolvimento de Aplicações Web</title>
        <meta charset="utf-8" />
        <meta name="author" content="Juliana Silva" />
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    </head>
    <body>
        <main>
        	<?php include_once 'view/menu.html';?>
            <div class="info"> 
               	<?php exibeFotoPerfil($login);?>
                <div class="lista">
                    <dl>
                       <?php exibePerfil($login);?>
                    </dl>
                </div>
             </div>
        </main>
        <?php include_once 'view/rodape.html';?>
    </body>
</html>
