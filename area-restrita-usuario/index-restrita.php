<?php
    session_start();
    include_once("../session/valida-sentinela.php");
    require_once("../classe/Conexao.php");
    require_once("../classe/Usuario.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <style>
    .card{
        position: relative;
        border: 1px solid black;
        margin-right: 5px;

    }
    .user{
        border-radius:50px;
        margin: 10px;
    }
    .nome{
        right: 140px;
        position: absolute;
        top: 0;
    }
    .data{
        position: absolute;
        right: 20px;
        top: 40px;
        font-size: 10px;
    }

    </style>
    <body>
        <?php 
        error_reporting(0);

        echo ("<h2> O Id do Úsuario é :" .$_SESSION['idUsuario']."</h2>");
        
        ?>
        <a href="../session/logout-usuario.php">Sair</a><br><a href="cadastro-denuncia.php">Denunciar</a><br>

        <?php
            $usuario = new Usuario();
            $listaDeDenuncias = $usuario->denunciasFeita();
            foreach($listaDeDenuncias as $linha){
        ?>
            <div class="card" style="width: 18rem;">
            <div>
                <img class="user" src="../cadastro/<?php echo $linha['imgUsuario'] ?>" alt="" style="width:50px"><!-- Foto do Usuario -->
                <h5 class="nome"><?php echo $linha['nomeUsuario'];?></h5><!--nome do Usuario -->
                <div class="body-card">
                    <h5 class=""><?php echo $linha['tituloDenuncia'];?></h5><!--titulo da Denuncia -->
                    
                    <p class="data"><?php echo $linha['dataDenuncia'];?></p><!--data da Denuncia -->

                    <h5 class=""><?php echo $linha['cepDenuncia'];?></h5><!--cep da Denuncia -->

                    <h5 class=""><?php echo $linha['descDenuncia'];?></h5><!--descrição da Denuncia -->

                    <img class="" src="../cadastro/<?php echo $linha['imgDenuncia']; ?>" alt="" style="width:150px"><!--Imagem da Denuncia -->
                    
                </div>
            </div>

            
        <?php
            }
        ?>
        

    </body>
</html>