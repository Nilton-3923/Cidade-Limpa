<?php
    session_start();
    unset($_SESSION['idUsuario']);
    session_destroy();
    header("Location: ../form-cadastro/login-usuario.php");
?>