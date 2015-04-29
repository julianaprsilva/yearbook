<?php
	class Cidade {
		public $idCidade;
		public $nomeCidade;
		
		
		function exibeCidade() {
		
			echo "
					<option value='$this->idCidade'>".utf8_encode($this->nomeCidade)."</option>";
		
		}
		
	}
?>