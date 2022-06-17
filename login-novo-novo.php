<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/registrar.css">
    <link rel="stylesheet" href="./css/input-foto.css">

    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
    />
    <!-- MDB -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css"
        rel="stylesheet"
    />
    <title>login</title>
</head>
<!-------------------------MACAQUISSE PRA AJUSTES PEQUENOS------------------------------->
<style>
    body{
        display:flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width:100vw;
        height:100vh;
        background-color: #c4c4c4;
    }
    .login-responsivo{
        background-color: #fff;
        width:600px;
        height:800px;
        
        
    
    }
    .centraliza-div{
        display:flex;
        align-items: center;
        justify-content:center;
        width:100%;
        height:100%;
        padding-bottom: 100px;
        overflow: hidden;
    }
    .nav-pills{
        margin-left: 0;
    }
    .ajuste-form-cadastro{
        display:flex;
        justify-content:center;
        flex-direction: column;
        width:80%;
    }
    .display-flex-do-luquinhas{
        display:flex;
        align-items:center;
        justify-content:center;
        flex-direction: column;
    }
    .section-cep-do-luquinhas{
        display:flex;
        flex-direction: row;
        position:relative;
    }
    .modal-cep-do-luquinhas{
        transition:opacity .35s;
        display:none;/*muda no click do cep*/
        opacity:0;/*muda no click do cep*/

        width:100%;
        background-color: rgba(0,0,0,0.4);
        flex-direction:column;
        position:absolute;
        top:37px;
    }
    .ajuste-preview{
        display:flex;
        flex-direction: column;
        align-items:center;
        justify-content:center;
        gap:10px;
        
    }
    .ajuste-img-preview{
        --tamanho-da-foto:150px;
        margin-bottom:0!important;
        width:var(--tamanho-da-foto)!important;
        height:var(--tamanho-da-foto)!important;
        border-radius:50%!important;
    }
    .nav-bar-login{
	width:100%;
	height:65px;
    background:rgb(77, 104, 112);
    display:flex;
	justify-content: start;
    padding-left:25px;
    }
    .voltar{
        transition:color .3s;
        color:#fff;
    }
    .voltar:hover{
        color:rgb(129, 218, 253);
    }
    .nav-pills .nav-link.active,.btn-primary{
        background-color:#27AE60;
    }
    .btn-primary{
        border-radius:20px;
    }
    .ajuste-div-login{
        display:flex;
        justify-content:center;
        align-items:center;
        background:red;
    }
@media(max-width:720px){
    .login-responsivo{
        height:100%;
        width: 100%;
    }
}
</style>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
<body>
    <div class="nav-bar-login">
        <h1><a class="voltar" href="./index.php"><img style="width:125px;"src="./imagens/logo.png" alt="VOLTAR"></a></h1>
    </div>
    <div class="login-responsivo">
            <!-- Pills navs -->
        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
            aria-controls="pills-login" aria-selected="true">Login</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
            aria-controls="pills-register" aria-selected="false">Registrar</a>
        </li>
        </ul>
        <!-- Pills navs -->
        
        <!-- Pills content -->
        <div class="tab-content centraliza-div">
        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form action="session/session-usuario.php" method="post">
            <h1 style="position:relative;top:-50px;"class="text-center">LOGIN</h1>
        
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="text" id="loginName" class="form-control" />
                <label class="form-label" for="loginName">Email</label>
            </div>
        
            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="loginPassword" class="form-control" />
                <label class="form-label" for="loginPassword">Senha</label>
            </div>
        
            <!-- 2 column grid layout -->
            <div class="row mb-4">
                <div class="col-md-6 d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="ajuste-div-login">
                        <div class="form-check mb-3 mb-md-0">
                            <input class="form-check-input" type="checkbox" value="" id="loginCheck"/>
                            <label class="form-check-label" for="loginCheck">Mostrar senha </label>
                        </div>
                        </div>
                    </div>
                
                    <!-- Submit button -->
                    <button style="width:max-content;" type="submit" class="btn btn-primary btn-block mb-4">Entrar</button>
                </div>
        
            <!-- Register buttons -->
            </form>
        </div>
        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
             <!---------------------------------REGISTRAR------------------------------------------->
            <div style="margin-top:125px;" class="centraliza-div">
                <form class="display-flex-do-luquinhas" action="cadastro/objeto-cadastro-usuario.php" method="post">
                    <h1 style="margin-bottom:15px;"class="text-center">REGISTRAR</h1>
                    <div class="form-input">
                        <div class="preview ajuste-preview">
                            <img style="display:block;"src="./imagens/foto-de-perfil-vazia.jpg" class="ajuste-img-preview" id="file-ip-1-preview">
                            <label for="file-ip-1">Escolher Imagem</label>
                            <!---  ATENÇÃOOOOOOOOOOOOOOOOOOO BACK END FILHO DA PUTA ARRUMA ISSO AQUI CARALHO  ------------->
                            <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);" name="fotoUsuario"><!--COLOCAR O "NAME" DESSE INPUT PRA COMEÇAR A FUNCIONAR-->
                        </div>
                    </div>
                    <div class="ajuste-form-cadastro">
                        <div class="form-outline mb-4">
                            <input type="text" name="txtEmail"id="email" class="form-control" />
                            <label class="form-label" for="email">Endereço de Email</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="text" name="telefone" id="telefone" class="form-control" maxlength="15"/>
                            <label class="form-label" for="Telefone">Telefone</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="text" name="txtNome" id="nome" class="form-control"/>
                            <label class="form-label" for="nome">Nome</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="password" name="txtSenha" id="senha" class="form-control"/>
                            <label class="form-label" for="senha">Senha</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="password" name="cpass" id="csenha" class="form-control"/>
                            <label class="form-label" for="csenha">Confirmar Senha</label>
                        </div>
                        <section class="form-outline mb-4">
                            <div class="form-outline mb-4">
                                <input type="text" name="txtCep" aria-describedby="inputGroupPrepend" required id="cep" class="form-control" maxlength="9">
                                <label class="form-label" for="cep">CEP</label>
                            </div>
                            <div id="modalCepDoLuquinhas"class="modal-cep-do-luquinhas">
                                <input type="text" name="rua"  placeholder="Rua"       id="rua"  disabled/>
                                <input type="text" name="bairro" placeholder="Bairro" id="bairro" disabled/>
                                <input type="text" name="cidade" placeholder="Cidade" id="cidade" disabled/>
                                <input type="text" name="uf" placeholder="UF"         id="uf" disabled/>
                            </div>
                        </section>
                    </div>
                    <script>
                        document.getElementById('cep').addEventListener("click",()=>{
                            const segundos = 4000; //TEMPO PARA A MODAL FECHAR DENOVO
                            document.getElementById('modalCepDoLuquinhas').style.display="flex";
                            setTimeout(()=>{
                                document.getElementById('modalCepDoLuquinhas').style.opacity="1";
                            },350)

                            setTimeout(()=>{
                                document.getElementById('modalCepDoLuquinhas').style.opacity="0";
                                setTimeout(()=>{
                                    document.getElementById('modalCepDoLuquinhas').style.display="none";
                                },350)
                            },segundos)
                        })
                    </script>

                    <input style="width:max-content;"class="btn btn-primary btn-block mb-4" type="submit" value="Cadastrar">
                </form>
            </div>
        </div>
        </div>
        <p id="mensagem"></p>
        <!-- Pills content -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="./javascript/mascara.js"></script>
    <script src="./javascript/input-foto.js"></script>
    <script src="./javascript/registrar.js"></script>
    <script src="./javascript/api-cep.js"></script>
    <!-- MDB -->
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"
    ></script>
</body>
</html>