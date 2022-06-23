<?php 
    require_once("../classe/Usuario.php");

    $resolvida = new Usuario();

    foreach($_POST['id'] as $id){
        $resolvida->denunciaRealizada($id);
    }


?>