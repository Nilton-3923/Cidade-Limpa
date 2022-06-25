<?php
    session_start();
    include_once("../session/valida-sentinela-adm.php");
    error_reporting(0);

    require_once("../classe/Adm.php");
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
    <link rel="stylesheet" href="../css/reset.css">

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
                                <li><a href="tabela-denuncia.php">Lista Denúncias</a></li>
                                <li><a href="tabela-denuncias-regiao.php">Denúncias por Região</a></li>
            
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class='bx bx-user icon' ></i> Usuário <i class='bx bx-chevron-right icon-right' ></i></a>
                            <ul class="side-dropdown">
                                <li><a href="tabela-usuario.php">Lista Usuários</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class='bx bxs-notepad icon' ></i> Ecopontos <i class='bx bx-chevron-right icon-right' ></i></a>
                            <ul class="side-dropdown">
                                <li><a href="tabela-ecopontos.php">Lista Ecopontos</a></li>
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
<style>
    h5{
        margin: 20px;
    }
</style>
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
        </div>
            <select name="txtRegiao" class="form-select form-select-sm" style="width: 400px; margin:5px;" aria-label=".form-select-sm example" id="selectRegiao" onChange="selecionarRegiao()">
                <option value="0">Todas</option>
                <option value="1">Zona Norte</option>
                <option value="2">Zona Sul</option>
                <option value="3">Zona Leste</option>
                <option value="4">Zona Oeste</option>
            </select>
            <div>
                <a href="pdfs/pdf-table-denuncia.php" class="btn btn-secondary">Vizualizar Pdf</a>
            </div>
           

            <div id="norte" style="display:none">
                <h5>Zona Norte</h5>
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
                            $regiao = "Zona Norte";
                            $tables1 = $adm->denunciaRegiao($regiao);
                            foreach($tables1 as $dados){
                        ?>
                        <tr>
                            <td><?php echo $dados['pk_idDenuncia']; ?></td>
                            <td><?php echo $dados['campoCategoria']; ?></td>
                            <td><?php echo $dados['dataDenuncia']; ?></td>
                            <td><?php echo $dados['ruaDenuncia']; ?></td>
                            <td><?php echo $dados['bairroDenuncia']; ?></td>
                            <td><?php echo $dados['emailUsuario']; ?></td>
                        </tr>
                            <?php }?>
                </table>
            </div>

            <div id="leste" style="display:none">
                <h5>Zona Leste</h5>
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
                            $regiao = "Zona Leste";
                            $tables2 = $adm->denunciaRegiao($regiao);
                            foreach($tables2 as $dados){
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

            <div id="sul" style="display:none">
                <h5>Zona Sul</h5>
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
                            $regiao = "Zona Sul";
                            $tables3 = $adm->denunciaRegiao($regiao);
                            foreach($tables3 as $dados){
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

            <div id="oeste" style="display:none">
                <h5>Zona Oeste</h5>
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
                            $regiao = "Zona Oeste";
                            $tables4 = $adm->denunciaRegiao($regiao);
                            foreach($tables4 as $dados4){
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
            
        

        <div id="tudo">
            <h5>Todas as denúncias</h5>
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
            
                            $regiao = $_POST['txtRegiao'];
                            $tables = $adm->denunciaRegiao($regiao);
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
        <script src="../javascript/selecionar-denuncia-regiao.js"></script>
		<script src="../javascript/index-adm.js"></script>
    </body>
</html>