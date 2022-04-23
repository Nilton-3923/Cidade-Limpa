<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/denuncias.css">
    <title>Denuncias</title>
</head>
<style>
    .card{
        position: relative;
        border: 1px solid black;
        margin-right: 5px;
    }
    .user{
        border-radius:50px;
        width: 10px;
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
<?php include 'includes/navbar.php'?>
    <section style="width:100vw;height:100vh;" class="flex-center">

    <div>
        <h2>Filtrar por:</h2>


        <div>
            <h2>REGIÃO</h2>
            <ul>
                <li>Zona Leste</li>
                <li>Zona Norte</li>
                <li>Zona Oeste</li>
                <li>Zona Sul</li>
            </ul>
        </div>
        <div>
            <h2>CATEGORIA</h2>
            <ul>
                <li>Todas</li>
                <li>Descarte de lixo</li>
                <li>Foco de dengue</li>
            </ul>
        </div>
        <div>
            <h2>DATA</h2>
            <ul>
                <li>Mais recentes</li>
                <li>Mais antigas</li>
            </ul>
        </div>
    </div>

    <div>
        <form action="">
            <input type="text" placeholder="Pesquisar denuncia">
        </form>
    </div>

    
        <?php
            require_once("classe/Denuncia.php");
            require_once("classe/Conexao.php");

            $denuncia = new Denuncia();
            $listaDenuncia = $denuncia->mostrar();

            foreach ($listaDenuncia as $linha){
        ?>
            
        <div class="card" style="width: 18rem;">
            <div>

                <img class="user" src="cadastro/<?php echo $linha['imgUsuario']; ?>" alt="" style="width:50px"><!--imagem do Usuario -->
                
                <h5 class="nome"><?php echo $linha['nomeUsuario'];?></h5><!--nome do Usuario -->
            
            </div>
            <div class="body-card">
                <h5 class=""><?php echo $linha['tituloDenuncia'];?></h5><!--titulo da Denuncia -->
                
                <p class="data"><?php echo $linha['dataDenuncia'];?></p><!--data da Denuncia -->

                <h5 class=""><?php echo $linha['cepDenuncia'];?></h5><!--cep da Denuncia -->

                <h5 class=""><?php echo $linha['descDenuncia'];?></h5><!--descrição da Denuncia -->

                <img class="" src="cadastro/<?php echo $linha['imgDenuncia']; ?>" alt="" style="width:150px"><!--Imagem da Denuncia -->
                
           
            </div>
        </div>

            
    <?php
            }
    ?>
    </section>
</body>
</html>