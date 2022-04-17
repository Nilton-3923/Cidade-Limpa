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
        <div id="parallax" class="mapa flex-center">
            <!--AIzaSyD5opbRMRKjMKTKajH2CdyKJCIsqOdwdUI-->
            <h1>Bem-vindo ao Cidade Limpa</h1>
        </div>
    </section>

    <section id="sobre" class="index-segunda-parte">
        <h1>Sobre Nós</h1>
        <p>Somos  a Cidade Limpa, Somos uma plataforma dedicada á denúncias de meio ambiente humanitário .</p>
        
    </section>

    <div id="map" style="height:300; width:300; background:red"></div>

    <script src="javascript/parallax.js"></script>
            <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5opbRMRKjMKTKajH2CdyKJCIsqOdwdUI">
                function initMap() {
                    const uluru = { lat: -25.363, lng: 131.044 };
                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 4,
                        center: uluru,
                    });
                    window.initMap = initMap;

            </script>
</body>
</html>