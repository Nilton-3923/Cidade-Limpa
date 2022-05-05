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
                <a onClick="modalAlterarConta()"class="btn-alterar-conta">Alterar conta</a>
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
                        <p onClick="modalCriarDenuncia()"class="btn-denunciar">Clique aqui para Denunciar</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="divisao-pagina"></div>

        <h2 class="segundo-titulo">DENUNCIAS FEITAS POR VOCÊ</h2>
        <div class="ajuste-denuncias">
            <div class="denuncias">
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
            
                <div class="card">
                    <div class="card-part1">
                        <img class="foto-usuario" src="../cadastro/<?php echo $linha['imgUsuario'] ?>" alt="" ><!-- Foto do Usuario -->
                        <h5><?php echo $linha['nomeUsuario'];?></h5><!--nome do Usuario -->
                    </div>
                    <div class="conteudo-card">
                        <div class="titulo-e-data">
                            <h5 class=""><?php echo $linha['tituloDenuncia'];?></h5><!--titulo da Denuncia -->
                            <p class=""><?php echo $linha['dataDenuncia'];?></p><!--data da Denuncia -->
                        </div>
                        <div class="div-cep">
                            <h5 class="">CEP:<?php echo $linha['cepDenuncia'];?></h5><!--cep da Denuncia -->
                            <div class="ajuste-cep"></div>
                        </div>
                        <div class="desc-e-img">
                            <h5 class="">Descrição:<br><?php echo $linha['descDenuncia'];?></h5><!--descrição da Denuncia -->
                            <div class="img-denuncia">
                                <img src="../cadastro/<?php echo $linha['imgDenuncia']; ?>" alt=""><!--Imagem da Denuncia -->
                            </div>  
                        </div>
                        <div class="divisao-card"></div>
                        <img class="icone" src="../imagens/icone-agua.png" >
                    </div>  
                </div>          
        <?php
            }

            $usuario = new Usuario();
            $lista = $usuario->perfil();

            foreach($lista as $linha){
        ?>
            
                </div>
            </div>
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
        <p id="mensagem"></p>
        <div id="modalCriarDenuncia" class="ajuste-criar-denuncia">
            <div class="criar-denuncia">
                <p onClick="cancelarModalCriarDenuncia()"class="btn-cancelar-modalCriarDenuncia">Cancelar</p>
                <h1 class="titulo-criar-denuncia">Denuncia</h1>
                <span id="mensagem" style="opacity:0;color:red;display:none">*Endereço invalido</span>
                <form action="../cadastro/objeto-cadastro-denuncia.php" method="post" enctype="multipart/form-data">
                <div class="form-pt1">

                    <!--Id do usuario-->
                    <input type="hidden" name="txtIdUsuario" value="
                    <?php 
                            session_start();
                            echo $_SESSION['idUsuario'];    
                            ?>
                    "> 
                    <div class="ajuste-para-correcao-inputs">
                        <!--Titulo denuncia-->
                        <input type="text" name="txtTituloDenuncia" placeholder="Titúlo">
                        <div class="correcao-inputs"></div>
                    </div>
                    
                    <!--Categoria da denuncia-->
                    <?php
                    require_once("../classe/Conexao.php");
                    require_once("../classe/Categoria.php");
                    
                    $categoria = new Categoria();
                    $listaCat = $categoria->listar();
                    
                    ?>
                    <div class="ajuste-para-correcao-inputs">
                        <input type="text" id="cep" name="txtCepDenuncia" placeholder="CEP";>
                        <div class="correcao-inputs"></div>
                    </div>
                    <div class="rua-e-num">
                        <input class="rua desabilitado"type="text" id="rua" name="txtRuaDenuncia" placeholder="Rua" disabled >
                        <input class="num" type="text" id="numero" name="txtNumeroDenuncia" placeholder="Nº">
                    </div>
                    <div class="ajuste-para-correcao-inputs">
                        <input class="desabilitado"type="text" id="bairro" name="txtBairroDenuncia" placeholder="Bairro" disabled>
                        <div class="correcao-inputs"></div>
                    </div>
                    <!--Endereços-->
                    <div class="cidade-uf">
                        <input class="cidade desabilitado"type="text" id="cidade" name="txtCidadeDenuncia" placeholder="Cidade"disabled >
                        <input class="uf desabilitado"type="text" id="uf" name="txtUfDenuncia" placeholder="UF" disabled>
                    </div>
                    
                    <!--Descrição denuncia-->
                    <!--Aqui tem que ser uma área para escrever-->
                    <textarea class="desc" name="txtDenuncia" id="denuncia" cols="23" rows="5" placeholder="Descrição"></textarea>
                    <br>
    
                </div>
                <!--Número da casa-->
                <div class="categ-reg-ft">
                    <select name="txtCategoria">
                        <option disabled selected>Selecione a Categoria</option>
                        <?php 
                            foreach($listaCat as $linha)
                            { 
                                ?>
                                <option value="<?php echo $linha['pk_idCategoria'];?>">
                                    <?php echo ($linha['campoCategoria']);?>
                                </option>
                                <?php 
                            } 
                            ?>
                        </select>
                        <!--Região-->
                        <select name="regiao" id="regiao">
                            <option disabled selected>Regiões de São Paulo</option>
                            <option value="Zona Leste">Zona Leste</option>
                            <option value="Zona Norte">Zona Norte</option>
                            <option value="Zona Sul">Zona Sul</option>
                            <option value="Zona Oeste">Zona Oeste</option>
                        </select><br>
                        <!--Imagem denuncia-->
                        <label>Selecione a Foto da Denuncia</label>
                        <input type="file" name="fotoDenuncia"><br>
                        <input class="btn-denunciar alteracao-btn-criar-denuncia"type="submit" value="Denunciar">
                    </div>
                    
                    
                    <!--Data denuncia-->
                    <input type="hidden" id="data" name="txtDtDenuncia" 
                    value="      
                    <?php
                        date_default_timezone_set('America/Sao_Paulo');
                        echo date('Y/m/d');
                        ?>
                    ">
                    
                </form>
            </div>
        </div>
    </body>
    <script src="../javascript/api-cep.js"></script>
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
                                    +'<img style="height:150px; width:300px;"src="../cadastro/<?php echo $img;?>"></a>'
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