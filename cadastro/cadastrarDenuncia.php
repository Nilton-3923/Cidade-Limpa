<?php 
    require_once("../classe/Conexao.php");
    require_once("../classe/Denuncia.php");

    //Criação de um Objeto Denuncia

    $denuncia = new Denuncia();

    $denuncia->setDescDenuncia($_POST['txtDenuncia']);
    $denuncia->setTituloDenuncia($_POST['txtTituloDenuncia']);
    $denuncia->setDataDenuncia($_POST['txtDtDenuncia']);
    $denuncia->setCepDenuncia($_POST['txtCepDenuncia']);
    $denuncia->setUfDenuncia($_POST['txtUfDenuncia']);
    $denuncia->setLogradouroDenuncia($_POST['txtLogradouroDenuncia']);
    $denuncia->setBairroDenuncia($_POST['txtBairroDenuncia']);

    echo $denuncia->denunciar($denuncia);

?>