<?php
    session_start();
    include_once("../session/valida-sentinela-adm.php");
    require_once("../classe/Conexao.php");
    require_once("../classe/Ecoponto.php");

    $ecoponto = new Ecoponto();

    


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/index-adm.css">
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
                                <li><a href="tabela-categoria.php">Tabela Categorias</a></li>
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

        <form action="../cadastro/objeto-cadastro-ecoponto.php" method="post">

            <input type="text" placeholder="CEP" id="cep" name="cep">
            <input type="text" placeholder="Bairro" id="bairro" name="bairro">
            <input type="text" placeholder="Rua" id="rua" name="rua">
            <input type="text" placeholder="Cidade" id="cidade" name="cidade">
            <input type="text" placeholder="Uf" id="uf" name="uf">
            <input type="text" placeholder="Número" name="numero">
            <select name="regiao" id="regiao">
                <option disabled selected>Regiões de São Paulo</option>
                <option value="Zona Leste">Zona Leste</option>
                <option value="Zona Norte">Zona Norte</option>
                <option value="Zona Sul">Zona Sul</option>
                <option value="Zona Oeste">Zona Oeste</option>
            </select><br>

            <input type="submit" value="Cadastrar">


        </form>
        <h1>cadastro em lote</h1>
        <form action="../cadastro/cadastro-xml-ecopontos.php" method="post" enctype="multipart/form-data">
            <input type="file" name="arquivo">
            <input type="submit">
        </form>

        <?php
        $mostrar = $ecoponto ->ecopontosSemGeolocalizacao();
        
        foreach($mostrar as $row){
            $id = $row[0];
            
            $selecao = $ecoponto-> selecionarEcopontoParametro($id);
        
            foreach($selecao as $linha){
                $localizacao = $ecoponto->geolocalizacaoExcel($linha[8], $linha[5], $linha[3],$linha[2], $linha[1]);
                $ecoponto->alterarLocalizacao($localizacao, $linha[0]);
            }

            
        }
        
        ?>

        <span id="mensagem"></span>
        <script src="../javascript/api-cep.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
		<script src="../javascript/index-adm.js"></script>
    </body>
</html>