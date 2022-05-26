var imagem = document.getElementById("foto");
var preview = document.getElementById("preview");

imagem.addEventListener("change",()=>{
    var reader = new FileReader();
    let penis = imagem.files[0];

    reader.readAsDataURL(penis);

    reader.onloadend = function () {
    preview.src = reader.result;
    }
})

var senha = document.getElementById('senha');
var Csenha = document.getElementById('Csenha')
var mostrarSenha = document.getElementById('mostrarSenha');

mostrarSenha.onclick = ()=>{
    mostrarSenha.classList.toggle('ativo');
    if(senha.type === "password"){
        senha.type = "text";
        Csenha.type = "text";
    }else{
        senha.type = "password"
        Csenha.type = "password";
    }
}

var modalCep = document.getElementById('modalCep');

function hover(){
    modalCep.style.display="flex";
    setTimeout(()=>{
        modalCep.style.opacity="1";
    },100)
    
}
function hoverOff(){
    setTimeout(()=>{
        modalCep.style.opacity="0";
        setTimeout(()=>{
            modalCep.style.display="none";
        },100)
    },2500)
}