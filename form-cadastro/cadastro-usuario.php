<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="../cadastro/cadastrarUsuario.php" enctype="multipart/form-data" method="post">
            <label>Digite seu nome:</label>
            <input type="text" name="txtNome"><br>
            <label>Sobrenome:</label>
            <input type="text" name="txtSobreNome"><br>
            <label>Digite seu Email:</label>
            <input type="text" name="txtEmail"><br>
            <label>Informe seu Cep:</label>
            <input type="text" name="txtCep"><br>
            <label>Digite sua senha:</label>
            <input type="text" name="txtSenha"><br>
            <label>Cadastre sua Foto:</label>
            <input type="file" name="fotoUsuario"><br>

            <label>Informe seu Telefone:</label>
            <input type="text" name="telefone"><br>

            <input type="submit">

        </form>
    </body>
</html>
