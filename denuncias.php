<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/denuncias.css">
    <title>Denuncias</title>
</head>
<body>
<?php include 'includes/navbar.php'?>
<section class="body">
        <div class="menu-lateral">
            <h2>Filtrar por:</h2>


            <div class="links">
                <h2>REGIÃO</h2>
                <a href="#">Zona Leste</a>
                <a href="#">Zona Norte</a>
                <a href="#">Zona Oeste</a>
                <a href="#">Zona Sul</a>
            </div>
            <div class="-div-"></div>
            <div class="links">
                <h2>CATEGORIA</h2>
                <a href="#">Todas</a>
                <a href="#">Descarte de lixo</a>
                <a href="#">Foco de dengue</a>
            </div>
            <div class="-div-"></div>
            <div class="links">
                <h2>DATA</h2>
                <a href="#">Mais recentes</a>
                <a href="#">Mais antigas</a>
            </div>
        </div>


        <div class="ajuste-div-principal">
                <form class="pesquisar-denuncia" action="">
                    <input type="text" placeholder="Pesquisar denuncia">
                    <button>🔍</button>
                </form>
            <div class="div-principal">
                <?php
                    require_once("classe/Denuncia.php");
                    require_once("classe/Conexao.php");
                    
                    $denuncia = new Denuncia();
                    $listaDenuncia = $denuncia->mostrarDenuncia();
    
                    foreach ($listaDenuncia as $linha){
                ?>
                
                    <div class="card">
                        <div class="card-section">
                            <img class="user" src="cadastro/<?php echo $linha['imgUsuario']; ?>" alt=""><!--imagem do Usuario -->
                            
                            <h5 class="nome"><?php echo $linha['nomeUsuario'];?></h5><!--nome do Usuario -->
                        </div>
                        <div class="body-card">
                            <div class="info-section">
                                <h5 class=""><?php echo $linha['tituloDenuncia'];?></h5><!--titulo da Denuncia -->
                                <p class="data"><?php echo $linha['dataDenuncia'];?></p><!--data da Denuncia -->
                            </div>
                            <div class="div-cep">
                                <h5 class="">CEP: <?php echo $linha['cepDenuncia'];?></h5><!--cep da Denuncia -->
                            </div>
                            <div class="desc-e-img">
                                <h5 class="">Descrição:<br><?php echo $linha['descDenuncia'];?></h5><!--descrição da Denuncia -->
                                <img class="" src="cadastro/<?php echo $linha['imgDenuncia']; ?>" alt=""><!--Imagem da Denuncia -->
                            </div>
                            <div class="divisao-card"></div>
                            <img class="icone"src="imagens/icone-agua.png">
                        </div>
                    </div>
                
                    
                <?php
                        }
                ?>
        </div>
    </div>
    </section>
</body>
</html>