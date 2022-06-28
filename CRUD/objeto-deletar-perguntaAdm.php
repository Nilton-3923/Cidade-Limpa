<?php
    require_once("../classe/Adm.php");

    $resposta = new Adm();

    $msg = $_GET['pk_idRespAdm'];

    echo $resposta->deletarMsg($msg);

    header("Location:../area-restrita-usuario/index-restrita.php");

?>