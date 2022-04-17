<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Denuncia</title>
        
    </head>
    <body>

    <span id="mensagem" style="opacity:0;color:red;display:none">*Endereço invalido</span>
        <form action="../cadastro/objeto-cadastro-denuncia.php" method="post" enctype="multipart/form-data">

            
            <!--Titulo denuncia-->
            <input type="text" name="txtTituloDenuncia" placeholder="Titúlo"><br>

            <!--Categoria da denuncia-->
            <!--Aqui tem que ser um select-->
            <select name="categoria" id="categoria">
                <option disabled selected>Categoria da denuncia</option>
                <option value="Descarte de Lixo">Descarte de Lixo</option>
                <option value="Casos de Dengue">Casos de Dengue</option>
            </select><br>
           
            <!--Endereços-->
            <input type="text" id="cep" name="txtCepDenuncia" placeholder="CEP";><br>
            <!--API do cep já preenche automaticamente-->
            <input type="text" id="bairro" name="txtBairroDenuncia" placeholder="Bairro" disabled><br>
            <input type="text" id="rua" name="txtRuaDenuncia" placeholder="Rua" disabled><br>
            <input type="text" id="cidade" name="txtCidadeDenuncia" placeholder="Cidade" disabled><br>
            <input type="text" id="uf" name="txtUfDenuncia" placeholder="UF" disabled><br>
            <!--Número da casa-->
            <input type="text" id="numero" name="txtNumeroDenuncia" placeholder="Número"><br>
            
            <!--Região-->
            <select name="regiao" id="regiao">
                <option disabled selected>Regiões de São Paulo</option>
                <option value="Zona Leste">Zona Leste</option>
                <option value="Zona Norte">Zona Norte</option>
                <option value="Zona Sul">Zona Sul</option>
                <option value="Zona Oeste">Zona Oeste</option>
            </select><br>

            
            <!--Data denuncia-->
            <input type="hidden" id="data" name="txtDtDenuncia" 
            value="      
                <?php
                date_default_timezone_set('America/Sao_Paulo');
                echo date('d/m/Y');
                ?>
            ">
            <!--Descrição denuncia-->
            <!--Aqui tem que ser uma área para escrever-->
            <textarea name="txtDenuncia" id="denuncia" cols="25" rows="5" placeholder="Descrição"></textarea>
            <br>
            <!--Imagem denuncia-->
            <label>Selecione a Foto da Denuncia</label>
            <input type="file" name="fotoDenuncia"><br>

            <input type="submit" value="cadastrar">
        </form>
  
    </body>
    <script src="../javascript/api-cep.js"></script>
</html>