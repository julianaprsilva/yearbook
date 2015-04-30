$(function(){
	$('#estados').change(function(){
		console.log("Teste");
		if( $(this).val() ) {
			console.log($(this).val());
			var estado = $('select').val();
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


$(function() {
    $("#login").change(function() {
    	var login = $("#login").val();
    
    	$.post('login.php',{login: login},function(data){
    		if(data == 1) {
    			$('#login').val("");
    			$('#resultado').css("color", "red");
    			$('#resultado').html("Login já existe");
    		}
    		else { 
    			$('#resultado').css("color", "green");
    			$('#resultado').html("Login válido");
    		}
    			
    	});
    });
});