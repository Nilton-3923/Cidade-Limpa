<?php
    session_start();
    error_reporting(0);
    include_once("../session/valida-sentinela-adm.php");
    require_once("../classe/Conexao.php");
    require_once("../classe/Ecoponto.php");

    $ecoponto = new Ecoponto();

    $mostrar = $ecoponto ->ecopontosSemGeolocalizacao();
    
    foreach($mostrar as $row){
        $id = $row[0];
        
        $selecao = $ecoponto-> selecionarEcopontoParametro($id);
    
        foreach($selecao as $linha){
            $localizacao = $ecoponto->geolocalizacaoExcel($linha[8], $linha[5], $linha[3],$linha[2], $linha[1]);
            $ecoponto->alterarLocalizacao($localizacao, $linha[0]);
        }

        
    }

    $pontosEcoponto = $ecoponto->mostrarEcoponto();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap"
      rel="stylesheet"
    />

	<link rel="stylesheet" href="../css/index-adm.css">
    <link rel="stylesheet" href="../css/cadastro-ecoponto.css">
    <link rel="stylesheet" href="../css/cadastro-ecoponto2.css">
    <link rel="stylesheet" href="../css/toast.css">
    <link rel="stylesheet" href="../css/update-denuncia-modal.css">
    
	<title>Ecoponto - Cidade Limpa</title>
    <link rel="shortcut icon" href="../imagens/reciclagem.png" type="image/x-icon">
</head>

	<body>
        <!-- SIDEBAR -->
        <section id="sidebar">
            <a href="index-adm-restrita.php" class="brand"><i class='bx bxs-map icon'></i>Cidade Limpa</a>
                    <ul class="side-menu">
                        <li><a href="index-adm-restrita.php" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
                        <li class="divider" data-text="Principal">Principal</li>
                        <li><a href="index-adm-restrita.php"><i class='bx bxs-chart icon' ></i> Gráficos</a></li>
                        <li class="divider" data-text="Tabelas e Formulários">Tabelas e Formulários</li> 
                        <li>
                            <a href="#"><i class='bx bx-message-x icon' ></i> Denúncias <i class='bx bx-chevron-right icon-right' ></i></a>
                            <ul class="side-dropdown">
                                <li><a href="tabela-denuncia.php">Tabela Denúncias</a></li>
                                <li><a href="tabela-denuncias-regiao.php">Denúncias por Região</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class='bx bx-user icon' ></i> Usuário <i class='bx bx-chevron-right icon-right' ></i></a>
                            <ul class="side-dropdown">
                                <li><a href="tabela-usuario.php">Tabela Usuários</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class='bx bxs-notepad icon' ></i> Ecopontos <i class='bx bx-chevron-right icon-right' ></i></a>
                            <ul class="side-dropdown">
                                <li><a href="tabela-ecopontos.php">Tabela Ecopontos</a></li>
                                <li><a href="./cadastro-ecoponto.php">Cadastrar EcoPonto</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class='bx bxs-spreadsheet icon' ></i> Categoria <i class='bx bx-chevron-right icon-right' ></i></a>
                            <ul class="side-dropdown">
                                <li><a href="cadastro-categoria.php">Cadastrar Categoria</a></li>
                            </ul>
                        </li>
                    </ul>

		</section>
		<!-- SIDEBAR -->

		<!-- CONTEUDO -->
		<section id="content">
			<!-- NAVBAR -->
			<nav>
				<i class='bx bx-menu toggle-sidebar' ></i>
				<form action="#">
				</form>
				<span class="divider"></span>
				<div class="profile">
					<img src="../imagens/sair-adm.png" alt="">
					<ul class="profile-link">
						<li><a href="../session/logout-adm.php"><i class='bx bxs-log-out-circle' ></i> Sair</a></li>
					</ul>
				</div>
			</nav>
            

        
            <!-----------MODAL DE ALERTA DO CADASTRO DO ECOPONTO-------------------------------------------------------->
            
            <?php
            /*
            SE COLOCAR A SESSION COMO TRUE NÃO É NECESSÁRIO FICAR CADASTRANDO PARA VERIFICAR O ESTILO NA MODAL
            $_SESSION['verificarCadastroEcoponto'] = TRUE; 
            */

            if($_SESSION['verificarCadastroEcoponto']){
                //VARIAVEL DA MENASGEM
                $msg = "Ecoponto cadastrado com SUCESSO!";

                $_SESSION['verificarCadastroEcoponto'] = FALSE; 
            ?>
                <div class="container-post">
                    <div class="wrapper-success">
                        <div class="card">
                        <div class="icon"><i class="fas fa-check-circle"></i></div>
                        <div class="subject">
                            <h3 class="titulo">Sucesso!</h3>
                            <p class="paragrafo"><?php echo $msg; ?></p>
                        </div>
                        <div class="icon-times"><i onClick="fecharToast()" class="fas fa-times"></i></div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            
            <!-----------MODAL DE ALERTA DO CADASTRO DO ECOPONTO XML - DANDO CERTO-------------------------------------------------------->   
            <?php

            /*
            SE COLOCAR A SESSION COMO TRUE NÃO É NECESSÁRIO FICAR CADASTRANDO PARA VERIFICAR O ESTILO NA MODAL
            
            $_SESSION['verificarXml-True'] = TRUE; 
            */
            if($_SESSION['verificarXml-True']){
                //VARIAVEL DA MENASGEM
                $msg = "Ecopontos cadastrados com SUCESSO!";

                $_SESSION['verificarXml-True'] = FALSE; 
            ?>
                <div class="container-post">
                    <div class="wrapper-success">
                        <div class="card">
                        <div class="icon"><i class="fas fa-check-circle"></i></div>
                        <div class="subject">
                            <h3 class="titulo">Sucesso!</h3>
                            <p class="paragrafo"><?php echo $msg; ?></p>
                        </div>
                        <div class="icon-times"><i onClick="fecharToast()" class="fas fa-times"></i></div>
                        </div>
                    </div>
                </div>
                
            <?php
            }
            ?>



            <!-----------MODAL DE ALERTA DO CADASTRO DO ECOPONTO XML - DANDO ERRO-------------------------------------------------------->
            <?php
            /*
            SE COLOCAR A SESSION COMO TRUE NÃO É NECESSÁRIO FICAR CADASTRANDO PARA VERIFICAR O ESTILO NA MODAL
            $_SESSION['verificarXml-False'] = TRUE; 
            */
            if($_SESSION['verificarXml-False']){
                //VARIAVEL DA MENASGEM
                 $msg = "Não foi possíve efetuar o cadastro!";

                $_SESSION['verificarXml-False'] = FALSE; 
            ?>
                <div class="container-post">
                    <div class="wrapper-warning">
                        <div class="card">
                            <div class="icon"><i class="fas fa-exclamation-circle"></i></div>
                            <div class="subject">
                                <h3 class="titulo">ERRO!</h3>
                                <p class="paragrafo"><?php echo $msg; ?></p>
                            </div>
                            <div class="icon-times"><i class="fas fa-times"></i></div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>



        

            <div class="cadastro-ecoponto">
                
                <h1>Cadastrar Ecoponto</h1>
                <form action="../cadastro/objeto-cadastro-ecoponto.php" method="post" class="">
        
                    <div class="form-floating">
                        <input type="text" required placeholder="CEP" id="cep" name="cep" class="form-control  input-normal" maxlength="9">
                        <label for="floatingInput">CEP</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" required placeholder="Bairro" id="bairro" name="bairro" class="form-control input-normal">
                        <label for="floatingInput">Bairro</label>
                    </div>

                    <div class="form-floating">
                        <input type="text" required placeholder="Rua" id="rua" name="rua" class="form-control input-normal">
                        <label for="floatingInput">Rua</label>
                    </div>

                    <div class="box-flex">
                        <div class="form-floating">
                            <input type="text" required placeholder="Cidade" id="cidade" name="cidade" class="form-control input-normal">
                            <label for="floatingInput">Cidade</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" required placeholder="Uf" id="uf" name="uf" class="form-control input-menor input-inline">
                            <label for="floatingInput">UF</label>
                        </div>
                    </div>

                    <div class="form-floating">
                        <input type="text" required placeholder="Número" name="numero" class="form-control input-menor">
                        <label for="floatingInput">Número</label>
                    </div>

                    <select name="regiao" required id="regiao" class="form-select input-normal" aria-label="Default select example">
                        <option selected disabled value="">Regiões de São Paulo</option>
                        <option value="Zona Leste">Zona Leste</option>
                        <option value="Zona Norte">Zona Norte</option>
                        <option value="Zona Sul">Zona Sul</option>
                        <option value="Zona Oeste">Zona Oeste</option>
                    </select><br>
        
                    <input type="submit" class="btn btn-secondary" value="Cadastrar">
                </form>
            </div>
            
            <div class="cadastro-excel">
                <h2 class="title2">Cadastrar com uma planilha Excel</h2>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tutorial
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <img src="../imagens/logo.png" class="logo-update" alt="">
                        <h5 class="alterar-label">Passo 1</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span><img src="../imagens/atencao.png" style="width: 30px;" alt=""></span> Faça o dowload do modelo formatado
                        <hr><p>Clique aqui:</p><img src="../imagens/formato-xml.jpg" alt="" srcset="">
                    </div>
                    <div class="modal-footer">
                       
                        <button type="button"  data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-primary">Proximo</button>
                    </div>
                    </div>
                </div>
                </div>
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <img src="../imagens/logo.png" class="logo-update" alt="">
                        <h5 class="alterar-label">Passo 2</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span><img src="../imagens/atencao.png" style="width: 30px;" alt=""></span> Preencha os Dados de localização
                        <hr>
                        <img src="../imagens/dadosEcopontos.jpg" style="width: 300px;" alt="" srcset="">
                    </div>
                    <div class="modal-footer">
                       
                        <button type="button"  data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal3" class="btn btn-primary">Proximo</button>
                    </div>
                    </div>
                </div>
                </div>
                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <img src="../imagens/logo.png" class="logo-update" alt="">
                        <h5 class="alterar-label">Passo 3</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span><img src="../imagens/atencao.png" style="width: 30px;" alt=""></span> Salve sua planilha com os dados 
                        <hr>
                        <img src="../imagens/salvar.jpg" style="width: 250px;" alt="" srcset="">
                    </div>
                    <div class="modal-footer">
                       
                        <button type="button"  data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal4" class="btn btn-primary">Proximo</button>
                    </div>
                    </div>
                </div>
                </div>
                <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <img src="../imagens/logo.png" class="logo-update" alt="">
                        <h5 class="alterar-label">Passo 4</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span><img src="../imagens/verificado.png" style="width: 25px;" alt=""></span> Importe sua planilha
                        <hr>
                        <img src="../imagens/importar.jpg" style="width: 400px;" alt="" srcset="">
                    </div>
                    <div class="modal-footer">
                       
                        <button type="button"  data-bs-dismiss="modal" data-bs-toggle="modal"  class="btn btn-primary">Proximo</button>
                    </div>
                    </div>
                </div>
                </div>
                <p>* É necessário que a planilha tenha sido salva como .xml</p>
                <a href="xml/formato-cadastro.xml" download="Formato-cadastro">Download do EXCEL(Exemplo)</a>
                <form action="../cadastro/cadastro-xml-ecopontos.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="arquivo" class="form-control input-normal">
                    <input type="submit" class="btn btn-secondary" value="Cadastrar">
                </form>
                
            </div>

            <div>
                <h2>Mapa com os Ecopontos</h2>
                <div id="map" style="width: 70%; height: 500px;"></div>
            </div>

            <span id="mensagem"></span>
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
                    foreach ($pontosEcoponto as $row){
                        $bairro = $row['bairroEcoponto'];
                        $rua = $row['ruaEcoponto'];
                        $numero = $row['numeroEcoponto'];
                        $regiao = $row['zonaEcoponto'];
                    ?>
                        {
                        coords:{<?php echo $row['coordeEcoponto'];?>},
                        content:'<h2 style="color: green; font-size:20px" >Ecoponto <?php echo $bairro; ?></h2>'
                                +'<h3 style="font-size:15px"><?php echo "$rua, $numero"; ?></h3>'
                                +'<h3 style="font-weight: normal; font-size:15px"><?php echo $regiao; ?></h3>',
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
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

 

        <script src="../javascript/toast.js"></script>

        <script src="../javascript/mascara.js"></script>
        <script src="../javascript/api-cep.js"></script>
		<script src="../javascript/index-adm.js"></script>
    </body>
</html>