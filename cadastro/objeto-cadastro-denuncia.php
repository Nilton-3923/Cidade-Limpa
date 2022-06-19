<?php 
    require_once("../classe/Conexao.php");
    require_once("../classe/Denuncia.php");
    require_once("../classe/Categoria.php");

    session_start();

    //Criação de um Objeto Denuncia
    //Cadastro da Foto da Denuncia
    $nomeImagem = $_FILES['fotoDenuncia']['name'];
    $arquivoImagem = $_FILES['fotoDenuncia']['tmp_name'];

    $caminhoImagem = "imgDenuncia/".$nomeImagem;
    move_uploaded_file($arquivoImagem,$caminhoImagem);

    $denuncia = new Denuncia();

    $denuncia->setTituloDenuncia($_POST['txtTituloDenuncia']); 
    $denuncia->setDescDenuncia($_POST['txtDenuncia']);
    $denuncia->setImagemDenuncia($caminhoImagem);

    $denuncia->setCepDenuncia($_POST['txtCepDenuncia']);
    $denuncia->setBairroDenuncia($_POST['txtBairroDenuncia']);
    $denuncia->setRuaDenuncia($_POST['txtRuaDenuncia']);
    $denuncia->setCidadeDenuncia($_POST['txtCidadeDenuncia']);
    $denuncia->setUfDenuncia($_POST['txtUfDenuncia']);
    $denuncia-> setNumero($_POST['txtNumeroDenuncia']);
    $denuncia->setZonaDenuncia($_POST['regiao']);
    
    date_default_timezone_set('America/Sao_Paulo');
    $denuncia->setDataDenuncia(date('d/m/Y'));
    $denuncia->setIdUsuario($_POST['txtIdUsuario']);
    
    $denuncia->setIdCategoria($_POST['txtCategoria']);


    echo $denuncia->denunciar($denuncia);
    
    $_SESSION['msgDenunciaCriada'] = TRUE; 
    
    header("Location:../area-restrita-usuario/index-restrita.php");

?>