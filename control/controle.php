<?php

	require_once 'model/banco.class.php';
	require_once 'model/participante.class.php';
	require_once 'model/cidade.class.php';
	require_once 'model/estado.class.php';
	
	function listaPessoas($limite) {
		$banco = new Banco();
		$stmt = $banco->conn->prepare("SELECT nomeCompleto, arquivoFoto, login FROM participantes LIMIT :limit");
		$stmt->bindParam(':limit', $limite, PDO::PARAM_INT);
		$stmt->execute();
		$participantes = $stmt->fetchAll(PDO::FETCH_CLASS, "Participante");
		
		foreach ($participantes as $participante) {
			echo "<li>
					<a href='pessoal.php?login=$participante->login' >"
					.$participante->exibeFotoPerfil().
				  "</a></li>";
		}
		
	}
	
	function exibePerfil($login) {
		$banco = new Banco();
		$stmt = $banco->conn->prepare("SELECT * FROM participantes WHERE login = ?");
		$stmt->execute(array($login));
		$participante = $stmt->fetchObject("Participante");
	
		$stmt = $banco->conn->prepare("SELECT * FROM cidades WHERE idCidade = ?");
		$stmt->execute(array($participante->cidade));
		$cidade = $stmt->fetchObject("Cidade");
		$participante->objCidade = $cidade;
		
		$stmt = $banco->conn->prepare("SELECT * FROM estados WHERE idEstado = ?");
		$stmt->execute(array($cidade->idEstado));
		$estado = $stmt->fetchObject("Estado");
		$participante->objEstado = $estado;
		
		echo $participante->exibeParticipante();
	}
	
	function exibeFotoPerfil($login) {
		$banco = new Banco();
		$stmt = $banco->conn->prepare("SELECT * FROM participantes WHERE login = ?");
		$stmt->execute(array($login));
		$participante = $stmt->fetchObject("Participante");
		$nome = utf8_encode($participante->nomeCompleto);
		$foto = $participante->arquivoFoto;
		
		echo "<img src='imagens/perfil/$foto' alt='Foto $nome' title='Foto $nome' />";
		
	}
	
	function dados($login) {
		$banco = new Banco();
		$stmt = $banco->conn->prepare("SELECT * FROM participantes WHERE login = ?");
		$stmt->execute(array($login));
		$participante = $stmt->fetchObject("Participante");
		
		$stmt = $banco->conn->prepare("SELECT * FROM cidades WHERE idCidade = ?");
		$stmt->execute(array($participante->cidade));
		$cidade = $stmt->fetchObject("Cidade");
		$participante->objCidade = $cidade;
		
		$stmt = $banco->conn->prepare("SELECT * FROM estados WHERE idEstado = ?");
		$stmt->execute(array($cidade->idEstado));
		$estado = $stmt->fetchObject("Estado");
		$participante->objEstado = $estado;
		
		return $participante;
	}
	
	function ultimosVisitados() {
		if (isset($_COOKIE['ultimos_visitados'])) {
			$visitados = unserialize($_COOKIE['ultimos_visitados']);
			foreach ($visitados as $visitado) {
				$participante = dados($visitado['login']);
				echo "<li>
					<a href='"."pessoal.php?login=".$participante->login."'>"
					.$participante->exibeFotoPerfil().
				  "</a></li>";
			}	
		}else 
			echo "<p>Você ainda não visitou nenhum perfil.</p>";
	}
	
	function busca($nome) {
		$banco = new Banco();
		$stmt = $banco->conn->prepare("SELECT * FROM participantes WHERE nomeCompleto like ?");
		$stmt->execute(array("%$nome%"));
	
		if($stmt->rowCount() >= 1) {
			$participantes = $stmt->fetchAll(PDO::FETCH_CLASS, "Participante");
			foreach ($participantes as $participante) {
				echo "<li>
						<a href='pessoal.php?login=$participante->login' >"
						.$participante->exibeFotoPerfil().
					  "</a></li>";
			}	
		}else {
			echo "<p>Não encontrado participante</p>";
		}
	}
	
		function listaEstados() {
		$banco = new Banco();
		$stmt = $banco->conn->query("SELECT idEstado, nomeEstado, sigaEstado FROM estados");
		$estados = $stmt->fetchAll(PDO::FETCH_CLASS, "Estado");
		return $estados;	
	}
	
	function listaCidadeAssoc($idestado) {
		$banco = new Banco();
		$stmt = $banco->conn->prepare("SELECT idCidade, nomeCidade FROM cidades WHERE idEstado = ?");
		$stmt->execute(array($idestado));
		$cidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $cidades;
	}
	
	function verificaLogin($login) {
		$banco = new Banco();
		$stmt = $banco->conn->prepare("SELECT * FROM participantes WHERE login = ?");
		$stmt->execute(array($login));
		echo $stmt->rowCount();
		if($stmt->rowCount() == 1) 
			return 1;
		else 
			return 0;
	
	}
?>