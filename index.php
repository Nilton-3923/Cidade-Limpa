<?php
    session_start();
    error_reporting(0);
    require_once("classe/Conexao.php");
    require_once("classe/Denuncia.php");
    require_once("classe/Ecoponto.php");

    //Verificando se a SESSION está vazia, então ele pré determina um valor 
    if(empty($_SESSION['coordenada'])){
        $coordenada = "lat:-23.5489,lng:-46.6388";   
        $zoom = 12;
    }
    //Se a SESSION não estiver vazia ele dá os valores da pesquisa 
    else {
        $coordenada = $_SESSION['coordenada'];
        $zoom = 18;
    }

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/reset.css">

    <title>Cidade Limpa</title>
    <link rel="shortcut icon" href="imagens/reciclagem.png" type="image/x-icon">
</head>
<body>
    <?php include 'includes/navbar.php'?>
    <div id="home"class="bem-vindo">
        <img id="imgBemVindo"src="./imagens/logo.png">
        <h1 id="h1">BEM-VINDO AO CIDADE LIMPA!</h1>
    </div>
    <script>
        window.addEventListener('scroll',()=>{
            document.getElementById('imgBemVindo').style.transform="translateY(-"+ window.scrollY * 0.5 +"px)";
            document.getElementById('h1').style.transform="translateY(-"+ window.scrollY * 0.5 +"px)";

            document.getElementById('imgBemVindo').style.opacity= 1 - window.scrollY * 0.002;
            document.getElementById('h1').style.opacity= 1 - window.scrollY * 0.002;    
        })
    </script>
    <div id="sobre" class="apresentacao-cidade-limpa">
        <img class="img-apresentacao scrollFade" src="./imagens/img-apresentacao.png">
        <div class="txt-apresentacao scrollFade2">
            <span>
                <h1>O que é o Cidade Limpa?</h1>
                <p>Cidade Limpa é um projeto criado para auxiliar na busca de ecopontos e ampliar as formas de denúnciar descarte irregular de lixo.</p>
                <p>Se você encontrar lixo acumulado perto de sua casa, basta tirar uma foto e fazer sua denuncia em nossa plataforma site.</p>
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
                    <img class="marcador"src="https://www.comdominioadm.com.br/wp-content/uploads/2015/10/marcador-mapa2.png">
                    <p>- Marcador denúncias</p>
                </div>
                <div class="div-legenda">
                    <img id="marcador-bandeira" class="marcador"src="https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png">
                    <p>- Marcador ecopontos</p>
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
        <div id="navbar-do-mapa"class="map-nav">
            <img class="logo" src="./imagens/logo.png">
            <h1 style="color:white;margin-left:25px;">DIGITE O NOME DE UMA RUA DE SÃO PAULO PARA LOCALIZAR AS DENUNCIAS</h1>
            <div class="ajuste-pesquisa">
                <form action="./objetos/objeto-pesquisar-mapa.php?localizacao=index" method="post">
                    <div class="pesquisa">
                        <input type="text" name="pesquisa" placeholder="Localizar Denuncias">
                        <button type="submit">🔍</button>
                    </div>
                </form>
            </div>
        </div>
        <!--Adicionando o maps-->
        <div id="map"></div>
        <script>
            const options = {
                root:null,
                threshold:1,
                rootMargin:'0px',
            };
            const observerHome = new IntersectionObserver(function(entries,observer){
                entries.forEach(entry =>{
                    if(entry.isIntersecting){
                        document.getElementById('nav-links').classList.add('navLinkAtivado');
                        document.getElementById('nav-links1').classList.remove('navLinkAtivado');
                        document.getElementById('nav-links2').classList.remove('navLinkAtivado');
                        document.getElementById('navbar-do-mapa').classList.remove('aparece-map-nav');
                    }
                });
            },options)
            const observerSobre = new IntersectionObserver(function(entries,observer){
                entries.forEach(entry =>{
                    if(entry.isIntersecting){
                        document.getElementById('nav-links').classList.remove('navLinkAtivado');
                        document.getElementById('nav-links1').classList.add('navLinkAtivado');
                        document.getElementById('nav-links2').classList.remove('navLinkAtivado');
                        document.getElementById('navbar-do-mapa').classList.remove('aparece-map-nav');
                    }
                });
            },options)
            const observerMap = new IntersectionObserver(function(entries,observer){
                entries.forEach(entry =>{
                    if(entry.isIntersecting){
                        document.getElementById('nav-links').classList.remove('navLinkAtivado');
                        document.getElementById('nav-links1').classList.remove('navLinkAtivado');
                        document.getElementById('nav-links2').classList.add('navLinkAtivado');
                        document.getElementById('navbar-do-mapa').classList.add('aparece-map-nav');
                    }
                });
            },options)

            observerHome.observe(document.querySelector('#home'));
            observerSobre.observe(document.querySelector('#sobre'));
            observerMap.observe(document.querySelector('#map'));
        </script>
        <script>
            // EFEITINHO DO SCROLL PEGUEI DA INTERNET PORQUE NÃO ENTENDI PORRA NENHUMA

            var fadeElements = document.getElementsByClassName('scrollFade');
            var fadeElements2 = document.getElementsByClassName('scrollFade2');

            function scrollFade() {
                var viewportBottom = window.scrollY + window.innerHeight;

                for (var index = 0; index < fadeElements.length; index++) {
                    var element = fadeElements[index];
                    var rect = element.getBoundingClientRect();

                    var elementFourth = rect.height/4;
                    var fadeInPoint = window.innerHeight - elementFourth;
                    var fadeOutPoint = -(rect.height/2);

                    if (rect.top <= fadeInPoint) {
                        element.classList.add('scrollFade--visible');
                        element.classList.add('scrollFade--animate');
                        element.classList.remove('scrollFade--hidden');
                    } else {
                        element.classList.remove('scrollFade--visible');
                        element.classList.add('scrollFade--hidden');
                    }

                    if (rect.top <= fadeOutPoint) {
                        element.classList.remove('scrollFade--visible');
                        element.classList.add('scrollFade--hidden');
                    }
                }

                for (var index2 = 0; index2 < fadeElements2.length; index2++) {
                    var element2 = fadeElements2[index2];
                    var rect2 = element2.getBoundingClientRect();

                    var elementFourth2 = rect2.height/4;
                    var fadeInPoint2 = window.innerHeight - elementFourth2;
                    var fadeOutPoint2 = -(rect2.height/2);

                    if (rect2.top <= fadeInPoint2) {
                        element2.classList.add('scrollFade2--visible');
                        element2.classList.add('scrollFade2--animate');
                        element2.classList.remove('scrollFade2--hidden');
                    } else {
                        element2.classList.remove('scrollFade2--visible');
                        element2.classList.add('scrollFade2--hidden');
                    }

                    if (rect2.top <= fadeOutPoint2) {
                        element2.classList.remove('scrollFade2--visible');
                        element2.classList.add('scrollFade2--hidden');
                    }
                }
            }

            document.addEventListener('scroll', scrollFade);
            window.addEventListener('resize', scrollFade);
            document.addEventListener('DOMContentLoaded', function() {
                scrollFade();
            });
        </script>
    </section>



    <script>
        function initMap(){
            // Opções para o mapa
            var options = {
                zoom: <?php echo $zoom; ?>,
                center:{<?php echo $coordenada; ?>},
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
   
    <?php include 'includes/footer.php'?>
</body>
</html>