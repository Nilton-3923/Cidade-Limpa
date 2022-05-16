<?php   
    require_once("../classe/Denuncia.php");
    $denuncia = new Denuncia();

    echo $idDenuncia = $_GET['pk_idDenuncia'];

    echo $denuncia->deletarDenuncia($idDenuncia);
    header("Location:../area-restrita-usuario/index-restrita.php");

?>