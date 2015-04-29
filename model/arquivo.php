<?php
function salvaArquivo($arquivo, $login) {
	$errors = array('Não houve erro', 'O arquivo no upload é maior do que o limite ',
					'O arquivo ultrapassa o limite de tamanho especifiado no HTML', 
					'O upload do arquivo foi feito parcialmente','Não foi feito o upload do arquivo');
	
	  if ($arquivo["error"] > 0) {
	  	echo "<p>".$errors[$arquivo["error"]]."</p>";
	  	die();
	  }	
	  $dir = "../imagens/perfil/";	  
	  if(!file_exists ( $dir ))
	  	mkdir($dir, 0655);  //permissao de leitura e execucao
	  	
	  $caminho = $dir.$login.".";
	  //Pega extensão, para depois usar nome do arquivo
	  $extensao = explode('/', $arquivo["type"]);

	  if(move_uploaded_file($arquivo["tmp_name"], $caminho.$extensao[1]))
		return $login.$extensao[1];
	  else {
	     echo "<p>Erro arquivo não criado</p>";
		 die();
	  }
}
?>