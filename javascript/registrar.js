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