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
	<link rel="stylesheet" href="../css/index-adm.css">
	<title>Admin</title>
</head>
	<body class="center full-screen">

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
					$cor = '#4040ff';
			}
			else if($listaCat['campoCategoria'] == 'EcoPontos'){
					$cor = '#29d629';
			}
			else if($listaCat['campoCategoria'] == 'Casos de Dengue'){
					$cor = '#F2CB05';
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
                            $corZona = '#04BF9D';
                        }
                        else if($zonas[1] == "Zona Norte"){
                            $corZona = '#F28157';
                        }
                        else if($zonas[1] == "Zona Oeste"){
                            $corZona = '#BF665E';
                        }
                        else if($zonas[1 == "Zona Sul"]){
                            $corZona = '#253659';
                        }
                        else{
                            $corZona = "#8000b0";
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
		<!--
		<section id="sidebar">
			<a href="#" class="brand"><i class='bx bxs-smile icon'></i> AdminSite</a>
			<ul class="side-menu">
				<li><a href="#" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
				<li class="divider" data-text="main">Main</li>
				<li>
					<a href="#"><i class='bx bxs-inbox icon' ></i> Elements <i class='bx bx-chevron-right icon-right' ></i></a>
					<ul class="side-dropdown">
						<li><a href="#">Alert</a></li>
						<li><a href="#">Badges</a></li>
						<li><a href="#">Breadcrumbs</a></li>
						<li><a href="#">Button</a></li>
					</ul>
				</li>
				<li><a href="#"><i class='bx bxs-chart icon' ></i> Charts</a></li>
				<li><a href="#"><i class='bx bxs-widget icon' ></i> Widgets</a></li>
				<li class="divider" data-text="table and forms">Table and forms</li> 
				<li><a href="#"><i class='bx bx-table icon' ></i> Tables</a></li>
				<li>
					<a href="#"><i class='bx bxs-notepad icon' ></i> Forms <i class='bx bx-chevron-right icon-right' ></i></a>
					<ul class="side-dropdown">
						<li><a href="#">Basic</a></li>
						<li><a href="#">Select</a></li>
						<li><a href="#">Checkbox</a></li>
						<li><a href="#">Radio</a></li>
					</ul>
				</li>
			</ul>
		</section>
		-->
		<!-- SIDEBAR -->

		<!-- NAVBAR -->
		<section class="flex-row" id="content">
		
			<div id="barraLateral" class="barra-lateral center">
				<div class="ajuste-btn-barra-lateral">
					<div onClick="abrirBarraLateral()" class="btn-barra-lateral">
						<div class="one"></div>
						<div class="two"></div>
						<div class="three"></div>
					</div>
				</div>

				<div id="links"class="links">
					<a href="#">LINK</a>
					<a href="#">LINK</a>
					<a href="#">LINK</a>
					<a href="#">SAIR</a>
				</div>
			</div>

			<!-- MAIN -->
			<main>

				<h1 class="title">Gráficos</h1>
				<div class="info-data">

				<!--CARD TOTAL DE USUARIOS-->
					<div class="card">
						<div class="head">
							<div>
							<?php
								#MÉTODOS PARA USAR NOS CARDS
								$quantidadeUsers = $adm->contarUsers();
								foreach($quantidadeUsers as $contar){
							
									echo "<h2>$contar[0]</h2>";
									echo "<p>Usuários Ativos</p>";
								}
							?>
							</div>
						</div>
					</div>

					<!--CARD TOTAL DE DENUNCIAS-->
					<div class="card">
						<div class="head">
							<div>
							<?php
								$totalDenuncia = $adm->contarTotalDenuncias(); 

								foreach($totalDenuncia as $row){
									echo "<h2>$row[0]</h2>";
									echo "<p>Total de denúncias feitas</p>";
								}
							?>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="head">
							<div>
								<h2>465</h2>
								<p>Pageviews</p>
							</div>
							<i class='bx bx-trending-up icon' ></i>
						</div>
						<span class="progress" data-value="30%"></span>
						<span class="label">30%</span>
					</div>
					<div class="card">
						<div class="head">
							<div>
								<h2>235</h2>
								<p>Visitors</p>
							</div>
							<i class='bx bx-trending-up icon' ></i>
						</div>
						<span class="progress" data-value="80%"></span>
						<span class="label">80%</span>
					</div>
				</div>
				<div class="data">
					<div class="content-data">
						<div class="head">
							<h3>Sales Report</h3>
							<div class="menu">
								<i class='bx bx-dots-horizontal-rounded icon'></i>
								<ul class="menu-link">
									<li><a href="#">Edit</a></li>
									<li><a href="#">Save</a></li>
									<li><a href="#">Remove</a></li>
								</ul>
							</div>
						</div>
						<div class="chart">
							<div id="grafico1" style="width: 500px; height: 300px;"></div>
						</div>
					</div>

					<div class="content-data">
						<div class="head">
							<h3>Denúncias atendidas</h3>
							<div class="menu">
								<i class='bx bx-dots-horizontal-rounded icon'></i>
								<ul class="menu-link">
									<li><a href="#">Edit</a></li>
									<li><a href="#">Save</a></li>
									<li><a href="#">Remove</a></li>
								</ul>
							</div>
						</div>
						<div class="chart">
							<div id="grafico2" style="width: 500px; height: 300px;"></div>
						</div>
					</div>
					<div class="content-data">
						<div class="head">
							<h3>Gráfico de denúncia feitas nas regiões de São Paulo</h3>
							<div class="menu">
								<i class='bx bx-dots-horizontal-rounded icon'></i>
								<ul class="menu-link">
									<li><a href="#">Edit</a></li>
									<li><a href="#">Save</a></li>
									<li><a href="#">Remove</a></li>
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
