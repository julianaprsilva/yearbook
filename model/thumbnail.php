<?php

//Função que gera imagem thumbnail de acordo com altura e largura passada com parâmetro
function geraThumbnail($pathImg, $largura, $altura, $nomeImg, $qualidade) {
	
	$size = getimagesize($pathImg);
  	$tipo  =  $size['mime'];
  	
  	//Verifica o tipo da imagem, para carregar imagem
  	switch ($tipo) {
  		case 'image/jpeg':
  			$img = imagecreatefromjpeg($pathImg);
  		break;
  		case 'image/gif':
  			$img = imagecreatefromjpeg($pathImg);
  		break;
  		case 'image/png':
  			$img = imagecreatefrompng($pathImg);
  		break;
  	}
  	
  	if($img) {
  		$width  = imagesx($img);
  		$height = imagesy($img);
	  	$scale  = min($largura/$width, $altura/$height);
	  	
	  	//Verifica se o tamanho a ser remedisionado não igual ao tamanho dá imagem, senão for redimesiona a imagem
	  	if($scale != 1 && $tipo != 'image/png') {
	  		
	  		//Gera novo tamanho das imagens
	  		$new_width  = floor($scale * $width);
			$new_height = floor($scale * $height);
			
			//Cria uma imagem temporária
			$tmpImg = imagecreatetruecolor($new_width, $new_height);
			
			//Redimesiona
			imagecopyresized($tmpImg, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			
			//Gerando a imagem
			imagepng($tmpImg, $nomeImg, $qualidade);
	  	}
  	}
  		
    
}
?>