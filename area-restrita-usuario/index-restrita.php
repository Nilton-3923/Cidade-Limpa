<?php
    error_reporting(0);
    session_start();
    include_once("../session/valida-sentinela.php");
    require_once("../classe/Conexao.php");
    require_once("../classe/Usuario.php");
    require_once("../classe/Denuncia.php");
    require_once("../classe/Ecoponto.php");

    require_once("../classe/Categoria.php");
                                                
    $categoria = new Categoria();
    $perfil = new Usuario();
    

    $listaCat = $categoria->listar();

    if(empty($_SESSION['coordenadaUsuario'])){
        $coordenada = "lat:-23.5489,lng:-46.6388";   
        $zoom = 12;
    }
    //Se a SESSION não estiver vazia ele dá os valores da pesquisa 
    else {
        $coordenada = $_SESSION['coordenadaUsuario'];
        $zoom = 18;
    }
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
        <link rel="stylesheet" href="../css/input-foto.css">
        <link rel="stylesheet" href="../css/alterar-modal.css">
        <link rel="stylesheet" href="../css/update-denuncia-modal.css">
        <link rel="stylesheet" href="../css/modal-confirmacao-deletar.css">
        <link rel="stylesheet" href="../css/notificacao.css">

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>  
        <title>Cidade Limpa</title>
        <link rel="shortcut icon" href="../imagens/reciclagem.png" type="image/x-icon">
    </head>
    <?php
        $listaPerfil = $perfil->perfil();
        foreach($listaPerfil as $lista)
        {

    ?>
    <?php 
        } 
        ?>


    <body>

        <!--------------------------------MODAL DE MENSAGEM QUANDO A DENUNCIA É REALIZADA------------------------------------------------------------------------>
        <?php 
        if($_SESSION['msgDenunciaCriada']){
            $msg = "Denuncia feita com sucesso";

            $_SESSION['msgDenunciaCriada'] = FALSE; 

        ?>
        <div class="toast" role="alert" id="aviso" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="../imagens/reciclagem.png" style="width:20px;"  class="rounded me-2" alt="...">
            <strong class="me-auto">AVISO</strong>
            <?php date_default_timezone_set('America/Sao_Paulo'); ?>
            <small><?php echo date('d/m/Y');?> às <?php echo date('H:i:s'); ?></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Olá <?php echo $_SESSION['nomeUsuario']; ?> <?php echo $msg; ?>
        </div>
        </div>
        <!-- jquery -->
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <!-- bootstrap -->
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <!-- chamada da função -->
        <script type="text/javascript">
        $(window).load(function() {
            $('#aviso').toast('show');
        });
        </script>

        <?php
        }
        ?>

        <!-----------------MODAL PARA CONFIRMAR AS DENÚNCIAS------------------------------------->
        <div class="modal-denuncia-resolvida" id="modal-denuncia-resolvida" style="display:none"> 
        <h3>Estamos verificando se algumas denúncias que você fez já foram realizadas</h3>
        <form action="../objetos/objeto-denuncia-resolvida.php" method="POST">
        <input type="submit" value="Denúncia resolvida">
        
            <table>
            <tr>
                <th>Categoria</th>
                <th>Data</th>
                <th>Rua</th>
                <th>Bairro</th>
                <th>Verificar</th>
            </tr>
            <?php
            $listarTabela = $perfil->verificarAdmTabela();
            foreach($listarTabela as $row){ ?>
                <tr>
                    <td><?php echo $row['campoCategoria']; ?></td>
                    <td><?php echo $row['dataDenuncia']; ?></td>
                    <td><?php echo $row['ruaDenuncia']; ?></td>
                    <td><?php echo $row['bairroDenuncia']; ?></td>
                    <td>
        
                        <input  type="checkbox"
                                name="id[]"
                                value="<?php echo $row['pk_idDenuncia']; ?>"
                                style="width:50px; height:50px"
                                id="checkbox"
                        >
                    </td>
                </tr>
            <?php
            }
            ?>
        
            </table>
        </form>
    </div>


        <!------------------------------------------------------>
        <nav>
            <div class="navbar-parte-1">
                <div class="ajuste-logonav-1">
                    <div class="ajuste-logonav-2">
                        <img class="logo" src="../imagens/logo.png">
                    </div>
                </div>
            </div>
            <!------------NOTIFICAÇÃO DO ADM------------------------------------------>
            <div class="notificacao" data-bs-toggle="modal" data-bs-target="#modalMsg">

                <div class="mensagem" onClick="">
                    <img src="../imagens/Talk.png" class="icon-mensagem">
                    <div class="circulo-notificacao">
                        <?php
                    $listar = $perfil->verificarAdm();
                    foreach($listar as $row){ 
                       echo $row[0]; 
                    } 
                    ?>
                    </div>
                </div>
            </div>
            <!------------------------------------------------------>
            <div id="abre-modal" class="navbar-logado">
                <div class="ajuste-div-foto">
                    <img class="foto-navbar ajuste-foto"src="../cadastro/<?php echo $lista['imgUsuario']; ?>">
                </div>
                <div id="seta"class="seta">
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
                <div id="mapa">
                    <form action="../objetos/objeto-pesquisar-mapa-usuario.php" method="post">

                        <input type="text" placeholder="Pesquisar local" name="pesquisa">
                        <button type="submit">Pesquisar</button>
                    </form>
                    <div id="map"></div>
                </div>
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

        <h1 class="segundo-titulo">DENUNCIAS FEITAS POR VOCÊ</h1>
        <div class="ajuste-denuncias">
            <div class="denuncias">
        <?php
            
            $usuario = new Usuario();
            $listaDeDenuncias = $usuario->denunciasFeita();
            foreach($listaDeDenuncias as $linha){
        ?>
                   <div>
            <div id="container">
                <a class="card-link">
                    <article class="blog-card" data-bs-target="#exampleModalToggle<?php echo $linha[0]; ?>" data-bs-toggle="modal" >
                            <img class="post-image" src="../cadastro/<?php echo $linha['imgDenuncia']; ?>" /><!--Imagem da Denuncia -->
                        <div class="article-details">
                            <h3 class="post-title"><?php echo $linha['tituloDenuncia'];?></h3><!--Titulo da denuncia-->
                            <p class="post-description"><?php echo $linha['descDenuncia'];?></p><!--descrição da Denuncia -->
                            <p class="post-author"><?php echo $linha['nomeUsuario'];?></p>
                            <h4 class="post-category">cep: <?php echo $linha['cepDenuncia'];?></h4><!--cep da Denuncia -->
                        </div>

                    </article>
                    </a>
                        
            </div>   
        </div>
        <!-- MODAL MENSAGEM ADM -->
        <div class="modal fade" id="modalMsg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
            <div class="modal-header">
                <img src="../imagens/logo.png" class="logo-update" alt="">
                <h5 class="alterar-label">Verificação da Denúncia!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Estamos verificando se algumas denúncias que você fez já foram realizadas</p>
                <form action="../objetos/objeto-denuncia-resolvida.php" method="POST">

                <hr>
        
            <table>
            <tr >
                <th>Categoria</th>
                <th>Data</th>
                <th>Rua</th>
                <th>Bairro</th>
                <th>Verificar</th>
            </tr>
            <?php
            $listarTabela = $perfil->verificarAdmTabela();
            foreach($listarTabela as $row){ ?>
                <tr>
                    <td><?php echo $row['campoCategoria']; ?></td>
                    <td><?php echo $row['dataDenuncia']; ?></td>
                    <td><?php echo $row['ruaDenuncia']; ?></td>
                    <td><?php echo $row['bairroDenuncia']; ?></td>
                    <td>
        
                        <input  type="checkbox"
                                name="id[]"
                                value="<?php echo $row['pk_idDenuncia']; ?>"
                                style="width:50px; height:50px"
                                id="checkbox"
                        >
                    </td>
                </tr>
            <?php
            }
            ?>
        
            </table>
            <div class="modal-footer">
                <input type="submit" class="btn-update-den" value="Denúncia resolvida">
            </div>
            
        </form>
            </div>
            
            </div>
        </div>
        </div>
        <!-- **************************** -->
        <div class="modal fade" id="exampleModalToggle<?php echo $linha[0]; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <img src="../imagens/logo.png" class="logo-update" alt="">
                    <h5 class="alterar-label">Alterar Denúncia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../CRUD/objeto-alterar-denuncia.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="pk_idDenuncia" value="<?php echo $linha['pk_idDenuncia'];?>">
                        <div class="div-update-den" >
                            <label for="" class="title-updateDen">Título da Denúncia</label>
                            <input type="text" name="tituloDenuncia" class="form-control" name="" value="<?php echo $linha['tituloDenuncia']; ?>">
                        </div>
                        <div class="div-update-den">
                            <label for="" class="title-updateDen" >Descrição da Denúncia</label>
                            <input type="text" name="descDenuncia" class="form-control" value="<?php echo $linha['descDenuncia']; ?>">
                        </div>
                        <div class="div-update-den">
                            <label for="" class="title-updateDen">Categorias</label>
                            <select name="txtCategoria" class="form-select" id="">
                                <?php 
                                    require_once("../classe/Categoria.php");
                                                        
                                    $categoria = new Categoria();
                                    $listaCat = $categoria->listar();
                                    foreach($listaCat as $categorias){
                                        if($linha['fk_idCategoria']==$categorias[0]){
                                            $sel = "selected";	
                                        }
                                        else{
                                            $sel = " ";	
                                        }
                                ?>
                                <option value="<?php echo $categorias['pk_idCategoria'];?>" <?php echo $sel; ?>><?php echo $categorias['campoCategoria']; ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        <div class="div-update-den">
                            <input class="form-control" type="file" name="imgDenuncia">
                        </div>   
                        <button type="button" class="btn-del-den" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $linha[0]; ?>">
                                Denúncia Resolvida
                        </button>
                        <input type="submit" class="btn-update-den" value="Salvar">
                    </form>
                </div>
               
                </div>
            </div>
        </div>
        <!-- MODAL CONFIRMAR SE DELETA A DENÚNCIA  -->
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop<?php echo $linha[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                        <img src="../imagens/logo.png" class="logo-update" alt="">
                        <h5 class="alterar-label">Confirmando denúncia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   Tem cer de que essa denúncia foi resolvida?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-del-den" data-bs-dismiss="modal">Cancelar</button>
                    <a class="btn-update-den"href="../CRUD/objeto-deletar-denuncia.php?pk_idDenuncia=<?php echo $linha['pk_idDenuncia'];?>">Sim, Tenho.</a>
                </div>
                </div>
            </div>
        </div>

        <!-- **************************************************FIM DA MODAL -->

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
                    <form action="../CRUD/objeto-alterar-usuario.php" method="post" enctype="multipart/form-data" class="alterar">
                            <div class="form-input">
                                <div class="preview">
                                    <img id="file-ip-1-preview">
                                    <label for="file-ip-1">Escolher Imagem</label>
                                    <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);">
                                </div>
                            </div>
                        <input type="hidden" name="pk_Usuario" value="<?php echo $_SESSION['idUsuario'];?>" >
                        <input type="text" name="nomeUsuario" value="<?php echo $linha['nomeUsuario'];?>" ><!--NOME USUARIO -->
                        <input class="input-desabilitado" type="text" name="emailUsuario" disabled value="<?php echo $linha['emailUsuario'];?>" ><!--TELEFONE USUARIO -->
                        <input type="text" name="senhaUsuario" value="<?php echo $linha['senhaUsuario'];?>" ><!--SENHA USUARIO -->
                        <input type="text" name="numTelUsuario" value="<?php echo $linha['numTelUsuario'];?>" ><!--TELEFONE USUARIO -->
                        
                        <div class="btns-modal">
                            <!-- Botao de deletar denuncia--><div data-bs-toggle="modal" data-bs-target="#modalDeletarConta" class="abrir-modal-confirmacao-deletar-conta">Deletar</div>
                        </div>
                        <p class="cancelar" onClick="modalAlterarConta()">Cancelar</p>
                        <input type="submit" value="Salvar">
                    </form>
                </div>
            </div>

            
            
        <?php } ?>
        <!-- MODAL PARA CONFIMAR EM DELETAR CONTA ***************************************************-->
        
            <!-- Modal -->
            <div class="modal fade" id="modalDeletarConta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="alterar-label">Tem Certeza disso?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                    <a class="btn btn-danger" href="../CRUD/objeto-deletar-usuario.php?pk_Usuario=<?php echo $_SESSION['idUsuario']; ?>">Sim </a><!--Deletar Usuario-->  
                </div>
                </div>
            </div>
            </div>

        <!--*************************************FIM DA MODAL********************-->
        <p id="mensagem"></p>
        <div id="modalCriarDenuncia" class="ajuste-criar-denuncia">
            <div class="criar-denuncia">
                <p onClick="cancelarModalCriarDenuncia()"class="btn-cancelar-modalCriarDenuncia">Cancelar</p>
                <h1 class="titulo-criar-denuncia">Denuncia</h1>
                <span id="mensagem" style="opacity:0;color:red;display:none">*Endereço invalido</span>
                
                <form action="../cadastro/objeto-cadastro-denuncia.php" method="post" enctype="multipart/form-data">
                <div class="ajuste-form">
                    <div class="form-pt1">
                        <!--Id do usuario-->
                        <input type="hidden" name="txtIdUsuario" value="<?php echo $_SESSION['idUsuario']; ?>"> 
                        <div class="ajuste-para-correcao-inputs">
                            <!--Titulo denuncia-->
                            <input type="text" name="txtTituloDenuncia" aria-describedby="inputGroupPrepend" required placeholder="Titúlo">
                            <div class="correcao-inputs"></div>
                        </div>
                        
                        <!--Categoria da denuncia-->
                        <div class="ajuste-para-correcao-inputs">
                            <input type="text" id="cep" name="txtCepDenuncia" aria-describedby="inputGroupPrepend" required placeholder="CEP" maxlength="9">   
                            <div class="correcao-inputs"></div>
                        </div>
                        <div class="ajuste-para-correcao-inputs">
                            <input class="rua config-input desabilitado"type="text" aria-describedby="inputGroupPrepend" required id="rua" name="txtRuaDenuncia" placeholder="Rua" >
                        </div>
                        <div class="ajuste-para-correcao-inputs">
                            <input class="desabilitado"type="text" id="bairro" aria-describedby="inputGroupPrepend" required name="txtBairroDenuncia" placeholder="Bairro">
                            <div class="correcao-inputs"></div>
                        </div>
                        <!--Endereços-->
                        <div class="ajuste-para-correcao-inputs">
                            <input class="cidade config-input desabilitado"type="text" aria-describedby="inputGroupPrepend" required id="cidade" name="txtCidadeDenuncia" placeholder="Cidade" >
                        </div>
                        <!--Descrição denuncia-->
                        <!--Aqui tem que ser uma área para escrever-->
                        <textarea class="desc" name="txtDenuncia" id="denuncia" cols="23" rows="5" placeholder="Descrição"></textarea>
                        
                        
                    </div>
                    <div class="ajuste-inputs-2dg">
                        <input class="num config-input" type="text" id="numero" aria-describedby="inputGroupPrepend" required name="txtNumeroDenuncia" placeholder="Nº">   
                        <input class="uf config-input desabilitado"type="text" aria-describedby="inputGroupPrepend" required id="uf" name="txtUfDenuncia" placeholder="UF" >
                    </div>
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
                            
                        <div style="width:100%;"class="form-input">
                            <div class="preview">
                                <img src="../imagens/sair-adm.png"class="img-preview" id="file-ip-1-preview-2">
                                <label for="file-ip-1-2">Escolher Imagem</label>
                                <input type="file" id="file-ip-1-2" accept="image/*" name="fotoDenuncia" onchange="showPreview2(event);">
                            </div>
                        </div>

                        <input class="btn-denunciar alteracao-btn-criar-denuncia"type="submit" value="Denunciar">
                        
                    </div>
                    <script>
                        function showPreview2(event){
                            if(event.target.files.length > 0){
                            var src2 = URL.createObjectURL(event.target.files[0]);
                            var preview2 = document.getElementById("file-ip-1-preview-2");
                            preview2.src = src2;
                            preview2.style.display = "block";
                            }
                        }
                    </script>
                 
                   
                    
                </form>
            </div>
        </div>
 
    </body>
    <script src="../javascript/api-cep.js"></script>
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
                            content:'<h3 style="color:<?php echo $cor; ?>; display: inline; margin-right:20px"><?php echo $categoria; ?></h3>'
                                    +'<span style="color:black"><?php echo $data; ?></span>'
                                    +'<p style="color:black; margin-top:20px; margin-bottom:20px;"><?php echo $desc;?></p>'
                                    +'<img style="height:150px; width:300px; margin-left:12px;"src="../cadastro/<?php echo $img;?>">'
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
    <script src="../javascript/modal-notificacao.js"></script>

    <script src="../javascript/mascara.js"></script>
    <script src="../javascript/index-restrita.js"></script>
    <script src="../javascript/input-foto.js"></script>
    
</html>