$(function(){
	$("#pesquisa").keyup(function(){
		//Recuperar o valor do campo

		var pesquisa = $(this).val();
		
		//Verificar se há algo digitado
		if(pesquisa != ''){
			var dados = {
				palavra : pesquisa
			}
			$.post('pesq-user.php', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 

				$(".resultado").html(retorna);
			});
        }
        else{
            retorna = null;
            $.post('pesq-user.php', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 

				$(".resultado").html(retorna);
			});
        }
	});
});