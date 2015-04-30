<!DOCTYPE html>
<?php
	session_start();
	 if(!isset($_SESSION['logged'])){
		header('location:index.php');
	}
    include_once 'view/cabecalho.html';
    require_once 'control/controle.php';
    
    if(isset($_POST['nome'])) {
    	$nome = htmlspecialchars($_POST['nome']);
    }
    
?>
<html lang="pt-br">
	<head>
        <title>Formulário de Cadastro</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/estilo.css" />
        <script src="scripts/cadastro.js"></script>
	</head>
    
    <body>
		<main>
			<?php include_once 'view/menu.html';?>
			<h1>Buscar Contato</h1>
			<form method="post" action="#" >
				<fieldset>
					<div>
						<label for="nome">Nome</label>
						<?php if(isset($nome)){ ?>
							<input size="35" maxlength="50" autofocus autocomplete="on" type="text" name="nome" id="nome " 
							        required value="<?php echo $nome?>" />
						<?php }else {?>
							<input size="35" maxlength="50" autofocus autocomplete="on" type="text" name="nome" id="nome" required />
						<?php }?>
					<div>
						<button class="button"type="submit">Buscar</button>
					</div>
				</fieldset>
			</form>
			
			<?php
				if(isset($nome)) {
					busca($nome);
				}
			?>
		</main>
    </body>
</html>
<?php
    include_once 'view/rodape.html';
?>