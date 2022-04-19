<?php

    if(!isset($_SESSION['idUsuario']) && empty($_SESSION['idUsuario'])){
        header("Location: ../login.php");
        exit();
    }

?>