<?php
    session_start();
    unset($_SESSION['idUsuario']);
    unset($_SESSION['nomeUsuario']);
    session_destroy();
    header("Location: ../novo-login.php");
?>
