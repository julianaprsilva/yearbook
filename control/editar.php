<?php
session_start();
if(!isset($_SESSION['logged'])){
		header('location:../index.php');
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
		
		$mudanca = false;
	
	if(!empty($_POST['nome']) && htmlspecialchars($_POST['nome']) != $participante->nomeCompleto) {
			$participante->nomeCompleto = htmlspecialchars($_POST['nome']);
			$mudanca = true;
	}
	if(!empty($_POST['email']) && htmlspecialchars($_POST['email']) != $participante->email) {
			$participante->email = htmlspecialchars($_POST['email']);
			$mudanca = true;
	}
	if(!empty($_POST['senha']) && md5($_POST['senha']) != $participante->senha) {
			$participante->senha = htmlspecialchars($_POST['senha']);
			$mudanca = true;
	}
	if(!empty($_POST['senha']) && $_POST['cidades'] != $participante->cidade) {
			$participante->cidade = intval(htmlspecialchars($_POST['cidades']));
			$mudanca = true;
	}
	if(!empty($_POST['senha']) && htmlspecialchars($_POST['descricao']) != $participante->descricao) {
			$participante->descricao = htmlspecialchars($_POST['descricao']);
			$mudanca = true;
	}

	if(isset($_FILES['foto']) && !empty($_FILES['foto']['name'])) {
		$foto = salvaArquivo($_FILES['foto'], $login);
	}

	if($mudanca) {
		$sql = "UPDATE participantes SET nomeCompleto=?, email=?, senha=?, cidade=?, descricao=? WHERE login=?";
		$stmt = $banco->conn->prepare($sql);
		$stmt->execute(array($participante->nomeCompleto, $participante->email, $participante->senha, $participante->cidade, 
		$participante->descricao, $login));

		if($stmt->rowCount() >= 1){
			header('location:../perfil.php');
			$banco->conn = false;
		}else {
			echo "<p>Erro ao editar usuário</p>";
			die();
		}
	}else 
		header('location:../perfil.php');
?>