<?php
    
    if($_SESSION['emailAdm'] != 'adm' || $_SESSION['senhaAdm'] != '123'){
        header("Location: ../login.php");
        exit();
    }
?>