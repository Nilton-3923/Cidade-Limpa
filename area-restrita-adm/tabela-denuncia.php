<?php
    session_start();
    require_once("../classe/Adm.php");
    include_once("../session/valida-sentinela-adm.php");

    $adm = new Adm();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/index-adm.css">
    <link rel="stylesheet" href="../css/adm-formatacao.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/update-denuncia-modal.css">
    <link rel="stylesheet" href="../css/form-pesquisa-adm.css">
	<title>Tabela - Cidade Limpa</title>
    <link rel="shortcut icon" href="../imagens/reciclagem.png" type="image/x-icon">
</head>

	<body>
        <!-- SIDEBAR -->
        <section id="sidebar">
            <a href="index-adm-restrita.php" class="brand"><i class='bx bxs-map icon'></i>Cidade Limpa</a>
                    <ul class="side-menu">
                        <li class="divider" data-text="Principal">Principal</li>
                        <li><a href="index-adm-restrita.php"><i class='bx bxs-chart icon' ></i> Gráficos</a></li>
                        <li class="divider" data-text="Tabelas e Formulários">Listas e Formulários</li> 
                        <li>
                            <a href="#"><i class='bx bx-message-x icon' ></i> Denúncias <i class='bx bx-chevron-right icon-right' ></i></a>
                            <ul class="side-dropdown">
                                <li><a href="tabela-denuncia.php">Listas Denúncias</a></li>
                                <li><a href="tabela-denuncias-regiao.php">Denúncias por Região</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class='bx bx-user icon' ></i> Usuário <i class='bx bx-chevron-right icon-right' ></i></a>
                            <ul class="side-dropdown">
                                <li><a href="tabela-usuario.php">Listas Usuários</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class='bx bxs-notepad icon' ></i> Ecopontos <i class='bx bx-chevron-right icon-right' ></i></a>
                            <ul class="side-dropdown">
                                <li><a href="tabela-ecopontos.php">Listas Ecopontos</a></li>
                                <li><a href="./cadastro-ecoponto.php">Cadastrar EcoPonto</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class='bx bxs-spreadsheet icon' ></i> Categoria de denúncias<i class='bx bx-chevron-right icon-right' ></i></a>
                            <ul class="side-dropdown">
                                <li><a href="cadastro-categoria.php">Cadastrar Categoria</a></li>
                            </ul>
                        </li>
                        </li>
                    </ul>

		</section>
		<!-- SIDEBAR -->

		<!-- NAVBAR -->
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

            
        <div>
            <h1>TABELA DE DENÚNCIAS</h1>
            <!-- Form Para Limitar Denúncias -->
                <select name="limite" id="select" class="select-normal form-select form-select-sm"  aria-label=".form-select-sm example" onChange="selecionados()">
                    <option value="0">Vizualizar todas as denúncias</option>
                    <option value="1">Vizualizar denúncias não resolvidas</option>
                    <option value="2">Vizualizar denúncias resolvidas</option>
                </select>
                
        </div>
        <?php
            $todas = $adm->contarTodasDenuncia();
            foreach($todas as $tudo){}
            $resolvidas = $adm->contagem();
            foreach($resolvidas as $resolvida){}
            $naoResolvidas = $tudo[0]-$resolvida[0];
        ?>

        <div id="tudo">
            <div> 
                
                <h1 style="color: #064018;">Número de Denúncias feitas: <?php echo $tudo[0]; ?> </h1>
                <hr>
                <!-- Form Para pesquisar Denúncias -->
                <form method="POST" id="form-pesquisa" action="" >
                    <div class="div-pesquisa-usuario">
                        <input type="text" class="form-control" style="margin-top:10px;width: 250px; height:40px;" name="pesquisa" id="pesquisa" placeholder="Digite a Denúncia">
                        <input type="submit" value="Pesquisar" class="btn btn-secondary btn-pesquisa">
                        <a href="pdfs/pdf-table-denuncia.php" class="btn btn-secondary btn-pesquisa" target="_blank">Vizualizar Pdf</a>
                    </div>
                </form>

                </div>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Código</th>
                        <th>Categoria</th>
                        <th>Data</th>
                        <th>Rua</th>
                        <th>Bairro</th>
                        <th>Usuario</th>
                        <th>Verificação do ADM</th>
                </tr>
                <?php
                    if(!isset($_POST['pesquisa'])){
                        $tables = $adm->tabelaDenuncia();
                    }
                    else{
                        $pesquisa = $_POST['pesquisa'];
                        $tables = $adm->pesquisaDenuncia($pesquisa);
                    }
                        foreach($tables as $dados){

                            //CRIANDO UMA FUTURA VALIDAÇÃO PARA ANALISAR SE A DENÚNCIA TEM A VERIFICAÇÃO DO ADM

                            //SE ELA TIVER A VERIFICAÇÃO O TARGET É NULO
                            if($dados['pk_idDenuncia'] == 46){
                                $target = "";
                            }
                            else{
                                $target = "#exampleModal$dados[0]";
                            }
                    ?>
                    <tr data-bs-toggle="modal" data-bs-target="<?php echo $target?>" >
                        <td><?php echo $dados['pk_idDenuncia']; ?></td>
                        <td><?php echo $dados['campoCategoria']; ?></td>
                        <td><?php echo $dados['dataDenuncia']; ?></td>
                        <td><?php echo $dados['ruaDenuncia']; ?></td>
                        <td><?php echo $dados['bairroDenuncia']; ?></td>
                        <td><?php echo $dados['emailUsuario']; ?></td>
                    </tr>
                    <div class="modal fade" id="exampleModal<?php echo $dados[0]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            <img src="../imagens/logo.png" class="logo-update" alt="">
                            <h5 class="alterar-label">Dados da Denúncia</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="" class="label-modal">Código: <?php echo $dados[0]; ?></label><br>
                                <label for="" class="label-modal">Data: <?php echo $dados['dataDenuncia']; ?></label><br>
                                <label for="" class="label-modal"><?php echo $dados['campoCategoria']; ?></label><br>
                                <label for="" class="label-modal"><?php echo $dados['tituloDenuncia']; ?></label><br>
                                <div class="form-floating mb-3">
                                    <p><?php echo $dados['descDenuncia']; ?></p>
                                </div>
                                <div class="fotoDen">
                                    <label for="" class="label-modal titleImg">Imagem Denúncia: <br>
                                    <img class="imgDen" src="../cadastro/<?php echo $dados['imgDenuncia']; ?>" alt="">
                                </div>
                                <label for="" class="label-modal local"><?php echo $dados[8].",". $dados[6].",". $dados[9]." - ". $dados[5]; ?></label><br>
                            </div>
                                <div class="formAdm">
                                    <label for="" class="label-modal coment">Adicionar comentário <br>
                                    <form action="../teste.php" method="post">
                                        <textarea name="comentarioAdm" class="descModal" id="message" type="text" rows="3" placeholder="Comentar..."  data-sb-validations="required"></textarea>
                                </div>
                            <div class="modal-footer">
                                        <input type="submit"  class="btn btn-secondary" >
                                    </form>
                                
                            </div>
                            </div>
                        </div>
                        </div>
                    <?php
                    }
                    ?>
            </table>
        </div>

        <div id="Nao-Resolvida" style="display: none">
            <h1 style="color: #064018;">Número de Denúncias Não Resolvidas: <?php echo $naoResolvidas; ?> </h1>
                    <hr>
                    

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="select-all" >
                <label>Selecionar todas as denúncias</label>
            </div>
            <form action="../objetos/objeto-alterar-verificacao.php" method="POST">
                <input type="submit" value="Verificar denúncia">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Código</th>
                        <th>Categoria</th>
                        <th>Data</th>
                        <th>Rua</th>
                        <th>Bairro</th>
                        <th>Usuario</th>
                        <th>Selecionar</th>
                    </tr>
                    <?php
                            $tables = $adm->tabelaDenunciaNaoResolvida();
                            foreach($tables as $dados){
                        ?>
                        <tr >
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal2<?php echo $dados[0] ?>"><?php echo $dados['pk_idDenuncia']; ?></td>
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal2<?php echo $dados[0] ?>"><?php echo $dados['campoCategoria']; ?></td>
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal2<?php echo $dados[0] ?>"><?php echo $dados['dataDenuncia']; ?></td>
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal2<?php echo $dados[0] ?>"><?php echo $dados['ruaDenuncia']; ?></td>
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal2<?php echo $dados[0] ?>"><?php echo $dados['bairroDenuncia']; ?></td>
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal2<?php echo $dados[0] ?>"><?php echo $dados['emailUsuario']; ?></td>
                            <td>
            
                                    <input  type="checkbox"
                                            name="id[]"
                                            value="<?php echo $dados['pk_idDenuncia']; ?>"
                                            style="width:50px; height:50px"
                                            id="checkbox"
                                            >
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModal2<?php echo $dados[0]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            <img src="../imagens/logo.png" class="logo-update" alt="">
                            <h5 class="alterar-label">Dados da Denúncia</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="" class="label-modal">Código: <?php echo $dados[0]; ?></label><br>
                                <label for="" class="label-modal">Data: <?php echo $dados['dataDenuncia']; ?></label><br>
                                <label for="" class="label-modal"><?php echo $dados['campoCategoria']; ?></label><br>
                                <div class="form-floating mb-3">
                                    <p><?php echo $dados['descDenuncia']; ?></p>
                                </div>
                                <div class="fotoDen">
                                    <label for="" class="label-modal titleImg">Imagem Denúncia: <br>
                                    <img class="imgDen" src="../cadastro/<?php echo $dados['imgDenuncia']; ?>" alt="">
                                </div>
                                <label for="" class="label-modal local"><?php echo $dados[8].",". $dados[6].",". $dados[9]." - ". $dados[5]; ?></label><br>
                            </div>
                                <div class="formAdm">
                                    <label for="" class="label-modal coment">Adicionar comentário <br>
                                    <form action="../teste.php" method="post">
                                        <!--------------AJEITAR ESSA PARTE NO FRONT, DEIXAR MAIS BONITINHA--------------->
                                        <textarea name="comentarioAdm" class="descModal" id="message" type="text" rows="3" placeholder="Digite seu comentário a respeito da denúncia."  data-sb-validations="required" ></textarea>
                                </div>
                                        <div class="modal-footer">
                                            <input type="submit"  class="btn btn-secondary" >
                                        </div>
                                    </form>
                                
                            </div>
                        </div>
                        </div>
                        <?php
                        }
                        ?>
                </table>
            </form>
        </div>

        <div id="resolvida" style="display: none">
            <h1 style="color: #064018;">Número de Denúncias resolvidas: <?php echo $resolvida[0]; ?> </h1>
                    <hr>

            <table class="table table-striped table-hover">
                <tr>
                    <th>Código</th>
                    <th>Categoria</th>
                    <th>Data</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Usuario</th>
                </tr>
                <?php
                        $tables = $adm->tabelaDenunciaResolvida();
                        foreach($tables as $dados){
                    ?>
                            <tr data-bs-toggle="modal" data-bs-target="#exampleModal3<?php echo $dados[0] ?>">
                            <td><?php echo $dados['pk_idDenuncia']; ?></td>
                            <td ><?php echo $dados['campoCategoria']; ?></td>
                            <td><?php echo $dados['dataDenuncia']; ?></td>
                            <td><?php echo $dados['ruaDenuncia']; ?></td>
                            <td><?php echo $dados['bairroDenuncia']; ?></td>
                            <td><?php echo $dados['emailUsuario']; ?></td>
                            </tr>
                            <div class="modal fade" id="exampleModal3<?php echo $dados[0]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            <img src="../imagens/logo.png" class="logo-update" alt="">
                            <h5 class="alterar-label">Dados da Denúncia</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="" class="label-modal">Código: <?php echo $dados[0]; ?></label><br>
                                <label for="" class="label-modal">Data: <?php echo $dados['dataDenuncia']; ?></label><br>
                                <label for="" class="label-modal">Título: <?php echo $dados['campoCategoria']; ?></label><br>
                                <label for="" class="label-modal">Título: <?php echo $dados['tituloDenuncia']; ?></label><br>
                                <div class="form-floating mb-3">
                                    <p><?php echo $dados['descDenuncia']; ?></p>
                                </div>
                                <div class="fotoDen">
                                    <label for="" class="label-modal titleImg">Imagem Denúncia: <br>
                                    <img class="imgDen" src="../cadastro/<?php echo $dados['imgDenuncia']; ?>" alt="">
                                </div>
                                <label for="" class="label-modal local"><?php echo $dados[8].",". $dados[6].",". $dados[9]." - ". $dados[5]; ?></label><br>
                            </div>
                                <div class="formAdm">
                                    <!--------AQUI TERÁ O COMENTÁRIO QUE FOI FEITO PELO ADM------------>
                                    <label for="" class="label-modal coment">Seu comentário <br>
                                    <p>MUDAR PARA O INNER JOIN COM O OCOMENTÁRIO DO ADM</p>
                                
                            </div>
                            </div>
                        </div>
                        </div>
                    <?php
                        }
                    ?>
            </table>
        </div>

        
        
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
		<script src="../javascript/index-adm.js"></script>
        <script src="../javascript/selecionar-denuncia.js"></script>
    </body>
</html>