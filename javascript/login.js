

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

setInterval(()=>{
    carroussel();
},5000)

