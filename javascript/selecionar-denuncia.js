const tabelaTudo = document.getElementById('tudo');
const tabelaNaoResolvida = document.getElementById('Nao-Resolvida');
const tabelaResolvida = document.getElementById('resolvida');


const select = document.getElementById('select');
function selecionados(){
     let valor  = select.options[select.selectedIndex].value;;

     if (valor == 0){
        tabelaTudo.style.display = "block"
        tabelaNaoResolvida.style.display = "none"
        tabelaResolvida.style.display = "none"
     }
     else if (valor == 1){
         tabelaNaoResolvida.style.display = "block"
        tabelaTudo.style.display = "none"
        tabelaResolvida.style.display = "none"
    }
    else {
        tabelaResolvida.style.display = "block"
        tabelaTudo.style.display = "none"
        tabelaNaoResolvida.style.display = "none"
    }
}

