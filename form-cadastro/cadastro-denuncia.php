<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Denuncia</title>
    </head>
    <body>
        <form action="../cadastro/cadastrarDenuncia.php" method="post" enctype="multipart/form-data">
            <input type="text" name="categoria" placeholder="Categoria da Denúncia..."><br>
            <input type="text" name="txtDenuncia" placeholder="Descrição da denúncia..."><br>
            <input type="text" name="txtTituloDenuncia" placeholder="Titúlo da denúncia..."><br>
            <input type="text" name="txtDtDenuncia" placeholder="Data da denúncia..."><br>
            <input type="text" name="txtCepDenuncia" placeholder="CEP da denúncia..."><br>
            <input type="text" name="txtUfDenuncia" placeholder="UF da denúncia..."><br>
            <input type="text" name="txtLogradouroDenuncia" placeholder="Lougradouro da denúncia..."><br>
            <input type="text" name="txtBairroDenuncia" placeholder="Bairro da denúncia..."><br>
            <label>Selcione a Foto da Denuncia</label>
            <input type="file" name="fotoDenuncia"><br>


            <input type="submit" value="cadastrar">

        </form>
    </body>
</html>