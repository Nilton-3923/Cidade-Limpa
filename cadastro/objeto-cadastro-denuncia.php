<?php 
    require_once("../classe/Conexao.php");
    require_once("../classe/Denuncia.php");
    require_once("../classe/Categoria.php");

    //Criação de um Objeto Denuncia

    $denuncia = new Denuncia();

    $denuncia->setTituloDenuncia($_POST['txtTituloDenuncia']); 
    $denuncia->setDescDenuncia($_POST['txtDenuncia']);

    $denuncia->setCepDenuncia($_POST['txtCepDenuncia']);
    $denuncia->setBairroDenuncia($_POST['txtBairroDenuncia']);
    $denuncia->setRuaDenuncia($_POST['txtRuaDenuncia']);
    $denuncia->setCidadeDenuncia($_POST['txtCidadeDenuncia']);
    $denuncia->setUfDenuncia($_POST['txtUfDenuncia']);
    $denuncia-> setNumero($_POST['txtNumeroDenuncia']);
    
    
    $denuncia->setDataDenuncia($_POST['txtDtDenuncia']);
    $denuncia->setIdUsuario($_POST['txtIdUsuario']);
    
    $denuncia->setIdCategoria($_POST['txtCategoria']);

     
    echo $denuncia->denunciar($denuncia);

    header("Location:../area-restrita-usuario/index-restrita.php"); 

    //header ("Location: ../area-restrita-usuario/index-restrita.php");
?>