<?php
    session_start();
    require_once("../classe/Usuario.php");
    require_once("../classe/Conexao.php");


    $usuario = new Usuario();
    
    $usuario->deletar();
    header("Location:../novo-login.php");
    

?>