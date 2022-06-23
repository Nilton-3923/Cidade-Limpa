<?php
    session_start();
    include_once("../session/valida-sentinela-adm.php");
    error_reporting(0);
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
        <form action="" method="post" > 
            <select name="txtRegiao" class="form-select form-select-sm" style="width: 400px; margin:5px;" aria-label=".form-select-sm example">
                <option value="todas" selected>Todas</option>
                <option value="Zona Norte">Zona Norte</option>
                <option value="Zona Sul">Zona Sul</option>
                <option value="Zona Leste">Zona Leste</option>
                <option value="Zona Oeste">Zona Oeste</option>
            </select>
            <div>
                <input class="btn btn-secondary" style="margin: 5px;" type="submit" value="Fitrar">
                <a href="pdfs/pdf-table-denuncia.php" class="btn btn-secondary">Vizualizar Pdf</a>
            </div>
           
            <br>
            <br>
        </form>
        <?php
        if(!isset($_POST['txtRegiao'])){ ?>
            <h5>Zona Norte</h5>
            <table class="table table-striped table-hover">
                <tr>
                    <th>id</th>
                    <th>Zona</th>
                    <th>Titulo</th>
                    <th>Data</th>
                    <th>Uf</th>
                    <th>Bairro</th>
                    <th>Cep</th>
                    <th>Rua</th>
                    <th>Cidade</th>
                    <th>Zona</th>
                    <th>Categoria</th>
                    <th>Usuario</th>

                </tr>
                    <?php 
                        require_once("../classe/Adm.php");
                        $adm = new Adm();
                        $regiao = "Zona Norte";
                        $tables1 = $adm->denunciaRegiao($regiao);
                        foreach($tables1 as $dados1){
                    ?>
                    <tr>
                        <td><?php echo $dados1['pk_idDenuncia']; ?></td>
                        <td><?php echo $dados1['zonaDenuncia']; ?></td>
                        <td><?php echo $dados1['tituloDenuncia']; ?></td>
                        <td><?php echo $dados1['dataDenuncia']; ?></td>
                        <td><?php echo $dados1['ufDenuncia']; ?></td>
                        <td><?php echo $dados1['bairroDenuncia']; ?></td>
                        <td><?php echo $dados1['cepDenuncia']; ?></td>
                        <td><?php echo $dados1['ruaDenuncia']; ?></td>
                        <td><?php echo $dados1['cidadeDenuncia']; ?></td>
                        <td><?php echo $dados1['zonaDenuncia']; ?></td>
                        <td><?php echo $dados1['campoCategoria']; ?></td>
                        <td><?php echo $dados1['emailUsuario']; ?></td>
                    </tr>
                    <?php
                    }
                ?>

            </table>

            <h5>Zona Leste</h5>
            <table class="table table-striped table-hover">
                <tr>
                    <th>id</th>
                    <th>Zona</th>
                    <th>Titulo</th>
                    <th>Data</th>
                    <th>Uf</th>
                    <th>Bairro</th>
                    <th>Cep</th>
                    <th>Rua</th>
                    <th>Cidade</th>
                    <th>Zona</th>
                    <th>Categoria</th>
                    <th>Usuario</th>

                </tr>
                    <?php 
                        require_once("../classe/Adm.php");
                        $adm = new Adm();
                        $regiao = "Zona Leste";
                        $tables2 = $adm->denunciaRegiao($regiao);
                        foreach($tables2 as $dados2){
                    ?>
                    <tr>
                        <td><?php echo $dados2['pk_idDenuncia']; ?></td>
                        <td><?php echo $dados2['zonaDenuncia']; ?></td>
                        <td><?php echo $dados2['tituloDenuncia']; ?></td>
                        <td><?php echo $dados2['dataDenuncia']; ?></td>
                        <td><?php echo $dados2['ufDenuncia']; ?></td>
                        <td><?php echo $dados2['bairroDenuncia']; ?></td>
                        <td><?php echo $dados2['cepDenuncia']; ?></td>
                        <td><?php echo $dados2['ruaDenuncia']; ?></td>
                        <td><?php echo $dados2['cidadeDenuncia']; ?></td>
                        <td><?php echo $dados2['zonaDenuncia']; ?></td>
                        <td><?php echo $dados2['campoCategoria']; ?></td>
                        <td><?php echo $dados2['emailUsuario']; ?></td>
                    </tr>
                    <?php
                    }
                ?>

            </table>

            <h5>Zona Sul</h5>
            <table class="table table-striped table-hover">
                <tr>
                    <th>id</th>
                    <th>Zona</th>
                    <th>Titulo</th>
                    <th>Data</th>
                    <th>Uf</th>
                    <th>Bairro</th>
                    <th>Cep</th>
                    <th>Rua</th>
                    <th>Cidade</th>
                    <th>Zona</th>
                    <th>Categoria</th>
                    <th>Usuario</th>

                </tr>
                    <?php 
                        require_once("../classe/Adm.php");
                        $adm = new Adm();
                        $regiao = "Zona Sul";
                        $tables3 = $adm->denunciaRegiao($regiao);
                        foreach($tables3 as $dados3){
                    ?>
                    <tr>
                        <td><?php echo $dados3['pk_idDenuncia']; ?></td>
                        <td><?php echo $dados3['zonaDenuncia']; ?></td>
                        <td><?php echo $dados3['tituloDenuncia']; ?></td>
                        <td><?php echo $dados3['dataDenuncia']; ?></td>
                        <td><?php echo $dados3['ufDenuncia']; ?></td>
                        <td><?php echo $dados3['bairroDenuncia']; ?></td>
                        <td><?php echo $dados3['cepDenuncia']; ?></td>
                        <td><?php echo $dados3['ruaDenuncia']; ?></td>
                        <td><?php echo $dados3['cidadeDenuncia']; ?></td>
                        <td><?php echo $dados3['zonaDenuncia']; ?></td>
                        <td><?php echo $dados3['campoCategoria']; ?></td>
                        <td><?php echo $dados3['emailUsuario']; ?></td>
                    </tr>
                    <?php
                    }
                ?>

            </table>

            <h5>Zona Oeste</h5>
            <table class="table table-striped table-hover">
                <tr>
                    <th>id</th>
                    <th>Zona</th>
                    <th>Titulo</th>
                    <th>Data</th>
                    <th>Uf</th>
                    <th>Bairro</th>
                    <th>Cep</th>
                    <th>Rua</th>
                    <th>Cidade</th>
                    <th>Zona</th>
                    <th>Categoria</th>
                    <th>Usuario</th>

                </tr>
                    <?php 
                        require_once("../classe/Adm.php");
                        $adm = new Adm();
                        $regiao = "Zona Oeste";
                        $tables4 = $adm->denunciaRegiao($regiao);
                        foreach($tables4 as $dados4){
                    ?>
                    <tr>
                        <td><?php echo $dados4['pk_idDenuncia']; ?></td>
                        <td><?php echo $dados4['zonaDenuncia']; ?></td>
                        <td><?php echo $dados4['tituloDenuncia']; ?></td>
                        <td><?php echo $dados4['dataDenuncia']; ?></td>
                        <td><?php echo $dados4['ufDenuncia']; ?></td>
                        <td><?php echo $dados4['bairroDenuncia']; ?></td>
                        <td><?php echo $dados4['cepDenuncia']; ?></td>
                        <td><?php echo $dados4['ruaDenuncia']; ?></td>
                        <td><?php echo $dados4['cidadeDenuncia']; ?></td>
                        <td><?php echo $dados4['zonaDenuncia']; ?></td>
                        <td><?php echo $dados4['campoCategoria']; ?></td>
                        <td><?php echo $dados4['emailUsuario']; ?></td>
                    </tr>
                    <?php
                    }
                ?>

            </table>
        <?php
        }else if($_POST['txtRegiao'] == "todas"){
            unset($_POST['txtRegiao']);
        }
        else{
        ?>
                        <table class="table table-striped table-hover">
                <tr>
                    <th>id</th>
                    <th>Zona</th>
                    <th>Titulo</th>
                    <th>Data</th>
                    <th>Uf</th>
                    <th>Bairro</th>
                    <th>Cep</th>
                    <th>Rua</th>
                    <th>Cidade</th>
                    <th>Zona</th>
                    <th>Categoria</th>
                    <th>Usuario</th>

                </tr>
                    <?php 
                        require_once("../classe/Adm.php");
                        $adm = new Adm();
                        $regiao = $_POST['txtRegiao'];
                        $tables = $adm->denunciaRegiao($regiao);
                        foreach($tables as $dados){
                    ?>
                    <tr>
                        <td><?php echo $dados['pk_idDenuncia']; ?></td>
                        <td><?php echo $dados['zonaDenuncia']; ?></td>
                        <td><?php echo $dados['tituloDenuncia']; ?></td>
                        <td><?php echo $dados['dataDenuncia']; ?></td>
                        <td><?php echo $dados['ufDenuncia']; ?></td>
                        <td><?php echo $dados['bairroDenuncia']; ?></td>
                        <td><?php echo $dados['cepDenuncia']; ?></td>
                        <td><?php echo $dados['ruaDenuncia']; ?></td>
                        <td><?php echo $dados['cidadeDenuncia']; ?></td>
                        <td><?php echo $dados['zonaDenuncia']; ?></td>
                        <td><?php echo $dados['campoCategoria']; ?></td>
                        <td><?php echo $dados['emailUsuario']; ?></td>
                    </tr>
                    <?php
                    }
                ?>

            </table>
        <?php
        }
        ?>
        
        
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
		<script src="../javascript/index-adm.js"></script>
    </body>
</html>