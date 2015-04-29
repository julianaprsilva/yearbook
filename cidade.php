<?php
	  require_once 'control/controle.php';
	  
	  if(isset($_GET['idestado'])) {
	  	$idEstado = $_GET['idestado'];
	 	$cidades = listaCidadeAssoc($idEstado);
	 	echo json_encode($cidades);
	  }
?>