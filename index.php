<?php
	session_start();
    include_once 'view/cabecalho.html';
    require_once 'control/controle.php';
    if(isset($_SESSION['logged']) && $_SESSION['logged']){
		header('location:perfil.php');
	}
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
        	 <ul>
                <?php listaPessoas(10)?>
            </ul>
        	<div class='introducao'>
        		 <p>Entre no Yearbook</p>
            	<p>Insira seus dados. Não tem cadastro <a href="cadastro.php">cadastre-se</a>.</p>
            	<p>Faça parte desta turma, conheça seus colegas de turma.</p>
        	</div>
        	
        	<form method="post" action="control/login.php" >
				<fieldset>
					<legend>Acesso</legend>
					<?php if(isset($_SESSION['logged'])) {
							if($_SESSION['logged'] == false) 
								echo "<p>Login ou senha inválidos</p>";
						}
					?>
					<div>
						<label for="login">Login</label>
						<input size="35" maxlength="50" autofocus autocomplete="on" type="text" name="login" id="login" required/>
					</div>
					<div>
						<label for="senha">Senha</label>
						<input size="35" maxlength="50" autofocus autocomplete="on" type="password" name="senha" id="senha" required/>
					</div>
					<div class="button">
						<button type="submit">entrar</button>
					</div>
				</fieldset>
			</form>
        </main>
    </body>
</html>
<?php
    include_once 'view/rodape.html';
?>