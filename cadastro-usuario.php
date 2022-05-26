<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/cadastro-usuario.css">
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <title>Registrar</title>
    </head>
    <body>
        <?php include 'includes/navbar.php' ?>
        <form class="cadastro" action="cadastro/objeto-cadastro-usuario.php" enctype="multipart/form-data" method="post">
            <h1 class="titulo">Crie sua conta</h1>
            <div class="alinhamento-cadastro">
                <div class="ajuste-alinhamento-cadastro">
                    <div class="div1">
                        <div class="alinhamento-inputs">
                            <label>nome</label>
                            <input class="inputs-estilizados" autocomplete="off" aria-describedby="inputGroupPrepend" required type="text" name="txtNome">
                            <div class="alinhamento-inputs">
                                <label>Email</label>
                                <input class="inputs-estilizados" autocomplete="off" type="text"  aria-describedby="inputGroupPrepend" required name="txtEmail">
                            </div>
                            <div class="alinhamento-inputs">
                                <label>senha</label>
                                <input class="inputs-estilizados" id="senha" aria-describedby="inputGroupPrepend" required type="password" name="txtSenha">
                                <div id="mostrarSenha"class="mostrar-senha"></div>
                            </div>
                            <div class="alinhamento-inputs">
                                <label>Confirmar senha</label>
                                <input class="inputs-estilizados" id="Csenha"type="password" aria-describedby="inputGroupPrepend" required name="txtSenha">
                            </div>
                        </div>
                    </div>
                    <div class="div-central"></div>
                    <div class="div2">
                        
                            <div class="alinhamento-foto">
                                <div class="alinhamento-preview">
                                    <img id="preview" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" alt="">
                                    <label for="foto">
                                        <p class="envia-foto">Escolher Foto de perfil</p>
                                    </label>
                                </div>
                                <input id="foto" type="file"   name="fotoUsuario">
                            </div>
                            <div class="alinhamento-inputs">
                                <label>Telefone</label>
                                <input class="inputs-estilizados" autocomplete="off"  aria-describedby="inputGroupPrepend" required type="text" name="telefone">
                            </div>
                            <div class="alinhamento-cep">
                                <label>CEP</label>
                                <input class="inputs-estilizados" autocomplete="off" type="text" aria-describedby="inputGroupPrepend" required name="txtCep" id="cep">
                                
                                <div onmouseout="hoverOff()" onmouseover="hover()" class="seta-hover">
                                    <div class="barra1"></div>
                                    <div class="barra2"></div>
                                </div>
                            </div>
                            <div id="modalCep" class="modal-cep">
                                <div class="div-cep">
                                    <label for="rua">Rua</label>
                                    <input  type="text" id="rua" disabled>
                                </div>
                                <div class="div-cep">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" id="bairro" disabled>
                                </div>
                                <div class="div-cep">
                                    <label for="cidade">Cidade</label>
                                    <div class="ajuste-uf">
                                        <input type="text" id="cidade" disabled>
                                        <input type="text" id="uf" disabled>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                    
                </div>
                <div class="ajuste-botao">
                    <input class="btn-cadastrar" value="cadastrar"type="submit">
                </div>

            </div>

        </form>
        
        <p id="mensagem"></p>
        

    </body>
    <script src="javascript/api-cep.js"></script>
    <script src="javascript/registrar.js"></script>
</html>