<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/input-foto.css">
    <link rel="stylesheet" href="./css/novo-login.css">
    <link rel="stylesheet" href="./css/registrar.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <title>Login</title>
    <link rel="shortcut icon" href="imagens/reciclagem.png" type="image/x-icon">
</head>

<body>
    <div class="nav-bar-login">
        <h1><a class="voltar" href="./index.php"><img style="width:125px;"src="./imagens/logo.png" alt="VOLTAR"></a></h1>
    </div>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <!-- multistep form -->
            <form id="msform" action="cadastro/objeto-cadastro-usuario.php" method="POST" enctype="multipart/form-data">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active"></li>
                <li></li>
                <li></li>
            </ul>
           
           
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Registrar conta</h2>
                <h3 class="fs-subtitle">Primeiro passo</h3>
                <input type="text" name="txtEmail" placeholder="Email" />
                <input type="text" name="telefone" placeholder="Telefone" id="telefone" maxlength="15"/>

                <input type="text" name="txtNome" placeholder="Nome" />
                <input type="password" name="txtSenha"  placeholder="Senha" />
                <input type="password" name="cpass"  placeholder="Confirmar Senha" />
                <input type="button" name="next" class="next action-button" value="Próximo" />
            </fieldset>

            <fieldset class="aba">
                <h2 class="fs-title">Localização do Usuário</h2>
                <h3 class="fs-subtitle">Digite seu Cep, para localizar-mos</h3>
                <input type="text" name="txtCep" aria-describedby="inputGroupPrepend" required placeholder="CEP" id="cep" maxlength="9">
                <input type="text" name="rua"  placeholder="Rua"       id="rua"  disabled/>
                <input type="text" name="bairro" placeholder="Bairro" id="bairro" disabled/>
                <input type="text" name="cidade" placeholder="Cidade" id="cidade" disabled/>
                <input type="text" name="uf" placeholder="UF"         id="uf" disabled/>
            
                <input type="button" name="previous" class="previous action-button" value="Voltar" />
                <input type="button" name="next" class="next action-button" value="Próximo" />
              
            </fieldset>

            <fieldset>
                <h2 class="fs-title">Foto do Usuário</h2>
                <h3 class="fs-subtitle">Escolha sua foto de perfil</h3>
                
                <div class="form-input">
                    <div class="preview">
                        <img style="display:block;width:200px;height:200px;background:linear-gradient(#c4c4c4,#8a8a8a);" id="file-ip-1-preview">
                        <label for="file-ip-1">Escolher Imagem</label>
                        <input type="file" id="file-ip-1" accept="image/*" name="fotoUsuario" onchange="showPreview(event);"><!--COLOCAR O "NAME" DESSE INPUT PRA COMEÇAR A FUNCIONAR-->
                    </div>
                </div>
                <script src="./javascript/input-foto.js"></script>
                
                <input type="button" name="previous" class="previous action-button" value="Voltar" />
                <input type="submit" value="Cadastrar" class="action-button">
            </fieldset>
            

            </form>


        </div>
        <div class="form-container sign-in-container">
            <form action="session/session-usuario.php" method="post">
                <h1 style="margin-bottom:45px;">Login</h1>
            
                <input placeholder="Email" autocomplete="off" id="login" aria-describedby="inputGroupPrepend" required type="text" name="emailUsuario">
                <input placeholder="Senha" id="senhaLogin" aria-describedby="inputGroupPrepend" required type="password" name="senhaUsuario">
                <a href="#">Esqueceu sua senha?</a>
                <button>login</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Registre-se agora mesmo!</h1>
                    <p>E ajude a transformar são paulo em um lugar melhor!</p>
                    <button class="ghost" id="signIn">Login</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Bem vindo de volta!</h1>
                    <p>Faça o login para fazer uma denuncia.</p>
                    <button class="ghost" id="signUp">Registrar</button>
                </div>
            </div>
        </div>
        <p id="mensagem"></p>
    </div>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="./javascript/registrar.js"></script>
    <script src="./javascript/mascara.js"></script>
    <script src="./javascript/novo-login.js"></script>
    <script src="javascript/api-cep.js"></script>

    </body>
</html>