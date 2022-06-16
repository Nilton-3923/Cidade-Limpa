<?php
    session_start();
    include_once("../session/valida-sentinela-adm.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/index-adm.css">
    <link rel="stylesheet" href="css/table.css">
	<title>AdminSite</title>
</head>

	<body>
        <!-- SIDEBAR -->
        <section id="sidebar">
                <a href="index-adm-restrita.php" class="brand"><i class='bx bxs-smile icon'></i> Bem Vindo Adm</a>
                    <ul class="side-menu">
                        <li><a href="index-adm-restrita.php" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
                        <li class="divider" data-text="Principal">Principal</li>
                        <li><a href="index-adm-restrita.php"><i class='bx bxs-chart icon' ></i> Gráficos</a></li>
                        <li class="divider" data-text="Tabelas e Formulários">Tabelas e Formulários</li> 
                        <li>
                            <a href="#"><i class='bx bx-table icon' ></i> Tabelas <i class='bx bx-chevron-right icon-right' ></i></a>
                            <ul class="side-dropdown">
                                <li><a href="tabela-denuncia.php">Tabela Denúncias</a></li>
                                <li><a href="tabela-usuario.php">Tabela Usuários</a></li>
                                <li><a href="tabela-ecopontos.php">Tabela Ecopontos</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class='bx bxs-notepad icon' ></i> Formulários <i class='bx bx-chevron-right icon-right' ></i></a>
                            <ul class="side-dropdown">
                                <li><a href="cadastro-categoria.php">Cadastrar Categoria</a></li>
                                <li><a href="#">Cadastrar EcoPonto</a></li>
                            </ul>
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
        <?php 

            require_once("../classe/Adm.php");
            $adm = new Adm();
            $denuncias = $adm->denunciasNaoResolvidas();
            foreach($denuncias as $den){}
            if(!isset($_POST['limite']) || empty($_POST['limite'])){
                $limitar=$den[0];
            }
            else{
                $limitar = $_POST['limite'];
            }
            $tables = $adm->tabelaDenuncia($limitar);
        ?>
 
                <table border="1" class="table table-striped table-hover" style="width: 300px;">
                <H1>TABELA DE DENÚNCIAS</H1>
                <!-- Form Para Limitar Denúncias -->
                <form action="" method="post">
                    <select name="limite" id="">
                        <option selected value="<?php echo $den[0]; ?>">Limitar Tabela</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="<?php echo $den[0]; ?>">Tudo</option>
                        <input type="submit" value="Limitar">
                    </select>
                </form>
                <a href="pdfs/pdf-table-denuncia.php">Vizualizar Pdf</a>
                <tr>
                <th>id</th>
                    <th>Titulo</th>
                    <th>Descrição</th>
                    <th>Foto</th>
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
                        foreach($tables as $dados){
                    ?>
                    <tr>

                        <td><?php echo $dados['pk_idDenuncia']; ?></td>
                        <td><?php echo $dados['tituloDenuncia']; ?></td>
                        <td><?php echo $dados['descDenuncia']; ?></td>
                        <td><img src="../cadastro/<?php echo $dados['imgDenuncia']; ?>" alt="" style="width:150px"></td>
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

        
        
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
		<script src="../javascript/index-adm.js"></script>
    </body>
</html>