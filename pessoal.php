<?php
	session_start();
	if(!isset($_SESSION['logged']) && empty($_SESSION['logged']) && $_SESSION['logged'] == false)
		header('location:index.php');
	$loginDono = $_SESSION['login'];
	if(!isset($_GET['login']))
		header('location:index.php');
	$login = $_GET['login'];
	
	//Verifica se não é perfil do dono e cria cookie
	if($login != $loginDono) {
		$visitados[$login] = $login;
		if(isset($_COOKIE[$loginDono])) {
			$visitados = unserialize($_COOKIE[$loginDono]);
			if(array_key_exists($login, $visitados) === false) {
				$visitados[$login] = $login;
				setcookie($loginDono, serialize($visitados));
			}
		}
		setcookie($loginDono, serialize($visitados));
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
                <a href="index.php" class="voltar" title="YEARBOOK">Voltar</a>
             </div>
        </main>
        <?php include_once 'view/rodape.html';?>
    </body>
</html>
