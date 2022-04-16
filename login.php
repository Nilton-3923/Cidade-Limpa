<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body class="flex-center">
    <?php include 'includes/navbar.php'?>
    <div class="conteudo">
        <div class="carroussel">
            <div id="img" class="container-carroussel">
                <img src="imagens/anuncio1.jpg" >
                <img src="imagens/anuncio2.jpg" >
                <img src="imagens/anuncio3.jpg" >
            </div>
              
        </div>
        <div class="login">
            <img class="logo-login" src="https://static.wixstatic.com/media/3cbee0_280ac02ce30f4cfba00d997e3c66b4a1~mv2.png/v1/fill/w_58,h_58,al_c,usm_0.66_1.00_0.01,enc_auto/3cbee0_280ac02ce30f4cfba00d997e3c66b4a1~mv2.png">
            <form class="form-login" action="">
                <h2>Login</h2>
                <div class="alinhamento-form">
                    <label for="login">Login</label>
                    <input autocomplete="off" id="login" type="text">
                    <label for="senha">Senha</label>
                    <input id="senha" type="password">
                    <input type="submit" value="Entrar">
                </div>
            </form>
            <div class="divisao-registrar">ou</div>
            <p>não tem uma conta? <a href="registrar.php">registre-se</a></p>
        </div>
    </div>
    <script src="javascript/login.js"></script>
</body>
</html>