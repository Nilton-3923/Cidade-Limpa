<?php
    session_start();
    error_reporting(0);
    require_once("classe/Conexao.php");
    require_once("classe/Denuncia.php");
    require_once("classe/Ecoponto.php");


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
    <?php include 'includes/navbar.php'?>
    <div class="bem-vindo">
        <img src="./imagens/logo.png">
        <h1>BEM-VINDO AO CIDADE LIMPA!</h1>
    </div>
    <div id="sobre" class="apresentacao-cidade-limpa">
        <img class="img-apresentacao" src="./imagens/img-apresentacao.png">
        <div class="txt-apresentacao">
            <span>
                <h1>O que é o Cidade Limpa?</h1>
                <p>é um projeto criado para facilitar a denuncia de descarte irregular de lixo nas ruas. se você encontrar lixo acumulado perto de sua casa, basta tirar uma foto e fazer uma denuncia no nosso site, a denuncia será enviada para o governo que irá cuidar da limpeza do local.</p>
            </span>
        </div>
    </div>
    <section class="index-primeira-parte">
        <div id="modalLegenda"class="modal-legenda">
            <div id="puxa"class="puxa-legenda">
                <div id="bl1"class="barralegenda1"></div>
                <div id="bl2"class="barralegenda2"></div>
            </div>
            <div class="legenda">
                <h1>Legenda</h1>
                <div style="background:#fff;" class="-div-"></div>
                <div class="div-legenda">
                    <img class="marcador"src="./imagens/marcador.png">
                    <p>- marcador padrão</p>
                </div>
                <div class="div-legenda">
                    <img class="marcador"src="./imagens/marcador.png">
                    <p>- marcador padrão</p>
                </div>
                <div class="div-legenda">
                    <img class="marcador"src="./imagens/marcador.png">
                    <p>- marcador padrão</p>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('puxa').addEventListener('click',()=>{
                document.getElementById('modalLegenda').classList.toggle("legendaPuxada");
                document.getElementById('bl1').classList.toggle("blAtivado");
                document.getElementById('bl2').classList.toggle("blAtivado");               
            })
        </script>
        <div class="map-nav">
            <div class="ajuste-pesquisa">
                <div class="pesquisa">
                    <input type="text" placeholder="Localizar Denuncias">
                    <button>🔍</button>
                </div>
            </div>
        </div>
        <!--Adicionando o maps-->
        <div id="map"></div>
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

                    if($categoria == 'Descarte Irregular de Lixo'){     
                        $cor = "#097005";
                    }
                    
                    else{
                        $cor ="blue";
                    }
                ?>
                        {
                            coords:{<?php echo $lista['coordeDenuncia'];?>},
                            //iconImage: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
                            content:'<h2 style="color:<?php echo $cor; ?>; display: inline; margin-right:20px"><?php echo $categoria; ?></h2>'
                                    +'<span style="color:black"><?php echo $data; ?></span>'
                                    +'<p style="color:black; margin-top:20px; margin-bottom:20px;"><?php echo $desc;?></p>'
                                    +'<img style="height:150px; width:300px; margin-left:12px;"src="cadastro/<?php echo $img;?>"></a>',     
                            iconImage: {
                                scale: 3,
                            }
                         },
                <?php
                }

                
                $ecoponto = new Ecoponto;
                $pontosEcoponto = $ecoponto->mostrarEcoponto();
                foreach ($pontosEcoponto as $row){
                    $bairro = $row['bairroEcoponto'];
                    $rua = $row['ruaEcoponto'];
                    $numero = $row['numeroEcoponto'];
                    $regiao = $row['zonaEcoponto'];
                ?>
                    {
                    coords:{<?php echo $row['coordeEcoponto'];?>},
                    content:'<h2 style="color: green">Ecoponto <?php echo $bairro; ?></h2>'
                            +'<h3><?php echo "$rua, $numero"; ?></h3>'
                            +'<h3 style="font-weight: normal"><?php echo $regiao; ?></h3>',
                    iconImage: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
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
        
    </script>
   
    <?php include 'includes/footer.php'?>
</body>
</html>