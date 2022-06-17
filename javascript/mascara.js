//  replace 
//  /^(\d{5})(\d{3})/
// "$1-$2"
const cep = document.getElementById("cep");

cep.addEventListener('keypress', () =>{
    let ceplength = cep.value.length

    console.log(ceplength)
    if(ceplength === 5 ){
        cep.value += '-'
    }

})
//console.log(cep.replace(/^(\d{5})(\d{3})/, "$1-$2" ));