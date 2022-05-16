<?php
    session_start();
    error_reporting(0);
    require_once("classe/Conexao.php");
    require_once("classe/Denuncia.php");
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Cidade Limpa</title>
</head>
<body>
    <?php include 'includes/navbar.php'?>

    <section class="index-primeira-parte">
        <!--Adicionando o maps-->
        <div class="pesquisa">
            <input type="text" placeholder="Localizar Denuncias" name id="">
            <button>🔍</button>
        </div>
        <div id="map"></div>
    </section>

    <section id="sobre" class="index-segunda-parte">
        <h1>Sobre Nós</h1>
        <p>Somos  a Cidade Limpa, Somos uma plataforma dedicada á denúncias de meio ambiente humanitário .</p>    
    </section>

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

                $pontos = new Denuncia();
                $listaPontos = $pontos->mostrarPontosMapa();

                foreach ($listaPontos as $lista){

                    $idDenuncia = $lista['pk_idDenuncia'];

                    $titulo = $lista['tituloDenuncia'];
                    $data = $lista['dataDenuncia'];
                    $desc = $lista['descDenuncia'];
                    $categoria = $lista['campoCategoria'];
                    $img = $lista['imgDenuncia'];
                    $coordenadas= $lista['coordeDenuncia'];

                    if($categoria == 'Descarte de lixo'){     
                        $cor = "#097005";
                    }
                    
                    else{
                        $cor ="blue";
                    }
                ?>
                        {
                            coords:{<?php echo $lista['coordeDenuncia'];?>},
                            //iconImage: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
                            content:'<a style="text-decoration:none"href="index-restrita.php?idDenuncia=<?php echo $idDenuncia;?>&&coordenadas=<?php echo $coordenadas ;?>">'
                                    +'<h2 style="color:<?php echo $cor; ?>"><?php echo $titulo; ?></h2>'
                                    +'<span style="color:black"><?php echo $data;?></span>'
                                    +'<p style="color:black"><?php echo $desc;?></p>'
                                    +'<img style="height:150px; width:300px;"src="cadastro/<?php echo $img;?>"></a>'
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

</body>
</html>