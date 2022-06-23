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
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/index-adm.css">
	<link rel="stylesheet" href="../css/adm-formatacao.css">

	<title>Dashboard - Cidade Limpa</title>
    <link rel="shortcut icon" href="../imagens/reciclagem.png" type="image/x-icon">
</head>
	<body>

	<?php
		require_once("../classe/Conexao.php");
		require_once("../classe/Adm.php");
		$adm = new Adm();

		$categoria = $adm->filtroCategoria();
	?>
	<!-- ********************SCRIPT DOS GRÁFICOS************************** -->
	<!-- Gráfico-1 categorias -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	google.charts.load("current", {packages:['corechart']});
	google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
		var data = google.visualization.arrayToDataTable([
		["Element", "Denúncias", { role: "style" } ],
		<?php
			foreach($categoria as $listaCat){

				//Verificação das Cores de cada Barra do Grafico
			if($listaCat['campoCategoria'] == 'Descarte Irregular de Lixo' && $listaCat[0]>5 || $listaCat['campoCategoria'] == 'Casos de Dengue' && $listaCat[0]>5){
					$cor = '#cd0000';
			}
			else if($listaCat['campoCategoria'] == 'Descarte Irregular de Lixo' && $listaCat[0]>3 || $listaCat['campoCategoria'] == 'Casos de Dengue' && $listaCat[0]>3){
					$cor = '#ff6d2a';
			}
			else if($listaCat['campoCategoria'] == 'Descarte Irregular de Lixo'){
					$cor = '#016064';
			}
			else if($listaCat['campoCategoria'] == 'EcoPontos'){
					$cor = '#29d629';
			}
			else if($listaCat['campoCategoria'] == 'Casos de Dengue'){
					$cor = '#757c88';
			}else{
				$cor = '#599bd4';
			}
			?>
			["<?php echo $listaCat['campoCategoria']; ?>", <?php echo $listaCat[0] ?>, "<?php echo $cor; ?>"],
			<?php } ?>
			]);

			var view = new google.visualization.DataView(data);
			view.setColumns([0, 1,
			{ calc: "stringify",
			sourceColumn: 1,
			type: "string",
			role: "annotation" },
			2]);

			var options = {
				title: "",
				width: 560,
				height: 300,
				bar: {groupWidth: "50%"},
				legend: { position: "none" },
			};
			var chart = new google.visualization.ColumnChart(document.getElementById("grafico1"));
			chart.draw(view, options);
			}
	</script>
<!-- FIM SCRIP GRÁFICO-1 CATEGORIAS -->
<!-- *********************GRÁFICO-2 DENÚNCIAS OIR************************ -->
<?php
				$contagem = $adm->contagem();
				$naoResolvidas = $adm->denunciasNaoResolvidas();
			?>
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
			google.charts.load("current", {packages:["corechart"]});
			google.charts.setOnLoadCallback(drawChart);
				function drawChart() {
				var data = google.visualization.arrayToDataTable([
					['Task', 'Hours per Day'],
					<?php
						foreach($naoResolvidas as $num){
					?>
						['Não Resolvidas', <?php echo $num[0]; ?>],
					<?php } 
						foreach($contagem as $linha){
					?>
						['Resolvidas',<?php echo $linha[0]; ?>]
					<?php } ?>
					]);

					var options = {
						title: '',
						is3D: true,
						};

					var chart = new google.visualization.PieChart(document.getElementById('grafico2'));
						chart.draw(data, options);
					}
				</script>
		

			<!-- FIM DO SEGUNDO PARAGRAFO -->
			<!-- *****************GRÁFICO-3 POR ZONA********************** -->
			<?php 
                $zona = $adm->filtrozona();
            ?>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load("current", {packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Element", "Quantidade de Denúncias: ", { role: "style" } ],
                    <?php foreach($zona as $zonas){
                        //Verificar Cores
                        if($zonas[1] == "Zona Leste"){
                            $corZona = '#3944bc';
                        }
                        else if($zonas[1] == "Zona Norte"){
                            $corZona = '#59788e';
                        }
                        else if($zonas[1] == "Zona Oeste"){
                            $corZona = '#016064';
                        }
                        else if($zonas[1 == "Zona Sul"]){
                            $corZona = '#151e3d';
                        }
                        else{
                            $corZona = "#52b2bf";
                        }
                        ?>
                    ["<?php echo $zonas[1]; ?>", <?php echo $zonas[0]; ?>, "<?php echo $corZona ?>"],
                    <?php } ?>
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                                { calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation" },
                                2]);

                var options = {
                    title: "",
					width: 450,
					height: 300,
					bar: {groupWidth: "50%"},
					legend: { position: "none" },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("grafico3"));
                chart.draw(view, options);
            }
            </script>
			
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
			<!-- NAVBAR -->

			<!-- MAIN -->
			<main>
				<!-- MÉTODOS PARA USAR NOS CARDS -->
				<?php
					$usersTotal = $adm->contarUsers();
					
				?>
				<h1 class="title">Área do Adm</h1>
				<ul class="breadcrumbs">
					<li><a href="#">Home</a></li>
					<li class="divider">/</li>
					<li><a href="#" class="active">Gráficos</a></li>
				</ul>
				<div class="info-data">
				<!-- CARD 1- USUÁRIOS -->
					<div class="card">
						<div class="head">
							<div>
								<?php
									foreach($usersTotal as $u){
								?>
								<h2>Total de Usuários <?php echo $u[0]; ?></h2>
								<p>Usuários Cadastrados</p>
							</div>
								<?php 
									}
								?>

							<!-- <i class='bx bx-trending-up icon' ></i> -->
						</div>
		
					</div>
					<!-- CARD-2 TOTAL DE DENÚNCIAS -->
					<div class="card">
						<div class="head">
							<div>
								<?php
									$soma= $num[0] + $linha[0];//Soma de todas as denúncias já feitas
								?>
								<h2>Total de Denúncias: <?php echo $soma; ?></h2>
								<p>Total de Denúncias já feitas</p>
							</div>
							<!-- <i class='bx bx-trending-up icon' ></i> -->
						</div>

					</div>
					<!-- CARD-3 DENÚNCIAS RESOLVIDAS -->
					<div class="card">
						<div class="head">
							<div>
								<?php 				
									//Fazendo conta da Porcentagem
									$porcentagemResolvidas= $soma - $linha[0];
									if($porcentagemResolvidas== 0){
										$porcentagemResolvidas= '100';
									}else{
										$porcentagemResolvidas= $porcentagemResolvidas/$soma;
										$porcentagemResolvidas= $porcentagemResolvidas*100;
										$porcentagemResolvidas= 100-$porcentagemResolvidas;
										$porcentagemResolvidas= number_format($porcentagemResolvidas, 2, '.', '');
									}
								
								?>
								<h2>Denúncias resolvidas <?php echo $linha[0];?></h2>
								<p>Denúncias que já foram atendidas: <?php echo $linha[0]; ?></p>
							</div>
							<!-- <i class='bx bx-trending-down icon down' ></i> -->
						</div>
						<span class="progress" data-value="<?php echo $porcentagemResolvidas; ?>%"></span>
						<span class="label"><?php echo $porcentagemResolvidas; ?>%</span>
					</div>

					<!-- CARD 4- DENÚNCIAS NÃO RESOLVIDAS -->
					<div class="card">
						<div class="head">
							<div>
								<h2>Denúncias não resolvidas: <?php echo $num[0];?></h2>
								<p>Denúncias que ja foram atendidas: <?php echo $num[0];?></p>
							</div>
							<!-- <i class='bx bx-trending-up icon' ></i> -->
						</div>
						<?php 	
							//Fazendo conta da Porcentagem
							$porcentagensNaoResolvidas = $soma - $num[0];
							if($porcentagensNaoResolvidas == 0){
								$porcentagensNaoResolvidas = '100';
							}else{
								$porcentagensNaoResolvidas = $porcentagensNaoResolvidas/$soma;
								$porcentagensNaoResolvidas = $porcentagensNaoResolvidas*100;
								$porcentagensNaoResolvidas = 100-$porcentagensNaoResolvidas;
								$porcentagensNaoResolvidas = number_format($porcentagensNaoResolvidas, 2, '.', '');
							}
								
						?>
						<span class="progress" data-value="<?php echo $porcentagensNaoResolvidas; ?>%"></span>
						<span class="label"><?php echo $porcentagensNaoResolvidas; ?>%</span>
					</div>
	
				</div>
				<div class="data">
					<div class="content-data"> 
						<div class="head">
							<h3>Quantidade de denúnicias feitas por Categoria</h3>
							<div class="menu">
								<i class='bx bx-dots-horizontal-rounded icon'></i>
								<ul class="menu-link">
									<li><a href="pdfs/pdf-table-categoria.php">PDF</a></li>
								</ul>
							</div>
						</div>
						<div class="chart">
							<div id="grafico1" style="width: 550px; height: 300px;"></div>
						</div>
					</div>
			
					<div class="content-data">
						<div class="head">
							<h3>Últimos Usuários cadastrados</h3>
							<div class="menu">
								<i class='bx bx-dots-horizontal-rounded icon'></i>
								<ul class="menu-link">
									<li><a href="pdfs/pdf-table-usuario.php">PDF</a></li>
								</ul>
							</div>
						</div>	

						<table class="table table-striped table-hover">
							<tr class="tr">
								<th>Nome</th>
								<th>Email</th>
								<th>CEP</th>
							</tr>
							<tr>
								<?php
									$ultimosUsers = $adm->ultimosUsers();
									foreach($ultimosUsers as $ultimos){
								?>
								<tr>
									<td><?php echo $ultimos['nomeUsuario']; ?></td>
									<td><?php echo $ultimos['emailUsuario']; ?></td>
									<td><?php echo $ultimos['cepUsuario']; ?></td>
								</tr>

								<?php
									}
								?>

							</tr>
						</table>
						
						
						
					</div>
					<div class="content-data">
						<div class="head">
							<h3>Denúncias atendidas</h3>
							<div class="menu">
								<i class='bx bx-dots-horizontal-rounded icon'></i>
								<ul class="menu-link">
									<li><a href="pdfs/pdf-grafico3.php">PDF</a></li>
								</ul>
							</div>
						</div>
						<div class="chart">
							<div id="grafico2" style="width: 550px; height: 300px;"></div>
						</div>
					</div>
					<div class="content-data">
						<div class="head">
							<h3>Quantidade de denúnicias feitas por regiões</h3>
							<div class="menu">
								<i class='bx bx-dots-horizontal-rounded icon'></i>
								<ul class="menu-link">
									<li><a href="pdfs/pdf-grafico4.php">PDF</a></li>
								</ul>
							</div>
						</div>
						<div class="chart">
							<div id="grafico3" style="width: 200px; height: 300px;"></div>
						</div>
					</div>

						
				</div>
			</main>
			<!-- MAIN -->
		</section>
		<!-- NAVBAR -->

		<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
		<script src="../javascript/index-adm.js"></script>
	</body>
</html>
