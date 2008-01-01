<?php

    require_once("classe/Conexao.php");
    require_once("classe/Denuncia.php");

    $idDenuncia =  $_GET['idDenuncia'];
    
    $denuncia = new Denuncia();
    $denunciaSelecionada = $denuncia->denunciaSelecionada($idDenuncia);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .denuncia{
        display: flex;
        flex-direction: column;
        justify-items: center;
        border: solid 1px red;
        padding: 20px;
        width: 350px;
        margin: auto;
        
    }
    .imgDenuncia{
        width: 300px;
        height: 200px;
        margin-left: 20px
    }
    #linhaTitulo{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .tituloDenuncia{
        display: inline;
        margin: 0;
    }
</style>
<body>
    

    <?php
    foreach($denunciaSelecionada as $row){
    ?>
            <div class="denuncia">
                <div id="linhaTitulo">
                    <h2 class="tituloDenuncia"><?php echo $row['tituloDenuncia']; ?></h2>
                    <span><?php echo $row ['dataDenuncia']?></span>
                </div>
                <p><?php echo $row['descDenuncia']?></p>
                <div id="endereco">
                    <p>CEP: <?php echo $row['cepDenuncia']?></p>
                    <p>Rua: <?php echo $row['ruaDenuncia']?></p>
                    <p>Bairro: <?php echo $row['bairroDenuncia']?></p>
                </div>
                <img 
                    class="imgDenuncia" 
                    src="cadastro/<?php echo $row['imgDenuncia'];?>"
                >
            </div>

    <?php
    }
    ?>
 

</body>
</html>