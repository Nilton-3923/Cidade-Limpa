<?php
    
    if($_SESSION['emailAdm'] != 'adm' || $_SESSION['senhaAdm'] != '123'){
        header("Location: ../novo-login.php");
        exit();
    }
?>