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
    <link rel="stylesheet" href="../css/cadastro-ecoponto.css">
    <link rel="stylesheet" href="../css/reset.css">


	<title>Categoria - Cidade Limpa</title>
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

            <h2>Cadastrar nova Categoria</h2>
            <form action="../CRUD/objeto-salvar-categoria.php" method="post"> 
                <input type="hidden" name="pk_idCategoria" value="<?php echo @$_GET['pk_idCategoria'];?>" >
                <div class="form-floating">
                    <input type="text" value="<?php echo @$_GET['campoCategoria']; ?>" name="txtCategoria" placeholder="Digite o nome da Categoria..." class="form-control input-normal">
                    <label for="floatingInput">Categoria</label>
                </div>
                <div>
                    <input type="submit" class="btn btn-secondary" value="cadastrar">
                    <a href="pdfs/pdf-table-categoria.php" class="btn btn-secondary" target="_blank">Vizualizar PDF</a>
                </div>
                    
            </form>
            <?php 

            require_once("../classe/Adm.php");
            $adm = new Adm();
            $tables = $adm->tabelaCategoria();
            ?>

            <h1>TABELA DE CATEGORIAS</h1>
            <table class="table table-striped table-hover" style="width:60%; margin: auto;">
                <tr>
                    <th>Código</th>
                    <th>Categoria</th>
                    <th>Excluir</th>
                    <th>Alterar</th>
                </tr>
                <?php 
                foreach($tables as $dados){
                ?>
                    <tr>
                        <td><?php echo $dados['pk_idCategoria']; ?></td>
                        <td><?php echo $dados['campoCategoria']; ?></td>      
                        <td><a class="deletar" href="../CRUD/objeto-deletar-categoria.php?pk_idCategoria=<?php echo $dados['pk_idCategoria'];?>">Deletar</a></td>
                        <td><a class="alterar" href="?pk_idCategoria=<?php echo $dados['pk_idCategoria'];?>&campoCategoria=<?php echo $dados['campoCategoria']; ?>">Alterar</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
		<script src="../javascript/index-adm.js"></script>
    </body>
</html>