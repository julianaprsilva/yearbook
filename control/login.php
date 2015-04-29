<?php
	session_start();
	require_once '../model/banco.class.php';

	$login = htmlspecialchars($_POST['login']);
	$senha = md5(htmlspecialchars($_POST['senha']));

	$banco = new Banco();
	$stmt = $banco->conn->prepare("SELECT * FROM participantes WHERE login = ? AND senha = ?");
	$stmt->execute(array($login, $senha));

	if($stmt->rowCount() == 1) {
		$_SESSION['login'] = $login;
		$_SESSION['senha'] = $senha;
		$_SESSION['logged'] = true;
		header('location:../perfil.php');
	}else {
		$_SESSION["logged"] = false;
		header('location:../index.php');
	}
	
	
	
	
	
?>