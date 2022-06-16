<?php
    session_start();
    unset($_SESSION['idUsuario']);
    session_destroy();
    header("Location: ../novo-login.php");
?>