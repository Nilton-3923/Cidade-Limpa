<?php 
    require_once("../classe/Conexao.php");
    require_once("../classe/Denuncia.php");

    //Criação de um Objeto Denuncia

    $denuncia = new Denuncia();

    $denuncia->setTituloDenuncia($_POST['txtTituloDenuncia']);
    $denuncia->setDescDenuncia($_POST['txtDenuncia']);

    $denuncia->setCepDenuncia($_POST['txtCepDenuncia']);
    $denuncia->setBairroDenuncia($_POST['txtBairroDenuncia']);
    $denuncia->setDataDenuncia($_POST['txtDtDenuncia']);
    $denuncia->setUfDenuncia($_POST['txtUfDenuncia']);
    $denuncia->setLogradouroDenuncia($_POST['txtLogradouroDenuncia']);
    

    echo $denuncia->denunciar($denuncia);

?>