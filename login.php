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
        <div class="anuncio">
            <h1>Torne o mundo um lugar melhor!</h1>
        </div>
        <div class="login">
            <h1>Cidade Limpa</h1>
            <form class="form-login" action="">
                <h2>Login</h2>
                <div class="alinhamento-form">
                    <label for="login">Login</label>
                    <input id="login" type="text">
                    <label for="senha">Senha</label>
                    <input id="senha" type="password">
                    <input type="submit" value="Entrar">
                </div>
            </form>
        </div>
    </div>
</body>
</html>