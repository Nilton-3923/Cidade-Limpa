<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="../cadastro/objeto-cadastro-usuario.php" enctype="multipart/form-data" method="post">
            <label>Digite seu nome:</label>
            <input type="text" name="txtNome"><br>

            <label>Digite seu Email:</label>
            <input type="text" name="txtEmail"><br>

            <label>Informe seu CEP:</label>
            <input type="text" name="txtCep" id="cep"><br>

            <label>Digite sua senha:</label>
            <input type="text" name="txtSenha"><br>
            
            <label>Cadastre sua Foto:</label>
            <input type="file" name="fotoUsuario"><br>

            <label>Informe seu Telefone:</label>
            <input type="text" name="telefone"><br>

            <input type="submit">

        </form>
        <!--Mensagem de erro-->
        <p id="mensagem">Digite o cep</p>


        <label>Rua</label>
        <input type="text" id="rua" disabled><br>

        <label>Bairro</label>
        <input type="text" id="bairro" disabled><br>

        <label>Cidade</label>
        <input type="text" id="cidade" disabled>
        <input type="text" id="uf" disabled>
    </body>
    <script src="../javascript/api-cep.js"></script>
</html>