function verificaSenha() {
    var senha = document.getElementById("senha").value;
    var senhaconf = document.getElementById("senhaconf").value;
    
    if(senha.localeCompare(senhaconf) !== 0) {
        alert("A senha não confere");
        document.getElementById("senha").value = '';
        document.getElementById("senhaconf").value = '';
    }
        
}

function verificaExtensao() { 
	var extensoes_permitidas = new Array(".jpg", ".jpeg", ".png"); 
	var arquivo = document.getElementById("foto").value;

	if(arquivo == '') {
		alert("Selecione uma foto");
		return;
	}
	
	permitida = false; 
	//Pegar extensão do arquivo para realizar comparação
	extensao = (arquivo.substring(arquivo.lastIndexOf("."))).toLowerCase(); 
	
	for (var i = 0; i < extensoes_permitidas.length; i++) { 
		if (extensoes_permitidas[i] == extensao) { 
	         permitida = true; 
	         break; 
	    } 
	} 

	if(!permitida) {
		alert("Extensão não permitida. Escolha uma foto no formato jpeg, jpg ou png");
		document.getElementById("foto").value = '';
		return;
	}
	var tamanho_max = document.getElementById("foto").value;
	var tamanho = document.getElementById("foto").files[0].size;
	
	if(tamanho > tamanho_max) {
		alert("Arquivo maior que "+(tamanho_max/1000));
		return;
	}	
}