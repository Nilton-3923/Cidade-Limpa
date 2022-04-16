const anuncios = document.getElementById('anuncios');
const img = document.querySelectorAll('img');
let idx = 0;

setInterval(()=>{
    idx++;

    if(idx > img.length - 4){
        idx = 0;
    }
    anuncios.style.transform='translateX(-'+idx*1000+'px)';
},4000)