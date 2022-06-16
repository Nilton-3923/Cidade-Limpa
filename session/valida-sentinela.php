<?php

    if(!isset($_SESSION['idUsuario']) && empty($_SESSION['idUsuario'])){
        header("Location: ../novo-login.php");
        exit();
    }

?>