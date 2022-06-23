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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/index-adm.css">
    <link rel="stylesheet" href="../css/adm-formatacao.css">
	<title>Tabela - Cidade Limpa</title>
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
                <a href="pdfs/pdf-table-denuncia.php" class="btn btn-secondary">Vizualizar Pdf</a>
                
            
        </div>

        <div id="tudo">
            <h2>Todas as denúncias que foram feitas.</h2>
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
                        $tables = $adm->tabelaDenuncia();
                        foreach($tables as $dados){
                    ?>
                    <tr>
                    <td>
                        <?php echo $dados['pk_idDenuncia']; ?></td>
                        <td><?php echo $dados['campoCategoria']; ?></td>
                        <td><?php echo $dados['dataDenuncia']; ?></td>
                        <td><?php echo $dados['ruaDenuncia']; ?></td>
                        <td><?php echo $dados['bairroDenuncia']; ?></td>
                        <td><?php echo $dados['emailUsuario']; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
            </table>
        </div>

        <div id="Nao-Resolvida" style="display: none">
            <h2>Todas as denúncias que não foram resolvidas.</h2>

            <input type="checkbox" id="select-all">
            <label>Selecionar a porra toda</label>
            
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
                        <tr>
                            <td><?php echo $dados['pk_idDenuncia']; ?></td>
                            <td><?php echo $dados['campoCategoria']; ?></td>
                            <td><?php echo $dados['dataDenuncia']; ?></td>
                            <td><?php echo $dados['ruaDenuncia']; ?></td>
                            <td><?php echo $dados['bairroDenuncia']; ?></td>
                            <td><?php echo $dados['emailUsuario']; ?></td>
                            <td>
            
                                    <input  type="checkbox"
                                            name="id[]"
                                            value="<?php echo $dados['pk_idDenuncia']; ?>"
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

        <div id="resolvida" style="display: none">
            <h2>Todas as denúncias que foram resolvidas.</h2>

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
                            <tr>
                            <td><?php echo $dados['pk_idDenuncia']; ?></td>
                            <td><?php echo $dados['campoCategoria']; ?></td>
                            <td><?php echo $dados['dataDenuncia']; ?></td>
                            <td><?php echo $dados['ruaDenuncia']; ?></td>
                            <td><?php echo $dados['bairroDenuncia']; ?></td>
                            <td><?php echo $dados['emailUsuario']; ?></td>
                            </tr>
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