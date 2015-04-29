<?php
	  require_once 'control/controle.php';
	  
	  if(isset($_POST['login'])) {
	  	$login = $_POST['login'];
	 	return verificaLogin($login);
	  }
?>