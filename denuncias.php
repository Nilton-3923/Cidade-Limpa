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
<div class="body">
        <?php
            require_once("classe/Denuncia.php");
            require_once("classe/Conexao.php");

        ?>

        <div class="ajuste-div-principal">
        
            <div class="div-principal">
                <?php
                   if(!isset($_POST['pesquisar'])){
                        $denuncia = new Denuncia();
                        $listaDenuncia = $denuncia->mostrar();
                   }else{
                       $pesquisar = $_POST['pesquisar'];
                        $denuncia = new Denuncia();
                        $listaDenuncia = $denuncia->pesquisar($pesquisar);
                   }

                    foreach ($listaDenuncia as $linha){
                ?>
                
                    <div class="card">
                        <div class="trava-img">
                            <img class="img-denuncia" src="cadastro/<?php echo $linha['imgDenuncia']; ?>" alt=""><!--Imagem da Denuncia -->
                        </div>
                        <div class="div-card">
                            <div class="card-div-1">
                                <div class="titulo-data">
                                    <h5 class="titulo-denuncia"><?php echo $linha['tituloDenuncia'];?></h5><!--titulo da Denuncia -->
                                </div>
                                <div class="user-nome">
                                    <div class="correcao-user">
                                        <img class="user" src="cadastro/<?php echo $linha['imgUsuario']; ?>" alt=""><!--imagem do Usuario -->
                                    </div>
                                    <h5 class="nome"><?php echo $linha['nomeUsuario'];?></h5><!--nome do Usuario -->
                                    <p class="data"><?php echo $linha['dataDenuncia'];?></p><!--data da Denuncia -->
                                </div>
                            </div>
                            
                            
                            <h5 class="descricao"><br><?php echo $linha['descDenuncia'];?></h5><!--descrição da Denuncia -->
                            
                            
    
                            <!--<div class="body-card">
                                <div class="div-cep">
                                    <h5 class="">CEP: <?php echo $linha['cepDenuncia'];?></h5> 
                                </div>
                                <div class="divisao-card"></div>
                                <img class="icone"src="imagens/icone-agua.png">
                            </div>-->
                        </div>
                        
                    
                    </div>
                
                    
                <?php
                        }
                ?>
                
            </div>
            <div class="menu-lateral">
                <div class="div-pesquisar-mobile">
                    <form class="pesquisar-denuncia" action="" method="POST">
                        <input autocomplete="off" type="text" name="pesquisar" placeholder="Pesquisar denuncia">
                        <input class="style-da-lupa"type="submit" value="🔍">
                    </form>
                    <div id="btnFiltrar" class="btn-filtrar sumirNoPc">Filtrar</div>
                </div>
                <div id="menuLateralMobile"class="menu-lateral-mobile">
                    <h2 class="sumirNoMobile">Filtrar por:</h2>
                    <div class="links">
                        <h2>REGIÃO</h2>
                        <a href="#">Zona Leste</a>
                        <a href="#">Zona Norte</a>
                        <a href="#" >Zona Oeste</a>
                        <a href="#">Zona Sul</a>
                    </div>
                    <div class="-div-"></div>
                    <div class="links">
                        <h2>CATEGORIA</h2>
                        <a href="#">Todas</a>
                        <a href="#" id="meuElemento" onclick="funcao('<?php echo $categoria; ?>')">Descarte de lixo</a>
                        <a href="#">Foco de dengue</a>
                    </div>
                    <div class="-div-"></div>
                    <div class="links">
                        <h2>DATA</h2>
                        <a href="#">Mais recentes</a>
                        <a href="#">Mais antigas</a>
                    </div>
                </div>
            </div>
    </div>
</div>
        <script>

            document.getElementById('btnFiltrar').addEventListener('click',()=>{   
                document.getElementById('menuLateralMobile').classList.toggle('heightCemPorcento');          
            })

            function funcao(string) {
                alert(string)
            }
            document.getElementById("meuElemento").click();

            
            
            
        </script>
        <script>
        var home = document.getElementById('nav-links');
        var sobre = document.getElementById('nav-links1');
        var portalDeDenuncias = document.getElementById('nav-links2');

        portalDeDenuncias.classList.add('navLinkAtivado');

        document.getElementById('mobilelinks2').classList.add('navLinkAtivado')
        
    </script>
    <script>
        document.getElementById('navbarDeslogado').style.justifyContent="end"
    </script>
</body>
</html>