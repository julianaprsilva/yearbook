<!DOCTYPE html>
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
<html lang="pt-br">
	<head>
        <title>Formulário de Cadastro</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/estilo.css" />
        <script src="scripts/cadastro.js"></script>
        <script src="scripts/jquery.js"></script>
        <script src="scripts/cadastro_jquery.js"></script>
	</head>
    
    <body>
		<main>
			<?php include_once 'view/menu.html';?>
			<h1>Editar</h1>
			<form method="post" action="control/editar.php" enctype= "multipart/form-data">
				<fieldset>
				
					<legend>Dados Pessoais</legend>
					<div>
						<label for="nome">Nome</label>
						<input size="50" maxlength="50" autofocus autocomplete="on" type="text" name="nome" id="nome" required value="<?php echo $participante->nomeCompleto;?>"/>
					</div>
					<div>
						<label for="email">Email</label>
						<input size="35" maxlength="50" autofocus autocomplete="on" type="email" name="email" id="email" required value="<?php echo $participante->email;?>" />
					</div>
					<div>
						<label for="estados">Estado</label>
						<select id="estados" name="estados" autofocus required>
							<option value="">Escolha um Estado</option>
							<?php foreach (listaEstados() as $estado): 
							       if($participante->objEstado->idEstado == $estado->idEstado) {?>
							       	<option value=<?php echo $estado->idEstado?> selected="selected"><?php echo $estado->nomeEstado?>
							       	</option>
							       <?php }else?>
						  			<option value=<?php echo $estado->idEstado?>><?php echo $estado->nomeEstado?></option>
						  	<?php endforeach;?>
						</select>			
					</div>
					
					<div>
						<label for="cidades">Cidade</label>
						<select name="cidades" id="cidades">
							<option value="">-- Escolha um estado --</option>
							<option value=<?php echo $participante->cidade;?> selected="selected"><?php echo $participante->objCidade->nomeCidade;?></option>
						</select>
					</div>
					
                    <div>
                        <label for="descricao">Descrição</label>
                        <textarea rows="4" cols="50" name="descricao" required autocomplete><?php echo $participante->descricao;?></textarea>
                    </div>
                    <div>
                        <label for="foto">Foto</label>
                        <input size="30" autofocus autocomplete="on" type="file" name="foto" id="foto" />
                    </div>
					<div>
						<label for="senha">Senha</label>
						<input size="35" maxlength="10" autofocus type="password" name="senha" id="senha" />
					</div>
					<div>
						<label for="senhaconf">Confirme a senha</label>
						<input onchange="verificaSenha()"size="35" maxlength="10" autofocus type="password" name="senhaconf" id="senhaconf" />    
					</div>
					<div>
						<button class="button" type="submit">enviar</button>
					</div>
				</fieldset>
			</form>
		</main>
    </body>
</html>
<?php
    include_once 'view/rodape.html';
?>