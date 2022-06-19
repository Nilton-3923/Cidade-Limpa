<?php
    session_start();
    include_once("../session/valida-sentinela-adm.php");

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
                                <li><a href="cadastro-ecoponto.php">Cadastrar EcoPonto</a></li>
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
            $usuarios = $adm->contarUsers();
            foreach($usuarios as $u){}
            if(!isset($_POST['limite']) || empty($_POST['limite'])){
                $limitar=$u[0];
            }
            else{
                $limitar = $_POST['limite'];
            }
            $tables = $adm->tabelaUsuario($limitar);
        ?>

        <div>
            <h1>TABELA DE USUÁRIOS</h1>
            <!-- Form Para Limitar Denúncias -->
            <form action="" method="post">
                <select name="limite" id="" class="select-normal form-select form-select-sm"  aria-label=".form-select-sm example">
                    <option selected value="">Limitar Tabela</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="<?php echo $u[0]; ?>">Tudo</option>
                    <input type="submit" value="Limitar">
                </select>
            </form>
            <a href="pdfs/pdf-table-usuario.php">Vizualizar Pdf</a>
        </div>


        <table class="table table-striped table-hover">
            <tr>
                <th>id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Cep</th>
            </tr>
                <?php 
                    foreach($tables as $dados){
                ?>
                <tr>

                    <td><?php echo $dados['pk_Usuario']; ?></td>
                    <td><?php echo $dados['nomeUsuario']; ?></td>
                    <td><?php echo $dados['emailUsuario']; ?></td>   
                    <td><?php echo $dados['cepUsuario']; ?></td>           
                </tr>
                <?php
                }
            ?>
        </table>
        
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
		<script src="../javascript/index-adm.js"></script>
    </body>
</html>