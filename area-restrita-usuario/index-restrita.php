<?php
    error_reporting(0);
    session_start();
    include_once("../session/valida-sentinela.php");
    require_once("../classe/Conexao.php");
    require_once("../classe/Usuario.php");
    require_once("../classe/Denuncia.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/reset.css">
        <Link rel="stylesheet" href="../css/index-restrita.css">
        <title>Document</title>
    </head>
    <?php
        $perfil = new Usuario();
        $listaPerfil = $perfil->perfil();
        foreach($listaPerfil as $lista)
        {

    ?>
    <?php 
        } 
        ?>
    <body>
        <nav>
            <div class="navbar-parte-1">
                <img class="logo" src="https://static.wixstatic.com/media/3cbee0_280ac02ce30f4cfba00d997e3c66b4a1~mv2.png/v1/fill/w_58,h_58,al_c,usm_0.66_1.00_0.01,enc_auto/3cbee0_280ac02ce30f4cfba00d997e3c66b4a1~mv2.png">
            </div>
            
            <div class="navbar-logado">
                <div class="ajuste-div-foto">
                    <img class="foto-navbar ajuste-foto"src="../cadastro/<?php echo $lista['imgUsuario']; ?>">
                </div>
                <div id="seta" class="seta">
                    <div class="linha-seta-1"></div>
                    <div class="linha-seta-2"></div>
                </div>
                
            </nav>
            <div style="top:-170px;" id="navbarModal" class="navbar-modal">
                <a href="../session/logout-usuario.php">Sair</a>
                <p onClick="modalAlterarConta()"class="btn-alterar-conta">Alterar conta</p>
            </div>
            
            
            <div class="div-principal">
            <h1 class="titulo-pagina">Criar Denuncia</h1>
            <div class="ajuste-info-e-mapa">
                <div id="map"></div>
                <div class="info-denuncia">
                    <h2>O que é preciso para denunciar?</h2>
                    <div class="div-info">
                        <ul>
                            <li>Endereço do local</li>
                            <li>Foto da denuncia</li>
                            <li>Descrição sobre a situação do local</li>
                        </ul>
                        <a class="btn-denunciar"href="cadastro-denuncia.php">Clique aqui para Denunciar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="divisao-pagina"></div>

        <h2 class="segundo-titulo">DENUNCIAS FEITAS POR VOCÊ</h2>
        <?php
            $pontos = new Denuncia();
            $listaPontos = $pontos->mostrarPontosMapa();


            foreach($listaPontos as $lista){
                echo $lista['coordeDenuncia'];
            }

            $usuario = new Usuario();
            $listaDeDenuncias = $usuario->denunciasFeita();
            foreach($listaDeDenuncias as $linha){
        ?>
            <div class="denuncias">
                <div class="card">
                    <div class="card-part1">
                        <img class="foto-usuario" src="../cadastro/<?php echo $linha['imgUsuario'] ?>" alt="" ><!-- Foto do Usuario -->
                        <h5><?php echo $linha['nomeUsuario'];?></h5><!--nome do Usuario -->
                    </div>
                    <div class="conteudo-card">
                        <h5 class=""><?php echo $linha['tituloDenuncia'];?></h5><!--titulo da Denuncia -->
                        
                        <p class=""><?php echo $linha['dataDenuncia'];?></p><!--data da Denuncia -->
    
                        <h5 class=""><?php echo $linha['cepDenuncia'];?></h5><!--cep da Denuncia -->
    
                        <h5 class=""><?php echo $linha['descDenuncia'];?></h5><!--descrição da Denuncia -->
                        <div class="img-denuncia">
                            <img src="../cadastro/<?php echo $linha['imgDenuncia']; ?>" alt=""><!--Imagem da Denuncia -->
                        </div>
                        
                    </div>            
            </div>
        <?php
            }

            $usuario = new Usuario();
            $lista = $usuario->perfil();

            foreach($lista as $linha){
        ?>
            
            
           
            <div id="modalAlterarConta"class="ajuste-modal-alterar-conta">
                <div class="modal-alterar-conta">
                    <form action="../CRUD/objeto-alterar-usuario.php" method="get" enctype="multipart/form-data">
                        <input type="file" name="fotoUsuario">
                        <input type="hidden" name="pk_Usuario" value="<?php echo @$_GET['pk_Usuario'];?>" >
                        <input type="text" name="nomeUsuario" value="<?php echo @$_GET['nomeUsuario'];?>" ><!--NOME USUARIO -->
                        <input class="input-desabilitado" type="text" name="emailUsuario" disabled value="<?php echo @$_GET['emailUsuario'];?>" ><!--TELEFONE USUARIO -->
                        <input type="text" name="senhaUsuario" value="<?php echo @$_GET['senhaUsuario'];?>" ><!--SENHA USUARIO -->
                        <input type="text" name="numTelUsuario" value="<?php echo @$_GET['numTelUsuario'];?>" ><!--TELEFONE USUARIO -->
                        
                        <div class="btns-modal">
                            <a class="deletar-conta" href="../CRUD/objeto-deletar-usuario.php?pk_Usuario=<?php echo $_SESSION['idUsuario']; ?>">deletar conta </a><!--Deletar Usuario-->  
                            <a href="?pk_Usuario=<?php echo $_SESSION['idUsuario'] ?>&nomeUsuario=<?php echo $linha['nomeUsuario'] ?>&senhaUsuario=<?php echo $linha['senhaUsuario']?>&numTelUsuario=<?php echo $linha['numTelUsuario']?>&emailUsuario=<?php echo $linha['emailUsuario']?>">Alterar conta </a>
                        </div>
                        <p class="cancelar" onClick="modalAlterarConta()">Cancelar</p>
                        <input type="submit" value="Salvar">
                    </form>
                </div>
            </div>
            
        <?php } ?>

    </body>
    <script>
        function initMap(){
            // Opções para o mapa
            var options = {
                zoom: 12,
                center:{lat:-23.5489,lng:-46.6388},
                styles:[{
                            "featureType": "poi",
                            "stylers": [{
                                "visibility": "off"
                            }],
                            

                        }]
            }
            // New Map
            var map = new
            google.maps.Map(document.getElementById('map'),options);

            //ADCIONANDO MARCADORES POR MEIO DE ARRAY 
            //Array dos marcadores
            var markers = [
                <?php 
                foreach ($listaPontos as $lista){
                    $titulo = $lista['tituloDenuncia'];
                ?>
                        ,{
                            coords:{<?php echo $lista['coordeDenuncia'];?>},
                            iconImage: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
                            content:'<h2><?php echo $titulo; ?></h2>'          
                        },
                <?php
                }
                ?>
            ]

            // Laço de repetição para percorrer os marcadores
            for(var i = 0; i < markers.length; i++){
                // Add marcadores 
                addMarker(markers[i]);
            }

            // Add Marker Function
            function addMarker(props){
                var marker = new google.maps.Marker({
                        position:props.coords,
                        map: map,
                        icon:props.iconImage,
                        
                });

                //Checando se o marcador está customizado
                if(props.iconImage){
                    //Adicionando um icon
                    marker.setIcon(props.iconImage);
                }

                //Checando o content
                if(props.content){
                    var infoWindow = new google.maps.InfoWindow({
                    content:props.content
                });

                marker.addListener('click', function(){
                    infoWindow.open(map,marker);
                });
                }
            }
        }

    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5opbRMRKjMKTKajH2CdyKJCIsqOdwdUI&callback=initMap"
    ></script>    
    <script src="../javascript/index-restrita.js"></script>
</html>