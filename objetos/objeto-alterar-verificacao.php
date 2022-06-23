<?php

    require_once("../classe/Adm.php"); 

    $verificar = new Adm();
    foreach($_POST['id'] as $id){
        $verificar->verificarDenunciAdm($id);
    }
    header("Location: ../area-restrita-adm/tabela-denuncia.php");


?>