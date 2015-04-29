<?php
session_start();
if(!isset($_SESSION['logged'])){
		header('location:index.php');
}
require_once '../model/banco.class.php';
require_once '../model/arquivo.php';
require_once '../model/participante.class.php';
require_once '../model/cidade.class.php';

		$login = $_SESSION['login'];
		$banco = new Banco();
		$stmt = $banco->conn->prepare("SELECT * FROM participantes WHERE login = ?");
		$stmt->execute(array($login));
		$participante = $stmt->fetchObject("Participante");
		
		$stmt = $banco->conn->prepare("SELECT * FROM cidades WHERE idCidade = ?");
		$stmt->execute(array($participante->cidade));
		$cidade = $stmt->fetchObject("Cidade");
		$participante->objCidade = $cidade;
	
	
	if(isset($_POST['nome'])) {
		if($_POST['nome'] != $participante->nomeCompleto)
			$participante->nomeCompleto = htmlspecialchars($_POST['nome']);
	}
	if(isset($_POST['email'])) {
		if($_POST['email'] != $participante->email)
			$participante->email = htmlspecialchars($_POST['email']);
	}
	if(isset($_POST['senha'])) {
		if(md5($_POST['senha']) != $participante->senha)
			$participante->senha = htmlspecialchars($_POST['senha']);
	}
	if(isset($_POST['cidade'])) {
		if($_POST['cidade'] != $participante->cidade)
			$participante->cidade = intval(htmlspecialchars($_POST['cidade']));
	}
	if(isset($_POST['descricao'])) {
		if($_POST['descricao'] != $participante->descricao)
			$participante->descricao = intval(htmlspecialchars($_POST['descricao']));
	}
	if(empty($_FILES['foto'])) {
		$foto = salvaArquivo($_FILES['foto'], $login);
	}

	$banco = new Banco();
	$sql = "UPDATE participantes SET nomeCompleto=?, email=?, senha=?, cidade=?, descricao=?, arquivoFoto=?";
	$stmt = $banco->conn->prepare($sql);
	$stmt->execute(array($participante->nomeCompleto, $participante->email, $participante->senha, $participante->cidade, 
	$participante->descricao, $participante->arquivoFoto));
	
	if($stmt->rowCount() >= 1){
		header('location:../perfil.php');
	}else {
		echo "<p>Erro ao editar usuário</p>";
		die();
	}
?>