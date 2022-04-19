<?php
    session_start();
    unset($_SESSION['emailAdm']);
    unset($_SESSION['senhaAdm']);
    session_destroy();
    header("Location: ../login.php");
?>