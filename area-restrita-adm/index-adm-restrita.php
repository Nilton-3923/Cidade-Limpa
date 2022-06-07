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
	<link rel="stylesheet" href="../css/index-adm.css">
	<title>AdminSite</title>
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
                            $corZona = '#5344A9';
                        }
                        else if($zonas[1] == "Zona Norte"){
                            $corZona = '#330000';
                        }
                        else if($zonas[1] == "Zona Oeste"){
                            $corZona = '#336666';
                        }
                        else if($zonas[1 == "Zona Sul"]){
                            $corZona = '#0099cc';
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
			<div class="ads">
				<div class="wrapper">
					<a href="#" class="btn-upgrade">Upgrade</a>
					<p>Become a <span>PRO</span> member and enjoy <span>All Features</span></p>
				</div>
			</div>
		</section>
		<!-- SIDEBAR -->

		<!-- NAVBAR -->
		<section id="content">
			<!-- NAVBAR -->
			<nav>
				<i class='bx bx-menu toggle-sidebar' ></i>
				<form action="#">
					<div class="form-group">
						<input type="text" placeholder="Search...">
						<i class='bx bx-search icon' ></i>
					</div>
				</form>
				<a href="#" class="nav-link">
					<i class='bx bxs-bell icon' ></i>
					<span class="badge">5</span>
				</a>
				<a href="#" class="nav-link">
					<i class='bx bxs-message-square-dots icon' ></i>
					<span class="badge">8</span>
				</a>
				<span class="divider"></span>
				<div class="profile">
					<img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
					<ul class="profile-link">
						<li><a href="#"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
						<li><a href="#"><i class='bx bxs-cog' ></i> Settings</a></li>
						<li><a href="#"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
					</ul>
				</div>
			</nav>
			<!-- NAVBAR -->

			<!-- MAIN -->
			<main>
				<!-- MÉTODOS PARA USAR NOS CARDS -->
				<?php
					$quantidadeUsers = $adm->contarUsersAtivos();
					$usersTotal = $adm->contarUsers();
					
				?>
				<h1 class="title">Dashboard</h1>
				<ul class="breadcrumbs">
					<li><a href="#">Home</a></li>
					<li class="divider">/</li>
					<li><a href="#" class="active">Dashboard</a></li>
				</ul>
				<div class="info-data">
				<!-- CARD 1- USUÁRIOS ATIVOS -->
					<div class="card">
						<div class="head">
							<div>
								<?php
									foreach($usersTotal as $total){}
									foreach($quantidadeUsers as $contar){
										$porcentagem=$total[0]-$contar[0];
										if($porcentagem == 0){
											$porcentagem = '100';
										}else{
											$porcentagem = $porcentagem/$total[0];
											$porcentagem = $porcentagem*100;
											$porcentagem = 100-$porcentagem;
											$porcentagem = number_format($porcentagem, 2, '.', '');
										}
								?>
								<h2>Usuários Ativos</h2>
								<p><?php echo $contar[0]." de ".$total[0]; ?></p>
								<?php
									}
								?>
							</div>

							<i class='bx bx-trending-up icon' ></i>
						</div>
						<span class="progress" data-value="<?php echo $porcentagem ?>%"></span>
						<span class="label"><?php echo $porcentagem ?>%</span>
					</div>
					<!-- CARD-2 DENÚNCIAS RESOLVIDAS -->
					<div class="card">
						<div class="head">
							<div>
								<?php 	

										$soma= $num[0] + $linha[0];
										$porcentagem2 = $soma - $linha[0];
										if($porcentagem2 == 0){
											$porcentagem2 = '100';
										}else{
											$porcentagem2 = $porcentagem2/$soma;
											$porcentagem2 = $porcentagem2*100;
											$porcentagem2 = 100-$porcentagem2;
											$porcentagem2 = number_format($porcentagem2, 2, '.', '');
										}
								
								?>
								<h2>Resolvidas <?php echo $linha[0];?></h2>
								<p>Denúncias Resolvidas <?php echo $linha[0]." de ".$soma; ?></p>
							</div>
							<i class='bx bx-trending-down icon down' ></i>
						</div>
						<span class="progress" data-value="<?php echo $porcentagem2; ?>%"></span>
						<span class="label"><?php echo $porcentagem2; ?>%</span>
					</div>

					<!-- CARD 3- DENÚNCIAS NÃO RESOLVIDAS -->
					<div class="card">
						<div class="head">
							<div>
								<h2>Não Resolvidas</h2>
								<p>Denúncias não resolvidas <?php echo $num[0]." de ".$soma; ?></p>
							</div>
							<i class='bx bx-trending-up icon' ></i>
						</div>
						<?php 	

										$soma= $num[0] + $linha[0];
										$porcentagem3 = $soma - $num[0];
										if($porcentagem3 == 0){
											$porcentagem3 = '100';
										}else{
											$porcentagem3 = $porcentagem3/$soma;
											$porcentagem3 = $porcentagem3*100;
											$porcentagem3 = 100-$porcentagem3;
											$porcentagem3 = number_format($porcentagem3, 2, '.', '');
										}
								
						?>
						<span class="progress" data-value="<?php echo $porcentagem3; ?>%"></span>
						<span class="label"><?php echo $porcentagem3; ?>%</span>
					</div>
					<div class="card">
						<div class="head">
							<div>
								<h2>Total de Denúncias: <?php echo $soma; ?></h2>
								<p>Total de Denúncias já feitas</p>
							</div>
							<i class='bx bx-trending-up icon' ></i>
						</div>

					</div>
				</div>
				<div class="data">
					<div class="content-data">
						<div class="head">
							<h3>Sales Report</h3>
							<div class="menu">
								<i class='bx bx-dots-horizontal-rounded icon'></i>
								<ul class="menu-link">
									<li><a href="pdf/grafico1.php">PDF</a></li>
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
							<h3>Chatbox</h3>
							<div class="menu">
								<i class='bx bx-dots-horizontal-rounded icon'></i>
								<ul class="menu-link">
									<li><a href="#">Edit</a></li>
									<li><a href="#">Save</a></li>
									<li><a href="#">Remove</a></li>
								</ul>
							</div>
						</div>
						<div class="chat-box">
							<p class="day"><span>Today</span></p>
							<div class="msg">
								<img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
								<div class="chat">
									<div class="profile">
										<span class="username">Alan</span>
										<span class="time">18:30</span>
									</div>
									<p>Hello</p>
								</div>
							</div>
							<div class="msg me">
								<div class="chat">
									<div class="profile">
										<span class="time">18:30</span>
									</div>
									<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque voluptatum eos quam dolores eligendi exercitationem animi nobis reprehenderit laborum! Nulla.</p>
								</div>
							</div>
							<div class="msg me">
								<div class="chat">
									<div class="profile">
										<span class="time">18:30</span>
									</div>
									<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, architecto!</p>
								</div>
							</div>
							<div class="msg me">
								<div class="chat">
									<div class="profile">
										<span class="time">18:30</span>
									</div>
									<p>Lorem ipsum, dolor sit amet.</p>
								</div>
							</div>
						</div>
						<form action="#">
							<div class="form-group">
								<input type="text" placeholder="Type...">
								<button type="submit" class="btn-send"><i class='bx bxs-send' ></i></button>
							</div>
						</form>
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
							<h3>i</h3>
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
