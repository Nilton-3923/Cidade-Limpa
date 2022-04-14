<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Denuncia</title>
        
    </head>
    <body>
        <form action="../cadastro/objeto-cadastro-denuncia.php" method="post" enctype="multipart/form-data">

            
            <!--Titulo denuncia-->
            <input type="text" name="txtTituloDenuncia" placeholder="Titúlo"><br>

            <!--Categoria da denuncia-->
            <!--Aqui tem que ser um select-->
            <select name="categoria" id="">
                <option value="Descarte de Lixo">Descarte de Lixo</option>
                <option value="Caso de Dengue">Casos de Dengue</option>
            </select><br>
           

            <!--Endereços-->
            <input type="text" id="cep" name="txtCepDenuncia" placeholder="CEP" onblur="pesquisacep(value)";><br>
            <input type="text" id="bairro" name="txtBairroDenuncia" placeholder="Bairro"><br>
            <input type="text" id="uf" name="txtUfDenuncia" placeholder="UF"><br>
            <input type="text" id="logradouro" name="txtLogradouroDenuncia" placeholder="Lougradouro"><br>
            
            <!--Data denuncia-->
            <input type="text" id="" name="txtDtDenuncia" placeholder="Data"><br>
            <!--Descrição denuncia-->
            <!--Aqui tem que ser uma área para escrever-->
            <input type="text" name="txtDenuncia" placeholder="Descrição"><br>

            <!--Imagem denuncia-->
            <label>Selcione a Foto da Denuncia</label>
            <input type="file" name="fotoDenuncia"><br>

            <input type="submit" value="cadastrar">
        </form>
    </body>
    <script src="javascript/api-cep.js"></script>
</html>