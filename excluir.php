<?php
session_start();
	 if(!isset($_SESSION['logged'])){
		header('location:index.php');
	}
    include_once 'view/cabecalho.html';
    include_once 'control/controle.php';
    
    $login = $_SESSION['login'];
    $participante = dados($login);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Turma Desenvolvimento de Aplicações Web</title>
        <meta charset="utf-8" />
        <meta name="description" content="Yearbook Desenvolvimento de Aplicações Web" />
        <meta name="author" content="Juliana Silva" />
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
        <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    </head>
    <body>
        <main>
        	<div class='introducao'>
        		 <p>Você tem certeza, que quer sair desta turma. Você perderá seu acesso.</p>
            	<p>Insira seus dados. Para confirmar a sua exclusão da turma</p>
        	</div>
        	<form method="post" action="control/excluir.php" >
				<fieldset>
					<legend>Excluir</legend>
					<div>
						<label for="login">Login</label>
						<input size="35" maxlength="50" autofocus autocomplete="on" type="text" name="login" id="login" required/>
					</div>
					<div>
						<label for="senha">Senha</label>
						<input size="35" maxlength="50" autofocus autocomplete="on" type="password" name="senha" id="senha" required/>
					</div>
					<div class="button">
						<button type="submit">excluir</button>
					</div>
				</fieldset>
			</form>
        </main>
    </body>
</html>
<?php
    include_once 'view/rodape.html';
?>