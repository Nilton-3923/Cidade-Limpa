var divRegistrar = document.getElementById('divRegistrar');//INULTILIZADO
var divLogin = document.getElementById('divLogin');//INULTILIZADO
var movimentacaoLoginEcadastro = document.getElementById('movimentacaoLoginEcadastro');
var widthDoLoginComCorrecao = divLogin.clientWidth + 200;

var btnEscolherRegistro = document.getElementById('btnEscolherRegistro');
var btnEscolherLogin = document.getElementById('btnEscolherLogin');

function trocarLoginParaRegistro(){
    movimentacaoLoginEcadastro.style.transform="translateX(-"+ widthDoLoginComCorrecao +"px)";//movimento

    btnEscolherRegistro.classList.add('escolhido');
    btnEscolherLogin.classList.remove('escolhido');
}
function trocarRegistroParaLogin(){
    movimentacaoLoginEcadastro.style.transform="translateX(0px)";//movimento

    btnEscolherRegistro.classList.remove('escolhido');
    btnEscolherLogin.classList.add('escolhido');
}


const img1 = document.getElementById('img1');
const img2 = document.getElementById('img2');
const img3 = document.getElementById('img3');

function img1_(){
    img1.style.opacity="1"
    img2.style.opacity="0"
    img3.style.opacity="0"
}
function img2_(){
    img1.style.opacity="0"
    img2.style.opacity="1"
    img3.style.opacity="0"
}
function img3_(){
    img1.style.opacity="0"
    img2.style.opacity="0"
    img3.style.opacity="1"
}
const delay = 4;
const delayEmSegundos = delay * 1000;
let cont = 1;

function carroussel(){
    if(cont === 1){
        img1_();
        setTimeout(()=>{
            cont += 1
        },delayEmSegundos)
    }
    
    if(cont === 2){
        img2_();
        setTimeout(()=>{
            cont += 1
        },delayEmSegundos)
    }
    
    if(cont === 3){
        img3_();
        setTimeout(()=>{
            cont = 1
        },delayEmSegundos)
    }
    
}
carroussel();
setTimeout(()=>{
    setInterval(()=>{
        carroussel();
    },5000)
},100)

/* ----------------------------------JAVASCRIPT DO CADASTRO-------------------------*/

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
var senhaLogin = document.getElementById('senhaLogin');
var senha = document.getElementById('senha');
var Csenha = document.getElementById('Csenha')
var mostrarSenhaCadastro = document.getElementById('mostrarSenhaCadastro');
var mostrarSenhaLogin = document.getElementById('mostrarSenhaLogin');

function mostrarSenha(){
    mostrarSenhaCadastro.classList.toggle('ativo');
    mostrarSenhaLogin.classList.toggle('ativo');
    
    if(senhaLogin.type === "password"){
        senhaLogin.type = "text";
    }else{
        senhaLogin.type = "password";
    }

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

