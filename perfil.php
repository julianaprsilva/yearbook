<?php
	session_start();
	if(!isset($_SESSION['logged']))
		header('location:index.php');
	$login = $_SESSION['login'];
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
        <div class="busca">
        	<form method="post" action="buscar.php" >
				<fieldset>
					<div>
						<label for="nome">Nome:</label>
						<input size="10" maxlength="50" autofocus autocomplete="on" type="text" name="nome" id="nome" required />
						<button class="button"type="submit">Buscar</button>
					</div>
				</fieldset>
			</form>
        </div>
            <div class="info"> 
               	<?php exibeFotoPerfil($login);?>
                <div class="lista">
                    <dl>
                       <?php exibePerfil($login);?>
                    </dl>
                </div>
            </div>
            <div>
            </div>
            <p class='assuntos'>Ultimos visitados</p>
            <ul>
                <?php ultimosVisitados($login);?>
             </ul>
             <p class='assuntos'>Outros usuários</p>
             <ul>
             	<?php listaPessoas(10, $login);?>
             </ul>
           		
           		
        </main>
        <?php include_once 'view/rodape.html';?>
    </body>
</html>
