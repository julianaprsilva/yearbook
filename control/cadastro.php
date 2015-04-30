<?php
	session_start();
	require_once '../model/banco.class.php';
	require_once '../model/arquivo.php';


	$nome = htmlspecialchars($_POST['nome']);
	$login = htmlspecialchars($_POST['login']);
	$email = htmlspecialchars($_POST['email']);
    $senha = md5(htmlspecialchars($_POST['senha']));
    $cidade = intval(htmlspecialchars($_POST['cidades']));
    $descricao = htmlspecialchars($_POST['descricao']);
	$foto = salvaArquivo($_FILES['foto'], $login);
    

	$banco = new Banco();
	$sql = "INSERT INTO participantes (nomeCompleto, login, email, senha, cidade, descricao, arquivoFoto) VALUES(?, ?, ?, ?, ?, ?, ?)";
	$stmt = $banco->conn->prepare($sql);
	$stmt->execute(array($nome, $login, $email, $senha, $cidade, $descricao, $foto));
	
	if($stmt->rowCount() >= 1){
		$_SESSION['login'] = $login;
		$_SESSION['senha'] = $senha;
		$_SESSION['logged'] = true;
		$banco->conn = null;
		header('location:../perfil.php');
	}else {
		$banco->conn = null;
		echo "<p>Erro no cadastro do usuário</p>";
		die();
	}
?>