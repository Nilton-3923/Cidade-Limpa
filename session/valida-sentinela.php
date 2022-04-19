<?php

    if(!isset($_SESSION['idUsuario']) && empty($_SESSION['idUsuario'])){
        header("Location: ../form-cadastro/login-usuario.php");
        exit();
    }

?>