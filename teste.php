<?php
    session_start();
    require_once("classe/Conexao.php");
    require_once("classe/Denuncia.php");
    require_once("classe/Ecoponto.php");

    #TUDO QUE TIVER HASHTAG TEM QUE ADICIONAR NA INDEX

    #
    //Verificando se a SESSION está vazia, então ele pré determina um valor 
    if(empty($_SESSION['coordenada'])){
        echo $coordenada = "lat:-23.5489,lng:-46.6388";   
    }
    //Se a SESSION não estiver vazia ele dá os valores da pesquisa 
    else {
        $coordenada = $_SESSION['coordenada'];
    }
    #

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Cidade Limpa</title>
    <link rel="shortcut icon" href="imagens/reciclagem.png" type="image/x-icon">
</head>
<body>

    <section class="index-primeira-parte">
        <!--#### Pesquisar localização-->
        <form action="objetos/objeto-pesquisar-mapa.php" method="POST">
            <input type="text" name="pesquisa">
            <input type="submit" value="Pesquisar">
        </form>

        <!--Adicionando o maps-->
        <div id="map"></div>
    </section>



    <script>
        function initMap(){
            // Opções para o mapa ###################
            var options = {
                zoom: 16,
                center:{<?php echo $coordenada; ?>},
                styles:[{
                            "featureType": "poi",
                            "stylers": [{
                                "visibility": "off"
                            }],
                            

                        }]
            }//######
            // New Map
            var map = new
            google.maps.Map(document.getElementById('map'),options);

            //ADCIONANDO MARCADORES POR MEIO DE ARRAY 
            //Array dos marcadores

            var markers = [
              
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
                        icon:props.iconImage
                        
                        
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
    <script>
        var home = document.getElementById('nav-links');
        var sobre = document.getElementById('nav-links1');
        var portalDeDenuncias = document.getElementById('nav-links2');

        home.classList.add('navLinkAtivado');

        document.getElementById('mobilelinks').classList.add('navLinkAtivado')
        
        document.getElementById('pesquisa').style.display="flex"
    </script>
   
</body>
</html>