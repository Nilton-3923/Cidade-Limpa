<?php   
    require_once("../classe/Denuncia.php");
    $idImagemDenuncia = $_GET['pk_idImgDenun'];
    $idDenuncia = $_GET['pk_idDenuncia'];
    $denuncia = new Denuncia();
    echo $denuncia->deletarDenuncia($idDenuncia,$idImagemDenuncia);
    header("Location:../area-restrita-usuario/index-restrita.php");

?>