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
    <section style="width:100vw;height:100vh;" class="body flex-center">

    <div class="menu-lateral">
        <h2>Filtrar por:</h2>


        <div>
            <h2>REGIÃO</h2>
            <ul>
                <li><a class="opcao-filtro"href="">Zona Leste</a></li>
                <li><a class="opcao-filtro"href="">Zona Norte</a></li>
                <li><a class="opcao-filtro"href="">Zona Oeste</a></li>
                <li><a class="opcao-filtro"href="">Zona Sul</a></li>
            </ul>
        </div>
        <div>
            <h2>CATEGORIA</h2>
            <ul>
                <li><a class="opcao-filtro"href="">Todas</a></li>
                <li><a class="opcao-filtro"href="">Descarte de lixo</a></li>
                <li><a class="opcao-filtro"href="">Foco de dengue</a></li>
            </ul>
        </div>
        <div>
            <h2>DATA</h2>
            <ul>
                <li><a class="opcao-filtro"href="">Mais recentes</a></li>
                <li><a class="opcao-filtro"href="">Mais antigas</a></li>
            </ul>
        </div>
    </div>

    <div>
        <form class="pesquisar-denuncia" action="">
            <input type="text" placeholder="Pesquisar denuncia">
            <button>🔍</button>
        </form>
    </div>

    
        <?php
            require_once("classe/Denuncia.php");
            require_once("classe/Conexao.php");

            $denuncia = new Denuncia();
            $listaDenuncia = $denuncia->mostrar();

            foreach ($listaDenuncia as $linha){
        ?>
        <div class="denuncias">
            <div class="card">
                <div>
                    <img class="user" src="cadastro/<?php echo $linha['imgUsuario']; ?>" alt=""><!--imagem do Usuario -->
                    
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
        </div>

            
    <?php
            }
    ?>
    </section>
</body>
</html>