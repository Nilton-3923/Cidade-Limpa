<?php 
    require_once("../classe/Usuario.php");

    $resolvida = new Usuario();

    if (!empty($_POST['id'])){
        foreach($_POST['id'] as $id){
            $resolvida->denunciaRealizada($id);

            header("Location: ../area-restrita-usuario/index-restrita.php");
    
        }
    }

?>