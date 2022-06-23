const tudo = document.getElementById('tudo');
const leste = document.getElementById('leste');
const oeste = document.getElementById('oeste');
const norte = document.getElementById('norte');
const sul = document.getElementById('sul');


const select = document.getElementById('selectRegiao');

function selecionarRegiao(){
    let valor  = select.options[select.selectedIndex].value;


    if (valor == 0){
        tudo.style.display = "block"
        leste.style.display = "none"
        oeste.style.display = "none"
        norte.style.display = "none"
        sul.style.display = "none"
    }
    else if(valor == 1){
        tudo.style.display = "none"
        leste.style.display = "none"
        oeste.style.display = "none"
        norte.style.display = "block"
        sul.style.display = "none"
    }
    else if(valor == 2){
        tudo.style.display = "none"
        leste.style.display = "none"
        oeste.style.display = "none"
        norte.style.display = "none"
        sul.style.display = "block"
    }
    else if(valor == 3){
        tudo.style.display = "none"
        leste.style.display = "block"
        oeste.style.display = "none"
        norte.style.display = "none"
        sul.style.display = "none"
    }
    else {
        tudo.style.display = "none"
        leste.style.display = "none"
        oeste.style.display = "block"
        norte.style.display = "none"
        sul.style.display = "none"
    }
}
