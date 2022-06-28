<?php
    require_once("../classe/Denuncia.php");
    require_once("../classe/Adm.php");
    $resposta = new Adm();

    $msg = $_GET['pk_idRespAdm'];

    echo $resposta->deletarMsg($msg);
    
    $denuncia = new Denuncia();

    $idDenuncia = $_GET['pk_idDenuncia'];

    echo $denuncia->alterarStatus($idDenuncia);

    header("Location:../area-restrita-usuario/index-restrita.php");
?>