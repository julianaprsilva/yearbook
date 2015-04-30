<?php
	require_once 'model/banco.class.php';
	require_once 'model/participante.class.php';
	require_once 'model/cidade.class.php';
	require_once 'model/estado.class.php';
	
	//Listas os outros participantes de acordo limite definido
	function listaPessoas($limite=false, $login=false) {
		$banco = new Banco();
		if($login === false && $limite !== false) {
			$stmt = $banco->conn->prepare("SELECT nomeCompleto, arquivoFoto, login FROM participantes LIMIT :limit");
			$stmt->bindParam(':limit', $limite, PDO::PARAM_INT);
		}elseif($login === true && $limite === false) {
			$stmt = $banco->conn->prepare("SELECT nomeCompleto, arquivoFoto, login FROM participantes WHERE login not like :login");
			$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		}else {
			$stmt = $banco->conn->prepare("SELECT nomeCompleto, arquivoFoto, login FROM participantes WHERE login not like :login LIMIT :limit");
			$stmt->bindParam(':login', $login, PDO::PARAM_STR);
			$stmt->bindParam(':limit', $limite, PDO::PARAM_INT);
		}
		$stmt->execute();
		$participantes = $stmt->fetchAll(PDO::FETCH_CLASS, "Participante");
		
		foreach ($participantes as $participante) {
			echo "<li>
					<a href='pessoal.php?login=$participante->login' >"
					.$participante->exibeFotoPerfil().
				  "</a></li>";
		}
		$banco->conn = null;
		
	}
	
	//Fornece os dados para montar os dados os participantes
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
		
		$banco->conn = null;
		
		echo $participante->exibeParticipante();
	}
	
	//Exibe foto do perfil, no qual passado o login como parâmetro
	function exibeFotoPerfil($login) {
		$banco = new Banco();
		$stmt = $banco->conn->prepare("SELECT * FROM participantes WHERE login = ?");
		$stmt->execute(array($login));
		$participante = $stmt->fetchObject("Participante");
		$nome = $participante->nomeCompleto;
		$foto = $participante->arquivoFoto;
		
		$banco->conn = null;
		
		echo "<img src='imagens/perfil/$foto' alt='Foto $nome' title='Foto $nome' />";
	}
	
	//Retorna todos dados do participante, que foi passado login
	function dados($login) {
		$banco = new Banco();
		
		//Dados participante
		$stmt = $banco->conn->prepare("SELECT * FROM participantes WHERE login = ?");
		$stmt->execute(array($login));
		$participante = $stmt->fetchObject("Participante");
		
		//Dados da cidade do participante
		$stmt = $banco->conn->prepare("SELECT * FROM cidades WHERE idCidade = ?");
		$stmt->execute(array($participante->cidade));
		$cidade = $stmt->fetchObject("Cidade");
		$participante->objCidade = $cidade;
		
		//Dados do estado do participante
		$stmt = $banco->conn->prepare("SELECT * FROM estados WHERE idEstado = ?");
		$stmt->execute(array($cidade->idEstado));
		$estado = $stmt->fetchObject("Estado");
		$participante->objEstado = $estado;
		
		$banco->conn = null;
	
		return $participante;
	}
	
	//Localiza os últimos visitados pelo usuário pegando o valor do cookie
	function ultimosVisitados($login) {
		if (isset($_COOKIE[$login])) {
			$visitados = unserialize($_COOKIE[$login]);
			foreach ($visitados as $key => $visitado) {
				$participante = dados($key);
				echo "<li>
					<a href='"."pessoal.php?login=".$participante->login."'>"
					.$participante->exibeFotoPerfil().
				  "</a></li>";
			}	
		}else 
			echo "<p>Você ainda não visitou nenhum perfil.</p>";
	}
	
	//Busca o participante pelo nome, que foi passado como parâmetro
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
		$banco->conn = null;
	}
	
	//Lista os estados que estão cadastro no banco
	function listaEstados() {
		$banco = new Banco();
		$stmt = $banco->conn->query("SELECT idEstado, nomeEstado, sigaEstado FROM estados");
		$estados = $stmt->fetchAll(PDO::FETCH_CLASS, "Estado");
		$banco->conn = null;
		return $estados;	
	}
	
	//Lista as cidade, de acordo com estado passado como parâmetro
	function listaCidadeAssoc($idestado) {
		$banco = new Banco();
		$stmt = $banco->conn->prepare("SELECT idCidade, nomeCidade FROM cidades WHERE idEstado = ?");
		$stmt->execute(array($idestado));
		$cidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $cidades;
	}
	
	//Verifica se existe o login passado como parâmetro
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