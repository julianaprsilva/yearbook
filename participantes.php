<?php
session_start();
	if(!isset($_SESSION['logged']))
		header('location:index.php');
	
    include_once 'view/cabecalho.html';
    require_once 'control/controle.php';
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
        	<?php include_once 'view/menu.html';?>
        	<h1>Turma</h1>
        	 <ul>
                <?php listaPessoas(false, true)?>
            </ul>
        </main>
    </body>
</html>
<?php
    include_once 'view/rodape.html';
?>