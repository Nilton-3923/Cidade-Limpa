//  replace 
//  /^(\d{5})(\d{3})/
// "$1-$2"
//console.log(cep.replace(/^(\d{5})(\d{3})/, "$1-$2" ));
const cep = document.getElementById("cep");

cep.addEventListener('keypress', () =>{
    let ceplength = cep.value.length

    if(ceplength === 5 ){
        cep.value += '-'
    }

})


const telefone = document.getElementById("telefone")

telefone.addEventListener('keypress', ()=>{

    let telefonelength  = telefone.value.length

    if (telefonelength < 1 )
        telefone.value = '('

    if (telefonelength === 3)
        telefone.value +=') '

    if(telefonelength === 10)
        telefone.value += '-'
})