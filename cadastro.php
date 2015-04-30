<!DOCTYPE html>
<?php
    include_once 'view/cabecalho.html';
    require_once 'control/controle.php';
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
			<h1>Cadastro</h1>
			<form method="post" action="control/cadastro.php" name="cadastro" enctype= "multipart/form-data">
				<fieldset>
					<legend>Dados Pessoais</legend>
					<div>
						<label for="nome">Nome</label>
						<input size="35" maxlength="50" autofocus autocomplete="on" type="text" name="nome" id="nome" required/>
					</div>
					<div>
						<label for="email">Email</label>
						<input size="35" maxlength="50" autofocus autocomplete="on" type="email" name="email"
id="email" required/>
					</div>
					<div>
						<label for="login">Login</label>
						<input size="35" maxlength="50" autofocus autocomplete="on" type="text" name="login" id="login" required/>
						<span id="resultado"></span>
					</div>
					<div>
						<label for="estados">Estado</label>
						<select id="estados" name="estados" autofocus required>
							<option value="">Escolha um Estado</option>
							<?php foreach (listaEstados() as $estado):?>
								 <option value=<?php echo $estado->idEstado?>><?php echo $estado->nomeEstado?></option>
						  	<?php endforeach;?>
						</select>
					</div>
					<div>
						<label for="cidades">Cidade</label>
						<select name="cidades" id="cidades">
							<option value="">-- Escolha um estado --</option>
						</select>
					</div>
                    <div>
                        <label for="descricao">Descrição</label>
                        <textarea rows="4" cols="50" name="descricao" required></textarea>
                    </div>
                    <input type="hidden" name="tamanho" value="100000" />
                    <div>
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" onchange="verificaExtensao()" size="30" required/>
                    </div>
					<div>
						<label for="senha">Senha</label>
						<input name="senha" id="senha" size="35" maxlength="10" autofocus type="password" required/>
					</div>
					<div>
						<label for="senhaconf">Confirme a senha</label>
						<input onchange="verificaSenha()"size="35" maxlength="10" autofocus type="password"
name="senhaconf" id="senhaconf" required/>    
					</div>
					<div>
						<button class="button" type="submit">cadastrar</button>
					</div>
				</fieldset>
			</form>
		</main>
    </body>
</html>
<?php
    include_once 'view/rodape.html';
?>