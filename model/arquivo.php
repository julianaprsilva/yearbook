<?php
require_once 'thumbnail.php';

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
	  	mkdir($dir, 0755);  
	  	
	  $caminho = $dir.$login.".";
	  //Pega extensão, para depois usar nome do arquivo
	  $extensao = explode('/', $arquivo["type"]);
	  $pathImg = $caminho.$extensao[1];

	  if(move_uploaded_file($arquivo["tmp_name"], $pathImg)) {
	  	geraThumbnail($pathImg, 360, 240, $caminho."png", 9);
	  	//Remover o arquivo sem redimesionamendo, se extensão for diferente de png
	  	if($extensao[1] != 'png')
	  		unlink($pathImg);
		return $login.".png";
	  } 
	  else {
	     echo "<p>Erro arquivo não criado</p>";
		 die();
	  }
}
?>