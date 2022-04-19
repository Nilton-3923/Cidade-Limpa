<?php
    
    if($_SESSION['emailAdm'] != 'adm' || $_SESSION['senhaAdm'] != '123'){
        header("Location: ../form-cadastro/login-usuario.php");
        exit();
    }
?>