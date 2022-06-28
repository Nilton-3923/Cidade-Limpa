const tabelaTudo = document.getElementById('tudo');
const tabelaNaoResolvida = document.getElementById('Nao-Resolvida');
const tabelaResolvida = document.getElementById('resolvida');

////////////////////NILTON EDITOU 
const select = document.getElementById('select');

function selecionados(){
     let valor  = select.options[select.selectedIndex].value;

    if (valor == 1){
         tabelaNaoResolvida.style.display = "block"
        tabelaResolvida.style.display = "none"
    }
    else {
        tabelaResolvida.style.display = "block"
        tabelaNaoResolvida.style.display = "none"
    }
}

document.getElementById('select-all').onclick = function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}

