<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/novo-login.css">
    <link rel="stylesheet" href="./css/registrar.css">
    <link rel="stylesheet" href="./css/login.css">
    
    <title>Login</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <!-- multistep form -->
            <form id="msform" action="cadastro/objeto-cadastro-usuario.php" method="POST">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active">Account Setup</li>
                <li>Social Profiles</li>
                <li>Personal Details</li>
            </ul>
           
           
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Create your account</h2>
                <h3 class="fs-subtitle">This is step 1</h3>
                <input type="text" name="txtEmail" placeholder="Email" />
                <input type="text" name="telefone" placeholder="Telefone" />

                <input type="text" name="txtNome" placeholder="Nome" />
                <input type="password" name="txtSenha"  placeholder="Password" />
                <input type="password" name="cpass"  placeholder="Confirm Password" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>

            <fieldset class="aba">
                <h2 class="fs-title">Localização do Usuário</h2>
                <h3 class="fs-subtitle">Digite seu Cep, para localizar-mos</h3>
                <input type="text" name="txtCep" aria-describedby="inputGroupPrepend" required placeholder="CEP" id="cep">
                <input type="text" name="rua"  placeholder="Rua"       id="rua"  disabled/>
                <input type="text" name="bairro" placeholder="Bairro" id="bairro" disabled/>
                <input type="text" name="cidade" placeholder="Cidade" id="cidade" disabled/>
                <input type="text" name="uf" placeholder="UF"         id="uf" disabled/>
            
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
              
            </fieldset>

            <fieldset>
                <h2 class="fs-title">Foto do Usuário</h2>
                <h3 class="fs-subtitle">Escolha sua foto de perfil</h3>
                <div class="alinhamento-foto">
                    <div class="alinhamento-preview">
                        <img id="preview" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" alt="">
                            <label for="foto">
                                <p class="envia-foto">Escolher Foto de perfil</p>
                            </label>
                        </div>
                    <input id="foto" type="file"   name="fotoUsuario">
                </div>    
                
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="submit" value="Cadastrar" class="action-button">
            </fieldset>
            

            </form>


        </div>
        <div class="form-container sign-in-container">
            <form action="#">
                <h1>Login</h1>
                
                <span>Ou entre com sua conta</span>
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Password" />
                <a href="#">Esqueceu sua senha?</a>
                <button>login</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bem vindo de volta!</h1>
                    <p>Ajude a transformar são paulo em um lugar melhor!</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
        <p id="mensagem"></p>
    </div>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="./javascript/registrar.js"></script>
    <script src="./javascript/novo-login.js"></script>
    <script src="javascript/api-cep.js"></script>
    <script src="./javascript/login.js"></script>

    </body>
</html>