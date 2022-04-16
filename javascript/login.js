var anuncios = document.getElementById('anuncios');
var somador = 0;

setInterval(()=>{
    if(somador > 1999){
        somador = -1000;
    }
    somador += 0;
    anuncios.style.transform='translateY(-'+somador+'px)';
},2000)