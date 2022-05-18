<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body class="flex-center">
    <?php include 'includes/navbar.php'?>
    <div class="conteudo">
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
        <div class="login">
            <img class="logo-login" src="./imagens/logo.png">
            <form class="form-login" action="session/session-usuario.php" method="post">
                <div class="alinhamento-form">
                    <label for="login"><p class="label">Login</p></label>
                    <input autocomplete="off" id="login" aria-describedby="inputGroupPrepend" required type="text" name="emailUsuario">
                    <label for="senha"><p class="label">Senha</p></label>
                    <input id="senha" aria-describedby="inputGroupPrepend" required type="password" name="senhaUsuario">
                    <input type="submit" value="Entrar">
                </div>
            </form>
            <div class="divisao-registrar">ou</div>
            <p class="pergunta">não tem uma conta? <a href="cadastro-usuario.php">registre-se</a></p>
        </div>
    </div>
    <script src="javascript/login.js"></script>
</body>
</html>