<?php
    session_start();
    error_reporting(0);
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
    #map{
        height:80vh;
        width: 70vw
    }

    </style>
    <body>
        <a href="../session/logout-usuario.php">Sair</a><br><a href="cadastro-denuncia.php">Denunciar</a><br>
        
        <div>
            <div id="map"></div>
        </div>



        <div>
            <h2>O que é ppreciso para denunciar?</h2>
            <ul>
                <li>Endereço do local</li>
                <li>Foto da denuncia</li>
                <li>Descrição sobre a situação do local</li>
            </ul>
            <a href="#">Clique aqui para denunciar</a>
        </div>


        <h2>DENUNCIAS FEITAS POR VOCÊ</h2>
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
                {
                    coords:{lat: -23.5648, lng:-46.6518},
                    iconImage: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
                    content:'<h1 style="color:green">Denuncia de descarte de lixo irregular</h1>'
                            +'<p>Av Paulista</p>'
                },
                {
                    coords: {lat: -23.5124, lng:-46.4108},
                    content:'<h1 style="color: blue">Denuncia de foco de dengue</h1>'
                            +'<p>Rua Carrossel</p>'
                },
                {
                    coords:{lat: -23.4929, lng:-46.4375},
                    content:'<h1 style="color: blue">Denuncia de foco de dengue</h1>'
                            +'<p>Av São Miguel Paulista</p>'
                }
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

</html>