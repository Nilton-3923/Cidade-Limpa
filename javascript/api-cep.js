function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
   
        document.getElementById('bairro').value=(conteudo.bairro);
        document.getElementById('uf').value=(conteudo.uf);
  
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}




function pesquisarcep(valor){
    //Nova variável 'cep' somente com digitos
    var cep = valor.replace(/\D/g,'');

    if(cep != ""){
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Validando o formato do cep
        if(validadecep.test(cep)){

            //Prechendo os campos com '...' enquano consulta webservice

            document.getElementById('bairro').value="...";
            document.getElementById('uf').value="...";
            document.getElementById('logradouro').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);


        }
    }
}