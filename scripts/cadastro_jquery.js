$(function(){
	$('#estados').change(function(){
		if( $(this).val() ) {
			var estado = $('#estados').val();
			$('#cidades').hide();
			$('.carregando').show();
			$.getJSON('cidade.php?idestado='+estado, function(j){
				var options = '<option value="">Escolha a cidade</option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].idCidade + '">' + j[i].nomeCidade + '</option>';
				}	
				$('#cidades').html(options).show();
				$('.carregando').hide();
			});
		} else {
			$('#cidades').html('<option value="">-- Escolha um estado --</option>');
		}
	});
});


$(function(){// declaro o início do jquery
    $("#login").change(function() {
    	//botão para disparar a ação
    	var login = $("input[name='login']").val();
    
    	$.post('login.php',{login: login},function(data){
    		if(data == 1) {
    			$('#login').val("");
    			$('#resultado').css("color", "red");
    			$('#resultado').html("Usuário já existe");
    		}
    		else { 
    			$('#resultado').css("color", "green");
    			$('#resultado').html("Usuário não existe");
    		}
    			
    	});
    });
});