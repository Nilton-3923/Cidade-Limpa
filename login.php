<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/reset.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body class="flex-center">
    <div class="conteudo flex-center">
        <div class="carroussel">
            <div class="container-carroussel">
                <div id="img3" class="flex-center img-carroussel">
                    <img src="imagens/anuncio3.png" >
                    <div class="flex-center frase-carroussel">
                        <h1>descarte o lixo no lugar correto</h1>
                    </div>
                </div>
                <div id="img2" class="flex-center img-carroussel">
                    <img src="imagens/anuncio2.jpg" >
                    <div class="flex-center frase-carroussel">
                        <h1>preservando o meio ambiente em que vivemos</h1>
                    </div>
                </div>
                <div id="img1" class="flex-center img-carroussel">
                    <img src="imagens/anuncio1.jpg" >
                    <div class="flex-center frase-carroussel">
                        <h1>Ajude-nos a tornar são paulo em um lugar melhor</h1>
                    </div>
                </div>
            </div>
              
        </div>
        <div class="login"><!-- <<<--- DIV GRANDE QUE CONTEM LOGIN E CADASTRO -->

            <div class="navbar-loginCadastro">
                <div id="btnEscolherLogin" onClick="trocarRegistroParaLogin();" class="btn-escolher-alterar escolhido">
                    <p>Login</p>
                </div>
                
                <div id="btnEscolherRegistro" onClick="trocarLoginParaRegistro();" class="btn-escolher-alterar">
                    <p>Cadastro</p>
                </div>
            </div>
            <div class="login-e-cadastro">
                <div id="movimentacaoLoginEcadastro"class="movimentacao-login-e-cadastro" style="transform:translateX(0px);">
                    <div id="divLogin" class="div-login">
                        <img class="logo-login" src="./imagens/logo.png">
                        <form class="form-login" action="session/session-usuario.php" method="post">
                            <div class="alinhamento-form">
                                <label for="login"><p class="label">Login</p></label>
                                <input class="inputs-estilizados"autocomplete="off" id="login" aria-describedby="inputGroupPrepend" required type="text" name="emailUsuario">
                                <div class="alinhamento-inputs">
                                    <label for="senha"><p class="label">Senha</p></label>
                                    <input class="inputs-estilizados" id="senhaLogin" aria-describedby="inputGroupPrepend" required type="password" name="senhaUsuario">
                                    <div  onclick="mostrarSenha()" id="mostrarSenhaLogin"class="mostrar-senha-login"></div>
                                </div>
                                <div class="ajuste-btn-login">
                                    <input class="btn-login"type="submit" value="Entrar">
                                </div>
                            </div>
                        </form>     
                    </div>
        
        
        
                    <!----------------------------------------------------------------------------------------------------->
                    <div class="div-d-separamento-200px"></div>
        
        
                    <div id="divRegistrar" class="alinhamento-cadastro">
                        
                        <form class="cadastro" action="cadastro/objeto-cadastro-usuario.php" enctype="multipart/form-data" method="post">
                        <div class="ajuste-alinhamento-cadastro">
                            <div class="div1">
                                <div class="alinhamento-inputs">
                                    <label class="ajuste-cor-fonte">nome</label>
                                    <input class="inputs-estilizados-cadastro" autocomplete="off" aria-describedby="inputGroupPrepend" required type="text" name="txtNome">
                                    <div class="alinhamento-inputs">
                                        <label class="ajuste-cor-fonte">Email</label>
                                        <input class="inputs-estilizados-cadastro" autocomplete="off" type="text"  aria-describedby="inputGroupPrepend" required name="txtEmail">
                                    </div>
                                    <div class="alinhamento-inputs">
                                        <label class="ajuste-cor-fonte">senha</label>
                                        <input class="inputs-estilizados-cadastro" id="senha" aria-describedby="inputGroupPrepend" required type="password" name="txtSenha">
                                        <div  onclick="mostrarSenha()" id="mostrarSenhaCadastro"class="mostrar-senha-cadastro"></div>
                                    </div>
                                    <div class="alinhamento-inputs">
                                        <label class="ajuste-cor-fonte">Confirmar senha</label>
                                        <input class="inputs-estilizados-cadastro" id="Csenha"type="password" aria-describedby="inputGroupPrepend" required name="txtSenha">
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
                                        <label class="ajuste-cor-fonte">Telefone</label>
                                        <input class="inputs-estilizados-cadastro" autocomplete="off"  aria-describedby="inputGroupPrepend" required type="text" name="telefone">
                                    </div>
                                    <div class="alinhamento-cep">
                                        <label class="ajuste-cor-fonte">CEP</label>
                                        <input class="inputs-estilizados-cadastro" autocomplete="off" type="text" aria-describedby="inputGroupPrepend" required name="txtCep" id="cep">
                                        
                                        <div onmouseout="hoverOff()" onmouseover="hover()" class="seta-hover">
                                            <div class="barra1"></div>
                                            <div class="barra2"></div>
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
                                    <div class="ajuste-botao">
                                        <input class="btn-cadastrar" value="cadastrar" type="submit">
                                    </div>
                            </div>
                            
                        </div>
                        
                    </div>
        
                    </form>
                </div>

                </div>
        
        <p id="mensagem"></p>
        </div>
    </div>
    <script src="javascript/api-cep.js"></script>
    <script src="javascript/login.js"></script>
</body>
</html>