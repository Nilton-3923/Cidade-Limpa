<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/cadastro-usuario.css">
        <title>Document</title>
    </head>
    <body>
        <?php include '../includes/navbar.php' ?>
        <form class="cadastro" action="../cadastro/objeto-cadastro-usuario.php" enctype="multipart/form-data" method="post">
            <h1 class="titulo">Criar seu cadastro</h1>
            <div class="alinhamento-cadastro">
                <div class="div1">
                    <div class="alinhamento-inputs">
                        <label>nome</label>
                        <input type="text" name="txtNome">
                    </div>
                    <div class="espaco"></div>
                    <div class="alinhamento-foto">
                        <div class="alinhamento-preview">
                            <img id="preview" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" alt="">
                            <label for="foto">
                                <p class="envia-foto">Escolher Foto de perfil</p>
                            </label>
                        </div>
                        <input id="foto" type="file" name="fotoUsuario">
                    </div>
                </div>
                <div class="div2">
                    <div class="alinhamento-inputs">
                        <label>CEP</label>
                        <input type="text" name="txtCep" id="cep">
                    </div>
                    <div class="alinhamento-inputs">
                        <label>Telefone</label>
                        <input type="text" name="telefone">
                    </div>
                    <div class="alinhamento-inputs">
                        <label>Email</label>
                        <input type="text" name="txtEmail">
                    </div>
                </div>
    
                <div class="div3">
                    <div class="alinhamento-inputs">
                        <label>senha</label>
                        <input type="password" name="txtSenha">
                    </div>
                    <div class="alinhamento-inputs">
                        <label>Confirmar senha</label>
                        <input type="password" name="txtSenha">
                    </div>
                </div>
                <div class="ajuste-botao">
                    <input class="btn-cadastrar" value="cadastrar"type="submit">
                </div>
            </div>

            



        </form>
        <!--Mensagem de erro-->
        
        <div id="modal-cep" class="modal-cep">
            <p id="mensagem">Digite o cep</p>
            <label>Rua</label>
            <input type="text" id="rua" disabled>
    
            <label>Bairro</label>
            <input type="text" id="bairro" disabled>
    
            <label>Cidade</label>
            <input type="text" id="cidade" disabled>
            <input type="text" id="uf" disabled>
        </div>

    </body>
    <script src="../javascript/api-cep.js"></script>
    <script src="../javascript/registrar.js"></script>
</html>