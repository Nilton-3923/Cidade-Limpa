<?php 



?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Ecoponto</title>
</head>
<body>
    <form action="../cadastro/objeto-cadastro-ecoponto.php" method="post">

        <input type="text" placeholder="CEP" id="cep" name="cep">
        <input type="text" placeholder="Bairro" id="bairro" name="bairro">
        <input type="text" placeholder="Rua" id="rua" name="rua">
        <input type="text" placeholder="Cidade" id="cidade" name="cidade">
        <input type="text" placeholder="Uf" id="uf" name="uf">
        <input type="text" placeholder="Número" name="numero">
        <select name="regiao" id="regiao">
            <option disabled selected>Regiões de São Paulo</option>
            <option value="Zona Leste">Zona Leste</option>
            <option value="Zona Norte">Zona Norte</option>
            <option value="Zona Sul">Zona Sul</option>
            <option value="Zona Oeste">Zona Oeste</option>
        </select><br>
        <input type="submit" value="Cadastrar">


    </form>

    <span id="mensagem"></span>
    <script src="../javascript/api-cep.js"></script>
</body>
</html>