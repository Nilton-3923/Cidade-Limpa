const imgs = document.getElementById('img');
const img = document.querySelectorAll('#img img');
let idx = 0;

setInterval(()=>{
    idx++;

    if(idx > img.length - 1){
        idx = 0;
    }
    imgs.style.transform='translateX(-'+idx*65+'vw)';
    

},4500)