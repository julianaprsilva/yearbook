<?php
	class Participante {
		public $login;
		public $senha;
		public $nomeCompleto;
		public $arquivoFoto;
		public $cidade;
		public $objCidade;
		public $objEstado;
		public $estado;
		public $email;
		public $descricao;
		
		function exibeFotoPerfil() {
			$nome = explode(" ", $this->nomeCompleto);
			return "<figure class='figaluno'> 
						<img src='imagens/perfil/$this->arquivoFoto' alt='$this->nomeCompleto' title='Foto $this->nomeCompleto' />
						<figcaption>
							$nome[0]
						<figcaption>
					</figure>";
		
		}
		
	function exibeParticipante() {
		$cidade = utf8_encode($this->objCidade->nomeCidade);
		$estado = $this->objEstado->sigaEstado;
		$nome = utf8_encode($this->nomeCompleto);
		$descricao = utf8_encode($this->descricao);
		
			return "  <dt>Nome:</dt><dd>$nome</dd>
                        <dt>Cidade:</dt><dd>$cidade-$estado</dd>
                        <dt>Email:</dt> <dd>$this->email</dd>
                        <dt>Informações:</dt> 
                            <dd>
                               $descricao
                            </dd>";
		}
		
	}
?>