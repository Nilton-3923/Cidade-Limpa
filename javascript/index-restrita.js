var navbarModal = document.getElementById('navbarModal');
var abreModal = document.getElementById('abre-modal');
var seta = document.getElementById('seta');

        abreModal.onclick = ()=>{
            if(navbarModal.style.top === "-170px"){
                navbarModal.style.top = "90px";
                seta.classList.toggle('movimento-seta');
            }else{
                navbarModal.style.top = "-170px";
                seta.classList.toggle('movimento-seta');
            }   
        }

function modalAlterarConta(){
    var modalAlterarConta = document.getElementById('modalAlterarConta');

    modalAlterarConta.classList.toggle('apareceModalAlterarConta');
    
}

var idmodalCriarDenuncia = document.getElementById('modalCriarDenuncia');
function modalCriarDenuncia(){
    idmodalCriarDenuncia.classList.add('apareceModalCriarDenuncia');
}
function cancelarModalCriarDenuncia(){
    idmodalCriarDenuncia.classList.remove('apareceModalCriarDenuncia');
}

 
function modalAlterarDenuncia(){
    
}