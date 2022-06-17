'use strict';

const limparFormulario = (endereco) =>{
    document.getElementById('bairro').value ="";
    document.getElementById('rua').value ="" ;
    document.getElementById('cidade').value ="";
    document.getElementById('uf').value ="";
}

const preencherFormulario = (endereco) =>{
    document.getElementById('bairro').value = endereco.bairro;
    document.getElementById('rua').value = endereco.logradouro;
    document.getElementById('cidade').value = endereco.localidade;
    document.getElementById('uf').value = endereco.uf;
}


const cepValido = (cep) => cep.length == 9;


const mensagem = document.getElementById('mensagem');

const pesquisarCep = async() =>{

    limparFormulario();
    const cep = document.getElementById('cep').value;
    const url = `http://viacep.com.br/ws/${cep}/json/`;

    if(cepValido(cep)){
        const dados = await fetch(url);
        const endereco = await dados.json();
        
        if(endereco.hasOwnProperty('erro')){
            mensagem.style.opacity='1';    
            mensagem.style.display='block';       
        }else{
            mensagem.style.opacity='0';    
            mensagem.style.display='none';       
            preencherFormulario(endereco);
        }    
    }else{
        mensagem.style.display='block';       
        mensagem.style.opacity='1';       
    }
}


document.getElementById('cep')
        .addEventListener('focusout', pesquisarCep);

