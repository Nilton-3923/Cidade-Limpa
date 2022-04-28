

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

const delay = 1.5; // <=== CONTROLA O DELAY POR AQUI 
const delayEmSegundos = delay * 1000

function carroussel(){
    setTimeout(()=>{
        img1_();
        setTimeout(()=>{
            img2_();
            setTimeout(()=>{
                img3_();
            },delayEmSegundos)
        },delayEmSegundos)
    },delayEmSegundos)

    return delayEmSegundos;
}

const delayDoCarrossel = delayEmSegundos * 6; //AQUI O DELAY DO CARROSSEL


setInterval(()=>{
    carroussel();
},delayDoCarrossel)

